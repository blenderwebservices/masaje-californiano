<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\BlockedDate;
use App\Models\Lead;
use App\Models\ScheduleSlot;
use App\Models\SpaService;
use App\Services\RagChatbotService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    /**
     * Muestra la Landing Page principal con toda la experiencia visual y sensorial.
     */
    public function index()
    {
        $services = SpaService::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $featuredServices = $services->where('is_featured', true);

        $posts = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $slots = ScheduleSlot::where('is_active', true)
            ->orderBy('time_slot', 'asc')
            ->get()
            ->groupBy('day_of_week');

        return view('welcome', compact('services', 'featuredServices', 'posts', 'slots'));
    }

    /**
     * Muestra un artículo del Blog de Bienestar.
     */
    public function blogPost(string $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $recentPosts = BlogPost::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog-show', compact('post', 'recentPosts'));
    }

    /**
     * Consulta disponibilidad de turnos para una fecha y zona.
     */
    public function checkAvailability(Request $request): JsonResponse
    {
        $dateStr = $request->input('date');
        $zone = $request->input('zone', 'cdmx');

        if (!$dateStr) {
            return response()->json(['available' => false, 'message' => 'Fecha requerida']);
        }

        try {
            $date = Carbon::parse($dateStr);
        } catch (\Exception $e) {
            return response()->json(['available' => false, 'message' => 'Fecha inválida']);
        }

        // 1. Verificar si la fecha está en el pasado
        if ($date->isPast() && !$date->isToday()) {
            return response()->json([
                'available' => false,
                'message' => 'No es posible agendar en fechas pasadas.',
                'slots' => [],
            ]);
        }

        // 2. Verificar bloqueos de agenda
        $blocked = BlockedDate::where('date', $date->toDateString())
            ->where(function ($q) use ($zone) {
                $q->where('zone_affected', 'todas')
                    ->orWhere('zone_affected', $zone);
            })
            ->first();

        if ($blocked) {
            return response()->json([
                'available' => false,
                'message' => $blocked->reason ?: 'Fecha no disponible para atención en esta zona.',
                'slots' => [],
            ]);
        }

        // 3. Obtener horarios predeterminados para el día de la semana
        $dayOfWeek = $date->dayOfWeek; // 0 = Domingo, 1 = Lunes...
        $defaultSlots = ScheduleSlot::where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->orderBy('time_slot', 'asc')
            ->pluck('time_slot')
            ->toArray();

        if (empty($defaultSlots)) {
            $defaultSlots = ['09:30', '12:00', '15:00', '17:30', '20:00'];
        }

        // 4. Obtener horarios ya ocupados por citas confirmadas
        $occupiedSlots = Appointment::where('appointment_date', $date->toDateString())
            ->whereIn('status', ['pendiente', 'confirmada', 'en_camino'])
            ->pluck('time_slot')
            ->toArray();

        // 5. Filtrar horarios disponibles
        $availableSlots = array_values(array_diff($defaultSlots, $occupiedSlots));

        return response()->json([
            'available' => count($availableSlots) > 0,
            'date' => $date->format('d/m/Y'),
            'slots' => $availableSlots,
            'occupied' => $occupiedSlots,
        ]);
    }

    /**
     * Procesa la solicitud de reserva directa de cita desde el front.
     */
    public function bookAppointment(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'spa_service_id' => 'required|exists:spa_services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'zone' => 'required|in:cdmx,edomex,playa_del_carmen',
            'address' => 'required|string|max:500',
            'client_notes' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Por favor indica tu nombre completo.',
            'phone.required' => 'Tu número de teléfono o WhatsApp es indispensable para confirmar tu cita.',
            'spa_service_id.required' => 'Selecciona el servicio de masaje o spa que deseas recibir.',
            'appointment_date.required' => 'Elige una fecha para tu sesión a domicilio.',
            'time_slot.required' => 'Selecciona un horario disponible.',
            'address.required' => 'Indica tu dirección completa para que el terapeuta acuda a tu domicilio.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $service = SpaService::findOrFail($request->spa_service_id);

        // 1. Registrar el Lead en el back
        $lead = Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'spa_service_id' => $service->id,
            'preferred_date' => $request->appointment_date,
            'preferred_time_slot' => $request->time_slot,
            'zone' => $request->zone,
            'address' => $request->address,
            'client_notes' => $request->client_notes,
            'status' => 'cita_agendada',
            'source' => 'web_landing_reserva',
        ]);

        // 2. Registrar la Cita oficial en el calendario
        $appointment = Appointment::create([
            'lead_id' => $lead->id,
            'spa_service_id' => $service->id,
            'client_name' => $request->name,
            'client_email' => $request->email,
            'client_phone' => $request->phone,
            'appointment_date' => $request->appointment_date,
            'time_slot' => $request->time_slot,
            'zone' => $request->zone,
            'full_address' => $request->address,
            'status' => 'confirmada',
            'client_notes' => $request->client_notes,
            'therapist_notes' => 'Cita reservada directamente desde la página web.',
        ]);

        // Enlace pre-armado a WhatsApp de Jesús Arturo
        $therapistPhone = '525512345678'; // Número de contacto oficial
        $formattedDate = Carbon::parse($request->appointment_date)->format('d/m/Y');
        $waMessage = "¡Hola Jesús Arturo! Acabo de solicitar una cita a domicilio en tu sitio web:\n"
            . "• Servicio: {$service->name}\n"
            . "• Fecha: {$formattedDate} a las {$request->time_slot}\n"
            . "• Mi nombre: {$request->name}\n"
            . "• Zona: " . ucfirst($request->zone) . "\n"
            . "• Dirección: {$request->address}\n"
            . "Quedo atento a tus indicaciones de preparación. ¡Gracias!";

        $whatsAppUrl = "https://wa.me/{$therapistPhone}?text=" . urlencode($waMessage);

        return response()->json([
            'success' => true,
            'message' => '¡Tu cita ha sido registrada con éxito! El terapeuta Jesús Arturo revisará los detalles y te enviará confirmación.',
            'appointment_id' => $appointment->id,
            'whatsapp_url' => $whatsAppUrl,
        ]);
    }

    /**
     * Registra un Lead general de contacto o dudas.
     */
    public function registerLead(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'zone' => 'nullable|string',
            'client_notes' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $lead = Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'zone' => $request->zone ?? 'cdmx',
            'client_notes' => $request->client_notes,
            'status' => 'nuevo',
            'source' => 'web_landing_contacto',
        ]);

        return response()->json([
            'success' => true,
            'message' => '¡Gracias por contactarnos! En breve Jesús Arturo se comunicará contigo por WhatsApp o llamada.',
            'lead_id' => $lead->id,
        ]);
    }

    /**
     * Endpoint del Chatbot con RAG.
     */
    public function chatbotMessage(Request $request, RagChatbotService $ragService): JsonResponse
    {
        $query = $request->input('message');

        if (!$query || trim($query) === '') {
            return response()->json([
                'answer' => 'Por favor escribe tu duda o consulta sobre nuestros servicios de Masaje Californiano a domicilio.',
                'sources' => [],
                'suggestions' => [],
            ]);
        }

        $result = $ragService->answer($query);

        return response()->json($result);
    }
}

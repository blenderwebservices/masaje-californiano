<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\Lead;
use App\Models\SpaService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasajeCalifornianoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Verifica que la Landing Page cargue exitosamente con los elementos esenciales.
     */
    public function test_landing_page_loads_with_therapist_and_services(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Masaje Californiano');
        $response->assertSee('Jesús Arturo Robles Gutiérrez');
        $response->assertSee('Servicio Profesional a Domicilio');
        $response->assertSee('Relajación');
        $response->assertSee('Equilibrio');
    }

    /**
     * Verifica que el endpoint de disponibilidad devuelva turnos disponibles.
     */
    public function test_availability_endpoint_returns_slots(): void
    {
        $tomorrow = now()->addDay()->toDateString();

        $response = $this->getJson("/api/disponibilidad?date={$tomorrow}&zone=cdmx");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'available',
            'date',
            'slots',
        ]);
        $this->assertTrue($response->json('available'));
        $this->assertNotEmpty($response->json('slots'));
    }

    /**
     * Verifica el flujo de agendar cita y registro sincrónico de lead en el back.
     */
    public function test_book_appointment_creates_lead_and_appointment(): void
    {
        $service = SpaService::first();
        $this->assertNotNull($service);

        $payload = [
            'name' => 'Lucía Ferraro',
            'phone' => '5511223344',
            'email' => 'lucia.ferraro@test.com',
            'spa_service_id' => $service->id,
            'appointment_date' => now()->addDays(3)->toDateString(),
            'time_slot' => '17:30',
            'zone' => 'cdmx',
            'address' => 'Col. Roma Norte, Calle Colima 210, Int 4, CDMX',
            'client_notes' => 'Tensión en cuello por largas horas frente a la laptop.',
        ];

        $response = $this->postJson('/api/agendar-cita', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $this->assertNotNull($response->json('whatsapp_url'));

        // Verificar que se guardó el Lead
        $this->assertDatabaseHas('leads', [
            'name' => 'Lucía Ferraro',
            'phone' => '5511223344',
            'status' => 'cita_agendada',
        ]);

        // Verificar que se creó la Cita
        $this->assertDatabaseHas('appointments', [
            'client_name' => 'Lucía Ferraro',
            'time_slot' => '17:30',
            'status' => 'confirmada',
        ]);
    }

    /**
     * Verifica el registro de leads de contacto general.
     */
    public function test_contact_lead_registers_successfully(): void
    {
        $payload = [
            'name' => 'Roberto Garza',
            'phone' => '5599887766',
            'email' => 'roberto.garza@test.com',
            'zone' => 'cdmx',
            'client_notes' => 'Quisiera saber si dan servicio para dos personas consecutivas el mismo día.',
        ];

        $response = $this->postJson('/api/contacto-lead', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('leads', [
            'name' => 'Roberto Garza',
            'status' => 'nuevo',
        ]);
    }

    /**
     * Verifica que el Chatbot con RAG responda utilizando la base de conocimiento.
     */
    public function test_chatbot_rag_answers_queries(): void
    {
        $response = $this->postJson('/api/chatbot', [
            'message' => '¿Qué es el Masaje Californiano y qué beneficios tiene?',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'query',
            'answer',
            'sources',
            'suggestions',
        ]);

        $answer = $response->json('answer');
        $this->assertStringContainsString('Masaje Californiano', $answer);
        $this->assertStringContainsString('relajación', mb_strtolower($answer, 'UTF-8'));
    }

    /**
     * Verifica que la vista del artículo de blog cargue correctamente.
     */
    public function test_blog_post_view_loads(): void
    {
        $post = BlogPost::first();
        $this->assertNotNull($post);

        $response = $this->get("/blog/{$post->slug}");

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    /**
     * Verifica el acceso al panel de Filament y la autenticación de usuarios.
     */
    public function test_filament_admin_panel_authentication(): void
    {
        // Invitado no autenticado es redirigido al login
        $guestResponse = $this->get('/admin');
        $guestResponse->assertRedirect('/admin/login');

        // La página de login carga exitosamente
        $loginResponse = $this->get('/admin/login');
        $loginResponse->assertStatus(200);

        // Administrador autenticado accede al Dashboard
        $admin = User::where('email', 'admin@masajecaliforniano.mx')->first();
        $this->assertNotNull($admin);

        $authResponse = $this->actingAs($admin)->get('/admin');
        $authResponse->assertStatus(200);
    }
}

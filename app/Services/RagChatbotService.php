<?php

namespace App\Services;

use App\Models\KnowledgeDocument;
use App\Models\SpaService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RagChatbotService
{
    /**
     * Process a user query through the RAG pipeline.
     */
    public function answer(string $query): array
    {
        $normalizedQuery = $this->normalizeText($query);
        $tokens = array_filter(explode(' ', $normalizedQuery), fn ($t) => strlen($t) > 2);

        // 1. Recuperar contexto de la base de conocimiento (RAG Retrieval)
        $relevantDocs = $this->retrieveContext($tokens, $normalizedQuery);

        // 2. Extraer servicios relevantes si se mencionan
        $matchedServices = $this->matchServices($tokens);

        // 3. Generar respuesta coherente y contextualizada
        $response = $this->generateAnswer($query, $relevantDocs, $matchedServices);

        // 4. Preguntas sugeridas para continuar la conversación
        $suggestions = $this->getSuggestedQuestions($tokens);

        return [
            'query' => $query,
            'answer' => $response,
            'sources' => $relevantDocs->pluck('title')->take(3)->values(),
            'suggestions' => $suggestions,
        ];
    }

    /**
     * Recupera documentos relevantes ponderando título, keywords y contenido.
     */
    protected function retrieveContext(array $tokens, string $normalizedQuery): Collection
    {
        $documents = KnowledgeDocument::where('is_active', true)->get();

        $scored = $documents->map(function (KnowledgeDocument $doc) use ($tokens, $normalizedQuery) {
            $score = 0;
            $title = $this->normalizeText($doc->title);
            $keywords = $this->normalizeText($doc->keywords ?? '');
            $content = $this->normalizeText($doc->content);

            foreach ($tokens as $token) {
                // Mayor peso en título
                if (str_contains($title, $token)) {
                    $score += 5;
                }
                // Peso en palabras clave
                if (str_contains($keywords, $token)) {
                    $score += 4;
                }
                // Peso en contenido
                if (str_contains($content, $token)) {
                    $score += 1;
                }
            }

            // Bonificación si coincide con frases completas
            if (str_contains($normalizedQuery, 'precio') || str_contains($normalizedQuery, 'costo')) {
                if (str_contains($keywords, 'precio') || str_contains($content, 'precio')) {
                    $score += 8;
                }
            }
            if (str_contains($normalizedQuery, 'domicilio') || str_contains($normalizedQuery, 'casa')) {
                if (str_contains($keywords, 'domicilio') || str_contains($keywords, 'preparacion')) {
                    $score += 6;
                }
            }
            if (str_contains($normalizedQuery, 'zona') || str_contains($normalizedQuery, 'cdmx') || str_contains($normalizedQuery, 'playa')) {
                if (str_contains($keywords, 'zonas') || str_contains($keywords, 'cobertura')) {
                    $score += 8;
                }
            }
            if (str_contains($normalizedQuery, 'jesus') || str_contains($normalizedQuery, 'terapeuta') || str_contains($normalizedQuery, 'quien')) {
                if (str_contains($keywords, 'terapeuta') || str_contains($keywords, 'credenciales')) {
                    $score += 8;
                }
            }
            if (str_contains($normalizedQuery, 'que es') || str_contains($normalizedQuery, 'californiano')) {
                if (str_contains($keywords, 'tecnica') || str_contains($keywords, 'definicion')) {
                    $score += 8;
                }
            }

            $doc->relevance_score = $score;
            return $doc;
        });

        // Ordenar por relevancia
        return $scored->sortByDesc('relevance_score')->filter(fn ($d) => $d->relevance_score > 0);
    }

    /**
     * Identifica servicios de spa relacionados.
     */
    protected function matchServices(array $tokens): Collection
    {
        return SpaService::where('is_active', true)->get()->filter(function ($service) use ($tokens) {
            $text = $this->normalizeText($service->name . ' ' . $service->short_description . ' ' . $service->category);
            foreach ($tokens as $token) {
                if (str_contains($text, $token)) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Formula la respuesta con tono empático y sereno de spa.
     */
    protected function generateAnswer(string $query, Collection $docs, Collection $services): string
    {
        $q = $this->normalizeText($query);

        // 1. Saludos iniciales
        if (in_array($q, ['hola', 'buenos dias', 'buenas tardes', 'buenas noches', 'saludos', 'hola que tal', 'menu'])) {
            return "¡Hola! Es un placer saludarte. Soy el asistente virtual de **Masaje Californiano a Domicilio**. \n\nPuedo orientarte sobre la técnica del masaje californiano, nuestros servicios de spa y faciales, zonas de cobertura (CDMX, Estado de México y Playa del Carmen), preparación de tu espacio en casa o ayudarte a reservar tu cita con el terapeuta Jesús Arturo Robles Gutiérrez.\n\n¿En qué te gustaría que te apoye hoy?";
        }

        // 2. Si no hay contexto específico, respuesta general amigable
        if ($docs->isEmpty() && $services->isEmpty()) {
            return "Gracias por tu mensaje. Para brindarte la mejor atención sobre nuestros servicios de **Masaje Californiano y terapias de spa a domicilio**, puedes consultarme sobre:\n\n- **¿Qué es el Masaje Californiano y cuáles son sus beneficios?**\n- **Zonas de cobertura en CDMX, Edomex y Playa del Carmen.**\n- **¿Qué necesitas en casa para la sesión? (Llevamos camilla y todo el equipo).**\n- **Servicios disponibles (Clásico, Descontracturante, Faciales, Rituales).**\n\nTambién puedes agendar tu cita directamente en la sección de reservas o escribirnos directamente a WhatsApp.";
        }

        // 3. Consultas sobre Precios y Cotizaciones
        if (str_contains($q, 'precio') || str_contains($q, 'costo') || str_contains($q, 'cuanto cuesta') || str_contains($q, 'tarifa')) {
            return "Por el momento, las sesiones se cotizan de forma **personalizada** según el servicio seleccionado (Masaje Californiano Clásico, Tejido Profundo, Faciales o Rituales), la duración (de 60 a 105 minutos) y la zona de tu domicilio.\n\nEl terapeuta Jesús Arturo acude con camilla profesional ergonómica, sábanas esterilizadas, aceites esenciales tibios y música ambiental.\n\nTe invitamos a seleccionar tu servicio y zona en nuestro formulario de reservas para brindarte la cotización exacta y confirmar disponibilidad en tu horario preferido.";
        }

        // 4. Consultas sobre Quién atiende / Terapeuta / Jesús Arturo
        if (str_contains($q, 'quien') || str_contains($q, 'terapeuta') || str_contains($q, 'jesus') || str_contains($q, 'certificado') || str_contains($q, 'robles')) {
            $doc = $docs->firstWhere('category', 'terapeuta') ?? $docs->first();
            return "Las sesiones son impartidas directamente por **Jesús Arturo Robles Gutiérrez**, terapeuta certificado en Masaje Californiano por un prestigioso instituto en la Ciudad de México.\n\nSu práctica se fundamenta en el **respeto absoluto, la calidez humana, la discreción y el profesionalismo**, creando un ambiente de confianza y seguridad en la privacidad de tu hogar.\n\nPuedes conocer más de su trayectoria y estilo de trabajo en Instagram: **@jessarturo_art** o **@masajecaliforniano.mx**.";
        }

        // 5. Consultas sobre Zonas de Cobertura
        if (str_contains($q, 'zona') || str_contains($q, 'donde') || str_contains($q, 'cobertura') || str_contains($q, 'cdmx') || str_contains($q, 'playa') || str_contains($q, 'mexico')) {
            return "Ofrecemos atención a domicilio en las siguientes áreas:\n\n1. **Ciudad de México (CDMX):** Polanco, Roma, Condesa, Del Valle, Juárez, Cuauhtémoc, Coyoacán, San Ángel, Nápoles, Santa Fe e Interlomas.\n2. **Estado de México (Edomex):** Huixquilucan, Zona Esmeralda, Ciudad Satélite y áreas colindantes.\n3. **Playa del Carmen y Riviera Maya:** Disponible en periodos y temporadas de movilidad del terapeuta (Playacar, Centro, Mayakoba).\n\nSi te encuentras en otra zona cercana, puedes consultarnos y con gusto verificamos viabilidad de traslado.";
        }

        // 6. Consultas sobre ¿Qué se necesita en casa? / Camilla
        if (str_contains($q, 'camilla') || str_contains($q, 'necesito') || str_contains($q, 'incluye') || str_contains($q, 'casa') || str_contains($q, 'espacio') || str_contains($q, 'toalla')) {
            return "¡Tú no tienes que preocuparte por nada! El terapeuta **Jesús Arturo lleva absolutamente todo el equipo profesional** hasta tu puerta:\n\n- **Camilla profesional ergonómica plegable** (acolchada y con cabezal regulable).\n- **Sábanas de algodón y toallas térmicas desinfectadas**.\n- **Aceites vegetales tibios con aromaterapia relajante** (lavanda, bergamota, eucalipto).\n- **Música ambiental envolvente** con altavoz binaural.\n\n**Lo único que requieres tener en tu hogar:**\nUn espacio libre de aprox. 2 x 2.5 metros (en tu recámara, sala o estudio) donde el terapeuta pueda moverse alrededor, temperatura agradable y un enchufe cercano.";
        }

        // 7. Consultas sobre ¿Qué es el Masaje Californiano?
        if (str_contains($q, 'californiano') || str_contains($q, 'que es') || str_contains($q, 'tecnica') || str_contains($q, 'beneficio') || str_contains($q, 'consiste')) {
            return "El **Masaje Californiano** es una técnica de relajación profunda de cuerpo entero nacida en Big Sur, California. Se distingue por sus **movimientos largos, fluidos, rítmicos y envolventes** que recorren el cuerpo como olas continuas.\n\n**Sus 4 beneficios cardinales:**\n- **Relajación profunda:** Sedación inmediata del sistema nervioso y reducción drástica del cortisol.\n- **Equilibrio emocional:** Reconexión mente-cuerpo que disipa la fatiga y ansiedad.\n- **Libera tensiones:** Suelta nudos musculares y rigidez sin dolor traumático.\n- **Bienestar integral:** Despertar de la vitalidad y una sensación flotante de ligereza.\n\nEl servicio a domicilio te permite descansar plácidamente en tu propia cama al finalizar, sin tener que conducir ni romper la relajación.";
        }

        // 8. Consultas sobre Horarios y Cómo Reservar
        if (str_contains($q, 'horario') || str_contains($q, 'cita') || str_contains($q, 'agendar') || str_contains($q, 'reserv') || str_contains($q, 'turno')) {
            return "Nuestros horarios habituales de atención a domicilio son:\n\n- **Lunes a Sábado:** Turnos a las 09:30, 12:00, 15:00, 17:30 y 20:00 hrs.\n- **Domingos:** Turnos a las 10:00, 13:00, 16:00 y 18:30 hrs.\n\nPuedes reservar directamente en el módulo de citas en esta misma página seleccionando tu servicio, zona, fecha y hora, o agendar por mensaje de WhatsApp para una confirmación inmediata.";
        }

        // 9. Respuesta sintética basada en los documentos RAG más relevantes
        $topDoc = $docs->first();
        return "Basado en nuestra base de información de **{$topDoc->title}**:\n\n{$topDoc->content}\n\nSi deseas agendar tu sesión a domicilio o tienes alguna petición especial sobre tu salud o tensiones musculares, con gusto te asistimos.";
    }

    /**
     * Ofrece preguntas sugeridas según el contexto.
     */
    protected function getSuggestedQuestions(array $tokens): array
    {
        return [
            '¿Qué es el Masaje Californiano?',
            '¿Qué zonas cubren a domicilio?',
            '¿Qué equipo llevan a mi casa?',
            '¿Cuáles son los horarios para agendar?',
        ];
    }

    protected function normalizeText(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', '¿', '?', '¡', '!', ',', '.', ':', ';', '(', ')', '"', '\''],
            ['a', 'e', 'i', 'o', 'u', 'u', 'n', '', '', '', '', '', '', '', '', '', '', '', ''],
            $text
        );
        return trim(preg_replace('/\s+/', ' ', $text));
    }
}

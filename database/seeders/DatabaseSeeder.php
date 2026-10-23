<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\BlockedDate;
use App\Models\KnowledgeDocument;
use App\Models\Lead;
use App\Models\ScheduleSlot;
use App\Models\SpaService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Usuarios del Sistema
        $admin = User::firstOrCreate(
            ['email' => 'admin@masajecaliforniano.mx'],
            [
                'name' => 'Jesús Arturo Robles Gutiérrez',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+52 55 1234 5678',
            ]
        );

        $terapeuta = User::firstOrCreate(
            ['email' => 'jesus@masajecaliforniano.mx'],
            [
                'name' => 'Jesús Arturo Robles Gutiérrez (Terapeuta)',
                'password' => Hash::make('password'),
                'role' => 'terapeuta',
                'phone' => '+52 55 9876 5432',
            ]
        );

        // 2. Servicios de Spa y Masajes
        $servicios = [
            [
                'name' => 'Masaje Californiano Clásico a Domicilio',
                'slug' => 'masaje-californiano-clasico-a-domicilio',
                'category' => 'masaje_californiano',
                'duration_minutes' => 75,
                'short_description' => 'Movimientos largos, fluidos y envolventes que conectan cuerpo y mente, liberando el estrés en la privacidad de tu hogar.',
                'description' => 'El Masaje Californiano nació en el prestigioso Instituto Esalen en Big Sur, California. Se caracteriza por sus pases largos, continuos e integradores que recorren el cuerpo como olas cálidas. La sesión se realiza con aceites tibios 100% vegetales y toallas térmicas, adaptando el ritmo a la respiración del consultante para restablecer la paz interior, liberar tensiones crónicas y promover un estado meditativo y reconfortante.',
                'benefits' => [
                    'Relajación profunda del sistema nervioso central',
                    'Equilibrio y calma emocional inmediata',
                    'Alivio de contracturas y nudos musculares acumulados',
                    'Sensación integradora de bienestar y armonía corporal',
                    'Mejora de la circulación sanguínea y oxigenación celular',
                ],
                'includes' => [
                    'Camilla ergonómica profesional de masaje llevada hasta tu hogar',
                    'Sábanas de algodón y toallas térmicas esterilizadas',
                    'Aceites vegetales tibios con esencias relajantes de lavanda y bergamota',
                    'Música ambiental envolvente de relajación con altavoz binaural',
                    'Aromaterapia sutil con difusor botánico ultrasónico',
                ],
                'recommended_for' => 'Personas con estrés laboral, ansiedad, fatiga mental, sobrecarga emocional o que buscan un momento íntimo de paz y autocuidado.',
                'image_url' => '/images/hero-massage.jpeg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Masaje Californiano de Tejido Profundo & Descontracturante',
                'slug' => 'masaje-californiano-tejido-profundo-descontracturante',
                'category' => 'masaje_californiano',
                'duration_minutes' => 90,
                'short_description' => 'Fusión de maniobras envolventes californianas con presión profunda y focalizada en espalda, cuello y hombros.',
                'description' => 'Combina la fluidez del estilo californiano con técnicas profundas miofasciales. Se concentra en las áreas con mayor sobrecarga postural (trapecios, zona lumbar, cuello y escápulas) sin generar dolor traumático, utilizando bálsamos tibios de árnica, romero y calor localizado para soltar la musculatura rígida de manera progresiva y respetuosa.',
                'benefits' => [
                    'Disolución de contracturas profundas y puntos gatillo',
                    'Corrección de rigidez postural por jornadas sedentarias',
                    'Aumento de la movilidad articular y descanso lumbar',
                    'Recuperación muscular post-entrenamiento o estrés prolongado',
                ],
                'includes' => [
                    'Camilla con cabezal ergonómico regulable',
                    'Bálsamo terapéutico descontracturante con extractos de árnica y romero',
                    'Compresas calientes para ablandar el tejido muscular antes de la presión',
                    'Técnicas de estiramiento pasivo asistido al finalizar la sesión',
                ],
                'recommended_for' => 'Quienes sufren de dolores de espalda, tensión en hombros y cuello, rigidez al despertar o tensiones físicas crónicas.',
                'image_url' => '/images/hero-massage.jpeg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Tratamiento Facial Hidratante, Calmante & Rejuvenecedor',
                'slug' => 'tratamiento-facial-hidratante-calmante-rejuvenecedor',
                'category' => 'faciales',
                'duration_minutes' => 60,
                'short_description' => 'Limpieza botánica suave, masaje miofascial facial lifting y mascarilla nutritiva en la comodidad de tu hogar.',
                'description' => 'Una experiencia de spa facial concebida para pieles fatigadas y expuestas al estrés urbano. Incluye doble limpieza vegetal, exfoliación enzimática gentil, masaje lifting suave que estimula los músculos tensores faciales, drenaje de bolsas palpebrales y mascarilla oclusiva de ácido hialurónico botánico y caléndula.',
                'benefits' => [
                    'Luminosidad inmediata y suavidad aterciopelada al tacto',
                    'Drenaje de líquidos retenidos y desinflamación facial',
                    'Relajación de la mandíbula y ceño fruncido (tensión por bruxismo)',
                    'Nutrición profunda con activos orgánicos de alta tolerancia',
                ],
                'includes' => [
                    'Limpieza botánica con agua micelar de rosas y emulsión calmante',
                    'Exfoliación suave sin fricción agresiva',
                    'Masaje craneofacial y drenaje con rodillo de jade frío',
                    'Mascarilla nutritiva según tipo de piel y sérum antioxidante con FPS',
                ],
                'recommended_for' => 'Todo tipo de piel que busque revitalización, frescura, relajación facial y un brillo saludable sin aparatología invasiva.',
                'image_url' => '/images/hero-massage.jpeg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Ritual Holístico: Californiano Integral + Aromaterapia & Reflexología',
                'slug' => 'ritual-holistico-californiano-aromaterapia-reflexologia',
                'category' => 'rituales',
                'duration_minutes' => 105,
                'short_description' => 'El ritual de máxima desconexión: masaje californiano completo, reflexología podal y selección aromática personalizada.',
                'description' => 'El servicio insignia de más alto nivel. Comienza con una bienvenida aromática y un reconfortante masaje podal que activa zonas reflejas clave, seguido del masaje californiano corporal completo con pases envolventes que abarcan desde los dedos de los pies hasta la coronilla, creando una sensación de ligereza flotante inigualable.',
                'benefits' => [
                    'Experiencia holística de desconexión absoluta del ritmo acelerado',
                    'Estimulación reflexológica que armoniza el balance general del cuerpo',
                    'Inducción a un sueño profundo y reparador durante la noche',
                    'Renovación energética y sensación de ligereza corporal',
                ],
                'includes' => [
                    'Ritual de toallas calientes perfumadas en pies y espalda',
                    'Aceites esenciales de grado terapéutico personalizados (lavanda, sándalo o cedro)',
                    'Sesión de reflexología podal de 25 minutos con crema botánica de menta fresca',
                    'Masaje californiano de cuerpo completo de 80 minutos',
                ],
                'recommended_for' => 'Quienes desean regalarse o regalar una tarde completa de bienestar, desintoxicación de estrés y mimo integral.',
                'image_url' => '/images/infographic.jpeg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Ritual Drenaje Suave & Alivio de Piernas Ligeras',
                'slug' => 'ritual-drenaje-suave-alivio-piernas-ligeras',
                'category' => 'terapias_holisticas',
                'duration_minutes' => 60,
                'short_description' => 'Maniobras drenantes y refrescantes para reactivar la circulación y aliviar la pesadez en piernas y pies.',
                'description' => 'Especialmente pensado para personas que pasan muchas horas de pie o sentadas, tras viajes largos en avión o que experimentan pesadez en las extremidades inferiores. Aplica técnicas de drenaje linfático suave y deslizamientos ascendentes que devuelven la soltura y frescura a las piernas.',
                'benefits' => [
                    'Disminución visible de inflamación y retención de líquidos',
                    'Sensación inmediata de frescura, descanso y ligereza',
                    'Reactivación del retorno venoso y linfático',
                    'Alivio del cansancio muscular acumulado',
                ],
                'includes' => [
                    'Gel criogénico natural con alcanfor, mentol y castaño de indias',
                    'Compresas tibias para activación y toques fríos reconfortantes',
                    'Elevación biomecánica durante el drenaje',
                ],
                'recommended_for' => 'Viajeros frecuentes, personas con largas jornadas laborales, deportistas en fase de descarga y mujeres con piernas cansadas.',
                'image_url' => '/images/infographic.jpeg',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        $serviceModels = [];
        foreach ($servicios as $item) {
            $serviceModels[$item['slug']] = SpaService::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }

        // 3. Horarios Predeterminados Disponibles (Lunes a Domingo)
        $horariosSemana = ['09:30', '12:00', '15:00', '17:30', '20:00'];
        $horariosFinSemana = ['10:00', '13:00', '16:00', '18:30'];

        for ($day = 1; $day <= 5; $day++) { // Lunes a Viernes
            foreach ($horariosSemana as $hora) {
                ScheduleSlot::firstOrCreate([
                    'day_of_week' => $day,
                    'time_slot' => $hora,
                ], ['is_active' => true]);
            }
        }

        // Sábado y Domingo
        foreach ([6, 0] as $day) {
            foreach ($horariosFinSemana as $hora) {
                ScheduleSlot::firstOrCreate([
                    'day_of_week' => $day,
                    'time_slot' => $hora,
                ], ['is_active' => true]);
            }
        }

        // 4. Fechas Bloqueadas de ejemplo
        BlockedDate::firstOrCreate(
            ['date' => Carbon::now()->addDays(20)->toDateString()],
            [
                'reason' => 'Viaje y estancia de servicio en Playa del Carmen / Riviera Maya',
                'zone_affected' => 'cdmx',
            ]
        );

        // 5. Leads de ejemplo
        $lead1 = Lead::firstOrCreate(
            ['phone' => '5551234567'],
            [
                'name' => 'Mariana Castillo Solís',
                'email' => 'mariana.castillo@gmail.com',
                'spa_service_id' => $serviceModels['masaje-californiano-clasico-a-domicilio']->id,
                'preferred_date' => Carbon::now()->addDays(2),
                'preferred_time_slot' => '17:30',
                'zone' => 'cdmx',
                'address' => 'Col. Condesa, Av. Ámsterdam 142, Depto 302, Cuauhtémoc, CDMX',
                'client_notes' => 'Tengo mucha tensión acumulada en el cuello por trabajo frente a la computadora.',
                'status' => 'cita_agendada',
                'source' => 'web_landing',
                'internal_notes' => 'Cliente validada. Confirmó fecha y disponibilidad de espacio para colocar la camilla.',
            ]
        );

        $lead2 = Lead::firstOrCreate(
            ['phone' => '5578901234'],
            [
                'name' => 'Carlos Mendoza Rivas',
                'email' => 'carlos.mendoza@corporativo.mx',
                'spa_service_id' => $serviceModels['masaje-californiano-tejido-profundo-descontracturante']->id,
                'preferred_date' => Carbon::now()->addDays(3),
                'preferred_time_slot' => '20:00',
                'zone' => 'cdmx',
                'address' => 'Polanco V Sección, Homero 820, Miguel Hidalgo, CDMX',
                'client_notes' => 'Dolor lumbar después de jugar pádel. Me interesa saber si atienden en las noches.',
                'status' => 'contactado',
                'source' => 'web_landing',
                'internal_notes' => 'Se le envió mensaje de WhatsApp para validar dirección y confirmar turno.',
            ]
        );

        $lead3 = Lead::firstOrCreate(
            ['phone' => '9841234567'],
            [
                'name' => 'Sofía Villarreal Krause',
                'email' => 'sofia.villarreal@yahoo.com',
                'spa_service_id' => $serviceModels['ritual-holistico-californiano-aromaterapia-reflexologia']->id,
                'preferred_date' => Carbon::now()->addDays(21),
                'preferred_time_slot' => '10:00',
                'zone' => 'playa_del_carmen',
                'address' => 'Playacar Fase II, Retorno Xaman-Ha, Casa 14, Playa del Carmen, Q.R.',
                'client_notes' => 'Estaremos de descanso familiar y queremos agendar el ritual para dos personas o individual extendido.',
                'status' => 'nuevo',
                'source' => 'chatbot_rag',
                'internal_notes' => 'Prospecto registrado vía el Asistente Virtual en temporada de Riviera Maya.',
            ]
        );

        // 6. Citas de ejemplo
        Appointment::firstOrCreate(
            [
                'client_phone' => '5551234567',
                'appointment_date' => Carbon::now()->addDays(2)->toDateString(),
            ],
            [
                'lead_id' => $lead1->id,
                'spa_service_id' => $serviceModels['masaje-californiano-clasico-a-domicilio']->id,
                'client_name' => 'Mariana Castillo Solís',
                'client_email' => 'mariana.castillo@gmail.com',
                'time_slot' => '17:30',
                'zone' => 'cdmx',
                'full_address' => 'Col. Condesa, Av. Ámsterdam 142, Depto 302, Cuauhtémoc, CDMX (Interfón 302)',
                'status' => 'confirmada',
                'client_notes' => 'Tensión en cuello y espalda alta.',
                'therapist_notes' => 'Llevar juego de aceites de bergamota y toallas térmicas adicionales.',
                'reminder_sent' => true,
            ]
        );

        // 7. Artículos de Blog
        $articulos = [
            [
                'title' => '¿Cómo preparar tu hogar para recibir un masaje californiano profesional?',
                'slug' => 'como-preparar-tu-hogar-para-un-masaje-californiano-a-domicilio',
                'excerpt' => 'Recibir un masaje de spa en la privacidad de tu casa es un lujo reconfortante. Descubre los sencillos pasos para acondicionar tu espacio ideal.',
                'content' => "Recibir un servicio de masaje profesional en tu propio hogar ofrece una ventaja insuperable: no tienes que lidiar con el tráfico, el estrés de desplazarte ni romper el estado de profunda relajación una vez concluida la sesión.\n\nPara garantizar una experiencia sublime, te compartimos estas recomendaciones:\n\n### 1. El espacio para la camilla\nJesús Arturo acude con una camilla ergonómica profesional plegable. Solo se requiere un espacio despejado de aproximadamente 2 x 2.5 metros (puede ser en tu recámara, sala o estudio) donde el terapeuta pueda caminar cómodamente alrededor.\n\n### 2. Temperatura y calidez\nEl cuerpo suele disminuir ligeramente de temperatura durante una relajación profunda. Procura que la habitación esté cálida (entre 22°C y 24°C), libre de corrientes de aire directas de ventiladores o aire acondicionado.\n\n### 3. Iluminación tenue y silencio\nBajar la intensidad de las luces, cerrar cortinas o encender unas velas suaves predispone a tu mente a soltar el control. Se sugiere silenciar notificaciones del teléfono móvil durante los 75 o 90 minutos de tu sesión.\n\n### 4. Ducha previa y ropa cómoda\nUna ducha tibia previa no solo ayuda a higienizar la piel, sino que dilata los poros y relaja los tejidos musculares, facilitando la absorción de los aceites vegetales terapéuticos.",
                'category' => 'Bienestar en Casa',
                'reading_time' => '4 min de lectura',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => '¿Qué diferencia al Masaje Californiano del masaje sueco o descontracturante tradicional?',
                'slug' => 'diferencias-clave-masaje-californiano-vs-tradicional',
                'excerpt' => 'A diferencia de los masajes segmentados, el Masaje Californiano concibe al cuerpo como una totalidad armónica mediante movimientos largos e integradores.',
                'content' => "Muchas personas confunden las diferentes disciplinas del masaje. Si bien todas buscan aliviar la incomodidad física, el Masaje Californiano tiene una filosofía profundamente diferente:\n\n### Movimientos continuos y envolventes\nMientras que el masaje tradicional trabaja segmento por segmento (primero un brazo, luego el otro, luego la pierna), el estilo californiano utiliza pases continuos y fluidos que viajan desde los pies hasta la espalda y cuello. Esto genera una sensación de integración en la mente del consultante.\n\n### El toque consciente y empático\nEl terapeuta no ve el cuerpo como una máquina mecánica, sino como un ser integral. La presión no es agresiva ni forzada; entra en diálogo con la respiración del cliente, permitiendo que la musculatura se suelte voluntariamente por relajación neurológica, no por impacto de dolor.\n\n### Efecto ansiolítico demostrado\nAl reducir drásticamente los niveles de cortisol y estimular la producción de endorfinas y serotonina, el masaje californiano es especialmente eficaz para combatir el insomnio, la sobrecarga mental y el agotamiento crónico.",
                'category' => 'Técnicas de Relajación',
                'reading_time' => '5 min de lectura',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'El impacto del autocuidado: Por qué agendar momentos de pausa renueva tu energía vital',
                'slug' => 'impacto-autocuidado-pausa-energia-vital',
                'excerpt' => 'En el ritmo acelerado de las grandes ciudades, regalarse una hora de silencio y cuidado corporal no es un capricho: es medicina preventiva.',
                'content' => "Vivimos en una cultura de la hiperproductividad donde detenerse parece una transgresión. Sin embargo, el cuerpo pasa factura a través de contracturas en cuello, migrañas por tensión, bruxismo y fatiga crónica.\n\nAgendar un masaje californiano a domicilio es establecer un límite sagrado entre las exigencias cotidianas y tu propio bienestar:\n\n- **Tu espacio:** Tu hogar se transforma en un santuario de paz.\n- **Tu momento:** 90 minutos donde nada ni nadie demanda tu atención.\n- **Tu bienestar:** Restaurar la vitalidad para volver a tu día a día con lucidez, paciencia y energía renovada.",
                'category' => 'Salud Integral',
                'reading_time' => '3 min de lectura',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
            ],
        ];

        foreach ($articulos as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }

        // 8. Base de Conocimiento RAG para el Chatbot Virtual
        $documentosRAG = [
            [
                'title' => 'Misión y Visión de Masaje Californiano a Domicilio',
                'category' => 'terapeuta',
                'content' => "MISIÓN: Brindar servicios profesionales de Masaje Californiano a domicilio, ofreciendo bienestar físico y emocional mediante experiencias personalizadas de relajación profunda, realizadas con respeto, profesionalismo, confidencialidad y calidez humana.\n\nVISIÓN: Ser la opción preferida de masaje terapéutico y de relajación a domicilio, reconocida por la calidad del servicio, la confianza de nuestros clientes y nuestro compromiso con el bienestar integral de cada persona.\n\nLEMA: Tu espacio • Tu momento • Tu bienestar. La relajación llega hasta tu puerta.",
                'keywords' => 'mision, vision, lema, valores, confianza, respeto, confidencialidad, calidez, filosofía',
                'sort_order' => 1,
            ],
            [
                'title' => '¿Qué es el Masaje Californiano y cómo se realiza?',
                'category' => 'tecnica_masaje',
                'content' => "El Masaje Californiano es una técnica de relajación corporal holística que utiliza movimientos largos, fluidos y envolventes para generar una profunda sensación de armonía entre cuerpo y mente. Ayuda a disminuir el estrés, liberar tensiones acumuladas y promover una profunda sensación de tranquilidad.\n\nSus cuatro pilares fundamentales son:\n1. Relajación profunda del sistema nervioso.\n2. Equilibrio emocional y serenidad mental.\n3. Liberación de tensiones y contracturas musculares sin dolor traumático.\n4. Bienestar integral y reconexión consigo mismo.\n\nSe realiza sobre una camilla profesional ergonómica utilizando aceites vegetales y esenciales tibios, adaptando el ritmo a la respiración del cliente.",
                'keywords' => 'que es, definicion, tecnica, movimientos largos, envolventes, relajacion profunda, estres, tensiones, bienestar',
                'sort_order' => 2,
            ],
            [
                'title' => 'Sobre el Terapeuta: Jesús Arturo Robles Gutiérrez',
                'category' => 'terapeuta',
                'content' => "Jesús Arturo Robles Gutiérrez es terapeuta profesional certificado en Masaje Californiano por un reconocido instituto especializado en la Ciudad de México.\n\nCuenta con una sólida vocación de servicio fundamentada en el profesionalismo, la discreción absoluta, la calidez humana y el respeto a la intimidad del hogar del cliente. Su atención es 100% personalizada.\n\nPuedes conocer más sobre su trabajo y conectar directamente en Instagram:\n- @jessarturo_art\n- @masajecaliforniano.mx",
                'keywords' => 'jesus arturo robles gutierrez, terapeuta, certificado, cdmx, quien atiende, quien es, instagram, jessarturo_art, credenciales',
                'sort_order' => 3,
            ],
            [
                'title' => 'Zonas de Cobertura y Servicio a Domicilio',
                'category' => 'zonas_cobertura',
                'content' => "El servicio de Masaje Californiano y faciales es estrictamente a domicilio, brindando comodidad y privacidad sin que el cliente deba trasladarse.\n\nZONAS DE ATENCIÓN:\n1. Ciudad de México (CDMX): Polanco, Roma Norte y Sur, Condesa, Del Valle, Juárez, Cuauhtémoc, Coyoacán, San Ángel, Nápoles, Santa Fe e Interlomas.\n2. Estado de México (Edomex): Huixquilucan, Zona Esmeralda, Satélite y alrededores selectos.\n3. Quintana Roo: Playa del Carmen y Riviera Maya (según temporadas de movilidad del terapeuta, confirmadas con antelación en el calendario de citas).\n\nPara zonas especiales o fuera del área habitual, se puede consultar disponibilidad directamente por WhatsApp.",
                'keywords' => 'zonas, cobertura, donde van, domicilio, cdmx, edomex, estado de mexico, playa del carmen, riviera maya, polanco, condesa, roma, del valle, santa fe',
                'sort_order' => 4,
            ],
            [
                'title' => 'Catálogo de Servicios Disponibles',
                'category' => 'beneficios',
                'content' => "Los servicios que actualmente ofrece Jesús Arturo Robles incluyen:\n1. Masaje Californiano Clásico a Domicilio (75 o 90 min): Masaje relajante envolvente de cuerpo completo con aceites tibios y aromaterapia.\n2. Masaje Californiano de Tejido Profundo (90 min): Maniobras fluidas combinadas con presión focalizada en zonas de contractura (espalda, cuello, lumbares).\n3. Facial Hidratante, Calmante & Rejuvenecedor (60 min): Limpieza botánica, masaje miofascial facial, rodillo de jade y mascarilla nutritiva.\n4. Ritual Holístico Integral (105 min): Masaje californiano de cuerpo entero + 25 min de reflexología podal + aromaterapia de grado terapéutico.\n5. Ritual Drenaje & Piernas Ligeras (60 min): Maniobras suaves de retorno venoso y linfático con geles criogénicos naturales para aliviar pesadez y retención.\n\nNOTA DE PRECIOS: Al estar en fase de atención personalizada, los precios exactos se cotizan según el servicio, duración y zona de domicilio mediante mensaje o WhatsApp.",
                'keywords' => 'servicios, catalogo, tipos de masaje, facial, faciales, reflexologia, precios, cuanto cuesta, costo, cotizacion, duracion',
                'sort_order' => 5,
            ],
            [
                'title' => '¿Qué incluye la visita a domicilio y qué necesito tener en casa?',
                'category' => 'preparacion_domicilio',
                'content' => "¿QUÉ LLEVA EL TERAPEUTA?:\nEl terapeuta Jesús Arturo acude con todo el equipo profesional necesario para transformar tu habitación en un spa de alta gama:\n- Camilla ergonómica plegable de alta resistencia y confort.\n- Sábanas y fundas de algodón recién lavadas y esterilizadas.\n- Toallas térmicas limpias y calientes.\n- Aceites vegetales y esenciales 100% orgánicos y tibios.\n- Difusor ultrasónico con esencias relajantes.\n- Música ambiental envolvente de relajación con altavoz binaural.\n\n¿QUÉ NECESITAS PROPORCIONAR TÚ EN TU HOGAR?:\n- Únicamente un espacio libre de aproximadamente 2 x 2.5 metros donde colocar la camilla (recámara, sala o estudio).\n- Un ambiente templado, tranquilo y privado donde no haya interrupciones durante la sesión.\n- Un enchufe cercano para el calentador de toallas/aceite o difusor.",
                'keywords' => 'que incluye, que necesito, camilla, toallas, aceites, espacio, preparacion, que debo tener, enchufe, tamano habitacion',
                'sort_order' => 6,
            ],
            [
                'title' => '¿Cómo agendar una cita y cuáles son los horarios disponibles?',
                'category' => 'faq',
                'content' => "CÓMO AGENDAR:\nPuedes agendar directamente desde el sitio web seleccionando el servicio deseado, la zona de tu domicilio, la fecha y el horario predeterminado disponible, o enviando un mensaje directo por WhatsApp al terapeuta.\n\nHORARIOS HABITUALES:\n- Lunes a Sábado: Turnos disponibles a las 09:30, 12:00, 15:00, 17:30 y 20:00 hrs.\n- Domingos: Turnos matutinos y vespertinos a las 10:00, 13:00, 16:00 y 18:30 hrs.\n\nCONFIRMACIÓN:\nUna vez recibida tu solicitud, el terapeuta revisa la ubicación, valida los detalles de acceso a tu domicilio y te envía la confirmación oficial por WhatsApp con las indicaciones previas para tu sesión.",
                'keywords' => 'como agendar, cita, reserva, como reservar, horarios, disponibilidad, whatsapp, confirmacion, turnos',
                'sort_order' => 7,
            ],
            [
                'title' => 'Preguntas Frecuentes sobre Privacidad, Confidencialidad y Ética',
                'category' => 'faq',
                'content' => "El servicio de Masaje Californiano a Domicilio se rige bajo los más estrictos estándares éticos, de respeto y profesionalismo terapéutico:\n\n- PRIVACIDAD Y DISCRECIÓN: Se mantiene absoluta confidencialidad sobre la identidad, domicilio y conversaciones de cada cliente.\n- CUBRIMIENTO TERAPÉUTICO (Draping): Durante toda la sesión, el cuerpo del consultante permanece cuidadosamente cubierto con sábanas y toallas térmicas, descubriendo únicamente la zona anatómica en la que se está trabajando de manera respetuosa y profesional.\n- HIGIENE IMPECABLE: El terapeuta cumple rigurosos protocolos de asepsia, lavado de manos antes y después de la terapia, y uso de material higienizado de un solo uso o esterilizado para cada cliente.",
                'keywords' => 'privacidad, confidencialidad, respeto, etica, ropa, toalla, desnudez, draping, seguridad, confianza',
                'sort_order' => 8,
            ],
        ];

        foreach ($documentosRAG as $doc) {
            KnowledgeDocument::updateOrCreate(
                ['title' => $doc['title']],
                $doc
            );
        }
    }
}

# Plan de Implementación: Masaje Californiano a Domicilio
**Fecha y Hora:** 2026-10-23 00:34 (Hora Local)  
**Cliente / Terapeuta:** Jesús Arturo Robles Gutiérrez  
**Instagram:** `@jessarturo_art` / `@masajecaliforniano.mx`  
**Ubicaciones de Atención:** CDMX, Estado de México y Playa del Carmen (Riviera Maya)

---

## 1. Visión y Objetivos del Proyecto

Desarrollar una aplicación web integral, elegante, responsive y altamente profesional que sirva como la presencia digital oficial y centro de operaciones para los servicios de **Masaje Californiano a Domicilio** y terapias de spa de **Jesús Arturo Robles Gutiérrez**.

La plataforma transmitirá serenidad, relajación profunda, bienestar integral y confianza absoluta, respetando rigurosamente la identidad visual y los colores presentados en los flyers de `/docs` (tonos oliva/verde salvia, beige cálido/crema, toques arena/dorado).

### Objetivos Clave:
1. **Frontend Público de Alta Gama**: Landing page responsive con narrativa sensorial, catálogo de servicios, perfil profesional del terapeuta, zonas de servicio, blog de bienestar y sistema interactivo de reserva de citas a domicilio.
2. **Asistente Virtual / Chatbot con RAG**: Chatbot interactivo conectado a una base de conocimiento dinámica (FAQs, preparación en casa, técnicas del masaje californiano, zonas y servicios).
3. **Panel Administrativo (FilamentPHP v3)**:
   - Gestión integral de Leads y conversión fluida a Citas.
   - Calendario y agenda de citas con horarios predeterminados, control de estados y recordatorios.
   - Administración de servicios de spa y faciales.
   - Gestión de disponibilidad y días bloqueados (incluyendo alternancia entre CDMX y Playa del Carmen).
   - CRUD para artículos del Blog de bienestar.
   - CRUD para documentos y preguntas frecuentes del Chatbot RAG.
   - Control de usuarios y roles.
4. **Interconexión Front-Back**: Botón de acceso directo al panel administrativo desde el pie/cabecera y botón de retorno al sitio público desde el panel.

---

## 2. Arquitectura Tecnológica

- **Framework Base:** Laravel 11 / 12 (PHP 8.4 via Laravel Herd)
- **Base de Datos:** SQLite (alta velocidad, cero fricción, portable y lista para migrar a MySQL si se requiere)
- **Panel Administrativo:** FilamentPHP v3 (`filament/filament:^3.x`)
- **Estilos y Frontend:** Blade, TailwindCSS y CSS personalizado para microanimaciones, paleta orgánica y tipografía refinada (Playfair Display / Plus Jakarta Sans).
- **Motor RAG / Chatbot:** Servicio nativo de búsqueda semántica y contextual por similitud léxica/TF-IDF y embeddings sobre los `KnowledgeDocument` gestionados en Filament, con respuestas contextualizadas y cálidas.

---

## 3. Modelo de Datos

1. **`User`**:
   - `id`, `name`, `email`, `password`, `role` (`admin`, `terapeuta`).
2. **`SpaService`**:
   - `id`, `name`, `slug`, `category` (`masaje_californiano`, `faciales`, `terapias_holisticas`), `duration_minutes`, `short_description`, `description`, `benefits` (JSON), `includes` (JSON: aceites, toallas, aromaterapia), `is_featured`, `is_active`, `sort_order`.
3. **`Lead`**:
   - `id`, `name`, `email`, `phone`, `spa_service_id`, `preferred_date`, `preferred_time_slot`, `zone` (`cdmx`, `edomex`, `playa_del_carmen`), `address`, `client_notes`, `status` (`nuevo`, `contactado`, `cita_agendada`, `descartado`), `internal_notes`.
4. **`Appointment`**:
   - `id`, `lead_id` (nullable), `spa_service_id`, `client_name`, `client_email`, `client_phone`, `appointment_date`, `time_slot`, `zone`, `full_address`, `status` (`pendiente`, `confirmada`, `en_camino`, `completada`, `cancelada`), `therapist_notes`, `client_notes`, `reminder_sent`.
5. **`ScheduleSlot` & `BlockedDate`**:
   - Horarios predeterminados para servicio a domicilio (ej: 09:30, 12:00, 15:00, 17:30, 20:00).
   - Bloqueo de días por vacaciones o estancia en Playa del Carmen vs CDMX.
6. **`BlogPost`**:
   - `id`, `title`, `slug`, `excerpt`, `content`, `category`, `cover_image`, `reading_time`, `is_published`, `published_at`.
7. **`KnowledgeDocument` (RAG)**:
   - `id`, `title`, `category` (`faq`, `tecnica_masaje`, `preparacion_domicilio`, `zonas_cobertura`, `terapeuta`), `content`, `keywords`, `is_active`.

---

## 4. Fases de Ejecución

### Fase 1: Creación del Proyecto Laravel e Instalación de Dependencias
- Inicializar Laravel en `/Users/franciscogomezbarragan/Herd/masaje-californiano`.
- Instalar FilamentPHP v3 y publicar assets.
- Configurar base de datos SQLite y variables de entorno `.env`.

### Fase 2: Modelos, Migraciones y Seeders
- Crear migraciones para `SpaService`, `Lead`, `Appointment`, `ScheduleSlot`, `BlockedDate`, `BlogPost` y `KnowledgeDocument`.
- Sembrar datos iniciales con la información exacta de las imágenes (`Misión`, `Visión`, `¿Qué es el Masaje Californiano?`, servicios típicos, horarios y preguntas frecuentes).

### Fase 3: Construcción del Panel FilamentPHP
- Crear `SpaServiceResource`, `LeadResource`, `AppointmentResource`, `BlogPostResource`, `KnowledgeDocumentResource`, `UserResource`.
- Añadir acciones rápidas en `LeadResource` para contactar por WhatsApp y convertir a Cita con 1 clic.
- Configurar navegación, iconos temáticos de bienestar, badges de estado y diseño sobrio.

### Fase 4: Frontend Público Sensorial y Elegante
- Implementar la landing page responsive con la paleta de colores y line-art del logotipo:
  - Header con navegación fluida y acceso a panel.
  - Hero con mensaje de bienestar ("La relajación llega hasta tu puerta").
  - Sección interactiva "¿Qué es el Masaje Californiano?".
  - Catálogo de Servicios con filtros y tarjetas informativas detalladas.
  - Sección "Sobre Jesús Arturo Robles Gutiérrez" con biografía, certificado y enlace a Instagram `@jessarturo_art`.
  - Zonas de cobertura y protocolo de atención a domicilio.
  - Formulario y Módulo de Reserva de Citas en vivo con validación y horarios disponibles.
  - Sección de Blog / Consejos de autocuidado.
  - Botón flotante y widget de Chatbot RAG.

### Fase 5: Implementación del Chatbot con RAG
- Crear endpoint y servicio backend `/api/chatbot/message` que consulte la base de conocimiento de `KnowledgeDocument`.
- Interfaz de chat flotante minimalista, acogedora y conversacional.

### Fase 6: Pruebas, Verificación y Entrega
- Validar flujo completo de registro de lead y reserva de cita.
- Validar acceso al panel administrativo y sincronización con el front.
- Generar el reporte de entrega `docs/YYYY-MM-DD_HH-mm_walkthrough.md`.

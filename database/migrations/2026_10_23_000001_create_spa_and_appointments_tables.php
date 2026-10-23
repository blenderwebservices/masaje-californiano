<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Servicios de Spa y Masajes
        Schema::create('spa_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('masaje_californiano'); // masaje_californiano, faciales, terapias_holisticas, rituales
            $table->integer('duration_minutes')->default(75);
            $table->text('short_description');
            $table->longText('description');
            $table->json('benefits')->nullable(); // Lista de beneficios clave
            $table->json('includes')->nullable(); // Equipamiento y amenidades incluidas
            $table->text('recommended_for')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Leads y Contactos desde el Front
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->foreignId('spa_service_id')->nullable()->constrained('spa_services')->nullOnDelete();
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time_slot')->nullable();
            $table->string('zone')->default('cdmx'); // cdmx, edomex, playa_del_carmen, otra
            $table->text('address')->nullable();
            $table->text('client_notes')->nullable();
            $table->string('status')->default('nuevo'); // nuevo, contactado, cita_agendada, descartado
            $table->string('source')->default('web_landing');
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });

        // Citas Agendadas
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->foreignId('spa_service_id')->constrained('spa_services')->cascadeOnDelete();
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone');
            $table->date('appointment_date');
            $table->string('time_slot'); // 09:30, 12:00, 15:00, 17:30, 20:00
            $table->string('zone')->default('cdmx'); // cdmx, edomex, playa_del_carmen
            $table->text('full_address');
            $table->string('status')->default('pendiente'); // pendiente, confirmada, en_camino, completada, cancelada
            $table->text('client_notes')->nullable();
            $table->text('therapist_notes')->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->timestamps();
        });

        // Horarios Predeterminados Disponibles para Citas
        Schema::create('schedule_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('day_of_week'); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado
            $table->string('time_slot'); // e.g. 09:30, 12:00, 15:00, 17:30, 20:00
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Días Bloqueados (Vacaciones, viajes entre CDMX y Playa del Carmen)
        Schema::create('blocked_dates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('reason')->nullable(); // Vacaciones, Viaje a Playa del Carmen, Asuntos personales
            $table->string('zone_affected')->default('todas'); // todas, cdmx, playa_del_carmen
            $table->timestamps();
        });

        // Blog de Bienestar, Salud y Relajación
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('category')->default('Masaje Californiano');
            $table->string('cover_image')->nullable();
            $table->string('reading_time')->default('4 min de lectura');
            $table->boolean('is_published')->default(true);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });

        // Documentos de Base de Conocimiento para Chatbot con RAG
        Schema::create('knowledge_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('faq'); // faq, tecnica_masaje, preparacion_domicilio, zonas_cobertura, terapeuta, beneficios
            $table->longText('content');
            $table->text('keywords')->nullable(); // Palabras clave para vector/match léxico
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_documents');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blocked_dates');
        Schema::dropIfExists('schedule_slots');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('spa_services');
    }
};

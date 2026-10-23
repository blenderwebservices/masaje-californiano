<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas de la Web
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [LandingController::class, 'blogPost'])->name('blog.show');

// Endpoints AJAX para Citas, Leads y Chatbot RAG
Route::get('/api/disponibilidad', [LandingController::class, 'checkAvailability'])->name('api.availability');
Route::post('/api/agendar-cita', [LandingController::class, 'bookAppointment'])->name('api.book');
Route::post('/api/contacto-lead', [LandingController::class, 'registerLead'])->name('api.lead');
Route::post('/api/chatbot', [LandingController::class, 'chatbotMessage'])->name('api.chatbot');

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masaje Californiano a Domicilio | Jesús Arturo Robles Gutiérrez | CDMX & Playa del Carmen</title>
    <meta name="description" content="Servicios profesionales de Masaje Californiano a domicilio por Jesús Arturo Robles Gutiérrez. Relajación profunda, faciales y bienestar en la comodidad y privacidad de tu hogar en CDMX, Edomex y Playa del Carmen.">
    
    <!-- Open Graph / Meta -->
    <meta property="og:title" content="Masaje Californiano a Domicilio | Jesús Arturo Robles">
    <meta property="og:description" content="La relajación llega hasta tu puerta. Masaje Californiano profesional, camilla y aceites tibios en tu hogar.">
    <meta property="og:image" content="{{ asset('images/logo-californiano.jpeg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-californiano.jpeg') }}">
    
    <!-- CSS Theme -->
    <link rel="stylesheet" href="{{ asset('css/spa-theme.css') }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="spa-navbar" id="navbar">
        <div class="spa-nav-container">
            <a href="#inicio" class="spa-brand">
                <img src="{{ asset('images/logo-californiano.jpeg') }}" alt="Logo Masaje Californiano" class="spa-brand-img">
                <div class="spa-brand-text">
                    <h1>Masaje Californiano</h1>
                    <span>A Domicilio • CDMX & Playa del Carmen</span>
                </div>
            </a>

            <ul class="spa-nav-links">
                <li><a href="#que-es">¿Qué es?</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#terapeuta">Sobre Jesús</a></li>
                <li><a href="#zonas">Zonas</a></li>
                <li><a href="#reservar">Reservar Cita</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>

            <div class="spa-nav-actions">
                <a href="{{ url('/admin') }}" class="btn-portal" title="Acceso al Panel Administrativo y de Citas">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Panel Terapeuta</span>
                </a>
                <a href="#reservar" class="btn-cta btn-cta-gold">
                    <span>Agendar Cita</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="spa-hero" id="inicio">
        <div class="spa-hero-container">
            <div class="hero-content">
                <span class="hero-subtitle font-script">La relajación llega hasta tu puerta.</span>
                <span class="hero-badge-domicilio">Servicio Profesional a Domicilio</span>
                <h1 class="hero-title">Masaje Californiano</h1>
                <p class="hero-tagline">
                    Disfruta en la comodidad y privacidad de tu hogar. Movimientos largos, fluidos y envolventes que generan una profunda armonía entre cuerpo y mente.
                </p>

                <!-- 4 Pilares del flyer -->
                <div class="pillars-card">
                    <div class="pillars-card-title">Disfruta en la comodidad y privacidad de tu hogar</div>
                    <div class="pillars-grid">
                        <div class="pillar-item">
                            <div class="pillar-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                                    <path d="M12 7v5l3 3"/>
                                </svg>
                            </div>
                            <span class="pillar-name">Relajación<br>profunda</span>
                        </div>
                        <div class="pillar-item">
                            <div class="pillar-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M9.5 2A2.5 2.5 0 0112 4.5v15a2.5 2.5 0 01-4.96.44 2.5 2.5 0 01-2.96-3.08 3 3 0 01-.34-5.58 2.5 2.5 0 011.32-4.24A2.5 2.5 0 019.5 2z"/>
                                    <path d="M14.5 2A2.5 2.5 0 0012 4.5v15a2.5 2.5 0 004.96.44 2.5 2.5 0 002.96-3.08 3 3 0 00.34-5.58 2.5 2.5 0 00-1.32-4.24A2.5 2.5 0 0014.5 2z"/>
                                </svg>
                            </div>
                            <span class="pillar-name">Equilibrio<br>emocional</span>
                        </div>
                        <div class="pillar-item">
                            <div class="pillar-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="5" r="2"/>
                                    <path d="M10 22v-5l-2-2 2.5-4 2.5 4-2 2v5"/>
                                </svg>
                            </div>
                            <span class="pillar-name">Libera<br>tensiones</span>
                        </div>
                        <div class="pillar-item">
                            <div class="pillar-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                            </div>
                            <span class="pillar-name">Bienestar<br>integral</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;" class="hero-actions">
                    <a href="#reservar" class="btn-cta" style="padding: 0.85rem 1.8rem; font-size: 0.95rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span>Reservar Cita a Domicilio</span>
                    </a>
                    <a href="https://wa.me/525512345678?text={{ urlencode('Hola Jesús Arturo, me gustaría solicitar informes sobre el Masaje Californiano a domicilio.') }}" target="_blank" class="btn-portal" style="padding: 0.85rem 1.4rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                        <span>WhatsApp Directo</span>
                    </a>
                </div>
            </div>

            <!-- Media card con la imagen original -->
            <div class="hero-media-wrapper">
                <div class="hero-img-card">
                    <img src="{{ asset('images/hero-massage.jpeg') }}" alt="Sesión de Masaje Californiano">
                </div>
                <div class="floating-badge">
                    <div style="background: var(--color-primary-soft); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--color-primary); flex-shrink: 0;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 0.85rem; font-weight: 700; color: var(--color-primary-dark);">Llevamos Todo el Spa</div>
                        <div style="font-size: 0.74rem; color: var(--color-text-muted);">Camilla ergonómica, sábanas y aceites tibios en tu hogar.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: ¿Qué es el Masaje Californiano? -->
    <section class="spa-section bg-surface" id="que-es">
        <div style="max-width: 1240px; margin: 0 auto;">
            <div class="section-header">
                <span class="section-eyebrow">Técnica Terapéutica Holística</span>
                <h2 class="section-title">¿Qué es el Masaje Californiano?</h2>
                <p class="section-description">
                    Es una técnica de relajación corporal que utiliza movimientos largos, fluidos y envolventes para generar una sensación de profunda armonía entre cuerpo y mente. Ayuda a disminuir el estrés, liberar tensiones acumuladas y promover una profunda sensación de tranquilidad.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap: 1.8rem; margin-top: 2rem;">
                <div style="background: #ffffff; padding: 2.2rem; border-radius: var(--border-radius-lg); border: 1px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--color-primary-soft); color: var(--color-primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.3rem;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.7rem;">Servicio a Domicilio</h3>
                    <p style="font-size: 0.92rem; color: var(--color-text-muted); line-height: 1.6;">
                        Profesionalismo, confianza y bienestar, donde tú estás. Sin estrés de traslados ni prisas para que tu descanso sea ininterrumpido.
                    </p>
                </div>

                <div style="background: #ffffff; padding: 2.2rem; border-radius: var(--border-radius-lg); border: 1px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--color-primary-soft); color: var(--color-primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.3rem;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.7rem;">Comodidad y Privacidad</h3>
                    <p style="font-size: 0.92rem; color: var(--color-text-muted); line-height: 1.6;">
                        Tu propio entorno seguro. Cuidado respetuoso con técnica de cubrimiento terapéutico (draping) para tu absoluta tranquilidad.
                    </p>
                </div>

                <div style="background: #ffffff; padding: 2.2rem; border-radius: var(--border-radius-lg); border: 1px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--color-primary-soft); color: var(--color-primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.3rem;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                            <line x1="9" y1="9" x2="9.01" y2="9"/>
                            <line x1="15" y1="9" x2="15.01" y2="9"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.7rem;">Atención Personalizada</h3>
                    <p style="font-size: 0.92rem; color: var(--color-text-muted); line-height: 1.6;">
                        Cada sesión se adapta a tu estado físico y emocional actual: nivel de presión deseado, zonas de sobrecarga muscular y selección de aromas.
                    </p>
                </div>

                <div style="background: #ffffff; padding: 2.2rem; border-radius: var(--border-radius-lg); border: 1px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--color-primary-soft); color: var(--color-primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.3rem;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.7rem;">Profesionalismo y Discreción</h3>
                    <p style="font-size: 0.92rem; color: var(--color-text-muted); line-height: 1.6;">
                        Terapeuta certificado por instituto oficial en la CDMX con estricto código de ética, confidencialidad e higiene quirúrgica de materiales.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Servicios de Spa -->
    <section class="spa-section" id="servicios">
        <div class="section-header">
            <span class="section-eyebrow">Catálogo de Bienestar</span>
            <h2 class="section-title">Servicios y Terapias a Domicilio</h2>
            <p class="section-description">
                Experiencias de relajación profunda diseñadas para renovar tu energía física, mental y emocional. Consulta cada servicio y agenda fácilmente tu fecha preferida.
            </p>
        </div>

        <div class="services-grid">
            @foreach($services as $service)
                <div class="service-card" id="service-card-{{ $service->id }}">
                    <div>
                        <div class="service-meta-top">
                            <span class="service-badge">{{ $service->category_label }}</span>
                            <span class="service-duration">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                {{ $service->duration_minutes }} min
                            </span>
                        </div>

                        <h3 class="service-card-title">{{ $service->name }}</h3>
                        <p class="service-card-desc">{{ $service->short_description }}</p>

                        @if(!empty($service->benefits))
                            <div style="font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-gold); margin-bottom: 0.6rem;">
                                Beneficios destacados:
                            </div>
                            <ul class="service-benefits-list">
                                @foreach(array_slice($service->benefits, 0, 4) as $benefit)
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        <span>{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div style="border-top: 1px solid rgba(74, 93, 67, 0.1); padding-top: 1.4rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.82rem; color: var(--color-text-muted);">
                            Camilla y amenidades incluidas
                        </span>
                        <button type="button" class="btn-cta btn-select-service" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}" style="padding: 0.55rem 1.15rem; font-size: 0.82rem;">
                            <span>Seleccionar y Agendar</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Sobre el Terapeuta: Jesús Arturo Robles Gutiérrez -->
    <section class="spa-section bg-surface" id="terapeuta">
        <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 3.5rem; align-items: center;">
            <div style="position: relative; text-align: center;">
                <div style="border-radius: 36px; overflow: hidden; box-shadow: var(--shadow-elevated); border: 6px solid #ffffff; display: inline-block;">
                    <img src="{{ asset('images/logo-californiano.jpeg') }}" alt="Emblema Masaje Californiano" style="width: 100%; max-width: 360px; height: auto; display: block;">
                </div>
                <div style="margin-top: 1.2rem;">
                    <span style="display: block; font-family: var(--font-serif); font-size: 1.5rem; color: var(--color-primary-dark); font-weight: 700;">
                        Jesús Arturo Robles Gutiérrez
                    </span>
                    <span style="font-size: 0.88rem; color: var(--color-gold); font-weight: 600; text-transform: uppercase; letter-spacing: 0.12em;">
                        Terapeuta Certificado en Masaje Californiano
                    </span>
                </div>
            </div>

            <div>
                <span class="section-eyebrow">Vocación y Profesionalismo</span>
                <h2 style="font-size: 2.6rem; line-height: 1.15; margin-bottom: 1.2rem; color: var(--color-primary-dark);">
                    Tu Espacio • Tu Momento • Tu Bienestar
                </h2>
                <p style="font-size: 1rem; color: var(--color-text-muted); margin-bottom: 1.2rem; line-height: 1.7;">
                    Jesús Arturo Robles cuenta con formación y certificación oficial por un reconocido instituto de Masaje Californiano en la Ciudad de México. Su labor trasciende la técnica mecánica: busca generar una atmósfera de recogimiento, quietud y respeto en el espacio más sagrado de cada consultante, su hogar.
                </p>
                <div style="background: #ffffff; padding: 1.4rem; border-radius: 16px; border-left: 4px solid var(--color-gold); margin-bottom: 1.8rem; box-shadow: var(--shadow-soft);">
                    <strong style="color: var(--color-primary-dark); display: block; margin-bottom: 0.3rem;">Misión y Compromiso:</strong>
                    <p style="font-size: 0.9rem; color: var(--color-text-dark); margin: 0;">
                        "Brindar servicios profesionales de Masaje Californiano a domicilio, ofreciendo bienestar físico y emocional mediante experiencias personalizadas de relajación profunda, realizadas con respeto, confidencialidad y calidez humana."
                    </p>
                </div>

                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="https://instagram.com/jessarturo_art" target="_blank" class="btn-portal" style="background: #ffffff;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"/>
                        </svg>
                        <span>@jessarturo_art</span>
                    </a>
                    <a href="https://instagram.com/masajecaliforniano.mx" target="_blank" class="btn-portal" style="background: #ffffff;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"/>
                        </svg>
                        <span>@masajecaliforniano.mx</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Zonas de Cobertura -->
    <section class="spa-section" id="zonas">
        <div class="section-header">
            <span class="section-eyebrow">Servicio a Domicilio</span>
            <h2 class="section-title">Zonas de Cobertura</h2>
            <p class="section-description">
                Llevamos todo el mobiliario y equipo terapéutico directamente a tu puerta en las siguientes regiones.
            </p>
        </div>

        <div style="max-width: 1240px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            <!-- CDMX -->
            <div style="background: #ffffff; border-radius: 24px; padding: 2.2rem; border: 1.5px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                    <span style="font-size: 0.8rem; font-weight: 700; color: var(--color-primary); background: var(--color-primary-soft); padding: 0.3rem 0.8rem; border-radius: 9999px;">
                        Zona Habitual
                    </span>
                    <span style="font-size: 1.6rem;">🏙️</span>
                </div>
                <h3 style="font-size: 1.6rem; margin-bottom: 0.6rem;">Ciudad de México (CDMX)</h3>
                <p style="font-size: 0.92rem; color: var(--color-text-muted); margin-bottom: 1rem;">
                    Polanco, Roma Norte y Sur, Condesa, Del Valle, Juárez, Cuauhtémoc, Coyoacán, San Ángel, Nápoles, Santa Fe e Interlomas.
                </p>
                <div style="font-size: 0.82rem; color: var(--color-primary); font-weight: 600;">
                    Disponibilidad: Lunes a Domingo
                </div>
            </div>

            <!-- Edomex -->
            <div style="background: #ffffff; border-radius: 24px; padding: 2.2rem; border: 1.5px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                    <span style="font-size: 0.8rem; font-weight: 700; color: var(--color-gold); background: #fdf5ea; padding: 0.3rem 0.8rem; border-radius: 9999px;">
                        Área Metropolitana
                    </span>
                    <span style="font-size: 1.6rem;">🌳</span>
                </div>
                <h3 style="font-size: 1.6rem; margin-bottom: 0.6rem;">Estado de México (Edomex)</h3>
                <p style="font-size: 0.92rem; color: var(--color-text-muted); margin-bottom: 1rem;">
                    Huixquilucan, Bosques de las Lomas, Zona Esmeralda, Ciudad Satélite, Lomas Verdes y alrededores selectos previa coordinación.
                </p>
                <div style="font-size: 0.82rem; color: var(--color-primary); font-weight: 600;">
                    Disponibilidad: Previa agenda
                </div>
            </div>

            <!-- Playa del Carmen -->
            <div style="background: #ffffff; border-radius: 24px; padding: 2.2rem; border: 1.5px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                    <span style="font-size: 0.8rem; font-weight: 700; color: #2b7a78; background: #e6f4f3; padding: 0.3rem 0.8rem; border-radius: 9999px;">
                        Temporadas Especiales
                    </span>
                    <span style="font-size: 1.6rem;">🌊</span>
                </div>
                <h3 style="font-size: 1.6rem; margin-bottom: 0.6rem;">Playa del Carmen & Riviera Maya</h3>
                <p style="font-size: 0.92rem; color: var(--color-text-muted); margin-bottom: 1rem;">
                    Playacar Fases I y II, Centro, Mayakoba y residenciales de la Riviera Maya durante las estancias periódicas del terapeuta.
                </p>
                <div style="font-size: 0.82rem; color: #2b7a78; font-weight: 600;">
                    Consulta fechas de estancia en el calendario
                </div>
            </div>
        </div>
    </section>

    <!-- Módulo Interactivo de Citas y Reservas -->
    <section class="spa-section bg-surface" id="reservar">
        <div class="section-header">
            <span class="section-eyebrow">Agenda tu Experiencia</span>
            <h2 class="section-title">Reserva tu Cita a Domicilio</h2>
            <p class="section-description">
                Elige tu servicio de spa, indica tu zona, selecciona fecha y horario predeterminado disponible. El terapeuta acudirá puntualmente con todo el equipo.
            </p>
        </div>

        <div class="booking-container">
            <form id="booking-form">
                <div class="booking-form-grid">
                    <!-- Columna Izquierda: Servicio y Ubicación -->
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="booking-service">1. Servicio Deseado *</label>
                            <select id="booking-service" name="spa_service_id" class="form-select" required>
                                <option value="">-- Selecciona un servicio --</option>
                                @foreach($services as $svc)
                                    <option value="{{ $svc->id }}" data-duration="{{ $svc->duration_minutes }} min">
                                        {{ $svc->name }} ({{ $svc->duration_minutes }} min)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-zone">2. Zona de tu Domicilio *</label>
                            <select id="booking-zone" name="zone" class="form-select" required>
                                <option value="cdmx">Ciudad de México (CDMX)</option>
                                <option value="edomex">Estado de México (Edomex)</option>
                                <option value="playa_del_carmen">Playa del Carmen / Riviera Maya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-date">3. Fecha Deseada *</label>
                            <input type="date" id="booking-date" name="appointment_date" class="form-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            <small id="availability-hint" style="font-size: 0.78rem; color: var(--color-primary); margin-top: 0.2rem; display: block;">
                                Verificando disponibilidad...
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">4. Horarios Disponibles *</label>
                            <input type="hidden" id="selected-time-slot" name="time_slot" required>
                            <div class="slots-grid" id="slots-container">
                                <!-- Slots se inyectan dinámicamente con AJAX -->
                                <button type="button" class="slot-btn selected" data-time="09:30">09:30</button>
                                <button type="button" class="slot-btn" data-time="12:00">12:00</button>
                                <button type="button" class="slot-btn" data-time="15:00">15:00</button>
                                <button type="button" class="slot-btn" data-time="17:30">17:30</button>
                                <button type="button" class="slot-btn" data-time="20:00">20:00</button>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Datos del Cliente y Dirección -->
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="booking-name">Tu Nombre Completo *</label>
                            <input type="text" id="booking-name" name="name" class="form-input" placeholder="Ej. Ana Sofía Morales" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-phone">Teléfono / WhatsApp *</label>
                            <input type="tel" id="booking-phone" name="phone" class="form-input" placeholder="Ej. 55 1234 5678" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-email">Correo Electrónico (Opcional)</label>
                            <input type="email" id="booking-email" name="email" class="form-input" placeholder="ejemplo@correo.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-address">Dirección Completa a Domicilio *</label>
                            <textarea id="booking-address" name="address" class="form-textarea" rows="2" placeholder="Calle, número exterior e interior, colonia, alcaldía o municipio y referencias de acceso" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="booking-notes">Peticiones o Dolencias Específicas</label>
                            <textarea id="booking-notes" name="client_notes" class="form-textarea" rows="2" placeholder="Ej. Mucha tensión en trapecios y cuello, preferencia de presión suave o media..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Botón de Envío y Mensajes -->
                <div style="margin-top: 1.8rem; padding-top: 1.5rem; border-top: 1px solid rgba(74, 93, 67, 0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div style="font-size: 0.85rem; color: var(--color-text-muted);">
                        🔒 Tus datos están protegidos. El terapeuta validará la dirección y te contactará.
                    </div>
                    <button type="submit" id="btn-submit-booking" class="btn-cta btn-cta-gold" style="padding: 0.9rem 2.2rem; font-size: 1rem;">
                        <span id="booking-btn-text">Confirmar y Solicitar Cita</span>
                    </button>
                </div>
            </form>

            <!-- Mensaje de Confirmación / Éxito -->
            <div id="booking-success-box" style="display: none; margin-top: 2rem; padding: 2.2rem; background: var(--color-primary-soft); border-radius: 20px; border: 1.5px solid var(--color-primary); text-align: center;">
                <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--color-primary); color: #ffffff; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <h3 style="font-size: 1.8rem; color: var(--color-primary-dark); margin-bottom: 0.6rem;">
                    ¡Solicitud de Cita Registrada!
                </h3>
                <p id="booking-success-msg" style="font-size: 1rem; color: var(--color-text-dark); max-width: 600px; margin: 0 auto 1.5rem;">
                    Hemos registrado tu cita en la agenda de Jesús Arturo. Para asegurar tu turno de inmediato, puedes escribirle directamente por WhatsApp:
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a id="booking-wa-btn" href="#" target="_blank" class="btn-cta" style="background: #25D366; border-color: #25D366; font-size: 0.95rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                        <span>Abrir WhatsApp con mi Cita Lista</span>
                    </a>
                    <button type="button" id="btn-nueva-cita" class="btn-portal">
                        <span>Agendar Otra Cita</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog de Bienestar y Consejos -->
    <section class="spa-section" id="blog">
        <div class="section-header">
            <span class="section-eyebrow">Artículos y Consejos</span>
            <h2 class="section-title">Blog de Bienestar y Salud Integral</h2>
            <p class="section-description">
                Lecturas sobre el arte del tacto consciente, el cuidado del cuerpo en casa y cómo la desconexión periódica renueva tu vitalidad.
            </p>
        </div>

        <div style="max-width: 1240px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 2.2rem;">
            @foreach($posts as $post)
                <article style="background: #ffffff; border-radius: 24px; border: 1px solid var(--color-sand); overflow: hidden; box-shadow: var(--shadow-soft); display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.3s ease;">
                    <div style="padding: 2.2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-gold);">
                                {{ $post->category }}
                            </span>
                            <span style="font-size: 0.78rem; color: var(--color-text-muted);">
                                {{ $post->reading_time }}
                            </span>
                        </div>
                        <h3 style="font-size: 1.45rem; line-height: 1.25; margin-bottom: 0.8rem;">
                            <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: var(--color-primary-dark);">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--color-text-muted); line-height: 1.6;">
                            {{ $post->excerpt }}
                        </p>
                    </div>

                    <div style="padding: 1.2rem 2.2rem; border-top: 1px solid rgba(74, 93, 67, 0.08); background: var(--color-cream); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; color: var(--color-text-muted);">
                            {{ $post->published_at ? $post->published_at->format('d M, Y') : 'Reciente' }}
                        </span>
                        <a href="{{ route('blog.show', $post->slug) }}" style="font-size: 0.85rem; font-weight: 600; color: var(--color-primary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">
                            <span>Leer artículo</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- Formulario de Contacto / Lead Rápido -->
    <section class="spa-section bg-surface" id="contacto">
        <div style="max-width: 860px; margin: 0 auto; background: #ffffff; border-radius: 32px; padding: 3rem; box-shadow: var(--shadow-elevated); border: 1px solid var(--color-sand);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span class="section-eyebrow">¿Tienes dudas o peticiones especiales?</span>
                <h2 style="font-size: 2.2rem; color: var(--color-primary-dark); margin-bottom: 0.6rem;">Escríbenos Directamente</h2>
                <p style="font-size: 0.96rem; color: var(--color-text-muted);">
                    Registraremos tu mensaje como prospecto en nuestro sistema y Jesús Arturo te responderá con calidez y prontitud.
                </p>
            </div>

            <form id="contact-lead-form">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem;">
                    <div class="form-group">
                        <label class="form-label" for="contact-name">Nombre *</label>
                        <input type="text" id="contact-name" name="name" class="form-input" required placeholder="Tu nombre">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contact-phone">WhatsApp / Teléfono *</label>
                        <input type="tel" id="contact-phone" name="phone" class="form-input" required placeholder="55 0000 0000">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact-email">Correo Electrónico</label>
                    <input type="email" id="contact-email" name="email" class="form-input" placeholder="tu@correo.com">
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact-notes">¿En qué podemos apoyarte? *</label>
                    <textarea id="contact-notes" name="client_notes" class="form-textarea" rows="3" required placeholder="Cuéntanos tus dudas sobre el servicio a domicilio, preparación en casa o cotizaciones especiales..."></textarea>
                </div>

                <div style="text-align: center; margin-top: 1.5rem;">
                    <button type="submit" id="btn-submit-contact" class="btn-cta" style="padding: 0.85rem 2.2rem;">
                        <span>Enviar Mensaje a Jesús Arturo</span>
                    </button>
                    <div id="contact-feedback" style="display: none; margin-top: 1rem; font-size: 0.92rem; color: var(--color-primary); font-weight: 600;"></div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: var(--color-primary-dark); color: #ffffff; padding: 4.5rem 1.5rem 2.5rem;">
        <div style="max-width: 1240px; margin: 0 auto; display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 3rem; margin-bottom: 3.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <img src="{{ asset('images/logo-californiano.jpeg') }}" alt="Logo" style="width: 44px; height: 44px; border-radius: 50%; border: 1.5px solid var(--color-gold);">
                    <span style="font-family: var(--font-serif); font-size: 1.3rem; letter-spacing: 0.06em; text-transform: uppercase;">
                        Masaje Californiano
                    </span>
                </div>
                <p style="font-size: 0.88rem; color: #c4d0c1; line-height: 1.6; max-width: 380px; margin-bottom: 1.2rem;">
                    La relajación llega hasta tu puerta. Experiencias terapéuticas personalizadas en la comodidad y confidencialidad de tu hogar en CDMX y Riviera Maya.
                </p>
                <div style="font-size: 0.82rem; color: var(--color-gold-light);">
                    TU ESPACIO • TU MOMENTO • TU BIENESTAR
                </div>
            </div>

            <div>
                <h4 style="color: var(--color-gold); font-size: 0.92rem; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 1.2rem;">
                    Navegación
                </h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.88rem;">
                    <li><a href="#inicio" style="color: #c4d0c1; text-decoration: none;">Inicio</a></li>
                    <li><a href="#que-es" style="color: #c4d0c1; text-decoration: none;">¿Qué es el Masaje Californiano?</a></li>
                    <li><a href="#servicios" style="color: #c4d0c1; text-decoration: none;">Servicios y Terapias</a></li>
                    <li><a href="#terapeuta" style="color: #c4d0c1; text-decoration: none;">Sobre Jesús Arturo Robles</a></li>
                    <li><a href="#reservar" style="color: #c4d0c1; text-decoration: none;">Reservar Cita</a></li>
                    <li><a href="#blog" style="color: #c4d0c1; text-decoration: none;">Blog de Bienestar</a></li>
                </ul>
            </div>

            <div>
                <h4 style="color: var(--color-gold); font-size: 0.92rem; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 1.2rem;">
                    Contacto & Redes
                </h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem; font-size: 0.88rem; color: #c4d0c1;">
                    <li>Instagram: <a href="https://instagram.com/jessarturo_art" target="_blank" style="color: var(--color-gold-light); text-decoration: none;">@jessarturo_art</a></li>
                    <li>Instagram: <a href="https://instagram.com/masajecaliforniano.mx" target="_blank" style="color: var(--color-gold-light); text-decoration: none;">@masajecaliforniano.mx</a></li>
                    <li>Zonas: CDMX, Estado de México y Playa del Carmen</li>
                    <li style="margin-top: 0.5rem;">
                        <a href="{{ url('/admin') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #ffffff; background: rgba(255,255,255,0.12); padding: 0.4rem 0.9rem; border-radius: 9999px; text-decoration: none; font-size: 0.78rem;">
                            <span>Portal Terapeuta / Admin &rarr;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div style="max-width: 1240px; margin: 0 auto; border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.8rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #8e9e8a; flex-wrap: wrap; gap: 1rem;">
            <div>
                &copy; {{ date('Y') }} Masaje Californiano a Domicilio. Todos los derechos reservados.
            </div>
            <div>
                Terapeuta: Jesús Arturo Robles Gutiérrez | CDMX & Playa del Carmen
            </div>
        </div>
    </footer>

    <!-- Chatbot Virtual RAG Widget Flotante -->
    <div id="chat-launcher" class="chat-launcher-btn" title="Conversar con nuestro Asistente Virtual">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
        </svg>
        <span class="chat-badge-pulse"></span>
    </div>

    <div id="chat-window" class="chat-window hidden">
        <div class="chat-header">
            <div class="chat-header-title">
                <h4>Concierge Californiano</h4>
                <span>Asistente con Base de Conocimiento RAG</span>
            </div>
            <button type="button" id="chat-close-btn" style="background: none; border: none; color: #ffffff; cursor: pointer; font-size: 1.2rem;">
                &times;
            </button>
        </div>

        <div class="chat-messages" id="chat-messages">
            <div class="chat-bubble chat-bubble-bot">
                ¡Hola! Bienvenido al espacio de <strong>Masaje Californiano a Domicilio</strong>. Soy tu asistente virtual. ¿Tienes dudas sobre la técnica, zonas de cobertura o cómo preparar tu hogar? Con gusto te oriento.
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.4rem; margin-top: 0.4rem;" id="chat-suggestions-box">
                <button type="button" class="btn-chat-chip" data-query="¿Qué es el Masaje Californiano?">¿Qué es el Masaje Californiano?</button>
                <button type="button" class="btn-chat-chip" data-query="¿Qué zonas cubren a domicilio?">¿Qué zonas cubren a domicilio?</button>
                <button type="button" class="btn-chat-chip" data-query="¿Qué equipo llevan a mi casa?">¿Qué equipo llevan a mi casa?</button>
                <button type="button" class="btn-chat-chip" data-query="¿Cómo agendo una cita?">¿Cómo agendo una cita?</button>
            </div>
        </div>

        <form id="chat-form" class="chat-input-box">
            <input type="text" id="chat-input" class="chat-input" placeholder="Escribe tu pregunta aquí..." autocomplete="off">
            <button type="submit" class="chat-send-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>
    </div>

    <style>
        .btn-chat-chip {
            background: #ffffff;
            border: 1px solid var(--color-sand);
            border-radius: 12px;
            padding: 0.45rem 0.75rem;
            font-size: 0.76rem;
            color: var(--color-primary-dark);
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
        }
        .btn-chat-chip:hover {
            background: var(--color-primary-soft);
            border-color: var(--color-primary);
        }
    </style>

    <!-- JavaScript Interactivo -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // 1. Preseleccionar servicio desde las tarjetas
            document.querySelectorAll('.btn-select-service').forEach(btn => {
                btn.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-service-id');
                    const selectEl = document.getElementById('booking-service');
                    if (selectEl) {
                        selectEl.value = serviceId;
                        document.getElementById('reservar').scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            // 2. Manejo de Horarios en Booking
            let selectedSlot = '09:30';
            const hiddenSlotInput = document.getElementById('selected-time-slot');
            hiddenSlotInput.value = selectedSlot;

            function bindSlotButtons() {
                document.querySelectorAll('.slot-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
                        this.classList.add('selected');
                        selectedSlot = this.getAttribute('data-time');
                        hiddenSlotInput.value = selectedSlot;
                    });
                });
            }
            bindSlotButtons();

            // 3. Consulta de Disponibilidad al cambiar fecha o zona
            const dateInput = document.getElementById('booking-date');
            const zoneSelect = document.getElementById('booking-zone');
            const slotsContainer = document.getElementById('slots-container');
            const availabilityHint = document.getElementById('availability-hint');

            async function checkAvailability() {
                const date = dateInput.value;
                const zone = zoneSelect.value;
                if (!date) return;

                availabilityHint.textContent = 'Consultando disponibilidad en agenda...';
                availabilityHint.style.color = 'var(--color-primary)';

                try {
                    const res = await fetch(`/api/disponibilidad?date=${encodeURIComponent(date)}&zone=${encodeURIComponent(zone)}`);
                    const data = await res.json();

                    slotsContainer.innerHTML = '';

                    if (!data.available || data.slots.length === 0) {
                        availabilityHint.textContent = data.message || 'No hay horarios disponibles para esta fecha. Intenta otro día.';
                        availabilityHint.style.color = '#c93b2b';
                        hiddenSlotInput.value = '';
                        return;
                    }

                    availabilityHint.textContent = `Turnos disponibles para el ${data.date}:`;
                    availabilityHint.style.color = 'var(--color-primary)';

                    data.slots.forEach((time, index) => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = `slot-btn ${index === 0 ? 'selected' : ''}`;
                        btn.setAttribute('data-time', time);
                        btn.textContent = time;
                        slotsContainer.appendChild(btn);
                    });

                    selectedSlot = data.slots[0];
                    hiddenSlotInput.value = selectedSlot;
                    bindSlotButtons();
                } catch (e) {
                    availabilityHint.textContent = 'Horarios disponibles por defecto.';
                }
            }

            dateInput.addEventListener('change', checkAvailability);
            zoneSelect.addEventListener('change', checkAvailability);
            checkAvailability();

            // 4. Envío del formulario de Reserva
            const bookingForm = document.getElementById('booking-form');
            const bookingBtn = document.getElementById('btn-submit-booking');
            const bookingSuccessBox = document.getElementById('booking-success-box');
            const bookingWaBtn = document.getElementById('booking-wa-btn');

            bookingForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                bookingBtn.disabled = true;
                bookingBtn.textContent = 'Registrando tu cita...';

                const formData = new FormData(bookingForm);
                const payload = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('/api/agendar-cita', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        bookingForm.style.display = 'none';
                        bookingSuccessBox.style.display = 'block';
                        bookingWaBtn.href = data.whatsapp_url;
                        bookingSuccessBox.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        alert(data.message || 'Por favor verifica los campos obligatorios del formulario.');
                        bookingBtn.disabled = false;
                        bookingBtn.textContent = 'Confirmar y Solicitar Cita';
                    }
                } catch (err) {
                    alert('Ocurrió un error al procesar tu solicitud. Intenta nuevamente.');
                    bookingBtn.disabled = false;
                    bookingBtn.textContent = 'Confirmar y Solicitar Cita';
                }
            });

            document.getElementById('btn-nueva-cita')?.addEventListener('click', function() {
                bookingSuccessBox.style.display = 'none';
                bookingForm.reset();
                bookingForm.style.display = 'block';
                bookingBtn.disabled = false;
                bookingBtn.textContent = 'Confirmar y Solicitar Cita';
                checkAvailability();
            });

            // 5. Envío de Formulario de Contacto / Lead
            const contactForm = document.getElementById('contact-lead-form');
            const contactFeedback = document.getElementById('contact-feedback');
            const contactBtn = document.getElementById('btn-submit-contact');

            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                contactBtn.disabled = true;
                contactBtn.textContent = 'Enviando...';

                const payload = Object.fromEntries(new FormData(contactForm).entries());

                try {
                    const res = await fetch('/api/contacto-lead', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        contactForm.reset();
                        contactFeedback.textContent = data.message;
                        contactFeedback.style.display = 'block';
                        contactFeedback.style.color = 'var(--color-primary)';
                    } else {
                        contactFeedback.textContent = 'Por favor completa los campos requeridos.';
                        contactFeedback.style.display = 'block';
                        contactFeedback.style.color = '#c93b2b';
                    }
                } catch (err) {
                    contactFeedback.textContent = 'Error al enviar. Intenta nuevamente.';
                    contactFeedback.style.display = 'block';
                } finally {
                    contactBtn.disabled = false;
                    contactBtn.textContent = 'Enviar Mensaje a Jesús Arturo';
                }
            });

            // 6. Chatbot Widget con RAG
            const chatLauncher = document.getElementById('chat-launcher');
            const chatWindow = document.getElementById('chat-window');
            const chatCloseBtn = document.getElementById('chat-close-btn');
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatMessages = document.getElementById('chat-messages');

            chatLauncher.addEventListener('click', function() {
                chatWindow.classList.toggle('hidden');
                if (!chatWindow.classList.contains('hidden')) {
                    chatInput.focus();
                }
            });

            chatCloseBtn.addEventListener('click', function() {
                chatWindow.classList.add('hidden');
            });

            async function sendChatMessage(msgText) {
                if (!msgText.trim()) return;

                // Agregar burbuja del usuario
                const userBubble = document.createElement('div');
                userBubble.className = 'chat-bubble chat-bubble-user';
                userBubble.textContent = msgText;
                chatMessages.appendChild(userBubble);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                chatInput.value = '';

                // Indicador de escribiendo
                const typingBubble = document.createElement('div');
                typingBubble.className = 'chat-bubble chat-bubble-bot';
                typingBubble.innerHTML = '<em>Consultando base de conocimiento...</em>';
                chatMessages.appendChild(typingBubble);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                try {
                    const res = await fetch('/api/chatbot', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: msgText })
                    });
                    const data = await res.json();
                    
                    // Formatear markdown básico a HTML
                    let htmlAnswer = data.answer
                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                        .replace(/\n\n/g, '<br><br>')
                        .replace(/\n/g, '<br>');

                    typingBubble.innerHTML = htmlAnswer;

                    // Si hay sugerencias, renderizarlas
                    if (data.suggestions && data.suggestions.length > 0) {
                        const sugBox = document.createElement('div');
                        sugBox.style.display = 'flex';
                        sugBox.style.flexDirection = 'column';
                        sugBox.style.gap = '0.35rem';
                        sugBox.style.marginTop = '0.4rem';

                        data.suggestions.forEach(sug => {
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'btn-chat-chip';
                            btn.textContent = sug;
                            btn.addEventListener('click', () => sendChatMessage(sug));
                            sugBox.appendChild(btn);
                        });
                        chatMessages.appendChild(sugBox);
                    }
                } catch (e) {
                    typingBubble.textContent = 'Lo siento, no pude conectar con el servidor. Puedes escribirnos a WhatsApp.';
                }

                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                sendChatMessage(chatInput.value);
            });

            document.querySelectorAll('.btn-chat-chip').forEach(chip => {
                chip.addEventListener('click', function() {
                    sendChatMessage(this.getAttribute('data-query'));
                });
            });
        });
    </script>
</body>
</html>

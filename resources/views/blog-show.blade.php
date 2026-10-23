<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | Masaje Californiano a Domicilio</title>
    <meta name="description" content="{{ $post->excerpt }}">
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-californiano.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/spa-theme.css') }}">
</head>
<body style="background-color: var(--color-cream);">

    <!-- Navbar simple -->
    <nav class="spa-navbar">
        <div class="spa-nav-container">
            <a href="{{ route('home') }}" class="spa-brand">
                <img src="{{ asset('images/logo-californiano.jpeg') }}" alt="Logo" class="spa-brand-img">
                <div class="spa-brand-text">
                    <h1>Masaje Californiano</h1>
                    <span>A Domicilio • CDMX & Playa del Carmen</span>
                </div>
            </a>
            <div class="spa-nav-actions">
                <a href="{{ route('home') }}#blog" class="btn-portal">
                    &larr; Volver al Blog
                </a>
                <a href="{{ route('home') }}#reservar" class="btn-cta btn-cta-gold">
                    Agendar Cita
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido del Artículo -->
    <main style="padding: 8rem 1.5rem 5rem; max-width: 860px; margin: 0 auto;">
        <article style="background: #ffffff; border-radius: 32px; padding: 3.5rem; border: 1px solid var(--color-sand); box-shadow: var(--shadow-elevated);">
            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap;">
                <span class="service-badge">{{ $post->category }}</span>
                <span style="font-size: 0.85rem; color: var(--color-gold); font-weight: 600;">
                    {{ $post->reading_time }}
                </span>
                <span style="font-size: 0.85rem; color: var(--color-text-muted);">
                    {{ $post->published_at ? $post->published_at->format('d de F, Y') : 'Publicación reciente' }}
                </span>
            </div>

            <h1 style="font-size: clamp(2.2rem, 4vw, 3.2rem); line-height: 1.15; margin-bottom: 1.5rem; color: var(--color-primary-dark);">
                {{ $post->title }}
            </h1>

            <p style="font-size: 1.15rem; color: var(--color-text-muted); font-style: italic; line-height: 1.7; border-left: 3px solid var(--color-gold); padding-left: 1.2rem; margin-bottom: 2.5rem;">
                {{ $post->excerpt }}
            </p>

            <div style="font-size: 1.05rem; line-height: 1.85; color: var(--color-text-dark); display: flex; flex-direction: column; gap: 1.5rem;">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Caja de Llamado a la Acción -->
            <div style="margin-top: 3.5rem; padding: 2.2rem; background: var(--color-primary-soft); border-radius: 20px; border: 1.5px solid var(--color-primary); text-align: center;">
                <h3 style="font-size: 1.6rem; color: var(--color-primary-dark); margin-bottom: 0.6rem;">
                    Vive la experiencia en la intimidad de tu hogar
                </h3>
                <p style="font-size: 0.95rem; color: var(--color-text-muted); max-width: 540px; margin: 0 auto 1.5rem;">
                    Jesús Arturo Robles acude a tu domicilio con camilla ergonómica, aromaterapia botánica y toallas térmicas.
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('home') }}#reservar" class="btn-cta btn-cta-gold" style="padding: 0.8rem 1.8rem;">
                        Reservar Mi Cita Ahora
                    </a>
                    <a href="https://wa.me/525512345678?text={{ urlencode('Hola Jesús Arturo, leí tu artículo "' . $post->title . '" y me gustaría agendar una sesión.') }}" target="_blank" class="btn-portal" style="background: #ffffff;">
                        Consultar por WhatsApp
                    </a>
                </div>
            </div>
        </article>

        <!-- Artículos Relacionados -->
        @if($recentPosts->isNotEmpty())
            <section style="margin-top: 4.5rem;">
                <h3 style="font-size: 1.8rem; color: var(--color-primary-dark); margin-bottom: 1.5rem; text-align: center;">
                    Otras lecturas recomendadas
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                    @foreach($recentPosts as $recent)
                        <div style="background: #ffffff; border-radius: 20px; padding: 1.6rem; border: 1px solid var(--color-sand); box-shadow: var(--shadow-soft);">
                            <span style="font-size: 0.75rem; color: var(--color-gold); font-weight: 700; text-transform: uppercase;">
                                {{ $recent->category }}
                            </span>
                            <h4 style="font-size: 1.2rem; margin: 0.6rem 0;">
                                <a href="{{ route('blog.show', $recent->slug) }}" style="text-decoration: none; color: var(--color-primary-dark);">
                                    {{ $recent->title }}
                                </a>
                            </h4>
                            <a href="{{ route('blog.show', $recent->slug) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--color-primary); text-decoration: none;">
                                Leer artículo &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <!-- Footer Simple -->
    <footer style="background: var(--color-primary-dark); color: #ffffff; padding: 2.5rem 1.5rem; text-align: center; font-size: 0.85rem;">
        <p style="margin: 0;">
            &copy; {{ date('Y') }} Masaje Californiano a Domicilio. Terapeuta: Jesús Arturo Robles Gutiérrez.
        </p>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sobre Nosotros - Asistencia Médica en Casa</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Estilos Inline en el Head -->
    <style>
        :root {
            --primary: #2D89CA;
            --secondary: #26B4E8;
            --light-blue: #84D3F6;
            --bg-light: #EFEFEF;
            --bg-lighter: #F6F6F7;
            --text-dark: #333;
            --text-light: #666;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-dark);
            background-color: white;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* === 1. BANNER FULL-SCREEN CON IMAGEN === */
        .banner-full {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('{{ asset('images/banner.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        .overlay-banner {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        .banner-hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 15;
            width: 100%;
            max-width: 820px;
            padding: 0 1.5rem;
            text-align: center;
        }

        .banner-hero-content h1 {
            font-size: 3.3rem;
            font-weight: 300;
            color: white;
            line-height: 1.2;
            margin: 0 auto 1.25rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
        }

        .banner-hero-content .highlight {
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--light-blue);
        }

        .banner-hero-content p {
            color: rgba(255, 255, 255, 0.92);
            font-size: 1.22rem;
            line-height: 1.75;
            margin: 0 auto;
            max-width: 720px;
            text-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
        }

        .banner-hero-btn {
            display: inline-block;
            margin-top: 1.75rem;
            padding: 0.85rem 1.8rem;
            background-color: var(--primary);
            color: white;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 30px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(45, 137, 202, 0.35);
        }

        .banner-hero-btn:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(45, 137, 202, 0.45);
        }

        /* === LOGO (superior derecha) === */
        .logo {
            position: absolute;
            padding: 1rem;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 20;
            transition: var(--transition);
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        /* === MENÚ SUPERIOR IZQUIERDA === */
        .menu {
            position: absolute;
            padding: 1rem;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 20;
        }

        .menu ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 400;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .menu a:hover {
            color: var(--light-blue);
            transform: translateY(-2px);
        }

        /* === REDES SOCIALES (inferior izquierda) === */
        .social-icons {
            position: absolute;
            padding: 1rem;
            bottom: 1.5rem;
            left: 1.5rem;
            z-index: 20;
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            color: white;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-icons a:hover {
            color: var(--light-blue);
            transform: scale(1.2) translateY(-3px);
        }

        /* === BOTÓN WHATSAPP FLOTANTE === */
        .whatsapp-float-wrapper {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .whatsapp-popup {
            background: white;
            color: var(--text-dark);
            padding: 0.7rem 1rem;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            position: relative;
            opacity: 0;
            transform: translateX(12px);
            animation: whatsappPopupIn 0.5s ease 1.2s forwards;
        }

        .whatsapp-popup::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: transparent transparent transparent white;
        }

        @keyframes whatsappPopupIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .whatsapp-float {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            background-color: #22c55e;
            border-radius: 9999px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            transition: transform 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        .whatsapp-float:focus {
            outline: none;
        }

        .whatsapp-float img {
            width: 2rem;
            height: 2rem;
        }

        .whatsapp-float .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        @media (max-width: 480px) {
            .whatsapp-popup {
                font-size: 0.8rem;
                padding: 0.55rem 0.8rem;
                max-width: 140px;
                white-space: normal;
                text-align: center;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .whatsapp-popup {
                opacity: 1;
                transform: none;
                animation: none;
            }
        }

        /* === INDICADOR DE SCROLL === */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            color: white;
            font-size: 1.5rem;
            text-align: center;
            opacity: 0.9;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            40% {
                transform: translateX(-50%) translateY(-15px);
            }

            60% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        /* === 2. SECCIÓN ¿QUIÉNES SOMOS? === */
        .section-nosotros {
            padding: 5rem 1.5rem;
            background-color: var(--bg-lighter);
            text-align: center;
        }

        .section-nosotros h2 {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .section-nosotros h2 .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .section-title {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            text-align: center;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .section-title .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .section-title-light {
            color: white;
            font-weight: 300;
        }

        .section-title-light .highlight {
            color: white;
            font-size: 2.4rem;
            font-weight: 600;
        }

        .section-nosotros p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--text-light);
        }

        /* === ANIMACIONES === */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .scroll-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-reveal-delay-1 {
            transition-delay: 0.15s;
        }

        .scroll-reveal-delay-2 {
            transition-delay: 0.3s;
        }

        .scroll-reveal-delay-3 {
            transition-delay: 0.45s;
        }

        @media (prefers-reduced-motion: reduce) {
            .scroll-reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }

            .beneficio-flip-inner {
                transform: none !important;
            }

            .beneficio-flip-front {
                display: none;
            }

            .beneficio-flip-back {
                position: relative;
                transform: none;
            }

            .aliados-track {
                animation: none;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
            }

            .aliados-group:not(:first-child) {
                display: none;
            }

            .logo-item {
                height: 90px;
            }

            .logo-item img {
                height: 84px;
                max-width: 180px;
            }
        }

        /* === 3. CALL TO ACTION CON PARALLAX === */
        .cta-parallax {
            position: relative;
            width: 100%;
            height: 400px;
            background: url('https://images.unsplash.com/photo-1581595219318-58688590621d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-attachment: fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 10;
        }

        .cta-overlay {
            position: absolute;
            inset: 0;
            background: rgba(45, 137, 202, 0.85);
            z-index: 1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
            color: white;
            max-width: 800px;
            padding: 0 1.5rem;
        }

        .cta-content h3 {
            font-size: 2rem;
            font-weight: 300;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .cta-content a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.8rem 1.8rem;
            background-color: white;
            color: var(--primary);
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cta-content a:hover {
            background-color: var(--light-blue);
            color: white;
            transform: scale(1.05);
        }

        /* === 4. SECCIÓN BENEFICIOS === */
        .section-beneficios {
            padding: 5rem 1.5rem;
            background-color: white;
        }

        .beneficios-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .beneficio-flip {
            perspective: 1000px;
            height: 300px;
            cursor: pointer;
        }

        .beneficio-flip-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.65s ease;
            transform-style: preserve-3d;
        }

        .beneficio-flip.is-flipped .beneficio-flip-inner {
            transform: rotateY(180deg);
        }

        .beneficio-flip.is-flipped .beneficio-flip-front,
        .beneficio-flip.is-flipped .beneficio-flip-back {
            border-color: var(--primary);
            box-shadow: 0 8px 20px rgba(45, 137, 202, 0.15);
        }

        .beneficio-flip-front,
        .beneficio-flip-back {
            position: absolute;
            inset: 0;
            backface-visibility: hidden;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e4e4e4;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        .beneficio-flip-front {
            background: white;
            display: flex;
            flex-direction: column;
        }

        .beneficio-flip-front img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .beneficio-flip-front img[src$=".svg"] {
            object-fit: contain;
            object-position: center;
            padding: 1.5rem 1.25rem 0.75rem;
            background: #e8f6fc;
        }

        .beneficio-flip-label {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--primary);
            background: white;
        }

        .beneficio-flip-back {
            transform: rotateY(180deg);
            background: var(--bg-lighter);
            padding: 1.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0.75rem;
        }

        .beneficio-flip-back i {
            color: var(--primary);
            font-size: 2rem;
        }

        .beneficio-flip-back h4 {
            font-size: 1.15rem;
            color: var(--primary);
            font-weight: 600;
            margin: 0;
        }

        .beneficio-flip-back p {
            color: var(--text-light);
            font-size: 0.92rem;
            line-height: 1.65;
            margin: 0;
        }

        /* === 5. SECCIÓN ALIADOS === */
        .section-aliados {
            padding: 4rem 1.5rem;
            background-color: var(--bg-lighter);
            text-align: center;
        }

        .section-aliados h3 {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .section-aliados h3 .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .aliados-carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
        }

        .aliados-track {
            display: flex;
            width: max-content;
            padding: 0.5rem 0;
            animation: aliados-scroll 35s linear infinite;
            will-change: transform;
        }

        .aliados-carousel:hover .aliados-track {
            animation-play-state: paused;
        }

        .aliados-group {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            padding-right: 2.5rem;
            flex-shrink: 0;
        }

        @keyframes aliados-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-25%);
            }
        }

        .logos-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-item {
            flex: 0 0 auto;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 0;
            box-shadow: none;
            transition: var(--transition);
        }

        .logo-item:hover {
            transform: scale(1.06);
            box-shadow: none;
            border-color: transparent;
        }

        .logo-placeholder {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-light);
            letter-spacing: 0.3px;
        }

        .logo-item img {
            height: 100px;
            width: auto;
            max-width: 220px;
            object-fit: contain;
            opacity: 0.95;
            transition: var(--transition);
        }

        .logo-item img:hover {
            opacity: 1;
        }

        /* === 6. FOOTER === */
        .footer {
            background-color: var(--primary);
            color: white;
            padding: 2.5rem 1.5rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer p {
            margin: 0;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
        }

        .footer-social a {
            color: white;
            font-size: 1rem;
            transition: var(--transition);
        }

        .footer-social a:hover {
            color: var(--light-blue);
            transform: scale(1.2);
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .menu ul {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .banner-hero-content {
                padding: 0 1.25rem;
            }

            .banner-hero-content h1 {
                font-size: 1.7rem;
            }

            .banner-hero-content .highlight {
                font-size: 2.1rem;
            }

            .banner-hero-content p {
                font-size: 0.92rem;
                line-height: 1.65;
            }

            .social-icons {
                bottom: 1rem;
                left: 1rem;
            }

            .social-icons a {
                font-size: 1.1rem;
            }

            .logo img {
                height: 36px;
            }

            .scroll-indicator {
                bottom: 1.5rem;
                font-size: 1.3rem;
            }

            .beneficios-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .beneficio-flip {
                height: 280px;
            }

            .cta-content h3 {
                font-size: 1.8rem;
            }

            .logos-container {
                gap: 1.5rem;
            }

            .logo-item img {
                height: 84px;
            }
        }

        @media (max-width: 480px) {
            .menu a {
                font-size: 0.85rem;
            }

            .section-nosotros h2,
            .section-title,
            .section-aliados h3 {
                font-size: 1.8rem;
            }

            .section-nosotros h2 .highlight,
            .section-title .highlight,
            .section-aliados h3 .highlight,
            .highlight {
                font-size: 2.2rem;
            }

            .section-title-light .highlight,
            .cta-content h3 .highlight {
                font-size: 2rem;
            }

            .section-nosotros p,
            .beneficio-flip-back p {
                font-size: 0.95rem;
            }

            .beneficios-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>

    <!-- 1. Banner Full-Screen con Menú, Logo y Redes -->
    <section class="banner-full">
        <div class="overlay-banner"></div>

        <!-- Logo en esquina superior derecha -->
        <div class="logo">
            <img src="{{ asset('images/logoNewTDEC.png') }}" alt="Logo Asistencia Médica">
        </div>

        <!-- Menú en esquina superior izquierda -->
        <nav class="menu">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="https://wa.me/584242271498?text=Hola ,%20me%20gustaría%20cotizar%20un%20seguro" target="_blank" rel="noopener noreferrer">Contáctanos</a></li>
            </ul>
        </nav>

        <!-- Contenido principal del banner -->
        <div class="banner-hero-content">
            <h1 class="scroll-reveal">¿Quiénes <span class="highlight">SOMOS?</span></h1>
            <p class="scroll-reveal scroll-reveal-delay-1">
                Somos una empresa dedicada a la asistencia médica en casa, ofreciendo atención personalizada,
                seguimiento continuo y planes de salud accesibles. Nuestro objetivo es brindar bienestar y tranquilidad
                a tus seres queridos sin necesidad de desplazamientos, garantizando calidad, profesionalismo y empatía.
                Con más de 10 años de experiencia, hemos transformado la forma en que miles de familias reciben cuidados médicos.
            </p>
            <a href="{{ asset('docs/Presentación Corporativa - Tu Doctor en Casa - 2026.pdf') }}" target="_blank" rel="noopener noreferrer" class="banner-hero-btn scroll-reveal scroll-reveal-delay-2">
                Saber más
            </a>
        </div>

        <!-- Redes sociales en esquina inferior izquierda -->
        <div class="social-icons">
            <a href="https://www.facebook.com/tudrencasa"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/tudrencasa/"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/tudrencasa"><i class="fab fa-twitter"></i></a>
        </div>

        <!-- Indicador de scroll -->
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i><br>
            <small>Leer mas!</small>
        </div>
    </section>

    <!-- 2. Call to Action con Parallax -->
    <section class="cta-parallax">
        <div class="cta-overlay"></div>
        <div class="cta-content">
            <h3 class="scroll-reveal section-title-light">¿Necesitas <span class="highlight">ATENCIÓN MÉDICA</span> en casa?</h3>
            <p class="scroll-reveal scroll-reveal-delay-1">Coordinamos tus servicios médicos primarios, farmacia, exámenes especiales y más. Nuestro equipo de profesionales altamente capacitados le brindará en todo momento una asesoría médica personalizada, garantizando una experiencia de cuidado confiable y eficiente.</p>
            <a href="https://wa.me/584242132112?text=Hola%2C%20me%20gustar%C3%ADa%20hablar%20con%20un%20experto" target="_blank" rel="noopener noreferrer" class="scroll-reveal scroll-reveal-delay-2">Habla con un experto</a>
        </div>
    </section>

    <!-- 4. Sección Beneficios -->
    <section class="section-beneficios">
        <div class="beneficios-grid">
            @foreach([
                ['Atención Inmediata', 'Servicio 24/7 con médicos y enfermeros disponibles en minutos.', 'beneficio-desplazamiento.png', 'fa-heartbeat'],
                ['Sin Desplazamientos', 'Evita traslados innecesarios, especialmente para adultos mayores.', 'beneficio-inmediata.png', 'fa-house-medical'],
                ['Planes Personalizados', 'Adaptamos el servicio a tus necesidades médicas y presupuesto.', 'beneficio-personalizado.png', 'fa-clipboard-list'],
                ['Seguimiento Continuo', 'Monitoreo constante y reportes mensuales para familiares.', 'beneficio-seguimiento.png', 'fa-chart-line'],
            ] as $index => $item)
                <article class="beneficio-flip scroll-reveal scroll-reveal-delay-{{ min($index + 1, 3) }}" tabindex="0">
                    <div class="beneficio-flip-inner">
                        <div class="beneficio-flip-front">
                            <img src="{{ asset('images/beneficios/' . $item[2]) }}" alt="{{ $item[0] }}">
                            <span class="beneficio-flip-label">{{ $item[0] }}</span>
                        </div>
                        <div class="beneficio-flip-back">
                            <i class="fas {{ $item[3] }}" aria-hidden="true"></i>
                            <h4>{{ $item[0] }}</h4>
                            <p>{{ $item[1] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- 5. Sección Aliados -->
    <section class="section-aliados">
        <h3 class="scroll-reveal section-title">Nuestros <span class="highlight">ALIADOS ESTRATÉGICOS</span></h3>
        <div class="aliados-carousel" aria-label="Carrusel de aliados estratégicos">
            <div class="aliados-track">
                @php
                    $aliados = [
                        ['archivo' => 'farmadc.png', 'nombre' => 'farmad+c'],
                        ['archivo' => 'fenix-salud.png', 'nombre' => 'Fénix Salud'],
                        ['archivo' => 'doctor-lente.png', 'nombre' => 'Doctor Lente 20/20'],
                        ['archivo' => 'vista-california.png', 'nombre' => 'Centro Clínico Vista California'],
                        ['archivo' => 'camara-comercio-valencia.png', 'nombre' => 'Cámara de Comercio Valencia'],
                        ['archivo' => 'nefrostat.png', 'nombre' => 'NEFROSTAT, C.A.'],
                        ['archivo' => 'sociedad-anticancerosa.png', 'nombre' => 'Sociedad Anticancerosa de Venezuela'],
                    ];
                @endphp
                {{-- 4 grupos iguales para scroll infinito sin huecos --}}
                @for ($grupo = 0; $grupo < 4; $grupo++)
                    <div class="aliados-group" @if($grupo > 0) aria-hidden="true" @endif>
                        @foreach ($aliados as $aliado)
                            <div class="logo-item">
                                <img
                                    src="{{ asset('images/aliados/' . $aliado['archivo']) }}"
                                    alt="{{ $grupo === 0 ? $aliado['nombre'] : '' }}"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- 6. Footer -->
    <footer class="footer" id="contacto">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Asistencia Médica en Casa. Todos los derechos reservados.</p>
            <div class="footer-social">
                <a href="https://www.facebook.com/tudrencasa"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/tudrencasa/"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://wa.me/584242271498?text=Hola ,%20me%20gustaría%20cotizar%20un%20seguro" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <!-- Script para animaciones al hacer scroll -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const revealElements = document.querySelectorAll('.scroll-reveal');
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -40px 0px'
            });

            revealElements.forEach(element => revealObserver.observe(element));

            const benefitCards = document.querySelectorAll('.beneficio-flip');
            const beneficiosSection = document.querySelector('.section-beneficios');
            let currentBenefitIndex = -1;
            let benefitInterval = null;
            const benefitIntervalMs = 3500;

            function setActiveBenefitCard(index) {
                benefitCards.forEach((card, i) => {
                    const isActive = i === index;
                    card.classList.toggle('is-flipped', isActive);
                    card.setAttribute('aria-expanded', isActive ? 'true' : 'false');
                });
                currentBenefitIndex = index;
            }

            function showNextBenefitCard() {
                const nextIndex = (currentBenefitIndex + 1) % benefitCards.length;
                setActiveBenefitCard(nextIndex);
            }

            function startBenefitAutoplay() {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                stopBenefitAutoplay();
                benefitInterval = setInterval(showNextBenefitCard, benefitIntervalMs);
            }

            function stopBenefitAutoplay() {
                if (benefitInterval) {
                    clearInterval(benefitInterval);
                    benefitInterval = null;
                }
            }

            if (benefitCards.length && beneficiosSection) {
                const autoplayObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            if (currentBenefitIndex === -1) {
                                showNextBenefitCard();
                            }
                            startBenefitAutoplay();
                        } else {
                            stopBenefitAutoplay();
                        }
                    });
                }, {
                    threshold: 0.3
                });

                autoplayObserver.observe(beneficiosSection);

                benefitCards.forEach((card, index) => {
                    card.setAttribute('role', 'button');
                    card.setAttribute('aria-expanded', 'false');

                    card.addEventListener('click', () => {
                        if (card.classList.contains('is-flipped')) {
                            setActiveBenefitCard(-1);
                        } else {
                            setActiveBenefitCard(index);
                        }

                        stopBenefitAutoplay();
                        setTimeout(startBenefitAutoplay, 1000);
                    });

                    card.addEventListener('keydown', (event) => {
                        if (event.key === 'Enter' || event.key === ' ') {
                            event.preventDefault();
                            card.click();
                        }
                    });
                });

                beneficiosSection.addEventListener('mouseenter', stopBenefitAutoplay);
                beneficiosSection.addEventListener('mouseleave', startBenefitAutoplay);
            }
        });
    </script>

    <!-- Botón de WhatsApp flotante -->
    <div class="whatsapp-float-wrapper">
        <div class="whatsapp-popup" role="status">Contáctanos</div>
        <a href="https://wa.me/584242271498?text=Hola ,%20me%20gustaría%20cotizar%20un%20seguro" target="_blank" rel="noopener noreferrer" class="whatsapp-float" aria-label="Cotiza con nosotros por WhatsApp">
            <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp">
        </a>
    </div>

</body>
</html>

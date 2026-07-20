<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tu Doctor en Casa &#8211; Humanizamos la salud 💚🩺 Plan de gastos menores que brinda atención médica especializada rápida y eficiente en sus hogares</title>

    <!--SEO-->
    <meta name="description" content="u Doctor en Casa es un modelo de asistencia de salud Integral, basada en los servicios de telemedicina y atención médica domiciliaria, las 24 horas, los 365 días del año.">
    <meta name="keywords" content="salud, viajes, seguros de viaje, asistencia médica, médico a domicilio,  Tu doctor en casa, tudrencasa, TuDrEnCasa, Medico en casa, telemedicina, atención Médica domiciliaria, ">
    <meta name="author" content="Tudrencasa">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.tudrencasa.com/">

    <meta property="og:title" content="Cuidamos tu Salud y tu Viaje">
    <meta property="og:description" content="Tudrencasa te ofrece servicios de salud a domicilio y seguros de viaje.">
    <meta property="og:image" content="{{ asset('images/imagotipo.png') }}">
    <meta property="og:url" content="https://www.tudrencasa.com/">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@Tudrencasa">
    <meta name="twitter:creator" content="@Tudrencasa">
    <meta name="twitter:title" content="Cuidamos tu Salud y tu Viaje">
    <meta name="twitter:description" content="Tudrencasa te ofrece servicios de salud a domicilio y seguros de viaje.">
    <meta name="twitter:image" content="{{ asset('images/imagotipo.png') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/imagotipo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/imagotipo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/imagotipo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/imagotipo.png') }}">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


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
            background-color: var(--bg-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* === SECCIÓN VIDEO FULLSCREEN === */
        .fullscreen-video {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .fullscreen-video video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .logo {
            position: absolute;
            padding: 1rem;
            top: 1rem;
            right: 1rem;
            z-index: 20;
            transition: var(--transition);
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        /* === MENÚ SUPERIOR (Escritorio) === */
        .menu-desktop {
            position: absolute;
            padding: 1rem;
            top: 1rem;
            left: 1rem;
            z-index: 20;
        }

        .menu-desktop ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .menu-desktop a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 400;
            letter-spacing: 0.3px;
            transition: var(--transition);
        }

        .menu-desktop a:hover {
            color: var(--light-blue);
            /* transform: translateY(-2px); */
            transform: scale(1.1) translateY(-3px);
        }

        /* === MENÚ HAMBURGUESA (Móvil) === */
        .menu-mobile {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 20;
            display: none;
            /* Oculto por defecto */
            cursor: pointer;
            color: white;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .menu-mobile:hover {
            color: var(--light-blue);
        }

        /* Panel desplegable (oculto por defecto) */
        .mobile-menu-panel {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(4px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 30;
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .mobile-menu-panel.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-panel ul {
            list-style: none;
            text-align: center;
            width: 80%;
            max-width: 300px;
        }

        .mobile-menu-panel a {
            display: block;
            color: white;
            text-decoration: none;
            font-size: 1.3rem;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            transition: var(--transition);
            letter-spacing: 0.5px;
        }

        .mobile-menu-panel a:hover {
            background-color: var(--primary);
            color: var(--light-blue);
        }

        .close-menu {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-menu:hover {
            color: var(--light-blue);
        }

        /* === REDES SOCIALES === */
        .social-icons {
            position: absolute;
            padding: 1rem;
            bottom: 1rem;
            left: 1rem;
            z-index: 20;
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            color: white;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .social-icons a:hover {
            color: var(--light-blue);
            transform: scale(1.2) translateY(-3px);
        }

        /* === SECCIONES === */
        .section-nosotros {
            padding: 5rem 1.5rem;
            background-color: var(--bg-lighter);
            color: var(--text-dark);
            text-align: left;
        }

        .nosotros-container {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 3rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .nosotros-tag {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border: 1px solid rgba(45, 137, 202, 0.25);
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 1.25rem;
        }

        .nosotros-title {
            font-size: 2rem;
            font-weight: 300;
            line-height: 1.2;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .nosotros-text {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-light);
            margin-bottom: 1rem;
            max-width: 560px;
        }

        .nosotros-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 14px;
            padding: 1.25rem 1rem;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(45, 137, 202, 0.12);
            border-color: var(--light-blue);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.82rem;
            line-height: 1.45;
            color: var(--text-light);
        }

        .nosotros-cta {
            display: inline-block;
            margin-top: 2rem;
        }

        .nosotros-image {
            width: 100%;
        }

        .nosotros-image img {
            width: 100%;
            height: 100%;
            min-height: 420px;
            max-height: 520px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(45, 137, 202, 0.15);
        }

        .section-testimonios {
            padding: 4rem 0 4.5rem;
            background-color: white;
            overflow: hidden;
        }

        .section-testimonios h2,
        .section-title {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 0 1.5rem;
            line-height: 1.2;
        }

        .section-testimonios h2 .highlight,
        .section-title .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .testimonials-carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
        }

        .testimonials-track {
            display: flex;
            gap: 1.5rem;
            width: max-content;
            padding: 0.5rem 0;
            animation: testimonials-scroll 45s linear infinite;
        }

        .testimonials-carousel:hover .testimonials-track {
            animation-play-state: paused;
        }

        @keyframes testimonials-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .testimonial-card {
            flex: 0 0 320px;
            background: var(--bg-lighter);
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .testimonial-stars {
            color: #f5b301;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
            letter-spacing: 2px;
        }

        .testimonial-quote {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.65;
            margin-bottom: 1.25rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .testimonial-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .testimonial-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }

        .testimonial-meta {
            font-size: 0.8rem;
            color: var(--text-light);
            margin: 0;
        }

        .section-planes {
            padding: 4rem 1.5rem;
            background-color: white;
        }

        .section-planes h2 {
            margin-bottom: 2rem;
        }

        .planes-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .plan-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem 1.2rem;
            width: 100%;
            max-width: 350px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .plan-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 12px 24px rgba(45, 137, 202, 0.18);
            border-color: var(--primary);
        }

        .plan-card h3 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.8rem;
            font-weight: 500;
        }

        .plan-card ul {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
            text-align: left;
            display: inline-block;
            width: 100%;
        }

        .plan-card li {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0.4rem 0;
            position: relative;
            padding-left: 1.2rem;
        }

        .plan-card li::before {
            content: "✔";
            color: var(--secondary);
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .plan-card a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.6rem 1.3rem;
            background-color: var(--primary);
            color: white;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .plan-card a:hover {
            background-color: var(--secondary);
            transform: scale(1.08);
        }

        /* === FOOTER === */
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

        .highlight
        {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
            text-underline-offset: 6px;
            text-decoration-thickness: 3px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            text-align: center;
            line-height: 1.2;
            margin-bottom: 2rem;
        }

        .section-title .highlight {
            font-size: 3rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .section-title-light {
            color: white;
        }

        .section-title-light .highlight {
            color: white;
            font-size: 2.4rem;
            font-weight: 600;
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

        .plan-card.scroll-reveal.is-visible:hover {
            transform: translateY(-8px) scale(1.03);
        }

        @media (prefers-reduced-motion: reduce) {
            .scroll-reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }

            .testimonials-track {
                animation: none;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
                max-width: 1100px;
                margin: 0 auto;
                padding: 0 1.5rem;
            }

            .testimonial-card {
                flex: 1 1 280px;
                max-width: 320px;
            }
        }

        /* === RESPONSIVE: Breakpoints === */

        /* Mostrar hamburguesa y ocultar menú desktop en móviles */
        @media (max-width: 768px) {
            .menu-desktop {
                display: none;
            }

            .menu-mobile {
                display: block;
            }

            .social-icons {
                bottom: 0.8rem;
                left: 0.8rem;
            }

            .social-icons a {
                font-size: 1rem;
            }

            .logo img {
                height: 32px;
            }

            .section-nosotros {
                padding: 3.5rem 1.25rem;
            }

            .nosotros-container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .nosotros-title {
                font-size: 1.8rem;
            }

            .nosotros-title .highlight {
                font-size: 2.2rem;
            }

            .nosotros-stats {
                grid-template-columns: 1fr;
            }

            .nosotros-image img {
                min-height: 280px;
                max-height: 360px;
            }

            .section-planes h2 {
                font-size: 1.8rem;
            }

            .section-testimonios h2,
            .section-title {
                font-size: 1.8rem;
            }

            .section-testimonios h2 .highlight,
            .section-title .highlight {
                font-size: 2.2rem;
            }

            .testimonial-card {
                flex: 0 0 280px;
            }

            .plan-card {
                max-width: 300px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .nosotros-title {
                font-size: 1.9rem;
            }

            .nosotros-title .highlight {
                font-size: 2.4rem;
            }
        }

        @media (max-width: 480px) {
            .mobile-menu-panel a {
                font-size: 1.2rem;
                padding: 0.9rem;
            }

            .nosotros-title {
                font-size: 1.7rem;
            }

            .nosotros-title .highlight {
                font-size: 2rem;
            }

            .nosotros-text {
                font-size: 0.95rem;
            }

            .stat-number {
                font-size: 1.7rem;
            }

            .section-planes h2,
            .section-title {
                font-size: 1.7rem;
            }

            .section-planes h2 .highlight,
            .section-title .highlight {
                font-size: 2rem;
            }
        }

        /* === BOTÓN EN SECCIÓN NOSOTROS === */
        .btn-nosotros {
            display: inline-block;
            padding: 0.8rem 1.8rem;
            background-color: var(--primary);
            color: white;
            margin-top: 4rem;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 30px; /* Bordes redondeados */
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(45, 137, 202, 0.2);
            transform: translateY(0);
        }

        .btn-nosotros.nosotros-cta {
            margin-top: 2rem;
        }

        .btn-nosotros:hover {
            transform: translateY(-3px); /* Eleva el botón */
            box-shadow: 0 7px 15px rgba(45, 137, 202, 0.35);
            background-color: var(--secondary); /* Cambia a azul más brillante */
            scale: 1.05; /* Aumento sutil */
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


        .scroll-indicator {
            bottom: 1.5rem;
            font-size: 1.3rem;
        }


        /* Responsive para móviles */
        @media (max-width: 480px) {
            .btn-nosotros {
                padding: 0.7rem 1.5rem;
                font-size: 0.95rem;
            }

            .btn-nosotros:hover {
                scale: 1.03;
                transform: translateY(-2px);
            }

        }

        .menu-style a:hover {
            transform: none;
        }

        .menu-style a:hover span {
            text-shadow: 0 0 10px rgba(132, 211, 246, 0.6), 0 0 20px rgba(132, 211, 246, 0.3);
            color: var(--light-blue);
        }

        /* === TEXTO CENTRADO SOBRE EL VIDEO === */
        .text-center-full {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            padding: 2rem;
            text-align: center;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            max-width: 900px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .btn-hero {
            display: inline-block;
            padding: 0.85rem 1.8rem;
            font-size: 1rem;
            font-weight: 500;
            font-family: inherit;
            text-decoration: none;
            border: none;
            border-radius: 30px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            white-space: nowrap;
            cursor: pointer;
        }

        .btn-hero-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 14px rgba(45, 137, 202, 0.35);
        }

        .btn-hero-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(45, 137, 202, 0.45);
        }

        .btn-hero-secondary {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
        }

        .btn-hero-secondary:hover {
            background-color: white;
            color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(0, 0, 0, 0.2);
        }

        .main-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 300;
            letter-spacing: -0.5px;
            line-height: 1.4;
            max-width: 800px;
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 1s ease forwards;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        /* Animación suave de entrada */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === RESPONSIVE: Ajuste en móviles === */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
                padding: 0 1rem;
            }

            .hero-content {
                gap: 1.5rem;
            }

            .hero-actions {
                flex-direction: column;
                width: 100%;
                max-width: 280px;
            }

            .btn-hero {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 1.6rem;
                line-height: 1.3;
            }
        }

        .highlightText {
            font-weight: bold;          /* Negrita */
            font-style: italic;         /* Cursiva */
            background: none;           /* Sin fondo, para mantenerlo minimalista */
            color: inherit;             /* Mantiene el color del texto original */
            padding: 0;                 /* Sin relleno extra */
            margin: 0;                  /* Sin márgenes */
            letter-spacing: -0.5px;     /* Ajuste sutil para mejorar la legibilidad (opcional) */
            font-family: inherit;       /* Usa la misma fuente que el texto padre */

            /* Sombra externa sutil — clave para el efecto minimalista */
            text-shadow:
            0 1px 2px rgba(0, 0, 0, 0.08),
            0 0 1px rgba(0, 0, 0, 0.05);


        }

        /* === ESTILO ESPECIAL PARA "PORTAL DEL AGENTE" === */

        .menu-desktop .menu-agent {
            color: var(--bg-light) !important;
            position: relative;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .menu-desktop .menu-agent::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 8px;
            border: 2px solid transparent;
            background: linear-gradient(90deg, var(--primary), var(--secondary)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .menu-desktop .menu-agent:hover {
            color: white !important;
            background-color: var(--primary);
            transform: scale(1.1) translateY(-3px);
        }

        .menu-desktop .menu-agent:hover::before {
            border-color: var(--secondary);
            background: linear-gradient(90deg, var(--secondary), var(--light-blue)) border-box;
        }








        /* === WHATSAPP FLOTANTE === */
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

        .whatsapp-float img {
            width: 2rem;
            height: 2rem;
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

        /* === MODAL COTIZACIÓN — iOS Liquid Glass === */
        .quote-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background: rgba(15, 23, 42, 0.35);
        }

        .quote-modal {
            position: relative;
            width: 100%;
            max-width: 720px;
            max-height: min(92vh, 760px);
            overflow-y: auto;
            padding: 1.75rem 1.5rem 1.5rem;
            border-radius: 28px;
            background:
                linear-gradient(145deg, rgba(255, 255, 255, 0.55) 0%, rgba(255, 255, 255, 0.28) 45%, rgba(255, 255, 255, 0.18) 100%);
            border: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.2) inset,
                0 24px 60px rgba(0, 0, 0, 0.22),
                0 2px 8px rgba(255, 255, 255, 0.35) inset;
            backdrop-filter: blur(10px) saturate(180%);
            -webkit-backdrop-filter: blur(10px) saturate(180%);
        }

        .quote-modal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 12%;
            right: 12%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.85), transparent);
            pointer-events: none;
        }

        .quote-modal-close {
            position: absolute;
            top: 0.85rem;
            right: 0.85rem;
            width: 2.25rem;
            height: 2.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.35);
            color: #334155;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .quote-modal-close:hover {
            background: rgba(255, 255, 255, 0.65);
            color: #0f172a;
            transform: scale(1.05);
        }

        .quote-modal-title {
            margin: 0 2rem 0.35rem 0;
            font-size: 1.35rem;
            font-weight: 600;
            color: #1e293b;
            letter-spacing: -0.02em;
        }

        .quote-modal-subtitle {
            margin: 0 0 1.5rem;
            font-size: 0.9rem;
            color: #000;
            font-weight: 400;
        }

        .quote-form {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        /* Honeypot anti-bot: oculto para humanos, visible para bots ingenuos */
        .quote-hp {
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .quote-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem 0.9rem;
        }

        .quote-field {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            text-align: left;
        }

        .quote-field label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1e293b;
        }

        .quote-field label .required {
            color: #ef4444;
            margin-left: 0.1rem;
        }

        .quote-input-wrap {
            display: flex;
            align-items: center;
            min-height: 2.85rem;
            padding: 0 0.95rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(148, 163, 184, 0.45);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .quote-input-wrap:focus-within {
            border-color: var(--secondary);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 0 0 3px rgba(38, 180, 232, 0.18);
        }

        .quote-input-wrap .quote-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .quote-input-wrap .quote-divider {
            width: 1px;
            height: 1.15rem;
            margin: 0 0.7rem;
            background: #cbd5e1;
            flex-shrink: 0;
        }

        .quote-input-wrap input,
        .quote-input-wrap select {
            flex: 1;
            min-width: 0;
            border: none;
            outline: none;
            background: transparent;
            font-family: inherit;
            font-size: 0.9rem;
            color: #1e293b;
            padding: 0.65rem 0;
            appearance: none;
            -webkit-appearance: none;
        }

        .quote-input-wrap input::placeholder {
            color: #94a3b8;
        }

        .quote-input-wrap select {
            cursor: pointer;
            padding-right: 1.5rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
        }

        .quote-field--full {
            grid-column: 1 / -1;
        }

        .quote-input-wrap--textarea {
            align-items: flex-start;
            min-height: 5.5rem;
            border-radius: 1.25rem;
            padding: 0.75rem 0.95rem;
        }

        .quote-input-wrap textarea {
            flex: 1;
            min-width: 0;
            width: 100%;
            min-height: 4.25rem;
            border: none;
            outline: none;
            background: transparent;
            font-family: inherit;
            font-size: 0.9rem;
            color: #1e293b;
            resize: vertical;
            padding: 0;
        }

        .quote-input-wrap textarea::placeholder {
            color: #94a3b8;
        }

        .quote-submit {
            align-self: center;
            margin-top: 0.35rem;
            min-width: 180px;
            padding: 0.85rem 2rem;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(45, 137, 202, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .quote-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(45, 137, 202, 0.45);
            filter: brightness(1.05);
        }

        .quote-submit:active {
            transform: translateY(0);
        }

        .quote-feedback {
            text-align: center;
            font-size: 0.875rem;
            color: #0f766e;
            background: rgba(45, 212, 191, 0.18);
            border: 1px solid rgba(45, 212, 191, 0.35);
            border-radius: 999px;
            padding: 0.65rem 1rem;
        }

        .quote-feedback--error {
            color: #b91c1c;
            background: rgba(248, 113, 113, 0.16);
            border-color: rgba(220, 38, 38, 0.35);
        }

        .quote-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
            filter: none;
        }

        /* Morph modal → logo al enviar */
        .quote-modal-overlay.is-morphing {
            pointer-events: none;
            animation: quoteOverlayFade 4.4s ease forwards;
        }

        /* Evita el flash al cerrar: se mantiene invisible y sin transición de Alpine */
        .quote-modal-overlay.is-morph-done,
        .quote-modal.is-morph-done {
            opacity: 0 !important;
            visibility: hidden !important;
            transition: none !important;
            animation: none !important;
            pointer-events: none !important;
        }

        .quote-modal-overlay.is-morph-done.opacity-100,
        .quote-modal.is-morph-done.opacity-100 {
            opacity: 0 !important;
        }

        .quote-modal.is-morph-done {
            width: 120px !important;
            height: 120px !important;
            max-width: 120px !important;
            max-height: 120px !important;
            transform: scale(0.92) !important;
        }

        .quote-modal-content {
            transition: opacity 0.28s ease, transform 0.35s ease;
        }

        .quote-modal-logo {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transform: scale(0.45);
            z-index: 2;
        }

        .quote-modal-logo img {
            width: 72px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.2));
        }

        .quote-success-check {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.2rem;
            opacity: 0;
            transform: scale(0.6);
            z-index: 3;
            pointer-events: none;
        }

        .quote-success-check svg {
            width: 48px;
            height: 48px;
            overflow: visible;
            flex-shrink: 0;
        }

        .quote-success-label {
            margin: 0;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #fff;
            text-transform: uppercase;
            line-height: 1;
        }

        .quote-check-circle {
            fill: rgba(22, 163, 74, 0.18);
            stroke: #16a34a;
            stroke-width: 2.5;
            stroke-dasharray: 160;
            stroke-dashoffset: 160;
        }

        .quote-check-mark {
            fill: none;
            stroke: #15803d;
            stroke-width: 3.2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
        }

        .quote-modal.is-morphing {
            width: 120px;
            height: 120px;
            max-width: 120px;
            max-height: 120px;
            padding: 0;
            border-radius: 28px;
            overflow: hidden;
            pointer-events: none;
            transition:
                width 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.12s,
                height 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.12s,
                max-width 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.12s,
                max-height 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.12s,
                padding 0.5s ease 0.1s,
                border-radius 0.65s cubic-bezier(0.4, 0, 0.2, 1) 0.15s,
                box-shadow 0.5s ease;
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.35) inset,
                0 16px 40px rgba(0, 0, 0, 0.25);
            animation: quoteLogoPop 4.4s ease forwards;
        }

        .quote-modal.is-morphing .quote-modal-content {
            opacity: 0;
            transform: scale(0.55);
            pointer-events: none;
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .quote-modal.is-morphing .quote-modal-close,
        .quote-modal.is-morphing .quote-modal::before {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .quote-modal.is-morphing .quote-modal-logo {
            animation: quoteLogoSoftFade 4.4s ease forwards;
        }

        .quote-modal.is-morphing .quote-modal-logo img {
            animation: quoteLogoPulse 1.1s ease-in-out 0.9s 2;
        }

        .quote-modal.is-morphing .quote-success-check {
            animation: quoteCheckReveal 4.4s ease forwards;
        }

        .quote-modal.is-morphing .quote-check-circle {
            animation: quoteCheckCircleDraw 0.28s ease forwards 2.2s;
        }

        .quote-modal.is-morphing .quote-check-mark {
            animation: quoteCheckMarkDraw 0.22s ease forwards 2.4s;
        }

        @keyframes quoteLogoPop {
            0%,
            82% {
                transform: scale(1);
                opacity: 1;
            }
            90% {
                transform: scale(1.04);
                opacity: 1;
            }
            100% {
                transform: scale(0.94);
                opacity: 0;
            }
        }

        @keyframes quoteLogoSoftFade {
            0%,
            18% {
                opacity: 0;
                transform: scale(0.45);
            }
            25% {
                opacity: 1;
                transform: scale(1);
            }
            42% {
                opacity: 1;
                transform: scale(1);
            }
            48% {
                opacity: 0;
                transform: scale(0.88);
            }
            100% {
                opacity: 0;
                transform: scale(0.88);
            }
        }

        @keyframes quoteLogoPulse {
            0%,
            100% {
                transform: scale(1);
                filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.2));
            }
            50% {
                transform: scale(1.12);
                filter: drop-shadow(0 8px 22px rgba(38, 180, 232, 0.45));
            }
        }

        @keyframes quoteCheckReveal {
            0%,
            48% {
                opacity: 0;
                transform: scale(0.55);
            }
            52% {
                opacity: 1;
                transform: scale(1.1);
            }
            55% {
                opacity: 1;
                transform: scale(1);
            }
            75% {
                opacity: 1;
                transform: scale(1);
            }
            100% {
                opacity: 0;
                transform: scale(0.92);
            }
        }

        @keyframes quoteCheckCircleDraw {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes quoteCheckMarkDraw {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes quoteOverlayFade {
            0%,
            84% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .quote-modal.is-morphing,
            .quote-modal-overlay.is-morphing,
            .quote-modal.is-morphing .quote-modal-logo,
            .quote-modal.is-morphing .quote-modal-logo img,
            .quote-modal.is-morphing .quote-success-check,
            .quote-modal.is-morphing .quote-check-circle,
            .quote-modal.is-morphing .quote-check-mark,
            .quote-modal.is-morphing .quote-modal-content {
                animation: none;
                transition: opacity 0.2s ease;
            }
        }

        [x-cloak] {
            display: none !important;
        }

        @media (max-width: 640px) {
            .quote-modal {
                padding: 1.5rem 1.15rem 1.25rem;
                border-radius: 24px;
                max-height: 92vh;
            }

            .quote-form-grid {
                grid-template-columns: 1fr;
            }

            .quote-modal-title {
                font-size: 1.2rem;
            }

            .quote-submit {
                width: 100%;
            }
        }

    </style>
</head>
<body
    data-quote-url="{{ route('quote.store') }}"
    x-data="quoteForm()"
    @keydown.escape.window="cerrarCotizacion()"
    :class="{ 'overflow-hidden': quoteModalOpen }"
>
<script>
    function quoteForm() {
        return {
            quoteModalOpen: false,
            quoteSubmitting: false,
            quoteMorphing: false,
            quoteMorphDone: false,
            quoteError: '',
            quoteNombre: '',
            quoteTelefono: '',
            quoteEmail: '',
            quoteEstado: '',
            quoteCiudad: '',
            quoteObservaciones: '',
            quoteWebsite: '',
            resetCotizacion() {
                this.quoteSubmitting = false;
                this.quoteMorphing = false;
                this.quoteMorphDone = false;
                this.quoteError = '';
                this.quoteNombre = '';
                this.quoteTelefono = '';
                this.quoteEmail = '';
                this.quoteEstado = '';
                this.quoteCiudad = '';
                this.quoteObservaciones = '';
                this.quoteWebsite = '';
            },
            playQuoteSuccess() {
                this.quoteSubmitting = false;
                this.quoteMorphing = true;
                setTimeout(() => {
                    this.quoteMorphDone = true;
                    requestAnimationFrame(() => {
                        this.quoteModalOpen = false;
                        setTimeout(() => this.resetCotizacion(), 220);
                    });
                }, 4400);
            },
            async enviarCotizacion() {
                if (this.quoteSubmitting || this.quoteMorphing || this.quoteMorphDone) return;

                this.quoteError = '';

                const phone = (this.quoteTelefono || '').trim();
                const email = (this.quoteEmail || '').trim();
                if (!phone && !email) {
                    this.quoteError = 'Indica al menos un teléfono o un correo electrónico.';
                    return;
                }

                this.quoteSubmitting = true;

                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const url = document.body.dataset.quoteUrl;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf || '',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({
                            full_name: this.quoteNombre,
                            phone: this.quoteTelefono,
                            email: this.quoteEmail,
                            state: this.quoteEstado,
                            city: this.quoteCiudad,
                            observations: this.quoteObservaciones,
                            website: this.quoteWebsite,
                        }),
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        if (response.status === 429) {
                            this.quoteError = 'Has enviado demasiadas solicitudes. Espera un momento e inténtalo de nuevo.';
                        } else if (response.status === 422 && data.errors) {
                            const firstError = Object.values(data.errors).flat()[0];
                            this.quoteError = firstError || 'Revisa los campos del formulario.';
                        } else {
                            this.quoteError = data.message || 'No pudimos enviar tu solicitud. Inténtalo de nuevo.';
                        }
                        this.quoteSubmitting = false;
                        return;
                    }

                    this.playQuoteSuccess();
                } catch (error) {
                    this.quoteError = 'No pudimos enviar tu solicitud. Revisa tu conexión e inténtalo de nuevo.';
                    this.quoteSubmitting = false;
                }
            },
            cerrarCotizacion() {
                if (this.quoteSubmitting || this.quoteMorphing || this.quoteMorphDone) return;
                this.quoteModalOpen = false;
                this.quoteError = '';
            },
        };
    }
</script>

    <!-- 1. Sección Video Fullscreen -->
    <section class="fullscreen-video" id="home">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('images/videoBanner.mp4') }}" type="video/mp4">
            Tu navegador no soporta video.
        </video>
        <div class="overlay"></div>

        <!-- ✅ TEXTO CENTRADO SOBRE EL VIDEO -->
        <div class="text-center-full">
            <div class="hero-content">
                <h1 class="main-title">
                    Asistencia médica con empatía,
                    que llega a cualquier rincón de Venezuela.
                </h1>
                <div class="hero-actions">
                    <button type="button" class="btn-hero btn-hero-primary" @click="quoteModalOpen = true">Cotiza con nosotros</button>
                    <a href="https://integracorp.tudrgroup.com/formulario-externo" target="_blank" rel="noopener noreferrer" class="btn-hero btn-hero-secondary">Sé nuestro aliado</a>
                </div>
            </div>
        </div>


        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logoNewTDEC.png') }}" alt="Logo Asistencia Médica">
        </div>

         <!-- Menú desplegable - Esquina superior izquierda con iconos y glow -->
         <div class="absolute top-8 left-6 z-30" x-data="{ open: false }" @click.away="open = false">
             <!-- Botón con ícono + texto "Menú" -->
             <button @click="open = !open" class="flex items-center space-x-2 px-4 py-2 rounded-full bg-black bg-opacity-30 backdrop-blur-sm border border-white border-opacity-20 hover:bg-opacity-50 transition-all duration-200 group focus:outline-none text-white text-sm font-medium" aria-label="Menú">
                 <div class="flex space-x-1">
                     {{-- <span class="block h-1 w-5 bg-white opacity-70 group-hover:opacity-100 transition"></span> --}}
                     <span class="block h-1 w-5 bg-white opacity-70 group-hover:opacity-100 transition"></span>
                     <span class="block h-1 w-5 bg-white opacity-70 group-hover:opacity-100 transition"></span>
                 </div>
                 <span>Menú Comercial</span>
             </button>

             <!-- Dropdown con iconos y efecto glow -->
             <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="origin-top-left absolute mt-2 w-52 rounded-xl shadow-lg bg-black bg-opacity-20 backdrop-blur-sm border border-white border-opacity-20 hover:bg-opacity-200 overflow-hidden">
                 <div class="py-1 text-sm text-gray-200">

                     <!-- Item 1: Panel Principal -->
                     <a href="https://integracorp.tudrgroup.com/master" class="flex items-center px-4 py-3 hover:bg-white hover:bg-opacity-10 transition duration-200 group">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-3">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                         </svg>
                         <span class="group-hover:text-white transition">AGENCIA MASTER</span>
                         <!-- Efecto glow al hacer hover -->
                         <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 blur-sm rounded-xl pointer-events-none"></div>
                     </a>

                     <!-- Item 2: General -->
                     <a href="https://integracorp.tudrgroup.com/general" class="flex items-center px-4 py-3 hover:bg-white hover:bg-opacity-10 transition duration-200 group">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-3">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                         </svg>
                         <span class="group-hover:text-white transition">AGENCIA GENERAL</span>
                         <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-transparent opacity-0 group-hover:opacity-100 blur-sm rounded-xl pointer-events-none"></div>
                     </a>

                     <!-- Item 2: Agentes -->
                     <a href="https://integracorp.tudrgroup.com/agents" class="flex items-center px-4 py-3 hover:bg-white hover:bg-opacity-10 transition duration-200 group">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-3">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                         </svg>
                         <span class="group-hover:text-white transition">AGENTE</span>
                         <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-transparent opacity-0 group-hover:opacity-100 blur-sm rounded-xl pointer-events-none"></div>
                     </a>
                 </div>
             </div>
         </div>


        <!-- Menú Desktop (solo en pantallas grandes) -->
        {{-- <nav class="menu-desktop menu-style">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="{{ route('inConstruccion') }}">Nosotros</a></li>
                <li><a href="{{ route('inConstruccion') }}">Contáctanos</a></li>
                <li><a href="https://integracorp.tudrgroup.com/agents" target="_blank" class="menu-agent">Portal del Agente</a></li>
                <li><a href="https://integracorp.tudrgroup.com/master" target="_blank" class="menu-agent">Portal Agencia Master</a></li>
                <li><a href="https://integracorp.tudrgroup.com/general" target="_blank" class="menu-agent">Portal Agencia General</a></li>
            </ul>
        </nav> --}}

        <!-- Menú Hamburguesa (solo en móviles) -->
        <div class="menu-mobile" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Panel Móvil Desplegable -->
        <div class="mobile-menu-panel" id="mobile-menu">
            <div class="close-menu" id="close-menu">
                <i class="fas fa-times"></i>
            </div>
            <ul>
                <li><a href="#home" onclick="closeMobileMenu()"><span>Inicio</span></a></li>
                <li><a href="{{ asset('docs/Presentación Corporativa - Tu Doctor en Casa - 2026.pdf') }}" target="_blank" rel="noopener noreferrer" onclick="closeMobileMenu()"><span>Nosotros</span></a></li>
                <li><a href="https://wa.me/584242271498?text=Hola ,%20me%20gustaría%20cotizar%20un%20seguro" target="_blank" rel="noopener noreferrer" onclick="closeMobileMenu()"><span>Contáctanos</span></a></li>
                <li><a href="https://integracorp.tudrgroup.com/agents" onclick="closeMobileMenu()" class="menu-agent"><span>Portal del Agente</span></a></li>
                <li><a href="https://integracorp.tudrgroup.com/master" onclick="closeMobileMenu()" class="menu-agent"><span>Portal Agencia Master</span></a></li>
                <li><a href="https://integracorp.tudrgroup.com/general" onclick="closeMobileMenu()" class="menu-agent"><span>Portal Agencia General</span></a></li>
            </ul>
        </div>

        <!-- Redes sociales -->
        <div class="social-icons">
            <a href="https://www.facebook.com/tudrencasa"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/tudrencasa/"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/tudrencasa"><i class="fab fa-twitter"></i></a>
        </div>

        <!-- Indicador de scroll -->
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i><br>
        </div>

    </section>

    <!-- 2. Sección Sobre Nosotros -->
    <section id="nosotros" class="section-nosotros">
        <div class="nosotros-container">
            <div class="nosotros-content">
                <h2 class="nosotros-title scroll-reveal scroll-reveal-delay-1">Acerca de <span class="highlight">NOSOTROS</span></h2>
                <p class="nosotros-text scroll-reveal scroll-reveal-delay-1">
                    Somos una empresa dedicada a la asistencia médica en casa, ofreciendo atención personalizada,
                    seguimiento continuo y planes de salud accesibles.
                </p>
                <p class="nosotros-text scroll-reveal scroll-reveal-delay-2">
                    Nuestro objetivo es brindar bienestar y tranquilidad a tus seres queridos sin necesidad de
                    desplazamientos, garantizando calidad, profesionalismo y empatía en cada atención.
                </p>

                <div class="nosotros-stats scroll-reveal scroll-reveal-delay-2">
                    <div class="stat-card">
                        <span class="stat-number" data-from="1" data-to="4" data-prefix="+">+1</span>
                        <span class="stat-label">Años de experiencia en el rubro</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number" data-from="0" data-to="100" data-suffix="%">0%</span>
                        <span class="stat-label">Servicio integral</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number" data-from="1" data-to="24">1</span>
                        <span class="stat-label">Horas de atención disponible al día</span>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="btn-nosotros nosotros-cta scroll-reveal scroll-reveal-delay-3">
                    Leer más!
                </a>
            </div>

            <div class="nosotros-image scroll-reveal scroll-reveal-delay-1">
                <img src="{{ asset('images/banner.jpg') }}" alt="Tu Doctor en Casa - asistencia médica en casa">
            </div>
        </div>
    </section>

    @php
        $testimonios = [
            ['iniciales' => 'MR', 'nombre' => 'María Rodríguez', 'ubicacion' => 'Caracas', 'texto' => 'Cotizamos el plan Ideal para mi madre y la atención domiciliaria ha sido excelente. Siempre responden rápido y con mucha empatía.'],
            ['iniciales' => 'CL', 'nombre' => 'Carlos López', 'ubicacion' => 'Valencia', 'texto' => 'El proceso de cotización fue muy sencillo. En pocos minutos entendí las coberturas y pude elegir el plan que mejor se adaptaba a mi familia.'],
            ['iniciales' => 'AP', 'nombre' => 'Ana Pérez', 'ubicacion' => 'Maracaibo', 'texto' => 'Contratamos Tu Doctor en Casa tras cotizar varias opciones. La telemedicina nos ha ahorrado desplazamientos y nos da mucha tranquilidad.'],
            ['iniciales' => 'JG', 'nombre' => 'José González', 'ubicacion' => 'Barquisimeto', 'texto' => 'Me sorprendió lo claro que fue el equipo al explicarme cada beneficio. Hoy mi esposa recibe seguimiento médico sin salir de casa.'],
            ['iniciales' => 'LM', 'nombre' => 'Laura Martínez', 'ubicacion' => 'Maracay', 'texto' => 'Cotizamos en línea y recibimos asesoría personalizada. El plan Especial nos ha dado respaldo real en momentos de urgencia.'],
            ['iniciales' => 'RF', 'nombre' => 'Ricardo Fernández', 'ubicacion' => 'Puerto Ordaz', 'texto' => 'Excelente relación calidad-precio. Desde que cotizamos el servicio, la atención ha sido profesional y muy humana con mi padre.'],
            ['iniciales' => 'IS', 'nombre' => 'Isabel Soto', 'ubicacion' => 'Mérida', 'texto' => 'La cotización fue rápida y sin complicaciones. Ahora contamos con médicos disponibles las 24 horas, eso no tiene precio.'],
            ['iniciales' => 'DH', 'nombre' => 'Daniel Herrera', 'ubicacion' => 'San Cristóbal', 'texto' => 'Recomiendo totalmente el servicio. Cotizamos el plan Inicial y superó nuestras expectativas en atención y seguimiento.'],
            ['iniciales' => 'VC', 'nombre' => 'Verónica Castillo', 'ubicacion' => 'Lechería', 'texto' => 'Me guiaron paso a paso en la cotización. Hoy mi familia tiene cobertura médica confiable sin tener que ir a clínicas.'],
            ['iniciales' => 'EM', 'nombre' => 'Eduardo Morales', 'ubicacion' => 'Ciudad Guayana', 'texto' => 'Después de cotizar con ustedes, contratamos el plan y la experiencia ha sido impecable. Atención rápida, clara y muy cercana.'],
        ];
    @endphp

    <!-- 3. Sección Testimonios -->
    <section id="testimonios" class="section-testimonios">
        <h2 class="section-title scroll-reveal">Lo que dicen nuestros <span class="highlight">CLIENTES</span></h2>

        <div class="testimonials-carousel" aria-label="Carrusel de testimonios">
            <div class="testimonials-track">
                @foreach (array_merge($testimonios, $testimonios) as $testimonio)
                    <article class="testimonial-card">
                        <div class="testimonial-stars" aria-hidden="true">★★★★★</div>
                        <p class="testimonial-quote">"{{ $testimonio['texto'] }}"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">{{ $testimonio['iniciales'] }}</div>
                            <div>
                                <p class="testimonial-name">{{ $testimonio['nombre'] }}</p>
                                <p class="testimonial-meta">{{ $testimonio['ubicacion'] }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. Sección Planes de Salud -->
    <section class="section-planes">
        <h2 class="section-title scroll-reveal">Nuestros <span class="highlight">PLANES DE SALUD</span></h2>

        <div class="planes-container">
            <div class="plan-card scroll-reveal scroll-reveal-delay-1">
                <h3>Inicial</h3>
                <ul>
                    <li>Atención Médica Telefónica</li>
                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Médica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                </ul>

            </div>
            <div class="plan-card scroll-reveal scroll-reveal-delay-2">
                <h3>Ideal</h3>
                <ul>
                    <li>Atención Médica Telefónica</li>
                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Médica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                    <li><span class="highlightText">Traslado en Ambulancia urbano en caso de Emergencia</span></li>
                    <li><span class="highlightText">Consulta ONLINE o Presencial con Médicos Especialistas</span></li>
                    <li><span class="highlightText">Asistencia Médica por Accidente</span></li>
                </ul>

            </div>
            <div class="plan-card scroll-reveal scroll-reveal-delay-3">
                <h3>Especial</h3>
                <ul>
                    <li>Atención Médica Telefónica</li>

                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Médica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                    <li>Traslado en Ambulancia urbano en caso de Emergencia</li>
                    <li>Consulta ONLINE o Presencial con Médicos Especialistas</li>
                    <li><span class="highlightText">Urgencias Menores en Domicilio o en sitio</span></li>
                    <li><span class="highlightText">Asistencia Médica por emergencia. (Patologías Listadas)</span></li>
                </ul>

            </div>
        </div>
    </section>

    <!-- 5. Footer -->
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

    <!-- JavaScript para el menú hamburguesa -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenu = document.getElementById('close-menu');

        // Abrir menú
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden'; // Evita scroll de fondo
        });

        // Cerrar menú
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = ''; // Restaura scroll
        }

        // Cerrar al hacer clic en X
        closeMenu.addEventListener('click', closeMobileMenu);

        // Cerrar al hacer clic fuera del menú
        mobileMenu.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                closeMobileMenu();
            }
        });

        // Animaciones al hacer scroll
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

            function animateCounter(element, duration = 1800) {
                const from = parseFloat(element.dataset.from || '0');
                const to = parseFloat(element.dataset.to || '0');
                const prefix = element.dataset.prefix || '';
                const suffix = element.dataset.suffix || '';

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    element.textContent = `${prefix}${to}${suffix}`;
                    return;
                }

                const startTime = performance.now();

                function update(currentTime) {
                    const progress = Math.min((currentTime - startTime) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const value = Math.round(from + ((to - from) * eased));
                    element.textContent = `${prefix}${value}${suffix}`;

                    if (progress < 1) {
                        requestAnimationFrame(update);
                    }
                }

                requestAnimationFrame(update);
            }

            const statsBlocks = document.querySelectorAll('.nosotros-stats');
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.querySelectorAll('.stat-number').forEach(counter => {
                        animateCounter(counter);
                    });

                    statsObserver.unobserve(entry.target);
                });
            }, {
                threshold: 0.35
            });

            statsBlocks.forEach(block => statsObserver.observe(block));
        });

    </script>

    <!-- Botón de WhatsApp flotante -->
    <div class="whatsapp-float-wrapper">
        <div class="whatsapp-popup" role="status">Contáctanos</div>
        <a href="https://wa.me/584242271498?text=Hola ,%20me%20gustaría%20cotizar%20un%20seguro" target="_blank" rel="noopener noreferrer" class="whatsapp-float" aria-label="Cotiza con nosotros por WhatsApp">
            <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp">
        </a>
    </div>

    <!-- Modal cotización — iOS Liquid Glass -->
    <div
        class="quote-modal-overlay"
        :class="{ 'is-morphing': quoteMorphing, 'is-morph-done': quoteMorphDone }"
        x-show="quoteModalOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="cerrarCotizacion()"
        role="dialog"
        aria-modal="true"
        aria-labelledby="quote-modal-title"
    >
        <div
            class="quote-modal"
            :class="{ 'is-morphing': quoteMorphing, 'is-morph-done': quoteMorphDone }"
            @click.stop
        >
            <div class="quote-modal-logo" aria-hidden="true">
                <img src="{{ asset('images/imagotipo.png') }}" alt="">
            </div>
            <div class="quote-success-check" aria-hidden="true">
                <svg viewBox="0 0 52 52" aria-hidden="true">
                    <circle class="quote-check-circle" cx="26" cy="26" r="24"></circle>
                    <path class="quote-check-mark" d="M14.5 27.2l7.2 7.2 16.8-16.9"></path>
                </svg>
                <p class="quote-success-label">ENVIADO</p>
            </div>

            <div class="quote-modal-content">
                <button type="button" class="quote-modal-close" @click="cerrarCotizacion()" aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>

                <h2 id="quote-modal-title" class="quote-modal-title">Cotiza con nosotros</h2>
                <p class="quote-modal-subtitle">Déjanos tus datos y te contactaremos pronto. Indica al menos un teléfono o un correo.</p>

                <form class="quote-form" @submit.prevent="enviarCotizacion()">
                    <div class="quote-hp" aria-hidden="true">
                        <label for="quote-website">Sitio web</label>
                        <input
                            id="quote-website"
                            type="text"
                            name="website"
                            x-model="quoteWebsite"
                            tabindex="-1"
                            autocomplete="off"
                            :disabled="quoteSubmitting || quoteMorphing"
                        >
                    </div>

                    <div class="quote-form-grid">
                        <div class="quote-field">
                            <label for="quote-nombre">Nombre y Apellido<span class="required">*</span></label>
                            <div class="quote-input-wrap">
                                <span class="quote-icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                                <span class="quote-divider" aria-hidden="true"></span>
                                <input
                                    id="quote-nombre"
                                    type="text"
                                    name="full_name"
                                    x-model="quoteNombre"
                                    placeholder="Tu nombre completo"
                                    required
                                    autocomplete="name"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                >
                            </div>
                        </div>

                        <div class="quote-field">
                            <label for="quote-telefono">Número de teléfono</label>
                            <div class="quote-input-wrap">
                                <span class="quote-icon" aria-hidden="true"><i class="fas fa-phone"></i></span>
                                <span class="quote-divider" aria-hidden="true"></span>
                                <input
                                    id="quote-telefono"
                                    type="tel"
                                    name="phone"
                                    x-model="quoteTelefono"
                                    placeholder="0412 000 0000"
                                    autocomplete="tel-national"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                >
                            </div>
                        </div>

                        <div class="quote-field">
                            <label for="quote-email">Correo Electrónico</label>
                            <div class="quote-input-wrap">
                                <input
                                    id="quote-email"
                                    type="email"
                                    name="email"
                                    x-model="quoteEmail"
                                    placeholder="correo@ejemplo.com"
                                    autocomplete="email"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                >
                            </div>
                        </div>

                        <div class="quote-field">
                            <label for="quote-estado">Estado<span class="required">*</span></label>
                            <div class="quote-input-wrap">
                                <input
                                    id="quote-estado"
                                    type="text"
                                    name="state"
                                    x-model="quoteEstado"
                                    placeholder="Ej. Miranda"
                                    required
                                    autocomplete="address-level1"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                >
                            </div>
                        </div>

                        <div class="quote-field">
                            <label for="quote-ciudad">Ciudad<span class="required">*</span></label>
                            <div class="quote-input-wrap">
                                <input
                                    id="quote-ciudad"
                                    type="text"
                                    name="city"
                                    x-model="quoteCiudad"
                                    placeholder="Ej. Caracas"
                                    required
                                    autocomplete="address-level2"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                >
                            </div>
                        </div>

                        <div class="quote-field quote-field--full">
                            <label for="quote-observaciones">Observaciones</label>
                            <div class="quote-input-wrap quote-input-wrap--textarea">
                                <textarea
                                    id="quote-observaciones"
                                    name="observations"
                                    x-model="quoteObservaciones"
                                    placeholder="Cuéntanos algo adicional (opcional)"
                                    rows="3"
                                    maxlength="2000"
                                    :disabled="quoteSubmitting || quoteMorphing"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <p
                        class="quote-feedback quote-feedback--error"
                        x-show="quoteError"
                        x-text="quoteError"
                        x-cloak
                        role="alert"
                    ></p>

                    <button type="submit" class="quote-submit" :disabled="quoteSubmitting || quoteMorphing">
                        <span x-show="!quoteSubmitting">Enviar</span>
                        <span x-show="quoteSubmitting" x-cloak>Enviando…</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

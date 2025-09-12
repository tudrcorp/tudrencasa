<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Asistencia Médica en Casa</title>

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
            padding: 4rem 1.5rem;
            background-color: var(--bg-lighter);
            text-align: center;
        }

        .section-nosotros h2 {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            margin-bottom: 1.2rem;
        }

        .section-nosotros p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-light);
        }

        .section-planes {
            padding: 4rem 1.5rem;
            background-color: white;
        }

        .section-planes h2 {
            font-size: 2rem;
            font-weight: 300;
            color: var(--primary);
            text-align: center;
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


        /* === ANIMACIONES === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 0.6s ease forwards;
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

            .section-nosotros h2,
            .section-planes h2 {
                font-size: 1.8rem;
            }

            .section-nosotros p {
                font-size: 0.95rem;
            }

            .plan-card {
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            .mobile-menu-panel a {
                font-size: 1.2rem;
                padding: 0.9rem;
            }

            .section-nosotros h2 {
                font-size: 1.7rem;
            }

            .section-planes h2 {
                font-size: 1.7rem;
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








    </style>
</head>
<body>

    <!-- 1. Sección Video Fullscreen -->
    <section class="fullscreen-video" id="home">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('images/videoBanner.mp4') }}" type="video/mp4">
            Tu navegador no soporta video.
        </video>
        <div class="overlay"></div>

        <!-- ✅ TEXTO CENTRADO SOBRE EL VIDEO -->
        <div class="text-center-full">
            <h1 class="main-title">
                Asistencia médica con empatía,
                que llega a cualquier rincón de Venezuela.
            </h1>
        </div>


        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logoNewTDEC.png') }}" alt="Logo Asistencia Médica">
        </div>

        <!-- Menú Desktop (solo en pantallas grandes) -->
        <nav class="menu-desktop menu-style">
            <ul>
                <li><a href="#home">Inicio</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#contacto">Contáctanos</a></li>
                <li><a href="https://integracorp.tudrgroup.com/agents" target="_blank" class="menu-agent">Portal del Agente</a></li>


            </ul>
        </nav>

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
                <li><a href="#nosotros" onclick="closeMobileMenu()"><span>Nosotros</span></a></li>
                <li><a href="#contacto" onclick="closeMobileMenu()"><span>Contáctanos</span></a></li>
                <li><a href="https://integracorp.tudrgroup.com/agents" onclick="closeMobileMenu()" class="menu-agent"><span>Portal del Agente</span></a></li>



            </ul>
        </div>

        <!-- Redes sociales -->
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>

        <!-- Indicador de scroll -->
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i><br>
        </div>

    </section>

    <!-- 2. Sección ¿Quiénes Somos? -->
    <section id="nosotros" class="section-nosotros">
        <h2>Acerca de <span class="highlight">NOSOTROS</span></h2>
        <p>
            Somos una empresa dedicada a la asistencia médica en casa, ofreciendo atención personalizada
            seguimiento continuo y planes de salud accesibles. Nuestro objetivo es brindar bienestar y tranquilidad
            a tus seres queridos sin necesidad de desplazamientos, garantizando calidad, profesionalismo y empatía.
        </p>
        <!-- Botón centrado con efecto hover -->
        <div class="mt-8">
            <a href="{{ route('about') }}" class="btn-nosotros">
                Leer más!
            </a>
        </div>
    </section>

    <!-- 3. Sección Planes de Salud -->
    <section class="section-planes">
        <h2>Nuestros <span class="highlight">PLANES DE SALUD</span></h2>

        <div class="planes-container">
            <div class="plan-card animate-fade-in">
                <h3>Inicial</h3>
                <ul>
                    <li>Atención Medica Telefonica</li>
                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Medica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                </ul>
                <a href="#contacto" class="btn-nosotros">Comprar</a>
            </div>
            <div class="plan-card animate-fade-in">
                <h3>Ideal</h3>
                <ul>
                    <li>Atención Medica Telefonica</li>
                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Medica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                    <li><span class="highlightText">Traslado en Ambulancia urbano en caso de Emergencia</span></li>
                    <li><span class="highlightText">Consulta ONLINE o Presencial con Médicos Especialistas</span></li>

                </ul>
                <a href="#contacto" class="btn-nosotros">Comprar</a>
            </div>
            <div class="plan-card animate-fade-in">
                <h3>Especial</h3>
                <ul>
                    <li>Atención Medica Telefonica</li>
                    <li>Entrega de Tratamiento Médico a Domicilio</li>
                    <li>Monitoreo Telefónico Evolutivo</li>
                    <li>Atención Medica Domiciliaria con Tratamiento de Unidosis Incluida</li>
                    <li>Laboratorios a Domicilio con fines Diagnósticos</li>
                    <li>Imagenología a Domicilio con fines Diagnósticos</li>
                    <li>Seguimiento e Interpretación de Resultados</li>
                    <li>Traslado en Ambulancia urbano en caso de Emergencia</li>
                    <li>Consulta ONLINE o Presencial con Médicos Especialistas</li>
                    <li><span class="highlightText">Urgencias Menores en Domicilio o en sitio</span></li>
                    <li><span class="highlightText">Asistencia Médica por emergencia. (Patologías Listadas)</span></li>
                </ul>
                <a href="#contacto" class="btn-nosotros mt-full">Comprar</a>
            </div>
        </div>
    </section>

    <!-- 4. Footer -->
    <footer class="footer" id="contacto">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Asistencia Médica en Casa. Todos los derechos reservados.</p>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
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
            const cards = document.querySelectorAll('.animate-fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = "translateY(0)";
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = "translateY(10px)";
                observer.observe(card);
            });
        });

    </script>

</body>
</html>

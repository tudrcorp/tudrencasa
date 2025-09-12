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
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
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
            font-size: 2.2rem;
            font-weight: 300;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .section-nosotros p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--text-light);
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
            font-weight: 400;
            margin-bottom: 1rem;
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

        .beneficio-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .beneficio-icon {
            color: var(--primary);
            font-size: 1.8rem;
            min-width: 50px;
            text-align: center;
            margin-top: 0.3rem;
        }

        .beneficio-text h4 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .beneficio-text p {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* === 5. SECCIÓN ALIADOS === */
        .section-aliados {
            padding: 4rem 1.5rem;
            background-color: var(--bg-lighter);
            text-align: center;
        }

        .section-aliados h3 {
            font-size: 1.8rem;
            font-weight: 300;
            color: var(--primary);
            margin-bottom: 2rem;
        }

        .logos-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-item img {
            height: 60px;
            width: auto;
            opacity: 0.8;
            transition: var(--transition);
        }

        .logo-item img:hover {
            opacity: 1;
            transform: scale(1.08);
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

            .beneficio-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .cta-content h3 {
                font-size: 1.8rem;
            }

            .logos-container {
                gap: 1.5rem;
            }

            .logo-item img {
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .menu a {
                font-size: 0.85rem;
            }

            .section-nosotros h2 {
                font-size: 1.9rem;
            }

            .section-nosotros p,
            .beneficio-text p {
                font-size: 0.95rem;
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
                <li><a href="/nosotros">Nosotros</a></li>
                <li><a href="/nosotros#contacto">Contáctanos</a></li>
            </ul>
        </nav>

        <!-- Redes sociales en esquina inferior izquierda -->
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>

        <!-- Indicador de scroll -->
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i><br>
            <small>Leer mas!</small>
        </div>
    </section>

    <!-- 2. Sección ¿Quiénes Somos? -->
    <section class="section-nosotros">
        <h2>¿Quiénes Somos?</h2>
        <p>
            Somos una empresa dedicada a la asistencia médica en casa, ofreciendo atención personalizada,
            seguimiento continuo y planes de salud accesibles. Nuestro objetivo es brindar bienestar y tranquilidad
            a tus seres queridos sin necesidad de desplazamientos, garantizando calidad, profesionalismo y empatía.
            Con más de 10 años de experiencia, hemos transformado la forma en que miles de familias reciben cuidados médicos.
        </p>
    </section>

    <!-- 3. Call to Action con Parallax -->
    <section class="cta-parallax">
        <div class="cta-overlay"></div>
        <div class="cta-content">
            <h3>¿Necesitas atención médica en casa?</h3>
            <p>Contáctanos hoy y descubre cómo podemos ayudarte con un plan personalizado.</p>
            <a href="/nosotros#contacto">Habla con un experto</a>
        </div>
    </section>

    <!-- 4. Sección Beneficios -->
    <section class="section-beneficios">
        @foreach([
        ['Atención Inmediata', 'Servicio 24/7 con médicos y enfermeros disponibles en minutos.'],
        ['Sin Desplazamientos', 'Evita traslados innecesarios, especialmente para adultos mayores.'],
        ['Planes Personalizados', 'Adaptamos el servicio a tus necesidades médicas y presupuesto.'],
        ['Seguimiento Continuo', 'Monitoreo constante y reportes mensuales para familiares.']
        ] as $index => $item)
        <div class="beneficio-item" style="opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; animation-delay: {{ $index * 0.2 }}s; animation: none;">
            <div class="beneficio-icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="beneficio-text">
                <h4>{{ $item[0] }}</h4>
                <p>{{ $item[1] }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <!-- 5. Sección Aliados -->
    <section class="section-aliados">
        <h3>Nuestros Aliados Estratégicos</h3>
        <div class="logos-container">
            @for($i = 1; $i <= 7; $i++) <div class="logo-item">
                <img src="https://via.placeholder.com/160x60?text=Aliado{{ $i }}" alt="Aliado {{ $i }}">
        </div>
        @endfor
        </div>
    </section>

    <!-- 6. Footer -->
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

    <!-- Script para animaciones al hacer scroll -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll('.beneficio-item');
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

            items.forEach(item => {
                setTimeout(() => {
                    observer.observe(item);
                }, 100); // Retraso mínimo para asegurar carga
            });
        });

    </script>

</body>
</html>

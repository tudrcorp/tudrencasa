<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>En Construcción</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #121212; /* Fondo claro suave */
        color: #e0e0e0;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        overflow: hidden; /* Evita scroll innecesario */
        }

        .construction-page {
        text-align: center;
        max-width: 100%;
        padding: 2rem;
        }

        .logo {
            width: 300px; /* Ajusta según tu logo */
            height: auto;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            filter: grayscale(100%); /* Opcional: da un toque “en construcción” */
        }


        .message {
            font-size: 1.4rem;
            font-weight: 100;
            line-height: 1.6;
            color: #e0e0e0; /* Gris claro sobre fondo oscuro */
            text-align: center;
            margin-bottom: 1.8rem;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            letter-spacing: -0.2px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Ajustes para móviles */
        @media (max-width: 480px) {
        .logo {
            width: 200px;

        }

        .message {
            font-size: 1.2rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        }

        /* Para pantallas pequeñas muy reducidas (ej. iPhone SE) */
        @media (max-width: 320px) {
            .logo {
                width: 200px;
            }

            .message {
                font-size: 1.2rem;
                line-height: 1.7;
                margin-bottom: 1.5rem;
            }


        }

        .btn-home {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.7rem 1.5rem;
        font-size: 1rem;
        font-weight: 500;
        color: #f0f0f0; /* Texto claro, casi blanco */
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.15); /* Borde sutil de luz */
        border-radius: 20px; /* Bordes redondeados suaves */
        background-color: transparent;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); /* Sombra interna para profundidad */
        cursor: pointer;
        font-family: inherit;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); /* Pequeño contraste en texto */
        }

        .btn-home:hover {
        background-color: rgba(255, 255, 255, 0.04); /* Ligero efecto de hover sutil */
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-home:active {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }


        /* Ajustes móviles */
        @media (max-width: 480px) {
        .btn-home {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
        margin-top: 1.5rem;
        }
        }

        @media (max-width: 320px) {
        .btn-home {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        }
        }


        footer {
        flex-shrink: 0;
        padding: 1.5rem 1rem;
        background-color: var(--primary);
        color: white;
        text-align: center;
        font-size: 0.85rem;
        }



    </style>
</head>
<body class="min-h-screen flex flex-col">
    <div class="construction-page">
        <img src="{{ asset('images/logoNewTDEC.png') }}" alt="Logo" class="logo" />
        <p class="message">Esta sección está en desarrollo para ofrecerte una experiencia aún más intuitiva y poderosa.<br>Próximamente disponible.</p>
        <a href="{{ route('home') }}" class="btn-home">Regrasar al Inicio!</a>
    </div>
</body>
</html>

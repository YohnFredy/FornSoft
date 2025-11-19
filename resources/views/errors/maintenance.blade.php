<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evolucionando nuestros servicios | [Nombre de tu Empresa]</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #f7f8fc;
            --card-bg-color: #ffffff;
            --primary-color: #4f46e5; /* Un morado/indigo moderno y elegante */
            --text-heading-color: #111827;
            --text-body-color: #374151;
            --text-light-color: #6b7280;
            --shadow-color: rgba(79, 70, 229, 0.1);
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-body-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
            box-sizing: border-box;
        }

        .card {
            background-color: var(--card-bg-color);
            border-radius: 16px;
            box-shadow: 0 20px 40px var(--shadow-color);
            text-align: center;
            padding: 3rem;
            max-width: 550px;
            width: 100%;
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-wrapper {
            margin-bottom: 2rem;
            animation: pulse 2.5s ease-in-out infinite;
        }

        .icon-wrapper svg {
            width: 50px;
            height: 50px;
            color: var(--primary-color);
        }

        .title {
            color: var(--text-heading-color);
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.75rem 0;
        }

        .subtitle {
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0 0 2rem 0;
            max-width: 400px;
        }

        .progress-bar-container {
            width: 100%;
            height: 8px;
            background-color: var(--border-color);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 2.5rem;
        }

        .progress-bar {
            width: 100%;
            height: 100%;
            background-color: var(--primary-color);
            border-radius: 4px;
            transform: translateX(-100%);
            animation: progress-animation 4s ease-out infinite;
        }
        
        .contact-link {
            font-size: 0.95rem;
            color: var(--text-light-color);
        }
        
        .contact-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .contact-link a:hover {
            opacity: 0.8;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes progress-animation {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0%);
            }
        }
        
        /* Ajustes para móviles */
        @media (max-width: 600px) {
            .card {
                padding: 2rem 1.5rem;
            }
            .title {
                font-size: 1.5rem;
            }
            .subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        
        <div class="icon-wrapper">
            <!-- Icono SVG elegante de "construcción" -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12L12 14.098 7.5 12" />
            </svg>
        </div>

        <h1 class="title">Una plataforma en constante evolución.</h1>
        
        <p class="subtitle">
            Estamos desplegando una actualización importante para mejorar la funcionalidad y seguridad de nuestros servicios. El sistema volverá a estar operativo en 10 minutos.
        </p>

        <div class="progress-bar-container">
            <div class="progress-bar"></div>
        </div>

        <p class="contact-link">
            Agradecemos tu comprensión.
        </p>

    </div>

</body>
</html>
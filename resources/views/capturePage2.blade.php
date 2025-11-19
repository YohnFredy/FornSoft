<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- class="dark" --}}>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'FORNUVI: La nueva era de generación de ingresos' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance

    <style>
        /* Estilo para el campo Honeypot - debe estar oculto visualmente */
        .honeypot-field {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            height: 0;
            width: 0;
            z-index: -1;
        }

        /* Estilo inicial para el botón de WhatsApp (oculto o semitransparente) */
        #whatsapp-button {
            /* opacity: 0.5; */
            /* transition: opacity 0.5s ease-in-out; */
            display: none;
            /* Lo mostraremos con JS */
            transform: translateY(20px);
            /* Efecto sutil de aparición */
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        #whatsapp-button.visible {
            /* opacity: 1; */
            display: inline-flex;
            /* O block, según tu diseño */
            transform: translateY(0);
        }

        /* Estilo para mensaje de error del video */
        .video-error-message {
            padding: 1rem;
            background-color: #fee2e2;
            color: #b91c1c;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            text-align: center;
            display: none;
        }
    </style>

</head>

<body class="min-h-screen bg-neutral-100 dark:bg-neutral-100 text-ink">
    <div class="py-8 md:py-10 mx-auto max-w-4xl">

        <header class="">
            <div class="flex justify-center">
                <x-app-logo-icon class=" fill-current" />
            </div>
            <div
                class="text-2xl sm:text-2xl md:text-4xl lg:text-5xl font-bold leading-tight text-center mt-4 md:mt-8 mx-4">
                <span class="text-primary">Transforma</span> Tus Gastos Diarios en <span class="text-primary">Ingresos
                    Reales</span>
            </div>

            <div class="w-16 md:w-24 h-1 bg-premium mx-auto my-4 rounded-full"></div>
            <p class="text-base sm:text-lg md:text-xl max-w-2xl mx-auto leading-relaxed px-6 text-center">
                Bienvenido a la nueva era de generación de ingresos. Descubre el modelo innovador de FORNUVI que
                convierte tus compras esenciales en una poderosa oportunidad financiera.
            </p>
        </header>

        <main class="mt-4 md:mt-8 ">
            <!-- Video principal optimizado para móviles -->
            <div class="flex justify-center mb-8 overflow-hidden rounded-2xl">
                <iframe class="rounded-2xl" width="360" height="640"
                    src="https://www.youtube.com/embed/tvoOPHY7Shk?si=LW_QaDt4ADJPy8X2" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
            <!-- Botón de WhatsApp -->
            <div class="text-center my-4 md:my-8 px-4">
                <a {{-- id="whatsapp-button" --}}
                    href="https://wa.me/573185995909?text=Hola%20%F0%9F%91%8B%20Me%20interesa%20conocer%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Fornuvi."
                    target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 bg-green-600 hover:bg-green-500 text-white font-bold text-base md:text-lg rounded-2xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 w-full sm:w-auto">
                    <i class="fab fa-whatsapp text-3xl mr-2"></i>
                    <span class="whitespace-normal">¡Quiero Más Información por WhatsApp!</span>
                </a>
            </div>

            {{-- Campo Honeypot para Spam --}}
            <div aria-hidden="true" class="honeypot-field">
                <label for="hp_field">No llenar este campo</label>
                <input type="text" id="hp_field" name="hp_field" tabindex="-1" autocomplete="off">
            </div>

            <!-- Cómo Funciona -->
            <section class=" mt-10 md:mt-16 px-2 md:px-4">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-6 md:mb-10 text-primary">Cómo
                    Funciona FORNUVI
                </h2>

                <!-- Llamado a la acción -->
                <section class=" mt-8 md:mt-12 px-2 md:px-4">
                    <div
                        class="text-center bg-gradient-to-br from-secondary to-ink text-white p-5 md:p-10 rounded-2xl shadow-2xl">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 md:mb-6">¿Listo para Transformar tu
                            Economía?</h2>
                        <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 max-w-2xl mx-auto">Deja de ser un
                            consumidor
                            pasivo. Conviértete en protagonista
                            de un sistema inteligente que trabaja para ti y tu futuro financiero.</p>

                        <a href="https://wa.me/573185995909?text=%C2%A1Hola!%20Ya%20vi%20toda%20la%20informaci%C3%B3n%20y%20quiero%20registrarme%20%E2%9C%85%20Por%20favor%2C%20env%C3%ADame%20el%20enlace%20de%20registro."
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 bg-green-600 hover:bg-green-500 text-white font-bold text-base md:text-lg rounded-2xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 w-full sm:w-auto">
                            <i class="fab fa-whatsapp text-3xl mr-2"></i>
                            <span class="whitespace-normal">Envíame el enlace de registro</span>
                        </a>
                        <p class="mt-4 md:mt-6 text-blue-100 text-sm md:text-base">Sin riesgos. Sin inversión. Sin
                            compromisos.
                        </p>
                    </div>
                </section>


        </main>

        <footer class="text-center mt-8 border-t border-gray-800 mx-4">
            {{--  <div class="mt-4 md:mt-8">
                <img src="{{ asset('storage/images/logo_fornuvi.png') }}" alt="FORNUVI Logo"
                    class="h-8 md:h-10 mx-auto">
            </div> --}}

            <p class="text-gray-500 text-sm md:text-base mt-4">&copy; {{ date('Y') }} FORNUVI. Todos los derechos
                reservados.</p>

            {{--  <div class="flex justify-center space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700 transition">Términos y Condiciones</a>
                <a href="#" class="text-blue-500 hover:text-blue-700 transition">Política de Privacidad</a>
                <a href="#" class="text-blue-500 hover:text-blue-700 transition">Contacto</a>
            </div> --}}
        </footer>
    </div>

    {{-- Pasamos el ID de la visita y la URL de tracking al JavaScript --}}
    <script>
        window.fornuviTracking = {
            visitId: {{ $visitId ?? 'null' }},
            trackUrl: '{{ route('landing.track') }}',
            csrfToken: '{{ csrf_token() }}'
        };

        document.addEventListener('DOMContentLoaded', function() {
            const videoElement = document.getElementById('fornuvi-video');
            const videoError = document.getElementById('video-error');
            const videoErrorMessageText = videoError ? videoError.querySelector('p:first-child') : null;

            if (videoElement && videoError && videoErrorMessageText) {
                videoElement.setAttribute('playsinline', '');
                videoElement.setAttribute('webkit-playsinline', '');
                videoElement.setAttribute('x5-playsinline', '');
                videoElement.setAttribute('x5-video-player-type', 'h5');

                // Estado inicial: no autoplay
                videoElement.autoplay = false;
                videoElement.muted = false;
                videoElement.volume = 1.0;

                // Mostrar un aviso "Haz clic para reproducir"
                const videoContainer = videoElement.parentElement;
                let playMsgElement = null;

                if (videoContainer) {
                    playMsgElement = document.createElement('div');
                    playMsgElement.className =
                        'absolute top-0 left-0 right-0 p-2 bg-black/60 text-white text-sm text-center shadow-md z-10 sm:rounded-t-lg';
                    playMsgElement.innerHTML = 'Haz clic en el video para reproducir con sonido';
                    videoContainer.appendChild(playMsgElement);
                }

                // Evento de reproducción manual
                const startVideoWithSound = () => {
                    videoElement.muted = false;
                    videoElement.volume = 1.0;
                    videoElement.play().then(() => {
                        console.log("Video iniciado con sonido.");
                        if (playMsgElement) playMsgElement.style.display = 'none';
                    }).catch(err => {
                        console.warn("No se pudo reproducir el video:", err);
                    });
                };

                videoElement.addEventListener('click', startVideoWithSound);
                videoElement.addEventListener('touchstart', startVideoWithSound, {
                    passive: true
                });

                // Manejo de errores
                videoElement.addEventListener('error', function(e) {
                    console.error('Error de video:', e);
                    let errorText = 'Lo sentimos, hubo un problema al cargar el video.';
                    if (videoElement.error) {
                        switch (videoElement.error.code) {
                            case videoElement.error.MEDIA_ERR_ABORTED:
                                errorText = 'La reproducción del video fue abortada.';
                                break;
                            case videoElement.error.MEDIA_ERR_NETWORK:
                                errorText = 'Hubo un problema de red al cargar el video.';
                                break;
                            case videoElement.error.MEDIA_ERR_DECODE:
                                errorText =
                                    'El video no pudo ser decodificado o el formato no es compatible.';
                                break;
                            case videoElement.error.MEDIA_ERR_SRC_NOT_SUPPORTED:
                                errorText = 'El formato del video no es compatible.';
                                break;
                            default:
                                errorText = 'Ocurrió un error desconocido al cargar el video.';
                        }
                    }
                    videoErrorMessageText.textContent = errorText;
                    videoError.style.display = 'block';
                    videoElement.style.display = 'none';
                });
            } else {
                console.error('Faltan elementos del video en el DOM.');
            }
        });
    </script>

    {{-- El archivo app.js contendrá la lógica de seguimiento --}}

</body>

</html>

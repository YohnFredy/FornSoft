<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- class="dark" --}}>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'FORNUVI: Transforma tus Gastos en Ingresos' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    <style>
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
        }

        .card-benefit {
            background: linear-gradient(135deg, rgba(75, 99, 204, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 1px solid rgba(102, 126, 234, 0.2);
            transition: all 0.3s ease;
        }

        .card-benefit:hover {
            transform: translateY(-5px);
            border-color: #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0761b0 0%, #0982eb 100%);
            border-radius: 12px;
            color: white;
            font-size: 28px;
        }

        .counter-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body class="bg-white">
    <!-- Header/Navbar -->
    <header class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-primary via-secondary to-ink rounded-lg flex items-center justify-center">
                    <i class="fas fa-rocket text-white text-lg"></i>
                </div>
                <div class="">
                    <div
                        class="font-abril text-xl sm:text-3xl font-semibold tracking-widest pl-0.5 sm:pl-1 flex justify-center -mb-1">
                        <span class=" text-primary">FOR</span>
                        <span class=" text-secondary">NU</span>
                        <span class=" text-primary">VI</span>
                    </div>

                    <div class=" w-full h-0.5 bg-gradient-to-r from-white via-secondary to-white"></div>

                    <div class="font-kite flex justify-center mt-0.5 ">
                        <span class=" text-secondary text-[6.5px] sm:text-[9.5px]">FORTALECIENDO NUESTRA VIDA</span>
                    </div>
                </div>
            </div>
            {{--  <span class="text-sm text-ink font-medium">Fortaleciendo Nuestra Vida</span> --}}
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-24 pb-8 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-5xl font-bold leading-tight text-center">
                            <span
                                class="bg-gradient-to-r from-primary via-danger to-secondary bg-clip-text text-transparent">Bienvenido
                                a una Nueva Era</span>
                            <span class="block text-ink">de Generación de Ingresos</span>
                        </h1>
                        <p class="text-xl text-ink leading-relaxed text-center">
                            Descubre cómo tus compras cotidianas pueden convertirse en una poderosa herramienta para
                            generar ingresos <span class="font-semibold text-primary">sin límites de profundidad</span>.
                        </p>
                    </div>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gradient-to-br from-secondary/5 to-primary/5 p-4 rounded-xl border border-danger/10">
                            <div class="text-3xl font-bold text-primary">100%</div>
                            <p class="text-sm text-ink mt-1">Gratuito</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-premium/5 to-primary/5 p-4 rounded-xl border border-pink-100">
                            <div class="text-3xl font-bold text-premium">∞</div>
                            <p class="text-sm text-ink mt-1">Ingresos Ilimitados</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="space-y-4 pt-4">
                        <button onclick="document.getElementById('video-section').scrollIntoView({behavior: 'smooth'})"
                            class="bg-primary w-full py-4 px-8 rounded-xl text-white font-bold text-lg">
                            <i class="fas fa-play mr-3"></i>Ver Video Completo
                        </button>
                        <p class="text-center text-ink text-sm">
                            ⏱️ Duración: 7 minutos • La información que cambiará tu vida
                        </p>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="relative h-40 hidden lg:flex items-center justify-center">
                    <div class="absolute inset-0 gradient-primary opacity-10 rounded-3xl blur-3xl"></div>
                    <div class="relative z-10 text-center space-y-6">
                        <div class="floating">
                            <i class="fas fa-chart-line text-6xl text-primary"></i>
                        </div>
                        <div class="space-y-2">
                            <p class="text-2xl font-bold text-ink">Crecimiento Automático</p>
                            <p class="text-ink">Tu red crece automáticamente</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section id="video-section" class="py-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white via-secondary/5 to-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center px-2 mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-ink mb-4">
                    Mira Cómo Funciona Fornuvi
                </h2>
                <p class="text-xl text-ink">
                    Descubre la revolución económica que está transformando la vida de miles de personas
                </p>
            </div>

            <!-- Video Player -->
            <div class="video-container mb-8">
                <iframe
                    src="https://www.youtube.com/embed/n9zdZX7nTs8?si=uDnCFzPic1HQaPqD?autoplay=0&modestbranding=1&rel=0"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>

            <!-- Video Benefits -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-secondary/5 border-b-2 border-primary p-6 rounded-xl">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-2">Gana con Cada Compra</h3>
                    <p class="text-ink">Convierte tus gastos cotidianos en ingresos reales</p>
                </div>

                <div class="bg-secondary/5 border-b-2 border-primary p-6 rounded-xl">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-2">Sistema Automático</h3>
                    <p class="text-ink">Tu red crece de forma automatica gracias a las redes sociales</p>
                </div>

                <div class="bg-secondary/5 border-b-2 border-primary p-6 rounded-xl">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-2">Sin Fronteras</h3>
                    <p class="text-ink">Expande tu negocio globalmente sin límites</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works - Automatic Growth Explanation -->
    {{--   <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-ink mb-4">
                    Tu Red Crece de Forma Inteligente
                </h2>
                <p class="text-xl text-ink max-w-3xl mx-auto">
                    No necesitas invitar a nadie. Fornuvi tiene un sistema inteligente que trae personas directamente a
                    tu red
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-12">
                <div class="space-y-6">
                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl gradient-primary">
                                <span class="text-white font-bold text-xl">1</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-ink mb-2">Te Unes al Equipo</h3>
                            <p class="text-ink">Simplemente te registras gratis y formas parte de Fornuvi</p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl gradient-secondary">
                                <span class="text-white font-bold text-xl">2</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-ink mb-2">La Publicidad Trabaja para Ti</h3>
                            <p class="text-ink">Fornuvi invierte en publicidad que trae clientes constantemente a la
                                plataforma</p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl gradient-primary">
                                <span class="text-white font-bold text-xl">3</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-ink mb-2">Se Integran a Tu Red</h3>
                            <p class="text-ink">El sistema automáticamente afilia a esas personas directamente bajo tu
                                estructura</p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl gradient-secondary">
                                <span class="text-white font-bold text-xl">4</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-ink mb-2">Comienzas a Generar Ingresos</h3>
                            <p class="text-ink">Cada compra que realizan genera comisiones que se distribuyen según tu
                                crecimiento</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="bg-gradient-to-br from-danger/10 to-pink-100 rounded-2xl p-8 border border-purple-200">
                        <div class="space-y-8">
                            <div class="text-center">
                                <div class="inline-block bg-white rounded-full p-6 mb-4">
                                    <i class="fas fa-user-tie text-4xl text-primary"></i>
                                </div>
                                <p class="font-bold text-ink">Tú (Afiliado)</p>
                                <p class="text-sm text-ink mt-1">Tu código único activo</p>
                            </div>

                            <div class="text-center relative">
                                <div
                                    class="absolute left-1/2 transform -translate-x-1/2 -top-4 -bottom-4 w-1 bg-gradient-to-b from-purple-400 to-pink-400">
                                </div>
                                <i class="fas fa-arrow-down text-2xl text-primary"></i>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-xl p-4 text-center border border-purple-200">
                                    <i class="fas fa-users text-2xl text-primary mb-2"></i>
                                    <p class="font-bold text-ink">Tu Red</p>
                                    <p class="text-xs text-ink mt-1">Crece automáticamente</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 text-center border border-pink-200">
                                    <i class="fas fa-shopping-cart text-2xl text-danger mb-2"></i>
                                    <p class="font-bold text-ink">Compras</p>
                                    <p class="text-xs text-ink mt-1">Generan comisiones</p>
                                </div>
                            </div>

                            <div class="text-center relative">
                                <div
                                    class="absolute left-1/2 transform -translate-x-1/2 -top-4 -bottom-4 w-1 bg-gradient-to-b from-pink-400 to-purple-400">
                                </div>
                                <i class="fas fa-arrow-down text-2xl text-danger"></i>
                            </div>

                            <div class="bg-white rounded-xl p-4 text-center border border-purple-200">
                                <i class="fas fa-coins text-2xl text-primary mb-2"></i>
                                <p class="font-bold text-ink">Tus Ingresos</p>
                                <p class="text-xs text-ink mt-1">Crecen sin que hagas nada</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Key Features -->
    {{--  <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-ink text-center mb-16">
                Lo Que Hace Diferente a Fornuvi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">100% Gratuito</h3>
                    <p class="text-ink">Sin inversión, sin costo oculto. Solo registrate y comienza a ganar</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">Sin Ventas Requeridas</h3>
                    <p class="text-ink">No necesitas vender nada. Solo compra lo que normalmente compras</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">Sin Límite de Profundidad</h3>
                    <p class="text-ink">Gana de infinitos niveles abajo. Tu red puede crecer infinitamente</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">Bono Socio Estratégico</h3>
                    <p class="text-ink">Gana del 2% al 4% adicional al traer comercios a la plataforma</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">Expansión Global</h3>
                    <p class="text-ink">Tu código de afiliado funciona en cualquier país donde esté Fornuvi</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-circle-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-3">100% Solidario</h3>
                    <p class="text-ink">Crece una comunidad donde todos ganan al crecer juntos</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- The Opportunity Section -->
    {{-- <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-gradient-to-r from-primary to-danger rounded-3xl p-12 md:p-16 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                            ¿Por Qué Ahora es el Momento?
                        </h2>
                        <p class="text-lg opacity-90 leading-relaxed">
                            Fornuvi hace poco llegó al país. Esto significa que todavía estamos en la fase inicial,
                            donde los primeros afiliados tienen el mayor potencial de crecimiento.
                        </p>
                        <p class="text-lg opacity-90 leading-relaxed">
                            Mientras más tiempo esperes, más personas se habrán posicionado por ti. El momento ideal
                            para comenzar es <span class="font-bold">AHORA</span>.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-yellow-300"></i>
                                <span>Posiciónate como pionero en tu red</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-yellow-300"></i>
                                <span>Aprovecha el crecimiento exponencial inicial</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-yellow-300"></i>
                                <span>Construye el legado de ingresos para tu familia</span>
                            </li>
                        </ul>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
                            <div class="space-y-6">
                                <div>
                                    <div class="text-5xl font-bold text-yellow-300 mb-2">0%</div>
                                    <p class="text-white/90">Inversión requerida</p>
                                </div>

                                <div class="w-full h-1 bg-white/20 rounded-full"></div>

                                <div>
                                    <div class="text-5xl font-bold text-yellow-300 mb-2">∞</div>
                                    <p class="text-white/90">Potencial de ingresos</p>
                                </div>

                                <div class="w-full h-1 bg-white/20 rounded-full"></div>

                                <div>
                                    <div class="text-5xl font-bold text-yellow-300 mb-2">1</div>
                                    <p class="text-white/90">Paso para comenzar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA Final Section -->
    <section class="py-10 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-secondary/5">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <div class="space-y-4">
                <h2 class="text-4xl md:text-5xl font-bold text-ink">
                    Es Tu Momento
                </h2>
                <p class="text-xl text-ink">
                    Comienza a construir tu propio camino hoy
                </p>
            </div>

            <div class="space-y-4">

                <a
                    href="https://wa.me/+573185995909?text=Hola%2C%20vi%20el%20video%20de%20FORNUVI%20y%20quiero%20m%C3%A1s%20informaci%C3%B3n.">


                    <button class=" bg-primary py-2 px-4 text-center rounded-2xl text-xl text-white hover:bg-secondary">
                        <i class="fas fa-whatsapp mr-3"></i>Contáctanos por WhatsApp</button>

                </a>

                <p class="text-ink  pt-4">
                    Nuestro equipo resolverá todas tus dudas y te guiará paso a paso
                </p>

                {{--  <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <button
                        class="px-8 py-3 border-2 border-primary text-primary font-bold rounded-xl hover:bg-secondary/5 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </button>
                    <button
                        class="px-8 py-3 border-2 border-primary text-primary font-bold rounded-xl hover:bg-secondary/5 transition-colors">
                        <i class="fas fa-phone mr-2"></i>Llamada
                    </button>
                </div> --}}
            </div>

            <div class="bg-secondary/5 border-l-4 border-primary p-6 rounded-lg mt-12">
                <p class="text-gray-700 italic">
                    "Fornuvi no es solo una plataforma, es una comunidad donde juntos estamos fortaleciendo vidas y
                    creando un futuro mejor para todos."
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    {{--  <footer class="bg-ink text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                            <i class="fas fa-rocket text-white"></i>
                        </div>
                        <span class="font-bold text-xl">Fornuvi</span>
                    </div>
                    <p class="text-gray-400">Fortaleciendo Nuestra Vida</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Rápidos Enlaces</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Inicio</a></li>
                        <li><a href="#video-section" class="hover:text-white transition">Ver Video</a></li>
                        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Síguenos</h4>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Fornuvi. Todos los derechos reservados. | Fortaleciendo Nuestra Vida</p>
            </div>
        </div>
    </footer> --}}

    <script>
        // Smooth scroll behavior already handled by Tailwind
        // Add any additional interactivity here

        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to elements
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            // Observe all cards and sections
            document.querySelectorAll('.card-benefit, .bg-white').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // Counter animation
            const animateCounter = (element, target, duration = 2000) => {
                let current = 0;
                const increment = target / (duration / 50);
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 50);
            };
        });
    </script>

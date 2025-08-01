<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'fornuvi' }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

@stack('css')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@stack('js')

<!-- Script de Alpine para el control del árbol -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('treeZoom', () => ({
            currentZoom: 1.0,
            zoomStep: 0.1,
            minZoom: 0.2,
            initialHeight: 0,
            containerHeight: 'auto', // Empezar con 'auto' y luego ajustar
            isLoaded: false,

            get showZoomInButton() {
                return this.currentZoom < 1.0;
            },

            init() {
                // PRIMERA CARGA: Esperamos a que la ventana completa se cargue (incluyendo imágenes, CSS, etc.)
                // Esto es mucho más fiable que 'DOMContentLoaded' o '$nextTick' para el renderizado inicial.
                window.addEventListener('load', () => {
                    this.calculateHeight();
                });

                // FALLBACK: Si por alguna razón el evento 'load' no funciona,
                // intentamos calcular después de un tiempo prudencial.
                setTimeout(() => {
                    if (!this.isLoaded) {
                        this.calculateHeight();
                    }
                }, 500); // 500ms es un buen equilibrio.
            },

            // Función única y central para calcular la altura.
            calculateHeight() {
                const treeContent = this.$refs.treeContainer;
                if (!treeContent) return;

                // Forzamos el recálculo del layout del navegador pidiendo una propiedad.
                // Es un pequeño truco para obtener la altura más actualizada.
                treeContent.getBoundingClientRect();

                const height = treeContent.scrollHeight;

                if (height > 50) { // Si la altura es válida...
                    this.initialHeight = height;
                    this.containerHeight = height;
                    this.isLoaded = true;
                } else {
                    // Si falla, en lugar de reintentar, simplemente dejamos la altura en 'auto'.
                    // El contenedor se expandirá naturalmente, lo cual es mejor que quedarse fijo en 0.
                    this.isLoaded = true;
                    this.containerHeight = 'auto';
                }
            },

            // Función llamada por el evento de Livewire '@recalculate-tree-height.window'
            recalculate() {
                this.isLoaded = false;
                this.currentZoom = 1.0;

                // Para actualizaciones de Livewire, $nextTick es perfecto porque se ejecuta
                // justo después de que Livewire actualiza el DOM.
                this.$nextTick(() => {
                    this.calculateHeight();
                });
            },

            decreaseZoom() {
                if (this.currentZoom > this.minZoom) {
                    this.currentZoom = parseFloat((this.currentZoom - this.zoomStep).toFixed(1));
                    this.updateContainerHeight();
                }
            },

            increaseZoom() {
                if (this.currentZoom < 1.0) {
                    this.currentZoom = parseFloat((this.currentZoom + this.zoomStep).toFixed(1));
                    this.updateContainerHeight();
                }
            },

            resetZoom() {
                this.currentZoom = 1.0;
                this.updateContainerHeight();
            },

            updateContainerHeight() {
                if (this.initialHeight > 0) {
                    const scaledHeight = this.initialHeight * this.currentZoom;
                    this.containerHeight = scaledHeight;
                }
            }
        }));
    });
</script>


@fluxAppearance

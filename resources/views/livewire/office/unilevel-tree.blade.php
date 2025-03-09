@push('css')
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">
            <i class="fas fa-home mr-1"></i> Home
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{route('binary-tree')}}">
            <i class="fas fa-network-wired mr-1"></i> Binario
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            <i class="fas fa-sitemap mr-1"></i> Unilevel
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center mb-2 mt-2 sm:mt-4">
        <h1 class="font-bold text-xl md:text-2xl text-primary mt-4 flex items-center">
            <i class="fas fa-diagram-project mr-2"></i> Red unilevel
        </h1>
    </div>

    <!-- Leyenda de árbol -->
    <div class="bg-white p-4 rounded-lg mb-4 shadow-md shadow-ink border border-zinc-200">
        <div class="flex flex-wrap items-center gap-4">
            <span class="font-semibold text-primary"><i class="fas fa-info-circle bg-white mr-1"></i>
                Leyenda:</span>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-neutral-300 mr-2"></div>
                <span>Usuario Activo</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-premium mr-2"></div>
                <span>Pendiente de Activación</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-danger mr-2"></div>
                <span>Inactivo</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-primary mr-2"></div>
                <span>Tú</span>
            </div>
        </div>
    </div>

    <!-- Filtros y búsqueda rápida -->
    <div class="bg-white p-3 sm:p-4 rounded-lg mb-4 shadow-md shadow-ink border border-zinc-300">

        <div class=" grid grid-cols-6 gap-2 sm:gap-4">
            <div class=" col-span-6 sm:col-span-4 relative">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar usuario en el árbol..."
                    class="w-full pl-10 pr-4 py-2 text-sm sm:text-base border rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-primary"></i>
            </div>

            <div class="col-span-3 sm:col-span-1">
                <select
                    class=" w-full text-xs sm:text-sm px-2 sm:px-3 py-1.5 sm:py-2 border rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary bg-white transition-colors">
                    <option value="">Niveles</option>
                    <option value="1" disabled>Nivel 1</option>
                    <option value="2" disabled>Nivel 2</option>
                    <option value="3" disabled>Nivel 3</option>
                </select>
            </div>
            <div class="col-span-3 sm:col-span-1">
                <select
                    class=" w-full text-xs sm:text-sm px-2 sm:px-3 py-1.5 sm:py-2 border rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary bg-white transition-colors">
                    <option value="">Estados</option>
                    <option value="active" disabled>Activos</option>
                    <option value="pending" disabled>Pendientes</option>
                    <option value="inactive" disabled>Inactivos</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Contenedor principal del árbol con navegación -->
    <div class="sm:shadow-md shadow-ink rounded-lg py-2">
        <!-- Control de navegación -->
        <div class="flex justify-between px-4">
            <div class="flex items-center space-x-2">
                <button id="zoom-out-btn"
                    class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring focus:ring-primary/30">
                    <i class="fas fa-minus"></i>
                </button>
                <button id="zoom-in-btn"
                    class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring focus:ring-primary/30">
                    <i class="fas fa-plus"></i>
                </button>
                <button id="zoom-reset-btn"
                    class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring focus:ring-primary/30">
                    <i class="fas fa-expand"></i>
                </button>
                <span class="text-ink text-sm" id="zoom-level-text">Zoom: 100%</span>
            </div>
        </div>

        <!-- Árbol binario -->
        <div class="flex justify-center ">
            <div class="caja ">
                <div id="tree-container" class="tree">
                    <ul>
                        @include('livewire.office.children-unilevel', ['node' => $tree])
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de paneles de información -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Panel de usuario -->
        <div class="bg-white rounded-lg shadow-md shadow-ink hover:shadow-lg transition-shadow overflow-hidden">
            <div class="bg-primary bg-opacity-10 p-4 border-b flex items-center">
                <i class="fas fa-user-circle text-2xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Información del Usuario</h2>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div
                        class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl mr-4">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">{{ $currentUser->name }}</h3>
                        <div class="flex items-center">
                            <span class="px-2 py-1 bg-premium text-white text-xs rounded-full mr-2">Asociado</span>
                            <span class="text-ink text-sm">User: </span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt w-6 text-ink"></i>
                        <span class="ml-2"><strong>Fecha de Ingreso:</strong> ingreso</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-star w-6 text-ink"></i>
                        <span class="ml-2"><strong>Puntos Acumulados:</strong> total puntos</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-trophy w-6 text-ink"></i>
                        <span class="ml-2"><strong>Posición:</strong> Derecha</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-link w-6 text-ink"></i>
                        <span class="ml-2"><strong>Patrocinador:</strong> admin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas del árbol -->
        <div class="bg-white rounded-lg shadow-md shadow-ink hover:shadow-lg transition-shadow overflow-hidden">
            <div class="bg-primary bg-opacity-10 p-4 border-b flex items-center">
                <i class="fas fa-chart-line text-2xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Estadísticas del Árbol</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-blue-50 p-3 rounded-lg text-center">
                        <div class="text-secondary text-3xl font-bold">0</div>
                        <div class="text-ink text-sm">Total Usuarios</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg text-center">
                        <div class="text-green-500 text-3xl font-bold">0</div>
                        <div class="text-ink text-sm">Nivel Actual</div>
                    </div>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg mb-4">
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Izquierda</span>
                        <span class="font-medium">Derecha</span>
                    </div>
                    <div class="flex h-4 rounded-full overflow-hidden bg-gray-200 mb-1">
                        <div class="bg-primary" style="width: 10%"></div>
                        <div class="bg-secondary" style="width: 20%"></div>
                    </div>
                    <div class="flex justify-between text-sm text-ink">
                        <span>0 puntos</span>
                        <span>0 puntos</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-users w-6 text-ink"></i>
                        <span class="ml-2"><strong>Activos:</strong> 0</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user-clock w-6 text-ink"></i>
                        <span class="ml-2"><strong>Pendientes:</strong> 0</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-week w-6 text-ink"></i>
                        <span class="ml-2"><strong>Esta semana:</strong> 0 nuevos</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="bg-white rounded-lg shadow-md shadow-ink hover:shadow-lg transition-shadow overflow-hidden">
            <div class="bg-primary bg-opacity-10 p-4 border-b flex items-center">
                <i class="fas fa-bolt text-2xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Acciones Rápidas</h2>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" wire:model="searchUser" placeholder="Buscar usuario por ID o nombre..."
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring focus:ring-primary/30 focus:border-primary">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button
                        class="w-full mt-2 bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> Buscar
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <button
                        class="bg-primary/20 hover:bg-primary/10 text-primary p-3 rounded-lg flex flex-col items-center">
                        <i class="fas fa-user-plus text-2xl mb-1"></i>
                        <span class="text-sm">Añadir Usuario</span>
                    </button>
                    <button
                        class="bg-danger/20 hover:bg-danger/10 text-danger p-3 rounded-lg flex flex-col items-center">
                        <i class="fas fa-sitemap text-2xl mb-1"></i>
                        <span class="text-sm">Ver Unilevel</span>
                    </button>
                    <button
                        class="bg-premium/20 hover:bg-premium/10 text-premium p-3 rounded-lg flex flex-col items-center">
                        <i class="fas fa-chart-pie text-2xl mb-1"></i>
                        <span class="text-sm">Estadísticas</span>
                    </button>
                    <button
                        class="bg-secondary/20 hover:bg-secondary/10 text-secondary p-3 rounded-lg flex flex-col items-center">
                        <i class="fas fa-dollar-sign text-2xl mb-1"></i>
                        <span class="text-sm">Comisiones</span>
                    </button>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <h3 class="font-medium mb-2 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-1"></i> Ayuda Rápida
                    </h3>
                    <p class="text-sm text-ink mb-2">Explore su red de afiliados y rastree el progreso de su
                        equipo utilizando estas herramientas.</p>
                    <a href="#" class="text-primary text-sm hover:underline flex items-center">
                        <i class="fas fa-book mr-1"></i> Ver tutorial completo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de actividad reciente -->
    <div class="bg-white rounded-lg shadow-md shadow-ink mt-6 overflow-hidden">
        <div class="bg-primary bg-opacity-10 p-4 border-b flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-history text-2xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Actividad Reciente</h2>
            </div>
            <a href="#" class="text-primary hover:underline text-sm">Ver todo</a>
        </div>
        <div class="p-4">
            @if (false)
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Usuario</th>
                            <th class="px-4 py-2 text-left">Acción</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenido de la tabla -->
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-clock text-gray-300 text-4xl mb-3"></i>
                    <p class="text-ink">No hay actividad reciente para mostrar</p>
                </div>
            @endif
        </div>
    </div>


    <!-- Script directo para el control del árbol -->
    <script>
        // Ejecutar cuando Livewire haya cargado completamente
        document.addEventListener('livewire:load', function() {
            initTreeZoomControls();
        });

        // Ejecutar cuando el DOM esté listo (alternativa por si livewire:load no funciona)
        document.addEventListener('DOMContentLoaded', function() {
            initTreeZoomControls();
        });

        function initTreeZoomControls() {
            // Verificar si los elementos ya tienen eventos asociados
            if (window.treeZoomInitialized) return;
            window.treeZoomInitialized = true;

            // Obtener referencias a los elementos
            const treeContainer = document.getElementById('tree-container');
            const zoomInBtn = document.getElementById('zoom-in-btn');
            const zoomOutBtn = document.getElementById('zoom-out-btn');
            const zoomResetBtn = document.getElementById('zoom-reset-btn');
            const zoomLevelText = document.getElementById('zoom-level-text');

            // Verificar que todos los elementos necesarios existan
            if (!treeContainer || !zoomInBtn || !zoomOutBtn || !zoomResetBtn || !zoomLevelText) {
                console.error('Algunos elementos del árbol no se encontraron');
                return;
            }

            // Variables de control
            let currentZoom = 1.0;
            const zoomStep = 0.1;
            const maxZoom = 2.0;
            const minZoom = 0.5;

            // Función para actualizar el zoom
            function updateZoom(zoom) {
                currentZoom = zoom;
                treeContainer.style.transform = `scale(${currentZoom})`;
                zoomLevelText.textContent = `Zoom: ${Math.round(currentZoom * 100)}%`;
            }

            // Asignar eventos a los botones
            zoomInBtn.addEventListener('click', function() {
                if (currentZoom < maxZoom) {
                    updateZoom(currentZoom + zoomStep);
                }
            });

            zoomOutBtn.addEventListener('click', function() {
                if (currentZoom > minZoom) {
                    updateZoom(currentZoom - zoomStep);
                }
            });

            zoomResetBtn.addEventListener('click', function() {
                updateZoom(1.0);
            });

            // Inicializar el estado
            updateZoom(1.0);

            console.log('Controles de zoom del árbol inicializados correctamente');
        }
    </script>
</div>
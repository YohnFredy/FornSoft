<div class="container mx-auto p-4 md:p-8">

    {{-- Título de la página --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Bolsa Global de Comisiones</h1>

    {{-- Mensaje de éxito después de generar el pago --}}
    @if (session('status'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('status') }}</p>
        </div>
    @endif

    {{-- Sección de Estadísticas Principales --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h3 class="text-sm font-medium text-gray-500">Valor del Punto (VFB)</h3>
            {{-- MODIFICADO --}}
            <p class="text-3xl font-semibold text-gray-800">{{ number_format($pointValueFactor, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
            <h3 class="text-sm font-medium text-gray-500">Puntos Bolsa Global</h3>
            {{-- MODIFICADO --}}
            <p class="text-3xl font-semibold text-gray-800">{{ number_format($totalGlobalPoints, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <h3 class="text-sm font-medium text-gray-500">Puntos Calificados Totales</h3>
            {{-- MODIFICADO --}}
            <p class="text-3xl font-semibold text-gray-800">{{ number_format($totalQualifiedPoints, 2, ',', '.') }}</p>
        </div>
    </div>

    {{-- Sección de Generación de Pago --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Generar Pagos</h2>
        <div class="flex flex-wrap items-end gap-4">
            {{-- Campo de Fecha de Inicio --}}
            <div class="flex-grow">
                <label for="startDate" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input wire:model="startDate" id="startDate" type="date"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('startDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Campo de Fecha de Fin --}}
            <div class="flex-grow">
                <label for="endDate" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                <input wire:model="endDate" id="endDate" type="date"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('endDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Botón de Acción --}}
            <div>
                <button wire:click="generateCommissions"
                        wire:loading.attr="disabled"
                        wire:confirm="¿Estás seguro de que deseas generar los pagos? Esta acción no se puede revertir."
                        class="w-full md:w-auto bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-indigo-300 transition ease-in-out duration-150">
                    <span wire:loading.remove wire:target="generateCommissions">
                        Generar Pago de Bolsa Global
                    </span>
                    <span wire:loading wire:target="generateCommissions">
                        Procesando...
                    </span>
                </button>
            </div>
        </div>
    </div>

    {{-- Tabla de Usuarios Calificados --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-700">Usuarios Calificados para Comisión</h2>
            <p class="text-sm text-gray-500 mt-1">
                Mostrando {{ $qualifiedUsersPoints->count() }} usuarios con puntos en ambas piernas y pendientes de pago.
            </p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Usuario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntos Izquierda</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntos Derecha</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntos Calificados</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($qualifiedUsersPoints as $userPoints)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $userPoints->user_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $userPoints->user->username ?? 'N/A' }}</td>
                            {{-- MODIFICADO --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($userPoints->left_points, 2, ',', '.') }}</td>
                            {{-- MODIFICADO --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($userPoints->right_points, 2, ',', '.') }}</td>
                            {{-- MODIFICADO --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">{{ number_format(min($userPoints->left_points, $userPoints->right_points), 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                No hay usuarios que califiquen para el pago de comisiones en este momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
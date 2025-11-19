<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <button wire:click="create()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Nuevo
                    Control</button>

                @if ($isOpen)
                    @include('livewire.admin.create-control')
                @endif

                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-12"></th>
                            <th class="px-4 py-2">id</th>
                            <th class="px-4 py-2">Usuario</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Total Asignado</th>
                            <th class="px-4 py-2">Valor de Publicidad</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($controls as $control)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center">
                                    <button wire:click="toggleRow({{ $control->id }})">
                                        @if ($expandedRow === $control->id)
                                            &#9660; <!-- Flecha hacia abajo -->
                                        @else
                                            &#9658; <!-- Flecha hacia la derecha -->
                                        @endif
                                    </button>
                                </td>
                                <td class="border px-4 py-2">{{ $control->user->id }}</td>
                                <td class="border px-4 py-2">{{ $control->user->username }}</td>
                                <td class="border px-4 py-2">{{ $control->user->name }} {{ $control->user->last_name }}
                                </td>
                                <td class="border px-4 py-2">{{ $control->total_assigned }}</td>
                                <td class="border px-4 py-2">${{ number_format($control->ad_value, 2) }}</td>
                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $control->id }})"
                                        class="bg-primary hover:bg-secondary text-white font-bold py-1 px-2 rounded">Editar</button>
                                    {{--  <button wire:click="delete({{ $control->id }})" class="bg-danger hover:bg-danger/80 text-white font-bold py-1 px-2 rounded">Eliminar</button> --}}
                                    <button wire:click="export({{ $control->id }})"
                                        class="bg-premium hover:bg-premium/80 text-white font-bold py-1 px-2 rounded">Exportar</button>

                                    <button wire:click="sendWhatsApp({{ $control->id }})"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                        WhatsApp
                                    </button>
                                </td>
                            </tr>
                            @if ($expandedRow === $control->id)
                                <tr>
                                    <td colspan="5" class="border px-4 py-4 bg-gray-50">
                                        <h3 class="text-lg font-bold mb-2">Afiliados de {{ $control->user->name }}</h3>
                                        @if ($affiliates->count())
                                            <table class="table-auto w-full">
                                                <thead>
                                                    <tr class="bg-gray-200">
                                                        <th class="px-4 py-2">Id</th>
                                                        <th class="px-4 py-2">Usuario</th>
                                                        <th class="px-4 py-2">Nombre</th>
                                                        <th class="px-4 py-2">DNI</th>
                                                        <th class="px-4 py-2">Email</th>
                                                        <th class="px-4 py-2">Teléfono</th>
                                                        <th class="px-4 py-2">Lado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($affiliates as $affiliate)
                                                        <tr>
                                                            <td class="border px-4 py-2">{{ $affiliate->user->id }}
                                                            </td>
                                                            <td class="border px-4 py-2">
                                                                {{ $affiliate->user->username }}</td>
                                                            <td class="border px-4 py-2">{{ $affiliate->user->name }}
                                                                {{ $affiliate->user->last_name }}</td>
                                                            <td class="border px-4 py-2">{{ $affiliate->user->dni }}
                                                            </td>
                                                            <td class="border px-4 py-2">{{ $affiliate->user->email }}
                                                            </td>
                                                            <td class="border px-4 py-2">
                                                                {{ $affiliate->user->userData->phone }}</td>
                                                            <td class="border px-4 py-2">
                                                                {{ ucfirst($affiliate->side) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No hay afiliados para este usuario.</p>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="5">No hay registros para mostrar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $controls->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Escuchamos el evento 'open-whatsapp' que viene desde Livewire
        document.addEventListener('livewire:initialized', () => {
            @this.on('open-whatsapp', (event) => {
                if (event.url) { // En Livewire 3, los datos vienen directamente en el evento
                    // Abrimos la URL en una nueva pestaña
                    window.open(event.url, '_blank');
                }
            });
        });
    </script>
@endpush

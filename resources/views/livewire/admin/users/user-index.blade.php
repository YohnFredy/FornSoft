<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.index') }}">
            <i class="fas fa-home mr-1"></i> Panel
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">
            <i class="fas fa-tag"></i> Usuario
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    @if (session('success'))
        <div class="bg-white my-6">
            <div class="bg-secondary/5 border border-secondary text-primary p-4 rounded-lg relative" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    &times;
                </button>
            </div>
        </div>
    @endif

    <!-- Encabezado de la sección -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4 px-6">
        <div>
            <h1 class="text-2xl font-bold text-primary">Gestión de usuarios</h1>
            <p class="text-sm text-ink mt-1">Administra tus usuarios</p>
        </div>
    </div>

    <!-- Tarjeta principal -->
    <div class="bg-white rounded-xl shadow-md shadow-ink overflow-hidden border border-neutral-300">
        <!-- Cabecera de la tarjeta con buscador -->
        <div class="p-5 border-b border-neutral-300 bg-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    <h2 class="text-lg font-semibold text-ink">Lista de usuarios</h2>

                </div>

                <div class="">
                    @if ($this->searchTerms)
                        <flux:button wire:click="clearSearch" class=" mt-4">
                            Limpiar búsqueda
                        </flux:button>
                    @endif
                </div>

                <div class="relative">
                    <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="Buscar Usuario..." />
                </div>
            </div>
        </div>

        <!-- Tabla de usuarios mejorada -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-neutral-50">
                    <tr class="text-xs font-medium text-primary uppercase tracking-wider">
                        <th scope="col" class="px-3 py-2 text-left">Username</th>
                        <th scope="col" class="px-2 py-2 text-left">Nombre Completo</th>
                        <th scope="col" class="px-2 py-2 text-left">DNI</th>
                        <th scope="col" class="px-2 py-2 text-left">Email</th>
                        <th scope="col" class="px-2 py-2 text-left">Teléfono</th>
                        <th scope="col" class="px-2 py-2 text-left">Sponsor</th>
                        <th scope="col" class="px-2 py-2 text-left">Estado</th>
                        <th scope="col" class="px-2 py-2 text-left">Acciones</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-300">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-1">{{ $user->username }}</td>
                            <td class="px-2 py-1">{{ $user->name }} {{ $user->last_name }}</td>
                            <td class="px-2 py-1">{{ $user->dni }}</td>
                            <td class="px-2 py-1 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-2 py-1 whitespace-nowrap">{{ $user->userData->phone}}</td> 
                            <td class="px-2 py-1 text-sm text-gray-500 ">
                                @if ($user->id > 1 && $user->binary && $user->binary->sponsor_id)
                                    {{ optional(\App\Models\User::find($user->binary->sponsor_id))->username ?? 'N/A' }}
                                @else
                                    master
                                @endif
                            </td>

                            <td class="px-2 py-1 whitespace-nowrap">
                                @php
                                    $isActive = $user->activation?->is_active == 1;
                                    $tooltip = $isActive ? 'Activo' : 'Inactivo';
                                    $icon = $isActive ? 'fa-toggle-on' : 'fa-toggle-off';
                                    $color = $isActive ? 'text-primary' : 'text-danger';
                                    $method = $isActive ? 'deactivate' : 'activate';
                                    $confirmation = $isActive
                                        ? '¿Estás seguro que deseas desactivar este usuario?'
                                        : '¿Estás seguro que deseas activar este usuario?';
                                @endphp

                                <flux:tooltip content="{{ $tooltip }}">
                                    <div class="text-center text-xl {{ $color }} cursor-pointer"
                                        wire:click="{{ $method }}({{ $user->id }})"
                                        wire:confirm="{{ $confirmation }}">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                </flux:tooltip>
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap text-left">
                                <div class="flex items-center space-x-3">

                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="text-primary hover:text-primary/80 transition-colors p-1.5 rounded-md hover:bg-primary/10">
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="text-secondary hover:text-secondary/80 transition-colors p-1.5 rounded-md hover:bg-secondary/10">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-primary/10 p-5 rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="text-primary font-medium mb-1">No se encontraron usuarios</p>
                                    <p class="text-ink text-sm">No hay usuarios disponibles para mostrar</p>
                                    @if (!empty($this->searchTerms))
                                        <flux:button wire:click="clearSearch" class=" mt-4">
                                            Limpiar búsqueda
                                        </flux:button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación mejorada -->
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $users->links() }}
        </div>
    </div>
</div>

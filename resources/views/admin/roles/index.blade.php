<x-layouts.admin title="Brands">

    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.index') }}">
            <i class="fas fa-home mr-1"></i> Home
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Roles
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
            <h1 class="text-2xl font-bold text-primary">Gestión de roles</h1>
            <p class="text-sm text-ink mt-1">Administra los Roles de los usuarios</p>
        </div>

        <a href="{{ route('admin.roles.create') }}">
            <flux:button icon="plus" variant="primary">Crar Rol
            </flux:button>
        </a>
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
                    <h2 class="text-lg font-semibold text-ink">Lista de roles</h2>
                </div>
            </div>
        </div>

        <!-- Tabla de Marcas -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-neutral-50">
                    <tr class="text-xs font-medium text-primary uppercase tracking-wider">
                        <th scope="col" class="px-6 py-4 text-left">Nombre</th>
                        {{-- <th scope="col" class="px-6 py-4 text-left">Permisos</th> --}}
                        <th scope="col" class="px-6 py-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-300">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $role->name }}</td>
                            {{-- <td class="px-6 py-4"> {{ $role->permissions->pluck('description')->implode(', - ') }}</td> --}}
                            <td class="px-6 py-4 flex items-center ">
                                <a href="{{ route('admin.roles.edit', $role) }}"
                                    class="text-primary hover:text-primary/80 transition-colors px-1.5 rounded-md hover:bg-primary/10 mr-2"><i
                                        class="fas fa-edit"></i></a>

                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar esta marca {{ $role->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-primary hover:text-primary/80 transition-colors px-1.5 rounded-md hover:bg-primary/10">
                                        <i class="fas fa-trash-alt"></i></button>
                                </form>
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
                                    <p class="text-primary font-medium mb-1">No se encontraron Roles</p>
                                    <p class="text-ink text-sm">No hay roles disponibles para mostrar</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación mejorada -->
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $roles->links() }}
        </div>
    </div>
</x-layouts.admin>











{{-- 








<x-layouts.admin>

    @section('content')
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Lista de Roles</h2>
                <a href="{{ route('admin.roles.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg text-sm">Nuevo
                    Rol</a>
            </div>

            <table class="w-full text-sm border">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-2">Nombre</th>
                        <th class="p-2">Permisos</th>
                        <th class="p-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-t">
                            <td class="p-2">{{ $role->name }}</td>
                            <td class="p-2">
                                {{ $role->permissions->pluck('description')->implode(', -') }}
                            </td>
                            <td class="p-2 text-right space-x-2">
                                <a href="{{ route('admin.roles.edit', $role) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline"
                                        onclick="return confirm('¿Eliminar este rol?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $roles->links() }}
            </div>
        </div>

    </x-layouts.admin> --}}

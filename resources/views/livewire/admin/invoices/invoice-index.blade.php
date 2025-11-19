<div>
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
            <h1 class="text-2xl font-bold text-primary">Gestión de soportes usuarios</h1>
            <p class="text-sm text-ink mt-1">Administra los soportes de las facturas del usuario</p>
        </div>
        <a href="{{ route('admin.invoices.create') }}"
            class="mt-4 md:mt-0 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-secondary transition duration-200 flex items-center shadow-lg shadow-primary/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Nuevo Soporte
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
                    <h2 class="text-lg font-semibold text-ink">Lista de soportes de usuarios</h2>
                </div>
                <!-- Buscador mejorado -->
                <div class="relative">
                    <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="Buscar soporte..." />
                </div>
            </div>
        </div>

        <!-- Tabla de invoiceos mejorada -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-neutral-50">
                    <tr class="text-xs font-medium text-primary uppercase tracking-wider">
                        <th scope="col" class="px-6 py-4 text-left">Fecha</th>
                        <th scope="col" class="px-6 py-4 text-left">Id</th>
                        <th scope="col" class="px-6 py-4 text-left">Id usuario</th>
                        <th scope="col" class="px-6 py-4 text-left">Negocio</th>
                        <th scope="col" class="px-6 py-4 text-left">Nº Factura</th>
                        <th scope="col" class="px-6 py-4 text-left">Total</th>
                        <th scope="col" class="px-6 py-4 text-left">Pts</th>
                        <th scope="col" class="px-6 py-4 text-left">Estado</th>
                        <th scope="col" class="px-6 py-4 text-left">Img</th>
                        <th scope="col" class="px-6 py-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-300">
                    @forelse ($invoices as $invoice)
                        <div wire:key="{{ $invoice->id }}">
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                 <td class="px-6 py-4">{{ $invoice->invoice_date }}</td>
                                <th scope="row" class="px-6 py-4">
                                    {{ $invoice->id }}
                                </th>
                                <td class="px-6 py-4">
                                    <flux:tooltip
                                        content="{{ $invoice->user->name }} {{ $invoice->user->last_name }} - {{ $invoice->user->username }}"
                                        position="top">
                                        <button type="button">{{ $invoice->user_id }}</button>
                                    </flux:tooltip>
                                </td>
                                <td class="px-6 py-4">
                                    <flux:tooltip content="business_data_id = {{ $invoice->business_data_id }}"
                                        position="top">
                                        <button type="button">{{ $invoice->company_name }}</button>
                                    </flux:tooltip>
                                </td>

                                <td class="px-6 py-4">{{ $invoice->invoice_number }}</td>
                                <td class="px-6 py-4">{{ $invoice->total_amount }}</td>
                                <td class="px-6 py-4">{{ $invoice->pts }}</td>
                                <td class="px-6 py-4">{{ $invoice->status }}</td>  
                                <td class="px-6 py-4"><a href="{{ asset('storage/' . $invoice->image_path) }}"
                                        target="_blank"
                                        class=" text-primary hover:text-secondary underline">
                                       <flux:icon.photo class="size-8" />
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                      
                                        {{-- Editar --}}
                                        {{--  <a href="{{ route('admin.invoices.edit', $invoice) }}"
                                            class="text-secondary hover:text-secondary/80 transition-colors p-1.5 rounded-md hover:bg-secondary/10">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}

                                        {{-- eliminar --}}
                                        <button wire:click="destroy({{ $invoice->id }})"
                                            wire:confirm="¿Estás seguro de eliminar el invoiceo {{ $invoice->name }}?"
                                            class="text-danger hover:text-primary/80 transition-colors px-1.5 rounded-md hover:bg-primary/10">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </div>
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
                                    <p class="text-primary font-medium mb-1">No se encontraron invoiceos</p>
                                    <p class="text-ink text-sm">No hay invoiceos disponibles para mostrar</p>
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
            {{ $invoices->links() }}
        </div>
    </div>
</div>

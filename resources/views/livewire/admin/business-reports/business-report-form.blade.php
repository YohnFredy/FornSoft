<div>
    <div class=" flex justify-between items-center mb-2">
        <h1 class=" font-bold  text-palette-200">
            {{ $isEditMode ? 'Editar Reporte del negocio' : 'Crear Reporte' }}</h1>
    </div>

    <div class="p-4 rounded-lg bg-white border border-palette-200/25 shadow-lg shadow-palette-800">
        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">

                <div class="col-span-6 md:col-span-2">
                    <x-input type="date" label="Fecha:" for="invoice_date" wire:model.live="invoice_date" autofocus
                        autocomplete="name" required />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Comercio:" for="business_data_id" wire:model.live="business_data_id">
                        <option value=""> Seleccione un comercio</option>
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}">{{ $business->id }} - {{ $business->business->name }}
                            </option>
                        @endforeach
                    </x-select-l>
                </div>


                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Documento del Usuario:" for="user_dni" wire:model.live="user_dni" />
                </div>


                <div class="col-span-6 md:col-span-2">
                    <x-input type="number" label="Total Facturado:" for="total_amount" wire:model.live="total_amount"
                        step="0.01" placeholder="Ej: 250000" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type="number" label="Comisión:" for="commission" wire:model.live="commission"
                        step="0.01" placeholder="Ej: 15000" />
                </div>


                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Moneda:" for="currency" wire:model.live="currency"
                        placeholder="Ej: COP, USD" />
                </div>


                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Estado:" for="status" wire:model.live="status">
                        <option value="pending_review">Pendiente de Revisión</option>
                        <option value="approved">Aprobado</option>
                        <option value="rejected">Rechazado</option>

                    </x-select-l>
                </div>


                {{-- Número de Factura --}}


                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Número de Factura:" for="invoice_number"
                        wire:model.live="invoice_number" placeholder="Ej: FAC-00123" />
                </div>
            </div>

            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="{{ route('admin.businesses.index') }}"> <i class="fas fa-arrow-left"></i></a>

                <x-button-dynamic type="submit" wire:loading.attr="disabled" wire:target="save,update">
                    <span wire:loading.remove wire:target="save,update">
                        {{ $isEditMode ? 'Actualizar' : 'Guardar' }}
                    </span>
                    <span wire:loading wire:target="save,update">
                        Procesando...
                    </span>
                </x-button-dynamic>
            </div>
        </form>
    </div>

</div>

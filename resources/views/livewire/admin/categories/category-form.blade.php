<div>
    <div class=" flex justify-between items-center mb-2">
        <h1 class=" font-bold  text-palette-200">
            {{ $isEditMode ? 'Editar Categorya' : 'Crear Categoria' }}</h1>

    </div>

    <div class="p-4 rounded-lg bg-white border border-palette-200/25 shadow-lg shadow-palette-800">
        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}" x-on:submit="$refs.fileInput.value = ''">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">

                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Nombre:" for="name" wire:model.live="name" autofocus
                        autocomplete="name" />
                </div>
                @foreach ($categoryLevels as $level => $categories)
                    @if ($categories->isNotEmpty())
                        <div class="sm:col-span-2">
                            <x-select-l label="{{ $level === 0 ? 'Categoría:' : 'Subcategoría nivel ' . $level }}"
                                for="level_{{ $level }}" wire:model.live="selectedLevels.{{ $level }}">
                                <option value="">Ninguno</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </x-select-l>
                        </div>
                    @endif
                @endforeach
            </div>

            <input type="hidden" name="parent_id" value="{{ $parent_id }}" />
            @error('parent_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="bg-neutral-50 border border-neutral-300 px-4 py-5 sm:rounded-lg mt-6">
                <h3 class="text-lg font-medium text-primary leading-6 mb-4">Configuración Adicional</h3>
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_final" wire:model="is_final"
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                            <div class="ml-3 text-sm">
                                <label for="is_final" class="font-medium text-primary">
                                    Categoría Final
                                </label>
                                <p class="text-ink">
                                    Si está marcada, esta categoría no podrá tener subcategorías.
                                </p>
                                @error('is_final')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" wire:model="is_active"
                            class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">

                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-primary">
                                Activa
                            </label>
                            <p class="text-ink">
                                Desmarque esta opción para ocultar temporalmente la categoría.
                            </p>
                            @error('is_active')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="{{ route('admin.categories.index') }}"> <i class="fas fa-arrow-left"></i></a>

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

<div>
    <div class=" flex justify-between items-center mb-2">
        <h1 class=" font-bold  text-palette-200">
            {{ $isEditMode ? 'Editar producto' : 'Crear porducto' }}</h1>
        @livewire('admin.products.calculadora-financiera')
    </div>

    <div class="p-4 rounded-lg bg-white border border-palette-200/25 shadow-lg shadow-palette-800">
        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}" x-on:submit="$refs.fileInput.value = ''">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">

                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Nombre:" for="name" wire:model.live="name" autofocus
                        autocomplete="name" />
                </div>

                <div class=" col-span-6 md:col-span-1">
                    <x-input type="number" label="Precio publico:" for="public_price" wire:model.blur="public_price" step="0.01"
                        min="0" required />
                </div>
                <div class=" col-span-6 md:col-span-1">
                    <x-input type="number" label="iva %:" for="tax_percent" wire:model.blur="tax_percent" step="0.01"
                        min="0" required />
                </div>
                <div class=" col-span-6 md:col-span-1">
                    <x-input type="number" label="Precio sin iva" for="price" wire:model.live="price" step="0.01"
                        min="0" disabled required />
                </div>

                <div class=" col-span-6 md:col-span-1">
                    <x-input type="number" label="Comisione inicio:" for="commission_income"
                        wire:model="commission_income" step="0.01" min="0" required />
                </div>
                <div class=" col-span-6 md:col-span-1 relative">
                    <x-input type="number" label="pts_base:" for="pts_base" wire:model.live="pts_base" step="0.01"
                        min="0" required />
                </div>

                <div class=" col-span-6 md:col-span-1 relative">

                    <x-input type="number" label="pts_bonus:" for="pts_bonus" wire:model.live="pts_bonus"
                        step="0.01" min="0" required />
                </div>

                <div class=" col-span-6 md:col-span-1 relative">

                    <x-input type="number" label="pts_dist:" for="pts_dist" wire:model.live="pts_dist" step="0.01"
                        min="0" required />
                </div>

                <div class="col-span-6 md:col-span-1">
                    <x-input type="number" label="Descuento %:" for="maximum_discount"
                        wire:model.live="maximum_discount" min="0" max="100" required />
                </div>
                <div class="col-span-6 md:col-span-1">
                    <x-input type="number" label="Stock:" for="stock" wire:model="stock" min="0" required />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Tangible:" for="is_physical" wire:model.live="is_physical">
                        <option value="1">tangible</option>
                        <option value="0">intangible</option>
                    </x-select-l>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Permitir pedidos pendientes:" for="allow_backorder"
                        wire:model.live="allow_backorder">
                        <option value="1">Permitir</option>
                        <option value="0">No permitir</option>
                    </x-select-l>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Producto activo:" for="is_active" wire:model.live="is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-select-l>
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="descripcion:">Descripcion:</x-label>
                    <textarea id="editor" wire:model.live="description"> {{ $description }}
                    </textarea>
                    <x-input-error for="description" />
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="Specifications">Specifications:</x-label>
                    <textarea id="editor2" wire:model.live="specifications"> {{ $specifications }}
                    </textarea>
                    <x-input-error for="specifications" />
                </div>

                <div class="col-span-6" wire:ignore>
                    <x-label for="information">Information:</x-label>
                    <textarea id="editor3" wire:model.live="information"> {{ $information }}
                    </textarea>
                    <x-input-error for="information" />
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

                <div class="col-span-6 md:col-span-2">
                    @if ($brands)
                        <x-select-l label="Marca:" for="brand_id" wire:model.live="brand_id">
                            @foreach ($brands as $brand)
                                <option value="">Ninguno</option>
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </x-select-l>
                    @endif
                </div>

                @if ($hasChildCategories === false)
                    <div class="col-span-6">
                        <p class="text-sm text-red-600">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            La categoría seleccionada tiene subcategorías. Por favor, seleccione una categoría del
                            último nivel.
                        </p>
                    </div>
                @endif
                <div class="col-span-6 form-group">
                    <x-input-file-l label="Imagenes:" for="newImages" wire:model="newImages" x-ref="fileInput"
                        wire:loading.attr="disabled" />
                </div>

            </div>

            <!-- Existing Images -->
            @if ($isEditMode)
                <div class=" mt-4">
                    <x-label>Imágenes Existentes:</x-label>
                    <div class="grid grid-cols-6 gap-2 ">
                        @foreach ($images as $image)
                            <div
                                class="col-span-2 md:col-span-1  relative bg-white shadow-md shadow-palette-300  border border-palette-200  rounded-lg flex items-center justify-center p-2">
                                <div class="">
                                    <img src="{{ Storage::url($image) }}" class="h-20" alt="Imagen del Producto">
                                    <button type="button" wire:confirm="Esta seguuro de eliminar la imagen ?"
                                        class=" absolute top-2 right-2 font-bold text-palette-400"
                                        wire:click="removeImage('{{ $image }}')">X</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="{{ route('admin.products.index') }}"> <i class="fas fa-arrow-left"></i></a>

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


    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(function(editor) {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(function(editor2) {
                editor2.model.document.on('change:data', () => {
                    @this.set('specifications', editor2.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .then(function(editor3) {
                editor3.model.document.on('change:data', () => {
                    @this.set('information', editor3.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>

</div>

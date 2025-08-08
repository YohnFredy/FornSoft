<div>
    <div class=" flex justify-between items-center mb-2">
        <h1 class=" font-bold  text-palette-200">
            {{ $isEditMode ? 'Editar negocio' : 'Crear negocio' }}</h1>
    </div>

    <div class="p-4 rounded-lg bg-white border border-palette-200/25 shadow-lg shadow-palette-800">
        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">
                {{-- Campos existentes --}}
                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Nombre:" for="name" wire:model.live="name" autofocus
                        autocomplete="name" required />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" label="Nit:" for="nit" wire:model.live="nit" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type='number' label="Intermediario id:" for="user_id" wire:model.live="user_id"
                        required />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type='number' label="porcentaje mínimo:" for="minimum_percentage"
                        wire:model.live="minimum_percentage" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type='number' label="porcentaje máximo:" for="maximum_percentage"
                        wire:model.live="maximum_percentage" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type='email' label="email:" for="email" wire:model.live="email" required />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Negocio activo:" for="is_active" wire:model.live="is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-select-l>
                </div>
                {{-- Resto de los campos de texto --}}
                <div class="col-span-6 md:col-span-2">
                    <x-input type='text' label="Teléfono:" for="phone" wire:model.live="phone" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type='text' label="WhatsApp:" for="whatsapp" wire:model.live="whatsapp" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type='url' label="Website url:" for="website_url" wire:model.live="website_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type='email' label="email contacto:" for="business_email"
                        wire:model.live="business_email" />
                </div>
                <div class="col-span-6" wire:ignore>
                    <x-label for="descripcion:">Descripcion:</x-label>
                    <textarea id="editor" wire:model.live="description"> {{ $description }}
                    </textarea>
                    <x-input-error for="description" class="col-span-6" />
                </div>

            </div>
            <div class=" grid grid-cols-6 gap-4 gap-y-2 mt-5">
                <!-- Pais -->
                <div class="col-span-6 md:col-span-2">
                    <x-select wire:model.live="selectedCountry" label="País:" for="selectedCountry"
                        placeholder="Seleccione un país..." :options="$countries" required />
                </div>

                <!-- Departamento -->
                @if ($selectedCountry)
                    <div class="col-span-6 md:col-span-2">
                        <x-select wire:model.live="selectedDepartment" label="Departamento:" for="selectedDepartment"
                            placeholder="Seleccione un departamento..." :options="$departments" />
                    </div>

                    <!-- ciudad -->
                    @if ($selectedDepartment)
                        @if (count($cities) > 0)
                            <div class="col-span-6 md:col-span-2">
                                <x-select wire:model.live="selectedCity" label="Ciudad:" for="selectedCity"
                                    placeholder="Seleccione una ciudad..." :options="$cities" />
                            </div>
                        @else
                            <!-- Ciudad -->
                            <div class="col-span-6 md:col-span-2">
                                <x-input wire:model="city" id="city" label="Ciudad:" type="text" for="city"
                                    required autofocus autocomplete="city" placeholder="Ciudad" />
                            </div>
                        @endif
                    @endif
                @endif
            </div>
            <div class=" grid grid-cols-6 gap-4 gap-y-2">

                <div class="col-span-6 md:col-span-4">
                    <x-input type="text" wire:model="address" label="Dirección:" for="address"
                        autocomplete="off" placeholder="Dirección" />
                </div>



                <div class="col-span-6 md:col-span-2">
                    <x-input type="number" wire:model="latitude" label="latitude:" for="latitude"
                        placeholder="latitude" step="0.0000001" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type="number" wire:model="longitude" label="longitude:" for="longitude"
                        placeholder="longitude" step="0.0000001" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="facebook_url" label="facebook_url:" for="facebook_url"
                        placeholder="facebook_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="instagram_url" label="instagram_url:" for="instagram_url"
                        placeholder="instagram_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="linkedin_url" label="linkedin_url:" for="linkedin_url"
                        placeholder="linkedin_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="youtube_url" label="youtube_url:" for="youtube_url"
                        placeholder="youtube_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="tiktok_url" label="tiktok_url:" for="tiktok_url"
                        placeholder="tiktok_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="url" wire:model="x_url" label="x_url:" for="x_url" placeholder="x_url" />
                </div>
                <div class="col-span-6 md:col-span-2">
                    <x-input type="text" wire:model="promo_video_url" label="promo_video_url:"
                        for="promo_video_url" placeholder="promo_video_url" />
                </div>
                <!-- ****** INICIO DE NUEVOS CAMPOS ****** -->

                <!-- Videos Adicionales -->
                <div class="col-span-6">
                    <label class=" text-sm text-danger" for="">Videos Adicionales:</label>
                    
                    @foreach ($additional_videos as $index => $video)
                        <div class="flex items-center space-x-2" wire:key="video-{{ $index }}">
                            <div class="flex-grow">
                                <x-input type="text" wire:model.live="additional_videos.{{ $index }}"
                                    placeholder="https://youtube.com/watch?v=..." />
                            </div>
                            <button type="button" wire:click="removeVideo({{ $index }})"
                                class="bg-danger text-white rounded-md px-2.5 py-1.5 text-sm font-bold hover:bg-danger">×</button>
                        </div>
                        <x-input-error for="additional_videos.{{ $index }}" />
                    @endforeach
                    <button type="button" wire:click="addVideo"
                        class="text-sm text-danger hover:text-secondary font-semibold">+ Añadir otro
                        video</button>
                </div>

                <!-- Enlaces Personalizados -->
                <div class="col-span-6 mt-5">
                    <label class="text-sm text-danger" for="">Enlaces Personalizados (Catálogos, PDF, etc.):</label>
                    @foreach ($custom_links as $index => $link)
                        <div class="grid grid-cols-12 gap-2 items-center" wire:key="link-{{ $index }}">
                            <div class="col-span-12 md:col-span-5">
                                <x-input type="text" wire:model.live="custom_links.{{ $index }}.title"
                                    placeholder="Título del enlace (Ej: Catálogo)" />
                                <x-input-error for="custom_links.{{ $index }}.title" />
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <x-input type="url" wire:model.live="custom_links.{{ $index }}.url"
                                    placeholder="URL del enlace" />
                                <x-input-error for="custom_links.{{ $index }}.url" />
                            </div>
                            <div class="col-span-12 md:col-span-1 flex items-center">
                                <button type="button" wire:click="removeCustomLink({{ $index }})"
                                    class="bg-danger text-white rounded-md px-2.5 py-1.5 text-sm font-bold hover:bg-danger w-full md:w-auto">×</button>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" wire:click="addCustomLink"
                        class="mt-1 text-sm text-danger hover:text-secondary font-semibold">+ Añadir otro
                        enlace</button>
                </div>

                <!-- ****** FIN DE NUEVOS CAMPOS ****** -->

                {{-- Categorías --}}
                <div class="col-span-6 mt-5">
                    <x-label for="categories">Categorías:</x-label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 border p-2 rounded-md">
                        @foreach ($allCategories as $category)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model.live="selectedCategories"
                                    value="{{ $category->id }}" class="rounded">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error for="selectedCategories" />
                </div>

                <div class="col-span-6 mt-5">
                    <x-label for="StoreType">Tipo de Tienda:</x-label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 border p-2 rounded-md">
                        @foreach ($allStoreTypes as $storeType)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model.live="selectedStoreTypes"
                                    value="{{ $storeType->id }}" class="rounded">
                                <span>{{ $storeType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error for="selectedStoreTypes" />
                </div>

                <div class="col-span-6 form-group">
                    <x-input-file-l label="Imagenes:" for="newImages" wire:model="newImages" x-ref="fileInput"
                        wire:loading.attr="disabled" />
                </div>

                <div class="col-span-6 form-group">
                    <x-input-file-l label="logo:" for="newLogo" wire:model="newLogos" x-ref="fileInput"
                        wire:loading.attr="disabled" />
                </div>
            </div>

            <!-- Existing Images -->
            @if ($isEditMode && !empty($existingImages))
                <div class=" mt-4">
                    <x-label>Imágenes Existentes:</x-label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-2 ">
                        {{-- CORRECCIÓN: Iterar sobre el array asociativo [id => path] --}}
                        @foreach ($existingImages as $id => $path)
                            <div
                                class="relative bg-white shadow-md shadow-palette-300  border border-palette-200  rounded-lg flex items-center justify-center p-2">
                                <div class="">
                                    <img src="{{ Storage::url($path) }}" class="h-20 object-cover"
                                        alt="Imagen del Negocio">

                                    {{-- CORRECCIÓN: Llamar al nuevo método con el ID y una confirmación --}}
                                    <button type="button" wire:click="removeMedia({{ $id }})"
                                        wire:confirm="¿Estás seguro de eliminar esta imagen?"
                                        class=" absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs">
                                        X
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Existing Logos -->
            @if ($isEditMode && !empty($existingLogos))
                <div class=" mt-4">
                    <x-label>Logos Existentes:</x-label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-2 ">
                        {{-- CORRECCIÓN: Iterar sobre el array asociativo [id => path] --}}
                        @foreach ($existingLogos as $id => $path)
                            <div
                                class="relative bg-white shadow-md shadow-palette-300  border border-palette-200  rounded-lg flex items-center justify-center p-2">
                                <div class="">
                                    <img src="{{ Storage::url($path) }}" class="h-20 object-cover"
                                        alt="Logo del Negocio">

                                    {{-- CORRECCIÓN: Reutilizamos el mismo método de borrado --}}
                                    <button type="button" wire:click="removeMedia({{ $id }})"
                                        wire:confirm="¿Estás seguro de eliminar este logo?"
                                        class=" absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs">
                                        X
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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

</div>

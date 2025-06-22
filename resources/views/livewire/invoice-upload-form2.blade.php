<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-ink mb-2">Registro de Facturas</h1>
        <p class="text-gray-600">Complete la información de la factura de manera precisa</p>
    </div>

    <!-- Form Container -->
    <div class="md:bg-white md:shadow-xl rounded-2xl overflow-hidden" x-data>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-gradient-to-r from-secondary to-primary text-white px-6 py-6 animate-pulse">
                <div class="flex items-center justify-center space-x-3">
                    <div
                        class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center animate-bounce">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold">¡Factura Registrada Exitosamente!</h3>
                        <p class="text-blue-100 mt-1">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="md:p-8 lg:p-10">

            <form class="space-y-8">
                <!-- Merchant Search Section -->
                <div class="bg-gradient-to-r from-blue-50 to-primary/10 rounded-xl p-4 md:p-6 border border-primary/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <h3 class="text-lg font-semibold text-ink">Información del Comercio</h3>
                    </div>

                    <div class="relative">
                        <label for="search" class="block text-sm font-medium text-ink mb-2">
                            Buscar Comercio
                            <span class="text-gray-500 text-xs">(NIT o Nombre)</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="search" wire:model.live="search"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-secondary focus:border-secondary transition-all"
                                autocomplete="off" placeholder="Escribe mínimo 2 caracteres...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        @if ($matchingMerchants && $matchingMerchants->count() > 0)
                            <div
                                class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                <div class="px-4 py-2 text-xs font-medium text-gray-500 bg-gray-50 border-b">
                                    {{ $matchingMerchants->count() }} resultado(s) encontrado(s)
                                </div>
                                @foreach ($matchingMerchants as $merchant)
                                    <button type="button" wire:click="selectMerchant({{ $merchant->id }})"
                                        class="w-full text-left px-4 py-3 hover:bg-primary/5 border-b border-gray-100 last:border-b-0 transition-colors">
                                        <div class="font-medium text-ink">{{ $merchant->name }}</div>
                                        <div class="text-sm text-gray-500">NIT: {{ $merchant->identification_number }}
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Location Section -->
                @if ($selectedMerchant)
                    <div
                        class="bg-gradient-to-r from-secondary/10 to-primary/10 rounded-xl p-4 md:p-6 border border-secondary/20">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">2</span>
                            </div>
                            <h3 class="text-lg font-semibold text-ink">Ubicación</h3>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="selectedCity" class="block text-sm font-medium text-ink mb-2">
                                    Ciudad
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="relative">
                                    <select id="selectedCity" wire:model.live="selectedCity"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-secondary focus:border-secondary transition-all appearance-none bg-white">
                                        <option value="">Seleccione una ciudad</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('selectedCity')
                                    <p class="mt-1 text-sm text-danger flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="selectedBranchId" class="block text-sm font-medium text-ink mb-2">
                                    Dirección
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="relative">
                                    <select id="selectedBranchId" wire:model.live="selectedBranchId"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-secondary focus:border-secondary transition-all appearance-none bg-white">
                                        <option value="">Seleccione una dirección</option>
                                        @foreach ($merchantBranches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->address }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                @error('selectedBranchId')
                                    <p class="mt-1 text-sm text-danger flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Invoice Details Section -->
                <div
                    class="bg-gradient-to-r from-premium/10 to-premium/5 rounded-xl p-4 md:p-6 border border-premium/20">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-premium rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">3</span>
                        </div>
                        <h3 class="text-lg font-semibold text-ink">Datos de la Factura</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div>
                            <label for="invoice_number_ocr" class="block text-sm font-medium text-ink mb-2">
                                Número de Factura
                                <span class="text-danger">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="invoice_number_ocr" wire:model="invoice_number_ocr"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-premium focus:border-premium transition-all"
                                    placeholder="Ej: FAC-001234">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('invoice_number_ocr')
                                <p class="mt-1 text-sm text-danger flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="total_amount_ocr" class="block text-sm font-medium text-ink mb-2">
                                Monto Total
                                <span class="text-danger">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" id="total_amount_ocr"
                                    wire:model="total_amount_ocr"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-premium focus:border-premium transition-all"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-medium">$</span>
                                </div>
                            </div>
                            @error('total_amount_ocr')
                                <p class="mt-1 text-sm text-danger flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="invoice_date_ocr" class="block text-sm font-medium text-ink mb-2">
                                Fecha de la Factura
                                <span class="text-danger">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="invoice_date_ocr" wire:model="invoice_date_ocr"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-premium focus:border-premium transition-all">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('invoice_date_ocr')
                                <p class="mt-1 text-sm text-danger flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="bg-gradient-to-r from-ink/5 to-primary/5 rounded-xl p-4 md:p-6 border border-ink/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-ink rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">4</span>
                        </div>
                        <h3 class="text-lg font-semibold text-ink">Foto de la Factura</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="image" class="block text-sm font-medium text-ink mb-2">
                                Subir Imagen
                                <span class="text-danger">*</span>
                            </label>
                            <div class="relative">
                                <input type="file" accept="image/*" capture="environment" id="image"
                                    wire:model="image"
                                    class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-ink focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="text-center" style="display: none;" id="upload-placeholder">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">Haz clic para subir o arrastra la imagen
                                            aquí</p>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-danger flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        @if ($image)
                            <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-sm font-medium text-ink">Previsualización de la imagen</p>
                                    <div class="flex items-center text-premium">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Imagen cargada</span>
                                    </div>
                                </div>
                                <div class="relative">
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="w-full max-h-64 object-contain rounded-lg shadow-md border border-gray-200">
                                    <div
                                        class="absolute top-2 right-2 bg-ink bg-opacity-75 text-white px-2 py-1 rounded text-xs">
                                        Vista previa
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-center sm:text-left">
                            <p class="text-sm text-gray-600">¿Todo listo? Revisa la información antes de continuar</p>
                            <p class="text-xs text-gray-500 mt-1">Los campos marcados con * son obligatorios</p>
                        </div>
                        <button type="button" wire:click="save" id="save-button"
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-secondary border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-primary/90 hover:to-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="button-text">Guardar Factura</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Sistema de Registro de Facturas v2.0</p>
    </div>
</div>


<script>
    // Loading state for save button and scroll functionality
    document.addEventListener('DOMContentLoaded', function() {
        const saveButton = document.getElementById('save-button');
        const buttonText = document.getElementById('button-text');

        if (saveButton && buttonText) {
            saveButton.addEventListener('click', function() {
                // Change button to loading state
                saveButton.disabled = true;
                saveButton.classList.add('opacity-75', 'cursor-not-allowed');
                buttonText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Guardando...
            `;

                // Simulate save process and scroll to top after success
                // This would typically be handled by Livewire, but we prepare the scroll
                setTimeout(() => {
                    scrollToTop();
                }, 1500); // Adjust timing based on your actual save process
            });
        }

        // Check if success message exists and scroll to top
        const successMessage = document.querySelector('.animate-pulse');
        if (successMessage) {
            // Scroll to top immediately when success message is present
            scrollToTop();

            // Auto-hide success message after 6 seconds with fade effect
            setTimeout(() => {
                successMessage.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 1000);
            }, 6000);
        }
    });

    // Smooth scroll to top function
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        // Alternative for better browser support
        if (!window.requestAnimationFrame) {
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        }
    }

    // Livewire hook to scroll to top after successful save
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            // Check if the message contains a success response
            if (message.response && message.response.serverMemo &&
                message.response.serverMemo.data &&
                Object.keys(message.response.serverMemo.data).some(key => key.includes('message'))) {

                // Small delay to ensure DOM is updated
                setTimeout(() => {
                    scrollToTop();

                    // Reset button state if it exists
                    const saveButton = document.getElementById('save-button');
                    const buttonText = document.getElementById('button-text');

                    if (saveButton && buttonText) {
                        saveButton.disabled = false;
                        saveButton.classList.remove('opacity-75', 'cursor-not-allowed');
                        buttonText.innerHTML = 'Guardar Factura';
                    }
                }, 100);
            }
        });
    });

    // Fallback: Listen for session flash message changes
    let lastFlashMessage = '';
    setInterval(() => {
        const flashMessage = document.querySelector('.animate-pulse');
        if (flashMessage && flashMessage.textContent !== lastFlashMessage) {
            lastFlashMessage = flashMessage.textContent;
            scrollToTop();
        }
    }, 500);
</script>

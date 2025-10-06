<div class="flex flex-col gap-6 lg:px-32">

    @if ($isEditMode == true)
        <x-auth-header title="Editar cuenta" description="Ingresa los datos a continuación para editar la cuenta" />
    @else
        <x-auth-header title="Crear una cuenta" description="Ingresa los datos a continuación para crear la cuenta" />
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}">

        <div class="grid grid-cols-2 gap-x-3">
            <!-- Name -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model="name" label="{{ __('Nombre') }}:" type="text" for="name" required autofocus
                    autocomplete="name" placeholder="Nombre" />
            </div>

            <!-- Apellidos -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model="last_name" id="last_name" label="{{ __('Apellido') }}:" type="text"
                    for="last_name" required autofocus autocomplete="last_name" placeholder="Apellidos" />
            </div>

            <!-- username -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model.live.debounce.500ms="username" id="username" label="Username:" type="text"
                    for="username" required placeholder="Nombre de usuario" />
            </div>

            <!-- Dni -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model.blur="dni" id="dni" label="Número de documento:" type="text" for="dni"
                    required placeholder="Número de documento" />
            </div>

            <!-- Email -->
            <div class="col-span-2">
                <x-input wire:model.blur="email" id="email" label="{{ __('Email address') }}:" type="email"
                    for="email" required autocomplete="email" placeholder="email@example.com" />
            </div>

            <!-- Sexo -->
            <div class="col-span-2 sm:col-span-1">
                <x-radio class="" name="sex" label="Sexo:" wire:model="sex" :options="[['value' => 'male', 'label' => 'Masculino'], ['value' => 'female', 'label' => 'Femenino']]" />
            </div>

            <!-- Fecha nacimiento -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model="birthdate" type="date" max="2999-12-31" label="Fecha nacimiento:" />
            </div>

            <!-- Teléfono -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model.live="phone" label="Teléfono:" type="text" for="phone" required
                    placeholder="Teléfono" />
            </div>

            <!-- Pais -->
            <div class="col-span-2 sm:col-span-1">
                <x-select wire:model.live="selectedCountry" label="País:" for="selectedCountry"
                    placeholder="Seleccione un país..." :options="$countries" required />
            </div>


            <!-- Departamento -->
            @if ($selectedCountry)

                <div class="col-span-2 sm:col-span-1">
                    <x-select wire:model.live="selectedDepartment" label="Departamento:" for="selectedDepartment"
                        placeholder="Seleccione un departamento..." :options="$departments" />
                </div>


                <!-- ciudad -->
                @if ($selectedDepartment)
                    @if (count($cities) > 0)
                        <div class="col-span-2 sm:col-span-1">
                            <x-select wire:model.live="selectedCity" label="Ciudad:" for="selectedCity"
                                placeholder="Seleccione una ciudad..." :options="$cities" />
                        </div>
                    @else
                        <!-- Ciudad -->
                        <div class="col-span-2 sm:col-span-1">
                            <x-input wire:model="city" id="city" label="Ciudad:" type="text" for="city"
                                required autofocus autocomplete="city" placeholder="Ciudad" />
                        </div>
                    @endif
                @endif
            @endif
        </div>

        <div class="grid grid-cols-2 gap-x-3  ">
            <!-- Dirección -->
            <div class="col-span-2">
                <x-input wire:model="address" id="Dirección" label="Dirección:" type="text" for="address"
                    autocomplete="off" placeholder="Dirección" />
            </div>

            <!-- sponsor -->
            <div class="col-span-2 sm:col-span-1">
                <x-input wire:model="sponsor" id="sponsor" :disabled="$isEditMode == true" label="Sponsor:" type="text"
                    for="sponsor" placeholder="sponsor" />
            </div>


            @if ($isEditMode == false)
                <!-- side -->
                <div class="col-span-2 sm:col-span-1">

                    <label for="lado" class="block mb-2 text-sm font-medium text-primary ">Posicion</label>

                    <select wire:model="side"
                        class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                        <option value="right">Right</option>
                        <option value="left">Left</option>
                    </select>
                </div>


                <!-- Password -->
                <div class=" col-span-2">
                    <x-input wire:model.live.debounce.750ms="password" id="password" label="{{ __('Password') }}:"
                        type="password" for="password" required autocomplete="new-password"
                        placeholder="Password" />
                </div>

                <!-- Confirm Password -->
                <div class=" col-span-2">
                    <x-input wire:model.live.debounce.750ms="password_confirmation" id="password_confirmation"
                        label="{{ __('Confirm password') }}:" type="password" for="password_confirmation" required
                        autocomplete="new-password" placeholder="Confirm password" />
                </div>
            @endif

        </div>

        <x-button-dynamic type="submit" wire:loading.attr="disabled" wire:target="save,update">
            <span wire:loading.remove wire:target="save,update">
                {{ $isEditMode ? 'Actualizar' : 'Guardar' }}
            </span>
            <span wire:loading wire:target="save,update">
                Procesando...
            </span>
        </x-button-dynamic>

    </form>

    <script>
        // Selecciona el campo de entrada
        var usernameInput = document.getElementById('username');

        // Añade un evento 'input' para eliminar espacios en tiempo real
        usernameInput.addEventListener('input', function() {
            this.value = this.value.replace(/\s+/g, '');
        });
    </script>
</div>

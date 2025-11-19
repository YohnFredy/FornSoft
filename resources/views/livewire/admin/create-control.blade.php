<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                    {{-- Campo de búsqueda de Usuario --}}
                    <div class="mb-4">
                        <label for="user_search" class="block text-gray-700 text-sm font-bold mb-2">Usuario:</label>
                        
                        @if ($selectedUserName)
                            {{-- Vista cuando un usuario ya está seleccionado --}}
                            <div class="flex items-center justify-between p-2 bg-gray-100 rounded">
                                <span>{{ $selectedUserName }} (ID: {{ $user_id }})</span>
                                <button type="button" wire:click="clearUserSelection()" class="text-sm text-red-500 hover:text-red-700">Cambiar</button>
                            </div>
                        @else
                            {{-- Vista para buscar un usuario --}}
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="user_search" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Buscar por username nombre, DNI, teléfono..."
                                    wire:model.live.debounce.300ms="searchQuery"
                                    autocomplete="off"
                                >
                                <div wire:loading wire:target="searchQuery" class="absolute top-0 right-0 mt-2 mr-3">
                                    <!-- Puedes poner un spinner aquí -->
                                    <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                
                                @if($searchResults->isNotEmpty())
                                    <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 max-h-48 overflow-y-auto">
                                        @foreach($searchResults as $user)
                                            <li class="px-3 py-2 cursor-pointer hover:bg-gray-100" 
                                                wire:click="selectUser({{ $user->id }},  '{{ $user->name }} {{ $user->last_name }}')">
                                               {{ $user->id }} - {{ $user->username }} - {{ $user->name }} {{ $user->last_name }} ({{ $user->dni }})
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif(strlen($searchQuery) >= 2)
                                    <div class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 p-3 text-gray-500">
                                        No se encontraron resultados.
                                    </div>
                                @endif
                            </div>
                        @endif

                        @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>

                  
                    <div class="mb-4">
                        <label for="ad_value" class="block text-gray-700 text-sm font-bold mb-2">Valor de Publicidad:</label>
                        <input type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="ad_value" wire:model.live="ad_value">
                        @error('ad_value') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Botones del modal (se mantienen igual) --}}
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">Guardar</button>
                    <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 mt-3 sm:mt-0 sm:w-auto sm:text-sm">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
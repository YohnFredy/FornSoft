<div>
    <div class="max-w-2xl mx-auto">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">
            Mensaje
        </label>
        <textarea wire:model.live="message" id="message" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4"
            placeholder="Escribe el mensaje">
        </textarea>

        <flux:button variant="primary" wire:click="exportToExcel">
            Exportar a Excel
        </flux:button>

        <flux:button variant="primary" wire:click="getUsers">
            Usuarios
        </flux:button>

        <flux:button variant="primary" wire:click="activeUsers">
            Usuarios Activos
        </flux:button>

        <flux:button variant="primary" wire:click="inactiveUsers">
            Usuarios inactivos
        </flux:button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Número de Teléfono</th>
                    <th scope="col" class="px-6 py-3">Mensaje 1</th>
                    <th scope="col" class="px-6 py-3">Mensaje 2</th>
                    <th scope="col" class="px-6 py-3">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        $count++;
                    @endphp

                    <tr wire:key="{{ $user->id }}" class="odd:bg-white  even:bg-gray-50 border-b  border-gray-200">
                        <th scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap">
                            {{ $user->userData->phone }}
                        </th>
                        <td class="px-6 py-0 whitespace-pre-wrap">

                            {{ $user->name }} {{ $user->last_name }}
                            {{-- {{ str_replace('name', e($user->name), e($message)) }} --}}
                        </td>
                        <td class="px-6 py-0"></td>
                        <td class="px-6 py-0"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $count }}
    </div>
</div>

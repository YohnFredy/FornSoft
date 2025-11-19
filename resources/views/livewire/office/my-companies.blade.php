<div class="mx-auto px-2 sm:px-4 pb-8">
    <div class=" flex justify-between">
        <h1 class="text-2xl font-bold text-primary mb-6 border-b border-ink pb-2">Mis Empresas</h1>


        <a href="{{ route('company.invoices') }}">
            <div>
                <flux:button variant="primary">Ver Soportes</flux:button>
            </div>
        </a>

    </div>

    @if ($user->business->isEmpty())
        <div class="bg-secondary/5 border-l-4 border-primary text-primary p-2 sm:p-4 rounded-lg" role="alert">
            <p class="font-bold">Información</p>
            <p>Actualmente no tienes ninguna empresa asociada a tu cuenta.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($user->business as $business)
                <div
                    class="bg-white rounded-xl shadow-lg shadow-ink border overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <div class="p-3 sm:p-6 space-y-2">
                        <h2 class="text-xl font-bold text-primary">{{ $business->name }}</h2>
                        <p class="text-sm text-nuetral-500">NIT: {{ $business->nit ?? 'No registrado' }}</p>

                        <div class="space-y-1">
                            <div class="flex justify-between bg-secondary/10 p-3 rounded-lg">
                                <span class="text-sm font-semibold text-neutral-600">Porcentaje Mínimo</span>
                                <span
                                    class="text-base font-bold text-premium">{{ number_format($business->minimum_percentage, 2) }}%</span>
                            </div>
                            <div class="flex justify-between bg-secondary/10 p-3 rounded-lg">
                                <span class="text-sm font-semibold text-neutral-600">Porcentaje Máximo</span>
                                <span
                                    class="text-base font-bold text-primary">{{ number_format($business->maximum_percentage, 2) }}%</span>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button wire:click="showBusinessData({{ $business->id }})"
                                class="w-full bg-primary text-white font-bold py-2 px-4 rounded-lg hover:bg-secondary transition-colors duration-300">
                                Ver información
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modal Detalle de Empresa --}}
    <div x-data="{ show: @entangle('showModal') }" x-cloak>
        <div x-show="show" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center sm:p-4"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div @click.away="$wire.closeModal()" x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden">

                {{-- Header --}}
                <div class="flex justify-between items-center p-3 sm:p-5 border-b bg-secondary/5">
                    <h3 class="text-xl font-bold text-primary">
                        {{ $selectedBusiness?->name ?? '' }}
                    </h3>
                    <button @click="$wire.closeModal()"
                        class="text-ink hover:text-gray-600 text-3xl leading-none">&times;</button>
                </div>

                {{-- Contenido --}}
                <div class=" p-1 sm:p-6 overflow-y-auto space-y-4">
                    @if ($selectedBusiness)
                        @foreach ($selectedBusiness->data as $data)
                            <div class="border rounded-lg p-2 sm:p-4 shadow-sm shadow-ink">
                                <h4 class="font-semibold text-primary mb-2">Sucursal</h4>

                                @if ($data->address)
                                    <p><strong>Dirección:</strong> {{ $data->address }}</p>
                                @endif
                                @if ($data->city)
                                    <p><strong>Ciudad:</strong> {{ $data->city }}</p>
                                @endif
                                @if ($data->phone)
                                    <p><strong>Teléfono:</strong> {{ $data->phone }}</p>
                                @endif
                                @if ($data->whatsapp)
                                    <p><strong>WhatsApp:</strong> {{ $data->whatsapp }}</p>
                                @endif
                                @if ($data->business_email)
                                    <p><strong>Email:</strong> {{ $data->business_email }}</p>
                                @endif
                                @if ($data->website_url)
                                    <p><strong>Sitio Web:</strong> <a href="{{ $data->website_url }}" target="_blank"
                                            class="text-primary hover:underline">{{ $data->website_url }}</a></p>
                                @endif

                                {{-- @if ($data->description)
                                    <p class="text-gray-700 mt-2">{!! $data->description !!}</p>
                                @endif --}}
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- Footer --}}
                <div class="p-4 bg-secondary/15 border-t text-right">
                    <button @click="$wire.closeModal()"
                        class="bg-primary text-white font-semibold py-2 px-5 rounded-lg hover:bg-secondary">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

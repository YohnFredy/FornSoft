<div>

    <div class="sm:bg-white sm:px-6 sm:pb-8 rounded-lg sm:shadow-md shadow-neutral-300 sm:border border-neutral-50">
        <div class="mb-3 sm:mt-4">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('home') }}">Inicio</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="#">{{ $product->category->name ?? 'Sin categoría' }}
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item>{{ $product->name }}</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <div class="grid grid-cols-8 gap-4 lg:gap-x-10 lg:px-10">
            <div class="hidden col-span-1 sm:flex items-center">
                <div>
                    @if ($product->images->count() > 1)
                        @foreach ($product->images->take(4) as $index => $image)
                            <button class=" shadow rounded-lg" wire:click="changeImage({{ $index }})"
                                class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden {{ $currentImageIndex === $index ? 'ring-2 ring-indigo-500' : '' }}">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-center object-cover rounded-lg">
                            </button>
                        @endforeach
                    @else
                        @if ($product->images->count() > 0)
                            <img class="w-full rounded-lg shadow-md"
                                src="{{ asset('storage/' . $product->images[$currentImageIndex]->path) }}"
                                alt="{{ $product->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-span-8 sm:col-span-3 shadow-md sm:shadow-none rounded-lg flex items-center">
                @if ($product->images->count() > 0)
                    <img class="w-full rounded-lg shadow-md"
                        src="{{ asset('storage/' . $product->images[$currentImageIndex]->path) }}"
                        alt="{{ $product->name }}">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                        <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="sm:hidden col-span-8 flex justify-center gap-2 px-1 pt-1 pb-2 overflow-x-auto ">
                @if ($product->images->count() > 1)
                    @foreach ($product->images as $index => $image)
                        <button wire:click="changeImage({{ $index }})"
                            class="flex-shrink-0 w-16 h-16 shadow rounded-lg {{ $currentImageIndex === $index ? 'ring-2 ring-neutral-200' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-center object-cover rounded-lg">
                        </button>
                    @endforeach
                @endif
            </div>
            <div class="col-span-8 sm:col-span-4 mt-3">
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-extrabold tracking-tight text-primary capitalize">{{ $product->name }}
                        </h1>
                        @if ($product->brand)
                            <a href="{{-- {{ route('brands.show', $product->brand) }} --}}" class="text-sm font-medium text-premium hover:text-primary">
                                {{ $product->brand->name }}
                            </a>
                        @endif
                    </div>

                    <!-- Precio -->
                    <div class="mt-4">
                        <p class="text-2xl text-secondary">
                             ${{ format_price_with_tax($product->price, $product->tax_percent) }}
                        </p>
                        @if ($product->maximum_discount > 0)
                            <p class="text-sm text-primary">
                                Descuento Usuarios Activos: {{ $product->maximum_discount }}%
                            </p>
                        @endif
                    </div>

                    <!-- Descripción breve -->
                    <div class="mt-6">
                        <p class="text-base text-ink">
                            {!! $product->description !!}
                        </p>
                    </div>

                    <!-- Disponibilidad -->
                    @if ($product->is_physical)
                        <div class="mt-6">
                            <div class="flex items-center">
                                @if ($product->stock > 0 || $product->allow_backorder)
                                    <svg class="h-5 w-5 text-premium" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="ml-2 text-sm text-primary">
                                        @if ($product->stock > 0)
                                            En stock ({{ $product->stock }} disponibles)
                                        @else
                                            Disponible bajo pedido
                                        @endif
                                    </p>
                                @else
                                    <svg class="h-5 w-5 text-danger" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="ml-2 text-sm text-danger">
                                        Agotado
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Cantidad y botón Agregar al Carrito -->
                    <div class="mt-8">
                        <div class="flex items-center">
                            <span class="mr-3 text-ink">Cantidad</span>
                            <div class="flex items-center border border-neutral-300 rounded-md">
                                <button wire:click="decrementQuantity"
                                    class="px-3 py-1 text-ink hover:bg-neutral-100 focus:outline-none">
                                    -
                                </button>
                                <span class="px-3 py-1 text-ink">{{ $quantity }}</span>
                                <button wire:click="incrementQuantity"
                                    class="px-3 py-1 text-ink hover:bg-neutral-100 focus:outline-none">
                                    +
                                </button>
                            </div>
                        </div>

                        <div class=" mt-6">
                            <flux:button icon="shopping-cart" variant="primary" wire:click="addToCart" class=" w-full">
                                Agregar al carrito
                            </flux:button>
                        </div>
                    </div>

                    <!-- Características adicionales -->
                    @if ($product->pts_base)
                        <div class="mt-6">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-premium" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <p class="ml-2 text-sm text-primary">
                                    Este producto otorga {{ number_format($product->pts_base, 2) }} puntos
                                </p>
                            </div>
                        </div>
                    @endif

                    @if ($product->commission_income)
                        <div class="mt-2">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-premium" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-danger">
                                    Comisión: ${{ number_format($product->commission_income, 0) }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>

    <div
        class=" grid grid-cols-2 gap-8 mt-6 bg-neutral-50 border border-neutral-300 px-2 py-4 sm:p-4 lg:p-8   rounded-lg">
        <div class="col-span-2 md:col-span-1 ">
            <h1 class=" text-lg text-primary font-medium pb-1 border-b border-secondary">Especificaciones</h1>
            <div class="mt-4">
                {!! $product->specifications !!}
            </div>
        </div>

        <div class="col-span-2 md:col-span-1">
            <h1 class="text-lg text-primary font-medium pb-1 border-b border-secondary">Información</h1>
            <div class="mt-4">
                {!! $product->information !!}
            </div>
        </div>
    </div>


    <flux:modal wire:model.live="modalCart" :dismissible="false" class="">
        <flux:heading class="text-primary! pr-6" size="lg">Lo que agregas al carrito
        </flux:heading>

        <div
            class=" grid grid-cols-10 gap-2 border-y border-neutral-400 divide-y divide-neutral-300  sm:divide-none py-4 mt-4 text-ink">
            <div class="col-span-10 sm:col-span-1 flex justify-center">
                <img class="w-12 h-12 rounded-md border border-neutral-300 object-cover mb-1"
                    src="{{ asset('storage/' . $product->latestImage->path) }}" alt="{{ $product->name }}">
            </div>
            <div class="col-span-10 sm:col-span-5 flex justify-center items-center mb-1">
                {{ $product->name }}
            </div>

            <div class="  col-span-10 sm:col-span-2 flex justify-center items-center mb-1">
               ${{ format_price_with_tax($product->price, $product->tax_percent) }}
            </div>

            {{-- <div class=" col-span-10 sm:col-span-2 flex justify-center items-center mb-1">
                Pts_base: {{ $product->pts_base }}
            </div> --}}

            <div class=" col-span-10 sm:col-span-2 flex justify-center items-center mb-1">
                Cant: {{ $quantity }}
            </div>
        </div>



        <div class=" grid sm:grid-cols-3 gap-2 pt-3">
            <a href="{{ route('products.index') }}" class="sm:col-start-2">
                <flux:button variant="primary" class="w-full">Seguir Comprando</flux:button>
            </a>
            <a href="{{ route('products.cart') }}">
                <flux:button variant="primary" class="w-full">Ir al carro</flux:button>
            </a>
            {{--  <flux:button x-on:click="$wire.modalCart = false" class="w-full">Cerrar
                        </flux:button> --}}
        </div>
    </flux:modal>


</div>

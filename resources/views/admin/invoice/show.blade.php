<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark bg-white">

<head>
    @include('partials.head')

    <style>
        .invoice-container {
            max-width: 800px;
        }

        .badge-status {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-paid {
            background-color: #DEF7EC;
            color: #0761B0;
        }

        .badge-pending {
            background-color: #FEF3C7;
            color: #0982EB;
        }

        .badge-rejected {
            background-color: #FEE2E2;
            color: #B00F07;
        }

        .badge-delivered {
            background-color: #DBEAFE;
            color: #B00F07;
        }

        .badge-sent {
            background-color: #E0E7FF;
            color: #B00F07;
        }

        .discount-badge {
            background-color: #FEE2E2;
            color: #B00F07;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
            margin-left: 8px;
        }

        .table-header {
            background-color: #0761B0;
            color: #ffffff;
        }

        .signature-line {
            border-top: 1px solid #D1D5DB;
            width: 200px;
            margin-top: 40px;
            padding-top: 10px;
        }

        .footer-gradient {
            background: linear-gradient(to right, #0761B0, #0982EB);
            height: 10px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }

            @page {
                size: A4;
                margin: 6mm;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body class=" text-ink">
    <div class="p-6">
        <div class="invoice-container mx-auto  overflow-hidden">
            <!-- Header -->
            <div class="bg-secondary/5 p-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <x-app-logo-icon class="fill-current" />
                    </div>
                    <div class="text-right">
                        <h2 class="text-xl font-semibold text-ink/70">
                            Documento Soporte N°
                            <span class="text-primary">{{ $order->public_order_number }}</span>
                        </h2>
                        <p class="text-sm text-gray-600">Fecha: {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Información de la empresa y el cliente -->
            <div class="p-4 grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm uppercase font-semibold text-gray-500 tracking-wider mb-2">Datos del
                        Vendedor
                    </h3>
                    <div class="border rounded-md p-4 bg-gray-50">
                        <h4 class="font-semibold text-gray-800">Fornuvi</h4>
                        <p class="text-sm text-gray-600">Tienda en línea de productos naturales</p>
                        <div class="mt-3 text-sm text-gray-600">
                            <p><i class="fas fa-globe mr-2 text-primary"></i> www.fornuvi.com</p>
                            <p><i class="fab fa-whatsapp mr-2 text-primary"></i> +57 314 520 7814</p>
                            <p><i class="fas fa-envelope mr-2 text-primary"></i> info@fornuvi.com
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm uppercase font-semibold text-gray-500 tracking-wider mb-2">Datos del
                        Cliente</h3>
                    <div class="border rounded-md p-4">
                        <h4 class="font-semibold text-gray-800">{{ $order->contact }}</h4>
                        <p class="text-sm text-gray-600">
                            {{ $order->dni ? 'CC: ' . $order->dni : 'Sin identificación registrada' }}</p>
                        <div class="mt-3 text-sm text-gray-600">
                            <p><i class="fas fa-phone mr-2 text-gray-400"></i> {{ $order->phone }}</p>
                            <p><i class="fas fa-envelope-open mr-2 text-gray-400"></i>{{ $order->email }}</p>
                            <p><i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> {{ $order->address }}
                            </p>
                            <p><i class="fas fa-city mr-2 text-gray-400"></i> {{ $order->addCity }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del pedido -->
            <div class="px-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm uppercase font-semibold text-gray-500 tracking-wider">Detalle de la
                        Compra</h3>
                    <div class="flex items-center">
                        @if (isset($order->discount_code) && $order->discount_code)
                            <span class="discount-badge mr-3">
                                <i class="fas fa-tag mr-1"></i> {{ $order->discount_code }}
                            </span>
                        @endif
                        <span
                            class="badge-status 
                            @if ($order->status == 1) badge-pending
                            @elseif(in_array($order->status, [2, 3, 4, 5])) badge-paid
                            @elseif($order->status == 4) badge-sent
                            @elseif($order->status == 5) badge-delivered
                            @elseif(in_array($order->status, [6, 7, 8])) badge-rejected @endif">
                            @switch($order->status)
                                @case(1)
                                    Pendiente
                                @break

                                @case(2)
                                    Pagado
                                @break

                                @case(3)
                                    Pagado
                                @break

                                @case(4)
                                    Pagado
                                @break

                                @case(5)
                                    Pagado
                                @break

                                @case(6)
                                    Rechazado
                                @break

                                @case(7)
                                    Anulado
                                @break

                                @case(8)
                                    Rechazo de anulación
                                @break

                                @default
                                    Pendiente
                            @endswitch
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="table-header text-xs uppercase font-semibold text-gray-600 tracking-wider">
                            <tr>
                                <th class="py-1 px-4 border-b">Descripción</th>
                                <th class="py-1 px-4 border-b text-center">Cantidad</th>
                                <th class="py-1 px-4 border-b text-right">Precio Unit.</th>
                                <th class="py-1 px-4 border-b text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($order->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-1 px-4 border-b">
                                        <div class="font-medium text-gray-800">{{ $item->name }}</div>

                                    </td>
                                    <td class="py-1 px-4 border-b text-center">{{ $item->quantity }}</td>
                                    <td class="py-1 px-4 border-b text-right">
                                        $ {{ number_format($item->final_price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-1 px-4 border-b text-right font-medium">$
                                        {{ number_format($item->final_price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totales -->
            <div class="p-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-6">
                        <h3 class="text-sm uppercase font-semibold text-gray-500 tracking-wider mb-2">
                            Información de
                            Entrega</h3>
                        <div class="border rounded-md p-4 bg-gray-50 text-sm">
                            <p class="flex items-center">
                                <i class="fas fa-shipping-fast mr-2 text-primary"></i>
                                <span class="font-medium">Tipo de Entrega:</span>
                                <span
                                    class="ml-2">{{ $order->envio_type == 'store' ? 'Recoge en tienda' : 'Envío a domicilio' }}</span>
                            </p>

                            @if ($order->envio_type != 'store')
                                <p class="mt-2 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                    <span class="font-medium">Dirección:</span>
                                    <span class="ml-2">{{ $order->address }},
                                        {{ $order->addCity }}</span>
                                </p>
                            @endif

                            <p class="mt-2 flex items-center">
                                <i class="fas fa-credit-card mr-2 text-primary"></i>
                                <span class="font-medium">Método de Pago:</span>
                                <span class="ml-2">{{ $order->payment_method ?? 'Por confirmar' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm uppercase font-semibold text-gray-500 tracking-wider mb-2">Resumen</h3>
                    <div class="border rounded-md p-4">


                        <div class="flex justify-between">
                            <span class="text-ink">Subtotal productos:</span>
                            <span>$
                                {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>

                        @if (isset($order->discount) && $order->discount > 0)
                            <div class="flex justify-between border-t border-neutral-200">
                                <span class="text-gray-600">Descuento:</span>
                                <span class="text-red-600">- $
                                    {{ number_format($order->discount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between border-t border-neutral-200">
                                <span class="text-gray-600">Subtotal descuento:</span>
                                <span class=""> $
                                    {{ number_format($order->subtotal - $order->discount, 0, ',', '.') }}</span>
                            </div>
                        @endif


                        @if ($order->tax_amount > 0)
                            <div class="flex justify-between border-t border-neutral-200">
                                <span class="text-gray-600">Subtotal (Sin IVA):</span>
                                <span class=""> $
                                    {{ number_format($order->taxable_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between border-t border-neutral-200">
                                <span class="text-gray-600">IVA:</span>
                                <span class=""> $
                                    {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        @if ($order->shipping_cost > 0)
                            <div class="flex justify-between border-t border-neutral-200">
                                <span class="text-gray-600">Envío:</span>
                                <span class=""> $
                                    {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between py-1 border-t border-gray-400 mt-2 pt-2">
                            <span class="font-semibold text-lg">Total:</span>
                            <span class="font-bold text-xl text-primary">$
                                {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>

                    </div>

                    <div class="mt-4 text-xs text-gray-500 italic">
                        <p>Los precios incluyen IVA (cuando aplique)</p>

                    </div>
                </div>
            </div>

            <!-- Nota legal y términos -->
            <div class="p-6 text-xs  border-t border-gray-200">
                <p class="mb-1"><strong>Nota:</strong> Este documento es un soporte de venta para compras en
                    línea de
                    FORNUVI.</p>
                <p class="mb-1">Para cualquier consulta o reclamación, por favor contacte a nuestro servicio
                    al
                    cliente.</p>
                <p>FORNUVI: Fortaleciendo Nuestras Vida.</p>
            </div>

            <!-- Botón de impresión y pie de página -->
            <div>
                <div class="p-4 text-center border-t border-gray-200 no-print">
                    <button onclick="window.print()"
                        class="px-6 py-2 bg-primary text-white rounded-md font-medium inline-flex items-center hover:bg-secondary transition">
                        <i class="fas fa-print mr-2"></i> Imprimir Documento
                    </button>
                </div>
                {{-- <div class="footer-gradient"></div> --}}
            </div>
        </div>
    </div>

    <script>
        // Automatizar la actualización de información
        document.addEventListener('DOMContentLoaded', function() {
            // Podríamos agregar código JavaScript adicional aquí si fuera necesario
            // Por ejemplo, para añadir un número de serie o fecha de generación automática
        });
    </script>
</body>

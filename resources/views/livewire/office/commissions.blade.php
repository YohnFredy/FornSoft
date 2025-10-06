<div class=" sm:bg-white/80 sm:shadow-lg shadow-ink rounded-lg min-h-screen">
    <div class="max-w-7xl mx-auto  sm:p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-3xl font-bold text-primary sm:text-3xl">Mis Comisiones</h1>
                    <p class="mt-2 text-base text-ink">Gestiona y visualiza todas tus comisiones en Fornuvi</p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    {{-- <button wire:click="exportCommissions" 
                            class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Exportar
                    </button> --}}
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            <!-- Total Comisiones -->
            <div
                class="bg-white overflow-hidden shadow-md shadow-ink rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-primary">Total Comisiones</p>
                            <p class="text-2xl font-bold text-ink"> ${{ number_format($summaryCommission ?? 0, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comisiones del Mes -->
            <div
                class="bg-white overflow-hidden shadow-md shadow-ink rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-secondary to-secondary/80 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-secondary">Total Comisiones {{-- Mes Anterior --}}</p>
                            <p class="text-2xl font-bold text-ink"> ${{ number_format($summaryCommission ?? 0, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comisiones de la Semana -->
            <div
                class="bg-white overflow-hidden shadow-md shadow-ink rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-premium to-premium/80 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-premium">Disponible</p>
                            <p class="text-2xl font-bold text-ink"> ${{ number_format($summaryCommission ?? 0, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white rounded-xl shadow-md shadow-ink border border-gray-100 mb-8">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <!-- Período -->
                    <div class="relative">
                        <label for="period" class="block mb-2 text-sm font-medium text-primary">Período</label>
                        <select wire:model.live="selectedPeriod"
                            class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg 
                            focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                            {{-- <option value="last_month">Mes Anterior</option>
                            <option value="current_quarter">Trimestre Actual</option>
                            <option value="current_year">Año Actual</option> --}}
                            <option value="all_time">Todo el Tiempo</option>
                        </select>

                        <div class="absolute inset-y-0 right-5 top-8 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <!-- Tipo de Comisión -->
                    <div class="relative">
                        <label for="type" class="block mb-2 text-sm font-medium text-primary">Tipo de
                            Comisión</label>
                        <select wire:model.live="selectedType"
                            class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg 
                            focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                            <option value="">Todas</option>
                            <option value="1">Bolsa Global</option>
                            {{--  <option value="3">Generacional</option>
                            <option value="4">Gen Avanzado</option>
                            <option value="5">Rangos</option>
                            <option value="6">Regalias</option> --}}
                            <option value="7">Socio estratégico</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commissions Table -->
        <div class="bg-white shadow-md shadow-ink rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-ink">Historial de Comisiones</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                VFB</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Comisión</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periodo</th>
                        </tr>
                    </thead>
                    @forelse($commissions as $commission)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($commission->type)
                                    @case(1)
                                        <p>Bolsa Global</p>
                                    @break

                                    @case(7)
                                        <p>Socio estratégico</p>
                                    @break

                                    @default
                                        <p>Otro tipo de comisión</p>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="flex items-center justify-center w-8 h-8 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">
                                    {{ number_format($commission->vfb ?? 0, 1) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ${{ number_format($commission->commission, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($commission->end)->format('Y-m-d') }}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay comisiones</h3>
                                        <p class="text-sm text-gray-500">No se encontraron comisiones con los filtros
                                            seleccionados.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>


        </div>
    </div>

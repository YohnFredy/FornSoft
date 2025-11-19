<li>
    @if ($node['level'] < 1)
        <a wire:click="show({{ $node['id'] }})" class="hover:bg-neutral-50 transition-colors cursor-pointer">

            <div class="grid grid-cols-2 gap-x-2 gap-y-1 p-2">
                <div class="col-span-2 flex items-center justify-center mb-1">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-primary/10 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    @if ($node['username'] == 'master')
                        <div>
                            <h4 class=" text-base sm:text-xl font-bold capitalize text-primary">
                                Alejandra

                            </h4>
                            <h1 class=" text-sm text-ink"> <strong class=" text-primary">PP:
                                </strong>{{ $node['PtsPersonal'] ?: 0.0 }}</h1>
                        </div>
                    @else
                        <div>
                            <h4 class=" text-base sm:text-xl font-bold capitalize text-primary">
                                {{ $node['username'] }}

                            </h4>
                            <h1 class=" text-sm text-ink"> <strong class=" text-primary">PP:
                                </strong>{{ $node['PtsPersonal'] ?: 0.0 }}</h1>
                        </div>
                    @endif
                </div>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Izquierdo
                </h5>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Derecho
                </h5>

                <div class="col-span-1  flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1">{{ $node['left'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1">{{ $node['right'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-chart-bar text-xs"></i> Puntos
                        </span>
                        <span class="font-medium pl-1">{{ $node['ptsLeft'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-chart-bar text-xs"></i> Puntos
                        </span>
                        <span class="font-medium pl-1">{{ $node['ptsRight'] ?: 'Vacío' }}</span>
                    </h6>
                </div>
            </div>
        </a>
    @elseif ($node['level'] < 2)
        <a wire:click="show({{ $node['id'] }})" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <div class="grid grid-cols-2 gap-x-2 gap-y-1 p-1">
                <div class="col-span-2 flex items-center justify-center mb-1">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-primary/10 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <h4 class=" text-base sm:text-xl font-bold capitalize text-primary">
                            {{ $node['username'] }}

                        </h4>
                        <h1 class=" text-sm text-ink"> <strong class=" text-primary">PP:
                            </strong>{{ $node['PtsPersonal'] ?: 0.0 }}</h1>
                    </div>
                </div>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Izquierdo
                </h5>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Derecho
                </h5>

                <div class="col-span-1  flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1">{{ $node['left'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1">{{ $node['right'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            Puntos
                        </span>
                        <span class="font-medium pl-1">{{ $node['ptsLeft'] ?: 'Vacío' }}</span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            Puntos
                        </span>
                        <span class="font-medium pl-1">{{ $node['ptsRight'] ?: 'Vacío' }}</span>
                    </h6>
                </div>
            </div>
        </a>
    @elseif ($node['level'] < 3)
        <a wire:click="show({{ $node['id'] }})" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <h4 class="capitalize text-primary">
                {{ $node['username'] }}
            </h4>
        </a>
    @elseif ($node['level'] < 4)
        <a wire:click="show({{ $node['id'] }})" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <h4 class="text-[8px] capitalize text-primary">
                {{ $node['username'] }}
            </h4>
        </a>
    @else
        <a wire:click="show({{ $node['id'] }})">
        </a>
    @endif

    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('livewire.office.children-binary', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>

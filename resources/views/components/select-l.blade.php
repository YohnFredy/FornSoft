@props([
    'for' => '',
    'label' => '',
])

<div class="relative">
    @if ($label)
        <label for="{{ $for }}" class="block mb-2 text-sm font-medium text-primary ">{{ $label }}</label>
    @endif

    <select id="{{ $for }}" name="{{ $for }}"
        {{ $attributes->merge([
            'class' => 'block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg 
                    focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer',
        ]) }}>
        {{ $slot }}
    </select>

    <div class="absolute inset-y-0 right-5 top-8 flex items-center pointer-events-none">
        <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </div>
    @error($for)
        <p class="text-sm text-danger">{{ $message }}</p>
    @enderror
</div>

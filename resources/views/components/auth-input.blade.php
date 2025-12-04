@props([
    'label',
    'name',
    'type' => 'text',
    'icon' => null,
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => null,
    'value' => null,
])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label }}
    </label>
    <div class="relative">
        @if ($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {!! $icon !!}
            </div>
        @endif
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
            value="{{ $value ?? old($name) }}" @if ($required) required @endif
            @if ($autofocus) autofocus @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            class="block w-full {{ $icon ? 'pl-10' : 'pl-3' }} pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
            placeholder="{{ $placeholder }}" {{ $attributes }}>
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>

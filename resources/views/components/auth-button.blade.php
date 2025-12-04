@props(['type' => 'submit'])

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold text-lg rounded-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl']) }}>
    {{ $slot }}
</button>
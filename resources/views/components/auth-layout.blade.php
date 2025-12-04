<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'VibeTix' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center {{ $slot->attributes->get('class', 'py-12') }}"
        style="background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%);">
        <div class="w-full max-w-md px-6 py-8">

            {{-- Logo/Título --}}
            <div class="text-center mb-8">
                <a href="{{ route('events.index') }}" class="inline-block">
                    <h1 class="text-5xl font-bold text-white mb-2">
                        <span class="italic">Vibe</span><span class="font-normal">Tix</span>
                    </h1>
                </a>
                <p class="text-purple-200 text-lg">{{ $subtitle }}</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                {{ $slot }}
            </div>

            {{-- Link de Voltar --}}
            <div class="text-center mt-6">
                <a href="{{ route('events.index') }}"
                    class="inline-flex items-center text-white hover:text-purple-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar para eventos
                </a>
            </div>
        </div>
    </div>
</body>

</html>

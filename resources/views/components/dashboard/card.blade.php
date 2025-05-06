<div class="bg-white rounded-2xl shadow p-6 text-center hover:shadow-lg transition">
    <div class="text-5xl mb-4 {{ $color }}">
        <i class="bi {{ $icon }}"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $text }}</p>
    <a href="{{ $route }}" class="inline-block px-4 py-2 text-white rounded-lg font-medium {{ $btnColor }}">
        {{ $btn }}
    </a>
</div>

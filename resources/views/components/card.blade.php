@props(['title', 'value', 'icon'])

<div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-medium text-gray-500">{{ $title }}</h2>
        <span class="text-xl">{{ $icon }}</span>
    </div>
    <p class="mt-2 text-3xl font-bold text-gray-800">{{ $value }}</p>
</div>

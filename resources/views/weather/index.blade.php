<x-app-layout>
    <x-slot name="header">
        <h2>Weather API</h2>
    </x-slot>

    <div class="p-6">
        <p><strong>City:</strong> {{ $weather['name'] ?? 'N/A' }}</p>
        <p><strong>Temperature:</strong> {{ $weather['main']['temp'] ?? 'N/A' }} °C</p>
        <p><strong>Condition:</strong> {{ $weather['weather'][0]['description'] ?? 'N/A' }}</p>
    </div>
</x-app-layout>
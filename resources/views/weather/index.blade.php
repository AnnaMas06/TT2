<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.weather') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-8">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    🌤 {{ $weather['name'] ?? 'N/A' }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="bg-gray-50 p-5 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Temperature
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $weather['main']['temp'] ?? 'N/A' }} °C
                        </p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Condition
                        </p>

                        <p class="text-xl font-semibold text-gray-800 mt-2">
                            {{ ucfirst($weather['weather'][0]['description'] ?? 'N/A') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Humidity
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $weather['main']['humidity'] ?? 'N/A' }}%
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
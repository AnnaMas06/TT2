<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Reservation System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="bg-white shadow-lg rounded-lg p-10 max-w-3xl text-center">

            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                Equipment Reservation System
            </h1>

            <p class="text-gray-600 text-lg mb-8">
                A web application for browsing equipment, creating reservations and managing availability.
            </p>

            <div class="flex justify-center gap-4 mb-8">
                <a href="{{ route('login') }}"
                   class="bg-gray-800 text-white px-6 py-3 rounded hover:bg-gray-700">
                    {{ __('messages.login') }}
                </a>

                <a href="{{ route('register') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-500">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left mt-8">

                <div class="bg-gray-50 p-5 rounded">
                    <h3 class="font-semibold text-gray-800 mb-2">
                        {{ __('messages.equipment') }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        Browse available equipment and view item details.
                    </p>
                </div>

                <div class="bg-gray-50 p-5 rounded">
                    <h3 class="font-semibold text-gray-800 mb-2">
                        {{ __('messages.reservations') }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        Create reservation requests for selected periods.
                    </p>
                </div>

                <div class="bg-gray-50 p-5 rounded">
                    <h3 class="font-semibold text-gray-800 mb-2">
                        {{ __('messages.weather') }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        View weather information using OpenWeather API integration.
                    </p>
                </div>

            </div>

            <div class="mt-8 text-sm text-gray-500">
                <a href="{{ route('language.switch', 'lv') }}" class="hover:underline">LV</a>
                |
                <a href="{{ route('language.switch', 'en') }}" class="hover:underline">EN</a>
            </div>

        </div>

    </div>

</body>
</html>
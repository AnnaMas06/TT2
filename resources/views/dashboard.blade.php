<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        {{ __('messages.categories') }}
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $categoriesCount }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        {{ __('messages.equipment') }}
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $equipmentCount }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        {{ __('messages.reservations') }}
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $reservationsCount }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        {{ __('messages.users') }}
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $usersCount }}
                    </p>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.reservations') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ __('messages.reservations') }}
                    </h3>

                    <a href="{{ route('reservations.create') }}"
                       class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        {{ __('messages.add_reservation') }}
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">{{ __('messages.equipment') }}</th>
                                <th class="px-4 py-3 text-left">{{ __('messages.start_date') }}</th>
                                <th class="px-4 py-3 text-left">{{ __('messages.end_date') }}</th>
                                <th class="px-4 py-3 text-left">{{ __('messages.status') }}</th>
                                <th class="px-4 py-3 text-left">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr class="border-t">
                                    <td class="px-4 py-3">{{ $reservation->id }}</td>

                                    <td class="px-4 py-3">
                                        {{ $reservation->equipment->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $reservation->start_date }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $reservation->end_date }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @if($reservation->status === 'pending')
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                                {{ __('messages.pending') }}
                                            </span>
                                        @elseif($reservation->status === 'approved')
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                                {{ __('messages.approved') }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                                                {{ __('messages.rejected') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 space-x-2">

                                        <a href="{{ route('reservations.show', $reservation) }}"
                                           class="text-blue-600 hover:underline">
                                            {{ __('messages.view') }}
                                        </a>

                                        @if($reservation->status === 'pending')
                                            <a href="{{ route('reservations.edit', $reservation) }}"
                                               class="text-green-600 hover:underline">
                                                {{ __('messages.edit') }}
                                            </a>

                                            <form action="{{ route('reservations.destroy', $reservation) }}"
                                                  method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-red-600 hover:underline">
                                                    {{ __('messages.cancel') }}
                                                </button>
                                            </form>
                                        @endif

                                        @if(auth()->user()->role &&
                                            in_array(auth()->user()->role->name, ['admin', 'staff']) &&
                                            $reservation->status === 'pending')

                                            <form action="{{ route('reservations.approve', $reservation) }}"
                                                  method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="text-green-700 hover:underline">
                                                    {{ __('messages.approve') }}
                                                </button>
                                            </form>

                                            <form action="{{ route('reservations.reject', $reservation) }}"
                                                  method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="text-red-700 hover:underline">
                                                    {{ __('messages.reject') }}
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
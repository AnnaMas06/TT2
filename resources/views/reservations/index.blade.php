<x-app-layout>
    <x-slot name="header">
        <h2>Reservations</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('reservations.create') }}">
            Create Reservation
        </a>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="10" style="margin-top:20px;">
            <tr>
                <th>ID</th>
                <th>Equipment</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            @foreach($reservations as $reservation)

                <tr>

                    <td>{{ $reservation->id }}</td>

                    <td>{{ $reservation->equipment->name }}</td>

                    <td>{{ $reservation->start_date }}</td>

                    <td>{{ $reservation->end_date }}</td>

                    <td>{{ $reservation->status }}</td>

                    <td>

                        <a href="{{ route('reservations.show', $reservation) }}">
                            View
                        </a>

                        @if($reservation->status === 'pending')

                            <a href="{{ route('reservations.edit', $reservation) }}">
                                Edit
                            </a>

                            <form
                                action="{{ route('reservations.destroy', $reservation) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Cancel
                                </button>

                            </form>

                        @endif
                        @if(auth()->user()->role &&
                            in_array(auth()->user()->role->name, ['admin', 'staff']) &&
                            $reservation->status === 'pending')

                            <form
                                action="{{ route('reservations.approve', $reservation) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf
                                @method('PATCH')

                                <button type="submit">
                                    Approve
                                </button>

                            </form>

                            <form
                                action="{{ route('reservations.reject', $reservation) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf
                                @method('PATCH')

                                <button type="submit">
                                    Reject
                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

            @endforeach

        </table>

    </div>
</x-app-layout>
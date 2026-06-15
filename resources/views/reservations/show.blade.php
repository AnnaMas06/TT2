<x-app-layout>
    <x-slot name="header">
        <h2>Reservation Details</h2>
    </x-slot>

    <div class="p-6">
        <p><strong>Equipment:</strong> {{ $reservation->equipment->name }}</p>
        <p><strong>Start date:</strong> {{ $reservation->start_date }}</p>
        <p><strong>End date:</strong> {{ $reservation->end_date }}</p>
        <p><strong>Status:</strong> {{ $reservation->status }}</p>

        <a href="{{ route('reservations.index') }}">Back</a>
    </div>
</x-app-layout>
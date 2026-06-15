<x-app-layout>
    <x-slot name="header">
        <h2>Edit Reservation</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('reservations.update', $reservation) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Equipment</label><br>
                <select name="equipment_id">
                    @foreach($equipment as $item)
                        <option value="{{ $item->id }}"
                            {{ $reservation->equipment_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Start Date</label><br>
                <input type="date" name="start_date" value="{{ $reservation->start_date }}" required>
            </div>

            <div>
                <label>End Date</label><br>
                <input type="date" name="end_date" value="{{ $reservation->end_date }}" required>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
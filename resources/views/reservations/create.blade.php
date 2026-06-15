<x-app-layout>
    <x-slot name="header">
        <h2>Create Reservation</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST"
              action="{{ route('reservations.store') }}">

            @csrf

            <div>

                <label>Equipment</label><br>

                <select name="equipment_id">

                    @foreach($equipment as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Start Date</label><br>

                <input
                    type="date"
                    name="start_date"
                    required>

            </div>

            <div>

                <label>End Date</label><br>

                <input
                    type="date"
                    name="end_date"
                    required>

            </div>

            <button type="submit">
                Reserve
            </button>

        </form>

    </div>
</x-app-layout>
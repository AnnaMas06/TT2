<x-app-layout>
    <x-slot name="header">
        <h2>Deleted Equipment</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('equipment.index') }}">Back to equipment</a>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="10" style="margin-top:20px;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Deleted at</th>
                <th>Action</th>
            </tr>

            @foreach($equipment as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->deleted_at }}</td>
                    <td>
                        <form method="POST" action="{{ route('equipment.restore', $item->id) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
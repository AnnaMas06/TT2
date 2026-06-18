<x-app-layout>
    <x-slot name="header">
        <h2>Equipment</h2>
    </x-slot>

    <div class="p-6">

        @if(auth()->user()->role && auth()->user()->role->name === 'admin')
            <a href="{{ route('equipment.create') }}">Add equipment</a>
            <a href="{{ route('equipment.deleted') }}">Deleted equipment</a>
        @endif

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <div style="margin-bottom:20px; margin-top:20px;">
            <input
                type="text"
                id="search"
                placeholder="Search equipment...">
        </div>

        <div id="equipmentTable">
            <table border="1" cellpadding="10" style="margin-top:20px;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Public</th>
                    <th>Actions</th>
                </tr>

                @foreach($equipment as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->is_public ? 'Yes' : 'No' }}</td>

                        <td>
                            <a href="{{ route('equipment.show', $item) }}">View</a>

                            @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                                <a href="{{ route('equipment.edit', $item) }}">Edit</a>

                                <form action="{{ route('equipment.destroy', $item) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            fetch('/equipment-search?search=' + this.value)
                .then(response => response.json())
                .then(data => {
                    let html = `
                        <table border="1" cellpadding="10">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    `;

                    data.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.name}</td>
                                <td>${item.category.name}</td>
                                <td>${item.status}</td>
                                <td><a href="/equipment/${item.id}">View</a></td>
                            </tr>
                        `;
                    });

                    html += '</table>';
                    document.getElementById('equipmentTable').innerHTML = html;
                });
        });
    </script>
</x-app-layout>
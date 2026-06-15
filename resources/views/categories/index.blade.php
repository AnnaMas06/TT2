<x-app-layout>
    <x-slot name="header">
        <h2>Categories</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('categories.create') }}">Add new category</a>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="10" style="margin-top: 20px;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category) }}">View</a>
                        <a href="{{ route('categories.edit', $category) }}">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
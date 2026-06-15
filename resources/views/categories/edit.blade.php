<x-app-layout>
    <x-slot name="header">
        <h2>Edit Category</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Name</label><br>
                <input type="text" name="name" value="{{ $category->name }}" required>
            </div>

            <div style="margin-top: 10px;">
                <label>Description</label><br>
                <textarea name="description">{{ $category->description }}</textarea>
            </div>

            <button type="submit" style="margin-top: 10px;">Update</button>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2>Category Details</h2>
    </x-slot>

    <div class="p-6">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Description:</strong> {{ $category->description }}</p>

        <a href="{{ route('categories.index') }}">Back</a>
    </div>
</x-app-layout>
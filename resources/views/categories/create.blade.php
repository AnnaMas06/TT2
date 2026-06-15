<x-app-layout>
    <x-slot name="header">
        <h2>Create Category</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div>
                <label>Name</label><br>
                <input type="text" name="name" required>
            </div>

            <div style="margin-top: 10px;">
                <label>Description</label><br>
                <textarea name="description"></textarea>
            </div>

            <button type="submit" style="margin-top: 10px;">Save</button>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2>Create Equipment</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST"
              action="{{ route('equipment.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div>
                <label>Name</label><br>
                <input type="text" name="name" required>
            </div>

            <div>
                <label>Description</label><br>
                <textarea name="description" required></textarea>
            </div>

            <div>
                <label>Category</label><br>

                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Status</label><br>

                <select name="status">
                    <option value="available">Available</option>
                    <option value="reserved">Reserved</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <div>
                <label>Public</label><br>

                <select name="is_public">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div>
                <label>Image</label><br>
                <input type="file" name="image">
            </div>

            <button type="submit">
                Save
            </button>

        </form>

    </div>
</x-app-layout>
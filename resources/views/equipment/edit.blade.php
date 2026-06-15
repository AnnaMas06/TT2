<x-app-layout>
    <x-slot name="header">
        <h2>Edit Equipment</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST"
              action="{{ route('equipment.update', $equipment) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div>
                <label>Name</label><br>

                <input
                    type="text"
                    name="name"
                    value="{{ $equipment->name }}"
                    required>
            </div>

            <div>
                <label>Description</label><br>

                <textarea
                    name="description"
                    required>{{ $equipment->description }}</textarea>
            </div>

            <div>
                <label>Category</label><br>

                <select name="category_id">

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ $equipment->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>
            </div>

            <div>
                <label>Status</label><br>

                <select name="status">

                    <option value="available"
                        {{ $equipment->status == 'available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="reserved"
                        {{ $equipment->status == 'reserved' ? 'selected' : '' }}>
                        Reserved
                    </option>

                    <option value="maintenance"
                        {{ $equipment->status == 'maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>

                </select>
            </div>

            <div>
                <label>Public</label><br>

                <select name="is_public">

                    <option value="1"
                        {{ $equipment->is_public ? 'selected' : '' }}>
                        Yes
                    </option>

                    <option value="0"
                        {{ !$equipment->is_public ? 'selected' : '' }}>
                        No
                    </option>

                </select>
            </div>

            <div>
                <label>New Image</label><br>
                <input type="file" name="image">
            </div>

            <button type="submit">
                Update
            </button>

        </form>

    </div>
</x-app-layout>
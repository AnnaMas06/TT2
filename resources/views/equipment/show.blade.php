<x-app-layout>
    <x-slot name="header">
        <h2>Equipment Details</h2>
    </x-slot>

    <div class="p-6">

        <p><strong>Name:</strong> {{ $equipment->name }}</p>

        <p><strong>Description:</strong>
            {{ $equipment->description }}
        </p>

        <p><strong>Category:</strong>
            {{ $equipment->category->name }}
        </p>

        <p><strong>Status:</strong>
            {{ $equipment->status }}
        </p>

        <p><strong>Public:</strong>
            {{ $equipment->is_public ? 'Yes' : 'No' }}
        </p>

        @foreach($equipment->images as $image)
            <img
                src="{{ asset('storage/' . $image->path) }}"
                width="300"
                style="margin-top:20px;"
            >
        @endforeach

        <br><br>

        <a href="{{ route('equipment.index') }}">
            Back
        </a>

    </div>
</x-app-layout>
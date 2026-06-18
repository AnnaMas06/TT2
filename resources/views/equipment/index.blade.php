<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.equipment') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ __('messages.equipment') }}
                    </h3>

                    @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                        <div class="space-x-2">
                            <a href="{{ route('equipment.create') }}"
                               class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                                {{ __('messages.add_equipment') }}
                            </a>

                            <a href="{{ route('equipment.deleted') }}"
                               class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                                {{ __('messages.deleted_equipment') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mb-6">
                    <input
                        type="text"
                        id="search"
                        placeholder="{{ __('messages.search') }}..."
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div id="equipmentTable" class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.name') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.categories') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.status') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.public') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($equipment as $item)
                                <tr class="border-t">
                                    <td class="px-4 py-3">{{ $item->id }}</td>
                                    <td class="px-4 py-3">{{ $item->name }}</td>
                                    <td class="px-4 py-3">{{ $item->category->name }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $item->is_public ? __('messages.yes') : __('messages.no') }}
                                    </td>

                                    <td class="px-4 py-3 space-x-2">
                                        <a href="{{ route('equipment.show', $item) }}"
                                           class="text-indigo-600 hover:underline">
                                            {{ __('messages.view') }}
                                        </a>

                                        @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                                            <a href="{{ route('equipment.edit', $item) }}"
                                               class="text-green-600 hover:underline">
                                                {{ __('messages.edit') }}
                                            </a>

                                            <form action="{{ route('equipment.destroy', $item) }}"
                                                  method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-red-600 hover:underline">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            fetch('/equipment-search?search=' + this.value)
                .then(response => response.json())
                .then(data => {
                    let html = `
                        <table class="min-w-full border border-gray-200 rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.name') }}</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.categories') }}</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.status') }}</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    data.forEach(item => {
                        html += `
                            <tr class="border-t">
                                <td class="px-4 py-3">${item.id}</td>
                                <td class="px-4 py-3">${item.name}</td>
                                <td class="px-4 py-3">${item.category.name}</td>
                                <td class="px-4 py-3">${item.status}</td>
                                <td class="px-4 py-3">
                                    <a href="/equipment/${item.id}" class="text-indigo-600 hover:underline">
                                        {{ __('messages.view') }}
                                    </a>
                                </td>
                            </tr>
                        `;
                    });

                    html += `
                            </tbody>
                        </table>
                    `;

                    document.getElementById('equipmentTable').innerHTML = html;
                });
        });
    </script>
</x-app-layout>
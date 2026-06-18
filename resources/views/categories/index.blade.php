<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.categories') }}
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
                        {{ __('messages.categories') }}
                    </h3>

                    <a href="{{ route('categories.create') }}"
                       class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        {{ __('messages.add_category') }}
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">
                                    {{ __('messages.name') }}
                                </th>
                                <th class="px-4 py-3 text-left">
                                    {{ __('messages.description') }}
                                </th>
                                <th class="px-4 py-3 text-left">
                                    {{ __('messages.actions') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                                <tr class="border-t">
                                    <td class="px-4 py-3">
                                        {{ $category->id }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $category->description }}
                                    </td>

                                    <td class="px-4 py-3 space-x-2">

                                        <a href="{{ route('categories.show', $category) }}"
                                           class="text-blue-600 hover:underline">
                                            {{ __('messages.view') }}
                                        </a>

                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="text-green-600 hover:underline">
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:underline">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('messages.user_management') }}</h2>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>{{ __('messages.name') }}</th>
                <th>Email</th>
                <th>{{ __('messages.current_role') }}</th>
                <th>{{ __('messages.change_role') }}</th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? 'No role' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                            @csrf
                            @method('PATCH')

                            <select name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit">{{ __('messages.update') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
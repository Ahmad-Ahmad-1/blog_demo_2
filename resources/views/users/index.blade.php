<x-app-layout title="Manage Users">

    <div>
        <table class="table w-75 m-auto mt-3 w-fit p-2">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            @forelse ($user->getRoleNames() as $role)
                                <span class="badge bg-primary">{{ $role }}</span>
                            @empty
                            @endforelse
                        </td>

                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary fw-bold">Show</a>

                            @if ($user->hasRole('Super Admin'))
                                @if (auth()->user()->hasRole('Super Admin'))
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-primary fw-bold">Edit</a>
                                @endif
                            @else
                                @can('Edit User')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary fw-bold">Edit</a>
                                @endcan
                                @can('Delete User')
                                    @if ($user->id != auth()->user()->id)
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger fw-bold" type="submit">Delete</button>
                                        </form>
                                    @endif
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $users->links() }}

    </div>

</x-app-layout>

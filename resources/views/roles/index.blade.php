<x-app-layout title="Manage Roles">

    @if (session('Role Deletion Success'))
        <div class="alert alert-success w-50 m-auto mt-3 fw-bold">{{ session('Role Deletion Success') }}</div>
    @endif

    <div>

        <div class="text-center mt-3">
            <a class="btn btn-success m-auto" href="{{ route('roles.create') }}">Create Role</a>
        </div>

        <table class="table w-50 m-auto mt-3 w-fit p-2">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $roles->links() }}
    </div>

</x-app-layout>

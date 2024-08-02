<x-app-layout title="Search Results">

    <x-search :action="route('roles.search')" placeholder="Search Roles" />

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

                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3">
                        <span class="text-danger">
                            There is no Role that matches your search!
                        </span>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
        {{ $roles->links() }}
    </div>

</x-app-layout>

<x-app-layout title="{{ $role->name }}">

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">
            <h5 class="card-title fw-bold h4">
                <span>Role:</span>
                <br>
                <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $role->name }}</div>
            </h5>

            <h5 class="card-title fw-bold h4">
                <span>Permissions:</span>
                <br>
                @if ($role->name == 'Super Admin')
                    <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">All</div>
                @else
                    @foreach ($permissions as $permission)
                        <div class="bg-primary p-2 text-white rounded d-inline-block mt-2">{{ $permission }}</div>
                    @endforeach
                @endif
            </h5>
        </div>

        <div class="mt-3">

            <div class="p-3">

                @if ($role->name != 'Super Admin')
                    @can('Edit Role')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-dark">Edit</a>
                    @endcan

                    @can('Delete Role')
                        <form action="{{ route('roles.destroy', $role->id) }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                @endif

                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>

            </div>

        </div>

    </div>

</x-app-layout>

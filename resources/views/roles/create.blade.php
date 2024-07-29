<x-app-layout title="Create Role">

    @if (session('Role Creation Success'))
        <div class="alert alert-success w-50 m-auto mt-3">
            {{ session('Role Creation Success') }}
        </div>
    @endif

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div>
                    <span class="h4">Role:</span>
                    <x-text-input name="name" class="mt-2 mb-2 form-control @error('name') is-invalid @enderror"
                        value="{{ @old('name') }}" />

                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <h5 class="card-title fw-bold h4 mb-2 mt-2">
                        <div>Permissions:</div>
                    </h5>

                    @foreach ($permissions as $permission)
                        <div class="p-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission['name'] }}"
                                id="{{ $permission['name'] }}">
                            <label for="{{ $permission['name'] }}">{{ $permission['name'] }}</label>
                        </div>
                    @endforeach

                    @error('permissions')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success mt-3">Create</button>
            </form>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-success">{{ $error }}</div>
            @endforeach
        @endif

    </div>
</x-app-layout>

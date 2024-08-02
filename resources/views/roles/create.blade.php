<x-app-layout title="Create Role">

    <x-flash-messages type="success" class="w-50" />

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="h4">Role:</label>
                    <x-text-input name="name" id="name" class="mt-2 mb-2 form-control" value="{{ @old('name') }}" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>

                    <div class="fw-bold h4 mb-2 mt-2">Permissions:</div>

                    @foreach ($permissions as $permission)
                        <div class="p-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                id="{{ $permission }}">
                            <label for="{{ $permission }}">{{ $permission }}</label>
                        </div>
                    @endforeach

                    <x-input-error :messages="$errors->get('permissions')" />

                </div>

                <button type="submit" class="btn btn-success mt-3">Create</button>
            </form>
        </div>

    </div>
</x-app-layout>

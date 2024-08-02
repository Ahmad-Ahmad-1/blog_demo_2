<x-app-layout title="Edit {{ $role->name }}">

    <x-flash-messages type="success" class="w-50" />

    <div class="card w-50 m-auto mt-3">

        <div class="card-body">

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('put')

                <div>
                    <label for="{{ $role->name }}" class="h4">Role:</label>
                    <x-text-input name="name" value="{{ $role->name }}"
                        class="form-control mt-2 mb-2" id="{{ $role->name }}" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mt-3">

                    <label for="" class="h4 fw-bold">Permissions:</label>

                    @foreach ($allPermissions as $permission)
                        <div class="p-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                id="{{ $permission }}" @checked(in_array($permission, $rolePermissions))>
                            <label for="{{ $permission }}">{{ $permission }}</label>
                        </div>
                    @endforeach

                    <x-input-error :messages="$errors->get('permissions')" />
                </div>

                <button type="submit" class="btn btn-success mt-3">Update</button>
            </form>
        </div>

    </div>

</x-app-layout>

{{--

    - Laravel form tips:

      * use a Bootstrap card as a container for the form.

      * put every input fields with all of its requirements in a separate div.

      * use all error handling functionalities for each input field (eg.. use
        is-invalid for input fields, text-danger for error messages displayed with
        @error('input') directive).

      * use Laravel components for input fields and not Bootstrap ones, because it's
        more consistent with the whole layout.

      * you don't need to get old form values to input fields in edit form (because you're
        already displaying the original values for resource, but you'll need to do this when
        working with create form because there is no default values for input fields and you
        don't want the user to have to re-enter all data on validation fail for an input field).

      * the @error('input') directive won't display the validation error messages if you don't
        have an input field with the name 'input', while $errors->any() will.

--}}

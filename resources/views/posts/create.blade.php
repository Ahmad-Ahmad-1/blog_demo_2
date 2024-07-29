<x-app-layout title="Create Post">

    <form method="POST" action="{{ route('posts.store') }}" class="w-75 m-auto mt-2" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="title" value="Title" />
            <x-text-input name="title" type="text" id="title" class="form-control" value="{{ @old('title') }}" />
            <x-input-error :messages="$errors->get('title')" />
        </div>

        <div>
            <label for="caption">Caption</label>
            <textarea name="caption" id="caption" cols="30" rows="10"
                class="form-control  @error('caption') is-invalid @enderror"></textarea>
            <x-input-error :messages="$errors->get('caption')" />
        </div>

        <div class="d-block">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror">
            <x-input-error :messages="$errors->get('img')" />
        </div>

        <button type="submit" class="btn btn-success mt-3">Create</button>

    </form>

</x-app-layout>

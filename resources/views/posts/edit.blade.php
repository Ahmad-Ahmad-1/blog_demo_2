<x-app-layout>

    <form method="POST" action="{{ route('posts.update', [$post->id]) }}" class="w-75 m-auto mt-2"
        enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <x-input-label for="title">Title</x-input-label>
            <x-text-input name="title" type="text" id="title" class="form-control" value="{{ $post->title }}" />
            <x-input-error :messages="$errors->get('title')" />
        </div>

        <div>
            <label for="caption">Caption</label>
            <textarea name="caption" id="caption" cols="30" rows="10" class="form-control">
                {{ $post->caption }}
            </textarea>
            <x-input-error :messages="$errors->get('caption')" />
        </div>

        @if ($post->getFirstMediaUrl('imgs'))
            <div style="card-img-top">
                <span>Post Image</span>
                <img src="{{ $post->getFirstMediaUrl('imgs') }}" alt="Image doesn't exist">
            </div>

            <div>
                <label for="img">New Image</label>
                <input type="file" name="img" class="form-control" id="img">
                <x-input-error :messages="$errors->get('img')" />
            </div>
        @else
            <div>
                <label for="img">Add Image</label>
                <input type="file" name="img" class="form-control" id="img">
                <x-input-error :messages="$erros->get('img')" />
            </div>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Update</button>

    </form>

</x-app-layout>

<x-app-layout title="{{ $post->title }}">

    <div class="card w-50 m-auto mt-3">

        @if ($post->getFirstMediaUrl('imgs'))
            <img src="{{ $post->getFirstMediaUrl('imgs') }}" class="card-img-top" alt="Image does not exist">
        @endif

        <div class="card-body">
            <h5 class="card-title fw-bold h4">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->caption }}</p>
        </div>

        <div class="mt-3">
            @can(['create post', 'edit post', 'delete post'])
                <div class="p-3">

                    <a href="{{ route('posts.edit', [$post->id]) }}" class="btn btn-success">Edit</a>

                    <form action="{{ route('posts.destroy', [$post->id, request()->route('redirect')]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            @endcan
        </div>

    </div>

</x-app-layout>

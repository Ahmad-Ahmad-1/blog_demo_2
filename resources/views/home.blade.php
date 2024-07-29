<x-app-layout title="Home">

    <div class="mt-4 mb-4 text-center h4">
        <span class="bg-black rounded fw-bold text-white p-2">Latest Posts</span>
    </div>

    @if (session('status'))
        <div class="alert alert-success w-75 m-auto mt-3 fw-bold">{{ session('status') }}</div>
    @endif

    <table class="table w-75 m-auto mt-3 w-fit p-2">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Posted By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>

                    <td>
                        <a href="{{ route('posts.show', [$post->id, 'home']) }}" class="btn btn-primary fw-bold">Read
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="text-danger">
                            No Posts Yet!
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @if ($posts->isNotEmpty())
            <tfoot>
                <tr>
                    <td colspan="4">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">See All</a>
                    </td>
                </tr>
            </tfoot>
        @endif

    </table>

</x-app-layout>

@props(['type'])

@if (session('status'))
    @if (is_array(session('status')))
        @foreach (session('status') as $status)
            <div {{ $attributes->merge(['class' => "alert alert-$type m-auto mt-3 fw-bold"]) }}>
                {{ $status }}
            </div>
        @endforeach
    @else
        <div {{ $attributes->merge(['class' => "alert alert-$type m-auto mt-3 fw-bold"]) }}
            class="alert alert-{{ $type }} m-auto mt-3 fw-bold">
            {{ session('status') }}
        </div>
    @endif
@endif

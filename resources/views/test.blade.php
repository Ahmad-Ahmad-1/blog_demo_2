<x-app-layout title="Test">

    <div>
        <div style="background-color: yellow;">{{ $post->getFirstMediaUrl('imgs') }}</div>
        <img src="{{ $post->getFirstMediaUrl('imgs') }}" alt="Image doesn't exist">
    </div>

</x-app-layout>

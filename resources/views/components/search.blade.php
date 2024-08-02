@props(['action', 'placeholder'])

<nav class="navbar m-auto mt-3 d-flex justify-content-center flex-column">
    <form action="{{ $action }}" method="GET" class="d-flex" role="search">
        <x-text-input class="form-control me-2" type="text" name="search" placeholder="{{ $placeholder }}"
            aria-label="Search" required />
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</nav>

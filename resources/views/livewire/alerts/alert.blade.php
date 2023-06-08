@if (session()->has("{$type}.message"))
    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        {{ session( "{$type}.message" ) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

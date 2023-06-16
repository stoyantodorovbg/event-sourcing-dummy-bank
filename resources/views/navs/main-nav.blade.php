<nav class="navbar navbar-expand-lg navbar-light bg-light m-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('home.home') }}">
                    <button type="button" class="btn btn-primary m-1">Home</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('credits.index') }}">
                    <button type="button" class="btn btn-primary m-1">Credits</button>
                </a>
            </li>
            @foreach($modalLinks ?? [] as $link)
                <li class="nav-item">
                    <button type="button"
                            class="btn btn-primary m-1"
                            data-bs-toggle="modal"
                            data-bs-target="#{{ $link['modalId'] }}"
                    >
                        {{ $link['name'] }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

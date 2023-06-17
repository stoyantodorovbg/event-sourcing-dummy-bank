<nav class="navbar navbar-expand-lg navbar-light bg-light ml-3 mr-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach($modalLinks ?? [] as $link)
                <li class="nav-item ">
                    <button type="button"
                            class="btn btn-primary btn-sm m-1"
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

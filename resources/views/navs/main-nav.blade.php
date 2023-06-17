<nav class="navbar navbar-expand-lg navbar-light bg-light ml-3 mr-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('home.home') }}">
                    <button type="button" class="btn btn-light m-1">Home</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('accounts.index') }}">
                    <button type="button" class="btn btn-light m-1">Accounts</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('credits.index') }}">
                    <button type="button" class="btn btn-light m-1">Credits</button>
                </a>
            </li>
        </ul>
    </div>
</nav>

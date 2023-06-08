<nav class="navbar navbar-expand-lg navbar-light bg-light m-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link p-0" href="{{ route('credits.index') }}">
                    <button type="button" class="btn btn-primary m-1">Credits</button>
                </a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#createCreditModal">
                    Create Credit
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
                    Create Payment
                </button>
            </li>
        </ul>
    </div>
</nav>

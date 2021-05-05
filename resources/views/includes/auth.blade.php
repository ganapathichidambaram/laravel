@auth
<ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#!">Settings</a>
            <a class="dropdown-item" href="#!">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
@else
@if (Route::has('login'))
    <a href="{{ route('login') }}" class="btn btn-primary" role="button">Login</a>&nbsp;
@endif
@if (Route::has('register'))
    <a  href="{{ route('register') }}" class="btn btn-primary" role="button">Register</a>&nbsp;
@endif
@endauth
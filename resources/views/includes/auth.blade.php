@if (Route::has('login'))
    <div class="top-right links">
    @auth
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
@else
        <a href="{{ route('login') }}" class="btn btn-primary" role="button">Login</a>&nbsp;
    @if (Route::has('register'))
        <a  href="{{ route('register') }}" class="btn btn-primary" role="button">Register</a>&nbsp;
    @endif
    
    @endauth
    </div>
@endif

{{-- Alternative Login Link with Nav Link class --}}
{{--
@if (Route::has('login'))    
    <ul class="navbar-nav">
    @auth
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
@else
        <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
        </li> 
    @if (Route::has('register'))
        <li class="nav-item">
        <a href="{{ route('register') }}" class="nav-link">Register</a>
        </li>
    @endif
    @endauth
    </ul>
@endif
--}}

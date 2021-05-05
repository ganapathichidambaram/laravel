<nav class="navbar navbar-expand navbar-dark bg-dark sb-topnav">
    <a class="navbar-brand" href="{{ url('/') }}">Product Name</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 @auth @else invisible @endauth" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    @include("includes.search")
    @include("includes.auth")
</nav>
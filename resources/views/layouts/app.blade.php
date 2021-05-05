<!doctype html>
<html lang="en">
  @include("includes.header")
<body class="sb-nav-fixed @auth @else sb-sidenav-toggled @endauth">
  @include("includes.nav")  
  
  <div id="layoutSidenav">
    @include("includes.left_nav") 
      <div id="layoutSidenav_content">
        <main >
          @yield("content")
        </main>
        @include("includes.footer")
      </div>
  </div>
  @include("includes.footer-scripts")

</body>
</html>

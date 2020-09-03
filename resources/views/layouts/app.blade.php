<!doctype html>
<html lang="en">
  @include("includes.header")
<body>
  @include("includes.nav")  
  
  <main role="main">

  @yield("content")

  </main>
  
  <hr>  
  @include("includes.footer")
  @include("includes.footer-scripts")
</body>
</html>

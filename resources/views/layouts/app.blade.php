<!doctype html>
<html lang="en">
  @include("includes.header")
<body>
  @include("includes.nav")  
  
  <main role="main">

  @yield("content")

  </main>
  
  @include("includes.footer")
  @include("includes.footer-scripts")
</body>
</html>

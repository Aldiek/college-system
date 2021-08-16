<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel" style="max-width: 100%;
    overflow-x: hidden;">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.footer')
  </div>
</div>
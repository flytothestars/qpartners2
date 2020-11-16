<!DOCTYPE html>
<html lang="en-US">

@include('index.layout.app')

<body class="home page-template page-template-tpl page-template-front-page page-template-tplfront-page-php page page-id-262  has-topbar header_sticky wide sidebar-left bottom-center wpb-js-composer js-comp-ver-5.1.1 vc_responsive">

<div class="themesflat-boxed">
  <!-- Preloader -->
  <div class="preloader">
    <div class="clear-loading loading-effect-2">
      <span></span>
    </div>
  </div>

  @include('index.layout.header')

  @yield('content')

  @include('index.layout.footer')

</div>


<script src="/new_design/js/jquery.js"></script>
<!-- include jQuery -->
<script src="/new_design/js/plugins.js"></script>
<!-- include jQuery -->
<script src="/new_design/js/jquery.main.js"></script>

@yield('js')

</body>
</html>
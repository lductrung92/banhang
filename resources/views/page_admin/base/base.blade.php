<!DOCTYPE html>
<html lang="en">
<head>
  <base href="{{ asset('/') }}"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Global stylesheets -->
  <link href="assets/plugin/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
  @yield('global_css')
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  @yield('core_js')
  <!-- /core JS files -->

  <!-- Theme JS files -->
  @yield('theme_js')
  <script type="text/javascript" src="assets/plugin/assets/js/pages/layout_fixed_native.js"></script>
  <!-- /theme JS files -->

</head>

<body class="navbar-top">

<!-- Main navbar -->
@include('page_admin.base.top_nav')
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

  <!-- Page content -->
  <div class="page-content">

    <!-- Main sidebar -->
    @include('page_admin.base.sidebar')
    <!-- /main sidebar -->

    <!-- Main content -->
    @yield('content')
    <!-- /main content -->

  </div>
  <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>

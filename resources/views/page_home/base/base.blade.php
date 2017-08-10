<!DOCTYPE html>
<html>
<head>
    <base href="{{ asset('/') }}" />
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0' name='viewport' />
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/jquery-migrate-1.2.0.js"></script>
    
    <link href='assets/lib/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <link href='assets/lib/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
    <link href='css/owl-carousel.css' rel='stylesheet' type='text/css' />
    <link href='css/styles.css' rel='stylesheet' type='text/css' />
    <link href='css/responsive.css' rel='stylesheet' type='text/css' />
</head>

<body class="chir_home">
    <!-- start desktop -->
    <div class="chir-page">
        @include('page_home.base.header')
        @include('page_home.base.main-menu')
        @include('page_home.base.slider.base')
        
        @yield('content')

        @include('page_home.base.footer')
    </div>
    <!-- end desktop -->


    <!-- start scroll -->
    <div class="fixedItem backtop">
        <a href="javascript:void(0)"><img src="css/images/top.png" alt="Super store" /></a>
    </div>
    <div class="fixedItem cart">
        <a href="/cart"><img src="css/images/icon_cart_mb.png" alt="Super store" /></a>
    </div>
    <!-- end scroll -->


    <!-- start mobile -->
    @include('page_home.base.mobile.base')
    <!-- end mobile -->


    <!-- plugin -->
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/bootstrap.min.js"></script>
    <script src='js/plugin/owl-carousel.js' type='text/javascript'></script>
    <script src='js/plugin/countdown.js' type='text/javascript'></script>
    <!-- custom -->
    <script src='js/scripts.js' type='text/javascript'></script>

</body>

</html>
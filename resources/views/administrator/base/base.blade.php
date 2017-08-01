<!doctype html>
<html>
<head>
    <base href="{{ asset('/') }}" />
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    
    @yield('lib-css')

  </head>

<body class="  ">
    <div class="bg-dark dk" id="wrap">
        <div id="top">
            @include('administrator.base.top')

            @include('administrator.base.header')
        </div>
        @include('administrator.base.sidebar')

        @yield('content')
    </div>
    
    <footer class="Footer bg-dark dker">
        <p>2017 &copy; Design by TrungLe</p>
    </footer>
    <!-- /#footer -->
    
    @yield('lib-js')
</body>
</html>

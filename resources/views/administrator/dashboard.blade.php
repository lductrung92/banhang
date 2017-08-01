@extends('administrator.base.base')

@section('title', 'Trang quản trị')

@section('lib-css')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="assets/lib/onoffcanvas/onoffcanvas.css">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate.css/animate.css">

    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>

    <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>
@endsection

@section('content')
<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="col-lg-12">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('lib-js')
    <!--jQuery -->
    <script src="assets/lib/jquery/jquery.js"></script>
    <!--Bootstrap -->
    <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
    <!-- MetisMenu -->
    <script src="assets/lib/metismenu/metisMenu.js"></script>
    <!-- onoffcanvas -->
    <script src="assets/lib/onoffcanvas/onoffcanvas.js"></script>
    <!-- Screenfull -->
    <script src="assets/lib/screenfull/screenfull.js"></script>


    <!-- Metis core scripts -->
    <script src="assets/js/core.js"></script>
    <!-- Metis demo scripts -->
    <script src="assets/js/app.js"></script>

    <script src="assets/js/style-switcher.js"></script>
@endsection
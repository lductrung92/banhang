@extends('page_admin.base.base')

@section('title', 'Cài đặt hiển thị')

@section('global_css')
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/css/notifier.css">
@endsection

@section('core_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/session/jquery.session.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/styling/switchery.min.js"></script>
@endsection

@section('theme_js')
    <script type="text/javascript" src="assets/plugin/assets/js/core/app.js"></script>
    <!-- Custom  -->
@endsection

@section('content')
    @if(Session::has('messages'))
        <script>
        window.onload = function() {
            $.notifier('{{ Session::has('type') ? Session::get('type') : 'success' }}','Thông báo','{{ Session::get('messages') }}','1500');
        };
        </script>
    @endif
    <script>
        window.onload = function() {
            if($.session.get('messages'))
                $.notifier('success', 'Thông báo', $.session.get('messages'),'1500');
                $.session.clear();
        };
    </script>
@endsection
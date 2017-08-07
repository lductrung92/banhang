@extends('page_admin.base.base')

@section('title', 'Quản lý san phẩm')

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
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/blockui.min.js"></script>
@endsection

@section('theme_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/app.js"></script>
    <!-- Custom  -->
    <script src="assets/sortable/jquery-sortable-lists.js"></script>
    <script src="assets/custom/handle-form.js"></script>
    <script src="assets/custom/product.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
    <!-- Page header -->
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sản phẩm</span> - danh sách</h4>
                </div>

                 <div class="heading-elements">
                    <div class="heading-btn-group">
                        <a href="{{ route('getInsertProduct') }}" type="button" class="btn btn-success"><i class="icon-add position-left"></i> Thêm mới</a>
                    </div>
                </div> 
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">
            
             

            <!-- Footer -->
            <div class="footer text-muted">
                &copy; 2018. <a href="#">Ecommerce</a> by <a href="#" target="_blank">Trung Lê</a>
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->
    </div>
    @if(Session::has('messages'))
        <script>
        window.onload = function() {
            $.notifier('{{ Session::has('type') ? Session::get('type') : 'success' }}','Thông báo','{{ Session::get('messages') }}','1500');
        };
        </script>
    @endif
@endsection
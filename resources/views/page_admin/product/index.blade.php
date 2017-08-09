@extends('page_admin.base.base')

@section('title', 'Quản lý sản phẩm')

@section('global_css')
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/plugin/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="assets/fancybox/dist/jquery.fancybox.min.css">
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
    <!-- Fancybox -->
    <script src="assets/fancybox/dist/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/app.js"></script>
    <!-- Custom  -->
    <script src="assets/custom/handle-form.js"></script>
    <script>
        var selSearch = '{{ showOptionCateChilds($cateops) }}';
    </script>
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
             <!-- List-->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Danh sách</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>

                <table id="dataTable" class="table datatable-basic table-bordered dataTable no-footer">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tiêu đề</th>
                            <th>Link SEO</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Nổi bật</th>
                            <th>Ảnh sản phẩm</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
             <!-- List-->
             

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
    <script>
        function viewImages(id) {
            if($('td div#viewImages-' + id).find('a:nth-child(2)').length) {
                $('td div#viewImages-' + id).find('a:nth-child(2)').trigger('click');
            } else {
                $('td div#viewImages-' + id).load('administrator/product/viewImages/' + id, function() {
                    if($(this).find('a:nth-child(2)').length) 
                    {
                        $(this).find('a:nth-child(2)').trigger('click');
                    }
                    else 
                    {
                        $.notifier('warning', 'Thông báo', 'Sản phẩm này không có ảnh', 1500);
                    }
                    
                });
            }
        }    
    </script>
@endsection
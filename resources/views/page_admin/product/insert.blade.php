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
    
    <!-- notifier.css stylesheet -->
    <link rel="stylesheet" href="assets/css/notifier.css">
    <!-- Jcrop -->
    <link rel="stylesheet" href="assets/jcrop/css/jquery.Jcrop.min.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="assets/fancybox/dist/jquery.fancybox.min.css">
    <!-- product.css stylesheet -->
    <link rel="stylesheet" href="css/product.css">
@endsection

@section('core_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <!--  ckeditor  -->
    <script src="assets/ckeditor/ckeditor.js"></script>
    <!-- dropzone -->  
    <script src="assets/dropzone/min/dropzone.min.js"></script>
    <!-- jcrop -->  
    <script src="assets/jcrop/js/jquery.Jcrop.min.js"></script>
    <!-- Fancybox -->
    <script src="assets/fancybox/dist/jquery.fancybox.min.js"></script>
@endsection

@section('theme_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/app.js"></script>
    <!-- Custom  -->
    <script>
        var cache_files = [];
    </script>
    <script src="assets/sortable/jquery-sortable-lists.js"></script>
    <script src="assets/custom/handle-form.js"></script>
    <script src="assets/custom/product-insert.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
    <!-- Page header -->
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sản phẩm</span> - thêm mới</h4>
                </div>
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form class="form-horizontal" id="formCreateProduct" action="{{ route('postInsertCate') }}" method="post">
                                <input type='hidden' name='_token' value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Danh mục</label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5" name="selCate">
                                            <option value="0">-- Chọn danh mục --</option>
                                            {{ showOptionCateChilds($cateops) }}
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="text" class="col-lg-2 control-label">Tên sản phẩm</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="txtNameProduct" placeholder="Nhập tên sản phẩm" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="col-lg-2 control-label">Tiêu đề</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="txtNameTitle" placeholder="Nhập tên tiêu đề sản phẩm" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" name="checkStatus" class="switchery" checked="checked">
                                                Hiển thị
                                            </label>
										</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="col-lg-2 control-label">Link SEO</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="txtSlug" placeholder="Nhập link seo" class="form-control">
                                        <p class="help-block"><i>* Nhập không dấu cách nhau bằng ký tự '-'</i></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="col-lg-2 control-label">Giá</label>
                                    <div class="col-lg-9">
                                            <input type="text" class="form-control" name="txtPrice" placeholder="Nhập giá sản phẩm" data-mask="VNĐ">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>  
                </div>

                <div class="panel-body" style="padding-top: 0px">
                    <div class="col-lg-12">
                        <label class="col-lg-1 control-label">Mô tả</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="desProduct" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
                        </div>
                    </div> 
                </div>  

                <div class="panel-body" style="padding-top: 0px">
                    <div class="col-lg-12">
                        <label class="col-lg-1 control-label">Ảnh</label>
                        <div class="col-lg-10">
                            <div id="imageUpload"></div>
                        </div>
                    </div> 
                </div> 

                <div class="panel-body" style="padding-top: 0px">
                    <div class="col-lg-12">
                        <div class="text-right" style="margin-bottom: 20px;">
                            <input type="submit" class="btn btn-primary" id="btnCreateProduct" value="Thêm mới">
                            <input type="button" class="btn btn-warning" id="btnResetCreate" value="Làm mới">
                        </div>
                    </div> 
                </div> 
            </div>

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
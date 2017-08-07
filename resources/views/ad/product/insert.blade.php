@extends('administrator.base.base')

@section('title', 'Thêm mới sản phẩm')

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

    <!-- Jcrop -->
    <link rel="stylesheet" href="assets/jcrop/css/jquery.Jcrop.min.css">

    {{--  <link rel="stylesheet" href="assets/dropzone/min/dropzone.min.css">  --}}

    <!-- Fancybox -->
    <link rel="stylesheet" href="assets/fancybox/dist/jquery.fancybox.min.css">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate.css/animate.css">

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/css/notifier.css">

    <!-- product.css stylesheet -->
    <link rel="stylesheet" href="css/product.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">

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

@section('main-bar')
<div class="main-bar">
    <h3>
        <i class="fa fa-magic"></i>&nbsp;Thêm mới sản phẩm
    </h3>
</div>
@endsection

@section('content')

<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="fa fa-edit"></i></div>
                            <h5>Thêm mới danh mục</h5>
                            <!-- .toolbar -->
                            <div class="toolbar">
                                <nav style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </nav>
                            </div>            
                            <!-- /.toolbar -->
                        </header>

                        <div id="div-1" class="body">
                            <form class="form-horizontal" id="formCreateProduct" action="{{ route('postInsertCate') }}" method="post">
                                <input type='hidden' name='_token' value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Danh mục</label>
                                    <div class="col-lg-6">
                                        <select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5" name="selCate">
                                            <option value="0">-- Chọn danh mục --</option>
                                            {{ showOptionCateChilds($cateops) }}
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                
                                <div class="form-group @if ($errors->has('txtNameProduct')) has-error @endif">
                                    <label for="text" class="control-label col-lg-3">Tên sản phẩm</label>

                                    <div class="col-lg-6">
                                        <input type="text" name="txtNameProduct" placeholder="Nhập tên sản phẩm" class="form-control">
                                        @if ($errors->has('txtNameProduct')) <p class="help-block">{{ $errors->first('txtNameProduct') }}</p> @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-3">Tiêu đề</label>

                                    <div class="col-lg-6">
                                        <input type="text" name="txtNameTitle" placeholder="Nhập tên tiêu đề sản phẩm" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-3"></label>
                                    <div class="col-lg-6">
                                        <div class="checkbox anim-checkbox" style="padding: 0px">
                                            <input type="checkbox" name="checkStatus" id="ch3" class="success" checked>
                                            <label for="ch3">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-3">Link SEO</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="txtSlug" placeholder="Nhập link seo" class="form-control">
                                        <p class="help-block"><i>* Nhập không dấu cách nhau bằng ký tự '-'</i></p>
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('txtPrice')) has-error @endif">
                                    <label for="text" class="control-label col-lg-3">Giá</label>

                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtPrice" placeholder="Nhập giá sản phẩm" data-mask="VNĐ">
                                            <span class="input-group-addon">VNĐ</span>
                                            @if($errors->has('txtPrice'))
                                                <p class="help-block">{{ $errors->first('txtPrice') }}</p> 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-1">Mô tả</label>

                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="desProduct" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="body" style="box-shadow:none">
                            <label class="control-label col-lg-1">Ảnh</label>
                            <div class="col-lg-10" id="imageUpload" style="padding: 0;">
                                
                            </div>

                            <div class="text-right" style="margin-bottom: 20px;">
                                <input type="submit" class="btn btn-primary btn-flat" value="Thêm mới">
                                <input type="button" class="btn btn-warning btn-flat" id="btnResetCreate" value="Làm mới">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <!-- /.inner -->
    </div>
<!-- /.outer -->
</div>

<div id="preview-template" style="display: none;">
    <div class="dz-preview dz-image-preview ng-scope pull-left">
        <div class="dz-details sn-div-img">
            <img data-dz-thumbnail>
            <a class="sn-delete-img-btn" href="javascript:undefined;" title="XÃ³a" data-dz-remove ><i style="cursor: pointer; color: red" class="icon-x"></i></a>
            <a class="btn sn-edit-img-btn" href="#sn-edit-img-btn" style="bottom: -92px;border-radius: 50%!important;cursor: pointer" data-toggle="tooltip" data-placement="right" title="Chá»‰nh sá»­a">
                <i style="cursor: pointer" class="fa fa-pencil" style="font-size: 14px"></i></a>
        </div>
    </div>
</div>


@endsection

@section('lib-js')
    <script>
        var listIdChange = [];
    </script>
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!--Bootstrap -->
    <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
    <!-- MetisMenu -->
    <script src="assets/lib/metismenu/metisMenu.js"></script>
    <!-- onoffcanvas -->
    <script src="assets/lib/onoffcanvas/onoffcanvas.js"></script>
    <!-- Screenfull -->
    <script src="assets/lib/screenfull/screenfull.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- Metis core scripts -->
    <script src="assets/js/core.js"></script>
    <!-- Metis demo scripts -->
    <script src="assets/js/app.js"></script>

    <!--  ckeditor  -->
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <!-- dropzone -->  
    <script src="assets/dropzone/min/dropzone.min.js"></script>

    <!-- jcrop -->  
    <script src="assets/jcrop/js/jquery.Jcrop.min.js"></script>

    <!-- Fancybox -->
    <script src="assets/fancybox/dist/jquery.fancybox.min.js"></script>

    <!-- Loader -->
    <script src="assets/loader/blockui.min.js"></script>

    <!-- Custom  -->.
    <script src="assets/sortable/jquery-sortable-lists.js"></script>
    <script src="assets/custom/handle-form.js"></script>
    <script src="assets/custom/product-insert.js"></script>

    @if(Session::has('messages'))
        <script>
            $.notifier('{{ Session::has('type') ? Session::get('type') : 'success' }}','Thông báo','{{ Session::get('messages') }}','1500');
        </script> 
    @endif
    <script src="assets/js/style-switcher.js"></script>
@endsection
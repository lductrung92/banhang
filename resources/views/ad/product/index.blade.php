@extends('administrator.base.base')

@section('title', 'Quản lý sản phẩm')

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

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/css/notifier.css">

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
        <i class="fa fa-magic"></i>&nbsp;Sản phẩm
    </h3>
</div>
@endsection

@section('content')

<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Bảng danh mục</h5>
                            <div style="padding: 0px; float: right; margin: 4px;">
                                <a href="{{ route('getInsertProduct') }}" type="button" class="btn btn-primary btn-flat"><i class="fa fa-plus-circle"></i> Thêm</a>
                            </div>
                        </header>
                        <div id="collapse4" class="body">
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th class='hidden'></th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Link SEO</th>
                                    <th>Danh mục cha</th>
                                    <th class='hidden'></th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>                
                            </table>
                            
                            <!-- Form Update-->
                            <div class="modal fade" id="formUpdateCate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="labelFormUpdate">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" method="post">
                                                <input type='hidden' name='_token' value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3">Danh mục</label>
                                                    <div class="col-lg-8">
                                                        <select data-placeholder="Chọn danh mục" name="selCate" class="form-control chzn-select" tabindex="5">
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->

                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Tên danh mục</label>

                                                    <div class="col-lg-8">
                                                        <input type="text" name="txtNameCate" placeholder="Nhập tên danh mục" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Link SEO</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="txtSlug" placeholder="Nhập link seo" class="form-control">
                                                        <p class="help-block"><i>* Nhập không dấu cách nhau bằng ký tự '-'</i></p>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                                
                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Mô tả</label>

                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3"></label>
                                                    <div class="col-lg-8">
                                                        <div class="checkbox anim-checkbox" style="padding: 0px">
                                                            <input type="checkbox" id="ch4" name="checkStatus" class="success">
                                                            <label for="ch4">Hiển thị</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary btn-flat" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Watting" id="btnSubmitUpdate">Cập nhật</button>
                                                    <input type="button" class="btn btn-warning btn-flat" value="Làm mới" id="btnResetUpdate">
                                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Form Update-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
<!-- /.outer -->
</div>
@endsection

@section('lib-js')
    <script>
        var listIdChange = [];
    </script>
    <!--jQuery -->
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
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

    <!-- Custom  -->.
    <script src="assets/sortable/jquery-sortable-lists.js"></script>
    <script src="assets/custom/handle-form.js"></script>
    <script src="assets/custom/product.js"></script>

    @if(Session::has('messages'))
        <script>
            $.notifier('{{ Session::has('type') ? Session::get('type') : 'success' }}','Thông báo','{{ Session::get('messages') }}','1500');
        </script> 
    @endif

    <script src="assets/js/style-switcher.js"></script>
@endsection
@extends('administrator.base.base')

@section('title', 'Quản lý danh mục')

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

    <style type="text/css">
       
        ul, li {
            list-style-type:none;
        }

        #tree_panel li{
            margin:3px; 
            cursor: move;
        }

        li div {
            padding:7px;
            background-color:#e1f1e6;
            border-radius: 3px;
           
        }
        .c1 { color: #f77720;cursor: pointer;}
        .c2 { color: #b5e853;cursor: pointer; }

    </style>

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
        <i class="fa fa-magic"></i>&nbsp;Danh mục sản phẩm
    </h3>
</div>
@endsection

@section('content')

<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-6">
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
                            <form class="form-horizontal" id="formCreateCate" action="{{ route('postInsertCate') }}" method="post">
                                <input type='hidden' name='_token' value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Danh mục</label>
                                    <div class="col-lg-8">
                                        <select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5" name="selCate">
                                            <option value="0">-- Chọn danh mục --</option>
                                            {{ showOptionCategories($cateops) }}
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                
                                <div class="form-group @if ($errors->has('txtNameCate')) has-error @endif">
                                    <label for="text" class="control-label col-lg-4">Tên danh mục</label>

                                    <div class="col-lg-8">
                                        <input type="text" name="txtNameCate" placeholder="Nhập tên danh mục" class="form-control">
                                        @if ($errors->has('txtNameCate')) <p class="help-block">{{ $errors->first('txtNameCate') }}</p> @endif
                                    </div>
                                </div>
                                <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-4">Mô tả</label>

                                    <div class="col-lg-8">
                                        <textarea class="form-control" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-4"></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox anim-checkbox" style="padding: 0px">
                                            <input type="checkbox" name="checkStatus" id="ch3" class="success" checked>
                                            <label for="ch3">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-grad" value="Thêm mới">
                                    <input type="button" class="btn btn-warning btn-grad" id="btnResetCreate" value="Làm mới">
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="box inverse">
                        <header>
                            <div class="icons"><i class="fa fa-th-large"></i></div>
                            <h5>Cây danh mục</h5>
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
                            </div>    <!-- /.toolbar -->
                        </header>
                        <div id="div-2" class="body">
                            
                            <ul class="tree_panel listsClass" id="tree_panel">
                                {{ showListCategories($catels) }}
                            </ul>
                            <div class="text-right">
                                <button class="btn btn-primary btn-grad" id="updateSortList" data-original-title="" title="">Lưu</button>
                                <button class="btn btn-danger btn-grad" data-original-title="" title="">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Bảng danh mục</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th class='hidden'></th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Danh mục cha</th>
                                    <th class='hidden'></th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($catetbs as $cate)
                                    <tr>
                                        <td class='hidden'>{{ $cate->id }}</td>
                                        <td>{{ $cate->name }}</td>
                                        <td>{{ $cate->description }}</td>
                                        <td>@if($cate->parent) {{ $cate->parent->name }} @endif</td>
                                        <td class='hidden'>@if($cate->parent) {{ $cate->parent->id }} @endif</td>
                                        <td>{{ $cate->status === 1 ? 'Hiển thị' : 'Không hiển thị' }}</td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button>
                                            <a href='administrator/category/delete/{{ $cate->id }}' class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
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
                                                        <select data-placeholder="Chọn danh mục" id="cateU" name="selCate" class="form-control chzn-select" tabindex="5">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->

                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Tên danh mục</label>

                                                    <div class="col-lg-8">
                                                        <input type="text" id="nameCateU" name="txtNameCate" placeholder="Nhập tên danh mục" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                                
                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Mô tả</label>

                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" id="desCateU" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
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
                                                    <button type="button" class="btn btn-primary btn-grad" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Watting" id="btnSubmitUpdate">Cập nhật</button>
                                                    <input type="button" class="btn btn-warning btn-grad" value="Làm mới" id="btnResetUpdate">
                                                    <button type="button" class="btn btn-danger btn-grad" data-dismiss="modal">Close</button>
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
    <script src="assets/custom/category.min.js"></script>

    @if(Session::has('messages'))
        <script>
            $.notifier('{{ Session::has('type') ? Session::get('type') : 'success' }}','Thông báo','{{ Session::get('messages') }}','1500');
        </script> 
    @endif

    <script src="assets/js/style-switcher.js"></script>
@endsection
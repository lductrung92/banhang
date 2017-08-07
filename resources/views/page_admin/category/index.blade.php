@extends('page_admin.base.base')

@section('title', 'Quản lý danh mục')

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
@endsection

@section('core_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script>
        var listIdChange = [];
        
    </script>
@endsection

@section('theme_js')
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/plugin/assets/js/core/app.js"></script>
    <!-- Custom  -->
    <script src="assets/sortable/jquery-sortable-lists.js"></script>
    <script src="assets/custom/handle-form.js"></script>
    <script src="assets/custom/category.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
    <!-- Page header -->
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Danh mục</span> - quản lý</h4>
                </div>

                <!-- <div class="heading-elements">
                    <div class="heading-btn-group">
                        <a href="administrator/product/create" type="button" class="btn btn-success"><i class="icon-add position-left"></i> Thêm mới</a>
                        <button type="button" class="btn btn-primary"><i class=" icon-file-excel position-left"></i> Xuất Excel</button>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">
            
            <!-- Insert Form-->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-pen"></i>&nbsp;&nbsp;Thêm mới</legend>
                                <form id="formCreateCate" action="{{ route('postInsertCate') }}" method="post">
                                    <input type='hidden' name='_token' value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label>Danh mục:</label>
                                        <select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5" name="selCate">
                                            <option value="0">-- Chọn danh mục --</option>
                                            {{ showOptionCategories($cateops) }}
                                        </select>
                                    </div>

                                    <div class="form-group @if ($errors->has('txtNameCate')) has-error @endif">
                                        <label>Tên danh mục:</label>
                                        <input type="text" name="txtNameCate" placeholder="Nhập tên danh mục" class="form-control">
                                        @if ($errors->has('txtNameCate')) <p class="help-block">{{ $errors->first('txtNameCate') }}</p> @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" name="checkStatus" id="ch3" class="switchery" checked="checked">Hiển thị
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Link SEO:</label>
                                        <input type="text" name="txtSlug" placeholder="Nhập link seo" class="form-control">
                                        <p class="help-block"><i>* Nhập không dấu cách nhau bằng ký tự '-'</i></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả:</label>
                                        <textarea rows="5" cols="5" class="form-control" name="txtDesCate" placeholder="Mô tả không quá 25 ký tự"></textarea>
                                    </div>
                                    
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-primary" value="Thêm mới">
                                        <input type="button" class="btn btn-warning" id="btnResetCreate" value="Làm mới">
                                    </div>
                                </form>
                            </fieldset>
                        </div>

                        <div class="col-md-6">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-tree7"></i>&nbsp;&nbsp;Cây danh mục</legend>
                                <ul class="tree_panel listsClass" id="tree_panel">
                                    {{ showListCategories($catels) }}
                                </ul>
                                <div class="text-right">
                                    <button class="btn btn-primary" id="updateSortList" data-original-title="" title="">Lưu</button>
                                    <button class="btn btn-danger" data-original-title="" title="">Hủy</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Insert Form-->

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
                        @foreach($catetbs as $cate)
                            <tr>
                                <td class='hidden'>{{ $cate->id }}</td>
                                <td>{{ $cate->name }}</td>
                                <td>{{ $cate->description }}</td>
                                <td>{{ $cate->slug }}</td>
                                <td>@if($cate->parent) {{ $cate->parent->name }} @endif</td>
                                <td class='hidden'>@if($cate->parent) {{ $cate->parent->id }} @endif</td>
                                <td>{{ $cate->status === 1 ? 'Hiển thị' : 'Không hiển thị' }}</td>
                                <td align="center">
                                    <button style="font-size: 7px; padding: 5px 6px;" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span style="font-size: 10px;" class="glyphicon glyphicon-pencil"></span></button>
                                    <a style="font-size: 7px; padding: 5px 6px;" href='administrator/category/delete/{{ $cate->id }}' class="btn btn-danger btn-xs"><span style="font-size: 10px;" class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             <!-- List-->

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
                                    <label class="control-label col-lg-3"></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" name="checkStatus" id="ch4" class="switchery" checked="checked">Hiển thị
                                            </label>
                                        </div>
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
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Watting" id="btnSubmitUpdate">Cập nhật</button>
                                    <input type="button" class="btn btn-warning" value="Làm mới" id="btnResetUpdate">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Update-->
             

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
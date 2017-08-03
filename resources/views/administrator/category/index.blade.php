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
                            <form class="form-horizontal" id="formCreateCate">

                                 <div class="form-group">
                                    <label class="control-label col-lg-4">Danh mục</label>

                                    <div class="col-lg-8">
                                        <select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5">
                                            <option value="0">-- Chọn danh mục --</option>
                                            <optgroup label="NFC EAST">
                                                <option>Dallas Cowboys</option>
                                                <option>New York Giants</option>
                                                <option>Philadelphia Eagles</option>
                                                <option>Washington Redskins</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-4">Tên danh mục</label>

                                    <div class="col-lg-8">
                                        <input type="text" placeholder="Nhập tên danh mục" class="form-control">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label for="text" class="control-label col-lg-4">Mô tả</label>

                                    <div class="col-lg-8">
                                        <textarea class="form-control" placeholder="Mô tả không quá 25 ký tự"></textarea>
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
                                <li id="item_a" data-module="a"><div>Item b</div></li>
                                <li class="sortableListsOpen" id="item_b" data-module="b">
                                    <div>Item b</div>
                                    <ul class="">
                                        <li id="item_b1" data-module="b">
                                            <div>Item b1</div>
                                        </li>
                                        <li id="item_b2" data-module="b">
                                            <div><span class="clickable">Item b2 - clickable text</span></div>
                                        </li>
                                        <li id="item_b3" data-module="b">
                                            <div>Item b3</div>
                                        </li>
                                        <li id="item_b4" data-module="b">
                                            <div>Item b4</div>
                                        </li>
                                        <li id="item_b5" data-module="b">
                                            <div>Item b5</div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <div class="text-right">
                                <button class="btn btn-primary btn-grad" data-original-title="" title="">Lưu</button>
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
                                    <th>Tên danh mục</th>
                                    <th>Danh mục cha</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+1</td>
                                        <td>Hiển thị</td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button>
                                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+2</td>
                                        <td>Hiển thị</td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button>
                                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+3</td>
                                        <td>Hiển thị</td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button>
                                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
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
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3">Danh mục</label>

                                                    <div class="col-lg-8">
                                                        <select data-placeholder="Chọn danh mục" id="cateU" class="form-control chzn-select" tabindex="5">
                                                            <option value="0">-- Chọn danh mục --</option>
                                                            <optgroup label="NFC EAST">
                                                                <option>Dallas Cowboys</option>
                                                                <option>New York Giants</option>
                                                                <option>Philadelphia Eagles</option>
                                                                <option>Washington Redskins</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->

                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Tên danh mục</label>

                                                    <div class="col-lg-8">
                                                        <input type="text" id="nameCateU" placeholder="Nhập tên danh mục" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                                
                                                <div class="form-group">
                                                    <label for="text" class="control-label col-lg-3">Mô tả</label>

                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" id="desCateU" placeholder="Mô tả không quá 25 ký tự"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary btn-grad" data-original-title="" title="">Cập nhật</button>
                                                    <button class="btn btn-warning btn-grad" data-original-title="" title="">Làm mới</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script src="assets/sortable/jquery-sortable-lists.js"></script>

    <!-- Custom  -->
    <script src="assets/custom/handle-form.js"></script>

    <!-- Metis core scripts -->
    <script src="assets/js/core.js"></script>
    <!-- Metis demo scripts -->
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').table({
                numberColumn: 5,
                orderColum: 0,
                selector: {
                    select: ['cateU'],
                    input: ['nameCateU', 'desCateU'],
                    form: 'formUpdateCate'
                }
            })
            

            var options = {
                placeholderCss: {'background-color': '#f9e3d3', 'border-radius': '3px'},
                hintCss: {'background-color':'#bbf'},
                
                isAllowed: function( cEl, hint, target )
                {
                    if( target.data('module') === 'c' && cEl.data('module') !== 'c' )
                    {
                        hint.css('background-color', '#ff9999');
                        return false;
                    }
                    else
                    {
                        hint.css('background-color', '#baf9ce');
                        hint.css('border-radius', '3px');
                        return true;
                    }
                },
                opener: {
                    active: true,
                    as: 'html',  // if as is not set plugin uses background image
                    close: '<i class="fa fa-minus c1"></i>',  // or 'fa-minus c3',  // or './imgs/Remove2.png',
                    open: '<i class="fa fa-plus c2"></i>',  // or 'fa-plus',  // or'./imgs/Add2.png',
                    openerCss: {
                        'display': 'inline-block',
                        'float': 'left',
                        'margin-left': '0px',
                        'margin-right': '5px',
                        //'background-position': 'center center', 'background-repeat': 'no-repeat',
                        'font-size': '1.1em'
                    }
                },
                ignoreClass: 'clickable'
            };

            // $('#tree_panel li div').click(function(event) {
            //     oriVal = $(this).text();
            //     $('#tree_panel').beforePopupForm($('#labelFormUpdate'), $('#cateU'), $('#nameCateU'), $('#desCateU'), oriVal);
            //     $('#formUpdateCate').modal('show');
            //     $('#formUpdateCate').on('hidden.bs.modal', function (e) {
            //        console.log('a');
            //     });
            // });

            $('#btnResetCreate').click(function (){
                $('#formCreateCate').handleForm({reset: true});
            });
            
            console.log( $('#tree_panel').sortableListsToHierarchy() );
        });

    </script>

    <script src="assets/js/style-switcher.js"></script>
@endsection
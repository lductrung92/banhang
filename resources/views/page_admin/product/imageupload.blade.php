<form action="administrator/upload/fileImage" method="post" class="dropzone no-margin dz-clickable"
        id="dropzone_multiple" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

<div id="preview-template" style="display: none;">
    <div class="dz-preview dz-image-preview ng-scope">
        <div class="dz-details sn-div-img">
            <img data-dz-thumbnail>
            <a class="sn-delete-img-btn" href="javascript:undefined;" title="Xóa" data-dz-remove ><i style="cursor: pointer; color: red" class="icon-x"></i></a>
            <a class="btn sn-edit-img-btn" href="#sn-edit-img-btn" style="bottom: -92px;border-radius: 50%!important;cursor: pointer" data-toggle="tooltip" data-placement="right" title="Chỉnh sửa">
                <i style="cursor: pointer" class="fa fa-pencil" style="font-size: 14px"></i></a>
        </div>
    </div>
</div>

<div id="sn-edit-img-btn">
    <div class="modal-header no-padding ng-scope">
        <div class="table-header">
            Thiết lập và điều chỉnh hình ảnh
        </div>
    </div>
    <div class="modal-body ng-scope">
        <div class="row center">
            <p>Bạn nên cấu hình kích thước ảnh đúng tỷ lệ theo khung cắt để tránh vỡ giao diện.<br>
                <i> Hệ thống sẽ lưu lại cấu hình cho những lần điều chỉnh hình ảnh sau. </i>
            </p>
            <p> Thiết lập cấu hình kích thước hình ảnh : <button class="btn btn-large btn-primary" id="open-control-crop">
                    {{--<span class="">Đóng thiết lập</span>--}}
                    <span class="ng-hide">Thiết lập</span></button>
            </p>
            <div class="form-group form-crop-image" style="text-align: left">
                <div class="control-crop-image">
                    <div class="form-group" style="width: 50%; float: left">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio-option-crop" class="styled" value='1'>
                                Theo khung hình vuông (800 X 800)
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="radio-option-crop" class="styled" value='2'>
                                Theo khung chữ nhật ngang (800 X 600)
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="width: 50%; float: right">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio-option-crop" class="styled" value='3'>
                                Theo khung chữ nhật đứng (600 X 800)
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="radio-option-crop" class="styled" value='4'>
                                Thiết lập bằng tay
                            </label>
                        </div>
                    </div>
                </div>

                <div class="option-crop">
                    <div class="col-xs-8 form-horizontal" style="float: right; margin-bottom: 10px">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Chiều dài: </label>
                                <div class="col-sm-7">
                                    <input type="text" name="w_setting" class="form-control" placeholder="VD: 400" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Chiều rộng: </label>
                                <div class="col-sm-7">
                                    <input type="text" name="h_setting" class="form-control" placeholder="VD: 400" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="margin-bottom-10" style="margin:0;clear:both">
                <div class="center margin-bottom-10">
                    <button class="btn btn-primary" id="open-option-crop"><span> Mở cấu hình</span></button>
                    <button class="btn btn-warning" id="close-control-crop">Lưu lại</button>
                </div>
            </div>
            <div style="margin-bottom:10px;text-align:center;clear:both; width: 100%">
                <img src="">
            </div>
            <form onsubmit="return false;" class="coords">
                <label>X1 <input class="form-control" type="text" size="5" id="x1" name="x1" /></label>
                <label>Y1 <input class="form-control" type="text" size="5" id="y1" name="y1" /></label>
                <label>X2 <input class="form-control" type="text" size="5" id="x2" name="x2" /></label>
                <label>Y2 <input class="form-control" type="text" size="5" id="y2" name="y2" /></label>
                <label>Rộng <input class="form-control" type="text" size="5" id="w" name="w" /></label>
                <label>Cao <input class="form-control" type="text" size="5" id="h" name="h" /></label>
            </form>
            <button class="btn btn-large btn-primary" id="submit_update_size_image">Thực hiện</button>
            <button class="btn btn-large btn-inverse" data-fancybox-close>
                Hủy bỏ
            </button>
        </div>
    </div>
</div>

<script src="assets/custom/upload-crop.js"></script>
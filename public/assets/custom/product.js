$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    var table = $('#dataTable').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "administrator/product/allproducts",
            dataType: "json",
            type: "POST",
            data: function(d) {
                d._token = CSRF_TOKEN;
                d.search.value = $('input[name="txtSearch"]').val();
                d.search.category = $('select[name="selCate"]').val();
                console.log(d.search)
            }
        },
        columns: [
            { "data": "name" },
            { "data": "title" },
            { "data": "slug" },
            { "data": "price" },
            { "data": "status" },
            { "data": "isnew" },
            { "data": "images", "bSortable": false },
            { "data": "options", "bSortable": false }
        ],
        language: {
            zeroRecords: "Không tìm thấy",
            infoEmpty: "Không thìm thấy",
            infoFiltered: "(Tìm kiếm trong _MAX_ danh mục)",
            paginate: {
                "first": "Trang đầu",
                "last": "Trang cuối",
                "next": "<i class='fa fa-angle-double-right'></i>",
                "previous": "<i class='fa fa-angle-double-left'></i>"
            },
            search: '<span>Tìm kiếm:</span> _INPUT_',
            lengthMenu: '<span>Hiển thị:</span> _MENU_',
        },

        bInfo: false,
        searching: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>'
    });

    $('select[name=dataTable_length]').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    })

    var shtml = '<div class="col-lg-9 form-inline">' +
        '<div class="form-group"><select data-placeholder="Chọn danh mục" class="form-control chzn-select" tabindex="5" name="selCate">' +
        '<option value="0">-- Tất cả --</option>' +
        selSearch +
        '</select></div>' +
        '<div class="form-group"><input type="text" name="txtSearch" placeholder="Tìm kiếm ..." class="form-control col-lg-3"></div>' +
        '<input type="button" class="btn btn-success" id="btnSearch" value="Tìm kiếm">' +
        '</div>';

    $('div#dataTable_wrapper div.datatable-header').prepend(shtml);

    $('#btnSearch').click(function() {
        table.ajax.reload();
    });

});
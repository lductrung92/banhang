(function($) {
    $.fn.handleForm = function(options) {
        var defaults = {
            reset: true,
            submit: false,
            resetForm: function() { return true; }
        }

        var settings = $.extend(defaults, options);

        return this.each(function() {
            var me = $(this);
            if (settings.reset) resetForm(me);
        });

        function resetForm(me) {
            me.find('select').val(0);
            me.find('input[type=text], textarea').val('');
            return true;
        }
    }

    $.fn.table = function(options) {
        var defaults = {
            numberColumn: 0,
            language: 'vi',
            orderColum: 0,
            type: 'asc',
            selector: {
                select: [],
                input: [],
                form: null,
            }
        }

        var settings = $.extend(defaults, options);

        return this.each(function() {
            var me = $(this);

            var table = setTable(me);

            me.find('button.btn-primary').click(function() {
                var row = $(this).parents('tr')[0];
                var obj = table.row(row).data();
                beforePopupForm(obj);
                $('#' + settings.selector.form).modal('show');
            });
        });

        function setTable(me) {
            var columns = [];
            for (var i = 0; i < settings.numberColumn; i++) {
                columns[i] = null;
                if (i === (settings.numberColumn - 1)) columns[i] = { "orderable": false };
            }
            var op = {
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ danh mục",
                    "zeroRecords": "Không tìm thấy",
                    "info": "Hiển thị _PAGE_/_PAGES_",
                    "infoEmpty": "Không thìm thấy",
                    "infoFiltered": "(Tìm kiếm trong _MAX_ danh mục)",
                    "paginate": {
                        "first": "Trang đầu",
                        "last": "Trang cuối",
                        "next": "<i class='fa fa-angle-double-right'></i>",
                        "previous": "<i class='fa fa-angle-double-left'></i>"
                    },
                },
                "columns": columns,
                "order": [
                    [settings.orderColum, settings.type]
                ]
            }
            return me.DataTable(op);
        }

        function beforePopupForm(obj) {
            var select = settings.selector.select;
            var input = settings.selector.input;
            $.each(select, function(i, val) {
                $('#' + val).val(0);
            });
            $.each(input, function(i, val) {
                $('#' + val).val(obj[i + 2]);
            });

            // type.html('Cập nhật - ' + '<i style="color: red">' + obj[0] + '</i>');
            // cate.val(0);
            // name.val(obj);
            // des.val(obj);
        }
    }
}(jQuery));
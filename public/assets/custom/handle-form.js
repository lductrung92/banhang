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
            type: 'asc'
        }

        var settings = $.extend(defaults, options);

        return this.each(function() {
            var me = $(this);
            var columns = [];
            for (var i = 0; i < settings.numberColumn; i++) {
                columns[i] = null;
                if (i === (settings.numberColumn - 1)) columns[i] = { "orderable": false };
            }
            console.log(columns);
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
            me.DataTable(op);
        });
    }
}(jQuery));
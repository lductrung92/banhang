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
            me.find('input[type=checkbox]').prop("checked", true);
            return true;
        }
    }

    $.fn.table = function(options) {

        var defaults = {
            numberColumn: 0,
            language: 'vi',
            orderColum: 0,
            type: 'asc',
            colums: {},
            title: {},
            url: null,
            selector: {
                form: null,
                button: {
                    update: null,
                    reset: null
                }
            },
            setTable: function(me) {},
            beforePopupForm: function(obj) {}
        }

        var settings = $.extend(defaults, options);

        var c;

        return this.each(function() {
            var me = $(this);

            var table = setTable(me);


            $('select[name=dataTable_length]').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });


            me.find('button.btn-primary').click(function() {
                var row = $(this).parents('tr')[0];
                var obj = table.row(row).data();
                beforePopupForm(obj);
                $('#' + settings.selector.form).modal('show');
            });

            settings.selector.button.reset.click(function() {
                $('#' + settings.selector.form).handleForm({ reset: true });
            });

            settings.selector.button.update.click(function() {
                var str = $('#' + settings.selector.form).find('form').serialize();
                var url = $('#' + settings.selector.form).find('form').attr('action');
                if (c != str) {
                    settings.selector.button.update.button('loading');
                    $.ajax({
                        url: url,
                        data: str,
                        type: 'POST',
                        dataType: 'json',
                        success: function(msg) {
                            setTimeout(function() {
                                settings.selector.button.update.button('reset');
                                if (msg.status) {
                                    $('#' + settings.selector.form).modal('hide');
                                    location.reload();
                                } else {
                                    var obj = msg.messages;
                                    $('div.has-error').find('p.help-block').remove();
                                    $('div.has-error').removeClass('has-error');
                                    $.each(obj, function(index, value) {
                                        var selector = $(':input[name=' + index + ']');
                                        selector.after('<p class="help-block">' + value + '</p>');
                                        selector.parent().parent('div.form-group').addClass('has-error');
                                    });
                                }
                                c = str;
                            }, 1000);
                        },
                        error: function(xhr) {
                            setTimeout(function() {
                                settings.selector.button.update.button('reset');
                            }, 1000);
                        }
                    });
                }
            });
        });

        function setTable(me) {
            var columns = [];
            for (var i = 0; i < settings.numberColumn; i++) {
                if (i === (settings.numberColumn - 1))
                    columns[i] = { "orderable": false };
                else
                    columns[i] = null;
            }
            var op = {
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
                "columns": columns,
                "order": [
                    [settings.orderColum, settings.type]
                ],
                bInfo: false,
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',

            }

            return me.DataTable(op);
        }

        function beforePopupForm(obj) {
            var selector = settings.colums;
            $('div.form-group').removeClass('has-error');
            $('div.form-group .help-block').remove();
            $('#' + settings.title.id).html('Cập nhật danh mục - ' + '<i style="color: red">' + obj[settings.title.indexText] + '</i>')
            $.each(selector, function(i, value) {
                var sel = $('#' + settings.selector.form).find(value.ftype + '[name=' + i + ']');
                if (i == 'id')
                    $('#' + settings.selector.form).find('form').attr('action', settings.url + obj[value.index]);
                if (value.type == 'text')
                    sel.val(obj[value.index]);
                if (value.type == 'select')
                    obj[value.index] == '' ? sel.val(0) : sel.val(obj[value.index]);
                if (value.type == 'checkbox')
                    obj[value.index] == 'Hiển thị' ? sel.prop("checked", true) : sel.prop("checked", false);
            });
            c = $('#' + settings.selector.form).find('form').serialize();
        }
    }

    // $.fn.tableServerSide = function(options) {
    //     var defaults = {
    //         url: null,
    //         columns: null,
    //         setTable: function(me) {},
    //     }
    //     var settings = $.extend(defaults, options);

    //     return this.each(function() {
    //         var me = $(this);

    //         setTable(me);

    //         // setInterval(function() {
    //         //     table.ajax.reload();
    //         // }, 1000);

    //         // setInterval(function() {
    //         //     var data = table.ajax.params();
    //         //     table.ajax.url(settings.url).load();
    //         // }, 1000);

    //         // $('#myQuestion').click(function() {
    //         //     if (login()) {
    //         //         var userId = $.cookie("userId");
    //         //         table.ajax.url("${context}/question/my.htm?userId=" + userId).load();
    //         //     }
    //         // });



    //         $('select[name=dataTable_length]').select2({
    //             minimumResultsForSearch: Infinity,
    //             width: 'auto'
    //         });
    //     });

    //     function setTable(me) {
    //         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //         var op = {
    //             processing: false,
    //             serverSide: true,
    //             ajax: {
    //                 url: settings.url,
    //                 dataType: "json",
    //                 type: "POST",
    //                 data: function(d) {
    //                     d._token = CSRF_TOKEN;
    //                 }
    //             },
    //             language: {
    //                 zeroRecords: "Không tìm thấy",
    //                 infoEmpty: "Không thìm thấy",
    //                 infoFiltered: "(Tìm kiếm trong _MAX_ danh mục)",
    //                 paginate: {
    //                     "first": "Trang đầu",
    //                     "last": "Trang cuối",
    //                     "next": "<i class='fa fa-angle-double-right'></i>",
    //                     "previous": "<i class='fa fa-angle-double-left'></i>"
    //                 },
    //                 search: '<span>Tìm kiếm:</span> _INPUT_',
    //                 lengthMenu: '<span>Hiển thị:</span> _MENU_',
    //             },
    //             columns: settings.columns,
    //             bInfo: false,
    //             searching: false,
    //             dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>'
    //         }

    //         return me.DataTable(op);
    //     }
    // }

    /**
     * Type: info, success, warning, danger, reminder, todo
     */
    $.notifier = function(type, title, content, duration) {
        var counter;
        var method = {
            init: function(type, title, content, duration, url) {
                var container = this.createContainer();
                this.createNotification(type, title, content, container, duration);
            },
            createContainer: function() {
                if ($('#notifier-container').length > 0) {
                    counter += 1;
                    return $('#notifier-container');
                } else {
                    counter = 0;
                    var element = this._createElement('div', { id: 'notifier-container', class: 'notify container' });
                    document.body.appendChild(element);
                    return $('#notifier-container');
                }
            },
            createNotification: function(type, title, content, container, duration) {
                var itemId = 'notifier-item-' + counter;
                var itemEl = this._createElement('div', { class: 'notify item ' + type, id: itemId });
                var titleEl = this._createElement('div', { class: 'header' });
                var contentEl = this._createElement('div', { class: 'content' });
                var clsEl = this._createElement('a', { class: 'close-btn' });
                var iconEl = this._createElement('div', { class: 'img img-' + type });


                titleEl.innerHTML = title;
                contentEl.innerHTML = content;
                clsEl.innerHTML = 'x';
                clsEl.addEventListener('click', function() {
                    method.closeNotification(itemId);
                });
                itemEl.appendChild(clsEl);
                itemEl.appendChild(titleEl);
                itemEl.appendChild(iconEl);
                itemEl.appendChild(contentEl);
                container.append(itemEl);
                setTimeout(function() {
                    $(itemEl).addClass('show-notifier');
                }, 100);
                if (duration > 0) {
                    setTimeout(function() {
                        method.closeNotification(itemId);
                    }, duration);
                }

            },
            closeNotification(currentEl) {
                $('#' + currentEl).removeClass('show-notifier');
                setTimeout(function() {
                    $('#' + currentEl).remove();
                }, 600);
                $('#notifier-container').remove();
            },
            _createElement: function(el, attrs) {
                var element = document.createElement(el);
                for (var prop in attrs) {
                    element.setAttribute(prop, attrs[prop]);
                }
                return element;

            }
        };
        return method.init(type, title, content, duration);
    };

}(jQuery));
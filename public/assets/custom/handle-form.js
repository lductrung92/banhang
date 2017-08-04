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
            selector: {
                select: null,
                input: [],
                status: null,
                form: null,
                button: {
                    update: null,
                    reset: null
                }
            }
        }

        var settings = $.extend(defaults, options);

        var c;

        return this.each(function() {
            var me = $(this);

            var table = setTable(me);

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
                    })
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
            var input = settings.selector.input;
            $('#labelFormUpdate').html('Cập nhật danh mục - ' + '<i style="color: red">' + obj[1] + '</i>');
            $.each(input, function(i, val) {
                $('#' + val).val(obj[i + 1]);
            });

            obj[5] == 'Hiển thị' ? $('#' + settings.selector.status).prop("checked", true) : $('#' + settings.selector.status).prop("checked", false);

            obj[4] == '' ? $('#' + settings.selector.select).val(0) : $('#' + settings.selector.select).val(obj[4]);

            $('#' + settings.selector.form).find('form').attr('action', 'administrator/category/update/' + obj[0]);
            c = $('#' + settings.selector.form).find('form').serialize();
            // type.html('Cập nhật - ' + '<i style="color: red">' + obj[0] + '</i>');
            // cate.val(0);
            // name.val(obj);
            // des.val(obj);
        }
    }

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
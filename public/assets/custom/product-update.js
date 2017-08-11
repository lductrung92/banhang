$(function() {
    var options = {
        filebrowserImageBrowseUrl: 'administrator/filemanager?type=Images',
        filebrowserImageUploadUrl: 'administrator/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: 'administrator/filemanager?type=Files',
        filebrowserUploadUrl: 'administrator/filemanager/upload?type=Files&_token='
    };
    var ckeditor = CKEDITOR.replace('desProduct', options);

    var elems = document.querySelectorAll('.switchery');
    for (var i = 0; i < elems.length; i++) {
        var switchery = new Switchery(elems[i], { color: 'rgb(100, 189, 99)' });
    }

    $('#btnUpdateProduct').click(function() {
        var formData = $('form#formUpdateProduct').serialize();

        var sum = parseInt($('input[name=txtTotal]').attr('data-total')) + parseInt($('input[name=txtTotal]').val() ? $('input[name=txtTotal]').val() : 0);
        var ex = parseInt($('input[name=txtExport]').val() ? $('input[name=txtExport]').val() : 0);

        if(ex > sum) {
            $.notifier('danger', 'Thông báo', 'Sản phẩm trong kho không đủ!', 1500);
        } else {
            var images = [];
            var serimages = [];

            for (var i = 0; i < cache_files.length; i++) {
                images.push(cache_files[i].name);
            }

            for (var i = 0; i < server_files.length; i++) {
                serimages.push(server_files[i].name);
            }

            var data = formData + '&txtDesCate=' + ckeditor.getData() + '&images=' + JSON.stringify(images) + '&serimages=' + JSON.stringify(serimages);

            $.ajax({
                url: 'administrator/product/update/' + id_update,
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(msg) {
                    if (msg.status && msg.validate) {
                        $.session.set("messages", msg.messages);
                        location.reload();
                    } else if (msg.status && !msg.validate) {

                    } else {
                        $.notifier('danger', 'Thông báo', 'Xảy ra lỗi!', 1500);
                        var obj = msg.messages;

                        $('div.has-error').find('p.help-block').remove();
                        $('div.has-error').removeClass('has-error');

                        $.each(obj, function(index, value) {
                            var selector = $(':input[name=' + index + ']');
                            selector.after('<p class="help-block">' + value + '</p>');
                            selector.parent().parent('div.form-group').addClass('has-error');
                        });
                    }
                },
                error: function(xhr) {

                }
            });
        }

        

    });

});
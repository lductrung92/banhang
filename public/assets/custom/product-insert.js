$(function() {
    var options = {
        filebrowserImageBrowseUrl: 'administrator/filemanager?type=Images',
        filebrowserImageUploadUrl: 'administrator/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: 'administrator/filemanager?type=Files',
        filebrowserUploadUrl: 'administrator/filemanager/upload?type=Files&_token='
    };
    var ckeditor = CKEDITOR.replace('desProduct', options);

    var primary = document.querySelector('.switchery');
    var switchery = new Switchery(primary, { color: 'rgb(100, 189, 99)' });

    $('#imageUpload').load('administrator/upload/fileImage/reload');

    $('#btnCreateProduct').click(function() {
        var formData = $('form#formCreateProduct').serialize();

        var images = [];

        for (var i = 0; i < cache_files.length; i++) {
            images.push(cache_files[i].name);
        }

        var data = formData + '&txtDesCate=' + ckeditor.getData() + '&images=' + JSON.stringify(images);

        $.ajax({
            url: 'administrator/product/insert',
            data: data,
            type: 'POST',
            dataType: 'json',
            success: function(msg) {
                if (msg.status) {

                } else {
                    $.notifier('danger', 'Thông báo', 'Xảy ra lỗi!', 1500);
                    var obj = msg.messages;
                    $('div.form-group').removeClass('has-error');
                    $('div.form-group .help-block').remove();
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

    });


});
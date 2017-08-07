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
        var data = formData + '&txtDesCate=' + ckeditor.getData();
        console.log(data);
    });


});
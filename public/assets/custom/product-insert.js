$(function() {
    var options = {
        filebrowserImageBrowseUrl: 'administrator/filemanager?type=Images',
        filebrowserImageUploadUrl: 'administrator/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: 'administrator/filemanager?type=Files',
        filebrowserUploadUrl: 'administrator/filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('desProduct', options);

    $('#imageUpload').load('administrator/upload/fileImage/reload');
});
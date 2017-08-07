<form action="administrator/upload/fileImage" method="post" class="dropzone no-margin dz-clickable"
        id="dropzone_multiple" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<script>
    $(function() {
        Dropzone.autoDiscover = false;
        var photo_counter = 0;
        var jcrop_api, oImage, boundx, boundy, t = 1;

        function showCoords(c) {
            $('#x1').val(parseInt(c.x * t));
            $('#y1').val(parseInt(c.y * t));
            $('#x2').val(parseInt(c.x2 * t));
            $('#y2').val(parseInt(c.y2 * t));
            $('#w').val(parseInt(c.w * t));
            $('#h').val(parseInt(c.h * t));
        }

        $("#dropzone_multiple").dropzone({
            paramName: "file",
            acceptedFiles: "image/*",
            uploadMultiple: false,
            parallelUploads: 100,
            maxFilesize: 8,
            dictDefaultMessage: '',
            maxFiles: 3,
            dictFileTooBig: '<div class="dz-message">Imagsadasdsae is bigger than 8MB</div>',
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            init: function() {
                var myDropzone = this;
                $('.dz-message').removeClass('dz-default');

                this.on("maxfilesexceeded", function(file) {
                    alert("No more files please!");
                });

                this.on("sending", function(file) {
                    $("#dropzone_multiple").block({
                        message: '<i class="fa fa-spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });
                });

                this.on("complete", function(file) {
                    console.log(file);
                    $('.dz-message').removeClass('dz-default');
                    // myDropzone.removeFile(file);// xoa tat ca
                    $('[data-toggle="tooltip"]').tooltip();

                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        // khoi tao lai event unbind

                        $("#dropzone_multiple").unblock();
                    }
                });

                var file = {name: 'mbuntu-12-658dd2e.jpg', size: 1};
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/mbuntu-12-658dd2e.jpg');
                    myDropzone.emit("complete", file);
                    photo_counter++;

                this.on("success", function(a) {
                    $('#imageUpload').html('');
                    $('#imageUpload').load('administrator/upload/fileImage/reload');                    
                });

                this.on("removedfile", function(file) {

                    $("#dropzone_multiple").block({
                        message: '<i class="fa fa-spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'administrator/upload/fileImage/delete',
                        data: { id: file.name, _token: $('#csrf-token').val() },
                        dataType: 'html',
                        success: function(data) {
                            var rep = JSON.parse(data);
                            if (rep.code == 200) {
                                photo_counter--;
                                $("#photoCounter").text("(" + photo_counter + ")");
                            }
                            $("#dropzone_multiple").unblock();
                            window.location.reload();
                        }

                    });

                });

            },
            error: function(file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function(file, done) {
                console.log(done);
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }

        });
    });
</script>
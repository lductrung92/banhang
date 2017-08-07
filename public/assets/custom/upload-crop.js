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
        dictFileTooBig: '<div class="dz-message">Imagsadasdsae is bigger than 8MB</div>',
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        init: function() {
            var myDropzone = this;
            $('.dz-message').removeClass('dz-default');

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
                $('.dz-message').removeClass('dz-default');
                // myDropzone.removeFile(file);// xoa tat ca
                $('[data-toggle="tooltip"]').tooltip();

                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    if (file.xhr) {
                        var obj = $.parseJSON(file.xhr.response);
                        myDropzone.options.thumbnail.call(myDropzone, file, 'uploads/caches/' + obj["filename"] + "?" + Math.floor(Math.random() * 1000000000));
                        cache_files.push({
                            'file': file,
                            'name': obj["filename"]
                        });

                        $('.dz-preview a.sn-edit-img-btn').click(function(e) {
                            var b = $(this).parent().find('img').attr("src");
                            var s = $(this);
                            var imgAfter = $(this).parent().find('img');
                            $(this).fancybox({
                                closeClickOutside: false,
                                margin: [44, 0],
                                afterLoad: function() {
                                    $(".fancybox-controls").append('<iao-alert-box position="top-right" style="z-index:999"><iao-alert-start></iao-alert-start></iao-alert-box>');

                                    $("#submit_update_size_image").click(function() {
                                        var jsonData = [{
                                            x: $('#x1').val(),
                                            y: $('#y1').val(),
                                            w: $('#w').val(),
                                            h: $('#h').val(),
                                            name: oImage.attr("src").split('?')[0]
                                        }];
                                        $.ajax({
                                            type: 'get',
                                            url: 'administrator/upload/fileImage/updateSize',
                                            data: { data: JSON.stringify(jsonData) },
                                            success: function(data) {
                                                imgAfter.parent().block({
                                                    message: '<i class="icon-spinner9 spinner"></i>',
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
                                                setTimeout(function() {
                                                    imgAfter.attr("src", b + "?" + Math.floor(Math.random() * 1000000000));
                                                    imgAfter.parent().unblock();
                                                }, 1000);
                                                parent.$.fancybox.close();
                                            }
                                        })
                                    });
                                },
                                beforeLoad: function() {
                                    oImage = $('#sn-edit-img-btn img');
                                    var img = new Image();
                                    oImage.attr('src', b + "?" + Math.floor(Math.random() * 1000000000)).load(function() {
                                        if (this.naturalWidth > 712 && this.naturalWidth < 1600) {
                                            $(this).css({
                                                'width': this.naturalWidth / 2,
                                                'height': this.naturalHeight / 2
                                            });
                                            t = 2;
                                        } else if (this.naturalWidth >= 1600 && this.naturalWidth < 2500) {
                                            $(this).css({
                                                'width': (this.naturalWidth / 3),
                                                'height': this.naturalHeight / 3
                                            });
                                            t = 3;
                                        } else if (this.naturalWidth >= 2500) {
                                            $(this).css({
                                                'width': (this.naturalWidth / 4),
                                                'height': this.naturalHeight / 4
                                            });
                                            t = 4;
                                        } else {
                                            t = 1;
                                            $(this).css({ 'width': 'auto', 'height': 'auto' });
                                        }

                                        if (typeof jcrop_api != 'undefined') {
                                            jcrop_api.destroy();
                                            jcrop_api = null;
                                            $(this).width(oImage.naturalWidth);
                                            $(this).height(oImage.naturalHeight);
                                        }

                                        $(this).Jcrop({
                                            bgFade: true, // use fade effect
                                            minSize: [80, 160],
                                            aspectRatio: 200 / 400, //(w,h)
                                            bgOpacity: .3, // fade opacity
                                            onChange: showCoords,
                                            onSelect: showCoords
                                        }, function() {
                                            // use the Jcrop API to get the real image size
                                            var bounds = this.getBounds();
                                            boundx = bounds[0];
                                            boundy = bounds[1];

                                            // Store the Jcrop API in the jcrop_api variable
                                            jcrop_api = this;
                                            jcrop_api.setSelect([0, 0, 200, 400]);
                                        });
                                    });


                                },
                                afterClose: function() {
                                    jcrop_api.destroy();
                                    $("#submit_update_size_image").unbind("click");
                                }
                            });

                            e.preventDefault();
                        });
                    }
                    $("#dropzone_multiple").unblock();
                }
            });


            this.on("success", function(a) {
                // $('#imageUpload').html('');
                // $('#imageUpload').load('administrator/upload/fileImage/reload');                    
            });

            this.on("removedfile", function(file) {

                var obj = $.parseJSON(file.xhr.response);

                for (var i = 0; i < cache_files.length; i++) {
                    if (cache_files[i].name == obj['filename']) {
                        cache_files.splice(i, 1);
                        break;
                    }
                }

                reloadAfterLoad(myDropzone, cache_files);

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
            photo_counter++;
            $("#photoCounter").text("(" + photo_counter + ")");
        }

    });

    function loadCacheImgs(me, data) {
        for (var i = 0; i < data.length; i++) {
            me.options.addedfile.call(me, data[i].file);
            me.options.thumbnail.call(me, data[i].file, 'uploads/caches/' + data[i].name);
        }
    }

    function reloadAfterLoad(me, data) {
        for (var i = 0; i < data.length; i++) {
            me.options.thumbnail.call(me, data[i].file, 'uploads/caches/' + data[i].name + "?" + Math.floor(Math.random() * 1000000000));
        }
    }

    function vOptionCrop(w, h) {
        if (!$.isNumeric(w) || !$.isNumeric(h)) {
            $.iaoAlert({
                msg: "Bạn nhập sai cấu hình <br /> Cấu hình sẽ là mặc định",
                type: "notification",
                mode: "dark",
                autoHide: true,
                alertTime: "1000",
                fadeTime: "1000",
                closeButton: false,
                closeOnClick: true
            });
            return false;
        }
        return true;
    }

    $("#open-control-crop").click(function() {
        $(".form-crop-image").show();
        $("#open-option-crop").show();
        $("#close-control-crop").hide();
        $(".option-crop").hide();
        $('input[type=radio][name=radio-option-crop]').attr('checked', false);
        $('input[type=radio][name=radio-option-crop]').attr('disabled', true);
        $.uniform.update('.styled');
        $('input[type=text][name=w_setting]').val('');
        $('input[type=text][name=h_setting]').val('');
    });

    $("#open-option-crop").click(function() {
        $('input[type=radio][name=radio-option-crop]').attr('disabled', false);
        $.uniform.update('.styled');
        $(this).hide();
        $("#close-control-crop").show();
    });

    $('input[type=radio][name=radio-option-crop]').change(function() {

        $("#open-option-crop").hide();
        $("#close-control-crop").show();
        if (this.value == 4) {
            $(".option-crop").show();
        } else {
            $(".option-crop").hide();
        }
    });

    $("#close-control-crop").click(function() {
        $(".form-crop-image").hide();
        $(".option-crop").hide();
        $("#open-option-crop").show();
        var op = $('input[type=radio][name=radio-option-crop]:checked').val();
        var op_crop;
        var sel_default;
        if (op) {
            if (op == 1) {
                op_crop = {
                    minSize: [80, 80],
                    aspectRatio: 800 / 800
                };
                sel_default = [0, 0, 200, 200];
            } else if (op == 2) {
                op_crop = {
                    minSize: [80, 60],
                    aspectRatio: 800 / 600
                };
                sel_default = [0, 0, 200, 150];
            } else if (op == 3) {
                op_crop = {
                    minSize: [60, 80],
                    aspectRatio: 600 / 800
                };
                sel_default = [0, 0, 150, 200];
            } else {
                var w = $('input[type=text][name=w_setting]').val();
                var h = $('input[type=text][name=h_setting]').val();
                if (!vOptionCrop(w, h)) return;
                op_crop = {
                    minSize: [parseInt(w / 10), parseInt(h / 10)],
                    aspectRatio: w / h
                };
                sel_default = [0, 0, parseInt(w / 5), parseInt(h / 5)];
            }
        } else {
            $.notifier('warning', 'Thông báo', 'Bạn chưa chọn cấu hình <br /> Cấu hình sẽ là mặc định', '1500');
            return;
        }

        if (jcrop_api) {
            jcrop_api.setOptions(op_crop);
            jcrop_api.setSelect(sel_default);
        }
        $.notifier('success', 'Thông báo', 'Lưu cấu hình thành công', '1500');

    });

});
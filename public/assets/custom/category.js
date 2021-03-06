$(document).ready(function() {

    var str = $('form#formCreateCate select[name=selCate]').html();
    $('#formUpdateCate select[name=selCate]').append(str);

    var elems = document.querySelectorAll('.switchery');
    for (var i = 0; i < elems.length; i++) {
        var switchery = new Switchery(elems[i], { color: 'rgb(100, 189, 99)' });
    }

    $('#dataTable').table({
        numberColumn: 9,
        url: 'administrator/category/update/',
        title: {
            id: 'labelFormUpdate',
            indexText: 1
        },
        colums: {
            id: { ftype: '', index: 0, type: 'text' },
            txtNameCate: { ftype: 'input', index: 1, type: 'text' },
            txtDesCate: { ftype: 'textarea', index: 2, type: 'text' },
            txtSlug: { ftype: 'input', index: 3, type: 'text' },
            selCate: { ftype: 'select', index: 5, type: 'select' },
            checkStatus: { ftype: 'input', index: 6, type: 'checkbox' },
            icon: {ftype: 'icon', index: 8, type: 'icon'}
        },
        orderColum: 0,
        btnpopup: 'btnPopupUpdate',
        selector: {
            form: 'formUpdateCate',
            button: {
                update: $('#btnSubmitUpdate'),
                reset: $('#btnResetUpdate')
            }
        }
    });

    $('#btnResetCreate').click(function() {
        $('#formCreateCate').handleForm({ reset: true });
    });



    var options = {
        placeholderCss: { 'background-color': '#f9e3d3', 'border-radius': '3px' },
        hintCss: { 'background-color': '#bbf' },

        isAllowed: function(cEl, hint, target) {
            if (target.data('module') === 'c' && cEl.data('module') !== 'c') {
                hint.css('background-color', '#ff9999');
                return false;
            } else {
                hint.css('background-color', '#baf9ce');
                hint.css('border-radius', '3px');
                return true;
            }
        },
        opener: {
            active: true,
            as: 'html', // if as is not set plugin uses background image
            close: '<i class="fa fa-minus c1"></i>', // or 'fa-minus c3',  // or './imgs/Remove2.png',
            open: '<i class="fa fa-plus c2"></i>', // or 'fa-plus',  // or'./imgs/Add2.png',
            openerCss: {
                'display': 'inline-block',
                'float': 'left',
                'margin-left': '0px',
                'margin-right': '5px',
                //'background-position': 'center center', 'background-repeat': 'no-repeat',
                'font-size': '1.1em'
            }
        },
        ignoreClass: 'clickable'
    };


    $('#tree_panel').sortableLists(options);
    var listBefore = $('#tree_panel').sortableListsToArray();

    $('#updateSortList').click(function() {
        var arr = [];
        $.each(listIdChange, function(index, value) {
            var check = true;
            var pid = $('#' + value).parent().parent('li').attr('data-module');
            typeof pid != 'undefined' ? pid = pid : pid = 0;
            for (var i = 0; i < listBefore.length; i++) {
                if (value.split('-')[1] == listBefore[i].id && pid == listBefore[i].parentId) {
                    check = false;
                    break;
                }
            }
            if (check) {
                arr.push({
                    pid: pid,
                    id: value.split('-')[1],
                });
            }
        });

        if (arr.length > 0) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: 'administrator/category/ajax/update',
                type: "POST",
                data: { 'data': arr, _token: CSRF_TOKEN },
                success: function(msg) {
                    if (msg.status) {
                        $.session.set("messages", msg.messages);
                        location.reload();
                    }
                }
            });
        }
    });

});

function chooserIcon(parent ,elmnt, check) {
    if (!$(elmnt).hasClass('is-chooser')) {
        $(parent + ' .is-chooser').removeClass('is-chooser');
        $(parent + ' .icon-checkmark2').remove('.icon-checkmark2');
        $(elmnt).addClass('is-chooser');
        $(elmnt).append('<i class="icon-checkmark2" style="position: absolute; top: initial; bottom: 0; right: 0; color: green"></i>');
        if(check)
            $(parent + ' input[name=txtIcon]').val($(elmnt).find('img').attr('src'));
        else
            $(parent + ' input[name=txtIcon]').val('');
    }
}

// function showOptionCategories(me, categories, parent_id = 0, char = '') {
//     $.each(categories, function(key, item) {
//         if (item.pid == parent_id) {
//             if (item.pid === 0) {
//                 me.append('<option style="font-weight: bold;" value="' + item.id + '">' + item.name + '</option>');
//                 showOptionCategories(me, categories, item.id, char + '--&nbsp;');
//             } else {

//                 me.append('<option value="' + item.id + '">' + char + item.name + '</option>');
//                 showOptionCategories(me, categories, item.id, char + '--&nbsp;');
//             }
//         }
//     });
// }
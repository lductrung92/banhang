$(document).ready(function() {

    var str = $('form#formCreateCate select[name=selCate]').html();
    $('#cateU').append(str);

    $('#dataTable').table({
        numberColumn: 7,
        orderColum: 0,
        selector: {
            select: 'cateU',
            input: ['nameCateU', 'desCateU'],
            status: 'ch4',
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
                    if (msg === 'success') location.reload();
                    // var select = $('form#formCreateCate select[name=selCate]');
                    // select.find('option').remove().end();
                    // select.append('<option value="0">-- Chọn danh mục --</option>')
                    // showOptionCategories(select, msg.categories);

                    // showListCategories($('#tree_panel'), msg.categories);

                }
            });
        }
    });

});

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
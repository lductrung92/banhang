$(document).ready(function() {
    $('#dataTable').tableServerSide({
        url: "administrator/product/allproducts",
        "columns": [
            { "data": "name" },
            { "data": "title" },
            { "data": "slug" },
            { "data": "price" },
            { "data": "status" },
            { "data": "isnew" },
            { "data": "images", "bSortable": false },
            { "data": "options", "bSortable": false }
        ]
    });
});
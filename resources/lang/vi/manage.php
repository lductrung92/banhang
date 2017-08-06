<?php 
    
return [

    'dashboard' => [
        'icon' => 'fa fa-dashboard', 
        'title' => 'Bảng điều khiển'
    ],
    'category' => [
        'icon' => 'fa fa-sitemap', 
        'title' => 'Danh mục', 
    ],
    'product' => [
        'icon' => 'fa fa-medkit', 
        'title' => 'Sản phẩm',
        'childs' => [
            'list' => ['title' => 'Danh sách', 'icon' => 'fa fa-table'],
            'sale' => ['title' => 'Khuyến mãi', 'icon' => 'fa fa-empire'],
            'warehouse' => ['title' => 'Tồn kho', 'icon' => 'fa fa-bank']
        ]
    ]

];
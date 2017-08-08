<?php 
    
return [

    'dashboard' => [
        'icon' => 'fa fa-tachometer', 
        'title' => 'Dashboard'
    ],
    'category' => [
        'icon' => 'fa fa-sitemap', 
        'title' => 'Categories', 
    ],
    'product' => [
        'icon' => 'fa fa-medkit', 
        'title' => 'Products',
        'childs' => [
            'list' => ['title' => 'List', 'icon' => 'fa fa-table'],
            'sale' => ['title' => 'Sale', 'icon' => 'fa fa-empire'],
            'warehouse' => ['title' => 'WareHouse', 'icon' => 'fa fa-bank']
        ]
    ],
    'btn' => [
        'create' => 'Create',
        'update' => 'Update',
        'cancel' => 'Cancel',
        'refresh' => 'Refresh',
        'save' => 'Save',
        'list' => 'List'
    ]

];
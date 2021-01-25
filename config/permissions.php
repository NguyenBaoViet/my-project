<?php

return [
    'access' => [
        //category
        'list-category' => 'list_category',
        'add-category' => 'add_category',
        'edit-category' => 'edit_category',
        'delete-category' => 'delete_category',
        //menu
        'list-menu' => 'list_menu',
        'add-menu' => 'add_menu',
        'edit-menu' => 'edit_menu',
        'delete-menu' => 'delete_menu',
        //product
        'list-product' => 'list_product',
        'add-product' => 'add_product',
        'edit-product' => 'edit_product',
        'delete-product' => 'delete_product',
        //slider
        'list-slider' => 'list_slider',
        'add-slider' => 'add_slider',
        'edit-slider' => 'edit_slider',
        'delete-slider' => 'delete_slider',

    ],
    'table_module' => [
        ['category','Danh mục sản phẩm'],
        ['menu','Menu'],
        ['product','Sản phẩm'],
        ['slider','Slider'],
        ['user','Nhân viên'],
        ['role','Vai trò'],
    ],
    'module_children' => [
        ['list','Xem'],
        ['add','Thêm'],
        ['edit','Sửa'],
        ['delete','Xóa']
    ],
];
<?php

add_action( 'init', function () {
    register_post_type( 'slider', array(
        'labels'       => array(
            'name'          => 'Слайдер',
            'singular_name' => 'Слайдер',
            'add_new'       => 'Добавить новый',
            'add_new_item'  => 'Добавить новый слайд',
            'edit_item'     => 'Редактировать',
            'new_item'      => 'Новый слайд',
            'view_item'     => 'Просмотр',
            'menu_name'     => 'Слайдер',
            'all_items'     => 'Все слайды',
        ),
        'public'       => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', ),
        'menu_icon'    => 'dashicons-format-gallery',
        'show_in_rest' => true,
    ) );

} );
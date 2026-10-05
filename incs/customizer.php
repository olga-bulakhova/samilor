<?php

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    $wp_customize->add_section('expo_theme_options', array(
        'title' => 'Шапка на главной странице',
        'priority' => 10
    ));


    $wp_customize->add_setting( 'expo_banner' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'expo_banner', [
        'label'   => 'Баннер',
        'section' => 'expo_theme_options',
    ] ) );


    $wp_customize->add_setting( 'expo_title' );
    $wp_customize->add_control( 'expo_title', array(
        'label' => 'Заголовок',
        'section' => 'expo_theme_options',
    ) );

    $wp_customize->add_setting( 'expo_text' );
    $wp_customize->add_control( 'expo_text', array(
        'label' => 'Text',
        'section' => 'expo_theme_options',
    ));


    $wp_customize->add_section('expo_theme_info', array(
        'title' => 'Контактная информация',
        'priority' => 10
    ));

    // phone
    $wp_customize->add_setting( 'expo_phone_1' );
    $wp_customize->add_control( 'expo_phone_1', array(
        'label' => 'Телефон 1',
        'section' => 'expo_theme_info',
    ) );

    $wp_customize->add_setting( 'expo_phone_2' );
    $wp_customize->add_control( 'expo_phone_2', array(
        'label' => 'Телефон 2',
        'section' => 'expo_theme_info',
    ) );

    $wp_customize->add_setting( 'expo_address' );
    $wp_customize->add_control( 'expo_address', array(
        'label' => 'Адрес',
        'section' => 'expo_theme_info',
    ) );

});

function expo_theme_options() {
    return array(
        'banner' => get_theme_mod( 'expo_banner' ),
        'title' => get_theme_mod( 'expo_title' ),
        'text' => get_theme_mod( 'expo_text' ),
    );
}

function expo_theme_info() {
    return array(
        'phone_1' => get_theme_mod( 'expo_phone_1' ),
        'phone_2' => get_theme_mod( 'expo_phone_2' ),
        'address' => get_theme_mod( 'expo_address' ),
    );
}


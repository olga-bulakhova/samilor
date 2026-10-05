<?php

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

if (!defined('EXPO_DIR_URI')) {
    define('EXPO_DIR_URI', untrailingslashit(get_template_directory_uri()));
}

if (!defined('EXPO_DIR_PATH')) {
    define('EXPO_DIR_PATH', untrailingslashit(get_template_directory()));
}

if (!defined('EXPO_IS_MOBILE')) {
    define('EXPO_IS_MOBILE', wp_is_mobile());
}

function expo_setup()
{
    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-lightbox');

    if (!EXPO_IS_MOBILE) {
        add_theme_support('wc-product-gallery-slider');
    }


    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(
        array(
            'menu-primary' => 'Главное меню',
            'menu-account' => 'Меню аккаунта',
        )
    );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'expo_setup');

add_action('wp_enqueue_scripts', 'expo_scripts');
function expo_scripts()
{
    wp_enqueue_style('expo-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
    wp_enqueue_style('expo-datepicker', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');

    wp_enqueue_style('slick', get_template_directory_uri() . '/lib/slick.css');
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/lib/slick-theme.css');
    wp_enqueue_style('star-rating', get_template_directory_uri() . '/lib/star-rating.css');
    wp_enqueue_style('expo-styles', get_template_directory_uri() . '/dist/css/global.bundle.css', array('expo-google-fonts'), filemtime(get_template_directory() . '/dist/css/global.bundle.css'), 'all');

    wp_enqueue_script('jquery');
    // wp_enqueue_script('expo-validator', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js', array('jquery'), false, true);
    // wp_enqueue_script('`ex`po-datepicker', '//code.jquery.com/ui/1.11.2/jquery-ui.js', array('jquery'), false, true);
    wp_enqueue_script('slick', get_template_directory_uri() . '/lib/slick.min.js', array('jquery'));
    wp_enqueue_script('expo-global', EXPO_DIR_URI . '/dist/js/global.bundle.js', ['jquery'], filemtime(EXPO_DIR_PATH . '/dist/js/global.bundle.js'), true);
}

add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');

function delete_intermediate_image_sizes($sizes)
{
    // размеры которые нужно удалить
    return array_diff($sizes, [
        'medium_large',
        'large',
        'medium',
        '1536x1536',
        '2048x2048',
    ]);
}

//require_once get_template_directory() . '/incs/register-post-type.php';
require_once get_template_directory() . '/incs/customizer.php';
require_once get_template_directory() . '/incs/woocommerce-hooks.php';
require_once get_template_directory() . '/incs/helper.php';

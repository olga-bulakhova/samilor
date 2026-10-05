<?php

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

add_action('woocommerce_before_main_content', function () {
    echo '<div class="wrapper">';
}, 5);

add_action('woocommerce_after_main_content', function () {
    echo '</div>';
}, 5);

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

    $fragments['span.cart-badge'] = '<span class="cart-badge count-' . count(WC()->cart->get_cart()) . '">' . count(WC()->cart->get_cart()) . '</span>';


    return $fragments;
});


remove_action('woocommerce_account_navigation', 'woocommerce_account_navigation');

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
add_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 5);

add_action('woocommerce_before_shop_loop', function () {
    echo '<div class="woocommerce_before_shop_loop_action d-flex justify-content-between align-items-center mobile-column mt-5 mb-4">';
}, 5);

add_action('woocommerce_before_shop_loop', function () {
    echo '</div>';
}, 35);

remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

//переподключаем мету с артикулом после заговка
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 7);

//отключаем табы с отзывами и описанием
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

//убираем аватарки из отзывов
remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);


//убираем ссылки с картинок на странице продукта
add_filter('woocommerce_single_product_image_thumbnail_html', 'custom_remove_product_link');
function custom_remove_product_link($html)
{
    return strip_tags($html, '<div><img>');
}

function quadlayers($fields, $errors)
{
    // in case any validation errors
    if (!empty($errors->get_error_codes())) {

        // omit all existing error messages
        foreach ($errors->get_error_codes() as $code) {
            $errors->remove($code);
        }
        // display custom single error message
        $errors->add('validation', 'Пожалуйста, заполните все обязательные поля!');
    }
}
add_action('woocommerce_after_checkout_validation', 'quadlayers', 9999, 2);

function my_woocommerce_add_error($error)
{
    if ('Неверный адрес эл. почты для выставления счета' == $error) {
        $error = 'Пожалуйста, введите корректный email!';
    }
    return $error;
}
add_filter('woocommerce_add_error', 'my_woocommerce_add_error');

// опускаем вниз рекомендаванные товары на странице корзины
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 5);


// меняем количество отображаемых заказов в личном кабинете
function kbnt_my_account_orders($args)
{
    $args['posts_per_page'] = 30; // add number or -1 (display all orderes per page)
    return $args;
}
add_filter('woocommerce_my_account_my_orders_query', 'kbnt_my_account_orders', 10, 1);


//Отключение формы ввода купона, если он уже применён
add_filter('woocommerce_coupons_enabled', 'true_if_coupon_applied_checkout', 25);

function true_if_coupon_applied_checkout($coupons_enabled)
{

    // можете удалить это условие, тогда форма ввода купона пропадёт и в корзине
    if (! is_checkout()) {
        return $coupons_enabled;
    }

    if (! empty(WC()->cart->applied_coupons)) {
        return false;
    }

    return $coupons_enabled;
}

//Исчезающие сообщения об ошибках на странице «Оформление заказа»
add_action('wp_enqueue_scripts', 'true_checkout_error_fade_out', 25);

function true_checkout_error_fade_out()
{

    // если находимся не на странице оформления заказа, то ничего не делаем
    if (! is_checkout()) {
        return;
    }
    wc_enqueue_js("
		$( document.body ).on( 'checkout_error', function(){
			setTimeout( function(){
				$('.woocommerce-error').fadeOut( 300 );
			}, 3000);
		})
	");
}

//Отключение оплаты на сайте
add_filter('woocommerce_cart_needs_payment', '__return_false');

add_action('woocommerce_after_cart_item_name', 'truemisha_artikul_in_cart', 25);

//отобразить артикул товара в корзине
function truemisha_artikul_in_cart($cart_item)
{

    $sku = $cart_item['data']->get_sku();

    if ($sku) { // если заполнен, то выводим
        echo '<p class="mb-1"><small>Артикул: ' . $sku . '</small></p>';
    }
}


//меняем текст на кнопке при добавлении в корзину

add_filter('woocommerce_product_single_add_to_cart_text', 'expo_single_product_btn_text');

function expo_single_product_btn_text($text)
{

    if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id(get_the_ID()))) {
        $text = 'В корзине &#10003;';
    }

    return $text;
}

// для страниц каталога товаров, категорий товаров и т д
add_filter('woocommerce_product_add_to_cart_text', 'expo_product_btn_text', 20, 2);

function expo_product_btn_text($text, $product)
{

    if (
        $product->is_type('simple')
        && $product->is_purchasable()
        && $product->is_in_stock()
        && WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))
    ) {

        $text = 'В корзине &#10003;';
    }

    return $text;
}

//Отключение уведомления Вы отложили Товар в свою корзину
add_filter('wc_add_to_cart_message_html', '__return_null');

//делаем дату самовывоза обязательным полем
// add_filter( 'woocommerce_checkout_fields', 'expo_required_fields', 25 );

// function expo_required_fields( $fields ) {
//     $fields[ 'order' ][ 'order_date' ][ 'required' ] = true;
//     return $fields;

// }

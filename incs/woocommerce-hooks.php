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


/**
 * Фрагмент счётчика корзины (AJAX).
 * Считаем количество ТОВАРОВ (штук), а не строк. Разметка должна совпадать с header.php.
 */
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    if (! function_exists('WC') || ! WC()->cart) {
        return $fragments;
    }

    // Бейдж в шапке
    $count = WC()->cart->get_cart_contents_count();
    $fragments['span.cart-badge'] = sprintf(
        '<span class="cart-badge count-%1$d">%1$d</span>',
        (int) $count
    );

    // Содержимое мини-корзины
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();

    $fragments['div.expo-mini-cart-content'] = '<div class="expo-mini-cart-content">' . $mini_cart . '</div>';

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

// переподключаем мету с артикулом после заголовка
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 7);

// отключаем табы с отзывами и описанием
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// убираем аватарки из отзывов
remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);


// убираем ссылки с картинок на странице продукта
add_filter('woocommerce_single_product_image_thumbnail_html', 'custom_remove_product_link');
function custom_remove_product_link($html)
{
    return strip_tags($html, '<div><img>');
}


// единое сообщение об ошибке валидации чекаута
function quadlayers($fields, $errors)
{
    if (! empty($errors->get_error_codes())) {
        foreach ($errors->get_error_codes() as $code) {
            $errors->remove($code);
        }
        $errors->add('validation', 'Пожалуйста, заполните все обязательные поля!');
    }
}
add_action('woocommerce_after_checkout_validation', 'quadlayers', 9999, 2);


/**
 * Подмена текста ошибки про email.
 * Ищем по подстроке, а не по полному совпадению — устойчиво к смене перевода WooCommerce.
 */
function my_woocommerce_add_error($error)
{
    if (false !== mb_stripos($error, 'эл. почт')) {
        $error = 'Пожалуйста, введите корректный email!';
    }
    return $error;
}
add_filter('woocommerce_add_error', 'my_woocommerce_add_error');


// опускаем вниз рекомендованные товары на странице корзины
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 5);


// меняем количество отображаемых заказов в личном кабинете
function kbnt_my_account_orders($args)
{
    $args['posts_per_page'] = 30; // число или -1 (показать все заказы)
    return $args;
}
add_filter('woocommerce_my_account_my_orders_query', 'kbnt_my_account_orders', 10, 1);


// Отключение формы ввода купона, если он уже применён
add_filter('woocommerce_coupons_enabled', 'true_if_coupon_applied_checkout', 25);
function true_if_coupon_applied_checkout($coupons_enabled)
{
    // убрать это условие — и форма купона пропадёт также в корзине
    if (! is_checkout()) {
        return $coupons_enabled;
    }

    if (WC()->cart && ! empty(WC()->cart->applied_coupons)) {
        return false;
    }

    return $coupons_enabled;
}


// Исчезающие сообщения об ошибках на странице «Оформление заказа»
add_action('wp_enqueue_scripts', 'true_checkout_error_fade_out', 25);
function true_checkout_error_fade_out()
{
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


// Отключение оплаты на сайте
add_filter('woocommerce_cart_needs_payment', '__return_false');


// отобразить артикул товара в корзине
add_action('woocommerce_after_cart_item_name', 'truemisha_artikul_in_cart', 25);
function truemisha_artikul_in_cart($cart_item)
{
    $sku = $cart_item['data']->get_sku();

    if ($sku) { // если заполнен, то выводим (с экранированием)
        echo '<p class="mb-1"><small>Артикул: ' . esc_html($sku) . '</small></p>';
    }
}


// меняем текст на кнопке при добавлении в корзину (страница товара)
add_filter('woocommerce_product_single_add_to_cart_text', 'expo_single_product_btn_text');
function expo_single_product_btn_text($text)
{
    if (WC()->cart && WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id(get_the_ID()))) {
        $text = 'В корзине &#10003;';
    }

    return $text;
}

// для каталога, категорий и т.д.
add_filter('woocommerce_product_add_to_cart_text', 'expo_product_btn_text', 20, 2);
function expo_product_btn_text($text, $product)
{
    if (
        $product->is_type('simple')
        && $product->is_purchasable()
        && $product->is_in_stock()
        && WC()->cart
        && WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))
    ) {
        $text = 'В корзине &#10003;';
    }

    return $text;
}


// Отключение уведомления «Вы отложили товар в свою корзину»
add_filter('wc_add_to_cart_message_html', '__return_null');


// 1. Регистрируем кастомную валюту (символ BYN).
//    ВНИМАНИЕ: валюта магазина должна быть установлена в XGH в настройках WooCommerce.
add_filter('woocommerce_currencies', 'add_custom_gh_currency');
function add_custom_gh_currency($currencies)
{
    $currencies['XGH'] = __('Моя кастомная валюта (BYN)', 'woocommerce');
    return $currencies;
}

// 2. Символ для валюты XGH
add_filter('woocommerce_currency_symbol', 'add_custom_gh_currency_symbol', 10, 2);
function add_custom_gh_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'XGH':
            $currency_symbol = 'BYN';
            break;
    }
    return $currency_symbol;
}


/**
 * Гасим системное сообщение «Корзина обновлена».
 * ВАЖНО: фильтр woocommerce_add_message отдаёт МАССИВ (['notice' => ..., 'data' => ...]),
 * а не строку — поэтому проверяем аккуратно. Отдельный обработчик для
 * wc_add_to_cart_message_html не нужен: он уже полностью отключён выше через __return_null.
 */
add_filter('woocommerce_add_message', 'handler_remove_cart_updated_notice', 10, 1);
function handler_remove_cart_updated_notice($message)
{
    $text = is_array($message) ? ($message['notice'] ?? '') : (string) $message;

    if (false !== strpos($text, 'Корзина обновлена') || false !== strpos($text, 'Cart updated')) {
        return false; // отменяем вывод этого сообщения
    }

    return $message;
}

/**
 * Добавляет процент скидки рядом с ценой для товаров на распродаже.
 */
add_filter('woocommerce_get_price_html', 'expo_add_sale_percentage', 10, 2);
function expo_add_sale_percentage($price_html, $product)
{
    if (! $product->is_on_sale()) {
        return $price_html;
    }

    $percentage = 0;

    if ($product->is_type('variable')) {
        // У вариативного товара скидка может отличаться по вариациям — берём максимальную.
        $prices      = $product->get_variation_prices();
        $percentages = array();

        foreach ($prices['price'] as $key => $active_price) {
            $regular_price = (float) $prices['regular_price'][$key];
            $active_price  = (float) $active_price;

            if ($regular_price > 0 && $active_price < $regular_price) {
                $percentages[] = round(100 - ($active_price / $regular_price * 100));
            }
        }

        if ($percentages) {
            $percentage = max($percentages);
        }
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        if ($regular_price > 0 && $sale_price > 0 && $sale_price < $regular_price) {
            $percentage = round(100 - ($sale_price / $regular_price * 100));
        }
    }

    if ($percentage > 0) {
        $label = $product->is_type('variable') ? '-до ' . $percentage . '%' : '-' . $percentage . '%';
        $price_html .= ' <span class="sale-percentage">' . esc_html($label) . '</span>';
    }

    return $price_html;
}

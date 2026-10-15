<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    // OG-изображение можно вынести в настройки темы; пока оставляем заданное.
    $expo_og_image = 'https://opengraph.b-cdn.net/production/images/543bb5d3-779a-48ef-9795-4e4ff91670af.jpg?token=c79lG2LV5dLJwZ43fXI3axPOjg6VQ9kh5IOy5LpuNbM&height=660&width=900&expires=33293572783';
    $expo_site_name = get_bloginfo('name');
    ?>
    <!-- Open Graph -->
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr($expo_site_name); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta property="og:image" content="<?php echo esc_url($expo_og_image); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="<?php echo esc_attr(wp_parse_url(home_url(), PHP_URL_HOST)); ?>">
    <meta property="twitter:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($expo_site_name); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($expo_og_image); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="expo-container">
        <header class="expo-header">
            <div class="wrapper d-flex justify-content-between">
                <div class="header-navigation">
                    <div class="menu-header-menu-container">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                            <span class="logo-first">SAMI</span><span class="logo-second">LOR</span>
                        </a>
                        <ul id="primary-menu" class="header-menu header-menu-left">
                            <li class="menu-item menu-item-link menu-item-has-children">
                                <span><?php esc_html_e('КАТАЛОГ', 'expo'); ?></span>
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                                            <?php esc_html_e('Все товары', 'expo'); ?>
                                        </a>
                                    </li>
                                    <?php wp_list_categories(array('taxonomy' => 'product_cat', 'title_li' => '',)); ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-actions">
                    <ul class="header-menu header-menu-right">
                        <li class="menu-item-has-children">
                            <a href="#">
                                <?php get_template_part('template-parts/icons/icon', 'search'); ?>
                            </a>
                            <div class="menu-menyu-akkaunta-container">
                                <ul class="sub-menu">
                                    <li>
                                        <?php if (function_exists('aws_get_search_form')) {
                                            aws_get_search_form(true);
                                        } else {
                                            get_search_form();
                                        } ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" aria-label="<?php esc_attr_e('Личный кабинет', 'expo'); ?>">
                                <?php get_template_part('template-parts/icons/icon', 'account'); ?>
                            </a>
                        </li>
                        <?php if (function_exists('WC') && WC()->cart) : $expo_cart_count = WC()->cart->get_cart_contents_count(); ?>
                            <li>
                                <span class="open-cart" role="button" tabindex="0" aria-label="<?php esc_attr_e('Корзина', 'expo'); ?>">
                                    <?php get_template_part('template-parts/icons/icon', 'cart'); ?>
                                    <span class="cart-badge count-<?php echo (int) $expo_cart_count; ?>">
                                        <?php echo (int) $expo_cart_count; ?>
                                    </span>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </header>

        <div class="expo-mini-cart animate__fadeInRight hidden">
            <div>
                <div class="mini-card-close">
                    <?php get_template_part('template-parts/icons/icon', 'close'); ?>
                </div>
                <div>
                    <div class="expo-mini-cart-content">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
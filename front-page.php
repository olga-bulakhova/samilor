<?php

/**
 * Front page template.
 *
 * @package Expo
 */

get_header();

$expo_theme_options = expo_theme_options();
$expo_theme_info    = expo_theme_info();


$shop_url   = esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'));
$hero_title = esc_html($expo_theme_options['title'] ?? '');
$address    = esc_html($expo_theme_info['address'] ?? '');

$expo_see_all_link = static function ($url) {
    printf(
        '<a class="mt-1 desktop" href="%s"><span class="link-bold-hover-bolder">%s</span></a>',
        $url,
        esc_html__('Смотреть все товары', 'expo')
    );
};
?>

<main id="primary" class="home-page-main">
    <div class="home__heading">
        <div class="wrapper">
            <div class="heading-content">
                <div class="heading-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/img/photo.webp'); ?>"
                        alt="<?php echo $hero_title ? $hero_title : esc_attr__('Главное изображение', 'expo'); ?>"
                        fetchpriority="high"
                        decoding="async">
                </div>

                <div class="heading-info">
                    <h1><?php echo $hero_title; ?></h1>

                    <div class="heading-subtitle expo-subtitle"><?php echo $address; ?></div>

                    <a class="btn btn-expo-secondary" href="<?php echo $shop_url; ?>">
                        <?php esc_html_e('ПЕРЕЙТИ В КАТАЛОГ', 'expo'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('template-parts/categories'); ?>

    <section class="mt-6 expo-slick-slider">
        <div class="wrapper">
            <div class="mb-5 d-flex justify-content-between">
                <h2><?php esc_html_e('Новинки', 'expo'); ?></h2>
                <?php $expo_see_all_link(esc_url(add_query_arg('orderby', 'date', $shop_url))); ?>
            </div>
            <?php echo do_shortcode('[products limit="16" orderby="id" order="DESC" visibility="visible"]'); ?>
        </div>
    </section>

    <?php if (! empty(wc_get_featured_product_ids())) : ?>
        <section class="mt-12 mt-12-mobile mb-12 mb-12-mobile expo-slick-slider">
            <div class="wrapper">
                <div class="mb-5 d-flex justify-content-between">
                    <h2><?php esc_html_e('Рекомендуемые товары', 'expo'); ?></h2>
                    <?php $expo_see_all_link(esc_url(add_query_arg('orderby', 'rating', $shop_url))); ?>
                </div>
                <?php echo do_shortcode('[featured_products limit="16" orderby="rand"]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (count(wc_get_product_ids_on_sale()) > 4) : ?>
        <section class="mb-12 mb-12-mobile expo-slick-slider">
            <div class="wrapper">
                <div class="mb-5 d-flex justify-content-between">
                    <h2><?php esc_html_e('Распродажа', 'expo'); ?></h2>
                    <?php $expo_see_all_link($shop_url); ?>
                </div>
                <?php echo do_shortcode('[sale_products limit="16" orderby="rand"]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <section>
        <div class="wrapper">
            <h2><?php esc_html_e('Наши контакты', 'expo'); ?></h2>
            <div class="expo-subtitle mt-3 mb-5"><?php echo $address; ?></div>
        </div>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9387.779039548688!2d27.607302821718402!3d53.96824866334564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbc8ca71cbebcb%3A0xfda3f78ccdb9fdd!2sEXPOBEL!5e0!3m2!1sru!2sby!4v1697200404614!5m2!1sru!2sby"
            title="<?php esc_attr_e('Карта: EXPOBEL', 'expo'); ?>"
            width="100%" height="450" style="border:0;"
            allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section class="mt-6 mb-6">
        <div class="wrapper">
            <h2 class="mb-3"><?php esc_html_e('Доставка', 'expo'); ?></h2>
            <div class="light-text text-medium">
                <div class="mb-1"><?php esc_html_e('Мы отправляем товар по всей Беларуси (почта/европочта).', 'expo'); ?></div>
                <div class="text-bold"><?php esc_html_e('Важно!!! Работаем по предоплате - 15 руб!', 'expo'); ?></div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();

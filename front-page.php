<?php get_header() ?>
<?php $expo_theme_options = expo_theme_options();
global $product;
?>

<main id="primary" class="home-page-main">
    <div class="home__heading">

        <div class="wrapper">
            <div class="heading-content">
                <div class="heading-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/photo.webp" width="100%" alt="">
                </div>
                <div class="heading-info">
                    <h1>
                        ГОЛОВНЫЕ УБОРЫ, ШАРФЫ, ПЕРЧАТКИ
                    </h1>

                    <div class="heading-subtitle expo-subtitle">
                        МИНСК | ТЦ ЭКСПОБЕЛ | 2 этаж, павильон 22-23
                    </div>

                    <a class="btn btn-expo-secondary" href="/shop/">ПЕРЕЙТИ В КАТАЛОГ</a>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('template-parts/categories'); ?>

    <section class="mt-6 expo-slick-slider">
        <div class="wrapper">
            <div class="mb-5 d-flex justify-content-between">
                <h2>Новинки</h2>
                <a class="mt-1 desktop" href="/shop/?orderby=date"><span class="link-bold-hover-bolder">Смотреть все товары</span></a>
            </div>
            <?php echo do_shortcode('[products limit="16" orderby="id" order="DESC" visibility="visible"]') ?>
        </div>
    </section>

    <?php

    $featured_product_ids = wc_get_featured_product_ids();

    if (! empty($featured_product_ids)) :
    ?>
        <section class="mt-12 mt-12-mobile mb-12 mb-12-mobile expo-slick-slider">
            <div class="wrapper">
                <div class="mb-5 d-flex justify-content-between">
                    <h2>Рекомендуемые товары</h2>
                    <a class="mt-1 desktop" href="/shop/?orderby=rating">
                        <span class="link-bold-hover-bolder">Смотреть все товары</span>
                    </a>
                </div>
                <?php echo do_shortcode('[featured_products limit="16" orderby="rand"]') ?>
            </div>
        </section>
    <?php
    endif;
    ?>


    <?php if (count(wc_get_product_ids_on_sale()) > 4) : ?>
        <section class="mb-12 mb-12-mobile expo-slick-slider">
            <div class="wrapper">
                <div class="mb-5 d-flex justify-content-between">
                    <h2>Распродажа</h2>
                    <a class="mt-1 desktop" href="/shop/"><span
                            class="link-bold-hover-bolder">Смотреть все товары</span></a>
                </div>
                <?php echo do_shortcode('[sale_products limit="16" orderby="rand"]') ?>
            </div>
        </section>
    <?php endif; ?>


    <section>
        <div class="wrapper">
            <h2>Наши контакты</h2>

            <div class="expo-subtitle mt-3 mb-5">
                МИНСК | ТЦ ЭКСПОБЕЛ, 2 этаж, ряд 8-9, пав. 22-23
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9387.779039548688!2d27.607302821718402!3d53.96824866334564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbc8ca71cbebcb%3A0xfda3f78ccdb9fdd!2sEXPOBEL!5e0!3m2!1sru!2sby!4v1697200404614!5m2!1sru!2sby"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section class="mt-6 mb-6 ">
        <div class="wrapper">
            <h2 class="mb-3">Доставка</h2>
            <div class="light-text text-medium">
                <div class="mb-1">Мы отправляем товар по всей Беларуси (почта/европочта).</div>
                <div class="text-bold">Важно!!! Работаем по предоплате - 15 руб!</div>
            </div>
        </div>
    </section>

</main>

<?php get_footer() ?>
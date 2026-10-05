<?php get_header() ?>
<?php $expo_theme_options = expo_theme_options();
global $product;
?>

<main id="primary" class="home-page-main">
    <div class="home__heading">
        <div class="heading-overlay">
            <div class="wrapper">
                <div class="heading-content">
                    <h1>
                        <?php echo $expo_theme_options['title'] ?>
                    </h1>
                    <div class="text-large mt-3 mb-4">
                        <?php echo $expo_theme_options['text'] ?>
                    </div>
                    <a class="btn btn-expo-secondary" href="/shop/">ПЕРЕЙТИ В КАТАЛОГ</a>
                </div>
            </div>
        </div>
    </div>
</main>

<section class="mt-6 expo-slick-slider">
    <div class="wrapper">
        <div class="mb-5 d-flex justify-content-between">
            <h2>Новинки</h2>
            <a class="mt-1 desktop" href="/shop/?orderby=date"><span class="link-bold-hover-bolder">Смотреть все товары</span></a>
        </div>
        <?php echo do_shortcode('[products limit="16" orderby="id" order="DESC" visibility="visible"]') ?>
    </div>
</section>

<section class="mt-12 mt-12-mobile mb-12 mb-12-mobile expo-slick-slider">
    <div class="wrapper">
        <div class="mb-5 d-flex justify-content-between">
            <h2>Рекомендуемые товары</h2>
            <a class="mt-1 desktop" href="/shop/?orderby=rating"><span class="link-bold-hover-bolder">Смотреть все товары</span></a>
        </div>
        <?php echo do_shortcode('[featured_products limit="16" orderby="rand"]') ?>
    </div>
</section>

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

<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9387.779039548688!2d27.607302821718402!3d53.96824866334564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbc8ca71cbebcb%3A0xfda3f78ccdb9fdd!2sEXPOBEL!5e0!3m2!1sru!2sby!4v1697200404614!5m2!1sru!2sby"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe> -->

<?php get_footer() ?>
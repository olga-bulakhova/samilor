<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<div <?php wc_product_class('expo-product-card', $product); ?>>
    <div class="product-card">
        <div class="ajax-loader">
            <img src="<?php echo get_template_directory_uri(); ?>/img/rolling.svg" alt="">
        </div>
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('woocommerce_before_shop_loop_item');

        ?>

        <div class="mb-2 product-main">
            <div class="product-thumb">
                <a href="<?php echo $product->get_permalink() ?>">
                    <?php

                    /**
                     * Hook: woocommerce_before_shop_loop_item_title.
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action('woocommerce_before_shop_loop_item_title');

                    ?>
                </a>
            </div><!-- ./product-thumb -->

            <div class="product-details mt-2">
                <?php

                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action('woocommerce_shop_loop_item_title');
                ?>

                <div>
                    <h4>
                        <a href="<?php echo $product->get_permalink() ?>"><?php echo $product->get_title() ?></a>
                    </h4>
                    <!-- <?php woocommerce_template_loop_rating(); ?> -->
                </div>

                <h5 class="mt-05 mb-1 fw-400">
                    <?php

                    if (!empty($product->get_sku())) {
                        echo 'Артикул: ' . $product->get_sku();
                    }

                    ?>
                </h5>

                <?php
                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('woocommerce_after_shop_loop_item_title');
                ?>
            </div>
        </div>

        <?php

        /**
         * Hook: woocommerce_after_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action('woocommerce_after_shop_loop_item');


        ?>


    </div><!-- ./product-card -->
</div><!-- ./col-lg-3 col-md-4 col-sm-6 mb-3 -->
<?php

/**
 * Checkout Form
 *
 * @see https://woocommerce.com
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (! defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// Если пользователь не авторизован и включен вход, WooCommerce выведет форму авторизации выше
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout custom-checkout-layout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()) : ?>

        <!-- ЛЕВАЯ КОЛОНКА: Данные покупателя и доставка -->
        <div class="checkout-billing-fields" id="customer_details">
            <div class="checkout-block-card">
                <?php do_action('woocommerce_checkout_billing'); ?>
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
        </div>

    <?php endif; ?>

    <!-- ПРАВАЯ КОЛОНКА: Ваш заказ и оплата (Sticky) -->
    <div class="checkout-order-review-sidebar">
        <div class="checkout-sticky-card" id="order_review">
            <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

            <div class="checkout-order-review-inner">
                <?php do_action('woocommerce_checkout_order_review'); ?>
            </div>
        </div>
    </div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
<?php

/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * @see     https://woocommerce.com
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined('ABSPATH') || exit;

// Проверяем, нужно ли вообще показывать адреса для этого заказа (например, для физических товаров)
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details custom-customer-details-layout">

  <?php do_action('woocommerce_order_details_before_customer_details', $order); ?>

  <div class="woocommerce-columns woocommerce-columns--addresses col2-set addresses">

    <!-- ОСТАВЛЯЕМ ТОЛЬКО ОДНУ МОНОЛИТНУЮ КАРТОЧКУ АДРЕСА -->
    <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2 address-card">

      <h3><?php esc_html_e('Адрес доставки', 'woocommerce'); ?></h3>

      <address>
        <!-- Выводим адрес доставки (куда курьеру везти товар) -->
        <?php echo wp_kses_post($order->get_formatted_shipping_address() ? $order->get_formatted_shipping_address() : esc_html__('No shipping address set.', 'woocommerce')); ?>

        <!-- Сюда же аккуратно подтягиваем Телефон и Email покупателя, чтобы они не потерялись -->
        <?php if ($order->get_billing_phone()) : ?>
          <p class="woocommerce-customer-details--phone address-phone">
            📞 <?php echo esc_html($order->get_billing_phone()); ?>
          </p>
        <?php endif; ?>

        <?php if ($order->get_billing_email()) : ?>
          <p class="woocommerce-customer-details--email address-email">
            ✉️ <?php echo esc_html($order->get_billing_email()); ?>
          </p>
        <?php endif; ?>
      </address>

    </div>

  </div>

  <?php do_action('woocommerce_order_details_after_customer_details', $order); ?>

</section>
<?php

/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (! wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
  $get_addresses = apply_filters(
    'woocommerce_my_account_get_addresses',
    array(
      'billing'  => __('Billing address', 'woocommerce'),
      'shipping' => __('Shipping address', 'woocommerce'),
    ),
    $customer_id
  );
} else {
  $get_addresses = apply_filters(
    'woocommerce_my_account_get_addresses',
    array(
      'billing' => __('Billing address', 'woocommerce'),
    ),
    $customer_id
  );
}

$oldcol = 1;
$col    = 1;
?>

<div class="custom-addresses-section">
  <div class="addresses-section-header mb-4">
    <h2><?php echo apply_filters('the_title', __('Addresses', 'woocommerce')); ?></h2>
    <p class="woocommerce-Addresses-description description">
      <?php echo apply_filters('woocommerce_my_account_my_address_description', esc_html__('The following addresses will be used on the checkout page by default.', 'woocommerce')); ?>
    </p>
  </div>

  <!-- Сетка карточек -->
  <div class="addresses-cards-grid">
    <?php foreach ($get_addresses as $name => $address_title) : ?>
      <?php
      $address = wc_get_account_formatted_address($name);
      $col     = $col * -1;
      $oldcol  = $oldcol * -1;
      ?>

      <div class="address-card-item account-address-<?php echo esc_attr($name); ?>">
        <div class="address-card-inner">

          <!-- Шапка карточки -->
          <div class="address-card-header">
            <h3><?php echo esc_html($address_title); ?></h3>
          </div>

          <!-- Тело карточки: Вывод адреса -->
          <div class="address-card-body">
            <address>
              <?php
              if ($address) {
                echo wp_kses_post($address);
              } else {
                esc_html_e('You have not set up this type of address yet.', 'woocommerce');
              }

              // Обязательный системный экшен WooCommerce
              do_action('woocommerce_my_account_after_my_address', $name);
              ?>
            </address>
          </div>

          <!-- Подвал карточки с кнопкой -->
          <div class="address-card-footer">
            <a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>" class="address-edit-btn">
              <?php echo $address ? esc_html__('Edit', 'woocommerce') : esc_html__('Add', 'woocommerce'); ?>
            </a>
          </div>

        </div>
      </div>

    <?php endforeach; ?>
  </div>
</div>
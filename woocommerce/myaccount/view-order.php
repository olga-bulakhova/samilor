<?php

/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();
$status_slug = $order->get_status();
$status_name = wc_get_order_status_name($status_slug);
?>

<div class="custom-view-order">
  <div class="view-order-header mb-3">
    <h2>
      <?php printf(esc_html__('Заказ #%s', 'woocommerce'), '<mark class="order-number">' . $order->get_order_number() . '</mark>'); ?>
    </h2>
    <div class="order-date-status">
      <span class="order-date"><?php printf(esc_html__('Оформлен %s', 'woocommerce'), '<time datetime="' . esc_attr($order->get_date_created()->date('c')) . '">' . esc_html(wc_format_datetime($order->get_date_created())) . '</time>'); ?></span>
      <div class="order-status-badge badge-<?php echo esc_attr($status_slug); ?>">
        <?php echo esc_html($status_name); ?>
      </div>
    </div>
  </div>

  <?php if ($notes) : ?>
    <div class="order-notes-block mb-4">
      <h3><?php esc_html_e('Обновления по заказу', 'woocommerce'); ?></h3>
      <ol class="woocommerce-OrderUpdates commentlist notes">
        <?php foreach ($notes as $note) : ?>
          <li class="woocommerce-OrderUpdate comment note">
            <div class="woocommerce-OrderUpdate-inner comment_container">
              <div class="woocommerce-OrderUpdate-text comment-text">
                <p class="woocommerce-OrderUpdate-meta meta"><?php echo esc_html(wc_format_datetime($note->date_created)); ?></p>
                <div class="woocommerce-OrderUpdate-description description">
                  <?php echo wpautop(wptexturize($note->content)); ?>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  <?php endif; ?>

  <div class="order-details-wrapper">
    <div class="order-table-container">
      <?php do_action('woocommerce_view_order', $order_id); ?>
    </div>
  </div>
</div>
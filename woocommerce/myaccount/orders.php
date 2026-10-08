<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>

  <div class="custom-orders-section">
    <div class="custom-orders-list">
      <?php
      foreach ($customer_orders->orders as $customer_order) {
        $order      = wc_get_order($customer_order);
        $item_count = $order->get_item_count() - $order->get_item_count_refunded();
        $status_slug = $order->get_status();
        $status_name = wc_get_order_status_name($status_slug);
        $order_date = wc_format_datetime($order->get_date_created());
      ?>

        <div class="order-card status-<?php echo esc_attr($status_slug); ?>">
          <!-- Шапка карточки -->
          <div class="order-card-header">
            <div class="order-info-main">
              <span class="order-number">
                <?php esc_html_e('Заказ', 'woocommerce'); ?>
                <a href="<?php echo esc_url($order->get_view_order_url()); ?>" class="order-id">
                  #<?php echo $order->get_order_number(); ?>
                </a>
              </span>
              <span class="order-date"><time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html($order_date); ?></time></span>
            </div>
            <!-- Бейдж статуса -->
            <div class="order-status-badge badge-<?php echo esc_attr($status_slug); ?>">
              <?php echo esc_html($status_name); ?>
            </div>
          </div>

          <!-- Контент карточки -->
          <div class="order-card-body">
            <div class="order-meta-info">
              <div class="meta-item">
                <span class="meta-label">Товаров:</span>
                <span class="meta-value"><?php echo esc_html($item_count); ?></span>
              </div>
              <div class="meta-item">
                <span class="meta-label">Сумма заказа:</span>
                <span class="meta-value order-total-price"><?php echo wp_kses_post($order->get_formatted_order_total()); ?></span>
              </div>

              <!-- Интеграция кастомных колонок от других плагинов через хук -->
              <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
                <?php if (!in_array($column_id, ['order-number', 'order-date', 'order-status', 'order-total', 'order-actions'])) : ?>
                  <div class="meta-item custom-column-<?php echo esc_attr($column_id); ?>">
                    <span class="meta-label"><?php echo esc_html($column_name); ?>:</span>
                    <span class="meta-value"><?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?></span>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Кнопки действий -->
          <div class="order-card-actions">
            <?php
            $actions = wc_get_account_orders_actions($order);

            if (! empty($actions)) {
              foreach ($actions as $key => $action) {
                $action_aria_label = empty($action['aria-label']) ? sprintf(__('%1$s order number %2$s', 'woocommerce'), $action['name'], $order->get_order_number()) : $action['aria-label'];

                // Стилизуем кнопку "Посмотреть" отдельно от остальных
                $extra_class = ('view' === $key) ? 'btn-view-order' : 'btn-secondary-order';

                echo '<a href="' . esc_url($action['url']) . '" class="order-action-btn ' . esc_attr($extra_class) . ' ' . sanitize_html_class($key) . '" aria-label="' . esc_attr($action_aria_label) . '">' . esc_html($action['name']) . '</a>';
              }
            }
            ?>
          </div>
          
        </div>
      <?php
      }
      ?>
    </div>
  </div>

  <?php do_action('woocommerce_before_account_orders_pagination'); ?>

  <!-- Постраничная навигация -->
  <?php if (1 < $customer_orders->max_num_pages) : ?>
    <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
      <?php if (1 !== $current_page) : ?>
        <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce'); ?></a>
      <?php endif; ?>

      <?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
        <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce'); ?></a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

<?php else : ?>

  <!-- Заглушка, если покупок нет -->
  <div class="no-orders-wrapper text-center">
    <span class="no-orders-icon">🛒</span>
    <p><?php esc_html_e('No order has been made yet.', 'woocommerce'); ?></p>
    <a class="order-action-btn btn-view-order" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
      <?php esc_html_e('Browse products', 'woocommerce'); ?>
    </a>
  </div>

<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
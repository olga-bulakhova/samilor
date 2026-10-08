<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if (! defined('ABSPATH')) {
  exit;
}

if (! apply_filters('woocommerce_order_item_visible', true, $item)) {
  return;
}
?>
<tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">

  <td class="woocommerce-table__product-name product-name">
    <div class="product-view-order-flex">
      <!-- БЛОК С КАРТИНКОЙ ТОВАРА -->
      <div class="product-view-order-thumb">
        <?php
        // Получаем объект товара (родительский или вариацию)
        $product = $item->get_product();

        if ($product) {
          // Выводим миниатюру товара. Размеры: thumbnail (или medium/woocommerce_thumbnail)
          $image_src = wp_get_attachment_image_url($product->get_image_id(), 'thumbnail');

          if (! $image_src) {
            $image_src = wc_placeholder_img_src(); // Заглушка, если фото нет
          }
        } else {
          $image_src = wc_placeholder_img_src();
        }

        // Если товар ещё существует в админке, делаем картинку кликабельной ссылки
        $is_visible        = $product && $product->is_visible();
        $product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);

        if ($product_permalink) {
          echo '<a href="' . esc_url($product_permalink) . '"><img src="' . esc_url($image_src) . '" alt="' . esc_attr($item->get_name()) . '" loading="lazy"></a>';
        } else {
          echo '<img src="' . esc_url($image_src) . '" alt="' . esc_attr($item->get_name()) . '" loading="lazy">';
        }
        ?>
      </div>

      <!-- БЛОК С НАЗВАНИЕМ И ХАРАКТЕРИСТИКАМИ -->
      <div class="product-view-order-info">
        <?php
        if ($product_permalink) {
          echo wp_kses_post(apply_filters('woocommerce_order_item_name', sprintf('<a href="%s" class="product-title-link">%s</a>', esc_url($product_permalink), $item->get_name()), $item, $is_visible));
        } else {
          echo wp_kses_post(apply_filters('woocommerce_order_item_name', $item->get_name(), $item, $is_visible));
        }

        // Вывод количества
        $qty          = $item->get_quantity();
        $refunded_qty = $order->get_qty_refunded_for_item($item_id);

        if ($refunded_qty) {
          $qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - $refunded_qty) . '</ins>';
        } else {
          $qty_display = esc_html($qty);
        }

        echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $qty_display) . '</strong>', $item);

        // Вывод мета-данных (Выбранные вариации: цвет, размер и т.д.)
        do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

        wc_display_item_meta($item); // Нативный выводитель свойств вроде "Цвет: Черный"

        do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
        ?>
      </div>
    </div>
  </td>

  <td class="woocommerce-table__product-total product-total">
    <?php echo $order->get_formatted_line_subtotal($item); ?>
  </td>

</tr>

<?php if ($show_purchase_note && $purchase_note) : ?>
  <tr class="woocommerce-table__purchase-note purchase-note">
    <td colspan="2"><?php echo wpautop(wptexturize($purchase_note)); ?></td>
  </tr>
<?php endif; ?>
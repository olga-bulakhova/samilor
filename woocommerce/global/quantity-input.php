<?php

/**
 * Product quantity input
 * @version 7.8.0
 */

if (! defined('ABSPATH')) {
  exit;
}

if ($max_value && $min_value === $max_value) {
?>
  <div class="quantity hidden">
    <input type="hidden" id="<?php echo esc_attr($input_id); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($min_value); ?>" />
  </div>
<?php
} else {
  // Начальное состояние кнопок, чтобы не мигали до загрузки JS.
  $is_at_min = ($input_value <= $min_value);
  $is_at_max = ($max_value !== '' && $max_value > 0 && $input_value >= $max_value);
?>
  <div class="quantity quantity-controls">
    <button type="button" class="quantity-btn minus" aria-label="<?php esc_attr_e('Уменьшить количество', 'woocommerce'); ?>" <?php disabled($is_at_min, true); ?>>
      <span aria-hidden="true">&minus;</span>
    </button>
    <input
      type="number"
      id="<?php echo esc_attr($input_id); ?>"
      class="<?php echo esc_attr(join(' ', (array) $classes)); ?>"
      step="<?php echo esc_attr($step); ?>"
      min="<?php echo esc_attr($min_value); ?>"
      max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
      name="<?php echo esc_attr($input_name); ?>"
      value="<?php echo esc_attr($input_value); ?>"
      title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'woocommerce'); ?>"
      size="4"
      placeholder="<?php echo esc_attr($placeholder); ?>"
      inputmode="<?php echo esc_attr($inputmode); ?>"
      autocomplete="off" />
    <button type="button" class="quantity-btn plus" aria-label="<?php esc_attr_e('Увеличить количество', 'woocommerce'); ?>" <?php disabled($is_at_max, true); ?>>
      <span aria-hidden="true">+</span>
    </button>
  </div>
<?php
}

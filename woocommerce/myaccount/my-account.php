<?php

/**
 * My Account page
 * @version 3.5.0
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-breadcrumb mb-4">
  <?php
  woocommerce_breadcrumb(array(
    'delimiter'   => ' <span class="bc-delimiter">/</span> ',
    'wrap_before' => '<nav class="woocommerce-breadcrumb-custom">',
    'wrap_after'  => '</nav>',
    'before'      => '<span class="bc-item">',
    'after'       => '</span>',
    'home'        => _x('Главная', 'breadcrumb', 'woocommerce'),
  ));
  ?>
</div>

<div class="custom-my-account-layout">
  <main class="my-account-content">
    <div class="my-account-content-inner">
      <?php do_action('woocommerce_account_content'); ?>
    </div>
  </main>
</div>
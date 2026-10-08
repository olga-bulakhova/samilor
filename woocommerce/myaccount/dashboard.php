<?php

/**
 * My Account dashboard
 * @version 4.4.0
 */

defined('ABSPATH') || exit;

$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
);
?>

<div class="account-dashboard-welcome">
    <h2>Рады видеть вас снова, <?php echo esc_html(wp_get_current_user()->display_name); ?>!</h2>
    <p>В своем личном кабинете вы можете отслеживать текущие заказы, управлять адресами доставки и менять пароль.</p>

    <!-- Сетка быстрого доступа -->
    <div class="dashboard-quick-links">
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="quick-link-card">
            <span class="card-icon">📦</span>
            <h3>Мои заказы</h3>
            <p>Проверить статус и историю покупок</p>
        </a>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="quick-link-card">
            <span class="card-icon">📍</span>
            <h3>Адреса</h3>
            <p>Настройка точек и параметров доставки</p>
        </a>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="quick-link-card">
            <span class="card-icon">⚙️</span>
            <h3>Профиль</h3>
            <p>Изменить пароль и личные данные</p>
        </a>
    </div>
</div>
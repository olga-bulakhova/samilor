jQuery(function ($) {
	if (!$('.cart_shop_table').length) return

	let timerId

	$(document).on('change', '.woocommerce-cart-form .qty', function () {
		clearTimeout(timerId)
		timerId = setTimeout(updateCartAjax, 500)
	})

	function updateCartAjax() {
		const $form = $('.woocommerce-cart-form')
		if (!$form.length) return

		const data = $form.serializeArray()
		data.push({ name: 'update_cart', value: '1' })

		$.ajax({
			type: 'POST',
			url: $form.attr('action') || window.location.href,
			data: $.param(data),
			beforeSend: function () {
				$form.css('opacity', 0.5)
			},
			complete: function () {
				$('.woocommerce-cart-form').css('opacity', 1)
			},
			success: function (html) {
				// scripts не выполняем — безопасный парсинг
				const $dom = $('<div>').append($.parseHTML(html))

				// 1. Таблица корзины и итоги
				const $freshForm = $dom.find('.woocommerce-cart-form').first()
				const $freshTotals = $dom.find('.cart-collaterals').first()
				if ($freshForm.length) {
					$('.woocommerce-cart-form').replaceWith($freshForm)
				}
				if ($freshTotals.length && $('.cart-collaterals').length) {
					$('.cart-collaterals').first().replaceWith($freshTotals)
				}

				// 2. Бейдж в шапке — берём напрямую из ответа
				const $freshBadge = $dom.find('.cart-badge').first()
				if ($freshBadge.length && $('.cart-badge').length) {
					$('.cart-badge').replaceWith($freshBadge)
				}

				// 3. Мини-корзина — тоже из ответа
				const $freshMini = $dom.find('.expo-mini-cart-content').first()
				if ($freshMini.length && $('.expo-mini-cart-content').length) {
					$('.expo-mini-cart-content').replaceWith($freshMini)
				}
			},
		})
	}
})

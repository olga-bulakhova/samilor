jQuery(document).ready(function ($) {
	// Сколько знаков после запятой у шага — чтобы не ловить 0.30000000004
	function stepDecimals(step) {
		const s = String(step)
		return s.indexOf('.') >= 0 ? s.split('.')[1].length : 0
	}

	// Привести значение к шагу/границам и обновить состояние кнопок
	function syncControls($container) {
		const $input = $container.find('input[type="number"]')
		if (!$input.length) return

		const step = parseFloat($input.attr('step')) || 1
		// По умолчанию минимум = 1 (кнопка «минус» гаснет на единице)
		const min = $input.attr('min') !== undefined && $input.attr('min') !== '' ? parseFloat($input.attr('min')) : 1
		const maxAttr = $input.attr('max')
		const max = maxAttr !== undefined && maxAttr !== '' ? parseFloat(maxAttr) : null

		let val = parseFloat($input.val())
		if (isNaN(val)) val = min

		// Клампинг в границы
		if (val < min) val = min
		if (max !== null && val > max) val = max

		$input.val(val.toFixed(stepDecimals(step)))

		// Включаем/выключаем кнопки
		$container.find('.quantity-btn.minus').prop('disabled', val <= min)
		$container.find('.quantity-btn.plus').prop('disabled', max !== null && val >= max)
	}

	// Клик по +/−
	$(document).on('click', '.quantity-btn', function (e) {
		e.preventDefault()

		const $button = $(this)
		if ($button.prop('disabled')) return

		const $container = $button.closest('.quantity-controls')
		const $input = $container.find('input[type="number"]')

		const step = parseFloat($input.attr('step')) || 1
		const min = $input.attr('min') !== undefined && $input.attr('min') !== '' ? parseFloat($input.attr('min')) : 1
		const maxAttr = $input.attr('max')
		const max = maxAttr !== undefined && maxAttr !== '' ? parseFloat(maxAttr) : null

		let val = parseFloat($input.val()) || min

		if ($button.hasClass('plus')) {
			if (max === null || val < max) val += step
		} else {
			if (val > min) val -= step
		}

		$input.val(val.toFixed(stepDecimals(step)))
		syncControls($container)
		$input.trigger('change')
	})

	// Ручной ввод в поле — тоже синхронизируем
	$(document).on('input change', '.quantity-controls input[type="number"]', function () {
		syncControls($(this).closest('.quantity-controls'))
	})

	// Инициализация при загрузке
	$('.quantity-controls').each(function () {
		syncControls($(this))
	})

	// Корзина WooCommerce перерисовывается через AJAX — переинициализируем
	$(document.body).on('updated_wc_div updated_cart_totals wc_fragments_refreshed', function () {
		$('.quantity-controls').each(function () {
			syncControls($(this))
		})
	})
})

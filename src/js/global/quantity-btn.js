jQuery(document).ready(function ($) {
	$(document).on('click', '.quantity-btn', function (e) {
		e.preventDefault()

		const $button = $(this)
		const $container = $button.closest('.quantity-controls')
		const $input = $container.find('input[type="number"]')

		// Получаем текущие значения, минимумы, максимумы и шаг
		let currentVal = parseFloat($input.val()) || 0
		const max = parseFloat($input.attr('max'))
		const min = parseFloat($input.attr('min')) || 0
		const step = parseFloat($input.attr('step')) || 1

		if ($button.hasClass('plus')) {
			// Клик по плюсу
			if (!max || currentVal < max) {
				$input.val((currentVal + step).toFixed(0))
			}
		} else {
			// Клик по минусу
			if (currentVal > min) {
				$input.val((currentVal - step).toFixed(0))
			}
		}


		$input.trigger('change')
	})
})

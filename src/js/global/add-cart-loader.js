jQuery(document).ready(function ($) {
	$('body').on('added_to_cart', function (e, fragments, cart_hash, $button) {
		const $btn = $($button)

		setTimeout(function () {
			$btn.addClass('text-transparent')
		}, 800)

		setTimeout(function () {
			$btn.removeClass('text-transparent')
			$btn.text('В корзине ✓')
		}, 3000)
	})
})

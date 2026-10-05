jQuery(document).ready(function ($) {
	// $('body').on('adding_to_cart', function (e, btn, data) {
	// 	btn.closest('.product-card').find('.ajax-loader').fadeIn()
	// })

	$('body').on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
		const $btn = $(btn[0])
		setTimeout(() => $btn.text('В корзине ✓'), 4000)
		//btn.closest('.product-card').find('.ajax-loader').fadeOut()
	})
})

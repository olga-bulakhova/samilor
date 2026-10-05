// jQuery(function ($) {
// 	$(document.body).on('adding_to_cart', function (event, button) {
// 		const $btn = $(button[0])
// 		const product_title = $btn.closest('.product-card').find('h4').text()

// 		setTimeout(() => $btn.text('В корзине ✓'), 4000)

// 		if (product_title) {
// 			const tpl = `
// 		    <div class="mb-2">Товар ${product_title} добавлен в корзину</div>

// 		       <a class="btn-expo-secondary btn-sm w-100 inline-block mb-1" onclick="jQuery.unblockUI();" style="cursor: pointer">Продолжить покупки</a>
// 		       <br>
// 		       <a href="/cart/" class="btn-expo-secondary btn-sm inline-block w-100">Оформить заказ</a>

// 		  `

// 			$.blockUI({
// 				message: tpl,
// 				timeout: 6000,
// 				showOverlay: false,
// 				centerY: false,
// 				fadeIn: 700,
// 				fadeOut: 700,
// 				css: {
// 					width: '300px',
// 					top: '10px',
// 					left: '',
// 					right: '10px',
// 					border: 'none',
// 					padding: '20px',
// 					backgroundColor: '#eaeff3',
// 					boxShadow: '0px 8px 15px rgba(0, 0, 0, 0.1)',
// 					borderRadius: '5px',
// 					cursor: 'initial',
// 				},
// 			})
// 		}
// 	})
// })

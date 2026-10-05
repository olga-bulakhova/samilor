jQuery(document).ready(function ($) {
	const menuItem = $('.menu-item-has-children')

	menuItem.on('click', function (e) {
		const subMenu = $(this).find('.sub-menu')
		subMenu.css('visibility', 'visible')
		$(document).one('mouseup', e => {
			if (!subMenu.is(e.target) && subMenu.has(e.target).length === 0) {
				subMenu.css('visibility', 'hidden')
			}
		})
	})
})

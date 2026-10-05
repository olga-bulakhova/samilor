jQuery(document).ready(function($) {

    const miniCart = $('.expo-mini-cart');

    $('.open-cart').on('click', function () {
        miniCart.toggle();
    })

    $('.mini-card-close').on('click', function () {
        miniCart.hide();
    })

    $(document).on('mouseup', (e) => {
        if ( !miniCart.is(e.target)
            && miniCart.has(e.target).length === 0 ) { // и не по его дочерним элементам
            miniCart.hide();
        }
    })

})
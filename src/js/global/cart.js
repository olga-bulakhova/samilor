jQuery( function( $ ) {
    if(!($('.cart_shop_table').length)) return;
    let timerId;

    $( 'body' ).on( 'change', '.qty', function() {
        clearTimeout(timerId);
        timerId = setTimeout(() => {
            $( '[name="update_cart"]' ).trigger( 'click' );
        }, 400);
    } );

} );
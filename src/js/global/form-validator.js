jQuery(document).ready(function($) {

    $('.expo-checkout-form').validate({
        rules: {
            billing_first_name: {
                required: true,
            },
            billing_city: {
                required: true,
            },
            billing_phone: {
                required: true,
            },
            billing_email: {
                required: true,
                email: true
            },
            order_date: {
                required: true,
            },

        },
        messages: {
            billing_first_name: '',
            billing_city: '',
            billing_phone: '',
            billing_email: '',
            order_date: '',
        },
    });

})

jQuery(document).ready(function($) {

    const field = $( "#order_date" );

    field.attr('autocomplete', 'off');

    field.datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: false,
        monthNamesShort: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
        dayNamesMin: [ "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс" ],
        minDate: new Date(),
        dateFormat: "dd/mm/yy"
    });

});
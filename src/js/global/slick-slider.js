jQuery(document).ready(function($) {

    const slider = $(".expo-slick-slider .products");

    if(!slider.length) return;

    slider
        .on('init', function(event, slick){
            const h = $(this).height();
            const items = $(this).find('.slick-slide')

            items.each(function (i, el) {
                const element = $(el);
                const elHeight = element.height();
                const x = element.find('.button');
                const y = h - elHeight;
                x.css({
                    'position' : 'relative',
                    'bottom' : `-${y}px`
                })
            })

           slider.css('opacity', 1);
        })
        .slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: false,
        arrows: true,
        adaptiveHeight: false,
        lazyLoad: 'progressive',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true,
                    arrows: false,
                }
            },

            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            },
        ]
    });

});


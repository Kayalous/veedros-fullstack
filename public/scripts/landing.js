$(".owl-carousel").owlCarousel({
    rewind: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 4000,
    nav: true,
    dotsEach: true,
    dots: true,
    responsive: {
        1200: {
            items: 2
        },
        992: {
            items: 1
        },
        768: {
            items: 1
        },
        0: {
            items: 1
        }
    },
    autoplayHoverPause: true
});

$(document).ready(function() {
    $('.instagram .owl-carousel').owlCarousel({
        loop: false,
        margin: 5,
        dots: true,
        nav: true,
        navText: ["<div class='prev icon icon-back'></div>",
            "<div class='next icon icon-forward'></div>"
        ],
        // navContainer: '.instagram .slider-nav',
        dotsContainer: '.instagram .owl-dots',
        responsive: {
            0: {
                items: 1,
            },
            410: {
                items: 2,
            },
            735: {
                items: 3,
            },
            1030: {
                items: 4,
            },
            1270: {
                items: 5,
            },
        }
    });

    $('.scrollbar-inner').scrollbar({
        scrollx: false
    });
});    
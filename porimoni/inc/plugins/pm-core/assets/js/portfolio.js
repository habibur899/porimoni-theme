(function ($) {
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/hello-world.default', function (scope, $) {
            setTimeout(function () {
                /* START ISOTOP JS */
                var $grid = $(scope).find('.work_content_area').isotope({
                    // options
                });
                // filter items on button click
                $(scope).find('.work_filter').on('click', 'li', function () {
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({filter: filterValue});
                });
                // filter items on button click
                $(scope).find('.work_filter').on('click', 'li', function () {
                    $(this).addClass('active').siblings().removeClass('active')
                });
                /* END ISOTOP JS */
            }, 2000);
        });
    });
})(jQuery);

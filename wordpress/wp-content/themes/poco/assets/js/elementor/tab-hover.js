(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/poco-tab-hover.default', ($scope) => {
            let $tabs = $scope.find('.tab-title .tab-item');
            let $contents = $scope.find('.tab-content');
            let $contentsItem = $scope.find('.tab-content-item');

            // Setup
            $tabs.first().addClass("active");
            $contentsItem.first().addClass("active");

            $tabs.on('click', function (e) {
                e.preventDefault();
                $tabs.removeClass('active');
                $contentsItem.removeClass('active');
                $(this).addClass('active');
                let id = $(this).attr('data-setting-key');
                $contents.find('#' + id).addClass('active');

            });

            $(window).on('load resize orientationchange', function () {
                var $carousel = $('.tab-content', $scope);
                if ($carousel.length > 0) {
                    var data = $carousel.data('settings');

                    if ($(window).width() > 768) {
                        if ($carousel.hasClass('slick-initialized')) {
                            $carousel.slick('unslick');
                        }
                    } else {
                        if (!$carousel.hasClass('slick-initialized')) {
                            $carousel.slick({
                                dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                                arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                                infinite: data.loop,
                                speed: 300,
                                slidesToShow: parseInt(data.items),
                                autoplay: false,
                                autoplaySpeed: 5000,
                                slidesToScroll: 1,
                                lazyLoad: 'ondemand',
                                rtl: data.rtl,
                                mobileFirst: true,
                            });
                        }
                    }
                }
            });
        });
    });

})(jQuery);
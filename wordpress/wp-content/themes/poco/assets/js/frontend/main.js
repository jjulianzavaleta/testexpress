(function ($) {
    'use strict';

    function login_dropdown() {
        $('.site-header-account').mouseenter(function () {
            $('.account-dropdown', this).append($('.account-wrap'));
        });
    }

    function handleWindow() {
        var body = document.querySelector('body');

        if (window.innerWidth > body.clientWidth + 5) {
            body.classList.add('has-scrollbar');
            body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
        } else {
            body.classList.remove('has-scrollbar');
        }
    }
    handleWindow();

    login_dropdown();
})(jQuery);


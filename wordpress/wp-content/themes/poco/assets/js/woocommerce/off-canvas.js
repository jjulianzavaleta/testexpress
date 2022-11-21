(function ($) {
    'use strict';

    $(function () {
        var $body = $('body');
        $body.on('click', '.filter-toggle', function (e) {
            e.preventDefault();
            $('html').toggleClass('off-canvas-active');
        });

        $body.on('click', '.filter-close, .poco-overlay-filter', function (e) {
            e.preventDefault();
            $('html').toggleClass('off-canvas-active');
        });

        // Dropdown
		var $dropdownWrapper = $('body .poco-dropdown-filter');

		$body.on('click','.filter-toggle-dropdown',function (e) {
			e.preventDefault();
			$dropdownWrapper.toggleClass('active-dropdown').slideToggle();
		});

		function clone_sidebar() {
		    if($(window).width() < 1024){
                $('#secondary').children().appendTo(".poco-canvas-filter-wrap");
            }else {
                $('.poco-canvas-filter-wrap').children().appendTo("#secondary");
            }
        }

        clone_sidebar();
		$(window).on( 'resize',function () {
            clone_sidebar();
        });
		
    });


})(jQuery);

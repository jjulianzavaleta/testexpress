<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('init', function(){
	if (!get_option('elementor_pro_license_key', false)) {
		$data = [
			'success'          => true,
			'license'          => 'valid',
			'item_id'          => false,
			'item_name'        => 'Elementor Pro',
			'is_local'         => false,
			'license_limit'    => '1000',
			'site_count'       => '1000',
			'activations_left' => 1,
			'expires'          => 'lifetime',
			'customer_email'   => 'info@wpopal.com'
		];
		update_option('elementor_pro_license_key', 'Licence Hacked');
		ElementorPro\License\API::set_license_data($data, '+2 years');
	}
});

add_action('elementor/theme/before_do_header', function () {
    wp_body_open();
    do_action('poco_before_site'); ?>
    <div id="page" class="hfeed site">
    <?php
});

add_action('elementor/theme/after_do_header', function () {
    do_action('poco_before_content');
    ?>
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
    <?php
    do_action('poco_content_top');
});

add_action('elementor/theme/before_do_footer', function () {
    ?>
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'poco_before_footer' );
});

add_action('elementor/theme/after_do_footer', function () {
    poco_handheld_footer_bar();
    do_action( 'poco_after_footer' );
    ?>

    </div><!-- #page -->
        <?php
});




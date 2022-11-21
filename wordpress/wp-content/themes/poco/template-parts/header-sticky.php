<?php
$show_sticky      = poco_get_theme_option( 'show-header-sticky', true );
$sticky_animation = poco_get_theme_option( 'header-sticky-animation', true );
$class            = $sticky_animation ? 'header-sticky hide-scroll-down' : 'header-sticky';
if ( $show_sticky == true ) {
	wp_enqueue_script( 'poco-sticky-header' );
	?>
    <div class="<?php echo esc_attr( $class ); ?>">
        <div class="col-full">
            <div class="header-group-layout">
				<?php

				poco_site_branding();
				poco_primary_navigation();
				?>
                <div class="header-group-action desktop-hide-down">
					<?php
					poco_header_account();
					if ( poco_is_woocommerce_activated() ) {
                        poco_header_wishlist();
						poco_header_cart();
					}
					?>
                </div>
				<?php
				if ( poco_is_woocommerce_activated() ) {
					?>
                    <div class="site-header-cart header-cart-mobile">
						<?php poco_cart_link(); ?>
                    </div>
					<?php
				}
				poco_mobile_nav_button();
				?>

            </div>
        </div>
    </div>
	<?php
}
?>

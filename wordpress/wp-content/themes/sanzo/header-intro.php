<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php global $sanzo_theme_options; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php if( isset($sanzo_theme_options['ts_responsive']) && $sanzo_theme_options['ts_responsive'] == 1 ): ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<?php endif; ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php 
	sanzo_theme_favicon();
	wp_head(); 
	?>
</head>
<?php
$header_classes = array();
if( isset($sanzo_theme_options['ts_enable_sticky_header']) && $sanzo_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}
?>
<body <?php body_class(); ?>>
<?php 
if( function_exists( 'wp_body_open' ) ){
	wp_body_open();
}
?>
<div id="page" class="hfeed site">

	<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

		<!-- Page Slider -->
		<?php if( is_page() ): $page_options = sanzo_get_page_options(); ?>
			<?php if( $page_options['ts_page_slider'] && $page_options['ts_page_slider_position'] == 'before_header' ): ?>
			<div class="top-slideshow">
				<div class="top-slideshow-wrapper">
					<?php sanzo_show_page_slider(); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
			<div class="header-container">
				<div class="header-template header-<?php echo esc_attr($sanzo_theme_options['ts_header_layout']); ?>">

					<div class="header-middle header-sticky">
						<div class="logo-wrapper"><?php echo sanzo_theme_logo(); ?></div>
						<div class="menu-wrapper hidden-phone">				
							<div class="ts-menu">
								<?php 
									if ( has_nav_menu( 'primary' ) ) {
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Sanzo_Walker_Nav_Menu() ) );
									}
									else{
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		
	<?php endif; ?>

	<div id="main" class="wrapper header-<?php echo esc_attr($sanzo_theme_options['ts_header_layout']); ?>">
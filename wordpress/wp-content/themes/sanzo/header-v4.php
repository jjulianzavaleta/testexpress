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
	
	<div class="mobile-menu-wrapper">
		<span class="ic-mobile-menu-close-button"><i class="fa fa-remove"></i></span>
		<?php 
		if ( has_nav_menu( 'mobile' ) ) {
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu mobile-menu', 'theme_location' => 'mobile' ) );
		}else{
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu mobile-menu', 'theme_location' => 'primary') );
		}
		?>
	</div>
	
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
				<?php 
				$extra_class = array();
				if( $sanzo_theme_options['ts_enable_tiny_shopping_cart'] == 0 ){
					$extra_class[] = 'hidden-cart';
				}
				else{
					$extra_class[] = 'show-cart';
					
				}
				if( $sanzo_theme_options['ts_enable_search'] == 0 ){
					$extra_class[] = 'hidden-search';
				}
				else{
					$extra_class[] = 'show-search';
				}
				if( $sanzo_theme_options['ts_middle_header_content'] ){
					$extra_class[] = 'show-banner';
				}
				else{
					$extra_class[] = 'hidden-banner';
				}
				?>
				<div class="header-template header-<?php echo esc_attr($sanzo_theme_options['ts_header_layout']); ?> <?php echo esc_attr(implode(' ', $extra_class)); ?> <?php echo has_nav_menu( 'vertical' )?'has-vertical-menu':''; ?>">

					<div class="header-top">
						<div class="container">
							<div class="header-top-left">

								<?php if( $sanzo_theme_options['ts_header_contact_information'] ): ?>
								<div class="info-desc"><?php echo do_shortcode(stripslashes($sanzo_theme_options['ts_header_contact_information'])); ?></div>
								<?php endif; ?>
								
								<?php get_template_part('templates/header-social-sharing'); ?>

							</div>
							<div class="header-top-right">
							
								<span class="ic-mobile-menu-button visible-phone"><i class="fa fa-bars"></i></span>
								
								<span class="ts-group-meta-icon-toggle visible-phone"><i class="fa fa-cog"></i></span>
								
								<?php if( $sanzo_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
								<div class="shopping-cart-wrapper cart-mobile visible-phone"><?php echo sanzo_tiny_cart(); ?></div>
								<?php endif; ?>
								
								<div class="group-meta-header">
									<?php if( $sanzo_theme_options['ts_header_currency'] ): ?>
									<div class="header-currency"><?php sanzo_woocommerce_multilingual_currency_switcher(); ?></div>
									<?php endif; ?>
									
									<?php if( $sanzo_theme_options['ts_header_language'] ): ?>
									<div class="header-language"><?php sanzo_wpml_language_selector(); ?></div>
									<?php endif; ?>
									
									<?php if( class_exists('YITH_WCWL') && $sanzo_theme_options['ts_enable_tiny_wishlist'] ): ?>
									<div class="my-wishlist-wrapper"><?php echo sanzo_tini_wishlist(); ?></div>
									<?php endif; ?>
									
									<?php if( $sanzo_theme_options['ts_enable_tiny_account'] ): ?>
									<div class="my-account-wrapper"><?php echo sanzo_tiny_account(); ?></div>
									<?php endif; ?>
									
									<?php if( $sanzo_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
									<div class="shopping-cart-wrapper hidden-phone"><?php echo sanzo_tiny_cart(); ?></div>
									<?php endif; ?>
								</div>
								
							</div>
						</div>
					</div>
					<div class="header-middle header-sticky">
						<div class="container">
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
							
							<?php if( $sanzo_theme_options['ts_middle_header_content'] ): ?>
							<div class="banner-middle-content"><?php echo do_shortcode(stripslashes($sanzo_theme_options['ts_middle_header_content'])); ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="header-bottom">
						<div class="container">
							<div class="menu-wrapper">
								<?php 
									if ( has_nav_menu( 'vertical' ) ) {
										?>
										<div class="vertical-menu-wrapper">
											<div class="vertical-menu-heading"><?php echo sanzo_get_vertical_menu_heading(); ?></div>
											<?php
											wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Sanzo_Walker_Nav_Menu() ) );
											?>
										</div>
										<?php
									}
								?>
							</div>
							<?php if( $sanzo_theme_options['ts_enable_search'] ): ?>
							<div class="search-wrapper"><?php sanzo_get_search_form_by_category(); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		
	<?php endif; ?>

	<div id="main" class="wrapper header-<?php echo esc_attr($sanzo_theme_options['ts_header_layout']); ?>">
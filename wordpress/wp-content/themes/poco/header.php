<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo poco_get_theme_option('site_mode') == 'dark' ? esc_attr('site-dark') : ''; ?>">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php
	/**
	 * Functions hooked in to wp_head action
	 *
	 * @see poco_pingback_header - 1
	 */
	wp_head();

	?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('poco_before_site'); ?>

<div id="page" class="hfeed site">
	<?php
	/**
	 * Functions hooked in to poco_before_header action
	 *
	 */
	do_action('poco_before_header');

	get_template_part('template-parts/header/header-1');
	/**
	 * Functions hooked in to poco_before_content action
	 *
	 * @see poco_breadcrumb - 10
	 *
	 */
	do_action('poco_before_content');
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

<?php
/**
 * Functions hooked in to poco_content_top action
 *
 * @see poco_shop_messages - 10 - woo
 */
do_action('poco_content_top');

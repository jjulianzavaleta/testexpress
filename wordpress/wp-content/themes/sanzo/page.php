<?php
global $sanzo_theme_options;
$page_options = sanzo_get_page_options();
get_header( $sanzo_theme_options['ts_header_layout'] );

$extra_class = "";

$page_column_class = sanzo_page_layout_columns_class($page_options['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && $page_options['ts_show_breadcrumb'] );
$show_page_title = ( !is_home() && !is_front_page() && $page_options['ts_show_page_title'] );
if( function_exists('is_bbpress') && is_bbpress() ){
	$show_page_title = true;
	$show_breadcrumb = true;
}
if( ($show_breadcrumb || $show_page_title) && isset($sanzo_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$sanzo_theme_options['ts_breadcrumb_layout'];
}

sanzo_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());

?>
<!-- Page slider -->
<?php if( $page_options['ts_page_slider'] && $page_options['ts_page_slider_position'] == 'before_main_content' ): ?>
<div class="top-slideshow">
	<div class="top-slideshow-wrapper">
		<?php sanzo_show_page_slider(); ?>
	</div>
</div>
<?php endif; ?>

<div class="page-container <?php echo esc_attr($extra_class) ?>">
	
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($page_options['ts_left_sidebar']) ): ?>
			<?php dynamic_sidebar($page_options['ts_left_sidebar']); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	
	<!-- Main Content -->
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div id="primary" class="site-content">
		<?php 
			if( class_exists('WooCommerce') ){
				wc_print_notices();
			}
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
					if( have_posts() ) the_post();
					the_content();
					wp_link_pages();
				?>
			</article>
			<?php 
			/* If comments are open or we have at least one comment, load up the comment template. */
			if ( comments_open() || get_comments_number() ) :
				comments_template( '', true );
			endif;
			?>
		</div>
	</div>
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($page_options['ts_right_sidebar'])): ?>
			<?php dynamic_sidebar($page_options['ts_right_sidebar']); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>
	
</div>

<?php get_footer(); ?>
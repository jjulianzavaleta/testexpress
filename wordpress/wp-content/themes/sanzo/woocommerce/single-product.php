<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $sanzo_theme_options;

get_header( $sanzo_theme_options['ts_header_layout'] ); 

$extra_class = "";
$page_column_class = sanzo_page_layout_columns_class($sanzo_theme_options['ts_prod_layout']);

$show_breadcrumb = true;
if($show_breadcrumb && isset($sanzo_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$sanzo_theme_options['ts_breadcrumb_layout'];
}
sanzo_breadcrumbs_title($show_breadcrumb, false, get_the_title());
?>
<div class="page-container <?php echo esc_attr($extra_class) ?>">
	
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($sanzo_theme_options['ts_prod_left_sidebar']) ): ?>
			<?php dynamic_sidebar( $sanzo_theme_options['ts_prod_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div id="primary" class="site-content">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

		</div>
	</div>
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
			<?php if( is_active_sidebar($sanzo_theme_options['ts_prod_right_sidebar']) ): ?>
				<?php dynamic_sidebar( $sanzo_theme_options['ts_prod_right_sidebar'] ); ?>
			<?php endif; ?>
		</aside>
	<?php endif; ?>
	
</div>
<?php get_footer( 'shop' ); ?>
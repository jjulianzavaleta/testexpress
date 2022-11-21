<?php
/**
 *	Template Name: Blog Template
 */	
global $sanzo_theme_options;
$page_options = sanzo_get_page_options();
get_header( $sanzo_theme_options['ts_header_layout'] );

$extra_class = "";

$page_column_class = sanzo_page_layout_columns_class($page_options['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && $page_options['ts_show_breadcrumb'] );
$show_page_title = ( !is_home() && !is_front_page() && $page_options['ts_show_page_title'] );

if( ($show_breadcrumb || $show_page_title) && isset($sanzo_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$sanzo_theme_options['ts_breadcrumb_layout'];
}

sanzo_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
	
?>
<div class="page-template blog-template page-container container-post <?php echo esc_attr($extra_class) ?>">
	<!-- Page slider -->
	<?php if( $page_options['ts_page_slider'] && $page_options['ts_page_slider_position'] == 'before_main_content' ): ?>
	<div class="top-slideshow">
		<div class="top-slideshow-wrapper">
			<?php sanzo_show_page_slider(); ?>
		</div>
	</div>
	<?php endif; ?>

	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($page_options['ts_left_sidebar']) ): ?>
			<?php dynamic_sidebar( $page_options['ts_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>			
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div id="primary" class="site-content">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			
			<?php	
				$paged = 1;
				if( is_paged() ){
					$paged = get_query_var('page');
					if( !$paged ){
						$paged = get_query_var('paged');
					}
				}
				
				$posts = new WP_Query( array('post_type'=>'post', 'paged'=>$paged) );
				if( $posts->have_posts() ):
					echo '<div class="list-posts">';
					while( $posts->have_posts() ) : $posts->the_post();
						get_template_part( 'content', get_post_format() ); 
					endwhile;
					echo '</div>';
					
					wp_reset_postdata();
				else:
					echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'sanzo').'</div>';
				endif;
				
				sanzo_pagination($posts);
			?>

		</div>
	</div>
	
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($page_options['ts_right_sidebar']) ): ?>
			<?php dynamic_sidebar( $page_options['ts_right_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
		
</div><!-- #container -->
<?php get_footer(); ?>
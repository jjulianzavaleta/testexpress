<?php
global $sanzo_theme_options;

get_header( $sanzo_theme_options['ts_header_layout'] );

$extra_class = "";

$page_column_class = sanzo_page_layout_columns_class($sanzo_theme_options['ts_blog_layout']);

$show_breadcrumb = false;
$show_page_title = false;
if($show_breadcrumb && isset($sanzo_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$sanzo_theme_options['ts_breadcrumb_layout'];
}
sanzo_breadcrumbs_title($show_breadcrumb, $show_page_title, '');
	
?>
<div class="page-template blog-template index-template page-container <?php echo esc_attr($extra_class) ?>">
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar( $sanzo_theme_options['ts_blog_left_sidebar'] ) ): ?>
			<?php dynamic_sidebar( $sanzo_theme_options['ts_blog_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>			
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div id="primary" class="site-content">
			
			<?php	
				if( have_posts() ):
					echo '<div class="list-posts">';
					while( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() ); 
					endwhile;
					echo '</div>';
				else:
					echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'sanzo').'</div>';
				endif;
				
				sanzo_pagination();
			?>

		</div>
	</div>
	
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar( $sanzo_theme_options['ts_blog_right_sidebar'] ) ): ?>
			<?php dynamic_sidebar( $sanzo_theme_options['ts_blog_right_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
		
</div>
<?php get_footer(); ?>
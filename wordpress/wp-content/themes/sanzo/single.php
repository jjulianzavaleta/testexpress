<?php 
global $sanzo_theme_options, $post;

get_header( $sanzo_theme_options['ts_header_layout'] );

$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */

$show_blog_thumbnail = $sanzo_theme_options['ts_blog_details_thumbnail'];

$extra_class = "";

$page_column_class = sanzo_page_layout_columns_class($sanzo_theme_options['ts_blog_details_layout']);

sanzo_breadcrumbs_title(true, false, get_the_title());
if( isset($sanzo_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$sanzo_theme_options['ts_breadcrumb_layout'];
}
?>
<div id="content" class="page-container container-post <?php echo esc_attr($extra_class) ?>">
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($sanzo_theme_options['ts_blog_details_left_sidebar']) ): ?>
			<?php dynamic_sidebar( $sanzo_theme_options['ts_blog_details_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	<!-- end left sidebar -->
	
	<!-- main-content -->
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">
		<article class="single single-post">
			<div class="entry-format">
				<!-- Blog Thumbnail -->
				<?php if( $show_blog_thumbnail ): ?>
					<?php if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){ ?>
						<a class=" thumbnail <?php echo ($post_format == 'gallery')?'gallery loading':'' ?>" href="javascript: void(0)">
							<figure>
								<?php 
								
								if( $post_format == 'gallery' ){
									$gallery = get_post_meta($post->ID, 'ts_gallery', true);
									$gallery_ids = explode(',', $gallery);
									if( is_array($gallery_ids) && has_post_thumbnail() ){
										array_unshift($gallery_ids, get_post_thumbnail_id());
									}
									foreach( $gallery_ids as $gallery_id ){
										echo wp_get_attachment_image( $gallery_id, 'sanzo_blog_thumb', 0, array('class' => 'thumbnail-blog') );
									}
									
									if( !has_post_thumbnail() && empty($gallery) ){
										$show_blog_thumbnail = 0;
									}
								}
							
								if( ($post_format === false || $post_format == 'standard') && !is_singular('ts_feature') ){
									if( has_post_thumbnail() ){
										the_post_thumbnail('sanzo_blog_thumb', array('class' => 'thumbnail-blog'));
									}
									else{
										$show_blog_thumbnail = 0;
									}
								}
								
								?>
							</figure>
						</a>
					<?php 
					}
					
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ts_video_url', true);
						if( $video_url != '' ){
							echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
						}
						$show_blog_thumbnail = 0;
					}
					
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.esc_url($audio_url).'"]');
							}
							else{
								echo do_shortcode('[ts_soundcloud url="'.esc_url($audio_url).'" width="100%" height="166"]');
							}
						}
						$show_blog_thumbnail = 0;
					}

					?>
				<?php endif; ?>
			</div>
			<div class="entry-content <?php echo ($show_blog_thumbnail)?'has-image':'no-image'; ?>">
				<?php if( $sanzo_theme_options['ts_blog_details_title'] ): ?>
					<h1 itemprop="name" class="heading-title blog-title entry-title"><?php echo get_the_title(); ?></h1>
				<?php endif; ?>
				<div class="entry-meta">
					<!-- Blog Date -->
					<?php if( $sanzo_theme_options['ts_blog_details_date']): ?>
					<span class="date-time">
						<?php echo get_the_time(get_option('date_format')); ?>
					</span>
					<?php endif; ?>
					
					<!-- Blog Comment -->
					<?php if( $sanzo_theme_options['ts_blog_comment'] ): ?>
					<span class="comment-count">
						<span class="number">
							<?php 
							$comments_count = wp_count_comments($post->ID); 
							$comment_number = $comments_count->approved;
							echo sprintf( _n('%s comment', '%s comments', $comment_number, 'sanzo'), $comment_number > 0?zeroise($comment_number, 2):$comment_number );
							?>
						</span>
					</span>
					<?php endif; ?>
					
					<!-- Blog Author -->
					<?php if( $sanzo_theme_options['ts_blog_author'] ): ?>
					<span class="vcard author"><?php esc_html_e('Post by ', 'sanzo'); ?><?php the_author_posts_link(); ?></span>
					<?php endif; ?>
				</div>
				
				<!-- Blog Content -->
				<?php if( $sanzo_theme_options['ts_blog_details_content'] ): ?>
				<div class="content-wrapper">
					<div class="full-content"><?php the_content(); ?></div>
					<?php wp_link_pages(); ?>
				</div>
				<?php endif; ?>
				<div class="meta-bottom-wrapper">
					
					<?php if( $sanzo_theme_options['ts_blog_details_sharing'] || $sanzo_theme_options['ts_blog_details_like'] ): ?>
					<div class="meta-bottom-1">	
						<!-- Blog Like -->
						<?php if( $sanzo_theme_options['ts_blog_details_like'] ): ?>
						<div class="blog-like-wrapper">
							<?php sanzo_get_post_like(); ?>
						</div>
						<?php endif; ?>
						
						<!-- Blog Sharing -->
						<?php 
						if( $sanzo_theme_options['ts_blog_details_sharing'] ){
							sanzo_template_social_sharing();
						}
						?>
					</div>
					<?php endif; ?>
					
					<?php 
					$tags_list = get_the_tag_list('', ' , '); 
					$categories_list = get_the_category_list(' , ');
					if( ($tags_list && $sanzo_theme_options['ts_blog_details_tags']) || 
						 ($categories_list && $sanzo_theme_options['ts_blog_details_categories']) ):
					?>
					<div class="meta-bottom-2">
						<!-- Blog Categories -->
						<?php if( $categories_list && $sanzo_theme_options['ts_blog_details_categories'] ): ?>
						<div class="cats-link">
							<span class="cat-title"><?php esc_html_e('Categories: ', 'sanzo'); ?></span>
							<span class="cat-links"><?php echo trim($categories_list); ?></span>
						</div>
						<?php endif; ?>
						<!-- Blog Tags -->
						<?php if( $tags_list && $sanzo_theme_options['ts_blog_details_tags'] ): ?>
						<div class="tags-link">
							<span class="tag-title"><?php esc_html_e('Tags: ','sanzo');?></span>
							<span class="tag-links"><?php echo trim($tags_list); ?></span>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- Blog Author -->
			<?php if( $sanzo_theme_options['ts_blog_details_author_box'] == 1 && get_the_author_meta('description') ) : ?>
			<div class="entry-author">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 130, 'mystery' ); ?>
				</div>	
				<div class="author-info">		
					<span class="author"><?php the_author_posts_link();?></span>
					/
					<span class="role"><?php echo sanzo_get_user_role( get_the_author_meta('ID') ); ?></span>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div>
			<?php endif; ?>	
			
			<!-- Next Prev Blog -->
			<div class="single-navigation">
			<?php
				previous_post_link('%link', esc_html__('Prev post', 'sanzo'));
				next_post_link('%link', esc_html__('Next post', 'sanzo'));
			?>
			</div>
			
			<!-- Related Posts-->
			<?php 
			if( !is_singular('ts_feature') && $sanzo_theme_options['ts_blog_details_related_posts'] ){
				get_template_part('templates/related-posts');
			}
			?>
			
			<!-- Comment Form -->
			<?php 
			if( $sanzo_theme_options['ts_blog_details_comment_form'] && ( comments_open() || get_comments_number() ) ){
				comments_template( '', true );
			}
			?>
		</article>
	</div><!-- end main-content -->
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($sanzo_theme_options['ts_blog_details_right_sidebar']) ): ?>
			<?php dynamic_sidebar( $sanzo_theme_options['ts_blog_details_right_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	<!-- end right sidebar -->	
</div>
<?php get_footer(); ?>
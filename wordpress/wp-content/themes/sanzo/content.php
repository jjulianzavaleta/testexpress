<?php 
global $post, $wp_query, $sanzo_theme_options;
$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
$post_class = 'post-item hentry';
$show_blog_thumbnail = $sanzo_theme_options['ts_blog_thumbnail'];

if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
	if( $post_format == 'gallery' ){
		$gallery = get_post_meta($post->ID, 'ts_gallery', true);
		if( $gallery != '' ){
			$gallery_ids = explode(',', $gallery);
		}
		else{
			$gallery_ids = array();
		}
		
		if( has_post_thumbnail() ){
			array_unshift($gallery_ids, get_post_thumbnail_id());
		}
		
		if( empty($gallery_ids) ){
			$show_blog_thumbnail = 0;
		}
	}
	
	if( $post_format === false || $post_format == 'standard' ){
		if( !has_post_thumbnail() ){
			$show_blog_thumbnail = 0;
		}
	}
}

if( $post_format == 'video' ){
	$video_url = get_post_meta($post->ID, 'ts_video_url', true);
	if( $video_url == '' ){
		$show_blog_thumbnail = 0;
	}
}

if( $post_format == 'audio' ){
	$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
	if( $audio_url == '' ){
		$show_blog_thumbnail = 0;
	}
}

if( !in_array($post_format, array('gallery', 'standard', 'video', 'audio')) && $post_format !== false ){
	$show_blog_thumbnail = 0;
}

if( !$show_blog_thumbnail ){
	$post_class .= ' no-featured-image';
}
?>
<article <?php post_class($post_class) ?>>

	<?php if( $post_format != 'quote' ): ?>
		<?php if( $show_blog_thumbnail ): ?>
		<div class="entry-format">
			<?php 
				if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
					if( $post_format != 'gallery'){
					?>
					<a class="thumbnail <?php echo esc_attr($post_format); ?> <?php echo ($post_format == 'gallery')?'loading':''; ?>" href="<?php the_permalink() ?>">
					<?php }else{ ?>
					<div class="thumbnail <?php echo esc_attr($post_format); ?> <?php echo ($post_format == 'gallery')?'loading':''; ?>">	
					<?php } ?>
						<figure>
						<?php 
							if( $post_format == 'gallery' ){
								foreach( $gallery_ids as $gallery_id ){
									echo '<a class="thumbnail '.$post_format.'" href="'.get_the_permalink().'">';
									echo wp_get_attachment_image( $gallery_id, 'sanzo_blog_thumb', 0, array('class' => 'thumbnail-blog') );
									echo '</a>';
								}
							}
						
							if( $post_format === false || $post_format == 'standard' ){
								the_post_thumbnail('sanzo_blog_thumb', array('class' => 'thumbnail-blog'));
							}
						?>
						</figure>
					<?php 
					if( $post_format != 'gallery'){
					?>
					</a>
					<?php }else{ ?>
					</div>
					<?php } ?>
				<?php
				
					/* Blog Sharing */
					if( $sanzo_theme_options['ts_blog_sharing'] ){
						sanzo_template_social_sharing();
					}
				}
				
				if( $post_format == 'video' ){
					echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
				}
				
				if( $post_format == 'audio' ){
					if( strlen($audio_url) > 4 ){
						$file_format = substr($audio_url, -3, 3);
						if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
							echo do_shortcode('[audio '.$file_format.'="'.esc_url($audio_url).'"]');
						}
						else{
							echo do_shortcode('[ts_soundcloud url="'.esc_url($audio_url).'" width="100%" height="166"]');
						}
					}
				}
			?>
		</div>
		<?php endif; ?>
		
		<div class="entry-content">
			
			<div class="entry-info">
				<!-- Blog Title -->
				<?php if( $sanzo_theme_options['ts_blog_title'] ): ?>
				<header>
					<h3 class="heading-title entry-title">
						<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
					</h3>
				</header>
				<?php endif; ?>
				
				<div class="entry-meta">
					<!-- Blog Date Time -->
					<?php if( $sanzo_theme_options['ts_blog_date'] ) : ?>
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
				
				<div class="entry-summary">
					<!-- Blog Excerpt -->
					<?php if( $sanzo_theme_options['ts_blog_excerpt'] ): ?>
					<div class="short-content">
						<?php 
						$max_words = (int)$sanzo_theme_options['ts_blog_excerpt_max_words']?(int)$sanzo_theme_options['ts_blog_excerpt_max_words']:125;
						$strip_tags = $sanzo_theme_options['ts_blog_excerpt_strip_tags']?true:false;
						sanzo_the_excerpt_max_words($max_words, $post, $strip_tags, '', true); 
						?>
					</div>
					<?php endif; ?>
					
					<!-- Blog Read More Button -->
					<?php if( $sanzo_theme_options['ts_blog_read_more'] ): ?>
					<a class="button button-readmore" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'sanzo'); ?></a>
					<?php endif; ?>
					
				</div>
			</div>
			
			<?php 
			$categories_list = get_the_category_list(', ');
			if ( ($categories_list && $sanzo_theme_options['ts_blog_categories']) || ($sanzo_theme_options['ts_blog_sharing'] && !$show_blog_thumbnail )): 
			?>
			<div class="entry-bottom">
				<!-- Blog Categories -->
				<?php if ($categories_list && $sanzo_theme_options['ts_blog_categories']): ?>
				<div class="cats-link">
					<span><?php esc_html_e('Categories: ', 'sanzo'); ?></span>
					<span class="cat-links"><?php echo trim($categories_list); ?></span>
				</div>
				<?php endif; ?>
				
				<!-- Blog Sharing -->
				<?php if( $sanzo_theme_options['ts_blog_sharing'] && !$show_blog_thumbnail){
					sanzo_template_social_sharing();
				}?>
			</div>
			
			<?php endif; ?>
			
		</div>
		
	<?php else: /* Post format is quote */ ?>
	
		<blockquote>
			<?php 
			$quote_content = get_the_excerpt();
			if( !$quote_content ){
				$quote_content = get_the_content();
			}
			echo do_shortcode($quote_content);
			?>
		</blockquote>
		
		<div class="blockquote-meta">
			<!-- Blog Date -->
			<?php if( $sanzo_theme_options['ts_blog_date'] ): ?>
			<span class="date-time">
				<?php echo get_the_time( get_option('date_format')); ?>
			</span>
			<?php endif; ?>
			
			<!-- Blog Author -->
			<?php if( $sanzo_theme_options['ts_blog_author'] ): ?>
			<span class="vcard author"><?php the_author_posts_link(); ?></span>
			<?php endif; ?>	
		</div>
		
	<?php endif; ?>
	
</article>
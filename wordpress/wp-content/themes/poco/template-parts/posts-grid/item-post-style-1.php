<div class="column-item post-style-1">
	<div class="post-inner">
		<?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('poco-post-grid-2'); ?>
				</a>
			</div><!-- .post-thumbnail -->

		<?php endif; ?>
		<div class="entry-content">
			<div class="entry-header">
				<div class="entry-meta">
					<?php
					poco_categories_link();
					poco_post_meta();
					?>
				</div>
				<?php
				the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
				?>
			</div>
			<div class="entry-bottom">
				<p><?php echo  wp_trim_words(esc_html(get_the_excerpt()), 18); ?></p>
				<a class='button' href="<?php the_permalink() ?>"><?php echo esc_html__('Read More', 'poco') ?></a>
			</div>
		</div>
	</div>
</div>

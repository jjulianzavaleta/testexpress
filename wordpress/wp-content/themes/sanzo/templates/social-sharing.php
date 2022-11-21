<div class="ts-social-sharing">
	<span class="sharing-title"><?php esc_html_e('Share', 'sanzo') ?></span>
	<ul>
		<li class="facebook">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Facebook', 'sanzo') ?></span></a>
		</li>
	
		<li class="twitter">
			<a href="https://twitter.com/home?status=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Twitter', 'sanzo') ?></span></a>
		</li>
	
		<li class="pinterest">
			<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );?>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link);?>" target="_blank"><i class="fa fa-pinterest"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Pinterest', 'sanzo') ?></span></a>
		</li>
	
		<li class="linkedin">
			<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-linkedin"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('LinkedIn', 'sanzo') ?></span></a>
		</li>
	
		<li class="reddit">
			<a href="http://www.reddit.com/submit?url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-reddit"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Reddit', 'sanzo') ?></span></a>
		</li>
	</ul>
</div>
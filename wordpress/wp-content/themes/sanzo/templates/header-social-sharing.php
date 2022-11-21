<?php 
global $sanzo_theme_options;
$facebook_url = $sanzo_theme_options['ts_facebook_url'];
$twitter_url = $sanzo_theme_options['ts_twitter_url'];
$youtube_url = $sanzo_theme_options['ts_youtube_url'];
$instagram_url = $sanzo_theme_options['ts_instagram_url'];
$linkedin_url = $sanzo_theme_options['ts_linkedin_url'];
$custom_url = $sanzo_theme_options['ts_custom_social_url'];
$custom_class = $sanzo_theme_options['ts_custom_social_class'];
?>
<ul class="ts-social-sharing header-social-sharing">
		
	<?php if( $facebook_url != '' ): ?>
	<li class="facebook">
		<a href="<?php echo esc_url($facebook_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
	</li>
	<?php endif; ?>

	<?php if( $twitter_url != '' ): ?>
	<li class="twitter">
		<a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
	</li>
	<?php endif; ?>
	
	<?php if( $youtube_url != '' ): ?>
	<li class="youtube">
		<a href="<?php echo esc_url($youtube_url); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
	</li>
	<?php endif; ?>
	
	<?php if( $instagram_url != '' ): ?>
	<li class="instagram">
		<a href="<?php echo esc_url($instagram_url); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
	</li>
	<?php endif; ?>
	
	<?php if( $linkedin_url != '' ): ?>
	<li class="linkedin">
		<a href="<?php echo esc_url($linkedin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
	</li>
	<?php endif; ?>
	
	<?php if( $custom_url != '' ): ?>
	<li class="custom">
		<a href="<?php echo esc_url($custom_url); ?>" target="_blank"><i class="fa <?php echo esc_attr($custom_class) ?>"></i></a>
	</li>
	<?php endif; ?>

</ul>
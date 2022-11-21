<?php
global $sanzo_theme_options;
get_header( $sanzo_theme_options['ts_header_layout'] ); 
?>
	<div class="fullwidth-template">
		<div id="main-content">	
			<div id="primary" class="site-content">
				<article>
					<div class="icon-404"><i class="fa fa-warning"></i></div>
					<h1><?php esc_html_e('404', 'sanzo'); ?></h1>
					<h2><?php esc_html_e('Oops! Page Not Found', 'sanzo'); ?></h2>
					<p><?php esc_html_e('The link you clicked might be corrupted, or the page may have been removed.', 'sanzo'); ?></p>
					<p><?php esc_html_e('You can back to homepage or seach anything.', 'sanzo'); ?></p>
					<p class="button-404">
						<a class="button" href="<?php echo esc_url( home_url('/') ) ?>"><?php esc_html_e('Homepage', 'sanzo') ?></a>
						<?php if( function_exists('wc_get_page_permalink') ): ?>
						<a class="button" href="<?php echo wc_get_page_permalink('shop') ?>"><?php esc_html_e('Shop page', 'sanzo') ?></a>
						<?php endif; ?>
					</p>
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();
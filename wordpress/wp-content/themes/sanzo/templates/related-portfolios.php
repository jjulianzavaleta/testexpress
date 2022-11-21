<?php 
global $post;
$per_page = 5;
$cat_list = get_the_terms($post, 'ts_portfolio_cat');
$cat_ids = array();
if( is_array($cat_list) ){
	foreach( $cat_list as $cat ){
		$cat_ids[] = $cat->term_id;
	}
}

$args = array(
	'post_type' 		=> $post->post_type
	,'post__not_in' 	=> array($post->ID)
	,'posts_per_page' 	=> $per_page
);

if( !empty($cat_ids) ){
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'ts_portfolio_cat'
			,'field'	=> 'term_id'
			,'terms'	=> $cat_ids
		)
	);
}

$related_posts = new WP_Query($args);
	
if( $related_posts->have_posts() ){
	$is_slider = true;
	if( isset($related_posts->post_count) && $related_posts->post_count <= 1 ){
		$is_slider = false;
	}
	
	$rand_id = 'related-portfolios-'.rand(0, 1000);
?>
	<div class="related-posts related related-portfolio <?php echo ($is_slider)?'loading':'' ?>" id="<?php echo esc_attr($rand_id); ?>">
		<header class="theme-title">
			<h3 class="heading-title"><?php esc_html_e('Related Projects', 'sanzo'); ?></h3>
		</header>
		<div class="content-wrapper">
			<div class="blogs">
				<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
				<article>
					<a class="thumbnail" href="<?php the_permalink() ?>">
						<figure>
							<?php 
						
							if( has_post_thumbnail() ){
								the_post_thumbnail('ts_portfolio_thumb'); 
							}
							
							?>
						</figure>
						<div class="effect-thumbnail"></div>
					</a>
				</article>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	
	<?php if( $is_slider ): ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			"use strict";
			var _this = jQuery('#<?php echo esc_js($rand_id); ?>');
			var slider_data = {
				loop : true
				,nav : true
				,navText : [,]
				,dots : false
				,navSpeed: 1000
				,slideBy: 1
				,rtl: jQuery('body').hasClass('rtl')
				,margin : 30
				,navRewind: false
				,autoplay: false
				,autoplayTimeout: 5000
				,autoplayHoverPause: true
				,autoplaySpeed: false
				,mouseDrag: true
				,touchDrag: true
				,responsiveBaseElement: _this
				,responsiveRefreshRate: 400
				,responsive:{
							0:{
								items : 1
							},
							500:{
								items : 2
							},
							1000:{
								items : 3
							},
							1200:{
								items : <?php echo esc_js($per_page) - 1; ?>
							},
							1400:{
								items : <?php echo esc_js($per_page); ?>
							}
						}
				,onInitialized: function(){
					_this.addClass('loaded').removeClass('loading');
				}
			};
			var owl = _this.find('.content-wrapper .blogs').owlCarousel(slider_data);
		});
	</script>
	<?php endif; ?>
<?php 
	wp_reset_postdata();
}
?>
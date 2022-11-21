<?php
add_action('widgets_init', 'sanzo_products_load_widgets');

function sanzo_products_load_widgets()
{
	register_widget('Sanzo_Products_Widget');
}

if( !class_exists('Sanzo_Products_Widget') ){
	class Sanzo_Products_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-products-widget', 'description' => esc_html__('Display your products on site','sanzo'));
			parent::__construct('ts_products', esc_html__('TS - Products','sanzo'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			if( !class_exists('WooCommerce') ){
				return;
			}
			
			extract($args);
			$title 				= apply_filters('widget_title', $instance['title']);
			$limit 				= ($instance['limit'] != 0)?absint($instance['limit']):8;
			$product_type 		= $instance['product_type'];
			$product_cats 		= $instance['product_cats'];
			$row 				= ($instance['row'] != 0)?absint($instance['row']):4;
			$show_thumbnail 	= empty($instance['show_thumbnail'])?0:$instance['show_thumbnail'];
			$show_categories 	= empty($instance['show_categories'])?0:$instance['show_categories'];
			$show_product_title = empty($instance['show_product_title'])?0:$instance['show_product_title'];
			$show_price 		= empty($instance['show_price'])?0:$instance['show_price'];
			$show_rating 		= empty($instance['show_rating'])?0:$instance['show_rating'];
			$is_slider 			= empty($instance['is_slider'])?0:$instance['is_slider'];
			$show_nav 			= empty($instance['show_nav'])?0:$instance['show_nav'];
			$position_nav 		= empty($instance['position_nav'])?0:$instance['position_nav'];
			$auto_play 			= empty($instance['auto_play'])?0:$instance['auto_play'];
			
			if( $limit == $row ){
				$is_slider = false;
			}
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $limit
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			switch( $product_type ){
				case 'sale':
					$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
				break;
				case 'featured':
					$args['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
				break;
				case 'best_selling':
					$args['meta_key'] 	= 'total_sales';
					$args['orderby'] 	= 'meta_value_num';
					$args['order'] 		= 'desc';
				break;
				case 'top_rated':		
					$args['meta_key'] 	= '_wc_average_rating';
					$args['orderby'] 	= 'meta_value_num';
					$args['order'] 		= 'desc';
				break;
				case 'mixed_order':
					$args['orderby'] 	= 'rand';
				break;
				default: /* Recent */
					$args['orderby'] 	= 'date';
					$args['order'] 		= 'desc';
				break;
			}
			
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$field_name = is_numeric($product_cats[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' 	=> 'product_cat'
											,'terms' 	=> $product_cats
											,'field' 	=> $field_name
										);
			}
			
			global $post, $product, $sanzo_theme_options;
			
			$lazy_load = isset($sanzo_theme_options['ts_prod_lazy_load']) && $sanzo_theme_options['ts_prod_lazy_load'];
			$placeholder_img_src = isset($sanzo_theme_options['ts_prod_placeholder_img'])?$sanzo_theme_options['ts_prod_placeholder_img']:wc_placeholder_img_src();
			
			echo $before_widget;
			
			if( $title ){
				echo $before_title . $title . $after_title;
			}
			
			$products = new WP_Query($args);
			if( $products->have_posts() ){
				$count = 0;
				$num_posts = $products->post_count;
				if( $num_posts <= $row ){
					$is_slider = false;
				}
				if( !$is_slider ){
					$row = $num_posts;
				}
				
				$extra_class = '';
				$extra_class .= ($is_slider)?'ts-slider loading':'';
				$extra_class .= (!$show_thumbnail)?' no-thumbnail':'';
				$extra_class .= ($is_slider && $show_nav)?' has-navi '.$position_nav:'';
				?>
				
				<div class="ts-products-widget-wrapper woocommerce <?php echo esc_attr($extra_class); ?>" data-show_nav="<?php echo esc_attr($show_nav) ?>" data-auto_play="<?php echo esc_attr($auto_play) ?>">
					<?php while( $products->have_posts() ): $products->the_post(); $product = wc_get_product( $post->ID ); ?>
						<?php if( $count % $row == 0 ): ?>
						<div class="per-slide">
							<ul class="product_list_widget">
						<?php endif; ?>
							<li>
								<a class="ts-wg-thumbnail" href="<?php echo esc_url( get_permalink($product->get_id()) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
									<?php  
										if ( $show_thumbnail ) {
											if( !$lazy_load ){
												echo $product->get_image();
											}
											else{
												$image_size = 'woocommerce_thumbnail';
												$img_src = '';
												$alt = '';
												$dimensions = wc_get_image_size( $image_size );
												if( has_post_thumbnail($product->get_id()) ){
													$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
													$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
													if( isset($image_obj[0]) ){
														$img_src = $image_obj[0];
													}
													$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
												}
												else if( wc_placeholder_img_src() ){
													$img_src = wc_placeholder_img_src();
												}
												
												echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($img_src).'" alt="'.esc_attr($alt).'" class="attachment-shop_thumbnail wp-post-image ts-lazy-load" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
											}
										}
									?>
								</a>
								
								<div class="ts-wg-meta">
								
									<?php if( $show_categories ){ 
										sanzo_template_loop_categories(); 
									} ?>
									
									<a href="<?php echo esc_url( get_permalink($product->get_id()) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
										<?php  
											if( $show_product_title ){
												echo esc_html( $product->get_title() );
											}
										?>
									</a>
									<?php 
									if( $show_rating ){ woocommerce_template_loop_rating(); }
									if( $show_price ){ woocommerce_template_loop_price(); }
									?>
								</div>
							</li>
						<?php if( $count % $row == $row - 1 || $count == $num_posts - 1 ): ?>	
							</ul>
						</div>
						<?php endif; ?>
					<?php $count++; endwhile; ?>
				</div>
				<?php
			}
			echo $after_widget;
			
			wp_reset_postdata();
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['product_type'] 		= $new_instance['product_type'];
			$instance['product_cats'] 		= $new_instance['product_cats'];		
			$instance['row'] 				= absint($new_instance['row']);		
			$instance['limit'] 				= absint($new_instance['limit']);		
			$instance['show_thumbnail'] 	= $new_instance['show_thumbnail'];		
			$instance['show_categories'] 	= $new_instance['show_categories'];		
			$instance['show_product_title'] = $new_instance['show_product_title'];		
			$instance['show_price'] 		= $new_instance['show_price'];		
			$instance['show_rating'] 		= $new_instance['show_rating'];		
			$instance['is_slider'] 			= $new_instance['is_slider'];		
			$instance['show_nav'] 			= $new_instance['show_nav'];
			$instance['position_nav'] 		= $new_instance['position_nav'];			
			$instance['auto_play'] 			= $new_instance['auto_play'];	
			
			if( $instance['row'] > $instance['limit'] ){
				$instance['row'] = $instance['limit'];
			}
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title'					=> 'Recent Products'
				,'product_type'			=> 'recent'
				,'product_cats'			=> array()
				,'row'					=> '4'
				,'limit'				=> '8'
				,'show_thumbnail' 		=> 1
				,'show_categories' 		=> 1
				,'show_product_title' 	=> 1
				,'show_price' 			=> 1
				,'show_rating' 			=> 1
				,'is_slider'			=> 1
				,'show_nav' 			=> 1
				,'position_nav'			=> 'nav-top'
				,'auto_play' 			=> 1
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
			$categories = $this->get_list_categories(0);
			if( !is_array($instance['product_cats']) ){
				$instance['product_cats'] = array();
			}
			
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'sanzo'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('product_type'); ?>"><?php esc_html_e('Product type', 'sanzo'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('product_type'); ?>" name="<?php echo $this->get_field_name('product_type'); ?>">
					<option value="recent" <?php selected($instance['product_type'], 'recent'); ?>><?php esc_html_e('Recent', 'sanzo'); ?></option>
					<option value="sale" <?php selected($instance['product_type'], 'sale'); ?>><?php esc_html_e('Sale', 'sanzo'); ?></option>
					<option value="featured" <?php selected($instance['product_type'], 'featured'); ?>><?php esc_html_e('Featured', 'sanzo'); ?></option>
					<option value="best_selling" <?php selected($instance['product_type'], 'best_selling'); ?>><?php esc_html_e('Best selling', 'sanzo'); ?></option>
					<option value="top_rated" <?php selected($instance['product_type'], 'top_rated'); ?>><?php esc_html_e('Top rated', 'sanzo'); ?></option>
					<option value="mixed_order" <?php selected($instance['product_type'], 'mixed_order'); ?>><?php esc_html_e('Mixed order', 'sanzo'); ?></option>
				</select>
			</p>
			
			<p>
				<label><?php esc_html_e('Select categories', 'sanzo'); ?></label>
				<div class="categorydiv">
					<div class="tabs-panel">
						<ul class="categorychecklist">
							<?php foreach($categories as $cat){ ?>
							<li>
								<label>
									<input type="checkbox" name="<?php echo $this->get_field_name('product_cats'); ?>[<?php esc_attr($cat->term_id); ?>]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id,$instance['product_cats']))?'checked':''; ?> />
									<?php echo esc_html($cat->name); ?>
								</label>
								<?php $this->get_list_sub_categories($cat->term_id, $instance); ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('row'); ?>"><?php esc_html_e('Number of rows - in carousel slider', 'sanzo'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('row'); ?>" name="<?php echo $this->get_field_name('row'); ?>" type="number" min="0" value="<?php echo esc_attr($instance['row']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Number of posts to show', 'sanzo'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" min="0" value="<?php echo esc_attr($instance['limit']); ?>" />
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" value="1" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php esc_html_e('Show thumbnail', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_categories'); ?>" name="<?php echo $this->get_field_name('show_categories'); ?>" value="1" <?php echo ($instance['show_categories'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_categories'); ?>"><?php esc_html_e('Show categories', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_product_title'); ?>" name="<?php echo $this->get_field_name('show_product_title'); ?>" value="1" <?php echo ($instance['show_product_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_product_title'); ?>"><?php esc_html_e('Show product title', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_price'); ?>" name="<?php echo $this->get_field_name('show_price'); ?>" value="1" <?php echo ($instance['show_price'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php esc_html_e('Show price', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>" value="1" <?php echo ($instance['show_rating'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php esc_html_e('Show rating', 'sanzo'); ?></label>
			</p>
			
			<hr/>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('is_slider'); ?>" name="<?php echo $this->get_field_name('is_slider'); ?>" value="1" <?php echo ($instance['is_slider'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('is_slider'); ?>"><?php esc_html_e('Show in a carousel slider', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_nav'); ?>" name="<?php echo $this->get_field_name('show_nav'); ?>" value="1" <?php echo ($instance['show_nav'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_nav'); ?>"><?php esc_html_e('Show navigation button', 'sanzo'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('auto_play'); ?>" name="<?php echo $this->get_field_name('auto_play'); ?>" value="1" <?php echo ($instance['auto_play'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('auto_play'); ?>"><?php esc_html_e('Auto play', 'sanzo'); ?></label>
			</p>
			
			<?php 
		}
		
		function get_list_categories( $cat_parent_id ){
			if ( !class_exists('WooCommerce') ) {
				return array();
			}
			$args = array(
					'taxonomy' 			=> 'product_cat'
					,'hierarchical'		=> 1
					,'parent'			=> $cat_parent_id
					,'title_li'			=> ''
					,'child_of'			=> 0
				);
			$cats = get_categories($args);
			return $cats;
		}
		
		function get_list_sub_categories( $cat_parent_id, $instance ){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
			?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
						<li>
							<label>
								<input type="checkbox" name="<?php echo $this->get_field_name('product_cats'); ?>[<?php esc_attr($sub_cat->term_id); ?>]" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id,$instance['product_cats']))?'checked':''; ?> />
								<?php echo esc_html($sub_cat->name); ?>
							</label>
							<?php $this->get_list_sub_categories($sub_cat->term_id, $instance); ?>
						</li>
					<?php } ?>
				</ul>
			<?php }
		}
		
	}
}


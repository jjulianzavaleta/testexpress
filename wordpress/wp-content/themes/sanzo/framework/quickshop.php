<?php 
global $sanzo_theme_options;
if( !empty($sanzo_theme_options['ts_enable_quickshop']) && class_exists('WooCommerce') && !class_exists('Sanzo_Quickshop') && !wp_is_mobile() ){
	
	class Sanzo_Quickshop{
	
		public $id;
		
		function __construct(){
			$this->add_hook();
		}
		
		function add_quickshop_button(){
			global $product;
			$href = admin_url('admin-ajax.php', is_ssl()?'https':'http') . '?ajax=true&action=sanzo_load_quickshop_content&product_id='.$product->get_id();
			echo '<div class="button-in quickshop">';
			echo '<a class="quickshop" href="'.esc_url($href).'"><i class="fa fa-eye"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Quick view', 'sanzo').'</span></a>';
			echo '</div>';
		}
		
		function add_hook(){
			global $sanzo_theme_options;
			
			add_action('woocommerce_after_shop_loop_item_title', array($this, 'add_quickshop_button'), 10001 );
			
			/** Product content hook **/
			if( $sanzo_theme_options['ts_prod_title'] ){
				add_action('sanzo_quickshop_single_product_title', array($this, 'product_title'), 10);
			}
			if( $sanzo_theme_options['ts_prod_availability'] ){
				add_action('sanzo_quickshop_single_product_summary', 'sanzo_template_single_availability', 10);
			}
			add_action('sanzo_quickshop_single_product_summary', 'sanzo_template_single_rating_sku_before', 15);
			if( $sanzo_theme_options['ts_prod_rating'] ){
				add_action('sanzo_quickshop_single_product_summary', 'woocommerce_template_single_rating', 20);
			}
			if( $sanzo_theme_options['ts_prod_sku'] ){
				add_action('sanzo_quickshop_single_product_summary', 'sanzo_template_single_sku', 30);
			}
			add_action('sanzo_quickshop_single_product_summary', 'sanzo_template_single_rating_sku_after', 35);
			if( $sanzo_theme_options['ts_prod_price'] ){
				add_action('sanzo_quickshop_single_product_summary', 'woocommerce_template_single_price', 40);
			}
			if( $sanzo_theme_options['ts_prod_excerpt'] ){
				add_action('sanzo_quickshop_single_product_summary', 'woocommerce_template_single_excerpt', 50);
			}
			if( !$sanzo_theme_options['ts_enable_catalog_mode'] && $sanzo_theme_options['ts_prod_add_to_cart'] ){
				add_action('sanzo_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 60); 
			}
			
			/* Register ajax */
			add_action('wp_ajax_sanzo_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );
			add_action('wp_ajax_nopriv_sanzo_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );		
		}
		
		function product_title(){
			?>
			<h1 itemprop="name" class="product_title entry-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h1>
			<?php
		}
		
		function filter_add_to_cart_url(){
			$ref_url = wp_get_referer();
			$ref_url = remove_query_arg( array('added-to-cart','add-to-cart'), $ref_url );
			$ref_url = add_query_arg( array( 'add-to-cart' => $this->id ), $ref_url );
			return esc_url( $ref_url );
		}
		
		function filter_review_link( $review_link = '#reviews' ){
			global $product;
			$link = esc_url( get_permalink( $product->get_id() ) );
			if( $link ){
				return trailingslashit($link) . $review_link;
			}
			else{
				return $review_link;
			}
		}
		
		function load_quickshop_content_callback(){
			global $post, $product;
			$prod_id = absint($_GET['product_id']);
			$post = get_post( $prod_id );
			$product = wc_get_product( $prod_id );

			if( $prod_id <= 0 ){
				die( esc_html__('Invalid Product', 'sanzo') );
			}
			if( !isset($post->post_type) || strcmp($post->post_type,'product') != 0 ){
				die( esc_html__('Invalid Product', 'sanzo') );
			}
			
			$this->id = $prod_id;
			
			add_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			add_filter( 'sanzo_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );
			
			/* Disable srcset attribute */
			if( function_exists('sanzo_disable_srcset_on_cloudzoom') ){
				sanzo_disable_srcset_on_cloudzoom();
			}
			
			$_wrapper_class = 'ts-quickshop-wrapper product type-' . $product->get_type();
			ob_start();	
			?>		
			<div itemscope itemtype="http://schema.org/Product" id="product-<?php echo get_the_ID();?>" <?php post_class( apply_filters('single_product_wrapper_class', $_wrapper_class) ); ?>>
				
				<div class="images-thumbnails">
					<!-- Main image -->
					<div class="images">
						<?php 
						if( function_exists('sanzo_template_loop_product_label') ){
							sanzo_template_loop_product_label();
						}
						if( has_post_thumbnail() ){
							$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
							$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
							$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
							$attributes = array(
								'title'                   => $image_title,
								'data-src'                => $full_size_image[0],
								'data-large_image'        => $full_size_image[0],
								'data-large_image_width'  => $full_size_image[1],
								'data-large_image_height' => $full_size_image[2],
							);
							
							$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'woocommerce_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="ts-qs-zoom cloud-zoom zoom" id="ts_qs_zoom" data-rel="position:\'inside\',showTitle:0,lensOpacity:0.5,adjustX:0,adjustY:-4">';
							$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
							$html .= '</a></div>';
						}
						else{
							$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'sanzo' ) );
							$html .= '</div>';
						}
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
						?>
					</div>
					<!-- Thumbnails -->
					<div class="thumbnails">
						<?php 
						$image_ids = array();
						if ( has_post_thumbnail() ){
							$image_ids[] = get_post_thumbnail_id();				
						}
						
						$attachment_ids = $product->get_gallery_image_ids();
						if( is_array($attachment_ids) ){
							$image_ids = array_merge($image_ids, $attachment_ids);
							if( count($image_ids) > 5 ){
								$image_ids = array_slice($image_ids, 0, 5);
							}
						}
						foreach( $image_ids as $image_id ){
							$image_info 		= wp_get_attachment_image_src($image_id, apply_filters( 'single_product_large_thumbnail_size', 'woocommerce_single' ));
							$image_title 		= get_the_title( $image_id );
							if( $image_info ){
								$image_url_full = wp_get_attachment_url($image_id);
							?>
							<div class="image-item">
								<a href="<?php echo esc_url($image_url_full) ?>" data-rel="useZoom: 'ts_qs_zoom', smallImage: '<?php echo esc_url($image_info[0]) ?>'" class="ts-qs-zoom-gallery cloud-zoom-gallery zoom">
									<img src="<?php echo esc_url($image_info[0]); ?>" alt="<?php echo esc_attr($image_title) ?>" />
								</a>
							</div>
							<?php 
							}
						}
						?>
					</div>
				</div>
				<!-- Product summary -->
				<div class="summary entry-summary">
					<?php do_action('sanzo_quickshop_single_product_title'); ?>
					<?php do_action('sanzo_quickshop_single_product_summary'); ?>
				</div>
			
			</div>
				
			<?php
			
			remove_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			remove_filter( 'sanzo_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );

			$return_html = ob_get_clean();
			wp_reset_postdata();
			die($return_html);
		}
		
	}
	new Sanzo_Quickshop();
}
?>
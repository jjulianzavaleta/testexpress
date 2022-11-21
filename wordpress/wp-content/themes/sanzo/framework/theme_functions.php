<?php 
/*** Activate Theme ***/
function sanzo_theme_activation(){
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) )
	{
		if( get_option( 'woocommerce_single_image_width' ) === false ){
			/* Single Image */
			update_option( 'woocommerce_single_image_width', 480 );
			
			/* Thumbnail Image */
			update_option('woocommerce_thumbnail_image_width', 350);
			update_option('woocommerce_thumbnail_cropping', '1:1');
		}
		
		if( get_option( 'yith_woocompare_image_size' ) === false ){
			update_option( 'yith_woocompare_image_size', array( 'width' => '350', 'height' => '350', 'crop' => 1 ) );
		}
	}
}
add_action('admin_init','sanzo_theme_activation');

/*** Theme Setup ***/
function sanzo_theme_setup(){
	global $sanzo_theme_options;

	/* Add editor-style.css file*/
	add_editor_style();
	
	/* Add Theme Support */
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'quote', 'video' ) );		
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	$defaults = array(
		'default-color'         => ''
		,'default-image'        => ''
	);
	add_theme_support( 'custom-background', $defaults );
	
	add_theme_support( 'woocommerce' );
	
	if( isset($sanzo_theme_options['ts_prod_cloudzoom']) && !$sanzo_theme_options['ts_prod_cloudzoom'] ){
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	
	if ( ! isset( $content_width ) ){ $content_width = 1200; }
	
	/* Translation */
	load_theme_textdomain( 'sanzo', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ){
		require_once $locale_file;
	}
	
	/* Register Menu Location */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'sanzo' ),
	) );
	register_nav_menus( array(
		'vertical' => esc_html__( 'Vertical Navigation', 'sanzo' ),
	) );
	register_nav_menus( array(
		'mobile' => esc_html__( 'Mobile Navigation', 'sanzo' ),
	) );
}
add_action( 'after_setup_theme', 'sanzo_theme_setup');


/*** Add Image Size ***/
function sanzo_add_image_size(){
	global $sanzo_theme_options;
	$menu_icon_width = isset($sanzo_theme_options['ts_menu_thumb_width'])?(int)$sanzo_theme_options['ts_menu_thumb_width']:16;
	$menu_icon_height = isset($sanzo_theme_options['ts_menu_thumb_height'])?(int)$sanzo_theme_options['ts_menu_thumb_height']:16;
	add_image_size('sanzo_menu_icon_thumb', $menu_icon_width, $menu_icon_height, true);
	
	add_image_size('sanzo_blog_shortcode_thumb', 680, 438, true);
	add_image_size('sanzo_blog_thumb', 1180, 760, true);
	add_image_size('sanzo_product_cat_thumb', 370, 450, true);
	add_image_size('sanzo_product_cat_thumb_2', 650, 650, true);
}
sanzo_add_image_size();

/*** Register google font ***/
function sanzo_register_google_font(){				
	global $sanzo_theme_options;
	$fonts = array();
	
	if( $sanzo_theme_options['ts_body_font_enable_google_font'] ){
		$fonts[] = array(
					'name'	=> $sanzo_theme_options['ts_body_font_google']	
					,'bold'	=> '300,400,500,600,700,800,900'
				);
	}
	
	if( $sanzo_theme_options['ts_secondary_body_font_enable_google_font'] ){
		$fonts[] = array(
					'name'	=> $sanzo_theme_options['ts_secondary_body_font_google']	
					,'bold'	=> '300,400,500,600,700,800,900'
				);
	}
	
	if( $sanzo_theme_options['ts_thirdary_body_font_enable_google_font'] ){
		$fonts[] = array(
					'name'	=> $sanzo_theme_options['ts_thirdary_body_font_google']
					,'bold'	=> '300,400,500,600,700,800,900'
				);
	}
	
	if( $sanzo_theme_options['ts_menu_font_enable_google_font'] ){
		$fonts[] = array(
					'name'	=> $sanzo_theme_options['ts_menu_font_google']	
					,'bold'	=> '300,400,500,600,700,800,900'
				);
	}
	
	if( $sanzo_theme_options['ts_sub_menu_font_enable_google_font'] ){
		$fonts[] = array(
					'name'	=> $sanzo_theme_options['ts_sub_menu_font_google']	
					,'bold'	=> '300,400,500,600,700,800,900'
				);
	}
	
	foreach( $fonts as $font ){
		sanzo_load_google_font( $font['name'], $font['bold'] );
	}
}

function sanzo_load_google_font( $font_name = '', $font_bold = '300,400,500,600,700,800,900' ){
	if( $font_name ){
		$font_name_id = sanitize_title( $font_name );
		
		$font_url = add_query_arg( 'family', urlencode( $font_name . ':' . $font_bold . '&subset=latin,latin-ext' ), '//fonts.googleapis.com/css');
		wp_enqueue_style( "google-fonts-{$font_name_id}", $font_url );
	}
}

/*** Register Front End Scripts  ***/
function sanzo_register_scripts(){
	global $sanzo_theme_options;
	sanzo_register_google_font();
	
	wp_deregister_style( 'font-awesome' );
	wp_deregister_style( 'yith-wcwl-font-awesome' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'sanzo-reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'sanzo-reset' );
	
	wp_enqueue_style( 'sanzo-style', get_stylesheet_uri() );
	
	if( isset($sanzo_theme_options['ts_responsive']) && (int) $sanzo_theme_options['ts_responsive'] == 1 ){
		wp_register_style( 'sanzo-responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_style( 'sanzo-responsive' );
	}
	
	wp_deregister_style( 'owl.carousel' );
	wp_register_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'owl.carousel' );
	
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'prettyPhoto' );
	
	wp_deregister_style( 'select2' );
	wp_register_style( 'select2', get_template_directory_uri() . '/css/select2.css' );
	wp_enqueue_style( 'select2' );
	
	if( isset($sanzo_theme_options['ts_enable_rtl']) && $sanzo_theme_options['ts_enable_rtl'] ){
		wp_register_style( 'sanzo-rtl', get_template_directory_uri() . '/css/rtl.css' );
		wp_enqueue_style( 'sanzo-rtl' );
		if( isset($sanzo_theme_options['ts_responsive']) && (int) $sanzo_theme_options['ts_responsive'] == 1 ){
			wp_register_style( 'sanzo-rtl-responsive', get_template_directory_uri() . '/css/rtl-responsive.css' );
			wp_enqueue_style( 'sanzo-rtl-responsive' );
		}
	}
	
	wp_register_script( 'sanzo-include-scripts', get_template_directory_uri().'/js/include_scripts.js', array('jquery'), null, true);
	wp_enqueue_script( 'sanzo-include-scripts' );
	
	wp_dequeue_script('owl.carousel');
	wp_register_script( 'owl.carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array(), null, true);
	wp_enqueue_script( 'owl.carousel' );
	
	wp_register_script( 'sanzo-script', get_template_directory_uri().'/js/main.js', array('jquery'), null, true);
	wp_enqueue_script( 'sanzo-script' );
	
	if( (is_singular('product') && $sanzo_theme_options['ts_prod_cloudzoom']) || class_exists('Sanzo_Quickshop') ){
		wp_register_script( 'sanzo-cloud-zoom', get_template_directory_uri().'/js/cloud-zoom.js', array('jquery'), null, true);
		wp_enqueue_script( 'sanzo-cloud-zoom' );
	}
	
	wp_register_script( 'jquery-caroufredsel', get_template_directory_uri().'/js/jquery.carouFredSel-6.2.1.min.js', array(), null, true);
	if( is_singular('product') && $sanzo_theme_options['ts_prod_thumbnails_style'] == 'vertical' ){
		wp_enqueue_script( 'jquery-caroufredsel' );
	}
	
	wp_enqueue_script( 'wc-add-to-cart-variation' );
	
	$load_select2 = true;
	if( function_exists('dokan_get_option') && wp_script_is('dokan-select2-js', 'enqueued') ){
		$page_id = dokan_get_option( 'dashboard', 'dokan_pages' );
		if( $page_id ){
			if( is_page($page_id) || ( get_query_var('edit') && is_singular('product') ) ){
				$load_select2 = false;
			}
		}
	}
	if( $load_select2 ){
		wp_dequeue_script('select2');
		wp_register_script( 'select2', get_template_directory_uri().'/js/select2.min.js', array(), null, true);
		wp_enqueue_script('select2');
	}
	
	if( is_single() && get_option( 'thread_comments' ) ){ 	
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Custom JS */
	if( isset($sanzo_theme_options['ts_custom_javascript_code']) && $sanzo_theme_options['ts_custom_javascript_code'] ){
		wp_add_inline_script( 'sanzo-script', stripslashes( trim( $sanzo_theme_options['ts_custom_javascript_code'] ) ) );
	}
	
}
add_action('wp_enqueue_scripts', 'sanzo_register_scripts', 1000);

function sanzo_register_custom_style(){
	$upload_dir = wp_upload_dir();
	$filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
	if( is_ssl() ){
		$filename = str_replace('http://', 'https://', $filename);
	}
	$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';

	if( file_exists( $filename_dir ) ){ 
		wp_enqueue_style('sanzo-dynamic-css', $filename, array(), get_option('sanzo_of_last_updated_time'));
	}
	else{
		ob_start();
		include_once get_template_directory() . '/framework/dynamic_style.php';
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		wp_add_inline_style( 'sanzo-style', $dynamic_css );
	}
}
add_action('wp_enqueue_scripts', 'sanzo_register_custom_style', 9999);

/* Add font style to compare popup - can not use wp_enqueue_scripts hook */
if( isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table' ){
	add_action('wp_print_styles', 'sanzo_add_font_style_to_compare_popup', 1000);
}
function sanzo_add_font_style_to_compare_popup(){
	global $sanzo_theme_options;
	sanzo_register_google_font();
	wp_enqueue_style( 'sanzo-reset' );
	wp_enqueue_style( 'sanzo-style' );
	wp_enqueue_style( 'font-awesome' );
	if( $sanzo_theme_options['ts_enable_rtl'] ){
		wp_enqueue_style( 'sanzo-rtl' );
	}
	wp_enqueue_style('sanzo-dynamic-css');
}

/*** Register Back End Scripts ***/
function sanzo_register_admin_scripts(){
	wp_enqueue_media();
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'sanzo-admin-style', get_template_directory_uri() . '/css/admin_style.css' );
	wp_enqueue_style( 'sanzo-admin-style' );
	
	wp_register_script( 'sanzo-admin-script', get_template_directory_uri().'/js/admin_main.js', array('jquery'), null, true);
	wp_enqueue_script( 'sanzo-admin-script' );
}
add_action('admin_enqueue_scripts', 'sanzo_register_admin_scripts');

/*** Register Javascript Global Variable***/
function sanzo_register_javascript_global_variable(){
	global $sanzo_theme_options;
	
	$smooth_scroll = 0;
	
	$window = false;
	$chrome = false;
	
	if( !empty($_SERVER['HTTP_USER_AGENT']) ){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$window  = (bool)preg_match('/Windows/i', $user_agent );
		$chrome  = (bool)preg_match('/Chrome/i', $user_agent );
	}
	
	if( $sanzo_theme_options['ts_smooth_scroll'] && !wp_is_mobile() && $window && $chrome ){
		$smooth_scroll = 1;
	}
	
	?>
	<script type="text/javascript">
		<?php if( defined('ICL_LANGUAGE_CODE') ): ?>
			var _ts_ajax_uri = '<?php echo admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative'); ?>';
		<?php else: ?>
			var _ts_ajax_uri = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
		<?php endif; ?>
		var _ts_enable_sticky_header = <?php echo (int)$sanzo_theme_options['ts_enable_sticky_header']; ?>;
		var _ts_enable_responsive = <?php echo (int)$sanzo_theme_options['ts_responsive']; ?>;
		var _ts_enable_smooth_scroll = <?php echo (int)$smooth_scroll; ?>;
		var _ts_enable_ajax_search = <?php echo isset($sanzo_theme_options['ts_ajax_search'])?(int)$sanzo_theme_options['ts_ajax_search']:1; ?>;
	</script>
	<?php
}
add_action('wp_footer', 'sanzo_register_javascript_global_variable');

/*** Array Attribute Compare ***/
if( !function_exists ('sanzo_array_atts') ){
	function sanzo_array_atts($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
		foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( is_array($atts[$name]) && is_array($default) ){
					$out[$name] = sanzo_array_atts($default,$atts[$name]);
				}
				else{
					$out[$name] = $atts[$name];
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}

/*** Vertical Menu Heading ***/
if( !function_exists ('sanzo_get_vertical_menu_heading') ){
	function sanzo_get_vertical_menu_heading(){
		$locations = get_nav_menu_locations();
		if( isset($locations['vertical']) ){
			$menu = wp_get_nav_menu_object($locations['vertical']);
			if( isset( $menu->name ) ){
				return $menu->name;
			}
			else{
				return esc_html__('Shop by category', 'sanzo');
			}
		}
		return '';
	}
}

/*** Get excerpt ***/
if( !function_exists ('sanzo_string_limit_words') ){
	function sanzo_string_limit_words($string, $word_limit){
		$words = explode(' ', $string, ($word_limit + 1));
		if( count($words) > $word_limit ){
			array_pop($words);
		}
		return implode(' ', $words);
	}
}

if( !function_exists ('sanzo_the_excerpt_max_words') ){
	function sanzo_the_excerpt_max_words( $word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true ) {
		if( $post ){
			$excerpt = sanzo_get_the_excerpt_by_id($post->ID);
		}
		else{
			$excerpt = get_the_excerpt();
		}
			
		if( $strip_tags ){
			$excerpt = wp_strip_all_tags($excerpt);
			$excerpt = strip_shortcodes($excerpt);
		}
			
		if( $word_limit != -1 )
			$result = sanzo_string_limit_words($excerpt, $word_limit);
		else
			$result = $excerpt;
		
		$result .= $extra_str;
			
		if( $echo ){
			echo do_shortcode($result);
		}
		return $result;
	}
}

if( !function_exists('sanzo_get_the_excerpt_by_id') ){
	function sanzo_get_the_excerpt_by_id( $post_id = 0 )
	{
		global $wpdb;
		$query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
		$result = $wpdb->get_results( $wpdb->prepare($query, $post_id), ARRAY_A );
		if( $result[0]['post_excerpt'] ){
			return $result[0]['post_excerpt'];
		}
		else{
			return $result[0]['post_content'];
		}
	}
}

/* Get User Role */
if( !function_exists('sanzo_get_user_role') ){
	function sanzo_get_user_role( $user_id ){
		global $wpdb;
		$user = get_userdata( $user_id );
		$capabilities = $user->{$wpdb->prefix . 'capabilities'};
		if( empty($capabilities) ){
			return '';
		}
		if ( !isset( $wp_roles ) ){
			$wp_roles = new WP_Roles();
		}
		foreach ( $wp_roles->role_names as $role => $name ) {
			if ( array_key_exists( $role, $capabilities ) ) {
				return $role;
			}
		}
		return '';
	}
}

/*** Get Page Options ***/
if( !function_exists('sanzo_get_page_options') ){
	function sanzo_get_page_options( $page_id = 0, $get_cache = true ){
		global $post;
		static $cached_page_options = null; /* only query one time */
		
		if( $get_cache && $cached_page_options != null && is_array($cached_page_options) ){
			$page_options = $cached_page_options;
		}
		else{
			if( !$page_id && isset($post->ID) ){
				$page_id = $post->ID;
			}
			$page_options = array();
			
			$post_custom = get_post_custom( $page_id );
			if( !is_array($post_custom) ){
				$post_custom = array();
			}
			foreach( $post_custom as $key => $value ){
				if( isset($value[0]) ){
					$page_options[$key] = $value[0];
				}
			}
			$default_page_options = array(
								'ts_layout_style'						=> 'default'
								,'ts_header_layout_style'				=> 'boxed'
								,'ts_main_content_layout_style'			=> 'boxed'
								,'ts_footer_layout_style'				=> 'boxed'
								,'ts_page_layout'						=> '0-1-0'
								,'ts_left_sidebar'						=> ''
								,'ts_right_sidebar'						=> ''
								,'ts_header_layout'						=> 'default'
								,'ts_menu_id'							=> 0
								,'ts_display_vertical_menu_by_default'	=> 0
								,'ts_breadcrumb_layout'					=> 'default'
								,'ts_breadcrumb_bg_parallax'			=> 'default'
								,'ts_bg_breadcrumbs'					=> ''
								,'ts_logo'								=> ''
								,'ts_logo_mobile'						=> ''
								,'ts_logo_sticky'						=> ''
								,'ts_show_breadcrumb'					=> 1
								,'ts_show_page_title'					=> 1
								,'ts_page_slider'						=> 0
								,'ts_page_slider_position'				=> 'before_main_content'
								,'ts_rev_slider'						=> 0
								);
								
			$page_options = sanzo_array_atts($default_page_options, $page_options);
			$cached_page_options = $page_options;
		}
		
		return $page_options;
	}
}

/*** Page Layout Columns Class ***/
if( !function_exists('sanzo_page_layout_columns_class') ){
	function sanzo_page_layout_columns_class($page_column){
		$data = array();
		
		if( empty($page_column) ){
			$page_column = '0-1-0';
		}
		
		$layout_config = explode('-', $page_column);
		$left_sidebar = (int)$layout_config[0];
		$right_sidebar = (int)$layout_config[2];
		$main_class = ($left_sidebar + $right_sidebar) == 2 ?'ts-col-12':( ($left_sidebar + $right_sidebar) == 1 ?'ts-col-18':'ts-col-24' );			
		
		$data['left_sidebar'] = $left_sidebar;
		$data['right_sidebar'] = $right_sidebar;
		$data['main_class'] = $main_class;
		$data['left_sidebar_class'] = 'ts-col-6';
		$data['right_sidebar_class'] = 'ts-col-6';
		
		return $data;
	}
}

/*** Show Page Slider ***/
function sanzo_show_page_slider(){
	$page_options = sanzo_get_page_options();
	switch( $page_options['ts_page_slider'] ){
		case 'revslider':
			$selected_slider = $page_options['ts_rev_slider'];
			if( class_exists('RevSliderSlider') && $selected_slider ){
				if( !defined('RS_REVISION') ){ /* RS < 6 */
					if( is_numeric($selected_slider) ){
						$rev_db = new RevSliderDB();
						$response = $rev_db->fetch(RevSliderGlobals::$table_sliders, 'id='.$selected_slider);
						if( !empty($response) ){
							RevSliderOutput::putSlider($selected_slider, '');
						}
					}
					else{
						echo do_shortcode('[rev_slider alias="'.$selected_slider.'"][/rev_slider]');
					}
				}
				else{
					if( is_numeric($selected_slider) ){
						$slider = new RevSliderSlider();
						$sliders = $slider->get_sliders();
						$list_ids = wp_list_pluck($sliders, 'id');
						$list_alias = wp_list_pluck($sliders, 'alias');
						$key = array_search($selected_slider, $list_ids);
						if( $key !== false ){
							echo do_shortcode('[rev_slider alias="'.$list_alias[$key].'"][/rev_slider]');
						}
					}
					else{
						echo do_shortcode('[rev_slider alias="'.$selected_slider.'"][/rev_slider]');
					}
				}
			}
		break;
		default:
		break;
	}
}

/*** Breadcrumbs ***/
if(!function_exists('sanzo_breadcrumbs')){
	function sanzo_breadcrumbs() {
		global $sanzo_theme_options;
		
		$is_rtl = is_rtl() || ( isset($sanzo_theme_options['ts_enable_rtl']) && $sanzo_theme_options['ts_enable_rtl'] );
		
		if( class_exists('WooCommerce') ){
			if( function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce() ){
				woocommerce_breadcrumb(array('wrap_before'=>'<div class="breadcrumbs"><div class="breadcrumbs-container">','delimiter'=>'<span>'.($is_rtl?'\\':'/').'</span>','wrap_after'=>'</div></div>'));
				return;
			}
		}
		
		if( function_exists('bbp_breadcrumb') && function_exists('is_bbpress') && is_bbpress() ){
			$args = array(
				'before' 			=> '<div class="breadcrumbs"><div class="breadcrumbs-container">'
				,'after' 			=> '</div></div>'
				,'sep' 				=> $is_rtl?'\\':'/'
				,'sep_before' 		=> '<span class="brn_arrow">'
				,'sep_after' 		=> '</span>'
				,'current_before' 	=> '<span class="current">'
				,'current_after' 	=> '</span>'
			);
			
			bbp_breadcrumb( $args );
			/* Remove bbpress breadcrumbs */
			add_filter('bbp_no_breadcrumb', '__return_true', 999);
			return;
		}
 
		$delimiter = '<span class="brn_arrow">'.($is_rtl?'\\':'/').'</span>';
	  
		$front_id = get_option( 'page_on_front' );
		if ( !empty( $front_id ) ) {
			$home = get_the_title( $front_id );
		} else {
			$home = esc_html__( 'Home', 'sanzo' );
		}
		$ar_title = array(
					'search' 		=> esc_html__('Search results for ', 'sanzo')
					,'404' 			=> esc_html__('Error 404', 'sanzo')
					,'tagged' 		=> esc_html__('Tagged ', 'sanzo')
					,'author' 		=> esc_html__('Articles posted by ', 'sanzo')
					,'page' 		=> esc_html__('Page', 'sanzo')
					,'portfolio' 	=> esc_html__('Portfolio', 'sanzo')
					);
	  
		$before = '<span class="current">'; /* tag before the current crumb */
		$after = '</span>'; /* tag after the current crumb */
		global $wp_rewrite;
		$rewriteUrl = $wp_rewrite->using_permalinks();
		if ( !is_home() && !is_front_page() || is_paged() ) {
	 
			echo '<div class="breadcrumbs"><div class="breadcrumbs-container">';
	 
			global $post;
			$homeLink = esc_url( home_url('/') ); 
			echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
			if ( is_category() ) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ( $thisCat->parent != 0 ) { 
					echo get_category_parents($parentCat, true, ' ' . $delimiter . ' '); 
				}
				echo $before . single_cat_title('', false) . $after;
		 
			}
			elseif ( is_search() ) {
				echo $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
		 
			}elseif ( is_day() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
		 
			}elseif ( is_month() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
		 
			}elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;
		 
			}elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type_name = $post_type->labels->singular_name;
				if( strcmp('Portfolio Item', $post_type->labels->singular_name) == 0 ){
					$post_type_name = $ar_title['portfolio'];
				}
				if( $rewriteUrl ){
					echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
				}else{
					echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
				}
				
				echo $before . get_the_title() . $after;
			    } else {
					$cat = get_the_category(); $cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo $before . get_the_title() . $after;
			    }
		 
			}elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$post_type_name = $post_type->labels->singular_name;
			    if( strcmp('Portfolio Item', $post_type->labels->singular_name) == 0 ){
					$post_type_name = $ar_title['portfolio'];
			    }
				if ( is_tag() ) {
					echo $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
				}
				elseif( is_taxonomy_hierarchical(get_query_var('taxonomy')) ){
					if($rewriteUrl){
						echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}			
					
					$curTaxanomy = get_query_var('taxonomy');
					$curTerm = get_query_var( 'term' );
					$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
					$pushPrintArr = array();
					if( $termNow !== false ){
						while ((int)$termNow->parent != 0){
							$parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
							array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
							$curTerm = $parentTerm->name;
							$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
						}
					}
					$pushPrintArr = array_reverse($pushPrintArr);
					array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
					echo implode($pushPrintArr);
				}else{
					echo $before . $post_type_name . $after;
				}
		 
			}elseif( is_attachment() ) {
				if( (int)$post->post_parent > 0 ){
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if( count($cat) > 0 ){
						$cat = $cat[0];
						echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					}
					echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				}
				echo $before . get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo $before . get_the_title() . $after;
		 
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
			    }
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
		 
			} elseif ( is_tag() ) {
				echo $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
		 
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . $ar_title['author'] . $userdata->display_name . $after;
		 
			} elseif ( is_404() ) {
				echo $before . $ar_title['404'] . $after;
			}
		 
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					echo $before .' ('; 
				}
				echo $ar_title['page'] . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					echo ')'. $after; 
				}
			}
			else{ 
				if ( get_query_var('page') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
						echo $before .' ('; 
					}
					echo $ar_title['page'] . ' ' . get_query_var('page');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
						echo ')'. $after; 
					}
				}
			}
			echo '</div></div>';
	 
	    }
		
		wp_reset_postdata();
	}
}

function sanzo_breadcrumbs_title( $show_breadcrumb = false, $show_page_title = false, $page_title = '', $extra_class_title = '' ){
	global $sanzo_theme_options;
	if( $show_breadcrumb || $show_page_title ){
		$breadcrumb_bg 				= '';
		$breadcrumb_layout 			= $sanzo_theme_options['ts_breadcrumb_layout'];
		$enable_background_image 	= $sanzo_theme_options['ts_enable_breadcrumb_background_image'];
		$enable_parallax 			= $sanzo_theme_options['ts_breadcrumb_bg_parallax'];
		$breadcrumb_bg_option 		= $sanzo_theme_options['ts_bg_breadcrumbs'];
		$layout_style 				= $sanzo_theme_options['ts_layout_style'];
		$main_content_layout_style 	= $sanzo_theme_options['ts_main_content_layout_style'];
		
		$extra_class = 'breadcrumb-' . $breadcrumb_layout;
		if( $enable_background_image && ( $breadcrumb_layout == 'v2' || $breadcrumb_layout == 'v3' ) ){
			if( $breadcrumb_bg_option == '' ){ /* No Override */
				$breadcrumb_bg = get_template_directory_uri() . '/images/bg_breadcrumb_'.$breadcrumb_layout.'.jpg';
			}
			else{
				$breadcrumb_bg = esc_url( $breadcrumb_bg_option );
			}
		}
		
		$style = '';
		if( $breadcrumb_bg != '' ){
			$style = 'style="background-image: url('. $breadcrumb_bg .')"';
			if( $enable_parallax ){
				$extra_class .= ' ts-breadcrumb-parallax';
			}
		}
		if( $breadcrumb_bg != '' && ( $layout_style == 'wide' || ( $layout_style == 'advance' && $main_content_layout_style == 'wide' ) ) ){
			echo '<div class="breadcrumb-title-wrapper '.$extra_class.'" '.$style.'><div class="breadcrumb-content"><div class="breadcrumb-title">';
		}else{
			echo '<div class="breadcrumb-title-wrapper '.$extra_class.'"><div class="breadcrumb-content" '.$style.'><div class="breadcrumb-title">';
		}
		if( $show_page_title ){
			echo '<h1 itemprop="name" class="heading-title page-title entry-title '.$extra_class_title.'">'.$page_title.'</h1>';
		}
		if( $show_breadcrumb ){
			sanzo_breadcrumbs();
		}
		echo '</div></div></div>';
	}
}

/*** Pagination ***/
if( !function_exists('sanzo_pagination') ){
	function sanzo_pagination( $query = null ){
		global $wp_query;
		$max_num_pages = $wp_query->max_num_pages;
		$paged = $wp_query->get( 'paged' );
		if( $query != null ){
			$max_num_pages = $query->max_num_pages;
			$paged = $query->get( 'paged' );
		}
		if( !$paged ){
			$paged = 1;
		}
		?>
		<nav class="ts-pagination">
			<?php
			echo paginate_links( array(
				'base'         	=> esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) )
				,'format'       => ''
				,'add_args'     => ''
				,'current'      => max( 1, $paged )
				,'total'        => $max_num_pages
				,'prev_text'    => '&larr;'
				,'next_text'    => '&rarr;'
				,'type'         => 'list'
				,'end_size'     => 3
				,'mid_size'     => 3
			) );
			?>
		</nav>
		<?php
	}
}

/*** Logo ***/
if( !function_exists('sanzo_theme_logo') ){
	function sanzo_theme_logo(){
		global $sanzo_theme_options;
		$logo_image 		= trim($sanzo_theme_options['ts_logo']);
		$logo_image_mobile 	= trim($sanzo_theme_options['ts_logo_mobile']);
		$logo_image_sticky 	= trim($sanzo_theme_options['ts_logo_sticky']);
		$logo_text 			= trim($sanzo_theme_options['ts_text_logo']);
		
		if( $logo_image_sticky == '' ){
			$logo_image_sticky = $logo_image;
		}
		if( $logo_image_mobile == '' ){
			$logo_image_mobile = $logo_image;
		}
		if( $logo_text == '' ){
			$logo_text = get_bloginfo('name');
		}
		?>
		<div class="logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>">
			<!-- Main logo -->
			<?php if( $logo_image ): ?>
				<img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="normal-logo" />
			<?php endif; ?>
			
			<!-- Main logo on mobile -->
			<?php if( $logo_image_mobile ): ?>
				<img src="<?php echo esc_url($logo_image_mobile); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="normal-logo mobile-logo" />
			<?php endif; ?>
			
			<!-- Sticky logo -->
			<?php if( $logo_image_sticky ): ?>
				<img src="<?php echo esc_url($logo_image_sticky); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="normal-logo sticky-logo" />
			<?php endif; ?>
			
			<!-- Logo Text -->
			<?php 
			if( $logo_image == '' ){
				echo esc_html($logo_text); 
			}
			?>
			</a>
		</div>
		<?php
	}
}

/*** Favicon ***/
if( !function_exists('sanzo_theme_favicon') ){
	function sanzo_theme_favicon(){
		if( function_exists('wp_site_icon') && function_exists('has_site_icon') && has_site_icon() ){
			return;
		}
		global $sanzo_theme_options;
		$favicon = trim($sanzo_theme_options['ts_favicon']);
		if( $favicon ){
		?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" />
		<?php
		}
	}
}

/*** Save Of Options - Save Dynamic css ***/
add_action('sanzo_of_save_options_after', 'sanzo_update_dynamic_css', 10000);
if( !function_exists('sanzo_update_dynamic_css') ){
	function sanzo_update_dynamic_css( $data = array() ){
		
		if( !is_array($data) ){
			return -1;
		}
		if(is_array($data['data'])){
			$data = $data['data'];	
		}
		else{
			return -1;
		}
	
		$upload_dir = wp_upload_dir();
		$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
		ob_start();
		include get_template_directory() . '/framework/dynamic_style.php';
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once ABSPATH .'/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		
		$creds = request_filesystem_credentials($filename_dir, '', false, false, array());
		if( ! WP_Filesystem($creds) ){
			return false;
		}

		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename_dir,
				$dynamic_css,
				FS_CHMOD_FILE
			);
		}
	}
}

/*** Social Sharing ***/
if( !function_exists('sanzo_template_social_sharing') ){
	function sanzo_template_social_sharing(){
		get_template_part('templates/social-sharing');
	}
}

/*** Product Search Form by Category ***/
if( !function_exists('sanzo_get_search_form_by_category') ){
	function sanzo_get_search_form_by_category(){
		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
			$placeholder_text = esc_html__('Search for products', 'sanzo');
		}
		else{
			$taxonomy = 'category';
			$post_type = 'post';
			$placeholder_text = esc_html__('Search', 'sanzo');
		}
		
		$options = '<option value="">'.esc_html__('All categories', 'sanzo').'</option>';
		$options .= sanzo_search_by_category_get_option_html($taxonomy, 0, 0);
		
		$rand = rand(0, 1000);
		$form = '<div class="ts-search-by-category">
		<form method="get" id="searchform' . $rand . '" action="' . esc_url( home_url( '/'  ) ) . '">
		 <select class="select-category" name="term">' . $options . '</select>
		 <div class="search-content">
			 <input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder_text . '" autocomplete="off" />
			 <input type="submit" title="' . esc_attr__( 'Search', 'sanzo' ) . '" id="searchsubmit' . $rand . '" value="' . esc_attr__( 'Search', 'sanzo' ) . '" />
			 <input type="hidden" name="post_type" value="' . $post_type . '" />
			 <input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
		 </div>
		</form></div>';
		
		echo $form;
	}
}

if( !function_exists('sanzo_search_by_category_get_option_html') ){
	function sanzo_search_by_category_get_option_html($taxonomy = 'product_cat', $parent = 0, $level = 0){
		$options = '';
		$spacing = '';
		for( $i = 0; $i < $level * 3 ; $i++ ){
			$spacing .= '&nbsp;';
		}
		
		$args = array(
			'number'     	=> ''
			,'hide_empty'	=> 1
			,'orderby'		=>'name'
			,'order'		=>'asc'
			,'parent'		=> $parent
		);
		
		$select = '';
		$categories = get_terms($taxonomy, $args);
		if( is_search() &&  isset($_GET['term']) && $_GET['term'] != '' ){
			$select = $_GET['term'];
		}
		$level++;

		// Ignorando la categoría de bolsas en el dropdown de categorías de la búsqueda de productos en header
		foreach ($categories as $key => $value) {
		    if ($value->term_id == 15) {
		        unset($categories[$key]);        
		    }
		}

		if( is_array($categories) ){
			foreach( $categories as $cat ){
				$options .= '<option value="' . $cat->slug . '" ' . selected($select, $cat->slug, false) . '>' . $spacing . $cat->name . '</option>';
				$options .= sanzo_search_by_category_get_option_html($taxonomy, $cat->term_id, $level);
			}
		}
		
		return $options;
	}
}

/* Ajax search */
add_action( 'wp_ajax_sanzo_ajax_search', 'sanzo_ajax_search' );
add_action( 'wp_ajax_nopriv_sanzo_ajax_search', 'sanzo_ajax_search' );
if( !function_exists('sanzo_ajax_search') ){
	function sanzo_ajax_search(){
		global $wpdb, $post, $sanzo_theme_options;
		
		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
		}
		else{
			$taxonomy = 'category';
			$post_type = 'post';
		}
		
		$num_result = isset($sanzo_theme_options['ts_ajax_search_number_result'])? (int)$sanzo_theme_options['ts_ajax_search_number_result']: 10;
		$desc_limit_words = isset($sanzo_theme_options['ts_prod_cat_grid_desc_words'])?(int)$sanzo_theme_options['ts_prod_cat_grid_desc_words']:10;
		
		$search_string = $_POST['search_string'];
		$category = isset($_POST['category'])? $_POST['category']: '';
		
		$args = array(
			'post_type'			=> $post_type
			,'post_status'		=> 'publish'
			,'s'				=> $search_string
			,'posts_per_page'	=> $num_result
			,'tax_query'		=> array()
		);
		
		if( $search_for_product ){
			$args['meta_query'] = WC()->query->get_meta_query();
			$args['tax_query'] = WC()->query->get_tax_query();
		}
		
		if( $category != '' ){
			$args['tax_query'][] = array(
					'taxonomy'  => $taxonomy
					,'terms'	=> $category
					,'field'	=> 'slug'
				);
		}
		
		$results = new WP_Query($args);
		
		if( $results->have_posts() ){
			$extra_class = '';
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$extra_class = 'has-view-all';
			}
			
			$html = '<ul class="'.$extra_class.'">';
			while( $results->have_posts() ){
				$results->the_post();
				$link = get_permalink($post->ID);
				
				$image = '';
				if( $post_type == 'product' ){
					$product = wc_get_product($post->ID);
					$image = $product->get_image();
				}
				else if( has_post_thumbnail($post->ID) ){
					$image = get_the_post_thumbnail($post->ID, 'thumbnail');
				}
				
				$html .= '<li>';
					$html .= '<div class="thumbnail">';
						$html .= '<a href="'.esc_url($link).'">'. $image .'</a>';
					$html .= '</div>';
					$html .= '<div class="meta">';
						$html .= '<a href="'.esc_url($link).'" class="title">'. sanzo_search_highlight_string($post->post_title, $search_string) .'</a>';
						$html .= '<div class="description">'. sanzo_the_excerpt_max_words($desc_limit_words, '', true, ' ...', false) .'</div>';
						if( $post_type == 'product' ){
							if( $price_html = $product->get_price_html() ){
								$html .= '<span class="price">'. $price_html .'</span>';
							}
						}
					$html .= '</div>';
				$html .= '</li>';
			}
			$html .= '</ul>';
			
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$view_all_text = sprintf( esc_html__('View all %d results', 'sanzo'), $results->found_posts );
				
				$html .= '<div class="view-all-wrapper">';
					$html .= '<a href="#">'. $view_all_text .'</a>';
				$html .= '</div>';
			}
			
			wp_reset_postdata();
			
			$return = array();
			$return['html'] = $html;
			$return['search_string'] = $search_string;
			die( json_encode($return) );
		}
		
		die('');
	}
}

if( !function_exists('sanzo_search_highlight_string') ){
	function sanzo_search_highlight_string($string, $search_string){
		$new_string = '';
		$pos_left = stripos($string, $search_string);
		if( $pos_left !== false ){
			$pos_right = $pos_left + strlen($search_string);
			$new_string_right = substr($string, $pos_right);
			$search_string_insensitive = substr($string, $pos_left, strlen($search_string));
			$new_string_left = stristr($string, $search_string, true);
			$new_string = $new_string_left . '<span class="hightlight">' . $search_string_insensitive . '</span>' . $new_string_right;
		}
		else{
			$new_string = $string;
		}
		return $new_string;
	}
}

/* Post like */
if( !function_exists('sanzo_get_post_like') ){
	function sanzo_get_post_like(){
		ob_start();
		global $post;
		$is_ajax = defined('DOING_AJAX') && DOING_AJAX;
		
		$post_id = $post->ID;
		if( $is_ajax && isset($_POST['post_id']) ){
			$post_id = $_POST['post_id'];
		}
		
		$number_like = get_post_meta($post_id, '_ts_like', true);
		$number_like = absint($number_like);
		
		$tooltip_text = '';
		
		$is_logged = is_user_logged_in();
		if( $is_logged ){
			$user_id = get_current_user_id();
			$already_like = get_user_meta($user_id, '_ts_like_'.$post_id, true);
			if( $already_like ){
				$tooltip_text = esc_html__('Unlike', 'sanzo');
			}
			else{
				$tooltip_text = esc_html__('Like', 'sanzo');
			}
		}
		?>
		<div class="post-like-container <?php echo !empty($already_like)?'already-like':'' ?>" data-post_id="<?php echo esc_attr($post_id) ?>">
			<span class="ic-like <?php echo ($is_logged)?'allow-like':'' ?>">
			<?php 
			if( $tooltip_text ){
				?>
				<span class="ts-tooltip">
					<?php echo esc_html($tooltip_text) ?>
				</span>
				<?php
			}
			?>
			</span>
			<span class="number-like"><?php echo esc_html($number_like) ?></span>
			<span class="text-like"><?php echo _n('like', 'likes', $number_like, 'sanzo') ?></span>
			<?php if( !$is_logged ): ?>
				<span class="message-like">(<?php esc_html_e('You must login to like', 'sanzo') ?>)</span>
			<?php endif; ?>
		</div>
		<?php
		$content = ob_get_clean();
		if( $is_ajax ){
			die($content);
		}
		else{
			echo $content;
		}
	}
}

add_action( 'wp_ajax_sanzo_update_post_like', 'sanzo_update_post_like' );
if( !function_exists('sanzo_update_post_like') ){
	function sanzo_update_post_like(){
		if( !isset($_POST['post_id']) || !is_user_logged_in() ){
			die('');
		}
		$post_id = $_POST['post_id'];
		$number_like = get_post_meta($post_id, '_ts_like', true);
		$number_like = absint($number_like);
		
		$user_id = get_current_user_id();
		$already_like = get_user_meta($user_id, '_ts_like_'.$post_id, true);
		if( $already_like ){
			$number_like--;
			delete_user_meta($user_id, '_ts_like_'.$post_id);
		}
		else{
			$number_like++;
			update_user_meta($user_id, '_ts_like_'.$post_id, 1);
		}
		update_post_meta($post_id, '_ts_like', $number_like);
		sanzo_get_post_like();
	}
}

/* Match with ajax search results */
add_filter('woocommerce_get_catalog_ordering_args', 'sanzo_woocommerce_get_catalog_ordering_args_filter');
if( !function_exists('sanzo_woocommerce_get_catalog_ordering_args_filter') ){
	function sanzo_woocommerce_get_catalog_ordering_args_filter( $args ){
		global $sanzo_theme_options;
		if( is_search() && !isset($_GET['orderby']) && get_option( 'woocommerce_default_catalog_orderby' ) == 'menu_order' 
			&& isset($sanzo_theme_options['ts_ajax_search']) && $sanzo_theme_options['ts_ajax_search'] ){
			$args['orderby'] = '';
			$args['order'] = '';
		}
		return $args;
	}
}

/* Custom Sidebar */
add_action( 'sidebar_admin_page', 'sanzo_custom_sidebar_form' );
function sanzo_custom_sidebar_form(){
?>
	<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="ts-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php esc_attr_e('Custom Sidebar Name', 'sanzo') ?>" />
        <button class="button-primary" id="ts-add-sidebar"><?php esc_html_e('Add Sidebar', 'sanzo') ?></button>
    </form>
<?php
}

function sanzo_get_custom_sidebars(){
	$option_name = 'ts_custom_sidebars';
	$custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars)?$custom_sidebars:array();
}

add_action('wp_ajax_sanzo_add_custom_sidebar', 'sanzo_add_custom_sidebar');
function sanzo_add_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		$option_name = 'ts_custom_sidebars';
		if( !get_option($option_name) || get_option($option_name) == '' ){
			delete_option($option_name);
		}
		
		$sidebar_name = $_POST['sidebar_name'];
		
		if( get_option($option_name) ){
			$custom_sidebars = sanzo_get_custom_sidebars();
			if( !in_array($sidebar_name, $custom_sidebars) ){
				$custom_sidebars[] = $sidebar_name;
			}
			$result = update_option($option_name, $custom_sidebars);
		}
		else{
			$custom_sidebars = array();
			$custom_sidebars[] = $sidebar_name;
			$result = add_option($option_name, $custom_sidebars);
		}
		
		if( $result ){
			die( esc_html__('Successfully added the sidebar', 'sanzo') );
		}
		else{
			die( esc_html__('Error! It seems that the sidebar exists. Please try again!', 'sanzo') );
		}
	}
	die('');
}

add_action('wp_ajax_sanzo_delete_custom_sidebar', 'sanzo_delete_custom_sidebar');
function sanzo_delete_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		$option_name = 'ts_custom_sidebars';
		$del_sidebar = trim($_POST['sidebar_name']);
		$custom_sidebars = sanzo_get_custom_sidebars();
		foreach( $custom_sidebars as $key => $value ){
			if( $value == $del_sidebar ){
				unset($custom_sidebars[$key]);
				break;
			}
		}
		$custom_sidebars = array_values($custom_sidebars);
		update_option($option_name, $custom_sidebars);
		die('1');
	}
	die( esc_html__('Cant delete the sidebar. Please try again!', 'sanzo') );
}

/* Product Category Filter Icons */
function sanzo_get_product_filter_icons(){
	return get_option('ts_product_filter_icons', '');
}

function sanzo_get_product_filter_icons_hover(){
	return get_option('ts_product_filter_icons_hover', '');
}

add_action('wp_ajax_sanzo_save_product_filter_icons', 'sanzo_save_product_filter_icons');
function sanzo_save_product_filter_icons(){
	if( isset($_POST['icon_ids'], $_POST['icon_hover_ids']) ){
		$updated_icon = true;
		$updated_icon_hover = true;
		$icon_ids = sanzo_get_product_filter_icons();
		$icon_hover_ids = sanzo_get_product_filter_icons_hover();
		if( $icon_ids != $_POST['icon_ids'] ){
			$updated_icon = update_option('ts_product_filter_icons', $_POST['icon_ids']);
		}
		if( $icon_hover_ids != $_POST['icon_hover_ids'] ){
			$updated_icon_hover = update_option('ts_product_filter_icons_hover', $_POST['icon_hover_ids']);
		}
		if( $updated_icon && $updated_icon_hover ){
			die( esc_html__('Successfully updated the icons', 'sanzo') );
		}
		else{
			die( esc_html__('Update failed', 'sanzo') );
		}
	}
	die('');
}

function sanzo_get_product_filter_icons_html( $icon_ids ){
	ob_start();
	if( $icon_ids ){
		$icon_ids = explode(',', $icon_ids);
		foreach( $icon_ids as $icon_id ){
			echo '<div class="icon">';
			echo wp_get_attachment_image($icon_id, 'thumbnail', false, array('data-id' => $icon_id));
			echo '</div>';
		}
	}
	return ob_get_clean();
}

add_action('wp_ajax_sanzo_load_product_filter_icons', 'sanzo_load_product_filter_icons');
function sanzo_load_product_filter_icons(){
	$response = array();
	$icon_ids = sanzo_get_product_filter_icons();
	$icon_hover_ids = sanzo_get_product_filter_icons_hover();
	$response['icon_ids'] = $icon_ids;
	$response['icon_hover_ids'] = $icon_hover_ids;
	$response['icon_html'] = sanzo_get_product_filter_icons_html($icon_ids);
	$response['icon_hover_html'] = sanzo_get_product_filter_icons_html($icon_hover_ids);
	die( json_encode($response) );
}

if( !function_exists('sanzo_product_category_filter_content') ){
	function sanzo_product_category_filter_content(){
		$icons = sanzo_get_product_filter_icons();
		if( $icons ){
			$icons = explode(',', $icons);
		}
		else{
			$icons = array();
		}
		$icons_hover = sanzo_get_product_filter_icons_hover();
		if( $icons_hover ){
			$icons_hover = explode(',', $icons_hover);
		}
		else{
			$icons_hover = array();
		}
		global $wp_registered_sidebars, $sidebars_widgets;
		$index = 'product-category-filter';
		foreach ( (array) $wp_registered_sidebars as $key => $value ) {
			if ( sanitize_title( $value['name'] ) == $index ) {
				$index = $key;
				break;
			}
		}
		$number_widgets = isset($sidebars_widgets[$index])?count($sidebars_widgets[$index]):0;
		?>
		<div class="ts-product-filter-wrapper">
			<div class="icons">
				<?php 
				for( $i = 0; $i < $number_widgets; $i++ ){
					$img = '';
					$img_hover = '';
					if( isset($icons[$i]) ){
						$img = wp_get_attachment_image($icons[$i], 'thumbnail');
					}
					if( isset($icons_hover[$i]) ){
						$img_hover = wp_get_attachment_image($icons_hover[$i], 'thumbnail', false, array('class' => 'icon-hover'));
					}
					$class = $img?'has-icon':'default-icon';
					$class .= $img_hover?' has-hover-icon':' no-hover-icon';
					echo '<div class="icon '.$class.'" data-id="'.$sidebars_widgets[$index][$i].'">'.$img.$img_hover.'</div>';
				}
				?>
			</div>
			<div class="widgets" style="display: none">
				<?php dynamic_sidebar('product-category-filter'); ?>
			</div>
		</div>
	<?php
	}
}

/* Calculate Color */
if( !function_exists('sanzo_hex2rgb') ){
	function sanzo_hex2rgb($hex){
		if( substr( $hex, 0, 1 ) == "#" ){
			$hex = substr( $hex, 1 );
		}
		if( strlen($hex) == 6 ){
			$R = substr($hex, 0, 2);
			$G = substr($hex, 2, 2);
			$B = substr($hex, 4, 2);
		}
		else{
			$R = substr($hex, 0, 1);
			$G = substr($hex, 1, 1);
			$B = substr($hex, 2, 1);
		}

		$R = hexdec($R);
		$G = hexdec($G);
		$B = hexdec($B);

		$RGB['R'] = $R;
		$RGB['G'] = $G;
		$RGB['B'] = $B;

		return $RGB;
	}
}

if( !function_exists('sanzo_rgb2hex') ){
	function sanzo_rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb['R']), 2, dechex($rgb['R']), STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['G']), 2, dechex($rgb['G']), STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['B']), 2, dechex($rgb['B']), STR_PAD_LEFT);

	   return $hex;
	}
}

if( !function_exists('sanzo_calc_color') ){
	function sanzo_calc_color($first_color = '', $second_color = '', $add = true){
		if( strrpos($first_color, '#') !== false && strrpos($second_color, '#') !== false ){
			$rgb_first_color = sanzo_hex2rgb($first_color);
			$rgb_second_color = sanzo_hex2rgb($second_color);
			if( $add ){
				$rgb_first_color['R'] += $rgb_second_color['R'];
				$rgb_first_color['G'] += $rgb_second_color['G'];
				$rgb_first_color['B'] += $rgb_second_color['B'];
			}
			else{
				$rgb_first_color['R'] -= $rgb_second_color['R'];
				$rgb_first_color['G'] -= $rgb_second_color['G'];
				$rgb_first_color['B'] -= $rgb_second_color['B'];
			}
			return sanzo_rgb2hex($rgb_first_color);
		}
		else{
			return $first_color;
		}
	}
}

/* Install Required Plugins */
add_action( 'tgmpa_register', 'sanzo_register_required_plugins' );
function sanzo_register_required_plugins(){
	$plugin_dir_path = get_template_directory() . '/framework/plugins/';
	
    $plugins = array(

        array(
            'name'                => 'ThemeSky'
            ,'slug'               => 'themesky'
            ,'source'             => $plugin_dir_path . 'themesky.zip'
            ,'required'           => true
            ,'version'            => '1.1.3'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'Sanzo Importer'
            ,'slug'               => 'sanzo-importer'
            ,'source'             => $plugin_dir_path . 'sanzo-importer.zip'
            ,'required'           => false
            ,'version'            => '1.0.7'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'WooCommerce'
            ,'slug'               => 'woocommerce'
            ,'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.3.7.0.zip'
            ,'required'           => true
            ,'version'            => '3.7.0'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'WPBakery Page Builder'
            ,'slug'               => 'js_composer'
            ,'source'             => $plugin_dir_path . 'js_composer.zip'
            ,'required'           => true
            ,'version'            => '6.0.5'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'Slider Revolution'
            ,'slug'               => 'revslider'
            ,'source'             => $plugin_dir_path . 'revslider.zip'
            ,'required'           => false
            ,'version'            => '6.1.0'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'Contact Form 7'
            ,'slug'               => 'contact-form-7'
            ,'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.5.1.4.zip'
            ,'required'           => false
            ,'version'            => '5.1.4'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'YITH WooCommerce Wishlist'
            ,'slug'               => 'yith-woocommerce-wishlist'
            ,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.2.2.13.zip'
            ,'required'           => false
            ,'version'            => '2.2.13'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'YITH WooCommerce Compare'
            ,'slug'               => 'yith-woocommerce-compare'
            ,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-compare.2.3.13.zip'
            ,'required'           => false
            ,'version'            => '2.3.13'
            ,'external_url'       => ''
        )

    );

    $config = array(
		'id'           	=> 'tgmpa'
		,'default_path' => ''
		,'menu'         => 'tgmpa-install-plugins'
		,'parent_slug'  => 'themes.php'
		,'capability'   => 'edit_theme_options'
		,'has_notices'  => true
		,'dismissable'  => true
		,'dismiss_msg'  => ''
		,'is_automatic' => false
		,'message'      => ''
	);

    tgmpa( $plugins, $config );
}
?>
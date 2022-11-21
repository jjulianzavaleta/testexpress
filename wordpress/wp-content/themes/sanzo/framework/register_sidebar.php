<?php 
function sanzo_get_list_sidebars(){
	$default_sidebars = array(
						array(
							'name' => esc_html__( 'Home Sidebar', 'sanzo' ),
							'id' => 'home-sidebar',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Blog Sidebar', 'sanzo' ),
							'id' => 'blog-sidebar',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Blog Detail Sidebar', 'sanzo' ),
							'id' => 'blog-detail-sidebar',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Product Category Sidebar', 'sanzo' ),
							'id' => 'product-category-sidebar',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Product Category Filter', 'sanzo' ),
							'id' => 'product-category-filter',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Product Detail Sidebar', 'sanzo' ),
							'id' => 'product-detail-sidebar',
							'description' => '',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
					);
					
	$custom_sidebars = sanzo_get_custom_sidebars();
	if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
		foreach( $custom_sidebars as $name ){
			$default_sidebars[] = array(
								'name' => ''.$name.'',
								'id' => sanitize_title($name),
								'description' => '',
								'class'			=> 'ts-custom-sidebar',
								'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</section>',
								'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							);
		}
	}
	
	return $default_sidebars;
}

function sanzo_get_list_widget_areas(){
	$default_widgetareas = array(
					array(
							'name' => esc_html__( 'Footer Widget Area', 'sanzo' ),
							'id' => 'footer-widget-area',
							'description' => esc_html__('Should only add one TS - Footer Block widget', 'sanzo'),
							'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
					)
					,array(
							'name' => esc_html__( 'Footer Copyright Widget Area', 'sanzo' ),
							'id' => 'footer-copyright-widget-area',
							'description' => esc_html__('Should only add one TS - Footer Block widget', 'sanzo'),
							'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
					)
				);
				
	return $default_widgetareas;
}

function sanzo_register_widget_areas(){
	$default_sidebars = sanzo_get_list_sidebars();
	$default_widgetareas = sanzo_get_list_widget_areas();
	$registered_sidebars = array_merge($default_sidebars, $default_widgetareas);
	foreach( $registered_sidebars as $sidebar ){
		register_sidebar($sidebar);
	}
}
add_action( 'widgets_init', 'sanzo_register_widget_areas' );
?>
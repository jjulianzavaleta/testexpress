<?php 
add_action( 'vc_before_init', 'sanzo_integrate_with_vc' );
function sanzo_integrate_with_vc() {
	
	if( !function_exists('vc_map') ){
		return;
	}

	/********************** Content Shortcodes ***************************/
	/*** TS Features ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Feature', 'sanzo' ),
		'base' 		=> 'ts_feature',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'sanzo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Horizontal', 'sanzo')	=>  'feature-horizontal'
						,esc_html__('Vertical', 'sanzo')	=>  'feature-vertical'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Use icon font', 'sanzo' )
				,'param_name' 	=> 'use_icon_font'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('No', 'sanzo')	=>  0
						,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'sanzo' )
				,'param_name' 	=> 'icon_fontawesome'
				,'admin_label' 	=> false
				,'value' 		=> 'fa fa-info-circle'
				,'settings' 	=> array(
					'emptyIcon' 	=> false /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add this icon before the block title', 'sanzo')
				,'dependency'	=> array( 'element' => 'use_icon_font', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Thumbnail', 'sanzo' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'use_icon_font', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Thumbnail URL', 'sanzo' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'sanzo')
				,'dependency'	=> array( 'element' => 'use_icon_font', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Thumbnail', 'sanzo' )
				,'param_name' 	=> 'style_thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Default', 'sanzo')	=>  'thumbnail-default'
						,esc_html__('Circle', 'sanzo')	=>  'thumbnail-circle'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Icon thumbnail transparent', 'sanzo' )
				,'param_name' 	=> 'icon_bg_transparent'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Yes', 'sanzo')	=>  1
						,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'use_icon_font', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Icon background color', 'sanzo' )
				,'param_name' 	=> 'icon_bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> esc_html__('Not support icon font', 'sanzo')
				,'dependency'	=> array( 'element' => 'icon_bg_transparent', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feature title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text title color', 'sanzo' )
				,'param_name' 	=> 'text_title_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text title color hover', 'sanzo' )
				,'param_name' 	=> 'text_title_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Short description', 'sanzo' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text description color', 'sanzo' )
				,'param_name' 	=> 'text_excerpt_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Background transparent', 'sanzo' )
				,'param_name' 	=> 'bg_transparent'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('No', 'sanzo')	=>  0
						,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'bg_transparent', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Border content', 'sanzo' )
				,'param_name' 	=> 'border_content'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('No', 'sanzo')	=>  0
						,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Border width', 'sanzo' )
				,'param_name' 	=> 'border_width'
				,'admin_label' 	=> false
				,'value' 		=> '1'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'border_content', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color', 'sanzo' )
				,'param_name' 	=> 'border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'border_content', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'sanzo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Ex: http://theme-sky.com', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'sanzo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'sanzo')	=>  '_blank'
						,esc_html__('Self', 'sanzo')			=>  '_self'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'sanzo' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Price Table ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Price Table', 'sanzo' ),
		'base' 		=> 'ts_price_table',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title Table', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Price', 'sanzo' )
				,'param_name' 	=> 'price'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Currency', 'sanzo' )
				,'param_name' 	=> 'currency'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'During Price', 'sanzo' )
				,'param_name' 	=> 'during_price'
				,'admin_label' 	=> true
				,'value' 		=> '/month'
				,'description' 	=> esc_html__('Ex: /day, /month, /year', 'sanzo')
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Description', 'sanzo' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Accept the ul, li, b, strong and i tags', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button text', 'sanzo' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'sanzo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> false
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Active Table', 'sanzo' )
				,'param_name' 	=> 'active_table'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Blogs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Blogs', 'sanzo' ),
		'base' 		=> 'ts_blogs',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'sanzo' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Grid', 'sanzo')		=> 'grid'
							,esc_html__('Slider', 'sanzo')	=> 'slider'
							,esc_html__('Masonry', 'sanzo')	=> 'masonry'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'1'				=> '1'
							,'2'			=> '2'
							,'3'			=> '3'
							,'4'			=> '4'
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Posts', 'sanzo' )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'sanzo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'sanzo' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'sanzo')		=> 'none'
						,esc_html__('ID', 'sanzo')		=> 'ID'
						,esc_html__('Date', 'sanzo')	=> 'date'
						,esc_html__('Name', 'sanzo')	=> 'name'
						,esc_html__('Title', 'sanzo')	=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'sanzo' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'sanzo')	=> 'DESC'
						,esc_html__('Ascending', 'sanzo')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show thumbnail', 'sanzo' )
				,'param_name' 	=> 'show_thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'sanzo' )
				,'param_name' 	=> 'show_author'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'sanzo' )
				,'param_name' 	=> 'show_comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'sanzo' )
				,'param_name' 	=> 'show_date'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'sanzo' )
				,'param_name' 	=> 'show_excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'sanzo' )
				,'param_name' 	=> 'show_readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'sanzo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> 16
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'sanzo' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'sanzo' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '30'
				,'description' 	=> esc_html__('Set margin between items', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
		)
	) );
	
	/*** TS Blogs Split ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Blogs Split', 'sanzo' ),
		'base' 		=> 'ts_blogs_split',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'sanzo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'sanzo' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'sanzo')		=> 'none'
						,esc_html__('ID', 'sanzo')		=> 'ID'
						,esc_html__('Date', 'sanzo')	=> 'date'
						,esc_html__('Name', 'sanzo')	=> 'name'
						,esc_html__('Title', 'sanzo')	=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'sanzo' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'sanzo')	=> 'DESC'
						,esc_html__('Ascending', 'sanzo')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'sanzo' )
				,'param_name' 	=> 'show_author'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'sanzo' )
				,'param_name' 	=> 'show_comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'sanzo' )
				,'param_name' 	=> 'show_date'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'sanzo' )
				,'param_name' 	=> 'show_excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'sanzo' )
				,'param_name' 	=> 'show_readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'sanzo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> 16
				,'description' 	=> ''
			)
		)
	) );

	/*** TS Button ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Button', 'sanzo' ),
		'base' 		=> 'ts_button',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'sanzo' )
				,'param_name' 	=> 'content'
				,'admin_label' 	=> true
				,'value' 		=> 'Button text'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'sanzo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'sanzo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Self', 'sanzo')				=> '_self'
						,esc_html__('New Window Tab', 'sanzo')	=> '_blank'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color', 'sanzo' )
				,'param_name' 	=> 'text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color hover', 'sanzo' )
				,'param_name' 	=> 'text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color hover', 'sanzo' )
				,'param_name' 	=> 'bg_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#3f3f3f'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color', 'sanzo' )
				,'param_name' 	=> 'border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#e8e8e8'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color hover', 'sanzo' )
				,'param_name' 	=> 'border_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Border width', 'sanzo' )
				,'param_name' 	=> 'border_width'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('In pixels. Ex: 1', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Size', 'sanzo' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Small', 'sanzo')	=> 'small'
						,esc_html__('Medium', 'sanzo')	=> 'medium'
						,esc_html__('Large', 'sanzo')	=> 'large'
						,esc_html__('X-Large', 'sanzo')	=> 'x-large'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Font icon', 'sanzo' )
				,'param_name' 	=> 'font_icon'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'settings' 	=> array(
					'emptyIcon' 	=> true /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add an icon before the text. Ex: fa-lock', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show popup', 'sanzo' )
				,'param_name' 	=> 'popup'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Popup Options', 'sanzo')
			)
			,array(
				'type' 			=> 'textarea_raw_html'
				,'heading' 		=> esc_html__( 'Popup content', 'sanzo' )
				,'param_name' 	=> 'popup_content'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group'		=> esc_html__('Popup Options', 'sanzo')
			)
		)
	) );
	
	/*** TS Single Image ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Single Image', 'sanzo' ),
		'base' 		=> 'ts_single_image',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'sanzo' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Size', 'sanzo' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'sanzo' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'sanzo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'sanzo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'sanzo')	=>  '_blank'
						,esc_html__('Self', 'sanzo')			=>  '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'sanzo' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hover Effect', 'sanzo' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Widespread Left Right', 'sanzo')		=> 'eff-widespread-corner-left-right'
						,esc_html__('Border Scale', 'sanzo')				=> 'eff-border-scale'
						,esc_html__('Background Fade Icon', 'sanzo')		=> 'eff-background-fade-icon'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Heading ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Heading', 'sanzo' ),
		'base' 		=> 'ts_heading',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading style', 'sanzo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Style 1', 'sanzo')			=> 'style-1'
						,esc_html__('Style 2', 'sanzo')			=> 'style-2'
						,esc_html__('Style 3', 'sanzo')			=> 'style-3'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading Size', 'sanzo' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'				=> '1'
						,'2'			=> '2'
						,'3'			=> '3'
						,'4'			=> '4'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'sanzo' )
				,'param_name' 	=> 'text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Banner ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Banner', 'sanzo' ),
		'base' 		=> 'ts_banner',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'sanzo' )
				,'param_name' 	=> 'bg_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Background Url', 'sanzo' )
				,'param_name' 	=> 'bg_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'sanzo')
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background Color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading 2 Colors', 'sanzo' )
				,'param_name' 	=> 'title_many_colors'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text', 'sanzo' )
				,'param_name' 	=> 'heading_title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text 2', 'sanzo' )
				,'param_name' 	=> 'heading_title_2'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'title_many_colors', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Heading Text Color', 'sanzo' )
				,'param_name' 	=> 'title_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Heading 2 Text Color', 'sanzo' )
				,'param_name' 	=> 'title_text_2_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'dependency'	=> array( 'element' => 'title_many_colors', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Description', 'sanzo' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Description Text Color', 'sanzo' )
				,'param_name' 	=> 'description_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Description Position', 'sanzo' )
				,'param_name' 	=> 'position_description'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Under Title', 'sanzo')		=>  'bottom-title'
							,esc_html__('Over Title', 'sanzo')		=> 	'top-title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Font Size', 'sanzo' )
				,'param_name' 	=> 'font_size'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Normal', 'sanzo')		=>  'font-normal'
							,esc_html__('Big', 'sanzo')			=>  'font-big'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Align', 'sanzo' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'sanzo')			=> 	'text-left'
							,esc_html__('Center', 'sanzo')		=>  'text-center'
							,esc_html__('Right', 'sanzo')		=> 	'text-right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Discount', 'sanzo' )
				,'param_name' 	=> 'show_discount'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Discount', 'sanzo' )
				,'param_name' 	=> 'discount'
				,'admin_label' 	=> false
				,'value' 		=> 'Discount 10%'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_discount', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Price', 'sanzo' )
				,'param_name' 	=> 'price'
				,'admin_label' 	=> false
				,'value' 		=> '$100'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_price', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Button', 'sanzo' )
				,'param_name' 	=> 'show_button'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Button Border', 'sanzo' )
				,'param_name' 	=> 'button_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__( 'Show border instead of background. Its color is also the background color', 'sanzo' )
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button Text', 'sanzo' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop now'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Discount Color', 'sanzo' )
				,'param_name' 	=> 'discount_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_discount', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Price Color', 'sanzo' )
				,'param_name' 	=> 'price_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_price', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color', 'sanzo' )
				,'param_name' 	=> 'button_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color', 'sanzo' )
				,'param_name' 	=> 'button_background_color'
				,'admin_label' 	=> false
				,'value' 		=> '#3f3f3f'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color Hover', 'sanzo' )
				,'param_name' 	=> 'button_text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color Hover', 'sanzo' )
				,'param_name' 	=> 'button_background_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner Content Position', 'sanzo' )
				,'param_name' 	=> 'position_content'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Left Top', 'sanzo')			=>  'left-top'
						,esc_html__('Left Bottom', 'sanzo')		=>  'left-bottom'
						,esc_html__('Left Center', 'sanzo')		=>  'left-center'
						,esc_html__('Right Top', 'sanzo')		=>  'right-top'
						,esc_html__('Right Bottom', 'sanzo')	=>  'right-bottom'
						,esc_html__('Right Center', 'sanzo')	=>  'right-center'
						,esc_html__('Center Top', 'sanzo')		=>  'center-top'
						,esc_html__('Center Bottom', 'sanzo')	=>  'center-bottom'
						,esc_html__('Center Center', 'sanzo')	=>  'center-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'sanzo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'sanzo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('New Window Tab', 'sanzo')	=>  '_blank'
							,esc_html__('Self', 'sanzo')			=>  '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'sanzo' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Effect', 'sanzo' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Background Scale', 'sanzo')						=>  'background-scale'
						,esc_html__('Background Scale Opacity', 'sanzo')			=>  'background-scale-opacity'
						,esc_html__('Background Scale Dark', 'sanzo')				=>	'background-scale-dark'
						,esc_html__('Background Scale and Line', 'sanzo')			=>  'background-scale-and-line'
						,esc_html__('Background Scale Opacity and Line', 'sanzo')	=>  'background-scale-opacity-line'
						,esc_html__('Background Scale Dark and Line', 'sanzo')		=>  'background-scale-dark-line'
						,esc_html__('Background Opacity and Line', 'sanzo')			=>	'background-opacity-and-line'
						,esc_html__('Background Dark and Line', 'sanzo')			=>	'background-dark-and-line'
						,esc_html__('Background Opacity', 'sanzo')					=>	'background-opacity'
						,esc_html__('Background Dark', 'sanzo')						=>	'background-dark'
						,esc_html__('Line', 'sanzo')								=>	'eff-line'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Responsive size', 'sanzo' )
				,'param_name' 	=> 'responsive_size'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra Class', 'sanzo' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Team Members ***/
	$team_options = array();
	if( class_exists('TS_Team_Members') || post_type_exists('ts_team') ){
		$args = array(
				'post_type'				=> 'ts_team'
				,'post_status'			=> 'publish'
				,'ignore_sticky_posts'	=> true
				,'posts_per_page'		=> -1
				);
		$teams = new WP_Query($args);
		if( $teams->have_posts() ){
			global $post;
			while( $teams->have_posts() ){
				$teams->the_post();
				$team_options[$post->post_title] = $post->ID;
			}
		}
		wp_reset_postdata();
	}
	
	vc_map( array(
		'name' 		=> esc_html__( 'TS Team Member', 'sanzo' ),
		'base' 		=> 'ts_team_member',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Member name', 'sanzo' )
				,'param_name' 	=> 'id'
				,'admin_label' 	=> true
				,'value' 		=> $team_options
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'sanzo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '30'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'sanzo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'sanzo')	=>  '_blank'
						,esc_html__('Self', 'sanzo')			=>  '_self'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/* TS Testimonial */
	vc_map( array(
		'name' 		=> esc_html__( 'TS Testimonial', 'sanzo' ),
		'base' 		=> 'ts_testimonial',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'sanzo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_testimonial'
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Testimonial IDs', 'sanzo' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of testimonial ids', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Avatar', 'sanzo' )
				,'param_name' 	=> 'show_avatar'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '4'
				,'description' 	=> esc_html__('Number of Posts', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'sanzo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '50'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Has padding', 'sanzo' )
				,'param_name' 	=> 'has_padding'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> true
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'sanzo' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> 'text-default'
							,esc_html__('Light', 'sanzo')	=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'sanzo' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation dots', 'sanzo' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
		)
	) );
	
	/* TS Portfolio */
	vc_map( array(
		'name' 		=> esc_html__( 'TS Portfolio', 'sanzo' ),
		'base' 		=> 'ts_portfolio',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'2'		=> '2'
							,'3'	=> '3'
							,'4'	=> '4'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '8'
				,'description' 	=> esc_html__('Number of Posts', 'sanzo')
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'sanzo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_portfolio'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'sanzo' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'sanzo')		=> 'none'
							,esc_html__('ID', 'sanzo')		=> 'ID'
							,esc_html__('Date', 'sanzo')	=> 'date'
							,esc_html__('Name', 'sanzo')	=> 'name'
							,esc_html__('Title', 'sanzo')	=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'sanzo' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Descending', 'sanzo')	=> 'DESC'
							,esc_html__('Ascending', 'sanzo')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show portfolio title', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show link icon', 'sanzo' )
				,'param_name' 	=> 'show_link_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show like icon', 'sanzo' )
				,'param_name' 	=> 'show_like_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show filter bar', 'sanzo' )
				,'param_name' 	=> 'show_filter_bar'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'sanzo' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'sanzo' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'sanzo' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__('If slider is enabled, the filter bar and load more button will be removed', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 30
				,'description' 	=> esc_html__('Set margin between items. It is only used for slider', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
		)
	) );
	
	
	/*** TS Logos Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Logos Slider', 'sanzo' ),
		'base' 		=> 'ts_logos_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Content Border', 'sanzo' )
				,'param_name' 	=> 'content_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '7'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Rows', 'sanzo' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> 1
				,'description' 	=> esc_html__( 'Number of Rows', 'sanzo' )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'sanzo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_logo'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin_image'
				,'admin_label' 	=> false
				,'value' 		=> '30'
				,'description' 	=> esc_html__('Set margin between items', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Activate link', 'sanzo' )
				,'param_name' 	=> 'active_link'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button style', 'sanzo' )
				,'param_name' 	=> 'style_logo'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')		=> 'style-default'
							,esc_html__('Light', 'sanzo')		=> 'style-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'sanzo' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	
	/*** TS Google Map ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Google Map', 'sanzo' ),
		'base' 		=> 'ts_google_map',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Address', 'sanzo' )
				,'param_name' 	=> 'address'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('You have to input your API Key in Appearance > Theme Options > General tab', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Height', 'sanzo' )
				,'param_name' 	=> 'height'
				,'admin_label' 	=> true
				,'value' 		=> 360
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Zoom', 'sanzo' )
				,'param_name' 	=> 'zoom'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> esc_html__('Input a number between 0 and 22', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Map Type', 'sanzo' )
				,'param_name' 	=> 'map_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('ROADMAP', 'sanzo')		=> 'ROADMAP'
								,esc_html__('SATELLITE', 'sanzo')	=> 'SATELLITE'
								,esc_html__('HYBRID', 'sanzo')		=> 'HYBRID'
								,esc_html__('TERRAIN', 'sanzo')		=> 'TERRAIN'
							)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Twitter Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Twitter Slider', 'sanzo' ),
		'base' 		=> 'ts_twitter_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'sanzo' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit tweets', 'sanzo' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Exclude Replies', 'sanzo' )
				,'param_name' 	=> 'exclude_replies'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('No', 'sanzo')		=> 'false'
								,esc_html__('Yes', 'sanzo')		=> 'true'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Has padding', 'sanzo' )
				,'param_name' 	=> 'has_padding'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> true
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'sanzo' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> 'text-default'
							,esc_html__('Light', 'sanzo')	=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation dots', 'sanzo' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'sanzo' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer key', 'sanzo' )
				,'param_name' 	=> 'consumer_key'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer secret', 'sanzo' )
				,'param_name' 	=> 'consumer_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token', 'sanzo' )
				,'param_name' 	=> 'access_token'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token secret', 'sanzo' )
				,'param_name' 	=> 'access_token_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'sanzo')
			)
		)
	) );
	
	/*** TS Milestone ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Milestone', 'sanzo' ),
		'base' 		=> 'ts_milestone',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number', 'sanzo' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '0'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Subject', 'sanzo' )
				,'param_name' 	=> 'subject'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'sanzo' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> 'text-default'
							,esc_html__('Light', 'sanzo')	=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Countdown ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Countdown', 'sanzo' ),
		'base' 		=> 'ts_countdown',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Day', 'sanzo' )
				,'param_name' 	=> 'day'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Month', 'sanzo' )
				,'param_name' 	=> 'month'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Year', 'sanzo' )
				,'param_name' 	=> 'year'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Label background color', 'sanzo' )
				,'param_name' 	=> 'label_bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Label text color', 'sanzo' )
				,'param_name' 	=> 'label_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Feedburner Subscription ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Feedburner Subscription', 'sanzo' ),
		'base' 		=> 'ts_feedburner_subscription',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feedburner ID', 'sanzo' )
				,'param_name' 	=> 'feedburner_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'Newsletter'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Intro Text', 'sanzo' )
				,'param_name' 	=> 'intro_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button Text', 'sanzo' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> true
				,'value' 		=> 'Subscribe'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Placeholder Text', 'sanzo' )
				,'param_name' 	=> 'placeholder_text'
				,'admin_label' 	=> true
				,'value' 		=> 'Enter your email address'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'sanzo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Style fullwidth', 'sanzo')	=> 'style-fullwidth'
							,esc_html__('Style normal', 'sanzo')	=> 'style-normal'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Image Gallery ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Image Gallery', 'sanzo' ),
		'base' 		=> 'ts_image_gallery',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Images', 'sanzo' )
				,'param_name' 	=> 'images'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'sanzo' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Slider', 'sanzo')	=> 'slider'
							,esc_html__('Grid', 'sanzo')	=> 'grid'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> array(
							1 	=> 1
							,2 	=> 2
							,3 	=> 3
							,4 	=> 4
							,6 	=> 6
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'sanzo' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'On click', 'sanzo' )
				,'param_name' 	=> 'on_click'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'sanzo')					=> 'none'
							,esc_html__('Open prettyPhoto', 'sanzo')	=> 'prettyphoto'
							,esc_html__('Open custom links', 'sanzo')	=> 'custom_link'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Custom links', 'sanzo' )
				,'param_name' 	=> 'custom_links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 images, the value of this field should be "link1, link2, link3"', 'sanzo')
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Custom link target', 'sanzo' )
				,'param_name' 	=> 'custom_link_target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Self', 'sanzo')				=> '_self'
							,esc_html__('New Window Tab', 'sanzo')	=> '_blank'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 30
				,'description' 	=> esc_html__('Set margin between items. It is only used for slider', 'sanzo')
			)
		)
	) );

	/********************** TS Product Shortcodes ************************/

	/*** TS Products ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products', 'sanzo' ),
		'base' 		=> 'ts_products',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'sanzo' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Recent', 'sanzo')			=> 'recent'
							,esc_html__('Sale', 'sanzo')			=> 'sale'
							,esc_html__('Featured', 'sanzo')		=> 'featured'
							,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
							,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
							,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Products', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show list categories', 'sanzo' )
				,'param_name' 	=> 'show_list_cats'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__( 'Display list of category links below the block title', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'sanzo' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 30
				,'description' 	=> esc_html__('Set margin between items. This value is used for slider. To remove margin on the grid layout, input 0', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item border', 'sanzo' )
				,'param_name' 	=> 'item_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item layout', 'sanzo' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'sanzo')		=> 'grid'
							,esc_html__('List', 'sanzo')	=> 'list'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Meta align', 'sanzo' )
				,'param_name' 	=> 'meta_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Center', 'sanzo')	=> 'meta-center'
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'item_layout', 'value' => array('grid') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show shop more button', 'sanzo' )
				,'param_name' 	=> 'show_shop_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'sanzo' )
				,'param_name' 	=> 'shop_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in short description', 'sanzo' )
				,'param_name' 	=> 'short_desc_words'
				,'admin_label' 	=> false
				,'value' 		=> 8
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Banners', 'sanzo' )
				,'param_name' 	=> 'banners'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Banner links', 'sanzo' )
				,'param_name' 	=> 'banner_links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 banners, the value of this field should be "link1, link2, link3"', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner position', 'sanzo' )
				,'param_name' 	=> 'banner_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'sanzo')		=> 'left'
							,esc_html__('Right', 'sanzo')	=> 'right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner layout', 'sanzo' )
				,'param_name' 	=> 'banner_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'sanzo')		=> 'grid'
							,esc_html__('Slider', 'sanzo')	=> 'slider'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'sanzo' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'sanzo' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'sanzo' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'sanzo' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'sanzo' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'sanzo' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'sanzo' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'sanzo' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'sanzo' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'1'		=> '1'
							,'2'	=> '2'
							,'3'	=> '3'
							,'4'	=> '4'
							)
				,'description' 	=> esc_html__( 'Number of Rows', 'sanzo' )
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button position', 'sanzo' )
				,'param_name' 	=> 'position_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'sanzo')		=> 'nav-top'
							,esc_html__('Bottom', 'sanzo')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Disable slider responsive', 'sanzo' )
				,'param_name' 	=> 'disable_slider_responsive'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__('You should only enable this option when Columns is 1 or 2', 'sanzo')
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
		)
	) );
	
	/*** TS Products Widget ***/
	vc_map( array(
		'name' 			=> esc_html__( 'TS Products Widget', 'sanzo' ),
		'base' 			=> 'ts_products_widget',
		'class' 		=> '',
		'description' 	=> '',
		'category' 		=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'sanzo' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Recent', 'sanzo')			=> 'recent'
							,esc_html__('Sale', 'sanzo')			=> 'sale'
							,esc_html__('Featured', 'sanzo')		=> 'featured'
							,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
							,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
							,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Products', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'sanzo' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'sanzo' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'sanzo' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'sanzo' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Row', 'sanzo' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> 3
				,'description' 	=> esc_html__( 'Number of Rows for slider', 'sanzo' )
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button position', 'sanzo' )
				,'param_name' 	=> 'position_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'sanzo')		=> 'nav-top'
							,esc_html__('Bottom', 'sanzo')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'sanzo')
			)
		)
	) );
	
	/*** TS Product Deals Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Deals Slider', 'sanzo' ),
		'base' 		=> 'ts_product_deals_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Products', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'sanzo' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'sanzo' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'sanzo')			=> 'recent'
						,esc_html__('Featured', 'sanzo')		=> 'featured'
						,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
						,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
						,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item border', 'sanzo' )
				,'param_name' 	=> 'item_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Meta align', 'sanzo' )
				,'param_name' 	=> 'meta_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Center', 'sanzo')	=> 'meta-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Banners', 'sanzo' )
				,'param_name' 	=> 'banners'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Banner links', 'sanzo' )
				,'param_name' 	=> 'banner_links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 banners, the value of this field should be "link1, link2, link3"', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner position', 'sanzo' )
				,'param_name' 	=> 'banner_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'sanzo')		=> 'left'
							,esc_html__('Right', 'sanzo')	=> 'right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show counter', 'sanzo' )
				,'param_name' 	=> 'show_counter'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'sanzo' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'sanzo' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'sanzo' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'sanzo' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'sanzo' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'sanzo' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'sanzo' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button position', 'sanzo' )
				,'param_name' 	=> 'position_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'sanzo')		=> 'nav-top'
							,esc_html__('Bottom', 'sanzo')	=> 'nav-bottom'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 30
				,'description' 	=> esc_html__('Set margin between items', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Disable slider responsive', 'sanzo' )
				,'param_name' 	=> 'disable_slider_responsive'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__('You should only enable this option when Columns is 1 or 2', 'sanzo')
			)
		)
	) );
	
	/*** TS Single Products Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Single Products Slider', 'sanzo' ),
		'base' 		=> 'ts_single_products_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'sanzo' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Recent', 'sanzo')			=> 'recent'
							,esc_html__('Sale', 'sanzo')			=> 'sale'
							,esc_html__('Featured', 'sanzo')		=> 'featured'
							,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
							,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
							,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Products', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'sanzo' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show shop more button', 'sanzo' )
				,'param_name' 	=> 'show_shop_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'sanzo' )
				,'param_name' 	=> 'shop_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail position', 'sanzo' )
				,'param_name' 	=> 'thumbnail_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'sanzo')		=> 'left'
							,esc_html__('Right', 'sanzo')	=> 'right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'sanzo' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'sanzo' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'sanzo' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'sanzo' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'sanzo' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'sanzo' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'sanzo' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Product Categories Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Categories', 'sanzo' ),
		'base' 		=> 'ts_product_categories_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'sanzo' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Small', 'sanzo')	=> 'title-small'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'sanzo' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Slider', 'sanzo')	=> 'slider'
							,esc_html__('Grid', 'sanzo')	=> 'grid'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'sanzo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Style 1', 'sanzo')	=> 'style-1'
							,esc_html__('Style 2', 'sanzo')	=> 'style-2'
							,esc_html__('Style 3', 'sanzo')	=> 'style-3'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns. Only accept 2,3,4,5 if Layout is Grid', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Product Categories', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent', 'sanzo' )
				,'param_name' 	=> 'parent'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get direct children of this category', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Child Of', 'sanzo' )
				,'param_name' 	=> 'child_of'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get all descendents of this category', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Include these categories', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'sanzo' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'sanzo')					=> 'none'
						,esc_html__('ID', 'sanzo')					=> 'term_id'
						,esc_html__('Name', 'sanzo')				=> 'name'
						,esc_html__('Number of products', 'sanzo')	=> 'count'
						,esc_html__('Included categories', 'sanzo')	=> 'include'
					)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'sanzo' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'sanzo')	=> 'DESC'
						,esc_html__('Ascending', 'sanzo')	=> 'ASC'
					)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hide empty product categories', 'sanzo' )
				,'param_name' 	=> 'hide_empty'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product category title', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product count', 'sanzo' )
				,'param_name' 	=> 'show_count'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('slider') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation dots', 'sanzo' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'sanzo')
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('slider') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('slider') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'sanzo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('Set margin between items', 'sanzo')
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('slider') )
			)
		)
	) );
	
	/*** TS Products In Category Tabs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products In Category Tabs', 'sanzo' ),
		'base' 		=> 'ts_products_in_category_tabs',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Color', 'sanzo' )
				,'param_name' 	=> 'color'
				,'admin_label' 	=> true
				,'value' 		=> '#f5a72c'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'sanzo' )
				,'param_name' 	=> 'icon_fontawesome'
				,'admin_label' 	=> true
				,'value' 		=> 'fa fa-info-circle'
				,'settings' 	=> array(
					'emptyIcon' 	=> false /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add this icon before the block title', 'sanzo')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Custom Icon', 'sanzo' )
				,'param_name' 	=> 'icon_image'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Logos', 'sanzo' )
				,'param_name' 	=> 'logos'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display these logos on the left side', 'sanzo')
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Links for logos', 'sanzo' )
				,'param_name' 	=> 'links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 logos, the value of this field should be "link1, link2, link3"', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'sanzo' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Recent', 'sanzo')			=> 'recent'
							,esc_html__('Sale', 'sanzo')			=> 'sale'
							,esc_html__('Featured', 'sanzo')		=> 'featured'
							,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
							,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
							,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'sanzo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'sanzo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'sanzo' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 8
				,'description' 	=> esc_html__( 'Number of Products', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'sanzo' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent Category', 'sanzo' )
				,'param_name' 	=> 'parent_cat'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Each tab will be a sub category of this category. This option is available when the Product Categories option is empty', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include children', 'sanzo' )
				,'param_name' 	=> 'include_children'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'sanzo' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show general tab', 'sanzo' )
				,'param_name' 	=> 'show_general_tab'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> esc_html__('Get products from all categories or sub categories', 'sanzo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'General tab heading', 'sanzo' )
				,'param_name' 	=> 'general_tab_heading'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type of general tab', 'sanzo' )
				,'param_name' 	=> 'product_type_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Recent', 'sanzo')			=> 'recent'
							,esc_html__('Sale', 'sanzo')			=> 'sale'
							,esc_html__('Featured', 'sanzo')		=> 'featured'
							,esc_html__('Best Selling', 'sanzo')	=> 'best_selling'
							,esc_html__('Top Rated', 'sanzo')		=> 'top_rated'
							,esc_html__('Mixed Order', 'sanzo')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'sanzo' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'sanzo' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'sanzo' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'sanzo' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'sanzo' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'sanzo' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'sanzo' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'sanzo' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'sanzo' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'sanzo' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Meta align', 'sanzo' )
				,'param_name' 	=> 'meta_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'sanzo')	=> ''
							,esc_html__('Center', 'sanzo')	=> 'meta-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show shop more button', 'sanzo' )
				,'param_name' 	=> 'show_shop_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'sanzo' )
				,'param_name' 	=> 'shop_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'sanzo' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'sanzo' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
						1		=> 1
						,2		=> 2
						,3		=> 3
						)
				,'description' 	=> esc_html__( 'Number of Rows in slider', 'sanzo' )
				,'dependency'	=> array( 'element' => 'is_slider', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'sanzo' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'is_slider', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'sanzo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'is_slider', 'value' => array('1') )
			)
		)
	) );
	
	/*** TS List Of Product Categories ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS List Of Product Categories', 'sanzo' ),
		'base' 		=> 'ts_list_of_product_categories',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'sanzo'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'sanzo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background image', 'sanzo' )
				,'param_name' 	=> 'bg_image'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Border', 'sanzo' )
				,'param_name' 	=> 'item_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'sanzo')	=>  0
							,esc_html__('Yes', 'sanzo')	=>  1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'sanzo' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f5f5f5'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Category', 'sanzo' )
				,'param_name' 	=> 'product_cat'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Display sub categories of this category', 'sanzo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include parent category in list', 'sanzo' )
				,'param_name' 	=> 'include_parent'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'sanzo')	=>  1
							,esc_html__('No', 'sanzo')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of Sub Categories', 'sanzo' )
				,'param_name' 	=> 'limit_sub_cat'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Leave blank to show all', 'sanzo' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Include these categories', 'sanzo' )
				,'param_name' 	=> 'include_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('If you set the Product Category option above, this option wont be available', 'sanzo')
			)
		)
	) );
	
}

/*** Add Shortcode Param ***/
WpbakeryShortcodeParams::addField('ts_category', 'sanzo_product_catgories_shortcode_param');
if( !function_exists('sanzo_product_catgories_shortcode_param') ){
	function sanzo_product_catgories_shortcode_param($settings, $value){
		$categories = sanzo_get_list_categories_shortcode_param(0, $settings);
		$arr_value = explode(',', $value);
		ob_start();
		?>
		<input type="hidden" class="wpb_vc_param_value wpb-textinput product_cats textfield ts-hidden-selected-categories" name="<?php echo esc_attr($settings['param_name']); ?>" value="<?php echo esc_attr($value); ?>" />
		<div class="categorydiv">
			<div class="tabs-panel">
				<ul class="categorychecklist">
					<?php foreach($categories as $cat){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($cat->name); ?>
						</label>
						<?php sanzo_get_list_sub_categories_shortcode_param($cat->term_id, $arr_value, $settings); ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			jQuery('.ts-select-category').bind('change', function(){
				"use strict";
				
				var selected = jQuery('.ts-select-category:checked');
				jQuery('.ts-hidden-selected-categories').val('');
				var selected_id = new Array();
				selected.each(function(index, ele){
					selected_id.push(jQuery(ele).val());
				});
				selected_id = selected_id.join(',');
				jQuery('.ts-hidden-selected-categories').val(selected_id);
			});
		</script>
		<?php
		return ob_get_clean();
	}
}

if( !function_exists('sanzo_get_list_categories_shortcode_param') ){
	function sanzo_get_list_categories_shortcode_param( $cat_parent_id, $settings ){
		$taxonomy = 'product_cat';
		if( isset($settings['class']) ){
			if( $settings['class'] == 'post_cat' ){
				$taxonomy = 'category';
			}
			if( $settings['class'] == 'ts_testimonial' ){
				$taxonomy = 'ts_testimonial_cat';
			}
			if( $settings['class'] == 'ts_portfolio' ){
				$taxonomy = 'ts_portfolio_cat';
			}
			if( $settings['class'] == 'ts_logo' ){
				$taxonomy = 'ts_logo_cat';
			}
		}
		
		$args = array(
				'taxonomy' 			=> $taxonomy
				,'hierarchical'		=> 1
				,'hide_empty'		=> 0
				,'parent'			=> $cat_parent_id
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
		$cats = get_categories($args);
		return $cats;
	}
}

if( !function_exists('sanzo_get_list_sub_categories_shortcode_param') ){
	function sanzo_get_list_sub_categories_shortcode_param( $cat_parent_id, $arr_value, $settings ){
		$sub_categories = sanzo_get_list_categories_shortcode_param($cat_parent_id, $settings); 
		if( count($sub_categories) > 0){
		?>
			<ul class="children">
				<?php foreach( $sub_categories as $sub_cat ){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($sub_cat->name); ?>
						</label>
						<?php sanzo_get_list_sub_categories_shortcode_param($sub_cat->term_id, $arr_value, $settings); ?>
					</li>
				<?php } ?>
			</ul>
		<?php }
	}
}

if( class_exists('Vc_Vendor_Woocommerce') ){
	$vc_woo_vendor = new Vc_Vendor_Woocommerce();

	/* autocomplete callback */
	add_filter( 'vc_autocomplete_ts_products_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_products_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	add_filter( 'vc_autocomplete_ts_product_deals_slider_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_product_deals_slider_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	add_filter( 'vc_autocomplete_ts_single_products_slider_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_single_products_slider_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	$shortcode_field_cats = array();
	$shortcode_field_cats[] = array('ts_products', 'product_cats');
	$shortcode_field_cats[] = array('ts_single_products_slider', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_widget', 'product_cats');
	$shortcode_field_cats[] = array('ts_product_deals_slider', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'parent_cat');
	$shortcode_field_cats[] = array('ts_list_of_product_categories', 'product_cat');
	$shortcode_field_cats[] = array('ts_list_of_product_categories', 'include_cats');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'parent');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'child_of');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'ids');
		
	foreach( $shortcode_field_cats as $shortcode_field ){
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_callback', array($vc_woo_vendor, 'productCategoryCategoryAutocompleteSuggester') );
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_render', array($vc_woo_vendor, 'productCategoryCategoryRenderByIdExact') );
	}
}
?>
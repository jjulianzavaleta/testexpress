<?php 
$options = array();
$default_sidebars = sanzo_get_list_sidebars();
$sidebar_options = array(
				'0'	=> esc_html__('Default', 'sanzo')
				);
foreach( $default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

$options[] = array(
				'id'		=> 'prod_layout_heading'
				,'label'	=> esc_html__('Product Layout', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
			
$options[] = array(
				'id'		=> 'prod_layout'
				,'label'	=> esc_html__('Product Layout', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'0'			=> esc_html__('Default', 'sanzo')
									,'0-1-0'  	=> esc_html__('Fullwidth', 'sanzo')
									,'1-1-0' 	=> esc_html__('Left Sidebar', 'sanzo')
									,'0-1-1' 	=> esc_html__('Right Sidebar', 'sanzo')
									,'1-1-1' 	=> esc_html__('Left & Right Sidebar', 'sanzo')
								)
			);
			
$options[] = array(
				'id'		=> 'prod_left_sidebar'
				,'label'	=> esc_html__('Left Sidebar', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'prod_right_sidebar'
				,'label'	=> esc_html__('Right Sidebar', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);

$options[] = array(
				'id'		=> 'prod_custom_tab_heading'
				,'label'	=> esc_html__('Custom Tab', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
			
$options[] = array(
				'id'		=> 'prod_custom_tab'
				,'label'	=> esc_html__('Custom Tab', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'0'		=> esc_html__('Default', 'sanzo')
									,'1'	=> esc_html__('Override', 'sanzo')
								)
			);
			
$options[] = array(
				'id'		=> 'prod_custom_tab_title'
				,'label'	=> esc_html__('Custom Tab Title', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'prod_custom_tab_content'
				,'label'	=> esc_html__('Custom Tab Content', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'textarea'
			);
			
$options[] = array(
				'id'		=> 'prod_breadcrumb_heading'
				,'label'	=> esc_html__('Breadcrumbs', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);

$options[] = array(
				'id'		=> 'bg_breadcrumbs'
				,'label'	=> esc_html__('Breadcrumb Background Image', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);
			
$options[] = array(
				'id'		=> 'prod_video_heading'
				,'label'	=> esc_html__('Video', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);

$options[] = array(
				'id'		=> 'prod_video_url'
				,'label'	=> esc_html__('Video URL', 'sanzo')
				,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'sanzo')
				,'type'		=> 'text'
			);		
?>
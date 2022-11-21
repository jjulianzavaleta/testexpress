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
				'id'		=> 'post_layout_heading'
				,'label'	=> esc_html__('Post Layout', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
			
$options[] = array(
				'id'		=> 'post_layout'
				,'label'	=> esc_html__('Post Layout', 'sanzo')
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
				'id'		=> 'post_left_sidebar'
				,'label'	=> esc_html__('Left Sidebar', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'post_right_sidebar'
				,'label'	=> esc_html__('Right Sidebar', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'bg_breadcrumbs'
				,'label'	=> esc_html__('Breadcrumb Background Image', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);
			
$options[] = array(
				'id'		=> 'post_audio_heading'
				,'label'	=> esc_html__('Post Audio', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);	
			
$options[] = array(
				'id'		=> 'audio_url'
				,'label'	=> esc_html__('Audio URL', 'sanzo')
				,'desc'		=> esc_html__('Enter MP3, OGG, WAV file URL or SoundCloud URL', 'sanzo')
				,'type'		=> 'text'
			);

$options[] = array(
				'id'		=> 'post_video_heading'
				,'label'	=> esc_html__('Post Video', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);			
			
$options[] = array(
				'id'		=> 'video_url'
				,'label'	=> esc_html__('Video URL', 'sanzo')
				,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'sanzo')
				,'type'		=> 'text'
			);			
?>
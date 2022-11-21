<?php 
$options = array();
		
$options[] = array(
				'id'		=> 'portfolio_url'
				,'label'	=> esc_html__('Portfolio URL', 'sanzo')
				,'desc'		=> esc_html__('Enter URL to the live version of the project', 'sanzo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'video_url'
				,'label'	=> esc_html__('Video URL', 'sanzo')
				,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL. Display this video instead of the featured image on the detail page', 'sanzo')
				,'type'		=> 'text'
			);

$options[] = array(
				'id'		=> 'bg_color'
				,'label'	=> esc_html__('Background Color', 'sanzo')
				,'desc'		=> esc_html__('Used for shortcode. It will display this background color on hover', 'sanzo')
				,'type'		=> 'colorpicker'
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field'
				,'label'	=> esc_html__('Custom Field', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'0'		=> esc_html__('Default', 'sanzo')
									,'1'	=> esc_html__('Override', 'sanzo')
								)
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field_title'
				,'label'	=> esc_html__('Custom Field Title', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field_content'
				,'label'	=> esc_html__('Custom Field Content', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'textarea'
			);
?>
<?php 
$options = array();

$options[] = array(
				'id'		=> 'gravatar_email'
				,'label'	=> esc_html__('Gravatar Email Address', 'sanzo')
				,'desc'		=> esc_html__('Enter in an e-mail address, to use a Gravatar, instead of using the "Featured Image". You have to remove the "Featured Image".', 'sanzo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'byline'
				,'label'	=> esc_html__('Byline', 'sanzo')
				,'desc'		=> esc_html__('Enter a byline for the customer giving this testimonial (for example: "CEO of Theme-Sky").', 'sanzo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'url'
				,'label'	=> esc_html__('URL', 'sanzo')
				,'desc'		=> esc_html__('Enter a URL that applies to this customer (for example: http://theme-sky.com/).', 'sanzo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'rating'
				,'label'	=> esc_html__('Rating', 'sanzo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
						'-1'	=> esc_html__('no rating', 'sanzo')
						,'0'	=> esc_html__('0 star', 'sanzo')
						,'0.5'	=> esc_html__('0.5 star', 'sanzo')
						,'1'	=> esc_html__('1 star', 'sanzo')
						,'1.5'	=> esc_html__('1.5 star', 'sanzo')
						,'2'	=> esc_html__('2 stars', 'sanzo')
						,'2.5'	=> esc_html__('2.5 stars', 'sanzo')
						,'3'	=> esc_html__('3 stars', 'sanzo')
						,'3.5'	=> esc_html__('3.5 stars', 'sanzo')
						,'4'	=> esc_html__('4 stars', 'sanzo')
						,'4.5'	=> esc_html__('4.5 stars', 'sanzo')
						,'5'	=> esc_html__('5 stars', 'sanzo')
				)
			);
?>
<?php
add_action('widgets_init', 'sanzo_social_icons_load_widgets');

function sanzo_social_icons_load_widgets()
{
	register_widget('Sanzo_Social_Icons_Widget');
}

if( !class_exists('Sanzo_Social_Icons_Widget') ){
	class Sanzo_Social_Icons_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-social-icons', 'description' => esc_html__('Display Your Social Icons','sanzo'));
			parent::__construct('ts_social_icons', esc_html__('TS - Social Icons','sanzo'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			
			$desc = $instance['desc'];
			
			$facebook_url 		= $instance['facebook_url'];
			$twitter_url 		= $instance['twitter_url'];
			$flickr_url 		= $instance['flickr_url'];
			$vimeo_url 			= $instance['vimeo_url'];
			$feedburner_url 	= $instance['feedburner_url'];
			$youtube_url 		= $instance['youtube_url'];
			$viber_number 		= $instance['viber_number'];
			$skype_username 	= $instance['skype_username'];
			$instagram_url 		= $instance['instagram_url'];
			$custom_link 		= $instance['custom_link'];
			$custom_text 		= $instance['custom_text'];
			$custom_font 		= $instance['custom_font'];
			$background_style 	= $instance['background_style'];
			$show_tooltip 		= $instance['show_tooltip'];
			
			echo $before_widget;
			
			if( empty($title) ){
				$before_title = '<h3 class="widget-title heading-title hidden">';
				$after_title = '</h3>';
				$title = esc_html__('Social Icons', 'sanzo');
			}
			echo $before_title . $title . $after_title;
			?>
			
			<div class="social-icons <?php echo ($show_tooltip)?'show-tooltip':'' ?> background-<?php echo esc_attr($background_style) ?>">
				<?php if( strlen(trim($desc)) > 0 ): ?>
				<div class="social-desc">
					<?php echo esc_html($desc); ?>
				</div>
				<?php endif; ?>
				<ul class="list-icons">
					<?php if( $facebook_url !== "" ): ?>
						<li class="facebook"><a href="<?php echo esc_url($facebook_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Become our fan', 'sanzo'):''; ?>" ><i class="fa fa-facebook"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Facebook', 'sanzo'); ?></span></a></li>				
					<?php endif; ?>
					<?php if( $twitter_url !== "" ): ?>
						<li class="twitter"><a href="<?php echo esc_url($twitter_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Follow us', 'sanzo'):''; ?>" ><i class="fa fa-twitter"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Twitter', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $flickr_url !== "" ): ?>
						<li class="flickr"><a href="<?php echo esc_url($flickr_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('See Us', 'sanzo'):''; ?>" ><i class="fa fa-flickr"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Flickr', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $vimeo_url !== "" ): ?>
						<li class="vimeo"><a href="<?php echo esc_url($vimeo_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Watch Us', 'sanzo'):''; ?>" ><i class="fa fa-vimeo-square"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Vimeo', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $feedburner_url !== "" ): ?>
						<li class="feedburner"><a href="<?php echo esc_url($feedburner_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Get updates', 'sanzo'):''; ?>" ><i class="fa fa-rss"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('RSS', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $youtube_url !== "" ): ?>
						<li class="youtube"><a href="<?php echo esc_url($youtube_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Watch Us', 'sanzo'):''; ?>" ><i class="fa fa-youtube-square"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Youtube', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $viber_number !== "" ): ?>
						<li class="viber"><a href="viber://<?php echo esc_attr($viber_number); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Call Us', 'sanzo'):''; ?>" ><i class="fa fa-phone"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Viber', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $skype_username !== "" ): ?>
						<li class="skype"><a href="skype:<?php echo esc_attr($skype_username); ?>?chat" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('Chat With Us', 'sanzo'):''; ?>" ><i class="fa fa-skype"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Skype', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $instagram_url !== "" ): ?>
						<li class="instagram"><a href="<?php echo esc_url($instagram_url); ?>" target="_blank" title="<?php echo (!$show_tooltip)?esc_html__('See Us', 'sanzo'):''; ?>" ><i class="fa fa-instagram"></i><span class="ts-tooltip social-tooltip"><?php esc_html_e('Instagram', 'sanzo'); ?></span></a></li>
					<?php endif; ?>
					<?php if( $custom_link !== "" ): ?>
						<li class="custom"><a href="<?php echo esc_url($custom_link); ?>" target="_blank" title="<?php echo (!$show_tooltip)?$custom_text:''; ?>" ><i class="fa <?php echo esc_attr($custom_font); ?>"></i><span class="ts-tooltip social-tooltip"><?php echo esc_html($custom_text); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</div>

			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 				= $new_instance['title'];
			$instance['desc'] 				=  $new_instance['desc'];
			$instance['facebook_url'] 		=  $new_instance['facebook_url'];
			$instance['twitter_url'] 		=  $new_instance['twitter_url'];			
			$instance['flickr_url'] 		=  $new_instance['flickr_url'];		
			$instance['vimeo_url'] 			=  $new_instance['vimeo_url'];		
			$instance['feedburner_url'] 	=  $new_instance['feedburner_url'];
			$instance['youtube_url'] 		=  $new_instance['youtube_url'];
			$instance['viber_number'] 		=  $new_instance['viber_number'];		
			$instance['skype_username'] 	=  $new_instance['skype_username'];		
			$instance['instagram_url'] 		=  $new_instance['instagram_url'];
			$instance['custom_link'] 		=  $new_instance['custom_link'];		
			$instance['custom_text'] 		=  $new_instance['custom_text'];		
			$instance['custom_font'] 		=  $new_instance['custom_font'];		
			$instance['background_style'] 	=  $new_instance['background_style'];		
			$instance['show_tooltip'] 		=  $new_instance['show_tooltip'];
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title'				=> ''
				,'desc'				=> ''
				,'facebook_url' 	=> ''
				,'twitter_url' 		=> ''
				,'flickr_url' 		=> ''
				,'vimeo_url'		=> '' 
				,'feedburner_url' 	=> ''
				,'youtube_url'		=> ''
				,'viber_number'		=> ''
				,'skype_username'	=> ''
				,'instagram_url'	=> ''
				,'custom_link' 		=> ''
				,'custom_text' 		=> ''
				,'custom_font' 		=> ''
				,'background_style' => 'default'
				,'show_tooltip'		=> 1
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'sanzo'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('desc'); ?>"><?php esc_html_e('Enter description about your social icons', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" value="<?php echo esc_attr($instance['desc']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php esc_html_e('Facebook URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" value="<?php echo esc_attr($instance['facebook_url']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php esc_html_e('Twitter URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" value="<?php echo esc_attr($instance['twitter_url']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('flickr_url'); ?>"><?php esc_html_e('Flickr URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('flickr_url'); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" value="<?php echo esc_attr($instance['flickr_url']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('vimeo_url'); ?>"><?php esc_html_e('Vimeo URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('vimeo_url'); ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" value="<?php echo esc_attr($instance['vimeo_url']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('feedburner_url'); ?>"><?php esc_html_e('FeedBurner URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('feedburner_url'); ?>" name="<?php echo $this->get_field_name('feedburner_url'); ?>" value="<?php echo esc_attr($instance['feedburner_url']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('youtube_url'); ?>"><?php esc_html_e('Youtube URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube_url'); ?>" name="<?php echo $this->get_field_name('youtube_url'); ?>" value="<?php echo esc_attr($instance['youtube_url']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('viber_number'); ?>"><?php esc_html_e('Viber Number', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('viber_number'); ?>" name="<?php echo $this->get_field_name('viber_number'); ?>" value="<?php echo esc_attr($instance['viber_number']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('skype_username'); ?>"><?php esc_html_e('Skype Username', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('skype_username'); ?>" name="<?php echo $this->get_field_name('skype_username'); ?>" value="<?php echo esc_attr($instance['skype_username']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('instagram_url'); ?>"><?php esc_html_e('Instagram URL', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('instagram_url'); ?>" name="<?php echo $this->get_field_name('instagram_url'); ?>" value="<?php echo esc_attr($instance['instagram_url']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('custom_link'); ?>"><?php esc_html_e('Custom Link', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('custom_link'); ?>" name="<?php echo $this->get_field_name('custom_link'); ?>" value="<?php echo esc_attr($instance['custom_link']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('custom_text'); ?>"><?php esc_html_e('Custom Text - Show on tooltip', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('custom_text'); ?>" name="<?php echo $this->get_field_name('custom_text'); ?>" value="<?php echo esc_attr($instance['custom_text']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('custom_font'); ?>"><?php esc_html_e('Custom Font - Use FontAwesome class', 'sanzo'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('custom_font'); ?>" name="<?php echo $this->get_field_name('custom_font'); ?>" value="<?php echo esc_attr($instance['custom_font']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('background_style'); ?>"><?php esc_html_e('Style', 'sanzo'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('background_style'); ?>" id="<?php echo $this->get_field_id('background_style'); ?>">
					<option value="default" <?php selected('default', $instance['background_style']) ?>><?php esc_html_e('Default', 'sanzo') ?></option>
					<option value="light" <?php selected('light', $instance['background_style']) ?>><?php esc_html_e('Light', 'sanzo') ?></option>
					<option value="big" <?php selected('big', $instance['background_style']) ?>><?php esc_html_e('Big', 'sanzo') ?></option>
				</select>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_tooltip'); ?>" name="<?php echo $this->get_field_name('show_tooltip'); ?>" value="1" <?php checked($instance['show_tooltip'], 1); ?> />
				<label for="<?php echo $this->get_field_id('show_tooltip'); ?>"><?php esc_html_e('Show Tooltip', 'sanzo'); ?></label>
			</p>
			<?php 
		}
	}
}
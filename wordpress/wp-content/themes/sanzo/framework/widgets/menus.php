<?php
add_action('widgets_init', 'sanzo_menus_load_widgets');

function sanzo_menus_load_widgets()
{
	register_widget('Sanzo_Menus_Widget');
}

if( !class_exists('Sanzo_Menus_Widget') ){
	class Sanzo_Menus_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-menus-widget', 'description' => esc_html__('Display a vertical menu, support Mega Menu', 'sanzo'));
			parent::__construct('ts_menus', esc_html__('TS - Menus', 'sanzo'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title 	= apply_filters('widget_title', $instance['title']);
			$menu 	= $instance['menu'];
			
			if( empty($menu) ){
				return;
			}
			
			if( empty($title) ){
				$menu_obj = wp_get_nav_menu_object($menu);
				if( isset( $menu_obj->name ) ){
					$title = $menu_obj->name;
				}
			}
			
			echo $before_widget;
			echo $before_title . $title . $after_title;
			
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu ts-mega-menu-wrapper', 'menu' => $menu, 'walker' => new Sanzo_Walker_Nav_Menu() ) );
			
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 		= strip_tags($new_instance['title']);			
			$instance['menu'] 		= $new_instance['menu'];			
			
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title' 		=> 'Shop By Category'
				,'menu' 		=> ''
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
			
			$menus = array('' => '');
			$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			if( is_array($nav_terms) ){
				foreach( $nav_terms as $term ){
					$menus[$term->term_id] = $term->name;
				}
			}
			
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'sanzo'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('menu'); ?>"><?php esc_html_e('Menu', 'sanzo'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('menu'); ?>" name="<?php echo $this->get_field_name('menu'); ?>">
					<?php foreach( $menus as $id => $name ): ?>
					<option value="<?php echo esc_attr($id) ?>" <?php selected($id, $instance['menu']) ?>><?php echo esc_html($name) ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			
			<?php 
		}
		
	}
}


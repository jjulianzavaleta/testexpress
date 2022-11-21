<?php 
function sanzo_before_save_of_data_filter( $data ){
	global $sanzo_theme_options;
	if( isset($sanzo_theme_options['ts_color_scheme'], $data['ts_color_scheme']) && $sanzo_theme_options['ts_color_scheme'] != $data['ts_color_scheme'] ){
		/* Load xml file */
		$color_name = $data['ts_color_scheme'];
		$xml_folder = get_template_directory() . '/admin/color_xml/';
		$file_path = $xml_folder . $color_name . '.xml';
		$obj_xml = simplexml_load_file( $file_path );
		if( $obj_xml !== false ){
			foreach($obj_xml->children() as $child ){
				if( isset($child->name, $child->value) ){
					$name = (string)$child->name;
					$value = (string)$child->value;
					if( isset($data[$name]) ){
						$data[$name] = $value;
					}
				}
			}
		}
	}
	
	return $data;
}
add_filter('sanzo_of_options_before_save', 'sanzo_before_save_of_data_filter', 10, 1);
?>
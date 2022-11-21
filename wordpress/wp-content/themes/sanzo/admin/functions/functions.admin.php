<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function sanzo_of_get_header_classes_array() 
{
	global $sanzo_of_options;
	
	foreach ($sanzo_of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}

/**
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function sanzo_of_get_options($key = null, $data = null) {
	global $sanzo_theme_options;

	do_action('sanzo_of_get_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();	
	}
	$data = apply_filters('sanzo_of_options_after_load', $data);
	if ($key == null) {
		$sanzo_theme_options = $data;
	} else {
		$sanzo_theme_options[$key] = $data;
	}
	
	do_action('sanzo_of_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;

}

/**
 * Save options to the database after processing them
 *
 * @param $data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */

function sanzo_of_save_options($data, $key = null) {
	global $sanzo_theme_options;
    if (empty($data))
        return;	
    do_action('sanzo_of_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('sanzo_of_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ( $data as $k=>$v ) {
			if (!isset($sanzo_theme_options[$k]) || $sanzo_theme_options[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('sanzo_of_save_options_after', array(
		'key'=>$key, 'data'=>$data
	));

	update_option('sanzo_of_last_updated_time', time());
}


/* Fix bug activate theme no value default */
function sanzo_of_option_setup()	
{
	global $sanzo_of_options, $sanzo_options_machine;
	$ts_data = sanzo_of_get_options();
	$sanzo_options_machine = new Sanzo_Options_Machine($sanzo_of_options);
	$ts_data = sanzo_array_atts($sanzo_options_machine->Defaults, $ts_data);
	sanzo_of_save_default_options($ts_data);	
}

function sanzo_of_save_default_options($data){
	foreach ( $data as $k=>$v ) {
		if (is_array($v)) {
			foreach ($v as $key=>$val) {
				if ($key != $k && $v[$key] == $val) {
					set_theme_mod($k, $v);
					break;
				}
			}
		} else {
			set_theme_mod($k, $v);
		}		
	}
}


/**
 * For use in themes
 *
 * @since forever
 */



$data = sanzo_of_get_options();
if (!isset($sanzo_smof_details))
	$sanzo_smof_details = array();
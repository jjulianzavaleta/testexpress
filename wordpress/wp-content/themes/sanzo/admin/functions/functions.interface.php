<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function sanzo_optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $sanzo_of_options, $sanzo_options_machine, $sanzo_theme_options, $sanzo_smof_details;
	if( !isset($sanzo_options_machine) ){
		$sanzo_options_machine = new Sanzo_Options_Machine($sanzo_of_options);
	}

	do_action('sanzo_optionsframework_admin_init_before', array(
			'of_options'		=> $sanzo_of_options,
			'options_machine'	=> $sanzo_options_machine,
			'smof_data'			=> $sanzo_theme_options
		));
	
	if (empty($sanzo_theme_options['smof_init'])) { // Let's set the values if the theme's already been active
		sanzo_of_save_options($sanzo_options_machine->Defaults);
		sanzo_of_save_options(date('r'), 'smof_init');
		$sanzo_theme_options = sanzo_of_get_options();
		$sanzo_options_machine = new Sanzo_Options_Machine($sanzo_of_options);
	}

	do_action('sanzo_optionsframework_admin_init_after', array(
			'of_options'		=> $sanzo_of_options,
			'options_machine'	=> $sanzo_options_machine,
			'smof_data'			=> $sanzo_theme_options
		));

}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function sanzo_optionsframework_add_admin() {
	
    $of_page = add_theme_page( THEMENAME, esc_html__('Theme Options', 'sanzo'), 'edit_theme_options', 'optionsframework', 'sanzo_optionsframework_options_page');

	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'sanzo_of_load_only');
	add_action("admin_print_styles-$of_page",'sanzo_of_style_only');
	
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function sanzo_optionsframework_options_page(){
	
	global $sanzo_options_machine;
	
	/*
	//for debugging

	$sanzo_theme_options = sanzo_of_get_options();
	print_r($sanzo_theme_options);

	*/	
	
	include_once ADMIN_PATH . 'front-end/options.php';

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function sanzo_of_style_only(){
	wp_enqueue_style('sanzo-of-admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	wp_enqueue_style('sanzo-of-admin-custom-jquery-ui', ADMIN_DIR .'assets/css/jquery-ui-custom.css');

	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', ADMIN_DIR . 'assets/css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
	do_action('sanzo_of_style_only_after');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function sanzo_of_load_only() 
{
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('sanzo-smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));

	/* ace editor */
	wp_enqueue_script('ace-editor', ADMIN_DIR .'assets/js/ace/ace.js', array( 'jquery' ), false, true);
	wp_enqueue_script('ace-theme-monokai', ADMIN_DIR .'assets/js/ace/theme-monokai.js', array( 'jquery' ), false, true);

	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', ADMIN_DIR .'assets/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', ADMIN_DIR .'assets/js/color-picker.min.js', array( 'jquery', 'iris' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
	

	/**
	 * Enqueue scripts for file uploader
	 */
	
	if ( function_exists( 'wp_enqueue_media' ) ){
		wp_enqueue_media();
	}

	do_action('sanzo_of_load_only_after');

}


/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function sanzo_of_ajax_callback() 
{
	global $sanzo_options_machine, $sanzo_of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = sanzo_of_get_options();
	
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			sanzo_of_save_options($upload_image);
		
				
		if( !empty($uploaded_file['error']) ){ 
			echo esc_html__('Upload Error: ', 'sanzo') . $uploaded_file['error']; 
		}	
		else {
			echo esc_url($uploaded_file['url']); 
		} // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			sanzo_of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		sanzo_of_save_options($backup, BACKUPS) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$sanzo_theme_options = sanzo_of_get_options(BACKUPS);

		sanzo_of_save_options($sanzo_theme_options);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){


		$sanzo_theme_options = json_decode(stripslashes($_POST['data']), true);
		sanzo_of_save_options($sanzo_theme_options);

		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{

		wp_parse_str(stripslashes($_POST['data']), $sanzo_theme_options);
		unset($sanzo_theme_options['security']);
		unset($sanzo_theme_options['of_save']);
		sanzo_of_save_options($sanzo_theme_options);
		
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		sanzo_of_save_options($sanzo_options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}

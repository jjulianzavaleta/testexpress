<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Poco_Options')) :
	/**
	 * The Poco Options class
	 */
	class Poco_Options {


		public $opt_name = "poco_options";

		public function __construct() {
			if (poco_is_redux_activated()) {
				$this->setup_redux();
				Redux::init($this->opt_name);
			}

			if (poco_is_cmb2_activated()) {
				$this->setup_metabox();
			}
		}

		private function setup_metabox() {
			add_action('cmb2_admin_init', [$this, 'metabox_page']);
		}

		public function metabox_page() {
			$cmb2 = new_cmb2_box(array(
				'id'           => 'poco_page_settings',
				'title'        => esc_html__('Page Settings', 'poco'),
				'object_types' => array('page',), // Post type
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
			));

			//Breadcrumb
			$cmb2->add_field(array(
				'name'    => esc_html__('Breadcrumb Background Color', 'poco'),
				'id'      => 'poco_breadcrumb_bg_color',
				'type'    => 'colorpicker',
				'default' => '',
			));

			$cmb2->add_field(array(
				'name'         => esc_html__('Breadcrumb Background', 'poco'),
				'desc'         => 'Upload an image or enter an URL.',
				'id'           => 'poco_breadcrumb_bg_image',
				'type'         => 'file',
				'options'      => array(
					'url' => false, // Hide the text input for the url
				),
				'text'         => array(
					'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
				),
				'preview_size' => 'large', // Image size to use when previewing in the admin.
			));
		}

		private function setup_redux() {
			$theme = wp_get_theme(); // For use with some settings. Not necessary.
			$args  = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'             => $this->opt_name,
				// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'         => $theme->get('Name'),
				// Name that appears at the top of your panel
				'display_version'      => $theme->get('Version'),
				// Version that appears at the top of your panel
				'menu_type'            => 'menu',
				//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'       => true,
				// Show the sections below the admin menu item or not
				'menu_title'           => esc_html__('Poco Options', 'poco'),
				'page_title'           => esc_html__('Poco Options', 'poco'),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'       => apply_filters('poco_google_api_key', ''),
				// Set it you want google fonts to update weekly. A google_api_key value is required.
				'google_update_weekly' => false,
				// Must be defined to add google fonts to the typography module
				'async_typography'     => false,
				// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
				'admin_bar'            => true,
				// Show the panel pages on the admin bar
				'admin_bar_icon'       => 'dashicons-portfolio',
				// Choose an icon for the admin bar menu
				'admin_bar_priority'   => 50,
				// Choose an priority for the admin bar menu
				'global_variable'      => '',
				// Set a different name for your global variable other than the opt_name
				'dev_mode'             => false,
				// Show the time the page took to load, etc
				'update_notice'        => true,
				// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
				'customizer'           => false,
				// Enable basic customizer support
				//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'        => null,
				// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'          => 'themes.php',
				// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'     => 'manage_options',
				// Permissions needed to access the options panel.
				'menu_icon'            => '',
				// Specify a custom URL to an icon
				'last_tab'             => '',
				// Force your panel to always open to a specific tab (by id)
				'page_icon'            => 'icon-themes',
				// Icon displayed in the admin panel next to your menu_title
				'page_slug'            => 'poco-options',
				// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
				'save_defaults'        => true,
				// On load save the defaults to DB before user clicks save or not
				'default_show'         => false,
				// If true, shows the default value next to each field that is not the default value.
				'default_mark'         => '',
				// What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'   => true,
				// Shows the Import/Export panel when not used as a field.

				// CAREFUL -> These options are for advanced use only
				'transient_time'       => 60 * MINUTE_IN_SECONDS,
				'output'               => true,
				// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'           => true,
				// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'             => '',
				// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'use_cdn'              => true,
				// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

				// HINTS
				'hints'                => array(
					'icon'          => 'el el-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'red',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				)
			);
			Redux::setArgs($this->opt_name, apply_filters('poco_redux_args_options', $args));


			// Section Basic
			add_filter('redux/options/' . $this->opt_name . '/sections', [$this, 'section_site_indentity']);
			add_filter('redux/options/' . $this->opt_name . '/sections', [$this, 'section_breadcrumb']);
			add_filter('redux/options/' . $this->opt_name . '/sections', [$this, 'section_blog']);
			add_filter('redux/options/' . $this->opt_name . '/sections', [$this, 'section_social']);

			if (poco_is_woocommerce_activated()) {
				add_filter('redux/options/' . $this->opt_name . '/sections', [$this, 'get_wocommerce_section']);
			}

		}

		public function section_site_indentity($sections) {
			$sections[] = array(
				'title'  => esc_html__('Home', 'poco'),
				'id'     => 'home',
				'icon'   => 'el el-home',
				'fields' => array(
					array(
						'id'    => 'logo_light',
						'type'  => 'media',
						'url'   => true,
						'title' => esc_html__('Logo', 'poco'),
					),
					array(
						'id'     => 'logo_size',
						'type'   => 'dimensions',
						'units'  => array('px'),
						'title'  => esc_html__('Logo Size', 'poco'),
						'output' => array('.site-header .site-branding img')
					),
					array(
						'id'     => 'body-background',
						'type'   => 'background',
						'output' => ['body'],
						'title'  => esc_html__('Body Background', 'poco'),
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__('Typography', 'poco'),
				'id'         => 'typography',
				'desc'       => esc_html__('For full documentation on this field, visit: ', 'poco') . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
				'icon'       => 'el el-font',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'             => 'typography-body',
						'type'           => 'typography',
						'title'          => esc_html__('Body', 'poco'),
						'google'         => true,
						'word-spacing'   => true,
						'text-align'     => false,
						'letter-spacing' => true,
						'color'          => false,
						'output'         => ['body, button, input, textarea']
					),
					array(
						'id'             => 'typography-heading',
						'type'           => 'typography',
						'title'          => esc_html__('Heading', 'poco'),
						'google'         => true,
						'word-spacing'   => true,
						'text-align'     => false,
						'letter-spacing' => true,
						'color'          => false,
						'output'         => ['h1, h2, h3, h4, h5, h6, blockquote, .widget .widget-title']
					),
				)
			);

			return $sections;
		}

		public function get_wocommerce_section($sections) {

			$sections[] = array(
				'title' => esc_html__('Wocommerce', 'poco'),
				'id'    => 'wocommerce',
				'icon'  => 'el el-cog',
			);

			$sections[] = array(
				'title'      => esc_html__('Product Image', 'poco'),
				'id'         => 'wocommerce-product-image',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'woocommerce_product_single_width',
						'type'    => 'dimensions',
						'units'   => 'px',
						'title'   => esc_html__('Single Product Width', 'poco'),
						'height'  => false,
						'default' => ['width' => 800],
					),
					array(
						'id'      => 'woocommerce_product_thumbnail_width',
						'type'    => 'dimensions',
						'units'   => 'px',
						'title'   => esc_html__('Archive Product Width', 'poco'),
						'height'  => false,
						'default' => ['width' => 450],
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__('Archive Product', 'poco'),
				'id'         => 'wocommerce-archive-product',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'woocommerce_archive_layout',
						'type'    => 'select',
						'title'   => esc_html__('Layout Style', 'poco'),
						// Must provide key => value pairs for select options
						'options' => array(
							'default'  => esc_html__('Sidebar', 'poco'),
							'canvas'   => esc_html__('Canvas Filter', 'poco'),
							'dropdown' => esc_html__('Dropdown Filter', 'poco'),
						),
						'default' => 'default',
					),
					array(
						'id'       => 'woocommerce_archive_sidebar',
						'type'     => 'select',
						'title'    => esc_html__('Sidebar Position', 'poco'),
						// Must provide key => value pairs for select options
						'options'  => array(
							'left'  => esc_html__('Left', 'poco'),
							'right' => esc_html__('Right', 'poco'),
						),
						'default'  => 'left',
						'required' => array('woocommerce_archive_layout', 'equals', 'default'),
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__('Single Product', 'poco'),
				'id'         => 'wocommerce-single-product',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'wocommerce_single_style',
						'title'   => esc_html__('Product Single Style', 'poco'),
						'type'    => 'select',
						'options' => array(
							'1' => esc_html__('Style 1', 'poco'),
							'2' => esc_html__('Style 2', 'poco'),
						),
						'default' => '1'
					),
					array(
						'id'       => 'single-product-gallery-layout',
						'type'     => 'select',
						'title'    => esc_html__('Product gallery layout', 'poco'),
						'options'  => array(
							'horizontal' => esc_html__('Horizontal', 'poco'),
							'vertical'   => esc_html__('Vertical', 'poco'),
						),
						'default'  => 'horizontal',
						'required' => array('wocommerce_single_style', 'equals', '1'),
					),
					array(
						'id'    => 'single-product-content-meta',
						'type'  => 'editor',
						'title' => esc_html__('Single extra description', 'poco'),
					),
				),
			);

			return $sections;
		}


		public function section_breadcrumb($sections) {
			$sections[] = array(
				'title'  => esc_html__('Breadcrumb', 'poco'),
				'id'     => 'breadcrumb',
				'icon'   => 'el el-flag',
				'fields' => array(
					array(
						'id'       => 'breadcrumb-default-color',
						'type'     => 'color',
						'title'    => esc_html__('Color', 'poco'),
						'validate' => 'color',
						'output'   => ['.poco-breadcrumb, .poco-breadcrumb .breadcrumb-heading, .poco-breadcrumb a'],
					),
					array(
						'id'     => 'breadcrumb-default-bg',
						'type'   => 'background',
						'title'  => esc_html__('Breadcrumb Background', 'poco'),
						'output' => ['.poco-breadcrumb']
					),
				)
			);

			return $sections;
		}

		public function section_blog($sections) {
			$sections[] = array(
				'title'  => esc_html__('Blog', 'poco'),
				'id'     => 'blog',
				'icon'   => 'el el-blogger',
				'fields' => array(
					array(
						'id'      => 'blog-style',
						'type'    => 'select',
						'title'   => esc_html__('Blog style', 'poco'),
						'options' => array(
							'standard' => __('Blog Standard', 'poco'),
							'grid'     => __('Blog Grid', 'poco'),
						),
						'default' => 'standard',
					),
				)
			);

			return $sections;
		}

		public function section_social($sections) {
			$sections[] = array(
				'title'  => esc_html__('Social', 'poco'),
				'id'     => 'social',
				'icon'   => 'el el-globe',
				'fields' => array(
					array(
						'id'       => 'social_text',
						'type'     => 'multi_text',
						'validate' => 'url',
						'title'    => esc_html__('Social link', 'poco'),
						'subtitle' => esc_html__('Add your social link', 'poco'),
					),
					array(
						'id'      => 'social-share',
						'type'    => 'switch',
						'title'   => esc_html__( 'Social Share', 'poco' ),
						'default' => false,
						'on'      => esc_html__( 'Yes', 'poco' ),
						'off'     => esc_html__( 'No', 'poco' ),
					),
					array(
						'id'       => 'social-share-facebook',
						'type'     => 'switch',
						'title'    => esc_html__('Share Facebook', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
					array(
						'id'       => 'social-share-twitter',
						'type'     => 'switch',
						'title'    => esc_html__('Share Twitter', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
					array(
						'id'       => 'social-share-linkedin',
						'type'     => 'switch',
						'title'    => esc_html__('Share Linkedin', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
					array(
						'id'       => 'social-share-google-plus',
						'type'     => 'switch',
						'title'    => esc_html__('Share Google Plus', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
					array(
						'id'       => 'social-share-pinterest',
						'type'     => 'switch',
						'title'    => esc_html__('Share Pinterest', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
					array(
						'id'       => 'social-share-email',
						'type'     => 'switch',
						'title'    => esc_html__('Share Email', 'poco'),
						'default'  => true,
						'on'       => esc_html__('Yes', 'poco'),
						'off'      => esc_html__('No', 'poco'),
						'required' => array('social-share', 'equals', true),
					),
				)
			);

			return $sections;
		}
	}

endif;

return new Poco_Options();

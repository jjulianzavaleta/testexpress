<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Poco_Elementor')) :

	/**
	 * The Poco Elementor Integration class
	 */
	class Poco_Elementor {
		private $suffix = '';

		public function __construct() {
			$this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

			add_action('wp', [$this, 'register_auto_scripts_frontend']);
			add_action('elementor/init', array($this, 'add_category'));
			add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
			add_action('elementor/widgets/widgets_registered', array($this, 'include_widgets'));
			add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

			// Custom Animation Scroll
			add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

			// Elementor Fix Noitice WooCommerce
			add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

			// Backend
			add_action('elementor/editor/after_enqueue_scripts', [$this, 'add_scripts_editor']);
			add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);
//
//			// Add Icon Custom
			add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
			add_action('elementor/controls/controls_registered', [$this, 'add_icons']);

			if (!poco_is_elementor_pro_activated()) {
				require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
			}

			// Fix Parallax granular-controls-for-elementor
			if (function_exists('granular_get_options')) {
				if ('yes' === granular_get_options('granular_editor_parallax_on', 'granular_editor_settings', 'no')) {
					add_action('elementor/frontend/section/after_render', [
						$this,
						'granular_editor_after_render'
					], 10, 1);
				}
			}
			add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
			add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
		}

		public function elementor_kit() {
			$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
			Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
			$myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
			if (!empty($myvals)) {
				$css = '';
				$css .= $myvals['system_colors'][0]['color'] !== '' ? '--primary:' . $myvals['system_colors'][0]['color'] . ';' : '';
				$css .= $myvals['system_colors'][1]['color'] !== '' ? '--secondary:' . $myvals['system_colors'][1]['color'] . ';' : '';
				$css .= $myvals['system_colors'][2]['color'] !== '' ? '--body:' . $myvals['system_colors'][2]['color'] . ';' : '';
				$css .= $myvals['system_colors'][3]['color'] !== '' ? '--heading:' . $myvals['system_colors'][3]['color'] . ';' : '';

				$custom_color = $myvals['custom_colors'];

				foreach ($custom_color as $color) {
					$title = $color["title"];
					switch ($title) {
						case "Primary hover":
							$css .= '--primary_hover:' . $color['color'] . ';';
							break;
						case "Light":
							$css .= '--light:' . $color['color'] . ';';
							break;
						case "Dark":
							$css .= '--dark:' . $color['color'] . ';';
							break;
						case "Border":
							$css .= '--border:' . $color['color'] . ';';
							break;
					}
				}

				$var = "body{{$css}}";
				wp_add_inline_style('poco-style', $var);
			}
		}

		public function additional_fonts($fonts) {
			$fonts["Bebas Neue"] = 'googlefonts';
			$fonts['Gilroy']     = 'system';

			return $fonts;
		}

		public function granular_editor_after_render($element) {
			$settings = $element->get_settings();
			if ($element->get_settings('section_parallax_on') == 'yes') {
				$type        = $settings['parallax_type'];
				$and_support = $settings['android_support'];
				$ios_support = $settings['ios_support'];
				$speed       = $settings['parallax_speed'];
				?>

				<script type="text/javascript">
					(function ($) {
						"use strict";
						var granularParallaxElementorFront = {
							init: function () {
								elementorFrontend.hooks.addAction('frontend/element_ready/global', granularParallaxElementorFront.initWidget);
							},
							initWidget: function ($scope) {
								$('.elementor-element-<?php echo esc_js($element->get_id()); ?>').jarallax({
									type: '<?php echo esc_js($type); ?>',
									speed: <?php echo esc_js($speed); ?>,
									keepImg: true,
									imgSize: 'cover',
									imgPosition: '50% 0%',
									noAndroid: <?php echo esc_js($and_support); ?>,
									noIos: <?php echo esc_js($ios_support); ?>
								});
							}
						};
						$(window).on('elementor/frontend/init', granularParallaxElementorFront.init);
					}(jQuery));
				</script>

			<?php }
		}

		public function add_js() {
			global $poco_version;
			wp_enqueue_script('poco-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $poco_version);
		}

		public function add_style_editor() {
			global $poco_version;
			wp_enqueue_style('poco-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $poco_version);
		}

		public function add_scripts_editor() {
			global $poco_version;
//			wp_enqueue_script( 'poco-elementor-admin-editor', get_theme_file_uri( '/assets/js/elementor/editor/backend.js' ), [], $poco_version, true );
		}

		public function add_scripts() {
			global $poco_version;
			$suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
			wp_enqueue_style('poco-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $poco_version);
			wp_style_add_data('poco-elementor', 'rtl', 'replace');

			// Add Scripts
			wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
			wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $poco_version);
			wp_register_script('magnific-popup', get_theme_file_uri('/assets/js/jquery.magnific-popup.min.js'), array('jquery'), $poco_version, true);
			wp_register_style('magnific-popup', get_theme_file_uri('/assets/css/libs/magnific-popup.css'));


			if (poco_elementor_check_type('animated-bg-parallax')) {
				wp_enqueue_script('tweenmax');
				wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
			}
		}


		public function register_auto_scripts_frontend() {
            global $poco_version;
            wp_register_script('poco-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-tab-hover', get_theme_file_uri('/assets/js/elementor/tab-hover.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $poco_version, true);
            wp_register_script('poco-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $poco_version, true);
           
        }

		public function add_category() {
			Elementor\Plugin::instance()->elements_manager->add_category(
				'poco-addons',
				array(
					'title' => esc_html__('Poco Addons', 'poco'),
					'icon'  => 'fa fa-plug',
				),
				1);
		}

		public function add_animations_scroll($animations) {
			$animations['Poco Animation'] = [
				'opal-move-up'    => 'Move Up',
				'opal-move-down'  => 'Move Down',
				'opal-move-left'  => 'Move Left',
				'opal-move-right' => 'Move Right',
				'opal-flip'       => 'Flip',
				'opal-helix'      => 'Helix',
				'opal-scale-up'   => 'Scale',
				'opal-am-popup'   => 'Popup',
			];

			return $animations;
		}

		/**
		 * @param $widgets_manager Elementor\Widgets_Manager
		 */
		public function include_widgets($widgets_manager) {
			$files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
			foreach ($files as $file) {
				if (file_exists($file)) {
					require_once $file;
				}
			}

			// Button
			add_action('elementor/element/button/section_style/after_section_end', function ($element, $args) {

				$element->update_control(
					'background_color',
					[
						'global' => [
							'default' => '',
						],
					]
				);
			}, 10, 2);

			// Text editor
			add_action('elementor/element/text-editor/section_style/before_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				$element->add_group_control(
					Group_Control_Text_Shadow::get_type(),
					[
						'name'     => 'texteditor_shadow',
						'selector' => '{{WRAPPER}} .elementor-text-editor',
					]
				);

			}, 10, 2);


			// Counter
			add_action('elementor/element/counter/section_number/after_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control('title_color', [
					'scheme' => [],
				]);
			}, 10, 2);

			// Toggle
			add_action('elementor/element/toggle/section_toggle_style_title/after_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control('title_color', [
					'scheme' => [],
				]);

				$element->update_control('tab_active_color', [
					'scheme' => [],
				]);
			}, 10, 2);

			// Image Box
			add_action('elementor/element/image-box/section_style_content/after_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control('title_color', [
					'scheme' => [],
				]);

				$element->update_control('title_typography', [
					'scheme' => [],
				]);

				$element->update_control('description_color', [
					'scheme' => [],
				]);

				$element->update_control('description_typography', [
					'scheme' => [],
				]);
			}, 10, 2);

			// Icon Box
			add_action('elementor/element/icon-box/section_style_content/after_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control('primary_color', [
					'scheme' => [],
				]);

				$element->update_control('title_color', [
					'scheme' => [],
				]);

				$element->update_control('title_typography', [
					'scheme' => [],
				]);

				$element->update_control('description_color', [
					'scheme' => [],
				]);

				$element->update_control('description_typography', [
					'scheme' => [],
				]);
			}, 10, 2);

			// Icon List
			add_action('elementor/element/icon-list/section_text_style/after_section_end', function ($element, $args) {
				/** @var \Elementor\Element_Base $element */
				// Remove Schema
				$element->update_control('icon_color', [
					'scheme' => [],
				]);

				$element->update_control('text_color', [
					'scheme'    => [],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
				]);

				$element->update_control('text_color_hover', [
					'scheme'    => [],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
					],
				]);

				$element->update_control('icon_typography', [
					'scheme'    => [],
					'selectors' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text',
				]);

				$element->update_control('divider_color', [
					'scheme'  => [],
					'default' => ''
				]);

			}, 10, 2);

//			Accordion
			add_action('elementor/element/accordion/section_title_style/before_section_end', function ($element, $args) {

				$element->add_control(
					'style_theme',
					[
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label'        => __('Style Theme', 'poco'),
						'prefix_class' => 'style-theme-'
					]
				);

			}, 10, 2);

//			Call to action
			add_action('elementor/element/call-to-action/button_style/before_section_end', function ($element, $args) {

				$element->add_control(
					'button_padding',
					[
						'type'      => \Elementor\Controls_Manager::DIMENSIONS,
						'label'     => __('Padding', 'poco'),
						'selectors' => [
							'{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
					'button_effect',
					[
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label'        => __('Effect Hover', 'poco'),
						'description'  => esc_html__('Applies when adding icons to buttons in field button text.
												Example : <span>Button text<i class="poco-icon-arrow"></i> </span> ', 'poco'),
						'prefix_class' => 'button-effect-'
					]
				);
			}, 10, 2);

//			Countdown
			add_action('elementor/element/countdown/section_countdown/before_section_end', function ($element, $args) {

				$element->add_control(
					'show_dot',
					[
						'label'     => __('Show Dots', 'poco'),
						'type'      => Controls_Manager::SWITCHER,
						'selectors' => [
							'{{WRAPPER}} .elementor-countdown-item:after' => 'content: "";',
						],
						'separator' => 'before'
					]
				);

			}, 10, 2);

//			Form
			add_action('elementor/element/form/section_field_style/before_section_end', function ($element, $args) {
				$element->add_control(
					'field_border_color_focus',
					[
						'label'     => __('Border Color Focus', 'poco'),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload) .elementor-field:not(.elementor-select-wrapper):focus' => 'border-color: {{VALUE}};',
							'{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select:focus'                                                  => 'border-color: {{VALUE}};',
						],
					]
				);

				$element->add_control(
					'field_text_padding',
					[
						'type'      => \Elementor\Controls_Manager::DIMENSIONS,
						'label'     => __('Padding', 'poco'),
						'selectors' => [
							'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload):not(.elementor-field-type-recaptcha_v3):not(.elementor-field-type-recaptcha) .elementor-field:not(.elementor-select-wrapper)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select'                                                                                                                               => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
					'field_text_margin',
					[
						'type'      => \Elementor\Controls_Manager::DIMENSIONS,
						'label'     => __('Margin', 'poco'),
						'selectors' => [
							'{{WRAPPER}} .elementor-field-group .elementor-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
					'textarea_heading',
					[
						'type'      => \Elementor\Controls_Manager::HEADING,
						'label'     => __('Textarea', 'poco'),
						'separator' => 'before'
					]
				);

				$element->add_control(
					'textarea_color',
					[
						'type'      => \Elementor\Controls_Manager::COLOR,
						'label'     => __('Color', 'poco'),
						'selectors' => [
							'{{WRAPPER}} textarea.elementor-field' => 'color: {{VALUE}} !important',
						],
					]
				);

				$element->add_control(
					'textarea_background',
					[
						'type'      => \Elementor\Controls_Manager::COLOR,
						'label'     => __('Background', 'poco'),
						'selectors' => [
							'{{WRAPPER}} textarea.elementor-field' => 'background: {{VALUE}} !important',
						],
					]
				);

				$element->add_control(
					'textarea_border_color',
					[
						'type'      => \Elementor\Controls_Manager::COLOR,
						'label'     => __('Border Color', 'poco'),
						'selectors' => [
							'{{WRAPPER}} textarea.elementor-field ' => 'border-color: {{VALUE}} !important',
						],
					]
				);

				$element->add_control(
					'textarea_border_color_active',
					[
						'type'      => \Elementor\Controls_Manager::COLOR,
						'label'     => __('Border Color Active', 'poco'),
						'selectors' => [
							'{{WRAPPER}} textarea.elementor-field:focus ' => 'border-color: {{VALUE}} !important',
						],
					]
				);

				$element->add_control(
					'textarea_border',
					[
						'label'     => __('Border Width', 'poco'),
						'type'      => \Elementor\Controls_Manager::SLIDER,
						'range'     => [
							'px' => [
								'min' => 0,
								'max' => 20,
							],
						],
						'selectors' => [
							'{{WRAPPER}} textarea.elementor-field' => 'border-width: {{SIZE}}{{UNIT}} !important;',
						],
					]
				);

				$element->add_control(
					'textarea_padding',
					[
						'label'      => __('Padding', 'poco'),
						'type'       => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => ['px', 'em'],
						'selectors'  => [
							'{{WRAPPER}} .elementor-field-group-message textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
					]
				);


			}, 10, 2);

			add_action('elementor/element/form/section_button_style/before_section_end', function ($element, $args) {
				$element->add_control(
					'button_submit_effect',
					[
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label'        => __('Effect Hover', 'poco'),
						'prefix_class' => 'button-effect-'
					]
				);
			}, 10, 2);

		}

		public function woocommerce_fix_notice() {
			if (poco_is_woocommerce_activated()) {
				remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
				remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
				remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
			}
		}

		public function add_icons( $manager ) {
            $new_icons = json_decode( '{"poco-icon-angle-down":"angle-down","poco-icon-angle-left":"angle-left","poco-icon-angle-right":"angle-right","poco-icon-angle-up":"angle-up","poco-icon-burger":"burger","poco-icon-cheeseburger":"cheeseburger","poco-icon-chicken":"chicken","poco-icon-circular":"circular","poco-icon-cocktail":"cocktail","poco-icon-delivery":"delivery","poco-icon-fast-food":"fast-food","poco-icon-fax":"fax","poco-icon-fire":"fire","poco-icon-food-delivery":"food-delivery","poco-icon-french-fries":"french-fries","poco-icon-group-1":"group-1","poco-icon-group":"group","poco-icon-hover":"hover","poco-icon-money":"money","poco-icon-mug-hot":"mug-hot","poco-icon-multimedia":"multimedia","poco-icon-order":"order","poco-icon-phone-plus":"phone-plus","poco-icon-pie":"pie","poco-icon-pizza-1":"pizza-1","poco-icon-pizza-2":"pizza-2","poco-icon-pizza":"pizza","poco-icon-salad":"salad","poco-icon-scooter":"scooter","poco-icon-search-2":"search-2","poco-icon-search":"search","poco-icon-store":"store","poco-icon-taco":"taco","poco-icon-time":"time","poco-icon-xmlid-1":"xmlid-1","poco-icon-arrow-circle-down":"arrow-circle-down","poco-icon-arrow-circle-left":"arrow-circle-left","poco-icon-arrow-circle-right":"arrow-circle-right","poco-icon-arrow-circle-up":"arrow-circle-up","poco-icon-bars":"bars","poco-icon-caret-down":"caret-down","poco-icon-caret-left":"caret-left","poco-icon-caret-right":"caret-right","poco-icon-caret-up":"caret-up","poco-icon-cart-empty":"cart-empty","poco-icon-check-square":"check-square","poco-icon-chevron-circle-left":"chevron-circle-left","poco-icon-chevron-circle-right":"chevron-circle-right","poco-icon-chevron-down":"chevron-down","poco-icon-chevron-left":"chevron-left","poco-icon-chevron-right":"chevron-right","poco-icon-chevron-up":"chevron-up","poco-icon-circle":"circle","poco-icon-clock":"clock","poco-icon-cloud-download-alt":"cloud-download-alt","poco-icon-comment":"comment","poco-icon-comments":"comments","poco-icon-contact":"contact","poco-icon-credit-card":"credit-card","poco-icon-dot-circle":"dot-circle","poco-icon-edit":"edit","poco-icon-envelope":"envelope","poco-icon-expand-alt":"expand-alt","poco-icon-external-link-alt":"external-link-alt","poco-icon-eye":"eye","poco-icon-file-alt":"file-alt","poco-icon-file-archive":"file-archive","poco-icon-filter":"filter","poco-icon-folder-open":"folder-open","poco-icon-folder":"folder","poco-icon-free_ship":"free_ship","poco-icon-frown":"frown","poco-icon-gift":"gift","poco-icon-grip-horizontal":"grip-horizontal","poco-icon-heart-fill":"heart-fill","poco-icon-heart":"heart","poco-icon-history":"history","poco-icon-home":"home","poco-icon-info-circle":"info-circle","poco-icon-instagram":"instagram","poco-icon-level-up-alt":"level-up-alt","poco-icon-long-arrow-alt-down":"long-arrow-alt-down","poco-icon-long-arrow-alt-left":"long-arrow-alt-left","poco-icon-long-arrow-alt-right":"long-arrow-alt-right","poco-icon-long-arrow-alt-up":"long-arrow-alt-up","poco-icon-map-marker-check":"map-marker-check","poco-icon-meh":"meh","poco-icon-minus-circle":"minus-circle","poco-icon-mobile-android-alt":"mobile-android-alt","poco-icon-money-bill":"money-bill","poco-icon-pencil-alt":"pencil-alt","poco-icon-plus-circle":"plus-circle","poco-icon-plus":"plus","poco-icon-quote":"quote","poco-icon-random":"random","poco-icon-reply-all":"reply-all","poco-icon-reply":"reply","poco-icon-search-plus":"search-plus","poco-icon-shield-check":"shield-check","poco-icon-shopping-basket":"shopping-basket","poco-icon-shopping-cart":"shopping-cart","poco-icon-sign-out-alt":"sign-out-alt","poco-icon-smile":"smile","poco-icon-spinner":"spinner","poco-icon-square":"square","poco-icon-star":"star","poco-icon-sync":"sync","poco-icon-tachometer-alt":"tachometer-alt","poco-icon-th-large":"th-large","poco-icon-th-list":"th-list","poco-icon-thumbtack":"thumbtack","poco-icon-times-circle":"times-circle","poco-icon-times":"times","poco-icon-trophy-alt":"trophy-alt","poco-icon-truck":"truck","poco-icon-user-headset":"user-headset","poco-icon-user-shield":"user-shield","poco-icon-user":"user","poco-icon-adobe":"adobe","poco-icon-amazon":"amazon","poco-icon-android":"android","poco-icon-angular":"angular","poco-icon-apper":"apper","poco-icon-apple":"apple","poco-icon-atlassian":"atlassian","poco-icon-behance":"behance","poco-icon-bitbucket":"bitbucket","poco-icon-bitcoin":"bitcoin","poco-icon-bity":"bity","poco-icon-bluetooth":"bluetooth","poco-icon-btc":"btc","poco-icon-centos":"centos","poco-icon-chrome":"chrome","poco-icon-codepen":"codepen","poco-icon-cpanel":"cpanel","poco-icon-discord":"discord","poco-icon-dochub":"dochub","poco-icon-docker":"docker","poco-icon-dribbble":"dribbble","poco-icon-dropbox":"dropbox","poco-icon-drupal":"drupal","poco-icon-ebay":"ebay","poco-icon-facebook":"facebook","poco-icon-figma":"figma","poco-icon-firefox":"firefox","poco-icon-google-plus":"google-plus","poco-icon-google":"google","poco-icon-grunt":"grunt","poco-icon-gulp":"gulp","poco-icon-html5":"html5","poco-icon-jenkins":"jenkins","poco-icon-joomla":"joomla","poco-icon-link-brand":"link-brand","poco-icon-linkedin":"linkedin","poco-icon-mailchimp":"mailchimp","poco-icon-opencart":"opencart","poco-icon-paypal":"paypal","poco-icon-pinterest-p":"pinterest-p","poco-icon-reddit":"reddit","poco-icon-skype":"skype","poco-icon-slack":"slack","poco-icon-snapchat":"snapchat","poco-icon-spotify":"spotify","poco-icon-trello":"trello","poco-icon-twitter":"twitter","poco-icon-vimeo":"vimeo","poco-icon-whatsapp":"whatsapp","poco-icon-wordpress":"wordpress","poco-icon-yoast":"yoast","poco-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

		public function add_icons_native($tabs) {
			global $poco_version;
			$tabs['opal-custom'] = [
				'name'          => 'poco-icon',
				'label'         => esc_html__('Poco Icon', 'poco'),
				'prefix'        => 'poco-icon-',
				'displayPrefix' => 'poco-icon-',
				'labelIcon'     => 'fab fa-font-awesome-alt',
				'ver'           => $poco_version,
				'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
				'native'        => true,
			];

			return $tabs;
		}
	}

endif;

return new Poco_Elementor();

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! poco_is_woocommerce_activated() ) {
	return;
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Poco_Elementor_Widget_Products extends \Elementor\Widget_Base {


	public function get_categories() {
		return array( 'poco-addons' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'poco-products';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Products', 'poco' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}


	public function get_script_depends() {
		return [
			'poco-elementor-products',
			'slick',
			'tooltipster'
		];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		//Section Query
		$this->start_controls_section(
			'section_setting',
			[
				'label' => esc_html__( 'Settings', 'poco' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Posts Per Page', 'poco' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'          => esc_html__( 'columns', 'poco' ),
				'type'           => \Elementor\Controls_Manager::SELECT,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ],
			]
		);


		$this->add_control(
			'advanced',
			[
				'label' => esc_html__( 'Advanced', 'poco' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'       => esc_html__( 'Date', 'poco' ),
					'id'         => esc_html__( 'Post ID', 'poco' ),
					'menu_order' => esc_html__( 'Menu Order', 'poco' ),
					'popularity' => esc_html__( 'Number of purchases', 'poco' ),
					'rating'     => esc_html__( 'Average Product Rating', 'poco' ),
					'title'      => esc_html__( 'Product Title', 'poco' ),
					'rand'       => esc_html__( 'Random', 'poco' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'poco' ),
					'desc' => esc_html__( 'DESC', 'poco' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Categories', 'poco' ),
				'type'     => Controls_Manager::SELECT2,
				'options'  => $this->get_product_categories(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'cat_operator',
			[
				'label'     => esc_html__( 'Category Operator', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => esc_html__( 'AND', 'poco' ),
					'IN'     => esc_html__( 'IN', 'poco' ),
					'NOT IN' => esc_html__( 'NOT IN', 'poco' ),
				],
				'condition' => [
					'categories!' => ''
				],
			]
		);

		$this->add_control(
			'tag',
			[
				'label'    => esc_html__( 'Tags', 'poco' ),
				'type'     => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'  => $this->get_product_tags(),
				'multiple' => true,
			]
		);

		$this->add_control(
			'tag_operator',
			[
				'label'     => esc_html__( 'Tag Operator', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => esc_html__( 'AND', 'poco' ),
					'IN'     => esc_html__( 'IN', 'poco' ),
					'NOT IN' => esc_html__( 'NOT IN', 'poco' ),
				],
				'condition' => [
					'tag!' => ''
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label'   => esc_html__( 'Product Type', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'newest',
				'options' => [
					'newest'       => esc_html__( 'Newest Products', 'poco' ),
					'on_sale'      => esc_html__( 'On Sale Products', 'poco' ),
					'best_selling' => esc_html__( 'Best Selling', 'poco' ),
					'top_rated'    => esc_html__( 'Top Rated', 'poco' ),
					'featured'     => esc_html__( 'Featured Product', 'poco' ),
				],
			]
		);

		$this->add_control(
			'paginate',
			[
				'label'   => esc_html__( 'Paginate', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => esc_html__( 'None', 'poco' ),
					'pagination' => esc_html__( 'Pagination', 'poco' ),
				],
			]
		);

		$this->add_control(
			'product_layout',
			[
				'label'   => esc_html__( 'Product Layout', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => esc_html__( 'Grid', 'poco' ),
					'list' => esc_html__( 'List', 'poco' ),
				],
			]
		);

		$this->add_control(
			'list_layout',
			[
				'label'     => esc_html__( 'List Layout', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__( 'Style 1', 'poco' ),
					'2' => esc_html__( 'Style 2', 'poco' ),
				],
				'condition' => [
					'product_layout' => 'list'
				]
			]
		);

		$this->add_responsive_control(
			'product_gutter',
			[
				'label'      => esc_html__( 'Gutter', 'poco' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product'      => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.products li.product-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} - 1px);',
					'{{WRAPPER}} ul.products'                 => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
				],
			]
		);

		$this->end_controls_section();
		// End Section Query

		// Carousel Option
		$this->add_control_carousel();
	}


	protected function get_product_categories() {
		$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			)
		);
		$results    = array();
		if ( ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$results[ $category->slug ] = $category->name;
			}
		}

		return $results;
	}

	protected function get_product_tags() {
		$tags    = get_terms( array(
				'taxonomy'   => 'product_tag',
				'hide_empty' => false,
			)
		);
		$results = array();
		if ( ! is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$results[ $tag->slug ] = $tag->name;
			}
		}

		return $results;
	}

	protected function get_product_type( $atts, $product_type ) {
		switch ( $product_type ) {
			case 'featured':
				$atts['visibility'] = "featured";
				break;

			case 'on_sale':
				$atts['on_sale'] = true;
				break;

			case 'best_selling':
				$atts['best_selling'] = true;
				break;

			case 'top_rated':
				$atts['top_rated'] = true;
				break;

			default:
				break;
		}

		return $atts;
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->woocommerce_default( $settings );
	}

	private function woocommerce_default( $settings ) {
		$type = 'products';
		$atts = [
			'limit'          => $settings['limit'],
			'columns'        => $settings['enable_carousel'] === 'yes' ? 1 : $settings['column'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'product_layout' => $settings['product_layout'],
		];

		$class = '';


		if ( $settings['product_layout'] == 'list' ) {

			$class .= ' products-list';
			$class .= ' producs-list-' . $settings['list_layout'];
			$class .= ' woocommerce-product-list';

            $atts['show_button']   = true;

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '1' ) {
                $atts['show_category']    = true;
            }
			if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '2' ) {
                $atts['show_rating']    = true;
                $atts['show_except']   = true;
			}

		}


		$atts = $this->get_product_type( $atts, $settings['product_type'] );
		if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
			$type = 'sale_products';
		} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
			$type = 'best_selling_products';
		} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
			$type = 'top_rated_products';
		}

		if ( ! empty( $settings['categories'] ) ) {
			$atts['category']     = implode( ',', $settings['categories'] );
			$atts['cat_operator'] = $settings['cat_operator'];
		}

		if ( ! empty( $settings['tag'] ) ) {
			$atts['tag']          = implode( ',', $settings['tag'] );
			$atts['tag_operator'] = $settings['tag_operator'];
		}

		// Carousel
		if ( $settings['enable_carousel'] === 'yes' ) {
			$atts['carousel_settings'] = json_encode( wp_slash( $this->get_carousel_settings() ) );
			$atts['product_layout']    = 'carousel';
			if ( $settings['product_layout'] == 'list' ) {
				$atts['product_layout'] = 'list-carousel';
			}
		} else {
			if ( ! empty( $settings['column_tablet'] ) ) {
				$class .= ' columns-tablet-' . $settings['column_tablet'];
			}

			if ( ! empty( $settings['column_mobile'] ) ) {
				$class .= ' columns-mobile-' . $settings['column_mobile'];
			}
		}
		$atts['class'] = $class;

		if ( $settings['paginate'] === 'pagination' ) {
			$atts['paginate'] = 'true';
		}

		echo ( new WC_Shortcode_Products( $atts, $type ) )->get_content(); // WPCS: XSS ok
	}

	protected function add_control_carousel( $condition = array() ) {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label'     => esc_html__( 'Carousel Options', 'poco' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => $condition,
			]
		);

		$this->add_control(
			'enable_carousel',
			[
				'label' => esc_html__( 'Enable', 'poco' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Navigation', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dots',
				'options'   => [
					'both'   => esc_html__( 'Arrows and Dots', 'poco' ),
					'arrows' => esc_html__( 'Arrows', 'poco' ),
					'dots'   => esc_html__( 'Dots', 'poco' ),
					'none'   => esc_html__( 'None', 'poco' ),
				],
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => esc_html__( 'Pause on Hover', 'poco' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'poco' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'poco' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay'        => 'yes',
					'enable_carousel' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'     => esc_html__( 'Infinite Loop', 'poco' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'product_carousel_border',
			[
				'label'        => esc_html__( 'Border Wrapper', 'poco' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'border-wrapper-',
				'condition'    => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_arrows',
			[
				'label'      => esc_html__( 'Carousel Arrows', 'poco' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'enable_carousel',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'none',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'dots',
						],
					],
				],
			]
		);

		//Style arrow
		$this->add_control(
			'style_arrow',
			[
				'label' => esc_html__( 'Style Arrow', 'poco' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		//add icon next size
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Size', 'poco' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//add icon next color
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};',
				],
				'separator' => 'after'

			]
		);

		$this->add_control(
			'next_heading',
			[
				'label' => esc_html__( 'Next button', 'poco' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'next_vertical',
			[
				'label'       => esc_html__( 'Next Vertical', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => esc_html__( 'Top', 'poco' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'poco' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'next_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'next_horizontal',
			[
				'label'       => esc_html__( 'Next Horizontal', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => esc_html__( 'Left', 'poco' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'poco' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'right'
			]
		);
		$this->add_responsive_control(
			'next_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->add_control(
			'prev_heading',
			[
				'label'     => esc_html__( 'Prev button', 'poco' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'prev_vertical',
			[
				'label'       => esc_html__( 'Prev Vertical', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => esc_html__( 'Top', 'poco' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'poco' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'prev_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'prev_horizontal',
			[
				'label'       => esc_html__( 'Prev Horizontal', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => esc_html__( 'Left', 'poco' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'poco' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'left'
			]
		);
		$this->add_responsive_control(
			'prev_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->end_controls_section();
	}

	protected function get_carousel_settings() {
		$settings = $this->get_settings_for_display();

		return array(
			'navigation'         => $settings['navigation'],
			'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
			'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
			'autoplayTimeout'    => $settings['autoplay_speed'],
			'items'              => $settings['column'],
			'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
			'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
			'loop'               => $settings['infinite'] === 'yes' ? true : false,
		);
	}

	protected function render_carousel_template() {
		?>
        var carousel_settings = {
        navigation: settings.navigation,
        autoplayHoverPause: settings.pause_on_hover === 'yes' ? true : false,
        autoplay: settings.autoplay === 'yes' ? true : false,
        autoplayTimeout: settings.autoplay_speed,
        items: settings.column,
        items_tablet: settings.column_tablet ? settings.column_tablet : settings.column,
        items_mobile: settings.column_mobile ? settings.column_mobile : 1,
        loop: settings.infinite === 'yes' ? true : false,
        };
		<?php
	}
}

$widgets_manager->register_widget_type( new Poco_Elementor_Widget_Products() );

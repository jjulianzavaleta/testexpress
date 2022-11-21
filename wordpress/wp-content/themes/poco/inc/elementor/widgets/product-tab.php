<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! poco_is_woocommerce_activated() ) {
	return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Poco_Elementor_Products_Tabs extends Elementor\Widget_Base {

	public function get_categories() {
		return array( 'poco-addons' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'poco-products-tabs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Products Tabs', 'poco' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}


	public function get_script_depends() {
		return [ 'poco-elementor-product-tab', 'slick' ];
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

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => __( 'Tabs', 'poco' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label'       => __( 'Tab Title', 'poco' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '#Product Tab', 'poco' ),
				'placeholder' => __( 'Product Tab Title', 'poco' ),
			]
		);

		$repeater->add_control(
			'limit',
			[
				'label'   => __( 'Posts Per Page', 'poco' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$repeater->add_control(
			'advanced',
			[
				'label' => __( 'Advanced', 'poco' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'       => __( 'Date', 'poco' ),
					'id'         => __( 'Post ID', 'poco' ),
					'menu_order' => __( 'Menu Order', 'poco' ),
					'popularity' => __( 'Number of purchases', 'poco' ),
					'rating'     => __( 'Average Product Rating', 'poco' ),
					'title'      => __( 'Product Title', 'poco' ),
					'rand'       => __( 'Random', 'poco' ),
				],
			]
		);

		$repeater->add_control(
			'order',
			[
				'label'   => __( 'Order', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'poco' ),
					'desc' => __( 'DESC', 'poco' ),
				],
			]
		);

		$repeater->add_control(
			'categories',
			[
				'label'    => __( 'Categories', 'poco' ),
				'type'     => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'  => $this->get_product_categories(),
				'multiple' => true,
			]
		);

		$repeater->add_control(
			'cat_operator',
			[
				'label'     => __( 'Category Operator', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => __( 'AND', 'poco' ),
					'IN'     => __( 'IN', 'poco' ),
					'NOT IN' => __( 'NOT IN', 'poco' ),
				],
				'condition' => [
					'categories!' => ''
				],
			]
		);

		$repeater->add_control(
			'tag',
			[
				'label'    => __( 'Tags', 'poco' ),
				'type'     => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'  => $this->get_product_tags(),
				'multiple' => true,
			]
		);

		$repeater->add_control(
			'tag_operator',
			[
				'label'     => __( 'Tag Operator', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => __( 'AND', 'poco' ),
					'IN'     => __( 'IN', 'poco' ),
					'NOT IN' => __( 'NOT IN', 'poco' ),
				],
				'condition' => [
					'tag!' => ''
				],
			]
		);

		$repeater->add_control(
			'product_type',
			[
				'label'   => __( 'Product Type', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'newest',
				'options' => [
					'newest'       => __( 'Newest Products', 'poco' ),
					'on_sale'      => __( 'On Sale Products', 'poco' ),
					'best_selling' => __( 'Best Selling', 'poco' ),
					'top_rated'    => __( 'Top Rated', 'poco' ),
					'featured'     => __( 'Featured Product', 'poco' ),
				],
			]
		);

		$repeater->add_control(
			'product_layout',
			[
				'label'   => __( 'Product Layout', 'poco' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => __( 'Grid', 'poco' ),
					'list' => __( 'List', 'poco' ),
				],
			]
		);

		$repeater->add_control(
			'list_layout',
			[
				'label'     => __( 'List Layout', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => __( 'Style 1', 'poco' ),
					'2' => __( 'Style 2', 'poco' ),
					'3' => __( 'Style 3', 'poco' ),
					'4' => __( 'Style 4', 'poco' ),
					'5' => __( 'Style 5', 'poco' ),
				],
				'condition' => [
					'product_layout' => 'list'
				]
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_title' => __( '#Product Tab 1', 'poco' ),
					],
					[
						'tab_title' => __( '#Product Tab 2', 'poco' ),
					]
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'          => __( 'columns', 'poco' ),
				'type'           => \Elementor\Controls_Manager::SELECT,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product',
			[
				'label' => __( 'Product', 'poco' ),
			]
		);
		$this->add_responsive_control(
			'product_gutter',
			[
				'label'      => __( 'Gutter', 'poco' ),
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

		$this->start_controls_section(
			'section_tab_header_style',
			[
				'label' => __( 'Header', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tab_header_padding',
			[
				'label'      => __( 'Padding', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'background_tab_header',
			[
				'label'     => __( 'Background Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_items',
			[
				'label'        => __( 'Align', 'poco' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
					'left'   => [
						'title' => __( 'Left', 'poco' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'poco' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'poco' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => '',
				'prefix_class' => 'elementor-tabs-h-align-',
				'selectors'    => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_margin',
			[
				'label'      => __( 'Spacing Between Item', 'poco' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-tab-title' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 ); margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label'     => __( 'Show Dots', 'poco' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title:before' => 'content: "";'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .elementor-tab-title',
			]
		);

        $this->add_responsive_control(
            'tab_title_padding',
            [
                'label'      => __( 'Padding', 'poco' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'poco' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background_color',
			[
				'label'     => __( 'Background Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};'
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'poco' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background_hover_color',
			[
				'label'     => __( 'Background Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title:hover' => 'background-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'title_hover_border_color',
			[
				'label'     => __( 'Border Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'poco' ),
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-tab-title.elementor-active:before' => 'background:',
				],
			]
		);

		$this->add_control(
			'title_background_active_color',
			[
				'label'     => __( 'Background Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'title_active_border_color',
			[
				'label'     => __( 'Border Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}!important;'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_tabs_title',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .elementor-tab-title',
				'separator'   => 'before',
			]
		);

        $this->add_control(
            'border_tabs_radius',
            [
                'label' => __( 'Border Radius', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->add_control_carousel();

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
		$tabs    = $this->get_settings_for_display( 'tabs' );
		$setting = $this->get_settings_for_display();

		$id_int = substr( $this->get_id_int(), 0, 3 );

		$this->add_render_attribute( 'data-carousel', 'class', 'elementor-tabs-content-wrapper' );

		if ( $setting['enable_carousel'] ) {

			$carousel_settings = $this->get_carousel_settings( $setting );
			$this->add_render_attribute( 'data-carousel', 'data-settings', wp_json_encode( $carousel_settings ) );
		}

		?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$class_item = 'elementor-repeater-item-' . $item['_id'];
					$class = ( $index == 0 ) ? 'elementor-active' : '';

					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

					$this->add_render_attribute( $tab_title_setting_key, [
						'id'            => 'elementor-tab-title-' . $id_int . $tab_count,
						'class'         => [
							'elementor-tab-title',
							'elementor-tab-desktop-title',
							$class,
							$class_item
						],
						'data-tab'      => $tab_count,
						'tabindex'      => $id_int . $tab_count,
						'role'          => 'tab',
						'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
					] );
					?>
                    <div <?php echo poco_elementor_get_render_attribute_string( $tab_title_setting_key, $this ); // WPCS: XSS ok.
					?>><?php echo esc_html( $item['tab_title'] ); ?></div>
				<?php endforeach; ?>
            </div>
            <div <?php echo poco_elementor_get_render_attribute_string( 'data-carousel', $this ); // WPCS: XSS ok.
			?>>
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$class_item = 'elementor-repeater-item-' . $item['_id'];
					$class_content = ( $index == 0 ) ? 'elementor-active' : '';

					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

					$this->add_render_attribute( $tab_content_setting_key, [
						'id'              => 'elementor-tab-content-' . $id_int . $tab_count,
						'class'           => [
							'elementor-tab-content',
							'elementor-clearfix',
							$class_content,
							$class_item
						],
						'data-tab'        => $tab_count,
						'role'            => 'tabpanel',
						'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
					?>
                    <div <?php echo poco_elementor_get_render_attribute_string( $tab_content_setting_key, $this ); // WPCS: XSS ok.
					?>>
						<?php $this->woocommerce_default( $item, $setting ); ?>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}

	private function woocommerce_default( $settings, $global_setting ) {
		$type = 'products';

		$class = '';

		if ( $global_setting['enable_carousel'] ) {

			$atts['product_layout'] = 'carousel';
			$atts                   = [
				'limit'             => $settings['limit'],
				'orderby'           => $settings['orderby'],
				'order'             => $settings['order'],
				'carousel_settings' => '',
				'columns'           => 1,
				'product_layout'    => 'carousel'
			];

			if ( $settings['product_layout'] == 'list' ) {
				$atts['product_layout'] = 'list-carousel';
			}
		} else {
			$atts = [
				'limit'             => $settings['limit'],
				'orderby'           => $settings['orderby'],
				'order'             => $settings['order'],
				'carousel_settings' => '',
				'columns'           => $global_setting['column'],
				'product_layout'    => $settings['product_layout']
			];

			if ( ! empty( $global_setting['column_tablet'] ) ) {
				$class .= ' columns-tablet-' . $global_setting['column_tablet'];
			}

			if ( ! empty( $global_setting['column_mobile'] ) ) {
				$class .= ' columns-mobile-' . $global_setting['column_mobile'];
			}
		}

		if ( $settings['product_layout'] == 'list' ) {
			$atts['show_rating'] = true;
			$class               .= ' products-list';
			$class               .= ' producs-list-' . $settings['list_layout'];
			$class               .= ' woocommerce-product-list';
            $atts['show_button']   = true;

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '1' ) {
                $atts['show_category']    = true;
            }
			if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '2' ) {
                $atts['show_rating']    = true;
                $atts['show_except']    = true;
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

		$atts['class'] = $class;

		echo ( new WC_Shortcode_Products( $atts, $type ) )->get_content(); // WPCS: XSS ok.
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

	protected function get_carousel_settings( $settings ) {
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

	protected function add_control_carousel( $condition = array() ) {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label'     => __( 'Carousel Options', 'poco' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => $condition,
			]
		);

		$this->add_control(
			'enable_carousel',
			[
				'label' => __( 'Enable', 'poco' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'poco' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dots',
				'options'   => [
					'both'   => __( 'Arrows and Dots', 'poco' ),
					'arrows' => __( 'Arrows', 'poco' ),
					'dots'   => __( 'Dots', 'poco' ),
					'none'   => __( 'None', 'poco' ),
				],
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => __( 'Pause on Hover', 'poco' ),
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
				'label'     => __( 'Autoplay', 'poco' ),
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
				'label'     => __( 'Autoplay Speed', 'poco' ),
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
				'label'     => __( 'Infinite Loop', 'poco' ),
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
				'label'        => __( 'Border Wrapper', 'poco' ),
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
				'label'      => __( 'Carousel Arrows', 'poco' ),
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

		$this->add_control(
			'next_heading',
			[
				'label' => __( 'Next button', 'poco' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'next_vertical',
			[
				'label'       => __( 'Next Vertical', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'poco' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'poco' ),
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
				'label'       => __( 'Next Horizontal', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => __( 'Left', 'poco' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'poco' ),
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
				'label'     => __( 'Prev button', 'poco' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'prev_vertical',
			[
				'label'       => __( 'Prev Vertical', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'poco' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'poco' ),
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
				'label'       => __( 'Prev Horizontal', 'poco' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => __( 'Left', 'poco' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'poco' ),
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
}

$widgets_manager->register_widget_type( new Poco_Elementor_Products_Tabs() );

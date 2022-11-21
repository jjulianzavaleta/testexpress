<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

class Poco_Elementor_Testimonials extends Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'poco-testimonials';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Poco Testimonials', 'poco' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_script_depends() {
		return [ 'poco-elementor-testimonial', 'slick' ];
	}

	public function get_categories() {
		return array( 'poco-addons' );
	}

	/**
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonials', 'poco' ),
			]
		);

        $this->add_control(
            'testimonial_style',
            [
                'label'   => esc_html__( 'Style', 'poco' ),
                'type'    => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options' => [
                    'style1'       => esc_html__( 'Style 1', 'poco' ),
                    'style2'       => esc_html__( 'Style 2', 'poco' ),
                ],
            ]
        );

		$this->add_control(
			'testimonials',
			[
				'label'       => __( 'Testimonials Item', 'poco' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => [

                    [
                        'name'    => 'testimonial_rating',
                        'label'   => esc_html__( 'Rating', 'poco' ),
                        'default' => 5,
                        'type'    => Controls_Manager::SELECT,
                        'options' => [
                            0 => esc_html__( 'Hidden', 'poco' ),
                            1 => esc_html__( 'Very poor', 'poco' ),
                            2 => esc_html__( 'Not that bad', 'poco' ),
                            3 => esc_html__( 'Average', 'poco' ),
                            4 => esc_html__( 'Good', 'poco' ),
                            5 => esc_html__( 'Perfect', 'poco' ),
                        ]

                    ],

					[
						'name'        => 'testimonial_content',
						'label'       => __( 'Content', 'poco' ),
						'type'        => Controls_Manager::TEXTAREA,
						'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'label_block' => true,
						'rows'        => '10',
					],
					[
						'name'       => 'testimonial_image',
						'label'      => __( 'Choose Image', 'poco' ),
						'type'       => Controls_Manager::MEDIA,
						'show_label' => false,
					],
					[
						'name'    => 'testimonial_name',
						'label'   => __( 'Name', 'poco' ),
						'default' => 'John Doe',
						'type'    => Controls_Manager::TEXT,
					],
					[
						'name'    => 'testimonial_job',
						'label'   => __( 'Job', 'poco' ),
						'default' => 'Design',
						'type'    => Controls_Manager::TEXT,
					],
					[
						'name'        => 'testimonial_link',
						'label'       => __( 'Link to', 'poco' ),
						'placeholder' => __( 'https://your-link.com', 'poco' ),
						'type'        => Controls_Manager::URL,
					],

				],
				'title_field' => '{{{ testimonial_name }}}',
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'testimonial_image',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
				'default'   => 'full',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'   => __( 'Columns', 'poco' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 1,
				'options' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6 ],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'poco' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();


		// WRAPPER STYLE
		$this->start_controls_section(
			'section_style_testimonial_wrapper',
			[
				'label' => __( 'Wrapper', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_responsive_control(
			'padding_estimonial_wrapper',
			[
				'label'      => __( 'Padding', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_testimonial_wrapper',
			[
				'label'      => __( 'Margin', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'color_testimonial_wrapper',
			[
				'label'     => __( 'Background Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'wrapper_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .item-box',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'wrapper_radius',
			[
				'label'      => __( 'Border Radius', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .item-box',
			]
		);

		$this->end_controls_section();

		// Content style
		$this->start_controls_section(
			'section_style_testimonial_style',
			[
				'label' => __( 'Content', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_content_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_content_color_hover',
			[
				'label'     => __( 'Color Hover', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .content',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'     => __( 'Spacing', 'poco' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .content' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'section_style_testimonial_image',
			[
				'label' => __( 'Image', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .elementor-testimonial-image img',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => __( 'Margin', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'section_style_testimonial_name',
			[
				'label' => __( 'Name', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .name, {{WRAPPER}} .name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_text_color_hover',
			[
				'label'     => __( 'Color Hover', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box .name:hover, {{WRAPPER}} .item-box .name a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this -> add_control(
		    'color-decor',
            [
                'label'     => __( 'Color Decor', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box .name:before, {{WRAPPER}} .item-box .name:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'name_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .name',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'name_padding',
			[
				'label'      => __( 'Padding', 'poco' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Job.
		$this->start_controls_section(
			'section_style_testimonial_job',
			[
				'label' => __( 'Job', 'poco' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_text_color',
			[
				'label'     => __( 'Color', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'job_text_color_hover',
			[
				'label'     => __( 'Color Hover', 'poco' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-box:hover .job' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'selector' => '{{WRAPPER}} .job',
			]
		);

		$this->end_controls_section();

		// Carousel options
		$this->add_control_carousel();

	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$testimonial_style = $settings['testimonial_style'];

		if ( ! empty( $settings['testimonials'] ) && is_array( $settings['testimonials'] ) ) {

			$this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-item-wrapper' );
			$this->add_render_attribute( 'wrapper', 'class', esc_attr($testimonial_style));

			// Row
			$this->add_render_attribute( 'row', 'class', 'row' );

			// Carousel
			if ( $settings['enable_carousel'] === 'yes' ) {

				$this->add_render_attribute( 'row', 'class', 'poco-carousel' );
				$carousel_settings = $this->get_carousel_settings();
				$this->add_render_attribute( 'row', 'data-settings', wp_json_encode( $carousel_settings ) );

			} else {

				$this->add_render_attribute( 'row', 'data-elementor-columns', $settings['column'] );
				if ( ! empty( $settings['column_tablet'] ) ) {
					$this->add_render_attribute( 'row', 'data-elementor-columns-tablet', $settings['column_tablet'] );
				}
				if ( ! empty( $settings['column_mobile'] ) ) {
					$this->add_render_attribute( 'row', 'data-elementor-columns-mobile', $settings['column_mobile'] );
				}

			}

			// Item
			$this->add_render_attribute( 'item', 'class', 'column-item elementor-testimonial-item' );


			?>
            <div <?php echo poco_elementor_get_render_attribute_string( 'wrapper', $this ); // WPCS: XSS ok. ?>>
                <div <?php echo poco_elementor_get_render_attribute_string( 'row', $this ); // WPCS: XSS ok. ?>>
					<?php foreach ( $settings['testimonials'] as $testimonial ): ?>
                        <div <?php echo poco_elementor_get_render_attribute_string( 'item', $this ); // WPCS: XSS ok. ?>>
                            <div class="item-box">

                                <div class="top">
                                    <div class="details">
                                        <div class="avatar">
                                            <?php $this->render_image( $settings, $testimonial ); ?>
                                        </div>
                                        <?php if ($testimonial_style == 'style1'):?>
                                            <div class="info">
                                                <?php
                                                $testimonial_name_html = $testimonial['testimonial_name'];
                                                if ( ! empty( $testimonial['testimonial_link']['url'] ) ) :
                                                    $testimonial_name_html = '<a href="' . esc_url( $testimonial['testimonial_link']['url'] ) . '">' . esc_html( $testimonial_name_html ) . '</a>';
                                                endif;
                                                printf('<div class="name">%s</div>', $testimonial_name_html);
                                                ?>
                                                <div class="job"><?php echo esc_html( $testimonial['testimonial_job'] ); ?></div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <?php
                                    if ($testimonial['testimonial_rating'] && $testimonial['testimonial_rating'] > 0) {
                                        echo '<div class="elementor-testimonial-rating">';
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $testimonial['testimonial_rating']) {
                                                echo '<i class="fa fa-star active" aria-hidden="true"></i>';
                                            } else {
                                                echo '<i class="winwood-icon- poco-icon-star" aria-hidden="true"></i>';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>

                                <?php if (!empty($testimonial['testimonial_content'])) :?>
                                    <div class="content">
                                        <?php echo sprintf('%s', $testimonial['testimonial_content'] ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($testimonial_style == 'style2'):?>
                                    <div class="info">
                                        <?php
                                        $testimonial_name_html = $testimonial['testimonial_name'];
                                        if ( ! empty( $testimonial['testimonial_link']['url'] ) ) :
                                            $testimonial_name_html = '<a href="' . esc_url( $testimonial['testimonial_link']['url'] ) . '">' . esc_html( $testimonial_name_html ) . '</a>';
                                        endif;
                                        printf('<div class="name">%s</div>', $testimonial_name_html);
                                        ?>
                                        <div class="job"><?php echo esc_html( $testimonial['testimonial_job'] ); ?></div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
			<?php
		}
	}

	private function render_image( $settings, $testimonial ) {
		if ( ! empty( $testimonial['testimonial_image']['url'] ) ) :
			?>
            <div class="elementor-testimonial-image">
				<?php
				$testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
				$testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
				echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'testimonial_image' );
				?>
                <i aria-hidden="true" class="fas fa-quote-left"></i>
            </div>
		<?php
		endif;
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

        $this->add_control(
            'color_button',
            [
                'label' => __( 'Color button', 'poco' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'button_color_normal',
            [
                'label' => __( 'Color normal', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:before, .slick-next:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color active', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover:before, .slick-prev:focus:before, .slick-next:hover:before, .slick-next:focus:before' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label'      => __( 'Carousel Dots', 'poco' ),
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
                            'value'    => 'both',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_carousel_dots_normal',
            [
                'label' => esc_html__('Normal', 'poco'),
            ]
        );

        $this->add_control(
            'carousel_dots_color',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label'     => esc_html__('Opacity', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_hover',
            [
                'label' => esc_html__('Hover', 'poco'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_activate',
            [
                'label' => esc_html__('Activate', 'poco'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_activate',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label'     => esc_html__('Opacity', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label'     => esc_html__('Spacing', 'poco'),
                'type'       => Controls_Manager::SLIDER,
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
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
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
			'autoplaySpeed'      => $settings['autoplay_speed'],
			'items'              => $settings['column'],
			'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
			'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
			'loop'               => $settings['infinite'] === 'yes' ? true : false,
			'rtl'                => is_rtl() ? true : false,
		);
	}

}

$widgets_manager->register_widget_type( new Poco_Elementor_Testimonials() );


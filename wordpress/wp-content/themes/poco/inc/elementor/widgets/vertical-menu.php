<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class OSF_Elementor_Vertical_Menu extends Elementor\Widget_Base{

    public function get_name()
    {
        return 'poco-vertical-menu';
    }

    public function get_title()
    {
        return esc_html__('Poco Menu Canvas', 'poco');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_categories()
    {
        return ['opal-addons'];
    }

    protected function _register_controls()
    {
        $this -> start_controls_section(
            'icon-menu_style',
            [
                'label' => esc_html__('Icon','poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_menu_size',
            [
                'label'     => __( 'Size Icon', 'poco' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color',
            [
                'label'     => __( 'Color', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color_hover',
            [
                'label'     => __( 'Color Hover', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this -> start_controls_section(
            'content-menu_style',
            [
                'label' => esc_html__('Content','poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_menu_canvas',
            [
                'label'     => esc_html__( 'Color ', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .mobile-navigation ul li a' => 'color: {{VALUE}};',
                    'body .mobile-navigation .dropdown-toggle' => 'color: {{VALUE}};',
                    'body .poco-mobile-nav .poco-social ul li a:before' => 'color: {{VALUE}};',
                    'body .mobile-nav-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color-menu-canvas-active',
            [
                'label'     => esc_html__( 'Color Active ', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body ul.menu li.current-menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color-menu-canvas-border',
            [
                'label'     => esc_html__( 'Color Border ', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .mobile-navigation ul li' => 'border-color: {{VALUE}};',
                    'body .poco-mobile-nav .poco-social' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background-menu-canvas',
            [
                'label'     => esc_html__( 'Background ', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'body .poco-mobile-nav' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-vertical-menu-wrapper' );
        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this);?>>
            <?php poco_mobile_nav_button(); ?>
        </div>
        <?php
    }

}
$widgets_manager->register_widget_type(new OSF_Elementor_Vertical_Menu());
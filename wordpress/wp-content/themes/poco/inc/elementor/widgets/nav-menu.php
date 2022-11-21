<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class OSF_Elementor_Nav_Menu extends Elementor\Widget_Base{

    public function get_name()
    {
        return 'poco-nav-menu';
    }

    public function get_title()
    {
        return esc_html__('Poco Nav Menu', 'poco');
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
            'nav-menu_style',
            [
                'label' => esc_html__('Menu','poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this -> add_responsive_control(
            'nav_menu_aligrment',
            [
                'label'       => esc_html__( 'Alignment', 'poco' ),
                'type'        => Controls_Manager::CHOOSE,
                'default'     => 'center',
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'poco' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'poco' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'poco' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}} .main-navigation' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'nav_menu_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul.menu li.menu-item a',
            ]
        );

        $this->start_controls_tabs( 'tabs_nav_menu_style' );

        $this->start_controls_tab(
            'tab_nav_menu_normal',
            [
                'label' =>  esc_html__( 'Normal', 'poco' ),
            ]
        );
        $this->add_control(
            'menu_title_color',
            [
                'label'     => __( 'Color', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item a:not(:hover)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_menu_color',
            [
                'label'     => __( 'Background Dropdown', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_nav_menu_hover',
            [
                'label' =>  esc_html__( 'Hover', 'poco' ),
            ]
        );
        $this->add_control(
            'menu_title_color_hover',
            [
                'label'     => __( 'Color', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_color_hover',
            [
                'label'     => __( 'Background Item', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item:hover > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_nav_menu_action',
            [
                'label' =>  esc_html__( 'Active', 'poco' ),
            ]
        );
        $this->add_control(
            'menu_title_color_action',
            [
                'label'     => __( 'Color', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item.current-menu-parent > a:not(:hover)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item.current-menu-item > a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_color_action',
            [
                'label'     => __( 'Background Item', 'poco' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item.current-menu-item > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-nav-menu-wrapper' );
        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this);?>>
            <?php poco_primary_navigation(); ?>
        </div>
        <?php
    }

}
$widgets_manager->register_widget_type(new OSF_Elementor_Nav_Menu());
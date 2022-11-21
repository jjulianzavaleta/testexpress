<?php

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use ElementorPro\Base\Base_Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Poco_Call_To_Action extends Elementor\Widget_Base {

    public function get_name() {
        return 'poco-banner';
    }

    public function get_title() {
        return __( 'Poco Banner', 'poco' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }



    protected function _register_controls() {

        $this->start_controls_section(
            'section_main_image',
            [
                'label' => __( 'Image', 'poco' ),
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Choose Image', 'poco' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image', // Actually its `image_size`
                'label' => __( 'Image Resolution', 'poco' ),
                'default' => 'large',
                'condition' => [
                    'bg_image[id]!' => '',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'poco' ),
            ]
        );

        $this->add_control(
            'graphic_element',
            [
                'label' => __( 'Graphic Element', 'poco' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'poco' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'poco' ),
                        'icon' => 'fa fa-picture-o',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'poco' ),
                        'icon' => 'eicon-star',
                    ],
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'graphic_image',
            [
                'label' => __( 'Choose Image', 'poco' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'graphic_image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'poco' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_view',
            [
                'label' => __( 'View', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'poco' ),
                    'stacked' => __( 'Stacked', 'poco' ),
                    'framed' => __( 'Framed', 'poco' ),
                ],
                'default' => 'default',
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_shape',
            [
                'label' => __( 'Shape', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'poco' ),
                    'square' => __( 'Square', 'poco' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'icon_view!' => 'default',
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Sub title', 'poco' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the sub title', 'poco' ),
                'placeholder' => __( 'Enter your sub title', 'poco' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title & Description', 'poco' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the heading', 'poco' ),
                'placeholder' => __( 'Enter your title', 'poco' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'poco' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'poco' ),
                'placeholder' => __( 'Enter your description', 'poco' ),
                'separator' => 'none',
                'rows' => 5,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'h2',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'button',
            [
                'label' => __( 'Button Text', 'poco' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Click Here', 'poco' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'poco' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'poco' ),

            ]
        );

        $this->add_control(
            'link_click',
            [
                'label' => __( 'Apply Link On', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => __( 'Whole Box', 'poco' ),
                    'button' => __( 'Button Only', 'poco' ),
                ],
                'default' => 'button',
                'separator' => 'none',
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'poco' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content-stretch',
            [
                'label' => __( 'Stretch', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'  => 'content-stretch-'
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label' => __( 'Height', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'vh'],
                'condition' => [
                      'content-stretch' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'poco' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'poco' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'poco' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'poco' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'vertical_position',
            [
                'label' => __( 'Vertical Position', 'poco' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'poco' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'poco' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'poco' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-cta--valign-',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => __( 'Border Radius', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'graphic_element_style',
            [
                'label' => __( 'Graphic Element', 'poco' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'graphic_element!' => [
                        'none',
                        '',
                    ],
                ],
            ]
        );

        $this->add_control(
            'graphic_image_hover',
            [
                'label' => __( 'Image Effect', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'  => 'graphic-image-effect-',
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_spacing',
            [
                'label' => __( 'Spacing', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_width',
            [
                'label' => __( 'Size', 'poco' ) . ' (%)',
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'graphic_image_border',
                'selector' => '{{WRAPPER}} .elementor-cta__image img',
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'graphic_image_border_radius',
            [
                'label' => __( 'Border Radius', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_spacing',
            [
                'label' => __( 'Spacing', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_primary_color',
            [
                'label' => __( 'Primary Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_secondary_color',
            [
                'label' => __( 'Secondary Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-framed .elementor-icon svg' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __( 'Icon Padding', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label' => __( 'Border Width', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', 'poco' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'title',
                            'operator' => '!==',
                            'value' => '',
                        ],
                        [
                            'name' => 'description',
                            'operator' => '!==',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );



        $this->add_control(
            'heading_style_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'poco' ),
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Spacing', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',

                ],
                'default'   => [
                    'size'  => 15,
                    'unit'  => 'px'
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_style_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'poco' ),
                'separator' => 'before',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subtitle_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__subtitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Spacing', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default'   => [
                    'size'  => 15,
                    'unit'  => 'px'
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );



        $this->add_control(
            'heading_style_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'poco' ),
                'separator' => 'before',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementor-cta__description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta__description',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Spacing', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default'   => [
                        'size'  => 15,
                        'unit'  => 'px'
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );



        $this->add_control(
            'heading_content_colors',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Colors', 'poco' ),
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'color_tabs' );

        $this->start_controls_tab( 'colors_normal',
            [
                'label' => __( 'Normal', 'poco' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Sub title Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'colors_hover',
            [
                'label' => __( 'Hover', 'poco' ),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Title Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => __( 'Sub title Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label' => __( 'Description Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button', 'poco' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-cta__button',
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab( 'button_normal',
            [
                'label' => __( 'Normal', 'poco' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => __( 'Hover', 'poco' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Background Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'button_border_width',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-cta__button',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', 'poco' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hover_effects',
            [
                'label' => __( 'Hover Effects', 'poco' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Content', 'poco' ),
            ]
        );

        $this->add_control(
            'content_animation',
            [
                'label' => __( 'Hover Animation', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'groups' => [
                    [
                        'label' => __( 'None', 'poco' ),
                        'options' => [
                            '' => __( 'None', 'poco' ),
                        ],
                    ],
                    [
                        'label' => __( 'Entrance', 'poco' ),
                        'options' => [
                            'enter-from-right' => 'Slide In Right',
                            'enter-from-left' => 'Slide In Left',
                            'enter-from-top' => 'Slide In Up',
                            'enter-from-bottom' => 'Slide In Down',
                            'enter-zoom-in' => 'Zoom In',
                            'enter-zoom-out' => 'Zoom Out',
                            'fade-in' => 'Fade In',
                        ],
                    ],
                    [
                        'label' => __( 'Reaction', 'poco' ),
                        'options' => [
                            'grow' => 'Grow',
                            'shrink' => 'Shrink',
                            'move-right' => 'Move Right',
                            'move-left' => 'Move Left',
                            'move-up' => 'Move Up 1',
                            'move-up-2' => 'Move Up 2',
                            'move-down' => 'Move Down',
                        ],
                    ],
                    [
                        'label' => __( 'Exit', 'poco' ),
                        'options' => [
                            'exit-to-right' => 'Slide Out Right',
                            'exit-to-left' => 'Slide Out Left',
                            'exit-to-top' => 'Slide Out Up',
                            'exit-to-bottom' => 'Slide Out Down',
                            'exit-zoom-in' => 'Zoom In',
                            'exit-zoom-out' => 'Zoom Out',
                            'fade-out' => 'Fade Out',
                        ],
                    ],
                ],
                'default' => 'grow',
            ]
        );

        /*
         *
         * Add class 'elementor-animated-content' to widget when assigned content animation
         *
         */
        $this->add_control(
            'animation_class',
            [
                'label' => __( 'Animation', 'poco' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'animated-content',
                'prefix_class' => 'elementor-',
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );

        $this->add_control(
            'content_animation_duration',
            [
                'label' => __( 'Animation Duration', 'poco' ) . ' (ms)',
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1000,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content-item' => 'transition-duration: {{SIZE}}ms',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
                    '{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
                ],
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );

        $this->add_control(
            'sequenced_animation',
            [
                'label' => __( 'Sequenced Animation', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'poco' ),
                'label_off' => __( 'Off', 'poco' ),
                'return_value' => 'elementor-cta--sequenced-animation',
                'prefix_class' => '',
                'condition' => [
                    'content_animation!' => '',

                ],
            ]
        );

        $this->add_control(
            'background_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Background', 'poco' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'transformation',
            [
                'label' => __( 'Hover Animation', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => 'None',
                    'zoom-in' => 'Zoom In',
                    'zoom-out' => 'Zoom Out',
                    'move-left-custom' => 'Move Left',
                    'move-right-custom' => 'Move Right',
                ],
                'default' => 'zoom-in',
                'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
            ]
        );

        $this->start_controls_tabs( 'bg_effects_tabs' );

        $this->start_controls_tab( 'normal',
            [
                'label' => __( 'Normal', 'poco' ),
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Overlay Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:not(:hover) .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters',
                'selector' => '{{WRAPPER}} .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label' => __( 'Blend Mode', 'poco' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Normal', 'poco' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'exclusion' => 'Exclusion',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => __( 'Hover', 'poco' ),
            ]
        );

        $this->add_control(
            'overlay_color_hover',
            [
                'label' => __( 'Overlay Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'bg_filters_hover',
                'selector' => '{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'effect_duration',
            [
                'label' => __( 'Transition Duration', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 1500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta .elementor-cta__bg, {{WRAPPER}} .elementor-cta .elementor-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_tag = $settings['title_tag'];
        $wrapper_tag = 'div';
        $button_tag = 'a';
        $bg_image = '';
        $content_animation = $settings['content_animation'];
        $animation_class = '';
        $print_bg = true;
        $print_content = true;

        if ( ! empty( $settings['bg_image']['id'] ) ) {
            $bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
        } elseif ( ! empty( $settings['bg_image']['url'] ) ) {
            $bg_image = $settings['bg_image']['url'];
        }

        if ( empty( $bg_image ) ) {
            $print_bg = false;
        }

        if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
            $print_content = false;
        }

        $this->add_render_attribute( 'background_image', 'style', [
            'background-image: url(' . $bg_image . ');',
        ] );

        $this->add_render_attribute( 'title', 'class', [
            'elementor-cta__title',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'subtitle', 'class', [
            'elementor-cta__subtitle',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'description', 'class', [
            'elementor-cta__description',
            'elementor-cta__content-item',
            'elementor-content-item',
        ] );

        $this->add_render_attribute( 'button', 'class', [
            'elementor-cta__button',
            'elementor-button-custom',
        ] );

        $this->add_render_attribute( 'graphic_element', 'class',
            [
                'elementor-content-item',
                'elementor-cta__content-item',
            ]
        );

        if ( 'icon' === $settings['graphic_element'] ) {
            $this->add_render_attribute( 'graphic_element', 'class',
                [
                    'elementor-icon-wrapper',
                    'elementor-cta__icon',
                ]
            );
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-view-' . $settings['icon_view'] );
            if ( 'default' != $settings['icon_view'] ) {
                $this->add_render_attribute( 'graphic_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
            }

            if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fa fa-star';
            }

            if ( ! empty( $settings['icon'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
            }
        } elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
            $this->add_render_attribute( 'graphic_element', 'class', 'elementor-cta__image' );
        }

        if ( ! empty( $content_animation ) ) {

            $animation_class = 'elementor-animated-item--' . $content_animation;

            $this->add_render_attribute( 'title', 'class', $animation_class );

            $this->add_render_attribute( 'graphic_element', 'class', $animation_class );

            $this->add_render_attribute( 'subtitle', 'class', $animation_class );

            $this->add_render_attribute( 'description', 'class', $animation_class );

        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $link_element = 'button';

            if ( 'box' === $settings['link_click'] ) {
                $wrapper_tag = 'a';
                $button_tag = 'span';
                $link_element = 'wrapper';
            }

            $this->add_link_attributes( $link_element, $settings['link'] );
        }

        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'description' );
        $this->add_inline_editing_attributes( 'button' );

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
        <<?php echo esc_html($wrapper_tag) . ' ' . poco_elementor_get_render_attribute_string( 'wrapper', $this ); ?> class="elementor-cta--skin-cover elementor-cta elementor-poco-banner">
        <?php if ( $print_bg ) : ?>
            <div class="elementor-cta__bg-wrapper">
                <div class="elementor-cta__bg elementor-bg" <?php echo poco_elementor_get_render_attribute_string( 'background_image', $this ); ?>></div>
                <div class="elementor-cta__bg-overlay"></div>
            </div>
        <?php endif; ?>
        <?php if ( $print_content ) : ?>
            <div class="elementor-cta__content">
            <?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                <div <?php echo poco_elementor_get_render_attribute_string( 'graphic_element', $this ); ?>>
                    <img src="<?php echo esc_attr($settings['graphic_image']['url']);?>" alt="image_baner">
                    <div class="image-behind">
                        <img src="<?php echo esc_attr($settings['graphic_image_2']['url']);?>" alt="image_baner">
                    </div>
                </div>
            <?php elseif ( 'icon' === $settings['graphic_element'] && ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) : ?>
                <div <?php echo poco_elementor_get_render_attribute_string( 'graphic_element', $this ); ?>>
                    <div class="elementor-icon">
                        <?php if ( $is_new || $migrated ) :
                            Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        else : ?>
                            <i <?php echo poco_elementor_get_render_attribute_string( 'icon', $this ); ?>></i>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>



            <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                <div <?php echo poco_elementor_get_render_attribute_string( 'subtitle', $this ); ?>>
                    <?php printf('%s', $settings['subtitle']); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['title'] ) ) : ?>
                <<?php echo esc_html($title_tag) . ' ' . poco_elementor_get_render_attribute_string( 'title', $this ); ?>>
                <?php printf('%s', $settings['title']); ?>
                </<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>

            <?php if ( ! empty( $settings['description'] ) ) : ?>
                <div <?php echo poco_elementor_get_render_attribute_string( 'description', $this ); ?>>
                    <?php printf('%s', $settings['description']); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['button'] ) ) : ?>
            <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item <?php echo esc_attr($animation_class); ?>">
                <<?php echo esc_html($button_tag) . ' ' . poco_elementor_get_render_attribute_string( 'button', $this ); ?>>
                <span>
                    <?php echo esc_html($settings['button']); ?>
                </span>
                </<?php echo esc_html($button_tag); ?>>
                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>

        </<?php echo esc_html($wrapper_tag); ?>>
        <?php
    }

    /**
     * Render Call to Action widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
}

$widgets_manager->register_widget_type(new Poco_Call_To_Action());

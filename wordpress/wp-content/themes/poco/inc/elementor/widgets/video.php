<?php

use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Video_Popup extends Elementor\Widget_Base {

    public function get_name() {
        return 'poco-video-popup';
    }

    public function get_title() {
        return __('Poco Video', 'poco');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['poco-elementor-video', 'magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => __('General', 'poco'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label'       => __('Link to', 'poco'),
                'type'        => Controls_Manager::TEXT,
                'description' => __('Support video from Youtube and Vimeo', 'poco'),
                'placeholder' => __('https://your-link.com', 'poco'),
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => __('Icon', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => __('Font Size', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_video_style');

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => __('Normal', 'poco'),
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label'     => __('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icons i:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_bgcolor',
            [
                'label'     => __('Background Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icons i' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => __('Hover', 'poco'),
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label'     => __('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-icons i:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_bgcolor',
            [
                'label'     => __('Background Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-icons i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['video_link'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-video-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'opal-video-popup');

        $this->add_render_attribute('button', 'class', 'elementor-video-popup');
        $this->add_render_attribute('button', 'role', 'button');
        $this->add_render_attribute('button', 'href', esc_url($settings['video_link']));
        $this->add_render_attribute('button', 'data-effect', 'mfp-zoom-in');

        $contentHtml = '<i class="icon"></i>';


        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <a <?php echo poco_elementor_get_render_attribute_string('button', $this); ?>>
                <?php printf(' <span class="elementor-video-icons">%s</span>', $contentHtml) ?>
            </a>
        </div>
        <?php
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Video_Popup());

<?php

//namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Control_Media;

class Poco_Elementor_Timeline extends Elementor\Widget_Base {

    public function get_name() {
        return 'poco-timeline';
    }

    public function get_title() {
        return __('Poco Timeline', 'poco');
    }

    public function get_categories() {
        return array('poco-addons');
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'poco'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number_year',
            [
                'label'       => __('Year', 'poco'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Year...', 'poco'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title & Content', 'poco'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Timeline Title', 'poco'),
                'label_block' => true,
            ]


        );
        $repeater->add_control(
            'content',

            [
                'label'      => __('Content', 'poco'),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __('Timeline Content', 'poco'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => __('Choose Image', 'poco'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label'       => __('Timeline Items', 'poco'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'number_year' => __('1960', 'poco'),
                        'title'       => __('Timeline #1', 'poco'),
                        'content'     => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'poco'),
                        'image'       => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'number_year' => __('1961', 'poco'),
                        'title'       => __('Timeline #2', 'poco'),
                        'content'     => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'poco'),
                        'image'       => Utils::get_placeholder_image_src(),

                    ],
                    [
                        'number_year' => __('1962', 'poco'),
                        'title'       => __('Timeline #3', 'poco'),
                        'content'     => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'poco'),
                        'image'       => Utils::get_placeholder_image_src(),
                    ],
                ],
                'title_field' => '{{{ title }}}',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'number_style',
            [
                'label' => __('Years', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'number_color',
            [
                'label'     => __('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .number-wrap'              => 'color: {{VALUE}};',
                    '{{WRAPPER}} .number-wrap .line'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .number-wrap .line:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .item:before'              => 'background-color: {{VALUE}};',
                ],

            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'selector' => '{{WRAPPER}} .number-wrap',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title',
            [
                'label'     => __('Title', 'poco'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );
        $this->add_responsive_control(
            'title_spacing_item',
            [
                'label'      => __('Spacing', 'poco'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );
        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="elementor-timeline-wrapper">
            <?php foreach ($settings['timeline_list'] as $item): ?>
                <div class="item">
                    <div class="thumbnail">
                        <?php
                        echo Group_Control_Image_Size::get_attachment_image_html($item);
                        ?>
                    </div>
                    <div class="content-wrap">
                        <div class="inner">
                            <div class="thumbnail-mobile">
                                <?php
                                echo Group_Control_Image_Size::get_attachment_image_html($item);
                                ?>
                            </div>
                            <div class="number-wrap">
                                <div class="inner">
                                    <span class="line"></span>
                                    <span class="number"><?php echo esc_html($item['number_year']) ?></span>
                                </div>
                            </div>
                            <div class="content">
                                <?php printf('<h3 class="title">%s</h3><div class="description">%s</div>', $item['title'], $item['content']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new Poco_Elementor_Timeline());

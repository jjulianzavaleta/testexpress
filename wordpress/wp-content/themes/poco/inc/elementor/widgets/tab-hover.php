<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Poco_Elementor_Widget_Tabs_Hover extends Widget_Base {

    public function get_name() {
        return 'poco-tab-hover';
    }


    public function get_title() {
        return esc_html__('Poco Tab Hover', 'poco');
    }


    public function get_icon() {
        return 'eicon-tabs';
    }


    public function get_categories() {
        return ['poco-addons'];
    }

    public function get_script_depends() {
        return ['poco-elementor-tab-hover', 'slick'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab_hover',
            [
                'label' => __('Tab Hover', 'poco'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_tab_title',
            [
                'label'   => __('Tab title', 'poco'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Tab title'
            ]
        );

        $repeater->add_control(
            'item_tab_content_heading',
            [
                'label' => __('Content', 'poco'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $repeater->add_control(
            'item_content_image',
            [
                'label'   => __('Image', 'poco'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'item_content_title',
            [
                'label'   => __('Title', 'poco'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Testimonial title',
            ]
        );

        $repeater->add_control(
            'item_content_description',
            [
                'label'       => __('Description', 'poco'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label'      => __('Button Text', 'poco'),
                'type'       => Controls_Manager::TEXT,
                'default'    => 'view collection',
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label'       => __('Link to', 'poco'),
                'placeholder' => __('https://your-link.com', 'poco'),
                'type'        => Controls_Manager::URL,
                'default'     => [
                    'url' => '#'
                ],
                'condition'   => [
                    'button_text!' => ''
                ]
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => __('Items', 'poco'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ item_tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_title_style',
            [
                'label' => __('Tab title', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_title_spacing',
            [
                'label'      => esc_html__('Spacing', 'poco'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'max' => 50,
                        'min' => 0,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tab-item' => 'margin: {{SIZE}}{{UNIT}} 0',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_title_typography',
                'selector' => '{{WRAPPER}} .tab-item',
            ]
        );

        $this->add_control(
            'tabs_title_line_color',
            [
                'label'     => esc_html__('Line Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item .number:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_title_color_tabs');

        $this->start_controls_tab(
            'tabs_title_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'poco'),
            ]
        );

        $this->add_control(
            'tabs_title_color_normal',
            [
                'label'     => esc_html__('Title Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_title_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'poco'),
            ]
        );

        $this->add_control(
            'tabs_title_color_hover',
            [
                'label'     => esc_html__('Title Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item:hover, {{WRAPPER}} .tab-item.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_content_style',
            [
                'label' => __('Tab content', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tabs_content_title_heading',
            [
                'label' => esc_html__('Title', 'poco'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_content_title_typography',
                'selector' => '{{WRAPPER}} .tab-content .title',
            ]
        );

        $this->add_control(
            'tab_content_title_color',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_content_title_spacing',
            [
                'label'      => esc_html__('Spacing', 'poco'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'max' => 150,
                        'min' => 0,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tab-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'tabs_content_description_heading',
            [
                'label' => esc_html__('Description', 'poco'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_content_description_typography',
                'selector' => '{{WRAPPER}} .tab-content .description',
            ]
        );

        $this->add_control(
            'tab_content_description_color',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_content_description_spacing',
            [
                'label'      => esc_html__('Spacing', 'poco'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'max' => 150,
                        'min' => 0,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tab-content .description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $carousel_settings = array(
            'navigation'         => 'dots',
            'autoplayHoverPause' => true,
            'autoplay'           => true,
            'items'              => 1,
            'items_tablet'       => 1,
            'items_mobile'       => 1,
            'loop'               => true,
            'rtl'                => is_rtl() ? true : false,
        );

        $this->add_render_attribute('tab-content', [
            'class'         => 'tab-content',
            'data-settings' => wp_json_encode($carousel_settings)
        ]);

        ?>
        <div class="wrapper">
            <div class="tab-title">
                <?php
                $count = 1;
                foreach ($settings['items'] as $index => $items):
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                    $this->add_render_attribute($tab_title_setting_key, [
                        'data-setting-key' => 'tab-hover-content-' . $count,
                        'class'            => 'tab-item'
                    ]);
                    ?>
                    <div <?php echo poco_elementor_get_render_attribute_string($tab_title_setting_key, $this); ?>>
                        <div class="number"><span><?php echo sprintf("%02d", $count); ?></span></div>
                        <?php printf('<div class="title">%s</div>', $items['item_tab_title']); ?>
                    </div>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </div>

            <div <?php echo poco_elementor_get_render_attribute_string('tab-content', $this); ?>>
                <?php
                $count = 1;
                foreach ($settings['items'] as $index => $items):
                    $tab_content_setting_key = $this->get_repeater_setting_key('content', 'tabs', $index);
                    $this->add_render_attribute($tab_content_setting_key, [
                        'id'    => 'tab-hover-content-' . $count,
                        'class' => 'tab-content-item'
                    ]);
                    ?>
                    <div <?php echo poco_elementor_get_render_attribute_string($tab_content_setting_key, $this); ?>>
                        <?php if ($items['item_content_image']['url']): ?>
                            <div class="image">
                                <img src="<?php echo esc_url($items['item_content_image']['url']); ?>" alt="<?php the_title() ?>">
                            </div>
                        <?php endif; ?>

                        <div class="content">
                            <?php if ($items['item_content_title']): ?>
                                <?php printf('<div class="title">%s</div>', $items['item_content_title']); ?>
                            <?php endif; ?>

                            <?php if ($items['item_content_description']): ?>
                                <?php printf('<div class="description">%s</div>', $items['item_content_description']); ?>
                            <?php endif; ?>

                            <?php if ($items['button_text']): ?>
                                <a href="<?php echo esc_url($items['button_link']['url']); ?>" class="link"><span><?php echo esc_html($items['button_text']); ?>
                                        <i class="poco-icon-arrow"></i></span></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

}

$widgets_manager->register_widget_type(new Poco_Elementor_Widget_Tabs_Hover());

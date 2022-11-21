<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Box_Shadow;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

class Poco_Elementor_Team_Box extends Elementor\Widget_Base {

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
        return 'poco-team-box';
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
        return esc_html__('Team Box', 'poco');
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
        return 'eicon-person';
    }

    public function get_categories() {
        return array('poco-addons');
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
            'section_team',
            [
                'label' => esc_html__('Team', 'poco'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'poco'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'teams',
            [
                'label' => esc_html__('Team Item', 'poco'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'      => esc_html__('Choose Image', 'poco'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'name',
            [
                'label'   => esc_html__('Name', 'poco'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'job',
            [
                'label'   => esc_html__('Job', 'poco'),
                'default' => 'Designer',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'poco'),
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore ',
                'type'    => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__('Link to', 'poco'),
                'placeholder' => esc_html__('https://your-link.com', 'poco'),
                'type'        => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'facebook',
            [
                'label'       => esc_html__('Facebook', 'poco'),
                'placeholder' => esc_html__('https://www.facebook.com/opalwordpress', 'poco'),
                'default'     => 'https://www.facebook.com/opalwordpress',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label'       => esc_html__('Twitter', 'poco'),
                'placeholder' => esc_html__('https://twitter.com/opalwordpress', 'poco'),
                'default'     => 'https://twitter.com/opalwordpress',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'youtube',
            [
                'label'       => esc_html__('Youtube', 'poco'),
                'placeholder' => esc_html__('https://www.youtube.com/user/WPOpalTheme', 'poco'),
                'default'     => 'https://www.youtube.com/user/WPOpalTheme',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'google',
            [
                'label'       => esc_html__('Google', 'poco'),
                'placeholder' => esc_html__('https://plus.google.com/u/0/+WPOpal', 'poco'),
                'default'     => 'https://plus.google.com/u/0/+WPOpal',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $this->add_responsive_control(
            'team_align',
            [
                'label'        => esc_html__('Alignment', 'poco'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'poco'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'poco'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'poco'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-teams-layout-social-',
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Wrapper.
        $this->start_controls_section(
            'section_style_team_wrapper',
            [
                'label' => esc_html__('Wrapper', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding_inner',
            [
                'label'      => esc_html__('Padding', 'poco'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'poco'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_team_image',
            [
                'label' => esc_html__('Image', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .team-image img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'poco'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-image img'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-image:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'poco'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'poco'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_team_name',
            [
                'label' => esc_html__('Name', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-teams-wrapper .team-name'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-name a:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .elementor-teams-wrapper .team-name:hover'   => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .team-name',
            ]
        );

        $this->add_responsive_control(
            'name_space',
            [
                'label'     => esc_html__('Spacing', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_team_job',
            [
                'label' => esc_html__('Job', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => esc_html__('Text Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .team-job',
            ]
        );

        $this->add_responsive_control(
            'job_space',
            [
                'label'     => esc_html__('Padding', 'poco'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Description
        $this->start_controls_section(
            'section_style_team_text-description',
            [
                'label' => esc_html__('Description', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text-description_text_color',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text-description_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .team-description',
            ]
        );

        $this->add_responsive_control(
            'text-description_space',
            [
                'label'     => esc_html__('Spacing', 'poco'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-description' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Social.
        $this->start_controls_section(
            'section_style_icon_social',
            [
                'label' => esc_html__('Icon Social', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_icon_social_style');

        $this->start_controls_tab(
            'tab_icon_social_normal',
            [
                'label' => esc_html__('Normal', 'poco'),
            ]
        );

        $this->add_control(
            'color_icon_social',
            [
                'label'   => esc_html__('Color', 'poco'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',

                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-icon-socials li.social a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-teams-wrapper .team-icon-socials a'           => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_social_hover',
            [
                'label' => esc_html__('Hover', 'poco'),
            ]
        );

        $this->add_control(
            'color_icon_social_hover',
            [
                'label'     => esc_html__('Color', 'poco'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .team-icon-socials li.social a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-teams-wrapper .team-icon-socials a:hover'           => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

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

        $this->add_render_attribute('wrapper', 'class', 'elementor-teams-wrapper');

        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok.
        ?>>
            <?php $this->render_style($settings) ?>
        </div>
        <?php
    }

    protected function render_style($settings) {
        $team_name_html = $settings['name'];
        if (!empty($settings['link']['url'])) :
            $team_name_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $team_name_html . '</a>';
        endif;
        ?>
        <div class="team-image">
            <?php
            if (!empty($settings['image']['url'])) :
                echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
            endif;
            ?>
            <div class="team-job"><?php echo esc_html($settings['job']); ?></div>
        </div>

        <div class="info">
            <div class="team-name"><?php printf('%s', $team_name_html) ?></div>

            <div class="team-description"><?php echo sprintf('%s', $settings['description']); ?></div>

            <div class="team-icon-socials">
                <ul>
                    <?php foreach ($this->get_socials() as $key => $social): ?>
                        <?php if (!empty($settings[$key])) : ?>
                            <li class="social">
                                <a href="<?php echo esc_url($settings[$key]) ?>">
                                    <i class="poco-icon-<?php echo esc_attr($social); ?>"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>


        <?php
    }

    private function get_socials() {
        return array(
            'facebook' => 'facebook',
            'twitter'  => 'twitter',
            'youtube'  => 'youtube',
            'google'   => 'google-plus',
        );
    }

}

$widgets_manager->register_widget_type(new Poco_Elementor_Team_Box());

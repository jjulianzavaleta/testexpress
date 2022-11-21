<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;


/**
 * Class OSF_Elementor_Blog
 */
class OSF_Elementor_Post_Grid extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'poco-post-grid';
    }

    public function get_title()
    {
        return esc_html__('Posts Grid', 'poco');
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
    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return array('poco-addons');
    }

    public function get_script_depends()
    {
        return ['poco-elementor-posts-grid', 'slick'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Query', 'poco'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'poco'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'poco'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'poco'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date' => esc_html__('Date', 'poco'),
                    'post_title' => esc_html__('Title', 'poco'),
                    'menu_order' => esc_html__('Menu Order', 'poco'),
                    'rand' => __('Random', 'poco'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'poco'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __('ASC', 'poco'),
                    'desc' => __('DESC', 'poco'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => __('Categories', 'poco'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_post_categories(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label' => __('Category Operator', 'poco'),
                'type' => Controls_Manager::SELECT,
                'default' => 'IN',
                'options' => [
                    'AND' => __('AND', 'poco'),
                    'IN' => __('IN', 'poco'),
                    'NOT IN' => __('NOT IN', 'poco'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'poco'),
                'type' => Controls_Manager::HEADING,
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label' => __('Columns', 'poco'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Style', 'poco'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_template_post_type(),
                'default' => 'post-style-1'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_post_top',
                'types' => [ 'classic'],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                ],
                'selector' => '{{WRAPPER}}  .post-style-2 .item-top .content',
                'separator' => 'after'
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __('Spacing', 'poco'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-post-wrapper .row' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .elementor-post-wrapper .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2); margin-bottom: calc({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label' => __('Pagination', 'poco'),
            ]

        );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination', 'poco'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'poco'),
                    'numbers' => __('Numbers', 'poco'),
                    'prev_next' => __('Previous/Next', 'poco'),
                    'numbers_and_prev_next' => __('Numbers', 'poco') . ' + ' . __('Previous/Next', 'poco'),
                ],
            ]
        );

        $this->add_control(
            'pagination_page_limit',
            [
                'label' => __('Page Limit', 'poco'),
                'default' => '5',
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->add_control(
            'pagination_numbers_shorten',
            [
                'label' => __('Shorten', 'poco'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'pagination_type' => [
                        'numbers',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_prev_label',
            [
                'label' => __('Previous Label', 'poco'),
                'default' => __('&laquo; Previous', 'poco'),
                'condition' => [
                    'pagination_type' => [
                        'prev_next',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_next_label',
            [
                'label' => __('Next Label', 'poco'),
                'default' => __('Next &raquo;', 'poco'),
                'condition' => [
                    'pagination_type' => [
                        'prev_next',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
            [
                'label' => __('Alignment', 'poco'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'poco'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'poco'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'poco'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-pagination' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel();

    }

    protected function get_post_categories()
    {
        $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }


    public static function get_query_args($settings)
    {
        $query_args = [
            'post_type' => 'post',
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish', // Hide drafts/private posts for admins
        ];

        if (!empty($settings['categories'])) {
            $categories = array();
            foreach ($settings['categories'] as $category) {
                $cat = get_term_by('slug', $category, 'category');
                if (!is_wp_error($cat) && is_object($cat)) {
                    $categories[] = $cat->term_id;
                }
            }

            if ($settings['cat_operator'] == 'AND') {
                $query_args['category__and'] = $categories;
            } elseif ($settings['cat_operator'] == 'IN') {
                $query_args['category__in'] = $categories;
            } else {
                $query_args['category__not_in'] = $categories;
            }
        }

        $query_args['posts_per_page'] = $settings['posts_per_page'];

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function get_current_page()
    {
        if ('' === $this->get_settings('pagination_type')) {
            return 1;
        }

        return max(1, get_query_var('paged'), get_query_var('page'));
    }

    public function get_posts_nav_link($page_limit = null)
    {
        if (!$page_limit) {
            $page_limit = $this->query_posts()->max_num_pages;
        }

        $return = [];

        $paged = $this->get_current_page();

        $link_template = '<a class="page-numbers %s" href="%s">%s</a>';
        $disabled_template = '<span class="page-numbers %s">%s</span>';

        if ($paged > 1) {
            $next_page = intval($paged) - 1;
            if ($next_page < 1) {
                $next_page = 1;
            }

            $return['prev'] = sprintf($link_template, 'prev', get_pagenum_link($next_page), $this->get_settings('pagination_prev_label'));
        } else {
            $return['prev'] = sprintf($disabled_template, 'prev', $this->get_settings('pagination_prev_label'));
        }

        $next_page = intval($paged) + 1;

        if ($next_page <= $page_limit) {
            $return['next'] = sprintf($link_template, 'next', get_pagenum_link($next_page), $this->get_settings('pagination_next_label'));
        } else {
            $return['next'] = sprintf($disabled_template, 'next', $this->get_settings('pagination_next_label'));
        }

        return $return;
    }

    protected function render_loop_footer()
    {

        $parent_settings = $this->get_settings();
        if ('' === $parent_settings['pagination_type']) {
            return;
        }

        $page_limit = $this->query_posts()->max_num_pages;
        if ('' !== $parent_settings['pagination_page_limit']) {
            $page_limit = min($parent_settings['pagination_page_limit'], $page_limit);
        }

        if (2 > $page_limit) {
            return;
        }

        $this->add_render_attribute('pagination', 'class', 'elementor-pagination');

        $has_numbers = in_array($parent_settings['pagination_type'], ['numbers', 'numbers_and_prev_next']);
        $has_prev_next = in_array($parent_settings['pagination_type'], ['prev_next', 'numbers_and_prev_next']);

        $links = [];

        if ($has_numbers) {
            $links = paginate_links([
                'type' => 'array',
                'current' => $this->get_current_page(),
                'total' => $page_limit,
                'prev_next' => false,
                'show_all' => 'yes' !== $parent_settings['pagination_numbers_shorten'],
                'before_page_number' => '<span class="elementor-screen-only">' . __('Page', 'poco') . '</span>',
            ]);
        }

        if ($has_prev_next) {
            $prev_next = $this->get_posts_nav_link($page_limit);
            array_unshift($links, $prev_next['prev']);
            $links[] = $prev_next['next'];
        }

        ?>
        <div class="pagination">
            <nav class="elementor-pagination" role="navigation"
                 aria-label="<?php esc_attr_e('Pagination', 'poco'); ?>">
                <?php echo implode(PHP_EOL, $links); ?>
            </nav>
        </div>
        <?php
    }


    public function query_posts()
    {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $query = $this->query_posts();

        if (!$query->found_posts) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-post-wrapper');
        $this->add_render_attribute('wrapper', 'class', $settings['style']);

        $this->add_render_attribute('row', 'class', 'row');

        if ($settings['enable_carousel'] === 'yes'){
            $this->add_render_attribute('row', 'class', 'poco-carousel');
            $carousel_settings = $this->get_carousel_settings();
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        }else {

            if (!empty($settings['column'])) {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns', 1);
            }

            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', 1);
            }

            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
            }
        }
        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok ?>>
            <div <?php echo poco_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok ?>>

                <?php
                global $post;
                $count = 0;

                while ($query->have_posts()) {
                    $query->the_post();
                    $post->loop = $count++;
                    $post->post_count = $query->post_count;

                    get_template_part('template-parts/posts-grid/item', $settings['style']);
                }
                ?>
            </div>

            <?php if ($settings['pagination_type'] && !empty($settings['pagination_type'])): ?>
                <div class="pagination">
                    <?php $this->render_loop_footer(); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php

        wp_reset_postdata();

    }

    private function get_template_post_type()
    {
        $folderes = glob(get_template_directory() . '/template-parts/posts-grid/*');

        $output = array();

        foreach ($folderes as $folder) {
            $folder = str_replace("item-", '', str_replace('.php', '', wp_basename($folder)));
            $value = str_replace('_', ' ', str_replace('-', ' ', ucfirst($folder)));
            $output[$folder] = $value;
        }

        return $output;
    }

    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => __('Carousel Options', 'poco'),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => __('Enable', 'poco'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label'     => __('Navigation', 'poco'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => __('Arrows and Dots', 'poco'),
                    'arrows' => __('Arrows', 'poco'),
                    'dots'   => __('Dots', 'poco'),
                    'none'   => __('None', 'poco'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => __('Pause on Hover', 'poco'),
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
                'label'     => __('Autoplay', 'poco'),
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
                'label'     => __('Autoplay Speed', 'poco'),
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
                'label'     => __('Infinite Loop', 'poco'),
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
                'label'      => __('Carousel Arrows', 'poco'),
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
                'label' => __('Style Arrow', 'poco'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        //add icon next size
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'poco' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
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
                'label' => __( 'Color', 'poco' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'next_heading',
            [
                'label' => __('Next button', 'poco'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => __('Next Vertical', 'poco'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => __('Top', 'poco'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'poco'),
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
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
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
                'label'       => __('Next Horizontal', 'poco'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => __('Left', 'poco'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'poco'),
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
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label' => __('Prev button', 'poco'),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => __('Prev Vertical', 'poco'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => __('Top', 'poco'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'poco'),
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
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
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
                'label'       => __('Prev Horizontal', 'poco'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => __('Left', 'poco'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'poco'),
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
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
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
            'autoplaySpeed'    => $settings['autoplay_speed'],
            'items'              => $settings['column'],
            'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
            'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
            'loop'               => $settings['infinite'] === 'yes' ? true : false,
        );
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Post_Grid());

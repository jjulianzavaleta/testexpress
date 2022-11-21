<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!poco_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

/**
 * Elementor Poco_Elementor_Products_Categories
 * @since 1.0.0
 */
class Poco_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('poco-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'poco-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Product Categories', 'poco');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
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

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __('Settings', 'poco'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'categories_name',
            [
                'label' => __('Alternate Name', 'poco'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'poco'),
                'type'     => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'  => $this->get_product_categories(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'category_image',
            [
                'label'      => __('Choose Image', 'poco'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]

        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tilte_typography',
                'selector' => '{{WRAPPER}} .cat-title',
            ]
        );

        $this->start_controls_tabs('tab_title');
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __('Normal', 'poco'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label' => __('Background', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __('Hover', 'poco'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Hover Color', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title a:hover ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_background_hover',
            [
                'label' => __('Background Hover', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'total_style',
            [
                'label' => __('Total', 'poco'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'total_typography',
                'selector' => '{{WRAPPER}} .cat-total',
            ]
        );

        $this->start_controls_tabs('tab_total');
        $this->start_controls_tab(
            'tab_total_normal',
            [
                'label' => __('Normal', 'poco'),
            ]
        );
        $this->add_control(
            'total_color',
            [
                'label' => __('Color', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_background',
            [
                'label' => __('Background', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-total ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_total_hover',
            [
                'label' => __('Hover', 'poco'),
            ]
        );
        $this->add_control(
            'total_color_hover',
            [
                'label' => __('Color Hover', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_background_hover',
            [
                'label' => __('Background Hover', 'poco'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-total ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
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
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            echo esc_html__('Choose Category', 'poco');
            return;
        }

        $category = get_term_by('slug', $settings['categories'], 'product_cat');
        if (!is_wp_error($category)) {

            if (!empty($settings['category_image']['id'])) {
                $image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
            } else {
                $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_url($thumbnail_id);
                } else {
                    $image = wc_placeholder_img_src();
                }
            }
            ?>

            <div class="product-cat">
                <div class="cat-image">
                    <a class="link_category_product" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                        <img src="<?php echo esc_url_raw($image); ?>" alt="<?php echo esc_html($category->name); ?>">
                    </a>
                    <div class="product-cat-caption">
                        <div class="cat-title">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                                <span class="cats-title-text"><?php echo empty($settings['categories_name']) ? esc_html($category->name) : sprintf('%s', $settings['categories_name']); ?></span>
                            </a>
                            <div class="cat-total"><?php echo esc_html($category->count); ?></div>
                        </div>

                    </div>
                </div>
            </div>
            <?php

        }

    }
}

$widgets_manager->register_widget_type(new Poco_Elementor_Products_Categories());


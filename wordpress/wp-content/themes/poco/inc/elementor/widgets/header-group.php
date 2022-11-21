<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Header_Group extends Elementor\Widget_Base
{

    public function get_name() {
        return 'poco-header-group';
    }

    public function get_title() {
        return __('Poco Header Group', 'poco');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return array('poco-addons');
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'account_config',
            [
                'label' => esc_html__('Config', 'poco'),
            ]
        );

        $this->add_control(
            'style_dark',
            [
                'label' => esc_html__( 'Style Dark', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'after',
                'prefix_class'  => 'style-dark-'
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => esc_html__( 'Show search form', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => esc_html__( 'Show account', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__( 'Show wishlist', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => esc_html__( 'Show cart', 'poco' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this -> add_control(
            'cart_dropdown',
            [
                'condition'  => ['show_cart' => 'yes'],
                'label' => esc_html__('Cart Content', 'poco'),
                'type'  => Controls_Manager::SELECT,
                'separator' => 'after',
                'options'   => [
                    '1' => esc_html__('Cart Canvas', 'poco'),
                    '2' =>  esc_html__('Cart Dropdown', 'poco'),
                ],
                'default'   => '1',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-header-group-wrapper' );
        ?>
        <div <?php echo poco_elementor_get_render_attribute_string('wrapper', $this);?>>
            <div class="header-group-action">
                <?php if ( $settings['show_search'] === 'yes' ):{
                    poco_header_search_button();
                }
                endif; ?>

                <?php if ( $settings['show_account'] === 'yes' ):{
                    poco_header_account();
                }
                endif; ?>

                <?php if ( $settings['show_wishlist'] === 'yes' ):{
                    poco_header_wishlist();
                }
                endif; ?>

                <?php if ( $settings['show_cart'] === 'yes' ):{
                    if ( poco_is_woocommerce_activated() ) {
                        ?>
                        <div class="site-header-cart menu">
                            <?php poco_cart_link(); ?>
                            <?php
                            if ( ! apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() ) ) {
                                if ( $settings['cart_dropdown'] === '1' ) {
                                    wp_enqueue_script( 'poco-cart-canvas' );
                                    add_action( 'wp_footer', 'poco_header_cart_side' );
                                } else {
                                    the_widget( 'WC_Widget_Cart', 'title=' );
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                endif; ?>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Header_Group());
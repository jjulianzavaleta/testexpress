<?php

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Poco_Image_Carousel extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'poco-image-carousel';
    }

    public function get_title()
    {
        return __('Poco Image Carousel', 'poco');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_script_depends() {
        return [ 'poco-elementor-image-carousel', 'slick' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_image_content',
            [
                'label' => __( 'Image', 'poco' ),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Add Images', 'poco' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
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
                    '{{WRAPPER}} .image-wrapper .row' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .image-wrapper .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2); margin-bottom: calc({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .image-wrapper img + img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => __('Columns', 'poco'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => __('Enable', 'poco'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['carousel'] ) ) {
            return;
        }

        $this->add_render_attribute('row', 'class', 'row');

        if ($settings['enable_carousel'] === 'yes'){
            $this->add_render_attribute('row', 'class', 'poco-carousel');
            $carousel_settings = array(
                'items'              => $settings['column'],
                'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
                'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
                'rtl'                => is_rtl() ? true : false,
            );
            $this->add_render_attribute( 'row', 'data-settings', wp_json_encode( $carousel_settings ) );
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

        $item_number = 0;
        $html = '';
        $item_count = count($settings['carousel']);

        foreach ( $settings['carousel'] as $index => $attachment ) {

            if ($item_number%2 == 0){
                $html .= '<div class="column-item">';
                $html .='<img class="image-carousel" src="' . esc_attr( $attachment['url'] ) . '" alt="'.esc_attr($index).'" />';
            }
            else{
                $html .='<img class="image-carousel" src="' . esc_attr( $attachment['url'] ) . '" alt="'.esc_attr($index).'" />';
                $html .='</div>';
            }

            $item_number++;
        }

        if ($item_count%2 == 1){
            $html .= '</div>';
        }

        ?>
     <div class="image-wrapper">
        <div <?php echo poco_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok ?>>
         <?php printf('%s', $html); ?>
        </div>
     </div>
<?php

    }

}

$widgets_manager->register_widget_type(new Poco_Image_Carousel());

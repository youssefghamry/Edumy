<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Woo_Mini_Cart extends Elementor\Widget_Base {

    public function get_name() {
        return 'edumy_woo_mini_cart';
    }

    public function get_title() {
        return esc_html__( 'Apus Header Woo Mini Cart', 'edumy' );
    }
    
    public function get_categories() {
        return [ 'edumy-header-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hide_cart',
            [
                'label' => esc_html__( 'Hide Cart', 'edumy' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'edumy' ),
                'label_off' => esc_html__( 'Show', 'edumy' ),
            ]
        );


        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'edumy' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'edumy' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumy' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumy' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),                
                'type'          => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'dark' => esc_html__('Dark', 'edumy'),
                    'white' => esc_html__('White', 'edumy'),                    
                ),
                'default' => 'white'
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'edumy' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'edumy' ),
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color Count', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wishlist-icon .count,{{WRAPPER}} .mini-cart .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $add_class = '';
        if ( !empty($align) ) {
            $add_class = 'menu-'.$align;
        }
        ?>
        <div class="header-button-woo <?php echo esc_attr($add_class.' '.$el_class.' '.$style); ?>">
            <div class="clearfix">
                <?php
                    global $woocommerce;
                    if ( $hide_cart && is_object($woocommerce) && is_object($woocommerce->cart) ) {
                    ?>
                        <div class="pull-right">
                            <div class="apus-topcart">
                                <div class="cart">
                                    <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" href="#" title="<?php esc_attr_e('View your shopping cart', 'edumy'); ?>">
                                        <i class="flaticon-shopping-bag"></i>                                
                                        <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                        <span class="total-minicart"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="widget_shopping_cart_content">
                                            <?php woocommerce_mini_cart(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>                
            </div>          
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Woo_Mini_Cart );
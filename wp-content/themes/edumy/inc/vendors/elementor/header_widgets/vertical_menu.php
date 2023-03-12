<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Vertical_Menu extends Elementor\Widget_Base {

	public function get_name() {
        return 'edumy_vertical_menu';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Vertical Menu', 'edumy' );
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
            'title',
            [
                'label' => esc_html__( 'Title', 'edumy' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Library'
            ]
        );

        $this->add_responsive_control(
            'show_menu',
            [
                'label' => esc_html__( 'Show menu condition', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'show-always' => esc_html__( 'Always', 'edumy' ),
                    'show-in-home' => esc_html__( 'In home page', 'edumy' ),
                    'show-hover' => esc_html__( 'When hover', 'edumy' ),
                ],
                'default' => 'show-in-home'
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Style 1 - Dark', 'edumy' ),
                    'style2' => esc_html__( 'Style 2 - White', 'edumy' ),    
                    'style3' => esc_html__( 'Style 3 - Black', 'edumy' ),                                    
                ],
                'default' => ''
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
            'bg_title_color',
            [
                'label' => esc_html__( 'Background Color Title', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .vertical-wrapper .title-vertical' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .apus-vertical-menu > li > a > i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .apus-vertical-menu > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .apus-vertical-menu > li:hover > a,{{WRAPPER}} .apus-vertical-menu > li.active > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( has_nav_menu( 'vertical-menu' ) ) { ?>
            <div class="vertical-wrapper <?php echo esc_attr($el_class.' '.$show_menu.' '.$style); ?>">
                <h2 class="title-vertical"><span class="text-title"><?php echo wp_kses_post($title); ?></span> <i class="fa fa-angle-down show-down" aria-hidden="true"></i></h2>
                <?php
                    $args = array(
                        'theme_location' => 'vertical-menu',
                        'container_class' => 'content-vertical',
                        'menu_class' => 'apus-vertical-menu nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'vertical-menu',
                        'walker' => new Edumy_Nav_Menu()
                    );
                    wp_nav_menu($args);
                ?>
            </div>
        <?php
        }
    }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Vertical_Menu );
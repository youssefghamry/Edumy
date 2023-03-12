<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'edumy_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Search Form', 'edumy' );
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
            'placeholder',
            [
                'label'         => esc_html__( 'Input placeholder', 'edumy' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => 'Search for the software or skills you want to learn'
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
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'edumy' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout type', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'edumy' ),
                    'popup' => esc_html__( 'Popup', 'edumy' ),
                ],
                'default' => 'default'
            ]            
        );

        $this->add_responsive_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'edumy' ),
                    'style2' => esc_html__( 'Style 2', 'edumy' ),
                    'style3' => esc_html__( 'Style 3', 'edumy' ),                    
                ],
                'default' => 'style1'
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

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        ?>
        <div class="apus-search-form <?php echo esc_attr($el_class.' '.$layout_type.' '.$style); ?>">
            <?php if ( $layout_type == 'popup' ) { ?>
                <a href="javascript:void(0);" class="show-search-form-btn"><i class="flaticon-magnifying-glass"></i></a>
                <div class="search-form-popup-wrapper">
            <?php } ?>
                
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form-popup">
                        <div class="search-form-popup-wrapper">
                            <input type="text" placeholder="<?php echo esc_attr( $placeholder ); ?>" name="s" class="apus-search form-control" autocomplete="off"/>
                            <?php if ( defined('LP_COURSE_CPT') && LP_COURSE_CPT ) { ?>
                                <input type="hidden" name="ref" value="course" class="post_type" />
                            <?php } ?>
                            <button type="submit" class="btn-search-icon"><i class="flaticon-magnifying-glass"></i></button>
                        </div>
                    </form>
            <?php if ( $layout_type == 'popup' ) { ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Search_Form );
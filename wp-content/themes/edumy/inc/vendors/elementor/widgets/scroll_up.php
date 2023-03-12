<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Scroll_Up extends Widget_Base {

	public function get_name() {
        return 'edumy_scroll_up';
    }

	public function get_title() {
        return esc_html__( 'Apus Scroll Up', 'edumy' );
    }

	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Scroll Up', 'edumy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'edumy' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'target_id',
            [
                'label'         => esc_html__( 'Target ID', 'edumy' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter target id', 'edumy' ),
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'edumy' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'edumy' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .scroll-up-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-scroll-up <?php echo esc_attr($el_class); ?>">
            <?php if ( !empty($icon) ) { ?>
                <a class="scroll-up-btn" href="#<?php echo esc_attr($target_id); ?>"><i class="<?php echo esc_attr($icon); ?>"></i></a>
            <?php } ?>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Scroll_Up );
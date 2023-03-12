<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Icon_Box extends Widget_Base {

	public function get_name() {
        return 'edumy_icon_box';
    }

	public function get_title() {
        return esc_html__( 'Apus Icon Box', 'edumy' );
    }

	public function get_icon() {
        return 'eicon-image-box';
    }

	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Icon Box', 'edumy' ),
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
            'title_text',
            [
                'label' => esc_html__( 'Title', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'edumy' ),
                'placeholder' => esc_html__( 'Enter your title', 'edumy' ),
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'edumy' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'edumy' ),
                'placeholder' => esc_html__( 'Enter your description', 'edumy' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link to', 'edumy' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'edumy' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style1', 'edumy'),
                    'style2' => esc_html__('Style2', 'edumy'),
                    'style3' => esc_html__('Style3', 'edumy'),
                    'style4' => esc_html__('Style4', 'edumy'),
                    'style5' => esc_html__('Style5', 'edumy'),
                    'style6' => esc_html__('Style6', 'edumy'),
                ),
                'default' => 'style1'
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
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-icon-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .icon-box-image.icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'edumy' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title a, {{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'edumy' ),
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );
        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-icon-box <?php echo esc_attr($el_class.' '.$style); ?>">
            <div class="item-inner">
                <?php
                $has_content = ! empty( $title_text ) || ! empty( $description_text );
                $html = '';

                if ( !empty($icon) ) {
                    $html .= '<div class="icon-box-image icon"><i class="'.$icon.'"></i></div>';
                }

                if ( $has_content ) {
                    $html .= '<div class="icon-box-content">';

                    if ( ! empty( $title_text ) ) {
                        if ( ! empty( $link['url'] ) ) {
                            $html .= '<a href="'.esc_url($link['url']).'" target="'.esc_attr($link['is_external'] ? '_blank' : '_self').'" '.($link['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_text.'</h3></a>';
                        } else {
                            $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_text );
                        }
                    }

                    if ( ! empty( $description_text ) ) {
                        $html .= sprintf( '<div class="description">%1$s</div>', $description_text );
                    }

                    $html .= '</div>';
                }

                echo wp_kses_post($html);
                ?>
            </div>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Icon_Box );
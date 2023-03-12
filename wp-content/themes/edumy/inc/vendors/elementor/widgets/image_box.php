<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Image_Box extends Widget_Base {

	public function get_name() {
        return 'edumy_image_box';
    }

	public function get_title() {
        return esc_html__( 'Apus Image Box', 'edumy' );
    }

	public function get_image() {
        return 'eimage-image-box';
    }

	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Image Box', 'edumy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'edumy' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
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
            'link',
            [
                'label' => esc_html__( 'Link to', 'edumy' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'edumy' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'edumy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'layout1' => esc_html__('Layout 1', 'edumy'),
                    'layout2' => esc_html__('Layout 2', 'edumy'),
                    'layout3' => esc_html__('Layout 3', 'edumy'),
                ),
                'default' => 'layout1'
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
                'condition' => [
                    'layout_type' => 'layout1',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button text', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Learn more',
                'placeholder' => esc_html__( 'Enter your button text', 'edumy' ),
                'condition' => [
                    'layout_type' => 'layout1',
                ],
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => esc_html__( 'Button Style', 'edumy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'edumy'),
                    'style2' => esc_html__('Style 2', 'edumy'),
                    'style3' => esc_html__('Style 3', 'edumy'),
                    'style4' => esc_html__('Style 4', 'edumy'),                    
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

        // Section Column Background Overlay.

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Overlay', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .image-box-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__( 'Opacity', 'edumy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [                    
                    '{{WRAPPER}} .image-box-content' => 'opacity: {{SIZE}};',
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

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .image-box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $style = '';
        if ( ! empty( $image['url'] ) ) {
            $style = 'style="background: url('.$image['url'].')";';
        }

        ?>
        <div class="widget-image-box <?php echo esc_attr($el_class.' '.$layout_type); ?>">
            <div class="item-inner">
                <?php
                if ( $layout_type == 'layout1' ) {
                    $has_content = ! empty( $title_text ) || ! empty( $description_text );
                    $html = '';

                    $html .= '<div class="image-box-image" '.trim($style).'></div>';

                    if ( $has_content ) {
                        $html .= '<div class="image-box-content">';

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

                        if ( ! empty( $button_text ) ) {
                            $html .= '<a class="btn btn-read-more'.' '.esc_attr($button_style).'" href="'.esc_url($link['url']).'" target="'.esc_attr($link['is_external'] ? '_blank' : '_self').'" '.($link['nofollow'] ? 'rel="nofollow"' : '').'>'.$button_text.' <i class="flaticon-right-arrow-1"></i></a>';
                        }                        

                        $html .= '</div>';
                    }

                    echo trim($html);
                } else {
                    $has_content = ! empty( $title_text ) || ! empty( $description_text );
                    $html = '';

                    $html .= '<div class="image-box-image" '.trim($style).'>';
                        if ( $has_content ) {
                            $html .= '<div class="image-box-content">';

                            if ( ! empty( $title_text ) ) {
                                if ( ! empty( $link['url'] ) ) {
                                    $html .= '<a href="'.esc_url($link['url']).'" target="'.esc_attr($link['is_external'] ? '_blank' : '_self').'" '.($link['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_text.'</h3></a>';
                                } else {
                                    $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_text );
                                }
                            }

                            $html .= '</div>';
                        }
                    $html .= '</div>';
                    echo trim($html);
                }
                ?>
            </div>
        </div>
        <?php
        
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Image_Box );
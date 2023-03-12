<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Logo extends Widget_Base {

	public function get_name() {
        return 'edumy_logo';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Logo', 'edumy' );
    }
    
	public function get_categories() {
        return [ 'edumy-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'edumy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Main Logo', 'edumy' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'image_transparent',
            [
                'label' => esc_html__( 'Transparent Header Logo', 'edumy' ),
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
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'edumy' ),
                'type' => Controls_Manager::CHOOSE,
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
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'edumy' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'edumy' ),
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="logo <?php echo esc_attr($el_class); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                <span class="logo-main <?php echo esc_attr(!empty($image_transparent['id']) ? 'has-transparent-logo' : ''); ?>">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
                </span>
                <?php if ( !empty($image_transparent['id']) ) { ?>
                    <span class="transparent-logo">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image_transparent' ); ?>
                    </span>
                <?php } ?>
            </a>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Logo );
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Team extends Widget_Base {

	public function get_name() {
        return 'edumy_team';
    }

	public function get_title() {
        return esc_html__( 'Apus Teams', 'edumy' );
    }

    public function get_icon() {
        return 'fa fa-users';
    }

	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Team', 'edumy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Social Title', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Social Title' , 'edumy' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Social Link', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your social link here', 'edumy' ),
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Social Icon', 'edumy' ),
                'type' => Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'name', [
                'label' => esc_html__( 'Member Name', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Member Name' , 'edumy' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'job', [
                'label' => esc_html__( 'Member Job', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Member Job' , 'edumy' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'edumy' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'edumy' ),
            ]
        );

        $this->add_control(
            'description', [
                'label' => esc_html__( 'Member Description', 'edumy' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Member Description' , 'edumy' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'socials',
            [
                'label' => esc_html__( 'Socials', 'edumy' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
                'label' => esc_html__( 'Title', 'edumy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Core\Schemes\Color::get_type(),
                    'value' => Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .social a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget widget-team <?php echo esc_attr($el_class); ?>">
            <div class="top-image">
                <?php
                if ( !empty($settings['img_src']['id']) ) {
                ?>
                    <div class="team-image">
                        <?php echo trim(edumy_get_attachment_thumbnail($settings['img_src']['id'], 'full')); ?>
                    </div>
                <?php } ?>
                <?php if ( !empty($socials) ) { ?>
                    <ul class="social">
                        <?php foreach ($socials as $social) { ?>
                            <?php if ( !empty($social['link']) && !empty($social['icon']) ) { ?>
                                <li>
                                    <a href="<?php echo esc_url($social['link']);?>" <?php echo !empty($social['title']) ? 'title="'.esc_attr($social['title']).'"' : ''; ?>>
                                        <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="content">
                <?php if ( !empty($name) ) { ?>
                    <h3 class="name-team"><?php echo wp_kses_post($name); ?></h3>
                <?php } ?>
                <?php if ( !empty($job) ) { ?>
                    <div class="job text-theme"><?php echo wp_kses_post($job); ?></div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Team );
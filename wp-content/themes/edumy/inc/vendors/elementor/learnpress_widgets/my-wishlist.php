<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Booking_My_Wishlist extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_booking_my_favorite';
    }

    public function get_title() {
        return esc_html__( 'Apus My Wishlist', 'edumy' );
    }

    public function get_categories() {
        return [ 'edumy-elements' ];
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
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'edumy' ),
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

        <div class="widget no-margin widget-my-wishlist <?php echo esc_attr($el_class); ?>">
            <?php if ( $title ) { ?>
                <h2 class="widget-title"><?php echo trim($title); ?></h2>
            <?php } ?>
            <?php
            if ( !is_user_logged_in() ) { ?>
                <div class="text-danger"><?php esc_html_e('Please login to view your wishlist', 'edumy'); ?></div>
            <?php
            } else {
                $post_ids = Edumy_Wishlist::get_wishlist();
                $post_ids = (!empty($post_ids) && is_array($post_ids)) ? array_merge(array(0), $post_ids) : array(0);
                $args = array(
                    'includes' => $post_ids
                );
                $courses = edumy_get_courses($args);
                ?>
                <div class="my-course-item-wrapper">
                    <?php
                    learn_press_get_template( 'layout-courses/list.php' , array(
                        'courses' => $courses,
                    ) );
                    ?>
                </div>
                <?php
            } ?>

        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Booking_My_Wishlist );
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Edumy_Elementor_Extensions' ) ) {
    final class Edumy_Elementor_Extensions {

        private static $_instance = null;

        
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  100 );
            add_filter( 'edumy_generate_post_builder', array( $this, 'render_post_builder' ), 10, 2 );

            add_action( 'elementor/controls/controls_registered', array( $this, 'modify_controls' ), 10, 1 );
            add_action('elementor/editor/before_enqueue_styles', array( $this, 'style' ) );
        }

        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'edumy-elements',
                [
                    'title' => esc_html__( 'Edumy Elements', 'edumy' ),
                    'icon' => 'fa fa-shopping-bag',
                ]
            );

            $elements_manager->add_category(
                'edumy-header-elements',
                [
                    'title' => esc_html__( 'Edumy Header Elements', 'edumy' ),
                    'icon' => 'fa fa-shopping-bag',
                ]
            );

        }

        public function elementor_widgets() {
            // general elements
            get_template_part( 'inc/vendors/elementor/widgets/heading' );
            get_template_part( 'inc/vendors/elementor/widgets/posts' );
            get_template_part( 'inc/vendors/elementor/widgets/call_to_action' );
            get_template_part( 'inc/vendors/elementor/widgets/features_box' );
            get_template_part( 'inc/vendors/elementor/widgets/social_links' );
            get_template_part( 'inc/vendors/elementor/widgets/testimonials' );
            get_template_part( 'inc/vendors/elementor/widgets/brands' );
            get_template_part( 'inc/vendors/elementor/widgets/process' );
            get_template_part( 'inc/vendors/elementor/widgets/popup_video' );
            get_template_part( 'inc/vendors/elementor/widgets/instagram' );
            get_template_part( 'inc/vendors/elementor/widgets/banner' );
            get_template_part( 'inc/vendors/elementor/widgets/countdown' );
            get_template_part( 'inc/vendors/elementor/widgets/nav_menu' );
            get_template_part( 'inc/vendors/elementor/widgets/team' );
            get_template_part( 'inc/vendors/elementor/widgets/icon_box' );
            get_template_part( 'inc/vendors/elementor/widgets/image_box' );
            get_template_part( 'inc/vendors/elementor/widgets/scroll_up' );

            // header elements
            get_template_part( 'inc/vendors/elementor/header_widgets/logo' );
            get_template_part( 'inc/vendors/elementor/header_widgets/primary_menu' );
            get_template_part( 'inc/vendors/elementor/header_widgets/vertical_menu' );
            get_template_part( 'inc/vendors/elementor/header_widgets/search_form' );
            get_template_part( 'inc/vendors/elementor/header_widgets/user_info' );

            if ( edumy_is_mailchimp_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/mailchimp' );
            }

            if ( edumy_is_woocommerce_activated() ) {
                get_template_part( 'inc/vendors/elementor/woo_header_widgets/woo_mini_cart' );
            }

            if ( edumy_is_learnpress_activated() ) {
                get_template_part( 'inc/vendors/elementor/learnpress_widgets/category_banner' );
                get_template_part( 'inc/vendors/elementor/learnpress_widgets/courses' );
                get_template_part( 'inc/vendors/elementor/learnpress_widgets/courses_tabs' );
                get_template_part( 'inc/vendors/elementor/learnpress_widgets/instructors' );
                get_template_part( 'inc/vendors/elementor/learnpress_widgets/my-wishlist' );
            }

            if ( edumy_is_simple_event_activated() ) {
                get_template_part( 'inc/vendors/elementor/event_widgets/events' );
            }

            if ( edumy_is_revslider_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/revslider' );
            }

        }

        public function style() {
            wp_enqueue_style('edumy-flaticon',  get_template_directory_uri() . '/css/flaticon.css');
        }

        public function modify_controls( $controls_registry ) {
            // Get existing icons
            $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
            // Append new icons
            $new_icons = array_merge(
                array(
                    'flaticon-user' => 'flaticon-user', 'flaticon-shopping-bag' => 'flaticon-shopping-bag', 'flaticon-magnifying-glass' => 'flaticon-magnifying-glass', 'flaticon-down-arrow' => 'flaticon-down-arrow', 'flaticon-right-arrow' => 'flaticon-right-arrow', 'flaticon-back' => 'flaticon-back', 'flaticon-up-arrow' => 'flaticon-up-arrow', 'flaticon-right-arrow-1' => 'flaticon-right-arrow-1', 'flaticon-left-arrow' => 'flaticon-left-arrow', 'flaticon-download-arrow' => 'flaticon-download-arrow', 'flaticon-up-arrow-1' => 'flaticon-up-arrow-1', 'flaticon-student' => 'flaticon-student', 'flaticon-book' => 'flaticon-book', 'flaticon-global' => 'flaticon-global', 'flaticon-first' => 'flaticon-first', 'flaticon-trophy' => 'flaticon-trophy', 'flaticon-like' => 'flaticon-like', 'flaticon-profile' => 'flaticon-profile', 'flaticon-consulting-message' => 'flaticon-consulting-message', 'flaticon-review' => 'flaticon-review', 'flaticon-comment' => 'flaticon-comment', 'flaticon-calendar' => 'flaticon-calendar', 'flaticon-calendar-1' => 'flaticon-calendar-1', 'flaticon-appointment' => 'flaticon-appointment', 'flaticon-placeholder' => 'flaticon-placeholder', 'flaticon-placeholder-1' => 'flaticon-placeholder-1', 'flaticon-placeholders' => 'flaticon-placeholders', 'flaticon-apple' => 'flaticon-apple', 'flaticon-google-play' => 'flaticon-google-play', 'flaticon-megaphone' => 'flaticon-megaphone', 'flaticon-student-1' => 'flaticon-student-1', 'flaticon-elearning' => 'flaticon-elearning', 'flaticon-elearning-1' => 'flaticon-elearning-1', 'flaticon-checklist' => 'flaticon-checklist', 'flaticon-student-2' => 'flaticon-student-2', 'flaticon-student-3' => 'flaticon-student-3', 'flaticon-ebook' => 'flaticon-ebook', 'flaticon-cap' => 'flaticon-cap', 'flaticon-graduation-cap' => 'flaticon-graduation-cap', 'flaticon-jigsaw' => 'flaticon-jigsaw', 'flaticon-online' => 'flaticon-online', 'flaticon-online-learning' => 'flaticon-online-learning', 'flaticon-account' => 'flaticon-account', 'flaticon-online-learning-1' => 'flaticon-online-learning-1', 'flaticon-tablet' => 'flaticon-tablet', 'flaticon-lamp' => 'flaticon-lamp', 'flaticon-pencil' => 'flaticon-pencil', 'flaticon-employee' => 'flaticon-employee', 'flaticon-resume' => 'flaticon-resume', 'flaticon-photo-camera' => 'flaticon-photo-camera', 'flaticon-creative-idea' => 'flaticon-creative-idea', 'flaticon-web' => 'flaticon-web', 'flaticon-speaker' => 'flaticon-speaker', 'flaticon-3d' => 'flaticon-3d', 'flaticon-web-programming' => 'flaticon-web-programming', 'flaticon-beach-ball' => 'flaticon-beach-ball', 'flaticon-bathroom' => 'flaticon-bathroom', 'flaticon-toy' => 'flaticon-toy', 'flaticon-bike' => 'flaticon-bike', 'flaticon-refund' => 'flaticon-refund', 'flaticon-refund-1' => 'flaticon-refund-1', 'flaticon-share' => 'flaticon-share', 'flaticon-play-button' => 'flaticon-play-button', 'flaticon-download' => 'flaticon-download', 'flaticon-download-1' => 'flaticon-download-1', 'flaticon-key' => 'flaticon-key', 'flaticon-key-1' => 'flaticon-key-1', 'flaticon-responsive' => 'flaticon-responsive', 'flaticon-flash' => 'flaticon-flash', 'flaticon-award' => 'flaticon-award', 'flaticon-medal' => 'flaticon-medal', 'flaticon-medal-1' => 'flaticon-medal-1', 'flaticon-play-button-1' => 'flaticon-play-button-1', 'flaticon-like-1' => 'flaticon-like-1', 'flaticon-love' => 'flaticon-love', 'flaticon-puzzle-1' => 'flaticon-puzzle-1', 'flaticon-shopping-bag-1' => 'flaticon-shopping-bag-1', 'flaticon-shopping-bag-2' => 'flaticon-shopping-bag-2', 'flaticon-speech-bubble' => 'flaticon-speech-bubble', 'flaticon-rating' => 'flaticon-rating', 'flaticon-add-contact' => 'flaticon-add-contact', 'flaticon-settings' => 'flaticon-settings', 'flaticon-settings-1' => 'flaticon-settings-1', 'flaticon-logout' => 'flaticon-logout', 'flaticon-send' => 'flaticon-send', 'flaticon-send-1' => 'flaticon-send-1', 'flaticon-paper-plane' => 'flaticon-paper-plane', 'flaticon-send-2' => 'flaticon-send-2', 'flaticon-edit' => 'flaticon-edit', 'flaticon-preview' => 'flaticon-preview', 'flaticon-delete-button' => 'flaticon-delete-button', 'flaticon-alarm' => 'flaticon-alarm', 'flaticon-alarm-1' => 'flaticon-alarm-1', 'flaticon-email' => 'flaticon-email', 'flaticon-clock' => 'flaticon-clock', 'flaticon-call' => 'flaticon-call', 'flaticon-phone-call' => 'flaticon-phone-call', 'flaticon-www' => 'flaticon-www', 'flaticon-zoom-in' => 'flaticon-zoom-in'
                ),
                $icons
            );
            // Then we set a new list of icons as the options of the icon control
            $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
        }

        public function render_page_content($post_id) {
            if ( class_exists( 'Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new Elementor\Core\Files\CSS\Post( $post_id );
                $css_file->enqueue();
            }

            return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
        }

        public function render_post_builder($html, $post) {
            if ( !empty($post) && !empty($post->ID) ) {
                return $this->render_page_content($post->ID);
            }
            return $html;
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Edumy_Elementor_Extensions::instance();
}
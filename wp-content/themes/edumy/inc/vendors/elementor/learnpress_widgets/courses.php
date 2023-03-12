<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Learnpress_Courses extends Elementor\Widget_Base {

	public function get_name() {
        return 'edumy_learnpress_courses';
    }

	public function get_title() {
        return esc_html__( 'Apus Courses', 'edumy' );
    }
    
	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Courses', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'get_course_by',
            [
                'label' => esc_html__( 'Get Courses By', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'recent_courses' => esc_html__('Recent Courses', 'edumy' ),
                    'featured_courses' => esc_html__('Featured Courses', 'edumy' ),
                    'popular_courses' => esc_html__('Popular Courses', 'edumy' ),
                ),
                'default' => 'recent_courses'
            ]
        );

        $this->add_control(
            'slugs',
            [
                'label' => esc_html__( 'Categories Slug', 'edumy' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'edumy' ),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'edumy' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter number products to display', 'edumy' ),
                'default' => 4
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'edumy'),
                    'carousel' => esc_html__('Carousel', 'edumy'),
                ),
                'default' => 'grid'
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'edumy' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your column number here', 'edumy' ),
                'default' => 4
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'edumy' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'edumy' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'edumy' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'edumy' ),
                'label_off'     => esc_html__( 'Hide', 'edumy' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'edumy' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'edumy' ),
                'label_off'     => esc_html__( 'Hide', 'edumy' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'edumy' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'edumy' ),
                'label_off'     => esc_html__( 'No', 'edumy' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'edumy' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'edumy' ),
                'label_off'     => esc_html__( 'No', 'edumy' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
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
        
        $courses = null;
        $slugs = !empty($slugs) ? array_map('trim', explode(',', $slugs)) : array();
        switch ($get_course_by) {
            case 'featured_courses':
                $courses = edumy_get_courses(array(
                    'course_type' => 'featured_courses',
                    'categories' => $slugs,
                    'limit' => (int)$limit,
                    'fields' => 'ids'
                ));
                break;
            case 'popular_courses':
                $courses = edumy_get_popular_courses(array(
                    'limit' => (int)$limit,
                    'categories' => $slugs,
                ));
                break;
            default:
                $courses = edumy_get_courses(array(
                    'course_type' => 'recent_courses',
                    'categories' => $slugs,
                    'limit' => (int)$limit,
                    'fields' => 'ids'
                ));
                break;
        }
        ?>
        <div class="widget widget-courses <?php echo esc_attr($el_class); ?>">
            
            <?php
                learn_press_get_template( 'layout-courses/'.$layout_type.'.php' , array(
                    'courses' => $courses,
                    'columns' => $columns,
                    'show_nav' => $show_nav,
                    'show_pagination' => $show_pagination,
                    'autoplay' => $autoplay,
                    'infinite_loop' => $infinite_loop,
                    'rows' => $rows,
                ) );
            ?>

        </div>
        <?php

    }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Learnpress_Courses );
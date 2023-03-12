<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Events extends Elementor\Widget_Base {

	public function get_name() {
        return 'edumy_events';
    }

	public function get_title() {
        return esc_html__( 'Apus Events', 'edumy' );
    }
    
	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Events', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'get_event_by',
            [
                'label' => esc_html__( 'Get Events By', 'edumy' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'recent' => esc_html__('Recent Events', 'edumy' ),
                    'upcoming' => esc_html__('Upcoming Events', 'edumy' ),
                ),
                'default' => 'recent'
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

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
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
                    'list' => esc_html__('List', 'edumy'),
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
        
        $slugs = !empty($slugs) ? array_map('trim', explode(',', $slugs)) : array();
        $events = edumy_get_events(array(
            'event_type' => $get_event_by,
            'categories' => $slugs,
            'limit' => (int)$limit
        ));
        if ( $events->have_posts() ) {

            if ( $image_size == 'custom' ) {
                
                if ( $image_custom_dimension['width'] && $image_custom_dimension['height'] ) {
                    $thumbsize = $image_custom_dimension['width'].'x'.$image_custom_dimension['height'];
                } else {
                    $thumbsize = 'full';
                }
            } else {
                $thumbsize = $image_size;
            }
            set_query_var( 'thumbsize', $thumbsize );

            ?>
            <div class="widget widget-events <?php echo esc_attr($el_class); ?>">
                <?php if ( $layout_type == 'carousel' ) {
                    $small_cols = $columns <= 1 ? 1 : 2;

                    ?>
                    <div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
                        data-smallmedium="<?php echo esc_attr($small_cols); ?>"
                        data-extrasmall="1"
                        data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">

                        <?php
                            while ( $events->have_posts() ) { $events->the_post();
                                get_template_part('templates-event/loop/inner');
                            }
                        ?>

                    </div>
                <?php } elseif ( $layout_type == 'grid' ) { ?>
                    <div class="row">
                        <?php
                            $classes = array();
                            if ( $columns == 5 ) {
                                $bcol = 'cus-5';
                            } else {
                                $bcol = 12/$columns;
                            }
                            $classes[] = 'col-lg-'.$bcol.' col-md-'.$bcol.( $columns > 1 ? ' col-sm-6' : 'col-xs-12');
                        ?>
                        <?php while ( $events->have_posts() ) { $events->the_post(); ?>
                            <div class="<?php echo implode(' ', $classes); ?>">
                                <?php get_template_part('templates-event/loop/inner'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <?php
                            $classes = array();
                            $classes[] = 'col-xs-12';
                        ?>
                        <?php while ( $events->have_posts() ) { $events->the_post(); ?>
                            <div class="<?php echo implode(' ', $classes); ?>">
                                <?php get_template_part('templates-event/loop/inner-list-small'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                
            </div>
            <?php
            wp_reset_postdata();
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Events );
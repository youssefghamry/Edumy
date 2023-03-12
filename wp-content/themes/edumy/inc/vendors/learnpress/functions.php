<?php

if ( !function_exists('edumy_get_courses') ) {
    function edumy_get_courses( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'categories' => array(),
            'course_type' => 'recent_courses',
            'paged' => 1,
            'limit' => -1,
            'orderby' => '',
            'order' => '',
            'includes' => array(),
            'excludes' => array(),
            'author' => '',
            'fields' => '', // ids
        ));
        extract($args);
        
        $query_args = array(
            'post_type' => LP_COURSE_CPT,
            'posts_per_page' => $limit,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        switch ($course_type) {
            case 'featured_courses':
                $meta_query = array(
                    array(
                        'key' => '_lp_featured',
                        'value' => 'yes',
                        'compare' => '=',
                    )
                );
                $query_args['meta_query'] = $meta_query;
                break;
            case 'recent_courses':
                $query_args['orderby'] = 'date';
                $query_args['order'] = 'DESC';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'      => 'course_category',
                'field'         => 'slug',
                'terms'         => $categories,
                'operator'      => 'IN'
            );
        }

        if (!empty($includes) && is_array($includes)) {
            $query_args['post__in'] = $includes;
        }
        
        if ( !empty($excludes) && is_array($excludes) ) {
            $query_args['post__not_in'] = $excludes;
        }

        if ( !empty($author) ) {
            $query_args['author'] = $author;
        }

        if ( !empty($fields) ) {
            $query_args['fields'] = $fields;
        }
        $loop = new WP_Query($query_args);
        $posts = array();
        if ( !empty($loop->posts) ) {
            $posts = $loop->posts;
        }
        return $posts;
    }
}

function edumy_get_popular_courses( $args = array() ) {
    global $wpdb;

    $limit = ! empty( $args['limit'] ) ? $args['limit'] : - 1;
    $order = ! empty( $args['order'] ) ? $args['order'] : 'DESC';
    $categories = ! empty( $args['categories'] ) ? $args['categories'] : '';

    $join_cat = $where_cat = '';
    if ( !empty($categories) ) {
        $join_cat = "
            INNER JOIN wp_term_relationships tr ON p.ID = tr.object_id 
            INNER JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id 
            INNER JOIN wp_terms t ON tt.term_id = t.term_id 
        ";
        $where_cat = " AND t.slug IN ('".implode("','", $categories)."') ";
    }

    if ( $limit <= 0 ) {
        $limit = 0;
    }

    $query = apply_filters( 'learn-press/course-curd/query-popular-courses',
        $wpdb->prepare( "
            SELECT DISTINCT p.ID, COUNT(*) AS number_enrolled 
            FROM {$wpdb->prefix}learnpress_user_items ui
            INNER JOIN {$wpdb->posts} p ON p.ID = ui.item_id

            %s

            WHERE ui.item_type = %s
                AND ( ui.status = %s OR ui.status = %s )
                AND p.post_status = %s %s
            ORDER BY number_enrolled {$order}
            LIMIT %d
        ", $join_cat, LP_COURSE_CPT, 'enrolled', 'finished', 'publish', $where_cat, $limit )
    );

    return $wpdb->get_col( $query );
}

function edumy_course_get_instructors($limit = '') {
    $args = array(
        'role__in'     => array( 'lp_teacher' ),
        'orderby'      => 'login',
        'order'        => 'ASC',
        'number'       => $limit
    ); 
    $instructors = get_users( $args );
    return $instructors;
}

function edumy_course_template_path($folder_name) {
    if ( edumy_is_new_learnpress('4.0.0') ) {
        return 'templates-education-v4';
    }
    return 'templates-education';
}
add_filter( 'learn_press_template_path', 'edumy_course_template_path' );

function edumy_course_override_templates($return) {
    return true;
}
add_filter( 'learn-press/override-templates', 'edumy_course_override_templates' );

function edumy_course_enqueue_scripts() {
    wp_enqueue_script( 'edumy-course', get_template_directory_uri() . '/js/course.js', array( 'jquery' ), '20150330', true );
    wp_localize_script( 'edumy-course', 'edumy_course_opts', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce( "edumy-ajax-nonce" ),
    ));
}
add_action( 'wp_enqueue_scripts', 'edumy_course_enqueue_scripts', 10 );


// Loop Course
function edumy_course_loop_before_begin() {
    echo '<div class="course-top-wrapper">';
}
function edumy_course_loop_before_end() {
    echo '</div>';
}
function edumy_course_loop_found_post() {
    global $wp_query;
    $count = $wp_query->found_posts;
    ?>
    <div class="course-found"><?php echo sprintf(_n('<span>%d</span> course found', '<span>%d</span> courses found', $count, 'edumy'), $count); ?></div>
    <?php
}
function edumy_course_loop_orderby() {

    $orderby_options = apply_filters( 'edumy_courses_orderby', array(
        ''    => esc_html__( 'Default', 'edumy' ),
        'newest'        => esc_html__( 'Newest', 'edumy' ),
        'oldest'        => esc_html__( 'Oldest', 'edumy' ),
    ) );

    $orderby = isset( $_GET['orderby'] ) ? wp_unslash( $_GET['orderby'] ) : '';
    ?>

    <div class="orderby">
        <form class="courses-ordering" method="get">
            <select name="orderby" class="orderby">
                <?php foreach ( $orderby_options as $id => $name ) : ?>
                    <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="paged" value="1" />
            <?php edumy_query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
        </form>
    </div>
    <?php
}

add_action( 'edumy-learn-press/after-archive-description', 'edumy_course_loop_before_begin', 6 );
add_action( 'edumy-learn-press/after-archive-description', 'edumy_course_loop_found_post', 10 );
add_action( 'edumy-learn-press/after-archive-description', 'learn_press_search_form', 15 );
add_action( 'edumy-learn-press/after-archive-description', 'edumy_course_loop_orderby', 16 );
add_action( 'edumy-learn-press/after-archive-description', 'edumy_course_loop_before_end', 200 );

remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );
remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );

function edumy_query_string_form_fields( $values = null, $exclude = array(), $current_key = '', $return = false ) {
    if ( is_null( $values ) ) {
        $values = $_GET; // WPCS: input var ok, CSRF ok.
    } elseif ( is_string( $values ) ) {
        $url_parts = wp_parse_url( $values );
        $values    = array();

        if ( ! empty( $url_parts['query'] ) ) {
            parse_str( $url_parts['query'], $values );
        }
    }
    $html = '';

    foreach ( $values as $key => $value ) {
        if ( in_array( $key, $exclude, true ) ) {
            continue;
        }
        if ( $current_key ) {
            $key = $current_key . '[' . $key . ']';
        }
        if ( is_array( $value ) ) {
            $html .= edumy_query_string_form_fields( $value, $exclude, $key, true );
        } else {
            $html .= '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( wp_unslash( $value ) ) . '" />';
        }
    }

    if ( $return ) {
        return $html;
    }

    echo trim($html); // WPCS: XSS ok.
}

function edumy_course_pre_get_posts($query) {
    $suppress_filters = ! empty( $query->query_vars['suppress_filters'] ) ? $query->query_vars['suppress_filters'] : '';

    $is_correct_taxonomy = false;
    if ( is_tax( 'course_category' ) || is_tax( 'course_tag' ) ) {
        $is_correct_taxonomy = true;
    }

    if ( ( (is_post_type_archive( LP_COURSE_CPT ) && !$suppress_filters && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == LP_COURSE_CPT ) || $is_correct_taxonomy) && $query->is_main_query() && !is_admin()  ) {

        $limit = edumy_get_config('number_courses_per_page', 12);
        $query->set( 'posts_per_page', $limit );
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
        switch ( $orderby ) {
            case 'newest':
                $query->set( 'orderby', 'date' );
                $query->set( 'order', 'DESC' );
                break;
            case 'oldest':
                $query->set( 'orderby', 'date' );
                $query->set( 'order', 'ASC' );
                break;
        }
        
        $tax_query = $query->get( 'tax_query' );
        if ( empty($tax_query) ) {
            $tax_query = array();
        }
        if ( ! empty( $_GET['filter-category'] ) ) {
            $tax_query[] = array(
                'taxonomy'  => 'course_category',
                'field'     => 'id',
                'terms'     => $_GET['filter-category'],
                'compare'   => '==',
            );
        }

        if ( $tax_query ) {
            $query->set( 'tax_query', $tax_query );
        }

        if ( ! empty( $_GET['filter-instructor'] ) ) {
            if ( is_array($_GET['filter-instructor']) ) {
                $query->set( 'author__in', $_GET['filter-instructor'] );
            } else {
                $query->set( 'author', $_GET['filter-instructor'] );
            }
        }

        $meta_query = $query->get( 'meta_query' );
        if ( empty($meta_query) ) {
            $meta_query = array();
        }
        if ( ! empty( $_GET['filter-level'] ) ) {
            $meta_query[] = array(
                'key' => '_lp_level',
                'value' => $_GET['filter-level'],
                'compare' => '=',
            );
        }
        if ( ! empty( $_GET['filter-price'] ) ) {
            if ( $_GET['filter-price'] == 'free' ) {
                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_lp_price',
                        'value' => '0',
                        'compare' => '=',
                    ),
                    array(
                        'key' => '_lp_price',
                        'value' => '',
                        'compare' => '=',
                    ),
                    array(
                        'key' => '_lp_price',
                        'compare' => 'NOT EXISTS',
                    )
                );
            } else {
                $meta_query[] = array(
                    'key' => '_lp_price',
                    'value' => '0',
                    'compare' => '>',
                );
            }
        }
        if ( ! empty( $_GET['filter-rating'] ) ) {
            $meta_query[] = array(
                'key' => '_average_rating',
                'value' => $_GET['filter-rating'],
                'compare' => '>=',
            );
        }
        if ( $meta_query ) {
            $query->set( 'meta_query', $meta_query );
        }

        return $query;
    } else {
        return;
    }
}
add_action( 'pre_get_posts', 'edumy_course_pre_get_posts', 100 );


if ( !function_exists('edumy_course_content_class') ) {
    function edumy_course_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
        if ( edumy_get_config('course_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'edumy_course_content_class', 'edumy_course_content_class', 1 , 1  );

if ( !function_exists('edumy_get_course_archive_layout_configs') ) {
    function edumy_get_course_archive_layout_configs() {
        
        $left = edumy_get_config('courses_left_sidebar');
        $right = edumy_get_config('courses_right_sidebar');

        switch ( edumy_get_config('courses_layout') ) {
            case 'left-main':
                if ( is_active_sidebar( $left ) ) {
                    $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                    $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
                }
                break;
            case 'main-right':
                if ( is_active_sidebar( $right ) ) {
                    $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
                    $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                }
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            default:
                $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
                break;
        }
        if ( empty($configs) ) {
            $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
            $configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
        }
        return $configs; 
    }
}

if ( !function_exists('edumy_get_course_single_layout_configs') ) {
    function edumy_get_course_single_layout_configs() {
        switch ( edumy_get_config('course_layout') ) {
            case 'left-main':
                $configs['sidebar_class'] = 'pull-left';
                $configs['main_class'] = 'pull-right';
                break;
            case 'main-right':
            default:
                $configs['sidebar_class'] = '';
                $configs['main_class'] = '';
                break;
        }
        return $configs; 
    }
}

function edumy_course_body_classes( $classes ) {
    global $post;
    if ( is_singular( LP_COURSE_CPT ) ) {
        $layout_type = edumy_get_config('course_layout_type', 'v1');
        if ( empty($layout_type) ) {
            $layout_type = 'v1';
        }
        $classes[] = 'course-single-layout-'.$layout_type;
    }
    if ( learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_course_tax() || learn_press_is_search() ) {
        $display_mode = edumy_get_config('courses_display_mode', 'grid');
        if ( $display_mode == 'list' ) {
            $classes[] = 'body-display-mode-list';
        }
    }
    return $classes;
}
add_filter( 'body_class', 'edumy_course_body_classes' );

function edumy_course_get_levels() {
    return apply_filters('edumy_course_get_levels', array(
        'beginner' => esc_html__('Beginner', 'edumy'),
        'intermediate' => esc_html__('Intermediate', 'edumy'),
        'advanced' => esc_html__('Advanced', 'edumy'),
    ));
}

function edumy_course_custom_metas($fields) {
    if ( class_exists('LP_Meta_Box_Text_Field') ) {
        $fields['_lp_language'] = new LP_Meta_Box_Text_Field(esc_html__( 'Language', 'edumy' ), esc_html__( 'The language of the course.', 'edumy' ), '' );
    }
    if ( class_exists('LP_Meta_Box_Checkbox_Field') ) {
        $fields['_lp_certificate'] = new LP_Meta_Box_Checkbox_Field(
            esc_html__( 'Certificate', 'edumy' ),
            esc_html__( 'Set certificate course.', 'edumy' ),
            'no'
        );
    }

    return $fields;
}
add_filter('lp/course/meta-box/fields/general', 'edumy_course_custom_metas', 100);


function edumy_course_metaboxes(array $metaboxes) {
    $prefix = '_lp_';
    $fields = array(
        array(
            'name' => esc_html__( 'Video url', 'edumy' ),
            'id'   => '_lp_video_url',
            'type' => 'text',
            'desc' => esc_html__( 'Enter youtube or vimeo video.', 'edumy' ),
        ),
        array(
            'name' => esc_html__( 'More Information', 'edumy' ),
            'id'   => $prefix.'more_info',
            'type' => 'wysiwyg',
        ),
    );
    
    $metaboxes[$prefix . 'more_information'] = array(
        'id'                        => $prefix . 'more_information',
        'title'                     => esc_html__( 'More Information', 'edumy' ),
        'object_types'              => array( LP_COURSE_CPT ),
        'context'                   => 'normal',
        'priority'                  => 'high',
        'show_names'                => true,
        'fields'                    => $fields
    );

    return $metaboxes;
}
add_filter( 'cmb2_meta_boxes', 'edumy_course_metaboxes' );

function edumy_is_courses() {
    if ( learn_press_is_course() && is_single() ) {
        return true;
    } elseif ( learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_course_tax() || learn_press_is_search() ) {
        return true;
    }
    return false;
}

function edumy_single_course_heading() {
    learn_press_get_template( 'single-course/header.php' );
}

function edumy_single_course_video() {
    learn_press_get_template( 'single-course/video.php' );
}

remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );

add_action( 'learn-press/content-landing-summary', 'edumy_single_course_video', 17 );
add_action( 'learn-press/content-learning-summary', 'edumy_single_course_video', 32 );

function edumy_single_course_action() {
    if ( edumy_get_config('course_layout_type') !== 'v3' ) {
        add_action( 'learn-press/content-landing-summary', 'edumy_single_course_heading', 10 );
        add_action( 'learn-press/content-learning-summary', 'edumy_single_course_heading', 15 );
    } else {
        add_action( 'edumy_single_course_header', 'edumy_single_course_heading', 10 );
    }
}
add_action( 'init', 'edumy_single_course_action' );

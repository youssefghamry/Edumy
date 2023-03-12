<?php

if ( !function_exists('edumy_get_events') ) {
    function edumy_get_events( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'categories' => array(),
            'event_type' => 'recent',
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
            'post_type' => 'simple_event',
            'posts_per_page' => $limit,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        switch ($event_type) {
            case 'recent':
                $query_args['orderby'] = 'date';
                $query_args['order'] = 'DESC';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'      => 'simple_event_category',
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
        
        return $loop;
    }
}

function edumy_event_theme_folder($folder) {
    return "templates-event";
}
add_filter( 'apus-simple-event-theme-folder-name', 'edumy_event_theme_folder', 10 );

if ( !function_exists('edumy_event_content_class') ) {
    function edumy_event_content_class( $class ) {
        $prefix = 'events';
        if ( is_singular( 'simple_event' ) ) {
            $prefix = 'event';
        }
        if ( edumy_get_config($prefix.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'edumy_event_content_class', 'edumy_event_content_class', 1 , 1  );


if ( !function_exists('edumy_get_event_layout_configs') ) {
    function edumy_get_event_layout_configs() {
        $prefix = 'events';
        if ( is_singular( 'simple_event' ) ) {
            $prefix = 'event';
        }
        $left = edumy_get_config($prefix.'_left_sidebar');
        $right = edumy_get_config($prefix.'_right_sidebar');

        switch ( edumy_get_config($prefix.'_layout') ) {
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

function edumy_event_metaboxes($fields, $prefix) {
    $fields[] = array(
        'name' => esc_html__( 'Phone', 'edumy' ),
        'id'   => $prefix.'phone',
        'type' => 'text',
        'desc'    => esc_html__('e.g. 1-896-567-234', 'edumy')
    );
    $fields[] = array(
        'name' => esc_html__( 'Email', 'edumy' ),
        'id'   => $prefix.'email',
        'type' => 'text',
        'desc'    => esc_html__('e.g. example@example.com', 'edumy')
    );
    $fields[] = array(
        'name' => esc_html__( 'Website', 'edumy' ),
        'id'   => $prefix.'website',
        'type' => 'text',
        'desc'    => esc_html__('e.g. http://www.edumy.com', 'edumy')
    );
    $fields[] = array(
        'id'          => $prefix.'participants',
        'type'        => 'group',
        'options'     => array(
            'group_title'       => esc_html__( 'Participant {#}', 'edumy' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => esc_html__( 'Add Another Participant', 'edumy' ),
            'remove_button'     => esc_html__( 'Remove Participant', 'edumy' ),
            'sortable'          => true,
        ),
        'fields' => array(
            array(
                'name' => esc_html__( 'Image', 'edumy' ),
                'id'   => 'image',
                'type' => 'file',
                'query_args' => array(
                    'type' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    ),
                ),
                'preview_size' => 'thumbnail'
            ),
            array(
                'name' => esc_html__( 'Name', 'edumy' ),
                'id'   => 'name',
                'type' => 'text',
                'desc'    => esc_html__('e.g. John Doe', 'edumy')
            ),
            array(
                'name' => esc_html__( 'Job', 'edumy' ),
                'id'   => 'job',
                'type' => 'text',
                'desc'    => esc_html__('e.g. Web Designer', 'edumy')
            ),
        )
    );
    return $fields;
}
add_filter('apussimpleevent_postype_event_metaboxes_fields_management', 'edumy_event_metaboxes', 10, 2);

function edumy_event_map_api_key($key) {
    $key = edumy_get_config('google_map_api_key');
    return $key;
}
add_filter('apussimpleevent_map_api_key', 'edumy_event_map_api_key');
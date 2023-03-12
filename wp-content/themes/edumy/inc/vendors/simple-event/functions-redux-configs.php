<?php

// Event Archive settings
function edumy_simple_event_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-website',
        'title' => esc_html__('Event Settings', 'edumy'),
        'fields' => array(
            array(
                'id' => 'events_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'events_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'edumy'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'edumy'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'edumy').'</em>',
                'id' => 'events_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'events_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'edumy'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'edumy'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Events Archives', 'edumy'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'events_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'events_display_mode',
                'type' => 'select',
                'title' => esc_html__('Events Layout', 'edumy'),
                'subtitle' => esc_html__('Choose a default layout archive event.', 'edumy'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'edumy'),
                    'list' => esc_html__('List', 'edumy'),
                ),
                'default' => 'grid'
            ),
            array(
                'id' => 'events_columns',
                'type' => 'select',
                'title' => esc_html__('Event Columns', 'edumy'),
                'options' => $columns,
                'default' => 3,
                'required' => array('events_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'number_events_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Events Per Page', 'edumy'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'events_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'events_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'edumy'),
                'default' => false
            ),
            array(
                'id' => 'events_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Event Layout', 'edumy'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive event page.', 'edumy'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'edumy'),
                        'alt' => esc_html__('Main Content', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'edumy'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'edumy'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'events_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'edumy'),
                'options' => $sidebars
            ),
            array(
                'id' => 'events_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'edumy'),
                'options' => $sidebars
            ),
        )
    );
    
    
    // Event Page
    $sections[] = array(
        'title' => esc_html__('Event Single', 'edumy'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'event_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'event_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'edumy'),
                'default' => false
            ),
            array(
                'id' => 'show_event_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'edumy'),
                'default' => 1
            ),
            array(
                'id' => 'event_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'event_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Event Sidebar Layout', 'edumy'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Event Page.', 'edumy'),
                'options' => array(
                	'main' => array(
                        'title' => esc_html__('Main Content', 'edumy'),
                        'alt' => esc_html__('Main Content', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left - Main Sidebar', 'edumy'),
                        'alt' => esc_html__('Left - Main Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main - Right Sidebar', 'edumy'),
                        'alt' => esc_html__('Main - Right Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'event_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'edumy'),
                'options' => $sidebars
            ),
            array(
                'id' => 'event_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'edumy'),
                'options' => $sidebars
            ),
        )
    );

    return $sections;
}
add_filter( 'edumy_redux_framwork_configs', 'edumy_simple_event_redux_config', 30, 3 );
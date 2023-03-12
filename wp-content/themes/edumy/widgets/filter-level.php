<?php

$levels = edumy_course_get_levels();

if ( ! empty( $levels ) ) {
    extract( $args );
    extract( $instance );
    $title = apply_filters('widget_title', $instance['title']);

    if ( $title ) {
        echo trim($before_title)  . trim( $title ) . $after_title;
    }

    $courses_page_id  = learn_press_get_page_id( 'courses' );
    $url = get_permalink($courses_page_id);
    $selected = isset($_GET['filter-level']) ? $_GET['filter-level'] : '';
    
?>
    <div class="filter-levels-widget">
        <form action="<?php echo esc_url($url); ?>" method="get">
        	<ul class="level-list">
                <?php foreach ($levels as $key => $title) {
                    $query_args = array(
                        'post_type' => LP_COURSE_CPT,
                        'posts_per_page' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_lp_level',
                                'value' => $key,
                                'compare' => '=',
                            )
                        ),
                    );
                    $loop = new WP_Query($query_args);
                    $courses_count = $loop->found_posts;
                ?>
                    <li>
                        <input id="filter-level-<?php echo esc_attr($key); ?>" type="radio" name="filter-level" value="<?php echo esc_attr($key); ?>" <?php checked($selected, $key); ?>>
                        <label for="filter-level-<?php echo esc_attr($key); ?>"><?php echo esc_html($title); ?> <span class="count">(<?php echo esc_html($courses_count); ?>)</span></label>
                    </li>
                <?php } ?>
            </ul>
            <?php edumy_query_string_form_fields( null, array( 'submit', 'paged', 'filter-level' ) ); ?>
        </form>
    </div>
<?php }
<?php

$instructors = edumy_course_get_instructors();

if ( ! empty( $instructors ) ) {
    extract( $args );
    extract( $instance );
    $title = apply_filters('widget_title', $instance['title']);

    if ( $title ) {
        echo trim($before_title)  . trim( $title ) . $after_title;
    }

    $courses_page_id  = learn_press_get_page_id( 'courses' );
    $url = get_permalink($courses_page_id);
    $selected = isset($_GET['filter-instructor']) ? $_GET['filter-instructor'] : '';
    
?>
    <div class="filter-instructors-widget">
        <form action="<?php echo esc_url($url); ?>" method="get">
        	<ul class="instructor-list">
                <?php foreach ($instructors as $instructor) {
                    $query_args = array(
                        'post_type' => LP_COURSE_CPT,
                        'posts_per_page' => 1,
                        'author' => $instructor->ID,
                    );
                    $loop = new WP_Query($query_args);
                    $courses_count = $loop->found_posts;
                ?>
                    <li>
                        <input id="filter-instructor-<?php echo esc_attr($instructor->ID); ?>" type="radio" name="filter-instructor" value="<?php echo esc_attr($instructor->ID); ?>" <?php checked($selected, $instructor->ID); ?>>
                        <label for="filter-instructor-<?php echo esc_attr($instructor->ID); ?>"><?php echo esc_html($instructor->display_name); ?> <span class="count">(<?php echo esc_html($courses_count); ?>)</span></label>
                    </li>
                <?php } ?>
            </ul>
            <?php edumy_query_string_form_fields( null, array( 'submit', 'paged', 'filter-instructor' ) ); ?>
        </form>
    </div>
<?php }
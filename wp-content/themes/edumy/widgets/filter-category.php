<?php

$args = array(
    'taxonomy' => 'course_category',
    'hide_empty' => false,
    'orderby' => 'date',
    'order' => 'DESC',
);
$terms = get_terms($args);
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    extract( $args );
    extract( $instance );
    $title = apply_filters('widget_title', $instance['title']);

    if ( $title ) {
        echo trim($before_title)  . trim( $title ) . $after_title;
    }

    $courses_page_id  = learn_press_get_page_id( 'courses' );
    $url = get_permalink($courses_page_id);
    $selected = isset($_GET['filter-category']) ? $_GET['filter-category'] : '';
?>
    <div class="filter-categories-widget">
        <form action="<?php echo esc_url($url); ?>" method="get">
        	<ul class="category-list">
                <?php foreach ($terms as $term) { ?>
                    <li>
                        <input id="filter-category-<?php echo esc_attr($term->term_id); ?>" type="radio" name="filter-category" value="<?php echo esc_attr($term->term_id); ?>" <?php checked($selected, $term->term_id); ?>>
                        <label for="filter-category-<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?> <span class="count">(<?php echo esc_html($term->count); ?>)</span></label>
                    </li>
                <?php } ?>
            </ul>
            <?php edumy_query_string_form_fields( null, array( 'submit', 'paged', 'filter-category' ) ); ?>
        </form>
    </div>
<?php }
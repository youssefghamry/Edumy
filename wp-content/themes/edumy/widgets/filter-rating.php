<?php

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$courses_page_id  = learn_press_get_page_id( 'courses' );
$url = get_permalink($courses_page_id);
$selected = isset($_GET['filter-rating']) ? $_GET['filter-rating'] : '';

?>
<div class="filter-rating-widget">
    <form action="<?php echo esc_url($url); ?>" method="get">
    	<ul class="rating-list">
            <?php for ($i=5; $i >= 1; $i--) {
            ?>
                <li>
                    <input id="filter-rating-<?php echo esc_attr($i); ?>" type="radio" name="filter-rating" value="<?php echo esc_html($i); ?>" <?php checked($selected, $i); ?>>
                    <label for="filter-rating-<?php echo esc_attr($i); ?>">
                        <?php Edumy_Course_Review::print_review($i); ?>
                    </label>
                </li>
            <?php } ?>
        </ul>
        <?php edumy_query_string_form_fields( null, array( 'submit', 'paged', 'filter-rating' ) ); ?>
    </form>
</div>
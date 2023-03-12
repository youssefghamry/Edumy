<?php

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$courses_page_id  = learn_press_get_page_id( 'courses' );
$url = get_permalink($courses_page_id);
$selected = isset($_GET['filter-price']) ? $_GET['filter-price'] : '';

?>
<div class="filter-price-widget">
    <form action="<?php echo esc_url($url); ?>" method="get">
    	<ul class="price-list">
            <li>
                <input id="filter-price-free" type="radio" name="filter-price" value="free" <?php checked($selected, 'free'); ?>>
                <label for="filter-price-free"><?php echo esc_html_e('Free', 'edumy'); ?></label>
            </li>
            <li>
                <input id="filter-price-paid" type="radio" name="filter-price" value="paid" <?php checked($selected, 'paid'); ?>>
                <label for="filter-price-paid"><?php echo esc_html_e('Paid', 'edumy'); ?></label>
            </li>
        </ul>
        <?php edumy_query_string_form_fields( null, array( 'submit', 'paged', 'filter-price' ) ); ?>
    </form>
</div>
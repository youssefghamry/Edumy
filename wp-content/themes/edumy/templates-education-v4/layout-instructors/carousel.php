<?php
global $post;
if ( empty($instructors) ) {
    return;
}

$show_nav = isset($show_nav) ? $show_nav : false;
$show_pagination = isset($show_pagination) ? $show_pagination : false;
$rows = isset($rows) ? $rows : 1;
$columns = isset($columns) ? $columns : 3;
$small_cols = $columns <= 1 ? 1 : 2;

?>
<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
    data-smallmedium="<?php echo esc_attr($small_cols); ?>"
    data-extrasmall="1"
    data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">

    <?php
        $file_name = 'content-instructor';
        if ( $item_style == 'style2' ) {
            $file_name = 'content-instructor-2';
        }
        foreach ( $instructors as $instructor ) {
            learn_press_get_template( $file_name, array('instructor' => $instructor) );
        }
    ?>

</div>
<?php wp_reset_postdata(); ?>
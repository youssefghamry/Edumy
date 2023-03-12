<?php
global $post;
if ( empty($courses) ) {
    return;
}

$show_nav = isset($show_nav) ? $show_nav : false;
$show_pagination = isset($show_pagination) ? $show_pagination : false;
$rows = isset($rows) ? $rows : 1;
$columns = isset($columns) ? $columns : 3;
$small_cols = $columns <= 1 ? 1 : 2;
$smalldesktop_cols = $columns >= 5 ? 4 : $columns;

?>
<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
    data-large="<?php echo esc_attr($smalldesktop_cols); ?>"
    data-smallmedium="<?php echo esc_attr($small_cols); ?>"
    data-extrasmall="1"
    data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>"
    data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>"
    data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>"
    data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">

    <?php
        foreach ( $courses as $course_id ) {
            $post = get_post( $course_id );
            setup_postdata( $post );
            ?>
            <div class="item">
                <?php learn_press_get_template_part( 'content-course' ); ?>
            </div>
            <?php
        }
    ?>

</div>
<?php wp_reset_postdata(); ?>
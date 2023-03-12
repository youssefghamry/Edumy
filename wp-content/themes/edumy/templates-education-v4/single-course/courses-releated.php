<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

$relate_count = edumy_get_config('number_course_releated', 2);
$relate_columns = edumy_get_config('releated_course_columns', 2);
$terms = get_the_terms( $post->ID, 'course_category' );
$termids =array();

if ($terms) {
    foreach($terms as $term) {
        $termids[] = $term->term_id;
    }
}

$args = array(
    'post_type' => LP_COURSE_CPT,
    'posts_per_page' => $relate_count,
    'post__not_in' => array( $post->ID ),
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'course_category',
            'field' => 'id',
            'terms' => $termids,
            'operator' => 'IN'
        )
    )
);
$relates = new WP_Query( $args );
if( $relates->have_posts() ):
?>
<div class="widget related-posts">
    <h3 class="widget-title title">
        <span><?php esc_html_e( 'Related Courses', 'edumy' ); ?></span>
    </h3>
    <div class="related-courses-content widget-content">
        <div class="slick-carousel" data-carousel="slick" data-smallmedium="2" data-extrasmall="1" data-items="<?php echo esc_attr($relate_columns); ?>" data-pagination="false" data-nav="true">
            <?php while ( $relates->have_posts() ) : $relates->the_post(); ?>
                <div class="item">
                    <?php learn_press_get_template_part( 'content-course' ); ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
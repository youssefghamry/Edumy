<?php

global $post;

if ( ! $course = LP_Global::course() ) {
	return;
}

$tags = get_the_terms($post->ID, 'course_tag');

if ( $tags && ! is_wp_error( $tags ) ) {
	extract( $args );
	extract( $instance );
	$title = apply_filters('widget_title', $instance['title']);

	if ( $title ) {
	    echo trim($before_title)  . trim( $title ) . $after_title;
	}

	?>
	<div class="course-tags-widget">
		<ul class="tags">
			<?php foreach ($tags as $term) { ?>
				<li><a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a></li>
			<?php } ?>
		</ul>
	</div>
<?php }
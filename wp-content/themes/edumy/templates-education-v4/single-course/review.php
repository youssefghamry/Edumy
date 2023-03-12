<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$rating = intval( get_comment_meta( $comment->comment_ID, '_rating', true ) );

?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="the-comment media">
		<div class="avatar media-left">
			<?php echo get_avatar( $comment->user_id, '80', '' ); ?>
		</div>
		<div class="comment-box media-body">

			<div class="meta">
				<h3 class="title-author"><?php comment_author(); ?></h3> 
				<div class="info-meta">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<span class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'edumy' ); ?></em></span>
					<?php else : ?>
						<span class="meta">
							<time><?php echo get_comment_date( get_option('date_format', 'd M, Y') ); ?></time>
						</span>
					<?php endif; ?>
				</div>

				<div class="star-rating clear pull-right" title="<?php echo sprintf(esc_attr__( 'Rated %d out of 5', 'edumy' ), $rating ) ?>">
					<?php Edumy_Course_Review::print_review($rating); ?>
				</div>
			</div>
			<div itemprop="description" class="comment-text">
				<?php comment_text(); ?>
			</div>

			<div id="comment-reply-wrapper-<?php comment_ID(); ?>">
				<?php comment_reply_link(array_merge( $args, array(
					'reply_text' => esc_html__('Reply', 'edumy'),
					'add_below' => 'comment-reply-wrapper',
					'depth' => 1,
					'max_depth' => $args['max_depth']
				))) ?>
			</div>
		</div>
	</div>
<?php

$GLOBALS['comment'] = $comment;
$add_below = '';

?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment">
		<?php if(get_avatar($comment, 92)){ ?>
			<div class="avatar">
				<?php echo get_avatar($comment, 92); ?>
			</div>
		<?php } ?>
		<div class="comment-box">
			<div class="comment-author meta clearfix">				
				<div class="comment-author-name pull-left">
					<div class="entry-post-author">
						<strong><?php echo get_comment_author_link() ?></strong>
					</div>
					<div class="date"><?php printf(esc_html__('%1$s', 'edumy'), get_comment_date()) ?></div>		
				</div>
				<div class="comment-author-action pull-right">
					<?php edit_comment_link(esc_html__('Edit', 'edumy'),'  ','') ?>
					<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'edumy'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>				
			</div>
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'edumy') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>			
		</div>
	</div>

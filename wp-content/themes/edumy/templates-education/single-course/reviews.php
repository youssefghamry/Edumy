<?php

global $post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}
global $post;
$total_rating = Edumy_Course_Review::get_ratings_average( $post->ID );
$comment_ratings = Edumy_Course_Review::get_detail_ratings( $post->ID );
$total = Edumy_Course_Review::get_total_reviews( $post->ID );
?>
<div id="reviews">
	<div class="course-rating clearfix">
		<h3 class="widget-title"><span><?php esc_html_e( 'Reviews', 'edumy' ); ?></span></h3>
		<div class="box-inner">
			
			<div class="detail-rating">
					<div class="detail-rating-inner">
						<?php for ( $i = 5; $i >= 1; $i -- ) : ?>
							<div class="list-rating">
								<div class="stars"><?php printf( esc_html__( '%s stars', 'edumy' ), $i ); ?></div>
								<div class="progress">
									<div class="progress-bar progress-bar-success" style="<?php echo esc_attr(( $total && !empty( $comment_ratings[$i]->quantity ) ) ? esc_attr( 'width: ' . ( $comment_ratings[$i]->quantity / $total * 100 ) . '%' ) : 'width: 0%'); ?>">
									</div>
								</div>
								<div class="value"><?php echo empty( $comment_ratings[$i]->quantity ) ? '0' : esc_html( $comment_ratings[$i]->quantity ); ?></div>
							</div>
						<?php endfor; ?>
					</div>
			</div>
			<div class="average-rating pull-right">
					<div class="average-value"><?php echo number_format((float)$total_rating, 1, '.', ''); ?></div>
					<div class="percent-star">
						<?php Edumy_Course_Review::print_review( $total_rating ); ?>
					</div>
					<div class="numbers-rating">
						<?php $total ? printf( _n( '%1$s rating', '%1$s ratings', $total, 'edumy' ), number_format_i18n( $total ) ) : esc_html_e( '0 rating', 'edumy' ); ?>
					</div>
			</div>
		</div>
	</div>

	<div id="comments">
		<?php if ( have_comments() ) : ?>
			
			<ol class="comment-list">
				<?php wp_list_comments( array( 'callback' => array( 'Edumy_Course_Review', 'course_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="apus-pagination">';
				paginate_comments_links( apply_filters( 'apus_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>
			
		<?php endif; ?>
	</div>
	<?php $commenter = wp_get_current_commenter(); ?>
	<div id="review_form_wrapper" class="commentform">
		<div class="reply_comment_form hidden">
			<?php
				$comment_form = array(
					'title_reply'          => esc_html__( 'Reply comment', 'edumy' ),
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'edumy' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="row"><div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Name', 'edumy' ).'</label>'.
						            '<input id="author" class="form-control" placeholder="'.esc_attr__( 'Your Name', 'edumy' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
						'email'  => '<div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Email', 'edumy' ).'</label>' .
						            '<input id="email" placeholder="'.esc_attr__( 'your@mail.com', 'edumy' ).'" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						            'url' => '<div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Website', 'edumy' ).'</label>
                                            <input id="url" name="url" placeholder="'.esc_attr__( 'Your Website', 'edumy' ).'" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                       	</div></div></div>',
					),
					'label_submit'  => esc_html__( 'Submit', 'edumy' ),
					'logged_in_as'  => '',
					'comment_field' => ''
				);

				$comment_form['comment_field'] .= '<div class="form-group"><textarea placeholder="'.esc_attr__( 'Write Comment', 'edumy' ).'" id="comment" class="form-control" name="comment" cols="45" rows="5" aria-required="true" placeholder="'.esc_attr__( 'Write Comment', 'edumy' ).'"></textarea></div>';
				
				$comment_form['must_log_in'] = '<p class="must-log-in">' .  esc_html__( 'You must be logged in to reply this review.', 'edumy' ) . '</p>';
				
				edumy_comment_form($comment_form);
			?>
		</div>
		<div id="review_form">
			<?php
				$comment_form = array(
					'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'edumy' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'edumy' ), get_the_title() ),
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'edumy' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="row"><div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Name', 'edumy' ).'</label>'.
						            '<input id="author" placeholder="'.esc_attr__( 'Your Name', 'edumy' ).'" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
						'email'  => '<div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Email', 'edumy' ).'</label>' .
						            '<input id="email" placeholder="'.esc_attr__( 'your@mail.com', 'edumy' ).'" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						            'url' => '<div class="col-xs-12 col-sm-12"><div class="form-group"><label>'.esc_html__( 'Website', 'edumy' ).'</label>
                                            <input id="url" placeholder="'.esc_attr__( 'Your Website', 'edumy' ).'" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                       	</div></div></div>',
					),
					'label_submit'  => esc_html__( 'Submit Review', 'edumy' ),
					'logged_in_as'  => '',
					'comment_field' => ''
				);

				
				$comment_form['must_log_in'] = '<div class="must-log-in">' .  esc_html__( 'You must be logged in to post a review.', 'edumy' ) . '</div>';
				

				$comment_form['comment_field'] = '<div class="choose-rating clearfix"><div class="choose-rating-inner">'.'

					<div class="form-group yourview"><div class="comment-form-rating"><label for="rating">' . esc_html__( 'What is it like to Course?', 'edumy' ) .'</label>
						<div class="review-stars-wrap">						
						<ul class="review-stars">
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
						<ul class="review-stars filled">
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul></div>
						<input type="hidden" value="5" name="rating" id="apus_input_rating">
						</div></div></div></div>
						' ;
				

				$comment_form['comment_field'] .= '<div class="form-group"><label>'.esc_html__( 'Review', 'edumy' ).'</label><textarea id="comment" class="form-control" placeholder="'.esc_attr__( 'Write Review', 'edumy' ).'" name="comment" cols="45" rows="5" aria-required="true"></textarea></div>';
				
				edumy_comment_form($comment_form);
			?>
		</div>
	</div>
</div>
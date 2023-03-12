<?php

global $post;
$args = array( 'position' => 'top', 'animation' => 'true' );
?>
<div class="apus-social-share">
		<div class="bo-social-icons bo-sicolor social-radius-rounded">
		<span class="title"><?php echo esc_html__('Share Link:','edumy'); ?> </span>
		<?php if ( edumy_get_config('facebook_share', 1) ): ?>
 
			<a class="bo-social-facebook" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank" title="<?php esc_attr_e('Share on facebook', 'edumy'); ?>">
				<i class="fa fa-facebook"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( edumy_get_config('twitter_share', 1) ): ?>
 
			<a class="bo-social-twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank" title="<?php esc_attr_e('Share on Twitter', 'edumy'); ?>">
				<i class="fa fa-twitter"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( edumy_get_config('linkedin_share', 1) ): ?>
 
			<a class="bo-social-linkedin" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php esc_attr_e('Share on LinkedIn', 'edumy'); ?>">
				<i class="fa fa-linkedin"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( edumy_get_config('tumblr_share', 1) ): ?>
 
			<a class="bo-social-tumblr" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank" title="<?php esc_attr_e('Share on Tumblr', 'edumy'); ?>">
				<i class="fa fa-tumblr"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( edumy_get_config('google_share', 1) ): ?>
 
			<a class="bo-social-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" title="<?php esc_attr_e('Share on Google plus', 'edumy'); ?>">
				<i class="fa fa-google-plus"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( edumy_get_config('pinterest_share', 1) ): ?>
 
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<a class="bo-social-pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank" title="<?php esc_attr_e('Share on Pinterest', 'edumy'); ?>">
				<i class="fa fa-pinterest"></i>
			</a>
 
		<?php endif; ?>
	</div>
</div>	
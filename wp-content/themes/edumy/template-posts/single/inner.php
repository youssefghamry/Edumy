<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="top-info-detail post-layout">
            <?php if( $post_format == 'link' ) {
                $format = edumy_post_format_link_helper( get_the_content(), get_the_title() );
                $title = $format['title'];
                $link = edumy_get_link_attributes( $title );
                $thumb = edumy_post_thumbnail('', $link);
                echo trim($thumb);
            } else { ?>
                <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                    <?php
                        $thumb = edumy_post_thumbnail();
                        echo trim($thumb);
                    ?>
                </div>
            <?php } ?>
            <?php edumy_post_categories($post); ?>
            <div class="entry-date-time">
                <a href="<?php the_permalink(); ?>">
                    <span class="day"><?php the_time( 'd' ); ?> </span>
                    <span class="month"><?php the_time( 'M' ); ?> </span>         
                </a>
            </div>
        </div>
    <?php } ?>
	<div class="entry-content-detail">
        <?php if (get_the_title()) { ?>
            <h1 class="entry-title-detail">
                <?php the_title(); ?>
            </h1>
        <?php } ?>
        <div class="post-layout">
            <div class="top-info">
                <span class="entry-author">
                    <i class="flaticon-profile"></i>
                    <?php the_author(); ?>
                </span>
                <span class="comments">
                    <i class="flaticon-consulting-message"></i>
                    <?php comments_number( esc_html__('0 Comments', 'edumy'), esc_html__('1 Comment', 'edumy'), esc_html__('% Comments', 'edumy') ); ?></span>
            </div>
        </div>
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php the_content(); ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'edumy' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'edumy' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
            <?php  
                $posttags = get_the_tags();
            ?>
            <?php if( !empty($posttags) || edumy_get_config('show_blog_social_share', false) ){ ?>
        		<div class="tag-social clearfix">
                    <?php edumy_post_tags(); ?>
        			<?php if( edumy_get_config('show_blog_social_share', false) ) {
        				get_template_part( 'template-parts/sharebox' );
        			} ?>
        		</div>
            <?php } ?>
    	</div>
    </div>
</article>
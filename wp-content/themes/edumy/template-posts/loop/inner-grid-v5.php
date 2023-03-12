<?php 
    $thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
    $thumb = edumy_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-grid-v5'); ?>>
    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <span class="post-sticky"><?php echo esc_html__('Featured','edumy'); ?></span>
    <?php endif; ?>

    <?php if( $thumb ) { ?>
        <div class="top-info-detail">
            <div class="top-image">
                <?php echo trim($thumb); ?>            
            </div>            
            <div class="entry-date-time">
                <a href="<?php the_permalink(); ?>">
                    <span class="day"><?php the_time( 'y' ); ?> </span>
                    <span class="month"><?php the_time( 'M' ); ?> </span> 
                </a>
            </div>
        </div>
    <?php } ?>

    <?php edumy_post_categories($post); ?>

    <?php if (get_the_title()) { ?>
        <h4 class="entry-title-detail">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
    <?php } ?>

</article>
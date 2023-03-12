<?php $thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-grid-v2'); ?>>
    <?php
        $thumb = edumy_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="entry-date-time">        
        <?php get_the_date(); ?>
        <span class="day"><?php the_time( 'd' ); ?> </span>
        <span class="month"><?php the_time( 'M' ); ?> </span> 
    </div>
    <div class="content">
        <div class="bottom-info">
            <?php edumy_post_categories($post); ?>
        </div>
        <?php if (get_the_title()) { ?>
            <h4 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>
    </div>
</article>
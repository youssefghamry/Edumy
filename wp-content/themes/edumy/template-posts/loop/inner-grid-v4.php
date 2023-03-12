<?php $thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-layout post-grid-v4'); ?>>
    <?php
        $thumb = edumy_display_post_thumb($thumbsize);        
    ?>
    <?php if( $thumb ) { ?>
        <div class="top-info-detail">
            <div class="top-image">
                <?php echo trim($thumb); ?>            
            </div>          
        </div>
    <?php } ?>

    <div class="content">
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title-detail">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>

        <div class="top-info">
            <div class="entry-date">
                <?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>            
        </div>      

    </div>
</article>

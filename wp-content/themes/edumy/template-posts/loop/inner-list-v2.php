<?php 
global $post;
$thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = edumy_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-v2'); ?>>
    <div class="list-inner">
        <div class="post-list-wrapper flex-top <?php echo (!empty($thumb))?'col-haf':'col-full'; ?>">
            <?php
                if ( $thumb ) {
                    ?>
                    <div class="image">
                        <div class="top-info-detail">
                            <div class="top-image">
                                <?php echo trim($thumb); ?>
                            </div>
                        </div>                        
                    </div>
                    <?php
                }
            ?>
            <div class="post-list-content">      
                <div class="post-list-item-content">
                    <?php if (get_the_title()) { ?>
                        <h4 class="entry-title-detail">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    <?php } ?>
                    <div class="entry-date">
                        <?php the_time( get_option('date_format', 'd M, Y') ); ?>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</article>
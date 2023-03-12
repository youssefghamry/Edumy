<?php 
global $post;
$thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = edumy_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-item'); ?>>
    <div class="list-inner">
        <div class="row <?php echo (!empty($thumb))?'flex-top':''; ?>">

            <?php
                if ( $thumb ) {
                    ?>
                    <div class="image col-xs-5">
                        <div class="top-info-detail">
                            <div class="top-image">
                                <?php echo trim($thumb); ?>
                            </div>
                            <?php edumy_post_categories($post); ?>
                            <div class="entry-date-time">
                                <a href="<?php the_permalink(); ?>">
                                    <span class="day"><?php the_time( 'd' ); ?> </span>
                                    <span class="month"><?php the_time( 'M' ); ?> </span> 
                                </a>
                            </div>
                        </div>                        
                    </div>
                    <?php
                }
            ?>

            <div class="<?php echo (!empty($thumb))?'col-xs-7':'col-xs-12 no-thumbnail'; ?>">      
                <div class="post-list-item-content">
                    <?php if (get_the_title()) { ?>
                        <h4 class="entry-title-detail">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    <?php } ?>

                    <div class="top-info">
                        <span class="entry-author">
                            <i class="flaticon-profile"></i>
                            <?php the_author(); ?>
                        </span>
                        <span class="comments">
                            <i class="flaticon-consulting-message"></i>
                            <?php comments_number( esc_html__('0 Comments', 'edumy'), esc_html__('1 Comment', 'edumy'), esc_html__('% Comments', 'edumy') ); ?>
                        </span>
                    </div>

                    <div class="description"><?php echo wp_kses_post(edumy_substring( get_the_excerpt(), 60, '...' )); ?></div>
                    <p class="post-button"><a href="<?php the_permalink(); ?>" class="btn btn-readmore"><?php esc_html_e('Read more', 'edumy'); ?></a></p>                    
                </div>
            </div>
        </div>
    </div>
</article>
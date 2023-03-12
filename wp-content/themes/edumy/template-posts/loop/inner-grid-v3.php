<?php $thumbsize = !isset($thumbsize) ? edumy_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-layout post-grid-v3'); ?>>
    <?php
        $thumb = edumy_display_post_thumb($thumbsize);        
    ?>

    <?php if( $thumb ) { ?>
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
    <?php } ?>

    <div class="content">
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

        <?php if(has_excerpt()){ ?>
            <div class="description"><?php echo wp_kses_post(edumy_substring( get_the_excerpt(),21, '...' )); ?></div>
        <?php } ?>

    </div>
</article>

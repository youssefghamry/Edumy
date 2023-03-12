<?php 
global $product;
$product_id = $product->get_id();
?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="grid-inner">
        <?php 
            do_action( 'edumy_woocommerce_loop_sale_flash' );
        ?>
        <div class="block-inner">
            <figure class="image">
                <?php
                    $image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';
                    edumy_product_image($image_size);
                ?>
                <?php
                    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
                    remove_action('woocommerce_before_shop_loop_item_title', 'edumy_swap_images', 10);
                    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </figure>            
        </div>
        <div class="metas clearfix">
            <div class="title-wrapper">
                <div class="product-info-left clearfix">                                                        
                    <?php
                        /**
                        * woocommerce_after_shop_loop_item_title hook
                        *
                        * @hooked woocommerce_template_loop_rating - 5
                        * @hooked woocommerce_template_loop_price - 10
                        */
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                        do_action( 'woocommerce_after_shop_loop_item_title');
                    ?>  
                    <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  
                    <?php
                        $rating_html = wc_get_rating_html( $product->get_average_rating() );
                        if ( $rating_html ) {
                            ?>
                            <div class="rating clearfix">
                                <?php echo trim( $rating_html ); ?>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="groups-button clearfix">
                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                </div> 
            </div>
        </div>
    </div>
</div>
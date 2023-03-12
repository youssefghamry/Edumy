<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="apus-woocommerce-product-gallery-wrapper">
    <?php
      $video = get_post_meta( $post->ID, 'apus_product_review_video', true );

      if (!empty($video)) {
        ?>
        <div class="video">
          <a href="<?php echo esc_url($video); ?>" class="popup-video">
            <i class="fa fa-play"></i>
            <span class="text-theme"><?php echo esc_html__('Watch video', 'edumy'); ?></span>
          </a>
        </div>
        <?php
      }
    ?>

	<div class="slick-carousel apus-woocommerce-product-gallery" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="false">
		<?php
		
		if ( has_post_thumbnail() ) {
			$html  = edumy_wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_attr__( 'Awaiting product image', 'edumy' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $attachment_id ) {
		 		$html  = edumy_wc_get_gallery_image_html( $attachment_id, true );
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}

		?>
	</div>
</div>
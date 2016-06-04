<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_count   = count( $product->get_gallery_attachment_ids() );
?>
	<div class="woocommerce-single-image-wrap">
	<?php
	?>
	<div class="gridblock-owlcarousel-wrap clearfix">
	<div id="owl-woocommerce-slideshow" class="owl-carousel owl-slideshow-element">
			<?php
			// Display the post thumbnail
			if ( has_post_thumbnail() ) {

				$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
				
				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				if ( $attachment_count > 0 ) {
					echo '<div class="gridblock-slideshow-element woo-slidshow-image">';
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-lightbox="magnific-image-gallery">%s</a>', $image_link, $image_title, $image ), $post->ID );
					echo '</div>';
				} else {
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-lightbox="magnific-image-gallery">%s</a>', $image_link, $image_title, $image ), $post->ID );
				}

			}

			// Add any attachments - excludes the post thumbnail.
			$attachment_ids = $product->get_gallery_attachment_ids();
			$loop = 0;
			if ( $attachment_ids ) {
				
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ( $attachment_ids as $attachment_id ) {

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo '<div class="gridblock-slideshow-element woo-slidshow-image">';
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-lightbox="magnific-image-gallery">%s</a>', $image_link, $image_title, $image ), $post->ID );
					echo '</div>';
					$loop++;
				}

			}
	echo '</div>';
	echo '</div>';
	?>
	<?php
		do_action( 'woocommerce_product_thumbnails' );
	?>
</div>
<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();
if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
	$product_detail_style              = kite_get_meta( 'product_detail_style' ); // style of product detail in product page

} else {
	$product_detail_style              = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
}

	// KiteSt codes
	// variation images
	$variable_images = array();
if ( $product->is_type( 'variable' ) ) {
	$get_variations       = sizeof( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
	$available_variations = array_reverse( $get_variations ? $product->get_available_variations() : array() );

	foreach ( $available_variations as $variable ) {
		if ( isset( $variable['image']['url'] ) && $variable['image']['url'] != '' ) {
			$variable_images[] = esc_url( $variable['image']['url'] );
		}
	}

	$variable_images =  array_unique( $variable_images );
}

if ( ( count( $attachment_ids ) + count( $variable_images ) ) > 0 ) {

	$processed_images = array();

	if ( $attachment_ids || count( $variable_images ) > 0 ) {
		?>
		<div class="thumbnails zoom-gallery">
			<div id="product-thumbs" <?php if( $product_detail_style == 'pd_sticky' ) { ?> data-sticky_column <?php } ?>>
				<div class="swiper-container clearfix 
				<?php
				if ( kite_opt( 'product_gallery_autoplay', true ) != 0 ) { ?> auto-play <?php } ?> ">
					<div class="swiper-wrapper">
							<?php

							$columns         = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
							$image_dimension = wc_get_image_size( 'gallery_thumbnail' );

							if ( has_post_thumbnail() ) {
								$thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
								$image = $thumb_image[0];
								$image_sizes = $image_dimension['width'];
								$i = 0;

								$srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id( $post->ID ) );
								$srcset_attr  = !empty( $srcset ) ? 'srcset="' . $srcset . '"' : '';

								$image = '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( get_the_title( get_post_thumbnail_id( $post->ID ) ) ) . '" ' . $srcset_attr . ' sizes="' . esc_attr( $image_sizes ) . 'px">';

								echo '<div class="swiper-slide" data-image-attribute="'.esc_attr( $i ).'">';
								echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image, $post->ID, $post->ID );
								echo '</div>';

								preg_match( '@src="([^"]+)"@', $image, $match );
								$src                = array_pop( $match );
								$processed_images[] = $src;
							}

							// variation images
							if ( $product->is_type( 'variable' ) ) {
								$k=1;
								foreach ( $variable_images as $key => $variable_image ) {
									// crop variable Image
										$variable_url = $variable_image;

									if ( in_array( $variable_url, $processed_images ) ) {
										continue;
									}
									$processed_images[] = $variable_url;
									$img_alt="";
									echo '<div class="swiper-slide" data-image-attribute="'.esc_attr( $k ).'">';
									echo '<img src="' . esc_url( $variable_url ) . '" alt="' . ( ( $img_alt = get_the_title( attachment_url_to_postid( $variable_url ) ) ) ? esc_attr( $img_alt ) : '' ) . '">';
									echo '</div>';
									$k++;
									$k = $k++;
									
				
								}$k = $k; 
								foreach ( $attachment_ids as $attachment_id ) {
									if ( array( 'is_quick_view' => true ) ) {
										$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
									} else {
										$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'gallery_thumbnail' ) );
									}

									preg_match( '@src="([^"]+)"@', $image, $match );
									$src = array_pop( $match );
									if ( in_array( $src, $processed_images ) ) {
										continue;
									}
									$processed_images[] = $src;



									echo '<div class="swiper-slide" data-image-attribute="'.esc_attr( $k ).'">';
									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image, $attachment_id, $post->ID );
									echo '</div>';
									$k++;
								}
								
							}
							$j = 1;
							if(!$product->is_type( 'variable' )){
							foreach ( $attachment_ids as $attachment_id ) {
								if ( array( 'is_quick_view' => true ) ) {
									$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
								} else {
									$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'gallery_thumbnail' ) );
								}

								preg_match( '@src="([^"]+)"@', $image, $match );
								$src = array_pop( $match );
								if ( in_array( $src, $processed_images ) ) {
									continue;
								}
								$processed_images[] = $src;



								echo '<div class="swiper-slide" data-image-attribute="'.esc_attr( $j ).'">';
								echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image, $attachment_id, $post->ID );
								echo '</div>';
								$j++;
							}}

							?>
								
					</div>
				
					
				</div>
			</div>
		</div>
		<?php
	}
}

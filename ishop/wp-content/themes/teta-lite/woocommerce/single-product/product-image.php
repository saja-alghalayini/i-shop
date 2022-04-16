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
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;


// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;
$product_gallery_popup = kite_opt( 'product_gallery_popup', false );
$attachment_ids        = $product->get_gallery_image_ids();

// KiteSt codes
$image_num = count( $attachment_ids ) + ( has_post_thumbnail() ? 1 : 0 );

$processed_images = array();

// variation images
$variable_images       = array();
$variable_image_titles = array();
$variations_id         = array();
if ( $product->is_type( 'variable' ) ) {
	$get_variations       = sizeof( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
	$available_variations = array_reverse( $get_variations ? $product->get_available_variations() : array() );
	foreach ( $available_variations as $variable ) {
		if ( isset( $variable['image']['url'] ) && $variable['image']['url'] != '' ) {
			$variations_id[]         = $variable['variation_id'];
			$variable_images[]       = esc_url( $variable['image']['url'] );
			$variable_srcset[]       = $variable['image']['srcset'];
			$variable_image_titles[] = esc_attr( $variable['image']['title'] );
		}
	}

	$variable_images       = array_unique( $variable_images );
	$variable_image_titles = array_unique( $variable_image_titles );
}

// add number of variation images
$image_num += count( $variable_images );
if ( !$image_num ) {
	$image_num = get_option( 'woocommerce_placeholder_image', 0 ) ? 1 : 0;
}

if ( isset( $is_quick_view ) ) {
	$product_detail_style = 'classic'; // style of product detail for quickview
} else {
	if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
		$product_detail_style = kite_get_meta( 'product_detail_style' ); // style of product detail in product page
		$product_gallery_direction          = kite_get_meta( 'product_gallery_direction' );

	} else {
		$product_detail_style = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
		$product_gallery_direction          = kite_opt( 'product-gallery-direction' );

	}
}
if (  kite_get_meta( 'shop_enable_zoom_inherit' ) == '1'  ) {
	$shopzoom = kite_get_meta( 'shop_enable_zoom'); 
} else {
	$shopzoom = kite_opt( 'shop_enable_zoom'  , true); // theme settings;
}
$zoom         = esc_attr( $shopzoom );
$zoom_display = '';
$hover_display = '';

if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {
	$zoom_display = 'enable';
}
if ($product_detail_style == 'pd_col_gallery' ) {
	$hover_display = 'col-gallery-hover';
}

$pd_fixed_summary = false;
if ( kite_opt( 'pd_fixed_summary' ) ) {
	$pd_fixed_summary = true;
}
?>
<div class="images">
<?php if (( $product_detail_style == 'pd_col_gallery' ) &&  ( count( $attachment_ids ) <= 0 && count( $variable_images ) == 0 ) ){ ?>
<div class="product-nogallery-right">
<?php } ?>
	<div id="product-fullview-thumbs" class="
	<?php
	if ( count( $attachment_ids ) <= 0 && count( $variable_images ) <= 1 ) {
		echo 'no-gallery';}
	?>
		">
		<div class="zoom-container <?php echo esc_attr( $zoom_display ); ?>">
		<?php
		if ( $image_num >= 1 ) {
			?>

			<div class="swiper-container clearfix">
				<div class="swiper-wrapper">

					<?php
					$zoom = esc_attr( $shopzoom );

					$slide_num = 0;

					if ( has_post_thumbnail() || get_option( 'woocommerce_placeholder_image', 0 ) ) {
						$mainImageID = has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'woocommerce_placeholder_image', 0 );
						$image_title = get_the_title( $mainImageID );

						$img_url     = wp_get_attachment_image_url( $mainImageID, apply_filters( 'single_product_large_thumbnail_size', 'single' ) );
						$image_sizes = function_exists('wc_get_image_size') ? wc_get_image_size('single')['width'] : $img_url[1];
						$image = '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $image_title ) . '" srcset="' . wp_get_attachment_image_srcset( $mainImageID ) . '"  sizes="' . esc_attr( $image_sizes ) . 'px"/>';

						preg_match( '@src="([^"]+)"@', $image, $match );
						$src                = array_pop( $match );
						$processed_images[] = $src;

						// if variable image and product thumbnail is the same add data-var_id
						$product_thumbnail_var_img_url = '';
						if ( $product->is_type( 'variable' ) ) {
							$iterateor = 0;
							foreach ( $variable_images as $key => $variable_image ) {
	
								$variable_url = $variable_image;
								if ( in_array( $variable_url, $processed_images ) ) {
									$product_thumbnail_var_img_url = 'data-variableimageurl="' . $variable_image . '"';
									break;
								}
							}
						}

						// echo slide
						if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {

							$big_image = wp_get_attachment_image_src( $mainImageID, 'full' );
							if ( $product_gallery_popup ) {
								 echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide  enable-popup %s"  data-zoom-image="%s" data-src="%s" data-slide="%s" %s>%s</div>', esc_attr( $hover_display ), esc_url( $big_image[0] ), esc_url( $img_url ), esc_attr( $slide_num ), $product_thumbnail_var_img_url, $image ), $post->ID );
							} else {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide %s " data-zoom-image="%s" data-slide="%s" %s>%s</div>', esc_attr( $hover_display ), esc_url( $big_image[0] ), esc_attr( $slide_num ), $product_thumbnail_var_img_url, $image ), $post->ID );
							}
						} else {
							if ( $product_gallery_popup ) {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide enable-popup %s"   data-src="%s" data-slide="%s" %s>%s</div>',  esc_attr( $hover_display ), esc_url( $img_url ), esc_attr( $slide_num ), $product_thumbnail_var_img_url, $image ), $post->ID );
							} else {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide %s" data-slide="%s" %s>%s</div>', esc_attr( $slide_num ),  esc_attr( $hover_display ), $product_thumbnail_var_img_url, $image ), $post->ID );
							}
						}

						$slide_num++;

					}


					// Process variable images at first (remove duplicate images of gallery because we need variable images for showing when user select a- it's more important than gallery iamges)

					if ( $product->is_type( 'variable' ) ) {
						$iterateor = 0;
						foreach ( $variable_images as $key => $variable_image ) {

								$variable_url = $variable_image;


							if ( in_array( $variable_url, $processed_images ) ) {
								continue;
							}
							$processed_images[] = $variable_url;

							// echo slide
							$image_title = '';
							if ( isset( $variable_image_titles[ $iterateor ] ) ) {
								$image_title = $variable_image_titles[ $iterateor ];
							}
							if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {


								if ( $product_gallery_popup ) {
									echo apply_filters( 
										'woocommerce_single_product_image_html', 
										sprintf( 
											'<div class="swiper-slide  enable-popup %s" data-src="%s" data-zoom-image="%s" data-slide="%s" data-variableimageurl="%s" data-var_id="%s"><img src="%s" alt="%s" %s ></div>', 
											esc_attr( $hover_display ),	
											esc_url( $variable_image ), 
											esc_url( $variable_image ), 
											esc_attr( $slide_num ), 
											esc_url( $variable_image ), 
											$variations_id[ $key ], 
											esc_url( $variable_url ), 
											esc_attr( $image_title ) ,
											!empty( $variable_srcset[ $key ] ) ? 'srcset="' . $variable_srcset[ $key ] . '"' : ''
										), 
										$post->ID 
									);
								} else {
									echo apply_filters( 
										'woocommerce_single_product_image_html', 
										sprintf( 
											'<div class="swiper-slide %s " data-zoom-image="%s" data-slide="%s" data-variableimageurl="%s" data-var_id="%s"><img src="%s" alt="%s" %s ></div>',
											esc_attr( $hover_display ),
											esc_url( $variable_image ), 
											esc_attr( $slide_num ), 
											esc_url( $variable_image ), 
											$variations_id[ $key ], 
											esc_url( $variable_url ), 
											esc_attr( $image_title ),
											!empty( $variable_srcset[ $key ] ) ? 'srcset="' . $variable_srcset[ $key ] . '"' : ''
										), 
										$post->ID 
									);
								}
							} else {
								if ( $product_gallery_popup ) {
									echo apply_filters( 
										'woocommerce_single_product_image_html', 
										sprintf( 
											'<div class="swiper-slide enable-popup %s"   data-src="%s" data-slide="%s"  data-variableimageurl="%s" data-var_id="%s"><img src="%s" alt="%s" %s ></div>', 
											esc_attr( $hover_display ),
											esc_url( $variable_image ), 
											esc_attr( $slide_num ), 
											esc_url( $variable_image ),
											$variations_id[ $key ], 											
											esc_url( $variable_url ), 
											esc_attr( $image_title ),
											!empty( $variable_srcset[ $key ] ) ? 'srcset="' . $variable_srcset[ $key ] . '"' : ''
										), 
										$post->ID 
									);
								} else {
									echo apply_filters( 
										'woocommerce_single_product_image_html', 
										sprintf( 
											'<div class="swiper-slide %s" data-slide="%s" data-variableimageurl="%s"><img src="%s" alt="%s" %s ></div>', 
											esc_attr( $hover_display ),
											esc_attr( $slide_num ), 
											esc_url( $variable_image ), 
											esc_url( $variable_url ), 
											esc_attr( $image_title ),
											!empty( $variable_srcset[ $key ] ) ? 'srcset="' . $variable_srcset[ $key ] . '"' : ''
										), 
										$post->ID 
									);
								}
							}

							$iterateor++;
							$slide_num++;

						}
					}



					foreach ( $attachment_ids as $attachment_id ) {

						$image_title = get_the_title( $attachment_id );

						if ( function_exists( 'wc_get_image_size' ) ) {


							$img_url          = wp_get_attachment_image_src( $attachment_id, 'full' );
							$image_dimension = wc_get_image_size( 'single' );
							$image_sizes     = $image_dimension['width'];
							$srcset = wp_get_attachment_image_srcset( $attachment_id );
							$srcset_attr  = !empty( $srcset ) ? 'srcset="' . $srcset . '"' : '';

							$image = '<img src="' . esc_url( $img_url[0] ) . '" alt="' . esc_attr( $image_title ) . '" ' . $srcset_attr . ' sizes="' . esc_attr( $image_sizes ) . 'px"/>';

						} else {

							$image = get_the_post_thumbnail( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'single' ) );

						}

						preg_match( '@src="([^"]+)"@', $image, $match );
						$src = array_pop( $match );
						if ( in_array( $src, $processed_images ) ) {
							continue;
						}
						$processed_images[] = $src;


						// echo slide
						if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {

							$big_image = wp_get_attachment_image_src( $attachment_id, 'full' );
							if ( $product_gallery_popup ) {
								 echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide  enable-popup %s"  data-zoom-image="%s" data-src="%s" data-slide="%s" >%s</div>', esc_attr( $hover_display ), esc_url( $big_image[0] ), esc_url( $img_url[0] ), esc_attr( $slide_num ), $image ), $post->ID );
							} else {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide %s " data-zoom-image="%s" data-slide="%s">%s</div>', esc_attr( $hover_display ), esc_url( $big_image[0] ), esc_attr( $slide_num ), $image ), $post->ID );
							}
						} else {
							if ( $product_gallery_popup ) {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide enable-popup %s"   data-src="%s" data-slide="%s" >%s</div>', esc_attr( $hover_display ), esc_url( $img_url[0] ), esc_attr( $slide_num ), $image ), $post->ID );
							} else {
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide %s" data-slide="%s" >%s</div>', esc_attr( $hover_display ), esc_attr( $slide_num ), $image ), $post->ID );
							}
						}

						$slide_num++;
					}

					?>
				</div>
				<?php if ((( $product_detail_style != 'pd_col_gallery' ) && ( $product_detail_style != 'pd_sticky' ) ) || wp_is_mobile()){ ?>
				<?php if (( $product_detail_style == 'pd_fullwidth_top' )&& (! wp_is_mobile())) { ?>
				<div class="pd-fullwidth-arrow">
				<div class="container">
				<?php } ?>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
				<?php if (( $product_detail_style == 'pd_fullwidth_top' )&& (! wp_is_mobile()) ){ ?>
				</div></div>
				<?php } ?>
				<?php } ?>
				<?php if ((( $product_detail_style == 'pd_fullwidth_top' )&& (! wp_is_mobile())) || ( isset( $is_quick_view ))) { ?>
				<div class="swiper-pagination"></div>
				<?php } ?>
			</div>
			<?php
		} else {

			$zoom = esc_attr( $shopzoom );

			if ( has_post_thumbnail() ) {

				$image_title = get_the_title( get_post_thumbnail_id() );

				if ( $product_detail_style == 'pd_top' || $product_detail_style == 'pd_fullwidth_top' ) {

					$image = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'full' );

				} else {
					if ( function_exists( 'wc_get_image_size' ) ) {

						$img_url         = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						$image_dimension = wc_get_image_size( 'single' );
						$image_sizes = $image_dimension['width'];		
						$srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id() );
						$srcset_attr  = !empty( $srcset ) ? 'srcset="' . $srcset . '"' : '';
						
						$image = '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $image_title ) . '" ' . $srcset_attr . ' sizes="' . esc_attr( $image_sizes ) . 'px"/>';

					} else {

						$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'single' ) );

					}
				}


				// echo slide
				if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {

					$big_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="" data-zoom-image="%s">%s</div>', esc_url( $big_image[0] ), $image ), $post->ID );

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', $image ), $post->ID );

				}
			}

			foreach ( $attachment_ids as $attachment_id ) {

				$image_title = get_the_title( $attachment_id );

				if ( $product_detail_style == 'pd_top' || $product_detail_style == 'pd_fullwidth_top' ) {

					$image = wp_get_attachment_image( $attachment_id, 'full' );

				} else {
					if ( function_exists( 'wc_get_image_size' ) ) {
						$img_url         = wp_get_attachment_image_src( $attachment_id, 'full' );
						$image_dimension = wc_get_image_size( 'single' );
						$image_sizes = $image_dimension['width'];
						$srcset = wp_get_attachment_image_srcset( $attachment_id );
						$srcset_attr  = !empty( $srcset ) ? 'srcset="' . $srcset . '"' : '';

						$image = '<img src="' . esc_url( $img_url[0] ) . '" alt="' . esc_attr( $image_title ) . '" ' . $srcset_attr . ' sizes="' . esc_attr( $image_sizes ) . 'px"/>';

					} else {

						$image = get_the_post_thumbnail( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'single' ) );

					}
				}


				// echo slide
				if ( $zoom == 1 && $product_detail_style != 'pd_top' && $product_detail_style != 'pd_fullwidth_top' ) {

					$big_image = wp_get_attachment_image_src( $attachment_id, 'full' );

					if ( $product_gallery_popup ) {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class=" enable-popup"  data-src="%s" data-zoom-image="%s">%s</div>', esc_url( $big_image[0] ), esc_url( $big_image[0] ), $image ), $post->ID );
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="" data-zoom-image="%s">%s</div>', esc_url( $big_image[0] ), $image ), $post->ID );
					}
				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', $image ), $post->ID );

				}
			}
		}
		?>
		</div>
	</div>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
<?php if (( $product_detail_style == 'pd_col_gallery' ) &&  ( count( $attachment_ids ) <= 0 && count( $variable_images ) == 0 )){ ?>
</div>
<?php } ?>
</div>



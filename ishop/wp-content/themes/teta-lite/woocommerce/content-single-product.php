<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// KiteSt codes
if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
	$product_detail_style              = kite_get_meta( 'product_detail_style' ); // style of product detail in product page
	$product_detail_sidebar_position   = kite_get_meta( 'product-detail-sidebar-position', 'right' ); // style of sidebar in product page
	$product_detail_gallery_sidebar_position   = kite_get_meta( 'product-detail-gallery-sidebar-position', 'right' ); // style of sidebar in product page
	$product_detail_gallery_sidebar   = kite_get_meta( 'product_detail_gallery_sidebar' ); // style of sidebar in product page
	$product_detail_sidebar_responsive = kite_get_meta( 'product-detail-sidebar-responsive', false ); // style of sidebar in product page
	$product_detail_txt_color          = kite_get_meta( 'product_detail_txt_color' );
	$gallery_column_number          = kite_get_meta( 'gallery_column_number' );
	$product_gallery_direction          = kite_get_meta( 'product_gallery_direction' );

} else {
	$product_detail_style              = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
	$product_detail_sidebar_position   = kite_opt( 'product-detail-sidebar-position', 'right' ); // style of sidebar in product page
	$product_detail_gallery_sidebar_position   = kite_opt( 'product-detail-gallery-sidebar-position', 'right' ); // style of sidebar in product page
	$product_detail_gallery_sidebar   = kite_opt( 'product_detail_gallery_sidebar' ); // style of sidebar in product page
	$product_detail_sidebar_responsive = kite_opt( 'product-detail-sidebar-responsive', false ); // style of sidebar in product page
	$product_detail_txt_color          = kite_opt( 'product_detail_txt_color' );
	$gallery_column_number          = kite_opt( 'gallery-column-number' );
	$product_gallery_direction          = kite_opt( 'product-gallery-direction' );

}

$catalog_mode                 = kite_opt( 'catalog_mode', false );
$product_breadcrumb           = kite_opt( 'product_breadcrumb', true );
$catalog_mode_class = '';
$text_color = '';
if ( $product_detail_txt_color != 1 ) {
		$text_color = 'light_text';
}
$custom_label             = '';
	$custom_product_label = get_post_meta( get_the_ID(), 'custom_product_label', true );
if ( ! empty( $custom_product_label ) ) {
	$custom_label = 'custom_label';
}
$class = array();
$col_number= '';
$gallery_dir= '';

 if ( ($product_gallery_direction != 0 ) ) {
	$gallery_dir = 'right';
}


if( $product_detail_style == 'pd_classic_sidebar' ){
	$class[] = $product_detail_sidebar_position;
}

if( $product_detail_style == 'pd_col_gallery' ){
	$class[] = $product_detail_gallery_sidebar_position;
	$col_number= 'column-' .$gallery_column_number;
} 
// End of KiteSt codes
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$container = ( $product_detail_style == 'pd_fullwidth_top' ) ? 'full-width' : ( ( $product_detail_style == 'pd_background' ) ? 'container pd-background' : 'container' );
?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class( array( $product_detail_style, $catalog_mode_class, $text_color, $col_number, $gallery_dir, $custom_label, 'parent_div_product' ), $product ); ?>>
	<div class="product-detail-bg">
		<div class="<?php echo esc_attr( $container ); ?>" >

			<?php
			if ( $product_detail_style == 'pd_sticky' ){
				
				echo '<div class="pd-sticky" data-sticky_parent > ';
			}
			?>
			<?php 
			if (( $product_detail_style == 'pd_classic_sidebar' )|| (( $product_detail_style == 'pd_col_gallery' ) && ($product_detail_gallery_sidebar != 1 ) )){
				
				echo '<div class="product-detail-content-with-sidebar ' .  implode( ' ', $class ) . '">';// Put wrapper around image & summary
			}
			?>
			<?php

			if ( ! isset( $is_product_shortcode ) ) {
				if ( ( $product_detail_style == 'pd_classic' ) || ( $product_detail_style == 'pd_kt_classic' ) || ( $product_detail_style == 'pd_col_gallery' ) || ( $product_detail_style == 'pd_background' ) ) {
					if ( ( ! wp_is_mobile() ) && $product_breadcrumb == true ) {
						/* Breadcrumb */
						woocommerce_breadcrumb(
							array(
								'delimiter'   => '<span class="delimiter">/</span>',
								'wrap_before' => '<nav id="breadcrumb" class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
								'wrap_after'  => '</nav>',
							)
						);
					}
				}
			}

				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
	<?php
	if ( ( $product_detail_style == 'pd_top' ) || ( $product_detail_style == 'pd_fullwidth_top' )  ) {
		?>
		</div>
	</div>
	<div class="container">
		<?php
	}
	$align = '';
	?>
			<div class="summary entry-summary <?php echo esc_attr( $align ); ?>" <?php if(( $product_detail_style == 'pd_sticky' ) ){ ?> data-sticky_column <?php } ?>>
				<?php
				if ( wp_is_mobile() || ( $product_detail_style == 'pd_fixed_summary' ) ||( $product_detail_style == 'pd_sticky' ) || ( $product_detail_style == 'pd_classic_sidebar' )  ) {
					/* Breadcrumb */
					if ( $product_breadcrumb == true ) {
						woocommerce_breadcrumb(
							array(
								'delimiter'   => '<span class="delimiter">/</span>',
								'wrap_before' => '<nav id="breadcrumb" class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
								'wrap_after'  => '</nav>',
							)
						);
					}
				}

					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked add_deal_count_down Timer - 25
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div><!-- .summary -->
		<?php
		if (( $product_detail_style == 'pd_classic_sidebar' )|| (( $product_detail_style == 'pd_col_gallery' ) && ($product_detail_gallery_sidebar != 1 ) )){


			echo '</div>';// Put wrapper around image & summary
		}


		if (( $product_detail_style == 'pd_top' ) || ( $product_detail_style == 'pd_fullwidth_top' ) ){
			?>
		</div>
			<?php
		} elseif (( $product_detail_style == 'pd_classic_sidebar' )|| (( $product_detail_style == 'pd_col_gallery' ) && ($product_detail_gallery_sidebar != 1 ) )){

			
			
			$pd_sidebar_in_responsive_class = '';
			if ( $product_detail_sidebar_responsive == 0 ) {
				$pd_sidebar_in_responsive_class = ' visible-desktop';
			}
			?>
			<div id="woocommerce-product-sidebar" class="span3<?php echo esc_attr( $pd_sidebar_in_responsive_class ); ?>">
				<span class="kt-sidebar-title hidden-desktop hidden-tablet"><?php esc_html_e( 'Widget Area', 'teta-lite' );?></span>
				<?php echo kite_get_sidebar( 'woocommerce-product-sidebar' ); ?>
			</div>
			<?php
		}

		?>
	<?php
	if ( $product_detail_style == 'pd_sticky' ){
		echo '</div> ';
	}
	?>
	<?php 
	if ( ($product_detail_style != 'pd_top' )&& ($product_detail_style != 'pd_fullwidth_top' ) ){
		?>
		</div>
	</div>
	<?php } ?>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

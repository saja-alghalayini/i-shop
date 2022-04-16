<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;


global $product;
$catalog_mode = kite_opt( 'catalog_mode', false );


// Added by KiteSt

/* get attribute complete info */

// Show Variation title
$variable_title = kite_opt( 'variable_title', true );
$title_display  = '';

if ( $variable_title != '0' ) {
	$title_display = 'title_display';
}
if (  kite_get_meta( 'variations_select_style_inherit' ) == '1'  ) {
	$variations_select_style = kite_get_meta( 'variations_select_style');
}
else{
	$variations_select_style = kite_opt( 'variations_select_style'  , true); // theme settings;
} 

// End of Added by KiteSt

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'teta-lite' ); ?></p>
	<?php else : ?>
		<table class="variations <?php echo esc_attr( $title_display ); ?> <?php
		if ( $variations_select_style != 1 ) :
?>
			with-dropdown<?php endif; ?>" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<!-- Added Php Wrap By KiteSt -->
						<?php
						if ( $variable_title ) {
							// it supports custom attribute

							?>
							<th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
							<?php
						}

						?>
						<!-- End of Added Php Wrap By KiteSt -->

						<td class="value">
							<!-- Edited By KiteSt -->
							<?php
							if ( $variations_select_style ) {
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );

								kite_wc_text_variation_attribute_items(
									array(
										'items'     => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'selected'  => $selected,
									)
								);

								echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="' . esc_url( '#' ) . '">' . esc_html__( 'Clear selection', 'teta-lite' ) . '</a>' : '';
							} else {
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									)
								);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="' . esc_url( '#' ) . '">' . esc_html__( 'Clear', 'teta-lite' ) . '</a>' ), $GLOBALS['kite-allowed-tags'] ) : '';
							}
							?>
							<!-- End of Edited By KiteSt -->
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>
		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );

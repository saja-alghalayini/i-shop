<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_null( WC()->cart ) ) {
	return;
}
?>

<?php // KiteSt codes ?>
<div class="cartsidebarheader">
	<div class="cart-close-btn"></div>
	<div class="cartsidebartitle">
		<?php esc_html_e( 'Shopping Bag', 'teta-lite' ); ?>
	</div>
						   
	<div class="cart-content-container">
		<?php echo sprintf( _n( '%s item', '%s items', WC()->cart->cart_contents_count, 'teta-lite' ), '<span class="cartcontentscount">' . WC()->cart->cart_contents_count . '</span>' ); ?>
	</div>

</div>
<?php // End of KiteSt codes ?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); if ( WC()->cart->is_empty() ) echo ' empty-cart';?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key, $mini_cart = true );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'shop_thumbnail' ), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

				?>
					<li 
						class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>"
						data-product_id="<?php echo esc_attr( $product_id ); ?>"
						data-min="<?php echo esc_attr( kite_get_min_product_quantity( $_product ) );?>"
						data-max="<?php echo esc_attr( $_product->get_max_purchase_quantity() );?>"
						data-item-key="<?php echo esc_attr( $cart_item_key );?>"
					>

						<?php
							echo apply_filters(
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-item-key="%s"></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'teta-lite' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() ),
									$cart_item_key
								),
								$cart_item_key
							);
						?>

						<?php // KiteSt codes ?>
						<div class="wc-loading hide"></div>

							<?php
							echo apply_filters(
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="icon icon-undo undo" title="%s" data-product_id="%s" data-product_sku="%s" data-item-key="%s"><span></span></a>',
									esc_url( wc_get_cart_undo_url( $cart_item_key ) ),
									esc_attr__( 'Undo this item', 'teta-lite' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() ),
									$cart_item_key
								),
								$cart_item_key
							);
							?>
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php echo '' . $thumbnail; ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo '' . $thumbnail; ?>
							</a>

						<?php endif; ?>
							<span><?php echo wp_kses( $product_name, $GLOBALS['kite-allowed-tags'] ); ?></span>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>


							
						
						<?php // End of KiteSt codes ?>

						<?php
						if ( empty( $cart_item['woosb_parent_id'] ) ) {
							$quantity_markup = '
								<span class="quantity">
									<span class="kt-num">' . $cart_item['quantity'] . '</span>
									<span class="kt-quantity-change">
										<span class="kt-minus icon icon-minus2"></span>
										<span class="kt-num">' . $cart_item['quantity'] . '</span>
										<span class="kt-plus icon icon-plus2"></span>
									</span>
									&times;
									' . $product_price . '
								</span>
							'; 
							echo apply_filters( 'woocommerce_widget_cart_item_quantity', $quantity_markup, $cart_item, $cart_item_key ); 
						}
						?>
					</li>
					<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_mini_cart_contents' ); ?>

	<?php else : ?>

		<li class="empty show-message"><?php esc_html_e( 'No products in the cart.', 'teta-lite' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

	<?php // KiteSt codes ?>
	<div class="cart-bottom-box">
	<?php
	if ( ! WC()->cart->is_empty() ) :
		// End of KiteSt codes
	?>

		<p class="total"><strong><?php esc_html_e( 'Subtotal', 'teta-lite' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
		</p>

		<?php // KiteSt codes ?>
	<?php endif; ?>
	</div>
	<?php // End of KiteSt codes ?>

<?php
do_action( 'woocommerce_after_mini_cart' );
?>

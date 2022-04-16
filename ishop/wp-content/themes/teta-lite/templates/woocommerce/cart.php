<?php

	$cart_style  = kite_opt( 'shop-wishlist-cart-style', true );
	$header_type = kite_opt( 'header-type', '1' );
	$icon_type   = kite_opt( 'icon_type', 'cart' );

	global $woocommerce;
	$icon_class = '';

if ( $icon_type == 'cart-full' ) {
	$icon_class = 'icon-cart-full';
} elseif ( $icon_type == 'cart-empty' ) {
	$icon_class = 'icon-cart-empty';
} elseif ( $icon_type == 'cart' ) {
	$icon_class = 'icon-cart';
} elseif ( $icon_type == 'bag2' ) {
	$icon_class = 'icon-bag2';
} elseif ( $icon_type == 'bag' ) {
	$icon_class = 'icon-bag';
} elseif ( $icon_type == 'shopping-basket' ) {
	$icon_class = 'icon-shopping-basket';
} elseif ( $icon_type == 'shopping-bag' ) {
	$icon_class = 'icon-shopping-bag';
} elseif ( $icon_type == 'shopping-cart' ) {
	$icon_class = 'icon-shopping-cart';
} else {
	$icon_class = 'icon-cart';
}

?>
<div class="cart-sidebarbtn widget widget_woocommerce-dropdown-cart responsive-cart <?php if ( $cart_style == 1 ) {	?> dark<?php } ?>">
	<a href="<?php echo wc_get_cart_url();?>">
		<div class="cart-contents"><div class="cartcontentscount"><?php echo WC()->cart->cart_contents_count; ?></div></div>
		<span class="icon <?php echo esc_attr( $icon_class ); ?>"></span>
	</a>
</div>

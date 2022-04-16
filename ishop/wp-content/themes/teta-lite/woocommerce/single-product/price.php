<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<?php // KiteSt Codes 
if ( ( $product->is_purchasable() && $product->is_in_stock() ) || $product->get_type() == 'external' ) {
?>
<div class="priceminheight">
<?php // End of KiteSt Codes ?>

	<p class="price"><?php echo '' . $product->get_price_html(); ?></p>

<?php // KiteSt Codes ?>
</div>
<?php 
}
// End of KiteSt Codes 
?>

<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_url = '';
$type     = '';// this variabe used to detect search form is in category page or main page of shop

if ( is_product_category() ) {
	global $wp_query;
	// get the query object
	$cat_obj = $wp_query->get_queried_object();

	if ( $cat_obj ) {
		$category_ID = $cat_obj->term_id;
		$page_url    = get_category_link( $category_ID );
	}

	$type = 'category';
} else {
	$page_url = esc_url( home_url( '/' ) );

	$type = 'mainshop';

}

?>

<form role="search" method="get" class="woocommerce-product-search" data-type="<?php echo esc_attr( $type ); ?>" action="<?php echo esc_url( $page_url ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e( 'Search for:', 'teta-lite' ); ?></label>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'teta-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'teta-lite' ); ?>" />
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'teta-lite' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'teta-lite' ); ?></button>
	<input type="hidden" name="post_type" value="product" />
</form>

<?php
/**
 * Product Loop Start
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */
?>
<?php
// th fallowing divs are container for title and woocomerce order dropdown menu
// started in woocommerce.php
global $woocommerce_loop;
$class      = '';
$layoutmode = '';

$shop_column_responsive = kite_opt( 'shop-column-responsive', 1 );
if ($shop_column_responsive == '2'){
	$columns = ' shop-'. kite_opt( 'shop-column', 4 ) .'column ' .'shop-tablet-'. kite_opt( 'shop-column-tablet', 3 ).'column '.'column_res  '.'column_tablet  ' ;
}
else{
	$columns = ' shop-'. kite_opt( 'shop-column', 4 ) .'column '.'shop-tablet-'. kite_opt( 'shop-column-tablet', 3 ).'column '.'column_tablet  ';
}



$products_view = kite_opt( 'shop-product-view', 'grid' );
if ( $products_view === 'grid_sv' || $products_view === 'list_sv' ) {
	if ( isset( $_GET['view'] ) ) {
		$products_view = htmlspecialchars( $_GET['view'] );
	}
}

if ( $products_view === 'list' || $products_view === 'list_sv' ) {
	$products_view = 'list';
} else {
	$products_view = 'grid';
}

$responsive_list_view = ( $products_view == 'list' && kite_opt( 'responsive-product-list-view', false ) ) ? true : false;

if ( ( ( $products_view === 'grid' || is_product() || wp_is_mobile() )  && ( !$responsive_list_view ) ) || ( $responsive_list_view && $woocommerce_loop['name'] == 'related' )|| ( $responsive_list_view && $woocommerce_loop['name'] == 'up-sells' ) ) {

	$class .= 'grid_view ';
	if ( isset( $_GET['productStyle'] ) && ! empty( $_GET['productStyle'] ) ) {
		$product_style = sanitize_text_field( $_GET['productStyle'] );
		switch ($product_style) {
			case 'buttons-on-hover':
				$product_style = 'buttonsonhover';
				break;
			case 'buttons-on-hover-center':
				$product_style = 'centered';
				break;
			case 'modern-buttons-on-hover':
			case 'modern-buttons-on-hover-vertical':
			case 'modern-buttons-on-hover-quantity':
			case 'modern-buttons-on-hover-stretched':
				$product_style = 'modern-buttons-on-hover';
				break;
			case 'info-on-hover':
				$product_style = 'infoonhover';
				break;
			case 'info-on-click':
				$product_style = 'infoonclick';
				break;
			case 'instant-shop':
				$product_style = 'instantshop';
				break;
			case 'buttons-appear-under':
				$product_style = 'buttonsappearunder';
				break;
			default:
				$product_style = kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE );
				break;
		}
	} else {
		$product_style = kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE );// Get shop product style
	}

	if ( $product_style == 'centered' ) {
		$product_style = 'buttonsonhover centered';
	}

	$layoutmode = 'data-layoutmode=' . esc_attr( kite_opt( 'shop-layout', 'fitRows' ) );
	$class     .= $columns;

} else {
		$product_style = 'list_view ';

}

	// Check shop fullwidth option
if ( isset( $_GET['shopWidth'] ) && ! empty( $_GET['shopWidth'] ) ) {
	if ( sanitize_text_field( $_GET['shopWidth'] ) == 'fullwidth' ) {
		$fullwidth = true;
	} elseif ( sanitize_text_field( $_GET['shopWidth'] ) == 'container' ) {
		$fullwidth = false;
	} else {
		$fullwidth = kite_opt( 'shop-enable-fullwidth', false );
	}
} else {
	$fullwidth = kite_opt( 'shop-enable-fullwidth', false );
}

	// Shop entrance animation
	$shop_entrance_animation = kite_opt( 'shop-entrance-animation', 'fadein' );

	$class .= 'main-shop-loop ';
	$class .= ( $fullwidth == 0 ? ' ' : 'fullwidthshop ' );
	$class .= ( $shop_entrance_animation != 'none' ? $shop_entrance_animation . ' ' : ' ' );
	$class .= $product_style . ' ';
	$class .=  $responsive_list_view ? 'kt-responsive-list-view' : '';


if ( is_shop() || is_product_category() || is_product_tag() ) {

	?>
	
	<div class="products woocommerce wc-categories <?php echo esc_attr( $class ); ?>" <?php echo esc_attr( $layoutmode ); ?> data-lm-text = "<?php esc_attr_e( 'Load More', 'teta-lite' ); ?>">
	<?php
} elseif ( is_product() ) {
	?>
	<div class="products grid_view <?php echo esc_attr( $product_style . $columns ); ?>">
	<?php
} else {
	?>
	<div class="products <?php echo esc_attr( $class ); ?>" <?php echo esc_attr( $layoutmode ); ?> >
	<?php
}

/**
 * kite_products_loop_start hook
 *
 * @hooked kite_show_seen_products 
 */
do_action( 'kite_products_loop_start' );
?>

<?php

$min_quantity = absint( get_option( 'woocommerce_minimum_order_quantity' ), '');
$quantity     =  ! empty( $min_quantity )? $min_quantity : 1;
    
$button = apply_filters(
    'woocommerce_loop_add_to_cart_link',
    sprintf(
        '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s %s" data-min-quantity="%s"><span class="icon"></span><span class="txt" data-hover="%s">%s</span></a><span class="kt-tooltip"><span class="hint-txt">%s</span></span>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        kite_get_min_product_quantity(),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        esc_attr( $product->get_type() ),
        esc_attr( $product->get_type() == 'simple' && 'yes' === $ajax_add_to_cart ? 'ajax_add_to_cart' : 'swiper-no-swiping' ), 
        kite_get_min_product_quantity(),
        esc_attr( $product->add_to_cart_text() ),
        esc_html( $product->add_to_cart_text() ),
        esc_html__( "Add to Cart", 'teta-lite' )
    ),
    $product
);

if ( ! $catalog_mode ) {
    echo '' . $button;
}

if ( $quickview !== 'disable' ) {
    kite_add_quick_view_button();
}

if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' && $compare !== 'disable' ) {
    if ( ! isset( $_GET['action'] ) || ( isset( $_GET['action'] ) && $_GET['action'] != 'edit' ) ) {
        kite_add_compare_button();
    }
}
if ( $wishlist !== 'disable' ) {
    kite_shop_page_wishlist_button();
}

?>
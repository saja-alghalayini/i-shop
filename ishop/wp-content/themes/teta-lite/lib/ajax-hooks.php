<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//
// ─── INSTAGRAM AJAX FUNCTIONALITY ───────────────────────────────────────────────
//
function kite_instagram_generate_dom() {

	$insta_data = $_POST['insta_data'];
	$insta_html = $_POST['insta_html'];
	if ( empty( $insta_html ) ) {
		die();
	}
	$instagram = kite_instagram_decode( $insta_html, $insta_data['hashtag'], true );
	if ( is_wp_error( $instagram ) ) {
		die();
	}
	$i                   = 1;
	$transient_name      = 'instagram-media-new-' . sanitize_title_with_dashes( $insta_data['username'] );
	$instagram_serialize = maybe_serialize( $instagram );
	set_transient( $transient_name, $instagram_serialize, apply_filters( 'null_instagram_cache_time', DAY_IN_SECONDS * 2 ) );
	foreach ( $instagram as $item ) {

		if ( $i > $insta_data['image_num'] ) {
			break;
		}
		$i++;

		if ( $insta_data['resolution'] == 'low_resolution' || $insta_data['resolution'] == 'low_resolution_crop' || $insta_data['resolution'] == 'standard_resolution' || $insta_data['image_resolution'] == 'standard_resolution_crop' ) {
			$image = $item['large'];
		} else {
			$image = $item[ $insta_data['resolution'] ];
		}

		$media_tag = "<img src=\"data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==\" class=\"media\" data-src=\"{$image}\"/>";

		$content  = '<div class="instagram-img ' . esc_attr( $insta_data['carousel'] ) . ' " >';
		$content .= '<a  href="' . esc_url( $item['link'] ) . '" target="_blank">';

		$content .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'instagram feed', 'teta-lite' ) . '"/>';

		$content .= '<div class="hover"></div>
                <div class="content">';

		if ( $insta_data['like'] == 'enable' ) {
			$content .= '<span class="like">' . kite_pretty_number( $item['likes'] ) . '</span>';
		}

		if ( $insta_data['comment'] == 'enable' ) {
			$content .= '<span class="comment">' . kite_pretty_number( $item['comments'] ) . '</span>';
		}

		$content .= '</div>';

		// output media
		echo '' . $content . '</a></div>';

	}
	die();
}
add_action( 'wp_ajax_kite-instagram-generate-dom', 'kite_instagram_generate_dom' );
add_action( 'wp_ajax_nopriv_kite-instagram-generate-dom', 'kite_instagram_generate_dom' );

/*-----------------------------------------------------------------*/
// Ajax Search
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_ajax_search' ) ) {
	function kite_ajax_search() {
		$default_post_type = kite_woocommerce_installed() ? 'product' : 'post';
		$search_post_type = kite_opt( 'search_post_type', $default_post_type );

		$s   = strtolower( trim( sanitize_text_field( $_GET['s'] ) ) );
		$cat = trim( sanitize_text_field( $_GET['cat'] ) );
		$results = [];
		if ( $cat == 'all' ) {
			$args = array(
				's'              => $s,
				'post_type'      => $search_post_type,
				'posts_per_page' => 20,
				'no_found_rows'  => 1,
			);
		} else {
			if ( $search_post_type == 'product' ) {
				$args = array(
					's'              => $s,
					'post_type'      => $search_post_type,
					'posts_per_page' => 20,
					'no_found_rows'  => 1,
					'product_cat'    => $cat,
				);
			} else {
				$args = array(
					's'              => $s,
					'post_type'      => $search_post_type,
					'posts_per_page' => 20,
					'no_found_rows'  => 1,
					'category_name'  => $cat,
				);
			}
		}
		global $post;
		$args['suppress_filters'] = 0;

		/**
		 * Modify ajax search args before doing search process
		 */
		$args = apply_filters( 'kite_ajax_search_args', $args );

		$posts        = get_posts( $args );

		if ( $search_post_type == 'product' ) {
			$args_sku            = array(
				'post_type'        => 'product',
				'posts_per_page'   => 20,
				'meta_query'       => array(
					array(
						'key'     => '_sku',
						'value'   => $s,
						'compare' => 'like',
					),
				),
				'suppress_filters' => 0,
			);
			$products_sku        = get_posts( $args_sku );

			$all_search_results    = array_merge( $posts, $products_sku );
			$products_id         = array();
			foreach ( $all_search_results as $key => $product ) {
				$id = $product->ID;
				if ( in_array( $id, $products_id ) ) {
					unset( $all_search_results[ $key ] );
				} else {
					$products_id[] = $id;
				}
			}
		}
		if ( $search_post_type != 'product' ) {
			$all_search_results = $posts;
		}
		if ( count( $all_search_results ) > 0 ) {

			if ( ! empty( $_GET['result_columns'] ) ) {
				$columns = 'columns-' . sanitize_text_field( $_GET['result_columns'] );
			} else {
				$columns = kite_opt( 'search_result_columns', false ) ? '' : 'columns-2';
			}

			/**
			 * Kite before search items loop
			 *
			 * @hooked - kite_change_price_style_in_ajax_search
			 */
			do_action( 'kite_before_ajax_search_items_loop', $search_post_type );

			if ( kite_opt( 'trident_search_enabled_items', true ) ) {

				$items = 'product' == $search_post_type ? esc_html__( 'Products', 'teta-lite' ) : esc_html__( 'Posts', 'teta-lite' );
				$results[] = "<h6>$items</h6>";

				$results[] = '<div class="kt-items ' . $columns . '">';
				if ( $search_post_type == 'product' ) {
					foreach ( $all_search_results as $post ) :
						setup_postdata( $post );
						$product   = wc_get_product( get_the_ID() );
						$main_cat = kite_get_post_primary_category( get_the_ID(), 'product_cat' )['primary_category'];
						$results[] = sprintf( '<div class="searchitem"><a href="%s" class="Link">%s<span class="searchitemdesc"><span class="itemdesc">%s</span><span class="kt-cat">%s</span> %s</span></a></div>', get_permalink(), ( ( has_post_thumbnail() ) ? woocommerce_get_product_thumbnail( 'shop_thumbnail' ) : '' ), $product->get_title(), $main_cat->name, $product->get_price_html() );
					endforeach;
				} else {
					foreach ( $all_search_results as $post ) :
						setup_postdata( $post );
						$main_cat = kite_get_post_primary_category( get_the_ID(), 'category' )['primary_category'];
						$results[] = sprintf( '<div class="searchitem"><a href="%s" class="Link">%s<span class="searchitemdesc">%s</span></a></div>', get_permalink(), ( ( '' == $featured_image = get_the_post_thumbnail() ) ? '' : '<div class="imageswrap">' . $featured_image . '</div>' ), get_the_title() );
					endforeach;
				}
				$results[] = '</div>';
			}

			/**
			 * Search results filter
             *
             * @hooked - kite_append_dokan_vendors_list_to_ajax_search - 1
			 */
			$results = apply_filters( 'kite_ajax_search_results', $results, $all_search_results );

			/**
			 * Kite after search items loop
			 *
			 * @hooked - kite_revert_back_price_style_after_ajax_search
			 */
			do_action( 'kite_after_ajax_search_items_loop', $search_post_type );

			$result = implode( $results );
			echo wp_kses( $result, $GLOBALS['kite-allowed-tags'] );
		} else {
			if ( ! empty( $results ) ) {
				$result = implode( $results );
				echo wp_kses( $result, $GLOBALS['kite-allowed-tags'] );
			} else {
				echo "<div class='emptyresult'>" . esc_html__( 'Nothing Found For : ', 'teta-lite' ) . '</div>';
			}
		}
		wp_reset_postdata();
		die();
	}
}

add_action( 'wp_ajax_kite_ajax_search_action', 'kite_ajax_search' );
add_action( 'wp_ajax_nopriv_kite_ajax_search_action', 'kite_ajax_search' );

function kite_format_price_range( $price, $from, $to ) {
	$price = sprintf( _x( '%1$s %2$s', 'Price range: from-to', 'teta-lite' ), is_numeric( $from ) ? wc_price( $from ) : $from, is_numeric( $to ) ? wc_price( $to ) : $to );
	return $price;
}

//
// ─── DISCONNECT INSTAGRAM ACCOUNT ───────────────────────────────────────────────
//

function kite_instagram_api_disconnect() {
	if ( class_exists('Kite_Instagram_Api') && wp_verify_nonce( $_POST['nonce'], 'kite-disconnect-instagram' ) ) {
		Kite_Instagram_Api::disconnect();
		wp_send_json_success( [ 'message' => 'disconnected successfully'] );
	}
}
add_action( 'wp_ajax_kite_instagram_api_disconnect', 'kite_instagram_api_disconnect');

if ( ! function_exists( 'kite_get_wishlist_quantity' ) ) {
	function kite_get_wishlist_quantity() {
		global $yith_wcwl;

		// check to see if the submitted nonce matches with the generated nonce we created earlier
		check_ajax_referer( 'ajax-nonce', 'security' );

		$data = array(
			'wishlist_count_products' => yith_wcwl_count_products(),
		);
		wp_send_json( $data );
	}
}
// Update wishlist widget
add_action( 'wp_ajax_get_wishlist_quantity', 'kite_get_wishlist_quantity' );
add_action( 'wp_ajax_nopriv_get_wishlist_quantity', 'kite_get_wishlist_quantity' );


if ( ! function_exists( 'kite_remove_item' ) ) {
	function kite_remove_item() {

		$item_key = sanitize_text_field( $_POST['item_key'] );

		$removed = WC()->cart->remove_cart_item( $item_key ); // Note: WP 2.3 >

		if ( $removed ) {
			$data['status']        = '1';
			$data['cart_count']    = WC()->cart->get_cart_contents_count();
			$data['cart_subtotal'] = WC()->cart->get_cart_subtotal();
		} else {
			$data['status'] = '0';
		}

		echo json_encode( $data );

		exit;

	}
}
// Remove item from card
add_action( 'wp_ajax_cart_remove_item', 'kite_remove_item' );
add_action( 'wp_ajax_nopriv_cart_remove_item', 'kite_remove_item' );


if ( ! function_exists( 'kite_undo_removed_item' ) ) {
	function kite_undo_removed_item() {

		$item_key = sanitize_text_field( $_POST['item_key'] );

		$cart      = WC()->instance()->cart;
		$undo_item = $cart->restore_cart_item( $item_key );

		if ( $undo_item ) {
			$data['status']        = '1';
			$data['cart_count']    = $cart->get_cart_contents_count();
			$data['cart_subtotal'] = $cart->get_cart_subtotal();
		} else {
			$data['status'] = '0';
		}

		echo json_encode( $data );

		exit;

	}
}
// Get back removed item to cart
add_action( 'wp_ajax_undo_removed_item', 'kite_undo_removed_item' );
add_action( 'wp_ajax_nopriv_undo_removed_item', 'kite_undo_removed_item' );
	
if ( ! function_exists( 'kite_update_mini_cart_item_quantity' ) ) {
	function kite_update_mini_cart_item_quantity() {
		$item_key = sanitize_text_field( $_POST['item_key'] );
		$quantity = (int) sanitize_text_field( $_POST['quantity'] );
		$data['status'] = '0';

		if ( WC()->cart->set_quantity( $item_key, $quantity) ) {
			$data['status']        = '1';
			$data['cart_count']    = WC()->cart->get_cart_contents_count();
			$data['cart_subtotal'] = WC()->cart->get_cart_subtotal();

		}

		echo json_encode( $data );

		exit;
	}
}
add_action( 'wp_ajax_update_mini_cart_item', 'kite_update_mini_cart_item_quantity' );
add_action( 'wp_ajax_nopriv_update_mini_cart_item', 'kite_update_mini_cart_item_quantity' );

//
// ─── DISSMISS NOTICES ───────────────────────────────────────────────────────────
//
if ( !function_exists('kite_dismiss_plugins_install_notices') ) {
	function kite_dismiss_plugins_install_notices() {
		$days = absint( $_GET['dismiss_time'] );
		set_transient( 'kite-install-plugins-dismiss', true, $days * DAY_IN_SECONDS );
	}
}
add_action( 'wp_ajax_dismiss_plugins_install_notices', 'kite_dismiss_plugins_install_notices' );
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function kite_shop_item( ) {

	global $product, $post , $woocommerce_loop;

	$defaults = array(
		'request_from'           => 'shop',
		'hover_image'            => 'show',
		'attachment_ids'         => array(),
		'layout'                 => 'masonry',
		'columns'                => '1',
		'gutter'                 => '',
		'nav_style'              => '',
		'carousel'               => 'disable',
		'carousel_class'         => '',
		'autoplay'               => '',
		'template'               => 'buttons-on-hover',
		'border'                 => 'enable',
		'image_size'             => 'shop_catalog',
		'image_size_width'       => '',
		'image_size_height'      => '',
		'image_size_crop'        => '',
		'catalog_mode'  		 => false, 
		'ajax_add_to_cart'		 => 'yes',
		'quickview'              => 'enable',
		'compare'                => 'enable',
		'wishlist'               => 'enable',
		'hover_price'            => 'enable',
		'entrance_animation'     => 'fadein',
		'responsive_animation'   => 'disable',
		'animation'              => 'none',
		'delay'                  => '0',
		'list_style'             => 'light',
		'badges'                 => 'enable',
		'hover_color'            => 'c0392b',
		'custom_hover_color'     => '',
		'countdown_activation'   => '',
		'progressbar_activation' => '',
		'product_color_scheme'   => 'light',
		'column_in_mobile'       => '1',
		'classes'				 => ''
	);

	extract( $defaults );

	// Extra post classes
	$classes = array();

	$attachment_ids = $product->get_gallery_image_ids();

	if ( count( $attachment_ids ) > 0 ) {
		$classes[] = 'has-gallery';
	}

	if ( isset( $_GET['productBorder'] ) && ( sanitize_text_field( $_GET['productBorder'] ) == 'with-border' || sanitize_text_field( $_GET['productBorder'] ) == 'no-border' ) ) {
		if ( sanitize_text_field( $_GET['productBorder'] ) == 'with-border' ) {
			$product_border = 1;
		} else {
			$product_border = 0;
		}
	} else {
		$product_border = kite_opt( 'shop-product-border', true );
	}

	$products_view = kite_opt( 'shop-product-view', 'grid' );

	if ( $products_view === 'grid_sv' || $products_view === 'list_sv' ) {
		if ( isset( $_GET['view'] ) ) {
			$products_view = sanitize_text_field( $_GET['view'] );
		}
	}

	if ( $product_border != 0 ) {
		$classes[] = 'with-border';
	}

	$columns = kite_opt( 'shop-column', 4 );
	
	$catalog_mode  = isset( $_GET['catalog-mode'] ) ? true : kite_opt( 'catalog_mode', false );
	$product_style = kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE );
	$ajax_add_to_cart = get_option( 'woocommerce_enable_ajax_add_to_cart' );
	$quickview     = kite_opt( 'shop-enable-quickview', false );
	$wishlist      = ( class_exists( 'YITH_WCWL' ) ) ? true : false;
	$compare       = ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) ? true : false;

	$hover_image = ( kite_opt( 'product-hover-image', true ) == 1 ) ? 'show' : '';
	$layout = kite_opt( 'shop-layout', 'fitRows' );

	$hover_color = kite_opt( 'product-hover-color', 'c0392b' );
	$custom_hover_color = kite_opt( 'product-hover-custom-color', '#fff' );
	$classes[]          = ( ! kite_opt( 'shop-product-color-scheme', true ) ) ? 'dark' : '';

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
	$container = ( $fullwidth !== 1 );

	if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
		if ( sanitize_text_field( $_GET['shopSidebar'] ) == 'left' ) {
			$sidebarPos = '1';
		} elseif ( sanitize_text_field( $_GET['shopSidebar'] ) == 'right' ) {
			$sidebarPos = '2';

		} elseif ( sanitize_text_field( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
			$sidebarPos = '0';
		} else {
			$sidebarPos = kite_opt( 'shop-sidebar-position', '0' );
		}
	} else {
		$sidebarPos = kite_opt( 'shop-sidebar-position', '0' );
	}
	$shop_sidebar = ( $sidebarPos != 0 );
	$product_template = kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE );

	$responsive_list_view = ( $products_view == 'list' && kite_opt( 'responsive-product-list-view', false ) ) ? true : false;


	switch ( $product_template ) {
		case 'buttonsonhover':
			$product_template = 'buttons-on-hover';
			break;

		case 'centered':
			$product_template = 'buttons-on-hover';
			break;

		case 'infoonhover':
			$product_template = 'info-on-hover';
			break;
		default:
			break;
	}
	if ( empty( $cart_button_style ) ) {
		$cart_button_style = ( ( $on_hover_style = kite_opt( 'modern-button-on-hover-style', 'horizontal' ) ) == 'vertical' ) && ( ( $cart_button_style = kite_opt( 'modern-button-on-hover-cart-style', 'default') ) == 'quantity' || $cart_button_style == 'stretched' ) ? $cart_button_style : '';
		if ( $product_template == 'modern-buttons-on-hover' && $on_hover_style == 'vertical' ) {
			$classes[] = 'vertical-buttons';
		}
		if ( $product_template == 'modern-buttons-on-hover' && $on_hover_style == 'vertical' && ! empty( $cart_button_style ) ) {
			$classes[] = 'separated-cart';
		}
	}
	$product_rating = kite_opt( 'shop-product-rating', false );
	if ( $product_rating !== 0 ) {
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 3 );
	}

	include locate_template( 'templates/woocommerce/product-' . $product_template . '.php', false, false );
}

add_action( 'kite_woocommerce_shop_loop_item', 'kite_shop_item' );

function kite_render_product_buttons( $product, $quickview, $wishlist, $compare, $ajax_add_to_cart, $catalog_mode ) {
	include locate_template( 'templates/woocommerce/product-buttons.php', false, false );
}

add_action( 'kite_woocommerce_widget_loop_buttons', 'kite_render_product_buttons', 1, 6);
add_action( 'kite_woocommerce_shop_loop_buttons', 'kite_render_product_buttons', 1, 6);

/* -------------------------------------------------------------------------- */
/*                             WooCommerce columns                            */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_custom_loop_columns' ) ) {
	function kite_custom_loop_columns() {
		return kite_opt( 'shop-column', 4 );
	}
}
add_filter( 'loop_shop_columns', 'kite_custom_loop_columns' );


/* -------------------------------------------------------------------------- */
/*                WooCommerce search redirect to product detail               */
/*						when there is just 1 product						  */
/* -------------------------------------------------------------------------- */

add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

/* -------------------------------------------------------------------------- */
/*                           Get account/login link                           */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_myaccount_link' ) ) {
	function kite_get_myaccount_link( $text = true ) {
		$myaccount_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		$link_title    = ( is_user_logged_in() ) ? esc_html__( 'My Account', 'teta-lite' ) : esc_html__( 'Login', 'teta-lite' );
		$link_class    = ( is_user_logged_in() ) ? '' : ' class="login-link-popup no_djax"';
		if ( $text ) {
			return '<a ' . $link_class . ' href="' . esc_url( $myaccount_url ) . '">' . $link_title . '</a>';
		} else {
			return '<a ' . $link_class . ' href="' . esc_url( $myaccount_url ) . '"><span class="icon icon-user"></span></a>';
		}
	}
}

/* -------------------------------------------------------------------------- */
/*      Redeclare Original WC functions - cart & checkout buttons in cart     */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'woocommerce_widget_shopping_cart_button_view_cart' ) ) {
	function woocommerce_widget_shopping_cart_button_view_cart() {
		// add data-hover attribute for checkout and view cart buttons
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward">
                <span data-hover="' . esc_attr__( 'View Cart', 'teta-lite' ) . '">' . esc_html__( 'View Cart', 'teta-lite' ) . '</span>
            </a>';
	}
}

if ( ! function_exists( 'woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) {
	function woocommerce_widget_shopping_cart_proceed_to_checkout() {
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward"  >
                <span data-hover="' . esc_attr__( 'Checkout', 'teta-lite' ) . '">' . esc_html__( 'Checkout', 'teta-lite' ) . '</span>
            </a>';
	}
}

/* -------------------------------------------------------------------------- */
/*                               Product review                               */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_product_review' ) ) {
	function kite_product_review( $comment ) {
		$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
		if ( '0' === $comment->comment_approved ) {
			?>

			<p class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'teta-lite' ); ?></em></p>

		<?php } else { ?>

			<p class="meta">
				<strong class="woocommerce-review__author"><?php comment_author(); ?></strong> 
				<?php

				if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
					echo '<em class="woocommerce-review__verified verified">(' . esc_html__( 'verified owner', 'teta-lite' ) . ')</em> ';
				}

				if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
					if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) {
						echo '<em class="verified">(' . esc_html__( 'verified owner', 'teta-lite' ) . ')</em> ';
					}
				}
				?>
				<time datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php printf( esc_html__( '%1$s', 'teta-lite' ), get_comment_date( get_option( 'date_format' ) ) ); ?></time>

			</p>

			<?php
		}
	}
}


if ( ! function_exists( 'kite_product_review_action' ) ) {
	function kite_product_review_action() {
		add_action( 'woocommerce_review_before_comment_meta', 'kite_product_review', 9 );
		remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
	}
}
kite_product_review_action();


/* -------------------------------------------------------------------------- */
/*                  WooCommerce is attribute in product name                  */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_woocommerce_is_attribute_in_product_name' ) ) {
	function kite_woocommerce_is_attribute_in_product_name( $is_in_name, $attribute, $name ) {
		return $is_in_name = false;
	}
}
add_filter( 'woocommerce_is_attribute_in_product_name', 'kite_woocommerce_is_attribute_in_product_name', 10, 3 );


/* -------------------------------------------------------------------------- */
/*                display categories and subcategories as text.               */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_woocommerce_product_subcategories' ) ) {
	function kite_woocommerce_product_subcategories() {

		$parentid = get_queried_object_id();
		$args     = array(
			'parent'     => $parentid,
			'hide_empty' => false,
		);

		$terms = get_terms( 'product_cat', $args );

		if ( $terms ) {
			foreach ( $terms as $term ) {
				if ( $term->count > 0 ) { // prevent to display empty categories
					$cat_icon = get_term_meta( $term->term_id, 'cat_icon', true );
					if ( empty( $cat_icon ) ) {
						echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">' . $term->name . ' (' . $term->count . ')</a></li>';
					} else {
						echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">
						<span class="kt-icon icon-' . $cat_icon . '" data-name="' . esc_attr( $cat_icon ) . '"></span> ' . '<span class="header-shopcategory"><span class="product-category">' . esc_attr( $term->name ) . '</span>' . '<span class="product-count">' . esc_attr( $term->count ) . ' ' . esc_html__( 'Items', 'teta-lite' ) . '</span></span></a></li>';
					}
				}
			}
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                         Extend Woocommerce product                         */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_woocommerce_product_extended' ) ) {
	function kite_woocommerce_product_extended( $args = [] ) {
		$taxonomy     = 'product_cat';
		$orderby      = 'name';
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';
		$empty        = 1;
		$default_args         = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty,
		);
		$args = array_merge( $default_args, $args );

		$all_categories = get_categories( $args );
		foreach ( $all_categories as $cat ) {
			$category_id = $cat->term_id;
			$cat_icon    = get_term_meta( $category_id, 'cat_icon', true );
			echo '<li class="cat-item">
			<span class="kt-icon icon-' . $cat_icon . '" data-name="' . esc_attr( $cat_icon ) . '"></span>
			<div class="items">
			<a href="' . get_term_link( $cat->slug, 'product_cat' ) . '">' . $cat->name . '</a>';
			$args2    = array(
				'taxonomy'     => $taxonomy,
				'parent'       => $category_id,
				'orderby'      => $orderby,
				'show_count'   => $show_count,
				'pad_counts'   => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li'     => $title,
				'hide_empty'   => $empty,
			);
			$sub_cats = get_categories( $args2 );
			if ( $sub_cats ) {
				echo '<ul class="children">';
				foreach ( $sub_cats as $sub_category ) {
					echo '<li class="cat-item"><a href="' . get_term_link( $sub_category->slug, 'product_cat' ) . '">' . $sub_category->name . '</a></li>';
				}
				echo '</ul></div>';
			}
			echo '</li>';
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                         mobile category menu                        */
/* -------------------------------------------------------------------------- */


if ( ! function_exists( 'kite_woocommerce_cat_menu' ) ) {
	function kite_woocommerce_cat_menu() {
		global $wp_query, $post;
		$taxonomy     = 'product_cat';
		$orderby      = 'name';
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';
		$empty        = 1;
		$max_depth        = 3;
		$args        = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty,
		);
		$args['depth']      = $max_depth;
		$current_cat          = false;
		$cat_ancestors = array();

 		 if ( is_tax( 'product_cat' ) ) {
			$current_cat   = $wp_query->queried_object;
			$cat_ancestors = get_ancestors( $current_cat->term_id, 'product_cat' );
		}
		elseif ( is_singular( 'product' ) ) {
			$terms = wc_get_product_terms(
				$post->ID,
				'product_cat',
				apply_filters(
				'woocommerce_product_categories_widget_product_terms_args',
					array(
					'orderby' => 'parent',
					'order'   => 'DESC',
					)
				)
			);
			if ( $terms ) {
				$main_term           = apply_filters( 'woocommerce_product_categories_widget_main_term', $terms[0], $terms );
				$current_cat   = $main_term;
				$cat_ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
			}
		}
		$args['current_category']           = ( $current_cat ) ? $current_cat->term_id : '';
		$args['current_category_ancestors'] = $cat_ancestors;
		wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $args ) );
	}
}
add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_productCategory_menu', 4 );
if ( ! function_exists( 'kite_woocommerce_productCategory_menu' ) ) {
	function kite_woocommerce_productCategory_menu() {
		?>
		<div class="toggle-sidebar-container productcatsidebar  hidden-desktop">
			<div class="togglesidebar toggle-sidebar-product-category-menu sidebar-menu <?php if ( kite_opt( 'mobile_menu-color', true ) == 0 ) {?>light<?php } ?> ">
				<div class="mobile-menu-close-button">
					<span><?php esc_html_e( 'All Categories', 'teta-lite' ); ?></span>
					<a href="#/"><span class="mobile-menu-icon"></span></a>
				</div>  
				<nav class="mobile-navigation">
				<?php
					echo '<ul id="menu-category-menu" class="clearfix simple-menu ">';
						kite_woocommerce_cat_menu();
					echo '</ul>';
				?>
                 
				</nav>
			</div>
		</div>
	<?php
	}
}
/* -------------------------------------------------------------------------- */
/*                          change structure of shop                          */
/* -------------------------------------------------------------------------- */

// Redeclare original woocommerce_content function of WC to 
if ( ! function_exists( 'kite_woocommerce_content' ) ) {
	function kite_woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) :
				the_post();

				wc_get_template_part( 'content', 'single-product' );

			endwhile;

		} else {
			
			do_action( 'woocommerce_before_main_content' );
			
			do_action( 'woocommerce_archive_description' );

			if ( have_posts() ) :

				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

					while ( have_posts() ) :
						the_post();

						wc_get_template_part( 'content', 'product' );

					endwhile; // end of the loop. 

				woocommerce_product_loop_end();

				do_action( 'woocommerce_after_shop_loop' );

			elseif ( ! woocommerce_product_subcategories(
				array(
					'before' => woocommerce_product_loop_start( false ),
					'after'  => woocommerce_product_loop_end( false ),
				)
			) ) :

				do_action( 'woocommerce_before_shop_loop' );
				wc_get_template( 'loop/no-products-found.php' );
				do_action( 'woocommerce_after_shop_loop' );

			endif;

			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );

		}
	}
}

/* -------------------------------------------------------------------------- */
/*            Redeclare original woocommerce_get_product_thumbnail            */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0 ) {
		global $post;
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

		$lazy_load = kite_opt( 'is_lazy_load_enable', true );
		if ( ( ! is_array( $image_size ) && has_image_size( $image_size ) ) || ! has_post_thumbnail() || $image_size == 'full' ) {
			$post_thumbnail_ID = has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'woocommerce_placeholder_image', 0 );
			$props = wc_get_product_attachment_props( $post_thumbnail_ID, $post );

			$img = wp_get_attachment_image( 
				$post_thumbnail_ID, 
				$image_size, 
				false,
				array(
					'title' => $props['title'],
					'alt'   => $props['alt'],
				) 
			);

			if ( $lazy_load ) {
				$img = str_replace( 'src=', 'src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%20200%20150\'%2F%3E" data-src=', $img );
			}
			
		} else {

			if ( is_array( $image_size ) && isset( $image_size['width'] ) && isset( $image_size['height'] ) && isset( $image_size['crop'] ) ) {
				$image_dimension = $image_size;
			} elseif ( function_exists( 'wc_get_image_size' ) ) {
				$image_dimension = wc_get_image_size( $image_size );
			} else {
				$img = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $image_size ) );
				return '<div class="imageswrap productthumbnail lazy-load lazy-load-on-load" style="padding-top:' . esc_attr( kite_get_height_percentage( $img ) ) . '%;">' . $img . '</div>';
			}
			
			$image_title = get_the_title( get_post_thumbnail_id() );

			$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
			if ( function_exists( 'aq_resize' ) ) {
				$image_attributes = aq_resize( $image_link, $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], false, true );
			}
			$img_url = isset( $image_attributes[0] ) ? $image_attributes[0] : $image_link;
			$img_width = isset( $image_attributes[1] ) ? $image_attributes[1] : $image_size['width'];
			$img_height = isset( $image_attributes[2] ) ? $image_attributes[2] : $image_size['height'];

			$image_src_attrib = $lazy_load ? 'src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%20' . $img_width . '%20' . $img_height . '\'%2F%3E" data-src="' . esc_url( $img_url ) . '"' : 'src="' . esc_url( $img_url ) . '"';

			$img = '<img ' . $image_src_attrib . '  width="' . esc_attr( $img_width ) . '" height="' . esc_attr( $img_height ) . '" alt="' . esc_attr( $image_title ) . '"/>';

		}

		$lazy_load_class = $lazy_load ? 'lazy-load lazy-load-on-load' : 'kt-disable-lazy-load';
		return '<div class="imageswrap productthumbnail ' . $lazy_load_class . '" style="padding-top:' . esc_attr( kite_get_height_percentage( $img ) ) . '%;">' . $img . '</div>';

	}
}

/* -------------------------------------------------------------------------- */
/*      Set appropriate image size for product thumbnails in masonry shop     */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_product_thumbnail_masonry_size' ) ) {
	function kite_product_thumbnail_masonry_size( $size ) {
		return kite_opt( 'shop-layout', 'fitRows' ) == 'masonry' ? 'Kite_product_thumbnail-auto-height' : $size; 
	}
}

add_filter( 'single_product_archive_thumbnail_size', 'kite_product_thumbnail_masonry_size' );


if ( ! function_exists( 'kite_woo_hide_page_title' ) ) {
	function kite_woo_hide_page_title() {
		return false;
	}
}

add_filter( 'woocommerce_show_page_title', 'kite_woo_hide_page_title' );

// Ensure cart contents update when products are added to the cart via AJAX
if ( ! function_exists( 'kite_woocommerce_header_add_to_cart_fragment' ) ) {
	function kite_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
			<div class="cart-contents"><div class="cartcontentscount"><?php echo WC()->cart->cart_contents_count; ?></div></div>
		<?php

		$fragments['div.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kite_woocommerce_header_add_to_cart_fragment' );


/* -------------------------------------------------------------------------- */
/*                             Woocommerce Notices                            */
/* -------------------------------------------------------------------------- */

// Hook into ajax add-to-cart functionality to add notices even when woocommerce_cart_redirect_after_add == yes
if ( ! function_exists( 'kite_woocommerce_addtocart_add_notices' ) ) {
	function kite_woocommerce_addtocart_add_notices( $product_id ) {
		if ( get_option( 'woocommerce_cart_redirect_after_add' ) != 'yes' ) {
			$quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( sanitize_text_field( $_POST['quantity'] ) );
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
		}
	}
}

add_action( 'woocommerce_ajax_added_to_cart', 'kite_woocommerce_addtocart_add_notices' );
	


// Print notices in reponse of adding item to cart ( cart widget) to access it through ajax add-to-cart
if ( ! function_exists( 'kite_woocommerce_addtocart_print_notices' ) ) {
	function kite_woocommerce_addtocart_print_notices() {
		if ( kite_is_shop_ajax_add_to_cart() ) {
			if ( kite_opt( 'woocommerce-notices', true ) != '0' ) {
				wc_print_notices(); // print notices to be shown in popup style
			} else {
				wc_clear_notices();// clear notices silently
			}
		}

	}
}

if ( ! function_exists( 'kite_woocommerce_addtocart_print_notices_action' ) ) {
	function kite_woocommerce_addtocart_print_notices_action() {
		add_action( 'woocommerce_after_mini_cart', 'kite_woocommerce_addtocart_print_notices' );

		// print notices in loop products shortcodes
		if ( ! function_exists( 'wc_print_notices' ) ) {
			return;
		}
		add_action( 'woocommerce_shortcode_before_single_product_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_products_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_sale_products_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_best_selling_products_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_top_rated_products_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_featured_products_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_product_attribute_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_shortcode_before_recent_products_loop', 'wc_print_notices', 10 );
	}
}
kite_woocommerce_addtocart_print_notices_action();

// remove archive desciption
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

if ( ! function_exists( 'kite_remove_ptags_around_shop_page_content' ) ) {
	function kite_remove_ptags_around_shop_page_content( $content ) {
		if ( strpos( $content, '</div>' ) !== false ) {
			return preg_replace( '/<p>(.+)<\/p>$/Uuis', '$1', $content );
		}

		return $content;
	}
}
add_filter( 'woocommerce_format_content', 'kite_remove_ptags_around_shop_page_content' );


/* -------------------------------------------------------------------------- */
/*                      Product Filter and Porduct Order                      */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_woocommerce_shop_filter_action' ) ) {
	function kite_woocommerce_shop_filter_action() {

		if ( isset( $_GET['shopFilter'] ) && ! empty( $_GET['shopFilter'] ) ) {
			if ( esc_html( $_GET['shopFilter'] ) == 'width-filter' ) {
				$shopFilter = true;
			} elseif ( esc_html( $_GET['shopFilter'] ) == 'without-filter' ) {
				$shopFilter = false;
			} else {
				$shopFilter = kite_opt( 'shop-filter', false );
			}
		} else {
			$shopFilter = kite_opt( 'shop-filter', false );
		}
		add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_filter', 4 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		if ( $shopFilter != 1 ) {

			if ( is_active_sidebar( 'woocommerce-sidebar' ) ) {
				add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_sidebar', 40 );
			}
		}
	}
}
add_action( 'init', 'kite_woocommerce_shop_filter_action' );

if ( ! function_exists( 'kite_woocommerce_container' ) ) {
	function kite_woocommerce_container() {
		if ( isset( $_GET['shopWidth'] ) && ! empty( $_GET['shopWidth'] ) ) {
			if ( esc_html( $_GET['shopWidth'] ) == 'fullwidth' ) {
				$fullwidth = true;
			} elseif ( esc_html( $_GET['shopWidth'] ) == 'container' ) {
				$fullwidth = false;
			} else {
				$fullwidth = kite_opt( 'shop-enable-fullwidth', false );
			}
		} else {
			$fullwidth = kite_opt( 'shop-enable-fullwidth', false );
		}

		if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
			if ( esc_html( $_GET['shopSidebar'] ) == 'left' ) {
				$sidebarPos = '1';
			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'right' ) {
				$sidebarPos = '2';

			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
				$sidebarPos = '0';
			} else {
				$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
			}
		} else {
			$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
		}
		if ( ! is_product() && ! ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) && !is_tax( 'dc_vendor_shop' ) ) {

			if ( 0 == $sidebarPos || !kite_count_sidebar_widgets( 'woocommerce-sidebar' ) ) {
				if ( $fullwidth != 1 ) {
					echo '<div class="shop_top_padding container">';
				} else {
					echo '<div class="shop_top_padding shop_fullwidth_widthoutsidebar">';
				}
				echo '<div class="container">';
			} else {
				if ( $fullwidth != 1 ) {
					echo '<div class="shop_top_padding container">';
				} else {
					echo '<div class="shop_top_padding shop_fullwidth_sidebar">';
				}
				if ( ! wp_is_mobile() ) {
					$contentClass = 'span9 has-wc-sidebar';
				} else {
					$contentClass = 'container';
				}

				if ( 1 == $sidebarPos && ! wp_is_mobile() ) {
					$contentClass .= ' float-right';
				}

				if ( 2 == $sidebarPos && ! wp_is_mobile() && is_rtl() ) {
					$contentClass .= ' float-left';
				}

				echo '<div class="' . esc_attr( $contentClass ) . '">';

			}
		}
	}
}

if ( ! function_exists( 'kite_woocommerce_top_container_close' ) ) {
	function kite_woocommerce_top_container_close() {
		if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
			if ( esc_html( $_GET['shopSidebar'] ) == 'left' ) {
				$sidebarPos = '1';
			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'right' ) {
				$sidebarPos = '2';

			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
				$sidebarPos = '0';
			} else {
				$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
			}
		} else {
			$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
		}
		if ( 0 == $sidebarPos || !kite_count_sidebar_widgets( 'woocommerce-sidebar' ) ) {
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'kite_woocommerce_container_close' ) ) {
	function kite_woocommerce_container_close() {
		if ( ! is_product() && ! ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) && !is_tax( 'dc_vendor_shop' ) ) {
			if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
				if ( esc_html( $_GET['shopSidebar'] ) == 'left' ) {
					$sidebarPos = '1';
				} elseif ( esc_html( $_GET['shopSidebar'] ) == 'right' ) {
					$sidebarPos = '2';

				} elseif ( esc_html( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
					$sidebarPos = '0';
				} else {
					$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
				}
			} else {
				$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
			}
			if ( $sidebarPos != 0 && kite_count_sidebar_widgets( 'woocommerce-sidebar' ) ) {
				echo '</div>';
				echo '<!-- Sidebar -->';
				ob_start();
				kite_get_sidebar( 'woocommerce-sidebar', 'togglefilterscontainer' );
				$sidebar = ob_get_clean();
				echo '<div id="woocommerce-sidebar" class="span3">' . $sidebar . '</div>';
			}

			echo '</div>';
		}
	}
}
if ( ! function_exists( 'kite_woocommerce_sidebar' ) ) {
	function kite_woocommerce_sidebar() {

		// filter button in Mobile
		echo '<span class="filterBgTabletPhone hidden-desktop"></span>';
		echo '<span class="shop-filter-toggle  hidden-desktop">
                    <span class="shop-filter-text no-select"><span class="closetext">' . esc_html__( 'Filter', 'teta-lite' ) . '</span></span>
                </span>';
		if ( isset( $_GET['shopFilter'] ) && ! empty( $_GET['shopFilter'] ) ) {
			if ( esc_html( $_GET['shopFilter'] ) == 'width-filter' ) {
				$shopFilter = true;
			} elseif ( esc_html( $_GET['shopFilter'] ) == 'without-filter' ) {
				$shopFilter = false;
			} else {
				$shopFilter = kite_opt( 'shop-filter', false );
			}
		} else {
			$shopFilter = kite_opt( 'shop-filter', false );
		}

		$style = $shopFilter ? '' : 'style="display:none;"';
		$class = kite_opt( 'shop-filter-style', true ) ? 'toggle-type' : 'sidebar-type';
		echo '<div class="shop-filter woocommerce-sidebar sidebar widget-area ' . $class .  '" ' . $style . '></div>';
	}
}

if ( ! function_exists( 'kite_woocommerce_sidebar_action' ) ) {
	function kite_woocommerce_sidebar_action() {
		add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_container', 5 );
		add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_top_container_close', 41 );
		add_action( 'woocommerce_after_shop_loop', 'kite_woocommerce_container_close', 40 );
	}
}
kite_woocommerce_sidebar_action();


if ( ! function_exists( 'kite_woocommerce_filter' ) ) {
	function kite_woocommerce_filter() {

		// Find the category + category parent, if applicable
		$term      = get_queried_object();
		$parent_id = empty( $term->term_id ) ? 0 : $term->term_id;

		// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( https://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
		$product_categories = get_categories(
			apply_filters(
				'woocommerce_product_subcategories_args',
				array(
					'parent'       => $parent_id,
					'menu_order'   => 'ASC',
					'hide_empty'   => 0,
					'hierarchical' => 1,
					'taxonomy'     => 'product_cat',
					'pad_counts'   => 1,
				)
			)
		);

		if ( apply_filters( 'woocommerce_product_subcategories_hide_empty', true ) ) {
			$product_categories = wp_list_filter( $product_categories, array( 'count' => 0 ), 'NOT' );
		}

		$display_type_shop_wc_setting             = get_option( 'woocommerce_shop_page_display' );
		$display_type_wc_setting                  = get_option( 'woocommerce_category_archive_display' );
		$display_type_cat_setting                 = get_term_meta( $parent_id, 'display_type' );
		$dispaly_type_category_archive_wc_setting = get_option( 'woocommerce_category_archive_display' );

		$show_filter    = ( ( is_shop() && $display_type_shop_wc_setting == 'subcategories' ) || ( is_product_category() && $display_type_cat_setting == 'subcategories' && $product_categories ) || ( is_product_category() && $display_type_wc_setting == 'subcategories' && $display_type_cat_setting == '' && $product_categories ) || ( is_product_category() && $dispaly_type_category_archive_wc_setting == 'subcategories' && $product_categories ) ) ? false : true;
		$switch_view    = ( ( kite_opt( 'shop-product-view', 'grid' ) === 'grid_sv' ) || ( kite_opt( 'shop-product-view', 'grid' ) === 'list_sv' ) ) ? true : false;
		$showSwitchView = $switch_view ? 'switch_view' : '';

		$per_page = kite_opt( 'product-per-page', true );
		if ( $per_page && isset( $_GET['pagination'] ) && ( $_GET['pagination'] == 'load_more' || $_GET['pagination'] ) == 'infinite_scroll' ) {
			$per_page = false;
		}
		if ( $per_page && ( kite_opt( 'products-pagination', 'pagination' ) == 'load_more' || kite_opt( 'products-pagination', 'pagination' ) == 'infinite_scroll' ) ) {
			$per_page = false;
		}

		$show_per_page      = $per_page ? 'show_per_page' : '';
		$enabled_sorting    = kite_opt( 'shop-filter-sorting', true );
		$enabled_categories = kite_opt( 'shop-filter-categories', true );
		$show_categories    = ( ( is_shop() && $display_type_shop_wc_setting == '' ) || ( is_product_category() && $display_type_cat_setting == '' && $display_type_wc_setting == '' ) || ( is_product_category() && $display_type_cat_setting == '' && $display_type_wc_setting == 'products' ) ) ? true : false;

		if ( ! $enabled_categories ) {
			$show_categories_filter = 'no-categories-filter';
		} else {
			$show_categories_filter = 'show-categories';
		}

		if ( ! $show_filter ) {
			return;
		}

		if ( isset( $_GET['shopFilter'] ) && ! empty( $_GET['shopFilter'] ) ) {
			if ( esc_html( $_GET['shopFilter'] ) == 'width-filter' ) {
				$shopFilter = true;
			} elseif ( esc_html( $_GET['shopFilter'] ) == 'without-filter' ) {
				$shopFilter = false;
			} else {
				$shopFilter = kite_opt( 'shop-filter', false );
			}
		} else {
			$shopFilter = kite_opt( 'shop-filter', false );
		}

		if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
			if ( esc_html( $_GET['shopSidebar'] ) == 'left' ) {
				$sidebarPos = '1';
			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'right' ) {
				$sidebarPos = '2';

			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
				$sidebarPos = '0';
			} else {
				$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
			}
		} else {
			$sidebarPos = kite_opt( 'shop-sidebar-position' , 0 );
		}
		$class = kite_opt( 'shop-filter-style', true ) ? 'toggle-type ' : 'sidebar-type ';
			echo '<div class="shop-filter sidebar widget-area ' . $class . ( get_search_query() ? 'show-search-result' : '' ) . ( $show_categories_filter ) . ' ' . $showSwitchView . ' ' . $show_per_page . ' ' . ( $show_categories ? '' : 'hidden-cats' ) . ' ' . ( ( $sidebarPos == '1' || $sidebarPos == '2' ) ? 'has-wc-sidebar' : '' ) . '">';

		if ( $shopFilter && ! ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) ) {
			echo '<span class="shop-filter-toggle">
                        <span class="togglelines"></span>
                <span class="shop-filter-text no-select"><span class="opentext">' . esc_html__( 'Close', 'teta-lite' ) . '</span><span class="closetext">' . esc_html__( 'Filter', 'teta-lite' ) . '</span></span>
                </span>';
		} elseif ( function_exists( 'woocommerce_result_count' ) ) {
			echo '<div class="special-filter result-count">';
			woocommerce_result_count();
			echo '</div>';
		}
			// shop categories
		if ( $enabled_categories ) {
			echo '<div class="special-filter cat ' . ( $show_categories ? '' : 'hidden-cats' ) . '">';
				kite_change_categories_nav_walker();
			echo '</div>';
		}

		if ( ( is_shop() && $display_type_shop_wc_setting == 'subcategories' ) || ( is_product_category() && $display_type_cat_setting == 'subcategories' && $product_categories ) || ( is_product_category() && $display_type_wc_setting == 'subcategories' && $display_type_cat_setting == '' && $product_categories ) ) {
			echo '</div>';
			return;
		}
		if ( $enabled_sorting ) {
			echo '<div class="special-filter sort">';
				kite_generate_sorting_methods();
			echo '</div>';
		}
		if ( $switch_view && ! ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) ) {
			echo '<div id="switch_view_buttons">
    
                        <span class="label_view">' . esc_html__( 'Views : ', 'teta-lite' ) . ' </span>
                        <span class="views_button grid"><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '?view=grid"><i class="icon-th"></i></a></span>
                        <span class="views_button list"><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '?view=list"><i class="icon-th-list"></i></a></span>
                        
                    </div>';
		}
			$loop_shop_columns = kite_opt( 'shop-column', 4 );
		if ( isset( $_GET['per-page'] ) && ! empty( $_GET['per-page'] ) ) {
			$get_per_page = htmlspecialchars( $_GET['per-page'] );
		} else {
			$get_per_page = '';
		}
		if ( $per_page ) {
			echo "<div class='product_per_page_filter'>
                        <span class='filter_title'>" . esc_html__( 'Show : ', 'teta-lite' ) . "</span>
                        <span class='num " . ( ( ( $loop_shop_columns * 3 ) == $get_per_page ) ? 'selected' : '' ) . "' data-num='" . ( $loop_shop_columns * 3 ) . "'>" . ( $loop_shop_columns * 3 ) . "</span>
                        <span class='num " . ( ( ( $loop_shop_columns * 4 ) == $get_per_page ) ? 'selected' : '' ) . "' data-num='" . ( $loop_shop_columns * 4 ) . "'>" . ( $loop_shop_columns * 4 ) . "</span>
                        <span class='num " . ( ( ( $loop_shop_columns * 6 ) == $get_per_page ) ? 'selected' : '' ) . "' data-num='" . ( $loop_shop_columns * 6 ) . "'>" . ( $loop_shop_columns * 6 ) . "</span>
                        <span class='num " . ( ( ( $loop_shop_columns * 8 ) == $get_per_page ) ? 'selected' : '' ) . "' data-num='" . ( $loop_shop_columns * 8 ) . "'>" . ( $loop_shop_columns * 8 ) . '</span>
                </div>';
		}

			// show search form
		if ( kite_opt( 'shop-filter-search', true ) ) {
			kite_search_form();
		}
			$showFilterToggleStyle = kite_opt( 'shop-filter-style', true );

		if ( isset( $_GET['filterStyle'] ) && $_GET['filterStyle'] == 'toggle' ) {
			$showFilterToggleStyle = true;
		} elseif ( isset( $_GET['filterStyle'] ) && $_GET['filterStyle'] == 'sidebar' ) {
				$showFilterToggleStyle = false;
		}

		if ( $showFilterToggleStyle ) {
			// Filters in filter sidebar
			kite_get_sidebar( 'woocommerce-filter-sidebar', 'togglefilterscontainer' );

			echo '<div class="bottompartfilter">';
				echo '<div class="special-filter">';

			if ( function_exists( 'woocommerce_result_count' ) ) {
				woocommerce_result_count();
			}

				echo '</div>';

				// show active filters
			if ( kite_opt( 'shop-filter-active-filters', true ) ) {
				echo '<div class="special-filter special_layered_nav_filters">';
				// @TODO: remove Kite_Theme_Check  
				if ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) {
					the_widget( 'Kite_WC_Widget_Layered_Nav_Filters' );
				} else {
					the_widget( 'WC_Widget_Layered_Nav_Filters' );
				}
				echo '</div>';
			}

				echo '</div>';
		}
		if ( ! is_product() ) {
			$filtersidebar = '';
			if ( $showFilterToggleStyle ) {
				$filtersidebar = 'hidden-desktop';
			}
				echo "<div class='toggle-sidebar-container filtersidebar " . $filtersidebar . "'>";
				echo "<div class='headsection'>";
				echo "<span class='sidebartitle'>" . esc_html__( 'Filters', 'teta-lite' ) . "</span><span class='closesidebar'><span class='icon'></span></span>";
				echo '</div>';
				if ( function_exists( 'woocommerce_result_count' ) ) {
					woocommerce_result_count();
				}
				echo '<div class="bottompartfilter">';
				// show active filters
			if ( kite_opt( 'shop-filter-active-filters', true ) ) {
				echo '<div class="special-filter special_layered_nav_filters">';
				// @TODO: remove kite_theme_check 
				if ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) {
							the_widget( 'Kite_WC_Widget_Layered_Nav_Filters' );
				} else {
						the_widget( 'WC_Widget_Layered_Nav_Filters' );
				}
						echo '</div>';
			}

				echo '</div>';
				kite_get_sidebar( 'woocommerce-filter-sidebar', 'togglefilterscontainer' );
				echo '</div>';
		}
		echo '</div>';
		if ( kite_opt( 'shop-filter-active-filters', true ) && ( is_shop() || is_product_category() || is_product_tag() ) && kite_opt( 'shop-filter', false ) ) {
			echo '<div class="mobileactivefilters hidden-desktop">';
			echo '<div class="special-filter special_layered_nav_filters">';
			// @TODO: remove kite_theme_check
			if ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) {
				the_widget( 'Kite_WC_Widget_Layered_Nav_Filters' );
			} else {
				the_widget( 'WC_Widget_Layered_Nav_Filters' );
			}
				echo '</div>';
			echo '</div>';
		}

	}
}
/* -------------------------------------------------------------------------- */
/*                             category in filter                             */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_change_categories_nav_walker' ) ) {
	function kite_change_categories_nav_walker() {

		global $wp_query;
		$page_url = wc_get_page_permalink( 'shop' );
		if ( '' === get_option( 'permalink_structure' ) ) {
			$page_url = get_post_type_archive_link( 'product' );
		}
		$hide_sub             = true;
		$all_categories_class = 'option';
		$current_cat          = ( is_tax( 'product_cat' ) ) ? $wp_query->queried_object->term_id : '';
		$current_cat_parent   = ( is_tax( 'product_cat' ) ) ? $wp_query->queried_object->parent : '';

		// Get current category's direct children
		$current_cat_has_children = get_terms(
			'product_cat',
			array(
				'fields'       => 'ids',
				'parent'       => $current_cat,
				'hierarchical' => true,
				'hide_empty'   => 0,
			)
		);
		$category_has_children    = ( empty( $current_cat_has_children ) ) ? false : true;

		if ( !strlen( $current_cat ) ) { // category page

			// No current category, set "All" as current (if not product tag archive or search)
			if ( ! is_product_tag() && ! isset( $_REQUEST['s'] ) ) {
				$all_categories_class .= ' current-cat';
			}
		}

		$args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		);

		$products = new WP_Query( $args );

		$output = '<li class="' . $all_categories_class . '" data-value="' . esc_url( $page_url ) . '"><a href="' . esc_url( $page_url ) . '">' . esc_html__( 'All Categories', 'teta-lite' ) . '</a></li>';

		// Categories order
		$orderby    = 'slug';
		$order      = 'asc';
		$hide_empty = 1;

		$shop_filter_hidden_empty_category = kite_opt( 'shop_filter_hidden_empty_category', false ); // show or hide empty categories on shop filter

		if ( $shop_filter_hidden_empty_category != 0 ) {
			$hide_empty = 0;
		}

		$empty_categories = get_categories(
			$args         = array(
				'type'         => 'post',
				'orderby'      => $orderby,
				'order'        => $order,
				'hide_empty'   => $hide_empty,
				'hierarchical' => 1,
				'taxonomy'     => 'product_cat',
			)
		);

		foreach ( $empty_categories as $category ) {
			if ( $category->parent == '0' ) {
				$output .= kite_category_list( $category, $current_cat );
			}
		}

		$output = '<div class="widget woocommerce widget_product_categories inFilterbar"><div class="nice-select"><span class="current">' . esc_html__( 'All Categories', 'teta-lite' ) . '</span><ul class="list">' . $output . '</ul></div></div>';

		echo '' . $output;
	}
}

if ( ! function_exists( 'kite_generate_sorting_methods' ) ) {
	function kite_generate_sorting_methods() {
		global $wp, $wp_the_query;
		if ( get_option( 'permalink_structure' ) == '' ) {
			$link = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$link = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
		}

		// Min/Max
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', esc_attr( $_GET['min_price'] ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', esc_attr( $_GET['max_price'] ), $link );
		}

		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
		}

		if ( ! empty( $_GET['post_type'] ) ) {

			$link = add_query_arg( 'post_type', esc_attr( $_GET['post_type'] ), $link );
		}

		if ( ! empty( $_GET['product_cat'] ) ) {
			$link = add_query_arg( 'product_cat', esc_attr( $_GET['product_cat'] ), $link );
		}

		if ( ! empty( $_GET['product_tag'] ) ) {
			$link = add_query_arg( 'product_tag', esc_attr( $_GET['product_tag'] ), $link );
		}

		// Min Rating Arg
		if ( isset( $_GET['rating_filter'] ) ) {
			$link = add_query_arg( 'rating_filter', wc_clean( $_GET['rating_filter'] ), $link );
		}

		// KiteSt
		// On Sale Arg
		if ( isset( $_GET['status'] ) && $_GET['status'] == 'sale' ) {
			$link = add_query_arg( 'status', esc_attr( $_GET['status'] ), $link );
		}
		// In stock Arg
		if ( isset( $_GET['availability'] ) && $_GET['availability'] == 'in_stock' ) {
			$link = add_query_arg( 'availability', esc_attr( $_GET['availability'] ), $link );
		}

		$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => esc_html__( 'Default sorting', 'teta-lite' ),
				'popularity' => esc_html__( 'Sort by popularity', 'teta-lite' ),
				'rating'     => esc_html__( 'Sort by average rating', 'teta-lite' ),
				'date'       => esc_html__( 'Sort by newness', 'teta-lite' ),
				'price'      => esc_html__( 'Sort by price: low to high', 'teta-lite' ),
				'price-desc' => esc_html__( 'Sort by price: high to low', 'teta-lite' ),
			)
		);

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $attribute => $data ) {
				$taxonomy_filter = 'filter_' . wc_attribute_taxonomy_slug( $attribute );

				$link = add_query_arg( esc_attr( $taxonomy_filter ), esc_attr( implode( ',', $data['terms'] ) ), $link );

				if ( 'or' == $data['query_type'] ) {
					$link = add_query_arg( esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ), 'or', $link );
				}
			}
		}
		$output  = '';
		$current = '';
		foreach ( $catalog_orderby_options as $key => $name ) {
			if ( $orderby == $key ) {
				$current = "<span class='current'>" . esc_attr( $name ) . '</span>';
				$output .= '<li data-value="' . esc_url( $link ) . '" class="option current">' . esc_attr( $name ) . '</li>';
			} else {
				// Add 'orderby' URL query string
				$link    = add_query_arg( 'orderby', $key, $link );
				$output .= '<li data-value="' . esc_url( $link ) . '" class="option"><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
			}
		}

		$current = ( $current == '' ) ? '<span class="current">' . esc_html__( 'Default Sorting', 'teta-lite' ) . '</span>' : $current;
		$output  = '<div class="widget woocommerce widget_product_sorting"><div class="nice-select">' . $current . '<ul class="list">' . $output . '</ul></div></div>';
		echo '' . $output;
	}
}

/* -------------------------------------------------------------------------- */
/*                                category list                               */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_category_list' ) ) {
	function kite_category_list( $category, $current_cat ) {
		$output = '<li data-value="' . esc_url( get_term_link( (int) $category->term_id, 'product_cat' ) ) . '" class="option cat-item-' . esc_attr( $category->term_id );

		if ( $current_cat == $category->term_id ) {
			$output .= ' current-cat';
		}

		$output .= ' ' . esc_attr( $category->name );

		$output .= '"><a href="' . esc_url( get_term_link( (int) $category->term_id, 'product_cat' ) ) . '">' . esc_attr( $category->name ) . '</a></li>';

		return $output;
	}
}

/* -------------------------------------------------------------------------- */
/*                              subcategory list                              */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_subcategory_list' ) ) {
	function kite_subcategory_list( $category, $current_cat ) {
		$output = '<li class="cat-item-' . esc_attr( $category->term_id );

		if ( $current_cat == $category->term_id ) {
			$output .= ' current-cat';
		}

		$output .= '"><a href="' . esc_url( get_term_link( (int) $category->term_id, 'product_cat' ) ) . '">' . esc_attr( $category->name ) . '</a></li>';

		return $output;
	}
}

if ( ! function_exists( 'kite_search_form' ) ) {
	function kite_search_form() {
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
			$type     = 'mainshop';
		}
		$get_search_arg = ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) ? 'start_search' : '';
		get_search_form([
			'shop-filter-search-form' 	=> true,
			'search-arg-class'			=> $get_search_arg,
			'search-type'				=> $type,
			'page-url'					=> $page_url
		]);
	}
}

// Product
if ( ! function_exists( 'kite_woocommerce_shop_loop_action' ) ) {
	function kite_woocommerce_shop_loop_action() {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
		if ( kite_opt( 'shop-product-rating', false ) != 0 ) {
			add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 3 );
		}
		// Product buttons
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 0 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 2 );
		add_action( 'woocommerce_shop_loop_item_title', 'shop_loop_product_categories', 5 );

		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );	
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	}
}
add_action( 'init', 'kite_woocommerce_shop_loop_action' );
/* -------------------------------------------------------------------------- */
/*                       Show Product Categories In Loop                      */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'shop_loop_product_categories' ) ) {
	function shop_loop_product_categories() {
		if ( ! kite_opt( 'shop-loop-product-categories', true ) ) {
			return;
		}
		global $product;
		$product_id   = $product->get_id();
		$terms        = get_the_terms( $product_id, 'product_cat' );
		$product_cats = array();
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$cat_link = "<a href='" . get_category_link( $term->term_id ) . "' class='cat_link'>" . $term->name . '</a>';
				array_push( $product_cats, $cat_link );
			}
			$product_cat = implode( ' . ', $product_cats );
		}
		if ( ! empty( $product_cat ) ) {
			echo '<span class="default_product_cat">' . $product_cat . '</span>';
		}
	}
}

/* -------------------------------------------------------------------------- */
/*             WooCommerce product title - linkde to product page             */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_woocommerce_product_title' ) ) {
	function kite_woocommerce_product_title() {
		global $product;
		$link = get_the_permalink();
		echo '<a href="' . $link . '" ><h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . esc_html( get_the_title() ) . '</h2></a>';
	}
}

if ( ! function_exists( 'kite_woocommerce_product_title_action' ) ) {
	function kite_woocommerce_product_title_action() {
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'woocommerce_shop_loop_item_title', 'kite_woocommerce_product_title', 10 );

	}
}
kite_woocommerce_product_title_action();

if ( ! function_exists( 'kite_add_compare_button' ) ) {
	function kite_add_compare_button() {
		if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) {
			global $yith_woocompare;
			ob_start();
			if ( $yith_woocompare->is_frontend() ) {
				$yith_woocompare->obj->add_compare_link();
			} else {
				$compare_link = "<a href='#' class='compare button' data-product_id='0' rel='nofollow'> " . esc_html__( 'Compare', 'teta-lite' ) . " </a>";
				echo wp_kses( $compare_link, $GLOBALS['kite-allowed-tags'] );
			}
			$output = ob_get_clean();
			$output = str_replace( 'class="', 'class="no_djax ', $output );
			echo '<span title="' . esc_attr__( 'Add to compare list', 'teta-lite' ) . '">' . $output . '<span class="kt-tooltip"><span class="hint-txt">' . esc_attr__( 'Compare', 'teta-lite' ) . '</span></span></span>';
		}
	}
}

if ( ! function_exists( 'kite_add_yith_compare_button' ) ) {
	function kite_add_yith_compare_button() {
		if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) {
			global $yith_woocompare;
			if ( class_exists( '\Elementor\Plugin' ) ) {
				if ( ( ! is_null( \Elementor\Plugin::$instance->editor ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ) {
					if ( ! defined( 'DOING_AJAX' ) ) {
						define( 'DOING_AJAX', true );
					}
					$_REQUEST['context'] = 'frontend';
					$yith_woocompare     = new YITH_Woocompare();
				}
			}
			remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
		}
	}
}

add_action( 'init', 'kite_add_yith_compare_button' );



if ( ! function_exists( 'kite_summery_add_compare_link' ) ) {
	function kite_summery_add_compare_link() {
		if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' ) {
			global $yith_woocompare;
			ob_start();

			$yith_woocompare->obj->add_compare_link();

			$compare_button = ob_get_clean();
			$compare_button = str_replace( '<a', '<a title="' . esc_attr__( 'Add to compare list', 'teta-lite' ) . '"', $compare_button );
			$compare_button = str_replace( 'class="', 'class="no_djax ', $compare_button );
			echo '' . $compare_button;
		}
	}
}

if ( ! function_exists( 'kite_yith_woocompare_button' ) ) {
	function kite_yith_woocompare_button() {
		if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' ) {
			global $yith_woocompare;

			remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
			add_action( 'woocommerce_after_add_to_cart_button', 'kite_summery_add_compare_link', 35 );

		}
	}
}
kite_yith_woocompare_button();

if ( ! function_exists( 'kite_yith_wooWishlist_button' ) && class_exists( 'YITH_WCWL' ) ) {
	function kite_yith_wooWishlist_button( $data ) {
		$data = array(
			'add-to-cart' => array(
				'hook'     => 'woocommerce_after_add_to_cart_button',
				'priority' => 31,
			),
			'thumbnails'  => array(
				'hook'     => 'woocommerce_product_thumbnails',
				'priority' => 21,
			),
			'summary'     => array(
				'hook'     => 'woocommerce_after_single_product_summary',
				'priority' => 11,
			),
			'after_add_to_cart' => array( 
				'hook' => 'woocommerce_single_product_summary', 
				'priority' => 31 
			),
		);
		return $data;
	}
	add_filter( 'yith_wcwl_positions', 'kite_yith_wooWishlist_button' );
}

add_action( 'woocommerce_after_add_to_cart_button', 'kite_summery_cart_button', 5 );

if ( ! function_exists( 'kite_summery_cart_button' ) ) {
	function kite_summery_cart_button() {
		if ( ! kite_opt( 'single-product-ajax-addtocart', true ) ) {
			return;
		}
		global $product;
		$ajaxClass = '';
		$href      = esc_url( '#' );
		if ( 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
			$ajaxClass = '  ajax_add_to_cart';
		}
		if ( $product->get_type() == 'external' ) {
			$product_url = $product->get_product_url();

			$href      = esc_url( $product_url );
			$ajaxClass = 'affilate-product';
			echo '<div class="cart">';

		}
		?>
		<a class="single_add_to_cart_button button alt product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button <?php echo esc_attr( $ajaxClass ); ?>" 
			<?php
			if ( $product->get_type() == 'simple' ) {
			?>
			 data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
			 data-quantity="<?php echo kite_get_min_product_quantity(); ?>" 
			<?php
			} if ( $product->get_type() == 'external' ) {
			?>
			href="<?php echo esc_url( $href ); ?> " 
			<?php } ?> 
			title="<?php echo esc_attr( $product->single_add_to_cart_text() ); ?>">
			<?php if ( $product->get_type() == 'simple' && 'no' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) { ?> 
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/> 
			<?php } ?>
					<span class="txt">
							<?php echo esc_attr( $product->single_add_to_cart_text() ); ?>
					</span>
		</a>
		<?php
		if ( $product->get_type() == 'external' ) {
			echo '</div>';
		}
	}
}


// change priority of items in WooCommerce single product page
if ( ! function_exists( 'kite_woocommerce_single_product_summary_action' ) ) {
	function kite_woocommerce_single_product_summary_action() {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		if ( ! kite_opt( 'single_product_meta', true ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		}

		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		
		if ( ! kite_opt( 'single_product_meta', true ) ) { 
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 40 );
			add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 10 );
		}
		
	}
}

add_action( 'init', 'kite_woocommerce_single_product_summary_action' );



/*-----------------------------------------------------------------*/
// woocommerce product summary out of stock
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_product_summary_stock' ) ) {
	function kite_product_summary_stock() {
		global $product;
		$availability = $product->get_availability();
		if ( $availability['availability'] == 'Out of stock') {
			add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
			echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
		}	
	}
}

add_action( 'woocommerce_single_product_summary', 'kite_product_summary_stock', 5);


/*-----------------------------------------------------------------*/
// woocommerce product summary style
/*-----------------------------------------------------------------*/

if( ! function_exists( 'kite_product_summary_left_content' ) ) {
	function kite_product_summary_left_content() {
		echo '<div class="kite-summary-left-content">';
				add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 2 );
	}
}

if ( ! function_exists( 'kite_product_summary_content' ) ) {
	function kite_product_summary_content() {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 21 );
	

	}
}
add_action( 'woocommerce_single_product_summary', 'kite_product_summary_content', 0);

if( ! function_exists ( 'kite_product_summary_right_content' ) ) {
	function kite_product_summary_right_content(){
		echo '</div>';
		echo '<div class="kite-summary-right-content">';
	}
}
if( ! function_exists ( 'kite_product_summary_content_end' ) ) {
	function kite_product_summary_content_end(){
		echo '</div>';
	}
}

if( ! function_exists ( 'kite_product_summary_content_end_action' ) ) {
	function kite_product_summary_content_end_action(){
		$product_detail_style = ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) ? kite_get_meta( 'product_detail_style' ) : kite_opt( 'product-detail-style', 'pd_classic' );
		if ( ( ( $product_detail_style == 'pd_fullwidth_top' ) || ( $product_detail_style == 'pd_top' ) ) && (! wp_is_mobile() ) ) {
			add_action( 'woocommerce_single_product_summary', 'kite_product_summary_left_content', 1 );
			add_action( 'woocommerce_single_product_summary', 'kite_product_summary_right_content', 25 );
			add_action( 'woocommerce_single_product_summary', 'kite_product_summary_content_end', 55 );
		}
		else if ( wp_is_mobile()  ) {
			remove_action( 'woocommerce_single_product_summary', 'kite_product_summary_left_content', 1 );
			remove_action( 'woocommerce_single_product_summary', 'kite_product_summary_right_content', 25 );
			remove_action( 'woocommerce_single_product_summary', 'kite_product_summary_content_end', 55 );
		}
	}
}
add_action( 'woocommerce_single_product_summary', 'kite_product_summary_content_end_action', 0);


// Change the product displayed price on product pages
if ( ! function_exists( 'kite_single_price' ) ) {
	function kite_single_price( $price ) {
		if ( strpos( $price, 'amount' ) > 0 ) {
			$price = str_replace( '&ndash;', ' - ', $price );
		}
		return $price;
	}
}


if ( ! function_exists( 'kite_woocommerce_subcategory_thumbnail' ) ) {
	function kite_woocommerce_subcategory_thumbnail( $category, $image_size ) {
		$image         = '';
		$attachment_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
		$width         = $height = 0;

		if ( ! function_exists( 'aq_resize' ) ) {
			$image_size = 'full';
		}

		if ( $image_size == 'full' ) {
			$image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
			if ( $image_src ) {
				$image = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( $image_src[0] ) . '" alt="' . esc_attr( $category->name ) . '"/>';

				$width  = $image_src[1];
				$height = $image_src[2];
			}
		} else {
			if ( function_exists( 'wc_get_image_size' ) ) {

				$image_dimension = wc_get_image_size( $image_size );

				$image_link = wp_get_attachment_image_src( $attachment_id, 'full' );
				if ( $image_link ) {
					if ( function_exists( 'aq_resize' ) ) {
						$img        = aq_resize( $image_link[0], $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], false, true );
					}
					if ( ! $img ) {
						$image  = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( $image_link[0] ) . '" alt="' . esc_attr( $category->name ) . '"/>';
						$width  = $image_link[1];
						$height = $image_link[2];
						if ( $image_link[0] == '' ) {
							$image = '';
						}
					} else {
						$image  = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( $img[0] ) . '" alt="' . esc_attr( $category->name ) . '"/>';
						$width  = $img[1];
						$height = $img[2];
					}
				}
			} else {

				$image_src = wp_get_attachment_image_src( $attachment_id, $image_size );

				if ( $image_src ) {
					$image  = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( $image_src[0] ) . '" alt="' . esc_attr( $category->name ) . '"/>';
					$width  = $image_src[0];
					$height = $image_src[1];
				}
			}
		}

		if ( $image == '' ) {
			$image  = '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( wc_placeholder_img_src() ) . '" alt="' . esc_attr( $category->name ) . '"/>';
			$width  = 100;
			$height = 100;

		}
		echo '<div class="lazy-load lazy-load-on-load" style="padding-top:' . esc_attr( kite_get_height_percentage( '', $width, $height ) ) . '%;">';
			echo '' . $image;// Sanitization performed in above lines!
		echo '</div>';

	}
}
// Product categories images
if ( ! function_exists( 'kite_woocommerce_subcategory_thumbnail_action' ) ) {
	function kite_woocommerce_subcategory_thumbnail_action() {
		remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
		add_action( 'woocommerce_before_subcategory_title', 'kite_woocommerce_subcategory_thumbnail', 10, 2 );
	}
}
kite_woocommerce_subcategory_thumbnail_action();


if ( ! function_exists( 'kite_woocommerce_ajax_wrapper_start' ) ) {
	function kite_woocommerce_ajax_wrapper_start() {

		$ajax_shop_pagination = kite_opt( 'ajax_shop_pagination', true ) ? '' : 'disable_pagination' ;
		echo '<div class="wc-ajax-wrapper">
				<span class="wc-loading hide"></span>
				<div class="wc-ajax-content ' . $ajax_shop_pagination . '">';
	}
}

if ( ! function_exists( 'kite_woocommerce_ajax_wrapper_end' ) ) {
	function kite_woocommerce_ajax_wrapper_end() {
		echo '</div></div>';
	}
}
// Add a wrapper around products for updating them with ajax
if ( ! function_exists( 'kite_woocommerce_ajax_wrapper_action' ) ) {
	function kite_woocommerce_ajax_wrapper_action() {
		add_action( 'woocommerce_before_shop_loop', 'kite_woocommerce_ajax_wrapper_start', 45 );
		add_action( 'woocommerce_after_shop_loop', 'kite_woocommerce_ajax_wrapper_end', 10 );
	}
}
kite_woocommerce_ajax_wrapper_action();




// Redeclare woocommerce function- Show a shop page description on product archives.
if ( ! function_exists( 'woocommerce_product_archive_description' ) ) {
	function woocommerce_product_archive_description() {
		// Don't display the description on search results page
		if ( is_search() || kite_is_shop_ajax_request() ) {
			return;
		}

		if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
			$shop_page = get_post( wc_get_page_id( 'shop' ) );
			if ( $shop_page ) {
				$description = wc_format_content( $shop_page->post_content );

				if ( $description ) {
					echo '<div class="page-description">' . $description . '</div>';
				}
			}
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                        WooCommerce Quick view button                       */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_add_quick_view_button' ) ) {
	function kite_add_quick_view_button() {

		$quick_view = kite_opt( 'shop-enable-quickview', false );

		if ( $quick_view == '1' && kite_woocommerce_installed() ) {
			global $product;

			echo '<span class="kt-qv"><a href="' . esc_url( '#' ) . '" class="quick-view-button" data-product_id="' . esc_attr( $product->get_id() ) . '"  title="' . esc_attr__( 'Show in quickview', 'teta-lite' ) . '">' . esc_attr__( 'Quick View', 'teta-lite' ) . '</a><span class="kt-tooltip"><span class="hint-txt">' . esc_attr__( 'Quick View', 'teta-lite' ) . '</span></span></span>';

		}
	}
}

if ( ! function_exists( 'kite_add_quick_view_button_action' ) ) {
	function kite_add_quick_view_button_action() {
		if ( ( $product_style = kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE ) ) != 'instantshop' && $product_style != 'modern-buttons-on-hover' ) {
			add_action( 'kite_woocommerce_shop_loop_buttons', 'kite_add_quick_view_button', 15 );
		} else {
			add_action( 'kite_woocommerce_shop_loop_hover_buttons', 'kite_add_quick_view_button', 15 );
		}
	}
}
// add_action( 'init', 'kite_add_quick_view_button_action' );

// Load modal template
if ( ! function_exists( 'kite_quikview_compare_modal' ) ) {
	function kite_quikview_compare_modal() {
		$quick_view = kite_opt( 'shop-enable-quickview', false );

		if ( $quick_view == '1' && kite_woocommerce_installed() ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}

		if ( function_exists( 'is_woocommerce' ) ) { // check woocomerce plugin is active or not
			wc_get_template( 'modal.php', array(), '', KITE_THEME_DIR . '/woocommerce/' );
		}
	}
}
add_action( 'wp_footer', 'kite_quikview_compare_modal' );


// Quick view Ajax
if ( ! function_exists( 'kite_load_quick_view' ) ) {
	function kite_load_quick_view() {

		global $woocommerce, $product, $post;

		$product = wc_get_product( sanitize_text_field( $_POST['product_id'] ) );
		$post    = $product->post;
		$output  = '';

		setup_postdata( $post );

		ob_start();
		wc_get_template( 'quick-view-content.php', array(), '', KITE_THEME_DIR . '/woocommerce/quickview/' );
		$output = ob_get_clean();

		wp_reset_postdata();

		echo '' . $output;

		exit;

	}
}
add_action( 'wp_ajax_load_quick_view', 'kite_load_quick_view' );
add_action( 'wp_ajax_nopriv_load_quick_view', 'kite_load_quick_view' );
add_action( 'wc_ajax_load_quick_view', 'kite_load_quick_view' );// Register WooCommerce Ajax endpoint (available since 2.4)


// title of quick view product
if ( ! function_exists( 'kite_title_quick_view' ) ) {
	function kite_title_quick_view() {
		global $product;
		echo '<a  href="' . esc_url( get_permalink( $product->id ) ) . '">';
		the_title( '<h1 class="product_title entry-title">', '</h1>' );
		echo '</a>';
	}
}
// gallery
if ( ! function_exists( 'kite_woocommerce_show_product_images' ) ) {
	function kite_woocommerce_show_product_images() {
		wc_get_template( 'single-product/product-image.php', array( 'is_quick_view' => true ) );
	}
}



// Summary
if ( ! function_exists( 'kite_quick_view_action' ) ) {
	function kite_quick_view_action() {

		add_action( 'quick_view_product_image', 'kite_woocommerce_show_product_images', 20 );
		add_action( 'quick_view_product_image', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'quick_view_product_image', 'kite_custom_label', 10 );
		add_action( 'quick_view_product_image', 'kite_product_summary_stock', 5);
		add_action( 'quick_view_product_summary', 'kite_title_quick_view', 5 );
		add_action( 'quick_view_product_summary', 'woocommerce_template_single_rating', 15 );
		add_action( 'quick_view_product_summary', 'woocommerce_template_single_price', 16 );
		add_action( 'quick_view_product_summary', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'quick_view_product_summary', 'add_deal_count_down_timer', 25 );
		add_action( 'quick_view_product_summary', 'kite_stock_progress_bar', 25 );
		add_action( 'quick_view_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		add_action( 'quick_view_product_summary', 'kite_yith_wishlist_compare', 1);

	}
}

kite_quick_view_action();
/* -------------------------------------------------------------------------- */
/*                          Woocommerce product video                         */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_woocommerce_product_video' ) ) {
	function kite_woocommerce_product_video() {

		global $product;
		$video_type = kite_get_meta( 'video_type' );
		$attributes = '';
		if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
			$product_detail_style = kite_get_meta( 'product_detail_style' ); // style of product detail in product page
		} else {
			$product_detail_style = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
		}
		$firstproductvideo = "";
		$endproductvideo = "";
		if ( ( $product_detail_style == 'pd_fullwidth_top' ) && (! wp_is_mobile() ) ) {
			$firstproductvideo = '<div class="container product-video">';
			$endproductvideo = "</div>";

		}
		$attributes = 'video_display_type="' . esc_attr( $video_type ) . '" ';

		if ( $video_type == 'none' || $video_type == '' ) {
			return;
		} elseif ( $video_type == 'local_video_popup' ) {
			$video_webm = kite_get_meta( 'video_webm' );
			$video_mp4  = kite_get_meta( 'video_mp4' );
			$video_ogv  = kite_get_meta( 'video_ogv' );

			if ( $video_webm == '' && $video_mp4 == '' && $video_ogv == '' ) {
				return;
			}

			$attributes .= 'video_webm="' . esc_attr( $video_webm ) . '" ';
			$attributes .= 'video_mp4="' . esc_attr( $video_mp4 ) . '" ';
			$attributes .= 'video_ogv="' . esc_attr( $video_ogv ) . '" ';
		} elseif ( $video_type == 'embeded_video_vimeo_popup' ) {
			$vimeo_id = kite_get_meta( 'video_vimeo_id' );
			if ( $vimeo_id == '' ) {
				return;
			}

			$attributes .= 'video_vimeo_id="' . esc_attr( $vimeo_id ) . '" ';
		} else {
			$youtube_id = kite_get_meta( 'video_youtube_id' );
			if ( $youtube_id == '' ) {
				return;
			}
			 $attributes .= 'video_youtube_id="' . esc_attr( $youtube_id ) . '" ';
		}

		$video_play_button_color = kite_get_meta( 'video_play_button_color' );
		$attributes             .= 'video_play_button_color="' . esc_attr( $video_play_button_color ) . '"';

		$video_button_label = kite_get_meta( 'video_button_label' );
		if ( ! empty( $video_button_label ) ) {
			$video_button_label = esc_attr( $video_button_label );
		} else {
			$video_button_label = '';
		}
		
		echo wp_kses( $firstproductvideo, $GLOBALS['kite-allowed-tags'] );
		echo do_shortcode( '[embed_video text="' . esc_attr( $video_button_label ) . '" video_autoplay="disable" ' . $attributes . ']' );
		echo wp_kses( $endproductvideo, $GLOBALS['kite-allowed-tags'] );
	}
}

if ( ! function_exists( 'kite_woocommerce_product_video_action' ) ) {
	function kite_woocommerce_product_video_action() {
		add_action( 'woocommerce_product_thumbnails', 'kite_woocommerce_product_video', 15 );
	}
}

kite_woocommerce_product_video_action();

/*-----------------------------------------------------------------*/
/* Woocommerce number of columns for shop page with sidebar
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_shop_with_sidebar_loop_columns' ) ) {
	function kite_shop_with_sidebar_loop_columns( $number_columns ) {
		$page_id = wc_get_page_id( 'shop' );
		// detect side bar position that set in admin panel
		if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
			if ( esc_html( $_GET['shopSidebar'] ) == 'left' ) {
				$sidebar = '1';
			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'right' ) {
				$sidebar = '2';

			} elseif ( esc_html( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
				$sidebar = '0';
			} else {
				$sidebar = kite_opt( 'shop-sidebar-position' , 0 );
			}
		} else {
			$sidebar = kite_opt( 'shop-sidebar-position' , 0 );
		}

		if ( 0 != $sidebar ) { // if shop page has sidebar
			return 3;
		}

		return $number_columns;
	}
}

if ( ! function_exists( 'kite_shop_loop_columns_action' ) ) {
	function kite_shop_loop_columns_action() {
		add_filter( 'loop_shop_columns', 'kite_shop_with_sidebar_loop_columns', 100, 1 );
		add_filter(
			'loop_shop_per_page',
			function( $cols ) {
				return ( kite_opt( 'shop-item-per-page', 12 ) != '' ? kite_opt( 'shop-item-per-page', 12 ) : 12 );
			},
			20
		);// Display X products per page.

	}
}
kite_shop_loop_columns_action();


if ( ! function_exists( 'kite_shop_page_wishlist_button' ) ) {
	function kite_shop_page_wishlist_button() {
		if ( class_exists( 'YITH_WCWL' ) ) {
			global $product;
			global $yith_wcwl;

			$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

			if ( ! empty( $default_wishlists ) ) {
				$default_wishlist = $default_wishlists[0]['ID'];
			} else {
				$default_wishlist = false;
			}

			// We put 2 buttons inside a tag to similify css codes
			$output  = '<span class="wishlist-btn">';
			$output .= '<a href="' . esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) ) . '" rel="nofollow" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product->get_type() ) . '" class="add_to_wishlist shop_wishlist_button ' . esc_attr( ( $yith_wcwl->is_product_in_wishlist( $product->get_id(), $default_wishlist ) == true ? 'exist_in_wishlist ' : '' ) ) . '" title="' . esc_attr__( 'Add to wishlist', 'teta-lite' ) . '"><span class="wc-loading hide"></span></a>';
			$output .= '<a href="' . esc_url( $yith_wcwl->get_wishlist_url() ) . '" rel="nofollow" class="wishlist-link shop_wishlist_button" style="' . esc_attr( ( $yith_wcwl->is_product_in_wishlist( $product->get_id(), $default_wishlist ) == true ? 'display:block; ' : '' ) ) . '" title="' . esc_attr__( 'Go to wishlist', 'teta-lite' ) . '"></a>';
			$output .= '<span class="kt-tooltip"><span class="hint-txt">' . esc_attr__( 'Add to Wishlist', 'teta-lite' ) . '</span></span>';
			$output .= '</span>';

			echo '' . $output;
		}
	}
}

if ( ! function_exists( 'kite_shop_page_wishlist_button_action' ) ) {
	function kite_shop_page_wishlist_button_action() {
		if ( kite_opt( 'shop-product-style', KITE_DEFAULT_PRODUCT_STYLE ) != 'modern-buttons-on-hover' ) {
			add_action( 'kite_woocommerce_shop_loop_buttons', 'kite_shop_page_wishlist_button', 11 );
		}
	}
}
// add_action( 'init', 'kite_shop_page_wishlist_button_action' );

/*
 *  Fetch  Add To cart fragments in Ajax request
 */
if ( ! function_exists( 'kite_ajax_add_to_cart_redirect_template' ) ) {
	function kite_ajax_add_to_cart_redirect_template() {
		if ( isset( $_REQUEST['kt-ajax-add-to-cart'] ) ) {
			wc_get_template( 'ajax-add-to-cart-fragments.php' );
			exit;
		}
	}
}
add_action( 'wp', 'kite_ajax_add_to_cart_redirect_template', 1000 );


/*-----------------------------------------------------------------*/
// Output of new attributes in woocommerce frontend
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_wc_text_variation_attribute_items' ) ) {
	function kite_wc_text_variation_attribute_items( $args = array() ) {
		$args                 = wp_parse_args(
			apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
			array(
				'options'          => false,
				'attribute'        => false,
				'product'          => false,
				'selected'         => false,
				'name'             => '',
				'id'               => '',
				'class'            => '',
				'show_option_none' => esc_html__( 'Choose an option', 'teta-lite' ),
			)
		);
		$options              = $args['options'];
		$product              = $args['product'];
		$attribute            = $args['attribute'];
		$name                 = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
		$id                   = $args['id'] ? $args['id'] : sanitize_title( $attribute );
		$class                = $args['class'];
		$available_variations = $product->get_available_variations();
		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[ $attribute ];
		}

		$attr_values = get_post_meta( absint( $product->get_id() ), esc_attr( $attribute ) . '_extravalue', true );
		if ( ! empty( $options ) ) {
			echo '<div class="attr-container select-attr" style="margin-bottom:-15px;">';
			if ( $product && taxonomy_exists( $attribute ) ) {
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					$data_var_id = '';
					foreach ( $available_variations as $variation ) {
						if ( $variation['attributes'][ 'attribute_' . $term->taxonomy ] == $term->slug ) {
							$data_var_id = "data-var_id='" . $variation['variation_id'] . "'";
						}
					}
					$varselect = selected( sanitize_title( $args['selected'] ), $term->slug, false ) ;
					$term_color    = get_term_meta( $term->term_id, 'term-color', true );
					$term_image_id = get_term_meta( $term->term_id, 'term-image-id', true );
					$defaultclass = '';
					$checked = '';
					if ($varselect ){
						$defaultclass = 'selected';
						$checked = 'checked';
					}
					if ( $term_image_id != '' && $term_image_id != 0 ) {
						$var   = "<span style='background-image:url(" . wp_get_attachment_url( $term_image_id ) . ");' class='variable_item select_item ". esc_attr( $defaultclass)."' data-value='" . esc_attr( $term->slug ) . "' " . $data_var_id . '></span>';
						$class = 'imagelabel';
					} elseif ( ! empty( $term_color ) ) {
						$var   = "<span style='background-color:" . $term_color . ";' class='variable_item select_item " . esc_attr( $defaultclass). "' data-value='" . esc_attr( $term->slug ) . "' " . $data_var_id . '></span>';
						$class = 'colorlabel';
					} else {
						$var   = "<span  id='' class='select_item variable_item " . esc_attr( $defaultclass). "' data-value='" . esc_attr( $term->slug ) . "' " . $data_var_id . '>' . $term->name . '</span>';
						$class = 'selectlabel';
					}
					if ( in_array( $term->slug, $options ) ) {
						echo '<label class="' . $class . '"><input type="radio"  value="' . $term->slug . '" name="' . $attribute . '" '. esc_attr( $checked). '/>' . $var . '</label>';
					}
				}
			} else {
				foreach( $options as $option ) {
					$data_var_id = '';
					foreach ( $available_variations as $variation ) {
						if ( in_array( $option, $variation['attributes'] ) ) {
							$data_var_id = "data-var_id='" . $variation['variation_id'] . "'";
						}
					}
					$var   = "<span  id='' class='select_item variable_item' data-value='" . esc_attr( $option ) . "' " . $data_var_id . '>' . $option . '</span>';
					$class = 'selectlabel';
					echo '<label class="' . $class . '"><input type="radio" value="' . $option . '" name="' . $attribute . '"/>' . $var . '</label>';
				}
			}
			echo '</div><br>';
		}

		// We keep select for using codes of add-to-cart-variation.js of woocommerce

		echo '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . ' hide-attr-select" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

		if ( $args['show_option_none'] ) {
			echo '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
		}

		if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
					}
				}
			} else {
				foreach ( $options as $option ) {
					// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
					$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
					echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
				}
			}
		}

		echo '</select>';
	}
}
add_action( 'woocommerce_product_query', 'kite_custom_query' );
if ( ! function_exists( 'kite_custom_query' ) ) {
	function kite_custom_query( $q ) {
		if ( ( isset( $_POST['ajax_shop_req'] ) && $_POST['ajax_shop_req'] == true ) ) {
			if ( ! empty ( $_GET['per-page'] ) ) {
				$q->set( 'posts_per_page', htmlspecialchars( $_GET['per-page'] ) );
			}
		}
	}
}
// Check if current request is an AJAX request for main-loop shop */
if ( ! function_exists( 'kite_is_shop_ajax_add_to_cart' ) ) {
	function kite_is_shop_ajax_add_to_cart() {

		if ( ( isset( $_GET['wc-ajax'] ) && $_GET['wc-ajax'] == 'add_to_cart' ) || ( isset( $_GET['kt-ajax-add-to-cart'] ) && $_GET['kt-ajax-add-to-cart'] == '1' ) ) {
			return true;
		}

		return false;
	}
}
/* -------------------------------------------------------------------------- */
/*                                Catalog Mode                                */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_catalog_mode_pages_redirect' ) ) {
	function kite_catalog_mode_pages_redirect() {
		$cart     = is_page( wc_get_page_id( 'cart' ) );
		$checkout = is_page( wc_get_page_id( 'checkout' ) );

		wp_reset_postdata();

		if ( $cart || $checkout ) {

			wp_redirect( esc_url( home_url( '/' ) ) );
			exit;
		}

	}
}

if ( ! function_exists( 'kite_catalog_mode' ) ) {
	function kite_catalog_mode() {
		$catalog_mode       = kite_opt( 'catalog_mode', false );
		$catalog_mode_price = kite_opt( 'catalog_mode_price', false );
		if ( $catalog_mode ) {

			// Remove add to cart button
			remove_action( 'kite_woocommerce_shop_loop_buttons', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'quick_view_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );

			// Disable any add to cart link(shortcodes, shop ...)
			add_filter( 'woocommerce_loop_add_to_cart_link', '__return_empty_string', 10 );

			// Disable add to cart functionality
			$priority = has_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ) );
			remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), $priority );

			// Redirect "cart" and "checkout" page
			add_action( 'wp', 'kite_catalog_mode_pages_redirect' );

			// hiden price in catalog mode
			if ( ! $catalog_mode_price ) {
				add_filter( 'woocommerce_variable_sale_price_html', 'kite_wc_remove_prices', 10, 2 );
				add_filter( 'woocommerce_variable_price_html', 'kite_wc_remove_prices', 10, 2 );
				add_filter( 'woocommerce_get_price_html', 'kite_wc_remove_prices', 10, 2 );

				function kite_wc_remove_prices( $price, $product ) {
					$price = '';
					return $price;
				}
				// Remove price from shop page, product details and quick view
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
				remove_action( 'quick_view_product_summary', 'woocommerce_template_single_price', 15 );
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			}
		}

	}
}

add_action( 'init', 'kite_catalog_mode' );
/*-----------------------------------------------------------------*/
// Enable/disable related products */
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_related_product' ) ) {
	function kite_related_product() {
		$related_product = kite_opt( 'related_product', true );
		if ( $related_product != 1 ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}
}
add_action( 'init', 'kite_related_product' );


// Change number of related products output
if ( ! function_exists( 'kite_related_products_limit' ) ) {
	add_action(
		'init',
		function() {
			$related_product_display = kite_opt( 'related_product_display', true ); // check related product on grid mode or carousel mode

			if ( $related_product_display == 0 ) {

				function kite_related_products_limit() {
					global $product;

					$args['posts_per_page'] = 6;
					return $args;
				}
				add_filter( 'woocommerce_output_related_products_args', 'kite_related_products_args' );

				function kite_related_products_args( $args ) {
					$args['posts_per_page'] = 6; // 4 related products
					$args['columns']        = 2; // arranged in 2 columns
					return $args;
				}
			}
		}
	);
}

/*-----------------------------------------------------------------*/
// Product gallery shows on products page
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_product_gallery' ) ) {
	function kite_product_gallery_popup() {
		$product_gallery_popup = kite_opt( 'product_gallery_popup', false );
		$product_gallery_style = kite_opt( 'product_gallery_style', false );

		if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
			$product_detail_style = kite_get_meta( 'product_detail_style' ); // style of product detail in product page
		} else {
            $product_detail_style = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
		}
		$firstgallerypopup = "";
		$endgallerypopup = "";
		
		if ( ( $product_detail_style == 'pd_fullwidth_top' ) && (! wp_is_mobile() ) ){
			$firstgallerypopup = '<div class="container gallery-popup">';
			$endgallerypopup = "</div>";

		}
		if ( $product_detail_style != 'pd_fixed_summary' ) {
			$style = '';
			if ( $product_gallery_style != 0 ) {
				$style = ' dark';
			}

			if ( $product_gallery_popup != 0 ) {
				echo wp_kses( $firstgallerypopup . '<a id="product_gallery_popup">' . '<div class="popup-button' . $style . '">' . '<span class="kt-icon icon-expand5" >' . '</span>' . '</div>' . '</a>' . $endgallerypopup, $GLOBALS['kite-allowed-tags'] ) ;
			}
		}
	}
}
add_action( 'woocommerce_product_thumbnails', 'kite_product_gallery_popup', 9 );


/*-----------------------------------------------------------------*/
// Custom fields of WC categories
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_wc_cat_taxonomy_add_meta_field' ) ) {
	function kite_wc_cat_taxonomy_add_meta_field() {
		?>
		<div class="form-field term-header-image-wrap">
			<label><?php esc_html_e( 'Header background image', 'teta-lite' ); ?></label>
			<div id="product_cat_background_image" data-default-img="<?php echo wc_placeholder_img_src(); ?>" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px"/></div>
			<div style="line-height: 60px;">
					<input type="hidden" id="header-background-image" name="header-background-image" value="" />
			<button type= type="button" class="upload_wc_cat_header_image_button button"><?php esc_html_e( 'Upload/Add image', 'teta-lite' ); ?></button>
			<button type="button" class="remove_wc_cat_header_image_button button"><?php esc_html_e( 'Remove image', 'teta-lite' ); ?></button>
		</div>
		</div>

		<div class="form-field term-header-icon-wrap">
			<?php
			$icons = maybe_unserialize( get_transient( 'kite_icon_names' ) );
			?>
			<div class="kt-icon-field field">
					<label for="field-cat_icon"><?php esc_html_e( 'Icon', 'teta-lite' ); ?></label>
				<div class="kt-icon-container">

					<div class="kt-icons" style="visibility: hidden;">
						<span class="close"></span>
					<?php foreach ( $icons as $icon ) { ?>
						<span class="kt-icon icon-<?php echo esc_attr( $icon ); ?>" data-name="<?php echo esc_attr( $icon ); ?>"></span>
					<?php } ?>
					</div>
					<span class="selected-icon icon" data-name="" title="<?php esc_attr_e( 'select an icon', 'teta-lite' ); ?>"></span>
					<span class="select-icon-text"><?php esc_html_e( 'Select an icon', 'teta-lite' ); ?></span>
					<input class="icon-filed" type="hidden" name="cat_icon" data-flags="" value="" />
				</div>
			</div>
		</div><br><br><br><br><br>
		<div class="form-field term-header-color-wrap">
			<label><?php esc_html_e( 'Header text color', 'teta-lite' ); ?></label>
			<div class="color-field-wrap clear-after">
				<input name="header-text-color" data-alpha="true" type="text" value="" class="colorinput"/>
				<div class="color-view"></div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'kite_wc_cat_taxonomy_edit_meta_field' ) ) {
	function kite_wc_cat_taxonomy_edit_meta_field( $term ) {

		$image             = '';
		$header_id         = absint( get_term_meta( $term->term_id, 'header-background-image', true ) );
		$header_text_color = get_term_meta( $term->term_id, 'header-text-color', true );
		$icons    = maybe_unserialize( get_transient( 'kite_icon_names' ) );
		$cat_icon = get_term_meta( $term->term_id, 'cat_icon', true );
		if ( $header_id ) :
			$image = wp_get_attachment_url( $header_id );
		else :
			$image = wc_placeholder_img_src();
		endif;

		?>
		
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Header background image', 'teta-lite' ); ?></label></th>
			<td>
				<div id="product_cat_background_image" data-default-img="<?php echo wc_placeholder_img_src(); ?>" style="float: left;margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px"/></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="header-background-image" name="header-background-image" value="<?php echo esc_attr( $header_id ); ?>" />
					<button type= type="button" class="upload_wc_cat_header_image_button button"><?php esc_html_e( 'Upload/Add image', 'teta-lite' ); ?></button>
					<button type="button" class="remove_wc_cat_header_image_button button"><?php esc_html_e( 'Remove image', 'teta-lite' ); ?></button>
				</div>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Header text color', 'teta-lite' ); ?></label></th>
			<td>
				<div class="field color-field clear-after">
					<div class="color-field-wrap clear-after">
						<input name="header-text-color" data-alpha="true" type="text" value="<?php echo esc_attr( $header_text_color ); ?>" class="colorinput"/>
						<div class="color-view"></div>
					</div>
				</div>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Category Icon', 'teta-lite' ); ?></label></th>
			<td>
				<div class="kt-icon-field field">
						<label for="field-cat_icon">Icon</label>
					<div class="kt-icon-container">

						<div class="kt-icons">
							<span class="close"></span>
						<?php foreach ( $icons as $icon ) { ?>
							<span class="kt-icon icon-<?php echo esc_attr( $icon ); ?>" data-name="<?php echo esc_attr( $icon ); ?>"></span>
						<?php } ?>
						</div>
						<span class="selected-icon icon<?php if ( ! empty( $cat_icon ) ) { echo '-' . $cat_icon;} ?> " data-name="<?php if ( ! empty( $cat_icon ) ) { echo esc_attr( $cat_icon );} ?>" title="<?php esc_attr_e( 'select an icon', 'teta-lite' ); ?>"></span>
						<span class="select-icon-text 
						<?php
						if ( $cat_icon != '' ) {
						echo 'show'; }?>
						"><?php esc_html_e( 'Select an icon', 'teta-lite' ); ?></span>
						<input class="icon-filed" type="hidden" name="cat_icon" data-flags="" value="
						<?php
						if ( ! empty( $cat_icon ) ) {
							echo esc_attr( $cat_icon );}
						?>
						" />
					</div>
				</div>
			</td>
		</tr>
		<?php
	}
}

if ( ! function_exists( 'kite_save_wc_cat_taxonomy_custom_meta' ) ) {
	function kite_save_wc_cat_taxonomy_custom_meta( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['header-background-image'] ) ) {
			update_term_meta( $term_id, 'header-background-image', absint( sanitize_text_field( $_POST['header-background-image'] ) ) );
			update_term_meta( $term_id, 'header-text-color', sanitize_text_field( $_POST['header-text-color'] ) );
			update_term_meta( $term_id, 'cat_icon', sanitize_text_field( $_POST['cat_icon'] ) );
		}

		delete_transient( 'wc_term_counts' );
	}
}

if ( ! function_exists( 'kite_wc_category_custom_field_action' ) ) {
	function kite_wc_category_custom_field_action() {
		add_action( 'product_cat_edit_form_fields', 'kite_wc_cat_taxonomy_edit_meta_field', 15 );
		add_action( 'product_cat_add_form_fields', 'kite_wc_cat_taxonomy_add_meta_field', 15 );
		add_action( 'edited_product_cat', 'kite_save_wc_cat_taxonomy_custom_meta', 10, 3 );
		add_action( 'create_product_cat', 'kite_save_wc_cat_taxonomy_custom_meta', 10, 3 );
	}
}
kite_wc_category_custom_field_action();
/*-----------------------------------------------------------------*/
// Avatar in my account page
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_myaccount_customer_avatar' ) ) {
	function kite_myaccount_customer_avatar() {
		$current_user = wp_get_current_user();
		if ( $current_user instanceof WP_User ) {
			echo '<div class="myaccount_avatar">' . get_avatar( $current_user->user_email, 50 ) . '<h6>' . $current_user->display_name . '</h6></div>';
		}
	}
}
add_action( 'kite_woocommerce_before_account_navigation', 'kite_myaccount_customer_avatar' );


/*-----------------------------------------------------------------*/
// Login/rgister popup
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_load_account_page' ) ) {
	function kite_load_account_page() {
		if ( ( ! is_user_logged_in() ) && ( kite_woocommerce_installed() ) ) {
			?>
			<div id="customer_login" class="hide-login 
			<?php
			if ( get_option( 'woocommerce_enable_myaccount_registration' ) != 'yes' ) {
				echo 'no-registration'; }?>
			">
			<div class="customer-login">
				<h2><?php esc_html_e( 'Login', 'teta-lite' ); ?></h2>
				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="username"><?php esc_html_e( 'Username or email address', 'teta-lite' ); ?> <span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php esc_attr_e( 'Username or email address', 'teta-lite' ); ?>" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="password"><?php esc_html_e( 'Password', 'teta-lite' ); ?> <span class="required">*</span></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php esc_attr_e( 'Password', 'teta-lite' ); ?>" type="password" name="password" id="password" />
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'teta-lite' ); ?></span>
						</label>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'teta-lite' ); ?>" />
						
						
						<span class="woocommerce-LostPassword lost_password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'teta-lite' ); ?></a>
						</span>
						<br>
					</p>
					

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>
			</div>
			<?php
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$myaccount_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					echo '<p class="kite-register"><span>' . esc_html__('Have not an account yet?','teta-lite') . '</span> <a class="register-link" href="' . $myaccount_url . '">' . esc_html__( 'Sign up', 'teta-lite' ) . '</a></p>';
				}
				?>
			</div>
			<?php
		}
	}
}
add_action( 'wp_footer', 'kite_load_account_page' );

/*-----------------------------------------------------------------*/
// Woocommerce loop - add-to-cart buttons
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_woocommerce_loop_add_to_cart_link_action' ) ) {
	function kite_woocommerce_loop_add_to_cart_link_action() {
		add_filter( 'woocommerce_loop_add_to_cart_link', 'kite_woocommerce_loop_add_to_cart_link', 100, 2 );
		add_filter( 'kite_loop_instant_shop_add_to_cart_link', 'kite_loop_instant_shop_add_to_cart_link', 10, 1 );
		add_filter( 'kite_loop_modern_add_to_cart_link', 'kite_loop_modern_add_to_cart_link', 10, 1 );
	}
}
kite_woocommerce_loop_add_to_cart_link_action();


/* Add a wrapper around add-to-cart link */
if ( ! function_exists( 'kite_woocommerce_loop_add_to_cart_link' ) ) {
	function kite_woocommerce_loop_add_to_cart_link( $link, $product ) {

		// Add some class for compatibility with 3rd-party plugins such as wooZone
		$class = sprintf(
			'class="button %s product_type_%s %s"',
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			esc_attr( $product->get_type() ),
			esc_attr( $product->get_type() == 'simple' && 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' )
		);

		$link = str_replace( 'class="button"', $class, $link );
		$link = str_replace( 'class="ajax_add_to_cart button"', $class, $link );

		return '<span class="product-button product_type_' . $product->get_type() . '">' . $link . '</span>';
	}
}


/* Change structure of add-to-cart button in instant-shop product style */
if ( ! function_exists( 'kite_loop_instant_shop_add_to_cart_link' ) ) {
	function kite_loop_instant_shop_add_to_cart_link( $link ) {
		$newLink = str_replace( '<span class="icon"></span>', '', $link );

		// change classes of A tag
		$newLink = str_replace( '<span class="product-button product_type_', '<span class="product_type_', $newLink );

		// change classes of wrapper of A tag
		$newLink = str_replace( 'class="button ', 'class="', $newLink );

		return $newLink;
	}
}


/* Change structure of add-to-cart button in product2 shortcode */
if ( ! function_exists( 'kite_loop_modern_add_to_cart_link' ) ) {
	function kite_loop_modern_add_to_cart_link( $link ) {

		$pattern = '#<span class="txt"(.*?)</span>#';

		preg_match( $pattern, $link, $result );

		$text_span = $text = '';

		if ( $result[0] ) {
			$text_span = $result[0];

			// Find the text
			$pattern = '#class="txt" data-hover="(.*?)">#';
			preg_match( $pattern, $text_span, $result );
			if ( $result[1] ) {
				$text = $result[1];

				$link = str_replace(
					$text_span,
					'<span class="firts_text txt hidden-v-tablet hidden-phone">' . $text . '</span>
                                                <span class="secound_txt txt hidden-v-tablet hidden-phone">' . $text . '</span>',
					$link
				);
			}

			return $link;

		} else {
			return $link;
		}
	}
}
if ( ! function_exists( 'kite_social_share_action' ) ) {
	function kite_social_share_action() {

		// call social Share in product detail - Quick View
		add_action( 'quick_view_product_summary', 'kite_social_share', 32 );
		// social Share in product detail
		if ( ! kite_opt( 'single_product_meta', true ) ) {
			add_action( 'woocommerce_single_product_summary', 'kite_social_share', 36 );  // 35 belong compare actions
		} else {
			add_action( 'woocommerce_single_product_summary', 'kite_social_share', 50 );  // 35 belong compare actions
		}
	}
}

if ( class_exists( 'Kite_Core' ) ) {
	add_action( 'init', 'kite_social_share_action' );
}

/*-----------------------------------------------------------------*/
// Show Count Down Timer for Deal Products in Single Page Content
/*-----------------------------------------------------------------*/

add_action( 'woocommerce_single_product_summary', 'add_deal_count_down_timer', 20 );
if ( ! function_exists( 'add_deal_count_down_timer' ) ) {
	function add_deal_count_down_timer( $flag ) {
		if ( ! function_exists( 'kite_sc_countdown' ) ) {
			return;
		}
		global $post;
		$today         = time();
		$deal_end_date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
		$deal_start_date = get_post_meta( get_the_ID(), '_sale_price_dates_from', true );
		if ( !empty( $deal_start_date ) && $deal_start_date > $today ) {
			return;
		}
		
		if ( ! empty( $deal_end_date ) && $deal_end_date > $today && ( $flag == 1 || empty( $flag ) ) ) {
			$deal_end_date = date( 'Y-m-d', $deal_end_date );
			echo '<div class="single_deal_count_down_timer">';
			echo kite_sc_countdown(
				array(
					'end_date'             => $deal_end_date,
					'fontsize'             => '28',
					'color'                => '#000000',
					'label_color'          => '#000000',
					'alignment'            => 'center',
				)
			);
			echo '</div>';
		}
		if ( ! empty( $deal_end_date ) && $deal_end_date > $today && $flag == 2 ) {
			return 'count_down';
		}
	}
}

/*-----------------------------------------------------------------*/
// product progress bar
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_stock_progress_bar_variation_action' ) ) {
	function kite_stock_progress_bar_variation_action() {
		global $product;
		if ( $product->is_type( 'variable' ) ) {
			add_action( 'woocommerce_single_product_summary', 'kite_stock_progress_bar' );
		} else {
			add_action( 'woocommerce_single_product_summary', 'kite_stock_progress_bar' , 20);
		}
	}
}
add_action( 'woocommerce_single_product_summary', 'kite_stock_progress_bar_variation_action' );

if ( ! function_exists( 'kite_stock_progress_bar' ) ) {
	function kite_stock_progress_bar( $flag ) {
		global $woocommerce, $product, $post;
		$product_id    = get_the_ID();
		$current_stock = 0;
		if ( $product->is_type( 'variable' ) ) {
			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $key => $variation ) {
				$variation_id  = $variation['variation_id'];
				$variation_obj = new WC_Product_variation( $variation_id );
				$stock         = $variation_obj->get_stock_quantity();
				$current_stock = $current_stock + $stock;
			}
		} else {
			$current_stock = get_post_meta( $product_id, '_stock', true );
		}
		$total_stock = get_post_meta( $product_id, 'kt_total_stock_quantity', true );

		if ( ! $total_stock ) {
			return;
		}

		$total_sold = $total_stock > $current_stock ? $total_stock - $current_stock : 0;
		$percentage = $total_sold > 0 ? round( $total_sold / $total_stock * 100 ) : 0;

		if ( $current_stock > 0 && ( $flag == 1 || empty( $flag ) ) ) {

				echo '<div class="progress-bar">';
					echo '<div class="progress-fill" style="width:' . esc_attr( $percentage ) . '%;">';
						echo '<div class="progress-fill-text">' . esc_html__( 'SOLD: ' , 'teta-lite') . $total_sold . '/' . $total_stock  . '</div>';
					echo '</div>';
					echo esc_html__( 'SOLD: ', 'teta-lite' ). $total_sold . '/' . $total_stock;
				echo '</div>';
		}
		if ( $current_stock > 0 && $flag == 2 ) {
			return 'Product_availability';
		}
	}
}

if ( ! function_exists( 'kite_total_stock_quantity_input' ) ) {
	function kite_total_stock_quantity_input() { // phpcs:ignore
		echo '<div class="options_group">';
			woocommerce_wp_text_input(
				array(
					'id'            => 'kt_total_stock_quantity',
					'label'         => esc_html__( 'Initial number in stock', 'teta-lite' ),
					'wrapper_class' => 'Initial_stock',
					'desc_tip'      => 'true',
					'description'   => esc_html__( 'Required for stock progress bar option', 'teta-lite' ),
					'type'          => 'number',
				)
			);
		echo '</div>';
	}
		add_action( 'woocommerce_product_options_inventory_product_data', 'kite_total_stock_quantity_input' );
}


if ( ! function_exists( 'kite_save_total_stock_quantity' ) ) {
	function kite_save_total_stock_quantity( $post_id ) { // phpcs:ignore

		$total_stock = isset( $_POST['kt_total_stock_quantity'] ) ? wc_clean( $_POST['kt_total_stock_quantity'] ) : ''; // phpcs:ignore
		$product     = wc_get_product( $post_id );
		$product->update_meta_data( 'kt_total_stock_quantity', $total_stock );
		$product->save();
	}

	add_action( 'woocommerce_process_product_meta', 'kite_save_total_stock_quantity' );
}

/* -------------------------------------------------------------------------- */
/*                           Search Products by sku                           */
/* -------------------------------------------------------------------------- */

function kite_get_products_by_sku() {
	global $getProductsBySku;
	$getProductsBySku = array();

	if ( ! isset( $_GET['s'] ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'kite_ajax_search_action' ) ) {
		return;
	}
	$s = trim( sanitize_text_field( $_GET['s'] ) );

	if ( ! isset( $_GET['cat'] ) ) {
		$cat = '';
	} else {
		$cat = trim( sanitize_text_field( $_GET['cat'] ) );
	}
	$args_sku         = array(
		'post_type'        => 'product',
		'posts_per_page'   => 20,
		'product_cat'      => $cat,
		'meta_query'       => array(
			array(
				'key'     => '_sku',
				'value'   => $s,
				'compare' => 'like',
			),
		),
		'suppress_filters' => false,
	);
	$getProductsBySku = get_posts( $args_sku );

}
// add_action( 'init', 'kite_get_products_by_sku' );

// merge search by sku result with search result and filtering same results
// add_filter( 'the_posts', 'kite_generate_search_posts' );
function kite_generate_search_posts( $posts, $query = false ) {

	if ( ! isset( $_GET['s'] ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'kite_ajax_search_action' ) ) {
		return $posts;
	}
	global $getProductsBySku;

	if ( ! isset( $getProductsBySku ) ) {
		$getProductsBySku = array();
	}

	$allSearchResults = array_merge( $getProductsBySku, $posts );
	$productsID       = array();
	foreach ( $allSearchResults as $key => $product ) {
		$id = $product->ID;
		if ( in_array( $id, $productsID ) ) {
			unset( $allSearchResults[ $key ] );
		} else {
			$productsID[] = $id;
		}
	}
	return $allSearchResults;
}
/*-----------------------------------------------------------------*/
// Category Description Position
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_wc_category_description_position' ) ) {
	function kite_wc_category_description_position() {

		$allowed_html = [
			'a'      => [
				'href'  => [],
				'title' => [],
			],
			'br'     => [],
			'h1'     => [],
			'p'     => [],
			'em'     => [],
			'strong' => [],
		]; 
		
		$subTitle = term_description();

		if ( kite_opt( 'category-description-position', true ) == '0' ) {
			kite_wc_category_description_position_action();
		} else {
			?>
			<span class="subtitle <?php if ( kite_opt( 'responsive-category-header', false ) ) echo esc_attr('kt-show'); ?>"><?php echo wp_kses( $subTitle, $allowed_html ); ?></span>
			<?php
		}

	}
}

if ( ! function_exists( 'kite_wc_category_description_position_action' ) ) {
	function kite_wc_category_description_position_action() {
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
		add_action(
			'woocommerce_before_shop_loop',
			function () {
				echo '<div class="kt-category-after-header">';
			},
			10
		);
		add_action( 'woocommerce_before_shop_loop', 'woocommerce_taxonomy_archive_description', 10 );
		add_action( 'woocommerce_before_shop_loop', 'woocommerce_taxonomy_archive_description', 10 );
		add_action(
			'woocommerce_before_shop_loop',
			function () {
				echo '</div>';
			},
			10
		);
	}
}

/*-----------------------------------------------------------------*/
// Show Product Variations
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'show_product_variations' ) ) {
	function show_product_variations( $show_all_variations = true, $image_size = 'woocommerce_thumbnail' ) {
		global $product;
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
		$product_id  = $product->get_id();
		$product_sku = $product->get_sku();
		if ( $product->is_type( 'variable' ) ) {
			$available_variations = $product->get_available_variations();
			$product_variation    = new WC_Product_Variable( $product_id );
			$attributes           = $product_variation->get_variation_attributes();
			if ( ! ( sizeof( $attributes ) > 1 ) ) {
				 $taxonomy_types        = array();
				  $attribute_taxonomies = wc_get_attribute_taxonomies();
				if ( $attribute_taxonomies ) {
					foreach ( $attribute_taxonomies as $tax ) {
						$taxonomy_types[ wc_attribute_taxonomy_name( $tax->attribute_name ) ] = $tax->attribute_type;
					}
				}
				$proccessed_variation = 0;
				foreach ( $attributes as $attribute => $value ) {

					if ( ! taxonomy_exists( $attribute ) ) {
						continue;
					}

					$variation_regular_price   = array();
					$variation_sale_price      = array();
					$variation_image           = array();
					$variation_srcset          = array();
					$data_variation_id         = array();
					$variation_sku             = array();
					$variation_add_to_cart_url = array();
					for ( $i = 0; $i < count( $available_variations ); $i++ ) {
						$variation_id  = $available_variations[ $i ]['variation_id'];
						$variation_prd = new WC_Product_Variation( $variation_id );
						if ( ! $variation_prd->is_in_stock() || ! $variation_prd->is_purchasable() ) {
							continue;
						}
						if ( ! empty( $variation_prd->get_regular_price() ) ) {
							$variation_regular_price[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $variation_prd ) : wc_get_price_excluding_tax( $variation_prd );
						}
						if ( ! empty( $variation_prd->get_sale_price() && empty( $tax_display_mode ) ) ) {
							$variation_sale_price[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ] = $variation_prd->get_sale_price();
						}
						$data_variation_id[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ]         = $variation_id;
						
						if ( $image_size == 'full' ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
						} else {
							if ( function_exists( 'wc_get_image_size' ) ) {
		
								$image_dimension = wc_get_image_size( $image_size );
		
								$image_link       = wp_get_attachment_url( $available_variations[ $i ]['image_id'] );
								if ( function_exists( 'aq_resize' ) ) {
									$image_attributes = aq_resize( $image_link, $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], false, true );
								}
								$image_url = isset( $image_attributes[0] ) ? $image_attributes[0] : $image_link;
		
							} else {
		
								$image_url = wp_get_attachment_image_src( $available_variations[ $i ]['image_id'], 'woocommerce_thumbnail' )[0];
		
							}
						}
						$variation_image[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ]           = $image_url;
						$variation_srcset[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ]          = ''; // wp_get_attachment_image_srcset( $available_variations[ $i ]['image_id'], 'woocommerce_thumbnail', null );
						$variation_add_to_cart_url[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ] = $variation_prd->add_to_cart_url();
						$variation_sku[ $available_variations[ $i ]['attributes'][ 'attribute_' . $attribute ] ]             = $variation_prd->get_sku();
						$sale_price = '';
					}
					if ( empty( $data_variation_id ) ) {
						return;
					}

					echo "<div class='hover-info'>";
						$terms = wp_get_post_terms( $product_id, $attribute );
						echo '<div class="productvariations select">';
						$term_names = array();
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
							foreach ( $terms as $term ) {
								// show only 3 variations
								if ( ! $show_all_variations ) {
									if ( $proccessed_variation >= 3 ) {
										break;
									}
								}

								$term_color    = get_term_meta( $term->term_id, 'term-color', true );
								$term_image_id = get_term_meta( $term->term_id, 'term-image-id', true );
								if ( function_exists( 'aq_resize' ) ) {
									$image_url = aq_resize( wp_get_attachment_thumb_url( $term_image_id ), 25, 25, true, true, true );
								} else {
									$image_url = wp_get_attachment_thumb_url( $term_image_id, 'thumbnail' );
								}
								if ( $term_image_id != '' && $term_image_id != 0 ) {
									$style = 'background-image:url(' . $image_url . ');';
									$class = 'imagelabel';
									$name  = '';
								} elseif ( $term_color != '' ) {
									$style = 'background-color:' . $term_color . ';';
									$class = 'colorlabel';
									$name  = '';
								} else {
									$style = '';
									$class = 'selectlabel';
									$name  = $term->name;
								}
								if ( in_array( $term->slug, $value ) ) {
									if ( ! isset( $data_variation_id[ $term->slug ] ) ) {
										continue;
									}
		
									if ( ! empty( $variation_sale_price[ $term->slug ] ) ) {
										$sale_price = $variation_sale_price[ $term->slug ];
									} else {
										$sale_price = '';
									}
									echo '<label class="' . $class . '">
										<input type="radio" value="' . $term->slug . '" name="' . esc_attr( get_the_title() ) . '"/>
										<a class="product_variation_item info select_item" style="' . $style . '"
										data-value="' . $term->slug . '" 
										data-image="' . $variation_image[ $term->slug ] . '" 
										data-srcset="' . $variation_srcset[ $term->slug ] . '" 
										data-product_id="' . $data_variation_id[ $term->slug ] . '" 
										data-quantity="1" 
										data-product_sku="' . $variation_sku[ $term->slug ] . '" 
										data-cart-url="' . $variation_add_to_cart_url[ $term->slug ] . '" 
										data-regular-price ="' . $variation_regular_price[ $term->slug ] . '"
										data-sale-price ="' . $sale_price . '"
										data-txt="' . esc_attr__( 'Add To Cart', 'teta-lite' ) . '">' . $name . '</a></label>';
									
									$proccessed_variation += 1;
		
								}
							}
						}
						
						// show only 3 variations
						if ( ! $show_all_variations ) {
							if ( $proccessed_variation < count( $available_variations ) ) {
								echo "<span>+" . ( count( $available_variations ) - $proccessed_variation ) . "</span>";
							}
						}
						echo '</div></div>';

				}
			}
		}
	}
}

/*-----------------------------------------------------------------*/
// Sku in ProductDetail Page
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_summary_add_sku' ) ) {
	function kite_summary_add_sku() {
		if ( kite_opt( 'single_product_meta', true ) ) {
			return;
		}
		global $product;
		$sku = $product->get_sku();
		if ( $sku != '' ) {
			echo "<div class='sku_container'><span class='product_sku'>" . esc_html__( 'SKU: ', 'teta-lite' ) . $sku . '</span></div>';
		}
	}
}
add_action( 'woocommerce_after_add_to_cart_button', 'kite_summary_add_sku', 20 );
/*-----------------------------------------------------------------*/
// Add Wishlist Button
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'yith_add_loop_wishlist' ) ) {
	function yith_add_loop_wishlist() {
		if ( class_exists( 'YITH_WCWL' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}
}
/*-----------------------------------------------------------------*/
// Custom label
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_custom_label' ) ) {
	function kite_custom_label() {
		$custom_product_label = get_post_meta( get_the_ID(), 'custom_product_label', true );
		$lable_bg             = get_post_meta( get_the_ID(), 'product_lable_bg', true );

		if ( ! empty( $custom_product_label ) ) { ?>
		<span class="custom_product_label" 
			<?php
			if ( $lable_bg ) {
			?>
			 style = "background-color: <?php echo esc_attr( $lable_bg ); ?>;" <?php } ?>><?php echo esc_html( $custom_product_label ); ?></span>
		
			<?php
		}
	}
}
add_action( 'woocommerce_single_product_summary', 'kite_custom_label', 5 );

/*-----------------------------------------------------------------*/
// percentage Sale
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_percentage_sale' ) ) {
	function kite_percentage_sale() {
		$percentage_sale = kite_opt( 'percentage_sale', true );
		if ( $percentage_sale ) {
			add_filter( 'woocommerce_sale_flash', 'kite_percentage_sale_filter' );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'woocommerce_single_product_summary', 'kite_percentage_sale_filter' , 6);		
		}
		else{
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash' , 6);		
		}
		
	}
}

add_action( 'init', 'kite_percentage_sale' );

if ( ! function_exists( 'kite_percentage_sale_filter' ) ) {

	function kite_percentage_sale_filter() {
		global $post, $product;
		$percentage_sale = kite_opt( 'percentage_sale', true );
		if ( ! $product->is_on_sale() ) {
			return;
		}
			$maximumper = 0;

			if ( $product->is_type( 'variable' ) ) {
				$maximumper           = 0;
				$available_variations = $product->get_available_variations();

				for ( $i = 0; $i < count( $available_variations ); ++$i ) {
					$variation_id  = $available_variations[ $i ]['variation_id'];
					$variation     = new WC_Product_Variation( $variation_id );
					$regular_price = $variation->get_regular_price();
					$sale_price    = $variation->get_sale_price();

					if ( $regular_price == 0 || $regular_price == $sale_price || $sale_price == null ) {
						continue;
					}

					$savings = ceil( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
					if ( $savings > $maximumper ) {
						$maximumper = $savings;
					}
				}
			} elseif ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
				$sale_price    = $product->get_sale_price();
				$regular_price = $product->get_regular_price();

				if ( $regular_price == 0 ) {
					return;
				}

				$savings    = ceil( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
				$maximumper = $savings;
			} elseif ( $product->is_type( 'grouped' ) ) {
				$product_id = $product->get_id();
				$childs_id  = $product->get_children();
				$maximumper = 0;
				for ( $i = 0; $i < count( $childs_id ); ++$i ) {
					$product_child_id = $childs_id[ $i ];
					$simple           = wc_get_product( $product_child_id );

					if ( $product->is_type( 'simple' ) ) {
						$regular_price = $product->get_regular_price();
						$sale_price    = $product->get_sale_price();
						$savings       = ceil( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

						if ( $regular_price == 0 ) {
							continue;
						}

						if ( $savings > $maximumper ) {
							$maximumper = $savings;
						}
					}
				}
			}

		if ( $maximumper == 0 ) {
			return;
		}
		
		echo  wp_kses( '<span class="onsale percentage-sale">' . '-' . $maximumper . '%' . '</span>', $GLOBALS['kite-allowed-tags'] );

	}
}

/*-----------------------------------------------------------------*/
// Shop Header Display
/*-----------------------------------------------------------------*/
function kite_shop_header_display( $wp_customize ) {
	$wp_customize->add_setting(
		KITE_THEME_SLUG . '_shop_header_display',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'cat_icon',
			'transport'         => 'refresh',
			'type'              => 'option',
			'sanitize_callback' => function( $input, $setting ) {
				$input   = sanitize_key( $input );
				$choices = $setting->manager->get_control( $setting->id )->choices;
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
			},
		)
	);
	$wp_customize->add_control(
		KITE_THEME_SLUG . '_shop_header_display',
		array(
			'label'       => esc_html__( 'Shop and Category page  header display', 'teta-lite' ),
			'description' => esc_html__( 'Choose which categories style to display on the shop and product category page header.', 'teta-lite' ),
			'section'     => 'woocommerce_product_catalog',
			'settings'    => KITE_THEME_SLUG . '_shop_header_display',
			'type'        => 'select',
			'choices'     => array(
				'cat_sub'   => esc_html__( 'Extended categories', 'teta-lite' ),
				'cat_icon'  => esc_html__( 'Categories by icon', 'teta-lite' ),
				'cat_image' => esc_html__( 'Categories by image', 'teta-lite' ),
			),
		)
	);
}
add_action( 'customize_register', 'kite_shop_header_display' );

//
// ─── ADD QUANTITY INPUT IN WOOCOMMERCE QUANTITY TEMPLATE ────────────────────────
//
add_action( 'woocommerce_after_quantity_input_field', 'kite_add_quantity_field' );
function kite_add_quantity_field() {
	echo '<div class="plus quantity-button"></div>';
	echo '<div class="minus quantity-button"></div>';
}


//
// ─── ADD_TO_CART_BUTTON ATTRIBUTES ──────────────────────────────────────────
//
add_filter( 'kite_loop_add_to_cart_button_attributes', 'kite_add_attribute_to_cart_button', 1, 3);
function kite_add_attribute_to_cart_button( $data_attribute, $product, $ajax_add_to_cart ) {
	// $min_quantity and $max_quantity sets from woo-min-max-quantities plugin
	return $data_attribute = array(
		'data-min-quantity' 	  => kite_get_min_product_quantity(),  
		'data-product_id'         => $product->get_id(), 
		'data-product_sku'        => $product->get_sku(),  
		'data-quantity'           => kite_get_min_product_quantity(), 
		'class'                   => 'addcartbutton ' . ( $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '' ) . ' product_type_' . $product->get_type() . ( $product->get_type() == 'simple' && 'yes' === $ajax_add_to_cart ? ' ajax_add_to_cart' : '' ) . ( 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ? ' ajax_enabled' : '' )
	);
}

//
// ─── GET MINIMUM WOOCOMMERCE QUANTITY ───────────────────────────────────────────
//

function kite_get_min_product_quantity( $product = '') {
	if ( empty( $product ) ) {
		global $product;
	}
	$quantity = get_post_meta( $product->get_id(), 'minimum_allowed_quantity' , true );
	return $quantity ? $quantity : 1 ;
}

//
// ─── ADD SPACER TO TABS SECTION ─────────────────────────────────────────────────
//

function kite_add_spacer_to_tabs_section() {
	echo "<div class='kt-spacer'></div>";
}
add_action( 'woocommerce_product_after_tabs', 'kite_add_spacer_to_tabs_section', 99 );

// check if shop page comes from products page or not when pagination is infinite scroll or load more 
add_filter( 'get_pagenum_link', 'kite_add_infinite_scroll_arg', 1 );
function kite_add_infinite_scroll_arg( $result ) {
	return ( ( is_shop() || is_product_category() || is_product_tag() ) && kite_opt( 'products-pagination', 'pagination') != 'pagination' ) ? add_query_arg( array( 'sp' => false ), $result ) : $result;
} 

// check if shop page comes from products page load seen products before current page 
add_action( 'kite_products_loop_start', 'kite_show_seen_products' );
function kite_show_seen_products() {
	global $paged, $wp_query;
	if ( ! $paged || $paged == 1 ) {
		return;
	}
	
	if ( ( is_shop() || is_product_category() || is_product_tag() ) && kite_opt( 'products-pagination', 'pagination') != 'pagination' && ! empty( $_GET['sp'] ) && $_GET['sp'] == 'infinite_scroll' ) {
		$per_page = kite_opt( 'shop-item-per-page', 12 );

		$per_page = ( $paged - 1 ) * $per_page;

		$args = $wp_query->query_vars;	
		$seen_products = [];	
		for ( $i = 1; $i < $paged; $i++ ) { 
			$args['paged'] = $i;	
			$products = new WP_Query( $args );
			$seen_products = array_merge( $seen_products, $products->posts );
		}
		$wp_query->posts = array_merge( $seen_products, $wp_query->posts );
		$wp_query->posts_per_page = count( $wp_query->posts );
		$wp_query->post_count = count( $wp_query->posts );
	} 
}


//
// ─── WOOCOMMERCE PAGINATION ─────────────────────────────────────────────────────
//

add_filter( 'woocommerce_pagination_args', 'kite_woocommerce_pagination', 1 , 99 );
function kite_woocommerce_pagination( $args ) {
	$args['prev_text'] = ( is_rtl() ? '&rarr; ' : '&larr; ' ) . esc_html__( 'Prev.', 'teta-lite' );
	$args['next_text'] = esc_html__( 'Next', 'teta-lite' ) . ( is_rtl() ? ' &larr;' : ' &rarr;' );
	if ( wp_is_mobile() ) {
		$args['end_size'] = 1;
		$args['mid_size'] = 1;
	}
	return $args;
}

//
// ─── CHANGE COUPON FORM POSITION ────────────────────────────────────────────────
//
add_action( 'init', 'kite_change_coupon_form_position' );
function kite_change_coupon_form_position() {
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	add_action( 'woocommerce_checkout_before_order_review', 'woocommerce_checkout_coupon_form' );
}

//
// ─── CHECK IF SHIPPING CALCULATRO IS ENABLED OR NOT ─────────────────────────────
//

add_filter( 'woocommerce_shipping_show_shipping_calculator', 'kite_is_shipping_calculator_enabled', 1, 1 );
function kite_is_shipping_calculator_enabled( $first ) {
	if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
		return false;
	}
	return $first;
}

//
// ─── MOVE CROSS SELLS TO BOTTOM OF PAGE IN CART ─────────────────────────────────
//

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

/**
 * append dokan vendors list to ajax search results
 *
 * @param $results
 *
 * @return mixed
 */
function kite_append_dokan_vendors_list_to_ajax_search( $output, $search_results ) {

    if ( !kite_opt( 'trident_search_enabled_vendors', false ) || !function_exists( 'dokan' ) ) {
        return $output;
    }

	$output[] = "<h6>" . esc_html__( 'Vendors', 'teta-lite' ) . "</h6>";
	$authors = [];

	foreach ( $search_results as $result ) {
		if ( !in_array( $result->post_author, $authors ) ) {
			$authors[] = $result->post_author;
		}
	}

	if ( !empty( $authors ) ) {
		$output[] = '<div class="kt-items vendors-list">';
		foreach ( $authors as $author ) {
			if ( get_user_meta( $author, 'dokan_enable_selling', true ) == 'yes' ) {
				$author_dokan_info = maybe_unserialize( get_user_meta( $author, 'dokan_profile_settings', true ) );
				$store_name = !empty( $author_dokan_info['store_name'] ) ? $author_dokan_info['store_name'] : '';
				$banner = !empty( $author_dokan_info['banner'] ) ? wp_get_attachment_image( $author_dokan_info['banner'], 'medium' ) : wp_get_attachment_image( get_option( 'woocommerce_placeholder_image', 0 ), 'medium' );
				$avatar = !empty( $author_dokan_info['banner'] ) ? wp_get_attachment_image( $author_dokan_info['gravatar'], 'thumbnail' ) : wp_get_attachment_image( get_option( 'woocommerce_placeholder_image', 0 ), 'thumbnail' );

				$vendor = dokan()->vendor->get( $author );

				$output[] = sprintf( '<div class="searchitem"><a href="%s" class="Link">%s %s<span class="vendor-name">%s</span></a></div>', $vendor->get_shop_url(), $banner, $avatar, $store_name );

			}
		}
		$output[] = "</div>";
	}
	return $output;
}
add_filter( 'kite_ajax_search_results', 'kite_append_dokan_vendors_list_to_ajax_search', 1, 2 );


/**
 * Add meta field of single product in head to use in facebook crawler for share button
 * 
 * @return void
 */
function kite_add_single_product_meta_fields_in_head() {
	if ( !is_product() || !is_single() ) {
		return;
	}

	echo "<meta property='og:url' content='" . get_the_permalink() . "'>";
	echo "<meta property='og:type' content='website'>";
	echo "<meta property='og:title' content='" . get_the_title() . "'>";
	echo "<meta property='og:description' content='" . esc_html( get_the_excerpt() ) . "'>";
	echo "<meta property='og:image' content='" . get_the_post_thumbnail_url() . "'>";
}
add_action( 'wp_head', 'kite_add_single_product_meta_fields_in_head');

/**
 * Check if is wcmp vendor page set the layout width
 *
 * @param array $main_content_classes
 * @return array
 */
function kite_check_wcmp_pages( $main_content_classes ) {
	if ( !function_exists('wcmp_is_store_page') ) {
		return $main_content_classes;
	}

	if ( wcmp_is_store_page() ) {
		if ( kite_opt( 'shop-enable-fullwidth', false ) ) {
			$main_content_classes[] = 'fullwidth';
		} else {
			$main_content_classes[] = 'container';
		}
	}
	
	return $main_content_classes;
}
add_filter( 'kite_main_content_classes', 'kite_check_wcmp_pages' );


<div <?php wc_product_class( $classes, $product ); ?>>
	<div class="productwrap">
	<?php
	if ( $request_from == 'widget' ) {
		if ( ! has_post_thumbnail() ) {
			$image = wc_placeholder_img( $image_size );
		} elseif ( ! is_array( $image_size ) || ! function_exists( 'aq_resize' ) ) {
			$image = get_the_post_thumbnail( $post->ID, $image_size );
			$default_image_sizes = get_intermediate_image_sizes();
			if ( is_string( $image_size ) && isset( $default_image_sizes[ $image_size ] ) ) {
				$src = 'src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%20' . $default_image_sizes[ $image_size ]['width'] . '%20' . $default_image_sizes[ $image_size ]['height'] . '\'%2F%3E" data-src=';	
			} elseif( is_array( $image_size ) ) {
				$src = 'src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%20' . $image_size['width'] . '%20' . $image_size['height'] . '\'%2F%3E" data-src=';	
			} else {
				$src = 'src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%2070%2070\'%2F%3E" data-src=';	
			}

			$image = str_replace( 'src=', $src, $image );
		} else {
			$image_dimension = wc_get_image_size( $image_size );

			$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
			$image_attributes = aq_resize( $image_link, $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], false, true );

			$img_url = isset( $image_attributes[0] ) ? $image_attributes[0] : $image_link;
			$img_width = isset( $image_attributes[1] ) ? $image_attributes[1] : $image_dimension['width'];
			$img_height = isset( $image_attributes[2] ) ? $image_attributes[2] : $image_dimension['height'];

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image = '<img src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg\'%20viewBox%3D\'0%200%20' . $img_width . '%20' . $img_height . '\'%2F%3E" width="' . esc_attr( $img_width ) . '" height="' . esc_attr( $img_height ) . '" data-src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $image_title ) . '"/>';

		}
		?>

		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="lazy-load lazy-load-on-load">
			<?php echo wp_kses( $image, $GLOBALS['kite-allowed-tags'] ); ?>
		</a>
		<div class="productinfo">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>">
				<h2 class="product-title"><?php echo esc_html( get_the_title() ); ?></h2>
			</a>
			<?php if ( ! $product->is_in_stock() ) { ?>
				<span class="out_of_stock"><?php esc_html_e( 'out of stock', 'teta-lite' ); ?></span>
			<?php } ?>
			<?php 
			echo wc_get_rating_html( $product->get_average_rating() ); 
			if ( $product->is_in_stock() && $product->is_purchasable() && $price_html = $product->get_price_html() ) { 
			?>
				<div class='kt-add-to-cart-container'>
					<span class="price"><?php echo '' . $price_html; ?></span>
					<?php 
					$button = apply_filters(
						'woocommerce_loop_add_to_cart_link',
						sprintf(
							'<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s %s" data-min-quantity="%s"><span class="icon"></span><span class="txt" data-hover="%s">%s</span></a>',
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
						echo wp_kses( $button, $GLOBALS['kite-allowed-tags'] );
					}
				?>
				</div>
			<?php } ?>
		</div>
		<?php
	} else {
		if ( ! wp_is_mobile() ) {
			if ( $product->is_on_sale() ) {
				echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'teta-lite' ) . '</span>', $post, $product );
			}
			if ( ! $product->is_in_stock() ) {
				echo '<div class="out_of_stock_badge_loop">' . esc_html__( 'Out of stock', 'teta-lite' ) . '</div>';
			}
			kite_custom_label();
		}
		if ( get_post_thumbnail_id() || get_option( 'woocommerce_placeholder_image', 0 ) ) {
		?>
		<div class="add_to_cart_btn_wrap lazy-load-on-load-load-hover-container">
		<?php
		echo '<a href="' . esc_url( get_the_permalink() ) . '" class="product-link" title="' . esc_attr( get_the_title() ) . '"></a>';
		echo woocommerce_get_product_thumbnail();
		if ( count( $attachment_ids ) > 0 && $hover_image == 'show' ) {
			$image_src         = '';
			$image             = '';
			$first_gallery_img = reset( $attachment_ids );// get the first image of gallery
			if ( function_exists( 'wc_get_image_size' ) && function_exists( 'aq_resize' ) ) {
				$image_dimension = wc_get_image_size( 'shop_catalog' );
				$image_link      = wp_get_attachment_url( $first_gallery_img );
				$img_url         = aq_resize( $image_link, $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], true, true );
				if ( ! $img_url ) {
					$img_url = $image_link;
				}
				$image = '<div class="hover-imagd lazy-load-on-load-load lazy-load-on-load-load-hover bd lazy-load-on-load-load" data-src="' . esc_url( $img_url ) . '"></div>';
			} else {
				$image_url = wp_get_attachment_image_src( $first_gallery_img, apply_filters( 'single_product_large_thumbnail_size', 'shop_catalog' ) );
				if ( $image_url != false ) {
					$image = '<div class="hover-imagd lazy-load-on-load-load lazy-load-on-load-load-hover bd lazy-load-on-load-load" data-src="' . esc_url( $image_url[0] ) . '"></div>';
				} else {
					$image_src = wp_get_attachment_image_src( $first_gallery_img, 'full' );
					$image     = '<div class="hover-image lazy-load lazy-load-hover bg-lazy-load" data-src="' . esc_url( $image_src[0] ) . '"></div>';
				}
			}

				echo '' . $image;// Sanitization performed in above lines!
		}
		?>
			<span class="added_to_cart_icon icon icon-check"></span>
		</div>
		<?php } ?>
		<div class="wrap_after_thumbnail">
		<div class="productinfo">
				<?php
				do_action( 'woocommerce_shop_loop_item_title' );
				do_action( 'woocommerce_after_shop_loop_item' );

				if ( wp_is_mobile() ) {
					if ( $product->is_on_sale() ) {
						echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'teta-lite' ) . '</span>', $post, $product );
					}
					if ( ! $product->is_in_stock() ) {
						echo '<div class="out_of_stock_badge_loop">' . esc_html__( 'Out of stock', 'teta-lite' ) . '</div>';
					}
					kite_custom_label();	
				}
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			wc_get_template( 'single-product/short-description.php' );

			$data_attribute = apply_filters( 'kite_loop_add_to_cart_button_attributes', array(), $product, $ajax_add_to_cart );

			?>
			<?php if ( ! $catalog_mode ) : ?>
				<div class="addtocartbutton">
					<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" rel="nofollow" <?php foreach( $data_attribute as $key => $data ) { echo '' . $key . '="' . $data . '"'; } ?> ><?php echo '' . ( $product->add_to_cart_text() ); ?></a>
				</div>
			<?php endif; ?> 
			
			<div class="product-buttons <?php if ( $wishlist ) { echo 'has-wishlist '; } if ( $compare ) { echo 'hascompare '; } ?>">
				<?php
				if ( $compare ) {
					kite_add_compare_button();
				}
				if ( $wishlist ) {
					yith_add_loop_wishlist();
				}
				?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>

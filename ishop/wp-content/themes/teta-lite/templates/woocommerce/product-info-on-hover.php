<div <?php wc_product_class( $classes, $product ); ?>>
	<div class="productwrap">
		<?php 
		$color = ( ! empty( $hover_color ) && $hover_color !== 'custom-color' && $hover_color !== 'custom' ) ? $hover_color : '';
		$color = ( empty( $color ) && ! empty( $custom_hover_color ) ) ? $custom_hover_color : $color;
		$color = ( ! empty( $color ) && strpos( $color, '#' ) === 0 ) ? $color : ( strpos( $color, 'rgb' ) === 0 ? $color : '#' . $color ) ;
		?>
		<div class="hover_layer" <?php echo ( ! empty( $color ) ) ? 'style="background-color:' . $color . ';"' : ''; ?> ></div>
		<?php
		if ( $badges != 'disable' && $request_from == 'widget' ) {
			if ( $product->is_on_sale() ) {

				echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'teta-lite' ) . '</span>', $post, $product );

			}

			if ( ! $product->is_in_stock() ) {

				echo '<div class="out_of_stock_badge_loop">' . esc_html__( 'Out of stock', 'teta-lite' ) . '</div>';

			}
			kite_custom_label();
		}
		?>
		<span class="added_to_cart_icon icon icon-check"></span>
		<div class="add_to_cart_btn_wrap lazy-load-hover-container <?php if ( $hover_image !== 'show' ) { echo 'no-hover'; } ?>" > 

			<?php
			if ( $request_from == 'shop' ) {
				echo '<a href="' . esc_url( get_the_permalink() ) . '" class="product-link" title="' . esc_attr( get_the_title() ) . '"></a>';

				echo woocommerce_get_product_thumbnail();
			} else {
				echo woocommerce_get_product_thumbnail( $image_size );
			}

			if ( count( $attachment_ids ) > 0 && $hover_image == 'show' ) {
				$image_src         = '';
				$image             = '';
				$first_gallery_img = reset( $attachment_ids );// get the first image of gallery

				if ( function_exists( 'wc_get_image_size' ) && function_exists( 'aq_resize' ) ) {

					$image_dimension = wc_get_image_size( 'shop_catalog' );

					$image_link = wp_get_attachment_url( $first_gallery_img );
					$img_url    = aq_resize( $image_link, $image_dimension['width'], $image_dimension['height'], $image_dimension['crop'], true, true );

					if ( ! $img_url ) {
						$img_url = $image_link;
					}

					$image = '<div class="hover-image lazy-load lazy-load-hover bg-lazy-load" data-src="' . esc_url( $img_url ) . '"></div>';

				} else {

					$image_url = wp_get_attachment_image_src( $first_gallery_img, apply_filters( 'single_product_large_thumbnail_size', 'shop_catalog' ) );
					if ( $image_url != false ) {
						$image = '<div class="hover-image lazy-load lazy-load-hover bg-lazy-load" data-src="' . esc_url( $image_url[0] ) . '"></div>';
					} else {
						$image_src = wp_get_attachment_image_src( $first_gallery_img, 'full' );
						$image     = '<div class="hover-image lazy-load lazy-load-hover bg-lazy-load" data-src="' . esc_url( $image_src[0] ) . '"></div>';
					}
				}

				echo '' . $image;// Sanitization performed in above lines!
			}
			if ( $request_from == 'shop' ) {
				echo "</div>";
			}
			
			?>
		<div class="wrap_after_thumbnail <?php if ( $hover_price == 'disable' ) { echo 'disable_price'; } ?>">
			<div class="product-buttons <?php if ( $product->is_type( 'variable' ) ) { echo 'has-variation'; } ?>" >	 
				<?php do_action( "kite_woocommerce_{$request_from}_loop_buttons", $product, $quickview, $wishlist, $compare, $ajax_add_to_cart, $catalog_mode ); ?>
			</div>
			<?php
			add_filter( 'woocommerce_format_price_range', 'kite_single_price', 10, 2 );
			if ( $request_from == 'shop' && $product_rating ) {
				remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 3 );
				add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
			}
			do_action( 'woocommerce_shop_loop_item_title' );
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
	<?php
	if ($request_from == 'widget') {
		echo "</div>";
	}
	if ( $countdown_activation == 'on' ) {
		add_deal_count_down_timer( 1 );
	}
	if ( $progressbar_activation == 'on' ) {
		kite_stock_progress_bar( 1 );
	}
	?>
</div>

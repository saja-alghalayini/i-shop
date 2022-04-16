<?php

if ( ! function_exists( 'register_sidebar' ) ) {
	return;
}
add_action( 'widgets_init', 'kite_register_sidebars' );
function kite_register_sidebars() {
	$theme_sidebars = array( 'Blog Sidebar', 'Page Sidebar', 'WooCommerce Sidebar', 'WooCommerce Filter Topbar', 'WooCommerce Product sidebar' );
	$defaults       = array(
		'name'          => esc_html__( 'Blog Sidebar', 'teta-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	$footerWidgets = kite_opt( 'footer_widgets', 0 );

	if ( $footerWidgets == 2 || $footerWidgets == 3 || $footerWidgets == 4 ) {
		$footerWidgets = 2;
	} elseif ( $footerWidgets == 5 || $footerWidgets == 7 || $footerWidgets == 8 ) {
		$footerWidgets = 3;

	} elseif ( $footerWidgets == 6 ) {
		$footerWidgets = 4;
	} elseif ( $footerWidgets == 9 || $footerWidgets == 10 || $footerWidgets == 11 ) {
		$footerWidgets = 5;
	} elseif ( $footerWidgets == 12 || $footerWidgets == 13 || $footerWidgets == 14 ) {
		$footerWidgets = 6;
	} elseif ( $footerWidgets == 15 ) {
		$footerWidgets = 7;
	}

	// Blog sidebar
	register_sidebar( array_merge( $defaults, array( 'id' => 'main-sidebar' ) ) );

	// Page sidebar
	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name' => esc_html__( 'Page Sidebar', 'teta-lite' ),
				'id'   => 'page-sidebar',
			)
		)
	);

	// Footer widgets
	for ( $i = 0; $i < $footerWidgets;$i++ ) {
		register_sidebar(
			array_merge(
				$defaults,
				array(
					'name' => 'Footer Widget ' . ( $i + 1 ),
					'id'   => 'footer-widget-' . ( $i + 1 ),
				)
			)
		);

		$theme_sidebars[] = 'Footer Widget ' . ( $i + 1 );
	}

	// Woocommerce Sidebar
	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name' => esc_html__( 'WooCommerce Sidebar', 'teta-lite' ),
				'id'   => 'woocommerce-sidebar',
			)
		)
	);

	// Woocommerce Product Sidebar
	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name' => esc_html__( 'WooCommerce Product Sidebar', 'teta-lite' ),
				'id'   => 'woocommerce-product-sidebar',
			)
		)
	);

	// Woocommerce Filter Sidebar
	if ( isset( $_GET['shopFilter'] ) && ! empty( $_GET['shopFilter'] ) ) {
		if ( sanitize_text_field( $_GET['shopFilter'] ) == 'width-filter' ) {
			$shopFilter = true;
		} elseif ( sanitize_text_field( $_GET['shopFilter'] ) == 'without-filter' ) {
			$shopFilter = false;
		} else {
			$shopFilter = kite_opt( 'shop-filter', false );
		}
	} else {
		$shopFilter = kite_opt( 'shop-filter', false );
	}
	if ( $shopFilter ) {
		register_sidebar(
			array_merge(
				$defaults,
				array(
					'name' => esc_html__( 'WooCommerce Filters Bar', 'teta-lite' ),
					'id'   => 'woocommerce-filter-sidebar',
				)
			)
		);
	}

	// Custom Sidebars
	if ( kite_opt( 'custom_sidebars' ) != '' ) {
		$sidebars = explode( ',', kite_opt( 'custom_sidebars' ) );
		$i        = 0;

		foreach ( $sidebars as $bar ) {
			if ( ! in_array( $bar, $theme_sidebars ) && ! is_active_sidebar( $bar ) ) {
				register_sidebar(
					array_merge(
						$defaults,
						array(
							'id'   => "custom-$i",
							'name' => str_replace( '%666', ',', $bar ),
						)
					)
				);

				$theme_sidebars[] = str_replace( '%666', ',', $bar );
			}

			$i++;
		}
	}
}

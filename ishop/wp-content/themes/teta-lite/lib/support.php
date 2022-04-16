<?php
if ( ! function_exists( 'kite_add_image_size_retina' ) ) {
	function kite_add_image_size_retina( $name, $width = 0, $height = 0, $crop = false ) {
		add_image_size( $name, $width, $height, $crop );

		if ( kite_opt( 'retina_ready', false ) != '0' ) { // Check Retina Ready option is enable or not!
			add_image_size( "$name@2x", $width * 2, $height * 2, $crop );
		}

	}
}
/*
-----------------------------------------------------------------------------------*/
/*
  Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {

	// Adds theme support for woocommerce
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'gallery' ) );

	// Auto-height product images used in masonry style
	if ( function_exists( 'wc_get_image_size' ) ) {
		$image_dimension = wc_get_image_size( 'shop_catalog' );
		 kite_add_image_size_retina( 'Kite_product_thumbnail-auto-height', $image_dimension['width'], 9999, false );
	}

	// Auto height images used in masonry style
	kite_add_image_size_retina( 'Kite_thumbnail-auto-height', 400, 9999, false );

	// Portfolio single
	 kite_add_image_size_retina( 'Kite_portfolio-single', 1140, 655, true );// More suited for wide images

	 // Standard blog detail
	 kite_add_image_size_retina( 'Kite_standard-blog-detail', 1170, 539, true );// More suited for wide images

	 kite_add_image_size_retina( 'Kite_recent_post_thumb', 55, 55, true );
}

/*
-----------------------------------------------------------------------------------*/
/*
   Zoom Feature for Product Image
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'wc-product-gallery-zoom' );

/*
-----------------------------------------------------------------------------------*/
/*
  RSS Feeds
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'automatic-feed-links' );

/*
-----------------------------------------------------------------------------------*/
/*
  Post Formats
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link', 'quote' ) );

/*
-----------------------------------------------------------------------------------*/
/*
  Custom Header/Background
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'custom-background' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );

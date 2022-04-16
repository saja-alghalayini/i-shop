<?php
// check topbar is Enable Or not
$main_content_classes = [ 
	'main' 				=> 'main-content',
	'contentVisibility'	=> kite_opt( 'kite_preloader' , '2') == '2' ? 'show' : '', 
];

$topbar = kite_opt( 'topbar_display', false );
if ( $topbar == '1' ) {
	$main_content_classes['hasTopbar'] = 'has-topbar';
} else {
	$main_content_classes['hasTopbar'] = 'noTopbar';
}
$main_content_classes['headerStyle'] = kite_opt( 'header-style', 'normal-menu' );
$headerType  = kite_opt( 'header-type', 1 );

if ( $headerType == 1 ) {

	$main_content_classes['headerTypeClass'] = ' type1';

} elseif ( $headerType == 7 || $headerType == 8 ) { // left & rightSidebar

	$main_content_classes['headerTypeClass'] = ' type7';

} elseif ( $headerType == 9 ) {

	$main_content_classes['headerTypeClass'] = ' type9';

} elseif ( $headerType == 2 || $headerType == 3 ) {

		$main_content_classes['headerTypeClass'] = 'type2_3';

} elseif ( $headerType == 4 || $headerType == 5 || $headerType == 6 ) {

	$main_content_classes['headerTypeClass'] = 'type4_5_6';
} elseif ( $headerType == 0 ) {
	$main_content_classes['headerTypeClass'] = 'type0';
} elseif ( $headerType == 10 ) {
	$main_content_classes['headerTypeClass'] = 'type10';
}
$main_content_classes['hasMobileTopbar'] = ( kite_opt( 'topbar_display', false ) && ( kite_opt( 'topbar-language-link-1' ) || kite_opt( 'topbar-language-link-2' ) || kite_opt( 'topbar-language-link-3' ) || kite_opt( 'topbar-language-link-4' ) || kite_opt( 'topbar_currency_shortcode', '[woocs show_flags=0 flag_position="left"]' ) ) ) ? 'has-mobile-topbar' : '';
if ( kite_opt( 'menu-search', true ) ) {
	$main_content_classes['hasSearch'] = 'has_search';
} else {
	$main_content_classes['hasSearch'] = '';
}

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
	$main_content_classes['hasSearch'] = '';
	$main_content_classes['headerTypeClass'] = '';
	$main_content_classes['hasMobileTopbar'] = '';
}

/* check Slider is Enable Or not  */
$main_content_classes['hasSlider'] = '';
if ( kite_get_meta( 'display-top-slider' ) ) {
	$main_content_classes['hasSlider'] = 'hasrevslider';
}

if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) { // check woocomerce plugin is active or not
	$productDetailStyleClass = '';
	if ( is_product() ) {
		/* check Product details Style */
		if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
			$product_detail_style = kite_get_meta( 'product_detail_style' ); // style of product detail in product page
		} else {
			$product_detail_style = kite_opt( 'product-detail-style', 'pd_classic' ); // style of product detail in theme settings
		}


		if ( $product_detail_style == 'pd_background' ) {
			$main_content_classes['productDetailStyleClass'] = 'pd_background';
		} elseif ( $product_detail_style == 'pd_top' ) {
			$main_content_classes['productDetailStyleClass'] = 'pd_top';
		}
		elseif ( $product_detail_style == 'pd_fullwidth_top' ) {
			$main_content_classes['productDetailStyleClass'] = 'pd_fullwidth_top';
		}
	}

	$main_content_classes['pagetopspace'] = '';
	$headerType   = kite_get_meta( 'header-type-switch', true );
	$hasSpace     = ( $headerType == '1' ) ? true : false;

	$term                     = get_queried_object();
	$cateID                   = empty( $term->term_id ) ? 0 : $term->term_id;
	$display_type_wc_setting  = get_option( 'woocommerce_category_archive_display' );
	$display_type_cat_setting = get_term_meta( $cateID, 'display_type' );
	// show subcategories after shop-filter
	$cat_display_header = ( ( is_product_category() && $display_type_cat_setting == 'both' ) || ( is_product_category() && $display_type_wc_setting == 'both' && $display_type_cat_setting == '' ) ) ? true : false;

	if ( ( ! is_shop() && ! $cat_display_header ) || $hasSpace ) {
		$main_content_classes['pagetopspace'] = 'pagetopspace';
	}
	if ( $headerType == '2' ) {
		$main_content_classes['pagetopspace'] = 'disabletopspace';
	}
	if ( $headerType == '0' ) {
		$main_content_classes['pagetopspace'] = 'enable-header';
	}

	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
		$main_content_classes['pagetopspace'] = '';
		$main_content_classes['hasSearch'] = '';
	}
	$classes = get_body_class();

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );

	?>

	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="main" >
			<?php if (( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) || ( function_exists( 'dokan' ) &&  in_array('dokan-dashboard', $classes) )  ) { ?>
				<div class="container"> 
			<?php  } ?> 
	<?php

		get_template_part( 'templates/slider' );

		get_template_part( 'templates/head' );


} elseif ( is_page_template( 'main-page.php' ) ) {

	$main_content_classes['pagetopspace'] = '';
	$headerType   = kite_get_meta( 'header-type-switch', true );
	$hasSpace     = ( $headerType == '1' ) ? true : false;

	if ( $hasSpace ) {
		$main_content_classes['pagetopspace'] = 'pagetopspace';
	}
	if ( $headerType == '2' ) {
		$main_content_classes['pagetopspace'] = 'disabletopspace';
	}
	if ( $headerType == '0' ) {
		$main_content_classes['pagetopspace'] = 'enable-header';
	}

	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
		$main_content_classes['pagetopspace'] = '';
		$main_content_classes['hasSearch'] = '';
	}

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );
	?>

	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="main">
			<?php
			get_template_part( 'templates/slider' );

} elseif ( is_page() ) {

	if ( kite_get_meta( 'page-type-switch' ) == 'blog-section' ) {
		$main_content_classes['pageType'] = 'blogclassicpage';
	}

	$main_content_classes['pagetopspace']      = '';
	$headerType        = kite_get_meta( 'header-type-switch', true );
	$hasSpace          = ( $headerType == '1' ) ? true : false;
	$bg_imag           = kite_get_meta( 'page_bg_image' );
	$bg_img_position   = kite_get_meta( 'bg_img_position' );
	$bg_img_attachment = kite_get_meta( 'bg_img_attachment' );
	$page_bg_color     = kite_get_meta( 'page_bg_color' );
	$bg_img_size       = kite_get_meta( 'bg_img_size' );
	$bg_img_repeat     = kite_get_meta( 'bg_img_repeat' );


	if ( $hasSpace ) {
		$main_content_classes['pagetopspace'] = 'pagetopspace';
	}
	if ( $headerType == '2' ) {
		$main_content_classes['pagetopspace'] = 'disabletopspace';
	}
	if ( $headerType == '0' ) {
		$main_content_classes['pagetopspace'] = 'enable-header';
	}

	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
		$main_content_classes['pagetopspace'] = '';
		$main_content_classes['hasSearch'] = '';
	}

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );
	
	?>
	<div class="row_overlay" <?php if ( $page_bg_color ) { ?> style=" background-color: <?php echo esc_attr( $page_bg_color ); ?>;"<?php } ?>></div>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="main" <?php if ( $page_bg_color ) { ?> style=" background-color: <?php echo esc_attr( $page_bg_color ); ?>;"<?php } ?> <?php if ( $bg_imag ) { ?> style="background-image: url(<?php echo esc_url( $bg_imag ); ?>);  background-size:<?php echo esc_attr( $bg_img_size ); ?>; background-repeat:<?php echo esc_attr( $bg_img_repeat ); ?>; background-position:<?php echo esc_attr( $bg_img_position ); ?>; background-attachment:<?php echo esc_attr( $bg_img_attachment ); ?>; "<?php } ?>>

			<?php

				get_template_part( 'templates/slider' );

				get_template_part( 'templates/head' );

} elseif ( is_home() ) {
	$main_content_classes['pagetopspace'] = '';
	$main_content_classes['pageType'] = 'blogclassicpage';
	$headerType   = kite_get_meta( 'header-type-switch', true );

	if ( $headerType == '1' ) {
		$main_content_classes['pagetopspace'] = 'pagetopspace';
	} elseif ( $headerType == '2' ) {
		$main_content_classes['pagetopspace'] = 'disabletopspace';
	} elseif ( $headerType == '0' ) {
		$main_content_classes['pagetopspace'] = 'enable-header';
	}

	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
		$main_content_classes['pagetopspace'] = '';
		$main_content_classes['hasSearch'] = '';
	}

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );

	?>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="main">
			<?php

				get_template_part( 'templates/slider' );

				get_template_part( 'templates/head' );

} elseif ( is_404() ) {
	$main_content_classes['pagetopspace'] = 'pagetopspace';
	
	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );
	
	?>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>"> 
			<div id="main" class="wrap container">
			   
	<?php

} elseif ( is_search() ) {
	$main_content_classes['pagetopspace'] = 'pagetopspace';

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );

	?>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>>
			<div id="searchPage" class="wrap kitesection customSection singlepost">
	<?php

} elseif ( is_archive() ) {
	$main_content_classes['pagetopspace'] = 'pagetopspace';

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );

	?>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div class="wrap kitesection customSection singlepost archiveblogsingle">
	<?php
} elseif ( is_single() ) {
	$main_content_classes['pagetopspace'] = 'pagetopspace';
	$sidebar      = kite_opt( 'blog-sidebar-position', 'main-sidebar' );
	$sidebarclass = '';
	if ( $sidebar == 'main-sidebar' ) {
		$sidebarclass = 'blog-has-sidebar right';
	}
	if ( $sidebar == 'left-sidebar' ) {
		$sidebarclass = 'blog-has-sidebar left';
	}

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );

	?>
	<div class="toggle-sidebar-container">
		<div  id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="blogsingle" class="wrap kitesection customSection singlepost <?php echo esc_attr( $sidebarclass ); ?>">
	<?php

} else {

	/**
	 * Main content classes filter
	 */
	$main_content_classes = apply_filters( 'kite_main_content_classes', $main_content_classes );
	
	$main_content_classes['pagetopspace'] = 'pagetopspace';
	?>
	<div class="toggle-sidebar-container">
		<div id="main-content" class="<?php echo implode( ' ', array_values( array_filter( $main_content_classes ) ) );?>">
			<div id="main" class="wrap">
				<div class="container">
	<?php
}

?>

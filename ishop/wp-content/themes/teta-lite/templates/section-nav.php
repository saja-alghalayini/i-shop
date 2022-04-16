<?php
if ( isset( $_GET['headerType'] ) && ! empty( $_GET['headerType'] ) ) {
	$requestedHeaderType = sanitize_text_field( $_GET['headerType'] );
	if ( is_numeric( $requestedHeaderType ) ) {
		if ( $requestedHeaderType == 0 || $requestedHeaderType == 1 || $requestedHeaderType == 2 || $requestedHeaderType == 3 || $requestedHeaderType == 4 || $requestedHeaderType == 5 || $requestedHeaderType == 6 || $requestedHeaderType == 9 || $requestedHeaderType == 10 ) {
			$headerType = $requestedHeaderType;
		}
	} else {
		$headerType = kite_opt( 'header-type', '1' );
	}
} else {
	$headerType = kite_opt( 'header-type', '1' );
}
  $headerStyle       = kite_opt( 'header-style', 'normal-menu' );
  $headerStyleDefault = 'fixed-menu';
  $search            = kite_opt( 'menu-search', true );
  $menuInContainer   = kite_opt( 'menu-container', false );
  $cart_style        = kite_opt( 'shop-wishlist-cart-style', true );
  $hasMobileTopbar   = ( kite_opt( 'topbar_display',false ) == 1 && ( kite_opt( 'topbar-language-link-1' ) || kite_opt( 'topbar-language-link-2' ) || kite_opt( 'topbar-language-link-3' ) || kite_opt( 'topbar-language-link-4' ) || kite_opt( 'topbar_currency_shortcode', '[woocs show_flags=0 flag_position="left"]' ) ) ) ? 'has-mobile-topbar' : '';
  // get menu hover Style option
  $menu_hover_style = kite_opt( 'menu-hover-style', 3 );
if ( $menu_hover_style == '0' ) {
	$menuHoverStyle = 'borderhover';
} elseif ( $menu_hover_style == '1' ) {
	$menuHoverStyle = 'fillhover';
} elseif ( $menu_hover_style == '2' ) {
	$menuHoverStyle = 'underline-hover';
} else {
	$menuHoverStyle = 'fadehover';
}

  // get submenu hover Style option
  $submenu_hover_style = kite_opt( 'submenu-hover-style', 0 );
if ( $submenu_hover_style == '1' ) {
	$submenu_hover_style = 'submenu_underlined';
} else {
	$submenu_hover_style = '';
}

switch ( $headerType ) {

	case '2' :
		$headerTypeClass = 'type2_3 type' . $headerType ;
		break;
	case '3' :
		$headerTypeClass = 'type2_3 type' . $headerType ;
		break;

	case '4' :
		$headerTypeClass = 'type4_5_6 type' . $headerType ;
		break;
	case '5' :
		$headerTypeClass = 'type4_5_6 type' . $headerType ;
		break;
	case '6' :
		$headerTypeClass = 'type4_5_6 type' . $headerType ;
		break;

	default:
		$headerTypeClass = 'type' . $headerType ;
		break;
}

// shop cart - Enable Or disable option
$shop_cart = kite_opt( 'shop-enable-cart', true );

// catalog mode option
$catalog_mode = kite_opt( 'catalog_mode', false );

// responsive logo
$responsivelogo = kite_opt( 'responsivelogo' );

$classes = array(
	$menuHoverStyle,
	$submenu_hover_style,
	$headerTypeClass,
	$headerStyle,
	$hasMobileTopbar
);

if ( $search != 1 ) {
	$classes[] = 'no-search';
}

if ( ! has_nav_menu( 'primary-nav' ) ) {
	$classes[] = 'no-menu';
}	

if ( $shop_cart == 1 && ! $catalog_mode ) {
	$classes[] = 'has-dropdown-cart';
}

if ( kite_opt( 'topbar_display', false ) == 1 ) {
	$classes[] = 'menu-space-noti';
}

if ( $menuInContainer == 1 ) {
	$classes[] = 'fullwidthmenu';
}

if ( kite_woocommerce_installed() && class_exists( 'YITH_WCWL' ) && kite_opt( 'header-wishlist-display', true ) == 1 ) {
	$classes[] = 'has-wishlist';
}

$data_fixed = ! empty( $headerStyle ) ? $headerStyle : $headerStyleDefault;
$logo = kite_opt( 'logo','' );
$logoSecond = kite_opt( 'logo-second', '' );

switch ( $headerType ) {
	case  0:
		include locate_template( 'templates/nav/header-0.php', false, false );	
		break;
	
	case  2 :
		include locate_template( 'templates/nav/header-2-3.php', false, false );		
		break;
	case  3 :
		include locate_template( 'templates/nav/header-2-3.php', false, false );		
		break;

	case  9 :
		include locate_template( 'templates/nav/header-9.php', false, false );
		break;

	case  7 :
		$data_fixed = '';
		$classes = array( 
			'hidden-desktop',
			$hasMobileTopbar
		);
		if ( $search !== 1 ) {
			$classes[] = 'no-search';
		}
		
		include locate_template( 'templates/nav/header-7.php', false, false );
		break;

	case  8 :
		$data_fixed = '';
		$classes = array( 
			'hidden-desktop',
			$hasMobileTopbar
		);
		if ( $search !== 1 ) {
			$classes[] = 'no-search';
		}
		include locate_template( 'templates/nav/header-8.php', false, false );
		break;
	default:
		include locate_template( 'templates/nav/header-def.php', false, false );	
		break;
}
?>
	
<span id="sidebar-open-overlay"></span>
<?php
if ( $search == 1 && $headerType != 0 ) {
	?>
	<div class="search-form-cls">
		<?php 
		get_search_form([ 
			'kite-search-form'	=> true 
		]); 
		?>
	</div>
	<?php
}
?>

<?php
// Main colors
$acc = kite_get_meta( 'kt-page-has-custom-color' ) ? kite_get_meta( 'style-accent-color' ) : kite_opt( 'style-accent-color', '#5956e9' );// Accent color
$hc  = kite_get_meta( 'kt-page-has-custom-color' ) ? kite_get_meta( 'style-highlight-color' ) : kite_opt( 'style-highlight-color', '#424242' );// Highlight color
$lc  = kite_get_meta( 'kt-page-has-custom-color' ) ? kite_get_meta( 'style-link-color' ) : kite_opt( 'style-link-color', '#4592ff' );// Link color
$lhc = kite_get_meta( 'kt-page-has-custom-color' ) ? kite_get_meta( 'style-link-hover-color' ) : kite_opt( 'style-link-hover-color', '#307adb' );// Link hover color

// Preloader
$preloader_bg_color   = kite_opt( 'preloader_bg_color', '#efefef' );
$preloader_color      = kite_opt( 'preloader_color', '#c7c7c7' );
$preloader_box_color  = kite_opt( 'preloader_box_color', '#f7f7f7' );
$preloader_text_color = kite_opt( 'preloader_text_color', '#000' );

// topbar
$topbar_bg_color     = kite_opt( 'topbar_bg_color', '#eee' );
$topbar_border_color = kite_opt( 'topbar_border_color', '#eee' );

// cart bg color
$shop_wishlist_cart_bg_color = kite_opt( 'shop-wishlist-cart-bg-color', '#eeeeee00' );

// Initial menu value
$initialMenuBgColor        = kite_opt( 'initial-menu-background-color', '#ffffff' );
$initialMenuTextColor      = kite_opt( 'initial-menu-text-color', '#000000' );
$initialMenuTextHoverColor = kite_opt( 'initial-menu-text-hover-color', '#000000' );
$initialMenuHoverColor     = kite_opt( 'initial-menu-text-bg-hover-color', '#307adb' );// initial menu hover color
$initialMenuColorHover     = kite_opt( 'initial-menu-text-color-hover' );
$initialMenuBorderColor    = kite_opt( 'initial-menu-border-color', '#eeeeee00' );

// Menu Styles
$menubgcolor                 = kite_opt( 'menu-background-color', '#ffffff' );
$menuTextColor               = kite_opt( 'menu-text-color', '#000000' );
$menuTextHoverColor          = kite_opt( 'menu-text-hover-color', '#000000' );
$MenuHoverColor              = kite_opt( 'menu-text-bg-hover-color', '#e8e8e8' );// menu hover color
$menuBorderColor             = kite_opt( 'menu-border-color', '#eee' );
$humburger_menu_icon_color   = kite_opt( 'menu_icon_color' );
$humburger_menu_icon_bgcolor = ( kite_opt( 'menu_icon_bgcolor' ) ? : 'transparent' );


// Submenu Styles
$submenubgcolor      = kite_opt( 'submenu-background-color', '#fff' );
$submenuTextColor    = kite_opt( 'submenu-text-color', '#222' );
$submenuHeadingColor = kite_opt( 'submenu-heading-color', '#111' );


$menuOpacity = kite_opt( 'menu-opacity', 30 );
if ( ( isset( $menuOpacity ) && ! empty( $menuOpacity ) ) || ( $menuOpacity == '0' ) ) {
	$menuOpacity = kite_opt( 'menu-opacity', 30 ) / 100;
} else {
	$menuOpacity = 0.98;
}

if ( kite_get_meta( 'menu' ) == 'custom' ) {
	// Initial menu value
	$initialMenuBgColor        = kite_get_meta( 'initial-menu-background-color' );
	$initialMenuTextColor      = kite_get_meta( 'initial-menu-text-color' );
	$initialMenuTextHoverColor = kite_get_meta( 'initial-menu-text-hover-color' );
	$initialMenuHoverColor     = kite_get_meta( 'initial-menu-text-bg-hover-color', '#307adb' );
	$initialMenuBorderColor    = kite_get_meta( 'initial-menu-border-color', '#eeeeee00' );

	if ( kite_opt( 'header-style', 'normal-menu' ) == 'kite-menu' ) {
		// Menu Styles
		$menubgcolor        = kite_get_meta( 'menu-background-color' );
		$menuTextColor      = kite_get_meta( 'menu-text-color' );
		$menuTextHoverColor = kite_get_meta( 'menu-text-hover-color' );
		$MenuHoverColor     = kite_get_meta( 'menu-text-bg-hover-color' );// menu hover color
		$menuBorderColor    = kite_get_meta( 'menu-border-color' );
	}
	if ( kite_opt( 'header-style', 'normal-menu' ) == 'normal-menu' ) {
		// Menu Styles
		$menubgcolor        = kite_get_meta( 'menu-background-color' );
		$menuTextColor      = kite_get_meta( 'menu-text-color' );
		$menuTextHoverColor = kite_get_meta( 'menu-text-hover-color' );
		$MenuHoverColor     = kite_get_meta( 'menu-text-bg-hover-color' );// menu hover color
		$menuBorderColor    = kite_get_meta( 'menu-border-color' );
	}
}

?>
:root {
	<?php 
	$def_font    = [
		'font-family'	=> 'DM Sans',
		'font-weight'	=> '400',
		'font-style'	=> 'normal',
		'letter-spacing'=> '0px'
	];
	
	if ( ( $primary = kite_opt( 'primary-font-type', 'default' ) ) == 'default' ) {
		$primary_font = "DM Sans";
	} else if ( $primary == 'google' ) {
		$primary_font = kite_opt( 'primary-font', $def_font )['font-family'];
	} else {
		$primary_font = kite_opt( 'primary-font-custom', 'DM Sans' );
	}
	?>
	--kite-primary-font : <?php echo esc_attr( $primary_font ); ?>;

	<?php 
	$def_font['font-family'] = 'Roboto';
	if ( ( $secondary = kite_opt( 'secondary-font-type', 'default' ) ) == 'default' ) {
		$secondary_font = "Roboto";
	} else if ( $secondary == 'google' ) {
		$secondary_font = kite_opt( 'secondary-font', $def_font )['font-family'];
	} else {
		$secondary_font = kite_opt( 'secondary-font-custom', 'Roboto' );
	}
	?>
	--kite-secondary-font : <?php echo esc_attr( $secondary_font ); ?>;

	<?php 
	if ( ( $condenced = kite_opt( 'condenced-font-type', 'default' ) ) == 'default' ) {
		$condenced_font_family = "Roboto";
		$condenced_font_style  = 'normal';
		$condenced_font_weight = 400;
		$condenced_letter_spacing = '1px';
	} else if ( $condenced == 'google' ) {
		$condenced_font = kite_opt( 'condenced-font', $def_font );
		$condenced_font_family = $condenced_font['font-family'];
		$condenced_font_weight = $condenced_font['font-weight'];
		$condenced_font_style  = $condenced_font['font-style'];
		$condenced_letter_spacing = $condenced_font['letter-spacing'];
	} else {
		$condenced_font_family = kite_opt( 'condenced-font-custom', 'Roboto' );
		$condenced_font_style  = 'normal';
		$condenced_font_weight = 400;
		$condenced_letter_spacing = '1px';
	}
	?>
	--kite-condenced-font : <?php echo esc_attr( $condenced_font_family ); ?>;
	--kite-condenced-font-style : <?php echo esc_attr( $condenced_font_style ); ?>;
	--kite-condenced-font-weight : <?php echo esc_attr( $condenced_font_weight ); ?>;
	--kite-condenced-font-letter-spacing : <?php echo esc_attr( $condenced_letter_spacing ); ?>;

	<?php
	if ( ( $navigation_font_type = kite_opt( 'font-navigation-type', 'default' ) ) == 'default' ) {
		$navigation_font = 'DM Sans';
	} elseif ( $navigation_font_type == 'google' ) {
		$navigation_font =  [ kite_opt( 'font-navigation', $def_font )['font-family'] => array( '300', '400', '500', '600', '700' ) ];
	} else {
		$navigation_font = kite_op( 'custom-font-name-navigation', 'DM Sans' );
	}
	?>
	--kite-nav-font : <?php echo esc_attr( $navigation_font ); ?>;

	<?php
	$primary_color = kite_opt( 'style-accent-color', '#5956e9');
	$secondary_color = kite_opt( 'style-highlight-color', '#424242');
	$threshold_notice_price_color = ( kite_opt( 'threshold_notice_price_color' ) ? : '#ee1c25' );
	?>
	--kite-primary-color : <?php echo ( ! empty( $primary_color ) ? esc_attr( $primary_color ) : '#000'  );?>;
	--kite-secondary-color : <?php echo ( ! empty( $secondary_color ) ? esc_attr( $secondary_color ) : '#fff'  );?>;
	--kite-accent-color : <?php echo esc_attr( $acc ); ?>;
	--threshold_notice_price_color : <?php echo esc_attr( $threshold_notice_price_color ); ?>;
	
	<?php
// woocommerce
if ( kite_woocommerce_installed() ) {
	if ( is_product() ) {

		if ( kite_get_meta( 'product_detail_style_inherit' ) == '1' ) {
			$pd_bg = kite_get_meta( 'product_detail_bg' ); // Product detail bg in product page
		} else {
			$pd_bg = kite_opt( 'product-detail-bg', '#fff' );// Product detail bg in theme settings
		}

		?>
		--kite-pd-bg:<?php echo esc_attr( $pd_bg ); ?>;
		<?php
	}
}
?>
}

/* cart bg color */
header.type0 .widget.widget_woocommerce-dropdown-cart,
header.type9 .widget.widget_woocommerce-dropdown-cart ,
header.type1 .widget.widget_woocommerce-dropdown-cart ,
header.type2_3 .widget.widget_woocommerce-dropdown-cart ,
header.type4_5_6 .widget.widget_woocommerce-dropdown-cart,
.humburger_menu_area .widget.widget_woocommerce-dropdown-cart,
header.type0 .topbar_wishlist,
header.type9 .topbar_wishlist ,
header.type1 .topbar_wishlist ,
header.type2_3 .topbar_wishlist ,
header.type4_5_6 .topbar_wishlist,
header.type10 .humburger-wrap-forbuttons .topbar_wishlist,
header.type10 .humburger-wrap-forbuttons .widget.widget_woocommerce-dropdown-cart
 {
	background-color: <?php echo esc_attr( $shop_wishlist_cart_bg_color ); ?> !important;
}

/* Menu */
aside.vertical_menu_area {
	background-color: <?php echo esc_attr( $menubgcolor ); ?>;
}
.vertical_menu_enabled .vertical_background_image {
	opacity: <?php echo esc_attr( $menuOpacity ); ?>;
}
#menubgcolor {
	background-color: <?php echo esc_attr( $menubgcolor ); ?>;
}
.menu-toggle .togglelines,
.menu-toggle .togglelines:after,
.menu-toggle .togglelines:before
{
	background-color: <?php echo esc_attr( $humburger_menu_icon_color ); ?> ;
}
.menu-toggle
{
	background-color: <?php echo esc_attr( $humburger_menu_icon_bgcolor ); ?> ;
	border-color: <?php echo esc_attr( $humburger_menu_icon_bgcolor ); ?> ;
}
/* background image in vertical menu opacity */
.vertical_menu_enabled #menubgcolor {
	opacity: <?php echo esc_attr( $menuOpacity ); ?>;
}

#kt-header #headerfirststate,#kt-header #mobile-header,#kt-header #mobile-header_secondstate {
	border-bottom-color: <?php echo esc_attr( $initialMenuBorderColor ); ?>;
}

header #headerfirststate .widget.widget_woocommerce-dropdown-cart,
header #headerfirststate .topbar_wishlist {
	border-color: <?php echo esc_attr( $initialMenuBorderColor ); ?> !important;
}
#kt-header #headersecondstate {
	border-bottom: 1px solid <?php echo esc_attr( $menuBorderColor ); ?>;
}
header  #headersecondstate .topbar_wishlist,
header #headersecondstate .widget.widget_woocommerce-dropdown-cart {
	border: 1px solid <?php echo esc_attr( $menuBorderColor ); ?> !important;
}
<?php if ( ! empty( $menuTextHoverColor ) ) { ?>
header.underline-hover #headersecondstate .navigation > ul > li:hover > a,
header.underline-hover #headersecondstate .navigation li.active > a,
header.underline-hover #headersecondstate .navigation > ul > li.current_page_item > a,
header.underline-hover #headersecondstate .navigation > ul > li.current-menu-ancestor > a,
header.fillhover #headersecondstate .navigation > ul > li:hover > a span,
header.fillhover #headersecondstate .navigation li.active > a span,
header.fillhover #headersecondstate .navigation > ul > li.current_page_item > a span ,
header.fillhover #headersecondstate .navigation > ul > li.current-menu-ancestor > a span ,
header.borderhover #headersecondstate .navigation > ul > li:hover > a span,
header.borderhover #headersecondstate .navigation > ul > li.current_page_item > a span,
header.borderhover #headersecondstate .navigation > ul > li.current-menu-ancestor > a span {
	color: <?php echo esc_attr( $menuTextHoverColor ); ?>;
}
<?php } ?>
<?php if ( ! empty( $initialMenuTextHoverColor ) ) { ?>
header.underline-hover #headerfirststate .navigation > ul > li:hover > a,
header.underline-hover #headerfirststate .navigation > ul > li.active > a,
header.underline-hover #headerfirststate .navigation > ul > li.current_page_item > a,
header.underline-hover #headerfirststate .navigation > ul > li.current-menu-ancestor > a,
header.fillhover #headerfirststate .navigation:not(.catmenu) > ul > li:hover > a span,
.humburger_menu_enabled .humburger_menu_area .menu_vertical.fillhover .vertical_menu_navigation li:hover a,
.menu_vertical.fillhover .vertical_menu_navigation li a:hover ,
header.fillhover #headerfirststate .navigation li.active > a span,
header.fillhover #headerfirststate .navigation > ul > li.current_page_item > a span ,
header.fillhover #headerfirststate .navigation > ul > li.current-menu-ancestor > a span ,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li:hover > a span,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.active > a span,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.current_page_item > a span,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.current-menu-ancestor > a span {
	color: <?php echo esc_attr( $initialMenuTextHoverColor ); ?>;
}
<?php } ?>
<?php if ( ! empty( $menuTextHoverColor ) ) { ?>
header.underline-hover #headersecondstate .navigation ul > li hr {  
	background-color:  <?php echo esc_attr( $menuTextHoverColor ); ?>;
}
<?php } ?>
<?php if ( ! empty( $initialMenuTextHoverColor ) ) { ?>
header.underline-hover #headerfirststate .navigation:not(.catmenu) ul > li hr {  
	background-color:  <?php echo esc_attr( $initialMenuTextHoverColor ); ?>;
}
<?php } ?>
/* Submenu */

<?php if ( ! empty( $submenubgcolor ) ) { ?>
header .navigation li div.menu-item-wrapper,
header .navigation li ul {
	background-color : <?php echo esc_attr( $submenubgcolor ); ?>;
}
<?php } ?>

<?php if ( ! empty( $submenuTextColor ) ) { ?>

header .navigation li.mega-menu-parent > .menu-item-wrapper > ul > li.special-last-child > ul > li:last-of-type:before, header .navigation li li > a,
#kt-header.type0 .navigation.catmenu li li > a {
	color : <?php echo esc_attr( $submenuTextColor ); ?>;
}

header .navigation > ul > li:not(.mega-menu-parent) li.menu-item-has-children:before,
header .navigation > ul > li:not(.mega-menu-parent) li.menu-item-has-children:after {
	background : <?php echo esc_attr( $submenuTextColor ); ?>;
}

header.submenu_underlined .navigation ul li li > a span:not(.icon) span.menu_title:before {
	background-color : <?php echo esc_attr( $submenuTextColor ); ?>;
}

<?php } ?>

<?php if ( ! empty( $submenuHeadingColor ) ) { ?>
header .navigation li.mega-menu-parent div > ul > li.menu-item-has-children > a,
header .navigation li.mega-menu-parent div > ul > li:not(.menu-item-has-children) > a,
#kt-header.type0 .navigation.catmenu li.mega-menu-parent div > ul > li.menu-item-has-children > a {
	color : <?php echo esc_attr( $submenuHeadingColor ); ?>;
}
header.submenu_underlined .navigation li li > a:before,
header .navigation li.mega-menu-parent li ul li.bottom-line:before,
header .navigation li.mega-menu-parent div > ul > li.menu-item-has-children > a:after {
	background-color : <?php echo esc_attr( $submenuHeadingColor ); ?>;
}

<?php } ?>
<?php if ( ! empty( $menuTextColor ) ) { ?>
header .search-button, aside.vertical_menu_area .search-button ,
header .navigation > ul > li > a , .vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li a {
	color: <?php echo esc_attr( $menuTextColor ); ?>;
}
<?php } ?>
<?php if ( ! empty( $menuTextHoverColor ) ) { ?>
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li a:hover,
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li.active a.mp-back ,
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li.active > a {
	color: <?php echo esc_attr( $menuTextHoverColor ); ?> !important;
}
<?php } ?>
#headerfirststate .menubgcolor,
#mobile-header, #mobile-header_secondstate
{
	background-color: <?php echo esc_attr( $initialMenuBgColor ); ?>;
}
<?php if ( ! empty( $MenuHoverColor ) ) { ?>
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li:hover,
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li.active {
	background-color: <?php echo esc_attr( $MenuHoverColor ); ?> !important;
}
header .navigation > ul > li .spanhover{ 
	background-color:<?php echo esc_attr( $MenuHoverColor ); ?>;
}
header .navigation > ul > li:hover .spanhover { 
	background-color:<?php echo esc_attr( $MenuHoverColor ); ?> !important;
}
header.borderhover .navigation:not(.catmenu) > ul > li > a:before,
header.borderhover .navigation:not(.catmenu) > ul > li.active > a:before,
header.borderhover .navigation:not(.catmenu) > ul > li.current_page_item > a:before,
header.borderhover .navigation:not(.catmenu) > ul > li.current-menu-ancestor > a:before {
	background-color:<?php echo esc_attr( $MenuHoverColor ); ?>;
}
<?php } ?>
.humburger_menu_enabled .humburger_menu_area .vertical_menu_navigation a,
#headerfirststate .search-button,
#headerfirststate .navigation > ul > li > a {
	color: <?php echo esc_attr( $initialMenuTextColor ); ?>;
}
<?php if ( ! empty( $initialMenuHoverColor ) ) { ?> 
header #headerfirststate .navigation > ul > li .spanhover  {
	background-color:<?php echo esc_attr( $initialMenuHoverColor ); ?> !important;
}
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li > a:before,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.active > a:before,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.current_page_item > a:before,
header.borderhover #headerfirststate .navigation:not(.catmenu) > ul > li.current-menu-ancestor > a:before {
	background-color:<?php echo esc_attr( $initialMenuHoverColor ); ?>;
}
<?php } ?>

<?php if ( ! empty( $initialMenuColorHover ) ) { ?> 
.humburger_menu_enabled .humburger_menu_area .vertical_menu_navigation li.current-menu-ancestor .current-menu-item > a,
.humburger_menu_enabled .humburger_menu_area .vertical_menu_navigation li  > a:hover  {
	color:<?php echo esc_attr( $initialMenuColorHover ); ?> !important;
}
.humburger_menu_enabled .humburger_menu_area .vertical_menu_navigation li  > a:after{
	background-color:<?php echo esc_attr( $initialMenuColorHover ); ?>;
}
<?php } ?>

/* Anchor */
a{ color:<?php echo esc_attr( $lc ); ?>; }
a.cat_link:hover{ color:<?php echo esc_attr( $lc ); ?>; }
a:hover{ color:<?php echo esc_attr( $lhc ); ?>; }

/* Text Selection */
::-moz-selection { background: <?php echo esc_attr( $hc ); ?>; /* Firefox */ }
::selection { background: <?php echo esc_attr( $hc ); ?>; /* Safari */ }


.search-inputwrapper .searchicon,
#mobile-header:not(.kt-elementor-template) .allcats,
#mobile-header_secondstate .allcats,
.woocommerce #content input.button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce-page #content input.button,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce.single-product .nice-select ul.list li:first-child:hover,
.woocommerce a.button,.woocommerce-page a.button,
.woocommerce a.button.alt,.woocommerce-page a.button.alt,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce input.button#place_order,
.product.woocommerce.add_to_cart_inline a.added_to_cart,
#kt-modal.shown a[rel="next"]:hover,
#kt-modal.shown a[rel="prev"]:hover,
.widget.widget_woocommerce-wishlist a span.wishlist_items_number,
.vertical_menu_enabled .vertical_menu_area .widget.widget_woocommerce-dropdown-cart .cartcontentscount,
.woocommerce div.products div.product a.added_to_cart, 
.woocommerce.single-product .nice-select ul.list li:first-child:hover,
#prev-product a[rel="next"]:hover,
#next-product a[rel="prev"]:hover,
.masonryblog .swiper-button-prev:hover:after,
.masonryblog .swiper-button-next:hover:after,
.masonryblog .swiper-button-prev:hover:before,
.masonryblog .swiper-button-next:hover:before,
.progress_bar .progressbar_percent:after,
.progress_bar .progressbar_percent,
.post-meta .hr-extra-small.hr-margin-small,
.touchevents #comment-text .button.button-large,
#comment-text .button.button-large:hover,
.touchevents .woocommerce #commentform .button.button-large,
.woocommerce #commentform .button.button-large:hover,
.testimonials .quot-icon,
.tabletblog .moretag:hover,
.custom-title .shape-container .hover-line,
.lazy-load-hover-container:before, .lazy-load-hover-container:after,
.widget.widget_woocommerce-dropdown-cart li .qbutton.chckoutbtn,
header .widget.widget_woocommerce-dropdown-cart .cart-contents .cartcontentscount,
.woocommerce form.register input.button,
.woocommerce form.login input.button,
.woocommerce form.login input.button:hover,
.woocommerce form.register input.button:hover,
.woocommerce button.button.alt,
.widget-area .product-categories li.cat-item.current-cat > a:before,
#kt-modal .woocommerce #customer_login a.register-link:before,
.galleryexternallink,
.kt-popup-newsletter-shortcode .widget_wysija_cont .wysija-submit ,
.buttonwrapper .kt_button:hover,
#header.shoppage .cats-toggle:hover:after,
#header.shoppage .cats-toggle:hover:before,
#mobilenavbar .navicons .shop-cart-icon .cartcontentscount,
.wc_payment_method input[type='radio']:checked:before,
form#commentform .kt_button:hover,
.not_found_page .search-form form .searchicon:hover ,
.wp-block-button__link:hover,
#wp-calendar td:not(.pad):not(#prev):not(#next):hover,
#wp-calendar td#prev a:hover,
#wp-calendar td#next a:hover,
.not_found_page div#search_box div.widget_area_display.searchicon span:hover,
.no-result-search-box input[type="submit"]:hover,
#kt-modal.sort-modal #modal-content ul.list li.current{
	background-color: <?php echo esc_attr( $acc ); ?>;
}
.humburger_menu_enabled .widget.widget_woocommerce-dropdown-cart .cartcontentscount,
header .widget.widget_woocommerce-dropdown-cart .cartcontentscount,
.nice-select .option:hover,
.woocommerce .cartempty .woocommerce-message a.restore-item:hover,
.woocommerce .return-to-shop .button.wc-backward:hover,
table.compare-list .add-to-cart td a:hover,
.sidebar .widget_shopping_cart_content a.checkout.wc-forward.button,
.widget_shopping_cart_content a.wc-forward.button,
.nice-select .option:hover,
.wpb_toggle.wpb_toggle_title_active:after, 
#content h4.wpb_toggle.wpb_toggle_title_active:after,
.togglesidebar.cart-sidebar-container .cart-bottom-box .buttons a.checkout,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.upsells):not(.infoonhover):not(.instantshop):not(.listview):not(.list_view) div.product span.product-button a,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.upsells):not(.infoonhover):not(.instantshop):not(.listview):not(.list_view):not(.infoonclick) div.product a.add_to_cart_button:hover,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.upsells):not(.infoonhover):not(.instantshop):not(.listview):not(.list_view) div.product span.product-button:hover .txt,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.upsells):not(.infoonhover):not(.instantshop):not(.listview):not(.list_view) div.product.add-to-cart-hovered span.product-button .txt,

.woocommerce div.products:not(.modern-buttons-on-hover):not(.instantshop):not(.upsells):not(.infoonclick):not(.listview):not(.list_view) div.product a.product_type_variable:hover,
.woocommerce div.products.list_view div.product .addtocartbutton,
.woocommerce .progress-fill,
.select2-container--default .select2-results__option--highlighted[aria-selected], 
.select2-container--default .select2-results__option--highlighted[data-selected],
.swiper-pagination-bullet-active
{
	background-color: <?php echo esc_attr( $acc );?>!important;
}
header .logo-title h5,
.project-detail li:last-child .project-subtitle a:hover,
.star-rating span, .star-rating span,
.widget-area .product-categories li.current-cat > a,
.widget-area .product-subcategories li.current-cat > a,
table.compare-list .price td .amount,
div.product .product-buttons .compare.button:hover:before,
table.compare-list td ins .amount,
table.compare-list .stock td span,
.product_meta> span a:hover,
.widget_ranged_price_filter li.current ,.widget_ranged_price_filter li.current a,
.widget_order_by_filter li.current, .widget_order_by_filter li.current a,
.woocommerce div.products div.product a:hover h3,
.woocommerce .widget_shopping_cart .total .amount, .woocommerce.widget_shopping_cart .total .amount,
.woocommerce ul.cart_list li .quantity, .woocommerce ul.product_list_widget li .quantity,
ul.cart_list li .amount, .woocommerce ul.cart_list li .amount, ul.product_list_widget li .amount,.woocommerce ul.product_list_widget li .amount,
.woocommerce form .form-row .required,
.woocommerce table.shop_table tfoot td, 
.woocommerce div.product form.cart table.group_table label a:hover,
.kt-newsletter:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
#respond-wrap  .graylabel.inputfocus , #respond .graylabel.inputfocus , #review_form .graylabel.inputfocus,
#respond-wrap .label.inputfocus ,
#respond .label.inputfocus , 
#review_form  .label.inputfocus,
.search-item .count,
.pagenavigation .more-link-arrow:hover,
.sticky .accordion_box10 .blogtitle , .sticky .accordion_box2 .accordion_title,
.navigation-mobile a:hover,
.widget_product_tag_cloud.collapse .show_more_tags:hover,
.widget_product_tag_cloud.collapse .show_more_tags:hover:before,
.widget_layered_nav.widget.collapse .show_more_items:hover,
.widget_layered_nav.widget.collapse .show_more_items:hover:before,
.widget_product_categories.collapse .show_more_items:hover,
.widget_product_categories.collapse .show_more_items:hover:before,
.widget_product_categories .cats-toggle:hover,
.vertical_menu_navigation .cats-toggle:hover,
.vertical_menu_navigation .cats-toggle.toggle-active,
.widget_product_categories .cats-toggle.toggle-active,
.footer-widgetized .product-categories li.current-cat > a,
.kt-popup-newsletter-content p.kt-popup-newsletter-text a,
form.woocommerce-currency-switcher-form .dd-option .dd-option-text:hover,
.searchitemdesc .woocommerce-Price-amount,
.kt_button.link_style:hover ,
#header.shoppage ul.cat-display li a:hover .product-category,
.wc_payment_method input[type=radio]:checked + label,
#kt-modal.sort-modal #modal-content ul.list li.current ,
.widget-area .widget_categories li a:hover,
.widget-area .widget_pages li a:hover,
.widget-area .widget_rss .rsswidget:hover,
.widget-area .widget_nav_menu li a:hover,
.widget-area .widget_meta li:hover,
.widget-area .widget_meta li a:hover,
.widget-area .widget_recent_comments li a:hover,
.widget-area .widget_recent_entries li a span.title:hover,
.elementor-widget-wp-widget-recent-posts li a span.title:hover,
.widget-area .widget_archive li:hover a,
.woocommerce .customer-login form.login .lost_password a:hover,
#kt-modal .woocommerce #customer_login .register-link:hover,	
.elementor-widget-kite-theme-select .option:hover a,
.elementor-widget-kite-theme-select .option:hover .element-icon
{
	color: <?php echo esc_attr( $acc ); ?>;
}
.woocommerce div.products.list_view div.product .product-buttons a.compare:hover,
.woocommerce div.products.list_view div.product .product-buttons .yith-wcwl-add-to-wishlist a:hover,
.woocommerce div.products.list_view div.product .product-buttons .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover:before,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.listview):not(.infoonclick):not(.infoonhover):not(.instantshop) div.product:hover span a:hover,
.woocommerce div.products:not(.listview) div.product:hover span:hover a:not(.cat_link), 
.woocommerce-page div.products div.product:hover span.product-button ~ span:hover a,
.woocommerce div.products:not(.listview) div.product:hover span:hover a:not(.cat_link),
.woocommerce div.products:not(.listview) div.product:hover span:hover a:not(.cat_link), 
.woocommerce-page div.products div.product:hover span.product-button ~ span:hover a,
#header.shoppage ul.cat-display-image div.product-category a:hover h2,
#header.shoppage ul.cat-display-image li.product-category a:hover h2,
.woocommerce div.products div.product .price ins, .woocommerce-page div.products div.product .price ins,
.woocommerce div.products:not(.modern-buttons-on-hover):not(.upsells):not(.infoonclick):not(.infoonhover) div.product:not(.product-type-simple) .price .woocs_price_code > span.amount:nth-child(1), 
.product-buttons .shop_wishlist_button.wishlist-link:before,
.woocommerce.wc-shortcode .single_deal_count_down_timer .countdown-timer .time-block .seconds,
.countdown-timer.secondstyle .time-block span.number.seconds,
.woocommerce .woocommerce-error a, .woocommerce .woocommerce-info a,
.woocommerce p.stars.selected a:not(.active):before,
.woocommerce p.stars.selected a.active:before, .woocommerce p.stars:hover a:before,
.woocommerce .woocommerce-breadcrumb a:hover,
.page-breadcrumb .woocommerce-breadcrumb a:hover,
.category-menu-container .allcats,
.wpb_toggle.wpb_toggle_title_active .title,
.vc_tta-tab.vc_active a span,
.vc_tta-tab:hover a span,
.vc_tta-tab:hover .vc_tta-icon,
.vc_tta-tab.vc_active .vc_tta-icon,
.vc_tta-accordion .vc_tta-panel:hover span.vc_tta-title-text:after,
.vc_tta-accordion .vc_tta-panel.vc_active span.vc_tta-title-text:after,
.vc_tta-accordion .vc_tta-panel:hover .vc_tta-icon,
.vc_tta-accordion .vc_tta-panel:hover  span.vc_tta-title-text,
.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-icon ,
.vc_tta-accordion .vc_tta-panel.vc_active  span.vc_tta-title-text,
.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover,
.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover,
.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
.yith-wcwl-wishlistaddedbrowse:before, .yith-wcwl-wishlistexistsbrowse:before,
.yith-wcwl-wishlistaddedbrowse:hover,
.lang-sel ul.lang_link > li:hover a,
#header.shoppage ul.cat-display-sub li.cat-item.current-cat> a,
#header.shoppage ul.cat-display-sub li.cat-item.current-cat-parent> a,
#header.shoppage ul.cat-display-sub li.cat-item .items> a:hover,
#header.shoppage ul.cat-display-sub li ul.children li.cat-item a:hover,
.comment-meta .author_name a:hover,
.is-style-outline .wp-block-button__link:hover
{
	color: <?php echo esc_attr( $acc ); ?> !important;
}
.kt-newsletter:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
.widget-area .product-categories li.cat-item.current-cat > a:before,
.widget-area .product-categories li.cat-item a:hover:before,
.widget-area .product-categories li.cat-item a:hover:before,
.galleryexternallink,
form#commentform .kt_button:hover,
.buttonwrapper .kt_button:hover, .buttonwrapper .kt_button.transparent:hover,
.woocommerce .wc-ajax-content .woocommerce-info a:hover ,
.is-style-outline .wp-block-button__link:hover,
.not_found_page .search-form form .searchicon:hover {
	border-color:<?php echo esc_attr( $acc ); ?>;
}
.woocommerce .blockUI.blockOverlay:after,
.woocommerce .loader:after,
table.compare-list .remove td .blockUI.blockOverlay:after,
.woocommerce .yith-woocompare-widget .products-list .blockUI.blockOverlay:after,
.woocommerce #respond input#submit.loading:after,
.woocommerce button.button.loading:after,
.woocommerce input.button.loading:after,
.woocommerce a.addcartbutton.loading:after,
.woocommerce a.button.loading:after,
.wc-loading:after,
.mejs-overlay-loading:after {
	border-right-color : <?php echo esc_attr( $acc ); ?>;
}
.sticky .blogaccordion .rightBorder {
	border-right-color:<?php echo esc_attr( $acc ); ?> !important;
}
.testimonials .quot-icon:before,
.testimonials:after,
.testimonials:before,
.vc_tta-tabs-position-bottom li.vc_tta-tab:hover,
.vc_tta-tabs-position-bottom li.vc_tta-tab.vc_active,
.kt_button.link_style:after{
	border-top-color: <?php echo esc_attr( $acc ); ?>;
}
.woocommerce form.login input.input-text:focus,
.woocommerce form.register input.input-text:focus,
.testimonials .quot-icon:after,
.testimonials .quot-icon:before,
.vc_tta-tabs-position-left li.vc_tta-tab.vc_active,
.vc_tta-tabs-position-right li.vc_tta-tab.vc_active,
.vc_tta-tabs-position-top li.vc_tta-tab.vc_active,
.vc_tta-tabs-position-top li.vc_tta-tab.vc_active:hover,
.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading,
.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading,
.wpb-js-composer .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading,
.wpb-js-composer .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading,
.custom-title .shape-container.triangle .shape-line, 
.custom-title .shape-container.triangle .shape-line:after, 
.custom-title .shape-container.triangle .shape-line:before {
	border-bottom-color:<?php echo esc_attr( $acc ); ?>;
}
.loading-next-page,
.wpb_heading,
.testimonials .quot-icon:before,
.textLeftBorder.fontsize123 .title,
.textLeftBorder .title {
	border-left-color : <?php echo esc_attr( $acc ); ?>;
}
#comment-text .button.button-large:hover,
.touchevents #comment-text .button.button-large,
.touchevents .woocommerce #commentform .button.button-large,
.woocommerce #commentform .button.button-large:hover,
.woocommerce .return-to-shop .button.wc-backward:hover,
.woocommerce .cartempty .woocommerce-message a.restore-item:hover,
.woocommerce .widget_layered_nav ul.imagelist li.chosen a img,
.tabletblog .moretag:hover,
.custom-title .shape-container.square .shape-line ,
.custom-title .shape-container.rotated_square .shape-line , 
.custom-title .shape-container.circle .shape-line{
	border-color:<?php echo esc_attr( $acc ); ?>!important;
}

/* topbar */
#topbar,.mobile-topbar  {
	background-color: <?php echo esc_attr( $topbar_bg_color ); ?>
}

#topbar {
	border-bottom-color: <?php echo esc_attr( $topbar_border_color ); ?>
}

/* preloader */
#preloader {
	background-color: <?php echo esc_attr( $preloader_bg_color ); ?>
}

#preloader .ball {
	background:<?php echo esc_attr( $preloader_color ); ?>;
}

.preloader_circular .path {
	stroke:<?php echo esc_attr( $preloader_color ); ?>;
}

#preloader-simple .rect {
	stroke:<?php echo esc_attr( $preloader_color ); ?>;
}

#preloader_box .rect {
	stroke:<?php echo esc_attr( $preloader_color ); ?>;
}

#preloader_box {
	background: <?php echo esc_attr( $preloader_box_color ); ?>
}
.preloader-text {
	color: <?php echo esc_attr( $preloader_text_color ); ?>
}

<?php
$footerwidgetbanner = kite_opt( 'footer-widget-banner' );

if ( $footerwidgetbanner != '' ) {
	?>

.footer-widgetized .section-container {
	background: 
	<?php
	if ( $footerwidgetbanner ) {
		?>
		 url(<?php echo esc_url( $footerwidgetbanner ); ?>) repeat bottom center <?php } ?> !important;
	background-size: cover !important;
}

	<?php
}
$footerwidgetBgColor = kite_opt( 'footer-widget-color' );
if ( $footerwidgetBgColor != '' ) {
	?>
.footer-widgetized .section-container:before {
	background-color: <?php echo esc_attr( $footerwidgetBgColor ); ?>;
	content : "";
	position:absolute;
	width:100%;
	height:100%;
	top:0;
	left:0;
	z-index:0;
}
<?php } ?>



/*######## Set font ########*/

/* General font */
<?php
$navFontType       = kite_opt( 'font-navigation-type', 'default' );
$navFont           = kite_opt( 'font-navigation' );
$navCustomFontUrl  = kite_opt( 'custom-font-url-navigation' );
$navCustomFontName = kite_opt( 'custom-font-name-navigation' );
?>

/* Navigation Font */

<?php if ( $navFontType !== 'default' ) { ?>
.topbar_wishlist .wishlist_text,
.topbar_lang_flag .lang-sel a,
.topbar_currency .currency-sel a,
header .navigation > ul > li li > a span.menu_title_wrap,
header .navigation > ul > li > a,
.menu-list a span,
.humburger_menu_enabled .humburger_menu_area .vertical_menu_navigation a,
header .search-inputwrapper .searchelements.light .nice-select.searchcats .current,
#kt-header.type0 .container .allcats,
header .navigation li.mega-menu-parent div > ul > li.menu-item-has-children > a {
	<?php
	if ( $navFontType == 'google' ) {
		?>
		font-family:'<?php echo esc_html( $navFont ); ?>', sans-serif;
		<?php
	} else // custom font
	{
		?>
		font-family:<?php echo esc_attr( $navCustomFontName ); ?>;
		<?php
	}
	?>
}

	<?php
}

$socialcolor1 = kite_opt( 'social_custom1_color' );
if ( kite_opt( 'social_custom1_color' ) ) {
	?>
.sociallink-shortcode.custom1 a:before{
	background: <?php echo esc_attr( $socialcolor1 ); ?>
}

	<?php
}

$socialcolor2 = kite_opt( 'social_custom2_color' );
if ( kite_opt( 'social_custom2_color' ) ) {
	?>
.sociallink-shortcode.custom2 a:before{
	background: <?php echo esc_attr( $socialcolor2 ); ?>
}
	<?php
}

$socialLogo1 = kite_opt( 'social_custom1_image' );
$socialLogo2 = kite_opt( 'social_custom2_image' );
?>

<?php
if ( $socialLogo1 != '' ) {
	?>
span.icon.icon-custom1{
	background-image: url("<?php echo esc_url( $socialLogo1 ); ?>");
}
	<?php
}

if ( $socialLogo1 != '' ) {
	?>
span.icon.icon-custom2{
	background-image: url("<?php echo esc_url( $socialLogo2 ); ?>");
}
	<?php
}
?>

/* Snap to scroll */
#snap-to-scroll-nav span:after {
	background:<?php echo esc_attr( $acc ); ?>;
}

.swiper-pagination-bullet-active {
	background: <?php echo esc_attr( $acc ); ?> !important;
}


/*######## Style Overrides ########*/

<?php kite_eopt( 'additional-css' ); ?>
/*
.search-inputwrapper .searchelements.focus + .searchicon{
	box-shadow: 0px 3px 10px 0px  <?php echo esc_attr( $acc ); ?>;
}
*/
#kt-popup-newsletter .kt-newsletter:not(.remove-kt-style) form.mailpoet_form:not(.mailpoet_form_sending) .mailpoet_submit:hover,
#kt-popup-newsletter .kt-newsletter:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
#kt-popup-newsletter .kt-newsletter:not(.remove-kt-style) .mc4wp-form input[type="submit"]:hover,
.kt-newsletter.style1:not(.remove-kt-style) form.mailpoet_form:not(.mailpoet_form_sending) .mailpoet_submit:hover,
.kt-newsletter.style1:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
.kt-newsletter.style1:not(.remove-kt-style) .mc4wp-form input[type="submit"]:hover,
.kt-newsletter.style2:not(.remove-kt-style) form.mailpoet_form:not(.mailpoet_form_sending) .mailpoet_submit:hover,
.kt-newsletter.style2:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
.kt-newsletter.style2:not(.remove-kt-style) .mc4wp-form input[type="submit"]:hover {
	background-color: <?php echo esc_attr( $acc ); ?> !important;
	border: 2px solid <?php echo esc_attr( $acc ); ?> !important;
}
.kt-newsletter.style3:not(.remove-kt-style) .mailpoet_form .mailpoet_submit,
.kt-newsletter.style3:not(.remove-kt-style) .mc4wp-form input[type="submit"],
.kt-newsletter.style3:not(.remove-kt-style) .widget_wysija_cont .wysija-submit {
	background-color: <?php echo esc_attr( $acc ); ?>;
	border: 2px solid <?php echo esc_attr( $acc ); ?>;
}
.kt-newsletter.style3:not(.remove-kt-style) form.mailpoet_form:not(.mailpoet_form_sending) .mailpoet_submit:hover,
.kt-newsletter.style3:not(.remove-kt-style) .widget_wysija_cont .wysija-submit:hover,
.kt-newsletter.style3:not(.remove-kt-style) .mc4wp-form input[type="submit"]:hover {
	background-color: transparent;
	color: <?php echo esc_attr( $acc ); ?>;
	border: 2px solid <?php echo esc_attr( $acc ); ?>;
}
<?php
?>


<?php
if ( ! kite_opt( 'rating_in_woocommerce_product_widget', true ) ) {
	?>
.woocommerce.widget_products ul.product_list_widget li .star-rating {
	display:none !important;
}
<?php } ?>

<?php
$element_on_accent_color_style_is_light = kite_get_meta( 'kt-page-has-custom-color' ) ? kite_get_meta( 'element-on-accent-color-style' ) : kite_opt( 'element-on-accent-color-style', true ); 
if ( ! $element_on_accent_color_style_is_light  ) { ?>
header .search-inputwrapper .searchicon span.icon,
#kt-header .cart-sidebarbtn .cartcontentscount,
.woocommerce div.product .summary.entry-summary .progress-bar .progress-fill,
.woocommerce.wc-shortcode .progress-bar .progress-fill,
.woocommerce .cart .button.alt.single_add_to_cart_button,
form.wpcf7-form input[type="submit"]:hover,
form.wpcf7-form.style2 input[type="submit"]:hover,
form.wpcf7-form.style3 input[type="submit"],
.woocommerce .cart .button.alt.single_add_to_cart_button .icon,
.woocommerce div.products:not(.infoonhover) div.product:not(.dark) a .icon,
.woocommerce div.products:not(.infoonhover) div.product:not(.dark) span.product-button:hover .txt,
.woocommerce div.products.buttonsonhover:not(.list_view) div.product:not(.dark):hover .product-buttons span a:not(.adding):hover:before,
.woocommerce div.products:not(.infoonhover) div.product:not(.dark) span.product-button .txt,
.woocommerce div.products.instantshop div.product .quick-view a,
.banner a.kt_button:hover,
.buttonwrapper .kt_button:hover,
.banner a:hover span,
.woocommerce div.products.list_view div.product .addtocartbutton .txt,
#mobile-header:not(.kt-elementor-template) .allcats ,
#mobile-header_secondstate .allcats,
header#kt-header .shop-cart-icon .cart-sidebarbtn.widget.widget_woocommerce-dropdown-cart .cart-contents .cartcontentscount,
.search-inputwrapper .searchicon,
.togglesidebar.cart-sidebar-container .cart-bottom-box .buttons a.checkout,
.woocommerce .shop-filter .special-filter .widget.widget_product_categories .nice-select ul.list li:hover a,
.woocommerce .shop-filter .special-filter .widget.widget_product_sorting .nice-select ul.list li:hover a,
.nice-select.orderby ul.list li:hover a,
.cblog .post-categories a:hover,
.woocommerce div.products.modern-buttons-on-hover div.product.separated-cart .product-button a .icon:before,
.woocommerce div.products.modern-buttons-on-hover div.product.separated-cart .product-button a .txt,
.product-button .kt-tooltip,
.vertical-buttons.separated-cart .product-button .kt-tooltip,
.kt-header-button .kt-icon-container .kt-badge,
#kt-modal.sort-modal #modal-content ul.list li.current,
.woocommerce .wc-proceed-to-checkout a.checkout-button,
.widget_shopping_cart_content a.checkout.wc-forward.button,
.woocommerce .sidebar .widget_shopping_cart_content a.checkout.wc-forward.button,
.woocommerce div.products.buttonsappearunder div.product .product-buttons > span:not(.product-button) a:hover:before,
.togglesidebar.cart-sidebar-container .cart-bottom-box .buttons a.checkout,
.woocommerce form.login input.button {
	color: #25252D !important;
}
<?php } else { ?>
#kt-header.type0 .search-inputwrapper .searchicon span.icon,
.kt-header-button .kt-icon-container .kt-badge,
.product-button .kt-tooltip,
.vertical-buttons.separated-cart .product-button .kt-tooltip,
.woocommerce div.products.modern-buttons-on-hover div.product.separated-cart .product-button .icon,
.woocommerce div.products.modern-buttons-on-hover div.product.separated-cart .product-button .icon:before,
.woocommerce div.products.modern-buttons-on-hover div.product.separated-cart .add_to_cart_btn_wrap span.product-button .txt,
.woocommerce .wc-proceed-to-checkout a.checkout-button,
.woocommerce div.products.buttonsappearunder div.product .product-buttons > span:not(.product-button) a:hover:before,
.togglesidebar.cart-sidebar-container .cart-bottom-box .buttons a.checkout,
.woocommerce form.login input.button {
	color: #fafafa !important;
}
<?php } ?>
<?php
$notice_bg_color = ( kite_opt( 'threshold_notice_background_color' ) ? : '#33d117' );
$notice_text_color = ( kite_opt( 'threshold_notice_text_color' ) ? : '#ffffff' );
$notice_progress_bg_color = ( kite_opt( 'threshold_notice_progress_background_color' ) ? : '#f4524d'); 
?>
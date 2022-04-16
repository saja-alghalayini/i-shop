<?php
$classes = array();
if ( ! kite_opt( 'topbar_style', false ) ) {
	$classes[] = 'dark';
}
if ( kite_opt( 'topbar-language-link-1' ) || kite_opt( 'topbar-language-link-2' ) || kite_opt( 'topbar-language-link-3' ) || kite_opt( 'topbar-language-link-4' ) ) {
	$classes[] = 'haslang';
	$has_lang = true;
} else {
	$has_lang = false;
}
if ( kite_woocommerce_installed() && class_exists( 'WOOCS' ) && kite_opt( 'topbar_currency_shortcode', '[woocs show_flags=0 flag_position="left"]' ) ) {
	$classes[] = 'has-currency';
}

$search_post_type    = kite_opt( 'search_post_type', 'product' );
$search_place_holder = esc_attr__( 'Search Posts', 'teta-lite' );
if ( ! $search_post_type ) { // set on product when update theme
	$search_post_type = 'product';
}
if ( ! $search_post_type || $search_post_type == 'product' ) {
	$search_place_holder = esc_attr__( 'Search Products', 'teta-lite' );
}

$search     = kite_opt( 'menu-search', true );
$search_style = kite_opt( 'searchbox-style', false ) == 1 ? 'dark' : 'light';


$headerType = kite_opt( 'header-type', '1' );
$headerStyle = kite_opt( 'mobile_header_style', false ) == 1 ? 'dark' : 'light';

// responsive logo
$responsivelogo = kite_opt( 'responsivelogo' );
$logo           = kite_opt( 'logo','' );

$location = has_nav_menu( 'mobile-nav' ) ? 'mobile-nav' : ( has_nav_menu( 'primary-nav' ) ? 'primary-nav' : '' );

$cat_args = array(
	'orderby'    => 'term_id',
	'order'      => 'ASC',
	'hide_empty' => false,
);
$terms = (  $search_post_type == 'product' && kite_woocommerce_installed() ) ? get_terms( 'product_cat', $cat_args ) : get_terms( 'category', $cat_args );
if ( kite_opt( 'search_form_hide_subcategories', false ) ) {
	foreach( $terms as $key => $term ) {
		if ( $term->parent ) {
			unset( $terms[$key] );
		}
	}
}
if ( kite_opt( 'topbar_display', false ) == 1 ) {
?>
<div class="mobile-topbar hidden-desktop <?php echo implode( ' ', $classes ); ?>" >
	<?php if ( $has_lang ) { ?>
		<div class="topbar_lang_flag">
  			<div class="lang-sel">
				<?php if ( kite_opt( 'topbar-language-link-1' ) ) { ?>
					<span id="mobile-language1">
						<a href="<?php echo esc_url( kite_opt( 'topbar-language-link-1' ) ); ?>"><?php kite_eopt( 'topbar-language-1' ); ?></a>
					</span>
				<?php } ?>
	   
				<ul class="lang_link">
				<?php if ( kite_opt( 'topbar-language-link-2' ) ) { ?>
					<li id="mobile-language2">
						<a href="<?php echo esc_url( kite_opt( 'topbar-language-link-2' ) ); ?>"><?php kite_eopt( 'topbar-language-2' ); ?></a>
					</li>
				<?php } ?>
				<?php if ( kite_opt( 'topbar-language-link-3' ) ) { ?>
					<li id="mobile-language3">
						<a href="<?php echo esc_url( kite_opt( 'topbar-language-link-3' ) ); ?>"><?php kite_eopt( 'topbar-language-3' ); ?></a>
					</li>
				<?php } ?>
				<?php if ( kite_opt( 'topbar-language-link-4' ) ) { ?>
					<li id="mobile-language4">
						<a href="<?php echo esc_url( kite_opt( 'topbar-language-link-4' ) ); ?>"><?php kite_eopt( 'topbar-language-4' ); ?></a>
					</li>
				<?php } ?>
				</ul>
  			</div>
		</div>
	<?php } ?>
	<?php if ( kite_woocommerce_installed() && class_exists( 'WOOCS' ) && kite_opt( 'topbar_currency_shortcode', '[woocs show_flags=0 flag_position="left"]' ) ) { ?>
	<div class="topbar_currency">
		<?php echo do_shortcode( kite_opt( 'topbar_currency_shortcode', '[woocs show_flags=0 flag_position="left"]' ) ); ?> 
	</div>
	<?php } ?>
</div>
<?php } ?>
<div id="mobile-header" class="hidden-desktop <?php echo esc_attr( $headerStyle ); if ( $search == 1 ) { ?> has_search<?php } ?> <?php if ( has_nav_menu( 'category-nav' ) && ( function_exists( 'is_shop' ) && ! is_shop() ) ) { ?>has-cat-menu <?php } ?> <?php	if ( $headerType ) { echo 'style2';} ?>	">
	<div class="mobilelogo">
	<?php if ( ! empty( $logo ) ) { ?>
		<a class="locallink logo" href="<?php echo esc_url( home_url() ); ?>#home">
			<?php if ( $responsivelogo != '' ) { ?>
				<img  class="firstLogo responsivelogo hidden-desktop" src="<?php echo esc_url( $responsivelogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
			<?php } ?>
			<img  class="firstLogo" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
		</a>
		<a class="externallink logo" href="<?php echo esc_url( home_url() ); ?>">
			<?php if ( $responsivelogo != '' ) { ?>
				<img  class="firstLogo responsivelogo hidden-desktop" src="<?php echo esc_url( $responsivelogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
			<?php } ?>
			<img  class="firstLogo" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
		</a>
	<?php } else {
		echo "<div class='logo-title'><a href='" . home_url() . "' ><h5>" . get_bloginfo( 'name' ) . "</h5></a></div>";
	} ?>
	</div>
	<?php
	$mobile_menu_color = kite_opt( 'mobile_menu-color', false );	
	if ( has_nav_menu( $location ) ) {
	?>
	<div class="mobile-nav-button mobilenavbutton hidden-desktop no_djax">
		<a href="#">
			<span class="icon icon-circle2"></span>
			<span class="icon icon-circle2"></span>
			<span class="icon icon-circle2"></span>
		</a>
	</div>
	<?php } ?>
	<div class="mobile-header-buttons">
		<?php
		// Check if WooCommerce is active
		if ( kite_woocommerce_installed() && kite_opt( 'shop-enable-cart', true ) == 1 && ! kite_opt( 'catalog_mode', false ) ) {
		?>
			<div class="shop-cart-icon">
				<?php
				/*woocomerce drop down cart widget */
				// Because it pushes the entire content to a side, it should be placed outside of layout element
				get_template_part( 'templates/woocommerce/cart' );
				?>
			</div>
		<?php } ?>
		<?php if ( kite_woocommerce_installed() && class_exists( 'YITH_WCWL' ) && kite_opt( 'header-wishlist-display', true ) == 1 && kite_opt( 'responsive-wishlist-display', false ) == 1 && ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) ) { ?>
			<div class="mobile-wishlist">
				<?php the_widget( 'Kite_Woocommerce_Wishlist_Icon_Widget' ); ?>
			</div>
		<?php } ?>
		<?php if ( kite_woocommerce_installed() && kite_opt( 'shop-login-link', true ) == 1 ) { ?>

			<div class="topbar_login_link">
				<div class="topbar_login">
					<div class="topbar_login_text ">
						<?php echo kite_get_myaccount_link( false ); ?>
					</div>
					<?php if ( is_user_logged_in() && kite_woocommerce_installed() ) { ?>
						<ul  class="topbar_login-content">
							<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
								<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
									<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>               
					<?php } ?>
				</div>
			</div> 

		<?php
		}
		if ( $search && $headerType ) {
		?>
			<div class="search_icon"><a href="#/"><span class="icon icon-search2"></span></a></div>
		<?php } ?>
	</div>
	<?php 
	if ( $headerType == 0 ) {
		if ( has_nav_menu( 'category-nav' ) && ( function_exists( 'is_shop' ) && ! is_shop() ) ) { ?>
			<div class="allcats cat-nav-button"><span class="icon icon-menu"></span></div>
		<?php } 
	} 
	if ( $headerType ) { 
		echo '<div class="responsive-whole-search-container">'; 
	}
	$search_form_args = array(
		'wrap_id'				=> 'mobile-search-input-wrapper',
		'wrap_classes'			=> 'kt-search-form-wrap search-inputwrapper search-container ' . $search_style,
		'form_classes' 			=> 'kt-search-form firststatesearchform',
		'style'					=> $search_style,
		'terms'	  				=> $terms,
		'search_place_holder' 	=> $search_place_holder,
		'search_post_type'		=> $search_post_type,
	);
	kite_generate_search_form( $search_form_args );
	if ( $headerType ) { echo '</div>'; } 
	?>
</div>
<!-- 
 -->
<?php if ( kite_woocommerce_installed() && kite_opt( 'responsive-sticky-bottom-navbar', true ) ) : ?>
<div id="mobilenavbar" class="hidden-desktop <?php if ( kite_opt( 'mobile_header_style', false ) == 1 ) echo 'dark'; ?>">
    <?php if ( is_shop() ) { ?>
    <div class="navicons"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="icon icon-home"></span><span class="title"><?php esc_html_e( 'Home', 'teta-lite' ); ?></span></a></div>
    <?php } else { ?>
    <div class="navicons"><a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><span class="icon icon-store"></span><span class="title"><?php esc_html_e( 'Shop', 'teta-lite' ); ?></span></a></div>
    <?php } ?>
    <?php if ( ( is_shop() || is_tax( array( 'product_cat', 'product_tag' ) ) ) && ( kite_opt( 'mobile_category_menu', true )) ){ ?>
	<div class="navicons productnavbutton"><a href="#/"><span class="icon icon-menu"></span><span class="title"><?php esc_html_e( 'Categories', 'teta-lite' ); ?></span></a></div>
    <?php  } elseif ( has_nav_menu( 'primary-nav' ) ) { ?>
        <div class="navicons mobilenavbutton"><a href="#/"><span class="icon icon-menu-circle"></span><span class="title"><?php esc_html_e( 'Menu', 'teta-lite' ); ?></span></a></div>
    <?php }  ?>

    <?php if ( ( is_shop() || is_tax( array( 'product_cat', 'product_tag' ) ) ) && kite_opt( 'shop-filter-sorting', true ) ) { ?>
    <div class="navicons sorting"><a href="#/"><span class="icon icon-sort-amount-desc"></span><span class="title"><?php esc_html_e( 'Sorting', 'teta-lite' ); ?></span></a></div>
    <?php } ?>
    <?php
    if ( isset( $_GET['shopFilter'] ) && ! empty( $_GET['shopFilter'] ) ) {
        if ( sanitize_text_field( $_GET['shopFilter'] ) == 'width-filter' ) {
            $shopFilter = true;
        } elseif ( sanitize_text_field( $_GET['shopFilter'] ) == 'without-filter' ) {
            $shopFilter = false;
        } else {
            $shopFilter = kite_opt( 'shop-filter', false );
        }
    } else {
        $shopFilter = kite_opt( 'shop-filter', false ) || kite_opt( 'shop-sidebar-position' , 0 ) ;
    }
    ?>
    <?php if ( ( is_shop() || is_tax( array( 'product_cat', 'product_tag' ) ) ) && $shopFilter ) { ?>
    <div class="navicons filters"><a href="#/"><span class="icon icon-funnel"></span><span class="title"><?php esc_html_e( 'Filters', 'teta-lite' ); ?></span></a></div>
    <?php } elseif ( kite_opt( 'shop-login-link', true ) == 1 ) { ?>
    <div class="navicons userAccount">
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
                <?php }	?>
            </div>
        </div> 
        <span class="title"><?php esc_html_e( 'Account', 'teta-lite' ); ?></span>
    </div>
    <?php } ?>

    <?php
    
    if ( is_singular( 'post' ) || is_home() || is_category() || is_tag() || ( function_exists('kite_has_page_blog_sidebar') && kite_has_page_blog_sidebar() ) ) { ?>
    <div class="navicons kt-sidebar">
        <a href="#/">
            <span class="icon icon-chevron-left-circle"></span>
            <span class="title"><?php esc_html_e( 'Sidebar', 'teta-lite' ); ?></span>
        </a>
    </div>
    <?php } ?>
    
    <?php if ( kite_opt( 'shop-enable-cart', true ) == 1 && ! kite_opt( 'catalog_mode', false ) ) { ?>
    <div class="navicons cart">
        <div class="shop-cart-icon">
            <?php
            /*woocomerce drop down cart widget */
            // Because it pushes the entire content to a side, it should be placed outside of layout element
            get_template_part( 'templates/woocommerce/cart' );
            ?>
        </div>
        <span class="title"><?php esc_html_e( 'Cart', 'teta-lite' ); ?></span>
    </div>
    <?php } ?>
</div>
<?php endif; ?>
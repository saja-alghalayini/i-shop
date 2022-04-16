<?php if ( has_nav_menu( 'mobile-nav' ) || has_nav_menu( 'primary-nav' ) ) { ?>
    <div class="togglesidebar toggle-sidebar-mobile-menu sidebar-menu <?php if ( kite_opt( 'mobile_menu-color', false ) == 0 ) {?>light<?php } ?>  hidden-desktop">
        <div class="mobile-menu-close-button">
            <span><?php esc_html_e( 'Navigation', 'teta-lite' ); ?></span>
            <span class="mobile-menu-icon" tabindex="0"></span>
        </div>  
        <nav class="mobile-navigation">
            <?php
            if ( has_nav_menu( 'mobile-nav' ) ) {
                wp_nav_menu(
                    array(
                        'container'      => '',
                        'menu_class'     => 'clearfix simple-menu ',
                        'before'         => '',
                        'theme_location' => 'mobile-nav',
                        'walker'         => new Kite_Nav_Walker(),
                        'fallback_cb'    => false,
                        'after'          => '',
                    )
                );
            } else {
                wp_nav_menu(
                    array(
                        'container'      => '',
                        'menu_class'     => 'clearfix simple-menu ',
                        'before'         => '',
                        'theme_location' => 'primary-nav',
                        'walker'         => new Kite_Nav_Walker(),
                        'fallback_cb'    => false,
                        'after'          => '',
                    )
                );
            }
            ?>
                 
        </nav>
    </div>
<?php } ?>
<?php if ( has_nav_menu( 'category-nav' ) ) { ?>
    <div class="togglesidebar toggle-sidebar-mobile-menu sidebar-menu categories-offcanvas <?php if ( kite_opt( 'mobile_menu-color', false ) == 0 ) { ?>light<?php } ?> right hidden-desktop">
	<div class="mobile-menu-close-button">
            <span><?php esc_html_e( 'All Categories', 'teta-lite' ); ?></span>
            <span class="mobile-menu-icon" tabindex="0"></span>
        </div>  
        <nav class="mobile-navigation">
            <?php
			wp_nav_menu(
                    array(
                        'container'      => '',
                        'menu_class'     => 'clearfix simple-menu ',
                        'before'         => '',
                        'theme_location' => 'category-nav',
                        'walker'         => new Kite_Nav_Walker(),
                        'fallback_cb'    => false,
                        'after'          => '',
                    )
                );
            ?>
                 
        </nav>
    </div>
<?php } ?>
<?php if ( kite_woocommerce_installed() ) { ?>
    <div class="togglesidebar cart-sidebar-container">
         <div class="cartsidebarwrap">
            <div class="wc-loading"></div>
            <span class="wc-loading-bg"></span>
            <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
    </div>
<?php } ?>
<div class="mobile-sidebar-overlay hidden-desktop"></div>
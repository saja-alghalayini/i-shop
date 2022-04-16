<!-- Header Navigation  -->
<header id="kt-header" data-fixed="<?php echo esc_attr( $data_fixed ); ?>"  class="<?php echo esc_attr( implode(' ', $classes ) );?>" >
    <div class="wrap headerwrap hidden-phone hidden-tablet">
        <div id="headerfirststate">
            <div class="menubgcolor hidden-phone hidden-tablet"></div>
            <?php if ( $menuInContainer == 0 ) { ?>
                <!-- if menu be in container -->
                <div class="container clearfix">
            <?php } ?> 
            <!-- First Logo -->
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
                echo "<div class='logo-title'><a href='" . home_url() . "' ><h5  >" . get_bloginfo( 'name' ) . "</h5></a></div>";
            } ?>
                
            <?php
            // Check if WooCommerce is active
            if ( $shop_cart == '1' && $catalog_mode == 0 && kite_woocommerce_installed() ) {
                /* woocomerce drop down cart widget */
                // Because it pushes the entire content to a side, it should be placed outside of layout element
                get_template_part( 'templates/woocommerce/cart' );
            }
            ?>
            <?php if ( kite_woocommerce_installed() && class_exists( 'YITH_WCWL' ) && kite_opt( 'header-wishlist-display', true ) == 1 && ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) ) { ?>
                <div class="topbar_wishlist <?php if ( $cart_style == 1 ) { ?>dark<?php } ?>">
                    <?php the_widget( 'Kite_Woocommerce_Wishlist_Icon_Widget' ); ?>
                </div>
            <?php } ?>                                                 
            <?php if ( $search == 1 ) { ?>
                <a href="#" class="search-button icon-magnifier no-select hidden-phone hidden-tablet"></a>
            <?php } ?>
            <?php if ( has_nav_menu( 'primary-nav' ) ) { ?>
                <nav class="navigation hidden-phone hidden-tablet">
                    <?php
                    wp_nav_menu(
                        array(
                            'container'   => '',
                            'menu_class'  => 'clearfix',
                            'before'      => '',
                            'theme_location' => 'primary-nav',
                            'walker'      => new Kite_Nav_Walker(),
                            'fallback_cb' => false,
                            'after'       => '',
                        )
                    );
                    ?>
                </nav>
            <?php } ?>
            <?php if ( $menuInContainer == 0 ) { ?>
                <!-- if menu be in container -->
                </div>
            <?php } ?>                          
        </div>	
    
        <?php
        if ( isset( $headerStyle ) ) {
            if ( $headerStyle == 'kite-menu' ) {
                ?>
                <div id="headersecondstate" class="hidden-phone hidden-tablet">
                    <div id="menubgcolor" class="hidden-phone hidden-tablet"></div>
                    <?php if ( $menuInContainer == 0 ) { ?>
                        <!-- if menu be in container -->
                        <div class="container clearfix">
                    <?php } ?> 
                    <!-- Secound Logo -->
                    <?php if ( ! empty( $logoSecond ) ) { ?>
                        <a class="locallink logo" href="<?php echo esc_url( home_url() ); ?>#home">
                            <?php if ( $responsivelogo != '' ) { ?>
                                <img  class="secoundlogo responsivelogo hidden-desktop" src="<?php echo esc_url( $responsivelogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
                            <?php } ?>
                            <img  class="secoundlogo" src="<?php echo esc_url( $logoSecond ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
                        </a>
                        <a class="externallink logo" href="<?php echo esc_url( home_url() ); ?>">
                            <?php if ( $responsivelogo != '' ) { ?>
                                <img  class="secoundlogo responsivelogo hidden-desktop" src="<?php echo esc_url( $responsivelogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
                            <?php } ?>
                                <img  class="secoundlogo" src="<?php echo esc_url( $logoSecond ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>"/>
                        </a>
                    <?php } else {
                        echo "<div class='logo-title'><a href='" . home_url() . "' ><h5  >" . get_bloginfo( 'name' ) . "</h5></a></div>";
                    } ?>
                    <?php
                    // Check if WooCommerce is active
                    if ( $shop_cart == '1' && $catalog_mode == 0 && kite_woocommerce_installed() ) {
                        /* woocomerce drop down cart widget */
                        // Because it pushes the entire content to a side, it should be placed outside of layout element
                        get_template_part( 'templates/woocommerce/cart' );
                    }
                    ?>
                    <?php if ( kite_woocommerce_installed() && class_exists( 'YITH_WCWL' ) && kite_opt( 'header-wishlist-display', true ) == 1 && ( class_exists( 'Kite_Theme_Check' ) || class_exists( 'Kite_Register_Widgets' ) ) ) { ?>
                        <div class="topbar_wishlist <?php if ( $cart_style == 1 ) { ?>dark<?php } ?>">
                            <?php the_widget( 'Kite_Woocommerce_Wishlist_Icon_Widget' ); ?>
                        </div>
                    <?php } ?>
                    <?php if ( $search == 1 ) { ?>
                        <a href="#" class="search-button icon-magnifier no-select hidden-phone hidden-tablet"></a>
                    <?php } ?>
                    <?php
                    // check if current client is on mobile
                    if ( has_nav_menu( 'primary-nav' ) ) {
                    ?>
                        <nav class="navigation hidden-phone hidden-tablet">
                            <?php
                            wp_nav_menu(
                                array(
                                    'container' => '',
                                    'menu_class' => 'clearfix',
                                    'before'  => '',
                                    'theme_location' => 'primary-nav',
                                    'walker'  => new Kite_Nav_Walker(),
                                    'fallback_cb' => false,
                                    'after' => '',
                                )
                            );
                            ?>
                        </nav>
                    <?php } ?>
                    <?php if ( $menuInContainer == 0 ) { ?>
                        <!-- if menu be in container -->
                        </div>
                    <?php } ?> 
                </div>	
                <?php
            }
        }      
        ?>
    </div>
    <?php
    // Because it pushes the entire content to a side, it should be placed outside of layout element
    get_template_part( 'templates/nav/header-mobile' );
    ?>
</header>
<!-- Header Navigation End -->
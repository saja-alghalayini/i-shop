<!-- tablet menu -->
<header id="kt-header" data-fixed="<?php echo esc_attr( $data_fixed ); ?>"  class="<?php echo esc_attr( implode(' ', $classes ) );?>" >
    <div class="wrap headerwrap hidden-phone hidden-tablet">
        <div id="headerfirststate">
            <div class="container clearfix">
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
            </div>
        </div>
    </div>
    <?php
    // Because it pushes the entire content to a side, it should be placed outside of layout element
    get_template_part( 'templates/nav/header-mobile' );
    ?>
</header>
<!-- tablet menu End -->

<aside class="vertical_menu_area visible-desktop left_menu hidden-tablet hidden-phone hide_menu">

    <!-- background Image -->
    <?php $backgroundImage = kite_opt( 'vertical_menu_background' ); ?> 

    <?php if ( $backgroundImage ) { ?>
        <div class="vertical_background_image" style="background-image:url('<?php echo esc_url( $backgroundImage ); ?>')"></div>    
    <?php } ?>

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
    
    <div class="set_nav_center">
        <div class="nav_tablecell_elemnt">
            <nav class="vertical_menu_navigation">
    
            <?php
            wp_nav_menu(
                array(
                    'container'      => '',
                    'menu_class'     => 'clearfix',
                    'before'         => '',
                    'theme_location' => 'primary-nav',
                    'walker'         => new Kite_Nav_Walker(),
                    'fallback_cb'    => false,
                    'after'          => '',
                )
            );
            ?>              
            </nav>
        </div>
    </div>
    <div class="vertical-wrap-forbuttons">
        <?php
        // Check if WooCommerce is active
        if ( $shop_cart == '1' && $catalog_mode == 0 && kite_woocommerce_installed() ) {
            /* woocomerce drop down cart widget */
            // Because it pushes the entire content to a side, it should be placed outside of layout element
            get_template_part( 'templates/woocommerce/cart' );
        }
        ?>
        <?php if ( $search == 1 ) { ?>
            <a href="#" class="search-button icon-magnifier no-select hidden-phone hidden-tablet"></a>
        <?php } ?>
    </div>
</aside>
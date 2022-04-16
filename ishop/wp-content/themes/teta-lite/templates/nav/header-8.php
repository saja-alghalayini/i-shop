<!-- tablet menu -->
<header id="kt-header" data-fixed="<?php echo esc_attr( $data_fixed ); ?>"  class="<?php echo esc_attr( implode(' ', $classes ) );?>" >
    <div class="wrap headerwrap hidden-tablet hidden-phone">
        <div id="headerfirststate">
            <div class="container clearfix">
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
                    /*woocomerce drop down cart widget */
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

    <?php if ( kite_opt( 'vertical-menu-social-display' ) == 1 ) { ?>
        <!-- Footer Social Link  -->
        <div class="vertical_menu_social">
            <?php $social_icons_style = ( kite_opt( 'vertical-menu-social-icon-style' ) == 1 ) ? 'light' : 'dark'; ?>
            <ul class="social-icons <?php echo esc_attr( $social_icons_style ); ?>">                   
                <?php
                kite_social_icon( 'social_facebook_url', 'icon-facebook', 'facebook' );// Facebook
                kite_social_icon( 'social_twitter_url', 'icon-twitter', 'twitter' ); // Twitter
                kite_social_icon( 'social_vimeo_url', 'icon-vimeo', 'vimeo' ); // Vimeo
                kite_social_icon( 'social_youtube_url', 'icon-youtube-play', 'youtube-play' ); // Youtube
                kite_social_icon( 'social_dribbble_url', 'icon-dribbble', 'dribbble' );// Dribbble
                kite_social_icon( 'social_tumblr_url', 'icon-tumblr', 'tumblr' );// Tumblr
                kite_social_icon( 'social_linkedin_url', 'icon-linkedin', 'linkedin' );// Linkedin
                kite_social_icon( 'social_flickr_url', 'icon-flickr', 'flickr' );// flickr
                kite_social_icon( 'social_github_url', 'icon-github', 'github5' );// github
                kite_social_icon( 'social_lastfm_url', 'icon-lastfm', 'lastfm' );// lastfm
                kite_social_icon( 'social_paypal_url', 'icon-paypal4', 'paypal4' );// paypal
                if ( kite_opt( 'rss_url', false ) == '0' ) {
                    kite_social_icon( 'social_rss_url', 'icon-feed', 'feed' );// rss
                }
                kite_social_icon( 'social_skype_url', 'icon-skype', 'skype' );// skype
                kite_social_icon( 'social_wordpress_url', 'icon-wordpress', 'WordPress' );// WordPress
                kite_social_icon( 'social_yahoo_url', 'icon-yahoo', 'yahoo' );// Yahoo
                kite_social_icon( 'social_deviantart_url', 'icon-deviantart', 'deviantart' );// Deviantart
                kite_social_icon( 'social_steam_url', 'icon-steam', 'steam' );// steam
                kite_social_icon( 'social_reddit_url', 'icon-reddit-alien', 'reddit-alien' );// reddit
                kite_social_icon( 'social_stumbleupon_url', 'icon-stumbleupon', 'stumbleupon' );// stumbleupon
                kite_social_icon( 'social_pinterest_url', 'icon-pinterest', 'pinterest' );// Pinterest
                kite_social_icon( 'social_xing_url', 'icon-xing', 'xing' );// xing
                kite_social_icon( 'social_blogger_url', 'icon-blogger', 'blogger' );// blogger
                kite_social_icon( 'social_soundcloud_url', 'icon-soundcloud', 'soundcloud' );// soundcloud
                kite_social_icon( 'social_delicious_url', 'icon-delicious', 'delicious' );// delicious
                kite_social_icon( 'social_foursquare_url', 'icon-foursquare', 'foursquare' );// foursquare
                kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram' );// foursquare
                kite_social_icon( 'social_behance_url', 'icon-behance', 'behance' );// Behance
                kite_social_icon( 'social_vk_url', 'icon-vk', 'vk' );// VK
                kite_social_icon( 'social_custom1_url', 'icon-custom1', 'custom1' );// Custom 1
                kite_social_icon( 'social_custom2_url', 'icon-custom2', 'custom2' );// Custom 2
                ?>
            </ul>
        </div>
    <?php } ?>
    <!-- vertical menu copyright -->
    <?php if ( kite_opt( 'vertical_menu_copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) { ?>
        <div class="vertical-menu-copyright">
            <?php kite_eopt( 'vertical_menu_copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ); ?>

        </div>
    <?php } ?>
</aside>
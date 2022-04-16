<div id="topbar" class="hidden-phone hidden-tablet <?php echo esc_attr( $topBarStyle ); ?> <?php echo esc_attr( $headerStyle ); ?> type<?php echo esc_attr( $headerType ); ?>">

    <?php if ( kite_opt( 'boxed_topbar', false ) == 1 ) { ?>
        <div class="container">
    <?php } ?>
                        
    <?php if ( kite_opt( 'topbar-language-link-1' ) || kite_opt( 'topbar-language-link-2' ) || kite_opt( 'topbar-language-link-3' ) ) { ?>
        <div class="topbar_lang_flag">
            <div class="lang-sel">
                    <?php if ( kite_opt( 'topbar-language-link-1' ) ) { ?>
                        <span id="language1">
                            <a href="<?php echo esc_url( kite_opt( 'topbar-language-link-1' ) ); ?>"><?php kite_eopt( 'topbar-language-1' ); ?></a>
                        </span>
                    <?php } ?>
                <ul class="lang_link">
                    <?php if ( kite_opt( 'topbar-language-link-2' ) ) { ?>
                        <li id="language2">
                            <a href="<?php echo esc_url( kite_opt( 'topbar-language-link-2' ) ); ?>"><?php kite_eopt( 'topbar-language-2' ); ?></a>
                        </li>
                    <?php } ?>
                    <?php if ( kite_opt( 'topbar-language-link-3' ) ) { ?>
                        <li id="language3">
                            <a href="<?php echo esc_url( kite_opt( 'topbar-language-link-3' ) ); ?>"><?php kite_eopt( 'topbar-language-3' ); ?></a>
                        </li>
                    <?php } ?>
                    <?php if ( kite_opt( 'topbar-language-link-4' ) ) { ?>
                        <li id="language4">
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
    <div class="topbar-message ">
        <?php if ( kite_opt( 'topbar_icon' ) ) { ?> 
            <div class="topbar-icon icon-<?php kite_eopt( 'topbar_icon' ); ?>"></div> 
        <?php } ?>
            
        <?php if ( kite_opt( 'topbar_title' ) ) { ?>
                <div class="topbar-title">
                <?php kite_eopt( 'topbar_title' ); ?>
                </div>
        <?php } ?>

        <?php if ( kite_opt( 'topbar_text' ) ) { ?>
                <div class="topbar-text">
                <?php kite_eopt( 'topbar_text' ); ?>
                </div>
        <?php } ?>
    </div>

    <?php if ( kite_opt( 'topbar-social-display', true ) ) { ?>
        <div class="topbar_social">
            <ul class="social-icons">
                        
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
                    kite_social_icon( 'social_paypal_url', 'icon-paypal', 'paypal' );// paypal
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
                    kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram' );// instagram
                    kite_social_icon( 'social_behance_url', 'icon-behance', 'behance' );// Behance
                    kite_social_icon( 'social_vk_url', 'icon-vk', 'vk' );// VK
                ?>
                
            </ul>
        </div>

    <?php } ?>
    <!-- Topbar Compare -->
    <?php
    if ( kite_woocommerce_installed() && class_exists( 'YITH_Woocompare' ) && kite_opt( 'topbar-compare-display', true ) == 1 ) {
        global $yith_woocompare;
    ?>
        <div class="topbar_compare">
            <div class="comparewrapper">
                <div class="topbar_compare_text ">
                <span><a href="<?php echo esc_url( $yith_woocompare->obj->view_table_url() ); ?>" class="no_djax compareLink">
                        <?php echo esc_html__( 'Compare', 'teta-lite' ); ?>                                    </a></span>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ( kite_woocommerce_installed() && kite_opt( 'shop-login-link', true ) == 1 ) { ?>

        <div class="topbar_login_link <?php if ( is_user_logged_in() && kite_woocommerce_installed() ) { echo 'has-content'; } ?>">
            <div class="topbar_login">
                <div class="topbar_login_text ">
                    <span> <?php echo kite_get_myaccount_link(); ?> </span>
                </div>
                <?php if ( is_user_logged_in() && kite_woocommerce_installed() ) { ?>
                    <ul  class="topbar_login-content">
                        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>                               
                    <?php
                }
                ?>
            </div>
        </div> 

    <?php } ?>
    <!-- Topbar NewsLetter -->
    <?php if ( kite_opt( 'popupNewsletterDisplay', false ) == 1 ) { ?>
        <div class="topbar_newsletter">
            <div class="newsletter"> 
                <div class="topbar_newsletter_text">
                    <span>
                        <a href="#">
                            <?php esc_html_e( 'Newsletter', 'teta-lite' ); ?>
                        </a>    
                    </span>
                </div>
            </div>
        </div>

    <?php
    }
    wp_nav_menu(
        array(
            'container'      => '',
            'menu_class'     => 'clearfix simple-menu ',
            'before'         => '',
            'theme_location' => 'topbar-nav',
            'walker'         => new Kite_Simple_Nav_Walker(),
            'fallback_cb'    => false,
            'after'          => '',
        )
    );
    ?>
    <?php if ( kite_opt( 'boxed_topbar', false ) == 1 ) { ?>
        </div>
    <?php } ?>
</div>
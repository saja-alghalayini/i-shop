<?php

// footer style
$style      = kite_opt( 'footerStyle', true );
$footerType = kite_opt( 'footerType', 'logo-in-middle' );
if ( $style == '0' ) {
	$style = 'light';
} else {
	$style = 'dark';
}
$headerType             = kite_opt( 'header-type', '1' );
$social_network_display = kite_opt( 'social_network_display', true );
$footerlogo             = kite_opt( 'footerlogo' , '');

?>

<footer class="footer-bottom <?php echo esc_attr( $style ); ?>">
	<div class="wrap">
		<!-- Footer Content   -->
		<div class="footer_content
		<?php
		if ( ! ( kite_opt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) ) {
			?>
			 nocopyright<?php } ?> <?php
				if ( kite_opt( 'footerFullwidth', false ) == false ) {
					?>
			container <?php } echo esc_attr( $footerType ) . '_footer'; ?> <?php
			if ( ! has_nav_menu( 'footer-nav' ) ) {
				echo 'nofootermenu';}
			?>
			">
			<div class="lg_screen_footer visible-desktop">    
			<?php
			switch ( $footerType ) {
				case 'leftaligned':
					?>
					<div class="span8 item">
						<?php if ( has_nav_menu( 'footer-nav' ) ) : ?>
						<div class="span12 footermenu">
							<?php
							wp_nav_menu(
								array(
									'container'      => '',
									'menu_class'     => 'clearfix simple-menu ' . $style,
									'before'         => '',
									'theme_location' => 'footer-nav',
									'walker'         => new Kite_Simple_Nav_Walker(),
									'fallback_cb'    => false,
									'after'          => '',
								)
							);
							?>
						</div>
						<?php endif; ?>
						<?php if ( $social_network_display != 0 ) : ?>
						<div class="span12 footersocialmenu">
							<!-- Footer Social Link  -->
							<ul class="social-icons">
											
								<?php
									kite_social_icon( 'social_facebook_url', 'icon-facebook', 'facebook', true );// Facebook
									kite_social_icon( 'social_twitter_url', 'icon-twitter', 'twitter', true ); // Twitter
									kite_social_icon( 'social_vimeo_url', 'icon-vimeo', 'vimeo', true ); // Vimeo
									kite_social_icon( 'social_youtube_url', 'icon-youtube', 'youtube', true ); // Youtube
									kite_social_icon( 'social_dribbble_url', 'icon-dribbble', 'dribbble', true );// Dribbble
									kite_social_icon( 'social_tumblr_url', 'icon-tumblr', 'tumblr', true );// Tumblr
									kite_social_icon( 'social_linkedin_url', 'icon-linkedin', 'linkedin', true );// Linkedin
									kite_social_icon( 'social_flickr_url', 'icon-flickr', 'flickr', true );// flickr
									kite_social_icon( 'social_github_url', 'icon-github', 'github5', true );// github
									kite_social_icon( 'social_lastfm_url', 'icon-lastfm', 'lastfm', true );// lastfm
									kite_social_icon( 'social_paypal_url', 'icon-paypal', 'paypal', true );// paypal
								if ( kite_opt( 'rss_url', false ) == '0' ) {
									kite_social_icon( 'social_rss_url', 'icon-feed', 'feed', true );// rss
								}
									kite_social_icon( 'social_skype_url', 'icon-skype', 'skype', true );// skype
									kite_social_icon( 'social_wordpress_url', 'icon-wordpress', 'WordPress', true );// WordPress
									kite_social_icon( 'social_yahoo_url', 'icon-yahoo', 'yahoo', true );// Yahoo
									kite_social_icon( 'social_deviantart_url', 'icon-deviantart', 'deviantart', true );// Deviantart
									kite_social_icon( 'social_steam_url', 'icon-steam', 'steam', true );// steam
									kite_social_icon( 'social_reddit_url', 'icon-reddit-alien', 'reddit-alien', true );// reddit
									kite_social_icon( 'social_stumbleupon_url', 'icon-stumbleupon', 'stumbleupon', true );// stumbleupon
									kite_social_icon( 'social_pinterest_url', 'icon-pinterest', 'pinterest', true );// Pinterest
									kite_social_icon( 'social_xing_url', 'icon-xing', 'xing', true );// xing
									kite_social_icon( 'social_blogger_url', 'icon-blogger', 'blogger', true );// blogger
									kite_social_icon( 'social_soundcloud_url', 'icon-soundcloud', 'soundcloud', true );// soundcloud
									kite_social_icon( 'social_delicious_url', 'icon-delicious', 'delicious', true );// delicious
									kite_social_icon( 'social_foursquare_url', 'icon-foursquare', 'foursquare', true );// foursquare
									kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram', true );// instagram
									kite_social_icon( 'social_behance_url', 'icon-behance', 'behance', true );// Behance
									kite_social_icon( 'social_vk_url', 'icon-vk', 'vk', true );// VK
									kite_social_icon( 'social_custom1_url', 'icon-custom1', 'custom1', true );// Custom 1
									kite_social_icon( 'social_custom2_url', 'icon-custom2', 'custom2', true );// Custom 2
								?>

							</ul>
						</div>
						<?php endif; ?>
						<?php if ( ! empty( kite_opt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) ) : ?>
						<div class="span12 footercopyright">
							<?php
								kite_eopt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' );
							?>
						</div>
						<?php endif; ?>
					</div>
					<div class="span4 footerlogo item">
						<?php if (! empty( $footerlogo ) ) { ?>
							<img src="<?php echo esc_url( $footerlogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>">
						<?php  } ?>
					</div>
					<?php
					break;
				case 'triangular':
					?>
					<div class="span12 footerlogo">
						<?php if (! empty( $footerlogo ) ) { ?>
							<img src="<?php echo esc_url( $footerlogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>">
						<?php } ?>
					</div>
					<?php if ( has_nav_menu( 'footer-nav' ) ) : ?>
					<div class="span12 footermenu">
						<?php
						wp_nav_menu(
							array(
								'container'      => '',
								'menu_class'     => 'clearfix simple-menu ' . $style,
								'before'         => '',
								'theme_location' => 'footer-nav',
								'walker'         => new Kite_Simple_Nav_Walker(),
								'fallback_cb'    => false,
								'after'          => '',
							)
						);
						?>
					</div>
					<?php endif; ?>
					<?php if ( ! empty( kite_opt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) ) : ?>
					<div class="span12 footercopyright">
						<?php
							kite_eopt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' );
						?>
					</div>
					<?php endif; ?>
					<?php if ( $social_network_display != 0 ) : ?>
					<div class="span12 footersocialmenu">
						<!-- Footer Social Link  -->
						<ul class="social-icons">
										
							<?php
								kite_social_icon( 'social_facebook_url', 'icon-facebook', 'facebook', true );// Facebook
								kite_social_icon( 'social_twitter_url', 'icon-twitter', 'twitter', true ); // Twitter
								kite_social_icon( 'social_vimeo_url', 'icon-vimeo', 'vimeo', true ); // Vimeo
								kite_social_icon( 'social_youtube_url', 'icon-youtube', 'youtube', true ); // Youtube
								kite_social_icon( 'social_dribbble_url', 'icon-dribbble', 'dribbble', true );// Dribbble
								kite_social_icon( 'social_tumblr_url', 'icon-tumblr', 'tumblr', true );// Tumblr
								kite_social_icon( 'social_linkedin_url', 'icon-linkedin', 'linkedin', true );// Linkedin
								kite_social_icon( 'social_flickr_url', 'icon-flickr', 'flickr', true );// flickr
								kite_social_icon( 'social_github_url', 'icon-github', 'github5', true );// github
								kite_social_icon( 'social_lastfm_url', 'icon-lastfm', 'lastfm', true );// lastfm
								kite_social_icon( 'social_paypal_url', 'icon-paypal', 'paypal', true );// paypal
							if ( kite_opt( 'rss_url', false ) == '0' ) {
								kite_social_icon( 'social_rss_url', 'icon-feed', 'feed', true );// rss
							}
								kite_social_icon( 'social_skype_url', 'icon-skype', 'skype', true );// skype
								kite_social_icon( 'social_wordpress_url', 'icon-wordpress', 'WordPress', true );// WordPress
								kite_social_icon( 'social_yahoo_url', 'icon-yahoo', 'yahoo', true );// Yahoo
								kite_social_icon( 'social_deviantart_url', 'icon-deviantart', 'deviantart', true );// Deviantart
								kite_social_icon( 'social_steam_url', 'icon-steam', 'steam', true );// steam
								kite_social_icon( 'social_reddit_url', 'icon-reddit-alien', 'reddit-alien', true );// reddit
								kite_social_icon( 'social_stumbleupon_url', 'icon-stumbleupon', 'stumbleupon', true );// stumbleupon
								kite_social_icon( 'social_pinterest_url', 'icon-pinterest', 'pinterest', true );// Pinterest
								kite_social_icon( 'social_xing_url', 'icon-xing', 'xing', true );// xing
								kite_social_icon( 'social_blogger_url', 'icon-blogger', 'blogger', true );// blogger
								kite_social_icon( 'social_soundcloud_url', 'icon-soundcloud', 'soundcloud', true );// soundcloud
								kite_social_icon( 'social_delicious_url', 'icon-delicious', 'delicious', true );// delicious
								kite_social_icon( 'social_foursquare_url', 'icon-foursquare', 'foursquare', true );// foursquare
								kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram', true );// instagram
								kite_social_icon( 'social_behance_url', 'icon-behance', 'behance', true );// Behance
								kite_social_icon( 'social_vk_url', 'icon-vk', 'vk', true );// VK
								kite_social_icon( 'social_custom1_url', 'icon-custom1', 'custom1', true );// Custom 1
								kite_social_icon( 'social_custom2_url', 'icon-custom2', 'custom2', true );// Custom 2
							?>

						</ul>
					</div>
				<?php endif; ?>
					<?php
					break;
				default:
					?>
							<div class="
							<?php
							/*
							if (!empty(kite_opt('footerlogo'))) { ?>
								span4 <?php }
								else { ?> span8 <?php }   */
							?>
							 span4 footer_copyright_menu item">
						
								<?php if ( has_nav_menu( 'footer-nav' ) ) : ?>
								<div class="footermenu span12">
									<?php
									wp_nav_menu(
										array(
											'container'   => '',
											'menu_class'  => 'clearfix simple-menu ' . $style,
											'before'      => '',
											'theme_location' => 'footer-nav',
											'walker'      => new Kite_Simple_Nav_Walker(),
											'fallback_cb' => false,
											'after'       => '',
										)
									);
									?>
								</div>
								<?php endif; ?>
								<?php if ( ! empty( kite_opt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) ) : ?>
								<div class="footercopyright span12">
									<?php
										kite_eopt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' );
									?>
								</div>
								<?php endif; ?>
							</div>
						   
							<?php // if (!empty(kite_opt('footerlogo'))) { ?>
								<div class="span4 footerlogo item">
									<?php if ( ! empty( $footerlogo ) ) { ?>
										<img src="<?php echo esc_url( $footerlogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>">
									<?php } ?>
								</div>
							<?php // } ?>
						   
							
							<div class="span4 footersocialmenu item">
								<!-- Footer Social Link  -->
								<ul class="social-icons">
								<?php if ( $social_network_display != 0 ) : ?>                
									<?php
										kite_social_icon( 'social_facebook_url', 'icon-facebook', 'facebook', true );// Facebook
										kite_social_icon( 'social_twitter_url', 'icon-twitter', 'twitter', true ); // Twitter
										kite_social_icon( 'social_vimeo_url', 'icon-vimeo', 'vimeo', true ); // Vimeo
										kite_social_icon( 'social_youtube_url', 'icon-youtube', 'youtube', true ); // Youtube
										kite_social_icon( 'social_dribbble_url', 'icon-dribbble', 'dribbble', true );// Dribbble
										kite_social_icon( 'social_tumblr_url', 'icon-tumblr', 'tumblr', true );// Tumblr
										kite_social_icon( 'social_linkedin_url', 'icon-linkedin', 'linkedin', true );// Linkedin
										kite_social_icon( 'social_flickr_url', 'icon-flickr', 'flickr', true );// flickr
										kite_social_icon( 'social_github_url', 'icon-github', 'github5', true );// github
										kite_social_icon( 'social_lastfm_url', 'icon-lastfm', 'lastfm', true );// lastfm
										kite_social_icon( 'social_paypal_url', 'icon-paypal', 'paypal', true );// paypal
									if ( kite_opt( 'rss_url', false ) == '0' ) {
										kite_social_icon( 'social_rss_url', 'icon-feed', 'feed', true );// rss
									}
										kite_social_icon( 'social_skype_url', 'icon-skype', 'skype', true );// skype
										kite_social_icon( 'social_wordpress_url', 'icon-wordpress', 'WordPress', true );// WordPress
										kite_social_icon( 'social_yahoo_url', 'icon-yahoo', 'yahoo', true );// Yahoo
										kite_social_icon( 'social_deviantart_url', 'icon-deviantart', 'deviantart', true );// Deviantart
										kite_social_icon( 'social_steam_url', 'icon-steam', 'steam', true );// steam
										kite_social_icon( 'social_reddit_url', 'icon-reddit-alien', 'reddit-alien', true );// reddit
										kite_social_icon( 'social_stumbleupon_url', 'icon-stumbleupon', 'stumbleupon', true );// stumbleupon
										kite_social_icon( 'social_pinterest_url', 'icon-pinterest', 'pinterest', true );// Pinterest
										kite_social_icon( 'social_xing_url', 'icon-xing', 'xing', true );// xing
										kite_social_icon( 'social_blogger_url', 'icon-blogger', 'blogger', true );// blogger
										kite_social_icon( 'social_soundcloud_url', 'icon-soundcloud', 'soundcloud', true );// soundcloud
										kite_social_icon( 'social_delicious_url', 'icon-delicious', 'delicious', true );// delicious
										kite_social_icon( 'social_foursquare_url', 'icon-foursquare', 'foursquare', true );// foursquare
										kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram', true );// instagram
										kite_social_icon( 'social_behance_url', 'icon-behance', 'behance', true );// Behance
										kite_social_icon( 'social_vk_url', 'icon-vk', 'vk', true );// VK
										kite_social_icon( 'social_custom1_url', 'icon-custom1', 'custom1', true );// Custom 1
										kite_social_icon( 'social_custom2_url', 'icon-custom2', 'custom2', true );// Custom 2
									?>
							<?php endif; ?>

								</ul>
							</div>
					<?php
					break;
			}
			?>
			</div>
			<div class="responsive_footer">
			<?php if ( ! empty( $footerlogo ) ) { ?>
				<div class="span12 footerlogo">
						<img src="<?php echo esc_url( $footerlogo ); ?>" alt="<?php esc_attr_e( 'Logo', 'teta-lite' ); ?>">
				</div> 
			<?php } ?>
				<?php if ( has_nav_menu( 'footer-nav' ) ) : ?>
				<div class="span12 footermenu">
					<?php
					wp_nav_menu(
						array(
							'container'      => '',
							'menu_class'     => 'clearfix simple-menu ' . $style,
							'before'         => '',
							'theme_location' => 'footer-nav',
							'walker'         => new Kite_Simple_Nav_Walker(),
							'fallback_cb'    => false,
							'after'          => '',
						)
					);
					?>
				</div>
				<?php endif; ?>
				<?php if ( $social_network_display != 0 ) : ?>

				<div class="span12 footersocialmenu">
					<!-- Footer Social Link  -->
					<ul class="social-icons">
									
						<?php
							kite_social_icon( 'social_facebook_url', 'icon-facebook', 'facebook', true );// Facebook
							kite_social_icon( 'social_twitter_url', 'icon-twitter', 'twitter', true ); // Twitter
							kite_social_icon( 'social_vimeo_url', 'icon-vimeo', 'vimeo', true ); // Vimeo
							kite_social_icon( 'social_youtube_url', 'icon-youtube', 'youtube', true ); // Youtube
							kite_social_icon( 'social_dribbble_url', 'icon-dribbble', 'dribbble', true );// Dribbble
							kite_social_icon( 'social_tumblr_url', 'icon-tumblr', 'tumblr', true );// Tumblr
							kite_social_icon( 'social_linkedin_url', 'icon-linkedin', 'linkedin', true );// Linkedin
							kite_social_icon( 'social_flickr_url', 'icon-flickr', 'flickr', true );// flickr
							kite_social_icon( 'social_github_url', 'icon-github', 'github5', true );// github
							kite_social_icon( 'social_lastfm_url', 'icon-lastfm', 'lastfm', true );// lastfm
							kite_social_icon( 'social_paypal_url', 'icon-paypal', 'paypal', true );// paypal
						if ( kite_opt( 'rss_url', false ) == '0' ) {
							kite_social_icon( 'social_rss_url', 'icon-feed', 'feed', true );// rss
						}
							kite_social_icon( 'social_skype_url', 'icon-skype', 'skype', true );// skype
							kite_social_icon( 'social_wordpress_url', 'icon-wordpress', 'WordPress', true );// WordPress
							kite_social_icon( 'social_yahoo_url', 'icon-yahoo', 'yahoo', true );// Yahoo
							kite_social_icon( 'social_deviantart_url', 'icon-deviantart', 'deviantart', true );// Deviantart
							kite_social_icon( 'social_steam_url', 'icon-steam', 'steam', true );// steam
							kite_social_icon( 'social_reddit_url', 'icon-reddit-alien', 'reddit-alien', true );// reddit
							kite_social_icon( 'social_stumbleupon_url', 'icon-stumbleupon', 'stumbleupon', true );// stumbleupon
							kite_social_icon( 'social_pinterest_url', 'icon-pinterest', 'pinterest', true );// Pinterest
							kite_social_icon( 'social_xing_url', 'icon-xing', 'xing', true );// xing
							kite_social_icon( 'social_blogger_url', 'icon-blogger', 'blogger', true );// blogger
							kite_social_icon( 'social_soundcloud_url', 'icon-soundcloud', 'soundcloud', true );// soundcloud
							kite_social_icon( 'social_delicious_url', 'icon-delicious', 'delicious', true );// delicious
							kite_social_icon( 'social_foursquare_url', 'icon-foursquare', 'foursquare', true );// foursquare
							kite_social_icon( 'social_instagram_url', 'icon-instagram', 'instagram', true );// instagram
							kite_social_icon( 'social_behance_url', 'icon-behance', 'behance', true );// Behance
							kite_social_icon( 'social_vk_url', 'icon-vk', 'vk', true );// VK
							kite_social_icon( 'social_custom1_url', 'icon-custom1', 'custom1', true );// Custom 1
							kite_social_icon( 'social_custom2_url', 'icon-custom2', 'custom2', true );// Custom 2
						?>

					</ul>
				</div>
				<?php endif; ?>
				<?php if ( ! empty( kite_opt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' ) ) ) : ?>
				<div class="span12 footercopyright">
					<?php
						kite_eopt( 'footer-copyright', '&copy; 2021 KiteStudio | Built With The ' . KITE_THEME_NAME . ' Theme' );
					?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>

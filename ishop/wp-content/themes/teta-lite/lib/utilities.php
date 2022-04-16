<?php
/* -------------------------------------------------------------------------- */
/*                        		Text Domain					                  */
/* -------------------------------------------------------------------------- */
function kite_load_text_domain() {
	load_theme_textdomain( 'teta-lite', KITE_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'kite_load_text_domain' );

/* -------------------------------------------------------------------------- */
/*                        Check woocommerce activation                        */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_woocommerce_installed' ) ) {
	function kite_woocommerce_installed() {
		return class_exists( 'WooCommerce' );
	}
}

/* -------------------------------------------------------------------------- */
/*                              Site Layout Width Style                        */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_is_layout_fullwidth' ) ) {
	/**
	 * check if layout if fullwidth or in a container
	 *
	 * @param boolean $is_content
	 * @param boolean $just_check_main_condition
	 * @return boolean
	 */
	function kite_is_layout_fullwidth( $is_content, $just_check_main_condition = false) {
		$site_layout = kite_opt( 'layout_width', false );
		if ( $is_content ) {

			if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() ) && !$just_check_main_condition ) {
				return kite_opt( 'shop-enable-fullwidth', false );
			}
			
			return kite_get_meta( 'custom-content-layout' ) ? kite_get_meta( 'content-layout' ) : $site_layout;
		}
		return $site_layout;
	}
}

/* -------------------------------------------------------------------------- */
/*            check query if is for posts archive or single post              */
/* -------------------------------------------------------------------------- */
if ( !function_exists('kite_is_blog') ) {
	/**
	 * check if current request is for post archive or single post
	 *
	 * @return boolean
	 */
	function kite_is_blog() {
		return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
	}
}

/* -------------------------------------------------------------------------- */
/*       Check if current request is an AJAX request for main-loop shop       */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_is_shop_ajax_request' ) ) {
	function kite_is_shop_ajax_request() {
		if ( isset( $_POST['ajax_shop_req'] ) && $_POST['ajax_shop_req'] == true ) {
			return true;
		}

		return false;
	}
}
/*--------------------------------------------------------------------------------
Add a pingback url auto-discovery header for single posts, pages, or attachments.
---------------------------------------------------------------------------------*/
function kite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'kite_pingback_header' );

/*--------------------------------------------------------------------------------
Kite Preloader
---------------------------------------------------------------------------------*/
if ( ! function_exists( 'kite_preloader_display' ) ) {
	function kite_preloader_display() {
		if ( kite_opt( 'loader_display' , '2' ) == '1' ) { ?>
			<!-- Preloader -->
			<div id="preloader" class="firstload <?php echo esc_attr( kite_opt( 'preloader-type', 'simple' ) ); ?>">
				<div id="preloader_box">
						<div id="preloader_items">
							<div class="preloader-items-container">
								<div class="preloader-image" style="background-image:url(<?php kite_preloader(); ?>);"></div>
							</div>
						</div>

						<div class="preloader-text-container">
							<div class="preloader-text">
							<?php
							if ( kite_opt( 'preloader-text' ) ) {
								kite_eopt( 'preloader-text' ); }
							?>
							</div>
						</div>

						<svg width="334" height="334" viewbox="0 0 40 40" class="preloader">
							<polygon points="0 0 0 40 40 40 40 0" class="rect" />
						</svg>
				</div>
				<?php if ( kite_opt( 'preloader-type', 'simple' ) == 'simple' || kite_opt( 'preloader-type', 'simple' ) == 'creative' ) { ?>
					<!-- preloader simple  -->
					<svg id="preloader-simple" width="50" height="50" viewbox="0 0 40 40" class="preloader">
						<polygon points="0 0 0 40 40 40 40 0" class="rect" />
					</svg>


				<?php } elseif ( kite_opt( 'preloader-type', 'simple' ) == 'circular' ) { ?>
					<!-- preloader circular  -->
					<svg id="preloader-circular" height="50" width="50" class="preloader_circular">
						<circle cx="25" cy="25" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" class="path"></circle>
					</svg>
				<?php } elseif ( kite_opt( 'preloader-type', 'simple' ) == 'sniper' ) { ?>
					<!-- preloader sniper  -->
					<div  id="preloader-sniper"  class="sniperloader">
						<?php esc_html_e( 'Loading...', 'teta-lite' ); ?>
						<div class="ball"></div>
						<div class="ball"></div>
						<div class="ball"></div>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}
	add_action( 'kite_preloader_section', 'kite_preloader_display', 10 );
}
/*--------------------------------------------------------------------------------
Elementor Header
---------------------------------------------------------------------------------*/
if ( ! function_exists( 'kite_maybe_print_elementor_header') ) {
	function kite_maybe_print_elementor_header() {
		$custom_header = kite_get_meta( 'is-header-build-with-elementor' ) ? kite_get_meta( 'header-template' ) : '';
		$elementor_header_ID = kite_opt( 'elementor_header_template_id', '' );

		if ( kite_get_meta( 'custom-menu-container' ) ) {
			$containerClass = kite_get_meta( 'menu-container' ) ? 'fullwidth' : 'container';
		} else {
			$containerClass = kite_opt( 'menu-container', false ) ? 'fullwidth' : 'container';
		}

		if ( ( kite_opt( 'is_header_build_with_elementor', false) && ! empty( $elementor_header_ID ) ) || ! empty( $custom_header) ) {
			$elementor_header_ID = ! empty( $custom_header ) ? $custom_header : $elementor_header_ID;

			$classes[] = 'kt-elementor-template ' . $containerClass;
			$classes[] = kite_opt( 'header-style ', 'normal-menu' ); // header style
			$classes[] = kite_get_meta( 'header-type-switch', true ) == '2' ? 'kt-overlay-header' : '';
			echo '<header id="kt-header" class="' . implode( ' ', $classes ) . '" >';

			/**
			 * kite actions tiggered before header builder print
			 */
			do_action( 'kite_before_header_builder_print');

			kite_render_elementor_template( $elementor_header_ID );
			echo '<div class="kt-header-builder-overlay"></div>';

			/**
			 * kite actions tiggered after header builder print
			 * @hooked kite_print_recent_products_in_header - 5
			 */
			do_action( 'kite_after_header_builder_print');

			echo '</header>';
		} else {
			add_action( 'kite_header_section', 'kite_topbar', 5 );
			add_action( 'kite_header_section', 'kite_print_header', 15 );
			add_action( 'kite_header_section', 'kite_mobile_nav', 10 );
		}
		include locate_template( 'templates/bottom-sticky-navigation.php', false, false );
	}
	add_action( 'kite_header_section', 'kite_maybe_print_elementor_header', 1 );
}
/*--------------------------------------------------------------------------------
Kite Topbar
---------------------------------------------------------------------------------*/
if ( ! function_exists( 'kite_topbar' ) ) {
	function kite_topbar() {

		do_action( 'kite_topbar_section' );

		if ( ! kite_opt( 'topbar_display', false ) ) {
			return;
		}
		$headerType  = kite_opt( 'header-type', '1' );
		$headerStyle = kite_opt( 'header-style', 'normal-menu' );
		$topBarStyle = kite_opt( 'topbar_style', false ) ? 'light' : 'dark';

		include locate_template( 'templates/nav/topbar.php', false, false );
	}
}

if ( ! function_exists( 'kite_print_header') ) {
	function kite_print_header() {
		include locate_template( 'templates/section-nav.php', false, false );
	}
}

/*--------------------------------------------------------------------------------
Elementor Footer
---------------------------------------------------------------------------------*/
if ( ! function_exists( 'kite_maybe_print_elementor_footer') ) {
	function kite_maybe_print_elementor_footer() {
		$custom_footer = kite_get_meta( 'is-footer-build-with-elementor' ) ? kite_get_meta( 'footer-template' ) : '';
		$elementor_footer_ID = kite_opt( 'elementor_footer_template_id', '' );
		$containerClass = kite_opt( 'footerFullwidth', false ) ? 'fullwidth' : 'container';

		if ( kite_get_meta( 'custom-footerFullwidth' ) ) {
			$containerClass = kite_get_meta( 'footerFullwidth' ) ? 'fullwidth' : 'container';
		} else {
			$containerClass = kite_opt( 'footerFullwidth', false ) ? 'fullwidth' : 'container';
		}

		if ( ( kite_opt( 'is_footer_build_with_elementor', false) && ! empty( $elementor_footer_ID ) ) || ! empty( $custom_footer) ) {
			$elementor_footer_ID = ! empty( $custom_footer ) ? $custom_footer : $elementor_footer_ID;
			echo '<footer class="kt-elementor-template ' . $containerClass . '" >';
			kite_render_elementor_template( $elementor_footer_ID );
			echo '</footer>';
		} else if ( ! kite_is_shop_ajax_request() && ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) ) {
			get_template_part( 'templates/section', 'footer' );
		}
	}
	add_action( 'kite_footer_action', 'kite_maybe_print_elementor_footer', 1000 );
}
/*--------------------------------------------------------------------------------
Kite Mobile Nav
---------------------------------------------------------------------------------*/
if ( ! function_exists( 'kite_mobile_nav' ) ) {
	function kite_mobile_nav() {

		do_action( 'kite_mobile_nav_section' );

		include locate_template( 'templates/nav/mobile-nav-menu.php', false, false );
	}
}

/*
---------------------------------
	Gathering In-line styles of pages of main-page + adding them to main-page
------------------------------------*/
if ( ! function_exists( 'kite_add_vc_custom_css' ) ) {
	function kite_add_vc_custom_css() {
		if ( ! class_exists( 'Vc_Manager' ) ) {
			return;
		}

		$shortcodes_custom_css = '';

		if ( is_page_template( 'main-page.php' ) ) {
			$page_ids        = get_all_page_ids();
			$current_page_id = get_the_ID();

			if ( count( $page_ids ) > 0 ) {
				foreach ( $page_ids as $page_id ) {
					$separate_page = get_post_meta( $page_id, 'page-position-switch', true );

					if ( $separate_page !== '0' && $page_id != $current_page_id ) {
						$shortcodes_custom_css .= get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
					}
				}

				if ( $shortcodes_custom_css != '' ) {
					echo '<s' . 'tyle data-type="vc_shortcodes-custom-css">';
					echo '' . $shortcodes_custom_css;
					echo '</s' . 'tyle>';
				}
			}
		} else {
			if ( function_exists( 'is_shop' ) ) {
				$shortcodes_custom_css = get_post_meta( wc_get_page_id( 'shop' ), '_wpb_shortcodes_custom_css', true );
				if ( is_shop() && $shortcodes_custom_css != '' ) {
					echo '<s' . 'tyle data-type="vc_shortcodes-custom-css">';
					echo '' . $shortcodes_custom_css;
					echo '</s' . 'tyle>';
				}
			}
		}
	}
}
add_action( 'wp_head', 'kite_add_vc_custom_css', 1000 );


/*---------------------------------
	Social Link
------------------------------------*/
if ( ! function_exists( 'kite_social_link' ) ) {
	function kite_social_link( $optKey, $text, $class, $socialname ) {
		$SocialText = $text;
		if ( kite_opt( $optKey ) != '' ) {
			if ( esc_attr( $optKey ) != 'social_custom1_url' && esc_attr( $optKey ) != 'social_custom2_url' ) {
				?>

			<li class="sociallink-shortcode textstyle <?php echo esc_attr( $socialname ); ?>">
				<a  href="<?php esc_url( kite_eopt( $optKey ) ); ?>" target="_blank">
					<span><?php echo esc_html( $SocialText ); ?></span>
				</a>
			</li>

				<?php
			} elseif ( esc_attr( $optKey ) == 'social_custom1_url' || esc_attr( $optKey ) == 'social_custom2_url' ) {
				?>
			<li class="sociallink-shortcode textstyle <?php echo esc_attr( $socialname ); ?>">
				<a  href="<?php esc_url( kite_eopt( $optKey ) ); ?>" target="_blank">
					<span><?php kite_eopt( $SocialText ); ?></span>
				</a>
			</li>
				<?php
			}
		}
	}
}

/*---------------------------------
	Social Icon
------------------------------------*/
if ( ! function_exists( 'kite_social_icon' ) ) {
	function kite_social_icon( $optKey, $class, $socialname, $footerStyle = false ) {
		if ( kite_opt( $optKey ) != '' ) {
			if ( esc_attr( $optKey ) != 'social_custom1_url' && esc_attr( $optKey ) != 'social_custom2_url' ) {
				?>

			<li class="<?php echo ( ! $footerStyle ? 'sociallink-shortcode' : 'footersocialicon' ); ?> iconstyle <?php echo esc_attr( $socialname ); ?>">
				<a  href="<?php esc_url( kite_eopt( $optKey ) ); ?>" target="_blank" >
					<span class="firsticon icon <?php echo esc_attr( $class ); ?>"></span>
					<?php if ( ! $footerStyle ) : ?>
					<span class="second-icon icon <?php echo esc_attr( $class ); ?>"></span>
					<?php endif; ?>
				</a>
			</li>

				<?php
			} elseif ( esc_attr( $optKey ) == 'social_custom1_url' || esc_attr( $optKey ) == 'social_custom2_url' ) {
				?>
			<li class="sociallink-shortcode iconstyle <?php echo esc_attr( $socialname ); ?>">
				<a  href="<?php esc_url( kite_eopt( $optKey ) ); ?>" >
					<span class="icon <?php echo esc_attr( $class ); ?>"></span>
				</a>
			</li>
				<?php
			}
		}
	}
}


/*---------------------------------
	 Font size in text editor
------------------------------------*/
if ( ! function_exists( 'kite_mce_buttons' ) ) {
	function kite_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'fontsizeselect' );
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'kite_mce_buttons' );


// Customize mce editor font sizes
if ( ! function_exists( 'kite_mce_text_sizes' ) ) {
	function kite_mce_text_sizes( $initArray ) {
		$initArray['fontsize_formats'] = '12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 24px 26px 28px 36px 40px 48px 60px 72px 80px';
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'kite_mce_text_sizes' );

/*---------------------------------
	 Preloader
------------------------------------*/

if ( ! function_exists( 'kite_preloader' ) ) {

	function kite_preloader() {

		global $post;

		if ( isset( $post ) ) {

			if ( ! ( is_page() || is_archive() || is_search() ) && has_post_thumbnail( $post->ID ) ) {
				$thumb = get_post_thumbnail_id( $post->ID );
				if ( function_exists( 'aq_resize' ) ) {
					$img_url = wp_get_attachment_url( $thumb, 'full' );
					echo aq_resize( $img_url, 200, 200, true );
				} else {
					$img_url = wp_get_attachment_url( $thumb, 'thumbnail' );
					echo esc_url( $image_url );
				}
			} elseif ( kite_opt( 'preloader-logo' ) != '' ) {
				kite_eopt( 'preloader-logo' );
			} else {
				echo esc_url( get_template_directory_uri() . '/assets/img/preloader.png' );
			}
		} else {

			if ( get_option( 'preloader-logo' ) != '' ) {
				kite_eopt( 'preloader-logo' );
			} else {
				echo esc_url( get_template_directory_uri() . '/assets/img/preloader.png' );
			}
		}

	}
}

/* -------------------------------------------------------------------------- */
/*                   Vertical menu - left And Right position                  */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_body_class_utility' ) ) {

	function kite_body_class_utility( $classes ) {

		if ( kite_woocommerce_installed() && kite_is_shop_ajax_request() ) {
			return;
		}

		// use fade effect even in preloader mode
		$classes[] = 'fade';

		// remove fade class because of conflict with wcmp plugin in vendor dashboard pages
		if ( class_exists('WCMp') && is_vendor_dashboard() && is_user_logged_in() && (is_user_wcmp_vendor(get_current_user_id()) || is_user_wcmp_pending_vendor(get_current_user_id()) || is_user_wcmp_rejected_vendor(get_current_user_id())) && apply_filters('wcmp_vendor_dashboard_exclude_header_footer', true)) {
            unset( $classes[ array_search( 'fade', $classes ) ] );
        }

		// Header related Classes
		$custom_header = kite_get_meta( 'is-header-build-with-elementor' ) ? kite_get_meta( 'header-template' ) : '';
		$elementor_header_ID = kite_opt( 'elementor_header_template_id', '' );
		if ( ( kite_opt( 'is_header_build_with_elementor', false) && ! empty( $elementor_header_ID ) ) || ! empty( $custom_header) ) {
			$classes[] = 'kt-header-builder';
		} else {

			// Menu
			$headerPosition       = kite_opt( 'header-type', '1' );
			$headerStyle          = kite_opt( 'header-style', 'normal-menu' );
			$ajax_page_transition = kite_opt( 'ajax_page_transition' );

			if ( $ajax_page_transition == 1 ) {
				$classes[] = 'ajax_page_transition';
			}

			// is left menu area turned on
			if ( isset( $headerPosition ) && $headerPosition == 7 ) { // left menu
				$classes[] = 'vertical_menu_enabled left_menu_enabled';
			} elseif ( isset( $headerPosition ) && $headerPosition == 8 ) { // right menu
				$classes[] = 'vertical_menu_enabled right_menu_enabled';
			} elseif ( isset( $headerPosition ) && $headerPosition == 10 ) { // humburger menu
				$classes[] = 'humburger_menu_enabled';
			}
		}
		// Check wishlist
		if ( class_exists( 'YITH_WCWL' ) ) {
			$classes[] = 'wishlist-enable';
		}

		// Check compare
		if ( class_exists( 'YITH_Woocompare' ) ) {
			$classes[] = 'compare-enable';
		}
		// check scrolltop
		if ( kite_opt( 'scrolltop_button', true ) ) {
			$classes[] = 'scrolltop_enable';
		}

		// check if snap to scroll
		$snap_to_scroll           = kite_get_meta( 'snap-to-scroll' );
		$snap_to_scroll_nav_style = kite_get_meta( 'snap-to-scroll-nav-style' );
		if ( $snap_to_scroll_nav_style != 0 ) {
			$snap_to_scroll_nav_style = ' snap-to-scroll-dark-nav';
		} else {
			$snap_to_scroll_nav_style = '';
		}
		if ( $snap_to_scroll == '1' && ! is_page_template( 'main-page.php' ) ) {
			$classes[] = 'snap-to-scroll snap-to-scroll-init ' . esc_attr( $snap_to_scroll_nav_style );
		}

		// Woocommerce related classes
		if ( kite_woocommerce_installed() ) {
			global $product;

			if ( is_shop() ) {
				$classes[] = 'is-woocommerce-shop';
			}

			if ( kite_opt( 'remove_responsive_hover_state', false ) ) {
				$classes[] = 'responsive-hover-state-off';
			}

			if ( kite_opt( 'woocommerce-notices', true ) == '0' ) {
				$classes[] = 'no_wc_notices';
			}

			// Single Product
			if ( is_product() ) {
				$attachment_ids = $product->get_gallery_image_ids();
				if ( count( $attachment_ids ) > 0 ) {
					$classes[] = 'have_gallery';
				}

				if ( ! kite_opt( 'single-product-ajax-addtocart', true ) ) {
					$classes[] = 'remove-ajax-add-to-cart';
				}

				if ( ! kite_opt( 'shop_enable_zoom_responsive', false ) && kite_opt( 'shop_enable_zoom', true ) ) {
					$classes[] = 'kt-responsive-zoom-disable';
				}
			}

			// products gutter
			if ( isset( $_GET['shopGutter'] ) && ( sanitize_text_field( $_GET['shopGutter'] ) == 'with-gutter' || sanitize_text_field( $_GET['shopGutter'] ) == 'no-gutter' ) ) {
				if ( sanitize_text_field( $_GET['shopGutter'] ) == 'no-gutter' ) {
					$product_gutter = 0;
				} else {
					$product_gutter = 1;
				}
			} else {
				$product_gutter = kite_opt( 'shop-product-gutter', true );
			}

			if ( is_shop() || is_product_category() || is_product_tag() ) {

				if ( $product_gutter == 0 ) {
					$classes[] = 'no-gutter';
				}
			}

			$catalog_mode = kite_opt( 'catalog_mode', false );
			if ( $catalog_mode ) {
				$classes[] = 'catalog-mode';
			}

		}

		if ( ! kite_opt( 'responsive-sticky-bottom-navbar', true ) || !kite_woocommerce_installed() ) {
			$classes[] = 'kt-disable-sticky-bottom-navbar';
		}

		// check topbar is Enable Or not
		$topbar = kite_opt( 'topbar_display', false );
		if ( $topbar == '1' ) {
			  $classes[] = 'has-topbar';
		}

		// check menu is has-scrollsticky styles or not
		$menuStyle = kite_opt( 'header-style' );
		if ( $menuStyle == 'scroll-sticky' ) {
			  $classes[] = 'has-scrollstickymenu';
		}

		// check if page has extra class name or not
		$extra_class = kite_get_meta( 'extra_class' );
		if ( $extra_class ) {
			$classes[] = esc_attr( $extra_class );
		}

		// Check if show more button For Category Widget is Enable add Class categoryShowMorebutton
        if(  kite_opt( 'show_more_button_in_woocommerce_categories_widget', true ) ) {
            $classes[] =  'show-more-categories';
        }

        if ( kite_opt( 'categories_widget_scroll_animation', false ) ) {
            $classes[] =  'categories-scroll-animation';
        }

		return $classes;
	}
}
add_filter( 'body_class', 'kite_body_class_utility' );

if ( ! function_exists( 'kite_body_attr' ) ) {
	function kite_body_attr() {
		global $post;
		$attributes = [];
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$page_id = wc_get_page_id( 'shop' );
		} else {
			if ( $post ) {
				$page_id = $post->ID;
			} else {
				$page_id = get_the_ID();
			}
		}
		$attributes['data-pageid'] = $page_id;

		$bg_image           = kite_get_meta( 'page_bg_image' );
		$bg_img_position   = kite_get_meta( 'bg_img_position' );
		$bg_img_attachment = kite_get_meta( 'bg_img_attachment' );
		$page_bg_color     = kite_get_meta( 'page_bg_color' );
		$bg_img_size       = kite_get_meta( 'bg_img_size' );
		$bg_img_repeat     = kite_get_meta( 'bg_img_repeat' );

		$style = $bg_image ? 'background-image: url(' . $bg_image . ');': '';
		$style .= $bg_img_position ? 'background-position:' . $bg_img_position . ';': '';
		$style .= $bg_img_attachment ? 'background-attachment:' . $bg_img_attachment . ';': '';
		$style .= $page_bg_color ? 'background-color:' . $page_bg_color . ';': '';
		$style .= $bg_img_size ? 'background-size:' . $bg_img_size . ';': '';
		$style .= $bg_img_repeat ? 'background-repeat:' . $bg_img_repeat . ';': '';

		$attributes['style'] = $style;

		/**
		 * Hook to add or change body attributes
		 */
		$attributes = apply_filters( 'kite_body_attributes', $attributes );

		foreach( $attributes as $key => $value ) {
			echo esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
		}

	}
}

/* -------------------------------------------------------------------------- */
/*                          Remove the excerpt "more"                         */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_new_excerpt_more' ) ) {
	function kite_new_excerpt_more( $more ) {
		return is_admin() ? $more : '';
	}
}
add_filter( 'excerpt_more', 'kite_new_excerpt_more' );


/* -------------------------------------------------------------------------- */
/*                retrieves the attachment ID from the file URL               */
/* -------------------------------------------------------------------------- */
if ( ! function_exists( 'kite_get_image_id' ) ) {
	function kite_get_image_id( $image_url ) {
		global $wpdb;

		// generate Full size Image URL by removing image size info
		$original_image_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $image_url );

		if ( $original_image_url == '' ) {
			$original_image_url = $image_url;
		}

		$attachment = $wpdb->get_col( $wpdb->prepare( 'SELECT ID FROM ' . $wpdb->prefix . 'posts' . " WHERE guid=%s;", $original_image_url ) );

		if ( count( $attachment ) ) {
			return $attachment[0];
		} else {
			return -1;
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                             Return theme option                            */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_opt' ) ) {
	function kite_opt( $option, $def = '' ) {

		global ${KITE_OPTIONS_KEY};
		$opt = ${KITE_OPTIONS_KEY};

		if ( empty( $opt ) || ! isset( $opt[ $option ] ) ) {
			return apply_filters( 'kite_option_value', $def, $option );
		}

		$mutli_input_item = 'custom_sidebars';
		$iconItem         = 'topbar_icon';
		if ( is_array( $opt[ $option ] ) && isset( $opt[ $option ]['rgba'] ) ) {
			$value = $opt[ $option ]['rgba'];
		} elseif ( is_array( $opt[ $option ] ) && isset( $opt[ $option ]['font-family'] ) ) {
			$value = empty( $opt[ $option ]['font-family'] ) ? $def : $opt[ $option ];
		} elseif ( is_array( $opt[ $option ] ) && isset( $opt[ $option ]['url'] ) ) {
			$value = $opt[ $option ]['url'];
		} elseif ( is_array( $opt[ $option ] ) && $option == $mutli_input_item ) {
			$value = implode( ',', $opt[ $option ] );
		} elseif ( $option == $iconItem ) {
			$icon = substr( $opt[ $option ], 5 );
			$value = $icon;
		} elseif ( is_array( $opt[ $option ] ) && isset( $opt[ $option ]['color'] ) ) {
			$value = $opt[ $option ]['color'];
		} else {
			$value = stripslashes( $opt[ $option ] );
		}

		return apply_filters( 'kite_option_value', $value, $option );
	}
}

if ( ! function_exists( 'kite_eopt' ) ) {
	function kite_eopt( $option, $default = '' ) {
		echo kite_opt( $option, $default );
	}
}


/* -------------------------------------------------------------------------- */
/*                     Gets array value with specified key                    */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_array_value' ) ) {
	// if the key doesn't exist  default value is returned
	function kite_array_value( $key, $arr, $default = '' ) {
		return array_key_exists( $key, $arr ) ? $arr[ $key ] : $default;
	}
}

/* -------------------------------------------------------------------------- */
/*                       Deletes attachment by given url                      */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_delete_attachment' ) ) {
	function kite_delete_attachment( $url ) {
		global $wpdb;

		// We need to get the image's meta ID.
		$results = $wpdb->get_results( $wpdb->prepare( 'SELECT ID FROM ' . $wpdb->prefix . 'posts' . " where guid = %s AND post_type = 'attachment", $url ) );

		// And delete it
		foreach ( $results as $row ) {
			wp_delete_attachment( $row->ID );
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                                get page meta                               */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_meta' ) ) {

	function kite_get_meta( $key = '', $single = true ) {
		$pid = null;

		if ( in_the_loop() || is_single() || ( is_page() && ! is_home() ) ) {
			$pid = get_the_ID();
		}

		// Special case for blog page
		if ( is_home() && ! is_front_page() ) {
			$pid = get_option( 'page_for_posts' );
		}

		if ( function_exists( 'is_shop' ) ) {
			if ( is_shop() ) {

				$pid = get_option( 'woocommerce_shop_page_id' );// use woocommerce function : wc_get_page_id('shop') instead of get_option('woocommerce_shop_page_id')
			}
		}

		if ( null == $pid ) {
			return '';
		}
		if ( $key == '' ) {
			return get_post_meta( $pid, $key, false );// return all post metas
		} else {
			return get_post_meta( $pid, $key, $single );
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                      Get title of page inside its loop                     */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_the_title' ) ) {

	function kite_get_the_title() {
		$pid = null;

		if ( in_the_loop() || is_single() || ( is_page() && ! is_home() ) ) {

			$pid = get_the_ID();

		}

		// Special case for blog page
		if ( is_home() && ! is_front_page() ) {
			$pid = get_option( 'page_for_posts' );
		}

		if ( function_exists( 'is_shop' ) ) {
			if ( is_shop() ) {

				$pid = get_option( 'woocommerce_shop_page_id' );
			}
		}

		if ( null == $pid ) {
			return '';
		}
		return get_the_title( $pid );// return all post metas

	}
}

/* -------------------------------------------------------------------------- */
/*         Get video URL from known sources such as YouTube and vimeo         */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_extract_video_info' ) ) {
	function kite_extract_video_info( $string ) {
		// check for YouTube video URL
		if ( preg_match( '/https?:\/\/(?:www\.)?youtube\.com\/watch\?v=[^&\n\s"<>]+/i', $string, $matches ) ) {
			$url = parse_url( $matches[0] );
			parse_str( $url['query'], $queryParams );

			return array(
				'type' => 'youtube',
				'url'  => $matches[0],
				'id'   => $queryParams['v'],
			);
		}
		// Vimeo
		elseif ( preg_match( '/https?:\/\/(?:www\.)?vimeo\.com\/\d+/i', $string, $matches ) ) {
			$url = parse_url( $matches[0] );

			return array(
				'type' => 'vimeo',
				'url'  => $matches[0],
				'id'   => ltrim( $url['path'], '/' ),
			);
		}

		return null;
	}
}

/* -------------------------------------------------------------------------- */
/*                        Get Audio URL from SoundCloud                       */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_extract_audio_info' ) ) {
	function kite_extract_audio_info( $string ) {
		// check for soundcloud url
		if ( preg_match( '/https?:\/\/(?:www\.)?soundcloud\.com\/[^&\n\s"<>]+\/[^&\n\s"<>]+\/?/i', $string, $matches ) ) {
			return array(
				'type' => 'soundcloud',
				'url'  => $matches[0],
			);
		}

		return null;
	}
}

if ( ! function_exists( 'kite_soundcloud_get_embed' ) ) {
	function kite_soundcloud_get_embed( $url ) {
		$json = kite_get_url_content( "http://soundcloud.com/oembed?format=json&url=$url"/*, '127.0.0.1:86'*/ );

		if ( is_array( $json ) ) {
			return 'Server Error: ' . $json['error'] . " \nError No: " . $json['errorno'];
		}
		if ( trim( $json ) == '' ) {
			return 'Error: got empty response from soundcloud';
		}
		// Convert the response string to PHP object
		$data = json_decode( $json );

		if ( null == $data ) {
			return "Cant decode the soundcloud response \nData: $json";
		}
		return $data->html;
	}
}


/* -------------------------------------------------------------------------- */
/*                        Downloads data from given URL                       */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_url_content' ) ) {
	function kite_get_url_content( $url, $proxy = '' ) {
		$args = array(
			'headers'   => array(),
			'body'      => null,
			'sslverify' => true,
		);

		$response = wp_remote_get(
			$url,
			array(
				'timeout' => 45,
			)
		);

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			$ret           = array(
				'error'   => $error_message,
				'errorno' => '',
			);
		} else {
			$ret = $response['body'];
		}

		return $ret;
	}
}


/* -------------------------------------------------------------------------- */
/*                              Revolution slider                             */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_revolutionSlider_slides' ) ) {
	function kite_get_revolutionSlider_slides() {

		if ( class_exists( 'RevSlider' ) ) {

			// Get WPDB Object
			global $wpdb;

			// Get sliders
			$sliders = $wpdb->get_results(
				'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders' . '
												ORDER BY id ASC LIMIT 100'
			);
			$items   = array( 'no-slider' => esc_html__( 'No slider', 'teta-lite' ) );

			// Iterate over the sliders
			foreach ( $sliders as $key => $item ) {
				$items[ $item->alias ] = $item->alias;
			}
			return $items;
		}

	}
}

/* -------------------------------------------------------------------------- */
/*                                     CF7                                    */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_contact_form7_forms' ) ) {
	function kite_get_contact_form7_forms() {
		// Get WPDB Object
		global $wpdb;

		// Get forms
		$forms = $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}posts
                                      WHERE post_type='wpcf7_contact_form'
                                      LIMIT 100"
		);

		$items = array( 'no-form' => '' );

		// Iterate over the sliders
		foreach ( $forms as $key => $item ) {
			$items[ $item->ID ] = $item->post_title;
		}

		return $items;
	}
}

/* -------------------------------------------------------------------------- */
/*                  post pagination Search And Archive page!                  */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_pagination' ) ) {
	function kite_get_pagination( $args = [] ) {

		$output = '<div class="post-pagination">';

		$args['prev_text'] = esc_html__( 'Prev.', 'teta-lite' );
		$args['next_text'] = esc_html__( 'Next', 'teta-lite' );
		$args['mid_size'] = 2;
		if ( wp_is_mobile() ) {
			$args['end_size'] = 1;
			$args['mid_size'] = 1;
		}

		$output .= get_the_posts_pagination( $args );

		$output .= '</div><!-- post-pagination -->';

		echo wp_kses( $output, $GLOBALS['kite-allowed-tags'] );
	}
}

/* -------------------------------------------------------------------------- */
/*                  Add support for Vertical Featured Images.                 */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_thumbnail_vertical_check' ) ) {
	function kite_thumbnail_vertical_check( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		$image_data = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
		// Get the image width and height from the data provided by wp_get_attachment_image_src()
		if ( $image_data ) {
			$width  = $image_data[1];
			$height = $image_data[2];
			if ( $height > $width ) {
				$html = str_replace( 'attachment-', 'vertical-image attachment-', $html );
			}
		}
		return $html;
	}
}

add_filter( 'post_thumbnail_html', 'kite_thumbnail_vertical_check', 10, 5 );

/* -------------------------------------------------------------------------- */
/*                           Search Pages by content                          */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_search_pages_by_content' ) ) {
	function kite_search_pages_by_content( $cnt ) {
		// Get WPDB Object
		global $wpdb;

		// Get forms
		$pages = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_content LIKE %s",
				'%' . $wpdb->esc_like( $cnt ) . '%'
			)
		);

		return $pages;
	}
}


/* -------------------------------------------------------------------------- */
/*                            Sidebar widget count                            */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_count_sidebar_widgets' ) ) {
	function kite_count_sidebar_widgets( $sidebar_id, $echo = false ) {
		$sidebars = get_option( 'sidebars_widgets', array() );
		if ( is_array( $sidebars ) && isset( $sidebars['array_version'] ) ) {
			unset( $sidebars['array_version'] );
		}

		if ( ! isset( $sidebars[ $sidebar_id ] ) ) {
			return -1;
		}
		$cnt = count( $sidebars[ $sidebar_id ] );

		if ( $echo ) {
			echo esc_html( $cnt );
		} else {
			return $cnt;
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                                 Get Sidebar                                */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_get_sidebar' ) ) {
	function kite_get_sidebar( $id = 1, $class = '' ) {
		if ( kite_count_sidebar_widgets( $id ) < 1 ) {
			$class .= ' no-widgets';
		}
		?>
		<div class="<?php echo esc_attr( $class ); ?>">
			<?php if ( $id == 'main-sidebar' ) { ?>
				<span class="kt-sidebar-title hidden-desktop hidden-tablet"><?php esc_html_e( 'Widget Area', 'teta-lite' );?></span>
			<?php } ?>
			<?php dynamic_sidebar( $id ); ?>
		</div>
		<?php
	}
}

/* -------------------------------------------------------------------------- */
/*                       Get all exception pages of ajax                      */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_no_ajax_pages' ) ) {
	function kite_no_ajax_pages() {

		$no_ajax_pages = array();

		// Get translation pages for current page and merge with main array

		$no_ajax_pages = array_merge( $no_ajax_pages, kite_get_wpml_pages_of_current_page() );

		// Add logout URL to main array
		$no_ajax_pages[] = wp_specialchars_decode( wp_logout_url() );

		return $no_ajax_pages;
	}
}

if ( ! function_exists( 'kite_get_wpml_pages_of_current_page' ) ) {
	function kite_get_wpml_pages_of_current_page() {
		$wpml_pages_of_current_page = array();

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			$language_pages = icl_get_languages( 'skip_missing=0' );

			foreach ( $language_pages as $key => $language_page ) {
				$wpml_pages_of_current_page[] = $language_page['url'];
			}
		}

		return $wpml_pages_of_current_page;
	}
}

// add 'row' that wrap feilds
if ( ! function_exists( 'kite_comment_before_fields' ) ) {
	function kite_comment_before_fields() {
		echo '<div class="row">';
	}
}

if ( ! function_exists( 'kite_comment_after_fields' ) ) {
	function kite_comment_after_fields() {
		echo '</div>';
	}
}

/*-----------------------------------------------------------------*/
// allowed skype protocol
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_ss_allow_skype_protocol' ) ) {
	function kite_ss_allow_skype_protocol( $protocols ) {
		$protocols[] = 'skype';
		return $protocols;
	}
}
add_filter( 'kses_allowed_protocols', 'kite_ss_allow_skype_protocol' );

/*-----------------------------------------------------------------*/
// Newsletter embedding (MailPoet)
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_get_mail_poet_forms' ) ) {
	function kite_get_mail_poet_forms() {

		// Get WPDB Object
		   global $wpdb;

		if ( class_exists( 'WYSIJA_NL_Widget' ) ) {// If the plugin is installed and activated create the shortcode

			// Get Form Values and IDs
			if ( $wpdb->get_var( "SHOW TABLES LIKE {$wpdb->prefix}wysija_form" ) == $wpdb->prefix . 'wysija_form' ) {// If we had the DB
				$mailPoetForm = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wysija_form" );
				$items        = array();

				// Iterate over the Forms
				foreach ( $mailPoetForm  as $value ) {
					 $items[ $value->name ] = $value->form_id;
				}
				if ( ! is_array( $items ) ) {
					return array();
				}
				return $items;
			}

			return array();

		}

		return array();
	}
}

/* -------------------------------------------------------------------------- */
/*              increase quality of WordPress thumbnails images.              */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_thumbnail_quality' ) ) {
	function kite_thumbnail_quality( $quality ) {
		return 100;
	}
}
add_filter( 'jpeg_quality', 'kite_thumbnail_quality' );
add_filter( 'wp_editor_set_quality', 'kite_thumbnail_quality' );

/*---------------------------------
	kite_get_template_part
------------------------------------*/
/**
 * Like get_template_part() lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 *
 * @param string filepart
 * @param mixed wp_args style argument list
 */

if ( ! function_exists( 'kite_get_template_part' ) ) {

	function kite_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
		$template_args = wp_parse_args( $template_args );
		$cache_args    = wp_parse_args( $cache_args );
		if ( $cache_args ) {
			foreach ( $template_args as $key => $value ) {
				if ( is_scalar( $value ) || is_array( $value ) ) {
					$cache_args[ $key ] = $value;
				} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
					$cache_args[ $key ] = call_user_func( 'get_id', $value );
				}
			}
			if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
				if ( ! empty( $template_args['return'] ) ) {
					return $cache;
				}
				echo '' . $cache;
				return;
			}
		}
		$file_handle = $file;
		do_action( 'start_operation', 'kite_template_part::' . $file_handle );
		if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
			$file = get_stylesheet_directory() . '/' . $file . '.php';
		} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
			$file = get_template_directory() . '/' . $file . '.php';
		}
		ob_start();
		$return = require $file;
		$data   = ob_get_clean();
		do_action( 'end_operation', 'kite_template_part::' . $file_handle );
		if ( $cache_args ) {
			wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
		}
		if ( ! empty( $template_args['return'] ) ) {
			if ( $return === false ) {
				return false;
			} else {
				return $data;
			}
		}
		echo '' . $data;
	}
}

/*-----------------------------------------------------------------*/
// Size Guide plugin
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_size_guide_plugin_styles' ) ) {

	function kite_size_guide_plugin_styles() {
		wp_dequeue_style( 'ct.sizeguide.style.css' );
		wp_dequeue_style( 'magnific.popup.css' );
		wp_dequeue_script( 'magnific.popup.js' );
		wp_dequeue_script( 'ct.sg.front.js' );
	}
}
add_action( 'wp_print_styles', 'kite_size_guide_plugin_styles' );


/*-----------------------------------------------------------------*/
// Custom Product Tabs for WooCommerce - Remove title
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_remove_yikes_custom_tab_heading' ) ) {

	function kite_remove_yikes_custom_tab_heading( $heading ) {
		return '';
	}
}
add_filter( 'yikes_woocommerce_custom_repeatable_product_tabs_heading', 'kite_remove_yikes_custom_tab_heading' );

/*-----------------------------------------------------------------*/
// wrap all sidebars
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_widget_sidebar' ) ) {
	function kite_widget_sidebar( $index ) {
		$footer_areas = array( 'footer-widget-1', 'footer-widget-2', 'footer-widget-3', 'footer-widget-4', 'footer-widget-5', 'footer-widget-6', 'footer-widget-7' );
		if ( in_array( $index, $footer_areas ) ) {
			return;
		}

		if ( ! is_admin() ) {
			echo '<div class="sidebar widget-area">';
		}
	}
}


if ( ! function_exists( 'kite_widget_sidebar_end' ) ) {
	function kite_widget_sidebar_end( $index ) {
		$footer_areas = array( 'footer-widget-1', 'footer-widget-2', 'footer-widget-3', 'footer-widget-4', 'footer-widget-5', 'footer-widget-6', 'footer-widget-7' );
		if ( in_array( $index, $footer_areas ) ) {
			return;
		}
		if ( ! is_admin() && $index != 'sidebar-store' ) { // sidebar-store is sidebar of dokan plugin (Due to adding widgets witout dynamic_sidebar when sidebar is empty in dokan! the closing tag in "sidebar-store" addded by "dokan_sidebar_store_after" action  )
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'kite_dokan_widget_sidebar_end' ) ) {
	function kite_dokan_widget_sidebar_end() {
		if ( ! is_admin() ) {
			echo '</div>';
		}
	}
}
add_action( 'dynamic_sidebar_before', 'kite_widget_sidebar', 10 );
add_action( 'dynamic_sidebar_after', 'kite_widget_sidebar_end', 10 );
add_action( 'dokan_sidebar_store_after', 'kite_dokan_widget_sidebar_end', 10 );

/*-----------------------------------------------------------------*/
// Cookie Law info  - cookie bar
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_cookies_popup' ) ) {

	add_action( 'wp_footer', 'kite_cookies_popup', 300 );

	function kite_cookies_popup() {

		if ( empty( kite_opt( 'cookies_info', false ) ) && ! isset( $_GET['gdpr'] )  ) {
			return;
		}
		$page_id = kite_opt( 'cookies_policy_page', '' );

		?>
			<div class="kt-cookies-bar">
				<div class="kt-cookies-inner">
					<div class="cookies-info-text">
						<?php echo do_shortcode( kite_opt( 'cookies_text_message', '' ) ); ?>
					</div>
					<div class="cookies-buttons">
						<?php if ( $page_id ) : ?>
							 <a href="<?php echo get_page_link( $page_id ); ?>" class="cookies-more-btn" target="_blank"><?php esc_html_e( 'More info', 'teta-lite' ); ?></a>
						<?php endif; ?>
						<a href="<?php echo esc_url( '#' ); ?>" class="cookies-accept-btn"><?php esc_html_e( 'Accept', 'teta-lite' ); ?></a>
					</div>
				</div>
			</div>
		<?php

	}
}
 // set cookie when woocommerce is not installed
if ( ! kite_woocommerce_installed() ) {
	add_action( 'wp_enqueue_scripts', 'kite_custom_frontend_scripts' );
}

if ( ! function_exists( 'kite_custom_frontend_scripts' ) ) {
	function kite_custom_frontend_scripts() {
		wp_register_script( 'js-cookie', KITE_THEME_ASSETS_URI . '/js/js.cookie.js', array( 'jquery' ), '2.1.4', true );
		wp_enqueue_script( 'js-cookie' );
	}
}

/*-----------------------------------------------------------------*/
// Maintenance mode
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_maintenance_page' ) ) {
	function kite_maintenance_page() {
		global $pagenow;
		$maintenance_mode = ( isset( $_GET['maintenance-mode'] ) && ! empty( kite_opt( 'maintenance_page', '' ) ) ) ? true : kite_opt( 'maintenance_mode', true );

		if ( ! $maintenance_mode ) {
			return;
		}

		$page_id = kite_opt( 'maintenance_page', '' );

		if ( empty( $page_id ) ) {
			return;
		}
		if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
			wp_redirect( get_permalink( $page_id ) );
			exit();
		}
	}
}
add_action( 'get_header', 'kite_maintenance_page' );


/*-----------------------------------------------------------------*/
// Instagram
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_pretty_number' ) ) {
	function kite_pretty_number( $x = 0 ) {
		$x = (int) $x;

		if ( $x > 1000000 ) {
			return floor( $x / 1000000 ) . 'M';
		}

		if ( $x > 10000 ) {
			return floor( $x / 1000 ) . 'k';
		}
		return $x;
	}
}

if ( ! function_exists( 'kite_scrape_instagram' ) ) {
	function kite_scrape_instagram( $username, $slice = 9 ) {
		$username       = strtolower( $username );
		$by_hashtag     = ( substr( $username, 0, 1 ) == '#' );
		$transient_name = 'instagram-media-new-' . sanitize_title_with_dashes( $username );
		$instagram      = get_transient( $transient_name );

		if ( false === $instagram ) {

			$request_param = ( $by_hashtag ) ? 'explore/tags/' . substr( $username, 1 ) : trim( $username );
			$remote        = wp_remote_get( 'https://instagram.com/' . $request_param );
			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'teta-lite' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'teta-lite' ) );
			}
			$instagram = kite_instagram_decode( $remote['body'], $by_hashtag, false );
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) && ! is_wp_error( $instagram ) ) {
				$instagram = maybe_serialize( $instagram );
				set_transient( $transient_name, $instagram, apply_filters( 'null_instagram_cache_time', DAY_IN_SECONDS * 2 ) );
			}
		}
		if ( ! empty( $instagram ) && ! is_wp_error( $instagram ) ) {
			$instagram = maybe_unserialize( $instagram );
			return array_slice( $instagram, 0, $slice );
		} else {
			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'teta-lite' ) );
		}
	}
}
function kite_instagram_decode( $insta_html_response, $by_hashtag, $ajax_request = false  ) {
	if ( empty( $insta_html_response ) ) {
		return;
	}
	$shards     = explode( 'window._sharedData = ', $insta_html_response );
	$insta_json = explode( ';</script>', $shards[1] );
	if ( $ajax_request ) {
		$insta_array = json_decode( stripslashes( $insta_json[0] ), true );
	} else {
		$insta_array = json_decode( $insta_json[0], true );
	}
	if ( ! $insta_array ) {
		return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'teta-lite' ) );
	}

	if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
		$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
	} elseif ( $by_hashtag && isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
		$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
	} else {
		return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'teta-lite' ) );
	}

	if ( ! is_array( $images ) ) {
		return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'teta-lite' ) );
	}

	$instagram = array();

	foreach ( $images as $image ) {
		$image = $image['node'];

		$caption = esc_html__( 'Instagram Image', 'teta-lite' );
		if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
			$caption = $image['edge_media_to_caption']['edges'][0]['node']['text'];
		}

		$image['thumbnail_src'] = preg_replace( '/^https:/i', '', $image['thumbnail_src'] );
		$image['thumbnail']     = preg_replace( '/^https:/i', '', $image['thumbnail_resources'][0]['src'] );
		$image['medium']        = preg_replace( '/^https:/i', '', $image['thumbnail_resources'][2]['src'] );
		$image['large']         = $image['thumbnail_src'];

		$type = ( $image['is_video'] ) ? 'video' : 'image';

		$instagram[] = array(
			'description' => $caption,
			'link'        => '//instagram.com/p/' . $image['shortcode'],
			'comments'    => $image['edge_media_to_comment']['count'],
			'likes'       => $image['edge_liked_by']['count'],
			'thumbnail'   => $image['thumbnail'],
			'medium'      => $image['medium'],
			'large'       => $image['large'],
			'type'        => $type,
		);
	}
	return $instagram;
}

/*-----------------------------------------------------------------*/
// Social Share buttons
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_social_share' ) ) {
	function kite_social_share() {
		$socialshare = kite_opt( 'social_share_display', false ); // theme settings;
		if ( $socialshare != 0 ) {
			?>
			<div class="socialshare-container">
				<div class="label hidden-phone hidden-v-tablet"> <?php esc_html_e( 'Share ', 'teta-lite' ); ?> </div>
				<?php
			   	get_template_part( 'templates/social-share' );
				echo kite_generate_social_share_markup();
			   	?>
			</div>
			<?php
		}
	}
}

/*-----------------------------------------------------------------*/
// add animation option to VC row
/*-----------------------------------------------------------------*/

if ( ! function_exists( 'kite_get_row_animation_attr' ) ) {
	function kite_get_row_animation_attr( $output, $obj, $attr ) {
		if ( ! class_exists( 'Vc_Manager') ) {
			return;
		}
		if ( ! empty( $attr['row_animation'] ) ) {

			$row_animation = $attr['row_animation'];
			if ( isset( $attr['row_animation_delay'] ) ) {
				$data_delay = $attr['row_animation_delay'];
			} else {
				$data_delay = 0;
			}

			$output = preg_replace_callback(
				'/row-animation-enable.*?"/',
				function ( $matches ) use ( $row_animation, $data_delay ) {
					return strtolower( $matches[0] . '  data-animation="' . $row_animation . '" data-delay="' . $data_delay . '"' );
				},
				$output
			);
		}
		return $output;
	}
}
add_filter( 'vc_shortcode_output', 'kite_get_row_animation_attr', 10, 3 );

/*-----------------------------------------------------------------*/
// Instagram Hashtag
/*-----------------------------------------------------------------*/
add_action( 'woocommerce_after_single_product_summary', 'kite_instagram_hashtag', 30 );
if ( ! function_exists( 'kite_instagram_hashtag' ) ) {
	function kite_instagram_hashtag() {

		if ( ! kite_opt( 'instagram_in_product_detail', false ) ) {
			return;
		}

		$hashtag = get_post_meta( get_the_ID(), 'product_hashtag', true );
		$method = kite_opt( 'product_detail_use_instagram_api', false ) ? 'api' : '';

		$instagram_html = kite_sc_instgram_feed(
			array(
				'method'			  => $method,
				'user'                => esc_html( $hashtag ),
				'column'              => '6',
				'image_resolution'    => 'medium',
				'carousel'            => 'enable',
				'enterance_animation' => 'disable',
				'like'                => 'enable',
				'gutter'              => 'no',
				'comment'             => 'enable',

			)
		);
		if ( ! empty( $instagram_html ) ) {
			?>

			<div class="kite_instagram_product">

				<?php if ( $method != 'api' ) { ?>
					<div class="product-instagram">
						<h3> <?php echo esc_attr( $hashtag ); ?></h3>
						<?php esc_html_e( 'Tag your photos with this on Instagram.', 'teta-lite' ); ?>
					</div>
				<?php } elseif( false != $username = get_transient( 'kite_instagram_username' ) ) { ?>
					<div class="product-instagram">
						<h3>@<?php echo esc_attr( $username ); ?></h3>
						<?php esc_html_e( 'Find us on Instagram.', 'teta-lite' ); ?>
					</div>
				<?php } ?>
					<?php echo wp_kses( $instagram_html, $GLOBALS['kite-allowed-tags'] ); ?>
			</div>
			<?php
		}
	}
}

/*-----------------------------------------------------------------*/
// Popup Newsletter
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_popup_newsletter_content' ) ) {
	function kite_popup_newsletter_content() {

		if ( ! kite_opt( 'popupNewsletterDisplay', false ) || kite_opt( 'popupNewsletterDisplay', false ) == '0' ) {
			return;
		} else {

			if ( kite_opt( 'popupNewsLetterDisplayMobile', false ) == '0' ) {
				echo '<div id="kt-popup-newsletter" class="hidden-phone">';
			} else {
				echo '<div id="kt-popup-newsletter">';
			}
			kite_popup_newsletter();
			echo '</div>';

		}
	}
}
add_action( 'wp_footer', 'kite_popup_newsletter_content', 50 );


if ( ! function_exists( 'kite_popup_newsletter' ) ) {
	function kite_popup_newsletter() {
		$delay = ( kite_opt( 'popupNewsLetterDelay', '1000' ) == '' ? '500' : kite_opt( 'popupNewsLetterDelay', '1000' ) );
		?>
		<div class="kt-popup-newsletter-inner <?php echo ( ! kite_opt( 'popupNewsLetterBackgroundImage' ) ) ? ' no_bg_image' : ''; ?>" data-delay="<?php echo esc_attr( $delay ); ?>">
		<?php
				echo '<div class="kt-popup-newsletter-close"></div>';
		?>
		<?php if ( kite_opt( 'popupNewsLetterBackgroundImage' ) ) { ?>
					<div class="kt-popup-newsletter-image" style="background: url(<?php echo esc_url( kite_opt( 'popupNewsLetterBackgroundImage' ) ); ?>) center no-repeat"></div>
				<?php } ?>

				<div class="kt-popup-newsletter-content">
					<h4 class="kt-popup-newsletter-title">
						<?php echo wp_kses( kite_opt( 'popupNewsLetterTitle' ), $GLOBALS['kite-allowed-tags'] ); ?>
					</h4>

					<h6 class="kt-popup-newsletter-subtitle">
						<?php echo wp_kses( kite_opt( 'popupNewsLetterSubtitle' ), $GLOBALS['kite-allowed-tags'] ); ?>
					</h6>

					<div class="kt-popup-newsletter-shortcode kt-newsletter">
						<?php echo do_shortcode( kite_opt( 'popupNewsLetterShortcode' ) ); ?>
					</div>

					<p class="kt-popup-newsletter-text">
						<?php echo wp_kses( kite_opt( 'popupNewsLetterText' ), $GLOBALS['kite-allowed-tags'] ); ?>
					</p>

				</div>
			</div>
		<?php
	}
}

//
// ─── NEWSLETTER - EMBEDDING MAILPOET - V3 ───────────────────────────────────────────
//

if ( ! function_exists( 'kite_get_mailpoet_forms' ) ) {
	function kite_get_mailpoet_forms() {

		// Get WPDB Object
		   global $wpdb;
		if ( function_exists( 'mailpoet_deactivate_plugin' ) ) {// If the plugin is installed and activated create the shortcode

			// Get Form Values and IDs
			if ( $wpdb->get_var( "SHOW TABLES LIKE {$wpdb->prefix}mailpoet_forms" ) == $wpdb->prefix . 'mailpoet_forms' ) {// If we had the DB
				$mailPoetForm = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}mailpoet_forms" );
				$items        = array();
				// Iterate over the Forms
				foreach ( $mailPoetForm  as $value ) {
					 $items[ $value->name ] = $value->id;
				}
				if ( ! is_array( $items ) ) {
					return array();
				}
				return $items;
			}

			return array();

		}

		return array();
	}
}

//
// ─── GET MAILCHIMP FORMS ID ─────────────────────────────────────────────────────
//

function kite_get_mailchimp_forms() {
	$options = array( '' => esc_html__('Select the form to show', 'teta-lite' ) ) ;
	if( ! function_exists('mc4wp_get_forms') ) {
		return $options;
	}

	$forms  = mc4wp_get_forms();
	foreach( $forms as $form ) {
		$options[ $form->ID ] = $form->name;
	}

    return $options;
}
/*
-----------------------------------------------------------------*/
// comment submit button
/*-----------------------------------------------------------------*/
if ( ! function_exists( 'kite_wc_comment_submit' ) ) {
	function kite_wc_comment_submit( $submit_button ) {
		$submit_button = '<div class="kt_button button-medium style2 fill text"><span class="txt" data-hover="' . esc_attr__( 'Submit', 'teta-lite' ) . ' "></span><span>' . $submit_button . '</span></div>';
		return $submit_button;
	}
}
add_filter( 'comment_form_submit_button', 'kite_wc_comment_submit' );
/*
-----------------------------------------------------------------*/
// visual composer FrontEnd editor
/*-----------------------------------------------------------------*/
function kite_get_vc_front_end_editor_link() {
	if ( ! class_exists( 'Vc_Manager' ) ) {
		return;
	}
	global $post;
	if ( ! is_object( $post ) ) {
		return;
	}
	$GLOBALS['pageID'] = $post->ID;
	add_filter(
		'vc_get_inline_url',
		function() {
			$the_ID = $GLOBALS['pageID'];
			return admin_url() . 'post.php?vc_action=vc_inline&post_id=' . $the_ID . '&post_type=' . get_post_type( $the_ID );
		}
	);
}
add_action( 'wp_head', 'kite_get_vc_front_end_editor_link' );


/*-----------------------------------------------------------------*/
// resonsive font size
/*-----------------------------------------------------------------*/

function kite_responsive_font_size( $selector = '', $fontsizes = '', $lineHeight = '' ) {

	$fontsizes       = explode( ',', $fontsizes );
	$lineHeight      = explode( ',', $lineHeight );
	$kiteInlineStyle = '';
	if ( empty( $selector ) || count( $fontsizes ) < 3 ) {
		return $kiteInlineStyle;
	}
	if ( ! empty( $fontsizes[0] ) ) {
		$kiteInlineStyle .= '@media(min-width:1140px){' . $selector . ' {font-size:' . $fontsizes[0] . 'px;line-height:' . ( ( ! empty( $lineHeight[0] ) ) ? $lineHeight[0] : $fontsizes[0] ) . 'px;}}';
	}

	if ( ! empty( $fontsizes[1] ) ) {
		$kiteInlineStyle .= '@media(max-width:1140px){' . $selector . ' {font-size:' . $fontsizes[1] . 'px;line-height:' . ( ( ! empty( $lineHeight[1] ) ) ? $lineHeight[1] : $fontsizes[1] ) . 'px;}}';
	} elseif ( ! empty( $fontsizes[0] ) ) {
		$kiteInlineStyle .= '@media(max-width:1140px){' . $selector . ' {font-size:' . $fontsizes[0] . 'px;line-height:' . ( ( ! empty( $lineHeight[0] ) ) ? $lineHeight[0] : $fontsizes[0] ) . 'px;}}';
	}

	if ( ! empty( $fontsizes[2] ) ) {
		$kiteInlineStyle .= '@media(max-width:767px){' . $selector . ' {font-size:' . $fontsizes[2] . 'px;line-height:' . ( ( ! empty( $lineHeight[2] ) ) ? $lineHeight[2] : $fontsizes[2] ) . 'px;}}';
	} elseif ( ! empty( $fontsizes[1] ) ) {
		$kiteInlineStyle .= '@media(max-width:767px){' . $selector . ' {font-size:' . $fontsizes[1] . 'px;line-height:' . ( ( ! empty( $lineHeight[1] ) ) ? $lineHeight[1] : $fontsizes[1] ) . 'px;}}';
	} elseif ( ! empty( $fontsizes[0] ) ) {
		$kiteInlineStyle .= '@media(max-width:767px){' . $selector . ' {font-size:' . $fontsizes[0] . 'px;line-height:' . ( ( ! empty( $lineHeight[0] ) ) ? $lineHeight[0] : $fontsizes[0] ) . 'px;}}';
	}
	return $kiteInlineStyle;
}

/* -------------------------------------------------------------------------- */
/*                          Elementor Container size                          */
/* -------------------------------------------------------------------------- */

add_action( 'redux/loaded', 'kite_set_elementor_container_size' );

function kite_set_elementor_container_size() {
	// Check if elementor is active or not
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}
	if ( kite_opt( 'container_size', true ) ) {
		update_option( 'elementor_container_width', '1170' );
	} else {
		update_option( 'elementor_container_width', kite_opt( 'dynamic_container_size', '1170' ) );
	}
}

function kite_prefix_kses_allowed_html( $tags, $context ) {
	switch ( $context ) {
		case 'socialtags':
			$tags = array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
				),
				'h1'     => array(),
				'h2'     => array(),
				'h3'     => array(),
				'h4'     => array(),
				'h5'     => array(),
				'h6'     => array(),
				'p'      => array(),
				'ul'     => array(),
				'li'     => array(),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
			);
			return $tags;
		break;
		case 'socialentities':
			$tags = array(
				'em'     => array(),
				'i'      => array(),
				'strong' => array(),
				'span'   => array(
					'class' => array(),
					'style' => array(),
				),
			);
			return $tags;
		break;
		return $tags;
		default:
			return $tags;
	}
}
add_filter( 'wp_kses_allowed_html', 'kite_prefix_kses_allowed_html', 20, 2 );
/*--------------------------------------------------------------------------------
Kite Related Posts
---------------------------------------------------------------------------------*/
function kite_related_posts( $post, $related_count = 3 ) {
	global $post;
	$post_id = $post->ID;
	$terms   = get_the_terms( $post_id, 'category' );

	if ( empty( $terms ) ) {
		$terms = array();
	}

	$term_list = wp_list_pluck( $terms, 'slug' );

	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'rand',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $term_list,
			),
		),
	);

	$query = new WP_Query( $related_args );
	ob_start();
	if ( $query->have_posts() ) {
		echo "<div class='related-posts-title'><span>" . __( 'Related Posts', 'teta-lite' ) . '</span></div>';
		?>
		<div class="related-posts-container">
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
			<div class="related-post">
				<span class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
				<span class="post-info">
					<span class="post-date"><?php echo get_the_date(); ?></span>
					<span class="post-author kt-icon icon-user" data-name="user"><?php the_author_posts_link(); ?></span>
					<?php if ( comments_open() ) { ?>
					<span class="post-comments kt-icon icon-bubble" data-name="bubble">
						<?php
						if ( comments_open() ) {
							comments_popup_link( '0', '1', '%', 'comments-link', '' );}
						?>
					</span>
					<?php } ?>
				</span>
			</div>
			<?php
		}
		?>
		</div>
		<?php
	}
	wp_reset_postdata();
	return ob_get_clean();

}
if ( ! function_exists( 'kite_custom_comment_author_link' ) ) {
	function kite_custom_comment_author_link( $return, $author, $comment_id ) {
		$comment = get_comment( $comment_id );
		$avatar  = get_avatar( $comment, $size = '30' );
		return $avatar . '<span>' . $author . '</span>';
	}
}
add_filter( 'get_comment_author_link', 'kite_custom_comment_author_link', 10, 3 );


add_filter( 'jet-elements/allowed-vendor-addons', 'kite_disable_jet_woo_widgets', 1 );
function kite_disable_jet_woo_widgets( $widgets ) {
	if ( isset( $widgets['woo_recent_products'] ) ) {
		unset( $widgets['woo_recent_products'] );
	}

	if ( isset( $widgets['woo_featured_products'] ) ) {
		unset( $widgets['woo_featured_products'] );
	}

	if ( isset( $widgets['woo_sale_products'] ) ) {
		unset( $widgets['woo_sale_products'] );
	}

	if ( isset( $widgets['woo_best_selling_products'] ) ) {
		unset( $widgets['woo_best_selling_products'] );
	}

	if ( isset( $widgets['woo_top_rated_products'] ) ) {
		unset( $widgets['woo_top_rated_products'] );
	}

	if ( isset( $widgets['woo_product'] ) ) {
		unset( $widgets['woo_product'] );
	}

	if ( isset( $widgets['contact_form7'] ) ) {
		unset( $widgets['contact_form7'] );
	}

	return $widgets;
}

/* -------------------------------------------------------------------------- */
/*                              Add Social Login                              */
/* -------------------------------------------------------------------------- */

add_action( 'woocommerce_login_form_start', 'kite_add_social_login' );
function kite_add_social_login() {
	$google_app_id       = kite_opt( 'google_app_id' );
	$google_app_secret   = kite_opt( 'google_app_secret' );
	$facebook_app_id     = kite_opt( 'facebook_app_id' );
	$facebook_app_secret = kite_opt( 'facebook_app_secret' );
	if ( class_exists( 'Social_Network_Authentication' ) && ( ( ! empty( $facebook_app_id ) && ! empty( $facebook_app_secret ) ) || ( ! empty( $google_app_id ) && ! empty( $google_app_secret ) ) ) ) :
		?>
		<div class="kite-social-login">
				<ul class="social-login-btn social-icons">
				<?php if ( ! empty( $facebook_app_id ) && ! empty( $facebook_app_secret ) ) : ?>
					<li class="sociallink-shortcode iconstyle facebook">
						<a href="<?php echo add_query_arg( 'social_auth', 'facebook', wc_get_page_permalink( 'myaccount' ) ); ?>" title="facebook login">
							<span class="firsticon icon icon-facebook"></span>
							<span class="second-icon icon icon-facebook"></span>
						</a>
					</li> 
					<?php endif; ?>
					<?php
					if ( ! empty( $google_app_id ) && ! empty( $google_app_secret ) ) :
					?>
					<li class="sociallink-shortcode iconstyle google">
						<a href="<?php echo add_query_arg( 'social_auth', 'google', wc_get_page_permalink( 'myaccount' ) ); ?>" title="google login">
							<span class="firsticon icon icon-google-plus"></span>
							<span class="second-icon icon icon-google-plus"></span>
						</a>
					</li> 
					<?php endif; ?>
				</ul>

		</div>
		<?php
	endif;
}

//
// ─── LOAD WIDGETIZED FOOTER ─────────────────────────────────────────────────────
//
add_action( 'kite_footer_action', 'kite_widgetized_footer', 5 );
function kite_widgetized_footer() {
    $woocommerce_check = class_exists('WooCommerce') ? true : false;

    if ( is_page() ) {
        $widgetized_footer = kite_get_meta("footer-widget-area");

        if ($widgetized_footer == "inherit") {

            if( kite_opt( 'footer-widget-area', false ) ) {
                //Footer Widgetized Area
                get_template_part('templates/section', 'widgetized_footer');
            }

        } elseif( $widgetized_footer == "enable" ) {
            //Footer Widgetized Area
            get_template_part('templates/section', 'widgetized_footer');
        }
    } elseif ( $woocommerce_check && ( is_product_category() || is_product_tag() ) ) {
        if ( kite_opt( 'category_widget_area', false ) ) {
            //Footer Widgetized Area
            get_template_part('templates/section', 'widgetized_footer');
        }
    } elseif ( $woocommerce_check && is_product() ) {
        if ( kite_opt( 'product_widget_area', false ) ) {
            //Footer Widgetized Area
            get_template_part('templates/section', 'widgetized_footer');
        }

    } else {
        if ( kite_opt( 'footer-widget-area', false ) ) {
            //Footer Widgetized Area
            get_template_part('templates/section', 'widgetized_footer');
        }
    }


}

//
// ─── Compatibility custom Product tab with elementor  ────────────────────────────────────
//

add_filter( 'yikes_woo_use_the_content_filter', '__return_false' );

add_filter( 'yikes_woo_filter_main_tab_content', 'yikes_woo_custom_tab_content_filter', 10, 1 );

function yikes_woo_custom_tab_content_filter( $content ) {

	$content = function_exists( 'capital_P_dangit' ) ? capital_P_dangit( $content ) : $content;
	$content = function_exists( 'wptexturize' ) ? wptexturize( $content ) : $content;
	$content = function_exists( 'convert_smilies' ) ? convert_smilies( $content ) : $content;
	$content = function_exists( 'wpautop' ) ? wpautop( $content ) : $content;
	$content = function_exists( 'shortcode_unautop' ) ? shortcode_unautop( $content ) : $content;
	$content = function_exists( 'prepend_attachment' ) ? prepend_attachment( $content ) : $content;
	$content = function_exists( 'wp_make_content_images_responsive' ) ? wp_make_content_images_responsive( $content ) : $content;

	if ( class_exists( 'WP_Embed' ) ) {

		// Deal with URLs
		$embed = new WP_Embed;
		$content = method_exists( $embed, 'autoembed' ) ? $embed->autoembed( $content ) : $content;
	}

	return $content;
}

//
// ─── KITE FUNCTION TO GENERATE SEARCH FORM ──────────────────────────────────────
//
if ( ! function_exists( 'kite_generate_search_form' ) ) {
	function kite_generate_search_form( $args = array() ) {
		$defaults = array(
			'wrap_id'				=> '',
			'wrap_classes'			=> 'kt-search-form-wrap',
			'form_classes' 			=> 'kt-search-form',
			'style'					=> 'light',
			'terms'	  				=> array(),
			'search_place_holder' 	=> esc_attr__( 'Search Posts', 'teta-lite' ),
			'search_post_type'		=> 'post',
			'search_icon'			=> 'icon icon-search',
			'svg_icon'				=> false,
			'svg_url'				=> ''
		);

		$args = wp_parse_args( $args, $defaults );

		/**
		 * Modify search args before generating search form
		 */
		$args = apply_filters( 'kite_search_form_args', $args );

		get_search_form( array_merge( $args, [
			'kite-modern-search-form'	=> true
		]));
	}
}

//
// ─── KITE FUNCTION TO RENDER ELEMENTOR TEMPLATE ─────────────────────────────────
//
function kite_render_elementor_template( $template_ID ) {
	if ( class_exists( '\Elementor\Plugin' ) ) {
		echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_ID );
	}
}

//
// ─── KITE FUNCTION TO RETURN ELEMENTOR LIBRARIES BY TYPE ────────────────────────
//
if( ! function_exists('kite_get_elementor_templates_list') ) {
    function kite_get_elementor_templates_list( $template_type = 'all' ){
        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'elementor_library',
            'post_status'      => 'publish'
        );

		$output = array( '' => esc_html__( 'Select a template', 'teta-lite' ) );

		if( $template_type !== 'all' ){
            $args['meta_key']   = '_elementor_template_type';
            $args['meta_value'] = $template_type;
        }


		$posts  = get_posts( $args );

		foreach ( $posts as $key => $value ) {
			$output[ $value->ID ] =  $value->post_title;
		}

        return $output;
    }
}

function kite_allowed_html() {

	$GLOBALS['kite-allowed-tags'] = array(
		'a' => array(
			'class' => array(),
			'id' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
			'data-product_id'	=> array(),
			'data-quantity'		=> array(),
			'data-min-quantity'	=> array(),
			'target' => array(),
			'data-nonce' => array()
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
			'data-layoutmode' 	=> array(),
			'data-layoutMode' 	=> array(),
			'data-delay' 		=> array(),
			'data-animation' 	=> array(),
			'data-autoplay' 	=> array(),
			'data-visibleitems' 	=> array(),
			'data-product-page-preselected-id' 	=> array(),
			'data-responsive-autoplay'    => array()
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'i' => array(),
		'img' => array(
			'alt'    	=> array(),
			'class'  	=> array(),
			'height' 	=> array(),
			'src'    	=> array(),
			'srcset'    => array(),
			'data-src'  => array(),
			'data-srcset' => array(),
			'width'  	=> array(),
			'sizes'  	=> array(),

		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
		),
	);
}
kite_allowed_html();

//
// ─── GET PRIMARY CATEGORY OF POST ───────────────────────────────────────────────
//
function kite_get_post_primary_category( $post_id, $term = 'category', $return_all_categories = false ) {
    $return = [];

    if ( class_exists( 'WPSEO_Primary_Term' ) ){
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
        $primary_term = get_term( $wpseo_primary_term->get_primary_term() );

        if ( ! is_wp_error( $primary_term ) ) {
            $return['primary_category'] = $primary_term;
        }
    }

    if ( empty( $return['primary_category'] ) || $return_all_categories ) {
        $categories_list = get_the_terms( $post_id, $term );

        if ( empty( $return['primary_category'] ) && ! empty( $categories_list ) ) {
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ( $return_all_categories ) {
            $return['all_categories'] = [];

            if ( ! empty( $categories_list ) ) {
                foreach( $categories_list as &$category ) {
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }

    return $return;
}

//
// ─── GET ALL MAINTENANCE PAGES ──────────────────────────────────────────────────
//

function kite_get_maintenance_page() {
	$args = array(
		'post_type'		=> 'page',
		'post_status'	=> 'publish',
		'meta_key' 		=> '_wp_page_template',
		'meta_value' 	=> 'maintenance.php'
	);
	$maintenance_pages_query = new WP_Query( $args );
	$maintenance_pages       = array();
	if ( $maintenance_pages_query->have_posts()) {
		while( $maintenance_pages_query->have_posts() ) {
			$maintenance_pages_query->the_post();
			$maintenance_pages[ get_the_ID() ] = get_the_title();
		}
		wp_reset_postdata();
	}

	return $maintenance_pages;
}

//
// ─── GET HEIGHT PERCENTATE ──────────────────────────────────────────────────────
//
if ( ! function_exists( 'kite_get_height_percentage' ) ) {
	function kite_get_height_percentage( $image, $width = 1, $height = 1 ) {
		if ( $image != '' ) {
			$re = '/width="(\\d+)".*height="(\\d+)"/';

			preg_match( $re, $image, $matches );
			if ( isset( $matches[1] ) && isset( $matches[2] ) ) {
				$height = $matches[2];
				$width  = $matches[1];
			} else {
				return 100;
			}
		}

		if ( $width == 0 ) {
			return 100;
		}

		return ( $height / $width ) * 100;
	}
}

//
// ─── ADD SKIP TO CONTENT LINK ───────────────────────────────────────────────────
//
if ( ! function_exists( 'kite_add_skip_link' ) ) {
	function kite_add_skip_link() {
		echo "<a href='#main-content' class='kt-skip-link'>" . esc_html__( 'Skip To Content', 'teta-lite' ) . "</a>";
	}
	add_action( 'wp_body_open', 'kite_add_skip_link' );
}

//
// ─── ADD ARRAY AFTER SPECIFIC KEY IN ANOTHER ARRRAY ─────────────────────────────
//

/**
 * Insert a value or key/value pair after a specific key in an array.  If key doesn't exist, value is appended
 * to the end of the array.
 *
 * @param array $array
 * @param string $key
 * @param array $new
 *
 * @return array
 */
function kite_array_insert_after( array $array, $key, array $new ) {
	$keys = array_keys( $array );
	$index = array_search( $key, $keys );
	$pos = false === $index ? count( $array ) : $index + 1;

	return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
}

//
// ─── SINGLE BLOG FLOATING SECTION ───────────────────────────────────────────────
//

/**
 * add floating section to single post
 *
 * @param  mixed $content
 * @return void
 */
function kite_add_floating_section_to_single_post( $content ) {
	if ( is_single() && 'post' == get_post_type() ) {

		$content = "<div class='kt-single-post-container'>" . $content . "</div>";
		$floating_section = "<div class='kt-floating-info hidden-phone hidden-tablet'>";
		$floating_section .= "<span class='title'>" . get_the_title() . "</span>";
		$floating_section .= "<span class='date'>" . get_the_date() . "</span>";

		$socialshare = kite_opt( 'social_share_display', false ); // theme settings;
		if ( $socialshare != 0 ) {
			$floating_section .= "<div class='share-btn'>";
			$floating_section .= "<span class='share-txt'>" . esc_html__( 'Share', 'teta-lite' ) . "</span>";
			get_template_part( 'templates/social-share' );
			$floating_section .= kite_generate_social_share_markup();
			$floating_section .= "</div>";
		}

		$floating_section .= '</div>';

		$content = $floating_section . $content;
	}
	return $content;
}
add_filter( 'the_content', 'kite_add_floating_section_to_single_post', 10 );

//
// ─── ADD SCROLL TO TOP DOM ──────────────────────────────────────────────────────
//
add_action( 'kite_before_layout_starts', 'kite_scroll_to_top', 5 );
function kite_scroll_to_top() {
	if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		return;
	}
	?>
	<div class="scrolltotop">
	<?php if (kite_opt('scrolltop_button' , true)){ ?>
	<a class="scrolltop" href="<?php echo esc_url( '#top' ); ?>"></a> <?php } ?>
		<?php
		?>
	</div>
	<?php
}


//
// ─── IMPROVE SEARCH TO INCLUDE CATEGORIES ───────────────────────────────────────
//

/**
 * Improve search functionality to include specific category
 *
 * @param object $query
 * @return object
 */
function kite_include_categories_in_search( $query ) {
	if ( $query->is_search && in_array( $query->get('post_type'), array( 'product', 'post' ) ) ) {
		if ( !empty( $_GET['cat'] ) && $_GET['cat'] != 'all' ) {
			$cat_taxonomy = $query->get('post_type') == 'product' ? 'product_cat' : 'category_name';
			$query->set( $cat_taxonomy, sanitize_text_field( $_GET['cat'] ) );
		}
	}
	return $query;
}
add_filter( 'pre_get_posts', 'kite_include_categories_in_search', 99, 1 );


//
// ─── ADD MOBILE MENU CLASS TO CATEGORIES MENU ELEMENT ───────────────────────────
//
/**
 * Add mobile menu class to categories menu element
 *
 * @param array $sidebar_classes
 * @return array $sidebar_classes
 */
function kite_add_mobile_menu_class_to_categories_element( $sidebar_classes ) {
	if ( ( $key = array_search( 'toggle-sidebar-category-menu', $sidebar_classes ) ) !== false) {
		unset( $sidebar_classes[ $key ] );
	}
	$sidebar_classes[] = 'toggle-sidebar-mobile-menu';
	$sidebar_classes[] = 'categories-offcanvas';
	return $sidebar_classes;
}
add_filter( 'kite_category_menu_sidebar_classes', 'kite_add_mobile_menu_class_to_categories_element', 1, 1 );
<?php

require_once dirname( __FILE__ ) . '/mediabox-strings.php';

class Kite_Theme_Admin {

	/**
     * Instance of this class.
     *
     * @var      object
     */
	protected static $instance = null;
	

	function __construct() {
		add_action( 'admin_init', array( &$this, 'kite_admin_init' ) );
		add_action( 'after_setup_theme', array( &$this, 'kite_after_setup' ) );
		add_action( 'switch_theme', array( &$this, 'kite_after_deactivate' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'init_admin_scripts' ), 200 ); // add high priority to print them at the end of page (specially admin.js)
	}

	function init_admin_scripts() {
		
		// Enqueue Styles
		$icomoon_handler = wp_style_is( 'icomoon', 'queue' ) ? 'kite-icomoon' : 'icomoon';
		wp_enqueue_style( $icomoon_handler, KITE_THEME_ASSETS_URI . '/css/icomoon.css', false, KITE_THEME_VERSION );
		wp_enqueue_style( 'kite-admin-css', KITE_THEME_LIB_URI . '/admin/css/style.css', false, '1.0.0', 'screen' );

		if ( ! isset( $_GET['page'] ) || $_GET['page'] != 'theme_settings' ) {
			// presscore stuff
			wp_enqueue_style( 'kite-vc-extend-css', get_template_directory_uri() . '/lib/admin/css/vc-extend.css' );
		}
		
		// Enqueue Scripts
		$screen = get_current_screen();
		if ( $screen->base == 'post' || $screen->base == 'edit-tags' || $screen->base == 'term' || $screen->base == "widgets" ) {
			wp_enqueue_script( 'sweet-alert', KITE_THEME_LIB_URI . '/admin/scripts/sweet-alert.min.js', array( 'jquery' ), '0.4.1' );
		}
		wp_register_script( 'wp-color-picker-alpha', KITE_THEME_LIB_URI . '/admin/scripts/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '3.0.0' );
		wp_enqueue_script( 'kite-admin-js', KITE_THEME_LIB_URI . '/admin/scripts/admin.js', array( 'jquery', 'wp-color-picker-alpha' ), '1.0.0' );
		wp_localize_script( 
			'kite-admin-js', 
			'kite_theme_admin_vars', 
			array(
				'ajax_url'         	=> esc_url( admin_url( 'admin-ajax.php' ) ),
				'wpnonce' 			=> wp_create_nonce( 'kite_theme_admin_nonce' ),
				'select_plugins'	=> esc_html__( 'Please select Plugins you want to install', 'teta-lite' ),
				'dismiss_plugin_installation'	=> esc_html__( 'Install recommanded plugins notice dismissed successfully', 'teta-lite' )
			) 
		);

	}

	function kite_after_deactivate() {
		update_option( 'theme_initialised', false );

	}

	function kite_after_setup() {

		// Set wishlist position after add to cart button
		if ( !get_theme_mod( 'yith_wcwl_initialized' ) && class_exists( 'YITH_WCWL' ) ) {

			$wishlist_position = get_option( 'yith_wcwl_button_position' );

			if ( $wishlist_position != 'add-to-cart' ) {
				update_option( 'yith_wcwl_button_position', 'add-to-cart' );
			}

			set_theme_mod( 'yith_wcwl_initialized', true );

		}
	}
	function kite_admin_init() {
		if ( in_array( $GLOBALS['pagenow'], array( 'media-upload.php', 'async-upload.php' ) ) ) {
			// Now we'll replace the 'Insert into Post Button' inside Thickbox
			add_filter( 'gettext', array( &$this, 'kite_replace_thickbox_text' ), 1, 3 );
		}

		// check if our old kt-core plugin or teta shortcode plugin is active, then deactivate them
		if ( function_exists( 'activate_Kite_core' ) ) {
			deactivate_plugins( 'kt-core/kt-core.php',false, null );
		}

		if ( function_exists( 'activate_Kite_shortcodes' ) ) {
			deactivate_plugins( 'kt-shortcodes/kt-shortcodes.php',false, null );
		}
	}

	function kite_replace_thickbox_text( $translated_text, $text, $domain ) {
		if ( 'Insert into Post' == $text ) {

			$texts = kite_get_media_box_strings();

			foreach ( $texts as $key => $value ) {
				$referer = strpos( wp_get_referer(), $key );

				if ( $referer !== false ) {
					return $value;
				}
			}
		}

		return $translated_text;
	}

	/**
     * Return an instance of this class.
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}
Kite_Theme_Admin::get_instance();

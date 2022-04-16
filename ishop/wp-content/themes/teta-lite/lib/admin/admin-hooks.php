<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*---------------------------------
	 Plugins Check
------------------------------------*/

add_action( 'admin_init', 'kite_check_plugins' );
function kite_check_plugins() {
	$plugins = array(
		'WOOCS' => array( 'woocommerce-currency-switcher/index.php', 'WooCommerce Currency Switcher' ),
	);
	foreach ( $plugins as $key => $value ) {
		if ( class_exists( $key ) && ! kite_woocommerce_installed() ) {
			deactivate_plugins( $value[0] );
			wp_die( 'To Active ' . $value[1] . ' plugin , Woocommerce plugin needed' );
		}
	}
}

/* -------------------------------------------------------------------------- */
/*                  Custom Excerpt for posts + no format box                  */
/* -------------------------------------------------------------------------- */

if ( ! function_exists( 'kite_default_hidden_meta_boxes' ) ) {
	function kite_default_hidden_meta_boxes( $hidden, $screen ) {
		// Grab the current post type
		$post_type = $screen->post_type;
		// If we're on a 'post'...
		if ( $post_type == 'post' ) {
			// Define which meta boxes we wish to hide
			$hidden = array(
				'trackbacksdiv',
				'slugdiv',
				'revisionsdiv',
				'postcustom',
				'commentstatusdiv',
				'authordiv',
				'formatdiv',
			);
			// Pass our new defaults onto WordPress
			return $hidden;
		}
		// If we are not on a 'post', pass the
		// original defaults, as defined by WordPress
		return $hidden;
	}
}
add_action( 'default_hidden_meta_boxes', 'kite_default_hidden_meta_boxes', 10, 2 );

//
// ─── KITE FUNCTION TO Show Activate Core Plugins Notice ──────────────────────────────────────
//
add_action( 'admin_notices', 'kite_install_required_plugins');
function kite_install_required_plugins() {
	if ( get_transient( 'kite-install-plugins-dismiss' )) {
		return;
	}
	$tgmpa = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	$check_plugins[] = 'kitestudio-core';
	foreach( $check_plugins as $key => $slug ) {
		if ( ! $tgmpa->is_plugin_installed( $slug ) ) {
			$plugins[ $slug ] = 'install';
		}
		if ( $tgmpa->can_plugin_activate( $slug ) ) {
			$plugins[ $slug ] = 'activate';
		}
	}
	if ( empty( $plugins ) ) {
		return;
	}
	?>
	<div class="notice updated is-dismissible" data-dismissible-time="2">
		<h2><?php echo sprintf( esc_html__( 'Thanks for choosing %s', 'teta-lite' ), KITE_THEME_MAIN_NAME);?></h2>
		<p><?php echo sprintf( esc_html__( 'To take full advantages of %1$s theme and enabling demo importer, %2$splease install core plugins.%3$s', 'teta-lite' ), KITE_THEME_MAIN_NAME, '<strong>', '</strong>' );?></p>
		<ul class="kt-plugins-form" data-redirect="<?php echo admin_url('admin.php?page=' . KITE_THEME_SLUG . '-dashboard');?>">
		<?php 
		foreach( $plugins as $slug => $action ) {
			?>
				<li data-slug="<?php echo esc_attr( $slug ); ?>" class="plugin-to-install">
					<?php
					if ( $action == 'install' ) {
						$actions = array(
							'install'   => 'install',
							'update'    => '',
							'activate'  => ''
						);
					} else {
						$actions = array(
							'install'   => '',
							'update'    => '',
							'activate'  => 'activate'
						);
					}
					?>
					<input 
						type="checkbox" 
						name="plugin-import[<?php echo esc_attr( $slug ); ?>]" 
						id="plugin-import[<?php echo esc_attr( $slug ); ?>]" 
						checked="checked" 
						disabled="disabled"
						data-actions="<?php echo esc_attr( json_encode( $actions ) );?>"
						data-slug="<?php echo esc_attr( $slug );?>"
						data-wpnonce="<?php echo wp_create_nonce( 'bulk-plugins' ); ?>"
					/>
				</li>
			<?php
		}
		?>
		</ul>
		<a href="#" class='button button-primary button-hero kt-install-core-plugins'><?php esc_html_e( 'Install Core Plugins', 'teta-lite' );?></a>
	</div>
	<?php
}

add_action( 'kite_dashboard_welcome_info', 'kite_go_pro_link' );
function kite_go_pro_link() {
	echo '<span class="kt-go-pro"><a href="ht' . 'tp://https://theme' . 'forest.net/item/teta-woocommerce-wordpress-theme/33042760">' . esc_html__( 'Go Pro', 'teta-lite') . '</a></span>';
}


/**
 * Use old widgets style
 */
add_filter( 'use_widgets_block_editor', '__return_false', 99 );

/**
 * set child theme options for parent options
 *
 * @since 1.3.7
 * @return void
 */
function kite_check_child_theme_options() {
	if ( !is_child_theme() || !empty( get_option( 'kite-child-theme-migrated', '' ) ) ) {
		return;
	}

	$options = [ 
		KITE_THEME_NAME_SEO . '-child_license_verified',
		KITE_THEME_NAME_SEO . '-Child_shop_header_display'
	];

	foreach ( $options as $key => $option ) {
		$value = get_option( $option, '' );
		if ( !empty( $value ) ) {
			$option_key = str_ireplace( '-child', '', $option );
			update_option( $option_key, $value );
		}
	}
	update_option( 'kite-child-theme-migrated', '1' );

}
add_action( 'admin_init', 'kite_check_child_theme_options' );
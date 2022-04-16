<?php

require_once dirname( __FILE__ ) . '/string.php';

class Kite_Framework {
	/**
	 * Includes (require_once) php file(s) inside selected folder
	 */
	public static function require_files( $path, $fileName ) {

		if ( is_string( $fileName ) ) {
			require_once kite_path_combine( $path, $fileName ) . '.php';
		} elseif ( is_array( $fileName ) ) {
			foreach ( $fileName as $name ) {
				require_once kite_path_combine( $path, $name ) . '.php';
			}
		} else {
			// Throw error
			throw new Exception( 'Unknown parameter type' );
		}
	}
}

// Include framework files

Kite_Framework::require_files(
	KITE_THEME_LIB,
	array(
		'constants',
		'icons',
		'utilities',
		'breadcrumb',
		'scripts-loader',
		'support',
		'retina-upload',
		'sidebars',
		'nav-walker',
		'menu/menu-setting',
		'menus',
		'loader',
		'settings',
	)
);

if ( is_admin() ) {
	Kite_Framework::require_files(
		KITE_THEME_LIB . '/admin',
		array(
			'admin-base',
			'admin-hooks'
		)
	);

	Kite_Framework::require_files(
		KITE_THEME_LIB,
		[
			'plugins-handler',
		]
	);
}

if ( wp_doing_ajax() ) {
	Kite_Framework::require_files(
		KITE_THEME_LIB,
		array(
			'ajax-hooks'
		)
	);
}

// Check if woocommerce plugin is active or not
if ( kite_woocommerce_installed() ) {
	Kite_Framework::require_files(
		KITE_THEME_LIB,
		array(
			'woocommerce/woocommerce-hooks'
		)
	);
}
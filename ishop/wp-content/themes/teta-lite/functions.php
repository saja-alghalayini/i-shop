<?php
/* --------------------------------- Constants -------------------------------- */

$theme_path = get_parent_theme_file_path();
$theme_uri = get_parent_theme_file_uri();
$constants = [
	'THEME_DIR'		=> $theme_path,
	'THEME_LIB'		=> $theme_path . '/lib',
	'THEME_PLUGINS'	=> $theme_path . '/plugins',
	'THEME_CSS'		=> $theme_path . '/assets/css',
	'THEME_URI'		=> $theme_uri,
	'THEME_LIB_URI'	=> $theme_uri . '/lib',
	'THEME_ASSETS_URI' 	=> $theme_uri . '/assets',
	'THEME_IMAGES_URI'	=> $theme_uri . '/assets/img'
];

foreach ( $constants as $constant => $value ) {
	if ( !defined( $constant ) ) {
		define( 'KITE_' . $constant, $value );
	}
}

/* ------------------------------ Content Width ----------------------------- */

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/* -------------------------------- LIBRARIES ------------------------------- */

require_once KITE_THEME_LIB . '/framework.php';


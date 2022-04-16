<?php

/** @var $theme WP_Theme */
$theme = is_child_theme() ? wp_get_theme( get_template() ) : wp_get_theme();

$version = $theme->Version;
$theme->name = $theme->slug = str_replace( ' ', '-', $theme->name );
$options_key = 'theme_teta_lite_options';

$constants = [
	'THEME_MAIN_NAME' 				=>  esc_html__( 'teta', 'teta-lite' ),
	'THEME_NAME'					=> $theme->Name,
	'THEME_SLUG'					=> $theme->slug,
	'THEME_NAME_SEO'				=> strtolower( str_replace( ' ', '_', $theme->Name ) ),
	'THEME_AUTHOR'					=> $theme->Author,
	'THEME_VERSION'					=> $version,
	'OPTIONS_KEY'					=> $options_key,
	'PRODUCT_ID'					=> '33042760',
	'PACK_MODE'						=>  esc_html__( 'Lite', 'teta-lite' ),
	'DEFAULT_PRODUCT_STYLE'	=> 'style1',
];

foreach ( $constants as $constant => $value ) {
	if ( !defined( $constant ) ) {
		define( 'KITE_' . $constant, $value );
	}
}
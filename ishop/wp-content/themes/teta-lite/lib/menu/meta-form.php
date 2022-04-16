<?php wp_nonce_field( 'theme-post-meta-form', KITE_THEME_NAME_SEO . '_post_nonce' ); ?>

<div class="kite-menu-field">
<?php
	global $post;

	$this->kite_set_working_directory( kite_path_combine( KITE_THEME_LIB, 'forms/templates' ) );
foreach ( $vars as $key => $settings ) {
	$isArray     = kite_array_value( 'array', kite_array_value( 'meta', $settings, array() ), false );
	$generalKey  = rtrim( $key, '-' . $post->ID );
	$val         = $this->kite_get_value( $generalKey );
	$fieldRepeat = 1;

	// Convert the key so it become array type
	if ( $isArray ) {
		$key .= '[]';

		if ( is_array( $val ) ) {
			$fieldRepeat = max( count( $val ), $fieldRepeat );
		}
	}

	for ( $m = 0; $m < $fieldRepeat; $m++ ) {
		$value = is_array( $val ) ? kite_array_value( $m, $val ) : $val;

		echo '' . $this->get_field( $key, $settings, array( 'val' => $value ) );
	}
}
?>
</div>

<?php

require_once dirname( __FILE__ ) . '/ivalueprovider.php';

class Kite_Post_Options_Provider implements IValueProvider {

	public function kite_get_value( $key ) {
		global $post;
		return get_post_meta( $post->ID, $key, true );

	}
}

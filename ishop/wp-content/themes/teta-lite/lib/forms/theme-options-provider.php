<?php

require_once dirname( __FILE__ ) . '/ivalueprovider.php';

class Kite_Theme_Options_Provider implements IValueProvider {
	public function kite_get_value( $key ) {
		return kite_opt( $key );
	}
}

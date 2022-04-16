<?php
require KITE_THEME_LIB . '/forms/template.php';

class Kite_Field_Template extends Kite_Template {
	/* @var IValueProvider $valueProvider */
	private $valueProvider = null;

	function __construct( IValueProvider $valueProvider, $templatesDir = '' ) {
		$this->valueProvider = $valueProvider;
		parent::__construct( $templatesDir );
	}

	function kite_get_value( $key ) {
		return $this->valueProvider->kite_get_value( $key );
	}

	public function get_field( $key, array $settings, array $vars = null ) {
		$params = array(
			'key'      => $key,
			'settings' => $settings,
		);

		if ( $vars != null ) {
			$params = array_merge( $vars, $params );
		}

		return $this->kite_get_template( $settings['type'] . '-field', $params );
	}
}

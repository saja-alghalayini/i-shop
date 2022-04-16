<?php

// Base class for generating html code from
// given template file
class Kite_Template {

	protected $templatesDir = 'templates';

	function __construct( $templatesDir = '' ) {
		if ( $templatesDir != '' ) {
			$this->templatesDir = $templatesDir;
		}
	}

	function kite_set_working_directory( $dir ) {
		$this->templatesDir = $dir;
	}

	function kite_get_template( $file, $vars = array() ) {
		ob_start();
		require kite_path_combine( $this->templatesDir, $file ) . '.php';
		return ob_get_clean();
	}

}

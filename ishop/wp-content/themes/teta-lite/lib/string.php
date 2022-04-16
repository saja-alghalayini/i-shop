<?php

function kite_ends_with( $string, $test ) {
	$strlen  = strlen( $string );
	$testlen = strlen( $test );
	if ( $testlen > $strlen ) {
		return false;
	}
	return substr_compare( $string, $test, -$testlen ) === 0;
}

function kite_replace_last_occurrence( $haystack, $needle, $replacement ) {
	$last = strrpos( $haystack, $needle );

	if ( $last === false ) {
		return $haystack;
	}

	return substr_replace( $haystack, $replacement, $last, strlen( $needle ) );
}

function kite_remove_last_occurrence( $haystack, $needle ) {
	return kite_replace_last_occurrence( $haystack, $needle, '' );
}

// Simple path combining function
function kite_path_combine( $path1, $path2 ) {
	$paths    = func_get_args();
	$last_key = func_num_args() - 1;
	array_walk(
		$paths,
		function( &$val, $key ) use ( $last_key ) {
			switch ( $key ) {
				case 0:
					$val = rtrim( $val, '/ ' );
					break;
				case $last_key:
					$val = ltrim( $val, '/ ' );
					break;
				default:
					$val = trim( $val, '/ ' );
					break;
			}
		}
	);

	$first = array_shift( $paths );
	$last  = array_pop( $paths );
	$paths = array_filter( $paths ); // clean empty elements to prevent double slashes
	array_unshift( $paths, $first );
	$paths[] = $last;
	return implode( '/', $paths );
}

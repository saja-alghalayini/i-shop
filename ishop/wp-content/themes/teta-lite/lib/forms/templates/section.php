<?php
/* @var Kite_Template $this */
$cnt = count( $vars );
$i   = 1;

foreach ( $vars as $sKey => $section ) {
	?>
	<div class="section section-<?php echo esc_attr( $sKey ); ?>">
		<div class="section-head">
			<div class="section-tooltip"><?php echo esc_html( $section['tooltip'] ); ?></div>
			<div class="label"><?php echo esc_html( $section['title'] ); ?></div>
		</div>
		<?php
		// Render fields
		$fields = $section['fields'];

		foreach ( $fields as $key => $settings ) {
			$isArray     = kite_array_value( 'array', kite_array_value( 'meta', $settings, array() ), false );
			$val         = $this->kite_get_value( $key );
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
	<?php if ( $i < $cnt ) { ?>
	<hr />
		<?php
	}
	$i++;
}

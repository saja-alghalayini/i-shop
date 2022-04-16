<?php
$name     = $vars['key'];
$settings = $vars['settings'];
$class    = kite_array_value( 'class', $settings );// Optional value
$flags    = kite_array_value( 'flags', $settings );// Optional value
$label    = kite_array_value( 'label', $settings );// Optional value

// remove -{id} from end of name of filed[just used in admin menu page] becouse in that page we make names unique by adding -{id}
$generalKey = rtrim( $name, '-' . get_the_ID() );

$value = ( ( esc_attr( $this->kite_get_value( $generalKey ) ) == '' ) && ( kite_array_value( 'value', $settings ) != '' ) ) ? kite_array_value( 'value', $settings ) : esc_attr( $this->kite_get_value( $generalKey ) );

$vars['settings']['label-class'] = 'kt-no-float';
?>
<div class="kt-icon-field field">
	<?php if ( $label != '' ) { ?>
		<label for="field-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
	<?php } ?>
	<div class="kt-icon-container <?php echo esc_attr( $class ); ?>">

		<div class="kt-icons">
			<span class="close"></span>
			<?php echo get_transient( 'kite_icons_markup' ); ?>
		</div>
		<span class="selected-icon icon
		<?php
		if ( $value != '' ) {
			echo '-' . esc_attr( $value ); }
		?>
		" data-name="<?php echo esc_attr( $value ); ?>" title="<?php esc_attr_e( 'select an icon', 'teta-lite' ); ?>"></span>
		   <span class="select-icon-text 
		   <?php
			if ( $value != '' ) {
				echo 'show'; }
			?>
			"><?php esc_html_e( 'Select an icon', 'teta-lite' ); ?></span>
		<input class="icon-filed" type="hidden" name="<?php echo esc_attr( $name ); ?>" data-flags="<?php echo esc_attr( $flags ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	</div>
</div>

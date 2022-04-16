<?php
$name        = $vars['key'];
$settings    = $vars['settings'];
$class       = kite_array_value( 'class', $settings );// Optional value
$label       = kite_array_value( 'label', $settings );// Optional value
$placeholder = kite_array_value( 'placeholder', $settings );// Optional value
$value       = ( ( esc_attr( $this->kite_get_value( rtrim( $name, '-' . get_the_ID() ) ) ) == '' ) && ( kite_array_value( 'value', $settings ) != '' ) ) ? kite_array_value( 'value', $settings ) : esc_attr( $this->kite_get_value( rtrim( $name, '-' . get_the_ID() ) ) );

?>

<div class="field color-field clear-after <?php echo esc_attr( $class ); ?>">
	<?php if ( $label != '' ) { ?>
		<span class="field-label"><?php echo esc_html( $label ); ?></span>
	<?php } ?>
	<div class="color-field-wrap clear-after
	<?php
	if ( $label != '' ) {
		echo ' has-label';}
	?>
	">
		<input name="<?php echo esc_attr( $name ); ?>" data-alpha="true" type="text" value="<?php echo esc_attr( $value ); ?>" class="colorinput" placeholder="<?php echo esc_attr( $placeholder ); ?>" />
		<div class="color-view"></div>
	</div>
</div>

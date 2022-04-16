<?php
$name     = $vars['key'];
$settings = $vars['settings'];
$title    = kite_array_value( 'title', $settings );// Optional value
$class    = kite_array_value( 'class', $settings );// Optional value
$label    = kite_array_value( 'label', $settings );// Optional value
$min      = kite_array_value( 'min', $settings, 1 );// Optional value
$max      = kite_array_value( 'max', $settings, 100 );// Optional value
$step     = kite_array_value( 'step', $settings, 1 );// Optional value
$default  = kite_array_value( 'default', $settings );// Optional value
$val      = $this->kite_get_value( $name );
$val      = strlen( $val ) ? $val : $default;
?>

<div class="field clear-after <?php echo esc_attr( $class ); ?>">
	<label>
		<?php if ( ! empty( $title ) ) { ?>
		<div class="label"><?php echo esc_html( $title ); ?> : &nbsp;</div>
		<?php } ?>
		<div class="label"><?php echo esc_html( $label ); ?></div>
	</label>
	<input name="<?php echo esc_attr( $name ); ?>" type="range" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>" step="<?php echo esc_attr( $step ); ?>"  value="<?php echo esc_attr( $val ); ?>" />
	<span class="output"><?php echo esc_html( $val ); ?></span>
</div>

<?php
$name     = $vars['key'];
$settings = $vars['settings'];
$class    = kite_array_value( 'class', $settings );// Optional value
$state0   = $settings['state0'];
$state1   = $settings['state1'];
$default  = kite_array_value( 'default', $settings );// Optional value
$label    = kite_array_value( 'label', $settings );// Optional value
$val      = $this->kite_get_value( $name );
$val      = strlen( $val ) ? $val : $default;
?>
<div class="field clear-after <?php echo esc_attr( $class ); ?>">
	<?php if ( $label != '' ) { ?>
		<span class="field-label"><?php echo esc_html( $label ); ?></span>
	<?php } ?>
	<div class="kite-switch-options" ><div class="state"><input class="state0" type="radio" name="<?php echo esc_attr( $name ); ?>" value='0' 
																											 <?php
																												if ( $val == 0 ) {
																													echo "checked='true'";}
																												?>
	><label class=""><span><?php echo esc_html( $state0 ); ?></span></label></div><div class="state"><input class="state1" type="radio" name="<?php echo esc_attr( $name ); ?>" value='1' 
									<?php
									if ( $val == 1 ) {
											echo "checked='true'";}
									?>
><label class=""><span><?php echo esc_html( $state1 ); ?></span></label></div></div>
</div> 

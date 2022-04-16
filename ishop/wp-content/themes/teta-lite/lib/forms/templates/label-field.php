<?php
$settings = $vars['settings'];
$desc     = kite_array_value( 'desc', $settings );// Optional value
$title    = kite_array_value( 'title', $settings );// Optional value
$class    = kite_array_value( 'class', $settings );// Optional value
?>
<div class="field clear-after kt-input-label  <?php echo esc_attr( $class ); ?>">
	<strong><?php echo esc_html( $title ); ?></strong>
	<?php if ( strlen( $desc ) ) { ?>
	<span><?php echo esc_html( $desc ); ?></span>
	<?php } ?>
</div>

<?php
$name        = $vars['key'];
$settings    = $vars['settings'];
$class       = kite_array_value( 'class', $settings );// Optional value
$placeholder = kite_array_value( 'placeholder', $settings );// Optional value
$label       = kite_array_value( 'label', $settings );// Optional value
$names = esc_attr( $name );
$metaname = array("ask_question", "delivery_return", "size_guide");

?>

<div class="field textarea-input <?php echo esc_attr( $class ); ?>">
	<?php if ( $label != '' ) { ?>
		<label for="field-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
	<?php } ?>
	<?php if ( in_array($names, $metaname) ) {
		 $meta_content = wpautop( esc_textarea( $this->kite_get_value( $name ) ),true);
                wp_editor($meta_content, $name, array(
                        'wpautop'               =>  true,
                        'media_buttons' =>      true,
                        'textarea_name' =>      $name  ,
                        'textarea_rows' =>      8,
                        'teeny'                 =>  true,
						'tinymce' => true,
						 'editor_class' => 'meta_content_editor'
	));
	}
	else { ?>
	<textarea name="<?php echo esc_attr( $name ); ?>" cols="30" rows="10" placeholder="<?php echo esc_attr( $placeholder ); ?>" ><?php echo esc_textarea( $this->kite_get_value( $name ) ); ?></textarea>
<?php } ?>
</div>
<?php



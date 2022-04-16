<?php
$name        = $vars['key'];
$settings    = $vars['settings'];
$default     = kite_array_value( 'default', $settings );
$selected    = $this->kite_get_value( $name );
$selected    = $selected == '' ? $default : $selected;
$class       = kite_array_value( 'class', $settings );
$label       = kite_array_value( 'label', $settings );// Optional value
$maintenance = kite_array_value( 'maintenance', $settings );// Optional value
?>
<div class="field clear-after <?php echo esc_attr( $class ); ?>">
	<div class="select
	<?php
	if ( $label != '' ) {
		echo ' has-label';}
	?>
	">
		<div></div>

		<?php
		if ( $maintenance == 1 ) {
			$args = array(
				'meta_key'   => '_wp_page_template',
				'meta_value' => 'maintenance.php',
				'selected'   => $selected,
				'name'       => $name,
			);

			$the_pages = new WP_Query( $args );

			if ( $the_pages->have_posts() ) {
				while ( $the_pages->have_posts() ) {
					$the_pages->the_post();
					the_title();
				}
			}
			wp_reset_postdata();
			wp_dropdown_pages( $args );

		} else {
			$args = array(
				'selected' => $selected,
				'name'     => $name,
			);
			wp_dropdown_pages( $args );

		}
		?>

	</div>
</div>

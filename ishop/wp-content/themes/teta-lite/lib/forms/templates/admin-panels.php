<div class="kt-main">
	<?php
	$panels = $this->template['panels'];

	foreach ( $panels as $panelKey => $panel ) {
		?>
		<div id="<?php echo esc_attr( $panelKey ); ?>" class="panel">
			<div class="content-head">
				<div class="kt-content-wrap">
					<a href="<?php echo esc_url( '#' ); ?>" class="save-button" >
						<?php echo '' . $this->kite_GetImage( 'save_icon.png', 'Save', 'save-icon' ); ?>
						<?php echo '' . $this->kite_GetImage( 'loading24.gif', 'Loading', 'loading-icon' ); ?>
						<div><?php esc_html_e( 'Save', 'teta-lite' ); ?></div>
					</a>
					<h3><?php echo esc_html( $panel['title'] ); ?></h3>

					<div class="support">
						<a href="<?php echo esc_url( $this->template['document-url'] ); ?>"><?php esc_html_e( 'Documentation', 'teta-lite' ); ?></a><span class="separator"></span><a href="<?php echo esc_url( $this->template['support-url'] ); ?>"><?php esc_html_e( 'Support', 'teta-lite' ); ?></a>
					</div>
				</div>
			</div>
			<?php echo '' . $this->kite_get_template( 'section', $panel['sections'] ); ?>
		</div>
		<?php
	}
	?>
</div>

<?php

	$footerWidgets = kite_opt( 'footer_widgets', 0 );

if ( $footerWidgets == 1 ) {

	$widgetSpan1 = 'span12';
} elseif ( $footerWidgets == 2 ) {

	$widgetSpan1 = 'span6';
	$widgetSpan2 = 'span6';
} elseif ( $footerWidgets == 3 ) {

	$widgetSpan1 = 'span8';
	$widgetSpan2 = 'span4';
} elseif ( $footerWidgets == 4 ) {

	$widgetSpan1 = 'span4';
	$widgetSpan2 = 'span8';

} elseif ( $footerWidgets == 5 ) {

	$widgetSpan1 = 'span4';
	$widgetSpan2 = 'span4';
	$widgetSpan3 = 'span4';
} elseif ( $footerWidgets == 6 ) {

	$widgetSpan1 = 'span3';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span3';
	$widgetSpan4 = 'span3';

} elseif ( $footerWidgets == 7 ) {

	$widgetSpan1 = 'span3';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span6';

} elseif ( $footerWidgets == 8 ) {

	$widgetSpan1 = 'span6';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span3';
} elseif ( $footerWidgets == 9 ) {

	$widgetSpan1 = 'span3';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span2';
	$widgetSpan4 = 'span2';
	$widgetSpan5 = 'span2';

} elseif ( $footerWidgets == 10 ) {

	$widgetSpan1 = 'span2';
	$widgetSpan2 = 'span2';
	$widgetSpan3 = 'span2';
	$widgetSpan4 = 'span3';
	$widgetSpan5 = 'span3';

} elseif ( $footerWidgets == 11 ) {

	$widgetSpan1 = 'span12';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span3';
	$widgetSpan4 = 'span3';
	$widgetSpan5 = 'span3';

} elseif ( $footerWidgets == 12 ) {

	$widgetSpan1 = 'span2';
	$widgetSpan2 = 'span2';
	$widgetSpan3 = 'span2';
	$widgetSpan4 = 'span2';
	$widgetSpan5 = 'span2';
	$widgetSpan6 = 'span2';

} elseif ( $footerWidgets == 13 ) {

	$widgetSpan1 = 'span12';
	$widgetSpan2 = 'span3';
	$widgetSpan3 = 'span3';
	$widgetSpan4 = 'span2';
	$widgetSpan5 = 'span2';
	$widgetSpan6 = 'span2';

} elseif ( $footerWidgets == 14 ) {

	$widgetSpan1 = 'span6';
	$widgetSpan2 = 'span6';
	$widgetSpan3 = 'span3';
	$widgetSpan4 = 'span3';
	$widgetSpan5 = 'span3';
	$widgetSpan6 = 'span3';

} elseif ( $footerWidgets == 15 ) {

	$widgetSpan1 = 'span6';
	$widgetSpan2 = 'span6';
	$widgetSpan3 = 'span3';
	$widgetSpan4 = 'span3';
	$widgetSpan5 = 'span2';
	$widgetSpan6 = 'span2';
	$widgetSpan7 = 'span2';

}
?>

<?php if ( $footerWidgets && ( is_active_sidebar( 'footer-widget-1' ) || is_active_sidebar( 'footer-widget-2' ) || is_active_sidebar( 'footer-widget-3' ) || is_active_sidebar( 'footer-widget-4' ) || is_active_sidebar( 'footer-widget-5' ) || is_active_sidebar( 'footer-widget-6' ) || is_active_sidebar( 'footer-widget-7' ) ) ) { ?>
<div id="footer-widget-<?php echo esc_attr( $footerWidgets ); ?>" class=" footer-widgetized kt-section 
								  <?php
									if ( kite_opt( 'footer-widget-style', false ) == 1 ) {
										?>
	 light <?php } ?> <?php
		if ( kite_opt( 'footer-widget-banner' ) ) {
			?>
	  footer-has-banner <?php } ?>
	<?php
	if ( kite_opt( 'footer-widget_width', false ) !== '1' ) {
		?>
	fullwidth <?php } ?>">
	<div class="section-container">
		<div class="section-content-container">
			<?php if ( kite_opt( 'footer-widget-banner' ) && kite_opt( 'footer-widget-gradient' ) ) { ?>
				<div class="footer-widgetized-gradient">
			<?php } ?>

					<div class="footer-widgetized-wrap wrap 
					<?php
					if ( kite_opt( 'footer-widget_width', false ) == '1' ) {
						?>
						 container <?php } ?>">
						<div class="clearfix">

							<?php if ( kite_opt( 'footer_title' ) || kite_opt( 'footer_subtitle' ) ) { ?>

								<div class="titlespace">
									<?php if ( kite_opt( 'footer_title' ) ) { ?>
										<div class="title"><h3><?php kite_eopt( 'footer_title' ); ?></h3></div>
									<?php } if ( kite_opt( 'footer_subtitle' ) ) { ?>
										<div class="subtitle"><?php kite_eopt( 'footer_subtitle' ); ?></div>
									<?php } ?>
								</div>

							<?php } ?>

						</div>

						<div class="clearfix">
							<!-- widgetized Area -->
							<div class="wpb_row vc_row-fluid">
								<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan1 ); ?>">
									<!--  Footer Widgetised 1 -->
									<?php
									dynamic_sidebar( 'footer-widget-1' );
									?>
								</div>

								<?php if ( ! ( $footerWidgets == 1 ) ) { ?>
								
									<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan2 ); ?>">
										<!--  Footer Widgetised 2 -->
										<?php
										dynamic_sidebar( 'footer-widget-2' );
										?>
									</div>
									 
									<?php if ( $footerWidgets == 5 || $footerWidgets == 6 || $footerWidgets == 7 || $footerWidgets == 8 || $footerWidgets == 9 || $footerWidgets == 10 || $footerWidgets == 11 || $footerWidgets == 12 || $footerWidgets == 13 || $footerWidgets == 14 || $footerWidgets == 15 ) { ?>
									<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan3 ); ?>">
										<?php
										dynamic_sidebar( 'footer-widget-3' );
										?>
									</div>
									<?php } ?>
							
									<?php if ( $footerWidgets == 6 || $footerWidgets == 9 || $footerWidgets == 10 || $footerWidgets == 11 || $footerWidgets == 12 || $footerWidgets == 13 || $footerWidgets == 14 || $footerWidgets == 15 ) { ?>
										<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan4 ); ?>">
											<?php
											dynamic_sidebar( 'footer-widget-4' );
											?>
										</div>
									<?php } ?>

									<?php if ( $footerWidgets == 9 || $footerWidgets == 10 || $footerWidgets == 11 || $footerWidgets == 12 || $footerWidgets == 13 || $footerWidgets == 14 || $footerWidgets == 15 ) { ?>
										<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan5 ); ?>">
											<?php
											dynamic_sidebar( 'footer-widget-5' );
											?>
										</div>
									<?php } ?>
									
									<?php if ( $footerWidgets == 12 || $footerWidgets == 13 || $footerWidgets == 14 || $footerWidgets == 15 ) { ?>
										<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan6 ); ?>">
											<?php
											dynamic_sidebar( 'footer-widget-6' );
											?>
										</div>
									<?php } ?>
									
									<?php if ( $footerWidgets == 15 ) { ?>
										<div class="wpb_column vc_column_container <?php echo esc_attr( $widgetSpan7 ); ?>">
											<?php
											dynamic_sidebar( 'footer-widget-7' );
											?>
										</div>
									<?php } ?>
									
								<?php } ?>

							</div>
						</div>
					</div>
			<?php if ( kite_opt( 'footer-widget-banner' ) && kite_opt( 'footer-widget-gradient' ) ) { ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

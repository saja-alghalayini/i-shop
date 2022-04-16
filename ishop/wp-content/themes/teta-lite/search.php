<?php
/**
 * Search template
 */

	get_header();
	$containerClass = kite_is_layout_fullwidth( true ) ? 'fullwidth' : 'container';
?>
	<div class="<?php echo esc_attr( $containerClass );?>">
		<div class="row">
			<div class="span12">
				<br/>
				<?php $pageHeading = have_posts() ? sprintf( esc_html__( "Results for &nbsp; '%s'", 'teta-lite' ), $s ) : get_template_part( 'templates/search', 'no-result' ); ?>
				<h2 class="span10 search-title"><?php echo esc_html( $pageHeading ); ?></h2>
				<?php
				get_template_part( 'templates/loop', 'search' );
				kite_get_pagination();
				?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>

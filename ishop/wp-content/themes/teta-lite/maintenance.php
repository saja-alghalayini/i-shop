<?php /* Template Name: Maintenance Page */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<?php if ( ! kite_is_shop_ajax_request() ) { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1,user-scalable=0" />
		<meta name="theme-color" content="<?php echo esc_attr( kite_opt( 'style-accent-color', '#5956e9' ) ); ?>">
			<?php 
	?>
		<?php wp_head(); ?>
	<?php } ?>
	</head>

	<body <?php body_class(); ?> <?php kite_body_attr(); ?>>
		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
		?>

		<div class="wrap" id="pageheight">
			<?php /* The loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'maintenance-page' ); ?>>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article><!-- #post -->
			<?php endwhile; ?>

		</div><!-- .site-content -->

		<?php
		wp_footer();
		?>
	</body>
</html>


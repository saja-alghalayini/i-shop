<?php
/**
 * Archive template
 */

get_header();
$blogSidebar  = 'span9';
$span1        = '';/* It is used to fix the positioning of span 10*/
$sidebarclass = '';
$sidebar      = kite_opt( 'blog-sidebar-position', 'main-sidebar' );

if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
	$sidebar = 'no-sidebar';
}


if ( $sidebar == 'main-sidebar' ) {
	$sidebarclass = 'blog-has-sidebar right';
}
if ( $sidebar == 'left-sidebar' ) {
	$sidebarclass = 'blog-has-sidebar left';
}
if ( $sidebar == 'no-sidebar' ) {
	$blogSidebar = 'span10 fullwidth-blog';
}
$containerClass = kite_is_layout_fullwidth( true ) ? 'fullwidth' : 'container';
?>

<!-- Blog -->
<section  id="blog" class="cblog <?php echo esc_attr( $sidebarclass ); ?>">
	<div class="wrap">
		<div class="<?php echo esc_attr( $containerClass );?>" id="content">
			<div class="row">
				<?php echo wp_kses( $span1, $GLOBALS['kite-allowed-tags'] ); ?>
				
				<?php if ( $sidebar == 'left-sidebar' ) { ?>
			   
				   <!-- left Sidebar  -->
					<div class="span3 main-sidebar-container">
						<?php kite_get_sidebar( 'main-sidebar' ); ?>
					</div>
				
				<?php } ?>
				<div class="<?php echo esc_attr( $blogSidebar ); ?>">
					<div id="blogloop">
						<?php
						if ( is_category() ) {
							$page_title = sprintf( esc_html__( 'All posts in: %s', 'teta-lite' ), single_cat_title( '', false ) );
						} elseif ( is_tag() ) {
							$page_title = sprintf( esc_html__( 'All posts tagged: %s', 'teta-lite' ), single_tag_title( '', false ) );
						} elseif ( is_day() ) {
							$page_title = sprintf( esc_html__( 'Archive for: %s', 'teta-lite' ), get_the_time( 'F jS, Y' ) );
						} elseif ( is_month() ) {
							$page_title = sprintf( esc_html__( 'Archive for: %s', 'teta-lite' ), get_the_time( 'F, Y' ) );
						} elseif ( is_year() ) {
							$page_title = sprintf( esc_html__( 'Archive for: %s', 'teta-lite' ), get_the_time( 'Y' ) );
						} elseif ( is_author() ) {
							/* Get author data */
							if ( get_query_var( 'author_name' ) ) {
								$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
							} else {
								$curauth = get_userdata( get_query_var( 'author' ) );
							}

							$page_title = sprintf( esc_html__( 'Posts by: %s', 'teta-lite' ), $curauth->display_name );
						} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {

							$page_title = esc_html__( 'Blog Archive', 'teta-lite' );
						} else {
							$page_title = '';
						}

						?>
							 
						
						<h2><?php echo esc_html( $page_title ); ?></h2>
						
						<?php

						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								global $post;
								?>
											
								<div <?php post_class( 'clearfix' ); ?>>
									<?php get_template_part( 'templates/loop', 'blog-standard' ); ?>
								</div>
								<?php
							}
						}

						?>
					</div>
					<?php if ( have_posts() ) { ?>
						<?php
						kite_get_pagination();
					}
					?>
				</div>
			
				<?php if ( $sidebar == 'main-sidebar' ) { ?>
			   
				   <!-- Right Sidebar  -->
					<div class="span3 main-sidebar-container">
						<?php kite_get_sidebar( 'main-sidebar' ); ?>
					</div>
				
				<?php } ?>
			</div>
		</div>
	</div>
</section>

	
	
<?php get_footer(); ?>

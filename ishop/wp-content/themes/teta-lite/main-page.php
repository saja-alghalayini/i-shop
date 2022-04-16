<?php
/*
Template Name: OnePage Container
*/

get_header();

$current_page_id = get_option( 'page_on_front' );

if ( ( $locations = get_nav_menu_locations() ) && $locations['primary-nav'] ) {

	// When Primary Navigation is active

	$menu       = wp_get_nav_menu_object( $locations['primary-nav'] );
	$menu_items = wp_get_nav_menu_items( $menu->term_id );

	$menu_list = array();
	foreach ( $menu_items as $item ) {
		if ( $item->object == 'page' ) {
			$menu_list[] = $item->object_id;
		}
	}

	$main_query = new WP_Query(
		array(
			'post_type'      => 'page',
			'post__in'       => $menu_list,
			'posts_per_page' => count( $menu_list ),
			'orderby'        => 'post__in',
		)
	);

} else {

	// When Primary Navigation is not active

	$args = array(
		'post_type'      => 'page',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'posts_per_page' => '-1',
	);

	$main_query = new WP_Query( $args );

}

$blogCount = 0;

if ( have_posts() ) :
	while ( $main_query->have_posts() ) :
		$main_query->the_post();
		global $post;
		$post_name     = $post->post_name;
		$post_id       = get_the_ID();
		$separate_page = get_post_meta( $post_id, 'page-position-switch', true );

		if ( ( $separate_page !== '0' ) && ( $post_id != $current_page_id ) ) {
			// custom section
			if ( get_post_meta( $post_id, 'page-type-switch', true ) == 'custom-section' ) {

				get_template_part( 'templates/section', 'custom' );

			}
			// Blog Section
			elseif ( get_post_meta( $post_id, 'page-type-switch', true ) == 'blog-section' && $blogCount == 0 ) {

				get_template_part( 'templates/section', 'blog' );
				$blogCount++;

			}
		}

	endwhile;
endif;

wp_reset_postdata();

// Footer Map
$footerMap = kite_get_meta( 'footer-map' );
if ( $footerMap == '1' ) {
	get_template_part( 'templates/section', 'location' );
}

get_footer();

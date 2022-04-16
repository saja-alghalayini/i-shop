<?php

/* Returns post/page link and their parents */
function kite_get_post_parent_trail( $post_id ) {
	$parents = array();

	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_post( $post_id );

		if ( null == $page ) {
			break;
		}

		/* Add the formatted post link to the array of parents. */
		$parents[] = '<a href="' . esc_url( get_permalink( $post_id ) ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . esc_html( get_the_title( $post_id ) ) . '</a>';

		/* Set the parent post's parent to the post ID. */
		$post_id = $page->post_parent;
	}

	/* reverse the array to put them in the proper order for the trail */
	$parents = array_reverse( $parents );

	return $parents;
}

function kite_breadcrumb_single_trail_handler( $postType ) {
	return false;
}

add_filter( 'kite_breadcrumb_single_trail_handler', 'kite_breadcrumb_single_trail_handler' );

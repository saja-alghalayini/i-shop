<?php
	$sidebar = kite_opt( 'blog-sidebar-position', 'main-sidebar' );// to make header gallery and video fill in span8
if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
	$sidebar = 'no-sidebar';
}
// check social share is Enable or not
if ( get_post_meta( get_the_ID(), 'social_share_inherit', true ) == '1' ) {
	$socialshare = get_post_meta( get_the_ID(), 'post-social-share', true );
} else {
	$socialshare = kite_opt( 'social_share_display', false ); // theme settings;
}
?>
<div class="row">
	<div class="single-post-metas">

		<div class="social-tag">
			<div class="post-tags"><?php the_tags( '  ', '   ', '' ); ?></div>
				<div class="social_share_container">
					<!-- blog Socail share -->
					<?php do_action( 'kite_social_share_buttons' ); ?>
				</div>
		</div>
		<?php
		$author_description = get_the_author_meta( 'description' );
		if ( ! empty( $author_description ) ) {
			?>
		<div class="about-author">
			<div class="profile-picture"><?php echo get_avatar( get_the_author_meta( 'email' ), 82 ); ?></div>
			<div class="author-description">
				<span class="author-name"><?php echo get_the_author_meta( 'display_name' ); ?></span>
				<span class="author-bio"><?php echo nl2br( $author_description ); ?></span>
			</div>
		</div>
		<?php } ?>
		<?php
		$prevPost         = get_previous_post();
		$nextPost         = get_next_post();
		$prevtitle        = '';
		$nexttitle        = '';
		$prevthumbnail[0] = '';
		$nextthumbnail[0] = '';
		if ( $prevPost ) {
			$prevtitle = esc_html( get_the_title( $prevPost ) );
			if ( has_post_thumbnail( $prevPost->ID ) ) {
				$prevthumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prevPost->ID ), 'medium_large' );
			}
		}
		if ( $nextPost ) {
			$nexttitle = esc_html( get_the_title( $nextPost ) );
			if ( has_post_thumbnail( $nextPost->ID ) ) {
				$nextthumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $nextPost->ID ), 'medium_large' );
			}
		}

		?>
		<?php if ( $nextPost || $prevPost ) { ?>
		<!-- nav box -->
		<div class="nav_box <?php if ( !( $nextPost && $prevPost ) ) echo 'one-item'; ?>">
			<?php echo next_post_link( '%link', '<div class="nextnav nav"><div class="arrows-button-next"></div><div class="nav-text"><span>' . esc_html__( 'Next Post', 'teta-lite' ) . '</span><span class="posttitle" title="' . esc_attr__( 'Newer Posts', 'teta-lite' ) . '">' . $nexttitle . '</span></div></div>' ); ?>
			<?php echo previous_post_link( '%link', '<div class="prevnav nav"><div class="arrows-button-prev"></div><div class="nav-text"><span>' . esc_html__( 'Previous Post', 'teta-lite' ) . '</span><span class="posttitle" title="' . esc_attr__( 'Older Posts', 'teta-lite' ) . '">' . $prevtitle . '</span></div></div>' ); ?>
		</div>
		<?php 
		} 
		if ( function_exists( 'kite_related_posts' ) ) {
			global $post;
			$related_posts = kite_related_posts( $post, 2 );
			echo '' . $related_posts;
		}
		?>

		<div class="commentwrap" id="comment-text">
			<?php
				$num_comments = get_comments_number();
			?>
				
				<?php
				if ( $num_comments != 0 ) {
					?>
				<div class="commentscount">        
					<?php
					echo esc_html( $num_comments ) . '   ';

					if ( $num_comments == 1 ) {// Comments text compatibility check
						esc_html_e( 'comment', 'teta-lite' );
					} else {
						esc_html_e( 'comments', 'teta-lite' );
					}
					?>
				</div>
					<?php
				}
				comments_template( '', true );
				?>
		</div>
	</div>
</div>

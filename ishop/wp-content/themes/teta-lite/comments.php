<?php

/*
-----------------------------------------------------------------------------------*/
/*
  Functions
/*-----------------------------------------------------------------------------------*/

function kite_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();

	$fields['author'] = '<div class="input-text"><span class="label required">' . esc_html__( 'Name', 'teta-lite' ) . '</span><span class="graylabel">' . esc_html__( 'Your Name', 'teta-lite' ) . '</span><input name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" type="text" tabindex="1"></div>';

	$fields['email'] = '<div class="input-text"><span class="label required">' . esc_html__( 'Email', 'teta-lite' ) . '</span><span class="graylabel">' . esc_html__( 'Email', 'teta-lite' ) . '</span><input name="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" type="text"  tabindex="2"></div>';

	$fields['url'] = '<div  class="input-text"><span class="label">' . esc_html__( 'Website', 'teta-lite' ) . '</span><span class="graylabel">' . esc_html__( 'Website', 'teta-lite' ) . '</span><input name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" tabindex="3"></div>';

	return $fields;
}
	add_filter( 'comment_form_default_fields', 'kite_comment_fields' );

function kite_comment_submit( $submit_button ) {
	$submit_button = '<div class="button kt_button button-medium  style2 fill text" title="' . esc_attr__( 'submit', 'teta-lite' ) . '"><span class="txt" data-hover="' . esc_attr__( 'Submit', 'teta-lite' ) . ' "></span><span><input name="submit" type="submit" value="' . esc_attr__( 'Submit', 'teta-lite' ) . '"></span></div>';
	return $submit_button;
}
	add_filter( 'comment_form_submit_button', 'kite_comment_submit' );

function kite_comment_form_before() {
	echo '<div class="form-fields clearfix">';
}

function kite_comment_form_after() {
	echo '</div>';
}

	add_action( 'comment_form_before_fields', 'kite_comment_form_before' );
	add_action( 'comment_form_after_fields', 'kite_comment_form_after' );

	// Comment styling

function kite_theme_comment( $comment, $args, $depth ) {

	$isByAuthor = false;

	if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) {
		$isByAuthor = true;
	}

	?>
		<li>
			<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'clearfix' ); ?> data-id="<?php comment_ID(); ?>">
				<div class="comment-image">
				<?php echo get_avatar( $comment, $size = '64' ); ?>
				</div>
				<div class="comment-content">
					<div class="comment-meta">
						<div class="author_name"><?php printf( wp_kses( __( '<cite>%s</cite>', 'teta-lite' ), 'socialentities' ), get_comment_author_link() ); ?></div>
					<?php
					if ( $isByAuthor ) {
						?>
						<span class="author-tag"><?php esc_html_e( '(Author)', 'teta-lite' ); ?></span><?php } ?>
						<a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'teta-lite' ), get_comment_date( 'M j, Y,    ' ), get_comment_time( 'G:i' ) ); ?></a>
					<?php edit_comment_link( esc_html__( 'Edit', 'teta-lite' ), '  ', '' ); ?>
					</div>
					<div class="comment-text">
					<?php
						comment_text();
						comment_reply_link(
							array_merge(
								$args,
								array(
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
					?>
					</div>
				</div>
				<div class="line"></div>
			</div>

	<?php
}

function kite_theme_list_pings( $comment, $args, $depth ) {
	?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php
}

if ( post_password_required() ) {
	?>
		<p class="nocomments"><?php esc_html_e( 'This post is password protected. Please enter password to view comments.', 'teta-lite' ); ?></p>
	<?php
	return;
}

/*
-----------------------------------------------------------------------------------*/
/*
  Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

if ( have_comments() ) { // if there are comments
	?>
	<div class="comments-wrap">


	<?php if ( ! empty( $comments_by_type['pingback'] ) ) { ?>

		<h4 id="pings"><?php esc_html_e( 'Pings for this post', 'teta-lite' ); ?></h4>
	   
		<ol class="ping_list">
		
			 <?php wp_list_comments( 'type=pings&callback=kite_theme_list_pings' ); ?>
		</ol>

	<?php } ?> 

	<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>

		<ul class="comments-list">
		 
			 <?php wp_list_comments( 'type=comment&avatar_size=64&callback=kite_theme_comment' ); ?>
		</ul>

	<?php } else { ?>

			<ul class="comments-list">
				<?php wp_list_comments( 'type=comment&avatar_size=64&callback=kite_theme_comment' ); ?>
			</ul>

	<?php } ?>


		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>

	</div>
	<?php

	// Deal with closed comments
	if ( ! comments_open() ) { // if the post has comments but comments are now closed
		?>

			<?php if ( is_single() ) { ?>
				<p class="nocomments"><?php esc_html_e( 'Comments are now closed.', 'teta-lite' ); ?></p>
				<?php
			} else {
				?>
				<p class="nocomments"><?php esc_html_e( 'Comments are now closed for this article.', 'teta-lite' ); ?></p>
			<?php } ?>

		<?php
	}
} else // There are no comments
{
	if ( ! comments_open() ) {
		if ( is_single() ) {
			?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'teta-lite' ); ?></p>
			<?php
		} else {
			?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed for this article.', 'teta-lite' ); ?></p>
			<?php
		}
	}
} // if there are comments

// Comment Form
if ( ! comments_open() ) {
	return;
}
?>
<div id="respond-wrap">
<?php
comment_form(
	array(
		'comment_notes_before' => '<p>' . esc_html__( 'Your email address will not be published. Website Field Is Optional.', 'teta-lite' ) . '</p>',
		'comment_field'        => '<div class="input-textarea"><span class="label">' . esc_html__( 'Comment', 'teta-lite' ) . '</span><span class="graylabel">' . esc_html__( 'Your Message', 'teta-lite' ) . '</span><textarea rows="10" cols="58" name="comment" tabindex="4"></textarea></div>',
	)
);
?>
</div>

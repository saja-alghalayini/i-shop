<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! comments_open() ) {
	return;
}

// add 'row' that wrap feilds

add_action( 'comment_form_before_fields', 'kite_comment_before_fields' );
add_action( 'comment_form_after_fields', 'kite_comment_after_fields' );

add_action( 'comment_form_logged_in', 'kite_comment_before_fields' );
add_action( 'comment_form_logged_in_after', 'kite_comment_after_fields' );

?>
<div class="review-container">
	<div id="reviews">
		<div id="comments">
			<h2>
				<?php
				$count = $product->get_review_count();
				if ( $count && wc_review_ratings_enabled() ) {
					/* translators: 1: reviews count 2: product name */
					$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'teta-lite' ) ), esc_html( $count ), '<span>' . esc_html( get_the_title() ) . '</span>' );
					echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
				} else {
					esc_html_e( 'Reviews', 'teta-lite' );
				}
				?>
			</h2>

			<?php if ( have_comments() ) : ?>

				<ol class="commentlist">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>

				<?php
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links(
						apply_filters(
							'woocommerce_comment_pagination_args',
							array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							)
						)
					);
					echo '</nav>';
				endif;
				?>

			<?php else : ?>

				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'teta-lite' ); ?></p>

			<?php endif; ?>
		</div>

		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

			<div id="review_form_wrapper">
				<div id="review_form">
					<?php

						$commenter = wp_get_current_commenter();

						$comment_form = array(
							'title_reply'        => have_comments() ? esc_html__( 'Add a review', 'teta-lite' ) : esc_html__( 'Be the first to review', 'teta-lite' ) . ' &ldquo;' . esc_html( get_the_title() ) . '&rdquo;',
							'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'teta-lite' ),
							'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
							'title_reply_after'  => '</span>',
							'fields'             => array(

								// Edit Name feild
								'author' => '<div class="comment-form-author">' .
													'<span class="label required">' . esc_html__( 'Name', 'teta-lite' ) . '</span>' .
													'<span class="graylabel"> ' . esc_html__( 'Name', 'teta-lite' ) . '</span>' .
													'<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />' .

												'</div>',

								// Edit Email feild
								'email'  => '<div class="form-group comment-form-email">' .
													'<span class="label required">' . esc_html__( 'Email', 'teta-lite' ) . '</span>' .
													'<span class="graylabel"> ' . esc_html__( 'Email', 'teta-lite' ) . '</span>' .
													'<input id="email" name="email" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />' .

												'</div>',
							),
							'label_submit'       => esc_attr__( 'Submit', 'teta-lite' ),
							'logged_in_as'       => '',
							'comment_field'      => '',
						);

						if ( wc_review_ratings_enabled() ) {

							$comment_form['comment_field'] = '
		                        
		                        <p class="comment-form-rating">
		                            <label for="rating">' . esc_html__( 'Your Rating', 'teta-lite' ) . '</label>
		                            <select name="rating" id="rating">
									    <option value="">' . esc_html__( 'Rate&hellip;', 'teta-lite' ) . '</option>
									    <option value="5">' . esc_html__( 'Perfect', 'teta-lite' ) . '</option>
									    <option value="4">' . esc_html__( 'Good', 'teta-lite' ) . '</option>
									    <option value="3">' . esc_html__( 'Average', 'teta-lite' ) . '</option>
									    <option value="2">' . esc_html__( 'Not that bad', 'teta-lite' ) . '</option>
									    <option value="1">' . esc_html__( 'Very Poor', 'teta-lite' ) . '</option>
								    </select>
		                                
		                        </p>';
						}

						if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( 'You must be <a href="%s">logged in</a> to post a review.', esc_url( $account_page_url ) ) . '</p>';
						}

						// Edit Your review textarea feild
						$comment_form['comment_field'] .= '<div class="comment-form-comment">
																<span class="label required">' . esc_html__( 'Your Review', 'teta-lite' ) . '</span>
		                                                        <span class="graylabel">' . esc_html__( 'Your Review', 'teta-lite' ) . '</span>
																<textarea id="comment" name="comment" cols="45" rows="8" class="form-control autogrow" placeholder="' . esc_attr__( 'Your Review...', 'teta-lite' ) . '"></textarea>
		                                                    </div>';

						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

						?>
				</div>
			</div>

		<?php else : ?>

			<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'teta-lite' ); ?></p>

		<?php endif; ?>

		<div class="clear"></div>
	</div>
</div>

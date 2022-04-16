<?php

//
// ─── SOCIAL SHARE MARKUP ────────────────────────────────────────────────────────
//
if ( ! function_exists( 'kite_generate_social_share_markup' ) ) {
	/**
	 * generate social share markup
	 *
	 * @param  mixed $post
	 * @param  mixed $portfolioLoop
	 * @return string
	 */
	function kite_generate_social_share_markup( $portfolioLoop = '' ) {
		
		global $post;

		$fbshare        = kite_opt( 'social_share_facebook', false );
		$emailshare     = kite_opt( 'social_share_mail', false );
		$twittershare   = kite_opt( 'social_share_twitter', false );
		$telegramshare   = kite_opt( 'social_share_telegram', false );
		$washare        = kite_opt( 'social_share_whatsapp', false );
		$linkedinshare   = kite_opt( 'social_share_linkedin', false );
		$vkshare   = kite_opt( 'social_share_vk', false );
		$pinterestshare = kite_opt( 'social_share_pinterest', false );

		if ( empty( $portfolioLoop ) ) {

			// try getting featured image -  pinterest icon
			$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			if ( ! $featured_img ) {
				$featured_img = '';
			} else {
				$featured_img = $featured_img[0];
			}
		} else {

			$featured_img = '';

		}

		$social_share_facebook  =
							'<li class="sociallink-shortcode iconstyle facebook">
								<a href="http' . '://www' . '.facebook.' . 'com/sharer.php?u=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '" title="' . esc_attr__( 'Share on Facebook!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-facebook"></span>
									<span class="second-icon icon icon-facebook"></span>
								</a>
							</li> ';
		$social_share_whatsapp  =
							'<li class="sociallink-shortcode iconstyle whatsapp">
								<a href="https' . '://api.whatsapp.com/send?text=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '&amp;title=' . esc_attr( urlencode( get_the_title() ) ) . '" title="' . esc_attr__( 'Share on Whatsapp!', 'teta-lite') . '">
									<span class="firsticon icon icon-whatsapp"></span>
									<span class="second-icon icon icon-whatsapp"></span>
								</a>
							</li> ';
		$social_share_telegram   =
							'<li class="sociallink-shortcode iconstyle telegram">
								<a href=" https' . '://telegram.me/share/?url='. urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '"
											title="' . esc_attr__( 'Share on Telegram!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-telegram"></span>
									<span class="second-icon icon icon-telegram"></span>
								</a>
							</li> ';
		$social_share_twitter   =
							'<li class="sociallink-shortcode iconstyle twitter">
								<a href="https' . '://twitter' . '.com/intent/tweet?original_referer=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '&amp;source=tweetbutton&amp;text=' . esc_attr( urlencode( get_the_title() ) ) . '&amp;url=' . esc_url( urlencode( get_permalink( get_the_ID() ) ) ) . '"
											title="' . esc_attr__( 'Share on Twitter!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-twitter"></span>
									<span class="second-icon icon icon-twitter"></span>
								</a>
							</li> ';
		$social_share_linkedin   =
							'<li class="sociallink-shortcode iconstyle linkedin">
								<a href="https' . '://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '"

											title="' . esc_attr__( 'Share on LinkedIn!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-linkedin"></span>
									<span class="second-icon icon icon-linkedin"></span>
								</a>
							</li> ';
		$social_share_vk   =
							'<li class="sociallink-shortcode iconstyle vk">
								<a href="https' . '://vk.com/share.php?url=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '&amp;title=' . esc_attr( urlencode( get_the_title() ) ) . '&amp;image=' . esc_attr($featured_img) . '"
											title="' . esc_attr__( 'Share on vk!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-vk"></span>
									<span class="second-icon icon icon-vk"></span>
								</a>
							</li> ';
		$social_share_mail      =
							'<li class="sociallink-shortcode iconstyle email">
								<a href="mailto:?subject=' . get_the_permalink() . '" title="' . esc_attr__( 'Share by Mail!', 'teta-lite' ) . '">
									<span class="firsticon icon icon-envelope2"></span>
									<span class="second-icon icon icon-envelope2"></span> 
								</a>
							</li>';
		$social_share_pinterest =
							'<li class="sociallink-shortcode iconstyle pinterest">
								<a href="http' . '://pinterest.' . 'com/pin/create/button/?url=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '&amp;media=' . esc_url( $featured_img ) . '&amp;description=' . esc_attr( urlencode( get_the_title() ) ) . '" class="pin-it-button">
									<span class="firsticon icon icon-pinterest"></span>
									<span class="second-icon icon icon-pinterest"></span> 
								</a>
							</li>';
		$markup = '<ul class="social-icons dark"> ';

		$markup .= ( $fbshare == '1' ) ? $social_share_facebook : '';
		$markup .= ( $emailshare == '1' ) ? $social_share_mail : '';
		$markup .= ( $twittershare == '1' ) ? $social_share_twitter : '';
		$markup .= ( $telegramshare == '1' ) ? $social_share_telegram : '';
		$markup .= ( $washare == '1' ) ? $social_share_whatsapp : '';
		$markup .= ( $linkedinshare == '1' ) ? $social_share_linkedin : '';
		$markup .= ( $vkshare == '1' ) ? $social_share_vk : '';
		$markup .= ( $pinterestshare == '1' ) ? $social_share_pinterest : '';

		$markup .= '</ul>';

		return $markup;

	}
}

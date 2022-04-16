<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" 
<?php
if ( $hidden ) {
	echo 'style="display:none;"';}
?>
>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); // @codingStandardsIgnoreLine ?>

	<p class="form-row form-row-first">
		<label for="username"><?php esc_html_e( 'Username or email', 'teta-lite' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" autocomplete="username" />
	</p>
	<p class="form-row form-row-last">
		<label for="password"><?php esc_html_e( 'Password', 'teta-lite' ); ?>&nbsp;<span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
	</p>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="form-row form-row-wide">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'teta-lite' ); ?>"><?php esc_html_e( 'Login', 'teta-lite' ); ?></button>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
		<label for="rememberme" class="inline">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'teta-lite' ); ?>
		</label>
		<span class="lost_password">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'teta-lite' ); ?></a>
		</span>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>

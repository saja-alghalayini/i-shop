<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     3.1.5
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_instagram_api_connector' ) ) {
	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_instagram_api_connector extends ReduxFramework {

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value = '', $parent = null ) {

			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;
			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}
		}
		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {

			// HTML output goes here
			$nonce = wp_create_nonce( 'kite-disconnect-instagram' );
			$token = get_option( 'kite_instagram_long_access_token', '');

			$connector_class = empty( $token ) ? '' : 'disable';
			$disconnector_class = empty( $token ) ? 'disable' : '';

            $connector = '<a class="instagram_connector ' . $connector_class . '" target="_blank" href="' . get_site_url( null, '/?insta_connect') . '">' . esc_html__( 'Connect', 'teta-lite' ) . '</a>';
            $disconnector = '<a href="#" class="instagram_disconnector ' . $disconnector_class . '" data-nonce="'. $nonce .'" >' . esc_html__( 'Disconnect', 'teta-lite' ) . '</a>';
		
            echo wp_kses( $connector . $disconnector, $GLOBALS['kite-allowed-tags'] ) ;
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {
			wp_enqueue_script( 'kite-instagram-connector', $this->extension_url . 'instagram-api-connector.js', ['jquery'], KITE_THEME_VERSION, true );
		}

	}
}


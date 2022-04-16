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
if ( ! class_exists( 'ReduxFramework_icon_picker' ) ) {
	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_icon_picker extends ReduxFramework {

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
			$icons = maybe_unserialize( get_transient( 'kite_icon_names' ) );

			$icon_list = '<select name=' . esc_attr( $this->field['name'] ) . ' id=' . esc_attr( $this->field['id'] ) . " class='customizer_icon_picker'><option value=" . esc_attr( $this->value ) . '>' . esc_attr( $this->value ) . '</option>';

			foreach ( $icons as $value ) {
				$icon_list .= '<option>icon-' . esc_attr( $value ) . '</option>';
			}

			$icon_list .= '</select>';
			echo '' . $icon_list;
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
			wp_enqueue_style( 'jquery-fonticonpicker', $this->extension_url . 'jquery.fonticonpicker.min.css', false, KITE_THEME_VERSION );
			wp_enqueue_style( 'jquery-fonticonpicker-grey', $this->extension_url . 'jquery.fonticonpicker.grey.min.css', false, KITE_THEME_VERSION );
			$icomoon_handler = wp_style_is( 'icomoon', 'queue' ) ? 'kite-icomoon' : 'icomoon';
			wp_enqueue_style( $icomoon_handler, KITE_THEME_ASSETS_URI . '/css/icomoon.min.css', false, KITE_THEME_VERSION );
			wp_enqueue_script(
				'jquery-fonticonpicker',
				$this->extension_url . 'jquery.fonticonpicker.min.js',
				false,
				KITE_THEME_VERSION,
				true
			);
			wp_enqueue_script(
				'kite-epicoiconpicker',
				$this->extension_url . 'epic_icon_picker.js',
				false,
				KITE_THEME_VERSION,
				true
			);

		}

	}
}


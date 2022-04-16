<?php

class Kite_Menu {

	private $postType;

	function __construct() {

		$this->postType = 'nav_menu_item';

		add_filter( 'nav_menu_item_additional_fields', array( &$this, 'kite_show_meta_box' ), 10, 5 );

		add_filter( 'wp_edit_nav_menu_walker', array( &$this, 'kite_nav_menu_hanler' ) );

		// Save post meta on the 'save_post' hook.
		add_action( 'save_post', array( &$this, 'kite_save_data' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( &$this, 'kite_init_scripts' ) );

	}

	function kite_save_data( $post_id = false, $post = false ) {

		// Verify the nonce before proceeding.
		$nonce = KITE_THEME_NAME_SEO . '_post_nonce';

		if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], 'theme-post-meta-form' ) ) {
			return $post_id;
		}

		// check auto-save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( $post->post_type != $this->postType || ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// CRUD Operation
		foreach ( $this->kite_get_options_for_store() as $key => $settings ) {
			$uniqueKey = $key . '-' . $post_id;// Unique key used for access fields of each menu item
			$postedVal = isset( $_POST[ $uniqueKey ] ) ? $_POST[ $uniqueKey ] : '';
			$val       = get_post_meta( $post_id, $key, false );

			if ( is_array( $postedVal ) ) {
				// Insert
				if ( ! empty( $postedVal ) && empty( $val ) ) {
					add_post_meta( $post_id, $key, $postedVal );

				}
				// Delete
				elseif ( ! empty( $val ) && empty( $postedVal ) ) {
					delete_post_meta( $post_id, $key );

					// Delete the attachment as well
					if ( $settings['type'] == 'upload' ) {
						kite_delete_attachment( $val );
					}
				}
				// Update
				elseif ( ! empty( $val ) && ! empty( $postedVal ) && $postedVal != $val ) {
					update_post_meta( $post_id, $key, $postedVal );
				}
			} else {
				// Insert
				if ( $postedVal != '' && empty( $val ) ) {
					add_post_meta( $post_id, $key, $postedVal );

				}
				// Delete
				elseif ( ! empty( $val ) && $postedVal == '' ) {
					delete_post_meta( $post_id, $key );

					// Delete the attachment as well
					if ( $settings['type'] == 'upload' ) {
						kite_delete_attachment( $val );
					}
				}
				// Update
				elseif ( $postedVal != '' && ! empty( $val ) && $postedVal != $val ) {
					update_post_meta( $post_id, $key, $postedVal );
				}
			}
		}

		return $post_id;
	}

	private function kite_get_options_for_store() {
		$options = $this->kite_get_options();
		$values  = array();

		foreach ( $options as $key => $field ) {
			$ignore = kite_array_value( 'dontsave', kite_array_value( 'meta', $field, array() ), false );

			if ( $ignore ) {
				continue;
			}

			$values[ $key ] = $field;
		}

		return $values;
	}

	private function kite_get_options() {
		$fields = array(
			'hide-in-menu-switch' => array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Hide in the menu', 'teta-lite' ),
				'class'       => 'hide-in-menu',
				'description' => esc_html__( 'If you check, this item  will be hidden.(Used in one-page style)', 'teta-lite' ),
				'value'       => '1',
			),
			'badge-label'         => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Badge label', 'teta-lite' ),
				'placeholder' => esc_html__( 'eg: new', 'teta-lite' ),
				'value'       => '',
			),
			'badge-bg-color'      => array(
				'type'  => 'color',
				'label' => esc_html__( 'Badge background color', 'teta-lite' ),
				'value' => '#ccc',
			),
			'is-mega-menu'        => array(
				'type'        => 'checkbox',
				'class'       => 'is-mega-menu',
				'label'       => esc_html__( 'Mega Menu', 'teta-lite' ),
				'description' => esc_html__( 'Transforms the menu to mega menu', 'teta-lite' ),
				'value'       => '1',
			),
			'is-bottom-line'      => array(
				'type'        => 'checkbox',
				'class'       => 'special-last-child',
				'label'       => esc_html__( 'Show the last child in special style', 'teta-lite' ),
				'description' => esc_html__( 'It is displayed in bottom of mega menu, use description field of last child to show subtitle', 'teta-lite' ),
				'value'       => '1',
			),
			'hide-menu-title'      => array(
				'type'        => 'checkbox',
				'class'       => 'hide-menu-title',
				'label'       => esc_html__( 'Hide menu title', 'teta-lite' ),
				'description' => esc_html__( 'Select to hide this title in mega menu', 'teta-lite' ),
				'value'       => '1',
			),
			'bg-image'            => array(
				'label'       => esc_html__( 'Background Image', 'teta-lite' ),
				'description' => esc_html__( 'Set an image for the mega menu', 'teta-lite' ),
				'type'        => 'upload',
				'referer'     => 'kt-portfolio-image',
				'meta'        => array( 'array' => false ),
			),
			'nav-menu-icon'       => array(
				'type'  => 'icon',
				'label' => esc_html__( 'Icon', 'teta-lite' ),
				'class' => 'menu-icon-container',
				'flags' => 'attribute', // CSV
			),
		);

		return $fields;

	}

	// this option add id of menu to each options because we need unique field names in menu page for each menu item
	private function kite_make_unique_options( $id ) {
		$options = $this->kite_get_options();

		$new_options = [];

		foreach ( $options as $key => $field ) {
			$new_options[ $key . '-' . $id ] = $field;
		}

		return $new_options;
	}

	function kite_show_meta_box( $new_fields, $item_output, $item, $depth, $args ) {
		require_once KITE_THEME_LIB . '/forms/fieldtemplate.php';
		require_once KITE_THEME_LIB . '/forms/post-options-provider.php';
		global $post;
		$post    = $item;
		$options = $this->kite_make_unique_options( $item->ID );

		$form = new Kite_Field_Template( new Kite_Post_Options_Provider(), dirname( __FILE__ ) );
		return $form->kite_get_template( 'meta-form', $options );
	}

	function kite_nav_menu_hanler() {
		require_once KITE_THEME_LIB . '/menu/nav-menu-handler.php';
		// return the name of class that handles nav-menu output in wp-admin
		return 'Kite_Walker_Nav_Menu_Edit';

	}

	function kite_init_scripts() {
		global $post;
		if ( ! $post || $post->post_type != $this->postType ) {
			return;
		}

		$this->kite_register_scripts();
		$this->kite_enqueue_scripts();
	}

	private function kite_register_scripts() {
		wp_register_script( 'jquery-easing', KITE_THEME_ASSETS_URI . '/js/jquery.easing.min.js', array( 'jquery' ), '1.3', true );

		wp_register_script( 'wp-color-picker-alpha', KITE_THEME_LIB_URI . '/admin/scripts/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '3.0.0' );

		wp_register_style( 'jquery-chosen', KITE_THEME_LIB_URI . '/admin/css/chosen.css', false, '1.0.0', 'screen' );
		wp_register_script( 'jquery-chosen', KITE_THEME_LIB_URI . '/admin/scripts/chosen.jquery.min.js', array( 'jquery' ), '1.0.0' );

		wp_register_style( 'kite-admin-css', KITE_THEME_LIB_URI . '/admin/css/style.css', false, '1.0.0', 'screen' );
		wp_register_script( 'kite-admin-js', KITE_THEME_LIB_URI . '/admin/scripts/admin.js', array( 'jquery' ), '1.0.0' );
	}

	private function kite_enqueue_scripts() {
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'jquery-easing' );

		// Include wpcolorpicker + its patch to support alpha chanel
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker-alpha' );

		wp_enqueue_style( 'jquery-chosen' );
		wp_enqueue_script( 'jquery-chosen' );

		wp_enqueue_style( 'kite-admin-css' );
		wp_enqueue_script( 'kite-admin-js' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
	}
}

new Kite_Menu();

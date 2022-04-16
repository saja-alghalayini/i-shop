<?php

/**
 * ------------------------------------------------------------------------------------------------
 * Init Theme Settings and Options with Redux plugin
 * ------------------------------------------------------------------------------------------------
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

	$opt_name = KITE_OPTIONS_KEY;
	$theme    = wp_get_theme();

	$args = array(
		'opt_name'             => $opt_name,
		'display_name'         => $theme->get( 'Name' ),
		'display_version'      => $theme->get( 'Version' ),
		'menu_type'            => 'menu',
		'allow_sub_menu'       => true,
		'menu_title'           => esc_html__( 'Theme Settings', 'teta-lite' ),
		'page_title'           => esc_html__( 'Theme Settings', 'teta-lite' ),
		'google_api_key'       => '',
		'google_update_weekly' => false,
		'async_typography'     => false,
		'admin_bar'            => true,
		'admin_bar_icon'       => 'dashicons-portfolio',
		'admin_bar_priority'   => 50,
		'global_variable'      => '',
		'dev_mode'             => false,
		'update_notice'        => true,
		'customizer'           => true,
		'page_priority'        => 3,
		'page_parent'          => 'themes.php',
		'page_permissions'     => 'manage_options',
		'menu_icon'            => '',
		'last_tab'             => '',
		'page_icon'            => 'icon-themes',
		'page_slug'            => 'theme_settings',
		'save_defaults'        => true,
		'default_show'         => false,
		'default_mark'         => '',
		'show_import_export'   => true,
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		'output_tag'           => true,
		'footer_credit'        => '1.0',
		'database'             => '',
		'system_info'          => false,
		'hints'                => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'light',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		),
	);

	Redux::setArgs( $opt_name, $args );

	do_action( 'kite_before_settings_initialized' );

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'General Settings', 'teta-lite' ),
			'id'     => 'kite_general',
			'icon'   => 'icon-cog',
			'fields' => array(
				array(
					'id'      => 'page_breadcrumb',
					'type'    => 'switch',
					'title'   => esc_html__( 'Header BreadCrumb', 'teta-lite' ),
					'default' => true,
				),
				array(
					'id'       => 'favicon',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Specify custom favicon URL or upload a new one here.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Favicon', 'teta-lite' ),
					'class'    => 'favicon',
				),
				array(
					'id'       => 'scrolling-easing',
					'type'     => 'select',
					'title'    => esc_html__( 'Page Scrolling Motion Effect', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select one of the scrolling motion effects bellow.', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options'  => array(
						'linear'           => 'linear',
						'easeInQuad'       => 'Ease In Quad',
						'easeOutQuad'      => 'Ease Out Quad',
						'easeInOutQuad'    => 'Ease In Out Quad',
						'easeInCubic'      => 'Ease In Cubic',
						'easeOutCubic'     => 'Ease Out Cubic',
						'easeInOutCubic'   => 'Ease In Out Cubic',
						'easeInQuart'      => 'Ease In Quart',
						'easeOutQuart'     => 'Ease Out Quart',
						'easeInOutQuart'   => 'Ease In Out Quart',
						'easeInQuint'      => 'Ease In Quint',
						'easeOutQuint'     => 'Ease Out Quint',
						'easeInOutQuint'   => 'Ease In Out Quint',
						'easeInSine'       => 'Ease In Sine',
						'easeOutSine'      => 'Ease Out Sine',
						'easeInOutSine'    => 'Ease In Out Sine',
						'easeInExpo'       => 'Ease In Expo',
						'easeOutExpo'      => 'Ease Out Expo',
						'easeInOutExpo'    => 'Ease In Out Expo',
						'easeInCirc'       => 'Ease In Circ',
						'easeOutCirc'      => 'Ease Out Circ',
						'easeInOutCirc'    => 'Ease In Out Circ',
						'easeInElastic'    => 'Ease In Elastic',
						'easeOutElastic'   => 'Ease Out Elastic',
						'easeInOutElastic' => 'Ease In Out Elastic',
						'easeInBack'       => 'Ease In Back',
						'easeOutBack'      => 'Ease Out Back',
						'easeInOutBack'    => 'Ease In Out Back',
						'easeInBounce'     => 'Ease In Bounce',
						'easeOutBounce'    => 'Ease Out Bounce',
						'easeInOutBounce'  => 'Ease In Out Bounce',
					),
					'default'  => 'easeInOutQuart',
				),
				array(
					'id'            => 'scrolling-speed',
					'type'          => 'slider',
					'title'         => esc_html__( 'Scrolling Speed', 'teta-lite' ),
					'subtitle'      => esc_html__( 'Adjust the speed of pages vertical scrolling.', 'teta-lite' ),
					'default'       => 1000,
					'min'           => 5,
					'step'          => 50,
					'max'           => 5000,
					'display_value' => 'label',
				),
				array(
					'id'       => 'lite_option_47u6i9rzwij',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload dashboard\'s login page logo. ( best size : 302px X 62px ) ( PNG , JPG , GIF )', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Dashboard\'s Login Page Logo', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'       => 'retina_ready',
					'type'     => 'switch',
					'title'    => esc_html__( 'Retina Ready', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can enable or disable retina. notice that enabling this option generate more images', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => 0,
				),
				array(
					'id'       => 'scrolltop_button',
					'type'     => 'switch',
					'title'    => esc_html__( 'Scroll Top Button', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can enable or disable scroll top button', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'       => 'layout_width',
					'type'     => 'switch',
					'title'    => esc_html__( 'Layout Width', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select width of layout', 'teta-lite' ),
					'on'       => esc_html__( 'Fullwidth', 'teta-lite' ),
					'off'      => esc_html__( 'Container', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'       => 'lite_option_tyqiki8t7h',
					'type'     => 'switch',
					'title'    => esc_html__( 'Pages Container Size', 'teta-lite' ),
					'subtitle' => esc_html__( 'Predefined size is set to 1170px.', 'teta-lite' ),
					'on'       => esc_html__( 'Predefined Size', 'teta-lite' ),
					'off'      => esc_html__( 'Custom Size', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'            => 'lite_option_l905awx2ew',
					'type'          => 'slider',
					'title'         => esc_html__( 'Custom Container Size', 'teta-lite' ),
					'subtitle'      => esc_html__( 'Adjust the size of pages container width. (Defined by pixle)', 'teta-lite' ),
					'default'       => 1170,
					'min'           => 1170,
					'step'          => 1,
					'max'           => 1600,
					'display_value' => 'label',
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_3qvmtpn0t8',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Details Container Size', 'teta-lite' ),
					'subtitle' => esc_html__( 'Predefined size is set to 1170px.', 'teta-lite' ),
					'on'       => esc_html__( 'Predefined Size', 'teta-lite' ),
					'off'      => esc_html__( 'Custom Size', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'            => 'lite_option_t81r27h5clq',
					'type'          => 'slider',
					'title'         => esc_html__( 'Product Detail Custom Container Size', 'teta-lite' ),
					'subtitle'      => esc_html__( 'Adjust the size of pages container width. (Defined by pixle)', 'teta-lite' ),
					'default'       => 1170,
					'min'           => 1170,
					'step'          => 1,
					'max'           => 1600,
					'display_value' => 'label',
					'class'	   => 'kt-pro-feature'
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Color Scheme', 'teta-lite' ),
			'id'     => 'kite_color',
			'icon'   => 'icon-bucket',
			'fields' => array(
				array(
					'id'       => 'style-accent-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Accent Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Accent color for theme elements.', 'teta-lite' ),
					'default'  => array(
						'color' => '#5956e9',
						'alpha' => '1',
					),

					'mode'     => 'background',

				),
				array(
					'id'       => 'style-highlight-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Highlight Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Highlight color on the highlited elements.', 'teta-lite' ),
					'default'  => array(
						'color' => '#424242',
						'alpha' => '1',
					),

					'mode'     => 'background',

				),
				array(
					'id'      => 'element-on-accent-color-style',
					'title'   => esc_html__( 'Chroma of Elements Placed On Accent Color', 'teta-lite' ),
					'type'    => 'switch',
					'on'      => esc_html__( 'Light', 'teta-lite' ),
					'off'     => esc_html__( 'Dark', 'teta-lite' ),
					'default' => true,
				),
				array(
					'id'     => 'Link_Color_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Link Color', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'style-link-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Normal Link Color', 'teta-lite' ),
					'default' => array(
						'color' => '#4592ff',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'      => 'style-link-hover-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'On Hover Link Color', 'teta-lite' ),
					'default' => array(
						'color' => '#307adb',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'     => 'Link_Color_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Pages Loading Transition', 'teta-lite' ),
			'id'     => 'kite_preloader',
			'icon'   => 'icon-toggle',
			'fields' => array(
				array(
					'id'       => 'loader_display',
					'title'    => esc_html__( 'Switch preloader | page transition', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can switch between preloader and page transition effect. This loader would be shown before your website is loaded completely.', 'teta-lite' ),
					'type'     => 'radio',
					'options'  => array(
						'1' => 'Preloader',
						'2' => 'None',
					),
					'default'  => '2',
				),
				array(
					'id'       => 'preloader_type_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Preloader Type', 'teta-lite' ),
					'indent'   => true,
					'required' => array( 'loader_display', '=', '1' ),

				),
				array(
					'id'      => 'preloader_display',
					'title'   => esc_html__( 'Switch preloader | page transition', 'teta-lite' ),
					'type'    => 'switch',
					'on'      => esc_html__( 'Display always', 'teta-lite' ),
					'off'     => esc_html__( 'Display just Between pages', 'teta-lite' ),
					'default' => true,
				),
				array(
					'id'      => 'preloader-type',
					'type'    => 'image_select',
					// Must provide key => value(array:title|img) pairs for radio options
					'options' => array(
						'circular' => array(
							'alt' => 'circular',
							'img' => KITE_THEME_LIB_URI . '/admin/img/preloader/circular.png',
						),
						'creative' => array(
							'alt' => 'creative',
							'img' => KITE_THEME_LIB_URI . '/admin/img/preloader/creative.png',
						),
						'simple'   => array(
							'alt' => 'simple',
							'img' => KITE_THEME_LIB_URI . '/admin/img/preloader/simple.png',
						),
						'sniper'   => array(
							'alt' => 'sniper',
							'img' => KITE_THEME_LIB_URI . '/admin/img/preloader/sniper.png',
						),
					),
					'default' => 'simple',
				),
				array(
					'id'     => 'preloader_type_section_end',
					'type'   => 'section',
					'indent' => false,
				),

				array(
					'id'       => 'preloader_color_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Preloader Color', 'teta-lite' ),
					'indent'   => true,
					'required' => array( 'loader_display', '=', '1' ),

				),
				array(
					'id'      => 'preloader_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'color', 'teta-lite' ),
					'default' => array(
						'color' => '#c7c7c7',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'      => 'preloader_bg_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Background color', 'teta-lite' ),
					'default' => array(
						'color' => '#efefef',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'       => 'preloader_box_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Box color', 'teta-lite' ),
					'default'  => array(
						'color' => '#f7f7f7',
						'alpha' => '1',
					),

					'mode'     => 'background',

					'required' => array( 'preloader-type', '=', 'creative' ),
				),
				array(
					'id'       => 'preloader_text_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Preloader Text', 'teta-lite' ),
					'indent'   => true,
					'required' => array( 'preloader-type', '=', 'creative' ),
				),
				array(
					'id'    => 'preloader-text',
					'type'  => 'text',
					'title' => esc_html__( 'Preloader Text', 'teta-lite' ),
				),
				array(
					'id'      => 'preloader_text_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Preloader Text color', 'teta-lite' ),
					'default' => array(
						'color' => '#000',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'     => 'preloader_text_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'preloader-logo',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Choose an image to make it appear in preloader page. (PNG, GIF, JPG)', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Preloader Image', 'teta-lite' ),
					'required' => array( 'preloader-type', '=', 'creative' ),
				),

			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Popup Newsletter', 'teta-lite' ),
			'id'     => 'kite_Popup_Newsletter',
			'icon'   => 'icon-news',
			'fields' => array(
				array(
					'id'       => 'popupNewsletterDisplay',
					'type'     => 'switch',
					'title'    => esc_html__( 'Popup Newsletter Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'This Newsletter will be shown to the visitors when they enter the site. You can enable or disable it.', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'     => 'popupNewsLetter_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Popup Newsletter Title and Subtitle', 'teta-lite' ),
					'indent' => true,
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
				array(
					'id'       => 'popupNewsLetterTitle',
					'type'     => 'text',
					'title'    => esc_html__( 'Title', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a title for the newsletter.', 'teta-lite' ),

				),
				array(
					'id'       => 'popupNewsLetterSubtitle',
					'type'     => 'text',
					'title'    => esc_html__( 'Subtitle', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a subtitle for the newsletter.', 'teta-lite' ),

				),
				array(
					'id'     => 'popupNewsLetter_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'popupNewsLetterShortcode',
					'type'     => 'text',
					'title'    => esc_html__( 'Popup Newsletter Shortcode', 'teta-lite' ),
					'subtitle' => esc_html__( 'Add a newsletter shortcode in this box. You can create your desired form by Mailchimp and then insert its shortcode here.', 'teta-lite' ),
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
				array(
					'id'       => 'popupNewsLetterBackgroundImage',
					'type'     => 'media',
					'operator' => 'and',
					'title'    => esc_html__( 'Popup Newsletter Background Image', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background image for the popup newsletter. It is better to use vertical photo (320*400).', 'teta-lite' ),
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
				array(
					'id'       => 'popupNewsLetterText',
					'type'     => 'text',
					'title'    => esc_html__( 'Popup Newsletter Extra Content', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can write some extra text to show on the newsletter popup.', 'teta-lite' ),
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
				array(
					'id'       => 'popupNewsLetterDisplayMobile',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show On Mobile', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show the popup in mobile devices', 'teta-lite' ),
					'default'  => false,
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
				array(
					'id'            => 'popupNewsLetterDelay',
					'type'          => 'slider',
					'title'         => esc_html__( 'Delay Time', 'teta-lite' ),
					'default'       => 1000,
					'min'           => 5,
					'step'          => 50,
					'max'           => 8000,
					'display_value' => 'label',
					'subtitle'      => esc_html__( 'Adjust the popup delay time after page loaded. (Defined by Milliseconds)', 'teta-lite' ),
					'required'=> array( 'popupNewsletterDisplay', '=' , true ),
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Header | Menu', 'teta-lite' ),
			'id'     => 'kite_header_menu',
			'icon'   => 'icon-window',
			'fields' => array(
				array(
					'id'     => 'header_builder_section-start',
					'type'   => 'section',
					'indent' => true,
					'title'	 => esc_html( 'Header Builder', 'teta-lite' ),
				),
				array (
					'id'       => 'is_header_build_with_elementor',
					'type'     => 'switch',
					'title'    => esc_html__('Build Header With Elementor', 'teta-lite'),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'elementor_header_template_id',
					'type'    => 'select',
					'title'   => esc_html__( 'Select Template', 'teta-lite' ),
					'options' => kite_get_elementor_templates_list( 'header' ),
					'required'=> array( 'is_header_build_with_elementor', '=' , true ),
				),
				array(
					'id'       => 'header-type',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Header Type', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select header type', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						1  => array(
							'alt' => 'type-1',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-1.png',
						),
						2  => array(
							'alt' => 'type-2',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-2.png',
						),
						3  => array(
							'alt' => 'type-3',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-3.png',
						),
						4  => array(
							'alt' => 'type-4',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-4.png',
						),
						5  => array(
							'alt' => 'type-5',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-5.png',
						),
						6  => array(
							'alt' => 'type-6',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-6.png',
						),
						9  => array(
							'alt' => 'type-9',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/type-9.png',
						),


					),
					'default'  => 1,
					'required'=> [
						array( 'is_header_build_with_elementor', '=' , false ),
					]
				),
				array(
					'id'     => 'header_builder_section-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'header-style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Second State Header Type', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select what to happens to the header after scrolling down the page.', 'teta-lite' ),

					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'normal-menu' => array(
							'alt' => 'normal-menu',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/normal-menu.png',
						),
						'kite-menu'   => array(
							'alt' => 'kite-menu',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/kite-menu.png',
						),
						'fixed-menu'  => array(
							'alt' => 'fixed-menu',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/fixed-menu.png',
						),
					),
					'default'  => 'normal-menu',
					'required'=> [
						array( 'is_header_build_with_elementor', '=' , false ),
					]
				),
				array(
					'id'       => 'menu-container',
					'type'     => 'switch',
					'title'    => esc_html__( 'Header Width', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the header to be boxed or full-width.', 'teta-lite' ),
					'on'       => esc_html__( 'Full Width', 'teta-lite' ),
					'off'      => esc_html__( 'Boxed', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'     => 'lite_option_qi0slptpajt',
					'type'   => 'section',
					'indent' => true,
					'title'	 => esc_html( 'Responsive Header Settings', 'teta-lite' ),
				),
				array(
					'id'       => 'lite_option_493qhc98pyl',
					'type'     => 'switch',
					'title'    => esc_html__( 'Mobile Header Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the style of header in responsive mode.', 'teta-lite' ),
					'on'       => esc_html__( 'Dark', 'teta-lite' ),
					'off'      => esc_html__( 'Light', 'teta-lite' ),
					'class'	 => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_jlwe9ktetn',
					'type'     => 'switch',
					'title'    => esc_html__( 'Mobile Off Canvas Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the style of off canvas menu in responsive mode.', 'teta-lite' ),
					'on'       => esc_html__( 'Dark', 'teta-lite' ),
					'off'      => esc_html__( 'Light', 'teta-lite' ),
					'class'	 => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_z1zxkziku9s',
					'type'    => 'switch',
					'title'   => esc_html__( 'Second State Header On Mobile', 'teta-lite' ),
					'default' => false,
					'class'	 => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_1q9wbsultfa',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'logo_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Logo', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'logo',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Uplaod your header logo.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Initial Header Logo', 'teta-lite' ),
				),
				array(
					'id'       => 'logo-second',
					'type'     => 'media',
					'subtitle' => esc_html__( 'This logo will be shown at the second state header.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Second State Header Logo', 'teta-lite' ),
					'required' => array( 'header-style', '=', 'kite-menu' ),
				),
				array(
					'id'       => 'responsivelogo',
					'type'     => 'media',
					'subtitle' => esc_html__( 'It\'s the logo that will only be shown in responsive mode (Mobile and tablets)', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Mobile Logo', 'teta-lite' ),
				),
				array(
					'id'     => 'logo_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'shop_cart_button_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Cart Button', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'shop-enable-cart',
					'type'     => 'switch',
					'title'    => esc_html__( 'Cart Button Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable menu cart menu button', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'      => 'icon_type',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Cart icon', 'teta-lite' ),
					'class'   => 'icon_type',
					'default' => 'cart',
					'options' => array(
						'cart-full'       => array(
							'alt' => 'cart-full',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/cart-full.png',
						),
						'cart-empty'      => array(
							'alt' => 'cart-empty',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/cart-empty.png',
						),
						'cart'            => array(
							'alt' => 'cart',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/cart.png',
						),
						'bag2'            => array(
							'alt' => 'bag2',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/bag2.png',
						),
						'bag'             => array(
							'alt' => 'bag',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/bag.png',
						),
						'shopping-basket' => array(
							'alt' => 'shopping-basket',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/shopping-basket.png',
						),
						'shopping-bag'    => array(
							'alt' => 'shopping-bag',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/shopping-bag.png',
						),
						'shopping-cart'   => array(
							'alt' => 'shopping-cart',
							'img' => KITE_THEME_LIB_URI . '/admin/img/cart_icons/shopping-cart.png',
						),
					),
				),
				array(
					'id'     => 'shop_cart_button_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'wishlist_button_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Wishlist Button ', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'header-wishlist-display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Wishlist Button Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable the display of the wishlist button.', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'       => 'responsive-wishlist-display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show Wishlist in Responsive', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show the wishlist button in responsive mode or not.', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'     => 'wishlist_button_section_end',
					'type'   => 'section',
					'indent' => false,
				),

				array(
					'id'     => 'wishlist_cart_button_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Cart/wishlist Button Chroma', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'shop-wishlist-cart-style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Cart/wishlist Button Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the Cart/wishlist button style.', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the Cart/wishlist button style.', 'teta-lite' ),
					'on'       => esc_html__( 'Dark Icon', 'teta-lite' ),
					'off'      => esc_html__( 'Light Icon', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'       => 'shop-wishlist-cart-bg-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Cart/wishlist Button Background Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background color for the Cart/wishlist button.', 'teta-lite' ),
					'default'  => array(
						'color' => '#eeeeee00',
						'alpha' => '0',
					),
					'mode'     => 'background',
				),
				array(
					'id'     => 'wishlist_cart_button_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'responsive-sticky-bottom-navbar_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Mobile Sticky Bottom Navigation', 'teta-lite' ),
					'indent' => true,
				),
				array (
					'id'       => 'responsive-sticky-bottom-navbar',
					'type'     => 'switch',
					'title'    => esc_html__('Sticky Bottom Navigation Bar', 'teta-lite'),
					'subtitle'     => esc_html__('Show or hide bottom sticky navigation bar', 'teta-lite'),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'mobile_category_menu',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Categories In Mobile Sticky Bottom Navigation', 'teta-lite' ),
					'subtitle'     => esc_html__('Show or hide Product Categories in the mobile sticky bottom navigation bar', 'teta-lite'),
					'default' => true,
					'on'       => esc_html__( 'Show', 'teta-lite' ),
					'off'      => esc_html__( 'Hide', 'teta-lite' ),
					'required' => array(
						array( 'responsive-sticky-bottom-navbar', '=', true ),
					),
				),
				array(
					'id'     => 'responsive-sticky-bottom-navbar_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);


	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Header Promo Bar', 'teta-lite' ),
			'id'     => 'kite_Header_PromoBar_lite',
			'icon'   => 'icon-reading',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'lite_option_19n2wtqoopp',
					'type'     => 'switch',
					'title'    => esc_html__( 'Promo Bar Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'The promo bar will be shown on top of the home page.', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_gd78qnpwj3g',
					'type'     => 'textarea',
					'title'    => esc_html__( 'Promo Bar Text', 'teta-lite' ),
					'subtitle' => esc_html__( 'Add a text to show on promo bar.', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),

				array(
					'id'      => 'lite_option_yzalg8bjtj',
					'type'    => 'switch',
					'title'   => esc_html__( 'Chroma of Promo Bar Text', 'teta-lite' ),
					'on'      => esc_html__( 'Dark', 'teta-lite' ),
					'off'     => esc_html__( 'Light', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),


				array(
					'id'       => 'lite_option_ghw3i44ihgo',
					'type'     => 'text',
					'title'    => esc_html__( 'Promo Bar Button', 'teta-lite' ),
					'subtitle' => esc_html__( 'This text will be Shown on your button. Leave it blank if you don\'t want to have the promo bar button.', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),


				array(
					'id'       => 'lite_option_up0m3px0dkr',
					'type'     => 'text',
					'title'    => esc_html__( 'Promo Bar link URL', 'teta-lite' ),
					'subtitle' => esc_html__( 'This link will be used for redirecting visitors after clicking on the promo bar or its button.', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_62xtxm5kmqh',
					'type'   => 'section',
					'title'  => esc_html__( 'Promo Bar Height', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'            => 'lite_option_syyoz95fwme',
					'type'          => 'slider',
					'title'         => esc_html__( 'Height of promo bar in desktop', 'teta-lite' ),
					'subtitle'      => esc_html__( 'Defined by pixle', 'teta-lite' ),
					'default'       => 50,
					'min'           => 50,
					'step'          => 1,
					'max'           => 200,
					'display_value' => 'label',
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'            => 'lite_option_m5awj8cw14g',
					'type'          => 'slider',
					'title'         => esc_html__( 'Height of promo bar in responsive', 'teta-lite' ),
					'subtitle'      => esc_html__( 'The measurement unit is a pixel.', 'teta-lite' ),
					'default'       => 60,
					'min'           => 60,
					'step'          => 1,
					'max'           => 200,
					'display_value' => 'label',
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_o6919j6gnkh',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_0y4kpzxj7xpa',
					'type'   => 'section',
					'title'  => esc_html__( 'Promo Bar Background Style', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_6fzdso37pqw',
					'type'     => 'media',
					'operator' => 'and',
					'title'    => esc_html__( 'Promo Bar Background Image', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background image for the Promo Bar.', 'teta-lite' ),
					'class'	   => 'kt-pro-feature'
				),

				array(
					'id'       => 'lite_option_ujj1svuyrqs',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Promo Bar Background Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background color for the Promo Bar.', 'teta-lite' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => '1',
					),
					'mode'     => 'background',
					'class'	   => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_dwp97g3wrfg',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'lite_option_tr26vqhdkd',
					'type'     => 'switch',
					'title'    => esc_html__( 'Promo Bar Close button Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'Showing of the close button.', 'teta-lite' ),
					'default'  => true,
					'class'	   => 'kt-pro-feature'
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Top Bar', 'teta-lite' ),
			'id'     => 'kite_topbar',
			'icon'   => 'icon-window-maximize',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'topbar_display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Enable Topbar', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can enable or disable the top bar here. Top bar is the bar that sticks to top of your page.', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'       => 'boxed_topbar',
					'type'     => 'switch',
					'title'    => esc_html__( 'Topbar Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can choose the top bar to be boxed or full-width', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Boxed', 'teta-lite' ),
					'off'      => esc_html__( 'Fullwidth', 'teta-lite' ),
				),
				array(
					'id'     => 'topbar_style_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Style', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'topbar_bg_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Topbar Content Chroma', 'teta-lite' ),
					'default' => array(
						'color' => '#eee',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'       => 'topbar_border_color',
					'type'     => 'color_rgba',
					'title'    => 'Topbar Border Color',
					'class'    => 'topbar-border-color',
					'subtitle' => esc_html__( 'Do you want the top bar have border? Choose its color.', 'teta-lite' ),
					'default'  => array(
						'color' => '#eee',
						'alpha' => '1',
					),

					'mode'     => 'background',

				),
				array(
					'id'      => 'topbar_style',
					'type'    => 'switch',
					'title'   => esc_html__( 'Topbar Color', 'teta-lite' ),
					'on'      => esc_html__( 'Light', 'teta-lite' ),
					'off'     => esc_html__( 'Dark', 'teta-lite' ),
					'default' => false,
				),
				array(
					'id'     => 'topbar_style_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'    => 'topbar_icon',
					'type'  => 'icon_picker',
					'title' => esc_html__( 'Topbar Icon', 'teta-lite' ),
				),
				array(
					'id'     => 'topbar_text_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Title and Text', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'    => 'topbar_title',
					'type'  => 'text',
					'title' => esc_html__( 'Top bar title', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar_text',
					'type'  => 'text',
					'title' => esc_html__( 'Top bar text', 'teta-lite' ),
				),
				array(
					'id'     => 'topbar_text_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'topbar-compare-display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Top bar Compare', 'teta-lite' ),
					'default'  => true,
					'subtitle' => esc_html__( 'This Item Works Perfectly If WooCommerce and YithCompare Plugins are active.', 'teta-lite' ),
				),
				array(
					'id'     => 'topbar_language_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Language', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'    => 'topbar-language-1',
					'type'  => 'text',
					'title' => esc_html__( '1st Language', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-link-1',
					'type'  => 'text',
					'title' => esc_html__( '1st Language URL', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-2',
					'type'  => 'text',
					'title' => esc_html__( 'Second Language', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-link-2',
					'type'  => 'text',
					'title' => esc_html__( 'Second Language URL', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-3',
					'type'  => 'text',
					'title' => esc_html__( 'Third Language', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-link-3',
					'type'  => 'text',
					'title' => esc_html__( 'Third Language URL', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-4',
					'type'  => 'text',
					'title' => esc_html__( 'Fourth Language', 'teta-lite' ),
				),
				array(
					'id'    => 'topbar-language-link-4',
					'type'  => 'text',
					'title' => esc_html__( 'Fourth Language URL', 'teta-lite' ),
				),
				array(
					'id'     => 'topbar_language_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'topbar-social-display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Social Icons', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable the social icons on the top bar.', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'       => 'topbar_currency_shortcode',
					'type'     => 'text',
					'title'    => esc_html__( 'Currency Switcher shortcode', 'teta-lite' ),
					'subtitle' => esc_html__(
						"Enter the currency switcher shortcode here. The default shortcode is [woocs show_flags=0 flag_position='left']. It is obvious that you should first install 'WooCommerce Currency Switcher' plugin which is available in theme's recommended plugins.",
						'teta-lite'
					),
					'default'  => '[woocs show_flags=0 flag_position="left"]',


				),
				array(
					'id'       => 'shop-login-link',
					'type'     => 'switch',
					'title'    => esc_html__( 'Login/My-account Button', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show the Login/My Account button or not.', 'teta-lite' ),
					'default'  => true,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Menu Options', 'teta-lite' ),
			'id'     => 'kite_header_menu_options',
			'icon'   => 'icon-menu',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'humburger_menu_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Humburger Menu Options', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '=', '10' ),
					),
				),
				array(
					'id'      => 'animated_text',
					'type'    => 'text',
					'title'   => esc_html__( 'Animated text', 'teta-lite' ),
					'default' => '',

				),
				array(
					'id'       => 'animated_text_Bgimage',
					'type'     => 'media',
					'operator' => 'and',
					'title'    => esc_html__( 'Animated text Background Image', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background image for Animated text in humburger Menu.', 'teta-lite' ),
				),
				array(
					'id'       => 'animated_text_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Animated text color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a color for Animated text in humburger Menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#25252d',
						'alpha' => '1',
					),
					'mode'     => 'background',
				),
				array(
					'id'       => 'menu_icon_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Menu Icon Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a color for Menu Icon.', 'teta-lite' ),
					'default'  => array(
						'color' => '#25252d',
						'alpha' => '1',
					),
					'mode'     => 'background',
				),
				array(
					'id'       => 'menu_icon_bgcolor',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Menu Icon Background Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a background color for Menu Icon', 'teta-lite' ),
					'default'  => array(
						'color' => '#fafafa',
						'alpha' => '1',
					),
					'mode'     => 'background',
				),
				array(
					'id'     => 'humburger_menu_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'cat-menu_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Ladder Menu', 'teta-lite' ),
					'indent'   => true,
					'required' => array( 'header-type', '=', 0 ),

				),
				array(
					'id'    	=> 'cat-menu-title',
					'type'  	=> 'text',
					'title' 	=> esc_html__( 'Ladder Menu Title', 'teta-lite' ),
					'default'	=> esc_html__( 'All Categories', 'teta-lite' ),
				),
				array(
					'id'       => 'cat-menu-state-open',
					'type'     => 'switch',
					'title'    => esc_html__( 'Ladder Menu State', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select State Of Ladder Menu', 'teta-lite' ),
					'on'       => esc_html__( 'Open', 'teta-lite' ),
					'off'      => esc_html__( 'Close', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'      => 'cat-menu-state-light',
					'type'    => 'switch',
					'title'   => esc_html__( 'Ladder Menu Chroma', 'teta-lite' ),
					'on'      => esc_html__( 'Light', 'teta-lite' ),
					'off'     => esc_html__( 'Dark', 'teta-lite' ),
					'default' => false,
				),
				array(
					'id'     => 'cat-menu_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'hover-menu_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Menu Titles Hover Style', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '!=', 7 ),
						array( 'header-type', '!=', 8 ),
						array( 'header-type', '!=', '10' ),
					),
				),
				array(
					'id'       => 'menu-hover-style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Menu Hover Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose menu hover style.', 'teta-lite' ),
					'class'    => 'menu-hover-style',
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(


						3 => array(
							'alt' => 'hover_style1',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/hover_style1.png',
						),
						2 => array(
							'alt' => 'hover_style2',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/hover_style2.png',
						),
						1 => array(
							'alt' => 'hover_style4',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/hover_style4.png',
						),
						0 => array(
							'alt' => 'hover_style3',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/hover_style3.png',
						),
					),
					'default'  => 3,

				),
				array(
					'id'     => 'hover-menu_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'initial-menu-color_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Initial Menu Colors', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '!=', 8 ),
						array( 'header-type', '!=', 7 ),
					),
				),
				array(
					'id'       => 'initial-menu-background-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Background Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#ffffff',
						'alpha' => '1',
					),
					'required' => array(
						array( 'header-type', '!=', '10' ),
					),
					'mode'     => 'background',

				),
				array(
					'id'       => 'initial-menu-text-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Text Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => '1',
					),

					'mode'     => 'background',

				),
				array(
					'id'       => 'initial-menu-text-color-hover',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Text hover Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => '1',
					),
					'required' => array(
						array( 'header-type', '=', '10' ),
					),
					'mode'     => 'background',
				),
				array(
					'id'       => 'initial-menu-text-hover-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Text Hover Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => '1',
					),
					'class'    => 'menu-hover-color',
					'mode'     => 'background',
					'required' => array(
						array( 'menu-hover-style', '!=', 3 ),
						array( 'header-type', '!=', '10' ),

					),
				),
				array(
					'id'       => 'initial-menu-text-bg-hover-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'on-hover Background Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#307adb',
						'alpha' => '1',
					),
					'mode'     => 'background',
					'required' => array(
						array( 'header-type', '!=', '10' ),
						array( 'menu-hover-style', '!=', 3 ),
						array( 'menu-hover-style', '!=', 2 ),

					),
				),
				array(
					'id'       => 'initial-menu-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Border Color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the color and set the opacity for initial menu.', 'teta-lite' ),
					'default'  => array(
						'color' => '#eeeeee00',
						'alpha' => '0',
					),
					'required' => array(
						array( 'header-type', '!=', '10' ),
					),
					'mode'     => 'background',
				),
				array(
					'id'     => 'initial-menu-color_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'menu-color_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Second State Header Menu Colors', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '!=', 7 ),
						array( 'header-type', '!=', '10' ),
					),
				),
				array(
					'id'      => 'menu-background-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Menu Background Color', 'teta-lite' ),
					'default' => array(
						'color' => '#ffffff',
						'alpha' => '1',
					),
					'mode'    => 'background',
				),
				array(
					'id'      => 'menu-text-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Menu Text Color', 'teta-lite' ),
					'default' => array(
						'color' => '#000000',
						'alpha' => '1',
					),
					'mode'    => 'background',
				),
				array(
					'id'      => 'menu-text-hover-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Menu Text Hover Color', 'teta-lite' ),
					'default' => array(
						'color' => '#000000',
						'alpha' => '1',
					),
					'class'   => 'menu-hover-color',
					'mode'    => 'background',
				),
				array(
					'id'       => 'menu-text-bg-hover-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Menu on-hover Background Color', 'teta-lite' ),
					'default'  => array(
						'color' => '#e8e8e8',
						'alpha' => '1',
					),
					'required' => array(
						array( 'header-type', '!=', '10' ),
					),
					'class'    => 'menu-bg-hover-color',
					'mode'     => 'background',
				),
				array(
					'id'      => 'menu-border-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Menu Border Color', 'teta-lite' ),
					'default' => array(
						'color' => '#eee',
						'alpha' => '0',
					),
					'class'   => 'border-color',
					'mode'    => 'background',
				),
				array(
					'id'            => 'menu-opacity',
					'type'          => 'slider',
					'title'         => esc_html__( 'Menu Background image Opacity', 'teta-lite' ),
					'default'       => 30,
					'min'           => 0,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'label',
					'required'      => array(
						array( 'header-type', '=', 7 ),
						array( 'header-type', '=', 8 ),
					),
				),
				array(
					'id'       => 'submenu-hover_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Submenu Items Hover Style', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '!=', 7 ),
						array( 'header-type', '!=', 8 ),
						array( 'header-type', '!=', '10' ),
					),
				),
				array(
					'id'       => 'submenu-hover-style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Submenu Hover Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the submenu items hover style.', 'teta-lite' ),
					'class'    => 'submenu-hover-style',
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						1 => array(
							'alt' => 'submenu_hover_style1',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/submenu_hover_style1.jpg',
						),
						0 => array(
							'alt' => 'submenu_hover_style2',
							'img' => KITE_THEME_LIB_URI . '/admin/img/menu/submenu_hover_style2.jpg',
						),
					),
					'default'  => 0,
				),
				array(
					'id'     => 'submenu-hover_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'submenu-color_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Submenu Colors', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '!=', 7 ),
						array( 'header-type', '!=', 8 ),
						array( 'header-type', '!=', '10' ),
					),
				),
				array(
					'id'      => 'submenu-background-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Submenu Background Color', 'teta-lite' ),
					'default' => array(
						'color' => '#fff',
						'alpha' => '1',
					),
					'mode'    => 'background',

				),
				array(
					'id'      => 'submenu-text-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Submenu Text Color', 'teta-lite' ),
					'default' => array(
						'color' => '#222',
						'alpha' => '1',
					),
					'mode'    => 'background',
				),
				array(
					'id'      => 'submenu-heading-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Submenu Heading Color', 'teta-lite' ),
					'default' => array(
						'color' => '#111',
						'alpha' => '1',
					),
					'mode'    => 'background',
				),
				array(
					'id'     => 'submenu-color_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'vertical_menu-text_start',
					'type'     => 'section',
					'title'    => esc_html__( 'vertical Menu Text and Background', 'teta-lite' ),
					'indent'   => true,
					'required' => array(
						array( 'header-type', '=', 7 ),
						array( 'header-type', '=', 8 ),
					),
				),
				array(
					'id'       => 'vertical_menu_background',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Select image that Shown In Menu Background', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Upload Menu Background', 'teta-lite' ),
				),
				array(
					'id'      => 'vertical_menu_copyright',
					'type'    => 'text',
					'title'   => esc_html__( 'Copyright Text', 'teta-lite' ),
					'default' => '&copy; 2021 KiteStudio | Built With The '. KITE_THEME_NAME .' Theme',
				),
				array(
					'id'     => 'vertical_menu-text_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'menu_font_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Menu Font', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'font-navigation-type',
					'type'    => 'select',
					'title'   => esc_html__( 'Menu Font', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options' => array(
						'default' => 'Theme default font',
						'google'  => 'Google fonts',
						'custom'  => 'Custom font',
					),
					'default' => 'default',
				),
				array(
					'id'          => 'font-navigation',
					'type'        => 'typography',
					'title'       => esc_html__( 'Google Font', 'teta-lite' ),
					'google'      => true,
					'font-backup' => true,
					'output'      => array( 'h2.site-description' ),
					'units'       => 'px',
					'required'    => array( 'font-navigation-type', '=', 'google' ),
				),
				array(
					'id'          => 'custom-font-url-navigation',
					'type'        => 'text',
					'title'       => esc_html__( 'Font URL', 'teta-lite' ),
					'placeholder' => 'i.e. http://fonts.googleapis.com/css?family=Dosis',
					'required'    => array( 'font-navigation-type', '=', 'custom' ),
				),
				array(
					'id'          => 'custom-font-name-navigation',
					'type'        => 'text',
					'title'       => esc_html__( 'Font Name', 'teta-lite' ),
					'placeholder' => 'Dosis, sans-serif',
					'required'    => array( 'font-navigation-type', '=', 'custom' ),
				),
				array(
					'id'     => 'menu_font_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Trident Search Options', 'teta-lite' ),
			'id'     => 'kite_header_search_options',
			'icon'   => 'icon-search',
			'subsection' => true,
			'fields' => array(
				array(
					'id'     => 'search_section_start',
					'title'	 => esc_html( 'Search Options', 'teta-lite' ),
					'type'   => 'section',
					'indent' => true,
				),
				array(
					'id'       => 'searchbox-style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Search Box Chroma', 'teta-lite' ),
					'on'       => esc_html__( 'dark', 'teta-lite' ),
					'off'      => esc_html__( 'light', 'teta-lite' ),
					'default'  => false,
					'required' => array(
						array( 'header-type', '=', 0 ),
					),
				),
				array(
					'id'       => 'menu-search',
					'type'     => 'switch',
					'title'    => esc_html__( 'Search Button', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable search in the header.', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => true,
				),
				array(
					'id'       => 'search_post_type',
					'type'     => 'select',
					'title'    => esc_html__( 'Search', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select the post type that you want the search engine work through it.', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options'  => array(
						'product' => esc_html__( 'Product', 'teta-lite' ),
						'post'    => esc_html__( 'Post', 'teta-lite' ),
					),
					'default'  => 'product',
				),
				array(
					'id'       => 'lite_option_m2j482huzsk',
					'type'     => 'switch',
					'title'    => esc_html__( 'Hide uncategorized option in categories list', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'search_form_hide_subcategories',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show only parent categories in categories list', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => false,
				),
				array(
					'id'       => 'lite_option_gvt63hheewe',
					'type'     => 'switch',
					'title'    => esc_html__( 'Select search results column number', 'teta-lite' ),
					'on'       => esc_html__( '3 Columns', 'teta-lite' ),
					'off'      => esc_html__( '2 Columns', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_hxbqeux8fsw',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show history before search result', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_pfims0rol59',
					'type'     => 'switch',
					'title'    => esc_html__( 'Search in Keywords - show tags section in search result', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_xgmm2hl992h',
					'type'     => 'switch',
					'title'    => esc_html__( 'Search in categories - show categories section in search result', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_pbz9uo55kfa',
					'type'     => 'switch',
					'title'    => esc_html__( 'Products/Posts list', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show all products/posts', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_bi9hchgvfzs',
					'type'     => 'switch',
					'title'    => esc_html__( 'Vendors list', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show all dokan vendors that sells the product', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'search_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			)
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Fonts', 'teta-lite' ),
			'id'     => 'kite_fonts',
			'icon'   => 'icon-text-size',
			'fields' => array(
				array(
					'id'     => 'primary_font_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Primary Font', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'primary-font-type',
					'type'    => 'select',
					// Must provide key => value pairs for select options
					'options' => array(
						'default' => 'Theme default font',
						'google'  => 'Google fonts',
						'custom'  => 'Custom font',
					),
					'default' => 'default',
				),
				array(
					'id'          => 'primary-font',
					'type'        => 'typography',
					'title'       => esc_html__( 'Google Font', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'google'      	=> true,
					'font-backup' 	=> false,
					'font-style' 	=> false,
					'font-weight' 	=> true,
					'font-size' 	=> false,
					'subsets' 		=> false,
					'line-height' 	=> true,
					'word-spacing' 	=> false,
					'letter-spacing' => true,
					'text-align' 	=> false,
					'text-transform' => false,
					'color' 		=> false,
					'output'      	=> array( 'h2.site-description' ),
					'units'       	=> 'px',
					'required'    	=> array( 'primary-font-type', '=', 'google' ),
				),
				array(
					'id'          => 'primary-font-custom-url',
					'type'        => 'text',
					'title'       => esc_html__( 'Font URL', 'teta-lite' ),
					'placeholder' => 'i.e. http://fonts.googleapis.com/css?family=Dosis',
					'required'    => array( 'primary-font-type', '=', 'custom' ),
				),
				array(
					'id'          => 'primary-font-custom',
					'type'        => 'text',
					'title'       => esc_html__( 'Font Name', 'teta-lite' ),
					'placeholder' => 'Dosis, sans-serif',
					'required'    => array( 'primary-font-type', '=', 'custom' ),
				),
				array(
					'id'     => 'primary_font_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'secondary_font_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Secondary Font', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'secondary-font-type',
					'type'    => 'select',
					// Must provide key => value pairs for select options
					'options' => array(
						'default' => 'Theme default font',
						'google'  => 'Google fonts',
						'custom'  => 'Custom font',
					),
					'default' => 'default',
				),
				array(
					'id'          => 'secondary-font',
					'type'        => 'typography',
					'title'       => esc_html__( 'Google Font', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'google'      	=> true,
					'font-backup' 	=> false,
					'font-style' 	=> false,
					'font-weight' 	=> true,
					'font-size' 	=> false,
					'subsets' 		=> false,
					'line-height' 	=> true,
					'word-spacing' 	=> false,
					'letter-spacing' => true,
					'text-align' 	=> false,
					'text-transform' => false,
					'color' 		=> false,
					'output'      => array( 'h2.site-description' ),
					'units'       => 'px',
					'required'    => array( 'secondary-font-type', '=', 'google' ),
				),
				array(
					'id'          => 'secondary-font-custom-url',
					'type'        => 'text',
					'title'       => esc_html__( 'Font URL', 'teta-lite' ),
					'placeholder' => 'i.e. http://fonts.googleapis.com/css?family=Dosis',
					'required'    => array( 'secondary-font-type', '=', 'custom' ),
				),
				array(
					'id'          => 'secondary-font-custom',
					'type'        => 'text',
					'title'       => esc_html__( 'Font Name', 'teta-lite' ),
					'placeholder' => 'Dosis, sans-serif',
					'required'    => array( 'secondary-font-type', '=', 'custom' ),
				),
				array(
					'id'     => 'secondary_font_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'condenced_font_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Condenced Font', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'condenced-font-type',
					'type'    => 'select',
					// Must provide key => value pairs for select options
					'options' => array(
						'default' => 'Theme default font',
						'google'  => 'Google fonts',
						'custom'  => 'Custom font',
					),
					'default' => 'default',
				),
				array(
					'id'          => 'condenced-font',
					'type'        => 'typography',
					'title'       => esc_html__( 'Google Font', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'google'      	=> true,
					'font-backup' 	=> false,
					'font-style' 	=> false,
					'font-weight' 	=> true,
					'font-size' 	=> false,
					'subsets' 		=> false,
					'line-height' 	=> true,
					'word-spacing' 	=> false,
					'letter-spacing' => true,
					'text-align' 	=> false,
					'text-transform' => false,
					'color' 		=> false,
					'output'      => array( 'h2.site-description' ),
					'units'       => 'px',
					'required'    => array( 'condenced-font-type', '=', 'google' ),
				),
				array(
					'id'          => 'condenced-font-custom-url',
					'type'        => 'text',
					'title'       => esc_html__( 'Font URL', 'teta-lite' ),
					'placeholder' => 'i.e. http://fonts.googleapis.com/css?family=Dosis',
					'required'    => array( 'condenced-font-type', '=', 'custom' ),
				),
				array(
					'id'          => 'condenced-font-custom',
					'type'        => 'text',
					'title'       => esc_html__( 'Font Name', 'teta-lite' ),
					'placeholder' => 'Dosis, sans-serif',
					'required'    => array( 'condenced-font-type', '=', 'custom' ),
				),
				array(
					'id'     => 'condenced_font_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'google_font_display',
					'type'    => 'select',
					'title'   => esc_html__( 'Google font display type', 'teta-lite' ),
					'options' => array(
						'disable' 	=> esc_html__( 'Disable', 'teta-lite' ),
						'block'  	=> esc_html__( 'Block', 'teta-lite' ),
						'swap'  	=> esc_html__( 'Swap', 'teta-lite' ),
						'fallback'  => esc_html__( 'Fallback', 'teta-lite' ),
						'optional'  => esc_html__( 'optional', 'teta-lite' ),
					),
					'default' => 'disable',
				),

			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Sidebar', 'teta-lite' ),
			'id'     => 'kite_sidebar',
			'icon'   => 'icon-exit-right',
			'fields' => array(
				array(
					'id'          => 'custom_sidebars',
					'type'        => 'multi_text',
					'title'       => esc_html__( 'Custom Sidebar', 'teta-lite' ),
					'subtitle'    => esc_html__( ' Select a sidebar for your pages. You can customise each sidebar widget from widget panel.', 'teta-lite' ),
					'placeholder' => esc_html__( 'Enter a sidebar name', 'teta-lite' ),
				),
				array(
					'id'       => 'sidebar-position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Page Sidebar Position', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the default sidebar position for those pages that have a sidebar.', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						1 => array(
							'alt' => 'left-side',
							'img' => KITE_THEME_LIB_URI . '/admin/img/left-sidebar.png',
						),
						2 => array(
							'alt' => 'right-side',
							'img' => KITE_THEME_LIB_URI . '/admin/img/right-sidebar.png',
						),
					),
					'default'  => 2,
				),
				array(
					'id'       => 'blog-sidebar-position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Blog and Blog Detail Sidebar', 'teta-lite' ),
					'subtitle' => esc_html__( 'Here you can disable or enable the sidebar for your blog and blog detail.', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'no-sidebar'   => array(
							'alt' => 'no-sidebar',
							'img' => KITE_THEME_LIB_URI . '/admin/img/no-sidebar.png',
						),
						'main-sidebar' => array(
							'alt' => 'main-sidebar',
							'img' => KITE_THEME_LIB_URI . '/admin/img/with-sidebar.png',
						),
						'left-sidebar' => array(
							'alt' => 'left-sidebar',
							'img' => KITE_THEME_LIB_URI . '/admin/img/left-sidebar.png',
						),
					),
					'default'  => 'main-sidebar',
				),
				array(
					'id'       => 'search-widget-category',
					'type'     => 'switch',
					'title'    => esc_html__( 'Index Category In Search Widget', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable this option if you want to search categories by using search widget.', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'default'  => false,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Shop Page', 'teta-lite' ),
			'id'     => 'kite_woocommerce',
			'icon'   => 'icon-store',
			'fields' => array(
				array(
					'id'       => 'shop-column',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Shop page Columns Number', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the number of products showing in every row in shop page.', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						5 => array(
							'alt' => 'five',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/five.png',
						),
						4 => array(
							'alt' => 'four',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/four.png',
						),
						3 => array(
							'alt' => 'three',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/three.png',
						),
						2 => array(
							'alt' => 'two',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/two.png',
						),
					),

					'default'  => 4,
				),
				array (
					'id'       => 'lite_option_upgyqy0tf5',
					'type'     => 'select',
					'title'    => esc_html__('Shop columns in tablet', 'teta-lite'),
					'subtitle' => esc_html__('show products in a row in tablet.','teta-lite'),
					'options'  => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
					),
					'class' => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_4joi6vjcept',
					'type'     => 'select',
					'title'    => esc_html__( 'Shop columns in mobile', 'teta-lite' ),
					'subtitle' => esc_html__( 'show products in a row in responsive mode.', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options'  => array(
						'1' => '1',
						'2' => '2',
					),
					'class' => 'kt-pro-feature'
				),
				array(
					'id'     => 'shop_item_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Products Per Page', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'shop-item-per-page',
					'type'     => 'select',
					'title'    => esc_html__( 'Items Per Page', 'teta-lite' ),
					'subtitle' => esc_html__( 'The number of products that will be shown in a single page of your shop.', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options'  => array(
						'1'  => '1',
						'2'  => '2',
						'3'  => '3',
						'4'  => '4',
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
					),
					'default'  => '12',
				),
				array(
					'id'     => 'lite_option_gutwj60j35',
					'type'   => 'section',
					'title'  => esc_html__( 'Products Pagination', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_isxg1tno8t',
					'type'     => 'select',
					'title'    => esc_html__( 'Products Pagination Type', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose one of these shop pagination methods.', 'teta-lite' ),
					'options'  => array(
						'pagination'      => 'Pagination',
						'load_more'       => 'Load More Button',
						'infinite_scroll' => 'Infinite Scroll',
					),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_wdnvaqvitfq',
					'type'     => 'switch',
					'title'    => esc_html__( 'Shop AJAX Pagination', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/Disable the shop page AJAX pagination.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable AJAX Pagination', 'teta-lite' ),
					'off'      => esc_html__( 'Disable AJAX Pagination', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_grjgmmqlugi',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'shop_layout_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Product View Options', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'shop-product-view',
					'type'     => 'select',
					'title'    => esc_html__( 'Products layout', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the layout of shop page products.', 'teta-lite' ),
					'options'  => array(
						'grid'    => esc_html__( 'Tiles', 'teta-lite' ),
						'list'    => esc_html__( 'List', 'teta-lite' ),
						'grid_sv' => esc_html__( 'Tiles with List view option', 'teta-lite' ),
						'list_sv' => esc_html__( 'List with Grid view option', 'teta-lite' ),
					),
					'default'  => 'grid',
				),
				array(
					'id'      => 'lite_option_cszb6qbxpb9',
					'type'    => 'switch',
					'title'   => esc_html__( 'List View In Responsive', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Yes', 'teta-lite' ),
					'off'     => esc_html__( 'No', 'teta-lite' ),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'       => 'shop-layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Grid View', 'teta-lite' ),
					'subtitle' => esc_html__( 'Products grid view style in shop page.', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'fitRows' => array(
							'alt' => 'fitRows',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/fitRows.png',
						),
						'masonry' => array(
							'alt' => 'masonry',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/masonry.png',
						),
					),
					'default'  => 'fitRows',
				),
				array(
					'id'     => 'shop_layout_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'shop_style_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Product Card Style', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'shop-product-style',
					'type'    => 'image_select',
					'options' => array(
						'buttonsonhover'     => array(
							'alt' => 'buttonsonhover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/classic.png',
						),
						'centered'           => array(
							'alt' => 'centered',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/centered.png',
						),
						'infoonhover'        => array(
							'alt' => 'infoonhover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/info-on-hover.png',
						),
					),
					'default' => 'buttonsonhover',
					'class'   => 'shop-styles',
				),
				array(
					'id'       => 'product-hover-color',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Product Hover Color', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'c0392b'       => array(
							'alt' => 'c0392b',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/c0392b.png',
						),
						'e74c3c'       => array(
							'alt' => 'e74c3c',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/e74c3c.png',
						),
						'd35400'       => array(
							'alt' => 'd35400',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/d35400.png',
						),
						'e67e22'       => array(
							'alt' => 'e67e22',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/e67e22.png',
						),
						'f39c12'       => array(
							'alt' => 'f39c12',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/f39c12.png',
						),
						'f1c40f'       => array(
							'alt' => 'f1c40f',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/f1c40f.png',
						),
						'1abc9c'       => array(
							'alt' => '1abc9c',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/1abc9c.png',
						),
						'2ecc71'       => array(
							'alt' => '2ecc71',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/2ecc71.png',
						),
						'3498db'       => array(
							'alt' => '3498db',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/3498db.png',
						),
						'01558f'       => array(
							'alt' => '01558f',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/01558f.png',
						),
						'9b59b6'       => array(
							'alt' => '9b59b6',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/9b59b6.png',
						),
						'ecf0f1'       => array(
							'alt' => 'ecf0f1',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/ecf0f1.png',
						),
						'bdc3c7'       => array(
							'alt' => 'bdc3c7',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/bdc3c7.png',
						),
						'7f8c8d'       => array(
							'alt' => '7f8c8d',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/7f8c8d.png',
						),
						'95a5a6'       => array(
							'alt' => '95a5a6',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/95a5a6.png',
						),
						'34495e'       => array(
							'alt' => '34495e',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/34495e.png',
						),
						'2e2e2e'       => array(
							'alt' => '2e2e2e',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/2e2e2e.png',
						),
						'custom-color' => array(
							'alt' => 'custom',
							'img' => KITE_THEME_LIB_URI . '/admin/img/vcimages/custom-color.png',
						),
					),
					'default'  => 'c0392b',
					'class'    => 'product_hover_preset',
					'required' => array(
						array( 'shop-product-style', '!=', 'buttonsappearunder' ),
						array( 'shop-product-style', '!=', 'buttonsonhover' ),
						array( 'shop-product-style', '!=', 'centered' ),
						array( 'shop-product-style', '!=', 'instantshop' ),
						array( 'shop-product-style', '!=', 'modern-buttons-on-hover' ),
					),
				),
				array(
					'id'       => 'product-hover-custom-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Custom Hover Color', 'teta-lite' ),
					'default'  => array(
						'color' => '#fff',
						'alpha' => '1',
					),
					'mode'     => 'background',
					'required' => array(
						array( 'shop-product-style', '!=', 'buttonsappearunder' ),
						array( 'shop-product-style', '!=', 'buttonsonhover' ),
						array( 'shop-product-style', '!=', 'centered' ),
						array( 'shop-product-style', '!=', 'instantshop' ),
						array( 'shop-product-style', '!=', 'modern-buttons-on-hover' ),
						array( 'product-hover-color', '=', 'custom-color' ),
					),
				),
				array(
					'id'      => 'lite_option_vse2jsf55h',
					'type'    => 'switch',
					'title'   => esc_html__( 'Products Color Scheme', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Light', 'teta-lite' ),
					'off'     => esc_html__( 'Dark', 'teta-lite' ),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_a7rz6g3bx9h',
					'title'   => esc_html__( 'Product Buttons Style', 'teta-lite' ),
					'type'    => 'image_select',
					'options' => array(
						'horizontal'     => array(
							'alt' => 'modern-buttons-on-hover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/horizontal.png',
						),
						'vertical'     => array(
							'alt' => 'buttonsonhover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/vertical.png',
						),
					),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_uzhdmiz8dq',
					'title'   => esc_html__( 'Cart Button Style', 'teta-lite' ),
					'type'    => 'image_select',
					'options' => array(
						'default'     => array(
							'alt' => 'modern-buttons-on-hover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/vertical.png',
						),
						'stretched'     => array(
							'alt' => 'buttonsonhover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/stretched.png',
						),
						'quantity'     => array(
							'alt' => 'buttonsonhover',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/quantity.png',
						),
					),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'       => 'shop-product-gutter',
					'type'     => 'switch',
					'title'    => esc_html__( 'Gutter', 'teta-lite' ),
					'subtitle' => esc_html( 'The gutter between products in the main shop page.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'With Gutter', 'teta-lite' ),
					'off'      => esc_html__( 'No Gutter', 'teta-lite' ),
				),
				array(
					'id'       => 'shop-product-border',
					'type'     => 'switch',
					'title'    => esc_html__( 'Border', 'teta-lite' ),
					'subtitle' => esc_html__( 'The border of each product in the main shop page.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'With Border', 'teta-lite' ),
					'off'      => esc_html__( 'No Border', 'teta-lite' ),
				),
				array(
					'id'      => 'shop-product-rating',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Rating', 'teta-lite' ),
					'default' => false,
					'class'   => 'product_rating',
					'on'      => esc_html__( 'Show Rating', 'teta-lite' ),
					'off'     => esc_html__( 'Hide Rating', 'teta-lite' ),
				),
				array(
					'id'      => 'shop-loop-product-categories',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Categories', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show/Hide product categories on product cards', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Show Categories', 'teta-lite' ),
					'off'     => esc_html__( 'Hide Categories', 'teta-lite' ),
				),
				array(
					'id'       => 'percentage_sale',
					'type'     => 'switch',
					'title'    => esc_html__( 'On-Sale Products Percentage Badge', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/ Disable Percentage sale badge on products', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'shop-entrance-animation',
					'type'    => 'select',
					'title'   => esc_html__( 'Entrance animation', 'teta-lite' ),
					// Must provide key => value pairs for select options
					'options' => array(
						'fadein'           => esc_html__( 'FadeIn', 'teta-lite' ),
						'fadeinfrombottom' => esc_html__( 'FadeIn From Bottom', 'teta-lite' ),
						'fadeinfromtop'    => esc_html__( 'FadeIn From Top', 'teta-lite' ),
						'fadeinfromright'  => esc_html__( 'FadeIn From Right', 'teta-lite' ),
						'fadeinfromleft'   => esc_html__( 'FadeIn From Left', 'teta-lite' ),
						'zoomin'           => esc_html__( 'Zoom-in', 'teta-lite' ),
						'default'          => esc_html__( 'No animation', 'teta-lite' ),
					),
					'default' => 'fadein',
				),
				array(
					'id'     => 'shop_style_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_jnabook7jg',
					'title'	 =>	esc_html( 'Product Variations', 'teta-lite' ),
					'type'   => 'section',
					'indent' => true,
				),
				array(
					'id'      => 'lite_option_jdzsngfuiy',
					'type'    => 'switch',
					'title'   => esc_html__( 'Show Variations On Product Cards', 'teta-lite' ),
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_dtbd0kafh6r',
					'type'    => 'switch',
					'title'   => esc_html__( 'Show Variations On Product Cards - Tablet', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_uasaa2oa3jk',
					'type'    => 'switch',
					'title'   => esc_html__( 'Show Variations On Product Cards - Mobile', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
					'class'   => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_8jnft5i1gkc',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'shop-enable-fullwidth',
					'type'    => 'switch',
					'title'   => esc_html__( 'Full Width Shop Page', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'shop-sidebar-position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Filter Sidebar Position', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the default filter sidebar position shop page.', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						0 => array(
							'alt' => 'none',
							'img' => KITE_THEME_LIB_URI . '/admin/img/no-sidebar.png',
						),
						1 => array(
							'alt' => 'left-side',
							'img' => KITE_THEME_LIB_URI . '/admin/img/left-sidebar.png',
						),
						2 => array(
							'alt' => 'right-side',
							'img' => KITE_THEME_LIB_URI . '/admin/img/right-sidebar.png',
						),
					),
					'default'  => 0,
					'class'    => 'page-sidebar',
				),
				array(
					'id'     => 'lite_option_lcbmdjz6l7',
					'type'   => 'section',
					'title'  => esc_html__( 'Recently Viewed Products', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_eyc595b27zu',
					'type'     => 'switch',
					'title'    => esc_html__( 'Recently viewed products', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable recently viewd products on product page', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_nhef0mfgwzr',
					'type'     => 'switch',
					'title'    => esc_html__( 'Recently viewed products Display', 'teta-lite' ),
					'on'       => esc_html__( 'Full width', 'teta-lite' ),
					'off'      => esc_html__( 'Container', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_8snjunp40by',
					'type'     => 'switch',
					'title'    => esc_html__( 'Recently viewed products Display in Mobile', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_w8qvldybb8',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_ros08qw6dkr',
					'title'  => esc_html__( 'Catalog Mode', 'teta-lite' ),
					'type'   => 'section',
					'indent' => true,
				),
				array(
					'id'      => 'lite_option_ecwwn6n162q',
					'type'    => 'switch',
					'title'   => esc_html__( 'Catalog Mode Display', 'teta-lite' ),
					'subtitle'=> esc_html__( 'Note that if you enable this option, the add to cart button and cart  will be deactivated', 'teta-lite' ),
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_mpr2j80kffc',
					'type'     => 'switch',
					'title'    => esc_html__( 'Price in Catalog Mode', 'teta-lite' ),
					'on'       => esc_html__( 'Show Price', 'teta-lite' ),
					'off'      => esc_html__( 'Hide Price', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_rgrviu3lr5',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'shop-enable-quickview',
					'type'    => 'switch',
					'title'   => esc_html__( 'Quick View', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'product-hover-image',
					'type'     => 'switch',
					'title'    => esc_html__( 'Products Hover Image', 'teta-lite' ),
					'subtitle' => esc_html__( 'If you enable this, The first image of gallery will be shown as hover of each product', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'     => 'shop_category_page_section_start',
					'type'   => 'section',
					'title'	 => esc_html__( 'Category Page', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'category-description-position',
					'type'     => 'switch',
					'title'    => esc_html__( 'Category Description Position', 'teta-lite' ),
					'subtitle' => esc_html__( 'You can manage the position of categories description with this option', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'On The Header', 'teta-lite' ),
					'off'      => esc_html__( 'After The Header', 'teta-lite' ),
				),
				array(
					'id'       => 'responsive-category-header',
					'type'     => 'switch',
					'title'    => esc_html__( 'Responsive Category Header', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/Disable category header title and description in responsive devices', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'     => 'shop_category_page_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_0p5hn9639gl',
					'type'   => 'section',
					'title'	 => esc_html__( 'Widgets Settings', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_ce8o09koslr',
					'type'     => 'switch',
					'title'    => esc_html__( 'Rating in woocommerce products widget', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/Disable Rating in woocommerce products widget', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_kr2xsivtk8',
					'type'     => 'switch',
					'title'    => esc_html__('Show More button in woocommerce categories widget', 'teta-lite'),
					'subtitle'     => esc_html__('Enable/Disable Show More button in woocommerce categories widget', 'teta-lite'),
					'on'       => esc_html__('Enable', 'teta-lite'),
					'off'      => esc_html__('Disable', 'teta-lite'),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_fakrzh8f3pg',
					'type'     => 'switch',
					'title'    => esc_html__('Categories widget scroll animation', 'teta-lite'),
					'subtitle'    => esc_html__('Enable/Disable categories widget scroll animation in shop page', 'teta-lite'),
					'on'       => esc_html__('Enable', 'teta-lite'),
					'off'      => esc_html__('Disable', 'teta-lite'),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_i5cx53f2yg8',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id' 		=> 'lite_option_cyx18uj5g0p',
					'type' 		=> 'section',
					'title' 	=> esc_html__( 'Shop Extra Templates', 'teta-lite' ),
					'indent' 	=> true,
				),
				array (
					'id'       => 'lite_option_8ste9zsey7o',
					'type'     => 'switch',
					'title'    => esc_html__('Shop Page Top Template', 'teta-lite'),
					'subtitle' => esc_html__( 'You can add Elemntor templates at the top of the shop page', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_sm7k0pjyaeo',
					'type'    => 'select',
					'title'   => esc_html__( 'Select Template', 'teta-lite' ),
					'options' => kite_get_elementor_templates_list( 'section' ),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_p9yjyvyhxw',
					'type'     => 'switch',
					'title'    => esc_html__('Shop Page Bottom Template', 'teta-lite'),
					'subtitle' => esc_html__( 'You can add Elemntor templates at the bottom of the shop page', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'      => 'lite_option_sfd20nd6w6e',
					'type'    => 'select',
					'title'   => esc_html__( 'Select Template', 'teta-lite' ),
					'options' => kite_get_elementor_templates_list( 'section' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id' => 'lite_option_ynt6o7vgnu',
					'type' => 'section',
					'indent' => false,
				),
				array(
					'id' => 'lite_option_tp6fu3p41v',
					'type' => 'section',
					'title' =>esc_html__( 'Shop Extra Options', 'teta-lite' ),
					'indent' => true,
				),
				array (
					'id'       => 'lite_option_w6xe6sjgq4',
					'type'     => 'switch',
					'title'    => esc_html__('Bypass product detail in External/Affiliate products', 'teta-lite'),
					'subtitle' => esc_html__('Link external products directly to product url instead of product detail page', 'teta-lite'),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_5cmll02zh7b',
					'type'     => 'switch',
					'title'    => esc_html__('Remove responsive product cards hover state', 'teta-lite'),
					'on'       => esc_html__( 'On', 'teta-lite' ),
					'off'      => esc_html__( 'Off', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_8u4b79ff70q',
					'type'     => 'text',
					'title'    => esc_html__('Trim Product Title In Mini Cart','teta-lite'),
					'subtitle'     => esc_html__( 'If you want to trim product title in mini cart, specify length of title.', 'teta-lite'),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id' => 'lite_option_ypd8f71va5e',
					'type' => 'section',
					'indent' => false,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Shop Filters Toolbar', 'teta-lite' ),
			'id'     => 'kite_shop_page_filters',
			'icon'   => 'icon-filter',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'shop-filter',
					'type'     => 'switch',
					'title'    => esc_html__( 'Shop Filter display', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable Shop Filter Toolbar on top of the products in shop page.', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'shop-filter-style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Shop Filter Toggling Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose Shop filter display on shop page.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Top expandable filters', 'teta-lite' ),
					'off'      => esc_html__( 'Off-canvas filters', 'teta-lite' ),
					'required' => array(
						array( 'shop-filter', '=', true ),
					),
				),
				array(
					'id'       => 'shop-filter-categories',
					'type'     => 'switch',
					'title'    => esc_html__( 'Categories Dropdown Display', 'teta-lite' ),
					'subtitle' => esc_html__( 'Caategories dropdown showing in the shop filter toolbar.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Show Categories', 'teta-lite' ),
					'off'      => esc_html__( 'Hide Categories', 'teta-lite' ),

				),
				array(
					'id'       => 'shop_filter_hidden_empty_category',
					'type'     => 'switch',
					'title'    => esc_html__( 'Empty Category Showing', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Show empty categories', 'teta-lite' ),
					'off'      => esc_html__( 'Hide empty categories', 'teta-lite' ),
					'required' => array( 'shop-filter-categories', '=', true ),
				),
				array(
					'id'      => 'shop-filter-sorting',
					'type'    => 'switch',
					'title'   => esc_html__( 'Sorting Filter', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Show Sorting filter', 'teta-lite' ),
					'off'     => esc_html__( 'Hide Sorting filter', 'teta-lite' ),
				),
				array(
					'id'       => 'product-per-page',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Per Page Filter', 'teta-lite' ),
					'subtitle' => esc_html__( 'Product Per Page Filter is shown when the main Shop pagination method is on pagination.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'shop-filter-active-filters',
					'type'    => 'switch',
					'title'   => esc_html__( 'Active Filters', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Show Active filters', 'teta-lite' ),
					'off'     => esc_html__( 'Hide Active filters', 'teta-lite' ),
				),
				array(
					'id'      => 'shop-filter-search',
					'type'    => 'switch',
					'title'   => esc_html__( 'Search Filter', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Show Search', 'teta-lite' ),
					'off'     => esc_html__( 'Hide Search', 'teta-lite' ),
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Free Shipping Threshold', 'teta-lite' ),
			'id'     => 'lite_option_xz4uqhnhzth',
			'icon'   => 'icon-truck',
			'subsection' => true,
			'fields' => array(
				array (
					'id'       => 'lite_option_mhkywq3mzn',
					'type'     => 'switch',
					'title'    => esc_html__('Show free shipping threshold notice', 'teta-lite'),
					'on'       => esc_html__('Enable', 'teta-lite'),
					'off'      => esc_html__('Disable', 'teta-lite'),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_f7b7f7cqa9',
					'type'     => 'text',
					'title'    => esc_html__('Required amount to show free shipping','teta-lite'),
					'subtitle'     => esc_html__('You should enable free shipping and minimum amount for free shipping in Woocommerce -> settings -> shipping -> shipping zones -> manage shipping method', 'teta-lite'),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_nxiodk7p8fo',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Price Color', 'teta-lite'),
					'subtitle'     => esc_html__('This color only applies in product detail page.', 'teta-lite'),
					'mode'     => 'background',
					'class'    => 'kt-pro-feature'

				),
				array (
					'id'       => 'lite_option_mfte2tdcndk',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Notice Background Color', 'teta-lite'),
					'mode'     => 'background',
					'class'    => 'kt-pro-feature'

				),
				array (
					'id'       => 'lite_option_ii8tm0orcg',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Notice Progress Background Color', 'teta-lite'),
					'mode'     => 'background',
					'class'    => 'kt-pro-feature'

				),
				array (
					'id'       => 'lite_option_63vjfxebw33',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Notice Text Color', 'teta-lite'),
					'mode'     => 'background',
					'class'    => 'kt-pro-feature'
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Product Details', 'teta-lite' ),
			'id'     => 'kite_Product_Detail',
			'icon'   => 'icon-product-hunt',
			'fields' => array(
				array(
					'id'       => 'product-detail-style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Layout', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select product details page layout style', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'pd_classic'         => array(
							'alt' => 'pd_classic',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/pd_classic.png',
						),
						'pd_top'             => array(
							'alt' => 'pd_top',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/pd_top.png',
						),
					),
					'default'  => 'pd_classic',
					'class'    => 'product-detail',
				),
				array(
					'id'       => 'product_detail_gallery_sidebar',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sidebar In product column gallery style', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Hide sidebar', 'teta-lite' ),
					'off'      => esc_html__( 'Show sidebar', 'teta-lite' ),
					'required' => array( 'product-detail-style', '=', 'pd_col_gallery' ),
				),
				array(
					'id'       => 'lite_option_lova230lop',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Product detail sidebar position', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose product detail sidebar position', 'teta-lite' ),
					// Must provide key => value(array:title|img) pairs for radio options
					'options'  => array(
						'left'  => array(
							'alt' => 'left',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/pd_left_sidebar.png',
						),
						'right' => array(
							'alt' => 'right',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/pd_right_sidebar.png',
						),
					),
					'default'  => 'right',
					'class'    => 'product-detail-sidebar kt-pro-feature',
				),
				array(
					'id'       => 'lite_option_fnrg1h2ke3g',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sidebar In Responsive', 'teta-lite' ),
					'on'       => esc_html__( 'Show sidebar in responsive', 'teta-lite' ),
					'off'      => esc_html__( 'Hide sidebar in responsive', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array (
					'id'       => 'lite_option_9yacnqmhvjn',
					'type'     => 'select',
					'title'    => esc_html__('gallery column ', 'teta-lite'),
					'subtitle' => esc_html__('show images gallery.','teta-lite'),
					'options'  => array(
						'2' => '2',
						'3' => '3',
					),
					'default'  => '3',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_xjbpjcyfzbi',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product detail text-color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a color for the text of "Product short description" on the product detail page.', 'teta-lite' ),
					'on'       => esc_html__( 'Dark', 'teta-lite' ),
					'off'      => esc_html__( 'Light', 'teta-lite' ),
					'class'    => 'kt-pro-feature'

				),
				array(
					'id'       => 'product-detail-bg',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Product detail background-color', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a color for background of product detail page and thumbnails', 'teta-lite' ),
					'default'  => array(
						'color' => '#fff',
						'alpha' => '1',
					),
					'mode'     => 'background',
					'required' => array(
						array( 'product-detail-style', '!=', 'pd_classic' ),
						array( 'product-detail-style', '!=', 'pd_kt_classic' ),
						array( 'product-detail-style', '!=', 'pd_classic_sidebar' ),
						array( 'product-detail-style', '!=', 'pd_fixed_summary' ),
						array( 'product-detail-style', '!=', 'pd_col_gallery' ),
						array( 'product-detail-style', '!=', 'pd_sticky' ),
						array( 'product-detail-style', '!=', 'pd_fullwidth_top' ),
					),
				),
				array(
					'id'      => 'product-gallery-direction',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product gallery direction in Product details', 'teta-lite' ),
					'on'      => esc_html__( 'right', 'teta-lite' ),
					'off'     => esc_html__( 'left', 'teta-lite' ),
					'default' => false,
					'required' => array(
						array( 'product-detail-style', '!=', 'pd_top' ),
						array( 'product-detail-style', '!=', 'pd_fullwidth_top' ),
					),

				),
				array(
					'id' => 'variable_options_start',
					'type' => 'section',
					'title'	=> esc_html__( 'Variable Options', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'variations_select_style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Variations Select Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select Variable Selection Style in Product detail', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Swatch Style', 'teta-lite' ),
					'off'      => esc_html__( 'Dropdown Style', 'teta-lite' ),
				),
				array(
					'id'       => 'lite_option_v1930d3zwge',
					'type'     => 'switch',
					'title'    => esc_html__( 'Variable Title in Product details', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/Disable this option to show Variable Title in Product details', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_r4lxxdfc1j',
					'type'     => 'text',
					'title'    => esc_html__( 'WooCommerce ajax variation threshold', 'teta-lite' ),
					'default'  => 30,
					'class'    => 'kt-pro-feature'
				),
				array(
					'id' => 'variable_options_end',
					'type' => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'lite_option_8ihj0y0rdef',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Summary Alignment in Product details', 'teta-lite' ),
					'on'      => esc_html__( 'left', 'teta-lite' ),
					'off'     => esc_html__( 'center', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_hla4dwia68o',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product navigation in Product details', 'teta-lite' ),
					'subtitle' => esc_html__( 'this option is to show next/previous products in Product details.', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_0djau6wcwcjq',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product breadcrumb in Product details', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable/Disable this option to show breadcrunb in Product details', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'product_gallery_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'product gallery', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'shop_enable_zoom',
					'type'     => 'switch',
					'title'   => esc_html__( 'Zooming of Products Gallery', 'teta-lite'),
					'subtitle' => esc_html__( 'Enable or disable zooming of products gallery','teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'shop_enable_zoom_responsive',
					'type'     => 'switch',
					'title'   => esc_html__( 'Responsive Zooming of Products Gallery', 'teta-lite'),
					'subtitle' => esc_html__( 'Enable or disable zooming of products gallery in responsive state','teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'required' => array(
						array( 'shop_enable_zoom', '=', true ),
					),
				),
				array(
					'id'       => 'product_gallery_popup',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Gallery Popup', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable product gallery popup on product detail pages', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'product_gallery_style',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Gallery Button Scheme', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Dark Button', 'teta-lite' ),
					'off'     => esc_html__( 'Light Button', 'teta-lite' ),
				),
				array(
					'id'      => 'product_gallery_autoplay',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Gallery Carousel AutoPlay', 'teta-lite' ),
					'default' => true,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'     => 'product_gallery_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
                    'id'       => 'lite_option_9xn1m83yoog',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'product description', 'teta-lite' ),
                    'subtitle' => esc_html__( 'Select style of product description', 'teta-lite' ),
					'options'  => array(
						'tab'         => array(
							'alt' => 'tab',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/tab.png',
						),
						'vartical_tab'             => array(
							'alt' => 'vartical_tab',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/vartical_tab.png',
						),
						'accordion_tab'             => array(
							'alt' => 'accordion_tab',
							'img' => KITE_THEME_LIB_URI . '/admin/img/shop/accordion_tab.png',
						),

                    ),
                    'default'  => 'tab',
					'class'    => 'product-desc-tab kt-pro-feature',

                ),
				array(
					'id'       => 'lite_option_9y9qp2ntnip',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload Payment Methods Image for Products.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Payment Methods Image', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_fr6kcratms',
					'type'     => 'switch',
					'title'    => esc_html__( 'Buy Now Button', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable button to redirect to the cart page after successful addition', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'single_product_meta',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Meta', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select position of product meta', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'In Summary Section', 'teta-lite' ),
					'off'      => esc_html__( 'After Summary Section', 'teta-lite' ),
				),
				array(
					'id'       => 'lite_option_nzxjr7s837',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product 360 View', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable product 360 view on product detail pages', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'product-detail-instagram-section-start',
					'type'   => 'section',
					'title'	 => esc_html__( 'Instagram', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'instagram_in_product_detail',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show instagram in product detail', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable instagram section in product detail', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'product_detail_use_instagram_api',
					'type'     => 'switch',
					'title'    => esc_html__( 'Instagram Connection Method', 'teta-lite' ),
					'subtitle' => esc_html__( 'Select connection method to instagram. The best and trusted way recommended by instagram is the Api method. For Api method you have to set the app id and app secret in setting\'s social tab.', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Api', 'teta-lite' ),
					'off'      => esc_html__( 'Scrape/Ajax', 'teta-lite' ),
				),
				array(
					'id'     => 'product-detail-instagram-section-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_miylwfq0dm',
					'type'   => 'section',
					'title'	 => esc_html__( 'Add to cart', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_6pq45z36xil',
					'type'     => 'switch',
					'title'    => esc_html__( 'Ajax Add To Cart', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable ajax add to cart in single products', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_sybhu86c5y',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sticky add to Cart', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable Sticky add to cart button. It will be displayed after scrolling to bottom of page to have better accessibility', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_l1hjxnlqbj',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sticky add to Cart in Mobile', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable Sticky add to cart button in mobile. It will be displayed after scrolling to bottom of page to have better accessibility', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_3nha1f0av52',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show/Hide add to cart notices in ajax requests', 'teta-lite' ),
					'subtitle' => esc_html__( 'If you Hide this and ajax-add-to-cart was enabled in woocomerce, add-to-cart notices would be hide', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_7swaca3vu24',
					'type'   => 'section',
					'indent' => false,
				),

			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Product Manual and Guides visibility', 'teta-lite' ),
			'id'     => 'lite_option_3ha15yu6k3i',
			'icon'   => 'icon-cart-full',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'lite_option_bodcyrsgtr',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Manual and Guides', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable product manual and guides to show size guide, delivery and ask question fields.', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_9jmupgm7t7u',
					'type'   => 'section',
					'title'  => esc_html__( 'Size Guide', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_2klejt0b0u6',
					'type'     => 'text',
					'title'    => esc_html__( 'Title', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a title for the sizeguide.', 'teta-lite' ),
					'default'  => 'Size Guide',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_buw4lsoxnz',
					'type'     => 'editor',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_xcshkblbv6',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_4fpvsnuneb2',
					'type'   => 'section',
					'title'    => esc_html__( 'Delivery & Return', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_44kqkckewns',
					'type'     => 'text',
					'title'    => esc_html__( 'Title', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a title for the Delivery & Return.', 'teta-lite' ),
					'default'  => 'Delivery & Return',
					'class'    => 'kt-pro-feature'

				),
				array(
					'id'       => 'lite_option_trr4z5o9hfo',
					'type'     => 'editor',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_ndthsjlnxw',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'lite_option_eek9m349t8',
					'type'   => 'section',
					'title'    => esc_html__( 'Ask a Question', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'lite_option_a8eqtkwv78j',
					'type'     => 'text',
					'title'    => esc_html__( 'Title', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose a title for the faq.', 'teta-lite' ),
					'default'  => 'FAQ',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_87yqmx7sq8v',
					'type'     => 'editor',
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_8j81jdihyj5',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);
	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'upsells/related products', 'teta-lite' ),
			'id'     => 'lite_option_8eyfaciq8l3',
			'icon'   => 'icon-cart-full',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'lite_option_cgadr12wh6',
					'type'     => 'switch',
					'title'    => esc_html__( 'Upsells Position', 'teta-lite' ),
					'on'       => esc_html__( 'After Product Description Tabs', 'teta-lite' ),
					'off'      => esc_html__( 'Before Product Description Tabs', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_4j5b4oefk0o',
					'type'     => 'switch',
					'title'    => esc_html__( 'Upsells Display Mode', 'teta-lite' ),
					'on'       => esc_html__( 'Gird Mode', 'teta-lite' ),
					'off'      => esc_html__( 'Carousel Mode', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_hbh05eemgas',
					'type'     => 'switch',
					'title'    => esc_html__( 'Upsells Width', 'teta-lite' ),
					'on'       => esc_html__( 'Full width', 'teta-lite' ),
					'off'      => esc_html__( 'Container', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_5c5c61e6h5g',
					'type'     => 'switch',
					'title'    => esc_html__( 'Related Products', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable related products on product page', 'teta-lite' ),
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_lzo1csg8jbc',
					'type'     => 'switch',
					'title'    => esc_html__( 'Related Products Display Mode', 'teta-lite' ),
					'on'       => esc_html__( 'Gird Mode', 'teta-lite' ),
					'off'      => esc_html__( 'Carousel Mode', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'       => 'lite_option_nbigymzxuvf',
					'type'     => 'switch',
					'title'    => esc_html__( 'Related Products Width', 'teta-lite' ),
					'on'       => esc_html__( 'Full width', 'teta-lite' ),
					'off'      => esc_html__( 'Container', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Cookie Law', 'teta-lite' ),
			'id'     => 'kite_cookie',
			'icon'   => 'icon-candy',
			'fields' => array(
				array(
					'id'       => 'cookies_info',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show cookies info', 'teta-lite' ),
					'subtitle' => esc_html__( 'Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'          => 'cookies_text_message',
					'type'        => 'textarea',
					'title'       => esc_html__( 'cookies Popup text', 'teta-lite' ),
					'default' 	  => esc_html__( 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'teta-lite' ),
					'required'    => array( 'cookies_info', '=', true ),
				),
				array(
					'id'       => 'cookies_policy_page',
					'type'     => 'select',
					'data'     => 'pages',
					'title'    => esc_html__( 'Cookies detail page', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose page that will contain detailed information about your Privacy Policy', 'teta-lite' ),
					'required' => array( 'cookies_info', '=', true ),
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Footer And Widget Area', 'teta-lite' ),
			'id'     => 'kite_footer',
			'icon'   => 'icon-enter-down',
			'fields' => array(
				array(
					'id'     => 'footer_builder_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Footer Builder', 'teta-lite' ),
					'indent' => true,
				),
				array (
					'id'       => 'is_footer_build_with_elementor',
					'type'     => 'switch',
					'title'    => esc_html__('Build Footer With Elementor', 'teta-lite'),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'elementor_footer_template_id',
					'type'    => 'select',
					'title'   => esc_html__( 'Select Template', 'teta-lite' ),
					'options' => kite_get_elementor_templates_list( 'footer' ),
					'required'=> array( 'is_footer_build_with_elementor', '=' , true ),
				),
				array(
					'id'     => 'footer_builder_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'footer_text_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Footer Title And Subtitle', 'teta-lite' ),
					'indent' => true,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'          => 'footer_title',
					'type'        => 'text',
					'title'       => esc_html__( 'Footer Title', 'teta-lite' ),
					'placeholder' => esc_html__( 'Enter footer title text here. ', 'teta-lite' ),
				),
				array(
					'id'          => 'footer_subtitle',
					'type'        => 'text',
					'title'       => esc_html__( 'Footer Subitle', 'teta-lite' ),
					'placeholder' => esc_html__( 'Enter footer subtitle text here. ', 'teta-lite' ),
				),
				array(
					'id'     => 'footer_text_section_end',
					'type'   => 'section',
					'indent' => false,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'     => 'footer_widget_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Widget Area', 'teta-lite' ),
					'title'  => esc_html__( 'Widget Area', 'teta-lite' ),
					'indent' => true,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'      => 'footer-widget-area',
					'type'    => 'switch',
					'title'   => esc_html__( 'Footer Widget Area', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Enable', 'teta-lite' ),
					'off'     => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'footer_widgets',
					'type'    => 'image_select',
					// Must provide key => value(array:title|img) pairs for radio options
					'options' => array(
						1  => array(
							'alt' => 'one',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget1.png',
						),
						2  => array(
							'alt' => 'Six-Six',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget2.png',
						),
						3  => array(
							'alt'   => 'eight-four',
							'class' => 'eight-four',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget3.png',
						),
						4  => array(
							'alt'   => 'four-eight',
							'class' => 'four-eight',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget4.png',
						),
						5  => array(
							'alt' => 'four-four-four',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget5.png',
						),
						6  => array(
							'alt' => 'three-three-three-three',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget6.png',
						),
						7  => array(
							'alt'   => 'three-three-six',
							'class' => 'three-three-six',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget7.png',
						),
						8  => array(
							'alt'   => 'six-three-three',
							'class' => 'six-three-three',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget8.png',
						),
						9  => array(
							'alt'   => 'three-three-two-two-two',
							'class' => 'three-three-two-two-two',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget9.png',
						),
						10 => array(
							'alt'   => 'two-two-two-three-three',
							'class' => 'two-two-two-three-three',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget10.png',
						),
						11 => array(
							'alt' => 'one-three-three-three-three',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget11.png',
						),
						12 => array(
							'alt' => 'two-two-two-two-two-two',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget12.png',
						),
						13 => array(
							'alt'   => 'one-three-three-two-two-two',
							'class' => 'one-three-three-two-two-two',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget13.png',
						),
						14 => array(
							'alt' => 'six-six-three-three-three-three',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget14.png',
						),
						15 => array(
							'alt'   => 'six-six-three-three-two-two-two',
							'class' => 'six-six-three-three-two-two-two',
							'img'   => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer_widget15.png',
						),
					),
					'default' => 0,
					'class'   => 'footer-widgets',
				),
				array(
					'id'     => 'footer_widget_section_end',
					'type'   => 'section',
					'indent' => false,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'     => 'product_widget_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Products & Categories In Widget Area', 'teta-lite' ),
					'indent' => true,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'       => 'product_widget_area',
					'type'     => 'switch',
					'title'    => esc_html__( 'Footer widget area in products page', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show widgetized footer in product page', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'       => 'category_widget_area',
					'type'     => 'switch',
					'title'    => esc_html__( 'Footer widget area in categories page', 'teta-lite' ),
					'subtitle' => esc_html__( 'Show widgetized footer in product page', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'     => 'product_widget_section_end',
					'type'   => 'section',
					'indent' => false,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'     => 'footer_widget_banner_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Widget Area Background', 'teta-lite' ),
					'indent' => true,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'       => 'footer-widget-banner',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload an image to be shown as Widget area background', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Background Image', 'teta-lite' ),
				),
				array(
					'id'       => 'footer-widget-gradient',
					'type'     => 'switch',
					'title'    => esc_html__( 'Gradient Overlay', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enable or disable Gradient Overlay on the footer background image', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'      => 'footer-widget-color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Footer Widget Background Color', 'teta-lite' ),
					'default' => array(
						'color' => '#f5f5f5',
						'alpha' => '1',
					),
					'mode'    => 'background',
				),
				array(
					'id'      => 'footer-widget-style',
					'type'    => 'switch',
					'title'   => esc_html__( 'Widget Area Color Scheme', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Light', 'teta-lite' ),
					'off'     => esc_html__( 'Dark', 'teta-lite' ),
				),
				array(
					'id'      => 'footer-widget_width',
					'type'    => 'switch',
					'title'   => esc_html__( 'Widget Area Width', 'teta-lite' ),
					'default' => false,
					'on'      => esc_html__( 'Container', 'teta-lite' ),
					'off'     => esc_html__( 'Full width', 'teta-lite' ),
				),
				array(
					'id'     => 'footer_widget_banner_section_end',
					'type'   => 'section',
					'indent' => false,
					'required'=> array( 'is_footer_build_with_elementor', '=' , false ),
				),
				array(
					'id'     => 'footer_style_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Footer Layout', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'footerType',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Footyer Layout Style', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the Footer style', 'teta-lite' ),
					'options'  => array(
						'logo-in-middle' => array(
							'alt' => 'one',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer-type1.png',
						),
						'triangular'     => array(
							'alt' => 'tweleve',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer-type2.png',
						),
						'leftaligned'    => array(
							'alt' => 'eight-four',
							'img' => KITE_THEME_LIB_URI . '/admin/img/footer_widget/footer-type3.png',
						),
					),
					'default'  => 'logo-in-middle',
					'class'    => 'footerType',
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'      => 'footer-copyright',
					'type'    => 'text',
					'title'   => esc_html__( 'Copyright Text', 'teta-lite' ),
					'default' => '&copy; 2021 KiteStudio | Built With The '. KITE_THEME_NAME .' Theme',
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'       => 'footerlogo',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload Footer Logo', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Footer Logo', 'teta-lite' ),
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'       => 'footerStyle',
					'type'     => 'switch',
					'title'    => esc_html__( 'Footer Color Scheme', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose footer color scheme', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Dark', 'teta-lite' ),
					'off'      => esc_html__( 'Light', 'teta-lite' ),
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'       => 'footerFullwidth',
					'type'     => 'switch',
					'title'    => esc_html__( 'Footer Width', 'teta-lite' ),
					'subtitle' => esc_html__( 'Choose the footer to be boxed or full-width.', 'teta-lite' ),
					'default'  => false,
					'on'       => esc_html__( 'Fullwidth', 'teta-lite' ),
					'off'      => esc_html__( 'Container', 'teta-lite' ),
				),
				array(
					'id'       => 'social_network_display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Social Network Icons', 'teta-lite' ),
					'default'  => true,
					'subtitle' => esc_html__( 'Enable/disable Social Network icons on footer.', 'teta-lite' ),
					'required' => array( 'is_footer_build_with_elementor', '=', false )
				),
				array(
					'id'     => 'footer_style_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);
	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Socials', 'teta-lite' ),
			'id'     => 'kite_socials',
			'icon'   => 'icon-share2',
			'fields' => array(
				array(
					'id'     => 'lite_option_8tti66jwbrv',
					'type'   => 'section',
					'title'  => esc_html__( 'Social Login', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'    => 'lite_option_q7pqa3vb3wg',
					'type'  => 'text',
					'title' => esc_html__( 'Google App Id', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'    => 'lite_option_qc9tkf7psvb',
					'type'  => 'text',
					'title' => esc_html__( 'Google App Secret', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'    => 'lite_option_vcikrbd6s2',
					'type'  => 'text',
					'title' => esc_html__( 'Facebook App Id', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'    => 'lite_option_ngh74rtbxjh',
					'type'  => 'text',
					'title' => esc_html__( 'Facebook App Secret', 'teta-lite' ),
					'class'    => 'kt-pro-feature'
				),
				array(
					'id'     => 'lite_option_a1d1euycd1t',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'instagram_api_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Instagram Api', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'    => 'instagram_app_id',
					'type'  => 'text',
					'title' => esc_html__( 'Instagram App Id', 'teta-lite' ),
				),
				array(
					'id'    => 'instagram_app_secret',
					'type'  => 'text',
					'title' => esc_html__( 'Instagram App Secret', 'teta-lite' ),
				),
				array(
					'id'    => 'instagram_api',
					'type'  => 'instagram_api_connector',
				),
				array(
					'id'     => 'instagram_api_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'rss_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Rss display', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'      => 'rss_url',
					'type'    => 'switch',
					'title'   => esc_html__( 'Rss', 'teta-lite' ),
					'default' => false,
				),
				array(
					'id'       => 'social_rss_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Rss Feed', 'teta-lite' ),
					'required' => array( 'rss_url', '=', true ),
				),
				array(
					'id'     => 'rss_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'social_share_display_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Social Share Buttons Display', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'social_share_display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Social Share Buttons', 'teta-lite' ),
					'default'  => false,
					'subtitle' => esc_html__( 'Enable/disable Social share buttons on products/post. This setting could be overrided in each products/post item', 'teta-lite' ),
				),
				array(
					'id'       => 'social_share_facebook',
					'type'     => 'switch',
					'title'    => esc_html__( 'Facebook', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_mail',
					'type'     => 'switch',
					'title'    => esc_html__( 'Email', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_twitter',
					'type'     => 'switch',
					'title'    => esc_html__( 'Twitter', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_telegram',
					'type'     => 'switch',
					'title'    => esc_html__( 'Telegram', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_whatsapp',
					'type'     => 'switch',
					'title'    => esc_html__( 'Whatsapp', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_linkedin',
					'type'     => 'switch',
					'title'    => esc_html__( 'LinkedIn', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_vk',
					'type'     => 'switch',
					'title'    => esc_html__( 'VK', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'       => 'social_share_pinterest',
					'type'     => 'switch',
					'title'    => esc_html__( 'Pinterest', 'teta-lite' ),
					'default'  => true,
					'required' => array( 'social_share_display', '=', true ),
				),
				array(
					'id'     => 'social_share_display_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'     => 'social_network_display_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Social Network URLs', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'social_facebook_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Facebook', 'teta-lite' ),
				),
				array(
					'id'       => 'social_twitter_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Twitter', 'teta-lite' ),
				),
				array(
					'id'       => 'social_vimeo_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Vimeo', 'teta-lite' ),
				),
				array(
					'id'       => 'social_youtube_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Youtube', 'teta-lite' ),
				),
				array(
					'id'       => 'social_dribbble_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Dribbble', 'teta-lite' ),
				),
				array(
					'id'       => 'social_tumblr_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Tumbler', 'teta-lite' ),
				),
				array(
					'id'       => 'social_linkedin_url',
					'type'     => 'text',
					'title'    => esc_html__( 'LinkedIn', 'teta-lite' ),
				),
				array(
					'id'       => 'social_flickr_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Flicker', 'teta-lite' ),
				),
				array(
					'id'       => 'social_github_url',
					'type'     => 'text',
					'title'    => esc_html__( 'GitHub', 'teta-lite' ),
				),
				array(
					'id'       => 'social_lastfm_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Last.fm', 'teta-lite' ),
				),
				array(
					'id'       => 'social_paypal_url',
					'type'     => 'text',
					'title'    => esc_html__( 'PayPal', 'teta-lite' ),
				),
				array(
					'id'       => 'social_skype_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Skype', 'teta-lite' ),
				),
				array(
					'id'       => 'social_wordpress_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Wordpress', 'teta-lite' ),
				),
				array(
					'id'       => 'social_yahoo_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Yahoo', 'teta-lite' ),
				),
				array(
					'id'       => 'social_deviantart_url',
					'type'     => 'text',
					'title'    => esc_html__( 'DeviantArt', 'teta-lite' ),
				),
				array(
					'id'       => 'social_steam_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Steam', 'teta-lite' ),
				),
				array(
					'id'       => 'social_reddit_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Reddit', 'teta-lite' ),
				),
				array(
					'id'       => 'social_stumbleupon_url',
					'type'     => 'text',
					'title'    => esc_html__( 'stumbleupon', 'teta-lite' ),
				),
				array(
					'id'       => 'social_pinterest_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Pinterest', 'teta-lite' ),
				),
				array(
					'id'       => 'social_xing_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Xing', 'teta-lite' ),
				),
				array(
					'id'       => 'social_blogger_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Blogger', 'teta-lite' ),
				),
				array(
					'id'       => 'social_soundcloud_url',
					'type'     => 'text',
					'title'    => esc_html__( 'SoundCloud', 'teta-lite' ),
				),
				array(
					'id'       => 'social_delicious_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Delicious', 'teta-lite' ),
				),
				array(
					'id'       => 'social_foursquare_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Foursquare', 'teta-lite' ),
				),
				array(
					'id'       => 'social_instagram_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Instagram', 'teta-lite' ),
				),
				array(
					'id'       => 'social_behance_url',
					'type'     => 'text',
					'title'    => esc_html__( 'Behance', 'teta-lite' ),
				),
				array(
					'id'       => 'social_vk_url',
					'type'     => 'text',
					'title'    => esc_html__( 'VK', 'teta-lite' ),
				),
				array(
					'id'     => 'social_network_display_section_end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'first_social_network_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'First Custom Social Network', 'teta-lite' ),
					'indent'   => true, // Indent all options below until the next 'section' option is set.
					'required' => array( 'social_network_display', '=', true ),
				),
				array(
					'id'    => 'social_custom1_title',
					'type'  => 'text',
					'title' => esc_html__( 'First custom social network Title : ', 'teta-lite' ),

				),
				array(
					'id'    => 'social_custom1_url',
					'type'  => 'text',
					'title' => esc_html__( 'First custom social network URL : ', 'teta-lite' ),
				),
				array(
					'id'       => 'social_custom1_image',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload logo image for custom Social Network.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Logo Image', 'teta-lite' ),
				),
				array(
					'id'      => 'social_custom1_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Accent color', 'teta-lite' ),
					'default' => array(
						'color' => '#a7a7a7',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'     => 'first_social_network_section_end',
					'type'   => 'section',
					'indent' => false, // Indent all options below until the next 'section' option is set.
				),
				array(
					'id'       => 'second_social_network_section_start',
					'type'     => 'section',
					'title'    => esc_html__( 'Second Custom Social Network', 'teta-lite' ),
					'indent'   => true, // Indent all options below until the next 'section' option is set.
					'required' => array( 'social_network_display', '=', true ),
				),
				array(
					'id'    => 'social_custom2_title',
					'type'  => 'text',
					'title' => esc_html__( 'Second custom social network Title : ', 'teta-lite' ),
				),
				array(
					'id'    => 'social_custom2_url',
					'type'  => 'text',
					'title' => esc_html__( 'Second custom social network URL : ', 'teta-lite' ),
				),
				array(
					'id'       => 'social_custom2_image',
					'type'     => 'media',
					'subtitle' => esc_html__( 'Upload logo image for custom Social Network.', 'teta-lite' ),
					'operator' => 'and',
					'title'    => esc_html__( 'Logo Image', 'teta-lite' ),
				),
				array(
					'id'      => 'social_custom2_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Accent color', 'teta-lite' ),
					'default' => array(
						'color' => '#a7a7a7',
						'alpha' => '1',
					),

					'mode'    => 'background',

				),
				array(
					'id'     => 'second_social_network_section_end',
					'type'   => 'section',
					'indent' => false, // Indent all options below until the next 'section' option is set.
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Performance', 'teta-lite' ),
			'id'     => 'kite_performance',
			'icon'   => 'icon-chart-growth',
			'fields' => array(
				array(
                    'id'       => 'is_lazy_load_enable',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Lazy Load', 'teta-lite' ),
                    'subtitle' => esc_html__( 'Enable or disable lazy load', 'teta-lite' ),
                    'on'       => esc_html__( 'Enable', 'teta-lite' ),
                    'off'      => esc_html__( 'Disable', 'teta-lite' ),
                    'default'  => true,
                ),
				array(
                    'id'       => 'lite_option_rk0evm55n1n',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Load Js when required', 'teta-lite' ),
                    'subtitle' => esc_html__( 'To have better speed score, enable this option to load js files when its required. Enable this option if you are using elementor as page builder.', 'teta-lite' ),
                    'on'       => esc_html__( 'Enable', 'teta-lite' ),
                    'off'      => esc_html__( 'Disable', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_9n657w61b3w',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Load styles when required', 'teta-lite' ),
                    'subtitle' => esc_html__( 'To have better speed score, enable this option to load css files when its required. Enable this option if you are using elementor as page builder.', 'teta-lite' ),
                    'on'       => esc_html__( 'Enable', 'teta-lite' ),
                    'off'      => esc_html__( 'Disable', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_6bc21aimkc8',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Disable Emoji Scripts', 'teta-lite' ),
                    'subtitle' => esc_html__( 'If you don\'t use emoji on your websites enable this option to have better speed score.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_yk1uzlof0xj',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Disable Gutenberg Styles', 'teta-lite' ),
                    'subtitle' => esc_html__( 'If you don\'t use gutenberg on your websites enable this option to have better speed score.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_3awikcknwtn',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Disable Woocommerce Block Styles', 'teta-lite' ),
                    'subtitle' => esc_html__( 'If you don\'t use Woocommerce blocks on your websites enable this option to have better speed score.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_yx0r1ktawga',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Disable Yith Dependent Scripts', 'teta-lite' ),
                    'subtitle' => esc_html__( 'To have better speed score, It\'s recommanded to enable this option.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_soceu42lxnb',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Disable Elementor Font Awesome', 'teta-lite' ),
                    'subtitle' => esc_html__( 'To have better speed score, It\'s recommanded to enable this option.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
				array(
                    'id'       => 'lite_option_qiammrg6ais',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Load contact form 7 plugin scripts when required', 'teta-lite' ),
                    'subtitle' => esc_html__( 'To have better speed score, It\'s recommanded to enable this option.', 'teta-lite' ),
                    'on'       => esc_html__( 'Yes', 'teta-lite' ),
                    'off'      => esc_html__( 'No', 'teta-lite' ),
                    'class'    => 'kt-pro-feature'
                ),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Maintenance', 'teta-lite' ),
			'id'     => 'kite_maintenance',
			'icon'   => 'icon-hammer-wrench',
			'fields' => array(
				array(
					'id'     => 'maintenance_section_start',
					'type'   => 'section',
					'title'  => esc_html__( 'Maintenance Settings', 'teta-lite' ),
					'indent' => true,
				),
				array(
					'id'       => 'maintenance_mode',
					'type'     => 'switch',
					'title'    => esc_html__( 'Maintenance mode', 'teta-lite' ),
					'subtitle' => esc_html__( 'If it is enabled, no one except admins can see frontend of the website. Users who have a role, such as authors, translators, etc, only can see the dashboard. You should create a maintenance page and select it in the next option.', 'teta-lite' ),
					'default'  => true,
					'on'       => esc_html__( 'Enable', 'teta-lite' ),
					'off'      => esc_html__( 'Disable', 'teta-lite' ),
				),
				array(
					'id'       => 'maintenance_page',
					'type'     => 'select',
					'options'  => kite_get_maintenance_page(),
					'title'    => esc_html__( 'Maintenance page', 'teta-lite' ),
					'required' => array( 'maintenance_mode', '=', true ),
				),
				array(
					'id'     => 'maintenance_section_end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

	Redux::setSection(
		$opt_name,
		array(
			'title'  => esc_html__( 'Additional Scripts', 'teta-lite' ),
			'id'     => 'kite_additional-scripts',
			'icon'   => 'icon-file-code',
			'fields' => array(
				array(
					'id'       => 'additional-js',
					'type'     => 'ace_editor',
                    'theme'    => 'chrome',
					'title'    => esc_html__( 'Additional JavaScript', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enter custom JavaScript code such as Google Analytics code here. Please note that you should not include &lt;script&gt; tags in your scripts.', 'teta-lite' ),
				),
				array(
					'id'       => 'additional-css',
					'type'     => 'ace_editor',
					'mode'     => 'css',
                    'theme'    => 'chrome',
					'title'    => esc_html__( 'Custom CSS', 'teta-lite' ),
					'subtitle' => esc_html__( 'Enter custom CSS code such as style overrides here. Please note that you should not include &lt;style&gt; tags in your css code.', 'teta-lite' ),
				),
			),
		)
	);
	Redux::setSection(
		$opt_name,
		array(
			'title'      => esc_html__( 'Import / Export', 'teta-lite' ),
			'id'         => 'kite_import/export',
			'heading'    => 'Import / Export Options',
			'icon'       => 'el el-refresh',
			'customizer' => false,
			'fields'     => array(
				array(
					'id'         => 'redux_import_export',
					'type'       => 'import_export',
					'full_width' => true,
				),
			),
		)
	);

	do_action( 'kite_after_settings_initialized' );

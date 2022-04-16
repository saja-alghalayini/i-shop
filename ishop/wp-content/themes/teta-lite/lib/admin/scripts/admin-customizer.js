jQuery(document).ready(function($) {
    var options_key = 'theme_teta_lite_options';
	jQuery('#' + options_key + '-topbar_icon div.selector-popup').css('width', '210px');
	/***********************************************************************
    *					Preloader | Page Transition						   *
	************************************************************************/
    function customizer_preloader_check() {
        if (jQuery('#' + options_key + '-loader_display input[name="loader_display"]').val() != "1") {
            jQuery('#' + options_key + '-page-transition-type').slideUp();
            jQuery('#' + options_key + '-preloader-type').show();
            jQuery('#' + options_key + '-preloader_display').show();
            preloader_creative_select();
        } else { 
            jQuery('#' + options_key + '-preloader-type').slideUp();
            jQuery('#' + options_key + '-preloader_display').slideUp();
            jQuery('#' + options_key + '-preloader_box_color').slideUp();
	    	jQuery('#' + options_key + '-preloader-text').slideUp();
	    	jQuery('#' + options_key + '-preloader_text_color').slideUp();
	    	jQuery('#' + options_key + '-preloader-logo').slideUp();
            jQuery('#' + options_key + '-page-transition-type').show();
        }
    }
    customizer_preloader_check();
    jQuery(document).on('click', '#' + options_key + '-loader_display', function(event) {
        event.preventDefault();
        /* Act on the event */
        customizer_preloader_check();
        jQuery('#' + options_key + '-loader_display').parent('ul').trigger('click');
    });
    function preloader_creative_select() {
    	if (jQuery('fieldset#' + options_key + '-preloader-type label.redux-image-select-selected img').attr('alt') == 'creative') {
    		jQuery('#' + options_key + '-preloader_box_color').show();
	    	jQuery('#' + options_key + '-preloader-text').show();
	    	jQuery('#' + options_key + '-preloader_text_color').show();
	    	jQuery('#' + options_key + '-preloader-logo').show();
    	}else {
    		jQuery('#' + options_key + '-preloader_box_color').slideUp();
	    	jQuery('#' + options_key + '-preloader-text').slideUp();
	    	jQuery('#' + options_key + '-preloader_text_color').slideUp();
	    	jQuery('#' + options_key + '-preloader-logo').slideUp();
    	}
    	
    }
    jQuery(document).on('click', '#' + options_key + '-preloader-type', function(event) {
        event.preventDefault();
        /* Act on the event */
        preloader_creative_select();
        jQuery('#' + options_key + '-preloader-type').parent('ul').trigger('click');
    });

    /***********************************************************************
    *					Header | Menu									   *
	************************************************************************/
	var $kite_menu;
	function header_type_select() {
		if (jQuery('fieldset#' + options_key + '-header-type label.redux-image-select-selected img').attr('alt') == 'type-7' || jQuery('fieldset#' + options_key + '-header-type label.redux-image-select-selected img').attr('alt') == 'type-8') {
			jQuery('#' + options_key + '-vertical-menu-social-display').show();
			jQuery('#' + options_key + '-vertical-menu-social-icon-style').show();
			jQuery('#' + options_key + '-vertical_menu_copyright').show();
			jQuery('#' + options_key + '-vertical_menu_background').show();
			jQuery('#' + options_key + '-menu-background-color').show();
			jQuery('#' + options_key + '-menu-text-color').show();
			jQuery('#' + options_key + '-menu-opacity').show();
			jQuery('#' + options_key + '-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-text-bg-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-border-color').slideUp();
			jQuery('#' + options_key + '-menu-container').slideUp();
			jQuery('#' + options_key + '-header-style').slideUp();
			jQuery('#' + options_key + '-menu-hover-style').slideUp();
			jQuery('#' + options_key + '-logo-second').slideUp();
			jQuery('#' + options_key + '-initial-menu-background-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-bg-hover-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-border-color').slideUp();
			jQuery('#' + options_key + '-submenu-hover-style').slideUp();
			jQuery('#' + options_key + '-submenu-background-color').slideUp();
			jQuery('#' + options_key + '-submenu-text-color').slideUp();
			jQuery('#' + options_key + '-submenu-heading-color').slideUp();
		}
		else if (jQuery('fieldset#' + options_key + '-header-type label.redux-image-select-selected img').attr('alt') == 'type-10') {
			jQuery('#' + options_key + '-animated_text').show();
			jQuery('#' + options_key + '-animated_text_Bgimage').show();
			jQuery('#' + options_key + '-animated_text_color').show();
			jQuery('#' + options_key + '-menu_icon_color').show();
			jQuery('#' + options_key + '-menu_icon_bgcolor').show();
			jQuery('#' + options_key + '-initial-menu-text-color-hover').show();
			jQuery('#' + options_key + '-initial-menu-text-color').show();
			jQuery('#' + options_key + '-menu-container').slideUp();
			jQuery('#' + options_key + '-header-style').slideUp();
			jQuery('#' + options_key + '-cat-menu-state-open').slideUp();
			jQuery('#' + options_key + '-menu-hover-style').slideUp();
			jQuery('#' + options_key + '-initial-menu-background-color').slideUp();
			jQuery('#' + options_key + '-menu-opacity').slideUp();
			jQuery('#' + options_key + '-menu-text-color').slideUp();
			jQuery('#' + options_key + '-vertical_menu_copyright').slideUp();
			jQuery('#' + options_key + '-vertical_menu_copyright').slideUp();
			jQuery('#' + options_key + '-cat-menu-state-light').slideUp();
			jQuery('#' + options_key + '-vertical_menu_background').slideUp();
			jQuery('#' + options_key + '-menu-background-color').slideUp();
			jQuery('#' + options_key + '-searchbox-style').slideUp();
			jQuery('#' + options_key + '-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-text-bg-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-border-color').slideUp();
			jQuery('#' + options_key + '-menu-container').slideUp();
			jQuery('#' + options_key + '-menu-hover-style').slideUp();
			jQuery('#' + options_key + '-logo-second').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-bg-hover-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-border-color').slideUp();
			jQuery('#' + options_key + '-submenu-hover-style').slideUp();
			jQuery('#' + options_key + '-submenu-background-color').slideUp();
			jQuery('#' + options_key + '-submenu-text-color').slideUp();
			jQuery('#' + options_key + '-submenu-heading-color').slideUp(); 
		} else {
			
			jQuery('#' + options_key + '-animated_text').slideUp();
			jQuery('#' + options_key + '-animated_text_Bgimage').slideUp();
			jQuery('#' + options_key + '-animated_text_color').slideUp();
			jQuery('#' + options_key + '-menu_icon_color').slideUp();
			jQuery('#' + options_key + '-menu_icon_bgcolor').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-color-hover').slideUp();
			jQuery('#' + options_key + '-cat-menu-state-open').show();
			jQuery('#' + options_key + '-header-style').show();
			jQuery('#' + options_key + '-vertical-menu-social-display').slideUp();
			jQuery('#' + options_key + '-vertical-menu-social-icon-style').slideUp();
			jQuery('#' + options_key + '-vertical_menu_copyright').slideUp();
			jQuery('#' + options_key + '-vertical_menu_background').slideUp();
			jQuery('#' + options_key + '-menu-opacity').slideUp();
			jQuery('#' + options_key + '-menu-container').show();
			jQuery('#' + options_key + '-menu-hover-style').show();
			header_menu_style_select();
			jQuery('#' + options_key + '-submenu-hover-style').show();
			jQuery('#' + options_key + '-submenu-background-color').show();
			jQuery('#' + options_key + '-submenu-text-color').show();
			jQuery('#' + options_key + '-submenu-heading-color').show();

		}
	}
	header_type_select();
	jQuery(document).on('click', '#' + options_key + '-header-type', function(event) {
        event.preventDefault();
        /* Act on the event */
        header_type_select();
        jQuery('#' + options_key + '-header-type').parent('ul').trigger('click');
    });
	function header_menu_style_select() {
		if (jQuery('fieldset#' + options_key + '-header-style label.redux-image-select-selected img').attr('alt') == 'kite-menu') {
			jQuery('#' + options_key + '-logo-second').show();
			$kite_menu = true;
			hover_menu_style_select();
		} else {
			jQuery('#' + options_key + '-logo-second').slideUp();
			$kite_menu = false;
			hover_menu_style_select();
		}
	}
	jQuery(document).on('click', '#' + options_key + '-header-style', function(event) {
        event.preventDefault();
        /* Act on the event */
        header_menu_style_select();
        jQuery('#' + options_key + '-header-style').parent('ul').trigger('click');
    });
	function hover_menu_style_select() {
		if ($kite_menu) {
			jQuery('#' + options_key + '-menu-background-color').show();
			jQuery('#' + options_key + '-menu-text-color').show();
			jQuery('#' + options_key + '-menu-border-color').show();
		} else {
			jQuery('#' + options_key + '-logo-second').slideUp();
			jQuery('#' + options_key + '-menu-background-color').slideUp();
			jQuery('#' + options_key + '-menu-text-color').slideUp();
			jQuery('#' + options_key + '-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-text-bg-hover-color').slideUp();
			jQuery('#' + options_key + '-menu-border-color').slideUp();
		}
		jQuery('#' + options_key + '-initial-menu-background-color').show();
		jQuery('#' + options_key + '-initial-menu-text-color').show();
		jQuery('#' + options_key + '-initial-menu-border-color').show();
		if (jQuery('fieldset#' + options_key + '-menu-hover-style label.redux-image-select-selected img').attr('alt') == 'hover_style4') {
			if ($kite_menu) {
				jQuery('#' + options_key + '-menu-text-hover-color').slideUp();
				jQuery('#' + options_key + '-menu-text-bg-hover-color').slideUp();
			}
			jQuery('#' + options_key + '-initial-menu-text-hover-color').slideUp();
			jQuery('#' + options_key + '-initial-menu-text-bg-hover-color').slideUp();				
		} else if (jQuery('fieldset#' + options_key + '-menu-hover-style label.redux-image-select-selected img').attr('alt') == 'hover_style3') {
			if ($kite_menu) {
				jQuery('#' + options_key + '-menu-text-hover-color').show();
				jQuery('#' + options_key + '-menu-text-bg-hover-color').slideUp();
			}
			jQuery('#' + options_key + '-initial-menu-text-hover-color').show();
			jQuery('#' + options_key + '-initial-menu-text-bg-hover-color').slideUp();
		} else {
			if ($kite_menu){
				jQuery('#' + options_key + '-menu-text-hover-color').show();
				jQuery('#' + options_key + '-menu-text-bg-hover-color').show();
			}
			jQuery('#' + options_key + '-initial-menu-text-hover-color').show();
			jQuery('#' + options_key + '-initial-menu-text-bg-hover-color').show();
		}
	}
	jQuery(document).on('click', '#' + options_key + '-menu-hover-style', function(event) {
        event.preventDefault();
        /* Act on the event */
        header_menu_style_select();
        jQuery('#' + options_key + '-menu-hover-style').parent('ul').trigger('click');
    });
    function font_navigation_type_select() {
    	if (jQuery('li#' + options_key + '-font-navigation-type input').val() == 'google') {
    		jQuery('#' + options_key + '-font-navigation').show();
    		jQuery('#' + options_key + '-custom-font-url-navigation').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-navigation').slideUp();
    	} else if (jQuery('li#' + options_key + '-font-navigation-type input').val() == 'custom') {
    		jQuery('#' + options_key + '-font-navigation').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-navigation').show();
    		jQuery('#' + options_key + '-custom-font-name-navigation').show();
    	} else {
    		jQuery('#' + options_key + '-font-navigation').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-navigation').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-navigation').slideUp();
    	}
    }
    font_navigation_type_select();
    var $fontElement = jQuery('li#' + options_key + '-font-navigation-type input');
    jQuery(document).on('change', $fontElement, function(event) {
        event.preventDefault();
        /* Act on the event */
        font_navigation_type_select();
        //jQuery('li#' + options_key + '-font-navigation-type').parent('ul').trigger('click');
    });
    
	/***********************************************************************
    *					Woocommerce										   *
	************************************************************************/
	function shop_product_style_select() {
		if (jQuery('fieldset#' + options_key + '-shop-product-style label.redux-image-select-selected img').attr('alt') == 'infoonclick' ) {
			jQuery('#' + options_key + '-shop-product-rating').slideUp();
			jQuery('#' + options_key + '-product-hover-color').slideUp();
			jQuery('#' + options_key + '-product-hover-custom-color').slideUp();
		} else if (jQuery('fieldset#' + options_key + '-shop-product-style label.redux-image-select-selected img').attr('alt') == 'infoonhover') {
			jQuery('#' + options_key + '-shop-product-rating').show();
			jQuery('#' + options_key + '-product-hover-color').show();
			product_hover_custom_color();
		} else {
			jQuery('#' + options_key + '-shop-product-rating').show();
			jQuery('#' + options_key + '-product-hover-color').slideUp();
			jQuery('#' + options_key + '-product-hover-custom-color').slideUp();
		}
	}
	shop_product_style_select();
	jQuery(document).on('click', '#' + options_key + '-shop-product-style', function(event) {
        event.preventDefault();
        /* Act on the event */
        shop_product_style_select();
        jQuery('#' + options_key + '-shop-product-style').parent('ul').trigger('click');
    });

	function product_hover_custom_color() {
		if (jQuery('fieldset#' + options_key + '-product-hover-color label.redux-image-select-selected img').attr('alt') == 'custom' ) {
			jQuery('#' + options_key + '-product-hover-custom-color').show();
		} else {
			jQuery('#' + options_key + '-product-hover-custom-color').slideUp();
		}
	}
	jQuery(document).on('click', '#' + options_key + '-product-hover-color', function(event) {
        event.preventDefault();
        /* Act on the event */
        product_hover_custom_color();
        jQuery('#' + options_key + '-product-hover-color').parent('ul').trigger('click');
    });

	function categories_filter() {
		if (jQuery('li#' + options_key + '-shop-filter-categories input').val() == 1 || jQuery('li#' + options_key + '-shop-filter-categories input').val() == "true") {
			jQuery('#' + options_key + '-shop-filter-subcategories').show();
		} else {
			jQuery('#' + options_key + '-shop-filter-subcategories').slideUp();
		}
	}
	categories_filter();
	jQuery(document).on('click', '#' + options_key + '-shop-filter-categories', function(event) {
        event.preventDefault();
        /* Act on the event */
        categories_filter();
        jQuery('#' + options_key + '-shop-filter-categories').parent('ul').trigger('click');
    });

    function product_detail_style_select() {
    	if (jQuery('fieldset#' + options_key + '-product-detail-style label.redux-image-select-selected img').attr('alt') == 'pd_background' || jQuery('fieldset#' + options_key + '-product-detail-style label.redux-image-select-selected img').attr('alt') == 'pd_top' || jQuery('fieldset#' + options_key + '-product-detail-style label.redux-image-select-selected img').attr('alt') == 'pd_fullwidth_top') {
    		jQuery('#' + options_key + '-product-detail-bg').show();
    		jQuery('#' + options_key + '-product-detail-sidebar-position').slideUp();
    		jQuery('#' + options_key + '-product-detail-sidebar-responsive').slideUp();
    	} else if (jQuery('fieldset#' + options_key + '-product-detail-style label.redux-image-select-selected img').attr('alt') == 'pd_classic_sidebar') {
    		jQuery('#' + options_key + '-product-detail-bg').slideUp();
    		jQuery('#' + options_key + '-product-detail-sidebar-position').show();
    		jQuery('#' + options_key + '-product-detail-sidebar-responsive').show();
    	} else {
    		jQuery('#' + options_key + '-product-detail-bg').slideUp();
    		jQuery('#' + options_key + '-product-detail-sidebar-position').slideUp();
    		jQuery('#' + options_key + '-product-detail-sidebar-responsive').slideUp();
    	}
    }
    product_detail_style_select();
    jQuery(document).on('click', '#' + options_key + '-product-detail-style', function(event) {
        event.preventDefault();
        /* Act on the event */
        product_detail_style_select();
        jQuery('#' + options_key + '-product-detail-style').parent('ul').trigger('click');
    });

    function related_product() {
		if (jQuery('li#' + options_key + '-related_product input').val() == 1 || jQuery('li#' + options_key + '-related_product input').val() == "true") {
			jQuery('#' + options_key + '-related_product_display').show();
		} else {
			jQuery('#' + options_key + '-related_product_display').slideUp();
		}
	}
	related_product();
	jQuery(document).on('click', '#' + options_key + '-related_product', function(event) {
        event.preventDefault();
        /* Act on the event */
        related_product();
        jQuery('#' + options_key + '-related_product').parent('ul').trigger('click');
    });


    /***********************************************************************
    *					Fonts Section									   *
	************************************************************************/
	function font_body_type_select() {
    	if (jQuery('li#' + options_key + '-font-body-type input').val() == 'google') {
    		jQuery('#' + options_key + '-font-body').show();
    		jQuery('#' + options_key + '-custom-font-url-body').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-body').slideUp();
    	} else if (jQuery('li#' + options_key + '-font-body-type input').val() == 'custom') {
    		jQuery('#' + options_key + '-font-body').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-body').show();
    		jQuery('#' + options_key + '-custom-font-name-body').show();
    	} else {
    		jQuery('#' + options_key + '-font-body').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-body').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-body').slideUp();
    	}
    }
    font_body_type_select();
    jQuery(document).on('change', '#font-body-type-select', function(event) {
    	event.preventDefault();
    	/* Act on the event */
    	font_body_type_select();
    	jQuery('li#' + options_key + '-font-body-type').parent('ul').trigger('click');
    });

    function font_headings_type_select() {
    	if (jQuery('li#' + options_key + '-font-headings-type input').val() == 'google') {
    		jQuery('#' + options_key + '-font-headings').show();
    		jQuery('#' + options_key + '-custom-font-url-headings').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-headings').slideUp();
    	} else if (jQuery('li#' + options_key + '-font-headings-type input').val() == 'custom') {
    		jQuery('#' + options_key + '-font-headings').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-headings').show();
    		jQuery('#' + options_key + '-custom-font-name-headings').show();
    	} else {
    		jQuery('#' + options_key + '-font-headings').slideUp();
    		jQuery('#' + options_key + '-custom-font-url-headings').slideUp();
    		jQuery('#' + options_key + '-custom-font-name-headings').slideUp();
    	}
    }
    font_headings_type_select();
    jQuery(document).on('change', '#font-headings-type-select', function(event) {
        event.preventDefault();
        /* Act on the event */
        font_headings_type_select();
        jQuery('li#' + options_key + '-font-headings-type').parent('ul').trigger('click');
    });


    /***********************************************************************
    *					Cookie Law Section								   *
	************************************************************************/

	function cookie_law_section() {
		if (jQuery('li#' + options_key + '-cookies_info input[name="cookies_info"]').val() != "1") {
			jQuery('#' + options_key + '-cookies_text_message').slideUp();
			jQuery('#' + options_key + '-cookies_policy_page').slideUp();
		} else {
			jQuery('#' + options_key + '-cookies_text_message').show();
			jQuery('#' + options_key + '-cookies_policy_page').show();
		}
	}
	jQuery('li#' + options_key + '-cookies_info').on('click', function(event) {
		cookie_law_section();
	});
	cookie_law_section();
	/***********************************************************************
    *						Social Section								   *
	************************************************************************/
	function social_share_button() {
		if (jQuery('li#' + options_key + '-social_share_display input').val() == 1 || jQuery('li#' + options_key + '-social_share_display input').val() == "true") {
			jQuery('#' + options_key + '-social_share_facebook').show();
			jQuery('#' + options_key + '-social_share_mail').show();
			jQuery('#' + options_key + '-social_share_twitter').show();
			jQuery('#' + options_key + '-social_share_pinterest').show();
			jQuery('#' + options_key + '-social_share_telegram').show();
			jQuery('#' + options_key + '-social_share_whatsapp').show();
			jQuery('#' + options_key + '-social_share_linkedin').show();
			jQuery('#' + options_key + '-social_share_vk').show();
		} else {
			jQuery('#' + options_key + '-social_share_facebook').slideUp();
			jQuery('#' + options_key + '-social_share_mail').slideUp();
			jQuery('#' + options_key + '-social_share_twitter').slideUp();
			jQuery('#' + options_key + '-social_share_pinterest').slideUp();
			jQuery('#' + options_key + '-social_share_telegram').slideUp();
			jQuery('#' + options_key + '-social_share_whatsapp').slideUp();
			jQuery('#' + options_key + '-social_share_linkedin').slideUp();
			jQuery('#' + options_key + '-social_share_vk').slideUp();
		}
	}
	jQuery('li#' + options_key + '-social_share_display').on('click', function(event) {
		social_share_button();
	});
	social_share_button();
});


function woo_body_type_select() {
	jQuery('li#customize-control-teta_shop_header_display').hide();
	if (jQuery('li#customize-control-woocommerce_shop_page_display select ').val() == 'both') {
		jQuery('li#customize-control-teta_shop_header_display').show();
	}
	else{
		jQuery('li#customize-control-teta_shop_header_display').hide();
	}
}
	woo_body_type_select();
    jQuery(document).on('change', '#customize-control-woocommerce_shop_page_display', function(event) {
    	event.preventDefault();
    	woo_body_type_select();
    	jQuery('li#customize-control-woocommerce_shop_page_display').parent('ul').trigger('click');
    }); 
	



/*! 
 * 
 * ================== assets/js/kite/main.js =================== 
 **/ 

/**
 * Kitestudio Main Js File
 */

window.kiteTheme = {};

// Configuration
( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    $.extend( kiteTheme, {

        // rtl: js_porto_vars.rtl == '1' ? true : false,
        // rtl_browser: $( 'html' ).hasClass( 'browser-rtl' ),

        ajax_url: kite_theme_vars.ajax_url,

        $window: $(window),
        $document: $(document),
        $body: $('body'),
        windowHeight: $(window).height(),
        windowWidth: $(window).width(),
        msie: window.navigator.userAgent.indexOf("self.msie "),
        msie11: navigator.userAgent.match(/Trident.*rv\:11\./),
        is_device_mobile: /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test( navigator.userAgent || navigator.vendor || window.opera ) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test( ( navigator.userAgent || navigator.vendor || window.opera ).substr( 0, 4 ) ),
        isTouchDevice: (Modernizr.touchevents) ? true : false,

        isTablet: function () {
            if ( window.innerWidth < 1024 )
                return true;
            return false;
        },

        isMobile: function () {
            if ( window.innerWidth <= 767 )
                return true;
            return false;
        },

        // Blog page number
        blogPageNum: 0,
        //Header
        $ktHeader: $("#kt-header"),

        scrolingToSection: false,
        externalClicked: false,
        $scrolId: '', // this value Save Value of specific id From top
        enableScrollId: '',
        //menu
        menuArray: [],

        $scrollpals: $("html, body"),
        wcNoticeTimer: '',
        resizeId: '',

        init: function() {
            this.updateDocHeight();
            this.updateWinDimension();
            this.pageTopSpace();
            this.minPageHeightSet();
            this.showMoreTag();
            this.initSelectElements();
            this.nav();
            this.allCats();
            this.UpdateCurrentMenuAncestorClass();
            this.homeHeight();
            this.mobileNavigation();
            this.toggleSidebar();
            this.kiteScrollBar();
            this.coveringLevelVerticalMenu();
            this.interactiveBackgroundImg();
            this.parallaxImg();
            this.scrollTo();
            this.lazyLoadOnLoad('#main-content, .togglesidebar');
            this.lazyLoadOnHover();
            this.abortImageLoading();
            this.wpmlMenu();
            this.vcGridReInit();
            this.fixIOSDoubleTapIssue();
            this.ajaxifySearch();
            this.updateToolbarEditLink();
            this.preloaderHide();
            this.topBar();
            this.topBarLang();
            this.additionalScript();
            this.scrolling();
            this.initialMenuArray();
            this.updateMenuOnActiveSection();
            this.searchForm();
            this.sliderParallax();
            this.headerTransformation();
            this.scrollToTopButton();
            this.galleryStart();
            this.getScrollBarWidth();
            this.ajaxSearchForm();
            this.headerPromoBar();
            this.checkHeader();
            this.tabClick();
            this.humburgerMenuToggle();
            this.humburgerMenuUpdate();
            this.humburgerMenuNavigation();
            this.bottomNavbarHandler();
            this.selectElement();
            this.shortcodeAnimation();
            this.faq();
            this.socialLink();
            this.socailshare();
            this.trapNavigationInModal();
        },

        onReady: function() {
            this.popupNewsletter();
            this.cookiesBar();
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Update document height, window height & width
        /*-----------------------------------------------------------------------------------*/

        updateDocHeight: function () {
            this.documentHeight = Math.max(
                this.$document.height(),
                this.windowHeight,
                document.documentElement.clientHeight /* For opera: */
            );

            this.$window.trigger('document-height-changed');
        },

        updateWinDimension: function () {
            this.windowHeight = this.$window.height();
            this.windowWidth = this.$window.width();
        },

        /*----------------------------------------------------------------------------------*/
        /*   top space for blog in main page
        /*-----------------------------------------------------------------------------------*/

        // page Top Space depends On menu Height
        pageTopSpace: function () {
            var topSpace = 0,
                topbarHeight = 0;

            if ($('#topbar').length) {
                topbarHeight = 33;
            }

            if ($('header').hasClass('type2_3')) {

                topSpace = 125 + topbarHeight;

            } else if ($('header').hasClass('type4_5_6')) {

                topSpace = 85 + topbarHeight;

            } else {

                topSpace = 58 + topbarHeight;

            }

            return topSpace;
        },

        /*----------------------------------------------------------------------------------*/
        /*  set min-height For Blog and blog Detail 
        /*-----------------------------------------------------------------------------------*/

        minPageHeightSet: function () {
            var self = this;

            if (self.windowWidth > 1140) {

                var $pageFooterHeight = $('.footer-bottom').height(),
                    topbarHeight = $('#topbar').height();

                // Add Footer Widget section height too Footer height
                if ($('.footer-widgetized').length) {
                    $pageFooterHeight = $pageFooterHeight + $('.footer-widgetized').height();
                }

                var $pageMainHeight,
                    $wholePageHeight,
                    $pageMainHeight2;

                if ( $('.layout').height() < self.windowHeight ) {
                    var pageHeightExcludedMainContent = $('.layout').height() - $('#main-content').height();
                    $('#main-content').css( 'min-height', 'calc(100vh - ' + pageHeightExcludedMainContent + 'px)');
                }

                //check if page is without slider, set a min-height for page
                if ($('#fullscreenslider').length <= 0 && $('#blogsingle').length <= 0) {
                    $pageMainHeight = $('#main').height();
                    $wholePageHeight = $pageMainHeight + $pageFooterHeight;
                    $pageMainHeight2 = self.windowHeight - $pageFooterHeight - topbarHeight;

                    $('#main').css({
                        'min-height': $pageMainHeight2 + "px",
                    });

                } else if ($('#blogsingle').length) {

                    $pageMainHeight = $('#blogsingle').height();
                    $wholePageHeight = $pageMainHeight + $pageFooterHeight;
                    $pageMainHeight2 = self.windowHeight - $pageFooterHeight - topbarHeight;

                    $('#blogsingle').css({
                        'min-height': $pageMainHeight2 + "px"
                    });

                } else {
                    $('#main').css({ 'min-height': "0px" });
                }
            }
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Show More tag
        /*-----------------------------------------------------------------------------------*/

        showMoreTag: function () {
            if ( $('.widget_product_tag_cloud .tagcloud').length != 0 ) {
                var productTagHeight = $('.widget_product_tag_cloud .tagcloud').height();
                if ( productTagHeight > 100 ) {
                    $('.widget_product_tag_cloud').addClass("collapse");
                    if ( !$('.widget_product_tag_cloud .tagcloud').find('.show_more_items').length ) {
                        $('.widget_product_tag_cloud .tagcloud').after("<span class='show_more_tags'>" + kite_theme_vars.show_more + "</span>");
                    }
                }

                $('.widget_product_tag_cloud .show_more_tags').on('click', function (e) {
                    e.preventDefault();
                    $('.widget_product_tag_cloud').removeClass("collapse");
                });
            }


            if ( $('.widget_layered_nav.widget > ul').length != 0 ) {
                $('.widget_layered_nav.widget').each(function (index, el) {

                    if ( $(this).find('> ul').height() > 162) {
                        $(this).addClass('collapse');
                        if ( !$(this).find('.show_more_items').length ) {
                            $(this).append("<span class='show_more_items'>" + kite_theme_vars.show_more + "</span>");
                        }
                    }

                    $('.widget_layered_nav.widget .show_more_items').on('click', function (event) {
                        event.preventDefault();
                        $(this).parents('.widget_layered_nav.widget').removeClass('collapse');
                    });
                });
            }

            if ( $('.widget_product_categories.widget > ul').length != 0 ) {
                var productCategoriesHeight = $('.widget_product_categories.widget:not(.inFilterbar) > ul').height();
                if ( productCategoriesHeight > 160 && $("body").hasClass("show-more-categories") ) {
                    $('.widget_product_categories.widget:not(.inFilterbar)').addClass('collapse');
                    if (!$('.widget_product_categories.widget:not(.inFilterbar)').find('.show_more_items').length) {
                        $('.widget_product_categories.widget:not(.inFilterbar)').append("<span class='show_more_items'>" + kite_theme_vars.show_more + "</span>");
                    }
                }

                $('.widget_product_categories.widget .show_more_items,.widget_product_categories .cats-toggle').on('click', function (event) {
                    event.preventDefault();
                    $('.widget_product_categories.widget').removeClass('collapse');
                });
            }

        },

        /*-----------------------------------------------------------------------------------*/
        /*  niceSelect For Restyle SELECT OPTION 
        /*-----------------------------------------------------------------------------------*/

        initSelectElements: function (Action) {
            if ( $('.woocommerce').length != 0 ) {
                $('.woocommerce-ordering .orderby').niceSelect(Action);
                $('form.cart table.variations select').not('.hide-attr-select').niceSelect(Action);
            }

            // Calculate shipping section in cart page
            // archive of post
            // widget select categories
            // woocommerce drop down widgets - layerd Nav
            $('section.shipping-calculator-form select, .widget_archive select, .widget_categories select.postform, .widget_product_categories select.dropdown_product_cat,.widget_layered_nav select,.widget select').niceSelect(Action);

            // this Code added : For bug Fix call select in Ajax Request in Filter drop down
            $('.widget_product_categories select.dropdown_product_cat,select.dropdown_layered_nav').niceSelect();

        },

        /*-----------------------------------------------------------------------------------*/
        /*  Navigation
        /*-----------------------------------------------------------------------------------*/

        nav: function () {

            var self = this;

            if (self.windowWidth <= 1140) {
                return;
			}

            var $menuItem = $('.navigation > ul li.menu-item-has-children');

            $menuItem.each(function () {

                var $menuWrapper = $(this).find('.menu-item-wrapper'),
                    $secondlevelItems = $menuWrapper.find('> ul > li'),
                    $rightOffset = 0;//store the offset of megamenu from right side of screen

                if ( $(this).hasClass('mega-menu-parent') ) {
                    $menuWrapper.find('.special-last-child').closest('.menu-item-wrapper').addClass('has-special-last-child');

                    $menuWrapper.width($secondlevelItems.length * $secondlevelItems.eq(0).outerWidth());
                    $menuWrapper.height($menuWrapper.find('> ul').height());
                    $menuWrapper.css('margin-left', '');//Reset margin-left to calculate correct position
                    var $rightOffset = self.windowWidth - ($menuWrapper.offset().left + $menuWrapper.outerWidth());
                    if ( $rightOffset < 0 ) {
                        $menuWrapper.css('margin-left', $rightOffset); // cause mega menu be in window
                    }
                    if ( $menuWrapper.parents('.catmenu').length != 0 ) {
                        if ( $menuWrapper.find('> ul').height() < $('nav.catmenu').height() ) {
                            $menuWrapper.height($('.category-menu-container > nav').height());
                            $menuWrapper.find('li.has-bg').height($('.category-menu-container > nav').height());
                        }
                    }
                } else {
                    var $subMenuWidth = $(this).find('> ul').eq(0).outerWidth();
                    var $rightOffset = self.windowWidth - ($(this).offset().left + $subMenuWidth);
                    if ($rightOffset < $subMenuWidth) {
                        $(this).addClass('left-submenus');
                    }
                }
                if ( $(this).parents('.catmenu').length != 0 ) {
                    var menuWidth = $(this).parents('.catmenu').siblings('.allcats').width();
                    if (self.windowWidth > 1140) {
                        var $left = parseInt(menuWidth) + parseInt($(this).parents('.catmenu').siblings('.allcats').css('marginLeft').replace('px', ''));
                        if ( $('body').hasClass('rtl') ) {
                            $menuWrapper.css('right', $left);
                        } else {
                            $menuWrapper.css('left', $left);
                        }
                        if ( !$(this).hasClass('mega-menu-parent') && $(this).parents('.mega-menu-parent').length == 0 ) {
                            if ( $('body').hasClass('rtl') ) {
                                $(this).find('> ul.sub-menu').css('right', $left);
                            } else {
                                $(this).find('> ul.sub-menu').css('left', $left);
                            }
						}
                    }
                }
            });

            //Mega menu
            $menuItem.mouseover(function () {
                if ( !$(this).hasClass('hover') ) {
					$(this).addClass("hover");
				}

            }).mouseout(function () {
                $(this).removeClass("hover");
            });

            $menuItem.focusin(function(){
                if ( !$(this).hasClass('hover') ) {
					$(this).addClass("hover");
				}
            });

            $menuItem.focusout(function(){
                $(this).removeClass("hover");
            });

        },
        allCats: function () {
            var self = this;
            $('.allcats').on('click', function () {
                $('.catmenu').toggleClass('close');
                self.nav();
            });
        },
        UpdateCurrentMenuAncestorClass: function () {
            var self = this;
            if ( self.windowWidth <= 1140 ) {
				return;
			}

            $('header .navigation > ul > li').removeClass('current-menu-ancestor');
            $('header .navigation > ul > li').removeClass('current-menu-item');
            $('header .navigation li li ul li.active').parents('.navigation > ul > li.menu-item-has-children').addClass('current-menu-ancestor');
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Home Height 
        /*-----------------------------------------------------------------------------------*/

        homeHeight: function (callback) {

            var self = this;

            var $wpAdminBarHeight = $('#wpadminbar').height();

            //Wordpress Admin Bar Height
            var checkWpBar = function () {
                var $HSlMHeight = self.windowHeight;
                if ( !isNaN($wpAdminBarHeight) ) {
                    $HSlMHeight = $HSlMHeight - $wpAdminBarHeight;
                }
                return $HSlMHeight;
            }

            var $HSlMVal = checkWpBar();

            // Image Fullscreen
            if ( $('.fulscreenimage').length !== 0 ) {
                $("#fulscreenimage").css({ height: $HSlMVal + 'px' });
            }

            if ( self.windowWidth > 1140 ) {
                // Revolution Slider
                if ( $('#homeHeight').height() > 0 ) {

                    var $LHeight = $('#homeHeight').height();
                    $LHeight = $LHeight - 6;

                    if ( !isNaN($wpAdminBarHeight) ) {
                        $LHeight = $LHeight - $wpAdminBarHeight;
                    }
                    $LHeight = 0;
                } else {//Reset the top margin for pages without intro
                    $("#main").css({ marginTop: 0 + 'px' });
                }

            } else {
                $('#main').css({ marginTop: 0 });
            }

            return true;

        },

        /*------------------------------------------------------------------------------*/
        /*  phone Navigation
        /*------------------------------------------------------------------------------*/

        mobileNavigation: function () {
            var self = this;
            $('.mobile-navigation li.cat-item:has(ul.children)').addClass('menu-item-has-children');
            $('.mobile-navigation li.cat-item ul.children').addClass('sub-menu');
            $('.mobile-navigation ul.sub-menu').slideUp('300', 'easeInOutCirc');
            $('.mobile-navigation li.menu-item-has-children a').off('click');
            $('.mobile-navigation li.menu-item-has-children a').on('click', function (event) {
                var $li = $(this).parent('li');
                if ($li.hasClass('menu-item-has-children')) {
                    event.preventDefault();
                }
                if ($li.hasClass('mega-menu-parent')) {
                    if ($(this).hasClass('active')) {
                        $li.find('> div.menu-item-wrapper > ul.sub-menu').slideUp('300', function(){
                            setTimeout( self.trapNavigationInModal(false), 300 );
                        } );
                        $(this).removeClass('active');
                        $li.removeClass('active expanded');
                    } else {
                        $li.find('> div.menu-item-wrapper > ul.sub-menu').slideDown('300', 'easeInOutCirc');
                        $(this).addClass('active');
                        $li.addClass('active expanded');
                    }
                } else {
                    if ($(this).hasClass('active')) {
                        $li.find('> ul.sub-menu').slideUp('300', function(){
                            setTimeout( self.trapNavigationInModal(false), 300 );
                        });
                        $(this).removeClass('active');
                        $li.removeClass('active expanded');
                    } else {
                        $li.find('> ul.sub-menu').slideDown('300', 'easeInOutCirc');
                        $(this).addClass('active');
                        $li.addClass('active expanded');
                    }
                }
                $(document).trigger( 'menu-parent-item-toggle-expand');
            });

            $('.mobile-navigation li.menu-item-has-children a .menu_title span').on('click',function(){
                window.open( $(this).parents('a').attr('href'), '_self' );
            });
        },

        /*------------------------------------------------------------------------------*/
        /*  Toggle Sidebar container  + cart container
        /*------------------------------------------------------------------------------*/

        toggleSidebar: function () {

            var self = this;

            var $toggleSidebarContainer = $('.toggle-sidebar-container:not(.filtersidebar)'),
                $toggleSidebarMobileMenu = $('.toggle-sidebar-mobile-menu:not(.categories-offcanvas)'),
                $toggleSidebarCategoryMenu = $('.toggle-sidebar-mobile-menu.categories-offcanvas'),
                $toggleSidebarProductCategoryMenu = $('.toggle-sidebar-product-category-menu'),
                $cartSidebarContainer = $('.cart-sidebar-container'),
                $fixedAddToCartContainer = $('.fixed-add-to-cart-container .fixed-add-to-cart'),
                $filtersidebarContainer = $('.toggle-sidebar-container.filtersidebar'),
                $widgetSidebarAreaContainer = $(".main-sidebar-container, #woocommerce-product-sidebar"),
                $scrollToTop = $('.scrolltotop'),
                //Buttons
                $mobileNavButton = $('.mobilenavbutton'),
                $catNavButton = $('.cat-nav-button'),
                $productNavButton = $('.productnavbutton'),
                $cartToggleButton = $('.cart-sidebarbtn,.kt-header-button.kt-cart'),
                $mobileSidebarOverlay = $('.mobile-sidebar-overlay');

            var closeSidebar = function () {
                if ($toggleSidebarContainer.hasClass('sidebar-toggle-open') || $filtersidebarContainer.hasClass('sidebar-toggle-open') || $('header.kt-elementor-template .responsive-whole-search-container').hasClass('open') ) {
                    self.$ktHeader.removeClass('sidebar-toggle-open');
                    $toggleSidebarContainer.removeClass('sidebar-toggle-open');
                    $toggleSidebarMobileMenu.removeClass('sidebar-toggle-open');
                    $toggleSidebarCategoryMenu.removeClass('sidebar-toggle-open');
                    $toggleSidebarProductCategoryMenu.removeClass('sidebar-toggle-open');
                    $cartSidebarContainer.removeClass('sidebar-toggle-open');
                    $widgetSidebarAreaContainer.removeClass('open');
                    $('header.kt-elementor-template .responsive-whole-search-container').removeClass('open');
                    $('.kt-header-builder-overlay').removeClass('show');

                    $fixedAddToCartContainer.removeClass('toggleOpen');
                    $scrollToTop.removeClass('toggleOpen');

                    $mobileSidebarOverlay.removeClass('open');

                    if ($('.shop-filter .shop-filter-toggle').hasClass('open'))
                        $('.shop-filter .shop-filter-toggle').removeClass('open');

                    if ($('.shop-filter').hasClass('open'))
                        $('.shop-filter').removeClass('open');

                    $filtersidebarContainer.removeClass('sidebar-toggle-open');
                    //Allow snap-to-scroll + scrolling
                    self.$body.removeClass('disable-snap-to-scroll');
                }
            }

            var openSidebar = function (type) {
                self.$ktHeader.addClass('sidebar-toggle-open');
                $toggleSidebarContainer.addClass('sidebar-toggle-open');
                $fixedAddToCartContainer.addClass('toggleOpen');
                $scrollToTop.addClass('toggleOpen');
                $('.kt-header-builder-overlay').addClass('show');

                //Disallow snap-to-scroll + disable scroll
                self.$body.addClass('disable-snap-to-scroll');

                if (type == 'cart') {
                    $cartSidebarContainer.addClass('sidebar-toggle-open');
                    $cartSidebarContainer.focus();
                } else if (type == 'catSidebar') {
                    $mobileSidebarOverlay.addClass('open');
                    $toggleSidebarCategoryMenu.addClass('sidebar-toggle-open');
                    self.trapNavigationInModal();
                } else if (type == 'filtersidebar') {
                    $filtersidebarContainer.addClass('sidebar-toggle-open');
                    $filtersidebarContainer.find('.togglefilterscontainer:not(.no-widgets)').css('display', 'block');
                    $filtersidebarContainer.focus();
                } else if (type == 'productcatsidebar') {
                    $mobileSidebarOverlay.addClass('open');
                    $toggleSidebarProductCategoryMenu.addClass('sidebar-toggle-open');
                    $toggleSidebarProductCategoryMenu.focus();
                    self.trapNavigationInModal();
                    console.error('test');
                } else if ( type == "widgetAreaSidebar" ) {
                    $widgetSidebarAreaContainer.addClass('open');
                } else {
                    $mobileSidebarOverlay.addClass('open');
                    $toggleSidebarMobileMenu.addClass('sidebar-toggle-open');
                    self.trapNavigationInModal();
                }
            }

            self.$document.on('click', '#sidebar-open-overlay, .kt-header-builder-overlay, .cart-sidebar-container .cart-close-btn,.togglesidebarWidgetbar #toggle-sidebar-close-btn,.mobile-sidebar-overlay,.mobile-menu-close-button span,.closesidebar, .kt-sidebar-title', function () {
                closeSidebar();
            });

            self.$document.on('keydown', '.cart-sidebar-container .cart-close-btn,.togglesidebarWidgetbar #toggle-sidebar-close-btn,.mobile-menu-close-button span,.closesidebar, .mobile-menu-close-button a', function (e) {
                if ( e.keyCode == 13 ) {
                    closeSidebar();
                }
            });

            var overlays = document.querySelectorAll('#sidebar-open-overlay, .kt-header-builder-overlay, .mobile-sidebar-overlay');
            for (var i = 0 ; i < overlays.length; i++) {
                overlays[i].addEventListener('touchstart' , function(e){
                    e.preventDefault();
                    closeSidebar();
                }) ;
            }

            self.$document.on( 'keydown', function(e){
                if( e.key === "Escape" ) {
                    closeSidebar();
                }
            });

            $cartToggleButton.on('click', function (e) {
                if ((self.$body.hasClass('vertical_menu_enabled') && self.windowWidth > 1140) || self.$body.hasClass('woocommerce-cart') || ( $(this).find('.widget_shopping_cart_content').length && self.$window.width() > 1025 ) )
                    return;

                e.preventDefault();
                openSidebar('cart');
            });

            $mobileNavButton.on('click', function () {
                openSidebar('mobileSidebar');
            });
            $catNavButton.on('click', function () {
                openSidebar('catSidebar');
            });
			$productNavButton.on('click', function () {
                openSidebar('productcatsidebar');
            });
            $('.shop-filter .shop-filter-toggle').on('click', function () {
                closeSidebar();
                if ( !$(this).siblings('.filtersidebar').hasClass('hidden-desktop') ) {
                    openSidebar('filtersidebar');
                }
            });
            $('#mobilenavbar .navicons.filters').on('click', function () {
                openSidebar('filtersidebar');
            });
            $('#mobilenavbar .navicons.kt-sidebar').on('click', function () {
                openSidebar('widgetAreaSidebar');
            });
            //close sidebar when click on links inside cart/sidebar
            self.$window.on('djaxLoading', function () {
                closeSidebar();
            })

        },

        /*------------------------------------------------------------------------------*/
        /*  Scrollbar
        /*------------------------------------------------------------------------------*/
        kiteScrollBar: function (element) {
            var $element = $(element);

            if (!$element) {
                return;
            }

            $element.each(function () {
                var $this = $(this),
                    $scrollContainer = $this.find('.swiper-container');

                if ($scrollContainer.length > 0) {
                    if ( $scrollContainer[0].swiper != undefined ) {
                        // $scrollContainer[0].swiper.updateSlidesSize();
                        return;
                    }
                }

                $this.wrapInner('<div class="swiper-container sw-scrollbar"><div class="swiper-wrapper"><div class="swiper-slide"></div></div><div class="swiper-scrollbar"></div></div>');
                $scrollContainer = $this.find('.swiper-container');

                var swiper = new Swiper($scrollContainer, {
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        draggable: true,
                    },
                    direction: 'vertical',
                    slidesPerView: 'auto',
                    mousewheelControl: true,
                    freeMode: true,
                    touchReleaseOnEdges: true,
                    mousewheelReleaseOnEdges: true,
                    mousewheelSensitivity: .6,
                });
            })

        },

        /*------------------------------------------------------------------------------*/
        /*  vertical sidebar
        /*------------------------------------------------------------------------------*/

        coveringLevelVerticalMenu: function () {

            var $verticalMenuItem = $(".vertical_menu_enabled .vertical_menu_navigation li.menu-item-has-children > a:not('.mp-back')");
            $verticalMenuItem.addClass('no_djax');

            $verticalMenuItem.on('click', function (e) {

                var $this = $(this);
                e.preventDefault();

                // Hide Li element
                $this.parent().siblings().addClass('hide-for-submenu');

                $this.addClass('hide-for-submenu');

                $this.parent().addClass('remove-activehover');

                var $subMenu = $this.siblings('.mp-level');

                if ( $subMenu.length ) {
                    $this.siblings('.mp-level').addClass('mp-level-open');
                }

            });

            $(".vertical_menu_enabled .vertical_menu_navigation li a.mp-back").on('click', function (e) {

                e.preventDefault();

                var $this = $(this);

                $this.parent().removeClass('mp-level-open');

                //show parent li element
                $this.parent().parent().find('a').removeClass('hide-for-submenu');

                $this.parent().parent().removeClass('remove-activehover');

                $this.parent().parent().siblings().removeClass('hide-for-submenu')

            });

        },

        /*----------------------------------------------------------------------------------*/
        /* Interactive background
        /*-----------------------------------------------------------------------------------*/
        interactiveBackgroundImg: function () {
            var self = this;
            if ( $('.interactive-background').length <= 0 ) {
                return;
            }

            self.interactiveBackground($('.interactive-background .section-container'), { sensitivity: 100, duration: 10000, zoom: false, initialZoom: true });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  parallax
        /*-----------------------------------------------------------------------------------*/

        parallaxImg: function () {

            var self = this;

            if ( self.$body.hasClass('snap-to-scroll') || $('.parallax').length <= 0 || self.msie > 0 || !!self.msie11 ) {
                return;
            }


            if ( self.windowWidth > 1140 && !self.isTouchDevice ) {
                var $parallaxContainers = $('.parallax'),
                    scrollPosition = 0;

                var parallaxHandler = function () {
                    $parallaxContainers.each(function () {
                        var $el = $(this),
                            speed = parseFloat($el.attr('data-speed')),
                            elementHeight = $el.data('height'),
                            elementTop = $el.data('offsetTop'),
                            elementBottom = elementTop + elementHeight,
                            factorMult = 0;

                        //When element is out of viewport
                        if ( elementTop > (scrollPosition + self.windowHeight) || elementBottom < scrollPosition ) {
                            return;
                        }

                        var parallax = (scrollPosition - elementTop) / self.windowHeight;
                        factorMult = Math.round((parallax) * speed * 100) / 100;
                        $el.find(".parallax-img").css({
                            'transform': 'translate3d(0,' + factorMult + '%,0)'
                        });
                    });
                }

                var parallaxInit = function () {
                    self.windowHeight = self.$window.height();
                    $parallaxContainers.each(function () {
                        var $el = $(this);
                        $el.data('offsetTop', $el.offset().top);
                        $el.data('height', $el.outerHeight(true));
                    });
                }

                var doScroll = function () {
                    $parallaxContainers.each(function () {
                        var $el = $(this);
                        $el.data('offsetTop', $el.offset().top);
                    });
                    scrollPosition = self.$window.scrollTop();
                    window.requestAnimationFrame(parallaxHandler);
                }

                parallaxInit();
                parallaxHandler();


                self.$window.on('scroll', doScroll).on('resize', parallaxInit);
                self.$window.one('djaxClick', function () {
                    self.$window.unbind('scroll', doScroll).unbind('resize', parallaxInit);
                });

            }
        },

        //Parallax by mouse position
        //Parallax by mouse position
        interactiveBackground: function ($elements, options) {
            var self = this;

            if (self.windowWidth <= 1140 || self.isTouchDevice) {
                return;
            }

            var transform = function ($target, x, y, scaleRatio) {
                $target.css('transform', 'matrix(1, 0, 0,1,' + x + ',' + y + ') scale(' + scaleRatio + ',' + scaleRatio + ')');
            }

            var transformLeave = function ($target, x, y, scaleRatio) {
                $target.css('transform', 'matrix(1, 0, 0,1,' + x + ',' + y + ') scale(' + scaleRatio + ',' + scaleRatio + ')');
            }

            return $elements.each(function () {

                var settings = $.extend({
                    target: '> .interactive-background-image img',
                    sensitivity: 20,
                    duration: 1400,//ms
                    zoom: true,
                    initialZoom: false,
                }, options);

                var el = $(this);
                //Prevent from multiple running
                if ( el.find(settings.target).length === 0 || el.hasClass('interactive-background-active') ) {
                    return true;
                }

                var target = el.find(settings.target),
                    h, w, cx, x, y, scaleRatio = 1;

                //set different transition duration for element
                if ( settings.duration != 1400 ) {
                    target.css('transition-duration', settings.duration + 'ms');
                }

                el.addClass('interactive-background-active');
                el.on('mouseenter interactive_bg_init', function (e) {
                    if (w !== el.width()) {
                        w = el.width();
                        h = el.height();
                        cx = settings.sensitivity / w;

                        if (settings.zoom || settings.initialZoom) {
                            scaleRatio = (w + settings.sensitivity) / w;
                        }

                        //set initial scale
                        if (settings.initialZoom) {
                            target.css('transform', 'scale(' + scaleRatio + ',' + scaleRatio + ')');
                        }
                    }
                }).on('mousemove', function (e) {
                    x = (-cx * (e.pageX - (target.offset().left + w / 2)));
                    y = (-cx * (e.pageY - (target.offset().top + h / 2)));
                    transform(target, x, y, scaleRatio);
                }).on('mouseleave', function (e) {
                    if (settings.initialZoom) {
                        transformLeave(target, 0, 0, scaleRatio);
                    }
                    else {
                        transformLeave(target, 0, 0, 1);
                    }

                });

                if (settings.initialZoom) {
                    el.trigger('interactive_bg_init');
                }
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Scrolling function 
        /*-----------------------------------------------------------------------------------*/

        scrollTo: function (location, introCheck, time) {

            var self = this;

            if ( location !== "#" ) {

                var scrollto;

                // introCheck 3 is for go to top Page ( top Button )
                // introCheck 2 is for logo
                //introcheck 5 is for next button in showcase
                if ( introCheck == 1 || introCheck == 2 || introCheck == 4 || introCheck == 5 ) {

                    if ( introCheck !== 4 && introCheck !== 5 ) { // this code run when link from external to internal
                        // get internal id ( hash ) From Query string
                        var sPageURL = window.location.search.substring(1);
                        var sURLVariables = sPageURL.split('&');
                        for (var i = 0; i < sURLVariables.length; i++) {
                            var sParameterName = sURLVariables[i].split('=');
                            if (sParameterName[0] == 'sectionid') {
                                location = '#'.concat(sParameterName[1]);
                            }
                        }
                    }

                    var $location = $(location);

                    if ( $location.length ) {
                        var offsetTop = $location.offset().top,
                            done = $location.closest('.layout').offset().top,
                            menuHeight = $('#headerfirststate').outerHeight(),
                            topBar = 0;

                        if ( $('#headersecondstate').length > 0 ) {
                            menuHeight = $('#headersecondstate').outerHeight();
                        }


                        offsetTop = offsetTop - done;

                        if ( self.$body.hasClass('has-topbar') ) { // Top bar height
                            topBar = 33;
                        }

                        if ( $('.vertical_menu_area').length || introCheck == 5 ) { // If vertical menu Or next button On showcase
                            scrollto = offsetTop - topBar;

                        } else {
                            scrollto = offsetTop - menuHeight + topBar;
                        }

                        if ( self.windowWidth <= 1140 ) {
                            scrollto = offsetTop - 70;//70px is responsive menu height
                        }

                    }
                }

                if ( introCheck === 1 || introCheck === 4 || introCheck === 5 ) {
                    var scrollTime = time ? time : parseInt(kite_theme_vars.scrolling_speed);
                    //scroll to inside id
                    self.$scrollpals.animate(
                        { scrollTop: scrollto },
                        {
                            duration: scrollTime,
                            easing: kite_theme_vars.scrolling_easing,
                            complete: function () {
                                self.scrolingToSection = false;
                                self.externalClicked = false;
                            },
                            queue: false
                        }
                    );

                } else if (introCheck === 2 || introCheck === 3) {
                    var scrollTime = time ? time : 1500;
                    //scroll to top of page
                    self.$scrollpals.animate(
                        { scrollTop: 0 },
                        {
                            duration: scrollTime,
                            easing: kite_theme_vars.scrolling_easing,
                            queue: false
                        }
                    );
                }
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  animation 
        /*-----------------------------------------------------------------------------------*/

        animationDelay: function (counter, $selector) {
            var baseDelay = 0.2;
            return baseDelay * counter;
        },

        setAnimationForItems: function ($container, $items, $item, $delay) {
            //Select one of available animations
            if ($container.hasClass('fadeinfrombottom') || $container.hasClass('fadein') || $container.hasClass('fadeinfromtop') || $container.hasClass('fadeinfromright') || $container.hasClass('fadeinfromleft')) {
                $container.find('ul li, .instagramfeed .instagram-img').addClass('isEaseInAnimated');
                $item.addClass('isanimated');
                $item.css({ 'transition-delay': $delay + 's' });
            } else if ($container.hasClass('zoomin')) {
                $container.find('.postphoto').addClass('isZoomInAnimated');
                $item.addClass('isanimated');
                $item.css({ 'transition-delay': $delay + 's' });
            } else if ($container.hasClass('default')) {
                $container.find('.postphoto').addClass('isDefault');
                $item.addClass('isanimated');
            }
        },

        // animation / cart blog
        isotopeAnimation: function ($container) {
            var self = this,
                $this = $container,
                counter = 0,
                $selector;

            if ((self.isMobile() || self.isTablet()) && $container.hasClass('no-responsive-animation')) {
                return;
            }

            $container.find('.isotope-item').not('.isotope-hidden').find('.postphoto,.blog_item').not('.isanimated').waypoint({
                handler: function () {
                    var $this = $(this.element);
                    $this.each(function () {
                        var $item = $(this);
                        setTimeout(function () {
                            //Ask self.animationDelay() for the amount of delay per each item
                            var delay = self.animationDelay(counter, $item);

                            // Select all items
                            var $allItems = $container.find('.postphoto');

                            //Select one of available animations
                            self.setAnimationForItems($container, $allItems, $item, delay);

                            //Reset counter per each iteration.
                            counter = counter + 1;

                        }, 50);
                        counter = 0;
                    });
                    this.destroy();
                },
                offset: '95%'
            });
        },

        //  products and Carousel ( image carousel , Instagram carousel , Products carousel )
        showAnimation: function ($container, $carousel) {

            var self = this,
                counter = 0,
                $carouselItem,
                $duplicateSlider;

            var showAnimationBase = function (that) {
                $(that).each(function () {
                    var $delay;
                    setTimeout(function () {
                        //Ask self.animationDelay() for the amount of delay per each item
                        //Select one of available animations
                        if ($container.hasClass('fadeinfrombottom') || $container.hasClass('fadeinfromtop') || $container.hasClass('fadeinfromright') || $container.hasClass('fadeinfromleft')) {

                            $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('isEaseInAnimated'); // Find .productWrap For Shop widge , Use Swiper-slide for image carousel
                            $(that).addClass('isanimated');

                            $delay = 0.15 * counter;
                            $(that).css({ 'transition-delay': $delay + 's' });

                        } else if ($container.hasClass('zoomin')) {
                            $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('isZoomInAnimated');
                            $(that).addClass('isanimated');

                            $delay = 0.1 * counter;
                            $(that).css({ 'transition-delay': $delay + 's' });

                        } else {
                            $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('fadein');
                            $(that).addClass('isanimated');

                            $delay = 0.01 * counter;
                            $(that).css({ 'transition-delay': $delay + 's' });

                        }

                        //Reset counter per each iteration.
                        counter = counter + 1;

                    }, 0);

                    counter = 0;

                });
            }

            //Set animation for duplicate slides seperatly to do not consider in animation delays
            var setAnimationBaseForDuplicatSlides = function ($that) {
                $that.css({ 'transition-delay': '0s' });
                $that.addClass('isanimated');

                if ($container.hasClass('fadeinfrombottom') || $container.hasClass('fadeinfromtop') || $container.hasClass('fadeinfromright') || $container.hasClass('fadeinfromleft')) {
                    $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('isEaseInAnimated'); // Find .productWrap For Shop widge , Use Swiper-slide for image carousel
                } else if ($container.hasClass('zoomin')) {
                    $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('isZoomInAnimated');
                } else {
                    $container.find('.productwrap , .swiper-slide,.product_category_container').addClass('fadein');
                }
            }

            if ((self.isMobile() || self.isTablet()) && $container.hasClass('no-responsive-animation')) {
                return true;
            }

            if ($carousel == 1) { //this code For carousel

                $carouselItem = $container.find('div.product');

                if ( !$carouselItem.hasClass('swiper-slide-visible') ) {
                    return 0;
                }

                $container.find('.swiper-slide-visible .productwrap:not(.isanimated), .swiper-slide-visible .product_category_container:not(.isanimated)').waypoint({
                    handler: function () {
                        var $item = $(this.element);


                        $duplicateSlider = $item.closest('div.product').siblings('div.product[data-swiper-slide-index="' + $item.closest('div.product').data("swiper-slide-index") + '"]').find('.productwrap, .product_category_container')
                        $container = $item.parents('.woocommerce.wc-shortcode');

                        //load animation on slide and its duplicate slide
                        showAnimationBase($item);
                        setAnimationBaseForDuplicatSlides($duplicateSlider);
                        this.destroy();
                    },
                    offset: '95%'
                });



            } else if ($carousel == 2) { // For Image Carousel

                $carouselItem = $container.find('div.swiper-slide');

                if (!$carouselItem.hasClass('swiper-slide-visible')) {
                    return 0;
                }

                if ($container.hasClass('has-animation')) {

                    $container.find('.swiper-slide-visible:not(.isanimated)').waypoint({
                        handler: function () {
                            var $item = $(this.element);

                            $duplicateSlider = $item.siblings('div[data-swiper-slide-index="' + $item.data("swiper-slide-index") + '"]')

                            $container = $item.parents('.carousel');

                            //load animation on slide and its duplicate slide
                            showAnimationBase($item);
                            setAnimationBaseForDuplicatSlides($duplicateSlider);
                            this.destroy();
                        },
                        offset: '95%'
                    });

                }

            } else if ($carousel == 3) { // For Instagram Carousel

                $carouselItem = $container.find('div.insta-media');

                if ( !$carouselItem.hasClass('swiper-slide-visible') ) {
                    return 0;
                }

                if ($container.hasClass('has-animation')) {
                    var $notAnimatedSlide = $container.find('.swiper-slide-visible:not(.isanimated)');

                    $notAnimatedSlide.waypoint({
                        handler: function () {
                            var $item = $(this.element);

                            $duplicateSlider = $item.siblings('div[data-swiper-slide-index="' + $item.data("swiper-slide-index") + '"]');
                            $container = $item.parents('.carousel');
                            //load animation on slide and its duplicate slide
                            showAnimationBase($item);
                            setAnimationBaseForDuplicatSlides($duplicateSlider);
                            this.destroy();
                        },
                        offset: '95%'
                    });

                }

            } else { //this code For gird ( no Carousel)
                if ( !$container.hasClass('main-shop-loop') ) {
                    $container = $container.closest('.woocommerce.wc-shortcode');
                }

                if ( !$container.hasClass('default') ) { // default = No animation for Product Grid
                    $container.find('.productwrap:not(.isanimated),.product_category_container:not(.isanimated)').waypoint({
                        handler: function () {
                            var $item = $(this.element);
                            showAnimationBase($item);
                            this.destroy();
                        },
                        offset: '95%'
                    });

                }

            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  Lazy loading images 
        /*-----------------------------------------------------------------------------------*/

        lazyLoadOnLoad: function (that) {
            let $thatContainers = typeof that == 'string' ? document.querySelectorAll(that) : that.get();

            var lazy_load_callback = (entries) => {
                entries.forEach( entry => {
                    if ( entry.isIntersecting ) {
                        let $this = entry.target;
                        if (!$this.classList.contains('lazy-loaded') && !$this.classList.contains('is-loading')) {
                            $this.classList.add('is-loading');
                            var $img, src;

                            if ($this.classList.contains('bg-lazy-load')) {
                                src = $this.dataset.src;

                            } else if ( $this.matches('img') ) {
                                $img = $this;
                                src = $img.dataset.src;
                            } else {
                                $img = $this.querySelector('img');
                                src = $img.dataset.src;
                            }

                            var img = new Image();

                            img.onload = function () {
                                if ($this.classList.contains('bg-lazy-load')) {
                                    $this.style.backgroundImage = 'url(' + src + ')';
                                    $this.removeAttribute('data-src');
                                } else {
                                    $img.src = src;
                                    $img.removeAttribute('data-src');
                                }

                                setTimeout(function () {
                                    $this.classList.add('lazy-loaded');
                                }, 100);
                            }
                            img.src = src;
                        }
                    }
                })
            }

            let options = {
                root: null,
                rootMargin: '0px',
                threshold: 0
            }

            $thatContainers.forEach( $container => {
                let $lazyLoadCntainers = $container.querySelectorAll('.lazy-load-on-load');
                if ($lazyLoadCntainers.length > 0) {

                    let observer = new IntersectionObserver( lazy_load_callback, options);
                    $lazyLoadCntainers.forEach( $lazyLoadElement => {
                        observer.observe( $lazyLoadElement );
                    })
                }
            })
        },

        lazyLoadOnHover: function ( $scope = '') {
            var self = this;

            if (self.isTouchDevice)
                return;
            if ( $scope == '' ) {
                var $items = $('.lazy-load-hover-container');
            } else {
                var $items = $scope.find('.lazy-load-hover-container');
            }

            $items.on('mouseenter', function () {
                var $this = $(this).find('.lazy-load-hover');
                if ($this.length > 0) {
                    if (!$this.hasClass('lazy-loaded') && !$this.hasClass('is-loading')) {
                        $this.addClass('is-loading');
                        $this.closest('.lazy-load-hover-container').addClass('is-loading');

                        var $img, src;

                        if ($this.hasClass('bg-lazy-load')) {
                            src = $this.data('src');
                        }
                        else {
                            $img = $this.find('img');
                            src = $img.data('src');
                        }

                        var img = new Image();

                        img.onload = function () {
                            if ($this.hasClass('bg-lazy-load'))
                                $this.css('background', 'url(' + src + ')').removeAttr('data-src', '');
                            else
                                $img.attr('src', src).removeAttr('data-src', '');

                            $this.closest('.lazy-load-hover-container').removeClass('is-loading');

                            setTimeout(function () {
                                $this.addClass('lazy-loaded');
                            }, 100);
                        }

                        img.src = src;
                    }
                }
            })
        },

        abortImageLoading: function () {
            $('.lazy-load.is-loading:not(.lazy-loaded) img').attr('src', '');
        },

        /*----------------------------------------------------------------------------------*/
        /*  WPML
        /*-----------------------------------------------------------------------------------*/

        wpmlMenu: function () {

            if ($('.headerwrap .menu-item-language').length) {
                $('.headerwrap .menu-item-language').append($("<span class='spanhover'></span>"));
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*   reInitialise the VC post grid
        /*-----------------------------------------------------------------------------------*/

        vcGridReInit: function () {
            if ($.fn.vcGrid) {
                $.fn.vcGrid.call($('[data-vc-grid-settings]'));
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*   Workaround for double tap issue on IOS
        /*-----------------------------------------------------------------------------------*/
        fixIOSDoubleTapIssue: function () {
            if (!navigator.platform.match(/(iPhone|iPod|iPad)/i)) {
                return;
            }

            var $elements = $('.buttons, .carousel .arrows-button-prev, .carousel .arrows-button-next,#blogsingle .arrows-button-next,#blogsingle .arrows-button-prev, .swiper-button-prev, .swiper-button-next,.woocommerce.infoonhover div.product, .woocommerce.infoonhover div.product .hover-image,.woocommerce.infoonhover div.product a.product-link');
            $elements = $elements.add('#mobile-menu-button,.cart-sidebarbtn,.cart-close-btn,#sidebar-open-overlay,.kt-header-builder-overlay,.responsive-wishlist a, .popup_interaction .soundcloud-format .play-button-wrap, .blog-masonry-container .play-button,#kt-modal,#kt-modal.quickview-modal #modal-close, #kt-modal a[rel="next"], #kt-modal a[rel="prev"]');
            $elements = $elements.add('.banner a,.gallery .postphoto, .galleryitem a, .readmore .loadmore, .woocommerce div.products div.product .product-buttons > span a, .pdwrap .pdnavigation a,.mobile-sidebar-overlay,.mobile-menu-close-button span,.navicons a,.scrolltotop a');
            $elements.on('touchstart mouseenter focus', function (e) {
                if (e.type == 'touchstart') {
                    e.stopImmediatePropagation();
                }
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Ajaxify Search
        /*-----------------------------------------------------------------------------------*/
        ajaxifySearch: function () {
            var self = this;

            //Woocommerce search
            self.$document.find("div.search-form form").submit(function (e) {
                var $this = $(this);

                var keyword = $this.find('input[name="s"]').val();
                if (keyword != '') {
                    var url = $this.attr('action');
                    $(this).siblings('a').attr('href', url + '?s=' + keyword).trigger('click');
                }
            });
        },

        /*----------------------------------------------------------------------------------*/
        /*   Wordpress toolbar edit link update
        /*-----------------------------------------------------------------------------------*/
        updateToolbarEditLink: function (content) {
            var self = this;

            if ( $("#wp-admin-bar-edit").length > 0 ) {
                // set up edit link when wp toolbar is enabled
                var page_id = self.$body.data('pageid');
                var oldLink = $('#wp-admin-bar-edit a').attr("href");
                var newLink = oldLink.replace(/(post=).*?(&)/, '$1' + page_id + '$2');
                $('#wp-admin-bar-edit a').attr("href", newLink);
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*   preloader
        /*-----------------------------------------------------------------------------------*/

        preloaderHide: function () {
            var self = this;

            //no-page-transition class prevent from running animation of page transition at first time
            self.$body.removeClass('no-page-transition');
            $('.main-content').addClass('show');
            // fixing issue : fade up animation in monitor with high height cause
            $('body.no-preloader.fade-up .footer-bottom').addClass('fadeissuefixed');
            $("#preloader").addClass('hide-preloader');
            setTimeout(function () {
                $("#preloader").css({ 'display': 'none' });
            }, 510);

        },


        /*----------------------------------------------------------------------------------*/
        /*   wpadminbar And Topbar
        /*-----------------------------------------------------------------------------------*/


        topBar: function () {
            var self = this;

            if ( $("#wpadminbar").length != 0 && self.windowWidth > 320 ) {

                if ( $("#topbar").length != 0 ) {

                    if (!(self.$ktHeader.hasClass('closedtopbar'))) {
                        // topbar Enable With wpadminbar
                        self.$ktHeader.add(".navigation-mobile").add("#homeHeight").addClass('menuspacewpnoti');
                        $("#topbar").addClass('topbarspacewp');
                    }
                    if ($('#topbar').hasClass('fixed-menu') || $('#topbar').hasClass('type10')) {

                        $('#topbar').css({ 'top': "32px", });
                    }

                } else {

                    // topbar disable With wpadminbar
                    self.$ktHeader.add("#homeHeight").addClass('menuspacewp');

                }
                $('.no-widgets > .sidebar.widget-area').addClass('has_adminbar');
            } else if ($("#topbar").length != 0 && !$("#topbar").hasClass('closed-topbar')) {
                // topbar Enable
                self.$ktHeader.add("#homeHeight").addClass('menu-space-noti');
            }

            if ( $("#wpadminbar").length != 0 && $(".vertical_menu_enabled").length != 0 ) {

                $('#home .homewrap .fulscreenimage').css({
                    'margin-top': "32px",
                });

            }

        },


        /*----------------------------------------------------------------------------------*/
        /*   Topbar language
        /*-----------------------------------------------------------------------------------*/

        topBarLang: function () {
            var href = window.location.href;
            var elements = $('.lang_link > li > a[href="' + href + '"]');
            var $langActive = elements.parent("li").addClass('active');
            if ($langActive.length) {
                var $selectedLang = $('.lang_link li.active').html();
                var $showLang = $("#language1,#mobile-language1").html()

                $('#language1,#mobile-language1').html($selectedLang);
                $('.lang_link li.active').html($showLang);
                $langActive.removeClass('active');
                $('#language1 > a,#mobile-language1 > a').attr('href', '#');
            }

            // Close the drop down language select in mobile menu
            $('.mobile-topbar .lang-sel > span:first-child a').on('click', function (event) {
                event.preventDefault();
                $('.mobile-topbar .lang-sel ul.lang_link').slideToggle('fast');
                $('.mobile-topbar .lang-sel ul.lang_link').toggleClass('show');
            });
            $('.dd-selected').on('click', function (event) {
                if ($('.mobile-topbar .lang-sel ul.lang_link').hasClass('show')) {
                    $('.mobile-topbar .lang-sel ul.lang_link').slideToggle('fast');
                    $('.mobile-topbar .lang-sel ul.lang_link').removeClass('show');
                }
            });
            $(document).on('click', function (event) {
                if ($(event.target).parents('.lang-sel').length == 0) {
                    if ($('.mobile-topbar .lang-sel ul.lang_link').hasClass('show')) {
                        $('.mobile-topbar .lang-sel ul.lang_link').slideToggle('fast');
                        $('.mobile-topbar .lang-sel ul.lang_link').removeClass('show');
                    }
                }

            });
            // End of Close dropdown language menu select in mobile menu
            $('.dd-select').off('click');
            $('.dd-select').on('click', function () {
                var $display = $('.dd-select').siblings('ul.dd-options').css('display');

                if ($display == 'none') {
                    $('.dd-select').siblings('ul.dd-options').slideDown();
                } else {
                    $('.dd-select').siblings('ul.dd-options').slideUp();
                }
            });
        },

        /*----------------------------------------------------------------------------------*/
        /*   User additional script
        /*-----------------------------------------------------------------------------------*/

        additionalScript: function () {
            //Run extra scripts here
            if ( '' != kite_theme_vars.additionaljs ) {
                eval(kite_theme_vars.additionaljs);
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*   Scrolling
        /*-----------------------------------------------------------------------------------*/

        scrolling: function () {
            var self = this;
            $(".navigation li a , .mobile-navigation li a , .vertical_menu_navigation li a").click(function (e) {
                var $this = $(this),
                    hashAttr = $this.attr('data-hash');

                $(".navigation li , .mobile-navigation li, .vertical_menu_navigation li").removeClass('active current_page_item');


                if (typeof hashAttr === typeof undefined || hashAttr === false) {

                    //add active class for first and secoud menu
                    var href = $this.attr('href');
                    var elements = $('a[href="' + href + '"]');

                    elements.parent().addClass('active');

                } else {
                    $('.navigation li a[data-hash="' + hashAttr + '"]').add('.mobile-navigation li a[data-hash="' + hashAttr + '"]').add('.vertical_menu_navigation li a[data-hash="' + hashAttr + '"]').parent().addClass('active');//Active item in all menus(Specially for kite-menu)
                }


                if (!$this.hasClass('locallink')) {
                    self.externalClicked = true;
                }

                if ($this.hasClass('externallink')) {

                    self.$scrolId = '#' + hashAttr; // section id that scroll into From External Page in internal page

                } else if ($this.hasClass('locallink')) {

                    e.preventDefault();
                    self.scrolingToSection = true;
                    self.scrollTo('#' + hashAttr, 4); //scroll to inside id  in Front Page
                }

                if ($this.hasClass('externallink')) {
                    self.enableScrollId = true;
                } else {
                    self.enableScrollId = false;
                }

            });

            $("header a.locallink.logo , header.type2_3 .locallink.logo a  ,aside .locallink.logo,header .locallink.home , aside .locallink.home").click(function (e) {
                var $this = $(this),
                    scroll = $this.attr('href');

                e.preventDefault();
                scroll = scroll.substring(scroll.indexOf("#"), scroll.length);
                self.scrollTo(scroll, 2);  //scroll to top of page
            });

            var pathname = window.location.href;

            if ( !window.location.origin ) { // Internet Explorer Origion
                window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
            }

            var $originpathname = window.location.origin + window.location.pathname;

            if ( pathname.search("#") > 0 ) {
                pathname = pathname.substring(pathname.indexOf("#"), pathname.length);
                if ( $originpathname !== pathname && pathname !== '#home' ) {
                    if ($(".page-template-main-page-php").length) {
                        self.scrollTo(pathname, 1);
                    }
                }
            }
        },

        //Initial list of menu items
        initialMenuArray: function () {
            var self = this;

            var aChildren = self.$ktHeader.find(".navigation li a").add(".vertical_menu_area .vertical_menu_navigation ul a"); // find the a children of the list items

            for (var i = 0; i < aChildren.length; i++) {

                var aChild = aChildren[i];
                if ($(aChild).hasClass('locallink')) {

                    var ahref = $(aChild).attr("data-hash");
                    if ( self.menuArray.indexOf(ahref) == -1 ) {
                        self.menuArray.push(ahref);
                    }
                }
            } // above loop fills the menuArray with attribute href values
        },

        /* add active class for menu when page Scrolling */
        updateMenuOnActiveSection: function () {
            var self = this;

            //Exit if this page is not main page
            if ( !self.$body.hasClass('home') || !self.$body.hasClass('page-template-main-page-php') ) {
                return;
            }

            //check navigating flag to know it is on scrolling to a section or not ( by click from user)
            if ( self.scrolingToSection == false && self.externalClicked == false ) {

                var windowY = self.$window.scrollTop(); // get the offset of the window from the top of page
                for (var i = 0; i < self.menuArray.length; i++) {
                    var theID = "#" + self.menuArray[i];
                    var theHash = self.menuArray[i];

                    if ( $(theID).length ) {

                        var divPos = $(theID).offset().top; // get the offset of the div from the top of page
                        var divHeight = $(theID).height(); // get the height of the div in question
                        var menuSize = 87;

                        if ($(".vertical_menu_area").length)
                            menuSize = 0;

                        if ( $("#wpadminbar").length != 0 ) { // wpadminbar
                            menuSize = menuSize + 36;
                        }

                        //Set divPos to 0 becouse #home section is parallax and doesn not exist from page normally
                        if ( theID == '#home' ) {
                            divPos = 0;
                        }

                        if ( self.$body.hasClass('home') ) {
                            self.$ktHeader.find(".navigation li.current_page_item").removeClass("current_page_item");
                            $("aside.vertical_menu_area .vertical_menu_navigation ul li.current_page_item").removeClass("current_page_item");
                        }

                        if ( windowY >= (divPos - menuSize) && windowY < (divPos + divHeight - menuSize) ) {
                            self.$ktHeader.find(".navigation a[data-hash='" + theHash + "']").parent().addClass("active");
                            $("aside.vertical_menu_area nav.vertical_menu_navigation li a[data-hash='" + theHash + "']").parent().addClass("active");
                        } else {
                            self.$ktHeader.find(".navigation a[data-hash='" + theHash + "']").parent().removeClass("active");
                            $("aside.vertical_menu_area nav.vertical_menu_navigation li a[data-hash='" + theHash + "']").parent().removeClass("active");
                        }
                    }
                }
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*   Search form
        /*-----------------------------------------------------------------------------------*/

        searchForm: function () {
            var self = this,
                $searchButton = $('.search-button , .search-button .icon, .search-icon-link');

            if ( $searchButton.length <= 0 ) {
                return;
            }
            var $searchForm = $('form.searchform.popup');
            var $searchInput = $searchForm.find('input[type="text"]');
            var $catBox = $searchForm.find('div.nice-select');
            var $searchResults = $searchForm.find('.searchresults');
            var $showAllResults = $searchForm.find('.show_all_results');
            self.$document.on('click', function (e) {
                if ( !$(e.target).is($searchForm) && $searchForm.has(e.target).length == 0 ) {
                    if ( $(e.target).is($searchButton) ) {
                        e.preventDefault();
                        $('.search-form-cls').toggleClass('showing');
                        if (!$searchResults.hasClass('close')) {
                            $searchResults.css('display', 'block');
                            $showAllResults.css('display', 'block');
                        }
                        setTimeout(function () {
                            $searchInput.focus();
                            var tmpStr = $searchInput.val();
                            $searchInput.val('');
                            $searchInput.val(tmpStr);
                        }, 100);
                    } else {
                        $('.search-form-cls').removeClass('showing');
                        if ( !$searchResults.hasClass('close') ) {
                            $searchResults.css('display', 'none');
                            $showAllResults.css('display', 'none');
                        }
                    }
                } else {
                    if ( $(e.target).is($catBox) || $catBox.has(e.target).length != 0 ) {
                        if ( !$searchResults.hasClass('close') ) {
                            $searchResults.toggleClass('close');
                        }
                        if ( !$showAllResults.hasClass('close') ) {
                            $showAllResults.toggleClass('close');
                        }
                    }
                }
            });
            self.$document.on( 'keydown', function(e){
                if(e.key === "Escape") {

                    $('.search-form-cls').removeClass('showing');
                    if ( !$('.mobilesearchcats').hasClass('open') ) {
                        $('.responsive-whole-search-container').removeClass('open');
                    }
                    if ( !$searchResults.hasClass('close') ) {
                        $searchResults.css('display', 'none');
                        $showAllResults.css('display', 'none');
                    }
                }
            });
        },

        /*----------------------------------------------------------------------------------*/
        /*  Home parallax
        /*-----------------------------------------------------------------------------------*/

        sliderParallax: function () {

            var self = this;

            if ( $('.sliderParallax').length <= 0 || self.msie > 0 || !!self.msie11 ) {
                return;
            }

            if ( self.windowWidth > 1140 && !self.isTouchDevice && $("#home").length > 0 ) {

                self.windowHeight = self.$window.height();
                var $slider = $('#home .slider-wrap'),
                    $start = $slider.find('#caption-start'),
                    latestKnownScrollPosition = 0,
                    tick = false;

                var updateSliderPosition = function () {

                    //When element is out of viewport
                    if ( self.windowHeight < latestKnownScrollPosition ) {
                        tick = false;
                        return;
                    }

                    $slider.css({
                        'transform': 'matrix(1, 0, 0, 1, 0, ' + latestKnownScrollPosition * 0.6 + ')'
                    });

                    tick = false;
                }
                updateSliderPosition();
                var requestTick = function () {
                    if (tick == false) {
                        window.requestAnimationFrame(updateSliderPosition);
                    }
                    tick = true;
                }

                var onScroll = function () {
                    latestKnownScrollPosition = window.pageYOffset;
                    requestTick();
                }

                self.$window.on('scroll', onScroll);

                self.$window.one('djaxClick', function () {
                    self.$window.unbind('scroll', onScroll);
                });
            }

        },


        /*----------------------------------------------------------------------------------*/
        /*  Header transform
        /*-----------------------------------------------------------------------------------*/

        headerTransformation: function () {

            var self = this;

            var isFixedMenu = self.$ktHeader.data("fixed") === 'fixed-menu';

            if ((self.windowWidth > 1140 && isFixedMenu) || self.$body.hasClass('vertical_menu_enabled')) {
                return;
            }

            var latestKnownScrollPosition = 0,
                headerHeight = self.$ktHeader.find('#headerfirststate').outerHeight();

            var updateMenuState = function () {
                latestKnownScrollPosition = window.pageYOffset;
                // checking the state of mobile Header
                if ($('#mobile-header_secondstate').length != 0) {
                    if (130 > latestKnownScrollPosition) {
                        $('#mobile-header').removeClass('state2');
                        $('#mobile-header_secondstate').removeClass('state2');
                    } else {
                        $('#mobile-header').addClass('state2');
                        $('#mobile-header_secondstate').addClass('state2');
                    }
                }


                if ( headerHeight > latestKnownScrollPosition ) {
                    self.$ktHeader.removeClass('state2');
                    // If Search Resutl is open => close it
                    if ( $('#kt-header #headersecondstate .searchresults').length > 0 ) {
                        $('#kt-header #headersecondstate .searchresults').css('visibility', 'hidden');
                        $('#kt-header #headersecondstate .show_all_results').css('visibility', 'hidden');
                        $('#kt-header #headersecondstate .searchelements').removeClass('focus');
                        $('#headersecondstate .searchelements input').blur();
                    }
                    // If Category dropdown is open => close it
                    if ( $('#headersecondstate div.nice-select').hasClass('open') ) {
                        $('#headersecondstate div.nice-select').removeClass('open');
                    }
                } else {
                    self.$ktHeader.addClass('state2');
                    // If Search Resutl of first header sate is open => close it
                    if ( !$('#headerfirststate .searchresults').hasClass('close') ) {
                        $('#headerfirststate .searchresults').addClass('close');
                        $('#headerfirststate .show_all_results').addClass('close');
                        $('#headerfirststate .searchelements').removeClass('focus');
                        $('#headerfirststate .searchelements input').blur();
                    }
                    // If Category dropdown is open => close it
                    if ( $('#headerfirststate div.nice-select').hasClass('open') ) {
                        $('#headerfirststate div.nice-select').removeClass('open');
                    }
                    // If Search Resutl of second header state is open => close it
                    if ( $('#kt-header #headersecondstate .searchresults').length > 0 ) {
                        if ( !$('#kt-header #headersecondstate .searchresults').hasClass('close') ) {
                            $('#kt-header #headersecondstate .searchresults').css('visibility', 'visible');
                            $('#kt-header #headersecondstate .show_all_results').css('visibility', 'visible');
                        } else {
                            $('#kt-header #headersecondstate .show_all_results').addClass('close');
                            $('#kt-header #headersecondstate .searchresults').attr('style', '');
                            $('#kt-header #headersecondstate .show_all_results').attr('style', '');
                        }
                    }
                }

            }

            self.$window.on('scroll', updateMenuState);
            updateMenuState();

        },

        /*----------------------------------------------------------------------------------*/
        /*  top Button
        /*-----------------------------------------------------------------------------------*/

        scrollToTopButton: function () {
            var self = this;

            var $scrollToTop = $(".scrolltotop");

            if ( $scrollToTop.length <= 0 ) {
                return;
            }

            var latestKnownScrollPosition = 0,
                tick = false,
                visibilityThreshold = self.windowHeight * 1.7;

            //use unbind to prevent from multiple times clikc event
            $scrollToTop.find("a.scrolltop").unbind().click(function (e) {
                e.preventDefault();
                self.scrollTo("top", 3);  //scroll to top of page
            });

            var updateButtonVisibility = function () {

                if ( visibilityThreshold > latestKnownScrollPosition ) {
                    $scrollToTop.removeClass('visiblescrolltop');
                } else {
                    $scrollToTop.addClass('visiblescrolltop');
                }

                tick = false;
            }

            updateButtonVisibility();

            var requestTick = function () {
                if (tick == false) {
                    window.requestAnimationFrame(updateButtonVisibility);
                }
                tick = true;
            }

            var onScroll = function () {
                latestKnownScrollPosition = window.pageYOffset;
                requestTick();
            }

            self.$window.on('scroll', onScroll);
            self.$window.one('djaxClick', function () {
                self.$window.unbind('scroll', onScroll);
            });
        },

        /*----------------------------------------------------------------------------------*/
        /*  Gallery
        /*-----------------------------------------------------------------------------------*/

        galleryStart: function () {
            var self = this;

            if (typeof $.fn.lightGallery != 'function' || ! $('.kt_lightgallery').length ) {
                return;
            }

            $('.kt_lightgallery').each(function () {

                var $this = $(this);

                //Let the animation be set by the user
                var slideAnimation = $this.parent('.isotope').data('animation-type'),
                    galleryID = $this.attr('id'),
                    galleryThumbnail = $this.parent('.isotope').data('gallery-thumbnail');

                $this.lightGallery({
                    selector: '.galleryitem',
                    counter: true,
                    mode: slideAnimation,
                    speed: 400,
                    thumbnail: galleryThumbnail,
                    currentPagerPosition: 'middle',
                    galleryId: galleryID,
                    iframeMaxWidth: '80%'
                });

                $this.on('onBeforeOpen.lg', function (event) {
                    //detect if the gallery is of type light style
                    $(".isotope.lightPopUp").click(function () {
                        $('.lg').addClass('lightstyle');//when LightStyle is selected
                        $('.lg-backdrop.in').addClass('galleryback');
                    });
                });

                $this.on('onAfterOpen.lg', function (event) {
                    $(".isotope .isotope-item").click(function () {

                        // Add Class Active Gallery
                        $('.kt_lightgallery').removeClass('activeGallery');
                        $(this).parents('.kt_lightgallery').addClass('activeGallery');

                        //Calculating Social share information
                        var json = $.parseJSON($(this).find('.postphoto .galleryitem a.portfolioLink').data('social-share'));

                        //Adding socailshare to the image wrap
                        $(".lg-outer .bd_socail_share").remove();
                        $(".lg-outer .lg-toolbar.group .lg-autoplay-button").after(json);
                        $('.social_share_toggle').hover(function () {//social button animation
                            $('.social_share_toggle .social_links_list').toggleClass('opentoggle');
                        });

                        self.socialSharePopup();
                        self.$body.addClass('gl-open');

                    });

                });


                $this.on('onAfterAppendSubHtml.lg', function (event) {

                    // Update socailshare
                    var $index = $('.lg-inner .lg-item.lg-current').index();
                    //Calculating Social share information
                    var json = $.parseJSON($('.kt_lightgallery.activeGallery').find('.postphoto .galleryitem a.portfolioLink').eq($index).data('social-share'));
                    //Adding socailshare to the image wrap
                    $(".lg-outer .bd_socail_share").remove();
                    $(".lg-outer .lg-toolbar.group .lg-autoplay-button").after(json);
                    $('.social_share_toggle').hover(function () {//social button animation
                        $('.social_share_toggle .social_links_list').toggleClass('opentoggle');
                    });

                    self.socialSharePopup();

                    $('.lg-sub-html').children().show('opacity', 1);

                });

                $this.on('onBeforeClose.lg', function (event) {
                    self.$body.removeClass('gl-open');
                });

            });

        },

        getScrollBarWidth: function () {
            var self = this;

            var inner = document.createElement('p');
            inner.style.cssText = 'width: 100%; height: 200px;';

            var outer = document.createElement('div');
            outer.style.cssText = 'width: 200px; height: 150px; position:absolute; visibility:hidden; left:0px; top:0px; overflow:hidden;';
            outer.appendChild(inner);

            document.body.appendChild(outer);
            var w1 = inner.offsetWidth;
            outer.style.overflow = 'scroll';
            var w2 = inner.offsetWidth;
            if ( w1 == w2 ) {
                w2 = outer.clientWidth;
            }

            document.body.removeChild(outer);

            if ( (w1 - w2) > 0 ) { // Detect scrollbar width
                if (self.$body.height() > self.windowHeight) { // Detect if a page has a vertical scrollbar?
                    self.$body.addClass('has-scrollbar');

                    if ((w1 - w2) == 15) { // ios device
                        self.$body.addClass('scrollbarSize15');
                    } else if ((w1 - w2) == 17) { // chorme and firefox in windows
                        self.$body.addClass('scrollbarSize17');
                    } else if ((w1 - w2) == 12) { // edge in windows
                        self.$body.addClass('scrollbarSize12');
                    }
                }
            }
        },

        // cookies bar
        cookiesBar: function () {
            if (typeof Cookies === 'undefined') { // this is temperpry solution
                return false;
            }
            if ( $(window).width() > 1280 ) {
                $('.kt-cookies-bar').addClass('container');
            }

            if (Cookies.set('kt_cookies') == 'accepted') {
                return;
            }
            var $cookiesBar = $('.kt-cookies-bar');
            setTimeout(function () {
                $cookiesBar.addClass('bar-display');
                $cookiesBar.on('click', '.cookies-accept-btn', function (e) {
                    e.preventDefault();
                    acceptCookies();
                })
            }, 2500);

            var acceptCookies = function () {
                $cookiesBar.removeClass('bar-display').addClass('bar-hide');
                Cookies.set('kt_cookies', 'accepted', { expires: 60, path: '/' });

            };
        },

        mobileHeaderSearchButtonClick: function () {
            var self = this;
            if ( $(window).width() >= 1140 ) {
                return;
            }

            $('.kt-header-button.kt-search').each(function (index, el) {
                $(this).on('click', function () {
                    var $this = $(this);
                    $this.siblings('.responsive-whole-search-container').toggleClass('open');
                    $('.kt-header-builder-overlay').addClass('show');
                });
            });

            $(document).on('click', function (event) {
                if ( !$(event.target).parents('.responsive-whole-search-container').length && !$(event.target).parents('.search_icon, .kt-header-button.kt-search').length && $('.responsive-whole-search-container').hasClass('open') ) {
                    $('.responsive-whole-search-container').removeClass('open');
                    $('.kt-header-builder-overlay').removeClass('show');
                }
            });

            // Not run in marketplace header
            if ( !$('#mobile-header.style2').length ) {
                return;
            }

            $('.search_icon, .kt-header-button.kt-search').each(function (index, el) {
                var $this = $(this);
                $this.on('click', function () {
                    $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').toggleClass('open');
                    setTimeout( function(){
                        $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').find('.searchinput').focus();
                        // $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').find('.searchinput').click();
                    }, 500 );
                });

                $this.on('keyup', function (e) {
                    if ( e.keyCode === 13 ) {
                        $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').addClass('open');
                        setTimeout( function(){
                            $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').find('.searchinput').focus();
                            // $this.parent('.mobile-header-buttons').siblings('.responsive-whole-search-container').find('.searchinput').click();
                            self.trapNavigationInModal( false );
                        }, 500 );
                    }
                });
            });
        },
        sanitize: function(string) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#x27;',
                "/": '&#x2F;',
            };
            const reg = /[&<>"'/]/ig;
            return string.replace(reg, (match)=>(map[match]));
        },
        ajaxSearchFormSync: function ($element, $value) {
            if ( $element.parent().hasClass('firstStateSearchForm') ) {
                $('.secondstatesearchform .searchinput').val($value);
            } else if ( $element.parent().hasClass('secondstatesearchform') ) {
                $('.firstStateSearchForm .searchinput').val($value);
            }
        },
        ajaxSearchForm: function () {

            var self = this;
            var xhr = null;
            var $selectedCat = 'all';
            var $Cats;
            var $input = $('.searchinput');
            var $searchForm = $('.search-form-cls');
            var $searchInputWrapper = $('.search-inputwrapper');
            var $searchIcon = $('.search-container .searchicon, .widget-has-catlist .searchicon, .search-icon-link');
            self.mobileHeaderSearchButtonClick();

            $searchIcon.on('click', function (event) {
                $(this).parents('form').submit();
            });
            $searchIcon.on('keydown', function(event){
                if ( event.keyCode == 13 ) {
                    $(this).parents('form').submit();
                }
            });
            $('.searchresults, .searchcats,.searchcats span').on('click', function (e) {
                var $searchElements = $(this).closest('.search-container').find('.searchelements');
                if ( !$searchElements.hasClass('focus') ) {
                    $searchElements.addClass('focus');
                    $('.search-inputwrapper form').addClass('focus');
                }
            });
            $('.mobilesearchcats li.option').on('click', function (event) {
                event.preventDefault();
                $(this).parents('.search-container').find('.searchinput').attr('placeholder', 'Search in "' + $(this).text() + '"');
            });
            $('.mobilesearchcats').on('click', function () {
                if ( !$(this).parents('.search-inputwrapper').find('.searchresults').hasClass('close') ) {
                    $('.searchresults').addClass('close');
                    $('.show_all_results').addClass('close');
                }
            });
            $('.searchinput').on('click', function () {
                if (!$(this).parent('.searchelements').hasClass('focus')) {
                    $(this).parent('.searchelements').addClass('focus');
                    $(this).parents('form').addClass('focus');
                }
                if (!$('.mobile-sidebar-overlay').hasClass('open')) {
                    $('header#kt-header').addClass('z-index');
                    $('.mobile-sidebar-overlay').addClass('open');
                    $('body').addClass('kt-fix-responsive');
                }
                var $searchResults = $(this).closest('.search-container').find('.searchresults');
                var $showAllResults = $(this).closest('.search-container').find('.show_all_results');
                if ( $searchResults.find('.searchitem').length > 0 ) {
                    if ( $searchResults.hasClass('close') ) {
                        $searchResults.toggleClass('close');
                        $showAllResults.toggleClass('close');
                    }
                } else {
                    var histories = self.getSearchHistory( '', false ),
                        historyLength = ( typeof histories == 'undefined' ) ? 0 : ( histories.length >= 4 ? 4 : histories.length ),
                        $activeSearchResults = $(this).closest('.search-container').find('.searchresults');

                    if ( historyLength != 0 ) {
                        var historiesLink = '',
                            hostname = kite_theme_vars.url,
                            postType = $(this).parents('form').find("input[name='post_type']").val();

                        for ( var i=0; i < historyLength; ++i ) {
                            var url = self.updateQueryStringParameter( hostname, 's', histories[i] );
                            url = self.updateQueryStringParameter( url, 'post_type', postType);
                            historiesLink += '<div class="row"><span class="icon icon-history"></span><a href="' + url +'">' + histories[i] + '</a></div>';
                        }

                        if ( ! $activeSearchResults.find( '.searchitem' ).length ) {
                            $activeSearchResults.find('.kt-history').html( historiesLink );
                        }

                        $activeSearchResults.removeClass('close');
                    }
                }

            });

            $('body').click(function (e) {
                if (!$(e.target).is('.searchcats,.searchinput, .searchcats span, .searchresults, .show_all_results,.search-button')) {
                    $('.searchelements').removeClass('focus');
                    $('.mobile-sidebar-overlay').removeClass('open');
                    $('body').removeClass('kt-fix-responsive');
                    $('header#kt-header').removeClass('z-index');
                    $('.search-inputwrapper form').removeClass('focus');
                    if ($(this).closest('.search-container').find('.searchresults').hasClass('close')) {
                        $(this).closest('.search-container').find('.show_all_results').addClass('close');
                    }

                }
            });

            $('.show_all_results').on('click', function () {
                $(this).closest('.search-container').find('form').submit();
            });
            $('.search-inputwrapper .searchicon').on('click', function () {
                $(this).closest('.search-container').find('form').submit();
            });
            $input.on('keyup', function (e) {
                if ( e.keyCode == 27 ) {
                    return;
                } else if ( xhr ) {
                    xhr.abort();
                }
                var value = $(this).val();
                if ( value.indexOf('<script') == 0 || value.indexOf('<script') > 0 ) {
                    value = self.sanitize(value);
                }
                self.ajaxSearchFormSync($(this), value);
                var $searchResults = $('.searchresults');
                var $showAllResults = $('.show_all_results');
                var $search_container = $(this).closest('.search-container');
                var $activeSearchResults = $search_container.find('.searchresults');
                var $activeShowAllResults = $search_container.find('.show_all_results');

                var resultColumns = '';
                if ( $(this).closest('.search-container.search-element.columns-1, .search-container.search-element.columns-2, .search-container.search-element.columns-3').length ) {
                    if ( $search_container.hasClass('columns-1') ) {
                        resultColumns = 1;
                    } else if ( $search_container.hasClass('columns-2') ) {
                        resultColumns = 2;
                    } else {
                        resultColumns = 3;
                    }
                }

                $searchResults.each(function (index, el) {
                    if ($(this).find('.searchitem').length > 0) {
                        if ($(this).hasClass('close')) {
                            $(this).toggleClass('close');
                            $(this).closest('.search-container').find('.show_all_results').toggleClass('close');
                        }
                    }
                });
                $Cats = $(this).parents('.search-container').find('li.option');
                if ( $Cats.length > 0 ) {
                    $.each($Cats, function (index, val) {
                        if ($(this).hasClass('selected')) {
                            $selectedCat = $(this).attr('data-value');
                        }
                    });
                }
                var data = {
                    action: 'kite_ajax_search_action',
                    s: value,
                    cat: $selectedCat,
                    result_columns : resultColumns
                }
                if (value.length < 2) {
                    $(this).parent().find('.typing-indicator span').css('visibility', 'hidden');
                    $searchInputWrapper.find('.searchicon span.icon,.searchicon,form .searchicon span').removeClass('loading');

                    $searchResults.each(function (index, el) {
                        if ( !$(this).hasClass('close') ) {
                            $(this).addClass('close');
                            $(this).closest('.search-container').find('.show_all_results').addClass('close');
                        }
                        if ($(this).find('.searchitem').length > 0) {
                            $(this).find('.kt-result').html('');
                            $(this).find('.kt-result').removeClass('has-result');
                        }
                        // Removeing The Style that Created with jquery when toggling search Form overlay
                        // Refer to search_form Function
                        $(this).removeAttr('style');
                        $(this).closest('.search-container').find('.show_all_results').removeAttr('style');
                    });
                    $showAllResults.each(function (index, el) {
                        if ( !$(this).hasClass('close') ) {
                            $(this).addClass('close');
                        }
                    });
                } else {
                    // show search histories
                    var histories = self.getSearchHistory( value, false ),
                        historyLength = ( typeof histories == 'undefined' ) ? 0 : ( histories.length >= 4 ? 4 : histories.length );
                    if ( historyLength != 0 ) {
                        var historiesLink = '',
                            hostname = $('<a>').prop('href', url).prop('hostname'),
                            postType = $(this).parents('form').find("input[name='post_type']").val();

                        for ( var i=0; i < historyLength; ++i ) {
                            var url = self.updateQueryStringParameter( hostname, 's', histories[i] );
                            url = self.updateQueryStringParameter( url, 'post_type', postType);
                            historiesLink += '<div class="row"><span class="icon icon-history"></span><a href="' + url +'">' + histories[i] + '</a></div>';
                        }

                        if ( ! $activeSearchResults.find( '.searchitem' ).length ) {
                            $activeSearchResults.find('.kt-history').html( historiesLink );
                        }

                        $activeSearchResults.removeClass('close');
                    }

                    $(this).parent().find('.typing-indicator span').css('visibility', 'visible');
                    $searchInputWrapper.find('form .searchicon span.icon, form .searchicon, form .searchicon span').addClass('loading');
                    $showAllResults.each(function (index, el) {
                        if ($(this).hasClass('close')) {
                            $(this).removeClass('close');
                        }
                        $(this).html( kite_theme_vars.see_all_results + " <a href='#' class='productsearchlink'>" + value + "</a>")
                    });
                    xhr = $.ajax({
                        url: kite_theme_vars.ajax_url,
                        type: 'GET',
                        dataType: 'html',
                        data: data,
                    }).done(function (response) {
                        if ($(response).find('.searchitem').length > 0) {
                            self.addSearchHistory(value);
                            // Search Results Sync Between two state header
                            $searchResults.each(function (index, el) {
                                if ($(this).find('.searchitem').length > 0) {
                                    $(this).find('.kt-result').html('');
                                    $(this).find('.kt-result').removeClass('has-result');
                                }
                                $(this).find('.kt-history').html('');
                                $(this).find('.kt-result').html(response);
                                $(this).find('.kt-result').addClass('has-result');
                                self.lazyLoadOnLoad($(this));
                            });
                            // Toggling Search Result show for just the activated Input
                            if ($activeSearchResults.hasClass('close')) {
                                $activeSearchResults.removeClass('close');
                                $activeShowAllResults.removeClass('close');
                            }
                            self.trapNavigationInModal( false );
                        } else {
                            $searchResults.each(function (index, el) {
                                if (!$(this).hasClass('close')) {
                                    $(this).addClass('close');
                                }
                                if ($(this).find('.searchitem').length > 0) {
                                    $(this).find('.kt-result').html('');
                                }
                                // Removeing The Style that Created with jquery when toggling search Form overlay
                                // Refer to search_form Function
                                $(this).removeAttr('style');
                                $(this).closest('.search-container').find('.show_all_results').removeAttr('style');
                            });
                            $showAllResults.each(function (index, el) {
                                if ($(this).hasClass('close')) {
                                    $(this).removeClass('close');
                                }
                                $(this).html(response + "<a href='#' class='productsearchlink'> " + value + "</a>")
                            });
                            self.trapNavigationInModal( false );
                        }
                        $('.typing-indicator span').css('visibility', 'hidden');
                        $searchInputWrapper.find('.searchicon span.icon,.searchicon, form .searchicon span').removeClass('loading');

                    }).fail(function (response) {

                    }).always(function () {

                    });
                }
            });

            if ($('.search-container').find('li.option').length > 0) {
                $('.search-container').on('click', 'li.option', function (event) {
                    if (xhr) {
                        xhr.abort();
                    }
                    var $clickedCat = $(this);
                    var value = $clickedCat.closest('.search-container').find('input.searchinput').val();
                    if ( value.indexOf('<script') == 0 || value.indexOf('<script') > 0 ) {
                        value = self.sanitize(value);
                    }
                    var $activeSearchResults = $clickedCat.closest('.search-container').find('.searchresults');
                    var $activeShowAllResults = $clickedCat.closest('.search-container').find('.show_all_results');
                    var $searchResults = $('.searchresults');
                    var $showAllResults = $('.show_all_results');
                    var $selectedCat = $clickedCat.attr('data-value');
                    var $catsNiceSelect = $('.search-inputwrapper .nice-select');

                    // change category for non ajax search action
                    $clickedCat.closest('.search-container').find('input[name="cat"]').val( $selectedCat );

                    // Categories Sync between two state
                    if ( $catsNiceSelect.length > 0 ) {
                        $catsNiceSelect.each(function (index, el) {
                            if (!$(this).parents('.search-container').is($clickedCat.parents('.search-container'))) {

                                var $otherStateCats = $(this).find('li.option');
                                $otherStateCats.each(function (index, el) {
                                    if ($(this).hasClass('selected')) {
                                        $(this).removeClass('selected focus');
                                    }
                                    if ($(this).attr('data-value') == $selectedCat) {
                                        $(this).addClass('selected focus');
                                        $(this).closest('.nice-select').find('.current').text($(this).text());
                                    }
                                });
                            }
                        });
                    }
                    var data = {
                        action: 'kite_ajax_search_action',
                        s: value,
                        cat: $selectedCat,
                    }
                    if (value.length < 2) {
                        if ($(this).parents('form').hasClass('popup')) {
                            $searchForm.find('.typing-indicator span').css('visibility', 'hidden');
                        } else {
                            $searchInputWrapper.find('.searchicon span.icon,.searchicon, form .searchicon span').removeClass('loading');
                        }
                        $searchResults.each(function (index, el) {
                            if ( !$(this).hasClass('close') ) {
                                $(this).addClass('close');
                                $(this).closest('.search-container').find('.show_all_results').addClass('close');
                            }
                            if ( $(this).find('.searchitem').length > 0 ) {
                                $(this).find('.kt-result').html('');
                            }
                            // Removeing The Style that Created with jquery when toggling search Form overlay
                            // Refer to search_form Function
                            $(this).removeAttr('style');
                            $(this).closest('.search-container').find('.show_all_results').removeAttr('style');
                        });
                    } else {
                        $searchForm.find('.typing-indicator span').css('visibility', 'visible');
                        $searchInputWrapper.find('.searchicon span.icon,.searchicon, form .searchicon span').addClass('loading');
                        if (xhr) {
                            xhr.abort();
                        }
                        xhr = $.ajax({
                            url: kite_theme_vars.ajax_url,
                            type: 'GET',
                            dataType: 'html',
                            data: data,
                        }).done(function (response) {
                            if ($(response).find('.searchitem').length > 0) {
                                // Search Results Sync Between two state header
                                $searchResults.each(function (index, el) {
                                    if ($(this).find('.searchitem').length > 0) {
                                        $(this).find('.searchitem').remove();
                                    }
                                    $(this).find('.kt-history').html('');
                                    $(this).find('.kt-result').html(response);
                                    $(this).find('.kt-result').addClass('has-result');
                                    self.lazyLoadOnLoad($(this));
                                });
                                // Toggling Search Result show for just the activated Input
                                if ($activeSearchResults.hasClass('close')) {
                                    $activeSearchResults.removeClass('close');
                                    $activeShowAllResults.removeClass('close');
                                }
                            } else {
                                $searchResults.each(function (index, el) {
                                    if (!$(this).hasClass('close')) {
                                        $(this).addClass('close');
                                    }
                                    if ($(this).find('.searchitem').length > 0) {
                                        $(this).find('.kt-result').html('');
                                    }
                                    // Removeing The Style that Created with jquery when toggling search Form overlay
                                    // Refer to search_form Function
                                    $(this).removeAttr('style');
                                    $(this).closest('.search-container').find('.show_all_results').removeAttr('style');
                                });
                                $showAllResults.each(function (index, el) {
                                    if ($(this).hasClass('close')) {
                                        $(this).removeClass('close');
                                    }
                                    $(this).html(response + "<a href='#' class='productsearchlink'> " + value + "</a>")
                                });
                            }
                            $('.typing-indicator span').css('visibility', 'hidden');
                            $searchInputWrapper.find('.searchicon span.icon,.searchicon, form .searchicon span').removeClass('loading');
                        }).fail(function () {

                        });
                    }
                });
                self.$document.on('click', function (event) {

                    var $searchInputWrapper = $("#headerfirststate .search-inputwrapper,#mobile-header .search-inputwrapper, #kt-header.kt-elementor-template .search-inputwrapper");
                    if ( $searchInputWrapper.length > 0 ) {
                        if ($searchInputWrapper.has(event.target).length == 0 && !$searchInputWrapper.is(event.target)) {
                            $searchInputWrapper.each(function (index, el) {
                                if (!$(this).find('.searchresults').hasClass('close')) {
                                    $(this).find('.searchresults').addClass('close');
                                    $(this).find('.show_all_results').addClass('close');
                                }
                            });
                        } else {
                            if ($searchInputWrapper.find('.searchcats').is(event.target) || $searchInputWrapper.find('.searchcats').has(event.target).length > 0) {
                                $searchInputWrapper.each(function (index, el) {
                                    if (!$(this).find('.searchresults').hasClass('close')) {
                                        $(this).find('.searchresults').addClass('close');
                                        $(this).find('.show_all_results').addClass('close');
                                    }
                                });
                            }
                        }
                    }
                    var $searchInputWrapperSecondState = $("#headersecondstate .search-inputwrapper,#mobile-header_secondstate .search-inputwrapper");
                    if ( $searchInputWrapperSecondState.length > 0 ) {
                        if ($searchInputWrapperSecondState.has(event.target).length == 0 && !$searchInputWrapperSecondState.is(event.target)) {
                            $searchInputWrapperSecondState.each(function (index, el) {
                                if (!$(this).find('.searchresults').hasClass('close')) {
                                    $(this).find('.searchresults').addClass('close');
                                    $(this).find('.show_all_results').addClass('close');
                                }
                            });
                        } else {
                            if ($searchInputWrapperSecondState.find('.searchcats').is(event.target) || $searchInputWrapperSecondState.find('.searchcats').has(event.target).length > 0) {
                                $searchInputWrapperSecondState.each(function (index, el) {
                                    if (!$(this).find('.searchresults').hasClass('close')) {
                                        $(this).find('.searchresults').addClass('close');
                                        $(this).find('.show_all_results').addClass('close');
                                    }
                                });
                            }
                        }
                    }
                });
            }
        },
        addSearchHistory: function( search ) {
            if ( ! $('body').hasClass('kt-search-history') || search == 'undefined' ) {
                return;
            }
            var self = this;
            var history = Cookies.get('kt-search-history');
            if ( history != '' ) {
                if ( ! self.getSearchHistory( search, true ) ) {
                    history = history + '|' + search;
                }
            } else {
                history = search;
            }
            Cookies.set( 'kt-search-history', history, { expires: 30 } );
        },
        getSearchHistory: function ( search, same = false ) {
            if ( ! $('body').hasClass('kt-search-history') ) {
                return;
            }
            var history = Cookies.get('kt-search-history');
                var result = [];
                if( history == '' || typeof history == 'undefined' ) {
                    return;
                }

                var histories = history.split('|');
                // if search is empty return latest 4 history
                if ( search == '' ) {
                    var loopNum = histories.length >= 4 ? ( histories.length - 4 ) : 0;
                    for ( var i = histories.length - 1; i >= loopNum; --i ) {
                        if ( histories[i] != 'undefined' ) {
                            result.push( histories[i] );
                        }
                    }
                } else {
                    if ( same == true ) {
                        for(var i = 0; i < histories.length; ++i){
                            if ( histories[i] == search ) {
                                return true;
                            }
                        }
                        return false;
                    }
                    for(var i = 0; i < histories.length; i++){
                        if ( histories[i].includes(search) ) {
                            if ( histories[i] != 'undefined' ) {
                                result.push(histories[i]);
                            }
                        }
                    }
                }

                return result;
        },

        // popup newsletter
        popupNewsletter: function () {

            var $newsletterModal = $("#kt-popup-newsletter");
            var $newsletterClose = $(".kt-popup-newsletter-close");
            var $newsletterInner = $(".kt-popup-newsletter-inner");
			var $topbarNewsletter = $(".topbar_newsletter, .kt-header-button.kt-newsletter");
			var $delay = $newsletterInner.data('delay');
            if ( $delay == '' || !$.isNumeric($delay) ) {
                $delay = 1000;
            }

            if ($(window).width() < 1140 ) {
                $delay = 0;
            }

			var topbarNewsletter = function(){
                setTimeout(function(){
                    $newsletterModal.css({
						'height': '100%',
						'opacity':'1'});
					$newsletterInner.addClass('show_popup');
                },$delay);


				// When the user clicks anywhere outside of the modal or on the X button, close it
				$newsletterModal.click(function (event) {
					var target = $(event.target);
					if (target.is($newsletterModal) || target.is($newsletterClose)) {
						$newsletterInner.removeClass('show_popup');
						$newsletterModal.css({
							'height': '0',
							'opacity':'0'});
						Cookies.set('kt_popup_newsletter', 'dismiss', { expires: 60, path: '/'});
					}
				});
			}

			// When topbarNewsletter is clicked, open the newsletter modal
			$topbarNewsletter.click(function () {
				$delay = 100;
				topbarNewsletter(setTimeout(function(){
                    $newsletterModal.css({
						'height': '100%',
						'opacity':'1'});
					$newsletterInner.addClass('show_popup');
                },$delay - 50)
				);

			});

            if ( $newsletterModal ) {
                if ($newsletterModal.hasClass('hidden-phone') && self.windowWidth <= 768) {
                    return;
                } else {

                    if (Cookies.set('kt_popup_newsletter') == 'dismiss') {
                       $newsletterModal.css({
							'height': '0',
							'opacity':'0'});
                        return;
                    } else {
                        topbarNewsletter();
                    }
                }
                if ($('.kt-popup-newsletter-shortcode .kt-newsletter').length != 0 && $('.kt-popup-newsletter-shortcode .kt-newsletter').hasClass('fullwidth')) {
                    $('.kt-popup-newsletter-shortcode').addClass('fullwidth');
                }
            }

        },

        headerPromoBar: function () {
            var self = this;
            var $responsiveHeader = $(".header-banner");
            var $headerBannerClose = $(".close-header-banner");
            $responsiveHeader.css('display', 'none');
            if ( $responsiveHeader ) {

                if ( self.windowWidth <= 1024 ) {
                    var $responsiveHeader_height = $responsiveHeader.data("responsive-height");
                    $responsiveHeader.css('height', $responsiveHeader_height);
                }


                if ( Cookies.set('header-banner') == 'dismiss' ) {
                    $responsiveHeader.remove();
                    return;
                } else {

                    if ($('#wpadminbar').length) {
                        var wpAdminBarHeight = $('#wpadminbar').height();
                    } else {
                        var wpAdminBarHeight = 0;
                    }
                    $(window).on('load', function () {
                        $responsiveHeader.css('display', 'block');
                        var headerHeight = $responsiveHeader.height() + wpAdminBarHeight;
                        var headerTopbarHeight = $('#topbar').height() + headerHeight;
                        if ( $responsiveHeader.hasClass('fixed-menu') ) {
                            $('#topbar.fixed-menu').css('top', headerHeight);
                            $('#kt-header.fixed-menu , #kt-header.fixed-menu #headerfirststate').css('top', headerTopbarHeight);
                        }
                    });

                    // When the user clicks anywhere outside of the modal or on the X button, close it
                    $headerBannerClose.click(function (event) {
                        $responsiveHeader.css('display', 'none');
                        var topbarHeight = $('#topbar').height() + wpAdminBarHeight;
                        $('#topbar.fixed-menu').css('top', wpAdminBarHeight);
                        $('#kt-header.fixed-menu, #kt-header.fixed-menu #headerfirststate').css('top', topbarHeight);
                        $('#kt-header.kite-menu #headersecondstate').css({ 'top': wpAdminBarHeight, 'transition': 'top .3s ease' });
                        Cookies.set('header-banner', 'dismiss', { expires: 60, path: '/' });
                    });
                }
            }
        },

        /*Wordpress Admin bar position in screen smaller size than 600px is not fixed
        and we need to fix over header in in fixed mode state to the top of screen while
        user scrolling the page down*/
        checkHeader: function () {
            var self = this;
            if ($('#wpadminbar').length > 0) {
                var $wpAdminBarHeight = $('#wpadminbar').height();
                // Check Window Width for the first time or when window resized
                if ( self.windowWidth > 600 ) {
                    $('#kt-header.fixed-menu').attr("style", "");
                    $('#mobile-header_secondstate').css('top', $wpAdminBarHeight);
                }
            }
        },

        tabClick: function () {
            var self = this;
            $('.vc_tta-tabs-container ul li a').on('click', function () {
                if ($('div.infoonclick').length) {
                    $('div.infoonclick div').find('span.show-hover').off('click');
                    self.productsInfoOnClick();
                }
            });
        },

        //humburger menu
        humburgerMenuToggle: function () {
            var $humburgerMenu = $('aside.humburger_menu_area'),
                $header = $('#kt-header.fixed-menu.type10');

            $('.menu-toggle').on('click', function () {
                var $this = $(this);
                $this.toggleClass('open').removeClass('closed');
                $humburgerMenu.toggleClass('show');
                $header.toggleClass('open');
            });
        },

        humburgerMenuUpdate: function () {
            var $widget = $('.vertical_menu_navigation'),
                $list = $widget.find('ul.humburger_menu');
            if ( ! $widget.length ) {
                return;
            }
            $list.find('li.menu-item-has-children').each(function () {
                var $this = $(this);
                if ( $this.find('ul').length <= 0 ) {
                    return true;
                }

                if ( $this.hasClass('current-menu-ancestor') ) {
                    $this.append('<div class="cats-toggle toggle-active"></div>');
                } else {
                    $this.append('<div class="cats-toggle"></div>');
                }
            });

            if ( $list.find('li.current-menu-item').length > 0 ) {
                $list.find('li.current-menu-item').parents('ul').css("display", "block");
                $list.find('li.current-menu-item ul.sub-menu').css("display", "block");
                $list.find('.current-menu-item.current-menu-ancestor .cats-toggle').addClass('toggle-active');
            }
        },
        humburgerMenuNavigation: function () {
            var $widget = $('.vertical_menu_navigation'),
                $list = $widget.find('ul.humburger_menu'),
                time = 300;
            $list.on('click', '.cats-toggle', function () {
                var $btn = $(this),
                $li = $btn.parent('li');
                if ($li.hasClass('mega-menu-parent')) {
                    var $subList =  $li.find('> div.menu-item-wrapper > ul.sub-menu');
                } else {
                    var $subList =  $li.find('> ul.sub-menu');
                }

                if ($subList.hasClass('list-shown')) {
                    $btn.removeClass('toggle-active');
                    $subList.stop().slideUp(time, 'easeInOutCirc').removeClass('list-shown');
                } else {
                    $subList.parent().parent().find('> li > .list-shown').slideUp().removeClass('list-shown');
                    $subList.parent().parent().find('> li > .toggle-active').removeClass('toggle-active');
                    $btn.addClass('toggle-active');
                    $subList.stop().slideDown(time, 'easeInOutCirc').addClass('list-shown');
                }
            });
        },

        bottomNavbarHandler: function() {
            $(document).on( 'click', function(e){
                if ( ! $(e.target).parents('.navicons').length && ! $(e.target).is('.navicons') ) {
                    return;
                }

                var $navIcons = $(e.target).is('.navicons') ? $(e.target) : $(e.target).parents('.navicons');

                if ( $navIcons.hasClass('cart') && ! $(e.target).is('.cart-sidebarbtn') && ! $(e.target).is('.kt-header-button.kt-cart') ) {
                    $('.cart-sidebarbtn').click();
                }

                if ( $navIcons.hasClass('userAccount') && ! $(e.target).is('.login-link-popup') ) {
                    $('.login-link-popup').click();
                }
            });
        },

        selectElement: function() {
            $('.kt-select-element').each(function(){
                if ( $(this).data('action') == 'hover' ) {
                    $(this).hover(function () {
                            // over
                            $(this).addClass('open');
                        }, function () {
                            // out
                            $(this).removeClass('open');
                        }
                    );
                }
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Animation For Image & Text Shortcode
        /*-----------------------------------------------------------------------------------*/

        shortcodeAnimation: function () {
            var self = this,
                $shortcodes;

            var animateShortcodes = function (item) {
                var $this = item,
                    $delay = $this.attr('data-delay');

                if ( $this.attr('data-animation') != 'none' ) {

                    $this.css('transition-delay', $delay + 'ms');

                    $this.addClass('do_animate');

                    if ( $this.hasClass("counterbox") || $this.hasClass("piechartbox") || $this.hasClass("progress_bar") ) {

                        //Run Counter Box Animation along left animations
                        if ( $this.hasClass("counterbox") ) {
                            self.counterBoxAnimate($this);
                        }

                        //Run Pie Chart  Animation along left animations
                        if ( $this.hasClass("piechartbox") ) {
                            self.pieChartAnimate($this);
                        }

                        //Run Progress bar  Animation along left animations
                        if ( $this.hasClass("progress_bar") ) {
                            self.progressBarAnimate($this);
                        }
                    }

                }

            }

            var aniamteShortcodesInSnapToScroll = function () {
                var $activeSlide = $('div.kt-section.visible'),
                    $inactiveSlide = $('div.kt-section').not('.visible');

                if (self.isMobile() || self.isTablet()) {
                    $shortcodes = $activeSlide.find('.shortcodeAnimation:not(.no-responsive-animation)');
				} else {
                    $shortcodes = $activeSlide.find('.shortcodeAnimation');
				}

                $shortcodes.each(function () {
                    var $shortcode = $(this);
                    animateShortcodes($shortcode);
                });

                $inactiveSlide.find('.shortcodeAnimation').removeClass("do_animate");
            }


            if ( !self.$body.hasClass('snap-to-scroll') || (self.$body.hasClass('snap-to-scroll') && self.windowWidth <= 1140 ) ) {

                if (self.isMobile() || self.isTablet()) {
                    $shortcodes = $('.shortcodeAnimation:not(.no-responsive-animation)');
				} else {
                    $shortcodes = $('.shortcodeAnimation');
				}

                $shortcodes.waypoint({
                    handler: function () {
                        var $item = $(this.element);
                        animateShortcodes($item);
                        this.destroy();
                    },
                    offset: '90%'
                });

            } else {
                self.$document.on('snap_to_scroll_slide_end', function () {
                    aniamteShortcodesInSnapToScroll();
                });
                aniamteShortcodesInSnapToScroll();
            }
        },

        /*-----------------------------------------------------------------------------------*/
        /*  toggle - FAQ
        /*-----------------------------------------------------------------------------------*/

        faq: function () {

            var $faqContainers = $('.toggle_wrap');

            if ( !$faqContainers.length ) { 
				return; 
			}

            $faqContainers.each(function () {
                var $container = $(this),
                    $titles = $container.find('.wpb_toggle'),
                    $contents = $container.find('.toggle_content_wrap');

                if ( $container.hasClass('wpb_toggle_open') ) {
                    $contents.slideDown();
                } else {
                    $contents.slideUp();
                }

                $titles.off("click").on('click', function (e) {
                    var $this = $(this);

                    $this.toggleClass('wpb_toggle_title_active');
                    var $parent = $this.parent()

                    $parent.toggleClass('wpb_toggle_open');

                    if ($parent.hasClass('wpb_toggle_open')) {
                        $parent.find('.toggle_content_wrap').slideDown();
                    } else {
                        $parent.find('.toggle_content_wrap').slideUp();

                    }
                });
            });
        },

        // Social links 
        socialLink: function () {
            if ($('.woocommercepage').length == 0 && $('.social_share_toggle').parents('div.product').length == 0) {
                $('.social_share_toggle').find('.social_links_list').addClass('opentoggle');
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  socail share icon
        /*-----------------------------------------------------------------------------------*/

        socailshare: function () {
            // Google Plus like button
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        },

        /*-----------------------------------------------------------------------------------*/
        /*  social share's pop up 
        /*-----------------------------------------------------------------------------------*/

        socialSharePopup: function () {

            $(".social_links a, .socialshare-container a").click(function (e) {
                e.preventDefault();

                var $url = $(this).attr('href'),
                    $title = $(this).attr('title'),
                    newWindow = window.open($url, $title, 'height=300,width=600');

                if (window.focus) { 
                    newWindow.focus() 
                }
                return false;
            });
        },

        trapNavigationInModal: function( firstElementFocus = true ) {
            // add all the elements inside modal which you want to make focusable
            var  focusableElements =
            'button, [href], input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])';
            var $modal = $('.search-form-cls, .responsive-whole-search-container, .togglesidebar.sidebar-menu'); // select the modal by it's id

            if ( !$modal.length ) {
                return;
            }

            var checkFocusedElement = function( e, $firstFocusableElement, $lastFocusableElement ) {
                var isTabPressed = e.key === 'Tab' || e.keyCode === 9;

                if (!isTabPressed) {
                    return;
                }

                if (e.shiftKey) { // if shift key pressed for shift + tab combination
                    if (document.activeElement === $firstFocusableElement) {
                        $lastFocusableElement.focus(); // add focus for the last focusable element
                        e.preventDefault();
                    }
                } else { // if tab key is pressed
                    if (document.activeElement === $lastFocusableElement ) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
                        $firstFocusableElement.focus(); // add focus for the first focusable element
                        e.preventDefault();
                    }

                    if ( $(document.activeElement).parents('.searchcats').length ) {
                        $('.search-form-cls .searchcats li').removeClass('selected').removeClass('focus');
                        $(document.activeElement).parent('li').addClass('selected focus');
                    }
                }
            }

            $modal.each( function() {
                var $eachModal = $(this);
                var $focusableContent = $eachModal.find(focusableElements).filter(':visible');
                var $firstFocusableElement = $focusableContent.first()[0]; // get first element to be focused inside modal
                var $lastFocusableElement = $focusableContent.last()[0]; // get last element to be focused inside modal

                $eachModal.off( 'keydown' );
                $eachModal.keydown( function(e) {
                    checkFocusedElement( e, $firstFocusableElement, $lastFocusableElement )
                });
                if ( firstElementFocus && typeof $firstFocusableElement !== 'undefined' ) {
                    $firstFocusableElement.focus();
                }
            });
        },

    } );

} ).apply( this, [ window.kiteTheme, jQuery ] );


(function($){
    kiteTheme.documentHeight = kiteTheme.$document.height();
    kiteTheme.init();

    $(document).on( 'ready', function(){
        kiteTheme.onReady();
    });

    $(window).on( 'resize', function() {
        kiteTheme.updateDocHeight();
        kiteTheme.updateWinDimension();
        kiteTheme.minPageHeightSet();
        kiteTheme.nav();
        kiteTheme.checkHeader();
        kiteTheme.initSelectElements();
    })

    $(window).on('elementor/frontend/init', function () {

        // if (!elementorFrontend.isEditMode()) {
        //     return;
        // }


        $(window).on('load', function(){
            $(this).trigger('resize');
        });

        // elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
        //     if ($scope.find('.masonry-blog.isotope').length) {
        //         $(window).on('resize',function(){
        //             kiteTheme.kite_blogMasonry($scope);
        //         });
        //     }
        // });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-piechart.default', function ($scope) {
            kiteTheme.shortcodeAnimation( $scope );
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-image-carousel.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.lazyLoadOnHover($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products-by-attribute.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.lazyLoadOnHover($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-hand-picked-products.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.lazyLoadOnHover($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-ajax-woocommerce-products.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.lazyLoadOnHover($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-product-categories.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.isotopeAnimation($scope);
            kiteTheme.shortcodeAnimation();
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-single-product.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
        });
    });
})( jQuery );


/*! 
 * 
 * ================== assets/js/kite/woocommerce.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  Woocommerce
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var woocommerce = {

        initWoocommerce: function() {
            this.woocommerceCats();
            this.cartWidgetUpdate();
            this.wishlistWidgetUpdate();
            this.wishlistButton();
            this.wishlistRemove();
            this.addToCart();
            this.addToCartEvents();
            this.addToCartVariationGroup();
            this.wcNotices();
            this.updateNotices();
            this.runIsotopeInProducts();
            this.updateWidgetCartOnCartPage();
            this.miniCartQuantityUpdate();
            this.catWidgetUpdate();
            this.catWidget();
            this.sortingPopup();
            this.accountPopup();
            this.recentlyViewedSlider();
            this.productProgressBar();
            this.shopHistory();
            this.productQuantity();
        },

        woocommerceResizeEvent: function(){
            this.runIsotopeInProducts();
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Woocommerce categories
        /*-----------------------------------------------------------------------------------*/

        woocommerceCats: function () {
            var self = this;
            if ($(".product-category a").length <= 0) {
                return;
            }

            self.interactiveBackground( $('.product-category a') );
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product cart widget,Cart page
        /*-----------------------------------------------------------------------------------*/

        cartWidgetUpdate: function () {
            var self = this;

            $(".mini_cart_item a.remove").addClass('no_djax');
            self.$document.off("click", ".mini_cart_item a.remove").addClass('no_djax');//unbind all functions binded to click to prevent unwanted behaviors
            self.$document.on("click", ".mini_cart_item a.remove", function (e) {

                e.preventDefault();
                var $this = $(this);
                var $productKey = $(this).data("item-key");

                $this.closest('li').addClass('loading');
                $this.siblings('.wc-loading').removeClass('hide');

                // Ajax action
                $.ajax({
                    url: kite_theme_vars.ajax_url,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    headers: { 'cache-control': 'no-cache' },
                    data: {
                        'action': 'cart_remove_item',
                        'item_key': $productKey
                    },
                    success: function (response) {

                        if (response.status === '1') {
                            $this.siblings('.wc-loading').addClass('hide');
                            $this.addClass('removed').closest('li').addClass('removed').removeClass('loading');

                            // Update cart item count
                            $('.cartcontentscount, .kt-cart .kt-count').html(response.cart_count);
                            $('.kt-cart .kt-amount').html(response.cart_subtotal);

                            // Is the cart empty?
                            if (response.cart_count == 0) {
                                $('.widget_shopping_cart_content .cart_list').addClass('empty-cart');
                                $('.cart-bottom-box').addClass('hide');
                            } else {
                                // Update cart subtotal
                                $('.cart-bottom-box .amount').html($(response.cart_subtotal).html());
                                // @if PRO
                                if ( response.percentage !== undefined ) {
                                    if ( $('.kt-free-shipping-notice').length ) {
                                        $('.kt-free-shipping-notice').removeClass('kt-complete');
                                        $('.kt-free-shipping-notice').find('span.text').html(response.free_shipp_text);
                                        $('.kt-fill-free-shipping').css( 'width', response.percentage+'%');
                                    } else {
                                        var $free_notice_html = "<div class='kt-free-shipping-notice'><span class='kt-fill-free-shipping'></span><span class='icon icon-notification'></span><span class='text'>"+response.free_shipp_text+"</span></div>";
                                        $('.cart-bottom-box').prepend($free_notice_html);
                                        $('.kt-fill-free-shipping').css( 'width', response.percentage+'%');

                                    }
                                }
                                // @endif
                            }
                        }

                        // Wait 3 second to get chance of undoing item
                        setTimeout(function () {
                            if ($this.closest('li').hasClass('removed')) {
                                $this.closest('li').find('.undo').hide('slow');

                                //after removing item from cart sidebar in cart page, cart page should be refreshed
                                if (self.$body.hasClass('woocommerce-cart')) {
                                    $(document).trigger('wc_update_cart');
                                    $(document.body).trigger( 'removed_from_cart', null, null, $this );
                                }
                            }
                        }, 3100);

                        setTimeout(function () {
                            if ($this.hasClass('removed')) {
                                $this.closest('li').addClass('removed_completly');
                            }
                        }, 3500);

                        $(document).trigger('wc_cart_updated');

                    }
                });
            });

            var ajaxCompleteHandler = function (event, xhr, settings) {

                if ( settings.url.indexOf('undo_item') > 0 ) {
                    setTimeout(function () {
                        $(document.body).trigger('wc_fragment_refresh');
                    }, 50)

                }
            }

            $(document).ajaxComplete(ajaxCompleteHandler);

            $(".mini_cart_item a.undo").addClass('no_djax');//unbind all functions binded to click to prevent unwanted behaviors
            self.$document.off("click", ".mini_cart_item a.undo");//unbind all functions binded to click to prevent unwanted behaviors
            self.$document.on("click", ".mini_cart_item a.undo", function (e) {
                e.preventDefault();
                var $this = $(this),
                    $productKey = $(this).data("item-key");

                $this.closest('li').removeClass('removed').addClass('loading');
                $this.siblings('a.remove').removeClass('removed');
                $this.siblings('.wc-loading').removeClass('hide');

                // Ajax action
                $.ajax({
                    url: kite_theme_vars.ajax_url,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    headers: { 'cache-control': 'no-cache' },
                    data: {
                        'action': 'undo_removed_item',
                        'item_key': $productKey
                    },
                    success: function (response) {

                        if ( response.status === '1' ) {
                            $this.siblings('.remove').removeClass('removed').end().closest('li').removeClass('removed loading');
                            $this.siblings('.wc-loading').addClass('hide');

                            // Update cart item count & cart subtotal
                            $('.cartcontentscount, .kt-cart .kt-count').html(response.cart_count);
                            $('.kt-cart .kt-amount').html(response.cart_subtotal);
                            $('.cart-bottom-box .amount').html($(response.cart_subtotal).html());
                            $('.cart-bottom-box').removeClass('hide');

                            //after undoing item from cart sidebar in cart page, cart page should be refreshed
                            if ( self.$body.hasClass('woocommerce-cart') ) {
                                $(document).trigger('wc_update_cart');
                            }
                            $(document).trigger('wc_cart_updated');
                        }
                    }
                });
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product  wishlist widget
        /*-----------------------------------------------------------------------------------*/

        wishlistWidgetUpdate: function () {
            var self = this;
            //Update it when a product added or removed to/from wishlist
            self.$body.on('added_to_wishlist removed_from_wishlist', function () {
                $.ajax({
                    url: kite_theme_vars.ajax_url,
                    data: {
                        'action': 'get_wishlist_quantity',
                        'security': kite_theme_vars.nonce
                    },
                    method: 'GET',//Use get to retrive data from server faster
                    success: function (data) {
                        $(".wishlist-content div.wishlist-contentcount, .kt-header-button.kt-wishlist .kt-total").html(data['wishlist_count_products']);
                    }
                });

                var $clicked_add_to_wishlist = self.$document.find('.add_to_wishlist.adding');
                $clicked_add_to_wishlist.find('.wc-loading').addClass('hide');
                $clicked_add_to_wishlist.fadeOut(400).siblings('.wishlist-link').fadeIn(400);

                self.addToCart();
                self.minPageHeightSet();
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /* Wishlist remove item
        /*-----------------------------------------------------------------------------------*/
        wishlistButton: function () {
            var self = this;

            self.$document.on('click', '.add_to_wishlist', function () {
                if ($(this).hasClass('shop_wishlist_button') || $(this).hasClass('single_add_to_wishlist')) {
                    $(this).addClass('adding').find('.wc-loading').removeClass('hide');
                }
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /* Wishlist remove item
        /*-----------------------------------------------------------------------------------*/

        wishlistRemove: function () {
            var self = this;

            self.$document.on('click', '.remove_from_wishlist', function (e) {
                e.preventDefault();
                $(this).addClass('show-loading').find('.wc-loading').removeClass('hide');
            });
        },

        /*------------------------------------------------------------------------------*/
        /*  Add To Cart - Open Toggle Sidebar When click On Add to cart Buttons
        /*------------------------------------------------------------------------------*/

        addToCart: function () {

            if ( $('.kt-header-button.kt-cart .widget_shopping_cart_content').length && $(window).width() > 1024 ) {
                return;
            }

            var self = this,
                $toggleSidebarContainer = $('.toggle-sidebar-container:not(.filtersidebar)'),
                $cartSidebarContainer = $('.cart-sidebar-container');

            // Open the Toggle Sidebar When Click On Add To Cart Buttons
            self.$document.on('click', ".add_to_cart_button:not(.product_type_variable) , .single_add_to_cart_button", function (e) {
                //Ignore affilate products

                var $this = $(this);
                if (!$this.is('.ajax_add_to_cart')) {
                    $this.parents('form').submit();
                    return;
                }

                e.preventDefault();

				// for fixed add to cart in variable and grouped product detail - prevent Add to cart open
                if ( $(this).parent().parent('.fixed-add-to-cart-container').find('.go-to-add-to-cart').length || $(this).hasClass('disabled') ) { 
                    return 0;
                }

				// is quick view window first wait 300ms then close it and then open sidebar cart.
                if ( self.$body.hasClass('modal-open') ) {

                    setTimeout(function () {
                        self.closeQuickView();
                    }, 300);

                    if ( !self.$body.hasClass('vertical_menu_enabled:not(humburger_menu_enabled)') ) {

                        setTimeout(function () {

                            self.$ktHeader.addClass('sidebar-toggle-open');
                            $toggleSidebarContainer.addClass('sidebar-toggle-open');
                            $cartSidebarContainer.addClass('sidebar-toggle-open');
                            $('.kt-header-builder-overlay').addClass('show');
                            $('.cart-sidebarbtn').addClass('active');
                            $('.scrolltotop').addClass('toggleOpen');

                        }, 600);
                    }

                } else {

                    if ($(this).parent().parent('.fixed-add-to-cart-container').length) { // is quick view window first wait 300ms then close it and then open sidebar cart.

                        $('.fixed-add-to-cart-container .fixed-add-to-cart').addClass('toggleOpen');
                        $('.scrolltotop').addClass('toggleOpen');

                    }

                    if ( !self.$body.hasClass('vertical_menu_enabled') ) {
                        self.$ktHeader.addClass('sidebar-toggle-open');
                        $toggleSidebarContainer.addClass('sidebar-toggle-open');
                        $cartSidebarContainer.addClass('sidebar-toggle-open');
                        $('.kt-header-builder-overlay').addClass('show');
                        $('.cart-sidebarbtn').addClass('active');
                    }

                }
                $(document.body).on('added_to_cart', function () {
                    if ($(window).width() > 768) {
                        $this.closest('div.product:not(.parent_div_product)').find('.added_to_cart_icon').css({
                            opacity: '1',
                            visibility: 'visible'
                        });
                    }
                    $this.removeClass('added');
                    self.infoonhoverAndClickAddedToCart($this);
                    $this.closest('div.product:not(.parent_div_product)').trigger('mouseout');
                });

            });
        },

        /*------------------------------------------------------------------------------*/
        /*  product variation adding to cart
        /*------------------------------------------------------------------------------*/

        addToCartEvents: function () {
            var self = this;

            // Updating cart and show loading
            $(document.body).on('adding_to_cart', function () {
                $('.cart-sidebar-container .cartsidebarwrap').addClass('updatingcart');
            });

            $(document.body).on('added_to_cart', function () {
                $('.cart-sidebar-container .cartsidebarwrap').removeClass('updatingcart');
                $(document.body).trigger('wc_fragment_refresh');
                $('.cartButtonClicked').addClass('haveItemInCart');
                $('.cartButtonClicked').removeClass('cartButtonClicked');
                $('.haveItemInCart').find('.add_to_cart_button.product_type_variable').removeAttr('style');
                $('.haveItemInCart').find('.price:not(.simpleprice)').removeAttr('style');
                $('.haveItemInCart').find('.simpleAddToCart').attr('style', 'display : none !important');
                $('.haveItemInCart').find('.product-quantity').addClass('disable');
                $('.haveItemInCart').find('.simpleprice').attr('style', 'display : none !important');
                $('.haveItemInCart').find('input[type="radio"]').prop('checked', false);
            });
            self.$document.on('added_to_cart wc_cart_updated', function () {

                $(".mini_cart_item a.remove, .mini_cart_item a.undo").addClass('no_djax');
                if ( $('body').hasClass('woocommerce-checkout') ) {
                    $( 'body' ).trigger( 'update_checkout' );
                }
            });
        },
        addToCartVariationGroup: function () {
            var self = this;

            // Ajax variation Product - add to cart
            self.$document.on('click', 'table.variations button.single_add_to_cart_button, .single_add_to_cart_button.product_type_variable , .single_add_to_cart_button.product_type_grouped', function (e) {

                if ( !$(this).is('.ajax_add_to_cart') ) {
                    $(this).parents('form').submit();
                    return;
                }

                var b = this;
                e.preventDefault();
                // AJAX add to cart request
                var $thisButton = $(this);

                if ($thisButton.hasClass('disabled')) {
					return;
				}

                if ( $thisButton.hasClass('product_type_variable') || $thisButton.hasClass('product_type_grouped') || $thisButton.parent('table.variations') ) {

                    $thisButton.addClass('loading');

                    var $productForm = $thisButton.closest('form');

                    if ( !$productForm.length ) {
                        return;
                    }

                    var data = {
                        product_id: $productForm.find("input[name*='add-to-cart']").val(),
                        product_variation_group_data: $productForm.serialize() // get variation and Group value
                    };

                    // Trigger event
                    $(document.body).trigger('adding_to_cart', [$thisButton, data]);

                    // Ajax action
                    $.ajax({
                        type: "POST",
                        url: "?add-to-cart=" + data.product_id + "&kt-ajax-add-to-cart=1",
                        data: data.product_variation_group_data,
                        dataType: "html",
                        cache: false,
                        headers: { 'cache-control': 'no-cache' },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                        },
                        success: function (response) {

                            if (!response) {
                                return;
                            }

                            if (response.error && response.product_url) {
                                window.location = response.product_url;
                                return;
                            }

                            // Redirect to cart option
                            if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {

                                window.location = wc_add_to_cart_params.cart_url;
                                return;

                            } else {

                                $(".widget_shopping_cart_content").html(response)
                                var $response = $(".widget_shopping_cart_content");

                                // Get replacement elements/values
                                var fragments = {
                                    ".cartcontentscount": $response.find(' .cartcontentscount'), // Count Of Items in Cart
                                    ".cart-bottom-box": $response.find('.cart-bottom-box'), // Count Of Items in Cart
                                    ".product_list_widget": $response.find('.product_list_widget'), // Cart items Detail
                                    ".wc-notice-content": $response.first().find('.woocommerce-error, .woocommerce-message') // Cart items Detail
                                };

                                // Replace elements
                                $.each(fragments, function (selector, $element) {
                                    if ($element.length) {
                                        $(selector).each(function () {
                                            if ($(this).parents('.widget_shopping_cart_content').length) { // Check Only Replace ( Update ) Dom in the Cart Sidebar
                                                $(this).replaceWith($element);
                                            }
                                        });
                                    }
                                });

                                // Update Cart Count in the Menus
                                $(".widget_woocommerce-dropdown-cart .cart-contents .cartcontentscount").replaceWith('<div class="cartcontentscount">' + $response.find('.cartcontentscount').text() + '</div>');
                                $('.kt-cart .kt-count').html( $response.find('.cartcontentscount').text() );

                                // wait All Replace Elemets Complete then trigger added_to_cart ( cause Fading Effect seen )
                                setTimeout(function () {
                                    $(document.body).trigger("added_to_cart", fragments, null, $thisButton);
                                    $thisButton.removeClass('loading');
                                    $thisButton.removeClass('added');
                                }, 100);
                            }
                        }
                    });

                    return false;
                }

                return true;
            });
        },
        /*------------------------------------------------------------------------------*/
        /*  Notices : accoutnt pag and form validation of checkout field are ignored
        /*------------------------------------------------------------------------------*/
        wcNotices: function () {
            var self = this;
            if ( self.$body.hasClass('no_wc_notices') ) {
                return;
            }

            /* Detect notices on adding simple product to cart */
            self.$body.on('added_to_cart', function (event, fragments) {

                // update cart element count and subtotal
                if ( typeof fragments != 'undefined' && fragments['div.widget_shopping_cart_content'] != 'undefined' ) {
                    var _cart_count = $(fragments['div.widget_shopping_cart_content']).find('.cartcontentscount').html();
                    var _cart_subtotal = $(fragments['div.widget_shopping_cart_content']).find('.total .woocommerce-Price-amount.amount').html();

                    $('.kt-cart .kt-count').html( _cart_count );
                    $('.kt-cart .woocommerce-Price-amount.amount').html( _cart_subtotal );
                }

                if ( fragments === undefined || (fragments["div.widget_shopping_cart_content"] === undefined && $(fragments[".wc-notice-content"]).length <= 0) ) {

				}
                    

                var replacedBefore = false;

                var $returnedMessage = $(fragments["div.widget_shopping_cart_content"]).find('.woocommerce-error, .woocommerce-message');

                if ($(fragments[".wc-notice-content"]).length > 0)
                    replacedBefore = true;

                //check existance of new notice
                if ($returnedMessage.length > 0 || replacedBefore == true) {
                    self.updateNotices($returnedMessage, replacedBefore);
                }

            });

        },

        updateNotices: function ($wcNoticesInCart, replacedBefore) {
            var self = this,
                $wcNoticesContainer = $('#kt_wc_notices');

            setTimeout(function () {

                if (replacedBefore == true) {
                    $wcNoticesContainer.wrapInner('<div class="wc-notice-content"></div>');
                } else {
                    $wcNoticesContainer.html($wcNoticesInCart);
                }

                $wcNoticesContainer.addClass('show');
                self.wcNoticeTimer = setTimeout(function () {
                    $wcNoticesContainer.removeClass('show');
                }, 6000);

            }, 470)
        },

        /*----------------------------------------------------------------------------------*/
        /*  products isotope
        /*-----------------------------------------------------------------------------------*/

        runIsotopeInProducts: function ($mainContainer) {
            var self = this;
            // Gets column number and divides to get column width

            if ($mainContainer === undefined)
                $mainContainer = self.$body;

            //WC shortcodes + main shop page loop
            $mainContainer.find('.woocommerce.wc-shortcode:not(.carousel) .products, .products.main-shop-loop').each(function () {
                var $container = $(this);
                //Reset width to calculate colWidth correctly in resize
                $container.css('width', '');
                var layout = 'fitRows';

                if ($container.is('.main-shop-loop')) {
                    layout = $container.data('layoutmode');
                } else {
                    layout = $container.parent().data('layoutmode');
                }

                if (layout != 'fitRows') {
                    layout = 'masonry';
                }

                if ($container.parents('.woocommerce.wc-shortcode.list').length == 0) {
                    // fix isotop masonry layout not runs in first load but run in resize or click load more button
                    var itemsGutter = ( $container.parents('.woocommerce.wc-shortcode.no-gutter').length || ( $('body.woocommerce.no-gutter').length && $container.parents('.wc-ajax-content').length ) ) ? 0 : 10;
                    $container.isotope({
                        itemSelector: '.product',
                        layoutMode: layout,
                        [layout]: {
                            gutter: itemsGutter
                        },
                        originLeft: ( ! $('body').hasClass('rtl') )
                    }, self.showAnimation($container));
                } else {
                    self.showAnimation($container);
                }

            });
        },

        /*----------------------------------------------------------------------------------*/
        /*  Show minicart | Show cart on sidebar when go to page with ajax | Code : cart-fragments.js in woocommerce plugin
        /*-----------------------------------------------------------------------------------*/
        updateWidgetCartOnCartPage: function () {
            var self = this;
            //Use ajaxSend event to detect when it's needed to update cart
            var ajaxStartHandlerForCartPage = function (event, xhr, settings) {
                if (settings.url.indexOf('get_cart_totals') > 0) {
                    $(document.body).trigger('wc_fragment_refresh');
                }
            }

            // just do it in cart page
            if ( self.$body.hasClass('woocommerce-cart') ) {
                $(document).ajaxSend(ajaxStartHandlerForCartPage);
            }
        },

        miniCartQuantityUpdate: function () {
            var sendParam;
            $(document).on('click', '.kt-quantity-change .icon', function(){
                var $this = $(this);
                var itemKey = $this.parents('li').data('item-key'),
                    min = $this.parents('li').data('min'),
                    max = $this.parents('li').data('max'),
                    $quantityWrapper = $this.parents('.quantity');
                if ( ! $quantityWrapper.length || $this.parents('li').hasClass('loading') ) {
                    return;
                }

                var currnetQuantity = parseInt( $quantityWrapper.find('.kt-num').first().text() );
                var newQuantity = 0;
                max = ( max == -1 ) ? Infinity : max;
                if ( $this.hasClass('kt-plus') && currnetQuantity < max ) {
                    newQuantity = ++currnetQuantity;
                    $quantityWrapper.find('.kt-num').text( newQuantity );
                    clearTimeout( sendParam );
                }

                if ( $this.hasClass('kt-minus') && currnetQuantity > min ) {
                    newQuantity = --currnetQuantity;
                    $quantityWrapper.find('.kt-num').text( newQuantity );
                    clearTimeout( sendParam );
                }

                if ( newQuantity == 0 ) {
                    return;
                }

                sendParam = setTimeout( function(){
                    $this.parents('li').addClass('loading');
                    $this.parents('li').find('.wc-loading').removeClass('hide');
                    // Ajax action
                    $.ajax({
                        url: kite_theme_vars.ajax_url,
                        dataType: 'json',
                        type: 'POST',
                        cache: false,
                        headers: { 'cache-control': 'no-cache' },
                        data: {
                            'action': 'update_mini_cart_item',
                            'item_key': itemKey,
                            'quantity': newQuantity
                        },
                        success: function (response) {
                            $this.parents('li').removeClass('loading');
                            $this.parents('li').find('.wc-loading').addClass('hide');
                            if (response.status === '1') {

                                // Update cart item count
                                $('.cartcontentscount, .kt-cart .kt-count').html(response.cart_count);
                                $('.kt-cart .kt-amount').html(response.cart_subtotal);
                                // Is the cart empty?
                                if (response.cart_count == 0) {
                                    $('.product_list_widget').each(function () {
                                        $('.cart-bottom-box').addClass('hide');
                                    });
                                } else {
                                    // Update cart subtotal
                                    $('.cart-bottom-box .amount').html($(response.cart_subtotal).html());
                                    // @if PRO
                                    if ( response.percentage !== undefined ) {
                                        if ( $('.kt-free-shipping-notice').length ) {
                                            $('.kt-free-shipping-notice').removeClass('kt-complete');
                                            $('.kt-free-shipping-notice').find('span.text').html(response.free_shipp_text);
                                            $('.kt-fill-free-shipping').css( 'width', response.percentage+'%');
                                        } else {
                                            var $free_notice_html = "<div class='kt-free-shipping-notice'><span class='kt-fill-free-shipping'></span><span class='icon icon-notification'></span><span class='text'>"+response.free_shipp_text+"</span></div>";
                                            $('.cart-bottom-box').prepend($free_notice_html);
                                            $('.kt-fill-free-shipping').css( 'width', response.percentage+'%');

                                        }
                                    }
                                    // @endif
                                }
                                $(document).trigger('wc_cart_updated');
                            }

                        }
                    });
                },1500);
            });
        },

        catWidgetUpdate: function () { //add toggle button to category widget + show current category/subcategory
            var $widget = $('.widget_product_categories'),
                $list = $widget.find('.product-categories');

            if ( ! $list.find('.cat-parent').length ) {
               return;
            }

            $list.find('.cat-parent').each(function () {
                var $this = $(this);
                if ( $this.find('ul').length <= 0 ) {
                    return true;
                }

                if ($this.hasClass('current-cat-parent')) {
                    if ( $this.find('.cats-toggle').length ) {
                        $this.find('.cats-toggle').addClass('toggle-active');
                    } else {
                        $this.append('<div class="cats-toggle toggle-active"></div>');
                    }
                } else {
                    if (!$this.find('.cats-toggle').length) {
                        $this.append('<div class="cats-toggle"></div>');
                    }
                }
            });


            if ( $list.find('li.current-cat').length > 0 ) {
                $list.find('li.current-cat').parents('ul').css("display", "block");
                $list.find('li.current-cat ul.children').css("display", "block");
                $list.find('.current-cat.cat-parent .cats-toggle').addClass('toggle-active');
            }
        },

        catWidget: function () {
            var $widget = $('.widget_product_categories'),
                $list = $widget.find('.product-categories'),
                time = 500;
            $list.off('click','.cats-toggle');
            $list.on('click', '.cats-toggle', function () {
                var $btn = $(this),
                    $subList = $btn.prev();
                if ($subList.hasClass('list-shown')) {
                    $btn.removeClass('toggle-active');
                    $subList.stop().slideUp(time).removeClass('list-shown');
                }
                else {
                    $subList.parent().parent().find('> li > .list-shown').slideUp().removeClass('list-shown');
                    $subList.parent().parent().find('> li > .toggle-active').removeClass('toggle-active');
                    $btn.addClass('toggle-active');
                    $subList.stop().slideDown(time).addClass('list-shown');
                }
            });
        },

        sortingPopup: function () {
            var self = this,
                $sort = $('.navicons.sorting');
            $sort.on('click', function (e) {
                e.preventDefault();

                var $sortModal = self.$document.find('#kt-modal'),
                    $sortHead = $sortModal.find('.modal-head'),
                    $sortContent = $sortModal.find('#modal-content');

                if ( $sortModal.length <= 0 ) {
                    return;
                }

                $sortModal.addClass('hidden-nav');

                self.$body.addClass('modal-open'); // disable scrollbar
                $sortModal.addClass('sort-modal');
                $sortHead.append('<div class="title">' + kite_theme_vars.sort_by_text + '</div>');

                if ( !$sortModal.removeClass('closed').hasClass('open') ) {
                    $sortModal.removeClass('loading').addClass('open');
                }


                var $data = $('.shop-filter > .special-filter.sort ul.list').clone();

                $sortContent.html($data);
                // content is ready, so show it
                $sortModal.addClass('shown');

                // Close quickview by click outside of content
                $sortModal.on('click', function (e) {
                    if (!$sortContent.is(e.target) && $sortContent.has(e.target).length === 0) {
                        self.closeSortPopup();
                    }
                });

                // Close quickview by click close button
                self.$document.on('click', '#kt-modal.sort-modal #modal-close', function (e) {
                    e.preventDefault();
                    self.closeSortPopup();
                });

                // Close box with esc key
                self.$document.keyup(function (e) {
                    if (e.keyCode === 27) {
                        self.closeSortPopup();
                    }
                });

            });
        },
        closeSortPopup: function () {
            var self = this;

            var $sortModal = self.$document.find('#kt-modal.sort-modal'),
                $sortTitle = $sortModal.find('.modal-head .title'),
                $sortContent = $sortModal.find('#modal-content');

            $sortModal.removeClass('shown loading open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $sortTitle.remove();
                $sortModal.removeClass('sort-modal');
            }, 0)

            setTimeout(function () {
                $sortContent.html('');
            }, 10);
        },
        accountPopup: function () {
            var self = this,
                $accountLink = $('.login-link-popup'),
                $topBarLoginLink = $('.topbar_login_link, .kt-header-button.kt-account');
            $topBarLoginLink.on('click', function (event) {
                $(this).toggleClass('hover');
            });
            $accountLink.on('click', function (e) {
                e.preventDefault();

                var $accountModal = self.$document.find('#kt-modal'),
                    $accountContent = $accountModal.find('#modal-content');

                if ( $accountModal.length <= 0 ) {
                    return;
                }


                $accountModal.addClass('hidden-nav');

                self.$body.addClass('modal-open'); // disable scrollbar
                $accountModal.addClass('account-modal');

                if ( !$accountModal.removeClass('closed').hasClass('open') ) {
                    $accountModal.removeClass('loading').addClass('open');
                }


                var $data = $('#customer_login.hide-login').clone().removeClass('hide-login');

                $accountContent.html($data);
                $accountModal.addClass('shown'); // content is ready, so show it


                // Close quickview by click outside of content
                $accountModal.on('click', function (e) {
                    if (!$accountContent.is(e.target) && $accountContent.has(e.target).length === 0) {
                        self.closeAccountPopup();
                    }
                });

                // Close quickview by click close button
                self.$document.on('click', '#kt-modal.account-modal #modal-close', function (e) {
                    e.preventDefault();
                    self.closeAccountPopup();
                });

                // Close box with esc key
                self.$document.keyup(function (e) {
                    if (e.keyCode === 27) {
                        self.closeAccountPopup();
                    }
                });

            });

        },
        closeAccountPopup: function () {
            var self = this;

            var $accountModal = self.$document.find('#kt-modal.account-modal'),
                $accountContent = $accountModal.find('#modal-content');

            $accountModal.removeClass('shown loading open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $accountModal.removeClass('account-modal');
            }, 300)

            setTimeout(function () {
                $accountContent.html('');
            }, 300);
        },

        recentlyViewedSlider: function () {
            $('.showrecentproduct').on('click', function (event) {
                if ($('.showrecentproduct').hasClass('disable')) {
                    $('.showrecentproduct').removeClass('disable');
                    $('.showrecentproduct').addClass('enable');
                    $('.showrecentproduct').find('i').removeClass('up');
                    $('.showrecentproduct').find('i').addClass('down');
                    $('.recentproduct.overlay').addClass('show');
                    $('.recentproduct.products').addClass('show');
                } else {
                    $('.showrecentproduct').removeClass('enable');
                    $('.showrecentproduct').addClass('disable');
                    $('.showrecentproduct').find('i').removeClass('down');
                    $('.showrecentproduct').find('i').addClass('up');
                    $('.recentproduct.overlay').removeClass('show');
                    $('.recentproduct.products').removeClass('show');
                }
            });

            var numOfItems = $('.viewed-products').attr('data-num-of-prd');
            if ( numOfItems > 10 ) {
                var loop = true;
            } else {
                var loop = false;
            }

            var $recentproductNum = 10;

            var $nextButton = $('.viewed-products').find('.arrow-button-next'),
                $prevButton = $('.viewed-products').find('.arrow-button-prev');
            var loop = false;
            if ( $('.viewed-products').hasClass('single-product') ) {
                var $recentproductNum = 5;
                if ( numOfItems > 5 ) {
                    loop = true;
                    if ($(window).width() > 480 && numOfItems < 6) {
                        $nextButton.remove();
                        $prevButton.remove();
                        $nextButton = '';
                        $prevButton = '';
                    }
                }
            } else {
                var $recentproductNum = 10;
                if ( numOfItems > 10 ) {
                    loop = true;
                    if ( $(window).width() > 480 && numOfItems < 10 ) {
                        $nextButton.remove();
                        $prevButton.remove();
                        $nextButton = '';
                        $prevButton = '';
                    }
                }
            }
            var swiper = new Swiper('.recently-viewed-product', {
                autoplay: false,
                spaceBetween: 13,
                loop: loop,
                slidesPerView: $recentproductNum,
                navigation: {
                    nextEl: $nextButton,
                    prevEl: $prevButton,
                },
                // Responsive breakpoints
                breakpoints: {
                    // when window width is <= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    // when window width is <= 480px
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    767: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1140: {
                        slidesPerView: 6,
                        spaceBetween: 20
                    },
                },
            });
            var swiper = new Swiper('.recently-viewed-product-style', {
                autoplay: false,
                spaceBetween: 4,
                loop: loop,
                slidesPerView: $recentproductNum,
                navigation: {
                    nextEl: $nextButton,
                    prevEl: $prevButton,
                },
                // Responsive breakpoints
                breakpoints: {
                    // when window width is <= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    // when window width is <= 480px
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 5
                    },
                    767: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1140: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                },
            });
            // hide recently viewed products when clicking on overlay
            $('.recentproduct.overlay').on('click', function (event) {
                $('.showrecentproduct').trigger('click');
            });
            // hide recently viewed products when reaching to the footer
            $(window).scroll(function () {
                var $docViewTop = $(window).scrollTop();
                var $docViewBottom = $docViewTop + $(window).height();
                var $elementTop = $('.footer-bottom, div[data-elementor-type="footer"]').offset().top;
                if ($docViewBottom >= $elementTop) {
                    if (!$('.showrecentproduct').hasClass('disable')) {
                        $('.showrecentproduct').trigger('click');
                    }
                    $('.showrecentproduct').hide();
                    if ($('.footer-bottom').hasClass('light')) {
                        $('.scrolltotop a').addClass('dark');
                    }
                } else {
                    $('.showrecentproduct').show();
                    $('.scrolltotop a').removeClass('dark');
                }
            });
        },

        productProgressBar: function () {
            var $barWidth = $('.progress-bar'),
                $productSummary = $('.summary.entry-summary');
            function barWidth() {
                var barWidth = $barWidth.width();
                $('.progress-fill-text').css('width', barWidth);
            }
            if ( $productSummary.length != 0 ) {
                barWidth();
            }
            $barWidth.each(function () {
                var $width = $(this).width();
                $(this).find('.progress-fill-text').css('width', $width);
            });
        },

        //a helper function to add/update querystrings of URL
        updateQueryStringParameter: function (uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if ( uri.match(re) ) {
                if ( value == '' ) {
                    return uri.includes('?') ? uri.replace(re, '?') : uri.replace(re, '');
                } else {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                }
            } else if ( value != '' ) {
                return uri + separator + key + "=" + value;
            }
        },

        shopHistory: function() {
            var self = this,
                thisUrl = window.location.href;

            if ( $('body.is-woocommerce-shop').length || $('body.archive.tax-product_cat').length || $('body.archive.tax-product_tag').length ) {
                thisUrl = self.updateQueryStringParameter( thisUrl, 'sp', '');
                window.history.replaceState({ 'url': thisUrl, 'title': '' }, '', thisUrl);
                $(document).on('click', function(e){
                    if ( $(e.target).parents('.product').length ) {
                        $(window).on('beforeunload',function(){
                            var thisUrl = window.location.href;
                            thisUrl = self.updateQueryStringParameter( thisUrl, 'sp', 'infinite_scroll');
                            window.history.replaceState({ 'url': thisUrl, 'title': '' }, '', thisUrl);
                        });
                    } else {
                        $(window).off('beforeunload');
                    }
                });
            }
        },

        /*-----------------------------------------------------------------------------------*/
        /*  woocomerce -  product quantity input
        /*-----------------------------------------------------------------------------------*/

        productQuantity: function () {
            var self = this;

            self.$document.on("click", '.quantity .quantity-button', function () {
                var min = 0,
                    max = 0,
                    step = 1 ;

                if ( $(this).parent( '.quantity').find('input.qty').attr('min') !== '' ) {
                    min = $(this).parent( '.quantity').find('input.qty').attr('min')
                }

                if ( $(this).parent( '.quantity').find('input.qty').attr('max') !== '' ) {
                    max = $(this).parent( '.quantity').find('input.qty').attr('max')
                }

                if ( $(this).parent( '.quantity').find('input.qty').attr('step') !== '' ) {
                    step = $(this).parent( '.quantity').find('input.qty').attr('step')
                }

                var $button = $(this);
                var $quantityInput = $(this).parent( '.quantity').find('input.qty');


                var oldValue = $quantityInput.val();
                oldValue = ( oldValue == '' || isNaN(oldValue) ) ? 0 : oldValue;
                var newVal = oldValue;
                if ( $button.hasClass("plus") ) {
                    if ( max == 0 || ( parseFloat(oldValue) + parseFloat(step) ) <= max ) {
                        newVal = parseFloat(oldValue) + parseFloat(step);
                    }
                } else {
                    if (oldValue > 0) {
                        if ( min == 0 || ( parseFloat(oldValue) - parseFloat(step) ) >= min ) {
                            newVal = parseFloat(oldValue) - parseFloat(step);
                        }
                    }
                }
                if ( newVal !== oldValue ) {
                    $quantityInput.val(newVal).trigger('change');
                }

            });

            $(document).on('change', '.woocommerce .quantity input[type="number"]', function () {
                $(this).parent('.quantity').siblings('.add_to_cart_button').attr('data-quantity', $(this).val());
            });
        },
    };

    kiteTheme = Object.assign( kiteTheme, woocommerce );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.initWoocommerce();
    $(window).on( 'resize', function(){
        kiteTheme.woocommerceResizeEvent();
    });

    $('body').on('woocommerce-content-updated', function () { 
        kiteTheme.runIsotopeInProducts();
    });

    $(window).on('elementor/frontend/init', function () {

        if ($('.kt_product_page').length) {
            if ($('.descriptionTab').find('section.elementor-section-stretched').length) {
                $('.descriptionTab').removeClass('container');
                $('.woocommerce-Tabs-panel').css('padding', '0');
                $('.descriptionTab').find('section').each(function () {
                    if (!$(this).hasClass('elementor-section-stretched')) {
                        $(this).addClass('container');
                        $(this).css('padding', '20px 0px');
                    }
                });
            }
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-ajax-woocommerce-products.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
            kiteTheme.productProgressBar();
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products-by-attribute.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-hand-picked-products.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-product-categories.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-single-product.default', function ($scope) {
            kiteTheme.runIsotopeInProducts($scope);
        });
    });
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/single-product-common.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  Single Product
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var singleProductCommonFunctions = {

        initCommonSingleProduct: function() {
            this.productThumbnails();
            this.productVariation();
            this.woocommerceVariationAttributesTrigger();
            this.woocommerceVariationAttributes();
            this.woocommerceVariationAttributesUpdate();
            this.woocommerceVariationAttributesSelection();
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product  detail - gallery 
        /*-----------------------------------------------------------------------------------*/

        productThumbnails: function ($target, isQuickview) {
            var self = this;

            if ($target === undefined)
                $target = self.$body;

            var $thumbnails = $target.find("#product-thumbs");
            var $thumbnailsItem = $target.find("#product-thumbs .swiper-slide");

            var fixedStyle = $('.parent_div_product.product').hasClass('pd_fixed_summary');

            var pdGallery = $('.parent_div_product.product').hasClass('pd_col_gallery');

            var pdFullwidthTop = $('.parent_div_product.product').hasClass('pd_fullwidth_top');

            var pdSticky = $('.parent_div_product.product').hasClass('pd_sticky');

            if ( $thumbnailsItem.length <= 1 && !fixedStyle ) {
                //popup gallery in simple products when just have a gallery image without featured image.
                var $thumbnailslider = $target.find("#product-fullview-thumbs");
                $thumbnailslider.find('.enable-popup').addClass('swiper-slide');

            }
            if ( $thumbnailsItem.length == 1 &&( !fixedStyle || !pdGallery) ) {

               $("#product-thumbs").remove();

            }
            if ( $thumbnailsItem.length > 1 && (pdFullwidthTop || pdGallery ) ) {

               $("#product-thumbs").remove();
            }

            if ( ($thumbnailsItem.length > 1 || fixedStyle) ) {
                $thumbnails.waitForImages(function(){
                    var $fullView = $target.find("#product-fullview-thumbs"),
                        $productimageContainer = $fullView.find('.swiper-container'),
                        visibleNum = 4,
                        direction = 'vertical',
                        slidesPerView = 4,
                        productDetail = 'classic';

                    if ( isQuickview ) {
                        var $thumbnailSlides = $thumbnails.find('.swiper-slide'),
                            slidesNum = $thumbnailSlides.length,
                            $productThumbContainer = $thumbnails.find(".swiper-container"),
                            $productThumbWraper = $thumbnails.find(".swiper-wrapper");
                    } else if ( !fixedStyle ) {
                        var $thumbnailSlides = $thumbnails.find('.swiper-slide'),
                            slidesNum = $thumbnailSlides.length,
                            $productThumbContainer = $thumbnails.find(".swiper-container"),
                            $productThumbWraper = $thumbnails.find(".swiper-wrapper");
                    }



                    if ( !isQuickview ) {
                        if ( $('#main div.pd_top').length ) {
                            productDetail = 'top';
                        } else if ( $('#main div.pd_classic_sidebar').length ) {
                            productDetail = 'classic_sidebar';
                        } else if ( $('#main div.pd_kt_classic').length ) {
                            productDetail = 'kt_classic';
                        } else if ( $('#main div.pd_classic').length ) {
                            productDetail = 'classic';
                        } else if ( $('#main div.pd_background').length ) {
                            productDetail = 'background';
                        } else if ( $('#main div.pd_fixed_summary').length ) {
                            productDetail = 'pd_fixed_summary';
                        } else if ( $('#main div.pd_sticky').length ) {
                            productDetail = 'pd_sticky';
                        } else if ( $('#main div.pd_col_gallery').length ) {
                            productDetail = 'pd_col_gallery';
                        } else if ( $('#main div.pd_fullwidth_top').length ) {
                            productDetail = 'pd_fullwidth_top';
                        }
                    }

                    if ( self.windowWidth > 979 || (!fixedStyle &&  !pdFullwidthTop &&  !pdGallery)  || isQuickview ) {
                        if ( isQuickview || productDetail == 'top' || productDetail == 'classic_sidebar') {
                            direction = 'horizontal';
                            if (slidesNum <= 2) {
                                $productThumbContainer.css({ "width": ($thumbnailSlides.outerWidth() + 10) * slidesNum, "margin": "0 auto" }); // 10px  margin bottom For Each items
                            }
                            $productThumbWraper.css("width", ($thumbnailSlides.outerWidth() + 10) * slidesNum); // 10px  margin bottom For Each items

                        }
                        if (productDetail == 'classic_sidebar' || productDetail == 'top' || productDetail == 'classic') {
                            slidesPerView = 5;
                            visibleNum = 4;
                        }
                        if (productDetail == 'kt_classic' || productDetail == 'background')
                            slidesPerView = 5;

                        if (productDetail == 'kt_classic')
                            visibleNum = 4; // 4 gallery item in classic styles

                        if ($productimageContainer.parents('.container').width() > 1220 && (productDetail == 'classic' || productDetail == 'kt_classic' || productDetail == 'background')) {
                            slidesPerView = 6;
                            visibleNum = 5;
                        }
                        if ($productimageContainer.parents('.container').width() > 1220 && (productDetail == 'pd_sticky') ){
                            slidesPerView = slidesNum;
                            visibleNum = 4;
                        }

                        if (isQuickview) {
                            visibleNum = 3;
                        }

                        var centeredSlides = true;
                        if ($(productDetail == 'kt_classic' || productDetail == 'classic' || productDetail == 'background' || productDetail == 'pd_sticky').length > 0) {
                            var productImageHeight = $('div.product.parent_div_product .swiper-container .swiper-wrapper > .swiper-slide > img').height();
                            if (( $('#product-thumbs').length > 0 ) && !pdSticky ) {
                                $('#product-thumbs,#product-thumbs .swiper-wrapper').height((productImageHeight));
                            }

                            if ($('div.product.parent_div_product .swiper-container .swiper-wrapper > .swiper-slide > img').height() < 400) {
                                visibleNum = 2;
                                centeredSlides = false;
                            }

                            var mainImageHeight = $( '#product-fullview-thumbs .swiper-wrapper > .swiper-slide img').height(),
                                mainImageWidth = $( '#product-fullview-thumbs .swiper-wrapper > .swiper-slide img').width(),
                                thumbWidth = $( '#product-thumbs' ).width();
                            var aspect_ratio = mainImageWidth / mainImageHeight;

                            var thumbHeight = thumbWidth / aspect_ratio ;
                            var thumbHeightSwiper = $( '#product-thumbs .swiper-wrapper > div.swiper-slide' ).height( thumbHeight+'px');
                            $( '#product-thumbs img' ).height( thumbHeight+'px' );

                            slidesPerView = Math.floor( mainImageHeight / thumbHeight );
                            var spaceBetween =  ( mainImageHeight - ( thumbHeight * slidesPerView ) ) / slidesPerView;
                            if ( pdSticky ){
                                if ($('#product-thumbs').length > 0) {
                                    slidesPerView = slidesNum;
                                    visibleNum = 4;
                                    spaceBetween = 12;
                                    $('#product-thumbs,#product-thumbs .swiper-wrapper ').height(thumbHeight * slidesNum);
                                }
                            }
                            if (productDetail == 'background'){
                                if ($('#product-thumbs').length > 0) {
                                    spaceBetween = 8;
                                }
                            } 
                            if (productDetail == 'kt_classic'){
                                if ($('#product-thumbs').length > 0) {
                                    spaceBetween = 13;
                                }
                            }
                            if (productDetail == 'classic'){
                                if ($('#product-thumbs').length > 0) {
                                    spaceBetween = 3;
                                }
                            }
                        } else {
                            var spaceBetween =  5;
                        }

                        var $productFullviewSwiper = $productimageContainer[0].swiper,
                            $productThumbsSwiper = new Swiper($productThumbContainer, {
                                speed: 700,
                                longSwipesMs: 800,
                                touchAngle: 90,
                                grabCursor: true,
                                touchRatio: 3,
                                slidesPerView: slidesPerView,
                                preventClicks: false,
                                slideToClickedSlide: true,
                                spaceBetween: spaceBetween,
                                height:thumbHeightSwiper,
                                direction: direction,
                                centeredSlides: true,
                                preloadImages: false,
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                lazyLoading: true,
                                on: {
                                    init: function () {
                                        if (slidesNum > visibleNum) {
                                            $thumbnails.addClass('initial-slides-position');
                                        }
                                    },
                                    setTranslate: function () {
                                        if (this.clickedIndex < visibleNum - 1 || this.activeIndex < visibleNum - 1) { //keep items visible until click on last visible item
                                            $productThumbWraper.css("transform", "translate3d(0px, 0px, 0px)");
                                            $productThumbWraper.css("-webkit-transform", "translate3d(0px, 0px, 0px)");
                                        }
                                    },
                                    transitionEnd: function () {
                                        if (this.clickedIndex < visibleNum - 1 || this.activeIndex < visibleNum - 1) { //keep items visible until click on last visible item
                                            $productThumbWraper.css("transform", "translate3d(0px, 0px, 0px)");
                                            $productThumbWraper.css("-webkit-transform", "translate3d(0px, 0px, 0px)");
                                        }
                                    },
                                    slideChangeTransitionStart: function () {
                                        if (($productFullviewSwiper !== "undefined") && !pdFullwidthTop) {
                                            $productFullviewSwiper.slideTo(this.activeIndex);
                                        }
                                    },
                                },
                            });

                    }

                    var isLoop = false,
                        slider_speed = 600,
                        $nextBtn = $target.find('.swiper-button-next'),
                        $prevBtn = $target.find('.swiper-button-prev');

                    if ( self.windowWidth < 979 ) {
                        isLoop = true;
                        $nextBtn = $productimageContainer.find('.swiper-button-next'),
                        $prevBtn = $productimageContainer.find('.swiper-button-prev');
                    }

                    if ( productDetail == 'top' ) {
                        slider_speed = 800;
                    }


                    var autoplayDuration = $('#product-thumbs .auto-play').length ? 6500 : 0;

                    if ( autoplayDuration == 0) {
                        var $autoplay = false;
                    } else {
                        var $autoplay = { delay: autoplayDuration };
                    }

                    if ( pdSticky && !isQuickview &&  $(window).width() > 979 ){
                        var $swiper = new Swiper($productimageContainer, {
                            autoplay: false,
                            autoplayDisableOnInteraction: false,
                            speed: slider_speed,
                            longSwipesMs: 700,
                            touchAngle: 30,
                            loop: isLoop,
                            followFinger: true,
                            direction:'vertical',
                            spaceBetween: 12,
                            height:mainImageHeight,
                            grabCursor: true,
                            keyboardControl: true,
                            slidesPerView:1,
                            allowTouchMove:true,
                            simulateTouch: false,
                            mousewheelControl: true,
                            touchReleaseOnEdges: true,
                            mousewheelReleaseOnEdges: true,
                            mousewheelSensitivity: .6,
                            keyboard: true,
                        });
                        $productFullviewSwiper = $swiper;
                    } else if ( pdFullwidthTop && !isQuickview &&  $(window).width() > 979 ) {
                        var $productThumbsFullviewSwiper = new Swiper($productimageContainer, {
                            slidesPerView: 3,
                            spaceBetween: 0,
                            centeredSlides:true,
                            loop:true,
                            slideToClickedSlide: true,
                            loopedSlides: 50,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                            mousewheel: false,
                            mousewheelControl: false,
                            touchReleaseOnEdges: false,
                            mousewheelReleaseOnEdges: false,
                            keyboard: true,
                            autoplay: $autoplay,
                            on: {
                                slideChangeTransitionStart: function () {
                                    if (self.windowWidth > 979 && isQuickview) {
                                        if (!this.isBeginning) {
                                            $productThumbsSwiper.slideTo(this.activeIndex);
                                        }
                                    } else if (self.windowWidth > 979 && !self.isTouchDevice) {
                                        if (!this.isBeginning) {
                                            $productThumbsSwiper.slideTo(this.activeIndex);
                                        }
                                    }
                                },
                                reachBeginning: function () {
                                    if (self.windowWidth > 979 && isQuickview) {
                                        $productThumbsSwiper.slideTo(0);
                                    } else if (self.windowWidth > 979 && !self.isTouchDevice) {
                                        $productThumbsSwiper.slideTo(0);
                                    }
                                },
                            },
                        });
                        $productFullviewSwiper = $productThumbsFullviewSwiper;
                    } else if ( !fixedStyle ||  $(window).width() < 979 ) {
                        if ( $(window).width() < 979 ) {
                            $autoplay = false;
                        }
                        var $productThumbsFullviewSwiper = new Swiper($productimageContainer, {
                            autoplay: $autoplay,
                            autoplayDisableOnInteraction: false,
                            speed: slider_speed,
                            longSwipesMs: 700,
                            touchAngle: 30,
                            loop: isLoop,
                            spaceBetween: 0,
                            followFinger: true,
                            navigation: {
                                nextEl: $nextBtn,
                                prevEl: $prevBtn,
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                            on: {
                                slideChangeTransitionStart: function () {
                                    if (self.windowWidth > 979 && isQuickview) {
                                        if (!this.isBeginning) {
                                            $productThumbsSwiper.slideTo(this.activeIndex);
                                        }
                                    } else if ( self.windowWidth > 979 && !self.isTouchDevice && !fixedStyle && !pdGallery ) {
                                        if (!this.isBeginning) {
                                            $productThumbsSwiper.slideTo(this.activeIndex);
                                        }
                                    }
                                },
                                reachBeginning: function () {
                                    if (self.windowWidth > 979 && isQuickview) {
                                        $productThumbsSwiper.slideTo(0);
                                    } else if ( self.windowWidth > 979 && !self.isTouchDevice && !fixedStyle && !pdGallery ) {
                                        $productThumbsSwiper.slideTo(0);
                                    }
                                },
                            },
                        });

                        $productFullviewSwiper = $productThumbsFullviewSwiper;
                        $('.pd_col_gallery #product-fullview-thumbs .swiper-slide').hover(
                            function() {
                                $('.pd_col_gallery #product-fullview-thumbs .swiper-slide').removeClass('col-gallery-hover');
                                $(this).addClass('col-gallery-hover');
                            },
                            function() {
                                $(this).toggleClass('col-gallery-hover');
                                $('.pd_col_gallery #product-fullview-thumbs .swiper-slide').addClass('col-gallery-hover');
                            }
                        )
                        $('.pd_col_gallery .attr-container label').on('click', function () {
                            $('.pd_col_gallery #product-fullview-thumbs .swiper-slide').removeClass('col-gallery-hover');
                        });
                    }

                });
            } else {
                $('div.pd_background #product-fullview-thumbs .swiper-slide').addClass('kt-one-slide');
            }

        },

        /*-----------------------------------------------------------------------------------*/
        /*  ReInit variation functionality by recalling woocommerce wc_variation_form function
        /*-----------------------------------------------------------------------------------*/

        reInitVariation: function ($container) {
            var $formVariation = $container.find('.variations_form');

            if ( $formVariation.length > 0 ) {
                $formVariation.wc_variation_form().find('.variations select:eq(0)').change();
                $formVariation.trigger('check_variations');
            }

        },

        /*-----------------------------------------------------------------------------------*/
        /*  product variation
        /*-----------------------------------------------------------------------------------*/

        productVariation: function () {
            var self = this;
            if ($("form.variations_form").length <= 0 || $('#product-fullview-thumbs .swiper-container').length <= 0) {
                return;
            }

            //Use passed parameter for getting variation images
            //variation.image_link : original image size
            //variation.image_src : smaller image ( shop_single size )
            $.fn.wc_variations_image_update = function (variation) {


                //check existnace of image for this variation
                if (variation && variation.image.url && variation.image.url.length > 1) {
                    if ($('.product').hasClass('pd_fixed_summary , pd_sticky') && self.windowWidth > 979) {
                        var $varImg = $('.swiper-slide[data-variableimageurl^="' + variation.image.url + '"]');
                        if (!$varImg.length)
                            return;
                        var $ImgOffset = $varImg.offset().top;
                        $('html,body').animate({ scrollTop: $ImgOffset }, "slow");
                        return;
                    }

                    //Find the index of variation slide and slide to it
                    var index = $("#product-fullview-thumbs").find('.swiper-slide[data-variableimageurl^="' + variation.image.url + '"]').data('slide'),
                        $image_slider = $('#product-fullview-thumbs .swiper-container')[0].swiper;

                    if (index == undefined)
                        return;

                    if ($image_slider == undefined)
                        return;

                    if (self.windowWidth < 768) {
                        index = index + 1; // increment to point to correct slide in loop mode slider
                    }

                    $image_slider.slideTo(index);
                    $('#product-thumbs').add($('#product-fullview-thumbs')).addClass('stop-by-variations');//Stop slider when select an varaition that has image
                    $image_slider.autoplay.stop();

                }
            };
            if ( $('.variations_form.cart').length && self.windowWidth > 979 && $('.pd_fixed_summary , .pd_sticky').length > 0 ) {
                $('.variable_item').on('click', function (event) {
                    var $varImg = $('.swiper-slide[data-var_id='+$(this).data('var_id')+']');
                    if (!$varImg.length)
                        return;
                    var $ImgOffset = $varImg.offset().top;
                    $('html,body').animate({ scrollTop: $ImgOffset }, "slow");
                });
            }
        },

        /*-----------------------------------------------------------------------------------*/
        /* woocommerce variation select
        /*-----------------------------------------------------------------------------------*/
        woocommerceVariationAttributesTrigger: function () {
            var self = this;

            if ( $('form.cart .variations select').length <= 0 ) {
                return;
            }

            self.$body.trigger('update_variation_values');

        },

        woocommerceVariationAttributes: function () {
            var self = this,
                $quickViewModal = self.$document.find('#kt-modal');


            if ( $('form.cart .variations select').length <= 0 ) {
                return;
            }

            if ( ( $('form.variations_form').length) && ($quickViewModal.length <= 0 || ! $('.quick-view-button').length ) ) {
                if ($('form.variations_form').siblings('.yith-wcwl-add-to-wishlist').length) {
                    $('.single_variation_wrap a.single_add_to_cart_button').after($('.yith-wcwl-add-to-wishlist').eq(0));
                }

                $('.yith-wcwl-add-to-wishlist').css('visibility', 'visible');

            }

            // On clicking the reset variation button
            $(document.body).on('click', '.reset_variations', function (event) {

                $('.nice-select').each(function () {

                    var $this = $(this);

                    var $dropdownLi = $this.find('.list li');

                    //reset DropDown
                    $dropdownLi.removeClass('selected');
                    var $chooseAnoptionText = $this.find('.list li:first-child').text();

                    var $currentText = $this.find('.current');
                    $currentText.html($chooseAnoptionText);

                });

            })

        },

        woocommerceVariationAttributesUpdate: function () {
            setTimeout(function () {

                $('form.cart').find('.variations select').each(function (index, el) {

                    var $select = $(this),
                        $colorAttr = $select.siblings('.select-attr'),
                        attr_values = new Array();

                    $select.find('option').each(function () {
                        attr_values.push($(this).val());
                    });

                    $colorAttr.find('span.select_item').removeClass('active');

                    if ( $colorAttr.length ) {
                        $.each(attr_values, function () {
                            if ( this != '' ) {
                                $colorAttr.find('span[data-value="' + this + '"]').addClass('active');
                            }
                        })
                    }

                    $colorAttr.find('.select_item:not(.active)').addClass('deactive');

                    // Update nice select
                    $('form.cart .variations select').not('.hide-attr-select').niceSelect('update');


                });
            }, 200)
        },


        woocommerceVariationAttributesSelection: function () {
            var self = this,
                $quickViewModal = self.$document.find('#kt-modal');

            if ($('form.cart .variations select').length <= 0) {
                return;
            }

            self.$body.unbind('update_variation_values', self.woocommerceVariationAttributesUpdate);
            self.$body.on('update_variation_values', self.woocommerceVariationAttributesUpdate);

            var $attrContainer = $('.woocommerce form.cart .variations .attr-container'),
                $selectableItems = $attrContainer.find('.select_item'),
                $attr_slides = $attrContainer.find('.swiper-slide');

            $selectableItems.on('click', function () {
                if ( !$(this).hasClass('active') ) {
                    $(this).siblings('input:radio').prop('disabled', 'disabled');
                    return;
                } else {
                    $(this).siblings('input:radio').removeProp('disabled');
                }

                if ( $(this).hasClass('active') ) {
                    //active clicked item
                    $selectableItems.removeClass('selected');
                    $(this).addClass('selected');
                }

                var $term = $(this).data('value');

                //change select element to trigger events
                $attrContainer.siblings('select').find('option[value="' + $term + '"]').prop('selected', true);
                $attrContainer.siblings('select').trigger('change');

            });

            if ( ($('form.variations_form').length)  && ($quickViewModal.length <= 0 || ! $('.quick-view-button').length ) ) {
                if ($('form.variations_form').siblings('.yith-wcwl-add-to-wishlist').length) {
                    $('.single_variation_wrap a.single_add_to_cart_button').after($('.yith-wcwl-add-to-wishlist').eq(0));
                }

                $('.yith-wcwl-add-to-wishlist').css('visibility', 'visible');

            }

            // On clicking the reset variation button
            $(document.body).on('click', '.reset_variations', function (event) {
                // For Color Selection Reset
                $('label.selectlabel input:radio,label.colorlabel input:radio,label.imagelabel input:radio').prop('checked', false);
                // For Image Selection Reset
                $('.variations_form.cart.variation_clicked').removeClass('variation_clicked');
                $attr_slides.removeClass('selected deactive');

                var imageSlider = $('#product-fullview-thumbs .swiper-container')[0].swiper;
                imageSlider.slideTo(0);


                $('.nice-select').each(function () {

                    var $this = $(this);

                    var $dropdownLi = $this.find('.list li');

                    //reset DropDown
                    $dropdownLi.removeClass('selected');
                    var $chooseAnoptionText = $this.find('.list li:first-child').text();

                    var $currentText = $this.find('.current');
                    $currentText.html($chooseAnoptionText);

                });

            })

        },

    };

    kiteTheme = Object.assign( kiteTheme, singleProductCommonFunctions );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($,kiteTheme){
    kiteTheme.initCommonSingleProduct();
    $(document).ready(function(){
        kiteTheme.productVariation();
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/product-cards.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  productCards
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var productCards = {

        initProductCards: function () { 
            this.mobileHoverState();
            this.productQuickView();
            this.productHover();
            this.productsInfoOnClick();
            this.woocommerceVariationItemSelect();
            this.woocommerceButtonsOnHoverCartClick();
            this.buttonsAppearUnderHover();
            this.modernButtonsOnHoverQuantityHandler();
        },

        initProductCardsOnReady: function () {
            this.compare();
        },

        productCardsResizeEvent: function() {
            this.mobileHoverState();
        },

        mobileHoverState: function () {

            if ( this.windowWidth >= 768 ) {
                return;
            }

            if ( $('body').hasClass('responsive-hover-state-off') ) {
                $('div.products.infoonclick .product, div.products.infoonhover .product').on( 'click', function(e){
                    e.preventDefault();
                    var url = $(this).find( 'a > h3, a > h2').parent('a').attr('href');
                    if ( url != '' ) {
                        window.location.href = url;
                    }
                });
                return;
            }

            if (navigator.platform.match(/(iPhone|iPod|iPad)/i)) {
                var $eventListener = 'click mouseover';
            } else {
                var $eventListener = 'click';
            }

            $('.woocommerce div.products div.product * ').on($eventListener, function (event) {
                var $self = $(this);
                if (!$self.parents('div.product:not(.parent_div_product)').hasClass('hover-state')) {
                    event.preventDefault();
                    $('.woocommerce div.products div.product').each(function (index, el) {
                        if ($(this).hasClass('hover-state'))
                            $(this).removeClass('hover-state');
                    });
                    $self.parents('div.product:not(.parent_div_product)').addClass('hover-state');
                }
            });

            $(document).on('click touchstart', function (event) {
                if ($(event.target).closest('.hover-state').length == 0) {
                    $('.hover-state').removeClass('hover-state');
                }
            });

            // fix 2column show bug in you may also like carousel
            if ($('.related.carousel div.products').hasClass('column_res')) {
                $('.related.carousel div.products').removeClass('column_res');
            }
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product  Quick view
        /*-----------------------------------------------------------------------------------*/

        productQuickView: function () {
            var self = this;

            var $quickViewModal = self.$document.find('#kt-modal'),
                $quickviewWrapper = $quickViewModal.find('.modal-content-wrapper'),
                $quickviewContent = $quickViewModal.find('#modal-content'),
                $quickviewNext = $quickViewModal.find('a[rel="next"]'),
                $quickviewPrev = $quickViewModal.find('a[rel="prev"]'),
                $items = $('div.products div.product');

            if ( $quickViewModal.length <= 0 || ! $('.quick-view-button').length ) {
                return;
            }

            $('.quick-view-button').on('click', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $productID = $this.data('product_id');

                $this.closest('div.product:not(.parent_div_product)').addClass('qv-active');

                //put a delay to load images after css transitions
                setTimeout(function () {

                    // next and Prev Buttons - in Quick view
                    var $nextItem = $items.filter('.qv-active').next('div.product:not(.parent_div_product)'),
                        $prevItem = $items.filter('.qv-active').prev('div.product:not(.parent_div_product)');

                    if ( $nextItem.length <= 0 ) {
                        $nextItem = $items.eq(0);
                    }

                    if ( $prevItem.length <= 0 ) {
                        $prevItem = $items.eq($items.length - 1);
                    }

                    if ($this.closest('.products').find('div.product').length <= 1) {
                        $quickViewModal.addClass('hidden-nav');
                    }
                    else {
                        if ( self.windowWidth > 767 ) {
                            $quickviewNext.find('img').remove();
                            $quickviewPrev.find('img').remove();

                            var $nextImg = $nextItem.find('img').eq(0).clone(),
                                $prevImg = $prevItem.find('img').eq(0).clone();
                            $nextImg.insertAfter($quickviewNext.find('span'));
                            $prevImg.insertAfter($quickviewPrev.find('span'));
                        }
                    }

                }, 400);

                self.$body.addClass('modal-open'); // disable scrollbar
                $quickViewModal.addClass('quickview-modal');

                if ( !$quickViewModal.removeClass('closed').hasClass('open') ) {
                    $quickViewModal.removeClass('loading').addClass('open');
                }

                var ajaxUrl,
                    data = {
                        product_id: $productID
                    };
                // Use new WooCommerce endpoint URL if available
                if (typeof wc_add_to_cart_params !== 'undefined') {
                    ajaxUrl = wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'load_quick_view'); // WooCommerce Ajax endpoint URL (available since 2.4)
                } else {
                    ajaxUrl = kite_theme_vars.ajax_url;
                    data['action'] = 'load_quick_view';
                }

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: data,
                    dataType: 'html',
                    cache: false,
                    headers: { 'cache-control': 'no-cache' },
                    success: function (data) {
                        $quickviewContent.html(data);
                        $quickViewModal.addClass('shown'); // content is ready, so show it
                        $quickviewContent.find($('form.cart .yith-wcwl-add-to-wishlist')).remove();
                        setTimeout(function () {
                            self.productThumbnails($quickviewContent, true); // enable gallery slider of product
                        }, 200);

                        self.initSelectElements();
                        self.countdown();
                        self.productProgressBar();
                        self.productVariation();
                        self.woocommerceVariationAttributes(); // enable variation attributes
                        self.woocommerceVariationAttributesSelection();
                        self.woocommerceVariationAttributesTrigger(); // update image attributes
                        self.woocommerceVariationItemSelect(); // update image attributes
                        self.reInitVariation($quickviewContent); // Variation Form
                        self.addToCart(); // add to cart - open side bar add to cart
                        $quickviewContent.find($('a.compare')).on('click', function (e) {
                            setTimeout(function () {
                                $quickviewContent.html('');
                                $quickViewModal.removeClass('shown').removeClass('quickview-modal');
                            }, 0);
                            setTimeout(function () {
                                $quickViewModal.addClass('compare-modal');
                            }, 300);
                            self.compare();

                        });
                    }
                });
            });


            // Close quickview by click outside of content
            $quickViewModal.on('click', function (e) {
                if (!$quickviewWrapper.is(e.target) && $quickviewWrapper.has(e.target).length === 0 && !$quickviewNext.is(e.target) && $quickviewNext.has(e.target).length === 0 && !$quickviewPrev.is(e.target) && $quickviewPrev.has(e.target).length === 0) {
                    self.closeQuickView();
                }
            });

            // Close quickview by click close button
            self.$document.on('click', '#kt-modal.quickview-modal #modal-close', function (e) {
                e.preventDefault();
                self.closeQuickView();
            });

            // Close box with esc key
            self.$document.keyup(function (e) {
                if (e.keyCode === 27) {
                    self.closeQuickView();
                }
            });

            $quickviewNext.on('click', function (e) {
                e.preventDefault();
                var $nextItem = $items.filter('.qv-active').next('div.product:not(.parent_div_product)');
                if ($nextItem.length <= 0) {
                    $nextItem = $items.eq(0);
                }

                $quickViewModal.removeClass('shown');
                $items.filter('.qv-active').removeClass('qv-active');
                $nextItem.find('a.quick-view-button').trigger('click');
            });

            $quickviewPrev.on('click', function (e) {
                e.preventDefault();
                var $prevItem = $items.filter('.qv-active').prev('div.product:not(.parent_div_product)');
                if ($prevItem.length <= 0) {
                    $prevItem = $items.eq($items.length - 1);
                }

                $quickViewModal.removeClass('shown');
                $items.filter('.qv-active').removeClass('qv-active')
                $prevItem.find('a.quick-view-button').trigger('click');
            });
        },

        closeQuickView: function () {
            var self = this;

            var $quickViewModal = self.$document.find('#kt-modal.quickview-modal'),
                $quickviewContent = $quickViewModal.find('#modal-content');

            $quickViewModal.removeClass('shown loading open').addClass('closed');
            $('div.product.qv-active:not(.parent_div_product)').removeClass('qv-active');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $quickViewModal.removeClass('quickview-modal');
            }, 300)

            setTimeout(function () {
                $quickviewContent.html('');
            }, 800);
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product hover
        /*-----------------------------------------------------------------------------------*/

        productHover: function () {

            var $productAddToCart = $('div.products.grid_view div.product span.product-button');
            //check existance of woocommerce class (shop page or a normal page with shortcode)
            if ($('.woocommerce').length <= 0  || ! $productAddToCart.length ) {
                return;
            }

            $productAddToCart.each(function () {
                var $product = $(this).closest('div.product:not(.parent_div_product)');

                if ( !$product.hasClass('single-product-shortcode') ) {

                    //Hover effect
                    $(this).mouseenter(function () {
                        $product.addClass('add-to-cart-hovered');
                    });

                    //Exit hover state of the cart button when mouse leaves the buttons container
                    $(this).mouseleave(function () {
                        $product.removeClass('add-to-cart-hovered');
                    });

                }

            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product - Info on click style
        /*-----------------------------------------------------------------------------------*/

        productsInfoOnClick: function ( $infiniteScroll = false ) {
            var self = this;

            if ( !$('div.infoonclick').length ) {
                return;
            }

            var $container = !$infiniteScroll ? $('div.infoonclick div') : $infiniteScroll;

            // off the previous click events
            $container.find('span.show-hover').off('click');
            $container.find('a.product_variation_item').off('click');

            $container.find('span.show-hover').on('click', function () {
                var $productID = $(this).parents('div.product:not(.parent_div_product)').attr('data-productid'); //data product ID
                $productID = $('div.product:not(.parent_div_product)[data-productid =' + $productID + ']');
                $(this).parents('div.products').find($productID).find('span.show-hover').toggleClass('show').closest('div.product').toggleClass('show-hover-content');
            });
            $container.find('a.product_variation_item').on('click', function () {
                $container.find('.selectlabel,.colorlabel').removeClass('selected');
                $(this).closest('.selectlabel,.colorlabel').addClass('selected');

            });

        },

        /*----------------------------------------------------------------------------------*/
        /*  compare
        /*----------------------------------------------------------------------------------*/

        compare: function () {
            var self = this;

            var $compareModal = self.$document.find('#kt-modal'),
                $compareContent = $compareModal.find('#modal-content'),
                $compareWrapper = $compareModal.find('.modal-content-wrapper');

            $('.compare').on('click', function () {
                $compareModal.addClass('compare-modal open').removeClass('closed'); // content is ready, so show it
            });
            $(document).on('click', '.comparewrapper a.compareLink, .kt-compare .hd-btn-link', function (ev) {
                ev.preventDefault();
                $compareModal.addClass('compare-modal open').removeClass('closed'); // content is ready, so show it
                var tableUrl = this.href;

                if ( typeof tableUrl == 'undefined' ) {
                    return;
                } 
                $('body').trigger('yith_woocompare_open_popup', { response: tableUrl, button: $(this) });
            });

            // Close quickview by click outside of content
            $compareModal.on('click', function (e) {
                if ( !$compareModal.hasClass('compare-modal') ) {
                    return;
                }

                if ( !$compareWrapper.is(e.target) && $compareWrapper.has(e.target).length === 0 ) {
                    closeCompareModal();
                }
            });

            self.$document.on('click', '#kt-modal.compare-modal #modal-close', function (e) {
                e.preventDefault();
                closeCompareModal();
            });

            var closeCompareModal = function () {
                $compareModal.removeClass('shown loading open').addClass('closed');
                setTimeout(function () {
                    self.$body.removeClass('modal-open');
                    $compareModal.removeClass('compare-modal');
                }, 300)

                setTimeout(function () {
                    $compareContent.html('');
                }, 800);

                var $widgetList = $('.yith-woocompare-widget div.products-list'),
                    data = {
                        action: yith_woocompare.actionview,
                        context: 'frontend'
                    };

                if (typeof $.fn.block != 'undefined') {
                    $widgetList.block({ message: null, overlayCSS: { background: '#fff url(' + yith_woocompare.loader + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6 } });
                }

                $.ajax({
                    type: 'post',
                    url: yith_woocompare.ajaxurl.toString().replace('%%endpoint%%', yith_woocompare.actionview),
                    data: data,
                    success: function (response) {
                        // add the product in the widget
                        if (typeof $.fn.block != 'undefined') {
                            $widgetList.unblock().html(response);
                        }
                        $widgetList.html(response);
                    }
                });
            }

            // open popup & Run yith_woocompare_open_popup handler
            self.$body.off('yith_woocompare_open_popup');
            self.$body.on('yith_woocompare_open_popup', function (e, data) {
                var url = data.response;

                self.$body.addClass('modal-open'); // Disable scrollbar

                $.post({
                    url: url + ' .compare-list',
                    cache: false,
                    headers: { 'cache-control': 'no-cache' },
                    success: function (response) {
                        $compareContent.html(response);
                        $compareModal.addClass('shown');
                        self.kiteScrollBar('table.compare-list tr.description td p:first-child ');
                    }
                });

            });

            self.$document.find('kt-modal.compare-modal tr.remove a').off('click');

            // remove from table
            self.$document.on('click', '#kt-modal.compare-modal tr.remove a', function (e) {
                e.preventDefault();

                $(this).addClass('norotate');

                var button = $(this),
                    data = {
                        action: yith_woocompare.actionremove,
                        id: button.data('product_id'),
                        context: 'frontend'
                    },
                    product_cell = $('td.product_' + data.id + ', th.product_' + data.id);

                // add ajax loader
                if (typeof $.fn.block != 'undefined') {
                    button.block({
                        message: null,
                        overlayCSS: {
                            background: '#fff url(' + yith_woocompare.loader + ') no-repeat center',
                            backgroundSize: '16px 16px',
                            opacity: 0.6
                        }
                    });
                }

                $.ajax({
                    type: 'post',
                    url: yith_woocompare.ajaxurl.toString().replace('%%endpoint%%', yith_woocompare.actionremove),
                    data: data,
                    dataType: 'html',
                    success: function (response) {

                        // in compare table
                        var table = $(response).filter('table.compare-list');
                        $('body  table.compare-list').replaceWith(table);

                        $('.compare[data-product_id="' + button.data('product_id') + '"]', window.parent.document).removeClass('added').html(yith_woocompare.button_text);

                        // removed trigger
                        self.$window.trigger('yith_woocompare_product_removed');
                    }
                });
            });


        },

        woocommerceVariationItemSelect: function () {

            var currencySymbol = $('.woocommerce-Price-currencySymbol:first').text();
            var simpleAddToCart = function ($productItem, buttonClass = false ) {
                var $cartButton = $productItem.find('div.addtocartbutton .addcartbutton,.product-buttons .product-button a, .modern-buttons-on-hover-cart-btn,.mobileAddToCart');
                if ( !$productItem.find('.simpleAddToCart').length ) {
                    $cartButton.after('<a href="" rel="nofollow" data-quantity="1" class="add_to_cart_button product_type_simple simpleAddToCart button" style="display:none"><span class="icon icon-cart"></span><span class="txt" data-hover="'+kite_theme_vars.add_to_cart+'">'+kite_theme_vars.add_to_cart+'</span></a>');
                    if ( ! buttonClass ) {
                        $('.simpleAddToCart').removeClass('button');
                    }
                    $('.simpleAddToCart').on('click', function () {
                        $(this).closest('div.product:not(.parent_div_product)').addClass('cartButtonClicked');
                    });
                }
            };
            $('.product_variation_item.info').on('click', function () {
                var $this = $(this),
                    $origImage = $(this).closest('div.product:not(.parent_div_product) ').find('div.imageswrap img'),
                    $hoverImage = $(this).closest('div.product:not(.parent_div_product) ').find('div.hover-image'),
                    buttonClass = $this.parents('.products').is('.modern-buttons-on-hover');

                simpleAddToCart($this.closest('div.product:not(.parent_div_product)'), buttonClass );
                $this.closest( 'div.product:not(.parent_div_product)').find('.product-quantity').removeClass('disable');

                $this.closest('div.product:not(.parent_div_product)').find('.add_to_cart_btn_wrap').addClass('is-loading');

                var $salePrice = $this.attr('data-sale-price');
                var $regPrice = $this.attr('data-regular-price');
                var dataImage = $this.attr('data-image');
                var dataSrcset = $this.attr('data-srcset');

                $('<img/>').attr('src', dataImage).on('load', function () {
                    $(this).remove(); // prevent memory leaks as @benweet suggested
                    $hoverImage.css('background', 'url(' + dataImage + ')');
                    $origImage.attr('src', dataImage);
                    $origImage.attr('srcset', dataSrcset);
                    $this.closest('div.product').find('.add_to_cart_btn_wrap').removeClass('is-loading');
                });

                if ($this.closest('div.product').find('.simpleprice').length == 0) {
                    $this.closest('div.product').find('.price').after('<span class="price simpleprice" style="display:none;"></span>');
                }
                if ($regPrice != '' && $salePrice != '') {
                    $this.closest('div.product:not(.parent_div_product) ').find('.simpleprice').html('<span class="woocs_price_code"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + $regPrice + '</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + $salePrice + '</span></ins></span>');
                } else if ($regPrice != '') {
                    $this.closest('div.product:not(.parent_div_product) ').find('.simpleprice').html('<span class="woocs_price_code"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + $regPrice + '</span></span>');
                } else if ($salePrice != '') {
                    $this.closest('div.product:not(.parent_div_product) ').find('.simpleprice').html('<span class="woocs_price_code"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + $salePrice + '</span></span>');
                }

                $this.closest('div.product:not(.parent_div_product)').find('.price:not(.simpleprice)').attr('style', 'display: none !important');
                $this.closest('div.product:not(.parent_div_product)').find('.simpleprice').removeAttr('style');
                $this.closest('div.product:not(.parent_div_product)').find('.simpleAddToCart').removeAttr('style');
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.addcartbutton:not(.simpleAddToCart), .product-button > a:not(.simpleAddToCart)').css('display', 'none');

                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').removeData('product_id');
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').removeData('product_sku');
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').data('product_id', $(this).data('product_id'));
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').attr('data-product_id', $(this).data('product_id'));
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').data('product_sku', $(this).data('product_sku'));
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').attr('data-product_sku', $(this).data('product_sku'));
                $this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.simpleAddToCart, .product-button > a.simpleAddToCart').attr('href', $(this).data('cart-url'));

                if ($this.closest('div.product:not(.parent_div_product)').find('div.addtocartbutton a.addcartbutton, .variations').hasClass('ajax_enabled')) {
                    $this.closest('div.product:not(.parent_div_product)').find('.simpleAddToCart').addClass('ajax_add_to_cart');
                }
            });
            $('.variable_item,.variations .nice-select li').on('click', function () {
                $('form.variations_form').addClass('variation_clicked');

            });

        },
        infoonhoverAndClickAddedToCart: function ($variationItem) {
            if ($(window).width() < 768)
                return;
            if ($('.woocommerce .products.infoonhover').length || $('.woocommerce .products.infoonclick').length) {
                var $price = $variationItem.closest('div.product:not(.parent_div_product)').find('.price:not(.simpleprice)');
                var $onSale = $variationItem.closest('div.product:not(.parent_div_product)').find('.onsale');
                var $label = $variationItem.closest('div.product:not(.parent_div_product)').find('.custom_product_label');
                if ($variationItem.closest('div.products').hasClass('infoonhover') || $variationItem.closest('div.products').hasClass('infoonclick')) {
                    $variationItem.closest('div.product:not(.parent_div_product)').hover(function () {
                        $price.removeAttr('style');
                    }, function () {
                        $price.addClass('add-cart');
                    });
                }
                if ($variationItem.closest('div.products').hasClass('infoonclick')) {
                    $variationItem.closest('div.product:not(.parent_div_product)').toggleClass('show-hover-content');
                    $variationItem.closest('div.product:not(.parent_div_product)').find('.show-hover').toggleClass('show');
                }
                if ($onSale.length) {
                    $onSale.css('top', ($price.outerHeight() + 10) + 'px');
                    if ($label.length) {
                        $label.css('top', ($onSale.outerHeight() + $price.outerHeight() + 15) + 'px');
                    }
                }
                else if ($label.length) {
                    $label.css('top', ($price.outerHeight() + 10) + 'px');
                }

                if ($variationItem.closest('div.product:not(.parent_div_product)').hasClass('product-type-variable')) {
                    $variationItem.closest('div.product:not(.parent_div_product)').find('input[type="radio"]').prop('checked', false);
                }
            }
        },
        woocommerceButtonsOnHoverCartClick: function () {
            var $addToCartButton = $('.woocommerce div.products.buttonsonhover div.product .product-buttons .product-button a, .woocommerce div.products.instantshop div.product .instant_shop_button div.addtocartbutton a.addcartbutton');
            $addToCartButton.off('click');
            $addToCartButton.on('click', function (event) {
                if ($(this).closest('div.product:not(.parent_div_product)').find('.product-button, div.addtocartbutton,div.addtocartbutton a').hasClass('product_type_variable')) {
                    if ($(this).closest('div.product:not(.parent_div_product)').find('.simpleAddToCart').length == 0) {
                        $(this).after('<a href="" rel="nofollow" data-quantity="1" class="add_to_cart_button product_type_simple simpleAddToCart" style="display:none"><span class="icon"></span><span class="txt" data-hover="'+kite_theme_vars.add_to_cart+'">'+kite_theme_vars.add_to_cart+'</span></a>');
                    }
                    if ($(this).parents('div.products').hasClass('buttonsonhover')) {
                        $(this).closest('div.product:not(.parent_div_product)').find('.simpleAddToCart').addClass('button');
                    } else {
                        $(this).closest('div.product:not(.parent_div_product)').find('.simpleAddToCart').addClass('addcartbutton');
                    }
                }
            });
        },
        buttonsAppearUnderHover: function () {
            if ($('div.products.buttonsappearunder').parents('.woocommerce.carousel.wc-shortcode, .woocommerce .related.grid').length) {
                var heightOfCarousel = $('div.products.buttonsappearunder').parents('.woocommerce.carousel.wc-shortcode ').height();
                var heightOfGrid = $('div.products.buttonsappearunder').parents('.woocommerce .related.grid ').height();
                $('div.products.buttonsappearunder').parents('.woocommerce.carousel.wc-shortcode').css('height', heightOfCarousel);
                $('div.products.buttonsappearunder').css('height', heightOfCarousel);
                $('div.products.buttonsappearunder').parents('.woocommerce .related.grid').css('height', heightOfGrid + 20 + 'px');
            }
        },

        modernButtonsOnHoverQuantityHandler: function () {
            $(document).on('click', '.modern-buttons-on-hover .product-quantity > span:not(.product-button)', function(){
                var $this = $(this);
                var min = $this.siblings('.product-button').find('a').data('min-quantity'),
                    max = $this.siblings('.product-button').find('a').data('max-quantity');

                var currnetQuantity = parseInt( $this.siblings('input').val() );
                var newQuantity = 0;
                max = ( max == -1 || typeof max == 'undefined' ) ? Infinity : max;

                if ( $this.hasClass('plus') && currnetQuantity < max ) {
                    newQuantity = ++currnetQuantity;
                    $this.siblings('input').val( newQuantity );
                    $this.siblings('span.product-button').find('a').data( 'quantity', newQuantity );
                    $this.siblings('span.product-button').find('a').attr( 'data-quantity', newQuantity );
                }

                if ( $this.hasClass('minus') && currnetQuantity > min ) {
                    newQuantity = --currnetQuantity;
                    $this.siblings('input').val( newQuantity );
                    $this.siblings('span.product-button').find('a').data( 'quantity', newQuantity );
                    $this.siblings('span.product-button').find('a').attr( 'data-quantity', newQuantity );
                }
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, productCards );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.initProductCards();
    $(window).on( 'resize', function(){
        kiteTheme.productCardsResizeEvent();
    });
    $(document).ready(function () { 
        kiteTheme.initProductCardsOnReady();
    });
})( jQuery );


/*! 
 * 
 * ================== assets/js/kite/shop.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  shop
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var shop = {

        initShop: function() {
            this.layerNavAjaxDropDown();
            this.disablePriceSliderKeydownEvent();
            this.priceSliderFilter();
            this.woocommerceFilter();
            this.woocommerceActiveTag();
            this.woocommerceAjaxWrapper();
            this.searchBoxToggle();
            this.productsPagination();
            this.switchView();
            this.shopHeadCatResponsive();
            this.shopHeadCatDisplay();
        },

        /*-----------------------------------------------------------------------------------*/
        /* Filter drop down ( select ) functionality after ajax request
        /*-----------------------------------------------------------------------------------*/

        layerNavAjaxDropDown: function () {

            $('.dropdown_layered_nav').change(function () {

                var slug = $(this).val(),
                    filtername = $(this).closest('select').attr('data-filtername');

                var url = window.location.href; // get current url
                slug = '?filter_' + filtername + '=' + slug;
                url += slug;
                location.href = url;

            });

        },

        /*-----------------------------------------------------------------------------------*/
        /* price slider filter - woocommerce code without any changes this code use for Djax
        /*-----------------------------------------------------------------------------------*/
        disablePriceSliderKeydownEvent: function () {
            $(".widget_price_filter").on('click', function () {
                $(this).find('.ui-slider-handle').unbind('keydown');
            });

            $(document).on('price_slider_slide', function(){
                $('.price_slider_amount button').addClass('active');
            });

            $(document).on('woocommerce-content-updated', function(){
                $('.price_slider_amount button').removeClass('active');
            });
        },

        priceSliderFilter: function () {
            if ( !$('.woocommerce-page').length ) {
                return 0;
            }

            var priceSlider = function () {
                // Get markup ready for slider
                $('input#min_price, input#max_price').hide();
                $('.price_slider, .price_label').show();

                // Price slider uses jquery ui
                var min_price = $('.price_slider_amount #min_price').data('min'),
                    max_price = $('.price_slider_amount #max_price').data('max'),
                    current_min_price = parseInt(min_price, 10),
                    current_max_price = parseInt(max_price, 10);

                //this section modified by kiteSt
                if ( $('.price_slider_amount #min_price').val() ) {
                    current_min_price = parseInt($('.price_slider_amount #min_price').val(), 10);
                }
                if ( $('.price_slider_amount #max_price').val() ) {
                    current_max_price = parseInt($('.price_slider_amount #max_price').val(), 10);
                }
                //end section

                $(document.body).bind('price_slider_create price_slider_slide', function (event, min, max) {
                    if ( woocommerce_price_slider_params.currency_pos === 'left' ) {

                        $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + min);
                        $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + max);

                    } else if ( woocommerce_price_slider_params.currency_pos === 'left_space' ) {

                        $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + ' ' + min);
                        $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + ' ' + max);

                    } else if ( woocommerce_price_slider_params.currency_pos === 'right' ) {

                        $('.price_slider_amount span.from').html(min + woocommerce_price_slider_params.currency_symbol);
                        $('.price_slider_amount span.to').html(max + woocommerce_price_slider_params.currency_symbol);

                    } else if ( woocommerce_price_slider_params.currency_pos === 'right_space' ) {

                        $('.price_slider_amount span.from').html(min + ' ' + woocommerce_price_slider_params.currency_symbol);
                        $('.price_slider_amount span.to').html(max + ' ' + woocommerce_price_slider_params.currency_symbol);

                    }

                    $(document.body).trigger('price_slider_updated', [min, max]);
                });

                $('.price_slider').slider({
                    range: true,
                    animate: true,
                    min: min_price,
                    max: max_price,
                    values: [current_min_price, current_max_price],
                    create: function () {

                        $('.price_slider_amount #min_price').val(current_min_price);
                        $('.price_slider_amount #max_price').val(current_max_price);

                        $(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
                    },
                    slide: function (event, ui) {

                        $('input#min_price').val(ui.values[0]);
                        $('input#max_price').val(ui.values[1]);

                        $(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
                    },
                    change: function (event, ui) {

                        $(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
                    }
                });
            }

            // woocommerce_price_slider_params is required to continue, ensure the object exists
            if (typeof woocommerce_price_slider_params === 'undefined') {
                return false;
            }

            if (typeof $.fn.slider != 'undefined') {
                priceSlider();
            } else {
                //Wait a bit to add scripts compelety to DOM and then run function
                setTimeout(function () {
                    if (typeof $.fn.slider != 'undefined') {
                        priceSlider();
                    }
                }, 1000)
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  Update woocommerce content by ajax
        /*-----------------------------------------------------------------------------------*/

        woocommerceFilter: function () {
            var self = this;

            $('.shop-filter-toggle').on('click', function () {
                var $this = $(this),
                    $searchKeyword = $(".shop-filter .search-keyword");

                $this.toggleClass('open').removeClass('closed');
                $this.parents('.shop-filter').toggleClass('open');
                if ($this.parents('.shop-filter').find('.togglefilterscontainer').length == 0) {
                    $('.togglesidebar.filtersidebar').toggleClass('open');
                } else if ( $this.hasClass('open') ) {
                    $this.parents('.shop-filter').find('.togglefilterscontainer').slideDown();
                } else {
                    $this.parents('.shop-filter').find('.togglefilterscontainer').slideUp();
                }
                if ($this.parents('#mobile-header_secondstate').length) {
                    $('.shop-filter').toggleClass('open');
                    $('body').toggleClass('filtersOpened');
                }

                if ( self.windowWidth < 1025 ) {
                    if ($this.hasClass('open')) {
                        $('.shopFilterCategoriesBtn').addClass('closed')
                    } else {
                        $('.shopFilterCategoriesBtn').removeClass('closed')
                    }
                }

                // Search keyword
                if ( $this.hasClass('open') ) {
                    $searchKeyword.addClass('hide');
                    if ($this.parents('.shop-filter').find(".special-filter.cat").hasClass("opencat")) {
                        $this.parents('.shop-filter').find(".special-filter.cat").removeClass('opencat');
                        $this.siblings('.shopFilterCategoriesBtn').removeClass('opencat');
                    }
                } else {
                    $searchKeyword.removeClass('hide');
                }
            });

            $('#sidebar-open-overlay').on('click', function () {
                $('.shop-filter').removeClass('open');
            });

            if ( $('.shop-filter').length ) {
                $('.shop-filter').find('.togglefilterscontainer').css('display', 'none');
            }

            if ( self.windowWidth < 1025 ) {

                $('.shopFilterCategoriesBtn').on('click', function () {
                    var $this = $(this),
                        $searchKeyword = $(".shop-filter .search-keyword");

                    $this.toggleClass('opencat').removeClass('closed');
                    $this.parents('.shop-filter').find(".special-filter.cat").toggleClass('opencat');

                    if ($this.hasClass('opencat')) {
                        $('.shop-filter-toggle').addClass('closed')
                    } else {
                        $('.shop-filter-toggle').removeClass('closed')
                    }

                    // Search keyword
                    if ($this.hasClass('opencat')) {
                        $searchKeyword.addClass('hide');
                        if ($this.parents('.shop-filter').hasClass("open")) {
                            $this.parents('.shop-filter').removeClass('open');
                            $this.siblings('.shop-filter-toggle').removeClass('open');
                        }
                    } else {
                        $searchKeyword.removeClass('hide');
                    }
                });

                var closeFilterAndCat = function () {
                    $('.shop-filter').removeClass('open');
                    $('.shop-filter-toggle').removeClass('open closed');
                    $(".shop-filter .search-keyword").addClass('hide');
                    $('.shop-filter').find(".special-filter.cat").removeClass('opencat');
                    $('.shopFilterCategoriesBtn').removeClass('opencat closed');
                }

                self.$body.on('wc-content-updating', closeFilterAndCat);
                self.$document.on('click', '.woocommerce .shop-filter .special-filter.cat', closeFilterAndCat);


                if ( !$('.woocommerce .shop-filter .sidebar').length ) {
                    var wcCloseSidebar = function () {
                        $('.woocommerce .wc-sidebar-btn').removeClass('active').siblings('.sidebar').removeClass('show');
                    }

                    self.$body.on('wc-content-updating', wcCloseSidebar);

                    self.$document.on('click', '.woocommerce .wc-sidebar-btn', function () {
                        var $this = $(this);

                        if (!$this.hasClass('active')) {
                            $this.siblings('.sidebar').addClass('show');
                        } else {
                            $this.siblings('.sidebar').removeClass('show');
                        }

                        $this.toggleClass('active');
                    });
                }


                self.woocommerceFilterResponsive();
            }

            $(document).on('click', '.search-inputwrapper .searchinput,#mobile-header_secondstate .allcats', function () {
                if ($('.shop-filter-toggle.mobile-filter').hasClass('open')) {
                    $('.shop-filter-toggle.mobile-filter').toggleClass('open');
                    $('.shop-filter-toggle:not(.mobile-filter)').siblings('.shop-filter').toggleClass('open');
                }

            });

        },

        woocommerceFilterResponsive: function () {
            var self = this,
                $shopFilterSidebar = $('.woocommerce .shop-filter .sidebar'),
                $shopSidebar = $('#woocommerce-sidebar .sidebar');

            if ( self.windowWidth > 1140 || ( ! $shopFilterSidebar.length && ! $shopSidebar.length ) ) {
                return;
            }

            $shopSidebar = $('#woocommerce-sidebar .sidebar').html();
            if ( $shopFilterSidebar.length && $('.navicons.filters').length ) {
                $shopFilterSidebar.append( $shopSidebar );
                $shopFilterSidebar.prepend($('.woocommerce .shop-filter .special-filter .widget.widget_on_sale_filter'));
                $shopFilterSidebar.prepend($('.woocommerce .shop-filter .special-filter .widget.widget_in_stock_filter'));
                self.showMoreTag();
            }
        },


        goToTopShop: function () {
            var self = this;
            setTimeout(function () {
                self.scrollTo('.woocommercepage.kt_shop_page .row', 1, 400);
            }, 500)

        },

        /*----------------------------------------------------------------------------------*/
        /*  Update woocommerce content by ajax
        /*-----------------------------------------------------------------------------------*/


        //Activate tag on page refresh
        woocommerceActiveTag: function () {
            var url = window.location.href;
            $('.widget.woocommerce.widget_product_tag_cloud a[href="' + url + '"]').addClass('current-cat');

        },

        woocommerceAjaxWrapper: function () {
            var self = this;

            if ( !self.$body.hasClass('woocommerce') || self.$body.hasClass('single-product') ) {
                return;
            }

            var isActiveAjaxRequest = function () {
                if ( xhr && xhr.readyState != 4 ) {
                    return true;
                }

                return false;
            }

            var hideWrapperLoading = function () {
                $('.wc-ajax-content').css('opacity', 1);
                $('.wc-ajax-wrapper > .wc-loading').addClass('hide');
            }

            var showWrapperLoading = function () {
                $('.wc-ajax-content').css('opacity', 0);
                $('.wc-ajax-wrapper > .wc-loading').removeClass('hide');
            }

            var displayBottomFilters = function (opacity) {
                var $currentActiveFilters = $('.widget.widget_layered_nav_filters'),
                    $resultCount = $('.woocommerce-result-count');

                $currentActiveFilters.add($resultCount).css('opacity', opacity);
            }

            var updateWidgets = function ($response) {
                //Update search form
                var form = $response.find('form.woocommerce-product-search');
                $('form.woocommerce-product-search').attr('data-type', form.attr('data-type')).attr('action', form.attr('action'));


                //Update search keyword
                var $searchKeyword = $response.find('.search-keyword a');
                if ( $searchKeyword.length > 0 ) {
                    $('.search-keyword').html($searchKeyword).removeClass('hide').addClass('show');
                } else {
                    $('.search-keyword').removeClass('show');
                }

                var $shopFilter = $response.find('.shop-filter'),
                    $resultCount = $response.find('p.woocommerce-result-count'),
                    $resOrdering = $response.find('.woocommerce-ordering select'),
                    $resShopFilters = $response.find('.shop-filter .widget-area'),
                    $resSidebarFilters = $response.find('.toggle-sidebar-container.filtersidebar'),
                    $resShopCats = $response.find('#shop-filter-cat'),
                    $resShopSidebar = $response.find('#woocommerce-sidebar'),
                    $resShopFilterBarSort = $response.find('.shop-filter .special-filter.sort'),
                    $resShopBottomFilters = $response.find('.shop-filter .bottompartfilter'),
                    $mobileActiveFilters = $response.find('.mobileactivefilters');

                //Wait .2s to complete animations
                setTimeout(function () {
                    if ( $shopFilter.length <= 0 ) {
                        $('.shop-filter, .shop-filter-toggle').addClass('hidden');
                    } else {
                        $('.shop-filter, .shop-filter-toggle').removeClass('hidden');
                    }

                    if ( $resShopCats.length > 0 ) {
                        $('#shop-filter-cat').html($resShopCats.html());
                    }


                    $('.shop-filter .widget-area').html($resShopFilters.html());
                    $('.toggle-sidebar-container.filtersidebar').html($resSidebarFilters.html());
                    $('.shop-filter .special-filter.sort').html($resShopFilterBarSort.html());

                    // Update filters in shop with filter
                    if ( self.windowWidth < 1025 ) {
                        $('.woocommerce-sidebar .sidebar.widget-area').html($resShopSidebar.html()); // In Responsive devices
                        $('.woocommerce .shop-filter .sidebar').append($resShopSidebar.html());
                    } else {
                        $('#woocommerce-sidebar').html($resShopSidebar.html());
                    }

                    $('.woocommerce-result-count').html($resultCount.html());
                    $('.woocommerce-ordering select').html($resOrdering.html());
                    $('.shop-filter .bottompartfilter').html($resShopBottomFilters.html());
                    $('.mobileactivefilters').html($mobileActiveFilters.html());
                    self.catWidgetUpdate();
                    self.showMoreTag();

                    setTimeout(function () {
                        self.disablePriceSliderKeydownEvent();
                        self.priceSliderFilter();
                        displayBottomFilters(1);
                        // self.woocommerceFilterResponsive();
                        self.shopHeadCatDisplay();
                        self.initSelectElements('update');
                        self.layerNavAjaxDropDown();
                        self.catWidget();
                    }, 100);
                }, 200);

            }

            var updateContent = function ($response, categoryChanged) {
                var $newBlock = $response.find('.wc-ajax-content'),
                    $newCategoryHeader = $response.find('#header'),
                    $newCategoryHeaderStyle = $newCategoryHeader.prev('style'),
                    $currentCategoryHeader = $('#header'),
                    $currentCategoryHeaderStyle = $currentCategoryHeader.prev('style'),
                    $newTopSpaceClasses = $response.find('#main-content').attr("class"); // get new top space classes

                if ( $newBlock.length > 0 ) {
                    $('.wc-ajax-content').html($newBlock.html());
                } else {
                    $newBlock = $response.find('.woocommerce-info').addClass('no-match');
                    $('.wc-ajax-content').html($newBlock);
                }

                //update category header and top space classes
                if ( categoryChanged ) {
                    if ( $newCategoryHeader.length > 0 ) {
                        if ($currentCategoryHeader.length > 0) {

                            $currentCategoryHeaderStyle.replaceWith($newCategoryHeaderStyle);
                            $currentCategoryHeader.after($newCategoryHeader.addClass('hide'));
                            //wait a bit to add content to DOM completely
                            setTimeout(function () {
                                $newCategoryHeader.removeClass('hide');
                            }, 100);
                            //wait a bit to animate completely
                            setTimeout(function () {
                                $currentCategoryHeader.remove();
                            }, 400);

                        } else {
                            $('#pageheight').before($newCategoryHeaderStyle);
                            $('#pageheight').before($newCategoryHeader.addClass('hidecompletly'));
                            //wait a bit to add content to DOM completely
                            setTimeout(function () {
                                $newCategoryHeader.removeClass('hidecompletly');
                            }, 200);
                        }

                    } else {
                        $currentCategoryHeader.addClass('hidecompletly');
                        setTimeout(function () {
                            $currentCategoryHeader.remove();
                            $currentCategoryHeaderStyle.remove();
                        }, 300);
                    }

                    // Replace New top Space classes
                    if ($newTopSpaceClasses.length > 0) {
                        $('#main-content').addClass($newTopSpaceClasses);
                    }
                }

                //wait a bit to add content to DOM completely
                setTimeout(function () {
                    self.runIsotopeInProducts();
                    self.productsInfoOnClick();
                    self.lazyLoadOnLoad('#main-content');
                    self.lazyLoadOnHover();
                    self.productHover();
                    self.productQuickView();
                    self.productsPagination();

                }, 50);

            }

            //Helper function to get content by url
            //is_search is a flag to show search results
            var getWoocommerceContent = function (pageUrl, categoryChanged) {

                //Prevent from multiple ajax requests
                if (isActiveAjaxRequest()) {
                    xhr.abort();
                }

                self.abortImageLoading();

                if ( pageUrl ) {

                    self.$body.trigger('wc-content-updating');

                    if ( self.windowWidth <= 1140 ) {
                        self.goToTopShop();
                    }

                    showWrapperLoading();

                    displayBottomFilters(0);

                    if ( $('.product_per_page_filter').length ) {
                        $('.product_per_page_filter .num').each(function (index, el) {
                            if ($(this).hasClass('selected')) {
                                pageUrl = self.updateQueryStringParameter(pageUrl, 'per-page', $(this).data('num'));
                            }
                        });
                    }

                    // Make sure the URL has a trailing-slash before query args (fix 301 redirect)
                    pageUrl = pageUrl.replace(/\/?(\?|#|$)/, '/$1');

                    //Update history of browser ( for browser next/prev button)
                    window.history.pushState({ 'url': pageUrl, 'title': '' }, '', pageUrl);

                    xhr = $.ajax({
                        url: pageUrl,
                        dataType: 'html',
                        data: { ajax_shop_req: true },
                        cache: false,
                        headers: { 'cache-control': 'no-cache' },
                        method: 'POST',

                        error: function (XMLHttpRequest, textStatus, error) {

                        },
                        success: function (response) {
                            // Update shop content
                            var $response = $(response);
                            updateContent($response, categoryChanged);
                            updateWidgets($response);

                        },
                        complete: function () {
                            hideWrapperLoading();
                            self.runIsotopeInProducts();
                            self.compare();
                            self.woocommerceVariationItemSelect();
                            self.woocommerceButtonsOnHoverCartClick();
                            self.mobileHoverState();
                            $('body').trigger( 'woocommerce-content-updated' );
                        }
                    });
                }
            };

            self.woocommerceActiveTag();

            var xhr;//xmlHttpRequest

            //Woocommerce pagination + woocommerce back-to-shop link
            self.$document.on('click', '.wc-ajax-content:not(.disable_pagination) nav.woocommerce-pagination li a, .back-to-shop', function (e) {
                // This will prevent event triggering more then once
                if ( e.handled !== true ) {
                    e.handled = true;
                    e.preventDefault();
                    self.goToTopShop();

                    $('.shop-filter .search-box').removeClass('open');
                    $('.shop-filter .search-box').siblings('.filter-search-form-container').removeClass('open');
                    $('.shop-filter .search-box').siblings('.special-filter.cat').removeClass('hide');
                    $('.shop-filter .search-box').siblings('.special-filter.sort').removeClass('hide');

                    if ( !$('.shop-filter .search-box').hasClass('open') ) {
                        $(".shop-filter .search-hint").addClass('hide');
                    }
                    $('.filter-search-form-container form').removeClass('start_search');
                    $('.filter-search-form-container form input').val('');

                    getWoocommerceContent($(this).attr('href'), false);
                }
            });

            //Woocommerce Layered nav + Layered nav filter (filter by and active filters widgets) + on sale filter + in stock filter + sorting filter
            self.$document.on('click', '.special-filter.sort li a,.widget_layered_nav li a, .widget_layered_nav_filters li a,.on-sale-filter a,.in-stock-filter a,.clearfilters a', function (e) {
                // This will prevent event triggering more then once
                if ( e.handled !== true ) {
                    e.handled = true;
                    e.preventDefault();

                    if ( !isActiveAjaxRequest() ) {
                        $(this).closest('li').addClass('pending');
                    } else {
                        $(this).closest('ul').find('.pending').removeClass('pending').toggleClass('chosen');
                    }

                    $(this).closest('li').toggleClass('chosen');
                    getWoocommerceContent($(this).attr('href'));
                }
            });
            self.$document.on('click', '#kt-modal.sort-modal ul.list li a', function (event) {
                event.preventDefault();
                getWoocommerceContent($(this).attr('href'));
                self.closeSortPopup();
            });
            //Woocommerce rating filter
            self.$document.on('click', '.widget_rating_filter li a', function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();
                    if ($(this).closest('ul').find('li.chosen').is($(this).closest('li'))) {
                        $(this).closest('li').toggleClass('chosen');
                    } else {
                        $(this).closest('li').toggleClass('chosen');
                    }

                    getWoocommerceContent($(this).attr('href'));
                }

            });

            //Woocommerce ranged price filter, sorting widget
            self.$document.on('click', '.widget_ranged_price_filter li a,.widget_order_by_filter li a', function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();
                    $(this).closest('ul').find('li.current').removeClass('current');
                    $(this).closest('li').toggleClass('current');
                    getWoocommerceContent($(this).attr('href'));
                }

            });

            //Woocommerce tag cloud widget
            self.$document.on('click', '.widget.woocommerce.widget_product_tag_cloud a', function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();
                    $(this).closest('.tagcloud').find('.current-tag').removeClass('current-tag');
                    $(this).addClass('current-tag');
                    getWoocommerceContent($(this).attr('href'));
                }

            });

            //Woocommerce categories
            self.$document.on('click', '.widget_product_categories li a', function (e) {

                // When shop page is set to show just categories or subcategories - filter ajax not work
                if ($(this).parents('.shop_is_categories_style').length) {
                    return;
                }

                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();
                    $(this).closest('.widget_product_categories').find('.current-cat').removeClass('current-cat');
                    $(this).closest('li').addClass('current-cat');
                    getWoocommerceContent($(this).attr('href'), true);
                    $('body').on( 'woocommerce-content-updated', function() {
                        if ( ! $('body').hasClass('categories-scroll-animation') ) {
                            return;
                        }
                        var topOffset = $('.wc-ajax-content').length ? $('.wc-ajax-content').offset().top : $('#main-content').offset().top ;
                        $('html, body').animate(
                            {
                              scrollTop: topOffset - 80,
                            },
                            'slow',
                            'linear'
                        );
                    });
                }

            });

            //Woocommerce categories
            self.$document.on('select2-open', '.widget_product_categories .dropdown_product_cat:not(.change_event_removed)', function (e) {
                $(this).addClass('change_event_removed');
                $('.dropdown_product_cat').unbind('change');
            });
            self.$document.on('change', '.widget_product_categories select', function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    var selected = $(this).find('option:selected').val(),
                        url,
                        homeUrl = kite_theme_vars.home_url;

                    if ( homeUrl.indexOf('?') > 0 ) {
                        url = homeUrl + '&product_cat=' + selected;
                    } else {
                        url = homeUrl + '?product_cat=' + selected;
                    }

                    getWoocommerceContent(url, true);
                }

            });

            //Woocommerce price filter
            self.$document.on('click', '.widget_price_filter button.button', function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();

                    var url = window.location.href,
                        minPrice = $(this).siblings('#min_price').val(),
                        maxPrice = $(this).siblings('#max_price').val();

                    //Update/add min_price and max_price
                    url = self.updateQueryStringParameter(url, 'min_price', minPrice);
                    url = self.updateQueryStringParameter(url, 'max_price', maxPrice);

                    getWoocommerceContent(url);
                }

            });
            //switch view
            if ( $('.products.woocommerce').hasClass('list_view') ) {
                $('.views_button.list').addClass('active');
            } else {
                $('.views_button.grid').addClass('active');
            }
            var $viewsButton = $(".views_button");

            $viewsButton.click(function (e) {
                e.preventDefault();
                let $thisItem = $(this),
                    url = window.location.href,
                    $shopContainer = $(".products.woocommerce");

                $viewsButton.removeClass("active");
                $thisItem.addClass("active");

                if ($thisItem.hasClass('grid') && $shopContainer.hasClass('list_view')) {

                    url = self.updateQueryStringParameter(url, 'view', 'grid');
                    getWoocommerceContent(url);
                } else if ( $thisItem.hasClass('list') && $shopContainer.hasClass('grid_view') ) {
                    url = self.updateQueryStringParameter(url, 'view', 'list');
                    getWoocommerceContent(url);
                }

            });

            //Woocommerce per page filter
            self.$document.on('click', '.product_per_page_filter .num', function (e) {
                // This will prevent event triggering more then once
                if ( e.handled !== true ) {
                    e.handled = true;
                    e.preventDefault();
                    if ( $(this).hasClass('selected') ) {
                        return;
                    }
                    var url = window.location.href,
                        perPage = $(this).data('num'),
                        $this = $(this);

                    $('.product_per_page_filter .num').each(function (index, el) {
                        if ( $(this).is($this) ) {
                            $(this).addClass('selected');
                        } else {
                            $(this).removeClass('selected');
                        }
                    });
                    //Update/add min_price and max_price
                    url = self.updateQueryStringParameter(url, 'per-page', perPage);

                    getWoocommerceContent(url);
                }

            });

            //Woocommerce sort
            //Unbind previous function and bind new function to orderby select
            $('.woocommerce-ordering').off('change', 'select.orderby');
            $('.woocommerce-ordering').on('change', 'select.orderby', function () {

                var selected = $(this).find('option:selected').val();
                var url = window.location.href;

                //Update/add orderby
                url = self.updateQueryStringParameter(url, 'orderby', selected);

                getWoocommerceContent(url);

            });

            //Woocommerce search
            self.$document.find("form.woocommerce-product-search").each(function () {
                var $this = $(this);
                $this.submit(function (e) {
                    e.preventDefault();
                    $this.addClass('start_search');
                    var keyword = $this.find('input.search-field').val();
                    if ( keyword != '' ) {
                        //Hide virtual keyboard in mobiles
                        $this.find('input.search-field').blur();

                        var url = $this.attr('action');
                        //Update/add orderby
                        url = self.updateQueryStringParameter(url, 's', keyword);
                        //Do not add post_type to URL if this form is in category page
                        if ($this.attr('data-type') != 'category') {
                            url = self.updateQueryStringParameter(url, 'post_type', 'product');
                        }
                        getWoocommerceContent(url);
                    }
                });
            });
            self.$document.find('form.woocommerce-product-search .cross_close_link').on('click', function (event) {
                event.preventDefault();
                var $url = $(this).attr('href');
                $(this).parents('form.woocommerce-product-search').removeClass('start_search');

                $('.shop-filter .search-box').removeClass('open');
                $('.shop-filter .search-box').siblings('.filter-search-form-container').removeClass('open');
                $('.shop-filter .search-box').siblings('.special-filter.cat').removeClass('hide');
                $('.shop-filter .search-box').siblings('.special-filter.sort').removeClass('hide');
                $('.shop-filter .search-box').siblings('#switch_view_buttons').removeClass('hide');
                $('.shop-filter .search-box').siblings('.product_per_page_filter').removeClass('hide');

                if (!$('.shop-filter .search-box').hasClass('open')) {
                    $(".shop-filter .search-hint").addClass('hide');
                }

                $(this).siblings('input').val('');
                getWoocommerceContent($url);
            });

            // remove search keyword and Update Product
            self.$document.on("click", ".shop-filter .search-keyword a", function (e) {
                // This will prevent event triggering more then once
                if (e.handled !== true) {

                    e.handled = true;
                    e.preventDefault();
                    $(this).closest('.search-keyword').toggleClass('show');
                    $('.special_layered_nav_filters').find('.search-keyword-active').removeClass('chosen');
                    getWoocommerceContent($(this).attr('href'));
                }
            });

            // Search Hint [ Press "Enter" to search ]
            self.$document.on("keyup", ".shop-filter .filter-search-form-container input[type='search']", function (e) {
                var len = $(this).val().length,
                    $searchHint = $(".shop-filter .search-hint");
                if ( len >= 2 ) {
                    $searchHint.removeClass('hide')
                } else {
                    $searchHint.addClass('hide')
                }
            }).on("keydown", ".shop-filter .filter-search-form-container input[type='search']", function (e) {
                if ( e.which === 13 && $(this).val() != '' ) {
                    setTimeout(function () {
                        $(".shop-filter .search-hint").addClass('hide');
                        $(".shop-filter .search-keyword").removeClass('show');
                    }, 300)
                }
            });
        },

        searchBoxToggle: function () {
            var self = this;

            $(".shop-filter .search-box").on("click", function (e) {
                $(this).toggleClass('open');
                $(this).siblings('.filter-search-form-container').toggleClass('open');
                $(this).siblings('.special-filter.cat').toggleClass('hide');
                $(this).siblings('.special-filter.sort').toggleClass('hide');
                $(this).siblings('#switch_view_buttons').toggleClass('hide');
                $(this).siblings('.product_per_page_filter').toggleClass('hide');

                //only run on tablet and mobiles
                if (self.windowWidth < 1025 && $('.shop-filter-toggle').hasClass('open')) {
                    $(this).parent('.shop-filter').toggleClass('open');
                }

                if (!$('.shop-filter .search-box').hasClass('open')) {
                    $(".shop-filter .search-hint").addClass('hide');
                }
                $('.filter-search-form-container #woocommerce-product-search-field').focus();

            });
        },

        // shop pagination
        productsPagination: function () {
            var self = this,
                $shopContainer = $(".woocommercepage"),
                $productsContainer = $(".woocommercepage .woocommerce.products"),
                $productsPagination = $('.woocommerce-pagination li a.next'),
                $mainContainer = self.$body,
                loadMoreText = $productsContainer.data('lm-text'),
                layoutMode = $productsContainer.data('layoutmode');

                if ( ! $productsContainer.length ) {
                    return;
                }
                $productsContainer.each(function(){
                    if ( ! $(this).find('div.product').hasClass('product-category') ) {

                        if ($productsPagination.length > 0) {
                            $(this).after("<div class='page-load-status'></div>");
                            var $loadStatus = $(".page-load-status");
                        }

                        if ($shopContainer.hasClass('infinite_scroll')) {
                            var $paginationMethod = "infinite_scroll";
                        } else if ($shopContainer.hasClass('load_more')) {
                            if ( $loadStatus ) {
                                $loadStatus.append("<button class='view-more-button'>" + loadMoreText + "</button>");
                            }
                            var $paginationMethod = "load_more";
                        } else {
                            var $paginationMethod = "pagination";
                        }

                        if ( $paginationMethod != 'pagination' && $productsPagination.length > 0 ) {

                            var $container = $(this).infiniteScroll({
                                path: '.woocommerce-pagination li a.next',
                                append: '.main-shop-loop .product',
                                checkLastPage: true,
                                status: '.page-load-status',
                                hideNav: '.woocommerce-pagination',
                                button: '.view-more-button',
                                history: 'replace',
                                debug: false,
                            });

                            if ($paginationMethod == 'load_more') {
                                $container.infiniteScroll('option', {
                                    scrollThreshold: false,
                                    loadOnScroll: false,
                                });
                            }

                            var $grid = $container.imagesLoaded(function () {
                                $grid.isotope({
                                    itemSelector: '.product',
                                    layoutMode: layoutMode,
                                    originLeft: ( ! $('body').hasClass('rtl') )
                                });
                            });

                            $grid.on('request.infiniteScroll', function (event, path) {

                                if ($paginationMethod == 'infinite_scroll') {
                                    $loadStatus.addClass('loading-next-page');
                                }

                                if ($paginationMethod == "load_more") {
                                    $loadStatus.addClass('teta-loading-next-page');
                                }

                            });
                            $grid.on('append.infiniteScroll', function (event, response, path, items) {

                                $grid.find('.product').addClass('isotope-item');
                                self.runIsotopeInProducts($mainContainer);

                                for (var index =0; index < items.length; index++) {
                                    items[index].classList.add('appended-item');
                                }

                                var $items = $('.appended-item');
                                $grid.append($items).isotope('appended', $items);

                                self.lazyLoadOnLoad($items);
                                self.lazyLoadOnHover();
                                self.buttonsAppearUnderHover($items);
                                self.productsInfoOnClick($items);
                                self.woocommerceVariationItemSelect($items);
                                
                                for (var index = 0; index < items.length; index++) {
                                    items[index].classList.remove('appended-item');
                                }

                                $loadStatus.removeClass('loading-next-page');
                                $loadStatus.removeClass('teta-loading-next-page');

                                if ($paginationMethod == 'load_more') {
                                    $loadStatus.css('display', 'block');
                                    $loadStatus.find('.view-more-button').css('visibility', 'visible');
                                }
                                self.productQuickView();
                                self.compare();
                                self.woocommerceButtonsOnHoverCartClick();
                                self.woocommerceVariationItemSelect();

                            });

                            $grid.on('last.infiniteScroll', function (event, response, path) {
                                $loadStatus.remove();
                            });
                        }
                    }
                });
        },

        //switch view
        switchView: function () {
            var self = this;
            var $shopFilter = $('.woocommercepage .shop-filter');

            self.kiteScrollBar('div.products.list_view .wrap_after_thumbnail .product__decription');

            if ( $shopFilter.hasClass('no-categories-filter') ) {
                $('.woocommerce .shop-filter .filter-search-form-container').css('border-radius', '50px');
                $('.search-box').click(function () {
                    if ( $(this).hasClass('open') ) {
                        $('.woocommerce .shop-filter .filter-search-form-container.open').css('width', 'calc(100% - 310px)');
                    } else {
                        $('.woocommerce .shop-filter .filter-search-form-container').css('width', '0');
                    }
                });

            }
        },

        shopHeadCatResponsive: function () {
            $('.responsive_cat_icon').on('click', function () {
                $(this).parents('.header_cats').toggleClass('show');
            });
        },
        shopHeadCatDisplay: function () {
            var $headerContent = $('#header.shoppage #header-content');
            if ( $(window).width() <= 1140 ) {
                $headerContent.parents('#header').css({
                    'background-image': 'none',
                    'transition': 'none',
                });
            }

        },
    };

    kiteTheme = Object.assign( kiteTheme, shop );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.initShop();
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/single-product.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  Single Product
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var singleProduct = {

        initSingleProduct: function() {
            this.productDetailHeight();
            this.productSizeGuide();
            this.productSizeGuidePopup();
            this.productDeliveryReturnPopup();
            this.productFaqPopup();
            this.productAccordionStyle();
            this.productTabs();
            this.productImageZoom();
            this.stickyProductThumbnails();
            this.productGalleryPopupLightGallery();
            this.reviewForm();
            this.productNextPrevButton();
            this.fixedAddToCartFunctionality();
            this.syncFixedAddToCart();
            this.fixedAddToCartVisibility();
            this.fixedProductStyle();
            this.product360View();
            this.tabsTourAccordion();
            this.tabsTourAccordionHeight();
            this.tabScrollbar();
            this.boughtTogetherProduct();
            this.buyNow();
        },

        singleProductResizeEvent: function() {
            this.productDetailHeight();
        }, 

        /*-----------------------------------------------------------------------------------*/
        /*  Set product detail appropriate height
        /*-----------------------------------------------------------------------------------*/
        productDetailHeight: function () {
            var self = this;

            var topSpace = self.pageTopSpace();

            if ( ( $('div.product.pd_top').length <= 0 ) || ( $('div.product.pd_fullwidth_top').length <= 0 ) ) {
                return;
            }


            // max-height - top product detail
            topSpace = topSpace + 60; // 60 is breadcrumb height+ paddings

            if ($('#product-thumbs').length > 0) {
                topSpace = topSpace + 100; // 100 is height of product thumbs
            }
            $('.woocommerce div.product.pd_top div.images img').css("max-height", self.windowHeight - topSpace);

        },

        /*-----------------------------------------------------------------------------------*/
        /*  Product detail size guide
        /*-----------------------------------------------------------------------------------*/

        productSizeGuide: function () {
            var self = this;
            var $sizeGuide = $('#ct_size_guide,.ct-size-guide');

            if ( !self.$body.hasClass('single-product') ) {
                return;
            }

            var $sizeGuideModal = self.$document.find('#kt-modal'),
                $sizeGuideContent = $sizeGuideModal.find('#modal-content');

            if ( $sizeGuideModal.length <= 0 || $sizeGuide.length <= 0 || $sizeGuide.hasClass('ct_sg_tabbed') ) {
                return;
            }

            $('.button_sg').on('click', function (e) {
                e.preventDefault();

                $sizeGuideModal.addClass('hidden-nav');

                self.$body.addClass('modal-open'); // disable scrollbar
                $sizeGuideModal.addClass('size-guide-modal');

                if (!$sizeGuideModal.removeClass('closed').hasClass('open')) {
                    $sizeGuideModal.removeClass('loading').addClass('open');
                }

                var $data = $sizeGuide.removeClass('mfp-hide');

                $sizeGuideContent.html($data);
                $sizeGuideModal.addClass('shown').prepend('<div class="mfp-bg"></div>'); // content is ready, so show it
            });


            // Close quickview by click outside of content
            $sizeGuideModal.on('click', function (e) {
                if ( !$sizeGuideContent.is(e.target) && $sizeGuideContent.has(e.target).length === 0 ) {
                    self.closeSizeGuide();
                }
            });

            // Close quickview by click close button
            self.$document.on('click', '#kt-modal.size-guide-modal #modal-close', function (e) {
                e.preventDefault();
                self.closeSizeGuide();
            });

            // Close box with esc key
            self.$document.keyup(function (e) {
                if (e.keyCode === 27) {
                    self.closeSizeGuide();
                }
            });
        },

        closeSizeGuide: function () {
            var self = this;

            var $sizeGuideModal = self.$document.find('#kt-modal.size-guide-modal'),
                $sizeGuideContent = $sizeGuideModal.find('#modal-content');

            $sizeGuideModal.removeClass('shown loading open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $sizeGuideModal.removeClass('size-guide-modal');
            }, 300)

            setTimeout(function () {
                var $data = $sizeGuideContent.html();
                $('#main').append($data);
                $('#ct_size_guide,.ct-size-guide').addClass('mfp-hide')
                $sizeGuideContent.html('');
                $sizeGuideModal.find('.mfp-bg').remove();
            }, 800);
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Product detail size guide popup
        /*-----------------------------------------------------------------------------------*/

        productSizeGuidePopup: function () {
            var self = this;
            var $sizeGuide = $('.product-popup-content-sizeguid');

            if ( !self.$body.hasClass('single-product') ) {
                return;
            }

            var $sizeGuideModal = self.$document.find('#kt-modal'),
                $sizeGuideContent = $sizeGuideModal.find('#modal-content');

            if ( $sizeGuideModal.length <= 0 || $sizeGuide.length <= 0 ) {
                return;
            }

            $('.product-popup.size-guide').on('click', function (e) {
                e.preventDefault();

                self.$body.addClass('modal-open'); // disable scrollbar
                $sizeGuideModal.addClass('size-guide-popup-modal');

                if ( !$sizeGuideModal.removeClass('closed').hasClass('open') ) {
                    $sizeGuideModal.removeClass('loading').addClass('open');
                }

                var $data = $sizeGuide.removeClass('hidden');

                $sizeGuideContent.html($data);
                $sizeGuideModal.addClass('shown');
            });


            // Close quickview by click outside of content
            $sizeGuideModal.on('click', function (e) {
                if ( !$sizeGuideContent.is(e.target) && $sizeGuideContent.has(e.target).length === 0 ) {
                    self.closeSizeGuidePopup();
                }
            });

            // Close quickview by click close button
            self.$document.on('click', '#kt-modal.size-guide-popup-modal #modal-close', function (e) {
                e.preventDefault();
                self.closeSizeGuidePopup();
            });

            // Close box with esc key
            self.$document.keyup(function (e) {
                if (e.keyCode === 27) {
                    self.closeSizeGuidePopup();
                }
            });
        },

        closeSizeGuidePopup: function () {
            var self = this;

            var $sizeGuideModal = self.$document.find('#kt-modal.size-guide-popup-modal'),
                $sizeGuideContent = $sizeGuideModal.find('#modal-content');

            $sizeGuideModal.removeClass('shown open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $sizeGuideModal.removeClass('size-guide-popup-modal');
            }, 0);

            setTimeout(function () {
                var $data = $sizeGuideContent.html();
                $('#main').append($data);
                $('.product-popup-content-sizeguid').addClass('hidden')
                $sizeGuideContent.html('');
            }, 1);
        },

		/*-----------------------------------------------------------------------------------*/
        /*  Product detail delivery return popup
        /*-----------------------------------------------------------------------------------*/
        productDeliveryReturnPopup: function () {
            var self = this;
            var $deliveryReturn = $('.product-popup-content-delivery');

            if ( !self.$body.hasClass('single-product') ) {
                return;
            }

            var $deliveryReturnModal = self.$document.find('#kt-modal'),
                $deliveryReturnContent = $deliveryReturnModal.find('#modal-content');

            if ($deliveryReturnModal.length <= 0 || $deliveryReturn.length <= 0 ) {
                return;
            }

            $('.product-popup.delivery-return').on('click', function (e) {
                e.preventDefault();

                self.$body.addClass('modal-open'); // disable scrollbar
                $deliveryReturnModal.addClass('delivery-return-modal');

                if (!$deliveryReturnModal.removeClass('closed').hasClass('open')) {
                    $deliveryReturnModal.removeClass('loading').addClass('open');
                }

                var $data = $deliveryReturn.removeClass('hidden');

                $deliveryReturnContent.html($data);
                $deliveryReturnModal.addClass('shown');
            });


            $deliveryReturnModal.on('click', function (e) {
                if (!$deliveryReturnContent.is(e.target) && $deliveryReturnContent.has(e.target).length === 0) {
                    self.closeDeliveryReturn();
                }
            });
            self.$document.on('click', '#kt-modal.delivery-return-modal #modal-close', function (e) {
                e.preventDefault();
                self.closeDeliveryReturn();
            });

            self.$document.keyup(function (e) {
                if (e.keyCode === 27) {
                    self.closeDeliveryReturn();
                }
            });
        },

        closeDeliveryReturn: function () {
            var self = this,
                $deliveryReturnModal = self.$document.find('#kt-modal.delivery-return-modal'),
                $deliveryReturnContent = $deliveryReturnModal.find('#modal-content');

            $deliveryReturnModal.removeClass('shown loading open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $deliveryReturnModal.removeClass('delivery-return-modal');
            }, 0)

            setTimeout(function () {
                var $data = $deliveryReturnContent.html();
                $('#main').append($data);
                var $deliveryReturn = $('.product-popup-content-delivery');
                $deliveryReturn.addClass('hidden')
                $deliveryReturnContent.html('');

            }, 1);
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Product detail faq popup
        /*-----------------------------------------------------------------------------------*/

        productFaqPopup: function () {
            var self = this,
                $faq = $('.product-popup-content-faq');

            if ( !self.$body.hasClass('single-product') ) {
                return;
            }

            var $faqModal = self.$document.find('#kt-modal'),
                $faqContent = $faqModal.find('#modal-content');

            if ($faqModal.length <= 0 || $faq.length <= 0 ) {
                return;
            }

            $('.product-popup.ask-question').on('click', function (e) {
                e.preventDefault();

                self.$body.addClass('modal-open'); // disable scrollbar
                $faqModal.addClass('faq-modal');

                if ( !$faqModal.removeClass('closed').hasClass('open') ) {
                    $faqModal.removeClass('loading').addClass('open');
                }

                var $data = $faq.removeClass('hidden');

                $faqContent.html($data);
                $faqModal.addClass('shown');
            });


            // Close quickview by click outside of content
            $faqModal.on('click', function (e) {
                if ( !$faqContent.is(e.target) && $faqContent.has(e.target).length === 0 ) {
                    self.closeFaq();
                }
            });

            // Close quickview by click close button
            self.$document.on('click', '#kt-modal.faq-modal #modal-close', function (e) {
                e.preventDefault();
                self.closeFaq();
            });

            // Close box with esc key
            self.$document.keyup(function (e) {
                if (e.keyCode === 27) {
                    self.closeFaq();
                }
            });
        },

        closeFaq: function () {
            var self = this;

            var $faqModal = self.$document.find('#kt-modal.faq-modal'),
                $faqContent = $faqModal.find('#modal-content');

            $faqModal.removeClass('shown loading open').addClass('closed');

            setTimeout(function () {
                self.$body.removeClass('modal-open');
                $faqModal.removeClass('faq-modal');
            }, 0)

            setTimeout(function () {
                var $data = $faqContent.html();
                $('#main').append($data);
                var $faq = $('.product-popup-content-faq');
                $faq.addClass('hidden')
                $faqContent.html('');

            }, 1);
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product  detail - tabs
        /*-----------------------------------------------------------------------------------*/
        //Modified version of Woocommerce/assets/js/frontend/single-product.js

        productAccordionStyle: function () {
            $('.hide-during-load').removeClass('hide-during-load');
            $( '.accordion-tab ul.tabs li' ).removeClass( 'active' );
            $( '.accordion-tab ul.tabs .panel' ).removeClass( 'current' ).slideUp(300);

            var $accTab = $( '.accordion-tab ul.tabs' );
            if( $accTab.find('#tab-more_seller_product') ) {
                $('.woocommerce-Tabs-panel .products.grid_view').removeClass('shop-4column , shop-5column , shop-3column').addClass('shop-2column');
            }
        },
        productTabs: function () {

            var self = this,
                ratingInitCount = 1; // Control to init rating Run Once time

            // wc_single_product_params is required to continue, ensure the object exists
            if (typeof wc_single_product_params === 'undefined') {
                return false;
            }

            // Tabs
            $('body')
                .on('init', '.wc-tabs-wrapper:not(.accordion-tab), .woocommerce-tabs:not(.accordion-tab)', function () {
                    $('.wc-tab.hide-during-load, .woocommerce-tabs .panel.hide-during-load:not(.panel .panel)').hide();

                    var hash = window.location.hash,
                        url = window.location.href,
                        $tabs = $(this).find('.wc-tabs, ul.tabs').first();

                    if ( hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews' ) {
                        $tabs.find('li.reviews_tab a').click();
                    } else if (url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {
                        $tabs.find('li.reviews_tab a').click();
                    } else {
                        $tabs.find('li:first a').click();
                    }
                    $('.hide-during-load').removeClass('hide-during-load');
                })
                //Kitest codes (custom version of click event for tabs)
                .on('click', '.wc-tabs li a, ul.tabs li a', function () {
                    var $this = $(this),
                        $currentPanelID = $this.attr('href'),
                        $currentPanel = $('.woocommerce-tabs').find($currentPanelID),
                        $visiblePanel = $currentPanel.siblings('.panel').filter(':visible');

                    if( $('.woocommerce-tabs').hasClass('accordion-tab') ){
                        if( $this.parent().hasClass( 'active' ) ) {
                            self.productAccordionStyle();
                            self.updateDocHeight();
                        } else {
                            self.productAccordionStyle();
                            $this.parent().addClass( 'active' );
                            $( '.accordion-tab ' + $currentPanelID ).addClass( 'current' ).slideDown(500, function () {
                                self.updateDocHeight();
                            });
                        }
                    } else{

                        $this.parent().siblings().removeClass('active').end().addClass('active');

                        if ( $visiblePanel.length <= 0 ) {
                            $currentPanel.addClass('current').fadeIn(300, function () {
                                self.updateDocHeight();
                            });
                        } else {
                            $visiblePanel.stop().fadeOut(300, function () {
                                $currentPanel.siblings('.panel').removeClass('current');
                                $currentPanel.addClass('current').stop().fadeIn(300, function () {
                                    self.updateDocHeight();
                                });
                            });
                        }
                    }

                    return false;
                })
                // Review link
                .on('click', 'a.woocommerce-review-link', function () {
                    $('.reviews_tab a').click();
                    return true;
                })
                //kiteSt code : modified version
                .on('init', '#rating', function () {
                    if (ratingInitCount == 1) { // Control to init rating Run Once time
                        $('#rating').hide().before('<p class="stars review_rating"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');
                        ratingInitCount++;
                    }
                })
                .on('click', '#respond p.stars a', function () {
                    var $star = $(this),
                        $rating = $(this).closest('#respond').find('#rating'),
                        $container = $(this).closest('.stars');

                    $rating.val($star.text());
                    $star.siblings('a').removeClass('active');
                    $star.addClass('active');
                    $container.addClass('selected');

                    return false;
                })
                .on('click', '#respond #submit', function () {
                    var $rating = $(this).closest('#respond').find('#rating'),
                        rating = $rating.val();

                    if ($rating.length > 0 && !rating && wc_single_product_params.review_rating_required === 'yes') {
                        window.alert(wc_single_product_params.i18n_required_rating_text);

                        return false;
                    }
                })

            //KiteSt code : modified version
            if (ratingInitCount === 1) { // Control to init rating Run Once time
                //Init Tabs and Star Ratings
                $('.wc-tabs-wrapper, .woocommerce-tabs, #rating').trigger('init');
                ratingInitCount++;
            }

        },

        /*-----------------------------------------------------------------------------------*/
        /*  product  detail - zoom effect 
        /*-----------------------------------------------------------------------------------*/

        productImageZoom: function () {
            var self = this;
            if ( self.windowWidth <= 979 && self.$body.hasClass( 'kt-responsive-zoom-disable' ) ) {
                return;
            }

            var onState = self.windowWidth <= 979 ? 'toggle' : 'mouseover';
            $('.zoom-container.enable .swiper-slide').each(function () {
                var $zoomImage = $(this).attr('data-zoom-image');
                $(this).zoom({
                    url: $zoomImage,
                    on: onState
                });
            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  product - sticky product thumbnails
        /*-----------------------------------------------------------------------------------*/	
        stickyProductThumbnails: function () {
            var self = this;
            var menuHeight = 0;
            if ($('#wpadminbar').length)
                var wpAdminBarHeight = $('#wpadminbar').height();
            else
                var wpAdminBarHeight = 0; 
            if ($('#headersecondstate').length > 0) {
                var menuHeight = $('#headersecondstate').outerHeight();
            } 
            if ($('.product').hasClass('pd_sticky') && self.windowWidth > 979) {
                if ( $('.pd_sticky').length > 0) {
                    $('#product-thumbs .swiper-slide').on('click', function (event) {
                        var $stickyIndex = $( this ).attr( 'data-image-attribute' );
                        var $offsetTopValue = $( '#product-fullview-thumbs .swiper-slide:eq( ' + $stickyIndex + ' )' );
                        $offsetTopValue = $offsetTopValue.offset().top;
                        $('html, body').stop()
                            .animate({
                                'scrollTop': $offsetTopValue
                            });
                    });
                }
                if( ( $( '.summary.entry-summary , #product-thumbs' ).length > 0 ) && ($(window).width() > 1220) ) {
                    $('.summary.entry-summary , #product-thumbs').imagesLoaded( function() {
                        $( '.summary.entry-summary , #product-thumbs' ).stick_in_parent({
                            offset_top:menuHeight+wpAdminBarHeight+32
                        });
                    });
                }
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  light galley for product detail
        /*-----------------------------------------------------------------------------------*/

        productGalleryPopupLightGallery: function () {
            if (typeof $.fn.lightGallery !== 'function' || $('#product-fullview-thumbs .enable-popup').length <= 0) {
                return;
            }

            var $productPopupGallery = $('#product-fullview-thumbs');
            $productPopupGallery.lightGallery({
                selector: '.enable-popup',
                getCaptionFromTitleOrAlt: false
            });

            $('.popup-button').on('click', function () {
                $productPopupGallery.find('.swiper-slide').trigger('click.lgcustom');
            });

            $productPopupGallery.on('onSlideClick.lg', function () {
                $productPopupGallery.data('lightGallery').goToNextSlide();
            });
        },

        /*----------------------------------------------------------------------------------*/
        /*  ReviewForm  blog and product details
        /*-----------------------------------------------------------------------------------*/

        reviewForm: function () {

            // product detail
            if ( $('#review_form').length ) {


                $("#review_form input").focus(function () {
                    $(this).siblings('.label').addClass('inputfocus');
                    $(this).siblings('.graylabel').addClass('inputfocus');
                });


                $("#review_form input").focusout(function () {
                    $(this).siblings('.label').removeClass('inputfocus');
                    $(this).siblings('.graylabel').removeClass('inputfocus');
                });

                $("#review_form textarea").focus(function () {
                    $(this).siblings('.label').addClass('inputfocus');
                    $(this).siblings('.graylabel').addClass('inputfocus');
                });


                $("#review_form textarea").focusout(function () {
                    $(this).siblings('.label').removeClass('inputfocus');
                    $(this).siblings('.graylabel').removeClass('inputfocus');
                });

            }

        },

        /*----------------------------------------------------------------------------------*/
        /* Next/prev button for product
        /*-----------------------------------------------------------------------------------*/

        productNextPrevButton: function () {
            var self = this;

            if ( self.$body.hasClass('single-product') ) {
                var $originalNextButton = $('#main span#next-product'),
                    $originalPrevButton = $('#main span#prev-product');
                if ( $originalNextButton.length > 0 ) {
                    if ($('.toggle-sidebar-container').siblings('span#next-product').length > 0 || $('.toggle-sidebar-container').siblings('span#prev-product').length > 0) {
                        if ( $originalNextButton.find('a').length > 0 ) {
                            $('.toggle-sidebar-container').siblings('span#next-product').addClass('visible').empty('').html($originalNextButton.html());
                        } else {
                            $('.toggle-sidebar-container').siblings('span#next-product').removeClass('visible');
                        }

                        if ( $originalPrevButton.find('a').length > 0 ) {
                            $('.toggle-sidebar-container').siblings('span#prev-product').addClass('visible').empty('').html($originalPrevButton.html());
                        } else {
                            $('.toggle-sidebar-container').siblings('span#prev-product').removeClass('visible');
                        }
                    } else {
                        $('.toggle-sidebar-container').after($originalNextButton).after($originalPrevButton);
                        setTimeout(function () {
                            $originalNextButton.addClass('visible');
                            $originalPrevButton.addClass('visible');
                        }, 200);
                    }
                }
            } else {
                $('span#next-product').removeClass('visible');
                $('span#prev-product').removeClass('visible');
            }
        },

        /*----------------------------------------------------------------------------------*/
        /* Fixed add to cart
        /*-----------------------------------------------------------------------------------*/

        fixedAddToCartFunctionality: function () {

            var self = this;

            if ($('div.product.parent_div_product').length <= 0 || !self.$body.hasClass('fixed-add-to-cart-enable')) {
                return;
            }

            if ((($('.kt_product_page > div.product').hasClass('product-type-variable')) && self.windowWidth < 1140) || $('.kt_product_page > div.product').hasClass('product-type-grouped')) {
                $('a.single_add_to_cart_button').removeClass('add_to_cart_button').addClass('go-to-add-to-cart'); // change type of add-to-cart button
            } else {
                $('a.single_add_to_cart_button').addClass('add_to_cart_button').removeClass('go-to-add-to-cart'); // change type of add-to-cart button
            }

            //update add to cart button text
            var $add_to_cart_button = $('a.single_add_to_cart_button');
            if ( $('.fixed-add-to-cart-container a.single_add_to_cart_button .txt').empty() && $add_to_cart_button.length ) {

                if ($add_to_cart_button.eq(0).find('.txt').html()) {
                    var $add_to_cart_text = $add_to_cart_button.eq(0).find('.txt').html().trim();
                } else { 
                    // Add this line code becuse some translate plugin remove span.text and this cuase error
                    var $add_to_cart_text = $add_to_cart_button.eq(0).html().trim();
                }

                $('.fixed-add-to-cart-container a.single_add_to_cart_button .txt').html($add_to_cart_text).attr('data-hover', $add_to_cart_text);
                $('.fixed-add-to-cart-container a.single_add_to_cart_button').attr('title', $add_to_cart_text);
            }

            $('.fixed-add-to-cart .go-to-add-to-cart').on('click', function (e) {
                e.preventDefault();

                var $top;

                if ($('table.variations').length > 0) {
                    $top = $('table.variations').offset().top;
                } else {
                    $top = $('a.add_to_cart_button , a.single_add_to_cart_button').eq(0).offset().top;
                }
                if ($('#wpadminbar').length) {
                    var wpAdminBarHeight = $('#wpadminbar').height();
                } else {
                    var wpAdminBarHeight = 0;
                }
                $top = $top - (100 + wpAdminBarHeight);

                self.$scrollpals.stop().animate(

                    { scrollTop: $top },
                    1000,
                    'easeOutQuad'
                );

            });

             $('.fixed-add-to-cart a.single_add_to_cart_button:not(.product_type_variable)').not('.go-to-add-to-cart').on('click', function (e) {
                e.preventDefault();
                $('a.single_add_to_cart_button')[0].click();
            });
            $('.fixed-add-to-cart').find($('form.cart .yith-wcwl-add-to-wishlist')).remove();
            $('.fixed-add-to-cart').find($('form.cart .compare.button')).remove();

            //compare button
            $('.scrolltotop a.compare').on('click', function (e) {
                e.preventDefault();
                $('.woocommerce div.product div.summary a.compare').eq(0).trigger('click');
            });


        },

        syncFixedAddToCart: function () {

            var self = this;

            if ( $('div.product.parent_div_product').length <= 0 || !self.$body.hasClass('fixed-add-to-cart-enable') ) {
                return;
            }

            //listen to event of add to cart button
            $(document.body).on('adding_to_cart', function () {
                self.$document.find('.single_add_to_cart_button').addClass('loading');
            });

            $(document.body).on('added_to_cart', function () {
                $('a.added_to_cart').removeClass('hide');
                $('.single_add_to_cart_button').addClass('added').removeClass('loading');
            });

            //listen to event of add to wishlist
            $(document.body).on('added_to_wishlist', function () {
                $('.fixed-add-to-cart .yith-wcwl-add-button').removeClass('show').addClass('hide');
                $('.fixed-add-to-cart .ajax-loading').css('visibility', 'hidden');
                $('.fixed-add-to-cart .yith-wcwl-wishlistaddedbrowse').removeClass('hide').addClass('show');
            });

            setTimeout(function () {
                // When the variation is revealed
                $("form.variations_form").on('show_variation', function (event, variation, purchasable) {
                    $('.fixed-add-to-cart a.added_to_cart').addClass('hide');
                    $('.fixed-add-to-cart a.single_add_to_cart_button').removeClass('added');
                });

            }, 200);


        },

        fixedAddToCartVisibility: function () {

            var self = this;

            if ($('div.product.parent_div_product').length <= 0 || !self.$body.hasClass('fixed-add-to-cart-enable') || $('.kt_product_page > div.product').hasClass('outofstock')) {
                $('.fixed-add-to-cart, .scrolltotop').removeClass('visible');
                return;
            }

            if ( self.$body.find( '.summary form.gift-cards_form' ).length ) {
                return;
            }

            var latestKnownScrollPosition = 0,
                tick = false,
                visibilityThreshold = 50,
                visibilityRangeStart = $('a.single_add_to_cart_button').eq(0).offset().top,
                visibilityRangeEnd = self.documentHeight - self.windowHeight - visibilityThreshold,//50px before footer
                $fixedAddToCart = $('.fixed-add-to-cart-container'),
                $scrollToTop = $(".scrolltotop"),
                isVerticalMenu = self.$body.hasClass('vertical_menu_enabled');

            if ($('table.variations').length > 0) {
                visibilityRangeStart = $('table.variations').offset().top;
            }

            var updateFxedAddToCartPosition = function () {

                if (latestKnownScrollPosition >= visibilityRangeStart /* && (isVerticalMenu) */) {
                    $fixedAddToCart.addClass('visible');
                    $scrollToTop.addClass('visible');
                }
                else {
                    $fixedAddToCart.removeClass('visible');
                    $scrollToTop.removeClass('visible');
                }

                tick = false;
            }

            updateFxedAddToCartPosition();

            var updateRange = function () {
               visibilityRangeEnd = self.documentHeight - self.windowHeight;
            }

            var doUpdateRange = function () {
                setTimeout(updateRange, 1000); // wait 1s to get correct document height
            }

            doUpdateRange()// update end of visibility range

            self.$window.on('document-height-changed', updateRange);

            var requestTick = function () {
                if (tick == false) {
                    window.requestAnimationFrame(updateFxedAddToCartPosition);
                }
                tick = true;
            }

            var onScroll = function () {
                latestKnownScrollPosition = self.$window.scrollTop();
                requestTick();
            }

            self.$window.on('scroll', onScroll);

            self.$window.one('djaxClick', function () {
                self.$window.unbind('scroll', onScroll).unbind('document-height-changed', updateRange);
            });

        },

        fixedProductStyle: function () {
            if ( $('.product.pd_fixed_summary').length != 0 && $(window).width() >= 979 ) {
                $('.product.pd_fixed_summary #product-fullview-thumbs').waitForImages(function(){
                    var $productSummary = $('.summary.entry-summary'),
                        $productSummaryHeight = $productSummary.height(),
                        summaryOffset = $('.summary').offset().top,
                        maxWidth = $('.images').width(),
                        windowWidth = $(window).height();

                    var imagesHeight = $('.images').height();
                    var imagesHeightAndOffset = imagesHeight + summaryOffset;
                    var menuHeight = $('#headerfirststate').outerHeight();
                    var topbarHeight = $('#topbar').height();
                    var offset = 0,
                        absoluteTrigger = 0;
                    if ( $('#wpadminbar').length ) {
                        var wpAdminBarHeight = $('#wpadminbar').height();
                    } else {
                        var wpAdminBarHeight = 0;
                    }

                    if ( $('#kt-header').hasClass('normal-menu') ) {
                        menuHeight = 0;
                        topbarHeight = 0;
                        summaryOffset = summaryOffset - wpAdminBarHeight - 32;
                        offset = wpAdminBarHeight + 32;
                    }

                    if ( $('#headersecondstate').length > 0 ) {
                        menuHeight = $('#headersecondstate').outerHeight();
                        summaryOffset = summaryOffset - menuHeight - wpAdminBarHeight - 32;
                        offset = menuHeight + wpAdminBarHeight + 32;
                    }

                    if ($('#kt-header').hasClass('fixed-menu')) {
                        menuHeight = $('#headerfirststate').outerHeight();
                        summaryOffset = summaryOffset - wpAdminBarHeight - menuHeight - topbarHeight - 32;
                        offset = topbarHeight + menuHeight + wpAdminBarHeight + 32;
                    }

                    var checkFirst = function () {
                        absoluteTrigger = $(document).scrollTop() + $productSummaryHeight + menuHeight + topbarHeight + wpAdminBarHeight + 32;
                        if ( absoluteTrigger >= imagesHeightAndOffset ) {
                            if ($('#headersecondstate').length > 0) {
                                var top = imagesHeight - $productSummaryHeight - 32;
                            } else {
                                var top = imagesHeight - $productSummaryHeight;
                            }
                            $('.summary').css({
                                'position': 'absolute',
                                'top': top,
                                'left': '50%',
                                'width': '50%',
                                'max-width': maxWidth
                            });

                        }
                        if ( $(document).scrollTop() >= summaryOffset && absoluteTrigger < imagesHeightAndOffset ) {
                            $productSummary.addClass('fixed');
                            $('.summary').css({
                                'position': 'fixed',
                                'top': offset,
                                'left': '50%',
                                'width': '50%',
                                'padding-left': '0px',
                                'max-width': maxWidth,
                            });
                        } else if ($(document).scrollTop() < summaryOffset) {
                            $productSummary.removeClass('fixed');
                            $('.summary').removeAttr('style');
                        }

                    }
                    checkFirst();
                    $(document).scroll(function () {
                        checkFirst();
                    });
                });
            }
        },

        // product 360 view
        product360View: function () {

            var $product360ViewContainer = $("#product-360-view-container"),
                $product360ViewButton = $("#product_360_view_popup"),
                $product360ViewClose = $(".product-360-view-close");

            if (($product360ViewContainer.length) > 0) {
                var load = document.getElementById('circularloader').getContext('2d');
                var al = 0,
                    start = 4.72,
                    ew = load.canvas.width,
                    eh = load.canvas.height,
                    diff;

                var progressSim = function () {
                    diff = ((al / 100) * Math.PI * 2 * 10).toFixed(2);
                    load.clearRect(0, 0, ew, eh);
                    load.lineWidth = 5;
                    load.fillStyle = '#000';
                    load.strokeStyle = "#000";
                    load.textAlign = "center";
                    load.font = "30px monospace";
                    load.fillText(al + '%', ew * .52, eh * .5 + 5, ew + 12);
                    load.beginPath();
                    load.arc(100, 100, 75, start, diff / 10 + start, false);
                    load.stroke();
                    $('#circularloader').css('display', 'block');
                    $('.kite-threed-view').css('display', 'none');
                    al++;
                    if ( al > 100 ) {
                        clearTimeout(sim);
                        $('#circularloader').css('display', 'none');
                        $('.kite-threed-view').css('display', 'block');
                    }

                }
                var sim = setInterval(progressSim, 100);
            }

            // when users click on the popup button, show the gallery 360
            $product360ViewButton.click(function () {
                $product360ViewContainer.css('display', 'block');
            });

            // When the user clicks on the X button, close it
            $product360ViewClose.click(function () {
                $product360ViewContainer.css('display', 'none');
            });

            //when users press ESC button, close the modal
            $("body").keyup(function (event) {
                if (event.which === 27) {
                    $product360ViewContainer.css('display', 'none');
                }
            });

        },

        /*-----------------------------------------------------------------------------------*/
        /*  tabs
        /*-----------------------------------------------------------------------------------*/

        tabsTourAccordion: function () {

            var self = this;
            if ($('.vc_tta-panels-container .vc_tta-panel').not('.show')) {
                $('.vc_tta-panels div:nth-child(1)').addClass('show vc_active');
            }

            // tabsTourAccordion Height
            self.tabsTourAccordionHeight();

            //Tab & Tour
            $('.vc_tta-container .vc_tta-tabs .vc_tta-tabs-list a').addClass('no_djax').on('click', function (e) {
                // Fixing tab issue when clicking (Jump to content bug)
                e.preventDefault();


                var $currentTab = $(this);
                if ( $currentTab.closest('ul').hasClass('ui-sortable') ) {
                    var ttaTab = ('data-vc-target');
                } else {
                    var ttaTab = ('href');
                }

                var $container = $currentTab.closest('.vc_tta-container'),
                    $currentPanelID = $($currentTab.attr(ttaTab)),
                    $previousTabID = $($currentTab.closest('.vc_tta-tabs-list').find('.vc_active a').attr(ttaTab));

                if ($currentTab.closest('li').hasClass('vc_active'))
                    return;

                //activate new tab
                $container.find('.vc_tta-tabs-list li.vc_active').removeClass('vc_active');
                $currentTab.closest('li').addClass('vc_active');
                $previousTabID.removeClass('vc_active');

                $container.find('.vc_tta-panel').removeClass('show');
                $currentPanelID.addClass('show');
                $currentPanelID.addClass('vc_active');
                fixTabContentScripts($currentPanelID);


            });

            //Accordion
            $('.vc_tta-accordion .vc_tta-panel-heading a').on('click', function (e) {
                e.preventDefault();

                var $currentTab = $(this);
                if ( $currentTab.closest('.vc_tta-panels').hasClass('ui-sortable') ) {
                    var ttaAcc = ('data-vc-target');
                } else {
                    var ttaAcc = ('href');
                }

                var $container = $currentTab.closest('.vc_tta-accordion'),
                    $activeTabID = $($currentTab.attr(ttaAcc)),
                    $previousTabID = $($currentTab.closest('.vc_tta-panels').find('.vc_active a').attr(ttaAcc));

                //activate new tab
                if ( $container.hasClass('vc_tta-o-all-clickable') ) {
                    $activeTabID.toggleClass('vc_active');
                    $activeTabID.find('.vc_tta-panel-body').slideToggle();
                } else {
                    if ($activeTabID.hasClass('vc_active')) {
						return;
					}

                    $container.find('.vc_tta-panel.vc_active').removeClass('vc_active');
                    $activeTabID.addClass('vc_active');

                    $previousTabID.find('.vc_tta-panel-body').slideUp();
                    $previousTabID.find('.vc_tta-panel-heading').removeClass('vc_active');
                    $activeTabID.find('.vc_tta-panel-body').slideDown();
                    $activeTabID.find('.vc_tta-panel-heading').addClass('vc_active');
                }

            });

            var fixTabContentScripts = function ($activeTabID) {
                if ($activeTabID.find('.products.isotope').length > 0) {
                    $activeTabID.find('.products.isotope').isotope('destroy');
                }

                var $tabsParent = $activeTabID.closest('.vc_tta-panels');


                //Products
                self.productThumbnails();
				self.stickyProductThumbnails();
                self.productVariation();
                self.productProgressBar();

                self.runIsotopeInProducts($activeTabID);

                //Carousel
                self.carousel($activeTabID);

                //shortcodes
                self.shortcode(true);

                //product "info on click" style
                self.productsInfoOnClick();

                // tabsTourAccordion Height
                self.tabsTourAccordionHeight();

            }
        },

        tabsTourAccordionHeight: function () {

            if ( ! $('.vc_tta-container .vc_general').length ) { 
				return; 
			}
            $('.vc_tta-container .vc_general').each(function () {
                var $this = $(this);
                //Tabs & tour
                if ($this.hasClass('vc_tta-tabs')) {
                    var childsHeight = [];
                    $this.find('.vc_tta-panel').each(function () {
                        childsHeight.push($(this).outerHeight());
                    });
                    $this.find('.vc_tta-panels').css('min-height', Math.min.apply(null, childsHeight));


					$this.find('.vc_tta-panel.vc_active').addClass('show');
                } else if ($this.hasClass('vc_tta-accordion')) { //Accordion
                    $this.find('.vc_tta-panel:not(.vc_active) .vc_tta-panel-body').slideUp();
                }
            });
        },
        tabScrollbar: function () {
            if ( $(window).width() > 1025 ) {
				return;
			}
            var $tabList = $('.vc_tta-tabs-position-top .vc_tta-tabs-list,.vc_tta-tabs-position-bottom .vc_tta-tabs-list');
            var $tabListItem = $('.vc_tta-tabs-position-top .vc_tta-tabs-list > li,.vc_tta-tabs-position-bottom .vc_tta-tabs-list > li');
            if ( $tabList.parents('.ajax_products_tab').length ) {
                return;
            }
            if ($tabList.find('.swiper-container').length == 0) {
                $tabListItem.wrap('<div class="swiper-slide" style="width:fit-content;"></div>');
                $tabListItem.first().parent('.swiper-slide').addClass('swiper-slide-active');
                $tabList.wrapInner('<div class="swiper-container"><div class="swiper-wrapper"></div><div class="swiper-scrollbar"></div></div>')
            }
            var $scrollContainer = $tabList.find('.swiper-container');

            var swiper = new Swiper($scrollContainer, {
                scrollbar: {
                    el: '.swiper-scrollbar',
                    hide: false,
                    draggable: true,
                },
                direction: 'horizontal',
                slidesPerView: 'auto',
                mousewheelControl: true,
                freeMode: true,
                touchReleaseOnEdges: true,
                mousewheelReleaseOnEdges: true,
                mousewheelSensitivity: .6,
            });
            $('.swiper-scrollbar-drag').each(function () {
                if ($(this).width() == $(this).parents('.swiper-scrollbar').width() || ($(this).width() > ($(this).parents('.swiper-scrollbar').width() - 5))) {
                    $(this).parents('.swiper-scrollbar').hide();
                } else {
                    $(this).parents('.swiper-scrollbar').show();
                }
            });
        },

        boughtTogetherProduct: function() {
            var $btProduct = $('#bt-product-summary');
            if ($btProduct.length <= 0) {
                return;
            }
            var $priceAt = $btProduct.find('.bt-total-price .woocommerce-Price-amount'),
                $btVal = $btProduct.find("input[name='add-to-cart']"),
                $button = $btProduct.find('.single_add_to_cart_button'),
                totalPrice = parseFloat($btProduct.find('#bt-data_price').data('price'));

            $('.bt-check-product').click(function(){
                var id = $(this).closest('li').find('a').data('id');
                var currentPrice = parseFloat($(this).closest('li').find('.s-price').data('price'));
                if($(this).is(":not(:checked)")){
                    $(this).addClass('uncheck');
                    $btProduct.find('.post-' + id).addClass('deactive');
                    totalPrice -= currentPrice;
                } else {
                    $btProduct.find('.post-' + id).removeClass('deactive');
                    $(this).removeClass('uncheck');
                    totalPrice += currentPrice;
                }

                var $productIDs = $('.bt-check-current-product').closest('li').find('a').data('id');
                $btProduct.find('.products-list li .bt-check-product').each(function () {
                    if (!$(this).hasClass('uncheck')) {
                        $productIDs += ',' + $(this).closest('li').find('a').data('id');
                    }
                });

                $btVal.attr('value', $productIDs);
                $button.attr('value', $productIDs);
                $priceAt.html((totalPrice));
            });


        },
        
        buyNow: function() {
            $('.single_add_to_cart_button.buy-now.disabled').on( 'click', function(e){
                e.preventDefault();
            })
        },

    };

    kiteTheme = Object.assign( kiteTheme, singleProduct );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.initSingleProduct();
    $(window).on( 'resize', function(){
        kiteTheme.singleProductResizeEvent();
    });
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/checkout.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  checkout
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var checkout = {

        /*----------------------------------------------------------------------------------*/
        /* Reinitialise select2 on countery select in checkout page
        /*-----------------------------------------------------------------------------------*/
        reinitCheckoutCounterySelect2: function () {
            var self = this;

            if ( $('.woocommerce-checkout select.country_to_state.country_select').length > 1 ) {

                //It's an copy of getEnhancedSelectFormatString function in woocommerce/assets/js/frontend/country-select.js
                var getEnhancedSelectFormatString = function () {
                    return {
                        'language': {
                            errorLoading: function () {
                                // Workaround for https://github.com/select2/select2/issues/4355 instead of i18n_ajax_error.
                                return wc_country_select_params.i18n_searching;
                            },
                            inputTooLong: function (args) {
                                var overChars = args.input.length - args.maximum;

                                if (1 === overChars) {
                                    return wc_country_select_params.i18n_input_too_long_1;
                                }

                                return wc_country_select_params.i18n_input_too_long_n.replace('%qty%', overChars);
                            },
                            inputTooShort: function (args) {
                                var remainingChars = args.minimum - args.input.length;

                                if (1 === remainingChars) {
                                    return wc_country_select_params.i18n_input_too_short_1;
                                }

                                return wc_country_select_params.i18n_input_too_short_n.replace('%qty%', remainingChars);
                            },
                            loadingMore: function () {
                                return wc_country_select_params.i18n_load_more;
                            },
                            maximumSelected: function (args) {
                                if (args.maximum === 1) {
                                    return wc_country_select_params.i18n_selection_too_long_1;
                                }

                                return wc_country_select_params.i18n_selection_too_long_n.replace('%qty%', args.maximum);
                            },
                            noResults: function () {
                                return wc_country_select_params.i18n_no_matches;
                            },
                            searching: function () {
                                return wc_country_select_params.i18n_searching;
                            }
                        }
                    };
                }

                var initSelect2ForWcSelects = function () {

                    setTimeout(function () {

                        if ($.isFunction($.fn.select2)) {

                            var wcCountrySelectSelect2 = function () {
                                $('select.country_select:visible, select.state_select:visible').each(function () {
                                    var select2_args = $.extend({
                                        placeholderOption: 'first',
                                        width: '100%'
                                    }, getEnhancedSelectFormatString());

                                    $(this).select2(select2_args);
                                });
                            };

                            wcCountrySelectSelect2();
                        }

                    }, 1000);
                }

                self.$body.bind('country_to_state_changed', function () {
                    initSelect2ForWcSelects();
                });

                initSelect2ForWcSelects();
            }
        },

        checkoutCoupon: function() {
            $('form.checkout button[name="apply_coupon"]').on( 'click', function(e){
                e.preventDefault();

                var $form = $( this ).parents('form');

                if ( $form.is( '.processing' ) ) {
                    return false;
                }

                $form.addClass( 'processing' ).block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });

                var data = {
                    security: wc_checkout_params.apply_coupon_nonce,
                    coupon_code: $form.find( 'input[name="coupon_code"]' ).val()
                };

                $.ajax({
                    type:   'POST',
                    url:    wc_checkout_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'apply_coupon' ),
                    data:   data,
                    success:    function( code ) {
                        $( '.woocommerce-error, .woocommerce-message' ).remove();
                        $form.removeClass( 'processing' ).unblock();

                        if ( code ) {
                            $( document.body ).trigger( 'applied_coupon_in_checkout', [ data.coupon_code ] );
                            $( document.body ).trigger( 'update_checkout', { update_shipping_method: false } );
                        }
                    },
                    dataType: 'html'
                });
            });
        }
    };

    kiteTheme = Object.assign( kiteTheme, checkout );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.reinitCheckoutCounterySelect2();
    kiteTheme.checkoutCoupon();
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/my-account.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  myAccount
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var myAccount = {
        responsiveTables: function(){
            var self = this;
            if ( self.$window.width() <= 768 ) {
                $('.woocommerce-MyAccount-content table.woocommerce-orders-table').rtResponsiveTables({
                    containerBreakPoint: 768
                });
            }

        },
    };

    kiteTheme = Object.assign( kiteTheme, myAccount );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    kiteTheme.responsiveTables();
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/elements/ajax-woocommerce-tab.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  ajaxWoocommerceTab
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var ajaxWoocommerceTab = {
        woocommerceAjaxProductsTab: function (container = $(document)) {
            if ( !container.find('.ajax_products_tab').length ) {
                return;
            }
            var self = this,
                xhr = null,
                $panels = container.find('.ajax_products_tab .vc_tta-panels');
            $panels.each(function (index, el) {
                $(this).attr('style', 'min-height:' + $(this).height() + 'px !important;');
            });
            container.find('.ajax_products_tab li.vc_tta-tab,.ajax_products_tab li.vc_tta-tab a,.ajax_products_tab li.vc_tta-tab span').off('click');
            container.find('.ajax_products_tab li.vc_tta-tab').on('click', function (event) {
                event.preventDefault();

                if (xhr) {
                    xhr.abort();
                }

                if ($(this).hasClass('vc_active')) {
                    return;
                } else {
                    $(this).parents('.vc_tta-container').find('li.vc_active').removeClass('vc_active');
                    $(this).addClass('vc_active');
                }
                if ($(this).parents('.ajax_products_tab').find('.vc_tta-panel[data-tab-id=' + $(this).data('tab-id') + ']').length) {
                    $(this).parents('.ajax_products_tab').find('.vc_tta-panel.vc_active_show').removeClass('vc_active_show').removeClass('show').removeClass('vc_active');
                    $(this).parents('.ajax_products_tab').find('.vc_tta-panel[data-tab-id=' + $(this).data('tab-id') + ']').addClass('vc_active_show show vc_active');
                    $(this).parents('.ajax_products_tab').find('.vc_tta-panels').attr('style', 'min-height:' + $('.vc_tta-panels').find('.vc_active.vc_tta-panel').outerHeight() + 'px !important');
                    self.runIsotopeInProducts();
                    return;
                }
                var $tabPanels = $(this).parents('.ajax_products_tab').find('.vc_tta-panels');
                if ($tabPanels.outerHeight() > 500) {
                    $tabPanels.find('.wc-loading').css('top', '20%');
                } else {
                    $tabPanels.find('.wc-loading').css('top', '50%');
                }
                $tabPanels.find('.wc-loading').removeClass('hide');
                $tabPanels.find('.vc_active_show').removeClass('vc_active_show').removeClass('show').removeClass('vc_active');
                var data = {
                    action: 'fetch_woocommerce_shortcode_dom',
                    atts: $(this).data('shortcode-prop'),
                    tab_id: $(this).data('tab-id'),
                    context: 'frontend'
                };
                xhr = $.ajax({
                    url: kite_theme_vars.ajax_url,
                    type: 'GET',
                    dataType: 'html',
                    data: data,
                }).done(function (response) {
                    $tabPanels.find('.wc-loading').addClass('hide');
                    $tabPanels.append(response);
                    self.carousel();
                    self.runIsotopeInProducts();
                    self.lazyLoadOnLoad($tabPanels);
                    self.lazyLoadOnHover($tabPanels);
                    self.compare();
                    self.woocommerceVariationItemSelect();
                    self.woocommerceButtonsOnHoverCartClick();
                    self.mobileHoverState();
                    self.productsInfoOnClick();
                    self.productQuickView();
                    $tabPanels.attr('style', 'min-height:' + $tabPanels.find('.vc_active.vc_tta-panel').height() + 'px !important;');
                }).fail(function (response) {

                }).always(function () {

                });
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, ajaxWoocommerceTab );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.woocommerceAjaxProductsTab();
    }
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/banner.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  bannerHeyperLink
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var banner = {
        bannerHyperLink: function () {

            if ( $('.banner').length > 0 ) {
                var $banner = $('.banner');
                $banner.each(function (index, el) {
                    if ($(this).find('a').length > 0) {
                        $(this).find('.content-container').css('cursor', 'pointer');
                        $(this).on('click', function (event) {
                            var $a = $(this).find('a');
                            var $url = $a.attr('href'),
                                $target = $a.attr('target');
                            window.open($url, $target);

                        });
                    }
                });
            }
        },

    };

    kiteTheme = Object.assign( kiteTheme, banner );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.bannerHyperLink();
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-banner.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/blog.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  blog
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var blog = {

        initBlog: function() {
            this.blogToggle();
            this.blogToggleLoadmore();
            this.blogHeadLine();
            this.toggleBlog();
            this.blogLoadMore();
            this.blogMasonry();
            // move to single blog js file 
            this.blogPostSlider();
            this.singlePage();
            this.reviewForm();
            this.blogFloatingPart();
        },

        blogResizeEvent: function(){
            var self = this;
            // blog toggle
            $('.blogaccordion').each(function () {
                var postVar = self.blogToggleArray($(this));
                // set toggle mode When Page Loaded
                self.blogToggleSet(postVar);
            });

            this.blogMasonry();
            this.blogHeadLine();
            this.toggleBlog();
        },
        /*-----------------------------------------------------------------------------------*/
        /*  blog toggle & blog toggle load more 
        /*-----------------------------------------------------------------------------------*/

        // blog toggle click 
        blogToggleClick: function (postVar) {

            var self = this;

            var $toggleMode = parseInt(postVar.$accordion.attr("data-value"));

            if ( $toggleMode === 0 ) {

                var $accordionHeight = "350px";
                if (self.windowWidth > 480) {
					$accordionHeight = "520px";
				}

                postVar.$content.fadeIn();


                postVar.$frameTitle.css({
                    opacity: 0.3,
                    'background-color': '#fff',
                    height: '160px'
                }),

				//post title And Date animation css
				postVar.$monthTitle.css({
					'border-left-color': '#fff',
					left: '-81px'
				});

                postVar.$titleImage.toggleClass('accordion_closed'),
                postVar.$accordion.toggleClass('accordionclosed'),

				// change data Value
				postVar.$accordion.attr("data-value", "1");

            } else if ( $toggleMode === 1 || isNaN($toggleMode) ) {

                postVar.$content.fadeOut('fast');
                postVar.$frameTitle.css({
                    opacity: 1,
                    'background-color': 'transparent',
                    height: '100%'
                })

                //post title And Date animation css
                postVar.$day.css({
                    width: '130px'
                }),

				postVar.$monthTitle.css({
					'border-left-color': '#fff',
					left: '0px'
				}),

				postVar.$monthTitle.find('.monthyear').css({
					left: '0px',
				}),

				postVar.$monthTitle.find('.blogtitle').css({
					left: '0px',
				});

                postVar.$titleImage.toggleClass('accordion_closed');
                postVar.$accordion.toggleClass('accordionclosed'),

				// change data Value
				postVar.$accordion.attr("data-value", "0");
            }


        },

        // blog toggle default set
        blogToggleSet: function (postVar) {
            var self = this;
            if ( postVar.$flag === 0 ) {
                // Set Close Mode
                postVar.$content.slideUp(function () {
                    self.parallaxImg();
                });

                postVar.$titleImage.toggleClass('accordion_closed');

            } else if ( postVar.$flag === 1 || isNaN(postVar.$flag) ) {

                postVar.$accordionBox10.add(postVar.$accordionBox).animate(
                    { height: postVar.$imgHeight },
                    {
                        queue: false,
                        duration: 500
					}
				)

                postVar.$frameTitle.css({
                    opacity: 0.3,
                    'background-color': '#fff',
                    height: '160px'
                })

            }

        },

        blogToggleArray: function ($thisAccordion) {

            var $accordion = $thisAccordion,
                $titleImage = $accordion.find('.image'),
                $imgH = $titleImage.find('img'),
                $noImage = $titleImage.find('.noImage'),
                $content = $accordion.find('.accordion_content'),
                $accordionBox2 = $accordion.find('.accordion_box2'),
                $accordionBox10 = $accordion.find('.accordion_box10'),
                $flag = parseInt($accordion.attr("data-value")),
                $blogClose = $accordion.find('.blogClose'),
                $minus = $accordion.find('.minus'),
                $plus = $accordion.find('.plus'),
                $accordionBox = $accordion.find('.accordionBox'),
                $frameTitle = $accordion.find('.frameTitle'),
                $day = $accordion.find('.accordion_title'),
                $monthTitle = $accordion.find('.leftborder');


            var postVar = {
                $accordion: $accordion,
                $titleImage: $titleImage,
                $imgH: $imgH,
                $noImage: $noImage,
                $content: $content,
                $accordionBox2: $accordionBox2,
                $accordionBox10: $accordionBox10,
                $flag: $flag,
                $minus: $minus,
                $plus: $plus,
                $accordionBox: $accordionBox,
                $frameTitle: $frameTitle,
                $day: $day,
                $monthTitle: $monthTitle,
            };

            return postVar;
        },

        // blog toggle
        blogToggle: function () {

            var self = this;
            if ( ! $('.blogaccordion').length ) {
                return;
            }

            $('.blogaccordion').each(function () {

                var $accordion = $(this),
                    $titleImage = $accordion.find('.image'),
                    $imgH = $titleImage.find('img'),
                    $noImage = $titleImage.find('.noImage'),
                    $content = $accordion.find('.accordion_content'),
                    $accordionBox2 = $accordion.find('.accordion_box2'),
                    $accordionBox10 = $accordion.find('.accordion_box10'),
                    $flag = parseInt($accordion.attr("data-value")),
                    $blogClose = $accordion.find('.blogClose'),
                    $minus = $accordion.find('.minus'),
                    $plus = $accordion.find('.plus'),
                    $accordionBox = $accordion.find('.accordionBox'),
                    $frameTitle = $accordion.find('.frameTitle'),
                    $day = $accordion.find('.accordion_title'),
                    $monthTitle = $accordion.find('.leftborder');

                var postVar = {
                    $accordion: $accordion,
                    $titleImage: $titleImage,
                    $imgH: $imgH,
                    $noImage: $noImage,
                    $content: $content,
                    $accordionBox2: $accordionBox2,
                    $accordionBox10: $accordionBox10,
                    $flag: $flag,
                    $minus: $minus,
                    $plus: $plus,
                    $accordionBox: $accordionBox,
                    $frameTitle: $frameTitle,
                    $day: $day,
                    $monthTitle: $monthTitle,
                };

                // set toggle mode When Page Loaded
                self.blogToggleSet(postVar);

                $minus.add($plus).add($blogClose).click(function () {
                    // toggle Post When Click Event Occur
                    self.blogToggleClick(postVar);
                });

            });

        },

        /* blog toggle loadmore */
        blogToggleLoadmore: function () {

            var self = this;

            $(".posts-page-" + (self.blogPageNum + 1)).find('.blogaccordion').each(function () {
                var $accordion = $(this),
                    $title = $accordion.find('.accordion_title'),
                    $titleImage = $accordion.find('.image'),
                    $imgH = $titleImage.find('img'),
                    $noImage = $titleImage.find('.noImage'),
                    $content = $accordion.find('.accordion_content'),
                    $accordionBox2 = $accordion.find('.accordion_box2'),
                    $accordionBox10 = $accordion.find('.accordion_box10'),
                    $flag = parseInt($accordion.attr("data-value")),
                    $blogClose = $accordion.find('.blogClose'),
                    $minus = $accordion.find('.minus'),
                    $plus = $accordion.find('.plus'),
                    $accordionBox = $accordion.find('.accordionBox'),
                    $frameTitle = $accordion.find('.frameTitle'),
                    $day = $accordion.find('.accordion_title'),
                    $monthTitle = $accordion.find('.leftborder');

                var postLoadVar = {
                    $accordion: $accordion,
                    $titleImage: $titleImage,
                    $imgH: $imgH,
                    $noImage: $noImage,
                    $content: $content,
                    $accordionBox2: $accordionBox2,
                    $accordionBox10: $accordionBox10,
                    $flag: $flag,
                    $minus: $minus,
                    $plus: $plus,
                    $accordionBox: $accordionBox,
                    $frameTitle: $frameTitle,
                    $day: $day,
                    $monthTitle: $monthTitle,
                };

                // set toggle mode When Page Loaded
                self.blogToggleSet(postLoadVar);

                $minus.add($plus).add($blogClose).click(function () {
                    // toggle Post When Click Event Occur
                    self.blogToggleClick(postLoadVar);
                });

            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Blog Load More Function
        /*-----------------------------------------------------------------------------------*/
        blogLoadMore: function () {

            var self = this,
                $loadBTN = $('.pagenavigation');

            if ( typeof paged_data == 'undefined' || $loadBTN.length < 1 ) {
				return;
			}

            var max = 1;

            if ( $loadBTN.hasClass('cartblog') ) {
                var $uniqueId = "#" + $loadBTN.siblings('.isotope').attr('data-id'),
                    $blog = $($uniqueId).first();
                max = $blog.data('maxpages');
            } else {
                max = parseInt(paged_data.maxPages);
            }

            if ( max < 2 ) {
				return;
			}

            //Replace links with load more button
            $loadBTN.html('<div class="readmore clearfix"><div class="loadmore loadmoreactive"><span class="text load-more-text">' + paged_data.loadmoreText + '</span><span class="text loading-text">' + paged_data.loadingText + '</span><span class="text no-more-text">' + paged_data.noMorePostsText + '</span></div></div>');

            $('.loadmore').click(function () {
                var $btn = $(this);
                $loadBTN = $(this).parents('.pagenavigation');

                if ( $loadBTN.hasClass('cartblog') ) {// It is a card blog

                    var $uniqueId = " #" + $loadBTN.siblings('.isotope').attr('data-id'),
                        $blog = $($uniqueId).first(),
                        $isCardBlog = true;
                    // Next line finds the first hidden page
                    var startPage = $blog.data('page'),
                        nextPage = startPage + 1,
                        max = $blog.data('maxpages'),
                        isLoading = false;
                    //Next line stores the pages that appeared by far
                    $blog.data('page', nextPage);
                } else if ( $loadBTN.hasClass('readmore-blog') ) {
                    var $uniqueId = " #" + $loadBTN.siblings('.blog-head-line-container, .blog-toggle-container').attr('data-id'),
                        $blog = $($uniqueId).first(),
                        $isHeadLineBlog = true;
                    // Next line finds the first hidden page
                    var startPage = $blog.data('page'),
                        nextPage = startPage + 1,
                        max = $blog.data('maxpages'),
                        isLoading = false;
                    //Next line stores the pages that appeared by far
                    $blog.attr('data-page', nextPage);
                    $blog.data('page', nextPage);

                } else {// It is classic blog
                    var startPage = parseInt(paged_data.startPage),
                        nextPage = startPage + 1,
                        max = parseInt(paged_data.maxPages),
                        isLoading = false;
                    var $blog = "#blogloop",
                        $uniqueId = ' .post';
                }

                if ( max < 2 ) { 
					return; 
				}

                //Activate loadmore button
                if ( nextPage > max ) {
                    $btn.removeClass('loadingactive').addClass('loadmoreactive');
				}

                if ( nextPage > max || isLoading ) {
					return;
				}

                isLoading = true;

                //Set loading text
                $(this).removeClass('loadmoreactive').addClass('loadingactive');
                var $pageContainer = $('<div class="posts-page-' + nextPage + '"></div>');

                //Next line is for creating a valid link to next page
                paged_data.nextLink = '/?postpage=' + nextPage;
                paged_data.nextLink = '?postpage=' + nextPage;

                $pageContainer.load(paged_data.nextLink + $uniqueId, function () {

                    //Insert the posts container before the load more button
                    $pageContainer.waitForImages(function () { //loads gallery in classic blog load more
                        var $content;
                        if ( $isCardBlog ) {
                            $content = $($pageContainer.html());
                            $content = $($content.html());
                        } else {
                            $content = $pageContainer;
                        }

                        if ( $isCardBlog ) {
                            var $container = $($uniqueId);
                            $container.append($content).isotope('appended',$content);
                            $container.waitForImages(function(){
                                setTimeout(function () {
                                    // call isotope animation ( defualt and custom mode )
                                    self.lazyLoadOnLoad($container);
                                    self.parallaxImg();
                                    self.isotopeAnimation($blog);
                                }, 500);
                            });
                        } else {
                            $content.hide().appendTo($blog).fadeIn('fast');
                        }

                        // Update page number and nextLink.
                        paged_data.startPage = paged_data.startPage.replace(/[0-9]+/, startPage + 1);

                        if ( nextPage < max ) {
                            $btn.removeClass('loadingactive').addClass('loadmoreactive');
                        } else if (nextPage >= max) {
                            $btn.removeClass('loadingactive loadmoreactive').addClass('nomoreactive');
                        }

                        isLoading = false;

                        if ( !($isCardBlog) ) {
                            self.blogPageNum = nextPage;
                            self.blogPageNum--;

                            self.blogToggleLoadmore();
							self.toggleBlog();
                            self.blogPostSlider();
                            self.fitVideo();
                        }

                    });


                });

            });

        },
        /*-----------------------------------------------------------------------------------*/
        /*  Blog Head Line Responsive Function
        /*-----------------------------------------------------------------------------------*/
        blogHeadLine: function() {
            if ( !$('.blog-head-line-container').length ) {
				return;
			}

            $('.blog-head-line-container').each(function() {
                if ($(this).parent().width() <= 350) {
                    $(this).find('.blog-head-line-item,.blog-head-line-description').addClass('responsive-350');
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').removeClass('responsive-674 responsive-558 responsive-451');
                } else if ( 350 < $(this).parent().width() && $(this).parent().width() <= 451 ) {
                    $(this).find('.blog-head-line-item,.blog-head-line-description').addClass('responsive-451');
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').removeClass('responsive-674 responsive-558 responsive-350');
                } else if ( 451 < $(this).parent().width() && $(this).parent().width() <= 558 ) {
                    $(this).find('.blog-head-line-item,.blog-head-line-description').addClass('responsive-558');
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').removeClass('responsive-674 responsive-451 responsive-350');
                } else if ( 558 < $(this).parent().width() && $(this).parent().width() <= 674 ) {
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').addClass('responsive-674');
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').removeClass('responsive-558 responsive-451 responsive-350');
                } else {
                    $(this).find('.blog-head-line-item,.blog-head-line-description,.blog-head-line-details').removeClass('responsive-674 responsive-558 responsive-451 responsive-350');
                }
            });
        },

		/*-----------------------------------------------------------------------------------*/
        /* Blog Toggle Responsive Function
        /*-----------------------------------------------------------------------------------*/
		toggleBlog: function() {
            if ( !$('.blog-toggle-container').length ) {
				return;
			}

			$('.blog-toggle-container').each(function() {
			   var $this = $(this);

				if ($this.parent().width() > 952) {
					$this.find('.blogaccordion').addClass('responsive-1024');
					$this.find('.blogaccordion').removeClass('responsive-952 responsive-475 responsive-265');
                }
				if ( 475 <  $this.parent().width() &&  $this.parent().width() <= 952) {
					$this.find('.blogaccordion').addClass('responsive-952');
                    $this.find('.blogaccordion').removeClass('responsive-265 responsive-475 responsive-1024');
                }
				if ( 265 <  $this.parent().width() &&  $this.parent().width() <= 475 ) {
                    $this.find('.blogaccordion').addClass('responsive-475');
                    $this.find('.blogaccordion').removeClass('responsive-952 responsive-265 responsive-1024');
                }
				if ($this.parent().width() <= 265) {
                    $this.find('.blogaccordion').addClass('responsive-265');
                    $this.find('.blogaccordion').removeClass('responsive-952 responsive-475 responsive-1024');
                }

            });
        },

        /*-----------------------------------------------------------------------------------*/
        /*  Blog Post Slider 
        /*-----------------------------------------------------------------------------------*/

        blogPostSlider: function () {

            // blog post slider - swoper slider
            if ( ! $('.bp-swiper').length ) {
                return;
            }
            $('.bp-swiper').not('.disabled_swiper').each(function () {

                var $blogPostNextBtn = $(this).find('.arrows-button-next'); // Next btns
                var $blogPostPrevBtn = $(this).find('.arrows-button-prev');// Previous Btns
                $blogPostNextBtn.add($blogPostPrevBtn).css({ 'opacity': '1' });

                var swiper = new Swiper($(this), {

                    loop: true,
                    speed: 650,
                    navigation: {
                        nextEl: $blogPostNextBtn,
                        prevEl: $blogPostPrevBtn,
                    },
                    on: {
                        slideChangeTransitionStart: function () {
                            //Unset height
                            $('.bp-swiper .swiper-wrapper').css({ height: '' });
                            //Calc Height
                            var $blogPostSwiperWidth = $('.bp-swiper').width(), // Container Width
                                $imgeWidth = $(this.slides[this.activeIndex]).find('img').attr('width'), // initial Images Width
                                $imgeHeight = $(this.slides[this.activeIndex]).find('img').attr('height'), // initial image width
                                $imgeNewHeight = ($blogPostSwiperWidth * $imgeHeight) / $imgeWidth; // Calc image height in container

                            $('.bp-swiper .swiper-wrapper').css({ height: $imgeNewHeight });
                            $('.bp-swiper').css({ height: $imgeNewHeight });
                        },
                    },
                });

            });

        },

        /*----------------------------------------------------------------------------------*/
        /*   Singlepages initialize
        /*-----------------------------------------------------------------------------------*/

        singlePage: function () {
            var self = this;
            if ( $('#blogsingle').length || $('.cblog').length ) {
                self.blogPostSlider(); // Blog Post slider
                self.socailshare(); // socail share
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  ReviewForm  blog and product details
        /*-----------------------------------------------------------------------------------*/

        reviewForm: function () {

            // blog detail
            if ( $('.comment-respond').length ) {

                $(".comment-respond input").focus(function () {
                    $(this).siblings('.label').addClass('inputfocus');
                    $(this).siblings('.graylabel').addClass('inputfocus');
                });


                $(".comment-respond input").focusout(function () {
                    $(this).siblings('.label').removeClass('inputfocus');
                    $(this).siblings('.graylabel').removeClass('inputfocus');
                });

                $(".comment-respond textarea").focus(function () {
                    $(this).siblings('.label').addClass('inputfocus');
                    $(this).siblings('.graylabel').addClass('inputfocus');
                });


                $(".comment-respond textarea").focusout(function () {
                    $(this).siblings('.label').removeClass('inputfocus');
                    $(this).siblings('.graylabel').removeClass('inputfocus');
                });

            }

        },

        /*----------------------------------------------------------------------------------*/
        /*  Masonry Blog
        /*-----------------------------------------------------------------------------------*/

        blogMasonry: function (isLoadMore, container = $(document)) {
            var self = this;

            container.find('.masonry-blog.isotope').each(function () {

                var $container = $(this);
                var $layoutMode = $(this).data('layoutmode');

                // calc blog wrap width
                var $columnNumber = $(this).data('columnnumber');

                if (self.windowWidth <= 979) {
                    //2column in vertical tablets
                    $columnNumber = 2; 
                    if (self.windowWidth <= 480) {
                        //1column in mobile devices
                        $columnNumber = 1;
                    }
                }

                var columnGutter = 12;
                var blogWrapWidth = $(this).parents('.vc_column-inner,.elementor-widget-container').width();
                var $colWidth = Math.floor(blogWrapWidth / $columnNumber) - (2 * columnGutter);

                if (isLoadMore != true) {
                    $container.isotope({
                        itemSelector: '.isotope-item',
                        layoutMode: $layoutMode,
                    });
                }

                // call isotope animation ( defualt and custom mode )
                self.isotopeAnimation($container);

                var blog_resize_handler = function () {
                    setTimeout(function () {
                        $container.isotope('reLayout');
                    }, 300);
                }
                self.$window.on('resize', blog_resize_handler);
                self.$window.one('djaxClick', function () {
                    self.$window.unbind('resize', blog_resize_handler);
                });

                $container.find('.blog-masonry-container').each(function () {

                    var $blogItems = $(this);

                    $blogItems.css({
                        'width': $colWidth,
                        'max-width': $colWidth,
                    });


                    $blogItems.find('.swiper-container').each(function () {

                        var $this = $(this);
                        if ( $this.find('.swiper-slide').length > 1 ) {
                            var $nextButton = $this.find('.swiper-button-next'),
                                $prevButton = $this.find('.swiper-button-prev'),

                                autoplayDuration = 3000 + Math.floor(Math.random() * 4000);

                            //Prevent from running swiper multiple times on initiated items
                            if ( $this[0].swiper != undefined ) {
                                return true;
                            }

                            if (autoplayDuration == 0) {
                                var autoplay = false;
                            } else {
                                var autoplay = { delay: autoplayDuration };
                            }
                            // Slider For Blog : Gallert Post format
                            var blogCartSlider = new Swiper($this, {
                                speed: 600,
                                longSwipesMs: 700,
                                touchAngle: 30,
                                loop: true,
                                autoplayDisableOnInteraction: false,
                                spaceBetween: 0,
                                followFinger: false,
                                navigation: {
                                    nextEl: $nextButton,
                                    prevEl: $prevButton,
                                },
                                autoplay: autoplay,
                            });

                            var blogCartSliderResizeHandler = function () {
                                setTimeout(function () {
                                    blogCartSlider.on('resize');
                                }, 100);
                            }

                            self.$window.on('resize', blogCartSliderResizeHandler);

                            self.$window.one('djaxClick', function () {
                                self.$window.unbind('resize', blogCartSliderResizeHandler);
                            });

                            // resize swiper after loading to calculate width correctly
                            blogCartSliderResizeHandler();


                        } else {
                            $this.find('.swiper-wrapper').addClass('disabled_swiper');
                        }

                    });
                    self.galleryStart(); //To restart pop-up video and pop-up sound
                });
            });
        },

        blogFloatingPart: function() {

            if ( ! $('.kt-single-post-container').length ) {
                return;
            }

            var $postContainer = $('.kt-single-post-container'),
                postContainerTopOffset = $postContainer.offset().top - 64,
                postContainerHeight = $postContainer.height(),
                bottomOfPostContainerTopOffset = postContainerTopOffset + postContainerHeight,
                $floatingPart = $('.kt-floating-info');

            var setFloatingPartPosition = function(){
                var scrollPosition = $(document).scrollTop();
                if ( scrollPosition > postContainerTopOffset && scrollPosition < bottomOfPostContainerTopOffset ) {
                    $floatingPart.addClass('fixed');
                } else if ( bottomOfPostContainerTopOffset - scrollPosition <= 120  ) {
                    $floatingPart.addClass('fixed');
                } else {
                    $floatingPart.removeClass('fixed');
                }
            }

            setFloatingPartPosition();
            $(document).on('scroll', function(){
                setFloatingPartPosition()
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, blog );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.initBlog();
    }
    $(window).on( 'resize', function(){
        kiteTheme.blogResizeEvent();
    });

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-blog.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.blogMasonry($scope);
            kiteTheme.blogLoadMore();
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-blog-headline.default', function ($scope) {
            kiteTheme.blogHeadLine();
            kiteTheme.blogLoadMore();
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-toggle-blog.default', function ($scope) {
            kiteTheme.toggleBlog();
            kiteTheme.blogLoadMore();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/carousel.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  carousel
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var carousel = {
        carouselResizeEvent: function() {
            var self = this;
            if ($('.carousel').length > 0) {
                clearTimeout(self.resizeId);
                self.resizeId = setTimeout(function () {
                    self.updateCarousel();
                }, 300);
            }
        },
        /*-----------------------------------------------------------------------------------*/
        /*  carousel Shortcode
        /*-----------------------------------------------------------------------------------*/
        carousel: function ($container) {

            var self = this,
                $carousel;

            if ($container === undefined) {
                $carousel = $('.carousel');
            } else {
                $carousel = $container.find('.carousel');
            }

            if ($carousel.length <= 0) {
                return;
            }

            // FullWidth Carousel remove col12 paddings
            $carousel.parents('.fullwidth').find('.vc_col-sm-12').css({
                'padding-right': '0px',
                'padding-left': '0px',
            });

            $carousel.each(function () {
                if ($(this).parents('.vc_tta-panel').length > 0) {
                    if ( !$(this).parents('.vc_tta-panel').hasClass('vc_active') ) {
                        return;
                    }
                }

                var $this = $(this),
                    $container = $this.find('.products'),
                    wcShortcodeWithBorder = $this.find('div.product').hasClass('with-border'),
                    setVisibleNumber = parseInt($this.find('.swiper-container').attr('data-visibleitems')),
                    visibleItems = 1;

                visibleItems = self.getVisibleItemNum($this, setVisibleNumber);

                var loopslideNum = visibleItems + 1,
                    gutter = 10,
                    slideClass = 'swiper-slide',
                    autoPlay = 0;
                if ( ($this.data('autoplay') == 'on') && ( self.windowWidth >= 1025 || $this.hasClass('kt-text-slider-container') ) ) {
                    autoPlay = 5000;
                }

                if ( $this.hasClass('wc-shortcode') ) { // wc-shortcode carousels

                    if ( $this.hasClass('no-gutter') || visibleItems == 1 ) {
                        gutter = 0;
                    }

                    slideClass = 'product';
                    autoPlay = 0;
                    if ( ( $this.data('autoplay') == 'on' && self.windowWidth >= 1025 ) || ( $this.data('responsive-autoplay') == 'on' && self.windowWidth < 1025 ) ) {
                        autoPlay = 3000;
                    }

                } else if ($this.hasClass('testimonials-style')) { // testimonials shortcode (testimonials-style)
                    gutter = 10;
                } else if ( $this.hasClass('instagram-carousel') ) {

                    slideClass = 'insta-media';
                    autoPlay = 0;
                    gutter = $this.hasClass('no-gutter') ? 0 : 10;

                } else { // image carousels
                    gutter = $this.hasClass('no-gutter') ? 0 : 10;
                }

                // disable loop for "gallery carousel" element - is buggy
                var loop = true;
                if ( $this.find('.swiper-container').parent().hasClass('gallery_carousel') ) {
                    loop = false;
                }
                if ( $this.hasClass('related') && $this.find('.swiper-container').data('exist_items') <= 3 ) {
                    loop = false;
                    $this.find('.arrows-button-next,.arrows-button-prev').css('display', 'none');
                }
                if ( autoPlay == 0 ) {
                    var autoPlay = false;
                } else {
                    var autoPlay = { delay: autoPlay };
                }
                if ( $this.find('.swiper-container').parents('#product-fullview-thumbs').length ) {
                    autoPlay = false;
                }

                var swiper = new Swiper($this.find('.swiper-container'), {
                    autoplay: autoPlay,
                    touchAngle: 45,
                    speed: 600,
                    longSwipesMs: 800,
                    loop: loop,
                    slidesPerView: visibleItems,
                    loopedSlides: loopslideNum,
                    autoplayDisableOnInteraction: false,
                    slideClass: slideClass,
                    spaceBetween: gutter,
                    watchSlidesVisibility: true,
                    roundLengths: false,
                    preloadImages: false,
                    on: {
                        init: function () {
                            if ($container.length) { // wc-shortcode carousels
                                if ($container.parents('.elementor-element').length) {
                                    self.productsInfoOnClick();
                                    self.woocommerceVariationItemSelect();
                                }
                                self.showAnimation($container, 1); // secound Parametr determines this code Runs In Carousel mode
                            }
                            else {
                                self.showAnimation($this, 2);   // "2" used for animation of image Carousel
                            }

                            $this.find('.arrows-button-next,.arrows-button-prev').css('opacity', 1);
                        },
                        slideChangeTransitionEnd: function () {
                            if ($this.hasClass('wc-shortcode')) {
                                self.showAnimation($container, 1);
                            }
                            else if ($this.hasClass('instagram-carousel')) { // instagram carousel
                                self.showAnimation($this, 3);   // "3" used for animation of image  instagram carousel
                            }
                            else {
                                self.showAnimation($this, 2);   // 2 used for image Carousel animation
                            }
                        },
                        touchEnd: function () {
                            if ($this.hasClass('wc-shortcode')) {
                                self.showAnimation($container, 1);
                            }

                            if ($this.hasClass('instagram-carousel')) { // instagram carousel
                                self.showAnimation($this, 3);   // 3 used for image  instagram carousel  animation
                            } else {
                                self.showAnimation($this, 2);   // 2 used for image Carousel animation
                            }
                        },
                        transitionStart: function () {
                            if ($this.hasClass('wc-shortcode') && wcShortcodeWithBorder) {
                                $this.find('div.last-visible-item').removeClass("last-visible-item");
                                $this.find('.swiper-slide-visible').last().addClass("last-visible-item");
                            }
                        },
                    },

                });

                //load image of duplicate slides
                setTimeout(function () {
                    //Remove is-loading class and prepare it for images lazy loading
                    $this.find('.swiper-slide-duplicate .lazy-load-on-load').removeClass('is-loading');
                    self.lazyLoadOnLoad($this.find('.swiper-slide-duplicate'));
                }, 500);

                if (autoPlay) {
                    $this.find('.swiper-container,.arrows-button-next,.arrows-button-prev').hover(function () {
                        swiper.autoplay.stop();
                    }, function () {
                        swiper.autoplay.start();
                    });
                    if (self.windowWidth <= 767 && ! $this.hasClass('kt-text-slider-container') && $this.data('responsive-autoplay') != 'on' )
                        swiper.autoplay.stop();
                }
            });
            $carousel.find('.arrows-button-next, .kt-next-btn').bind('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                $(this).siblings('.swiper-container')[0].swiper.slideNext();
            });

            $carousel.find('.arrows-button-prev, .kt-prev-btn').bind('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                $(this).siblings('.swiper-container')[0].swiper.slidePrev();

            });

        },

        getVisibleItemNum: function ($container, visibleItems) {
            var self = this;

            if ( ( $container.hasClass('wc-shortcode')) || ($container.hasClass('testimonials-style') ) ) {
                var $productsWrapper = $container.find('.products');

                if ( self.windowWidth <= 1140 && self.windowWidth >= 768 ) {
                    if ( $productsWrapper.length ) {
                        for (var i = 2; i < 5; i++) {
                            if ( $productsWrapper.hasClass( 'shop-tablet-'+i+'column' ) ) {
                                return i;
                            }
                        }
                    }
                }

                if ( self.windowWidth <= 1140 ) {
                    if ( visibleItems > 3 ) {
                        if ( $productsWrapper.length ) {
                            $productsWrapper.removeClass('shop-'+visibleItems+'column');
                            $productsWrapper.addClass('shop-3column');
                        }
                        visibleItems = 3; //3columns in vertical tablet devices
                    }
                    //2column in mobiles
                    if ( self.windowWidth <= 979 ) {
                        if ( visibleItems >= 2 ) {
                            if ( $productsWrapper.length ) {
                                $productsWrapper.removeClass('shop-3column');
                                $productsWrapper.addClass('shop-2column');
                            }
                            visibleItems = 2;//2columns in mobile devices
                        }

                        if ( self.windowWidth <= 480 ) {
                            if ( $container.hasClass('phone-column-2') ) {
                                visibleItems = 2;
                            } else {
                                if ( $productsWrapper.length ) {
                                    $productsWrapper.removeClass('shop-2column');
                                    $productsWrapper.addClass('shop-1column');
                                }
                                visibleItems = 1;//1column in mobile devices
                            }
                        }
                    }
                } else {
                    if ($productsWrapper.length && !$productsWrapper.hasClass('shop-'+visibleItems+'column')) {
                        for (var i = 1; i < 6; i++) {
                            $productsWrapper.removeClass( 'shop-'+i+'column' );
                        }
                        $productsWrapper.addClass( 'shop-'+visibleItems+'column' );
                    }
                }
            } else {
                if ( self.windowWidth <= 979 ) {
                    if ( visibleItems > 3 ) {
                        visibleItems = 3; //3columns in vertical tablet devices
                    }
                    //2column in mobiles
                    if ( self.windowWidth <= 767 ) {
                        if ( visibleItems >= 2 ) {
                            visibleItems = 2;//2columns in mobile devices
                        }

                        if ( self.windowWidth <= 480 ) {
                            if ( $container.hasClass('instagram-carousel') || $container.hasClass('phone-column-2') ) {
                                visibleItems = 2;//1column in mobile devices
                            } else {
                                visibleItems = 1;//1column in mobile devices
                            }
                        }
                    }
                }

            }

            return visibleItems;
        },

        updateCarousel: function (container = $(document)) {
            var self = this,
                $carousel = container.find('.carousel');

            if ( ! $carousel.length ) {
                return;
            }
            $carousel.each(function () {

                var $this = $(this),
                    $swiperContainer = $this.find('.swiper-container');

                if ($swiperContainer[0].swiper != undefined) {
                    var visibleItems = self.getVisibleItemNum($this, $swiperContainer.attr('data-visibleitems'));

                    $swiperContainer[0].swiper.params.slidesPerView = visibleItems;
                    $swiperContainer[0].swiper.params.loopedSlides = visibleItems + 1;

                    if ($this.hasClass('wc-shortcode')) { // wc-shortcode carousels
                        var gutter = ($this.hasClass('no-gutter') || visibleItems == 1) ? 0 : 20;

                        $swiperContainer[0].swiper.update(true);
                        self.showAnimation($this.find('.products'), 1); // secound Parametr determine this code Run In Carousel
                    }

                    else if (($this.hasClass('testimonials-style')) || ($this.hasClass('instagram-carousel'))) { // testimonials-shortcode(testimonials-style) and instagram-carousel
                        $swiperContainer[0].swiper.update(true);

                    } else {
                        self.showAnimation($this, 2);   // 2 used for image Carousel animation
                        $swiperContainer[0].swiper.update(true);
                    }

                }
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, carousel );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    if ( window.kiteTheme ) {
        kiteTheme.carousel();
    }

    $(window).on( 'resize', function(){
        kiteTheme.carouselResizeEvent();
    });

    $(window).on('elementor/frontend/init', function () {

        // elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
        //     if ($scope.find('.carousel').length) {
        //         kiteTheme.updateCarousel($scope);
        //         $(window).on('resize',function(){
        //             kiteTheme.updateCarousel($scope);
        //         });
        //     }
        // });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-testimonial.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-image-carousel.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-gallery-carousel.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products.default', function ($scope) {
            kiteTheme.lazyLoadOnLoad($scope);
            kiteTheme.lazyLoadOnHover($scope);
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-products-by-attribute.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-woocommerce-hand-picked-products.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-ajax-woocommerce-products.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-product-categories.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-instagram-feed.default', function ($scope) {
            kiteTheme.carousel($scope);
        });
    });
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/elements/contact-form.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  contactForm
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var contactForm = {
        contactForm: function () {
            if ( ! $('form.wpcf7-form').parents('div.wpcf7').length ) return;
            $('form.wpcf7-form').parents('div.wpcf7').each(function (index, el) {
                if ( $(this).parent().width() < 325 ) {
                    $(this).addClass('responsive');
                } else {
                    $(this).removeClass('responsive');
                }
            });
            $('form.wpcf7-form.two_column').parents('div.wpcf7').each(function (index, el) {
                if ( $(this).parent().width() < 510 ) {
                    $(this).addClass('responsive');
                } else {
                    $(this).removeClass('responsive');
                }
            });
            $('form.wpcf7-form.two_column p input[type!="submit"]').parents('p').addClass('two_column');
            $('form.wpcf7-form.two_column p textarea').parents('p').addClass('textarea');
        },
    };

    kiteTheme = Object.assign( kiteTheme, contactForm );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.contactForm();
    }
    $(window).on( 'resize', function(){
        kiteTheme.contactForm();
    });

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-contact-form-7.default', function ($scope) {
            kiteTheme.contactForm();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/countdown.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  countDown
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var countDown = {

        countdown: function () {
            if( ! $(".countdown-timer").length ) {
				return;
			}

            $(".countdown-timer").each(function () {
                var $this = $(this);
                if ( $this.hasClass('initiated') ) {
					return;
				}

                $this.addClass('initiated');

                var updateCountDown = function () {
                    var date = Date.parse($this.data("end")) / 1000,
                        now = Math.floor($.now() / 1000),
                        $day = $this.find(".days"),
                        $hours = $this.find(".hours"),
                        $min = $this.find(".minutes"),
                        $second = $this.find(".seconds"),
                        dayDistance = date - now;

                    if (dayDistance > 0) {
                        var day = Math.floor(dayDistance / 86400);
                        dayDistance -= 60 * day * 60 * 24;
                        var hours = Math.floor(dayDistance / 3600);
                        dayDistance -= 60 * hours * 60;
                        var min = Math.floor(dayDistance / 60);
                        dayDistance -= 60 * min,
                            10 > day && (day = "0" + day),
                            10 > hours && (hours = "0" + hours),
                            10 > min && (min = "0" + min),
                            10 > dayDistance && (dayDistance = "0" + dayDistance),
                            1 > $day.length || "00" == day ? $day.parent().hide() : $day.text(day),
                            $hours.text(hours + "	" + ":"),
                            $min.text(min + "	" + ":"),
                            //$min.text(min),
                            $second.text(dayDistance)
                    } else {
                        $this.css( 'display', 'none' );
                    }
                };
                setInterval(updateCountDown, 1000),
                    updateCountDown()
            })
        },

    };

    kiteTheme = Object.assign( kiteTheme, countDown );
} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( kiteTheme ) {
        kiteTheme.countdown();
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-count-down.default', function ($scope) {
            kiteTheme.countdown();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/counter.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  counter
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var counter = {
        /*-----------------------------------------------------------------------------------*/
        /*  Counter Box
        /*-----------------------------------------------------------------------------------*/

        counterBox: function () { // counterBox run in document ready and call after Ajax
            var self = this;

            var $counterBoxContainers = $('.counterbox:not(.shortcodeanimation), .counterbox.shortcodeanimation.no-responsive-animation');
            if (!$counterBoxContainers.length) return;
            self.counterBoxAnimate($counterBoxContainers);
        },

        /* Counter Box With Animation */
        counterBoxAnimate: function ($element) { // call in appear function - run when element come to screen view

            $element.each(function () {
                var countNmber = $(this).attr('data-countNmber');
                $(this).find('.counterboxnumber').countTo({
                    from: 0,
                    to: countNmber,
                    speed: 2000,
                    refreshInterval: 10,
                });
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, counter );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.counterBox();
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-counter-box.default', function ($scope) {
            kiteTheme.counterBox();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/custom-title.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  customTitle
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var customTitle = {
        customTitle: function () {

            var self = this;

            if ( $('.custom-title').length <= 0 || self.msie > 0 || !!self.msie11 || self.windowWidth <= 1140 || self.isTouchDevice ) {
                return;
            }

            var $titles = $('.custom-title');
            self.windowHeight = self.$window.height();
            var scrollPosition = 0;

            var parallaxHandler = function () {
                $titles.each(function () {
                    var $el = $(this),
                        elementTop = $el.data('offsetTop'),
                        factorMult = 0;

                    var offsetDiff = elementTop - scrollPosition;
                    factorMult = 1 - ((((self.windowHeight / 3) - offsetDiff) / (self.windowHeight / 3)) * 1.1);

                    var $parallaxedShape = $(this).find('.shape-container');
                    if ($parallaxedShape.length) {

                        //shape
                        factorMult = (elementTop - scrollPosition - (self.windowHeight / 4)) * 0.15;

                        // Parallax For Custom Shape  in top of [ $self.windowHeight / 4 ]  size
                        if (elementTop < (self.windowHeight / 4)) {

                            factorMult = factorMult + (self.windowHeight / 16);
                            $parallaxedShape.css({ transform: 'translate3d(0,' + factorMult + 'px,0)' });

                        } else {

                            // Parallax For Custom Shape
                            if (factorMult > -10) {
                                $parallaxedShape.css({ transform: 'translate3d(0,' + factorMult + 'px,0)' });
                            }

                        }
                    }
                });
            }

            var parallaxInit = function () {
                $titles.each(function () {
                    var $el = $(this);
                    if ($el.find('.title >span').length) {
                        $el.data('offsetTop', $el.find('.title >span').offset().top);
                    }
                });
            }

            var requestTick = function () {
                parallaxInit();
                scrollPosition = self.$window.scrollTop();
                window.requestAnimationFrame(parallaxHandler);
            }

            var resizeHandler = function () {
                self.windowHeight = self.$window.height();
                parallaxInit();
            }

            parallaxInit();
            parallaxHandler();

            self.$window.on('scroll', requestTick).resize(resizeHandler);

            self.$window.one('djaxClick', function () {
                self.$window.unbind('scroll', requestTick).unbind('resize', resizeHandler);
            });
        },
    };

    kiteTheme = Object.assign( kiteTheme, customTitle );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.customTitle();
    }
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/hotspot.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  imageHotSpots
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var imageHotSpots = {

        imageHotSpots: function() {
            $('.kt-hotspot').each(function(){
                var $this = $(this),
                    $container = $this.parents('.kt-hotspots-container'),
                    containerWidth = $container.width(),
                    containerHeight = $container.height(),
                    hotspotWidth = $this.width(),
                    hotspotHeight = $this.height(),
                    $hotspotDetails = $this.find( '.kt-hotspot-details');

                var hotspotLeftOffset = $this.data('left'),
                    hotspotTopOffset = $this.data('top');

                hotspotLeftOffset = hotspotLeftOffset * containerWidth / 100;
                hotspotTopOffset = hotspotTopOffset * containerHeight / 100;

                var right = ( containerWidth - hotspotLeftOffset < 75 ) ? true : false,
                    left = ( hotspotLeftOffset < 75 ) ? true : false,
                    bottom = ( containerHeight - ( hotspotTopOffset + $hotspotDetails.height() ) < 75 ) ? true : false;

                var xPos = 'calc(-50% + ' + ( hotspotWidth / 2 ) + 'px)',
                    yPos = '5px';

                xPos = right ? '-100%' : xPos;
                xPos = left ? '0' : xPos;

                yPos = bottom ? 'calc(-100% - ' + ( hotspotHeight + 5 ) + 'px)' : yPos;

                $hotspotDetails.attr( 'style', 'transform:translate3D(' + xPos + ', ' + yPos + ', 0 )');
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, imageHotSpots );
} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( kiteTheme ) {
        kiteTheme.imageHotSpots();
    }
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/icon-box.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  iconBox
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};
    var iconBox = function () {
        this.hyperLink();
    };

    iconBox.prototype = {
        hyperLink: function () {
            if ($('.iconbox.whole_link_enable,.custom-iconbox.whole_link_enable').length) {
                $('.iconbox.whole_link_enable,.custom-iconbox.whole_link_enable').on('click', function () {
                    var $a = $(this).find('a');
                    window.open($a.attr('href'));
                });
            }
        },

    };

    // expose to scope
    $.extend( kiteTheme, {
        iconBox: iconBox
    } );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($){
    if ( window.kiteTheme ) {
        new kiteTheme.iconBox();
    }
})(jQuery);


/*! 
 * 
 * ================== assets/js/kite/elements/instagram.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  instagram
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var instagram = {

        instagramInit: function() {
            this.instagramAjaxRequest();
            this.instagramAnimation();
            this.instagramEqualHeightWidth();
        },

        instagramAjaxRequest: function( container = $(document)) {
            var self = this;
            if (container.find('.insta-ajax').length) {
                let elements = [] ;
                container.find('.insta-ajax').each(function(){
                    elements.push($(this).attr('id'));
                });
                let i = 0;
                var instaAjaxFunction = function(i) {
                    if (i < elements.length ) {
                        let instaUrl = "https://instagram.com/";
                        let el = container.find('#'+elements[i]);
                        let instaData = el.data('insta');

                        if ( typeof instaData == 'undefined' || !instaData ) return;

                        if (instaData.hashtag.length)
                            instaUrl += "explore/tags/"+instaData.hashtag;
                        else
                            instaUrl += instaData.username.trim();

                        $.ajax({
                            url: instaUrl
                        }).done(function(response){
                            let ajaxurl = kite_theme_vars.ajax_url;
                            $.ajax({
                                url: ajaxurl,
                                method:'post',
                                data: {
                                    action:"kite-instagram-generate-dom",
                                    insta_data: instaData,
                                    insta_html: response
                                }
                            }).done( function( newResponse ) {
                                if ( instaData.carousel.length ) {
                                    el.find('.swiper-wrapper').html(newResponse);
                                    self.carousel(container);
                                    self.instagramAnimation();
                                    self.instagramEqualHeightWidth();
                                } else {
                                    el.find('.instagramfeed').html(newResponse);
                                    self.instagramAnimation();
                                    self.instagramEqualHeightWidth();
                                }
                                ++i;
                                instaAjaxFunction(i);
                            }).fail(function(error){
                                console.log('2.failed to load instagram data');
                                ++i;
                                instaAjaxFunction(i);
                            });
                        }).fail(function(){
                            console.log('1.failed to load instagram data');
                            ++i;
                            instaAjaxFunction(i);
                        });
                    }
                };
                instaAjaxFunction(i);
            }
        },
        instagramEqualHeightWidth: function () {
            if ($('.instagram-feed').length) {
                if ($('.instagram-feed').data('equal-height-width')) {
                    $('.instagram-feed').find('.instagram-img img').each(function (index, el) {
                        $(this).attr('style', 'height:' + $(this).width() + 'px !important;object-fit:cover;');
                    });
                }
            }
        },

        /* Instagram animation  */
        instagramAnimation: function () {
            var self = this;

            if ( ! $('#main .instagram-feed').length ) { 
                return;
            }

            var instagramAnimationBase = function ($container) {
                var $selector,
                    counter = 0;

                if ($container.find('.instagramfeed').hasClass('instagram-carousel')) { // Selector for carousel mode
                    $selector = '.swiper-slide-visible:not(.isanimated)';
                } else { // selector for grid mode
                    $selector = '.instagramfeed .instagram-img:not(.isanimated)';
                }
                $container.find($selector).waypoint({
                    handler: function () {
                        var $this = $(this.element);

                        $this.each(function () {
                            var $item = $(this);
                            setTimeout(function () {

                                //Ask self.animationDelay() for the amount of delay per each item
                                var delay = self.animationDelay(counter, $item);

                                // Select all items
                                var $allItems = $container.find('.instagramfeed .instagram-img');

                                //Select one of available animations
                                self.setAnimationForItems($container, $allItems, $item, delay);

                                //Reset counter per each iteration.
                                counter = counter + 1;

                            }, 50);
                            counter = 0;
                        });
                        this.destroy();
                    },
                    offset: '95%'
                });
            }

            $('#main .instagram-feed').each(function () {

                var $container = $(this);

                if ((self.isMobile() || self.isTablet()) && $container.hasClass('no-responsive-animation')) {
                    return true;
                }

                instagramAnimationBase($container);

            });

            //Remove class of animation because there is no need for animation in toggle-sidebar
            $('.togglesidebar .instagram-feed').removeClass('fadein fadeinfrombottom fadeinfromtop fadeinfromright fadeinfromleft zoomin');
        },

    };

    kiteTheme = Object.assign( kiteTheme, instagram );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.instagramInit();
    }
    $(window).on( 'resize', function(){
        kiteTheme.instagramEqualHeightWidth();
    });

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-instagram-feed.default', function ($scope) {
            kiteTheme.instagramAjaxRequest($scope);

            kiteTheme.instagramEqualHeightWidth();
            kiteTheme.instagramAnimation();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/lookbook-fullscreen.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  lookBookFullScreen
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var lookBookFullScreen = {
        /*-----------------------------------------------------------------------------------*/
        /*  Lookbook FullScreen Image Reveal
        /*-----------------------------------------------------------------------------------*/
        lookBookFullScreen: function () {
            if ( !$('.imagefullscreenreveal').length ) {
                return;
            }
            if ( $(window).width() < 1140 ) {
                $('.imagefullscreenreveal .swiper-container').css('display', 'none');
                return;
            }
            $('.imagefullscreenreveal').each(function () {
                var $this = $(this);
                var $swiperContainer = $(this).find('.swiper-container');
                var lookBookFullsSreenSwiper = new Swiper($swiperContainer, {
                    autoplay: {
                        delay: 400,
                    },
                    speed: 200,
                    loop: true,
                    effect: 'fade',
                });
                lookBookFullsSreenSwiper.autoplay.stop();
                $this.find(' > span').hover(function () {
                    /* Stuff to do when the mouse enters the element */
                    lookBookFullsSreenSwiper.autoplay.start();
                    $(this).parents('.imagefullscreenreveal').addClass('hover');
                }, function () {
                    /* Stuff to do when the mouse leaves the element */
                    lookBookFullsSreenSwiper.autoplay.stop();
                    $(this).parents('.imagefullscreenreveal').removeClass('hover');
                });
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, lookBookFullScreen );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.lookBookFullScreen();
    }
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/newsletter.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  newsletter
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var newsletter = {
        /*-----------------------------------------------------------------------------------*/
        /*  Easy Pie Chart Function
        /*-----------------------------------------------------------------------------------*/

        newsletter: function () {
            if ( ! $('.mailpoet_form.mailpoet_form_widget, .widget_mc4wp_form_widget, .mc4wp-form').length ) return;
            $('.mailpoet_form.mailpoet_form_widget, .widget_mc4wp_form_widget').each(function (index, el) {
                if ($(this).parents('.kt-newsletter').length == 0) {
                    $(this).wrap('<div class="kt-newsletter boxed style1"></div>');
                }
            });

            $('.widget_wysija_cont').each(function (index, el) {
                if ($(this).parents('.kt-newsletter').length == 0) {
                    $(this).wrap('<div class="kt-newsletter boxed style1"></div>');
                }
            });

            $('.kt-newsletter').each(function (index, el) {
                if ($(this).parent().width() < 325 || $(this).find('input:not(:hidden)').length > 2)
                    $(this).addClass('responsive');
                else
                    $(this).removeClass('responsive');


            });

            $('.mailpoet_paragraph').each(function (index, el) {
                if ($(this).find('input.mailpoet_submit').length && $(this).find('.mailpoet_submit_loading').length == 0)
                    $(this).append('<span class="mailpoet_submit_loading"></span>');
            });

            $('.kt-newsletter .mailpoet_text,.kt-newsletter .wysija-paragraph .wysija-input').hover(function () {
                $(this).parents('.kt-newsletter').addClass('hover');
            }, function () {
                $(this).parents('.kt-newsletter').removeClass('hover');
            });
        },
    };

    kiteTheme = Object.assign( kiteTheme, newsletter );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.newsletter();
    }
    $(window).on( 'resize', function(){
        kiteTheme.newsletter();
    });

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-newsletter.default', function ($scope) {
            kiteTheme.newsletter();
        });
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-newsletter-mailchimp.default', function ($scope) {
            kiteTheme.newsletter();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/pie-chart.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  pieChart
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var pieChart = {
        /*-----------------------------------------------------------------------------------*/
        /*  Easy Pie Chart Function
        /*-----------------------------------------------------------------------------------*/

        pieChart: function () { // pieChart run in document ready and call after Ajax

            var self = this;

            var $pieChartBox = $('.piechartbox:not(.shortcodeanimation), .piechartbox.shortcodeanimation.no-responsive-animation');

            if (!$pieChartBox.length) return;

            self.pieChartAnimate($pieChartBox);
        },

        /* PieChart With Animation*/
        pieChartAnimate: function ($element) { // call when its appeared on viewport
            var self = this;

            var animation = false;
            if ( self.windowWidth > 1140 ) {
                animation = { duration: 2500, enabled: true };
            }

            $element.each(function () {
                var $this = $(this);
                var $dot = $this.find('.dot-container');
                $this.find('.easypiechart').easyPieChart({
                    scaleColor: false,
                    barColor: $this.attr('data-barColor'),
                    lineWidth: 2,
                    trackColor: 'rgba(0,0,0,0)',
                    lineCap: 'round',
                    easing: 'easeOutQuint',
                    animate: animation,
                    size: 145,
                    onStep: function (from, to, percent) {
                        $dot.css({ transform: 'rotate(' + (percent * 3.6 + 6) + 'deg)' });
                    }
                });

                if ( animation == false ) {
                    var percent = $this.find('.easypiechart').data('percent');
                    $dot.css({ transform: 'rotate(' + (percent * 3.6 + 6) + 'deg)' });
                }
            });
        },
    };

    kiteTheme = Object.assign(kiteTheme, pieChart);

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.pieChart();
    }

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/kite-piechart.default', function ($scope) {
            kiteTheme.pieChart();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/progressbar.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  ProgressBar
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var progressBar = {
        /*-----------------------------------------------------------------------------------*/
        /*  progress bar with animation Function
        /*-----------------------------------------------------------------------------------*/

        progressBar: function () { // progressBar run in document ready and call after Ajax

            var self = this;

            var $progressBar = $('.progress_bar:not(.shortcodeanimation), .progress_bar.shortcodeanimation.no-responsive-animation');

            if ( !$progressBar.length ) { 
				return;
			}

            self.progressBarAnimate($progressBar);
        },

        /* Animate progressBar */
        progressBarAnimate: function ($element) { // call when its appeared on viewport

            var self = this;

            $element.each(function () {
                var $this = $(this),
                    percentage = $this.find('.progressbar_percent').data('percentage');
                $this.find('.progress_percent_value').addClass("complete");
                $this.find('.progressbar_percent').css('width', percentage + '%');

            });
        },

    };

    kiteTheme = Object.assign(kiteTheme, progressBar);

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.progressBar();
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/kite-progressbar.default', function ($scope) {
            kiteTheme.progressBar();
        });
    });
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/teta-text-box.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  tetaTextBox
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var tetaTextBox = {
        typeAnimation: function () {
            var self = this;
            
			if ( ! $('.textbox[data-animation-txt="true"]').length ) { 
				return;
			}

            $('.textbox[data-animation-txt="true"]').each(function () {
                var string = [$('#' + $(this).attr('id') + ' #txtbox').attr('data-text')],
                    loop = Boolean(parseInt($(this).attr('data-loop'))),
                    typeSpeed = parseInt($(this).attr('data-speed')),
                    backDelay = $('#' + $(this).attr('id') + ' #txtbox').attr('backDelay'),
                    backSpeed = parseInt($(this).attr('data-backspeed'));
                var typed = new Typed('#' + $(this).attr('id') + '  #txtbox', {
                    strings: string,
                    typeSpeed: typeSpeed,
                    backSpeed: backSpeed,
                    backDelay: backDelay,
                    fadeOut: true,
                    loop: loop
                });
            });
        },

    };

    kiteTheme = Object.assign( kiteTheme, tetaTextBox);

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( window.kiteTheme ) {
        kiteTheme.typeAnimation();
    }
})(jQuery, window.kiteTheme);


/*! 
 * 
 * ================== assets/js/kite/elements/video.js =================== 
 **/ 

/*-----------------------------------------------------------------------------------*/
/*  video
/*-----------------------------------------------------------------------------------*/

( function ( kiteTheme, $ ) {
    'use strict';

    kiteTheme = kiteTheme || {};

    var video = {

        initVideo: function () {
            this.fitVideo();
            this.initVideoBackground();
            this.embedVideoLightGallery();
            this.videoBackgroundSize();
        },

        /*-----------------------------------------------------------------------------------*/
        /*  fitvid 
        /*-----------------------------------------------------------------------------------*/

        fitVideo: function () {
            $(".container").fitVids();
        },

        /*----------------------------------------------------------------------------------*/
        /*  mediaelementplayer ( Html Video )
        /*-----------------------------------------------------------------------------------*/

        initVideoBackground: function () {

            var self = this;
            if ( ! $('.video').length ) {
                return;
            }

            if (typeof $.fn.mediaelementplayer == 'function') {
                $('.video').each(function (index, el) {
                    var autoplay = false;
                    var autoplayCheck = $(this).attr('autoplay');
                    if (typeof autoplayCheck !== typeof undefined && autoplayCheck !== false) {
                        autoplay = true;
                    }
                    $(this).mediaelementplayer({
                        enableKeyboard: false,
                        iPadUseNativeControls: false,
                        pauseOtherPlayers: false,
                        iPhoneUseNativeControls: false,
                        AndroidUseNativeControls: false,
                        autoplay: autoplay,
                        features: ['playpause', 'progress', 'current', 'duration', 'tracks', 'volume', 'fullscreen'],
                        success: function (mediaElement, domObject) {
                            // fade in play buttons and poster image In Video Html 5 inline
                            $('.mejs-poster').addClass('fadein');

                            if (mediaElement.paused && autoplay) {
                                mediaElement.play();
                            }

                        },
                    });
                });

                //mobile check
                if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
                    self.videoBackgroundSize();
                    $('.videohomepreload').show();
                    $('.videowrap').remove();
                }

                $('.inline_video').each(function (i) {
                    var $this = $(this);
                    if ($this.hasClass('hide-control')) {
                        var $hideControl = $this.find('.mejs-controls');
                        $hideControl.remove();
                        $this.find('.mejs-layers').remove();
                    }
                });

                // append play button In poster image wrap ( for inline Video ) - we need set this div In this Position For hidding Play buttons when click On video
                var $playButton = $('.inline_video.video_embed_container .play-button');
                $('.inline_video.video_embed_container .play-button').remove();

                var $mejsPoster = $('.mejs-poster');
                $playButton.appendTo($mejsPoster);
            }
        },

        /*----------------------------------------------------------------------------------*/
        /*  light galley for video
        /*-----------------------------------------------------------------------------------*/

        embedVideoLightGallery: function () {

            if ( ! $('.video_embed_container').length ) {
                return;
            }

            $('.video_embed_container').each(function (i) {

                var $this = $(this);

                var videoEmbedID = $this.attr('id');
                if (typeof $.fn.lightGallery == 'function') {
                    $this.not('.inline_video').lightGallery({
                        counter: false,
                        addClass: 'videopopup',
                        galleryId: videoEmbedID,
                    });
                }
            });

        },

        /*----------------------------------------------------------------------------------*/
        /*  Video background size
        /*-----------------------------------------------------------------------------------*/

        videoBackgroundSize: function () {
            if ( ! $('.videowrap').length ) {
                return;
            }

            $('.videowrap').each(function (i) {

                var $sectionWidth = $(this).closest('.videohome ').outerWidth();
                var $vcVideoWrap = $(this).parents('.vc_videowrap');

                if ($vcVideoWrap.length) {

                    var $sectionHeight = $vcVideoWrap.find('.vc_videocontent').outerHeight();

                    $(this).width($sectionWidth);
                    $vcVideoWrap.height($sectionHeight);

                } else {

                    var $sectionHeight = $(this).closest('.videohome').outerHeight();
                    $(this).width($sectionWidth);
                    $(this).height($sectionHeight);

                }

                // calculate scale ratio
                var videoWidthOriginal = 1280,  // original video dimensions
                    videoHeightOriginal = 720,
                    vidRatio = 1280 / 720,
                    scale_h = $sectionWidth / videoWidthOriginal,
                    scale_v = ($sectionHeight) / videoHeightOriginal,
                    scale = scale_h > scale_v ? scale_h : scale_v;

                // limit minimum width
                var minVideoWidth = vidRatio * ($sectionHeight + 20);

                if (scale * videoWidthOriginal < minVideoWidth) { scale = minVideoWidth / videoWidthOriginal; }

                $(this).find('video').width(Math.ceil(scale * videoWidthOriginal + 2));
                $(this).find('video').height(Math.ceil(scale * videoHeightOriginal + 2));

                $(this).scrollLeft(($(this).find('video').width() - $sectionWidth) / 2);
                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);
                $(this).scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);

            });

        },
    };

    kiteTheme = Object.assign( kiteTheme, video );

} ).apply( this, [ window.kiteTheme, jQuery ] );

(function($, kiteTheme){
    if ( kiteTheme ) {
        kiteTheme.initVideo();

        $(window).on( 'resize', function(){
            kiteTheme.videoBackgroundSize();
        });
    }
})(jQuery, window.kiteTheme);
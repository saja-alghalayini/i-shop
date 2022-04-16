(function ($) {
    var optionsKey = 'theme_teta_lite_options';
    var utility = {
        //Checks if element as desired attribute
        HasAttr: function ($elm, attr) {
            return typeof $elm.attr(attr) != 'undefined';
        },
        GetAttr: function ($elm, attr, def) {
            return this.HasAttr($elm, attr) ? $elm.attr(attr) : def;
        }
    };

    //Show/hide fields based on selected value
    function FieldSelector() {
        $('.field-selector select').each(function () {
            var $select = $(this),
                $section = $select.parents('.section'),
                fieldList = utility.GetAttr($select, 'data-fields', ''),
                $fields = $section.find(fieldList);

            $select.change(function () {
                var $selected = $select.find('option:selected');

                if (!utility.HasAttr($selected, 'data-show')) {
                    $fields.slideUp('fast');
                    return;
                }

                var show = $selected.attr('data-show'),
                    $items = $section.find(show);

                $fields.not($items).slideUp('fast');
                $items.slideDown('fast');
            }).change();
        });
    }

    //Handles icon selector
    function iconSelect() {
        var iconSelectFunc = function() {
            $('.kt-icons').removeAttr('style');
            var $iconsContainer = $('.kt-icon-container').eq(0).clone();
            $iconsContainer.addClass('kt-container-popup');
            $iconsContainer.find('input,.selected-icon,.select-icon-text').remove();
            $('.kt-icons').remove();
            $('body').append($iconsContainer);

            $(document).on('click','.select-icon-text',function() {
                var $this = $(this);

                if ( $('.kt-container-popup').length <= 0 ) {
                    $iconsContainer = $('.kt-icon-container').eq(0).clone();
                    $iconsContainer.addClass('kt-container-popup');
                    $iconsContainer.find('input,.selected-icon,.select-icon-text').remove();
                    $('.kt-icons').remove();
                    $('body').append($iconsContainer);
                }

                var $iconInput = $this.siblings('input'),
                    $selectedIconBox = $this.siblings('.selected-icon');

                $iconsContainer.find('.kt-icon.selected').removeClass('selected');

                if ( $iconInput.attr('value') !== '' ) {

                    $iconsContainer.find('.kt-icon[data-name="' + $iconInput.attr('value') + '"]').addClass('selected');
                    setTimeout(function(){
                        //Scroll iconContainer to show the select icon
                        if ( $iconsContainer.find('.selected').length ) {
                            var $kt_icons = $iconsContainer.find('.kt-icons'),
                                $offset = $kt_icons.scrollTop() - $kt_icons.offset().top + $kt_icons.find('.selected').offset().top ;

                            if ( $offset > 0 ) {
                                $kt_icons.stop().animate({
                                    scrollTop: $offset + "px"
                                }, 200);
                            }
                        }
                    },100)

                }

                $selectedIconBox.addClass('icon_container_owner');
                $iconsContainer.addClass('show');


            });

            $(document).on('click','.kt-container-popup .kt-icon', function () {
                var $this = $(this),
                    $iconOwner = $('.icon_container_owner'),
                    $iconInput = $iconOwner.siblings('input');

                if ( $this.is('.selected') ) {
                    $this.removeClass('selected');
                    $iconInput.attr('value', '');
                    $iconOwner.removeClass('icon-' + $iconOwner.data('name'));
                    $iconOwner.data('name','');
                } else {
                    $iconInput.attr('value', $(this).attr('data-name'));
                    $this.siblings('.kt-icon').removeClass('selected');

                    $iconOwner.removeClass('icon-' + $iconOwner.data('name'));
                    $iconOwner.addClass('icon-' + $(this).attr('data-name'));
                    $iconOwner.data('name',$(this).attr('data-name'));
                    $this.addClass('selected');
                }

            });

            $(document).on('click','.kt-icons .close,.kt-container-popup', function () {
                var $iconOwner = $('.icon_container_owner');

                $iconOwner.removeClass('icon_container_owner');
                $iconsContainer.removeClass('show');
            });

        }

        iconSelectFunc();
    }

    function CSVInput() {

        $('.csv-input').each(function () {
            var $container = $(this),
                $hidden = $container.find('input[type="hidden"]'),
                $input = $container.find('input[type="text"]'),
                $addBtn = $container.find('.btn-add'),
                $list = $container.find('.list');

            var values = $hidden.val().length > 0 ? $hidden.val().split(',') : [];

            //Add current items to our list
            for ( i = 0; i < values.length; i++) {
                var val = values[i],
                    text = val.replace('%666', ','),//Evil char
                    $item = getNewItem(val, text);

                $list.append($item);
                handleCloseBtn($item);
            }

            assembleList();

            //Handle add button
            $addBtn.click(function (e) {
                e.preventDefault();

                var val = $input.val();
                val = $.trim(val);
                $input.val('');//Clear

                if (val.length < 1) {
                    return;
                }

                var $item = getNewItem(val.replace(",", "%666"), val);
                handleCloseBtn($item);
                $item.hide();

                $list.prepend($item);

                assembleList();

                $item.slideDown('fast', function () { $(window).resize(); });
            });

            function assembleList() {
                $hidden.val('');//Clear the current list
                var vals = [];

                $list.find('.value').each(function () {
                    var value = $(this).attr('data-val');
                    vals.push(value);
                });

                $hidden.val(vals.join(','));
            }

            function handleCloseBtn($item) {
                //Remove item on click
                $item.find('.btn-close').click(function (e) {
                    e.preventDefault();

                    $item.slideUp('fast', function () { $item.remove(); assembleList(); $(window).resize(); });
                });
            }

            function getNewItem(val, text) {
                return $('<div class="value" data-val="' + val + '"><span>' + text + '</span><a href="#" class="btn-close"></a></div>');
            }

        });


    }

    function imageSelect() {
        var $controls = $('.imageSelect');

        $controls.each(function () {
            var $select = $(this),
                $input = $select.find('input'),
                $options = $select.find('a');

            if( !$select.find('.selected').length )
            {
                $select.find('a').eq(0).addClass('selected');
                $input.val($select.find('a').eq(0).html());
            }

            //Hide input control
            $input.hide();

            $options.click(function (e) {
                e.preventDefault();

                var $ctl = $(this);

                if ( $ctl.hasClass('selected') ) {
                    return;
                }

                $options.removeClass('selected');
                $ctl.addClass('selected');

                $input.val( $ctl.html() );
            });
        });

       function advancedImageSelect() {
            $('.kt-imageselect-container').each(function () {

                var $list = $(this),
                $input = $list.find('input'),
                $inputval = $input.val();

                if ($inputval.length !== 0) {
                    $list.find("span.image-" + $inputval).addClass('selected');
                } else {
                    $list.find("span:first-child").addClass('selected');
                }

                $(document).on('click', '.kt-image',function () {
                    if( !$(this).hasClass('selected') ) {
                        $(this).closest('span').siblings('input').val($(this).attr('data-name'));
                        $(this).siblings('.kt-image').removeClass('selected');
                        $(this).addClass('selected');
                    }
                    $input.trigger( "change" );
                });

            });
        }
        advancedImageSelect();
    }

    function Chosen() {
        if ( !$.fn.chosen ) {
            return;
        }

        $('.chosen').chosen();
    }

    function Combobox() {
        $('div.select').each(function () {
            var $this = $(this),
                $overlay = $this.find('div'),
                $select = $this.find('select');

            $select.change(function () {
                $overlay.html($select.find('option:selected').text());
            });

            $select.change();
        });
    }

    function colorPicker() {
        if ( !$.fn.wpColorPicker ) {
            return;
        }

        $('#appearance .colorinput, #preloader .colorinput , #header .colorinput , #menu .colorinput , #headerstyle .colorinput , #headerStartBtn .colorinput , #footer .colorinput , #notification .colorinput, #social .colorinput , #topbar .colorinput , #woocomerce .colorinput, .kite-widget-attributes-table .colorinput, .widget-insta.colorinput,#menu-management ul.menu li .colorinput, .taxonomy-product_cat .colorinput,.color-attr-field-container .colorinput,.all_taxonamies_color .colorinput').each(function () {
            $(this).wpColorPicker( { 
                palettes : false,
                change:function() {
                    if ($(this).is('.color-attr-field-container .colorinput')) {
                        $color = $(this).wpColorPicker('color');
                        $(this).closest('.color-attr-field-container').find('.color_extra_value').val($color);
                    }
                }
            });
        });
    }

    function rangeField() {
        $('input[type="range"]').on( 'input', function(){
            $(this).siblings('span.output').html( $(this).val() );
        });
    }

    function tooltips() {


        $('.section-tooltip').each(function () {
            var $this = $(this),
                text = $this.html(),
                $icon = $('<a href="#"></a>'),
                $wrap = $('<div class="tip_wrapper"><div class="text">' + text + '</div><div class="arrow_shade"></div><div class="arrow"></div></div>');

            $this.html('');
            $this.append($icon);
            $this.append($wrap);
            $wrap.css({ opacity: 0, display: 'none' });

            function adjustTooltip() {
                $wrap.css({ right: 0, top: -(($wrap.outerHeight() - $icon.outerHeight() * 0.5) + 15) });
            }

            adjustTooltip();

            $icon.click(function (e) {
                e.preventDefault();
            });

            if ($.fn.hoverIntent) {
                $this.hoverIntent(inHandler, outHandler);
            } else {
                $this.hover(inHandler, outHandler);
            }

            function inHandler() {
                $wrap.css({ display: 'block' });
                adjustTooltip();
                $wrap.stop().animate({ opacity: 1 }, 200);
            }

            function outHandler() {
                $wrap.stop().animate(
                    {
                        opacity: 0
                    },
                    {
                        duration: 200, 
                        complete: function () {
                            $wrap.css({ display: 'none' });
                        }
                    }
                );
            }

        });

    }

    function saveButton() {
        var $btns = $('.kt-main .save-button'),
            $loadingIcons = $btns.find('.loading-icon'),
            $saveIcons = $btns.find('.save-icon'),
            $form = $('.kt-container'),
            $dummyData = $('.kt-main input[name="import_dummy_data"]');

        $btns.click(function (e) {
            var $btn = $(this);

            if ($btn.hasClass('loading')) {
                e.preventDefault();
                return;
            }

            var data = $form.find('input,textarea,select').serialize();

            $loadingIcons.css({ display: 'inline' });
            $saveIcons.hide();

            $btns.addClass('loading');


            //Todo: Save the settings
            //Test ajax call
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                success: function (data, textStatus, jqXHR) {
                    //TODO: Show proper saved message
                    onSaveComplete();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    onSaveComplete();

                    alert('Error occured in saving data');
                }
            });

            function onSaveComplete() {
                $loadingIcons.hide();
                $saveIcons.css({ display: 'inline' });
                $btns.removeClass('loading');

                //Reload page if import dummy data option is selected
                if ($dummyData.length && $dummyData.val() == '1') {
                    document.location.reload(true);
                }
            }

            e.preventDefault();
        });


    }

    function tabs() {
        var $tabs = $('.kt-tab a'),
            $active = $();

        $tabs.each(function () {
            var $this = $(this),
                href = $this.attr('href'),
                $container = $(href);

            $this.click(function (e) {
                e.preventDefault();

                if ( $this.hasClass('active') ) {
                    return;
                }

                $tabs.removeClass('active');
                $this.addClass('active');

                $active.fadeOut(100);
                $container.fadeIn(400);

                $active = $container;

                $(window).resize();
            });

            if ( $this.hasClass('active') ) {
                $this.removeClass('active');
                $this.click();
                $active = $container;
            } else {
                $container.fadeOut(100);
            }

        });

    }

    function sidebarAccordion() {
        var $panels = $('#kt-sidebar-accordion > div'),
            $head = $('#kt-sidebar-accordion > h3 a');

        $panels.hide();

        var $active = $('#kt-sidebar-accordion > h3 a.active'),
            $target = $();

        if ( $active.length > 0 ) {
            $target = $active.parent().next();
            $target.show();
        }


        $head.click(function (e) {
            var $this = $(this);

            $target = $this.parent().next();

            if ( !$this.hasClass('active') ) {
                var $prev = $('#kt-sidebar-accordion > h3 a.active').parent().next();

                $head.removeClass('active');

                $prev.slideUp('slow', 'easeOutQuad');
                $target.slideDown('slow', 'easeOutQuad');
                $this.addClass('active');

            }

            e.preventDefault();
        });
    }

    function thickBox() {
        var $currentField = $();
        var $imageField = $();
        var $imageFieldContainer = $();

        $(document).on('click','.upload-field .upload-button',function(e){
            var $this = $(this),
                $parent = $this.parent(),
                referer = 'kt-settings',
                title = 'Upload';

            if ( $parent.attr('data-referer') !== undefined ) {
                referer = $parent.attr('data-referer');
            }

            if ( $parent.attr('data-title') !== undefined ) {
                title = $parent.attr('data-title');
            }

            $currentField = $(this).prev();
            $imageField = $(this).siblings('.upload-thumb').find('img');
            $imageFieldContainer = $(this).siblings('.upload-thumb');

            var $pid;


            if ( $('#post_ID').length <= 0 ) {
                $pid = $(this).parents('li.menu-item').find("input.menu-item-data-object-id");//Find ID of menu item
            } else {
                $pid = $('#post_ID');//Find ID of post type (post, page , ...)
            }

            var postId = $pid.length > 0 ? $pid.val() : '0';


            tb_show(title, 'media-upload.php?post_id=' + postId + '&referer=' + referer + '&type=image&TB_iframe=true', false);

            e.preventDefault();
        });

        $(document).on('click','.upload-thumb .close',function (e) {
            $(this).parents('.upload-thumb').removeClass("show");
            $(this).parents('.upload-field').find('input').val('');
        });

        var origSendToEditor = window.send_to_editor;

        window.send_to_editor = function (html) {
            if ($currentField.length) {
                var imageUrl = $(html).attr('href');

                //Find image id for using in upload field of product attribute
                //below code add becouse some host return a tag around img dom
                if ( $(html).attr('class') ) {
                    var imageUrl = $(html).attr('href');
                    var classes = $(html).attr('class').split(' ').filter(function (classname) { return (classname.indexOf('wp-image-') == 0); });
                } else {
                    var imageUrl = $(html).find('img').attr('src');
                    var classes = $(html).find('img').attr('class').split(' ').filter(function (classname) { return (classname.indexOf('wp-image-') == 0); });
                }

                var imageID = classes[0].replace('wp-image-','');
                if( imageID != undefined ) {
                    $currentField.closest('.field-container').find('input[name^="attribute_extra_values"]').val(imageID);
                }

                if( imageUrl == undefined ) {
                    imageUrl = $(html).attr('src');
                }

                $currentField.val(imageUrl);
                $imageField.attr({ 'src': imageUrl });

                if ( imageUrl.length ) {
                    $imageFieldContainer.addClass('show');
                }

                $imageField = $();
                $currentField = $();
                tb_remove();
            } else {
                if (typeof origSendToEditor != 'undefined') {
                    origSendToEditor(html);
                }
            }
        }
    }

    function imageFields() {
        var $imageSec = $('.section-home-slides'),
            $fields = $imageSec.find('.upload-field'),
            $dupBtn = $('<a class="duplicate-button" href="#">Add Image</a>'),
            $remBtn = $('<span class="remove-button"><a class=" close" href="#"><span class="close-icon"></span></a></span>');

        //Click handler for remove button
        $remBtn.click(function (e) {
            e.preventDefault();

            var $this = $(this);

            $this.parent().remove();

            $fields = $imageSec.find('.upload-field');

            if ($fields.length < 2) {
                //Remove the button
                $fields.find('.remove-button').remove();
            }
        });


        //Add remove button if there is more than one image field
        if ( $fields.length > 1 ) {
            $fields.append($remBtn.clone(true));
        }

        //Add duplicate button after last upload field
        $fields.filter(':last').after($dupBtn);

        $dupBtn.click(function (e) {
            e.preventDefault();

            //Don't try to reuse $fields var above ;)
            $fields = $imageSec.find('.upload-field');
            var $lastField = $fields.filter(':last'),
                $clone = $lastField.clone(true);

            //Clear the value (if any)
            $clone.find('input[type="text"]').val('');
            $clone.find('.upload-thumb').removeClass('show');
            $clone.find('img').attr('src','');

            $lastField.after($clone);

            //Refresh
            $fields = $imageSec.find('.upload-field');
            //Add 'remove' button to all fields
            //Rest of 'remove' buttons will get cloned
            if ( $fields.length == 2 ) {
                $fields.append($remBtn.clone(true));
            }
        });
    }

    function preloader() {

        var $preloaderTypeSelected = $('.section-preloader-type .imageSelect a.selected');
        $preloaderTypeSelected = $preloaderTypeSelected.text();

        $preloadertext = $('.section-preloader-text');
        $preloaderlogo = $('.section-preloader-logo');
        $preloaderboxcolor = $('.section-preloader_color').find('.field').eq(1);

        if ($preloaderTypeSelected == 'creative') {
            $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideDown('fast');
        } else {
            $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideUp('fast').show();
            $('.section-preloader-text').add($preloaderboxcolor).next('hr').hide();
        }

        $(document).on('click', '.section-preloader-type .imageSelect a', function () {

            var $this = $(this);
            $preloaderType = $this.text();

            if ($preloaderType == "creative") {
                $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideDown('fast');
                $('.section-preloader-text').next('hr').show();
            } else {
                $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideUp('fast');
                $('.section-preloader-text').next('hr').hide();
            }

        });

    }

    function menu() {

        var $container = $('#menu'),

            // Header Position
            $headerPosition = $container.find('.section-header-type .imageList a.selected'),
            $headerPositionVal = $headerPosition.text();

            //HeaderTop Style
            $HeadertopStyle = $container.find('.section-header-style .imageList a.selected'),
            $HeadertopStyleVal = $HeadertopStyle.text();

            // Header Color
            $HeaderColor = $container.find('.section-menu-color');
            // Header intial Color  - Only Hybrid menu
            $HeaderTopIntialColor = $container.find('.section-initial-menu-color');
            // Header intial Logo  - Only Hybrid menu
            $intialLogo = $container.find('.section-logo-second');
            // Header top Style
            $headerStyle = $container.find('.section-header-style');
            // Header Top Hover Style
            $HeaderTopHoverStyle = $container.find('.section-menu-hover-style');
            // Header submenu Hover Style
            $HeaderSubmenuHoverStyle = $container.find('.section-submenu-hover-style');
            // Header menu container  styles container Or Fullwidth            
            $HeaderContainerStyle = $container.find('.section-menu-container');
            // Menu vertical background Image
            $sectionVerticalMenuBackground = $container.find('.section-vertical_menu_background');
            // menu vertical - copyright text
            $sectionVerticalMenuCopyright = $container.find('.section-vertical_menu_copyright');
            $sectionVerticalMenuSocial = $container.find('.section-vertical-menu-social-display');
            // submenu color - mega menu Option Disable in sidebars menu
            $submenu_color = $container.find('.section-submenu-color');

        // 7 , 8 => Header is Top
        if ( $headerPositionVal !== '7' && $headerPositionVal !== '8' ) {

            // slid Up Menu vertical background Image
            $sectionVerticalMenuBackground.add($sectionVerticalMenuCopyright).slideUp('fast').next('hr').hide();
            $sectionVerticalMenuSocial.slideUp('fast').next('hr').hide();
            $headerStyle.add($HeaderTopHoverStyle).add($HeaderContainerStyle).add($submenu_color).add($HeaderSubmenuHoverStyle).slideDown('fast').next('hr').show();
            $(".section-menu-color").find('.field').eq(3).show(); // Hide opacity Option in left and Right menu
            $(".section-menu-color").find('.field.menu-opacity').hide();// this feild is hidden in top menus
            $(".section-menu-color").find('.field.border-color').show();// this feild is visible in top menus 

            // Slide up intail Color panel When Kite Menu ( hybrid Menu ) is not selected
            if ($HeadertopStyleVal == "kite-menu") {
                $HeaderColor.slideDown('fast').next('hr').show();
                $intialLogo.slideDown('fast').next('hr').show();
            } else if ($HeadertopStyleVal == "scroll-sticky") {
                $HeaderColor.slideUp('fast').next('hr').hide();
                $intialLogo.slideUp('fast').next('hr').hide();
            } else {
                $HeaderColor.slideUp('fast').next('hr').hide();
                $intialLogo.slideUp('fast').next('hr').hide();
            }                                    

        } else if ( $headerPositionVal == '7' || $headerPositionVal == '8') { // header is left or Right 

            $headerStyle.add($HeaderTopHoverStyle).add($HeaderTopIntialColor).add($HeaderContainerStyle).add($HeaderSubmenuHoverStyle).add($submenu_color).slideUp('fast').next('hr').hide();
            $sectionVerticalMenuBackground.add($sectionVerticalMenuCopyright).slideDown('fast').next('hr').show();
            $sectionVerticalMenuSocial.slideDown('fast').next('hr').show();

            $HeaderColor.slideDown('fast'); // slide down color

            $(".section-menu-color").find('.field.menu-opacity').show();// this feild is visible in vetical menu 
            $(".section-menu-color").find('.field.border-color').hide();// this feild is hidden in vetical menu

            $(".section-menu-color").find('.field').eq(2).show();// this feild visible in vetical menu 
            $(".section-menu-color").find('.field').eq(3).show();// this feild visible in vetical menu
            $HeaderTopIntialColor.slideUp('fast').next('hr').hide(); // intial header slide up 
            $intialLogo.slideUp('fast').next('hr').hide();//intial logo
            $HeaderTopHoverStyle.slideUp('fast').next('hr').hide(); // Top hover Style slide Up 

        }

        // Menu hover style
        var menuHoverStyle = function() {
            var $selected = $('.menu-hover-style .imageList a.selected');
            var $menuHoverColor = $('.menu-hover-color');
            var $menuBgHoverColor = $('.menu-bg-hover-color');

            if( $selected.hasClass('hover_style4') || $selected.hasClass('hover_style3') ) {

                if($selected.hasClass('hover_style3')) {
                    $menuBgHoverColor.fadeOut(100);
                    $menuHoverColor.fadeIn(100);
                } else {
                    $menuHoverColor.add($menuBgHoverColor).fadeOut(100);
                }
            } else {
                $menuHoverColor.add($menuBgHoverColor).fadeIn(100);
            }
        }
        menuHoverStyle();
        $(document).on('click', '.menu-hover-style .imageList a', menuHoverStyle);

        // Menu Position
        $(document).on('click', '.section-header-type .imageList a', function () {

            var $headerPositionVal = parseInt($(this).text());

            //HeaderTop Style
            $HeadertopStyle = $container.find('.section-header-style .imageList a.selected'),
            $HeadertopStyleVal = $HeadertopStyle.text();

            if ( $headerPositionVal == '7' || $headerPositionVal == '8' ) { // header is left or Right

                $headerStyle.add($HeaderTopHoverStyle).add($HeaderContainerStyle).add($submenu_color).add($HeaderSubmenuHoverStyle).slideUp('fast').next('hr').hide();
                $sectionVerticalMenuBackground.add($sectionVerticalMenuCopyright).slideDown('fast').next('hr').show();
                $sectionVerticalMenuSocial.slideDown('fast').next('hr').show();
                $HeaderColor.slideDown('fast'); // slid down color
                $HeaderTopIntialColor.slideUp('fast').next('hr').hide(); // intial header slide up 
                $intialLogo.slideUp('fast').next('hr').hide();//intial logo
                $HeaderTopHoverStyle.slideUp('fast').next('hr').hide(); // Top hover Style slide Up 

                $(".section-menu-color").find('.field.menu-opacity').show();// this feild is visible in vetical menu 
                $(".section-menu-color").find('.field.border-color').hide();// this feild is hidden in vetical menu

            } else if ( $headerPositionVal !== '7' && $headerPositionVal !== '8' ) { // 7 , 8 => Header is't Top

                // Slide up intail Color panel When Kite Menu ( hybrid Menu ) is not selected
                if ($HeadertopStyleVal == "kite-menu") {

                    $HeaderTopIntialColor.slideDown('fast').next('hr').show();
                    $intialLogo.slideDown('fast').next('hr').show();

                } else if ($HeadertopStyleVal == "scroll-sticky") { // scroll to sticky menu

                    $HeaderTopIntialColor.slideDown('fast').next('hr').show();
                    $intialLogo.slideUp('fast').next('hr').hide();
                    $HeaderColor.slideUp('fast').next('hr').hide();

                } else { // fixed menu

                    $HeaderTopIntialColor.slideDown('fast').next('hr').show();
                    $HeaderColor.slideUp('fast').next('hr').hide();

                }
                $sectionVerticalMenuSocial.slideUp('fast').next('hr').hide();
                $(".section-menu-color").find('.field').eq(3).show(); // Hide opacity Option in left and Right menu
                $headerStyle.add($HeaderTopHoverStyle).add($HeaderSubmenuHoverStyle).add($HeaderContainerStyle).add($submenu_color).slideDown('fast').next('hr').show();
                $sectionVerticalMenuBackground.add($sectionVerticalMenuCopyright).slideUp('fast').next('hr').hide();

                $(".section-menu-color").find('.field.menu-opacity').hide();// this feild is hidden in top menus 
                $(".section-menu-color").find('.field.border-color').show();// this feild is visible in top menus
            }

        });

        // menu top style 
        $(document).on('click', '.section-header-style .imageList a', function () {

            var val = $(this).text(),
                $selected = $('#menu').find('.section-' + val);

            if (val == 'fixed-menu' || val == 'scroll-sticky') {
                // Hide logo secoun
                $(".section-logo-second").slideUp('fast').next('hr').hide();
                $(".section-menu-color").slideUp('fast').next('hr').hide();
                $(".section-logo").slideDown('fast').next('hr').show();
                $(".section-initial-menu-color").slideDown('fast').next('hr').show();

            } else if (val == 'kite-menu') {

                $(".section-logo-second , .section-logo , .section-initial-menu-color , .section-menu-color").slideDown('fast').next('hr').show();

            }

            $selected.slideDown('fast').next('hr').show();

        }).change();

    }

    function demoImporter() {
        $(document).on('click', 'a.import', function (e) {
            e.preventDefault();
            var demo = $(this).data('demo');
            $(this).parents('form').find('input#demo_name').val(demo);
            $(this).parents('form').submit();
        });
    }

    function setRowTypeIcon ()
    {
        $('span.row_type').each(function(){
            if($(this).html() == "parallax") {
                $(this).removeClass('video-type interactive_background-type').addClass('parallax-type'); 
            } else if( $(this).html() == "video" ) {
                $(this).removeClass('parallax-type interactive_background-type').addClass('video-type');
            } else if( $(this).html() == "interactive_background" ) {
                $(this).removeClass('parallax-type video-type').addClass('interactive_background-type');
            } else {
                $(this).removeClass('parallax-type video-type interactive_background-type');
            }
        })
    }

    function menuDependencies() {
        $(document).on('mouseup', 'li.menu-item .menu-item-handle' ,function(e){
            megaMenuHandle();
        });
        $(document).on('change',"input[name^='is-mega-menu']",function(e) {
            e.stopPropagation();
            megaMenuHandle();
        });

        megaMenuHandle();

        function megaMenuHandle(){
            //Mega menu & upload field dependencies
            var $menu = $('ul.menu.ui-sortable');

            setTimeout(function(){
                $menu.find('li.menu-item').removeClass('enable-mega-menu-of-parent');

                $menu.find('li.menu-item.menu-item-depth-0').each(function() {
                    $this = $(this);
                    var $megaMenu = $this.find("input[name^='is-mega-menu']");

                    if( $megaMenu.prop('checked') ) {

                        $this.nextUntil( '.menu-item-depth-0','li.menu-item.menu-item-depth-1,li.menu-item.menu-item-depth-2').addClass("enable-mega-menu-of-parent");
                        $this.addClass('enable-mega-menu-of-parent');

                    } else {
                        $this.nextUntil( '.menu-item-depth-0','li.menu-item.menu-item-depth-1,li.menu-item.menu-item-depth-2').removeClass("enable-mega-menu-of-parent");
                        $this.removeClass('enable-mega-menu-of-parent');
                    }
                });
            },500);
        }

        $('#menu-to-edit').on('click',"a.item-edit",menuInitOptionHandle);

        function menuInitOptionHandle () {
            colorPicker();
        }
    }

    function filterWidgetChangeDisplayType() {
       // Add a new attribute (via ajax) : this function is a customized copy of function defined in woocommerce/assets/js/admin/meta-boxes-product.js
        $(document).on( 'change', 'p.display_type_container select, p.attribute_container select', function(e) {
            e.preventDefault();

            var $widget      = $(this).closest('.widget-content'),
                attribute    = $widget.find('p.attribute_container select').find('option:selected').val(),
                displayType = $widget.find('p.display_type_container select').find('option:selected').val(),
                id           = $widget.find('input[name="w_id"]').val(),
                id_base      = $widget.find('input[name="w_idbase"]').val(),
                number       = $widget.find('input[name="w_number"]').val(),
                ajaxNonce    = $widget.find('input[name="ajax_nonce"]').val(),
                $attrTable   = $widget.find('.kite-widget-attributes-table'),
                $hideText    = $widget.find('.hide_text_container');

            if(displayType == 'image') {
                $hideText.slideDown();
            } else {
                $hideText.slideUp();
            }

            if ( attribute !== undefined &&  (displayType == 'color' || displayType == 'image') ) {

                var data = {
                    action:      'change_attribute_display_type',
                    attribute    : attribute,
                    display_type : displayType,
                    id           : id,
                    id_base      : id_base,
                    number       : number,
                    ajax_nonce   : ajaxNonce
                };
                $attrTable.slideDown();
                $attrTable.addClass('loading');
                $attrTable.find('.wc-loading').removeClass('hide');

                $.post( ajaxurl, data, function( response ) {
                    $attrTable.find('table, .no-term').remove();
                    $attrTable.prepend(response);
                    colorPicker();
                    //wait a bit to add new elements
                    setTimeout(function() {
                        $attrTable.removeClass('loading');
                        $attrTable.find('.wc-loading').addClass('hide')
                    },100)

                });

            }
            else
            {
                $attrTable.slideUp();
            }

            return false;
        });

        //Run colorPicker aftar updating widget
        $( document ).on( 'widget-updated' , function( event, $widget ){
            colorPicker();
        });
    }

    function videoWidgetChangeDisplayType() {
        var videoTypeDependencies = function( videoDisplayTypeContainer ) {
            if( videoDisplayTypeContainer == undefined ) {
                videoDisplayTypeContainer = '.videoDisplayTypeContainer select';
            }

            var $videoDisplayTypeContainer = $(videoDisplayTypeContainer);

            $videoDisplayTypeContainer.each(function(){
                var $widget      = $(this).closest('.kite-video-widget'),
                    displayType  = $(this).find('option:selected').val();

                $widget.removeClass('local_video local_video_popup embeded_video_youtube embeded_video_youtube_popup embeded_video_vimeo embeded_video_vimeo_popup').addClass(displayType);
            });

        }

        videoTypeDependencies();

        $( document ).on( 'change', '.videoDisplayTypeContainer select', function(){
            videoTypeDependencies(this);
        });

        $( document ).on( 'widget-updated' , function( event, $widget ) {
            videoTypeDependencies();
        });
    }

    function fontDependencies() {
        var $selectFontTypeBody = $('select[name="font-body-type"]'),
            $selectFontTypeHeadings = $('select[name="font-headings-type"]'),
            $selectFontTypeNavigation = $('select[name="font-navigation-type"]'),
            $selectFontBody = $('select[name="font-body"]').closest('.field'),
            $selectFontHeadings = $('select[name="font-headings"]').closest('.field'),
            $selectFontNavigation = $('select[name="font-navigation"]').closest('.field'),
            $selectCustomFontBodyUrl = $('input[name="custom-font-url-body"]').closest('.field'),
            $selectCustomFontBodyName = $('input[name="custom-font-name-body"]').closest('.field'),
            $selectCustomFontHeadingsUrl = $('input[name="custom-font-url-headings"]').closest('.field'),
            $selectCustomFontHeadingsName = $('input[name="custom-font-name-headings"]').closest('.field'),
            $selectCustomFontNavigationUrl = $('input[name="custom-font-url-navigation"]').closest('.field'),
            $selectCustomFontNavigationName = $('input[name="custom-font-name-navigation"]').closest('.field');

            $selectFontBody.add($selectFontHeadings).add($selectCustomFontBodyUrl).add($selectCustomFontBodyName).add($selectCustomFontHeadingsUrl).add($selectCustomFontHeadingsName).add($selectFontNavigation).add($selectCustomFontNavigationUrl).add($selectCustomFontNavigationName).hide();
            set_font_type();

        function set_font_type()
        {
            //Body font
            var selected = $selectFontTypeBody.find('option:selected').val();
            if( selected == 'default' ) {
                $selectFontBody.hide();
                $selectCustomFontBodyUrl.hide()
                $selectCustomFontBodyName.hide();
            } else if( selected == 'google' ) {
                $selectFontBody.show();
                $selectCustomFontBodyUrl.hide();
                $selectCustomFontBodyName.hide();
            } else {
                $selectFontBody.hide();
                $selectCustomFontBodyUrl.show();
                $selectCustomFontBodyName.show();
            }

            // Headings font
            var selected = $selectFontTypeHeadings.find('option:selected').val();
            if( selected == 'default' ) {
                $selectFontHeadings.hide();
                $selectCustomFontHeadingsUrl.hide();
                $selectCustomFontHeadingsName.hide();
            } else if( selected == 'google' ) {
                $selectFontHeadings.show();
                $selectCustomFontHeadingsUrl.hide();
                $selectCustomFontHeadingsName.hide();
            } else {
                $selectFontHeadings.hide();
                $selectCustomFontHeadingsUrl.show();
                $selectCustomFontHeadingsName.show();
            }

            // Navigation font
            var selected = $selectFontTypeNavigation.find('option:selected').val();
            if( selected == 'default' ) {
                $selectFontNavigation.hide();
                $selectCustomFontNavigationUrl.hide();
                $selectCustomFontNavigationName.hide();
            } else if( selected == 'google' ) {
                $selectFontNavigation.show();
                $selectCustomFontNavigationUrl.hide();
                $selectCustomFontNavigationName.hide();
            } else {
                $selectFontNavigation.hide();
                $selectCustomFontNavigationUrl.show();
                $selectCustomFontNavigationName.show();
            }
        }


        $selectFontTypeBody.change(set_font_type);
        $selectFontTypeHeadings.change(set_font_type);
        $selectFontTypeNavigation.change(set_font_type);

    }

    function instagramWidgetDependencies() {

        function setDependencies() {

            $('select.instagram-source').each(function(){
                var $instagramWidget = $(this).closest('.widget-content'),
                    $selectInstagramSource = $(this);
                    $inputInstagramCarousel = $instagramWidget.find('input.instagram-carousel'),
                    $hoverColor = $instagramWidget.find('.instagram-hover-color span');
                //source of media
                var selected = $selectInstagramSource.find('option:selected').val();
                if( selected == 'self' ) {
                    $selectInstagramSource.closest('p').siblings('p.instagram-otheruser').slideUp('fast');
                } else {
                    $selectInstagramSource.closest('p').siblings('p.instagram-otheruser').slideDown('fast');
                }

                // caousel
                if( $inputInstagramCarousel.prop('checked') == false ) {
                    $inputInstagramCarousel.closest('p').siblings('p.instagram-nav-style').slideUp('fast');
                } else {
                    $inputInstagramCarousel.closest('p').siblings('p.instagram-nav-style').slideDown('fast');
                }

                // hover color
                if( $hoverColor.filter('.selected').data("name") == "custom" ) {
                    $hoverColor.closest('.instagram-hover-color').siblings('.instagram-custom-hover-color').slideDown('fast');
                } else {
                    $hoverColor.closest('.instagram-hover-color').siblings('.instagram-custom-hover-color').slideUp('fast');
                }
            })

        }

        setDependencies();

        $(document).on( 'change', 'select.instagram-source, input.instagram-carousel', setDependencies);
        $(document).on( 'click', '.instagram-hover-color span', setDependencies);
    }     


    function productDetailDependencies() {
        var $productDetail = $('.imageSelect.product-detail'),
            $productDetailBg = $('.section.section-product-detail-bg');
            $productDetailSidebarPosition = $('.section.section-product-detail-sidebar');
            $shopEnableZoom = $('.section.section-shop_enable_zoom');


        $productDetail.find('a').on('click',function(){
            productDetailChangeHandler($(this));
        });

        productDetailChangeHandler($productDetail.find('a.selected'));

        function productDetailChangeHandler($element) {

            if( $element.hasClass('pd_background') ) {
                $productDetailBg.add($productDetailBg.next('hr')).slideDown();
                $productDetailSidebarPosition.add($productDetailSidebarPosition.next('hr')).slideUp();
                $shopEnableZoom.add($shopEnableZoom.next('hr')).slideDown();
            } else if( $element.hasClass('pd_top') ) {
                $productDetailBg.add($productDetailBg.next('hr')).slideDown();
                $productDetailSidebarPosition.add($productDetailSidebarPosition.next('hr')).slideUp();
                $shopEnableZoom.add($shopEnableZoom.next('hr')).slideUp();
            } else if( $element.hasClass('pd_fullwidth_top') ) {
                $productDetailBg.add($productDetailBg.next('hr')).slideDown();
                $productDetailSidebarPosition.add($productDetailSidebarPosition.next('hr')).slideUp();
                $shopEnableZoom.add($shopEnableZoom.next('hr')).slideUp();
            } else if( $element.hasClass('pd_classic_sidebar') ) {
                $productDetailBg.add($productDetailBg.next('hr')).slideUp();
                $productDetailSidebarPosition.add($productDetailSidebarPosition.next('hr')).slideDown();
                $shopEnableZoom.add($shopEnableZoom.next('hr')).slideDown();
            } else {
                $productDetailBg.add($productDetailBg.next('hr')).slideUp();
                $productDetailSidebarPosition.add($productDetailSidebarPosition.next('hr')).slideUp();
                $shopEnableZoom.add($shopEnableZoom.next('hr')).slideDown();
            }
        }
    }

    function productStyleDependencies() {
        var $productStyle = $('.imageSelect.shop-styles'),
            $productHoverColor = $('.imageSelect.product_hover_preset'),
            $productCustomHoverColor = $('.product_hover_custom_preset');
            $productRating = $('.product_rating');

        $productStyle.find('a').on('click',function(){
            productStyleChangeHandler($(this));
        });

        $productHoverColor.find('a').on('click',function(){
            productHoverColorHandler($(this));
        });

        productStyleChangeHandler($productStyle.find('a.selected'));
        productHoverColorHandler($productHoverColor.find('a.selected'));

        function productStyleChangeHandler( $element ) {

            if( $element.hasClass('infoonhover') ) {
                $productHoverColor.slideDown();
                $productRating.slideDown();
            } else if ( $element.hasClass('infoonclick') ) {
                $productRating.slideUp();
            } else {
                $productRating.slideDown();
                $productHoverColor.slideUp();
            }
        }


        function productHoverColorHandler($element) {
            if( $element.hasClass('_custom-color') && $productStyle.find('a.selected').hasClass('infoonhover') ) {
                $productCustomHoverColor.slideDown();
            } else {
                $productCustomHoverColor.slideUp();
            }
        }
    }

    function uploadWcCatHeaderImg() {
        // Only show the "remove image" button when needed
        if ( '0' === $( '#header_image_id' ).val() ) {
        	$( '.remove_wc_cat_header_image_button' ).hide();
        }

        // Uploading files
        var file_frame;

        $( document ).on( 'click', '.upload_wc_cat_header_image_button', function( event ) {

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.downloadable_file = wp.media({
                title: 'Choose an image',
                button: {
                    text: 'Use image'
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
                var attachmentThumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                $( '#header-background-image' ).val( attachment.id );
                $( '#product_cat_background_image' ).find( 'img' ).attr( 'src', attachmentThumbnail.url );
                $( '.remove_wc_cat_header_image_button' ).show();
            });

            // Finally, open the modal.
            file_frame.open();
        });

        $( document ).on( 'click', '.remove_wc_cat_header_image_button', function() {
            $( '#product_cat_background_image' ).find( 'img' ).attr( 'src', $( '#product_cat_background_image' ).data('default-img') );
            $( '#header-background-image' ).val( '' );
            $( '.remove_wc_cat_header_image_button' ).hide();
            return false;
        });

        $( document ).ajaxComplete( function( event, request, options ) {
            if ( request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {
                // Clear header image and color fields on submit
                $( '#product_cat_background_image' ).find( 'img' ).attr( 'src', $( '#product_cat_background_image' ).data('default-img') );
                $( '.term-header-color-wrap .wp-picker-clear,.all_taxonamies_color .wp-picker-clear' ).trigger('click');
                $('.selected-icon').attr('class', 'selected-icon icon');
            }
        });

	}
    function reduxDependency () {
        var $headerType = $('fieldset#' + optionsKey +  '-header-type label.redux-image-select-selected input');
        var $headerStyle = $('fieldset#' + optionsKey +  '-header-style label.redux-image-select-selected input');
        var $menuHoverStyle = $('fieldset#' + optionsKey +  '-menu-hover-style label.redux-image-select-selected input');
        var $menuBackgroundColor = $('fieldset#' + optionsKey +  '-menu-background-color');
        var $menuBackgroundColorSection = $('#section-menu-color_section_start');
        var $menuTextColor = $('fieldset#' + optionsKey +  '-menu-text-color');
        var $menuTextHoverColor = $('fieldset#' + optionsKey +  '-menu-text-hover-color');
        var $menuTextBgHoverColor = $('fieldset#' + optionsKey +  '-menu-text-bg-hover-color');
        var $menuBorderColor = $('fieldset#' + optionsKey +  '-menu-border-color');
        if ($headerType.val() == 7 || $headerType.val() == 8) {
            $menuBackgroundColor.parents('tr').css('display', 'table-row');
            $menuTextColor.parents('tr').css('display', 'table-row');
            $menuTextHoverColor.parents('tr').css('display', 'none');
            $menuTextBgHoverColor.parents('tr').css('display', 'none');
            $menuBorderColor.parents('tr').css('display', 'none');
        } else {
            if ($headerStyle.val() == 'kite-menu') {
                $menuBackgroundColor.parents('tr').css('display', 'table-row');
                $menuBackgroundColorSection.css('display', 'block');
                $menuTextColor.parents('tr').css('display', 'table-row');
                $menuBorderColor.parents('tr').css('display', 'table-row');
                if ($menuHoverStyle.val() == 2 ) {
                    $menuTextHoverColor.parents('tr').css('display', 'table-row');
                    $menuTextBgHoverColor.parents('tr').css('display', 'none');
                } else if ($menuHoverStyle.val() != 3) {
                    $menuTextHoverColor.parents('tr').css('display', 'table-row');
                    $menuTextBgHoverColor.parents('tr').css('display', 'table-row');
                } else {
                    $menuTextHoverColor.parents('tr').css('display', 'none');
                    $menuTextBgHoverColor.parents('tr').css('display', 'none');
                }
            } else {
                $menuBackgroundColor.parents('tr').css('display', 'none');
                $menuBackgroundColorSection.css('display', 'none');
                $menuTextColor.parents('tr').css('display', 'none');
                $menuTextHoverColor.parents('tr').css('display', 'none');
                $menuTextBgHoverColor.parents('tr').css('display', 'none');
                $menuBorderColor.parents('tr').css('display', 'none');
            }
        }
    }
    function activationClick() {
        $('.purchase_info').on('click' ,function(e) {
            if (!$(this).hasClass('selected')) {
                $('.purchase_info').each(function(){
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                });
                $(this).addClass('selected');
                var purchaseCode = $(this).data('purchase_code');
                $('input[name="purchase_code"]').val(purchaseCode);
                var supportedUntil = $(this).data('supported_until');
                $('input[name="supported_until"]').val(supportedUntil);
            }
        });
        $('.deactive').on('click', function(event) {
            event.preventDefault();
            if (confirm('Are You Sure you Want to deactive this purchase info?')) {
                $(this).parents('form').submit();
            }
        });
    }
    function product360ViewGallery() {

        // Product gallery file uploads.
        var $productGalleryFrame,
        $imageGalleryIDs = $( '#product_360_image_gallery' ),
        $productImages    = $( '#product_360_images_container' ).find( 'ul.product_360_images' );

        $( '.add_product_360_images' ).on( 'click', 'a', function( event ) {
            var $el = $( this );

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( $productGalleryFrame ) {
                $productGalleryFrame.open();
                return;
            }

            // Create the media frame.
            $productGalleryFrame = wp.media.frames.product_gallery = wp.media({
                // Set the title of the modal.
                title: $el.data( 'choose' ),
                button: {
                    text: $el.data( 'update' )
                },
                states: [
                    new wp.media.controller.Library({
                        title: $el.data( 'choose' ),
                        filterable: 'all',
                        multiple: true
                    })
                ]
            });

            // When an image is selected, run a callback.
            $productGalleryFrame.on( 'select', function() {
                var selection = $productGalleryFrame.state().get( 'selection' );
                var $attachmentIDs = $imageGalleryIDs.val();

                selection.map( function( attachment ) {
                    attachment = attachment.toJSON();

                    if ( attachment.id ) {
                        $attachmentIDs   = $attachmentIDs ? $attachmentIDs + ',' + attachment.id : attachment.id;
                        var attachmentImage = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                        $productImages.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachmentImage + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
                    }
                });

                $imageGalleryIDs.val( $attachmentIDs );
            });

            // Finally, open the modal.
            $productGalleryFrame.open();
        });

        // Image ordering.
        if ( typeof $productImages.sortable !== 'undefined' ) {
            $productImages.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start: function( event, ui ) {
                    ui.item.css( 'background-color', '#f6f6f6' );
                },
                stop: function( event, ui ) {
                    ui.item.removeAttr( 'style' );
                },
                update: function() {
                    var $attachmentIDs = '';

                    $( '#product_360_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
                        var attachmentID = $( this ).attr( 'data-attachment_id' );
                        $attachmentIDs = $attachmentIDs + attachmentID + ',';
                    });

                    $imageGalleryIDs.val( $attachmentIDs );
                }
            });
        }

        // Remove images.
        $( '#product_360_images_container' ).on( 'click', 'a.delete', function() {
            $( this ).closest( 'li.image' ).remove();

            var $attachmentIDs = '';

            $( '#product_360_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
                var attachmentID = $( this ).attr( 'data-attachment_id' );
                $attachmentIDs = $attachmentIDs + attachmentID + ',';
            });

            $imageGalleryIDs.val( $attachmentIDs );

            // Remove any lingering tooltips.
            $( '#tiptip_holder' ).removeAttr( 'style' );
            $( '#tiptip_arrow' ).removeAttr( 'style' );

            return false;
        });
    }
    function initialStock(){
        if ( $('#inventory_product_data').length ) {
            $(document).on('click', function() {
                stockCheck();
            });
        }
        var stockCheck = function (){
            if ( $('#_manage_stock').is(':checked') ) {
                $('#kt_total_stock_quantity').parents('.options_group').show();
            } else {
                $('#kt_total_stock_quantity').parents('.options_group').hide();
            }
        };
        stockCheck();
    }
    // start proccessing plugins
    function startProccessingPlugins() {
        $(document).on( 'click', '.kt-install-plugins, .kt-install-core-plugins', function( e ){
            e.preventDefault();

            if ( $('li.plugin-to-install input:checked').length == 0 ) {
                alert( kite_theme_admin_vars.select_plugins );
                return;
            }
            $(this).addClass('kt-checking');

            $('li.plugin-to-install input:checked').siblings('.spinner').css('visibility', 'visible');

            findNext();

        });

        var itemsCompleted = 0;
        var currentItem = '';
        var $currentNode;
        var currentItemHash = '';

        function ajax_callback(response){
            if(typeof response == 'object' && typeof response.message != 'undefined'){
                $currentNode.find('span').text(response.message);
                $('.kt-install-core-plugins').text(response.message);
                if( typeof response.url != 'undefined' ) {
                    // we have an ajax url action to perform.
                    if( response.hash == currentItemHash ) {
                        $currentNode.find('span').text("failed");
                        findNext();
                    } else {
                        currentItemHash = response.hash;
                        jQuery.post(response.url, response, function(response2) {
                            processCurrent();
                            $currentNode.find('span').text(response.message);
                        }).fail(ajax_callback);
                    }

                } else if ( typeof response.done != 'undefined' ) {
                    // finished processing this plugin, move onto next
                    $currentNode.find('span').addClass('kt-success');
                    findNext();
                } else {
                    // error processing this plugin
                    findNext();
                }
            } else {
                // error - try again with next plugin
                $currentNode.find('span').addClass('kt-success').text("Success");
                findNext();
            }
        }
        function processCurrent(){
            if( currentItem ){
                // query our ajax handler to get the ajax to send to TGM
                // if we don't get a reply we can assume everything worked and continue onto the next one.
                $.post(kite_theme_admin_vars.ajax_url, {
                    action: 'install_plugins',
                    wpnonce: kite_theme_admin_vars.wpnonce,
                    slug: currentItem
                }, ajax_callback).fail(ajax_callback);
            }
        }
        function findNext(){
            var doNext = false;
            if( $currentNode ){
                if( !$currentNode.data('done_item') ) {
                    itemsCompleted++;
                    $currentNode.data('done_item',1);
                }
                $currentNode.find('.spinner').css('visibility','hidden');
            }
            var $li = $('.kt-plugins-form li').has('input:checked').addClass('installing');
            $('.kt-plugins-form li').find('input').prop('disabled', true);
            $li.each(function(){
                if( currentItem == '' || doNext ){
                    currentItem = $(this).find('input').data('slug');
                    $currentNode = $(this);
                    processCurrent();
                    doNext = false;
                } else if ( $(this).data('slug') == currentItem ) {
                    doNext = true;
                }
            });
            if( itemsCompleted >= $li.length ){
                // finished all plugins!
                var failed = false;
                $('.kt-plugins-form li span').each(function(index, el) {
                    if ($(this).text() == 'failed') {
                        failed = true;
                    }
                });
                if ( failed ) {
                    $('.kt-install-plugins, .kt-install-core-plugins').removeClass('kt-checking');
                    document.cookie = 'pluginFailed=true';
                    window.location.reload(true);
                } else {
                    document.cookie = 'pluginFailed=;';
                    $li.removeClass('installing');
                    $('.kt-install-plugins, .kt-install-core-plugins').removeClass('kt-checking');
                    if ( $('.kt-plugins-form').data('redirect') != '' ) {
                        window.location.replace( $('.kt-plugins-form').data('redirect') );
                    }
                }
            }
        }
    }

    function instagramWidgetDependencyCheck() {

        var instaDependencyCheckInit = function( $this ) {
            if ( $this.find('.instagram-connection-method').is(':checked') ) {
                $this.find('.insta-username, .insta-image-resolution, .insta-like, .insta-comment').parents('p').hide();
            } else {
                $this.find('.insta-username, .insta-image-resolution, .insta-like, .insta-comment').parents('p').show();
            }
        }

        instaDependencyCheckInit( $(document) );

        $('.instagram-connection-method').on( 'change', function(){
            instaDependencyCheckInit( $(this).parents('.widget-content') );
        });
    }

    function adminAjaxRequests() {
        $('.notice-dismiss').on( 'click', function(){
            var days = $(this).parents('.is-dismissible').data('dismissible-time');
            $.ajax({
                url: ajaxurl,
                data: {
                    'action': 'dismiss_plugins_install_notices',
                    'dismiss_time': days,
                },
                success: function (response) {
                    alert( kite_theme_admin_vars.dismiss_plugin_installation)
                }
            });
        });
    }
    $(document).ready(function () {

        FieldSelector();
        CSVInput();
        imageSelect();
        saveButton();
        thickBox();
        tooltips();
        rangeField();
        colorPicker();
        Combobox();
        Chosen();
        tabs();
        sidebarAccordion();
        imageFields();
        menu();
        iconSelect();
        demoImporter();
        preloader();
        productDetailDependencies();
        productStyleDependencies();
        filterWidgetChangeDisplayType();
        instagramWidgetDependencies();
        fontDependencies();
        videoWidgetChangeDisplayType();
        uploadWcCatHeaderImg();
        reduxDependency();
        activationClick();
        product360ViewGallery();
        startProccessingPlugins();
        adminAjaxRequests();
        setTimeout(function(){
            setRowTypeIcon();
        },800);
        menuDependencies();
        initialStock();
        instagramWidgetDependencyCheck();

        $('#vc_ui-panel-edit-element span.vc_ui-button-action').on('click',function(){
            setTimeout(function(){
                setRowTypeIcon();
            },200);
        });
        $(document).on('click', 'input[name="' + optionsKey +  '[header-type]"],input[name="' + optionsKey +  '[header-style]"]', function() {
            reduxDependency();
        });

    });

    $(window).on('load', function(){
        adminAjaxRequests();
    });
})(jQuery);
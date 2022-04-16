jQuery(document).ready(function($) {
	if ($('.customizer_icon_picker').length > 0) {
        $('.customizer_icon_picker').fontIconPicker({
        	iconsPerPage : 15,
        });
    }
    $('.redux-container').css('overflow', 'scroll');
});
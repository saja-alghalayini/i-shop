(function( $ ) {
	'use strict';

	$('.instagram_disconnector').on( 'click', function(e){
        e.preventDefault();
        var $this = $(this);
        if ( $this.hasClass('disable') ) return;
        var _nonce = $this.data('nonce');

        $.ajax({
            type: "post",
            url: kite_theme_admin_vars .ajax_url,
            data: {
                'action': 'kite_instagram_api_disconnect',
                'nonce': _nonce
            },
            dataType: "json",
            success: function (response) {
                if ( response.success ) {
                    $this.addClass('disable');
                    $('.instagram_connector').removeClass('disable');
                }
            }
        });
    });

    $('.disable').on('click', function(e){
        e.preventDefault();
    });

})( jQuery );

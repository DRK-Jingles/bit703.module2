// semi-colon is a safety net against unclosed scripts 
;(function($, window, document, undefined){
    "use strict";

	$(document).ready(function(){

    });

    /*
     * $(window).on('load') only fires after all 
     * images, fonts and elements are in place, 
     * so there will be no FOUC
     */
	$(window).on('load', function () {
        $('.grid').masonry({
            itemSelector: '.grid-item'
        });

        $('.spinner').fadeOut();
        $('.loader').delay(600).fadeOut('slow');
        $('body').delay(600).css({
            'overflow': 'visible'
        });

        $('.grid-item').click(function(){
            var close = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $('#image-modal .modal-body').html($(this).html()).append(close);
            $('#image-modal').modal().show();
        });
	});
    
})(jQuery, window , document);
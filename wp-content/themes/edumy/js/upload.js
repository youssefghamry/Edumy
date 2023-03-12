jQuery(document).ready(function($){
	"use strict";
	var edumy_upload;
	var edumy_selector;

	function edumy_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		edumy_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( edumy_upload ) {
			edumy_upload.open();
			return;
		} else {
			// Create the media frame.
			edumy_upload = wp.media.frames.edumy_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			edumy_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = edumy_upload.state().get('selection').first();

				edumy_upload.close();
				edumy_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					edumy_selector.find('.edumy_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		edumy_upload.open();
	}

	function edumy_remove_file(selector) {
		selector.find('.edumy_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.edumy_upload_image_action .remove-image', function(event) {
		edumy_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.edumy_upload_image_action .add-image', function(event) {
		edumy_add_file(event, $(this).parent().parent());
	});



	function edumy_get_flaticon_icons() {
        var files = document.querySelectorAll('*[id^="edumy-flaticon"]'), html = '', css;
        
        if( !files || files.length === 0 )
            return '';
        
        var icons_load_call = '';
            
        for( var i=0; i < files.length; i++ ){
            css = Array.prototype.map.call( files[i].sheet.cssRules, edumy_css_text ).join('\n');
            css = css.split('::before');
            css.forEach(function( i ){
                i = i.split('.')[1];
                if( i !== undefined && i.indexOf('/') == -1 ) {
                    var class_name = i.replace(/[^a-z-0-9]/g, "");
                    if ( class_name !== '' ) {
                        icons_load_call += "'" + class_name + "' => '" + class_name + "', ";
                    }
                }
            });
        }
        
        console.log(icons_load_call);
    }
    function edumy_css_text(x) {
            return x.cssText;
        }
    edumy_get_flaticon_icons();

});
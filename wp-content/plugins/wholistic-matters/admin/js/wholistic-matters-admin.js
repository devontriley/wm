(function( $ ) {
	'use strict';

	var $body = $('body');

	if(($body.hasClass('post-type-post') && $body.hasClass('post-new-php')) /*|| $body.hasClass('post-php')*/)
	{
		var $post_format = $('input.post-format'),
			post_format = $('input[name="post_format"]:checked').val();

		$('#wm-post-metabox-video, #wm-post-metabox-link, #wm-post-metabox-audio, #seriesdiv').show();

		if(post_format == 0){
			$('#wm-post-metabox-video, #wm-post-metabox-link, #wm-post-metabox-audio, #seriesdiv').hide();
		} else if(post_format == 'link'){
			$('#wm-post-metabox-video, #wm-post-metabox-audio, #seriesdiv').hide();
		} else if(post_format == 'video'){
			$('#wm-post-metabox-link, #wm-post-metabox-audio, #seriesdiv').hide();
		} else if(post_format == 'audio'){
			$('#wm-post-metabox-video, #wm-post-metabox-link').hide();
		}
		
		$post_format.on('click', function()
		{
			var sel_post_format = $(this).val();

			$('#wm-post-metabox-video, #wm-post-metabox-link, #wm-post-metabox-audio, #seriesdiv').hide();

			if(sel_post_format == 0){
			} else if(sel_post_format == 'link'){
				$('#wm-post-metabox-link').show();
			} else if(sel_post_format == 'video'){
				$('#wm-post-metabox-video').show();
			} else if(sel_post_format == 'audio'){
				$('#wm-post-metabox-audio, #seriesdiv').show();
			}
		});
	}

})( jQuery );

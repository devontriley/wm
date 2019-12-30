(function ($, wp) {
	'use strict';

    function wm_bookmark_stripslashes (str) {
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Ates Goral (http://magnetiq.com)
        // +      fixed by: Mick@el
        // +   improved by: marrtins
        // +   bugfixed by: Onno Marsman
        // +   improved by: rezna
        // +   input by: Rick Waldron
        // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
        // +   input by: Brant Messenger (http://www.brantmessenger.com/)
        // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
        // *     example 1: stripslashes('Kevin\'s code');
        // *     returns 1: "Kevin's code"
        // *     example 2: stripslashes('Kevin\\\'s code');
        // *     returns 2: "Kevin\'s code"
        return (str + '').replace(/\\(.?)/g, function (s, n1) {
            switch (n1) {
                case '\\':
                    return '\\';
                case '0':
                    return '\u0000';
                case '':
                    return '';
                default:
                    return n1;
            }
        });
    }
	$.fn.bindWithDelay = function( type, data, fn, timeout, throttle ) {

		if ( $.isFunction( data ) ) {
			throttle = timeout;
			timeout = fn;
			fn = data;
			data = undefined;
		}

		// Allow delayed function to be removed with fn in unbind function
		fn.guid = fn.guid || ($.guid && $.guid++);

		// Bind each separately so that each element has its own delay
		return this.each(function() {

			var wait = null;

			function cb() {
				var e = $.extend(true, { }, arguments[0]);
				var ctx = this;
				var throttler = function() {
					wait = null;
					fn.apply(ctx, [e]);
				};

				if (!throttle) { clearTimeout(wait); wait = null; }
				if (!wait) { wait = setTimeout(throttler, timeout); }
			}

			cb.guid = fn.guid;

			$(this).bind(type, data, cb);
		});
	};
	
	// link: https://stackoverflow.com/questions/22581345/click-button-copy-to-clipboard-using-jquery
	var wm_copyToClipboard = function(textContent) {
  // create hidden text element, if it doesn't already exist
		var targetId = "_hiddenCopyText_";
		// must use a temporary form element for the selection and copy
		target = document.getElementById(targetId);
		if (!target) {
			var target = document.createElement("textarea");
			target.style.position = "fixed";
			target.style.left = "-9999px";
			target.style.top = "0";
			target.id = targetId;
			document.body.appendChild(target);
		}
		target.textContent = textContent;

		//commenting focus ... causes page jumping issue
		var currentFocus = document.activeElement;
		target.focus();

		// select the content
		target.setSelectionRange(0, target.value.length);

		// copy the selection
		var succeed;
		try {
			  succeed = document.execCommand("copy");
		} catch(e) {
			succeed = false;
		}
		// restore original focus
		if (currentFocus && typeof currentFocus.focus === "function") {
			currentFocus.focus();
		}
		//document.getElementById('btnCopyWidhlist').focus();
		// clear temporary content
		target.textContent = "";
		return succeed;
	}


	$(document).ready(function () {

		var wm_timeoutHandler = null;
		
		$('[data-toggle="popover"]').each(function(){
			var $self = $(this),
				target = $self.data('target');
				$self.popover({
					content: $(target),
					html : true
				});
		}); 
	
		$('.js_char_count').each(function(){
			var $self = $(this),
				$target = $($self.attr('data-char-count-field'));
			$target.attr('maxlength', wm_bookmark.folder_max_char);
			$self.text(wm_bookmark.folder_max_char);
			$target.on('keyup', function() {
				$self.text(wm_bookmark.folder_max_char - this.value.length);
			});
		});
		
		$('body').on('click','.js_wm_copy_link', function (event) {
			event.preventDefault();
			if(wm_copyToClipboard($(this).attr('href'))){
				var $toast = '<h4>Link Copied!</h4>';
				if($('.js_wm_toasts').length){
					$('.js_wm_toasts').html($toast);
					$("body").addClass('open-toast');
					if (wm_timeoutHandler) clearTimeout(wm_timeoutHandler);
					wm_timeoutHandler = setInterval(function () {
						$("body").removeClass('open-toast');
					}, 2000);
				}else{
					alert('Link Copied!');
				}
			}
		});
		$('.wm_to_bookmark_popup').on('click','.wm_close', function (event) {
			event.preventDefault();
			var $self = $(this),
				$popup = $self.closest('.wm_to_bookmark_popup');
			
			if( $popup.hasClass('is-adding-folder') && $self.attr('data-target') && $self.attr('data-target').trim() != '' ){
				$popup.find( $self.attr('data-target') ).click();
			}else{
				$popup.removeClass('opened');
				//$popup.hide();
			}
		});
		
		$('.wm_to_bookmark_popup').on('click', function (e) {
			if (e.target !== this)
				return;
			var $self = $(this),
				$popup = $self.hasClass('opened') ? $self : $self.closest('.wm_to_bookmark_popup');

			if( $popup.hasClass('is-adding-folder') ){
				$popup.find( '.wm_create_folder_toggle' ).click();
			}else{
				$popup.removeClass('opened');
				//$popup.hide();
			}
		});
		$('body').on('click','.js_wm_toggle', function (event) {
			event.preventDefault();
			var $self = $(this),
				$target = $($self.attr('href'));
			$self.toggleClass('toggled');
			$target.toggle();
			
			if($self.hasClass('wm_a2b_popup')){
				var $popup = $('.wm_to_bookmark_popup');
				if($popup.length){
					$popup.toggleClass('is-adding-folder');
					var $close = $popup.find('.wm_close');
					if($close.attr('data-target').trim() == ''){
						$close.attr('data-target','.wm_create_folder_toggle');
					}else{
						$close.attr('data-target', '');
					}
					var $title = $popup.find('.wm_a2b_popup_title'),
						swap_title = $title.attr('data-swap_value'),
						current_title = $title.text();
					$title.attr('data-swap_value', current_title).text(swap_title);
				}
			}
			return false;
		});
		
		$('body').on('click','.js_wm_clone', function (event) {
                    event.preventDefault();
                    var $self = $(this),
                    cloneTemplate = wp.template($self.attr('data-tmpl')),
                    cloneData = $.parseJSON($self.attr('data-tmpl-data')) || {},
                    maxClones = parseInt($self.attr('data-max')) || 5,
                    currClones = parseInt($self.attr('data-clones')) || 0;
                    if(currClones >= maxClones){
                        $self.hide();
                        return;
                    }
                    $( cloneTemplate(cloneData) ).insertBefore(this); currClones++;
                    $self.attr('data-clones', currClones);
                });
                
		$('body').on('click','.js_wm_trigger', function (event) {
			event.preventDefault();
			var $self = $(this),
			$target = $($self.attr('href')),
			triggerEv = $self.attr('data-trigger');
			$target.trigger(triggerEv);

			var $resp_msg = $('.js_create_folder_msg');
			if($self.hasClass('wm_create_folder_cancel') && $resp_msg.length && $resp_msg.hasClass('error')){
				$resp_msg.removeClass('error').html('');
			}
			if($self.hasClass('wm_account_email_cancel')){
				var default_email = $self.data('default_email');
				if($('#email_readonly').length){
					$('#email_readonly').val(default_email);
					$('#email_new').val('').blur();
					$('#email_new2').val('').blur();
				}
			}
			if($self.hasClass('wm_account_password_cancel')){
				if($('#password_readonly').length){
					$('#password_readonly').val('');
					$('#password1').val('').blur();
					$('#password2').val('').blur();
				}
			}
			return false;
		});

		var ajaxurl = wm_bookmark.ajaxurl;
		
		var wm_load_my_bookmarks = function( $outputEl, search ){
			var folder_template = wp.template('wm-accordion-folder'),
				item_template = wp.template('wm-bookmark'),
				search = search || '';
			if($outputEl.hasClass('wm_a2b_popup')){
				var $popup = $outputEl.closest('.wm_to_bookmark_popup'),
					current_post_id = $popup.attr('data-object_id');
				folder_template = wp.template('wm-folder-popup');
			}
			var data = {
				'action'   : 'wm_load_my_bookmarks',
				'security' : wm_bookmark.nonce,
				'search'   : search,
			};
			var $ajaxLoader = $outputEl.parent().find('.cbxwpbkmarkloading');
			$ajaxLoader.show();
			$.post(ajaxurl, data, function (response) {
				response = $.parseJSON(response);
				if (response.code == 1) {
					var folder_data = response.data;
					var accordionCardsHtml = '';
					for(var i = 0; i < folder_data.length; i++){
						if( !$outputEl.hasClass('wm_a2b_popup') ){
							var bookmarks_items = folder_data[i].bookmark_items;
							var bookmarksHtml = '';
							if(bookmarks_items.length > 0){
								for(var j = 0; j < bookmarks_items.length; j++){
									bookmarksHtml += item_template(bookmarks_items[j]);
								}
							}else{
								//no bookmarks found
								bookmarksHtml += '<span class="wm_bookmark_not_found">'+wm_bookmark.bookmark_not_found+'</span>';
							}
							folder_data[i].bookmarks = bookmarksHtml;
							folder_data[i].is_collapsed = true;
							if(i===0){
								folder_data[i].is_collapsed = false;
							}
						}else{
							var bookmarks_items = folder_data[i].bookmark_items;
							folder_data[i].bookmark_in_folder = false;
							if(bookmarks_items.length > 0){
								for(var j = 0; j < bookmarks_items.length; j++){
									if(bookmarks_items[j].object_id == current_post_id){
										folder_data[i].bookmark_in_folder = true;
										break;
									}
								}
							}
						}
						folder_data[i].default_folder_id = wm_bookmark.default_folder_id;
						accordionCardsHtml += folder_template(folder_data[i]);
					}
					$outputEl.html(accordionCardsHtml);
				} else {
					if(response.code == 0){
						$outputEl.html('<h4 class="wm_bookmark_not_found">'+wm_bookmark.folder_not_found+'</h4>');
					}else{
						$outputEl.html('<h4 class="wm_bookmark_not_found">'+wm_bookmark.guest_warning+'</h4>');
					}
				}
				$ajaxLoader.hide();
				if( $outputEl.hasClass('wm-a2b-account') && window.location.hash != ''){
					// Remove the # from the hash, as different browsers may or may not include it
					var hash = window.location.hash.replace('#','');
					if(hash != ''){
					   // Clear the hash in the URL
					   // location.hash = '';   // delete front "//" if you want to change the address bar
						$('html, body').animate(
							{ scrollTop: $('#' + hash).offset().top - 60 }, 300, 
							function(){
								if($('#' + hash + '[aria-expanded="false"]')){
									$('#' + hash + '[aria-expanded="false"]').click();
								}
							});
					}
			   }
			});
		}; 
		if( $('.js_wm_my_bookmarks').length && ($('.js_wm_my_bookmarks').hasClass('wm-a2b-account') || $('.js_wm_my_bookmarks').hasClass('opened')) ){
			wm_load_my_bookmarks( $('.js_wm_my_bookmarks') );
		}
		
		$('.js_search_folder').bindWithDelay("keyup", function () {
			var $self = $(this);
//			if( $('.js_wm_my_bookmarks').length && $self.val().length > 2 ){
			if( $('.js_wm_my_bookmarks').length ){
				wm_load_my_bookmarks( $('.js_wm_my_bookmarks'), $self.val().trim() );
			}
		}, 750, true);
		
		
		//on click create category button
		$('.js_wm_create_folder').on('click', function (event) {
			event.preventDefault();
			var $this 			= $(this),
				$addnewwrap 	= $('.wm_create_folder'),
				$folder_name 	= $addnewwrap.find('#wm_folder_name'),
				$resp_msg		= $('.js_create_folder_msg');

			if ((wm_bookmark.max_cat_limit > 0) && (wm_bookmark.user_current_cat_count >= wm_bookmark.max_cat_limit)) {
				$addnewwrap.find('.wm_create_folder_cancel').trigger('click');
				$resp_msg.addClass('error').html(wm_bookmark.max_cat_limit_error);
				return;
			}

			$resp_msg.removeClass('error').html('');
			//check if the input text field is empty or not
			//if the text input for category name validate then send ajax request
			if ($folder_name.val() != '') {
				$addnewwrap.find('.cbxwpbkmarkloading').show();
				//send ajax request
				var data = {
					'action'   : 'wm_add_folder',
					'security' : wm_bookmark.nonce,
					'cat_name' : $folder_name.val()
				};

				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				$.post(ajaxurl, data, function (response) {
					response = $.parseJSON(response);
					if (response.code == 1) {
						//category created
						$folder_name.val('').blur().trigger('change');
						var folders_count = $.parseJSON(response.folders_count);
						wm_bookmark.user_current_cat_count = folders_count;
						
						$addnewwrap.find('.cbxwpbkmarkloading').hide();

						//show success message
						$resp_msg.html(response.msg);
						
						$addnewwrap.find('.wm_create_folder_cancel').trigger('click');
						if( $('.js_wm_my_bookmarks').length ){
							wm_load_my_bookmarks( $('.js_wm_my_bookmarks') );
						}
					}
					else {
						//failed or duplicate
						$addnewwrap.find('.cbxwpbkmarkloading').hide();
						$resp_msg.addClass('error').html(response.msg);
					}
					if (wm_timeoutHandler) clearTimeout(wm_timeoutHandler);
					wm_timeoutHandler = setInterval(function () {
						$resp_msg.removeClass('error').html('');
					}, 2000);
				});
			}else {
				$resp_msg.addClass('error').html(wm_bookmark.category_name_empty);
				if (wm_timeoutHandler) clearTimeout(wm_timeoutHandler);
				wm_timeoutHandler = setInterval(function () {
					$resp_msg.removeClass('error').html('');
				}, 2000);
			}

		});
		
		$('.js_wm_my_bookmarks').on('click','a.js_wm_add_bookmark', function (event) {
			event.preventDefault();
			var $this 			= $(this);
			if ($this.hasClass('bookmarked')) {
				//already bookmarked .. remove bookmark
				if (!confirm(wm_bookmark.areyousuretodeletebookmark)) {
					return false;
				}
				var $postdelete = $this;
				$postdelete.removeClass('bookmarked');
				var $my_bookmarks = $postdelete.closest('.wm_my_bookmarks');
				var $folder_id 		= $postdelete.data("folder_id");
				var $object_id 		= $postdelete.data("object_id");
				var $object_type 		= $postdelete.data("object_type");
				var $bookmark_id 	= $postdelete.data("bookmark_id");
				var $target_bookmark 	= $my_bookmarks.find("#my_bookmark_" + $bookmark_id);
				var $wrapper = $target_bookmark.parent();
				var $folder = $my_bookmarks.find('#wm_folder_' + $folder_id);
				var $ajaxLoader = $my_bookmarks.find('.cbxwpbkmarkloading');
				$ajaxLoader.show();

				var data = {
					'action'  : 'wm_delete_bookmark_post',
					'security': wm_bookmark.nonce,
					'folder_id'  : $folder_id,
					'object_id'  : $object_id,
					'bookmark_id'  : $bookmark_id,
					'object_type'  : $object_type,
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations

				if ($postdelete) {
					$.post(ajaxurl, data, function (response) {
						response = $.parseJSON(response);
						$ajaxLoader.hide();
						if (response.msg == 0) {
							// Remove the el if the bookmark is deleted
							$target_bookmark.remove();
							//alert( wm_bookmark.bookmark_removed );
							var bookmarks_count = $wrapper.find('.wm_my_bookmark').length;
							$folder.find('.js_mybookmarks_count').text(bookmarks_count);
							if (bookmarks_count === 0) {
								$wrapper.append('<span class="wm_bookmark_not_found">'+wm_bookmark.bookmark_removed_empty+'</span>');
							}
						} else if (response.msg == 1) {
							alert( wm_bookmark.bookmark_removed_failed );
						}
					});
				}
			}else{
				//add bookmark
			}
		});
		
		$('body').on('click','.js_wm_popup_add_bookmark', function (event) {
			event.preventDefault();
			var $this 		= $(this),
				$popup		= $('.wm_to_bookmark_popup');
				
			var object_id 		= $('.wm_to_bookmark_popup').attr("data-object_id"),
				object_type 	= $('.wm_to_bookmark_popup').attr("data-object_type"),
				folder_id 		= $this.data("folder_id");
				
			var $my_bookmarks = $this.closest('.wm_my_bookmarks');
			var $folder = $my_bookmarks.find('#wm_folder_' + folder_id);
			var toast_template = wp.template('wm-toast');
			//now send ajax request to save this post id and category as bookmark for this user
			//post id already in variable $object_id

			var addbookmark = {
				'action'     : 'wm_add_bookmark',
				'security'   : wm_bookmark.nonce,
				'cat_id'     : parseInt(folder_id),
				'object_id'  : parseInt(object_id),
				'object_type': object_type
			};

			$.post(ajaxurl, addbookmark, function (response) {

				response = $.parseJSON(response);
				var $bookmark_count = parseInt(response.bookmark_count);
                var $bookmark_byuser 	= parseInt(response.bookmark_byuser);


				if($('.js_wm_my_bookmarks').length)
					wm_load_my_bookmarks( $('.js_wm_my_bookmarks') );
//                $folder.find('.js_mybookmarks_count').text($bookmark_count);
//
//                if($bookmark_byuser > 0){
//				}
				var data = {};
				data.msg = response.msg;
				data.operation = response.operation;
				data.folder_id = folder_id;
				data.folder_name = $('#wm_folder_name_' + folder_id).text();
				var $toast = toast_template(data);
//				if (response && response.code == 1) {
//					alert(response.msg);
//				}else {
//					alert(response.msg);
//				}
				if($('.js_wm_toasts').length){
					$('.js_wm_toasts').html($toast);
					$("body").addClass('open-toast');
					if (wm_timeoutHandler) clearTimeout(wm_timeoutHandler);
					wm_timeoutHandler = setInterval(function () {
						$("body").removeClass('open-toast');
					}, 2000);
				}
				$popup.removeClass('opened');
				var object_id 		= $('.wm_to_bookmark_popup').attr("data-object_id"),
					object_type 	= $('.wm_to_bookmark_popup').attr("data-object_type");
				if($bookmark_byuser > 0){
					$('.js_wm_to_bookmark[data-object_id="'+object_id+'"][data-object_type="'+object_type+'"]').addClass('bookmarked');
				}else{
					$('.js_wm_to_bookmark[data-object_id="'+object_id+'"][data-object_type="'+object_type+'"]').removeClass('bookmarked');
				}
			});
		});
		$('body').on('click','a.js_wm_to_bookmark', function (event) {
			event.preventDefault();
			var $this 		= $(this),
				$popup		= $('.wm_to_bookmark_popup');
				
			if($('.js_wm_access_popup').length){
				$('.js_wm_access_popup').addClass('opened');
				$("body").addClass("no-scroll");
				return;
			}
//			if ($this.hasClass('bookmarked')) {
//				//already bookmarked .. remove bookmark
//				if (!confirm(wm_bookmark.areyousuretodeletebookmark)) {
//					return false;
//				}
//				var $postdelete = $this;
//				$postdelete.removeClass('bookmarked');
//				var $my_bookmarks = $postdelete.closest('.wm_my_bookmarks');
//				var $folder_id 		= $postdelete.data("folder_id");
//				var $object_id 		= $postdelete.data("object_id");
//				var $object_type 		= $postdelete.data("object_type");
//				var $bookmark_id 	= $postdelete.data("bookmark_id");
//				var $target_bookmark 	= $my_bookmarks.find("#my_bookmark_" + $bookmark_id);
//				var $wrapper = $target_bookmark.parent();
//				var $folder = $my_bookmarks.find('#wm_folder_' + $folder_id);
//				var $ajaxLoader = $my_bookmarks.find('.cbxwpbkmarkloading');
//				$ajaxLoader.show();
//
//				var data = {
//					'action'  : 'wm_delete_bookmark_post',
//					'security': wm_bookmark.nonce,
//					'folder_id'  : $folder_id,
//					'object_id'  : $object_id,
//					'bookmark_id'  : $bookmark_id,
//					'object_type'  : $object_type,
//				};
//				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
//
//				if ($postdelete) {
//					$.post(ajaxurl, data, function (response) {
//						response = $.parseJSON(response);
//						$ajaxLoader.hide();
//						if (response.msg == 0) {
//							// Remove the el if the bookmark is deleted
//							$target_bookmark.remove();
//							alert( wm_bookmark.bookmark_removed );
//							var bookmarks_count = $wrapper.find('.wm_my_bookmark').length;
//							$folder.find('.js_mybookmarks_count').text(bookmarks_count);
//							if (bookmarks_count === 0) {
//								$wrapper.append('<span class="wm_bookmark_not_found">'+wm_bookmark.bookmark_removed_empty+'</span>');
//							}
//						} else if (response.msg == 1) {
//							alert( wm_bookmark.bookmark_removed_failed );
//						}
//					});
//				}
//			}else{
				//add bookmark
				
				var object_id 		= $this.data("object_id");
				var object_type 		= $this.data("object_type");
				$popup.attr('data-object_id', object_id);
				$popup.attr('data-object_type', object_type);
				$popup.find('.js_wm_default_folder').attr('data-folder_id', wm_bookmark.default_folder_id);
				if($('.js_wm_my_bookmarks').length)
					wm_load_my_bookmarks( $('.js_wm_my_bookmarks') );
				$popup.addClass('opened');
				$popup.find('.js_search_folder').focus();
				
//			}
		});
		
		var wm_make_el_editable = function($el){
			var isEditable		= $el.is('.editable');
			$el.prop('contenteditable', !isEditable).toggleClass('editable').focus();
		};
		
		
        $('.wm_my_bookmarks').on('click','span.editable', function (event) {
            event.preventDefault();
			return false;
		});
		
        $('.wm_my_bookmarks').on('click','a.js_wm_toggle_subactions', function (event) {
            event.preventDefault();
			var $this = $(this),
				folder_id = $this.data('folder_id');
			if(folder_id && !$this.hasClass('active')){
				if($this.hasClass('js_wm_edit_folder')){
					$('.js_wm_delete_folder.active[data-folder_id="'+folder_id+'"]').trigger('click');
				}else{
					$('.js_wm_edit_folder.active[data-folder_id="'+folder_id+'"]').trigger('click');
				}
			}
			$this.toggleClass('active');
			if($this.hasClass('active')){
				$this.siblings('.wm_action_actions').show();
			}else{
				$this.siblings('.wm_action_actions').hide();
			}
			return false;
		});
		
		var js_wm_is_deleting = false;
        $('.wm_my_bookmarks').on('click','a.js_wm_delete_folder_confirm', function (event) {
            event.preventDefault();

			if (!confirm(wm_bookmark.areyousuretodeletecat) || js_wm_is_deleting) {
                return false;
            }
			
            var $this			= $(this),
				$folder_id		= $this.data("folder_id");
				
			var $my_bookmarks		= $this.closest('.wm_my_bookmarks'),
				$target_folder		= $my_bookmarks.find("#wm_folder_" + $folder_id),
				$target_folder_div	= $target_folder.parent();
				
			var $ajaxLoader = $my_bookmarks.find('.cbxwpbkmarkloading');
			$ajaxLoader.show();
				
            var data = {
                'action'  : 'wm_delete_bookmark_category',
                'security': wm_bookmark.nonce,
                'id'      : parseInt($folder_id)
            };
			
            // We can also pass the url value separately from ajaxurl for front end AJAX implementations
			if(parseInt($folder_id) > 0){
                js_wm_is_deleting = true;
                $.post(ajaxurl, data, function (response) {
					$ajaxLoader.hide();
                    response = $.parseJSON(response);
                    if (response.msg == 0) {
                        // success Message
                        alert(wm_bookmark.category_delete_success);
                        // Remove the li tag if the category deleted
                        $target_folder_div.remove();
						var folders_count = $my_bookmarks.find('.wm_my_folder').length;
						if (folders_count === 0) {
							$my_bookmarks.find('.js_wm_my_bookmarks').append('<h4 class="wm_bookmark_not_found">'+wm_bookmark.folder_removed_empty+'</h4>');
						}
                    } else {
						if(response.msg != 1){
							alert(wm_bookmark.category_delete_error + ': '+ response.msg);
						}else{
							alert(wm_bookmark.category_delete_error);
						}
                    }
                    js_wm_is_deleting = false;
                });
			}
			return false;
        });
		
        $('.wm_my_bookmarks').on('click','a.js_wm_edit_folder', function (event) {
            event.preventDefault();

            var $this			= $(this);
            var $folder_id		= $this.data("folder_id"),
				$folder_field	= $('#wm_folder_name_' + $folder_id);
			wm_make_el_editable( $folder_field );
			return false;
        });
		
        $('.wm_my_bookmarks').on('click','a.js_wm_edit_folder_save', function (event) {
            event.preventDefault();

            var $this			= $(this),
				$folder_id		= $this.data("folder_id"),
				$folder_field	= $('#wm_folder_name_' + $folder_id),
				edited_folder_name = $folder_field.text().trim();
			if (edited_folder_name != '') {
				var $my_bookmarks = $this.closest('.wm_my_bookmarks');
				var $ajaxLoader = $my_bookmarks.find('.cbxwpbkmarkloading');
				$ajaxLoader.show();
                //send ajax request
                var data = {
                    'action'   : 'wm_edit_folder',
                    'security' : wm_bookmark.nonce,
                    'cat_name' : edited_folder_name,
                    'cat_id'   : parseInt($folder_id),
                };
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(ajaxurl, data, function (response) {
					$ajaxLoader.hide();
                    response = $.parseJSON(response);
                    if (response.code == 1) {
                        var folders_count = $.parseJSON(response.folders_count);
                        wm_bookmark.user_current_cat_count = folders_count;
						alert(response.msg);
						if($this.hasClass('js_wm_edit_folder_save')){
							$('.js_wm_edit_folder.active[data-folder_id="'+$folder_id+'"]').trigger('click');
						}
					} else {
                        //failed or duplicate
						alert(response.msg);
                    }
                });

            } else {
                alert(wm_bookmark.category_name_empty);
            }
			return false;
        });//manage: Edit category button
        
		
		
        $('.account-login').on('click','a.js_wm_account_email_update', function (event) {
            event.preventDefault();

            var $email	= $('#email_readonly'),
				$email_new	= $('#email_new'),
				$email_new2	= $('#email_new2');
			var isEmail1Valid = document.getElementById('email_new').checkValidity(),
				isEmail2Valid = document.getElementById('email_new2').checkValidity();
			$email_new.removeClass('is-invalid');
			$email_new2.removeClass('is-invalid');
			if( $email_new.val().trim() == '' || !isEmail1Valid ){
				$email_new.addClass('is-invalid').focus();
				return false;
			}
			if( $email_new2.val().trim() == '' || !isEmail2Valid ){
				$email_new2.addClass('is-invalid').focus();
				return false;
			}
			if( $email_new2.val().trim() != $email_new.val().trim() ){
				alert('New Email & Confirm Email address are different. Please try again!');
				return false;
			}
			
			$email.val($email_new.val().trim());
			$('.wm_account_email_toggle').trigger('click');
			return false;
        });
		
        $('.account-login').on('click','a.js_wm_account_password_update', function (event) {
            event.preventDefault();

            var $password	= $('#password_readonly'),
				$password1	= $('#password1'),
				$password2	= $('#password2');
			$password1.removeClass('is-invalid');
			$password2.removeClass('is-invalid');
			if( $password1.val().trim() == '' ){
				$password1.addClass('is-invalid').focus();
				return false;
			}
			if( $password2.val().trim() == '' ){
				$password2.addClass('is-invalid').focus();
				return false;
			}
			if( $password1.val().trim() != $password2.val().trim() ){
				alert('New Password & Confirm Password are different. Please try again!');
				return false;
			}
			
			if( $password1.val().trim().length < 8 ){
				alert('Please use 8 or more characters with a mix of letters, numbers & symbols');
				return false;
			}
			
			$password.val($password1.val().trim());
			$('.wm_account_password_toggle').trigger('click');
			return false;
        });
		
		
		
		$('.wm-archive-tabs').on('click','a.js_wm_loadmore_archive', function (event) {
            event.preventDefault();

            var $this			= $(this),
				$term_id		= $this.data("load-term") || 0,
				$taxonomy		= $this.data("load-tax") || '',
				$params		= $this.data("params") || false,
				$type		= $this.data("load-tab"),
				$order		= $this.data("load-order") || 'DESC',
				$page		= $this.data("load-page") || 2, //next page
				$post_type		= $this.data("load-post_type") || 'post'; 
			
				$this.addClass('btn-loading');
				if($params == false){
					//send ajax request
					var data = {
						'action'   : 'wm_load_more_archive',
						'security' : wm_bookmark.nonce,
						'taxonomy' : $taxonomy,
						'term_id'  : parseInt($term_id),
						'post_type'	   : $post_type,
						'type'	   : $type,
						'order'	   : $order,
						'paged'    : parseInt($page)
					};
				}else{
					var data = {
						'action'   : 'wm_load_more_archive',
						'security' : wm_bookmark.nonce,
						'params' : $params,
						'type'	   : $type,
						'paged'    : parseInt($page)
					};
				}
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(ajaxurl, data, function (response) {
					$this.removeClass('btn-loading');
                    if (response.length > 0) {
                       $this.parent().replaceWith(response);
					} 
                });

			return false;
        });
		
		var wm_s_query_load = function($loadMoreEl){
			var $s_query	= $('#wm_s_query'),
				$params		= $s_query.val(),
				$page		= $loadMoreEl && $loadMoreEl.length ? $loadMoreEl.data("load-page") : 1; //init page

			var $All = $('#all_media'),
				$All_count = $('#all_media-tab > b'),
				$Articles = $('#Articles'),
				$Articles_count = $('#Articles-tab > b'),
				$Videos = $('#Videos'),
				$Videos_count = $('#Videos-tab > b'),
				$Podcast = $('#Podcast'),
				$Podcast_count = $('#Podcast-tab > b'),
				$Downloads = $('#Downloads'),
				$Downloads_count = $('#Downloads-tab > b'),
				$Recipes = $('#Recipes'),
				$Recipes_count = $('#Recipes-tab > b'),
				$Skills = $('#Skills'),
				$Skills_count = $('#Skills-tab > b'),
				$found_posts = $('.wm_s_found_posts'),
				$search_tabs = $('.js_wm_search_tabs');
			if($loadMoreEl && $loadMoreEl.length){
				$loadMoreEl.addClass('btn-loading');
			}
			//send ajax request
			var data = {
				'action'   : 'wm_load_more_search',
				'security' : wm_bookmark.nonce,
				'params': $.parseJSON($params),
				'paged'    : parseInt($page)
			};
			// We can also pass the url value separately from ajaxurl for front end AJAX implementations
			$.post(ajaxurl, data, function (response) {
				if($loadMoreEl && $loadMoreEl.length){
					$loadMoreEl.removeClass('btn-loading');
				}
				response = $.parseJSON(response);
				//console.log(response);
				$found_posts.text(response.total);
				$All_count.text( parseInt($All_count.text()) + response.data.length );
				
				if($All.find('.wm_loadmore_archive_all').length){
					$All.find('.wm_loadmore_archive_all').remove();
				}
				
				var article_count = 0,
					skill_count = 0,
					recipe_count = 0,
					link_count = 0,
					audio_count = 0,
					vid_count = 0,
					all_total = 0;
				if(response.data && response.data.length > 0){
					for(var i = 0; i < response.data.length; i++){
						$All.append(response.data[i].html);
						if(response.data[i].type == 'article'){
							$Articles.append(response.data[i].html); article_count++;
						}
						if(response.data[i].type == 'audio'){
							$Podcast.append(response.data[i].html); audio_count++;
						}
						if(response.data[i].type == 'video'){
							$Videos.append(response.data[i].html); vid_count++;
						}
						if(response.data[i].type == 'link'){
							$Downloads.append(response.data[i].html); link_count++;
						}
						if(response.data[i].type == 'wm_recipe'){
							$Recipes.append(response.data[i].html); recipe_count++;
						}
						if(response.data[i].type == 'wm_skill_video'){
							$Skills.append(response.data[i].html); skill_count++;
						}
					}
					var art_total = parseInt($Articles_count.text()) + article_count; 
					var pod_total = parseInt($Podcast_count.text()) + audio_count; 
					var vid_total = parseInt($Videos_count.text()) + vid_count; 
					var link_total = parseInt($Downloads_count.text()) + link_count; 
					var recipe_total = parseInt($Recipes_count.text()) + recipe_count; 
					var skill_total = parseInt($Skills_count.text()) + skill_count; 
					all_total = art_total + pod_total + vid_total + link_total + recipe_total + skill_total;
					
					$search_tabs.show();
					$Articles_count.parent().show();
					$Podcast_count.parent().show();
					$Videos_count.parent().show();
					$Downloads_count.parent().show();
					$Recipes_count.parent().show();
					$Skills_count.parent().show();
					
					if(art_total > 0){
						$Articles_count.text( art_total );
					}else{
						$Articles_count.parent().hide();
					}
					if(pod_total > 0){
						$Podcast_count.text( pod_total );
					}else{
						$Podcast_count.parent().hide();
					}
					if(vid_total > 0){
						$Videos_count.text( vid_total );
					}else{
						$Videos_count.parent().hide();
					}
					if(link_total > 0){
						$Downloads_count.text( link_total );
					}else{
						$Downloads_count.parent().hide();
					}
					if(recipe_total > 0){
						$Recipes_count.text( recipe_total );
					}else{
						$Recipes_count.parent().hide();
					}
					if(skill_total > 0){
						$Skills_count.text( skill_total );
					}else{
						$Skills_count.parent().hide();
					}
					
				}
				if(all_total == 0 || (response.data && response.data.length == 0) ){
					$Articles_count.parent().hide();
					$Podcast_count.parent().hide();
					$Videos_count.parent().hide();
					$Downloads_count.parent().hide();
					$Recipes_count.parent().hide();
					$Skills_count.parent().hide();
				}
				$All.append(response.load_link);
			});
		};
		if($('#wm_s_query') && $('#wm_s_query').length && $('#wm_s_query').val() != ""){
			wm_s_query_load(); //load first page for search
		}
		
		$('.wm-archive-tabs').on('click','a.js_wm_loadmore_search', function (event) {
            event.preventDefault();
            var $this = $(this);
			wm_s_query_load($this); 
			return false;
        });
		
		//like/dislike feature
		$('body').on('click', '.sl-button', function() {
			var button = $(this);
			var post_id = button.attr('data-post-id');
			var security = button.attr('data-nonce');
			var sl_action = button.hasClass('dislike') ? 'dislike':'like';
			if(button.hasClass('freeze')){
                            return false;
                        }
			var loader = button.siblings('#sl-loader');
			if (post_id !== '') {
				$.ajax({
					type: 'POST',
					url: wm_bookmark.ajaxurl,
					data : {
						action : 'process_simple_like',
						post_id : post_id,
						sl_action : sl_action,
						nonce : security,
					},
					beforeSend:function(){
                                            button.addClass('freeze');
                                            loader.html('&nbsp;<div class="loader">Loading...</div>');
					},	
					success: function(response){
                                            loader.empty();
                                            if(response.code == 1) {
                                                loader.html(response.msg);
                                                setTimeout(function(){
                                                    button.closest('.sl-wrapper').fadeOut();
                                                    loader.empty();
                                                },1000);
                                            } else {
                                                //on error
                                                if(response.msg){
                                                    loader.html(response.msg);
                                                    setTimeout(function(){
                                                        button.closest('.sl-wrapper').fadeOut();
                                                        loader.empty();
                                                    },1000);
                                                }
                                            }
                                            button.removeClass('freeze');
					}
				});

			}
			return false;
		});
		
		//ajax contact form
		$('form.contactForm').on('submit', function() {
			var $form = $(this),
				$formData = $form.serializeArray(),
				$errMsg = $('.wm_error_msgs'),
				$loader = $form.siblings('.cbxwpbkmarkloading');
			$formData.push({ name: "security", value: wm_bookmark.nonce });
			var validator = $form.validate();
			var valid = true;
			
			var $inputs = $form.find("input,textarea");
			
			$inputs.each(function () {
				if (!validator.element(this) && valid) {
					valid = false;
				}
			});
			
			if (valid) {
				$.ajax({
					type: 'POST',
					url: wm_bookmark.ajaxurl,
					data : $.param($formData),
					beforeSend:function(){
						if($loader){
							$loader.show();
						}
					},
					success: function(response){
						//console.log(response);		
						if(response.success == 0){
							$errMsg.html('<p class="login-error">'+response.msg+'</p>');
						}else if(response.success == 1){
							$errMsg.html('');
							$form.replaceWith('<p class="alert alert-success" style="margin-top: 1em;">'+response.msg+'</p>');
						}
						if($loader){
							$loader.hide();
						}
					}
				});
			}
			return false;
		});
		
		var wm_load_herbs = function( $outputEl, args ){
			var item_template = wp.template('wm-herb-item'),
				page = (args && args.page) ? args.page : 1,
				search = (args && args.search) ? args.search : '',
				replace = (args && args.replace) ? true : false,
				$loadMoreEl = (args && args.loadBtn) ? args.loadBtn : false;
			var currentLoadBtn = $outputEl.find('.js_wm_loadmore_herbs');
			if($loadMoreEl && $loadMoreEl.length){
				$loadMoreEl.addClass('btn-loading');
			}else{
				var $ajaxLoader = $outputEl.parent().find('.cbxwpbkmarkloading');
				$ajaxLoader.show();
			}
			var data = {
				'action'   : 'wm_load_herbs',
				'security' : wm_bookmark.nonce,
				'keyword'   : search,
				'page'   : parseInt(page),
			};
			
			$.post(ajaxurl, data, function (response) {
				response = $.parseJSON(response);
				
				if(replace){
					$outputEl.empty();
				}
				if(currentLoadBtn && currentLoadBtn.length){
					currentLoadBtn.parent().remove();
				}
				if(response.data && response.data.length > 0){
					for(var i = 0; i < response.data.length; i++){
						$outputEl.append(response.data[i].html);
					}
				}
				
				$outputEl.append(response.load_link);
				if($loadMoreEl && $loadMoreEl.length){
					$loadMoreEl.removeClass('btn-loading');
				}else{
					$ajaxLoader.hide();
				}
			});
		}; 
		if( $('.js_wm_herbs').length ){
			wm_load_herbs( $('.js_wm_herbs'), {} );
		}
		$('.js_wm_herbs').on('click','a.js_wm_loadmore_herbs', function (event) {
            event.preventDefault();
            var $this = $(this),
				$page = $this.data('page'),
				keyword = $this.data('keyword');
				
			var data = {
				page : $page,
				search : keyword,
				loadBtn : $this,
			};
			wm_load_herbs( $('.js_wm_herbs'), data );
			return false;
        });
		
		$('#wm_herbs_form').on('submit', function (event) {
            event.preventDefault();
            var $this = $(this),
				keyword = $this.find('.js_wm_herb_keyword').val();
				
			var data = {
				page : 1,
				search : keyword,
				replace : 1,
			};
			wm_load_herbs( $('.js_wm_herbs'), data );
			return false;
        });
		
		$('body').on('click', '[data-is_premium]', function(e){
			e.preventDefault();
			var $popup = $('.js_wm_access_tools_popup');
			if($popup && $popup.length){
				$popup.addClass('opened');
				$("body").addClass("no-scroll");
			}
		});
		$('.wm_popup_modal').on('click','.wm_close', function (event) {
			event.preventDefault();
			var $self = $(this),
				$popup = $self.closest('.wm_popup_modal');
			
			$popup.removeClass('opened');
			$("body").removeClass("no-scroll");
			//$popup.hide();
		});
		/////////////////////////////////////////////////


        // Use the browser's built-in functionality to quickly and safely escape the string
        function escapeHtml(str) {
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

		// UNSAFE with unsafe strings; only use on previously-escaped ones!
        function unescapeHtml(escapedStr) {
            var div = document.createElement('div');
            div.innerHTML = escapedStr;
            var child = div.childNodes[0];
            return child ? child.nodeValue : '';
        }

        // var newsletterForms = $('.newsletter-signup-form');
		//
        // $.each(newsletterForms, function(key, value){
        // 	var form = value;
        //     var formMessage = $(form).find('.message');
        //     var hideModalCookie = Cookies.get('wm-hide-newsletter-modal');
		//
        //     // Show modal and set cookie
        //     if (typeof hideModalCookie === 'undefined') {
        //         var isModal = $(form).parents('.newsletter-modal');
		//
        //         if (isModal.length) {
        //             var close = isModal.find('.close');
		//
        //             close.on('click', function (e) {
        //                 e.preventDefault();
        //                 isModal.css('display', 'none');
        //                 if (typeof hideModalCookie === 'undefined') {
        //                     Cookies.set('wm-hide-newsletter-modal', true, {expires: 7});
        //                 }
        //             });
		//
        //             setTimeout(function () {
        //                 isModal.css('display', 'flex');
        //             }, 3000);
        //         }
        //     }
		//
        //     $(form).validate({
        //         invalidHandler: function(e, validator) {
        //             e.preventDefault();
		//
        //             formMessage.empty();
        //         },
		//
        //         submitHandler: function(form, e) {
        //             e.preventDefault();
		//
        //             var data = {
        //                 action: 'wm_mc_put_contact',
        //                 security: wm_bookmark.nonce,
        //                 url: 'https://us16.api.mailchimp.com/3.0/lists/b70bf5059b/members/', // wm mc master list
        //                 type: 'PUT',
        //                 data: {
        //                     email_address: null,
        //                     status_if_new: "subscribed",
        //                     status: "subscribed",
		// 					merge_fields: {}
        //                 }
        //             }
		//
        //             var email = jQuery(e.target).find('input[name=email]');
        //             var fname = jQuery(e.target).find('input[name=fname]');
        //             var lname = jQuery(e.target).find('input[name=lname]');
		//
        //             if(typeof email.val() !== 'undefined') {
        //                 data.data.email_address = escapeHtml(email.val());
        //                 data.email = email.val();
        //             }
		//
        //             if(typeof fname.val() !== 'undefined') data.data.merge_fields.FNAME = escapeHtml(fname.val());
        //             if(typeof lname.val() !== 'undefined') data.data.merge_fields.LNAME = escapeHtml(lname.val());
		//
        //             $.post(ajaxurl, data, function (response) {
        //                 var json = JSON.parse(JSON.parse(response));
		//
        //                 formMessage.empty();
		//
        //                 if(json.status === 400) {
        //                     formMessage.html('<p class="error">This user has previously unsubscribed.</p>');
        //                     return;
        //                 }
		//
        //                 formMessage.html('<p class="success">You\'ve been subscribed!</p>');
        //                 Cookies.set('wm-hide-newsletter-modal', true, { expires: 90 });
        //                 hideModalCookie = Cookies.get('wm-hide-newsletter-modal');
        //             });
        //         }
        //     });
		// });

	});

})(jQuery, wp);


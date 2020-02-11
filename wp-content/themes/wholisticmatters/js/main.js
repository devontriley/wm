jQuery(document).ready(function ($)
{
	var ajaxurl = localized_vars.ajaxurl;

	Stickyfill.add($('.hub-sidebar'));
    Stickyfill.add($('.primaryHeader'));

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

	/**
	 * Check if touch device
	 */
	function wmIsTouchDevice() {
		return 'ontouchstart' in window        // works on most browsers
		|| navigator.maxTouchPoints;       // works on IE10/11 and Surface
	}


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


    /***
	 * Click handler to show/hide mobile navigation
     */
	$(".primaryHeader__utilities-hamburger").on('click', function(e)
	{
		e.preventDefault();

		$(this).toggleClass('open');
		$('.primaryHeader__nav').toggleClass('open');
	});


    /***
	 * Mobile navigation accordion
     */
    if(window.matchMedia('(max-width: 1099px)').matches)
	{
		// Top level accordion
		$('#primaryNav .primaryNav__top-list > li > span').on('click', function(e)
		{
			e.preventDefault();

			var active = $(this).hasClass('active');

			$('.primaryNav__top-list > li > span').removeClass('active');
			$('.primaryNav__dropdown').hide();

			if(active) return;

            $(this).addClass('active');
			$(this).next('.primaryNav__dropdown').show();

            window.scroll(0, 0);
		});

		// Dropdown accordion
		$('.primaryNav__dropdown-column h3').on('click', function(e)
		{
			e.preventDefault();

			var active = $(this).hasClass('active');

            $('.primaryNav__dropdown-column h3').removeClass('active');
            $('.primaryNav__dropdown-column ul').hide();

            if(active) return;

            $(this).addClass('active');
            $(this).next('.primaryNav__dropdown-column ul').show();
		})
	}

	var wm_hide_main_nav = function()
	{
		$('.primaryHeader__utilities-hamburger, .primaryHeader__nav').removeClass('open');
	}

	if(wmIsTouchDevice())
	{
		$( 'body' ).addClass( 'is-touch-device' );
		$('.primary-nav .dropdown-menu').on("click.bs.dropdown", function (e) {
			e.stopPropagation(); 
			//e.preventDefault(); 
		}); //prevent closing of dropdown on click/touch
		$('.primary-nav [data-wm-plugin="collapse"]').trigger('click');
	}

	// Owl Carousel

	$(document).ready(function () {
		var owl = $('.owl-carousel');
		owl.owlCarousel({
			margin: 15,
			nav: true,
			dots: false,
			loop: true,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 3
				}
			}
		})
	})


	// Label Style

	$(".form-control").focus(function () {
		$(this).parent().addClass("is-focused");

	}).blur(function () {
		if($(this).val() == ""){
			$(this).parent().removeClass("is-focused");
		}
	})


    /**
	 * User registration validation
     */

	$(".signupForm").each(function()
	{
		$(this).validate({
			ignore: '.ignore',
			rules: {
				first_name: "required",
				last_name: "required",
				email: "required",
				password: {
					required: true,
					minlength: 8
				},
				_wm_hc_professional_type: {
					required: "#user_role_hcp:checked"
				},
                hiddenRecaptcha:
				{
                    required: function ()
					{
                        if(grecaptcha.getResponse() == '') return true;

                        return false;
                    }
                }
			},
			messages: {
				first_name: "Please enter your firstname",
				last_name: "Please enter your lastname",
				email: "Please enter your email",
				password: {
					required: "Please provide a password",
					minlength: ""
				}
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");

				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.next("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});

    /**
	 * User login validation
     */

	$(".LoginForm").each(function(){
		$(this).validate({
			rules: {
				log: "required",
				pwd: {
					required: true,
					//minlength: 8
				},
			},
			messages: {
				log: "Please enter your email",
				pwd: {
					required: "Please provide a password",
					//minlength: "Please use 8 or more characters with a mix of letters, numbers & symbols"
				},
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");

				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.next("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			submitHandler: function(form) {
				console.log('submit form');
				form.submit();
			}
		});
	});

	$(".contactForm").each(function(){
		$(this).validate({
			rules: {
				firstName: "required",
				lastName: "required",
				email: "required",
				message: "required",
				contactName: {
					required: true,
					minlength: 6
				},
				password: {
					required: true,
					minlength: 8
				},
				subject: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				firstName: "Please enter your firstname",
				lastName: "Please enter your lastname",
				email: "Please enter your email",
				message: "Please enter your message",
				contactName: {
					required: "Please enter your name",
					minlength: "Please enter minimum 6 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Please use 8 or more characters with a mix of letters, numbers & symbols"
				},
				subject: {
					required: "Please enter subject",
					minlength: "Please enter minimum 6 characters"
				},
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");

				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.next("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			}
		});
	});


    /***
	 * Click handler to show password
     */
	$("body").on('click', '.password-show', function ()
	{
		var input = $($(this).attr('data-password-field'));

		if (input.length > 0)
		{
			if (input.attr("type") === "password")
			{
				input.attr("type", "text");
			}
			else
			{
				input.attr("type", "password");
			}
		}
	});

	// $("body").on('click', '.password-show', function ()
	// {
	// 	var input = $("#exampleInputEmail9");
	//
	// 	if (input.attr("type") === "password")
	// 	{
	// 		input.attr("type", "text");
	// 	}
	// 	else
	// 	{
	// 		input.attr("type", "password");
	// 	}
	// });

	function wmGetParameterByName(name, url)
	{
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, '\\$&');
		var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}

    /***
	 * Click handler to close sign up modal
     */
	$(".closeModal").on('click', function(e)
	{
		e.preventDefault();

		$(".signUpScreenPopup").removeClass('opened');
		$(".LoginScreenPopup").removeClass('opened');
		$("body").removeClass("no-scroll");
	});

    /***
	 * Click handler to show signup modal
     */
	$("body").on('click', '.signup_popup', function(e)
	{
		e.preventDefault();

		console.log('signup popup!');

        wm_hide_main_nav();

		$(".LoginScreenPopup").removeClass('opened');
		$(".signUpScreenPopup").addClass('opened');
		$('.premium-signup-modal').hide();
		$("body").addClass("no-scroll");
	});

    /***
	 * Click handler to show login modal
     */
	$(".login_popup").on('click', function(e)
	{
		e.preventDefault();

        var href = $(this).attr('href');
        var redirect_to = wmGetParameterByName('redirect_to', href);

		wm_hide_main_nav();

		$(".signUpScreenPopup").removeClass('opened');
		$(".LoginScreenPopup").addClass('opened');

		if(redirect_to) $(".LoginScreenPopup").find('input[name="redirect_to"]').val(redirect_to);

		$("body").addClass("no-scroll");
	});

    /***
	 * Click handler to close login modal
     */
	$('.LoginScreenPopup').on('click', function(e)
	{
		e.preventDefault();

		if(!$(e.target).closest('.login-wrapp').length)
		{
			$('.LoginScreenPopup').removeClass('opened');
			$('body').removeClass('no-scroll');
		}
	})


	// Search

	$(".primaryHeader__utilities-search a").on('click', function()
	{
		$(".search-overlay").toggle();
		$('.search-box').toggle();
		$('body').toggleClass('search-open');
		$(this).toggleClass('active');
	});

	$(".short_link_search").on('click', function()
	{
		$('.advance-search').toggle();
	});

	$(".close-search, .search-overlay").on('click', function()
	{
		$(".wm_close_search").click();
	});


    /***
	 * Account validation start
     */
	$(document).ready(function () {
		$("#form-login-account").validate({
			rules: {
				email: "required",
				password: {
					required: true,
					minlength: 8
				},
			},
			messages: {
				email: "Please enter your email",
				password: {
					required: "Please provide a password",
					minlength: "Please use 8 or more characters with a mix of letters, numbers & symbols"
				},
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");

				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.next("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			}
		});

	});

	
	// Floting icons
	$(window).scroll(function ()
	{
		var scroll = $(window).scrollTop();

		if (scroll >= 500) {
			$(".floating-icons").addClass("fixed");
		} else {
			$(".floating-icons").removeClass("fixed");
		}
	});
	
	$('.signUpScreen').on('click', '.user_role', function(){
		var $self = $(this),
			$popup = $self.closest('.signUpScreen'),
			$finish = $popup.find('#finish'),
			$continue = $popup.find('#continue');
		if($self.hasClass('hcp')){
			$finish.hide();
			$continue.show();
		}else if($self.hasClass('non-hcp')){
			$continue.hide();
			$finish.show();
		}
	});

	$('.signUpScreen .user_role:checked').trigger('click');


    /**
	 * User registration modal
     */

	$('.signUpScreen').on('click', '#continue-next', function ()
	{
		var formId = $(this).closest('.signUpScreen').hasClass('signUpScreenPopup') ? '#signupFormPopup' : '#signupForm';
		var $form = $(formId);
		var validator = $form.validate();
		var valid = true;
		var i = 0;

		var $inputs = $(this).closest(".inner-wrapp").find("input");
		var p = 0;
		$inputs.each(function () {

			if (!validator.element(this) && valid) {
				valid = false;
			}
		});
		if (valid) {
			$form.find(".Data-one").hide();
			$form.find("#continue-data").show();
			$form.find("#continue").hide();
		}
	});
	
	// Toggle accordion
	$(".angle > i").click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).closest(".drop").toggleClass("open-child");
	});


	
	
	if($('body').hasClass('wm_is_premium')){ //prevent tab focus scroll issue
		$('#site-content').find('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]').attr('tabindex', '-1');
	}
	
	
	if( !wmIsTouchDevice() ){
		//// Expand Dropdown on hover
		$('ul.nav li.dropdown').hover(function() {
		  //jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		  $(this).addClass('show');
		  $(this).children('.dropdown-menu').addClass('show');
		  $(this).children('.dropdown-toggle').attr('aria-expanded',true);
		}, function() {
		  //jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		  $(this).removeClass('show');
		  $(this).children('.dropdown-menu').removeClass('show');
		  $(this).children('.dropdown-toggle').attr('aria-expanded',false);
		});
	}

	//Floting aside
	if ($(".articles-secton") && $(".articles-secton").length){
		var art_float_offset = $(".articles-secton").offset().top - $('header.sticky-top').height() - 25;	//header + 25px margin
		$('body').scroll(function () {
			var scroll = $('body').scrollTop();		
			if (scroll >= art_float_offset) {
				$(".article-block").addClass("fixed-aside");
			} 
			if (scroll < art_float_offset) {
				$(".article-block").removeClass("fixed-aside");
			} 
		});
	}

	// Newsletter Modal
    // const newsletterForms = $('.newsletter-signup-form');
    //
    // $.each(newsletterForms, function(key, value)
	// {
     //    let form = value;
     //    let formMessage = $(form).find('.message');
     //    let hideModalCookie = Cookies.get('wm-hide-newsletter-modal');
     //    let isModal = $(form).parents('.newsletter-modal');
     //    let closeModal;
     //    let noThanks;
    //
     //    if (isModal.length) {
     //        closeModal = isModal.find('.close');
     //        noThanks = isModal.find('.no-thanks');
    //
	// 		(closeModal).on('click', function (e) {
     //            e.preventDefault();
    //
     //            isModal.css('display', 'none');
     //            console.log('close');
    //
     //            if (typeof hideModalCookie === 'undefined') {
     //                Cookies.set('wm-hide-newsletter-modal', true, {expires: 7});
     //            }
     //        });
    //
     //        (noThanks).on('click', function (e) {
     //            e.preventDefault();
    //
     //            isModal.css('display', 'none');
     //            console.log('close');
    //
     //            if (typeof hideModalCookie === 'undefined') {
     //                Cookies.set('wm-hide-newsletter-modal', true, {expires: 7});
     //            }
     //        });
     //    }
    //
     //    // Show modal and set cookie
     //    if (typeof hideModalCookie === 'undefined') {
     //        setTimeout(function () {
     //            isModal.css('display', 'flex');
     //        }, 3000);
     //    }
    //
     //    $('.newsletter-signup-modal-trigger').on('click', function(e) {
     //    	e.preventDefault();
    //
     //    	isModal.css('display', 'flex');
	// 	});
    //
     //    $(form).validate({
     //        invalidHandler: function(e, validator) {
     //            e.preventDefault();
    //
     //            formMessage.empty();
     //        },
    //
     //        submitHandler: function(form, e) {
     //            e.preventDefault();
    //
     //            let data = {
     //                action: 'wm_mc_put_contact',
     //                security: wm_bookmark.nonce,
     //                // url: 'https://us16.api.mailchimp.com/3.0/lists/b70bf5059b/members/', // wm mc master list
     //                // type: 'PUT',
     //                data: {
     //                    email_address: null,
     //                    status_if_new: "subscribed",
     //                    status: "subscribed",
     //                    merge_fields: {}
     //                }
     //            }
    //
     //            let email = jQuery(e.target).find('input[name=email]');
     //            let fname = jQuery(e.target).find('input[name=fname]');
     //            let lname = jQuery(e.target).find('input[name=lname]');
    //
     //            if(typeof email.val() !== 'undefined') {
     //                data.data.email_address = escapeHtml(email.val());
     //                data.email = email.val();
     //            }
    //
     //            if(typeof fname.val() !== 'undefined') data.data.merge_fields.FNAME = escapeHtml(fname.val());
     //            if(typeof lname.val() !== 'undefined') data.data.merge_fields.LNAME = escapeHtml(lname.val());
    //
     //            $.post(ajaxurl, data, function (response) {
     //                let json = JSON.parse(JSON.parse(response));
    //
     //                formMessage.empty();
    //
     //                if(json.status === 400) {
     //                    formMessage.html('<p class="error">This user has previously unsubscribed.</p>');
     //                    return;
     //                }
    //
     //                formMessage.html('<p class="success">You\'ve been subscribed!</p>');
     //                Cookies.set('wm-hide-newsletter-modal', true, { expires: 90 });
     //                hideModalCookie = Cookies.get('wm-hide-newsletter-modal');
     //            });
     //        }
     //    });
    // });


    /**
	 * Premium tag info popup
     */

    $('body').on('click', function(e)
    {
        if($(e.target).closest('.premium-info-popup.active').length === 0 && $(e.target).closest('.premium-info-btn').length === 0) {
            $('.premium-info-popup').removeClass('active');
        }
    });

    $('body').on('click', '.premium-info-btn', function(e)
    {
		e.preventDefault();

		if(window.matchMedia('(max-width: 768px)').matches)
        {
            $('.premium-signup-modal').css('display', 'flex');
        }
        else
        {
            $('.premium-info-popup').removeClass('active');

            $(this).next('.premium-info-popup').addClass('active');
        }
	});

    $('.premium-signup-modal .close').on('click', function(e)
    {
       e.preventDefault();
       $('.premium-signup-modal').hide();
    });


    /**
	 * Continuing Education Accordion Additional Info Boxes and Sidebar switching
     */

    $('.wm-archive-tabs .nav-link[data-toggle="tab"]').on('click', function(e)
	{
		var target = $(this).attr('aria-controls');

		$('.image-text-module[data-accordion-parent]').addClass('d-none');
		$('.image-text-module[data-accordion-parent="'+target+'"]').removeClass('d-none');

		$('.articles-secton .article-block[data-accordion-parent]').addClass('d-none');
        $('.articles-secton .article-block[data-accordion-parent="'+target+'"]').removeClass('d-none');

        $('.course-additional-copy[data-accordion-parent]').hide();
        $('.course-additional-copy[data-accordion-parent="'+target+'"]').show();
	});


    /**
	 * HUB sidebar anchor scroll
     */

    let sidebar = $('.hub-sidebar');
    let headerHeight = $('#primaryHeader').outerHeight();
    let modulesContainer = $('.modules-container');
    let accordionControl = $('.sidebar-header');
    let mobileCollapse = $('.sidebar-mobile-collapse');

    $('.sidebar-list a').on('click', function(e)
    {
    	e.preventDefault();

        let targetElement = $($(this).attr('href'));
        let scrollDistance = targetElement.offset().top - (headerHeight + 20);

        if(window.matchMedia('(max-width: 991px)').matches)
		{
            mobileCollapse.slideUp(0);
            accordionControl.removeClass('active');
            scrollDistance = targetElement.offset().top - (headerHeight + accordionControl.outerHeight() + 20);
		}

        $('html, body').animate({
            scrollTop: scrollDistance
        }, 100, 'linear');
    });

    /**
	 * HUB mobile accordion
     */
    if(window.matchMedia('(max-width: 991px)').matches)
	{
		accordionControl.on('click', function(e)
		{
			e.preventDefault();

			mobileCollapse.stop().slideToggle();
			accordionControl.stop().toggleClass('active');
		});
	}

	/** BIODIGITAL LANDING PAGE **/

	// check for scroller
	if(document.getElementById('systems-scroller')){

        var latestScrollY = 0,
            imagesY = document.getElementById('systems-scroller').offsetTop,
            imagesHeight = document.getElementById('systems-scroller').offsetHeight,
            viewportHeight = window.innerHeight,
            viewportWidth = window.innerWidth,
            imageOffset = viewportWidth * 0.1,
            imagesContainer = document.getElementById('scroller-inner'),
            ticking = false,
        	ua = window.navigator.userAgent,
        	msie = ua.indexOf("MSIE ");

        // //check if IE and stop the function if so
        // if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
        	// return;
		// }

        function onScroll(e) {
            requestTick();
        }

        function requestTick() {
            if(!ticking) {
                requestAnimationFrame(update);
            }
            ticking = true;
        }

        function update(timestamp) {
            ticking = false;

            var direction = (window.scrollY - latestScrollY > 0) ? 1 : -1;

            latestScrollY = window.scrollY;

            var topPosition = imagesY - (viewportHeight + latestScrollY),
                bottomPosition = (imagesY) - (latestScrollY - imagesHeight);

            if(topPosition <= 0 && bottomPosition >= 0) {
                var total = (bottomPosition - topPosition),
                    percentAnimated = Math.abs(topPosition / total),
                    transformX = 22 - (44 * percentAnimated);

                imagesContainer.style.transform = 'translateX('+ transformX +'vw)';
            }
        }
        window.addEventListener('scroll', onScroll, false);
	}


    /**
	 * Biodigital Tools
     */
	// once everything is loaded, adjust iframe to be full screen
	var height = $(window).height();
	var interactiveHeaderHeight = $('.interactive-header').outerHeight();
	var correctHeight = height - interactiveHeaderHeight;
	$('.interactive-body iframe').css('height', correctHeight);

	//keep an eye out for resizes so that the iframe adapts height
	$(window).resize(function(){
        var height = $(window).height();
        var interactiveHeaderHeight = $('.interactive-header').outerHeight();
        var correctHeight = height - interactiveHeaderHeight;
        $('.interactive-body iframe').css('height', correctHeight);
	});

	// check to see if a user to logged in and gate the proper content if not
	var contentBody = $('.biodigital-content-body');

	if(contentBody.hasClass('gated-content')){
	    console.log('gated content!');
		var modelBtns = $('.model-btn');

		for(var i = 0; i <= modelBtns.length; i++){
			if(i !== 0){
				$(modelBtns[i]).addClass('gated');
                $(modelBtns[i]).addClass('signup_popup');
			}
		}
	}

	//if logged out, create account button will launch modal on click
    $("body").on('click', '#create-new-account-btn', function(e)
    {
        e.preventDefault();

        wm_hide_main_nav();

        $(".LoginScreenPopup").removeClass('opened');
        $(".signUpScreenPopup").addClass('opened');
        $('.premium-signup-modal').hide();
        $("body").addClass("no-scroll");
    });

	// drawer in and out on click
	$('.drawer-toggle').on('click', function(e)
	{
		if(!$('.interactive-drawer').hasClass('active')) {
			$('.interactive-drawer').addClass('active');
		} else {
            $('.interactive-drawer').removeClass('active');
		}
		$('.content-container').toggleClass('active');
	});


	// on model button click
	$('.model-btn').on('click', function(e){
        var thisBtn = $(e.target).closest('div[class^="model-btn"]');

        //check to see if the content is gated
        if($(thisBtn).hasClass('gated')){
			e.preventDefault();
			// add modal
        } else {
            $('.model-btn').removeClass('active');

            $(thisBtn).addClass('active');

            var iframeSrc = $(thisBtn).data('src');
            $('iframe').attr('src', iframeSrc);

            // append correct model to header span
            var modelLabel = $(thisBtn).find('.label');
            var modelText = $(modelLabel).text();

            $('.viewing-model').text(modelText);

            /* we need to make sure that if the currently viewing header changes height,
            so does the position of the drawer */
			var currentViewingHeight = $('.headerviewing-text').outerHeight();
			var fullHeaderHeight = currentViewingHeight + 60;
			var newDrawerHeight = "calc(100vh - " + fullHeaderHeight + "px)";

			$('.interactive-drawer').css({"height" : newDrawerHeight, "top" : fullHeaderHeight + "px"});

			//finally, close the drawer!
			setTimeout(function(){
                $('.interactive-drawer').removeClass('active');
                $('.content-container').toggleClass('active');
			}, 300);
		}
	});

	// new systems select
	$('.system-block').on('click', function(e){
		var allBlocks = $('.system-block');
		var thisBlock = $(e.target).closest('div[class^="system-block"]');
        var selectedValue = $(thisBlock).data('value');

		//confirm e target is not currently selected
		if(! $(thisBlock).hasClass('active')){

            //highlight the right systems block
            $(allBlocks).removeClass('active');
            $(thisBlock).addClass('active');

            //get the corresponding models for this system to show
            $('.models-inner').removeClass('active');
            $('.models-inner').each(function(){
                var modelsSystem = $(this).data('system');

                if(modelsSystem == selectedValue){
                    $(this).addClass('active');

                    //check to see if gated
                    var modelBtns = $(this).find('.model-btn');

					if(! $(modelBtns[0]).hasClass('gated')){

                        //make first option active automatically
                        $(modelBtns).removeClass('active');
                        $(modelBtns[0]).addClass('active');

                        // preload source into iframe
                        var iframeSrc = $(modelBtns[0]).data('src');
                        $('iframe').attr('src', iframeSrc);

                        //append correct system to header span
                        $('.viewing-system').text(modelsSystem + ' System');

                        // append correct model to header span
                        var modelLabel = $(modelBtns[0]).find('.label');
                        var modelText = $(modelLabel).text();
                        $('.viewing-model').text(modelText);

                        /* we need to make sure that if the currently viewing header changes height,
            			so does the position of the drawer */
                        var currentViewingHeight = $('.headerviewing-text').outerHeight();
                        var fullHeaderHeight = currentViewingHeight + 60;
                        var newDrawerHeight = "calc(100vh - " + fullHeaderHeight + "px)";

                        $('.interactive-drawer').css({"height" : newDrawerHeight, "top" : fullHeaderHeight + "px"});
					}
                }
            });
		}
	});


    /**
	 * Header notice bar
     */

    $('.primaryHeader__notice .close').on('click', function(e)
	{
		e.preventDefault();

		$('body').removeClass('promobar-enabled');

        Cookies.set('wm-hide-promobar', true);

		$(this).parents('.primaryHeader__notice').slideUp();
	});

});


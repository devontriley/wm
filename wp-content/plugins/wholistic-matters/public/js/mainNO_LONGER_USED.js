jQuery(document).ready(function () {
	jQuery(".mob-navbar-header button").click(function () {
		jQuery('.main_nav').toggleClass('nav-open', 500);
		jQuery('.nav-open').css('left', 0);
		//jQuery("#mob_nav_menu").toggleClass("show");

		jQuery(".mob-navbar-header button").toggleClass("now");
	});


	// Owl Carousel

	jQuery(document).ready(function () {
		var owl = jQuery('.owl-carousel');
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

	jQuery(".form-control").focus(function () {
		jQuery(this).parent().addClass("is-focused");

	}).blur(function () {
		if(jQuery(this).val() == ""){
			jQuery(this).parent().removeClass("is-focused");
		}
	})

	


	// Signup validation

	jQuery(document).ready(function () {
		jQuery("#signupForm").validate({
			rules: {
				first_name: "required",
				last_name: "required",
				email: "required",
				password: {
					required: true,
					minlength: 8
				},
			},
			messages: {
				first_name: "Please enter your firstname",
				last_name: "Please enter your lastname",
				email: "Please enter your email",
				password: {
					required: "Please provide a password",
					minlength: ""
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
				jQuery(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				jQuery(element).addClass("is-valid").removeClass("is-invalid");
			}
		});

	});

	// Login validation
	console.log('devon');
	jQuery(document).ready(function () {
		jQuery("#LoginForm").validate({
			rules: {
				log: "required",
				pwd: {
					required: true,
					minlength: 8
				},
			},
			messages: {
				log: "Please enter your email",
				pwd: {
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
				jQuery(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				jQuery(element).addClass("is-valid").removeClass("is-invalid");
			},
            submitHandler: function(form) {
                console.log(form);
				form.submit();
            }
		});
	});

	// With button

	jQuery("#continue-next").click(function () {
		debugger

		var validator = jQuery("#signupForm").validate();
		var valid = true;
		var i = 0;

		var $inputs = jQuery('#continue-next').closest(".inner-wrapp").find("input");
		debugger
		var p = 0;
		$inputs.each(function () {

			if (!validator.element(this) && valid) {
				valid = false;
			}
		});
		if (valid) {
			jQuery(".Data-one").hide();
			jQuery("#continue-data").show();
			jQuery("#continue").hide();
		}

	});


	// Password Toggle 

	jQuery("body").on('click', '.password-show', function () {
		var input = jQuery(jQuery(this).attr('data-password-field'));
		if (input.length > 0) {
                    if (input.attr("type") === "password") {
                            input.attr("type", "text");
                    } else {
                            input.attr("type", "password");
                    }
		}
	});

	jQuery("body").on('click', '.password-show', function () {
		var input = jQuery("#exampleInputEmail9");
		if (input.attr("type") === "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});


	// Signup open/close

	jQuery(".signup_butn").click(function () {
		jQuery(".signUpScreen").show();
		jQuery("body").addClass("no-scroll");
	});

	jQuery(".closeModal").click(function () {
		jQuery(".signUpScreen").hide();
		jQuery("body").removeClass("no-scroll");
	});


	// Signin open/close

	jQuery(".login_butn").click(function () {
		jQuery(".LoginScreen").show();
		jQuery("body").addClass("no-scroll");
	});

	jQuery(".closeModal").click(function () {
		jQuery(".LoginScreen").hide();
		jQuery("body").removeClass("no-scroll");
	});

	jQuery(".signup_butn_2").click(function () {
		jQuery(".LoginScreen").hide();
		jQuery(".signUpScreen").show();
		jQuery("body").addClass("no-scroll");
	});


	// Search

	jQuery(".search-head").click(function () {
		jQuery(".sticky-top").toggleClass("search-open");
	});

	jQuery(".short_link_search").click(function () {
		jQuery(".sticky-top").toggleClass("advance-open");
	});

	jQuery(".close-search").click(function () {
		jQuery(".sticky-top").removeClass("advance-open");
		jQuery(".sticky-top").removeClass("search-open");
	});



	// Account validation start

//	jQuery.validator.setDefaults({
//		submitHandler: function () {
//                    
//			//alert("submitted!");
//		}
//	});

	jQuery(document).ready(function () {
		jQuery("#form-login-account").validate({
			rules: {
				email_login: "required",
				password_login: {
					required: true,
					minlength: 8
				},
			},
			messages: {
				email_login: "Please enter your email",
				password_login: {
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
				jQuery(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				jQuery(element).addClass("is-valid").removeClass("is-invalid");
			}
		});

	});

	// Account validation End

});

 function show1() {
            document.getElementById('finish').style.display = 'none';
            document.getElementById('continue').style.display = 'block';
        }

        function show2() {
            document.getElementById('finish').style.display = 'block';
            document.getElementById('continue').style.display = 'none';
        }
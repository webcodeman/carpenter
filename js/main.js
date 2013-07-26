/* You can safely use $ in this code block to reference jQuery */
jQuery(function($) {
	//check for mobile devices
	var ua = navigator.userAgent;
	var checker = {
		iphone: ua.match(/(iPhone|iPod)/),
		ipad: ua.match(/(iPad)/),
		blackberry: ua.match(/BlackBerry/),
		android: ua.match(/Android/)
	};
	
	//on ready
	$(document).ready(function() {
		//vars
		var cat = "";
		var curr_url = document.URL;
		var this_class = "";
		var this_id = "";
		var nav_id = "";
		var current_path = '';
		var current_index = null;
		var next_url = '';
		var prev_url = '';
		var urls = [];
		var urls_string = "";
		var grid_url = "";
		var classes = new Array();
		
		//functions
		function onBefore() {
			//before slide switches
			if($("#content").hasClass('home')) {
				curr_slide = $(this).index();
				$("#banner_display").find(".active").removeClass("active");
				$("#banner_display").find("p:eq(" + curr_slide + ")").addClass("active");
			}
			if($("#content").hasClass('work')) {
				curr_slide = $(this).index();
				$("#project_display").find(".active").removeClass("active");
				$("#project_display").find("li:eq(" + curr_slide + ")").addClass("active");
				if($(".slide_info_wrapper").is(":visible")) {
					$(this).removeClass(".show");
					$(this).parent().find(".slide_info_container").slideUp();
					$(this).find(".slide_info_switch").removeClass("active");
				}
			}
		}
		
		function onBeforeTest() {
			//before slide switches
			curr_test = $(this).index();
			$("#testimonial_display").find("p").find(".active").removeClass("active");
			$("#testimonial_display").find("p").find("span:eq(" + curr_test + ")").addClass("active");
		}
		
		function onAfter() {
			//after slide switches
		}
		
		function anchor_next() {
			if (next_url.length > 0) {
				window.location.href = next_url;
			}
		}
		
		function anchor_prev() {
			if (prev_url.length > 0) {
				window.location.href = prev_url;
			}
		}
		
		//wait for images and then fade in after they've all been loaded
		$("#fade_container").waitForImages(function() {
		
			//add arrow to top of dropdowns
			$("#menu-navigation").find(".sub-menu").wrap('<div class="sub-menu-container" />');
		
			//have social media icons open in new window/tab
			$(".twitter_link").parent().attr("target","_blank");
			$(".facebook_link").parent().attr("target","_blank");
		
			//hover states for social media icons
	 
		
			//find active nav items to display in sub-nav and side-nav
			if($("#sub_nav_container").length > 0) {
				nav_id = $(".current_page_parent").attr("id");
				$("#sub_" + nav_id).addClass("current_page_parent");
				nav_id = $(".current_page_item").attr("id");
				$("#sub_" + nav_id).addClass("current_page_item");
				nav_id = $(".current-menu-item").attr("id");
				$("#sub_" + nav_id).addClass("current_page_item");
			}
		
			//remove empty headers for IE7
			if (jQuery.browser.msie && parseInt(jQuery.browser.version) <= 7 ) {
				if($(".entry-title").html() == '') {
					$(".entry-title").css("lineHeight","1");
				}
				if($("#menu_sub_navigation").find("li").length > 0) {
					$("#menu_sub_navigation").find("li").css("position"," ");
				}
			}
		
			//default text fill for newsletter sign up
			$("#glutij-glutij").focus(function() {
				if($(this).val() == "Your Email Address") {
					$(this).val("");
				}
			});
		
			$("#glutij-glutij").blur(function() {
				if($(this).val() == "") {
					$(this).val("Your Email Address");
				}
			});
		
		
			//set up fancy box lighboxing for links
			if(!checker.android && !checker.iphone && !checker.blackberry) {
				$("a.fancybox").fancybox({
					titleShow: false,
					overlayOpacity: .87,
					overlayColor: "#000"
				});
			}
		
		//HOME SPECIFIC CODE
			if($("#content").hasClass('home')) {
				//if it's IE7 or below we need to not use cycle for the top banner
				//because the z-index of the drop downs won't show them on top of the slides
				if (jQuery.browser.msie && parseInt(jQuery.browser.version) <= 7 ) {
					//ie7 code here
					$("#slides").find(".slide_container").hide();
					$("#slides").find(".slide_container:first").show();
				} else {
					$("#home_slides").css("position","relative");
					//check for multiple slides
					if($("#slides").length > 0) {
						var curr_slide = 0;
						//$("#slides").waitForImages(function() {
							var banner_slider = $("#slides").cycle({
								fx: 'fade',
								timeout: 7000,
								fit: 1,
								speed: 3000,
								easing: "easeOutExpo",
								before: onBefore
							});
						//});
						$("#banner_display").find("p:first-child").addClass("active");
						$("#banner_display").find("p").click(function() {
							var go_to = $(this).index();
							banner_slider.cycle(go_to);
						});
						$("#slides").find(".slide_container").click(function() {
							banner_slider.cycle('next');
						});
					}
				}
				if($("#testimonial_container").length > 0) {
					if(!checker.android && !checker.iphone && !checker.blackberry) {
						var curr_test = 0;
						var test_slider = $("#testimonial_container").cycle({
							fx: 'fade',
							timeout: 8500,
							fit: 1,
							speed: 1500,
							easing: "easeOutExpo",
							before: onBeforeTest
						});
						$("#testimonial_display").find("p").find("span:first-child").addClass("active");
						$("#testimonial_display").find("p").find("span").click(function() {
							var go_to = $(this).index();
							test_slider.cycle(go_to);
						});
					} else {
						$("#testimonial_container").find(".slide_container").hide();
						$("#testimonial_container").find(".slide_container:first-child").show();
						$("#testimonial_display").hide();
					}
				}
			}
		//END OF HOME SPECIFIC CODE
		//PORTFOLIO SPECIFIC CODE
			if($("#content").hasClass("portfolio")) {
				current_path = '';
				current_index = null;
				next_url = '';
				prev_url = '';
				urls = [];
				urls_string = "";
				titles = [];
				titles_string = "";
				//clear project_urls and project_grid cookie
				$.cookie('project_urls', null, {path: '/'});
				$.cookie('project_grid', null, {path: '/'});
				//check if the browser is returning http:// as part of the url and remove it if it is, then split the url on all /'s
				if(curr_url.substring(0,7) == "http://") {
					url_array = curr_url.substring(7).split("index.html");
				} else {
					url_array = curr_url.split("index.html");
				}
				grid_url = '/' + url_array[1] + '/' + url_array[2] + '/';
				urls = [];
				$(".projects_list_item").each(function() {
					var path = $(this).find("a").attr("href");
					urls.push(path);
				});
				// Join urls array, store in cookie
				$.cookie('project_urls', urls.join(), {path: '/'});
				$.cookie('project_grid', grid_url, {path: '/'});
			}
		//END OF PORTFOLIO SPECIFIC CODE
		//WORK ITEM SPECIFIC CODE
			if($("#content").hasClass("work")) {
				current_path = '';
				current_index = null;
				next_url = '';
				prev_url = '';
				urls = [];
				grid_url = '';
				//change active top nav to gallery from blog
				$("#nav_blog").removeClass("current_page_parent");
				$("#nav_gallery").addClass("current_page_parent");
				// If cookie exists get next/last urls
				if($.cookie('project_urls') != null) {
					urls = $.cookie('project_urls').split(",");
				}
				if($.cookie('project_grid') != null) {
					grid_url = $.cookie('project_grid');
				} else {
					grid_url = 'gallery/index.html';
				}
				if(urls != undefined) {
					//
				} else {
					$('.prev_project').css('display', 'none');
					$('.next_project').css('display', 'none');
				}
				// Get current path
				current_path = location.href;
				for (i in urls) {
					// If current path matches url, set current index
					if (current_path == urls[i]) {					
						current_index = i;
					}
				}
				// Get next, prev urls based on current index
				if (current_index != null) {
					var next_index = Number(current_index) + 1;
					if (next_index >= urls.length) {
						next_index = 0;
					}
					var prev_index = Number(current_index) - 1;
					if (prev_index < 0) {
						prev_index = urls.length - 1;
					}
					next_url = urls[next_index];
					prev_url = urls[prev_index];
				}
				$(".prev_project").find("a").attr("href",prev_url);
				$(".next_project").find("a").attr("href",next_url);
				$(".grid_link").find("a").attr("href",grid_url);
				//check for multiple slides
				if($("#slides").length > 0) {
					var project_slider = "";
					if(!checker.android && !checker.iphone && !checker.blackberry) {
						$(".project_link_mobile").click(function() {
							return false;
						})
						if($(".slide_info_container").length > 0) {
							$(".slide_info_container").hide();
							$(".slide_info_switch").click(function() {
								if($(this).parent().find(".slide_info_container").is(":visible")) {
									$(this).removeClass("active");
									$(this).parent().find(".slide_info_wrapper").removeClass(".show");
									$(this).parent().find(".slide_info_container").slideUp(600);
								} else {
									$(this).addClass("active");
									$(this).parent().find(".slide_info_wrapper").addClass(".show");
									$(this).parent().find(".slide_info_container").slideDown(600);
								}
								project_slider.cycle('pause');
								return false;
							});
						}
						var curr_slide = 0;
						$("#slides").waitForImages(function() {
							project_slider = $("#slides").cycle({
								fx: 'fade',
								timeout: 7000,
								width: "100%",
								speed: 3000,
								easing: "easeOutExpo",
								before: onBefore
							});
						});
						$("#project_display").find("li:first-child").addClass("active");
						$("#project_display").find("li").click(function() {
							var go_to = $(this).index();
							project_slider.cycle(go_to);
							project_slider.cycle('pause');
						});
						$("#project_slide_prev").click(function() {
							project_slider.cycle('prev');
						});
						$("#project_slide_next").click(function() {
							project_slider.cycle('next');
						});
					} else {
						$("#project_display").hide();
					}
				}
			}
		//END OF WORK ITEM SPECIFIC CODE
		//CONTACT PAGE SPECIFIC CODE
			if($(".contact_form").length > 0) {
				$("#gform_submit_button_1").addClass('inactive');
				//default value for name field
				$("#input_1_1").focus(function() {
					if($(this).val() == "Name") {
						$(this).val("");
					}
				});
				$("#input_1_1").blur(function() {
					if($(this).val() == "") {
						$(this).val("Name");
					}
					check_button();
				});
				//default value for email field
				$("#input_1_2").focus(function() {
					if($(this).val() == "Email") {
						$(this).val("");
					}
				});
				$("#input_1_2").blur(function() {
					if($(this).val() == "") {
						$(this).val("Email");
					}
					check_button();
				});
				//default value for phone number field
				$("#input_1_3").focus(function() {
					if($(this).val() == "Phone #") {
						$(this).val("");
					}
				});
				$("#input_1_3").blur(function() {
					if($(this).val() == "") {
						$(this).val("Phone #");
					}
					check_button();
				});
				//default value for message field
				$("#input_1_4").focus(function() {
					if($(this).val() == "Your Message") {
						$(this).val("");
					}
				});
				$("#input_1_4").blur(function() {
					if($(this).val() == "") {
						$(this).val("Your Message");
					}
					check_button();
				});
				// check for inactive requirement on submit button
				function check_button() {
					if($("#input_1_1").val() != "Name" && $("#input_1_2").val() != "Email" && $("#input_1_4").val() != "Your Message") {
						$("#gform_submit_button_1").removeClass('inactive');
					} else {
						$("#gform_submit_button_1").addClass('inactive');
					}
				}
				$("#gform_submit_button_1").click(function() {
					if($(this).hasClass("inactive")) {
						alert('Please provide a Name, Email Address, and Message before submitting the Contact Form. Thanks.');
						return false;
					}
				});
			}
		//END OF CONTACT PAGE SPECIFIC CODE
			$("#fade_container").fadeIn(500);
		});
	});
});
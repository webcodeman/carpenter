<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="UTF-8" />
<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />

<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" /> 
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/javacsript/fancybox/jquery.fancybox-1.3.4.css" />

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.waitforimages.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/picanim files/picanim.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/picanim files/jquery.picanim.min.js"></script>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/app-icon.html" />

<?php wp_head(); ?>
</head>
<script>
$(window).load(function(){		
			$('#home_slides img').picanim({initEf:'grayscale',hoverEf:'fadeIn'});
			$('#home_features img').picanim({initEf:'grayscale',hoverEf:'fadeIn'});
});
$("#fade_container").waitForImages(function() {
			//add arrow to top of dropdowns
			$("#menu-navigation").find(".sub-menu").wrap('<div class="sub-menu-container" />');
			//have social media icons open in new window/tab
			$(".twitter_link").parent().attr("target","_blank");
			$(".facebook_link").parent().attr("target","_blank");
			//hover states for social media icons
			$(".twitter_link").hover(
				function() {
					$(this).attr('src','<?php echo get_template_directory_uri(); ?>/images/twitter_color.png');
				}, 
				function() {
					$(this).attr('src','<?php echo get_template_directory_uri(); ?>/images/twitter.png');
				}
			);
			$(".facebook_link").hover(
				function() {
					$(this).attr('src','<?php echo get_template_directory_uri(); ?>/images/facebook_color.png');
				}, 
				function() {
					$(this).attr('src','<?php echo get_template_directory_uri(); ?>/images/facebook.png');
				}
			);
		}
			);
</script>
<body class="home">
<div class="main_wrapper">
<div id="page" class="wrapper">
	<div id="fade_container">
		<!-- #fade -->
		<div class="header_wrapper">
			<div id="logo">
				<?php
			$logo = of_get_option('hmk_logo');
			if(!$logo) {
			$logo= get_template_directory_uri()."/images/logo.png";
			}
			?>
				<a href="<?php echo get_site_url(); ?>" title="Country Carpenter" rel="home"><img src="<?php echo $logo; ?>" ></a>
			</div>
			<div id="nav">
				<nav id="access" role="navigation" class="container_24">
				<h1 class="assistive-text section-heading">Main menu</h1>
				<div class="skip-link screen-reader-text">
					<a href="#content" title="Skip to content">Skip to content</a>
				</div>
				<div class="grid_16 prefix_4 suffix_4">
					<div class="menu-navigation-container">
						<ul class="hmk_social">
							<li id="nav_274" class="menu-item ">
							<a href="<?php  echo of_get_option('hmk_facebook_url'); ?>">
							<img class="facebook_links" width="9" height="20" src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="" /> </a>
							</li>
							<li id="nav_273" class="menu-item ">
							<a href="<?php  echo of_get_option('hmk_twitter_url'); ?>">
							<img class="twitter_links" width="19" height="19" src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="" /> </a>
							</li>
							<li id="nav_273" class="menu-item ">
							<a href="<?php  echo of_get_option('hmk_linkedin_url'); ?>">
							<img class="twitter_links" width="19" height="19" src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt="" /> </a>
							</li>
						</ul>
						<?php  echo hmk_nav(); ?>
					</div>
				</div>
				</nav>
				<!-- #access -->
			</div>
		</div>
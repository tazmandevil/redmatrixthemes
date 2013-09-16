<?php
// theme: basicblog
// by tazman@red.tazmandevil.info

	$uid = get_theme_uid();

	if($uid)
		load_pconfig($uid,'blogbasic');

	// set all to false
	$line_height = false;
	$background = false;
	$blogbasic_font_size = false;
	$navcolour = false;
	$linkcolour = false;
	$radius = false;
	$asect = false;
	$asectopacity = false;
	$astext = false;
	$shadows = false;

	// get user defines first, the fall back to the site cofiguration
	// and finaly the hardcoded defaults
	if ($uid) {
		$line_height = get_pconfig($uid, "blogbasic","line_height");
		$background = get_pconfig($uid, "blogbasic", "background");
		$blogbasic_font_size = get_pconfig($uid, "blogbasic", "font_size");
		$navcolour = get_pconfig($uid, "blogbasic", "navcolour");
		$linkcolour = get_pconfig($uid, "blogbasic", "linkcolour");
		$radius = get_pconfig($uid,'blogbasic','radius');
		$asect = get_pconfig($uid, 'blogbasic', 'asect');
		$asectopacity = get_pconfig($uid, 'blogbasic', 'asectopacity');
		$astext = get_pconfig($uid, 'blogbasic', 'astext');
		$shadows = get_pconfig($uid, "blogbasic", "shadow");
	}

	# get site configuration if we need it and eventualy set hardcoded defaults
	if (!isset($line_height)) $line_height = get_config("blogbasic","line_height");
	if ($line_height < 1.0 || $line_height > 2.0) $line_height = "1.2";

	if (!isset($blogbasic_font_size)) $blogbasic_font_size = get_config("blogbasic", "font_size");
	if ($blogbasic_font_size < 8.0 || $blogbasic_font_size > 20.0) $blogbasic_font_size = "12";

	if (!isset($navcolour)) $navcolour = get_config("blogbasic", "navcolour");
	if (!isset($navcolour)) $navcolour = "red";

	if (!isset($linkcolour)) $linkcolour = get_config("blogbasic", "linkcolour");

	if (!isset($radius)) $radius = get_config('blogbasic','radius');
	if (!isset($radius)) $radius = "5";

	if (!isset($shadows)) $shadows = get_config('blogbasic','shadow');
	if (!isset($shadows)) $shadows = "true";

	// In non-expert mode, we just let them choose font size, line height, and a colour scheme.
	// A colour scheme is just a pre-defined set of the above variables.
	// But only apply these settings in non-expert mode to prevent confusion when turning expert mode on and off.
	if(! feature_enabled($uid,'expert')) {
		if ($colour_scheme === 'blogbasic')
			$navcolour = 'red';
		$shadows = "true";
		$radius = 5;
		$asectopacity = 1;
	}


	// print the css first.
	if(file_exists('view/theme/' . current_theme() . '/css/style.css')) {
		$x = file_get_contents('view/theme/' . current_theme() . '/css/style.css');
		if(get_config('system','pcss_compress')) {
			// this shaves off about 10%, probably not enough to worry about right now.
			logger('pcss compress: original size: ' . strlen($x), LOGGER_DEBUG);
			$x = str_replace(array("\r","\t","  "),array("",' ',' '),$x);
			$x = preg_replace('/(\n[ ]+?)/s',"\n",$x);
			$x = str_replace("\n","",$x);
			logger('pcss compress: final size: ' . strlen($x), LOGGER_DEBUG);
		}
		echo str_replace(array('$radius'),array($radius),$x);
	}


	// prepare colors for nav bar
	switch ($navcolour) {
		case "pink":
			$nav_bg_1 = "#FFC1CA"; $nav_bg_2 = "#FFC1CA"; break;
		case "green":
			$nav_bg_1 = "#5CD65C"; $nav_bg_2 = "#5CD65C"; break;
		case "blue":
			$nav_bg_1 = "#186292"; $nav_bg_2 = "#1892d2"; break;
		case "purple":
			$nav_bg_1 = "#551A8B"; $nav_bg_2 = "#551A8B"; break;
		case "black":
			$nav_bg_1 = "#000";    $nav_bg_2 = "#222";    break;
		case "orange":
			$nav_bg_1 = "#FF3D0D"; $nav_bg_2 = "#FF3D0D"; break;
		case "brown":
			$nav_bg_1 = "#330000"; $nav_bg_2 = "#330000"; break;
		case "grey":
			$nav_bg_1 = "#2e2f2e"; $nav_bg_2 = "#2e2f2e"; break;
		case "gold":
			$nav_bg_1 = "#FFAA00"; $nav_bg_2 = "#FFAA00"; break;
		case "red": // red is the default
		default:
			$nav_bg_1 = "#f00";    $nav_bg_2 = "#b00";    break;
	}
	logger("navbg1: $nav_bg_1, navbg2: $nav_bg_2");

	// now print our stuff
	echo
		// navbar colours
		"
			nav {
				background-image: linear-gradient(bottom, $nav_bg_1 26%, $nav_bg_2 82%);
				background-image: -o-linear-gradient(bottom, $nav_bg_1 26%, $nav_bg_2 82%);
				background-image: -moz-linear-gradient(bottom, $nav_bg_1 26%, $nav_bg_2 82%) !important;
				background-image: -webkit-linear-gradient(bottom, $nav_bg_1 26%, $nav_bg_2 82%);
				background-image: -ms-linear-gradient(bottom, $nav_bg_1 26%, $nav_bg_2 82%);
			}
		" .

		// if we have nav_bg_3 and 4 colors, use them for hover
		(($nav_bg_3 and $nav_bg_4) ? "
			nav:hover {
				background-image: linear-gradient(bottom, $nav_bg_3 26%, $nav_bg_4 82%);
				background-image: -o-linear-gradient(bottom, $nav_bg_3 26%, $nav_bg_4 82%);
				background-image: -moz-linear-gradient(bottom, $nav_bg_3 26%, $nav_bg_4 82%) !important;
				background-image: -webkit-linear-gradient(bottom, $nav_bg_3 26%, $nav_bg_4 82%);
				background-image: -ms-linear-gradient(bottom, $nav_bg_3 26%, $nav_bg_4 82%);
			}
		" : "") .

		// font size
		"
			.wall-item-content {
				font-size: ${blogbasic_font_size}px;
			}
		" .

		// line height
		"
			.wall-item-content {
				line-height: $line_height;
			}
		" .

		// Minimum value shadows - they shouldn't all be the same size; just get it working, clean up later.
		($shadows === "true" ? "
			code, blockquote, .wall-item-content-wrapper,
			.wall-item-content-wrapper.comment, .wall-item-content img, #profile-jot-perms,
			#profile-jot-submit, .tab, .tab.active, .settings-widget li, .wall-item-photo,
			.photo, .contact-block-img, .my-comment-photo, #posted-date-selector:hover,
			.contact-entry-photo img, .profile-match-photo img, #photo-photo img,
			.directory-photo-img, .photo-album-photo, .photo-top-photo, .group-selected,
			.nets-selected, .fileas-selected, .categories-selected {
				box-shadow: 5px 5px 5px #111;
			}

			.tab.active, #jot-title, #jot-category, .comment-edit-text-empty,
			.comment-edit-text-full, iframe#profile-jot-text_ifr, #profile-jot-text {
				box-shadow: 5px 5px 5px #666 inset;
			}
		" : "") .

		// background
		($background ? "
			body {
				background-image: url('${background}')!important;
				background-repeat: repeat;
				background-attachment: fixed;
			}
		" : "") .

		// section and aside bg color
		($asect ? "
			section, aside, right_aside, #nav-search-text {
				background-color: #$asect!important;
			}
		" : "") .

		// section and aside bg opacity
		($asectopacity ? "
			section, aside, right_aside, #nav-search-text {
				opacity: $asectopacity!important;
			}
		" : "") .

		// section and aside font color
		($astext ? "
			section, aside, right_aside, #nav-search-text {
				color: #$astext!important;
			}
		" : "") .

		// link colour
		($linkcolour != false ? "
			a, a:visited, a:link, .fakelink, .fakelink:visited, .fakelink:link {
				color: #$linkcolour;
			}
		" : "")
	;



// 0xAF: please leave the vim modeline here
// vim: set tabstop=4 shiftwidth=4 softtabstop=4 sidescroll=4 noet :


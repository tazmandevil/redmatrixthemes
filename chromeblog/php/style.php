<?php
// theme: basicblog
// by tazman@red.tazmandevil.info

	$uid = get_theme_uid();

	if($uid)
	    load_pconfig($uid,'chromeblog');

    $line_height = false;
    $chromeblog_font_size = false;
    $resolution = false;
    $navcolour = false;
    $linkcolour = false;
	$radius = 5;
    $site_line_height = get_config("chromeblog","line_height");
    $site_chromeblog_font_size = get_config("chromeblog", "font_size" );
    $navcolour = get_config("chromeblog", "navcolour" );
    $linkcolour = get_config("chromeblog", "linkcolour" );
    $background = false;

	$x = get_config('chromeblog','radius');
	if($x !== false)
		$radius = $x;
    
    if ($uid) {
        $background = get_pconfig($uid, "chromeblog", "background");
        $line_height = get_pconfig($uid, "chromeblog","line_height");
        $chromeblog_font_size = get_pconfig($uid, "chromeblog", "font_size");
        $navcolour = get_pconfig($uid, "chromeblog", "navcolour");
        $linkcolour = get_pconfig($uid, "chromeblog", "linkcolour");
		$x = get_pconfig($uid,'chromeblog','radius');
		if($x !== false)
			$radius = $x;

    // In non-expert mode, we just let them choose font size, line height, and a colour scheme.  A colour scheme is just a pre-defined set of the above variables.
    // But only apply these settings in non-expert mode to prevent confusion when turning expert mode on and off.
    if(! feature_enabled($uid,'expert')) {
	    if ($colour_scheme === 'chromeblog'){$navcolour = 'red';}
		$shadows = false;
		$radius = 5;
}

// background
	if($background) {
		echo "body {
				background: url('${background}');
				background-repeat: repeat;
				background-attachment: fixed;
				
			}";
	}

// This is probably the easiest place to apply global settings.  Don't bother with site line height and such.  Instead, check pconfig for global user settings.  
// eg, if ($chromeblog_font_size === false) {$chromeblog_font_size = get_pconfig($uid, "global", "font_size");  If it's not set, we'll just use the CSS with no changes.
// Then all you need to do is add a "Global Settings" tab to settings/display, and make an equivalent of theme_settings.tpl and config.php to be loaded there.  Easy.

    if ($line_height === false) {$line_height = $site_line_height;}
    if ($line_height === false) {$line_height = "1.2";}
    if ($chromeblog_font_size === false) {$chromeblog_font_size = $site_chromeblog_font_size;}
    if ($chromeblog_font_size === false) {$chromeblog_font_size = "12";}
	    if ($navcolour === "black") {$nav_bg_1 = "000";
			      $nav_bg_2 = "2e2f2e";}

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
    echo "\r\n";


// Enforce sane limits for expert mode - otherwise we'll end up with "experts" who think font size is a percentage.

	if(($chromeblog_font_size >= 8.0) && ($chromeblog_font_size <= 20.0)) {
		echo ".wall-item-content { font-size: ${chromeblog_font_size}px;}\r\n";
	}

	if(($line_height >= 1.0) && ($line_height <= 2.0)) {
		echo ".wall-item-content { line-height: $line_height; }\r\n";
	}	
	
// Since every change would otherwise require five lines, it's simpler to just set a default and echo this without first checking if we've set it.  
	echo "nav {background-image: linear-gradient(bottom, #$nav_bg_1 26%, #$nav_bg_2 82%);
	      background-image: -o-linear-gradient(bottom, #$nav_bg_1 26%, #$nav_bg_2 82%);
	      background-image: -moz-linear-gradient(bottom, #$nav_bg_1 26%, #$nav_bg_2 82%) !important;
	      background-image: -webkit-linear-gradient(bottom, #$nav_bg_1 26%, #$nav_bg_2 82%);
	      background-image: -ms-linear-gradient(bottom, #$nav_bg_1 26%, #$nav_bg_2 82%);}";

	if($navcolour === false || $navcolour === 'red') {
		echo "nav:hover {background-image: linear-gradient(bottom, #$nav_bg_3 26%, #$nav_bg_4 82%);
	      background-image: -o-linear-gradient(bottom, #$nav_bg_3 26%, #$nav_bg_4 82%);
	      background-image: -moz-linear-gradient(bottom, #$nav_bg_3 26%, #$nav_bg_4 82%) !important;
	      background-image: -webkit-linear-gradient(bottom, #$nav_bg_3 26%, #$nav_bg_4 82%);
	      background-image: -ms-linear-gradient(bottom, #$nav_bg_3 26%, #$nav_bg_4 82%);}";
	}

// Put the # here to force hex colours - if we don't, somebody is going to do something odd, using RGB and we're all going to be confused on the support forums
// until one of us works out what they've done.

	  if ($linkcolour != false) {
		    echo "a, a:visited, a:link, .fakelink, .fakelink:visited, .fakelink:link {color: #$linkcolour;}\r\n";
	}
    }	

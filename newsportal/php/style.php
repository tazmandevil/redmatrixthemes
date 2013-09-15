<?php
  // This needs changing now, if we're going for global settings.  Admin settings have been removed in preparation, You *should* just be able to remove all 
  // the get_config bits, though this is untested.  
  // We also need to eventually.  Use the page owners settings for everybody - get_pconfig(page_owner()) or whatever that would look like.


	$uid = get_theme_uid();

	if($uid)
	    load_pconfig($uid,'newsportal');

    $line_height = false;
    $newsportal_font_size = false;
    $resolution = false;
    $navcolour = false;
    $nav_bg_1 = "f88";
    $nav_bg_2 = "b00";
	$nav_bg_3 = "f00";
	$nav_bg_4 = "b00";
    $site_line_height = get_config("newsportal","line_height");
    $site_newsportal_font_size = get_config("newsportal", "font_size" );
    $navcolour = get_config("newsportal", "navcolour" );
    
    if ($uid) {
        $line_height = get_pconfig($uid, "newsportal","line_height");
        $newsportal_font_size = get_pconfig($uid, "newsportal", "font_size");
        $navcolour = get_pconfig($uid, "newsportal", "navcolour");

        if (! feature_enabled($uid,'expert')) {$colour_scheme = get_pconfig($uid, "newsportal", "colour_scheme");}
    }

    // In non-expert mode, we just let them choose font size, line height, and a colour scheme.  A colour scheme is just a pre-defined set of the above variables.
    // But only apply these settings in non-expert mode to prevent confusion when turning expert mode on and off.
    if(! feature_enabled($uid,'expert')) {
	    if ($colour_scheme === 'newsportal'){$navcolour = 'red';}
		$shadows = false;
}

// This is probably the easiest place to apply global settings.  Don't bother with site line height and such.  Instead, check pconfig for global user settings.  
// eg, if ($newsportal_font_size === false) {$newsportal_font_size = get_pconfig($uid, "global", "font_size");  If it's not set, we'll just use the CSS with no changes.
// Then all you need to do is add a "Global Settings" tab to settings/display, and make an equivalent of theme_settings.tpl and config.php to be loaded there.  Easy.

    if ($line_height === false) {$line_height = $site_line_height;}
    if ($line_height === false) {$line_height = "1.2";}
    if ($newsportal_font_size === false) {$newsportal_font_size = $site_newsportal_font_size;}
    if ($newsportal_font_size === false) {$newsportal_font_size = "12";}
    if ($colour === false) {$colour = $site_colour;}
    if ($colour === false) {$colour = "light";}
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

	if(($newsportal_font_size >= 8.0) && ($newsportal_font_size <= 20.0)) {
		echo ".wall-item-content { font-size: ${newsportal_font_size}px;}\r\n";
	}

	if(($line_height >= 1.0) && ($line_height <= 2.0)) {
		echo ".wall-item-content { line-height: $line_height; }\r\n";
	}	


// Minimum value shadows - they shouldn't all be the same size; just get it working, clean up later.
	if($shadows === "true") {
		echo "code, blockquote, .wall-item-content-wrapper, .wall-item-content-wrapper.comment, .wall-item-content img, #profile-jot-perms, #profile-jot-submit, .tab, .tab.active, .settings-widget li, .wall-item-photo, .photo, .contact-block-img, .my-comment-photo, #posted-date-selector:hover, .contact-entry-photo img, .profile-match-photo img, #photo-photo img, .directory-photo-img, .photo-album-photo, .photo-top-photo, .group-selected, .nets-selected, .fileas-selected, .categories-selected {
		box-shadow: 5px 5px 5px #111;}\r\n
		
		.tab.active, #jot-title, #jot-category, .comment-edit-text-empty, .comment-edit-text-full, iframe#profile-jot-text_ifr, #profile-jot-text {
		box-shadow: 5px 5px 5px #666 inset;}\r\n";
	
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


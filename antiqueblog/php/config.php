<?php
/**
 * antiqueblog theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$background = get_pconfig(local_user(), 'antiqueblog', 'background' );
	$font_size = get_pconfig(local_user(),'antiqueblog', 'font_size' );
	$item_colour = get_pconfig(local_user(), 'antiqueblog', 'colour' );
	$line_height = get_pconfig(local_user(), 'antiqueblog', 'line_height' );
	$colour = get_pconfig(local_user(), 'antiqueblog', 'colour' );
	$shadow = get_pconfig(local_user(), 'antiqueblog', 'shadow' );
	$navcolour = get_pconfig(local_user(), 'antiqueblog', 'navcolour');
	$displaystyle = get_pconfig(local_user(), 'antiqueblog', 'displaystyle');
	$linkcolour = get_pconfig(local_user(), 'antiqueblog', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'antiqueblog', 'iconset');
	$shiny = get_pconfig(local_user(), 'antiqueblog', 'shiny');
	$colour_scheme = get_pconfig(local_user(), 'antiqueblog', 'colour_scheme');
	$radius = get_pconfig(local_user(),'antiqueblog','radius');

	return antiqueblog_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['antiqueblog-settings-submit'])) {
		set_pconfig(local_user(), 'antiqueblog', 'font_size', $_POST['antiqueblog_font_size']);
		set_pconfig(local_user(), 'antiqueblog', 'background', $_POST['antiqueblog_background']);	

		set_pconfig(local_user(), 'antiqueblog', 'colour', $_POST['antiqueblog_item_colour']);	

		set_pconfig(local_user(), 'antiqueblog', 'font_colour', $_POST['antiqueblog_font_colour']);
		set_pconfig(local_user(), 'antiqueblog', 'line_height', $_POST['antiqueblog_line_height']);
		set_pconfig(local_user(), 'antiqueblog', 'colour', $_POST['antiqueblog_colour']);	
		set_pconfig(local_user(), 'antiqueblog', 'shadow', $_POST['antiqueblog_shadow']);	
		set_pconfig(local_user(), 'antiqueblog', 'navcolour', $_POST['antiqueblog_navcolour']);
		set_pconfig(local_user(), 'antiqueblog', 'displaystyle', $_POST['antiqueblog_displaystyle']);
		set_pconfig(local_user(), 'antiqueblog', 'linkcolour', $_POST['antiqueblog_linkcolour']);
		set_pconfig(local_user(), 'antiqueblog', 'iconset', $_POST['antiqueblog_iconset']);
		set_pconfig(local_user(), 'antiqueblog', 'shiny', $_POST['antiqueblog_shiny']);
		set_pconfig(local_user(), 'antiqueblog', 'colour_scheme', $_POST['antiqueblog_colour_scheme']);
		set_pconfig(local_user(), 'antiqueblog', 'radius', $_POST['antiqueblog_radius']);
	}

}

function antiqueblog_form(&$a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius) {
	$line_heights = array(
		"1.3" => "1.3",
		"---" => "---",
		"1.6" => "1.6",				
		"1.5" => "1.5",		
		"1.4" => "1.4",
		"1.2" => "1.2",
		"1.1" => "1.1",
	);	
	$font_sizes = array(
		'12' => '12',
		'14' => '14',
		"---" => "---",
		"16" => "16",		
		"15" => "15",
		'13.5' => '13.5',
		'13' => '13',		
		'12.5' => '12.5',
		'12' => '12',
	);
	$colours = array(
		'light' => 'light',		
		'dark' => 'dark',						
	);

	$colour_schemes = array(
		'antiqueblog' => 'antiqueblog',		
	);
	$shadows = array(
		  'true' => 'Yes',
		  'false' => 'No',
	);

	$navcolours = array (
		  'red' => 'red',
		  'black' => 'black',	
		  'blue' => 'blue',
		  'green' => 'green',
	);
	
	$displaystyles = array (
		    'fancy' => 'fancy',
		    'classic' => 'classic',
	);
	
	$linkcolours = array (
		    'blue' => 'blue',
		    'red' => 'red',
	);
	
	$iconsets = array (
		    'default' => 'default',
	);
	
	$shinys = array (
		    'none' => 'none',
		    'opaque' => 'opaque',
	);
	if(feature_enabled(local_user(),'expert')) {
	  $t = get_markup_template('theme_settings.tpl');
	  $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('antiqueblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('antiqueblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour' => array('antiqueblog_colour', t('Set colour scheme'), $colour, '', $colours),	
		'$shadow' => array('antiqueblog_shadow', t('Draw shadows'), $shadow, '', $shadows),
		'$navcolour' => array('antiqueblog_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$displaystyle' => array('antiqueblog_displaystyle', t('Display style'), $displaystyle, '', $displaystyles),
		'$linkcolour' => array('antiqueblog_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('antiqueblog_iconset', t('Icons'), $iconset, '', $iconsets),
		'$shiny' => array('antiqueblog_shiny', t('Shiny style'), $shiny, '', $shinys),
		'$radius' => array('antiqueblog_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('antiqueblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$background' => array('antiqueblog_background', t('Set background image'), $background, '', $backgrounds),	
		'$nav' => array('antiqueblog_nav', t('Colour of the navigation bar'), $nav, '', $navs),
		'$line_height' => array('antiqueblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour_scheme' => array('antiqueblog_colour_scheme', t('Set colour scheme'), $colour_scheme, '', $colour_schemes),	
	 ));}
	 
	return $o;
}


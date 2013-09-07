<?php
/**
 * Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'tazblog', 'font_size' );
	$line_height = get_pconfig(local_user(), 'tazblog', 'line_height' );
	$colour = get_pconfig(local_user(), 'tazblog', 'colour' );
	$shadow = get_pconfig(local_user(), 'tazblog', 'shadow' );
	$navcolour = get_pconfig(local_user(), 'tazblog', 'navcolour');
	$displaystyle = get_pconfig(local_user(), 'tazblog', 'displaystyle');
	$linkcolour = get_pconfig(local_user(), 'tazblog', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'tazblog', 'iconset');
	$shiny = get_pconfig(local_user(), 'tazblog', 'shiny');
	$colour_scheme = get_pconfig(local_user(), 'tazblog', 'colour_scheme');
	$radius = get_pconfig(local_user(),'tazblog','radius');

	return tazblog_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['tazblog-settings-submit'])) {
		set_pconfig(local_user(), 'tazblog', 'font_size', $_POST['tazblog_font_size']);
		set_pconfig(local_user(), 'tazblog', 'line_height', $_POST['tazblog_line_height']);
		set_pconfig(local_user(), 'tazblog', 'colour', $_POST['tazblog_colour']);	
		set_pconfig(local_user(), 'tazblog', 'shadow', $_POST['tazblog_shadow']);	
		set_pconfig(local_user(), 'tazblog', 'navcolour', $_POST['tazblog_navcolour']);
		set_pconfig(local_user(), 'tazblog', 'displaystyle', $_POST['tazblog_displaystyle']);
		set_pconfig(local_user(), 'tazblog', 'linkcolour', $_POST['tazblog_linkcolour']);
		set_pconfig(local_user(), 'tazblog', 'iconset', $_POST['tazblog_iconset']);
		set_pconfig(local_user(), 'tazblog', 'shiny', $_POST['tazblog_shiny']);
		set_pconfig(local_user(), 'tazblog', 'colour_scheme', $_POST['tazblog_colour_scheme']);
		set_pconfig(local_user(), 'tazblog', 'radius', $_POST['tazblog_radius']);
	}

}

// We probably don't want these if we're having global settings, but we'll comment out for now, just in case
//function theme_admin(&$a) {	$font_size = get_config('tazblog', 'font_size' );
//	$line_height = get_config('tazblog', 'line_height' );
//	$colour = get_config('tazblog', 'colour' );	
//	$shadow = get_config('tazblog', 'shadow' );	
//	$navcolour = get_config('tazblog', 'navcolour' );
//	$opaquenav = get_config('tazblog', 'opaquenav' );
//	$itemstyle = get_config('tazblog', 'itemstyle' );
//	$linkcolour = get_config('tazblog', 'linkcolour' );
//	$iconset = get_config('tazblog', 'iconset' );
//	$shiny = get_config('tazblog', 'shiny' );
//	
//	return tazblog_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $itemstyle, $linkcolour, $iconset, $shiny);
//}

//function theme_admin_post(&$a) {
//	if (isset($_POST['tazblog-settings-submit'])) {
//		set_config('tazblog', 'font_size', $_POST['tazblog_font_size']);
//		set_config('tazblog', 'line_height', $_POST['tazblog_line_height']);
//		set_config('tazblog', 'colour', $_POST['tazblog_colour']);
//		set_config('tazblog', 'shadow', $_POST['tazblog_shadow']);
//		set_config('tazblog', 'navcolour', $_POST['tazblog_navcolour']);
//		set_config('tazblog', 'opaquenav', $_POST['tazblog_opaquenav']);
//		set_config('tazblog', 'itemstyle', $_POST['tazblog_itemstyle']);
//		set_config('tazblog', 'linkcolour', $_POST['tazblog_linkcolour']);
//		set_config('tazblog', 'iconset', $_POST['tazblog_iconset']);
//		set_config('tazblog', 'shiny', $_POST['tazblog_shiny']);
//	}
//}

// These aren't all used yet, but they're not bloat - we'll use drop down menus in idiot mode.
function tazblog_form(&$a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius) {
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
		'tazblog' => 'tazblog',		
		'fancyred' => 'fancyred',						
		'dark' => 'dark',	
	);
	$shadows = array(
		  'true' => 'Yes',
		  'false' => 'No',
	);

	$navcolours = array (
		  'red' => 'red',
		  'black' => 'black',	
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
		'$font_size' => array('tazblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('tazblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour' => array('tazblog_colour', t('Set colour scheme'), $colour, '', $colours),	
		'$shadow' => array('tazblog_shadow', t('Draw shadows'), $shadow, '', $shadows),
		'$navcolour' => array('tazblog_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$displaystyle' => array('tazblog_displaystyle', t('Display style'), $displaystyle, '', $displaystyles),
		'$linkcolour' => array('tazblog_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('tazblog_iconset', t('Icons'), $iconset, '', $iconsets),
		'$shiny' => array('tazblog_shiny', t('Shiny style'), $shiny, '', $shinys),
		'$radius' => array('tazblog_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('tazblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('tazblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour_scheme' => array('tazblog_colour_scheme', t('Set colour scheme'), $colour_scheme, '', $colour_schemes),	
	 ));}
	 
	return $o;
}


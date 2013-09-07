<?php
/**
 * Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'redblog', 'font_size' );
	$line_height = get_pconfig(local_user(), 'redblog', 'line_height' );
	$colour = get_pconfig(local_user(), 'redblog', 'colour' );
	$shadow = get_pconfig(local_user(), 'redblog', 'shadow' );
	$navcolour = get_pconfig(local_user(), 'redblog', 'navcolour');
	$displaystyle = get_pconfig(local_user(), 'redblog', 'displaystyle');
	$linkcolour = get_pconfig(local_user(), 'redblog', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'redblog', 'iconset');
	$shiny = get_pconfig(local_user(), 'redblog', 'shiny');
	$colour_scheme = get_pconfig(local_user(), 'redblog', 'colour_scheme');
	$radius = get_pconfig(local_user(),'redblog','radius');

	return redblog_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['redblog-settings-submit'])) {
		set_pconfig(local_user(), 'redblog', 'font_size', $_POST['redblog_font_size']);
		set_pconfig(local_user(), 'redblog', 'line_height', $_POST['redblog_line_height']);
		set_pconfig(local_user(), 'redblog', 'colour', $_POST['redblog_colour']);	
		set_pconfig(local_user(), 'redblog', 'shadow', $_POST['redblog_shadow']);	
		set_pconfig(local_user(), 'redblog', 'navcolour', $_POST['redblog_navcolour']);
		set_pconfig(local_user(), 'redblog', 'displaystyle', $_POST['redblog_displaystyle']);
		set_pconfig(local_user(), 'redblog', 'linkcolour', $_POST['redblog_linkcolour']);
		set_pconfig(local_user(), 'redblog', 'iconset', $_POST['redblog_iconset']);
		set_pconfig(local_user(), 'redblog', 'shiny', $_POST['redblog_shiny']);
		set_pconfig(local_user(), 'redblog', 'colour_scheme', $_POST['redblog_colour_scheme']);
		set_pconfig(local_user(), 'redblog', 'radius', $_POST['redblog_radius']);
	}

}

// We probably don't want these if we're having global settings, but we'll comment out for now, just in case
//function theme_admin(&$a) {	$font_size = get_config('redblog', 'font_size' );
//	$line_height = get_config('redblog', 'line_height' );
//	$colour = get_config('redblog', 'colour' );	
//	$shadow = get_config('redblog', 'shadow' );	
//	$navcolour = get_config('redblog', 'navcolour' );
//	$opaquenav = get_config('redblog', 'opaquenav' );
//	$itemstyle = get_config('redblog', 'itemstyle' );
//	$linkcolour = get_config('redblog', 'linkcolour' );
//	$iconset = get_config('redblog', 'iconset' );
//	$shiny = get_config('redblog', 'shiny' );
//	
//	return redblog_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $itemstyle, $linkcolour, $iconset, $shiny);
//}

//function theme_admin_post(&$a) {
//	if (isset($_POST['redblog-settings-submit'])) {
//		set_config('redblog', 'font_size', $_POST['redblog_font_size']);
//		set_config('redblog', 'line_height', $_POST['redblog_line_height']);
//		set_config('redblog', 'colour', $_POST['redblog_colour']);
//		set_config('redblog', 'shadow', $_POST['redblog_shadow']);
//		set_config('redblog', 'navcolour', $_POST['redblog_navcolour']);
//		set_config('redblog', 'opaquenav', $_POST['redblog_opaquenav']);
//		set_config('redblog', 'itemstyle', $_POST['redblog_itemstyle']);
//		set_config('redblog', 'linkcolour', $_POST['redblog_linkcolour']);
//		set_config('redblog', 'iconset', $_POST['redblog_iconset']);
//		set_config('redblog', 'shiny', $_POST['redblog_shiny']);
//	}
//}

// These aren't all used yet, but they're not bloat - we'll use drop down menus in idiot mode.
function redblog_form(&$a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius) {
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
		'redblog' => 'redblog',		
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
		'$font_size' => array('redblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('redblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour' => array('redblog_colour', t('Set colour scheme'), $colour, '', $colours),	
		'$shadow' => array('redblog_shadow', t('Draw shadows'), $shadow, '', $shadows),
		'$navcolour' => array('redblog_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$displaystyle' => array('redblog_displaystyle', t('Display style'), $displaystyle, '', $displaystyles),
		'$linkcolour' => array('redblog_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('redblog_iconset', t('Icons'), $iconset, '', $iconsets),
		'$shiny' => array('redblog_shiny', t('Shiny style'), $shiny, '', $shinys),
		'$radius' => array('redblog_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('redblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('redblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour_scheme' => array('redblog_colour_scheme', t('Set colour scheme'), $colour_scheme, '', $colour_schemes),	
	 ));}
	 
	return $o;
}


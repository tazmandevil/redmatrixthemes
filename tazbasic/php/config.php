<?php
/**
 * Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'tazbasic', 'font_size' );
	$line_height = get_pconfig(local_user(), 'tazbasic', 'line_height' );
	$colour = get_pconfig(local_user(), 'tazbasic', 'colour' );
	$shadow = get_pconfig(local_user(), 'tazbasic', 'shadow' );
	$navcolour = get_pconfig(local_user(), 'tazbasic', 'navcolour');
	$displaystyle = get_pconfig(local_user(), 'tazbasic', 'displaystyle');
	$linkcolour = get_pconfig(local_user(), 'tazbasic', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'tazbasic', 'iconset');
	$shiny = get_pconfig(local_user(), 'tazbasic', 'shiny');
	$colour_scheme = get_pconfig(local_user(), 'tazbasic', 'colour_scheme');
	$radius = get_pconfig(local_user(),'tazbasic','radius');

	return tazbasic_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['tazbasic-settings-submit'])) {
		set_pconfig(local_user(), 'tazbasic', 'font_size', $_POST['tazbasic_font_size']);
		set_pconfig(local_user(), 'tazbasic', 'line_height', $_POST['tazbasic_line_height']);
		set_pconfig(local_user(), 'tazbasic', 'colour', $_POST['tazbasic_colour']);	
		set_pconfig(local_user(), 'tazbasic', 'shadow', $_POST['tazbasic_shadow']);	
		set_pconfig(local_user(), 'tazbasic', 'navcolour', $_POST['tazbasic_navcolour']);
		set_pconfig(local_user(), 'tazbasic', 'displaystyle', $_POST['tazbasic_displaystyle']);
		set_pconfig(local_user(), 'tazbasic', 'linkcolour', $_POST['tazbasic_linkcolour']);
		set_pconfig(local_user(), 'tazbasic', 'iconset', $_POST['tazbasic_iconset']);
		set_pconfig(local_user(), 'tazbasic', 'shiny', $_POST['tazbasic_shiny']);
		set_pconfig(local_user(), 'tazbasic', 'colour_scheme', $_POST['tazbasic_colour_scheme']);
		set_pconfig(local_user(), 'tazbasic', 'radius', $_POST['tazbasic_radius']);
	}

}

// We probably don't want these if we're having global settings, but we'll comment out for now, just in case
//function theme_admin(&$a) {	$font_size = get_config('tazbasic', 'font_size' );
//	$line_height = get_config('tazbasic', 'line_height' );
//	$colour = get_config('tazbasic', 'colour' );	
//	$shadow = get_config('tazbasic', 'shadow' );	
//	$navcolour = get_config('tazbasic', 'navcolour' );
//	$opaquenav = get_config('tazbasic', 'opaquenav' );
//	$itemstyle = get_config('tazbasic', 'itemstyle' );
//	$linkcolour = get_config('tazbasic', 'linkcolour' );
//	$iconset = get_config('tazbasic', 'iconset' );
//	$shiny = get_config('tazbasic', 'shiny' );
//	
//	return tazbasic_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $itemstyle, $linkcolour, $iconset, $shiny);
//}

//function theme_admin_post(&$a) {
//	if (isset($_POST['tazbasic-settings-submit'])) {
//		set_config('tazbasic', 'font_size', $_POST['tazbasic_font_size']);
//		set_config('tazbasic', 'line_height', $_POST['tazbasic_line_height']);
//		set_config('tazbasic', 'colour', $_POST['tazbasic_colour']);
//		set_config('tazbasic', 'shadow', $_POST['tazbasic_shadow']);
//		set_config('tazbasic', 'navcolour', $_POST['tazbasic_navcolour']);
//		set_config('tazbasic', 'opaquenav', $_POST['tazbasic_opaquenav']);
//		set_config('tazbasic', 'itemstyle', $_POST['tazbasic_itemstyle']);
//		set_config('tazbasic', 'linkcolour', $_POST['tazbasic_linkcolour']);
//		set_config('tazbasic', 'iconset', $_POST['tazbasic_iconset']);
//		set_config('tazbasic', 'shiny', $_POST['tazbasic_shiny']);
//	}
//}

// These aren't all used yet, but they're not bloat - we'll use drop down menus in idiot mode.
function tazbasic_form(&$a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius) {
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
		'tazbasic' => 'tazbasic',		
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
		'$font_size' => array('tazbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('tazbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour' => array('tazbasic_colour', t('Set colour scheme'), $colour, '', $colours),	
		'$shadow' => array('tazbasic_shadow', t('Draw shadows'), $shadow, '', $shadows),
		'$navcolour' => array('tazbasic_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$displaystyle' => array('tazbasic_displaystyle', t('Display style'), $displaystyle, '', $displaystyles),
		'$linkcolour' => array('tazbasic_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('tazbasic_iconset', t('Icons'), $iconset, '', $iconsets),
		'$shiny' => array('tazbasic_shiny', t('Shiny style'), $shiny, '', $shinys),
		'$radius' => array('tazbasic_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('tazbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('tazbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour_scheme' => array('tazbasic_colour_scheme', t('Set colour scheme'), $colour_scheme, '', $colour_schemes),	
	 ));}
	 
	return $o;
}


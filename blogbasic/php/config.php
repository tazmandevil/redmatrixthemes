<?php
/**
 * Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'blogbasic', 'font_size' );
	$line_height = get_pconfig(local_user(), 'blogbasic', 'line_height' );
	$colour = get_pconfig(local_user(), 'blogbasic', 'colour' );
	$shadow = get_pconfig(local_user(), 'blogbasic', 'shadow' );
	$navcolour = get_pconfig(local_user(), 'blogbasic', 'navcolour');
	$displaystyle = get_pconfig(local_user(), 'blogbasic', 'displaystyle');
	$linkcolour = get_pconfig(local_user(), 'blogbasic', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'blogbasic', 'iconset');
	$shiny = get_pconfig(local_user(), 'blogbasic', 'shiny');
	$colour_scheme = get_pconfig(local_user(), 'blogbasic', 'colour_scheme');
	$radius = get_pconfig(local_user(),'blogbasic','radius');

	return blogbasic_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['blogbasic-settings-submit'])) {
		set_pconfig(local_user(), 'blogbasic', 'font_size', $_POST['blogbasic_font_size']);
		set_pconfig(local_user(), 'blogbasic', 'line_height', $_POST['blogbasic_line_height']);
		set_pconfig(local_user(), 'blogbasic', 'colour', $_POST['blogbasic_colour']);	
		set_pconfig(local_user(), 'blogbasic', 'shadow', $_POST['blogbasic_shadow']);	
		set_pconfig(local_user(), 'blogbasic', 'navcolour', $_POST['blogbasic_navcolour']);
		set_pconfig(local_user(), 'blogbasic', 'displaystyle', $_POST['blogbasic_displaystyle']);
		set_pconfig(local_user(), 'blogbasic', 'linkcolour', $_POST['blogbasic_linkcolour']);
		set_pconfig(local_user(), 'blogbasic', 'iconset', $_POST['blogbasic_iconset']);
		set_pconfig(local_user(), 'blogbasic', 'shiny', $_POST['blogbasic_shiny']);
		set_pconfig(local_user(), 'blogbasic', 'colour_scheme', $_POST['blogbasic_colour_scheme']);
		set_pconfig(local_user(), 'blogbasic', 'radius', $_POST['blogbasic_radius']);
	}

}

// We probably don't want these if we're having global settings, but we'll comment out for now, just in case
//function theme_admin(&$a) {	$font_size = get_config('blogbasic', 'font_size' );
//	$line_height = get_config('blogbasic', 'line_height' );
//	$colour = get_config('blogbasic', 'colour' );	
//	$shadow = get_config('blogbasic', 'shadow' );	
//	$navcolour = get_config('blogbasic', 'navcolour' );
//	$opaquenav = get_config('blogbasic', 'opaquenav' );
//	$itemstyle = get_config('blogbasic', 'itemstyle' );
//	$linkcolour = get_config('blogbasic', 'linkcolour' );
//	$iconset = get_config('blogbasic', 'iconset' );
//	$shiny = get_config('blogbasic', 'shiny' );
//	
//	return blogbasic_form($a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $itemstyle, $linkcolour, $iconset, $shiny);
//}

//function theme_admin_post(&$a) {
//	if (isset($_POST['blogbasic-settings-submit'])) {
//		set_config('blogbasic', 'font_size', $_POST['blogbasic_font_size']);
//		set_config('blogbasic', 'line_height', $_POST['blogbasic_line_height']);
//		set_config('blogbasic', 'colour', $_POST['blogbasic_colour']);
//		set_config('blogbasic', 'shadow', $_POST['blogbasic_shadow']);
//		set_config('blogbasic', 'navcolour', $_POST['blogbasic_navcolour']);
//		set_config('blogbasic', 'opaquenav', $_POST['blogbasic_opaquenav']);
//		set_config('blogbasic', 'itemstyle', $_POST['blogbasic_itemstyle']);
//		set_config('blogbasic', 'linkcolour', $_POST['blogbasic_linkcolour']);
//		set_config('blogbasic', 'iconset', $_POST['blogbasic_iconset']);
//		set_config('blogbasic', 'shiny', $_POST['blogbasic_shiny']);
//	}
//}

// These aren't all used yet, but they're not bloat - we'll use drop down menus in idiot mode.
function blogbasic_form(&$a, $font_size, $line_height, $colour, $shadow, $navcolour, $opaquenav, $displaystyle, $linkcolour, $iconset, $shiny, $colour_scheme,$radius) {
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
		'blogbasic' => 'blogbasic',		
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
		'$font_size' => array('blogbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('blogbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour' => array('blogbasic_colour', t('Set colour scheme'), $colour, '', $colours),	
		'$shadow' => array('blogbasic_shadow', t('Draw shadows'), $shadow, '', $shadows),
		'$navcolour' => array('blogbasic_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$displaystyle' => array('blogbasic_displaystyle', t('Display style'), $displaystyle, '', $displaystyles),
		'$linkcolour' => array('blogbasic_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('blogbasic_iconset', t('Icons'), $iconset, '', $iconsets),
		'$shiny' => array('blogbasic_shiny', t('Shiny style'), $shiny, '', $shinys),
		'$radius' => array('blogbasic_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('blogbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('blogbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$colour_scheme' => array('blogbasic_colour_scheme', t('Set colour scheme'), $colour_scheme, '', $colour_schemes),	
	 ));}
	 
	return $o;
}


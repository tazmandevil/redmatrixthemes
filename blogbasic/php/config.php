<?php
/**
 * Blogbasic Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'blogbasic', 'font_size' );
	$background = get_pconfig(local_user(), 'blogbasic', 'background' );
	$line_height = get_pconfig(local_user(), 'blogbasic', 'line_height' );
	$navcolour = get_pconfig(local_user(), 'blogbasic', 'navcolour');
	$linkcolour = get_pconfig(local_user(), 'blogbasic', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'blogbasic', 'iconset');
	$radius = get_pconfig(local_user(),'blogbasic','radius' );
	$asect = get_pconfig(local_user(), 'blogbasic', 'asect' );
	$asectopacity = get_pconfig(local_user(), 'blogbasic', 'asectopacity' );
	$astext = get_pconfig(local_user(), 'blogbasic', 'astext' );
	$shadow = get_pconfig(local_user(), 'blogbasic', 'shadow' );

	return blogbasic_form($a, $font_size, $background, $line_height, $navcolour, $linkcolour, $iconset, $radius, $asect, $asectopacity, $astext, $shadow);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['blogbasic-settings-submit'])) {
		set_pconfig(local_user(), 'blogbasic', 'font_size', $_POST['blogbasic_font_size']);
		set_pconfig(local_user(), 'blogbasic', 'background', $_POST['blogbasic_background']);	
		set_pconfig(local_user(), 'blogbasic', 'line_height', $_POST['blogbasic_line_height']);
		set_pconfig(local_user(), 'blogbasic', 'navcolour', $_POST['blogbasic_navcolour']);
		set_pconfig(local_user(), 'blogbasic', 'linkcolour', $_POST['blogbasic_linkcolour']);
		set_pconfig(local_user(), 'blogbasic', 'iconset', $_POST['blogbasic_iconset']);
		set_pconfig(local_user(), 'blogbasic', 'radius', $_POST['blogbasic_radius']);
		set_pconfig(local_user(), 'blogbasic', 'asect', $_POST['blogbasic_asect']);
		set_pconfig(local_user(), 'blogbasic', 'asectopacity', $_POST['blogbasic_asectopacity']);
		set_pconfig(local_user(), 'blogbasic', 'astext', $_POST['blogbasic_astext']);
		set_pconfig(local_user(), 'blogbasic', 'shadow', $_POST['blogbasic_shadow']);	
	}

}

function blogbasic_form(&$a, $font_size, $background, $line_height, $navcolour, $linkcolour, $iconset, $radius, $asect, $asectopacity, $astext, $shadow) {
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

	$colour_schemes = array(
		'blogbasic' => 'blogbasic',		
	);

	$shadows = array(
		  'true' => 'Yes',
		  'false' => 'No',
	);


	$navcolours = array (
		  'red' => 'red',
		  'black' => 'black',	
	);
	
	$linkcolours = array (
		    'blue' => 'blue',
		    'red' => 'red',
	);
	
	$iconsets = array (
		    'default' => 'default',
	);
	
	if(feature_enabled(local_user(),'expert')) {
	  $t = get_markup_template('theme_settings.tpl');
	  $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('blogbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$background' => array('blogbasic_background', t('Set background image'), $background, '', $backgrounds),	
		'$line_height' => array('blogbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$navcolour' => array('blogbasic_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$linkcolour' => array('blogbasic_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('blogbasic_iconset', t('Icons'), $iconset, '', $iconsets),
		'$radius' => array('blogbasic_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
		'$asect' => array('blogbasic_asect', t('Section and Aside BG color (hex without #)'), $asect),
		'$asectopacity' => array('blogbasic_asectopacity', t('Section and Aside BG opacity (float: 0.80 - 1.00)'), $asectopacity),
		'$astext' => array('blogbasic_astext', t('Text color in Aside and Section (hex without #)'), $astext),
		'$shadow' => array('blogbasic_shadow', t('Draw shadows'), $shadow, '', $shadows),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('blogbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$background' => array('blogbasic_background', t('Set background image'), $background, '', $backgrounds),	
		'$line_height' => array('blogbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$nav' => array('blogbasic_nav', t('Colour of the navigation bar'), $nav, '', $navs),
		'$asectopacity' => array('blogbasic_asectopacity', t('Section and Aside BG opacity (float: 0.00 - 1.00)'), $asectopacity),
		'$astext' => array('blogbasic_astext', t('Text color in Aside and Section (hex without #)'), $astext),
		'$shadow' => array('blogbasic_shadow', t('Draw shadows'), $shadow, '', $shadows),
	 ));}
	 
	return $o;
}


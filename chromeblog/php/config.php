<?php
/**
 * chromeblog Theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'chromeblog', 'font_size' );
	$background = get_pconfig(local_user(), 'chromeblog', 'background' );
	$line_height = get_pconfig(local_user(), 'chromeblog', 'line_height' );
	$navcolour = get_pconfig(local_user(), 'chromeblog', 'navcolour');
	$linkcolour = get_pconfig(local_user(), 'chromeblog', 'linkcolour');
	$iconset = get_pconfig(local_user(), 'chromeblog', 'iconset');
	$radius = get_pconfig(local_user(),'chromeblog','radius');

	return chromeblog_form($a, $font_size, $background, $line_height, $navcolour, $linkcolour, $iconset, $radius);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['chromeblog-settings-submit'])) {
		set_pconfig(local_user(), 'chromeblog', 'font_size', $_POST['chromeblog_font_size']);
		set_pconfig(local_user(), 'chromeblog', 'background', $_POST['chromeblog_background']);	
		set_pconfig(local_user(), 'chromeblog', 'line_height', $_POST['chromeblog_line_height']);
		set_pconfig(local_user(), 'chromeblog', 'navcolour', $_POST['chromeblog_navcolour']);
		set_pconfig(local_user(), 'chromeblog', 'linkcolour', $_POST['chromeblog_linkcolour']);
		set_pconfig(local_user(), 'chromeblog', 'iconset', $_POST['chromeblog_iconset']);
		set_pconfig(local_user(), 'chromeblog', 'radius', $_POST['chromeblog_radius']);
	}

}

function chromeblog_form(&$a, $font_size, $background, $line_height, $navcolour, $linkcolour, $iconset, $radius) {
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
		'chromeblog' => 'chromeblog',		
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
		'$font_size' => array('chromeblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$background' => array('chromeblog_background', t('Set background image'), $background, '', $backgrounds),	
		'$line_height' => array('chromeblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$navcolour' => array('chromeblog_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
		'$linkcolour' => array('chromeblog_linkcolour', t('Display colour of links - hex value, do not include the #'), $linkcolour, '', $linkcolours),
		'$iconset' => array('chromeblog_iconset', t('Icons'), $iconset, '', $iconsets),
		'$radius' => array('chromeblog_radius', t('Corner radius'), $radius, t('0-99 default: 5')),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('chromeblog_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$background' => array('chromeblog_background', t('Set background image'), $background, '', $backgrounds),	
		'$line_height' => array('chromeblog_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$nav' => array('chromeblog_nav', t('Colour of the navigation bar'), $nav, '', $navs),
	 ));}
	 
	return $o;
}


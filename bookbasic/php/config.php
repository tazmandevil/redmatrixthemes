<?php
/**
 * bookbasic theme settings
 */

function theme_content(&$a) {
	// Doesn't yet work for anyone other than the channel owner, and stupid mode isn't finished, so return both for now.
	if(!local_user()) { return;	}
	$font_size = get_pconfig(local_user(),'bookbasic', 'font_size' );
	$line_height = get_pconfig(local_user(), 'bookbasic', 'line_height' );
	$navcolour = get_pconfig(local_user(), 'bookbasic', 'navcolour');

	return bookbasic_form($a, $font_size, $line_height, $navcolour);
}

function theme_post(&$a) {
	if(!local_user()) { return; }

	if (isset($_POST['bookbasic-settings-submit'])) {
		set_pconfig(local_user(), 'bookbasic', 'font_size', $_POST['bookbasic_font_size']);
		set_pconfig(local_user(), 'bookbasic', 'line_height', $_POST['bookbasic_line_height']);
		set_pconfig(local_user(), 'bookbasic', 'navcolour', $_POST['bookbasic_navcolour']);
	}

}

function bookbasic_form(&$a, $font_size, $line_height, $navcolour) {
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
	$navcolours = array (
		  'black' => 'black',	
		  'red' => 'red',	
	);
	
	$displaystyles = array (
		    'classic' => 'classic',
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
		'$font_size' => array('bookbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$line_height' => array('bookbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
		'$navcolour' => array('bookbasic_navcolour', t('Navigation bar colour'), $navcolour, '', $navcolours),
	  ));}
	 
	 if(! feature_enabled(local_user(),'expert')) {
	    $t = get_markup_template('basic_theme_settings.tpl');
	    $o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$font_size' => array('bookbasic_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$nav' => array('bookbasic_nav', t('Colour of the navigation bar'), $nav, '', $navs),
		'$line_height' => array('bookbasic_line_height', t('Set line-height for posts and comments'), $line_height, '', $line_heights),
	 ));}
	 
	return $o;
}


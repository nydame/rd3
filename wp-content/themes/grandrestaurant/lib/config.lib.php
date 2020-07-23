<?php
//Setup theme constant and default data
$theme_obj = wp_get_theme('grandrestaurant');

define("THEMENAME", $theme_obj['Name']);
define("THEMEDEMO", false);
define("SHORTNAME", "pp");
define("SKINSHORTNAME", "ps");
define("THEMEVERSION", $theme_obj['Version']);
define("THEMEDOMAIN", THEMENAME.'Language');
define("THEMEDEMOURL", $theme_obj['ThemeURI']);
define("THEMEDATEFORMAT", get_option('date_format'));
define("THEMETIMEFORMAT", get_option('time_format'));
define("ENVATOITEMID", 11812117);
define("BUILDERDOCURL", 'http://themes.themegoods.com/grandrestaurant/doc/create-a-page-using-content-builder-2/');

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title(THEMENAME))."/");
define("THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(sanitize_title(THEMENAME))."/");

if(!is_dir(THEMEUPLOAD))
{
	mkdir(THEMEUPLOAD);
}

//Define all google font usages in customizer
$tg_google_fonts = array('tg_body_font', 'tg_header_font', 'tg_menu_font', 'tg_sidemenu_font', 'tg_sidebar_title_font', 'tg_button_font', 'tg_page_title_mixed_font');
global $tg_google_fonts;

//Get default WordPress file system variable
function grandrestaurant_get_wp_filesystem() {
	WP_Filesystem();
	global $wp_filesystem;
	return $wp_filesystem;
}
?>
<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

if(THEMEDEMO)
{
	//Add cache control to custom CSS header
	$max_age = 60*60*24*7; // 24 hours
	$now = gmdate('D, d M Y H:i:s', time()).'GMT';
	$last_modified = get_theme_mod('my_custom_css_last_modified',$now);
	$etag = md5($last_modified);
	
	if (strtotime($s['HTTP_IF_MODIFIED_SINCE']) >= strtotime($last_modified) || $s['HTTP_IF_NONE_MATCH']==$etag) {
	  header('HTTP/1.1 304 Not Modified');
	} else {
	  header('HTTP/1.1 200 Ok');
	  header("Expires: " . gmdate('D, d M Y H:i:s', time()+$max_age.'GMT'));
	  header("Cache-Control: max-age={$mag_age}, public, must-revalidate");
	  header("Last-Modified: {$last_modified}");
	  header("ETag: {$etag}");
	  header("content-type: application/x-javascript"); 
	}
}
?>
jQuery('#<?php echo esc_js($_GET['id']); ?>').circliful();
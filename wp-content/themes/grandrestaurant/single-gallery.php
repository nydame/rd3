<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header();

//Run gallery script data
wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");

wp_enqueue_script("supersized.3.1.3", get_template_directory_uri()."/js/supersized.3.1.3.js", false, THEMEVERSION, "all");
wp_enqueue_script("supersized.shutter", get_template_directory_uri()."/js/supersized.shutter.js", false, THEMEVERSION, "all");
wp_enqueue_script("jquery.touchwipe.1.1.1", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, THEMEVERSION, "all");
wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$current_page_id, false, THEMEVERSION, true);
?>

<div id="slidecaption"></div>

<div id="thumb-tray" class="load-item">
    <a id="prevslide" class="load-item"></a>
    <a id="nextslide" class="load-item"></a>
</div>

<?php	
	get_footer();
?>
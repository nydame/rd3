<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Check if portfolio post type then go to another template
$post_type = get_post_type();

if($post_type == 'projects')
{
	$tg_project_sectors_services_layout = kirki_get_option('tg_project_sectors_services_layout');
	
	if(file_exists(get_template_directory() . "/".$tg_project_sectors_services_layout.".php"))
	{
		get_template_part($tg_project_sectors_services_layout);
	}
	else
	{
		get_template_part("project-grid-fullwidth");
	}
	exit;
}
else if($post_type == 'galleries')
{
	get_template_part("galleries");
	exit;
}
else
{
	//Get archive page layout setting
	$tg_blog_archive_layout = kirki_get_option('tg_blog_archive_layout');
	
	$located = locate_template($tg_blog_archive_layout.'.php');
	if (!empty($located))
	{
		get_template_part($tg_blog_archive_layout);
	}
	else
	{
		echo 'Error can\'t find page template you selected';
	}
}
?>
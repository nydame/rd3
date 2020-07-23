<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post_type == 'galleries')
{
	get_template_part("single-gallery");
	exit;
}
elseif($post_type == 'projects')
{
	//Get portfolio content type
	$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	
	switch($portfolio_type)
	{
		case "Vimeo Video":
			get_template_part("single-project-vimeo");
			exit;
		break;
		
		case "Youtube Video":
			get_template_part("single-project-youtube");
			exit;
		break;
		
		case "Self-Hosted Video":
			get_template_part("single-project-self-hosted");
			exit;
		break;
		
		case "Portfolio Content":
		default:
			get_template_part("single-project");
			exit;
		break;
	}
	exit;
}
else
{
	$post_layout = get_post_meta($post->ID, 'post_layout', true);
	
	switch($post_layout)
	{
		case "With Right Sidebar":
		default:
			get_template_part("single-post-r");
			exit;
		break;
		
		case "With Left Sidebar":
			get_template_part("single-post-l");
			exit;
		break;
		
		case "Fullwidth":
			get_template_part("single-post-f");
			exit;
		break;
	}
}
?>
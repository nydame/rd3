<?php
/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page header display setting
$page_title = get_the_title();
$tg_blog_header_bg = kirki_get_option('tg_blog_header_bg');
$page_menu_transparent = 0;

//Check if add blur effect
$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');

if(!empty($tg_blog_header_bg))
{
	$pp_page_bg = '';
	
	//Get page featured image
	if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        
        if(isset($image_thumb[0]) && !empty($image_thumb[0]))
        {
        	$pp_page_bg = $image_thumb[0];
        	$page_menu_transparent = 1;
        }
    }
    
    global $global_pp_topbar;
?>
<div id="page_caption" class="<?php if(!empty($pp_page_bg)) { ?>hasbg parallax<?php } ?> <?php if(!empty($global_pp_topbar)) { ?>withtopbar<?php } ?>">

	<?php if(!empty($pp_page_bg)) { ?>
		<div class="parallax_overlay_header"></div>
		<div id="bg_regular" style="background-image:url(<?php echo esc_url($pp_page_bg); ?>);"></div>
	<?php } ?>
	<?php
	    if(!empty($tg_page_title_img_blur) && !empty($pp_page_bg))
	    {
	?>
	<div id="bg_blurred" style="background-image:url(<?php echo admin_url('admin-ajax.php').'?action=grandrestaurant_blurred&src='.esc_url($pp_page_bg); ?>);"></div>
	<?php
	    }
	?>
	
	<div class="page_title_wrapper" <?php if(!empty($pp_page_bg)) { ?>data-stellar-ratio="1.3"<?php } ?>>
		<div class="page_title_inner">
			<h1 <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>class ="withtopbar"<?php } ?>><?php echo esc_html($page_title); ?></h1>
		    <div class="post_detail">
		    	<?php echo get_the_time(THEMEDATEFORMAT); ?>
				<?php
				    //Get Post's Categories
				    $post_categories = wp_get_post_categories($post->ID);
				    if(!empty($post_categories))
				    {
				?>
				    <?php echo _e( 'In', THEMEDOMAIN ); ?>
				<?php
				    	foreach($post_categories as $c)
				    	{
				    		$cat = get_category( $c );
				?>
				    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
				<?php
				    	}
				    }
				?>
		    </div>
		</div>
		<?php if(empty($pp_page_bg)) { ?>
		<br class="clear"/>
		<?php
		    }
		?>
	</div>
</div>
<?php
}
?>

<!-- Begin content -->
<?php
global $page_content_class;
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($page_content_class)) { echo esc_attr($page_content_class); } ?>">
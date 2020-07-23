<?php
/**
 * Template Name: Page Full Width
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page_obj = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page_obj->ID))
{
    $current_page_id = $page_obj->ID;
}

get_header(); 
?>

<?php
    //Include custom header feature
	get_template_part("/templates/template-header");
?>

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
        	
        <div class="sidebar_content full_width nopadding">
        	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
        </div>
    
    </div>
    <!-- End main content -->
    </div>
</div>
<br class="clear"/><br/><br/>
<?php get_footer(); ?>

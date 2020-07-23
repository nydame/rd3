<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

global $global_pp_topbar;

/**
*	Get current page id
**/

$current_page_id = $post->ID;

//If display feat content
$tg_blog_feat_content = kirki_get_option('tg_blog_feat_content');


/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($tg_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}

//Include custom header feature
get_template_part("/templates/template-post-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(!empty($tg_blog_feat_content) && has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
	    	if(!empty($tg_blog_feat_content) )
	    	{
			    //Get post featured content
			    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
			    
			    switch($post_ft_type)
			    {
			    	case 'Image':
			    	default:
			        	if(!empty($image_thumb))
			        	{
			        		$large_image_url = wp_get_attachment_image_src($image_id, 'original', true);
			        		$small_image_url = wp_get_attachment_image_src($image_id, 'large', true);
			        		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			?>
			
			    	    <div class="post_img static">
			    	    	<a href="<?php echo esc_url($large_image_url[0]); ?>" class="img_frame">
			    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
				            </a>
			    	    </div>
			
			<?php
			    		}
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
			?>
			    		<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Youtube Video':
			    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
			?>
			    		<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Gallery':
			    		$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
			?>
			    		<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="670" height="270"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    } //End switch
			} //End if enable blog featured image
			?>
		    
		    <?php
			    //Check if display post header then no need to display it again
				$tg_blog_header_bg = kirki_get_option('tg_blog_header_bg');
		    
		    	//Check post format
		    	$post_format = get_post_format(get_the_ID());
				
				switch($post_format)
				{
					case 'quote':
			?>
					
					<div class="post_header">
						<div class="post_quote_title">
						    <?php the_content(); ?>
						    <?php
								if(empty($tg_blog_header_bg))
								{
							?>
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
							<?php } ?>
						</div>
					</div>
			<?php
					break;
					
					case 'link':
			?>
					
					<div class="post_header">
						<div class="post_quote_title">
						    <?php the_content(); ?>
						    <?php
								if(empty($tg_blog_header_bg))
								{
							?>
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
							<?php } ?>
						</div>
					</div>
			<?php
					break;
					
					default:
		    ?>
				    <div class="post_header">
				    	<?php
						    if(empty($tg_blog_header_bg))
						    {
						?>
					    	<div class="post_header_title">
							    <h5><?php the_title(); ?></h5>
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
							    <br class="clear"/>
					    	</div>
					    	<br class="clear"/>
						    <?php
								}
							?>
				    
				    <?php
				    	the_content();
				    	
				    	$tg_blog_display_tags = kirki_get_option('tg_blog_display_tags');
			
					    if(has_tag() && !empty($tg_blog_display_tags))
					    {
					?>
					    <div class="post_excerpt post_tag">
					    	<?php the_tags('', '','<br />'); ?>
					    </div>
					<?php
					    }
				    	
						wp_link_pages();
				    ?>
				    
			    </div>
		    <?php
		    		break;
		    	}
		    ?>
			<br class="clear"/>
			
			<?php
			    $tg_blog_display_related = kirki_get_option('tg_blog_display_related');
			    
			    if($tg_blog_display_related)
			    {
			?>
			
			<?php
			//for use in the loop, list 9 post titles related to post's tags on current post
			$tags = wp_get_post_tags($post->ID);
			
			if ($tags) {
			
			    $tag_in = array();
			  	//Get all tags
			  	foreach($tags as $tags)
			  	{
			      	$tag_in[] = $tags->term_id;
			  	}
			
			  	$args=array(
			      	  'tag__in' => $tag_in,
			      	  'post__not_in' => array($post->ID),
			      	  'showposts' => 4,
			      	  'ignore_sticky_posts' => 1,
			      	  'orderby' => 'date',
			      	  'order' => 'DESC'
			  	 );
			  	$my_query = new WP_Query($args);
			  	$i_post = 1;
			  	
			  	if( $my_query->have_posts() ) {
			 ?>
			 	<br class="clear"/><hr/><br/><br/>
			  	<h5 class="related_post"><span><?php echo _e( 'You might also like', THEMEDOMAIN ); ?></span></h5><br class="clear"/>
			
			 	<ul class="posts blog">
			    	 <?php
			    	 	global $have_related;
			    	    while ($my_query->have_posts()) : $my_query->the_post();
			    	    $have_related = TRUE; 
			    	 ?>
			    	    <li>
			    	    	<?php
			    	    		if(has_post_thumbnail($post->ID, 'thumbnail'))
			    				{
			    					$image_id = get_post_thumbnail_id($post->ID);
			    					$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
			    	    	?>
			    	    	<div class="post_circle_thumb">
			    	    		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="post_ft" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title(); ?>"/></a>
			    	    	</div>
			    	    	<?php
			    	    		}
			    	    	?>
			    	    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			    	    	<div class="post_detail related">
								<?php echo get_the_time(THEMEDATEFORMAT); ?>
			    	    	</div>
			    		</li>
			    	  <?php
			    	  		$i_post++;
			    			endwhile;
			    	  ?>
			      
			  	</ul>
			    <br class="clear"/>
			<?php
			  	}
			}
			?>
			
			<?php
			    } //end if show related
			?>
			
			<br class="clear"/>
			
			<?php
			    $tg_blog_display_author = kirki_get_option('tg_blog_display_author');
			    
			    if($tg_blog_display_author)
			    {
			    	$author_name = get_the_author();
			    	$author_info = get_the_author_meta('description');
			?>
			<div id="about_the_author">
				<h3 class="about_author"><?php echo _e( 'About The Author', THEMEDOMAIN ); ?></h3><br/>
			    <div class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '160' ); ?></div>
			    <div class="author_detail">
			     	<div class="author_content">
			     		<h5><?php echo esc_html($author_name); ?></h5>
			     		<?php echo esc_html($author_info); ?>
			     	</div>
			    </div>
			</div>
			
			<?php
			    }
			?>
			
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<?php
if (comments_open($post->ID)) 
{
?>
<br class="clear"/><br/><br/><br/><hr/>
<div class="fullwidth_comment_wrapper sidebar">
	<?php comments_template( '', true ); ?>
</div>
<?php
}
?>

<?php endwhile; endif; ?>
						
    	</div>

    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">

    					<?php 
						if (is_active_sidebar('single-post-sidebar')) { ?>
		    	    		<ul class="sidebar_widget">
		    	    		<?php dynamic_sidebar('single-post-sidebar'); ?>
		    	    		</ul>
		    	    	<?php } ?>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    
    </div>
    <!-- End main content -->
   
</div>

<?php
	//Check if display social sharing
    global $share_id;
    global $share_class;
    $share_id = 'share_post_'.$post->ID;
    $share_class = 'inline';
?>
<div class="post_share_bubble">
    <?php		
    	//Get Social Share
    	get_template_part("/templates/template-share-blog");
    ?>
    <a href="javascript:;" class="post_share" data-share="<?php echo esc_attr($share_id); ?>" data-parent="post-<?php the_ID(); ?>"><i class="fa fa-share-alt"></i></a>
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>
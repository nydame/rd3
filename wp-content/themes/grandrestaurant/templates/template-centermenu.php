<?php
//Get page ID
if(is_object($post))
{
    $obj_page = get_page($post->ID);
}
$current_page_id = '';

if(isset($obj_page->ID))
{
    $current_page_id = $obj_page->ID;
}
elseif(is_home())
{
    $current_page_id = get_option('page_on_front');
}
?>

<div class="header_style_wrapper">
<?php
    //Check if display top bar
    $tg_topbar = kirki_get_option('tg_topbar');
    if(THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
	{
	    $tg_topbar = true;
	}
    
    global $global_pp_topbar;
    $global_pp_topbar = $tg_topbar;
    
    if(!empty($tg_topbar))
    {
?>

<!-- Begin top bar -->
<div class="above_top_bar">
    <div class="page_content_wrapper">
    	
    <?php
    	//Get Soical Icon
    	get_template_part("/templates/template-socials");
    	
    	//Display Top Menu
	    if ( has_nav_menu( 'top-menu' ) ) 
		{
		    wp_nav_menu( 
		        	array( 
		        		'menu_id'			=> 'top_menu',
		        		'menu_class'		=> 'top_nav',
		        		'theme_location' 	=> 'top-menu',
		        	) 
		    ); 
		}
	?>
	    <div class="extend_top_contact_info top_contact_info">
	    	<?php
	    	    $tg_menu_contact_address = kirki_get_option('tg_menu_contact_address');
	    	    
	    	    if(!empty($tg_menu_contact_address))
	    	    {	
	    	?>
	    	    <span id="top_contact_address"><i class="fa fa-map-marker"></i><?php echo esc_html($tg_menu_contact_address); ?></span>
	    	<?php
	    	    }
	    	?>
	    	<?php
	    	    $tg_menu_contact_hours = kirki_get_option('tg_menu_contact_hours');
	    	    
	    	    if(!empty($tg_menu_contact_hours))
	    	    {	
	    	?>
	    	    <span id="top_contact_hours"><i class="fa fa-clock-o"></i><?php echo esc_html($tg_menu_contact_hours); ?></span>
	    	<?php
	    	    }
	    	?>
	    	<?php
	    	    //Display top contact info
	    	    $tg_menu_contact_number = kirki_get_option('tg_menu_contact_number');
	    	    
	    	    if(!empty($tg_menu_contact_number))
	    	    {
	    	?>
	    	    <span id="top_contact_number"><a href="tel:<?php echo esc_attr($tg_menu_contact_number); ?>"><i class="fa fa-phone"></i><?php echo esc_html($tg_menu_contact_number); ?></a></span>
	    	<?php
	    	    }
	    	?>
	    </div>
    </div>
</div>
<?php
    }
?>
<!-- End top bar -->

<?php
    $pp_page_bg = '';
    //Get page featured image
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    
   if(!empty($pp_page_bg) && basename($pp_page_bg)=='default.png')
    {
    	$pp_page_bg = '';
    }
    
    //If enable menu transparent
    $page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
    
    //Check if single post page
    if(is_single() && $post->post_type == 'post')
    {
        $tg_blog_header_bg = kirki_get_option('tg_blog_header_bg');
		
		if(!empty($tg_blog_header_bg) && has_post_thumbnail($current_page_id, 'full'))
		{
    		$page_menu_transparent = 1;
    	}
    }
    
    //Check ifi single project page
    if(is_single() && $post->post_type == 'projects')
	{
	    $tg_project_header = kirki_get_option('tg_project_header');
	    
	    if(!empty($tg_project_header) && has_post_thumbnail($current_page_id, 'full'))
	    {
	    	$page_menu_transparent = 1;
	    }
	}
	
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Check if woocommerce page
		if(tg_is_woocommerce_page() && !is_product_category())
		{
			$shop_page_id = get_option( 'woocommerce_shop_page_id' );
			$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
		}
		elseif(tg_is_woocommerce_page() && is_product_category())
		{
			$page_menu_transparent = 0;
		}
		
		if(tg_is_woocommerce_page() && is_single())
		{
			$page_menu_transparent = 0;
		}
	}
	
	if(is_search())
	{
	    $page_menu_transparent = 0;
	}
	
	if(is_404())
	{
	    $page_menu_transparent = 0;
	}
	
	if(is_single() && $post->post_type == 'galleries')
	{
	    $page_menu_transparent = 1;
	}
	
?>
<div class="top_bar <?php if(!empty($pp_page_bg) && !empty($page_menu_transparent)) { ?>hasbg<?php } ?>">

    <div id="menu_wrapper">
    	
    	<!-- Begin logo -->
    	<?php
    	    //get custom logo
    	    $tg_retina_logo = kirki_get_option('tg_retina_logo');

    	    if(!empty($tg_retina_logo))
    	    {	
    	    	//Get image width and height
		    	$image_id = pp_get_image_id($tg_retina_logo);
		    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    	$image_width = 0;
		    	$image_height = 0;
		    	
		    	if(isset($obj_image[1]))
		    	{
		    		$image_width = intval($obj_image[1]/2);
		    	}
		    	if(isset($obj_image[2]))
		    	{
		    		$image_height = intval($obj_image[2]/2);
		    	}
    	?>
    	<div id="logo_normal" class="logo_container <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } ?>">
    		<div class="logo_align">
	    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>" style="width:<?php echo esc_attr($image_width); ?>px;height:<?php echo esc_attr($image_height); ?>px;"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php bloginfo('name'); ?>" width="101" height="34" style="width:101px;height:34px;"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	
    	<?php
    		//get custom logo transparent
    	    $tg_retina_transparent_logo = kirki_get_option('tg_retina_transparent_logo');

    	    if(!empty($tg_retina_transparent_logo))
    	    {
    	    	//Get image width and height
		    	$image_id = pp_get_image_id($tg_retina_transparent_logo);
		    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    	$image_width = 0;
		    	$image_height = 0;
		    	
		    	if(isset($obj_image[1]))
		    	{
		    		$image_width = intval($obj_image[1]/2);
		    	}
		    	if(isset($obj_image[2]))
		    	{
		    		$image_height = intval($obj_image[2]/2);
		    	}
    	?>
    	<div id="logo_transparent" class="logo_container <?php if(empty($page_menu_transparent)) { ?>hidden<?php } ?>">
    		<div class="logo_align">
	    	    <a id="custom_logo_transparent" class="logo_wrapper <?php if(empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>" style="width:<?php echo esc_attr($image_width); ?>px;height:<?php echo esc_attr($image_height); ?>px;"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php bloginfo('name'); ?>" width="101" height="34" style="width:101px;height:34px;"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	<!-- End logo -->
    	
        <!-- Begin main nav -->
        <div id="nav_wrapper">
        	<div class="nav_wrapper_inner">
        		<div id="menu_border_wrapper">
        			<?php 	
        				//Check if has custom menu
        				if(is_object($post) && $post->post_type == 'page')
    					{
    						$page_menu = get_post_meta($current_page_id, 'page_menu', true);
    					}
        			
        				if(empty($page_menu))
    					{
    						if ( has_nav_menu( 'primary-menu' ) ) 
    						{
    		    			    wp_nav_menu( 
    		    			        	array( 
    		    			        		'menu_id'			=> 'main_menu',
    		    			        		'menu_class'		=> 'nav',
    		    			        		'theme_location' 	=> 'primary-menu',
    		    			        		'walker' => new tg_walker(),
    		    			        	) 
    		    			    ); 
    		    			}
    		    			else
    		    			{
    			    			echo '<div class="notice">'.__( 'Setup Menu via Wordpress Dashboard > Appearance > Menus', THEMEDOMAIN ).'</div>';
    		    			}
    	    			}
    	    			else
    				    {
    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
    						    wp_nav_menu( 
    						        array(
    						            'menu' => $page_menu,
    						            'walker' => new tg_walker(),
    						            'menu_id'			=> 'main_menu',
    		    			        	'menu_class'		=> 'nav',
    						        )
    						    );
    						}
    				    }
        			?>
        		</div>
        	</div>
        	
        	<!-- Begin side menu button -->
	        <div class="menu_buttons_container">
		        <div class="menu_buttons_content">
		        	<!-- Begin Reservation -->
			    	<?php
			    		//Reservation button
			    		$pp_reservation_email = get_option('pp_reservation_email');
			    		$pp_reservation_url = get_option('pp_reservation_url');
			    		$class_name = '';
			    		$target = '';
			    		
			    		if(!empty($pp_reservation_email) OR !empty($pp_reservation_url))
			    		{
			    			if(!empty($pp_reservation_url))
			    			{
				    			$href_link = esc_url($pp_reservation_url);
				    			$class_name = 'custom_link';
				    			$target = 'target="_blank"';
			    			}
			    			else
			    			{
				    			$href_link = 'javascript:;';
			    			}
			    	?>
			    	<a <?php echo esc_attr($target); ?> href="<?php echo esc_attr($href_link); ?>" id="tg_reservation" class="button <?php echo esc_attr($class_name); ?>"><?php _e( 'Reservation', THEMEDOMAIN ); ?></a>
			    	<?php
			    		}
			    	?>
			    	<!-- End Reservation -->
			    	
			    	<?php
			    	if (class_exists('Woocommerce') && tg_is_woocommerce_page()) {
			    	    //Check if display cart in header
			
			    	    global $woocommerce;
			    	    $cart_url = $woocommerce->cart->get_cart_url();
			    	    $cart_count = $woocommerce->cart->cart_contents_count;
			    	?>
			    	<div class="header_cart_wrapper">
			    		<div class="cart_count"><?php echo esc_html($cart_count); ?></div>
			    	    <a href="<?php echo esc_url($cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
			    	</div>
			    	<?php
			    	}
			    	?>
		        
			        <!-- Begin side menu -->
			    	<a href="javascript:;" id="mobile_nav_icon"></a>
			    	<!-- End side menu -->
			    	
			    </div>
		    </div>
	    	<!-- End side menu button -->
        </div>
        <!-- End main nav -->

        </div>
    </div>
</div>

<?php
	//Reservation Form 		
	if(!empty($pp_reservation_email))
	{   
		wp_enqueue_style("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.css", false, "1.0", "all");
		
		wp_enqueue_script("jquery-ui-datepicker");
		wp_enqueue_style("datepicker", get_template_directory_uri()."/css/datepicker.css", false, "1.0", "all");
		wp_enqueue_script('custom-date', get_template_directory_uri()."/js/custom-date.js", false, THEMEVERSION, true);
		wp_enqueue_script("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.js", false);
		wp_enqueue_script('custom-time', get_template_directory_uri()."/js/custom-time.js", false, THEMEVERSION, true);
	    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);	
		wp_register_script("script-reservation-form", get_stylesheet_directory_uri()."/templates/script-reservation-form.php", false, THEMEVERSION, true);
		$params = array(
		  'ajaxurl' => admin_url('admin-ajax.php'),
		  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
		);
		wp_localize_script( 'script-reservation-form', 'tgAjax', $params );
		wp_enqueue_script("script-reservation-form", get_stylesheet_directory_uri()."/templates/script-reservation-form.php", false, THEMEVERSION, true);
?>
<div id="reservation_wrapper">
	<div class="reservation_content">
		<div class="reservation_form">
			<div class="reservation_form_wrapper">
				<a id="reservation_cancel_btn" href="javascript:;"><i class="fa fa-close"></i></a>
			
				<h2 class="ppb_title"><?php echo tg_get_first_title_word(__( "Table Booking", THEMEDOMAIN )); ?></h2>
				<div id="reponse_msg"><ul></ul></div>
				
				<form id="tg_reservation_form" method="post">
			    	<input type="hidden" id="action" name="action" value="tg_reservation_mailer"/>
			    	
			    	<div class="one_third">
				    	<label for="your_name"><?php echo _e( 'Name*', THEMEDOMAIN ); ?></label>
						<input id="your_name" name="your_name" type="text" class="required_field"/>
			    	</div>
			    	
			    	<div class="one_third">
				    	<label for="email"><?php echo _e( 'Email*', THEMEDOMAIN ); ?></label>
						<input id="email" name="email" type="text" class="required_field"/>
			    	</div>
					
					<div class="one_third last">
						<label for="phone"><?php echo _e( 'Phone*', THEMEDOMAIN ); ?></label>
						<input id="phone" name="phone" type="text" class="required_field"/>
					</div>
					
					<br class="clear"/><br/>
					
					<div class="one_third">
						<label for="date" class="hidden"><?php echo _e( 'Date*', THEMEDOMAIN ); ?></label>
						<input type="text" class="pp_date required_field" id="date" name="date" value="<?php echo date('m/d/Y'); ?>">
					</div>
					
					<div class="one_third">
						<label for="time"><?php echo _e( 'Time*', THEMEDOMAIN ); ?></label>
						<input type="text" class="pp_time required_field" id="time" name="time" value="18:00"/>
					</div>
					
					<div class="one_third last">
						<label for="seats"><?php echo _e( 'Seats*', THEMEDOMAIN ); ?></label>
				        <select id="seats" name="seats" class="required_field" style="width:99%">
				        	<?php
				        		for ($i = 1; $i < 21 ; $i++) {
				        			$option_title = $i;
				        			if($i==1)
				        			{
					        			$option_title.=  ' '.__( 'person', THEMEDOMAIN );
				        			}
				        			elseif($i<20)
				        			{
					        			$option_title.=  ' '.__( 'people', THEMEDOMAIN );
				        			}
				        			else
				        			{
					        			$option_title.=  '+ '.__( 'people', THEMEDOMAIN );
				        			}
				        	?>
				        		<option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($option_title); ?></option>
				        	<?php
				        		}
				        	?>
				        </select>
					</div>
					
					<br class="clear"/><br/>
					
					<div class="one">
						<label for="message"><?php echo _e( 'Special Requests', THEMEDOMAIN ); ?></label>
					    <textarea id="message" name="message" rows="7" cols="10"></textarea>
					</div>
					
					<br class="clear"/><br/>
				    
				    <div class="one">
					    <p>
		    				<input id="reservation_submit_btn" type="submit" value="<?php echo _e( 'Book Now', THEMEDOMAIN ); ?>"/>
					    </p>
				    </div>
				    
				    <br class="clear"/>
				</form>
			</div>
		</div>
	</div>
	<div class="parallax_overlay_header"></div>
</div>
<?php
	}
?>
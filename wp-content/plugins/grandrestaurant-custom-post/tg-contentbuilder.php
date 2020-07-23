<?php
function ppb_text_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100%',
		'padding' => 30,
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	
	if($size!='one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(urldecode($width)).'">';
	}
	$return_html.= do_shortcode(tg_apply_content($content)).'</div>';
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size!='one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_text', 'ppb_text_func');

function ppb_text_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100%',
		'padding' => 30,
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	
	if($size!='one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode(tg_apply_content($content));
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size!='one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_text_fullwidth', 'ppb_text_fullwidth_func');


function ppb_text_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'padding' => 30,
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	$return_html.= '"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= ' data-stellar-background-ratio="0.5" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner" ';

	$return_html.= '>';
	$return_html.= do_shortcode(tg_apply_content($content)).'</div>';
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_text_image', 'ppb_text_image_func');


function ppb_text_sidebar_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'sidebar' => '',
		'padding' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="one withsmallpadding" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	$return_html.= '<div class="sidebar_content">';
	
	$return_html.= do_shortcode(tg_apply_content($content)).'</div>';
	
	//Display Sidebar
	$return_html.= '<div class="sidebar_wrapper"><div class="sidebar"><div class="content"><ul class="sidebar_widget">';
	$return_html.= get_dynamic_sidebar(urldecode($sidebar));
	$return_html.= '</ul></div></div></div>';
	
	$return_html.= '</div></div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_text_sidebar', 'ppb_text_sidebar_func');


function ppb_header_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'subtitle' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100%',
		'padding' => 30,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));

	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header ';
	
	if(!empty($layout) && $layout == 'fullwidth')
	{
		$return_html.= 'fullwidth ';
	}

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	$custom_css_fontcolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(urldecode($width)).'">';
	}
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="ppb_subtitle" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($title) OR !empty($subtitle))
	{
		$return_html.= '<div class="page_header_sep '.esc_attr($textalign).'"></div>';
	}
	
	if(!empty($content))
	{
		$return_html.= do_shortcode(tg_apply_content($content));
	}
	
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header', 'ppb_header_func');


function ppb_header_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'subtitle' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'width' => '100%',
		'padding' => 30,
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_header ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= ' data-stellar-background-ratio="0.5" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	if($size == 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="ppb_subtitle" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="page_header_sep '.esc_attr($textalign).'"></div>';
		$return_html.= do_shortcode(tg_apply_content($content));
	}
	
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	if($size != 'one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_header_image', 'ppb_header_image_func');


function ppb_header_video_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'fontcolor' => '',
		'textalign' => 'left',
		'padding' => 30,
		'poster' => '',
		'mp4' => '',
		'webm' => '',
		'ogv' => '',
		'bgcolor' => '#000000',
		'custom_css' => '',
		'opacity' => 40,
		'height' => 75,
		'builder_id' => '',
	), $atts));
	
	$custom_id = 'ppb_header_video'.time().rand();

	$return_html = '';
	if($size != 'one')
	{	
		$return_html.= '<div class="standard_wrapper">';
	}

	$return_html.= '<div id="'.$custom_id.'" class="'.esc_attr($size).' withsmallpadding ppb_header_video ';

	$return_html.= '"';
	
	$custom_css.= 'text-align:'.esc_attr($textalign).';padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$custom_css_fontcolor = '';
	$custom_css_bordercolor = '';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		$custom_css_bordercolor.= 'border-color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).';height:'.$height.'vh;position:relative;" ';
	}
	
	$return_html.= '>';

	
	$custom_css_rgb = '';
	if(!empty($bgcolor))
	{
		$bgcolor_rgb = tg_hex_to_rgb($bgcolor);
		$custom_css_rgb = 'background-color: rgba('.$bgcolor_rgb['r'].', '.$bgcolor_rgb['g'].', '.$bgcolor_rgb['b'].', '.esc_attr($opacity/100).');';
		$return_html.= '<div class="overlay_background_title" style="'.esc_attr($custom_css_rgb).'"></div>';
	}
	
	$return_html.= '<div class="background_center_title_wrapper" style="z-index:3;position:relative;">';
	$return_html.= '<div class="title_content">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	//Add title and content
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode(tg_get_first_title_word($title)).'</h2>';
	}
	
	if(!empty($subtitle))
	{
		$return_html.= '<div class="ppb_subtitle" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_header_content">'.do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	
	$return_html.= '</div></div>';

	if(!empty($mp4) OR !empty($webm) OR !empty($ogv))
	{
		//Print contact form javascript code	
		wp_enqueue_script("vide", get_template_directory_uri()."/js/jquery.vide.js", false, THEMEVERSION, true);
	
		$return_html.= '<script>';
		$return_html.='
		    jQuery(document).ready(function(){ 
		    	jQuery("#'.$custom_id.'").vide({';
		    	
		if(!empty($mp4))
		{
			$return_html.= 'mp4: "'.esc_url($mp4).'",';
		}
		
		if(!empty($webm))
		{
			$return_html.= 'webm: "'.esc_url($webm).'",';
		}
		
		if(!empty($ogv))
		{
			$return_html.= 'ogv: "'.esc_url($ogv).'",';
		}
		
		if(!empty($poster))
		{
			$return_html.= 'poster: "'.esc_url($poster).'",';
		}
		    	
		$return_html.='
		    	      volumne: 0
		    	});
		    });
		';
		$return_html.= '</script>';
	}

	return $return_html;

}

add_shortcode('ppb_header_video', 'ppb_header_video_func');


function ppb_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'builder_id' => '',
	), $atts));

	//Set begin wrapper div for live builder
	$return_html= grandrestaurant_live_builder_begin_wrapper($builder_id, 'ppb_divider');
	
	$return_html.= '<div class="divider '.esc_attr($size).'">&nbsp;</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);

	return $return_html;

}

add_shortcode('ppb_divider', 'ppb_divider_func');

function ppb_open_table_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'width' => '100%',
		'open_table_id' => '',
		'padding' => 30,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	wp_enqueue_style("jquery-ui", get_template_directory_uri()."/functions/jquery-ui/css/custom-theme/jquery-ui-1.8.24.custom.css", false, "1.0", "all");
	wp_enqueue_style("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.css", false, "1.0", "all");
	
	wp_enqueue_script("jquery-ui-datepicker");
	wp_enqueue_style("datepicker", get_template_directory_uri()."/css/datepicker.css", false, "1.0", "all");
	wp_enqueue_script('custom-date', get_template_directory_uri()."/js/custom-date.js", false, THEMEVERSION, true);
	wp_enqueue_script("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.js", false);
	wp_enqueue_script('custom-time', get_template_directory_uri()."/js/custom-time.js", false, THEMEVERSION, true);
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	
	if($size!='one')
	{
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_text"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(urldecode($width)).';text-align:center;">';
	}
	
	//Display Reservation Form
	$return_html.= do_shortcode(tg_apply_content($content));
	
	$return_html.= '<form name="open_table_form" id="open_table_form" target="_blank" method="POST" action="https://secure.opentable.com/ism/interim.aspx">';
	
	$return_html.= '<input type="hidden" name="RestaurantID" value="'.$open_table_id.'">
	<input type="hidden" name="txtDateFormat" value="MM/dd/yyyy">';
	
	//Date Field
	$return_html.= '<div class="open_table_field">';
	$return_html.= '<label for="startDate" class="hidden"><i class="fa fa-calendar"></i></label>';
	$return_html.= '<input type="text" class="pp_date required_field" id="startDate" name="startDate" value="'.date('m/d/Y').'"/>';
	$return_html.= '</div>';
	
	//Time Field
	$return_html.= '<div class="open_table_field">';
	$return_html.= '<label for="ResTime" class="hidden"><i class="fa fa-clock-o"></i></label>';
	$return_html.= '<input type="text" class="pp_time required_field" id="ResTime" name="ResTime" value="06:00 PM"/>';
	$return_html.= '</div>';
	
	//People Field
	$return_html.= '<div class="open_table_field">';
	$return_html.= '<label for="PartySize" class="hidden"><i class="fa fa-user"></i></label>';
	$return_html.= '<select id="PartySize" name="PartySize" class="required_field">';
	for ($i = 1; $i < 21 ; $i++) 
	{
		$option_title = $i;
		if($i==1)
		{
		    $option_title.=  ' '.__( 'person', PLUGINDOMAIN );
		}
		elseif($i<20)
		{
		    $option_title.=  ' '.__( 'people', PLUGINDOMAIN );
		}
		else
		{
		    $option_title.=  '+ '.__( 'people', PLUGINDOMAIN );
		}
		
		$return_html.= '<option value="'.$i.'">'.$option_title.'</option>';
	}
	$return_html.= '</select>';
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/><input id="open_table_submit" type="submit" class="" value="'.__( 'Find a table', PLUGINDOMAIN ).'"/>';
	
	$return_html.= '</form>';
	$return_html.= '</div>';
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($size!='one')
	{
		$return_html.= '</div>';
	}

	return $return_html;

}

add_shortcode('ppb_open_table', 'ppb_open_table_func');


function ppb_menu_with_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'image_width' => 50,
		'image' => '',
		'align' => 1,
		'cat' => '',
		'items' => 5,
		'content_width' => 50,
		'padding' => 0,
		'bgcolor' => '',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($image_width))
	{
		$image_width = 50;
	}
	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	if(!is_numeric($items))
	{
		$items = 5;
	}
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$content_custom_css = '';
	
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	//Get content block custom CSS
	if(!empty($bgcolor))
	{
		$content_custom_css.= 'background:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_menu_with_image" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half parallax_scroll_image" style="width:'.esc_attr($image_width).'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;right:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_menu_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($title).'</h2>';
		}
		
		//Display Content
		if(!empty($content))
		{
			$return_html.= do_shortcode(tg_apply_content($content));
		}
		
		//Display food menus items
		if(!empty($menu_arr) && is_array($menu_arr))
		{
			foreach($menu_arr as $key => $menu_item)
			{
				$menu_ID = $menu_item->ID;
				$menu_price = get_post_meta($menu_ID, 'menu_price');
				$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
				if(!isset($menu_price_currency[0]))
				{
					$menu_price_currency[0] = '$';
				}
				$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
				$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
				if(isset($menu_order_url[0]))
				{
				    $menu_order_url = $menu_order_url[0];
				}
				
				$menu_title_class = '';
			
				$return_html.= '
					<div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">
		            <h5 class="menu_post">
		            	<span class="menu_title" style="background:'.esc_attr($bgcolor).';">'.$menu_item->post_title.'</span>
		            	<span class="menu_dots"></span>';
		            	
		        if(isset($menu_price[0]))
		        {
		        	$return_html.= '
		            	<span class="menu_price" style="background:'.esc_attr($bgcolor).';">'.$menu_price_currency[0].$menu_price[0].'</span>';
		        }
		            	
		        $return_html.= '</h5>
		            <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
		            
		        if(!empty($menu_highlight))
		        {
                    $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
                }
                
                if(!empty($menu_order_url))
			    {
	                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
	            }
	            
	            //Get menu size options
				$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
				$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
				
				if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
				{
					$return_html.= '<br class="clear"/>';
				
					foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
					{
						if(!empty($menu_size_item_title_item))
						{
							$return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size" style="background:'.esc_attr($bgcolor).';">'.$menu_size_item_title_item.'</span><span class="size"></span>';
						}
						
						if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
						{
							$return_html.= '<span class="menu_price size" style="background:'.esc_attr($bgcolor).';">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
						}
					}
				}
                    
                $return_html.= '</div>';
			}
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;left:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;z-index:2;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_menu_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';border-color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($title).'</h2>';
		}
		
		//Display Content
		if(!empty($content))
		{
			$return_html.= do_shortcode(tg_apply_content($content));
		}
		
		//Display food menus items
		if(!empty($menu_arr) && is_array($menu_arr))
		{
			foreach($menu_arr as $key => $menu_item)
			{
				$menu_ID = $menu_item->ID;
				$menu_price = get_post_meta($menu_ID, 'menu_price');
				$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
				if(!isset($menu_price_currency[0]))
				{
					$menu_price_currency[0] = '$';
				}
				$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
				$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
				if(isset($menu_order_url[0]))
				{
				    $menu_order_url = $menu_order_url[0];
				}
				
				$menu_title_class = '';
			
				$return_html.= '
					<div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">
		            <h5 class="menu_post">
		            	<span class="menu_title" style="background:'.esc_attr($bgcolor).';">'.$menu_item->post_title.'</span>
		            	<span class="menu_dots"></span>';
		            	
		        if(isset($menu_price[0]))
		        {
		        	$return_html.= '
		            	<span class="menu_price" style="background:'.esc_attr($bgcolor).';">'.$menu_price_currency[0].$menu_price[0].'</span>';
		        }
		            	
		        $return_html.= '</h5>
		            <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
		            
		        if(!empty($menu_highlight))
		        {
                    $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
                }

                if(!empty($menu_order_url))
			    {
	                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
	            }
	            
	            //Get menu size options
				$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
				$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
				
				if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
				{
					$return_html.= '<br class="clear"/>';
				
					foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
					{
						if(isset($menu_size_item_price_arr[$key]))
						{
							$return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size" style="background:'.esc_attr($bgcolor).';">'.$menu_size_item_title_item.'</span><span class="size"></span>';
			    
							$return_html.= '<span class="menu_price size" style="background:'.esc_attr($bgcolor).';">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
						}
					}
				}
                    
                $return_html.= '</div>';
			}
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half parallax_scroll_image last" style="width:'.$image_width.'%;">';
		if(!empty($image))
		{
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_menu_with_image', 'ppb_menu_with_image_func');


function ppb_menu_with_image_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'image' => '',
		'image_height' => '600',
		'cat' => '',
		'items' => '',
		'content_width' => 50,
		'content_align' => 'left',
		'padding' => 0,
		'bgcolor' => '',
		'fontcolor' => '',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($content_align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($image_height))
	{
		$image_height = 600;
	}

	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_menu_with_image_fullwidth" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}

	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	switch($content_align)
	{
		case 'left':
		default:
			$custom_css_align = 'left:90px;';
		break;
		
		case 'right':
			$custom_css_align = 'right:90px;';
		break;
		
		case 'center':
			$custom_css_align = 'left:'.intval(50-($content_width/2)).'%;';
		break;
	}
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	$content_custom_css = '';
	
	//Get content block custom CSS
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	if(!empty($bgcolor))
	{
		$content_custom_css.= 'background:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}
	
	//Display content
	$return_html.= '<div class="one">';
	if(!empty($image))
	{
	    $return_html.= '<div class="image_classic_frame expand"><div class="fullwidth_image" style="height:'.$image_height.'px;background-image:url(\''.esc_url($image).'\');">';
	    $return_html.= '</div></div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;'.$custom_css_align.''.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3" data-stellar-vertical-offset="'.intval($image_height).'">';
	
	//Display menus
	if(!empty($title))
	{
	    $return_html.= '<h2 class="ppb_menu_title" ';
	    if(!empty($fontcolor))
	    {
	    	$return_html.= 'style="color:'.esc_attr($fontcolor).';border-color:'.esc_attr($fontcolor).';"';
	    }
	    $return_html.= '>'.urldecode($title).'</h2>';
	}
	
	//Display food menus items
	if(!empty($menu_arr) && is_array($menu_arr))
	{
	    foreach($menu_arr as $key => $menu_item)
	    {
	    	$menu_ID = $menu_item->ID;
	    	$menu_price = get_post_meta($menu_ID, 'menu_price');
	    	$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
	    	if(!isset($menu_price_currency[0]))
	    	{
	    		$menu_price_currency[0] = '$';
	    	}
	    	$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
	    
	    	$return_html.= '
	    		<div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">
	            <h5 class="menu_post">
	            	<span class="menu_title" style="background:'.esc_attr($bgcolor).';';
	            	
			if(!empty($fontcolor))
		    {
		    	$return_html.= 'color:'.esc_attr($fontcolor).';';
		    }
		    
		    $return_html.= '">'.$menu_item->post_title.'</span>';
	            	
	        if(isset($menu_price[0]))
	        {
	        	$return_html.= '<span class="menu_dots" style="background:'.esc_attr($bgcolor).';';
	            	
		        $return_html.= '"></span>
		            	<span class="menu_price" style="background:'.esc_attr($bgcolor).';';
		            	
		        if(!empty($fontcolor))
			    {
			    	$return_html.= 'color:'.esc_attr($fontcolor).';';
			    }
	        
	        	$return_html.= '">'.$menu_price_currency[0].$menu_price[0].'</span>';
	        }
	            
	        $return_html.= '</h5>
	            <div class="post_detail menu_excerpt"';
	            
	        if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }    
	        
	        $return_html.= '>'.$menu_item->post_excerpt.'</div>';
	            
	        if(!empty($menu_highlight))
	        {
                $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
            }
            
            $menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
            if(!empty($menu_order_url))
			{
	            $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
	        }
	        
	        $menu_title_class = '';
	        
	        //Get menu size options
			$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
			$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
			
			if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
			{
				$return_html.= '<br class="clear"/>';
			
				foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
				{
					if(!empty($menu_size_item_title_item))
					{
					    $return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size" style="background:'.esc_attr($bgcolor).';color:'.esc_attr($fontcolor).';">'.$menu_size_item_title_item.'</span><span class="size"></span>';
					}
				
					if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
					{
						$return_html.= '<span class="menu_price size" style="background:'.esc_attr($bgcolor).';color:'.esc_attr($fontcolor).';">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
					}
				}
			}
			
			$return_html.= '</div>';
	    }
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_menu_with_image_fullwidth', 'ppb_menu_with_image_fullwidth_func');


function ppb_menu_classic_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'width' => '',
		'menu_image' => '',
		'columns' => '',
		'cat' => '',
		'items' => '',
		'padding' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 5;
	}
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
		
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($width))
	{
		$return_html.= '<div style="margin:auto;width:'.esc_attr(urldecode($width)).';text-align:center;">';
	}
	
	//Display Title
	if(!empty($title))
	{
	    $return_html.= '<h2 class="ppb_menu_title" ';
	    $return_html.= '>'.urldecode($title).'</h2><br class="clear"/><br/>';
	}
	
	//Display Post Content under Title
	if(!empty($content))
	{
		$return_html.= '<div class="menu_content_subtitle" ';
		$return_html.= do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	switch($columns)
	{
		case 1:
		default:
		$wrapper_class = "one";
		break;
		
		case 2:
		$wrapper_class = "one_half";
		break;
		
		case 3:
		$wrapper_class = "one_third";
		break;
	}
	
	//Display food menus items
	if(!empty($menu_arr) && is_array($menu_arr))
	{
	    foreach($menu_arr as $key => $menu_item)
	    {
	    	$item_index = $key+1;
	    	$last_class = '';
	    	if($columns > 1 && ($item_index%$columns) == 0)
	    	{
		    	$last_class = 'last';
	    	}
	    
			$return_html.= '<div class="'.$wrapper_class.' '.$last_class.'">';
			
			//Display Food Menu
			$menu_ID = $menu_item->ID;
			$menu_price = get_post_meta($menu_ID, 'menu_price');
			$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
			if(!isset($menu_price_currency[0]))
			{
			    $menu_price_currency[0] = '$';
			}
			$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
			$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
			
			$menu_title_class = '';
			$menu_dots_class = 'menu_dots';
			
			$return_html.= '
			    <div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">';
			 
			if(!empty($menu_image) && has_post_thumbnail($menu_item->ID, 'thumbnail'))
			{
			    $image_id = get_post_thumbnail_id($menu_item->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
			    $image_full = wp_get_attachment_image_src($image_id, 'original', true);
			    
			    if(isset($image_thumb[0]) && !empty($image_thumb[0]))
			    {
			    	$return_html.= '<div class="menu_image"><a href="'.$image_full[0].'" class="img_frame"><img src="'.$image_thumb[0].'" alt=""/></a></div>';
			    	$menu_dots_class.= ' image';
			    	$menu_title_class = 'image';
			    }
			}
			    
		    $return_html.= '<h5 class="menu_post">
		        	<span class="menu_title">'.$menu_item->post_title.'</span>
		        	<span class="'.$menu_dots_class.'"></span>';
		    
		    if(isset($menu_price[0]))
		    {
		        	$return_html.= '<span class="menu_price">'.$menu_price_currency[0].$menu_price[0].'</span>';
		    }
		        
		    $return_html.= '</h5>
		        <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
		        
		    if(!empty($menu_highlight))
		    {
                $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
            }
            
            if(!empty($menu_order_url))
		    {
                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
            }
            
            //Get menu size options
			$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
			$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
			
			if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
			{
				$return_html.= '<br class="clear"/>';
			
				foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
				{
					if(!empty($menu_size_item_title_item))
						{
							$return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size">'.$menu_size_item_title_item.'</span><span class="'.$menu_dots_class.' size"></span>';
						}
				
					if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
					{
						$return_html.= '<span class="menu_price size">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
					}
				}
			}
            
            $return_html.= '</div>';
			
			$return_html.= '</div>';
		}
	}
	
	if(!empty($width))
	{
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_menu_classic', 'ppb_menu_classic_func');


function ppb_menu_multiple_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'cat' => '',
		'padding' => 0,
		'bgcolor' => '#fff',
		'fontcolor' => '',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_menu_multiple '.$size.' nopadding ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper fullwidth">';
	
	if(!empty($cat))
	{
		$return_html.= '<div class="standard_wrapper">';
		$return_html.= '<div class="portfolio_filter_wrapper two_cols gallery portfolio-content section content clearfix">';
		
		if(!empty($title) OR !empty($content))
		{
			$return_html.= '<div class="element classic2_cols">';
			$return_html.= '<div class="one_half gallery2 filterable static">';
			
			//Custom CSS for block content
			$content_custom_css = '';
			if(!empty($fontcolor))
			{
				$content_custom_css.= 'color:'.esc_attr($fontcolor).';';
			}
			
			if(!empty($bgcolor))
			{
				$content_custom_css = 'background:'.esc_attr($bgcolor).';';
			}
	
			if(!empty($bordercolor))
			{
			    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
			}
			
			$return_html.= '<div class="menu_multiple_wrapper" style="'.esc_attr($content_custom_css).'">';
			
			//Add title and content
			if(!empty($title))
			{
				if(empty($fontcolor))
				{
					$return_html.= '<h2 class="ppb_title">'.urldecode(tg_get_first_title_word($title)).'</h2>';
				}
				else
				{
					$return_html.= '<h2 class="ppb_title" style="color:'.esc_attr($fontcolor).';">'.urldecode(tg_get_first_title_word($title)).'</h2>';
				}
			}
			
			if(!empty($content))
			{
				if(empty($fontcolor))
				{
					$return_html.= '<div class="menu_multiple_content">'.do_shortcode(tg_apply_content($content)).'</div>';
				}
				else
				{
					$return_html.= '<div class="menu_multiple_content" style="color:'.esc_attr($fontcolor).';">'.do_shortcode(tg_apply_content($content)).'</div>';
				}
			}
			
			$return_html.= '</div>';
			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$menu_cat_arr = explode(',', $cat);
	
		if(!empty($menu_cat_arr) && is_array($menu_cat_arr))
		{
		
			foreach($menu_cat_arr as $key => $menu_cat)
			{
				$return_html.= '<div class="element classic2_cols">';
				$return_html.= '<div class="one_half gallery2 filterable static">';
				$return_html.= '<div class="menu_multiple_wrapper">';
				
				//Get menu cateogry title
				$menu_term = get_term_by('slug', $menu_cat, 'menucats');

				if(isset($menu_term->name))
				{
					$return_html.= '<h2 class="ppb_menu_title" ';
					$return_html.= '>'.$menu_term->name.'</h2><br class="clear"/><br/>';
				}
			
				$item_index = $key+1;
				$last_class = '';
				if($item_index%2 == 0)
				{
					$last_class = 'last';
				}
				
				//Get food menu items
				$args = array(
				    'numberposts' => -1,
				    'order' => 'ASC',
				    'orderby' => 'menu_order',
				    'post_type' => array('menus'),
				    'menucats' => $menu_cat,
				);

				$menu_arr = get_posts($args);
				
				foreach($menu_arr as $key => $menu_item)
			    {
			    	$item_index = $key+1;
			    	$last_class = '';
			    
					$return_html.= '<div class="one">';
					
					//Display Food Menu
					$menu_ID = $menu_item->ID;
					$menu_price = get_post_meta($menu_ID, 'menu_price');
					$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
					if(!isset($menu_price_currency[0]))
					{
					    $menu_price_currency[0] = '$';
					}
					$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
					$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
					if(isset($menu_order_url[0]))
					{
					    $menu_order_url = $menu_order_url[0];
					}
					
					$menu_title_class = '';
					$menu_dots_class = 'menu_dots';
					
					$return_html.= '
					    <div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">';
					    
					if(!empty($menu_image) && has_post_thumbnail($menu_item->ID, 'thumbnail'))
					{
					    $image_id = get_post_thumbnail_id($menu_item->ID);
					    $image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
					    $image_full = wp_get_attachment_image_src($image_id, 'original', true);
					    
					    if(isset($image_thumb[0]) && !empty($image_thumb[0]))
					    {
					    	$return_html.= '<div class="menu_image"><a href="'.$image_full[0].'" class="img_frame"><img src="'.$image_thumb[0].'" alt=""/></a></div>';
					    	$menu_dots_class.= ' image';
					    }
					}
					    
				    $return_html.= '<h5 class="menu_post">
				        	<span class="menu_title">'.$menu_item->post_title.'</span>
				        	<span class="'.$menu_dots_class.'"></span>';
				    
				    if(isset($menu_price[0]))
				    {
				        	$return_html.= '<span class="menu_price">'.$menu_price_currency[0].$menu_price[0].'</span>';
				    }
				        
				    $return_html.= '</h5>
				        <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
				        
				    if(!empty($menu_highlight))
				    {
		                $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
		            }
		            
		            if(!empty($menu_order_url))
				    {
		                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
		            }
		                
		            //Get menu size options
					$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
					$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
					
					if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
					{
						$return_html.= '<br class="clear"/>';
					
						foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
						{
							if(!empty($menu_size_item_title_item))
							{
								$return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size" style="background:'.esc_attr($bgcolor).';">'.$menu_size_item_title_item.'</span><span class="size"></span>';
							}
						
							if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
							{
								$return_html.= '<span class="menu_price size">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
							}
						}
					}
		                
		            $return_html.= '</div>';
					
					$return_html.= '</div>';
				}
				
				$return_html.= '<br class="clear"/>';
				$return_html.= '</div>';
				$return_html.= '</div>';
				$return_html.= '</div>';
			}
		}
		
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= 'Please select at least 1 menu category.';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_menu_multiple', 'ppb_menu_multiple_func');


function ppb_menu_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 8,
		'cat' => '',
		'padding' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 8;
	}
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_portfolio '.$size.' nopadding ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper fullwidth">';
	
	if(!empty($menu_arr) && is_array($menu_arr))
	{
		$return_html.= '<div class="portfolio_filter_wrapper four_cols gallery portfolio-content section content clearfix">';
	
		foreach($menu_arr as $key => $menu_item)
		{
			$item_index = $key+1;
			$last_class = '';
			if($item_index%4 == 0)
			{
				$last_class = 'last';
			}
			
			//Display Food Menu
			$menu_ID = $menu_item->ID;
			$menu_price = get_post_meta($menu_ID, 'menu_price');
			$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
			if(!isset($menu_price_currency[0]))
			{
			    $menu_price_currency[0] = '$';
			}
			$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
			$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
			
			$menu_title_class = '';
			$menu_dots_class = 'menu_dots';
			
			//Begin display HTML
			$return_html.= '<div class="element classic3_cols">';
			$return_html.= '<div class="one_fourth gallery4 filterable static animated'.($key+1).'">';
			
			//Get food menu image
			 $image_id = get_post_thumbnail_id($menu_item->ID);
			 $image_thumb = wp_get_attachment_image_src($image_id, 'tg_grid', true);
			 $image_full = wp_get_attachment_image_src($image_id, 'original', true);
			
			if(!empty($image_thumb[0]))
			{
				$return_html.= '<div class="button_wrapper"><div class="button_center"><div class="button_content">';
			
				//Get image caption
				$image_caption = get_post_field('post_excerpt', $image_id);
				$tg_lightbox_enable_caption = kirki_get_option('tg_lightbox_enable_caption');
			
				$return_html.= '<a data-title="'.esc_attr($menu_item->post_title).'" href="'.esc_url($image_full[0]).'" class="fancy-gallery" ';
				
				if(!empty($tg_lightbox_enable_caption)) 
				{
					$return_html.= 'title="'.esc_attr($image_caption).'" ';
				}
				
				$return_html.= '><i class="fa fa-search"></i></a>';
				
				$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
				if(isset($menu_order_url[0]))
				{
				    $menu_order_url = $menu_order_url[0];
				}
				
				if(!empty($menu_order_url))
			    {
	                $return_html.= '<a href="'.esc_url($menu_order_url).'"><i class="fa fa-shopping-cart"></i></a><';
	            }
				
				$return_html.= '</div></div></div>';
				
				$return_html.= '<img src="'.esc_url($image_thumb[0]).'" alt=""/>';
			}
			$return_html.= '</div>';
			
			//Display portfolio detail
			$return_html.= '<br class="clear"/><div id="portfolio_desc_'.$menu_ID.'" class="portfolio_desc portfolio4 filterable '.$last_class.'">';
			
			$return_html.= '
			    <div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic">';
            
            $return_html.= '<h5 class="menu_post">
		        	<span class="menu_title">'.$menu_item->post_title.'</span>
		        	<span class="'.$menu_dots_class.'"></span>';
		        	
		    if(isset($menu_price[0]))
		    {
		        	$return_html.= '<span class="menu_price">'.$menu_price_currency[0].$menu_price[0].'</span>';
		    }
		    
		    $return_html.= '</h5>
		        <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
		        
		    if(!empty($menu_highlight))
		    {
                $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
            }
            
            if(!empty($menu_order_url))
		    {
                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
            }
            
            //Get menu size options
			$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
			$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
			
			if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
			{
				$return_html.= '<br class="clear"/>';
			
				foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
				{
					if(!empty($menu_size_item_title_item))
					{
					    $return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size">'.$menu_size_item_title_item.'</span><span class="'.$menu_dots_class.' size"></span>';
					}
						
					if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
					{
						$return_html.= '<span class="menu_price size">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
					}
				}
			}
            
			$return_html.= '</div>';
			
			$return_html.= '</div>';
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_menu_grid', 'ppb_menu_grid_func');


function ppb_menu_grid_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 8,
		'cat' => '',
		'padding' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 8;
	}
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_portfolio '.$size.' nopadding ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper fullwidth">';
	
	if(!empty($menu_arr) && is_array($menu_arr))
	{
		$return_html.= '<div class="portfolio_filter_wrapper four_cols gallery portfolio-content section content clearfix">';
	
		foreach($menu_arr as $key => $menu_item)
		{
			$item_index = $key+1;
			$last_class = '';
			if($item_index%4 == 0)
			{
				$last_class = 'last';
			}
			
			//Display Food Menu
			$menu_ID = $menu_item->ID;
			$menu_price = get_post_meta($menu_ID, 'menu_price');
			$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
			if(!isset($menu_price_currency[0]))
			{
			    $menu_price_currency[0] = '$';
			}
			$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
			$menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
			
			$menu_title_class = '';
			$menu_dots_class = 'menu_dots';
			
			//Begin display HTML
			$return_html.= '<div class="element classic3_cols">';
			$return_html.= '<div class="one_fourth gallery4 filterable grid_image static animated'.($key+1).'">';
			
			//Display portfolio detail
			$return_html.= '<div id="portfolio_desc_'.$menu_ID.'" class="portfolio_desc grid_image portfolio4 filterable '.$last_class.'">';
			
			$return_html.= '<div class="grid_image_frame">
			    <div id="menu_'.esc_attr($menu_ID).'" class="menu_content_classic center">';
            
            $return_html.= '<h5 class="menu_post">
		        	<span class="menu_title">'.$menu_item->post_title.'</span>
		        </h5>
		        <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div><br class="clear"/><br/>';
		        
		    if(isset($menu_price[0]))
		    {
		        $return_html.= '<span class="menu_price">'.$menu_price_currency[0].$menu_price[0].'</span>';
		    }
		        
		    if(!empty($menu_highlight))
		    {
                $return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
            }
            
            $menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
            
            if(!empty($menu_order_url))
		    {
                $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
            }
            
            //Get menu size options
			$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
			$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
			
			if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
			{
				$return_html.= '<br class="clear"/><br/>';
			
				foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
				{
					if(!empty($menu_size_item_title_item))
					{
					    $return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size">'.$menu_size_item_title_item.'</span><span class="'.$menu_dots_class.' size"></span>';
					}
						
					if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
					{
						$return_html.= '<span class="menu_price size">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
					}
				}
			}
            
			$return_html.= '</div></div>';
			
			$return_html.= '</div>';
			
			//Get food menu image
			 $image_id = get_post_thumbnail_id($menu_item->ID);
			 $image_thumb = wp_get_attachment_image_src($image_id, 'tg_grid', true);
			 $image_full = wp_get_attachment_image_src($image_id, 'original', true);
			
			if(!empty($image_thumb[0]))
			{
				$return_html.= '<img src="'.esc_url($image_thumb[0]).'" alt=""/>';
			}
			
			$return_html.= '</div>';
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_menu_grid_image', 'ppb_menu_grid_image_func');


function ppb_gallery_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'padding' => 0,
		'height' => 400,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="original" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'" timer="'.esc_attr($timer).'" height="'.$height.'"]');
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider', 'ppb_gallery_slider_func');


function ppb_gallery_slider_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper nopadding"><div class="inner">';
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="original" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'"  timer="'.esc_attr($timer).'"]');
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider_fixed_width', 'ppb_gallery_slider_fixed_width_func');


function ppb_gallery_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'gallery_id' => '',
		'margin' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode('[tg_grid_gallery gallery_id="'.esc_attr($gallery_id).'" margin="'.esc_attr($margin).'"]');
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_grid', 'ppb_gallery_grid_func');


function ppb_gallery_masonry_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'gallery_id' => '',
		'margin' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= do_shortcode('[tg_masonry_gallery gallery_id="'.esc_attr($gallery_id).'" margin="'.esc_attr($margin).'"]');
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_masonry', 'ppb_gallery_masonry_func');


function ppb_image_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'image' => '',
		'height' => 400,
		'display_caption' => 1,
		'background_position' => 'center',
		'padding' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));

	if(!is_numeric($height))
	{
		$height = 400;
	}
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper withbg"';
	
	if(!empty($image))
	{
		$return_html.= ' style="background-image:url('.esc_url($image).');background-size:cover;background-position:center '.esc_attr($background_position).';height:'.esc_attr($height).'px;position:relative;"';
	}
	
	$return_html.= '>';
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = pp_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		
		if(!empty($image_caption))
		{
			$return_html.= '<div id="gallery_caption" class="ppb_fullwidth"><h2>'.$image_caption.'</h2></div>';
		}
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fullwidth', 'ppb_image_fullwidth_func');


function ppb_image_parallax_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'image' => '',
		'height' => 50,
		'display_title' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	if(!is_numeric($height))
	{
		$height = 50;
	}
	
	if($height > 100)
	{
		$height = 100;
	}
	
	//Set begin wrapper div for live builder
	$return_html = grandrestaurant_live_builder_begin_wrapper($builder_id);

	$return_html.= '<div '.$sec_id.' class="parallax ';
	
	if(!empty($display_title))
	{
		$return_html.= 'title';
	}
	
	$return_html.= '" ';
	
	if(!empty($image))
	{
		$image_id = pp_get_image_id($image);
		$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
		
		//Check if got file name
		if(basename($image_thumb[0]) != 'default.png')
		{
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		
			$return_html.= 'data-image="'.esc_url($background_image).'" ';
			$return_html.= 'data-width="'.$background_image_width.'" ';
			$return_html.= 'data-height="'.$background_image_height.'" ';
		}
		else
		{
			$return_html.= 'data-image="'.esc_url($image).'" ';
			list($background_image_width, $background_image_height) = getimagesize($image);
			$return_html.= 'data-width="'.$background_image_width.'" ';
			$return_html.= 'data-height="'.$background_image_height.'" ';
		}
	}
	
		
	if(!empty($height))
	{
		$return_html.= 'data-content-height="'.$height.'" ';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'"';
	}
	
	$return_html.= '>';
	
	if(!empty($display_title))
	{
		//Add title
		if(!empty($title))
		{
			$return_html.= '<div class="parallax_title"><h2 class="ppb_title">'.urldecode(tg_get_first_title_word($title)).'</h2></div>';
		}
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);

	return $return_html;
}

add_shortcode('ppb_image_parallax', 'ppb_image_parallax_func');


function ppb_image_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'image' => '',
		'display_caption' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';

	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($image))
	{
		$image_id = pp_get_image_id($image);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
		$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		$return_html.= '</div>';
	}
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = pp_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		$image_description = get_post_field('post_content', $image_id);
		
		if(!empty($image_caption) OR !empty($image_description))
		{
			$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
			$return_html.= '<div class="image_description">'.$image_description.'</div>';
		}
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fixed_width', 'ppb_image_fixed_width_func');


function ppb_content_half_bg_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'subtitle' => '',
		'background' => '',
		'background_parallax' => '',
		'background_position' => '',
		'padding' => 30,
		'bgcolor' => '#ffffff',
		'opacity' => 100,
		'fontcolor' => '',
		'align' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_content_half_bg ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
		$custom_css.= 'background-image:url('.esc_url($background).');';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= 'parallax ';
	}
	
	if(!empty($background_position))
	{
		$custom_css.= 'background-position: center '.esc_attr($background_position).';';
	}
	
	$return_html.= '"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	if(!empty($background_parallax))
	{
		$return_html.= ' data-stellar-background-ratio="0.5" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if(!empty($content))
	{
		$custom_bgcolor_css = '';
		if(!empty($bgcolor))
		{
			$ori_bgcolor = $bgcolor;
			$opacity = $opacity/100;
			$bgcolor = HexToRGB($bgcolor);
		
			$custom_bgcolor_css.= 'background:'.$ori_bgcolor.';';
			$custom_bgcolor_css.= 'background:rgb('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
			$custom_bgcolor_css.= 'background:rgba('.$bgcolor['r'].','.$bgcolor['g'].','.$bgcolor['b'].','.$opacity.');';
		}
		$custom_css_fontcolor = '';
		if(!empty($fontcolor))
		{
			$custom_css_fontcolor.= 'color:'.esc_attr($fontcolor).';';
		}
	
		if($align == 'left')
		{
			$return_html.= '<div class="one_half_bg" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'">';
		}
		else
		{
			$return_html.= '<div class="one_half_bg floatright" style="'.esc_attr($custom_bgcolor_css.$custom_css_fontcolor).'">';
		}
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="ppb_subtitle" style="'.esc_attr($custom_css_fontcolor).'">'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
			$return_html.= '<div class="page_header_sep left" ';
			
			if(!empty($fontcolor))
			{
				$return_html.= 'style="border-color:'.$fontcolor.'"';
			}
			
			$return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= do_shortcode(tg_apply_content($content));
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_content_half_bg', 'ppb_content_half_bg_func');


function ppb_image_half_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'image' => '',
		'align' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last content_middle animate">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half content_middle animate textright">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fixed_width', 'ppb_image_half_fixed_width_func');


function ppb_card_two_cols_with_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'image_width' => 50,
		'image' => '',
		'image_lightbox' => 'enable',
		'align' => 1,
		'content_width' => 50,
		'padding' => 0,
		'bgcolor' => '#fff',
		'fontcolor' => '',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($image_width))
	{
		$image_width = 50;
	}
	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_card_two_cols_with_image" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
		    
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	//Get content block custom CSS
	$content_custom_css = '';
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	if(!empty($bgcolor))
	{
		$content_custom_css.= 'background:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half parallax_scroll_image" style="width:'.esc_attr($image_width).'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			if($image_lightbox == 'enable')
			{
				$return_html.= '<a href="'.esc_url($image).'" class="img_frame">';
			}
			$return_html.= '<img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/>';
			if($image_lightbox == 'enable')
			{
				$return_html.= '</a>';
			}
			
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;right:90px;padding:'.esc_attr($padding).'px;'.esc_attr($content_custom_css).'" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;left:90px;padding:'.esc_attr($padding).'px;z-index:2;block !important;'.esc_attr($content_custom_css).'" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half parallax_scroll_image last" style="width:'.$image_width.'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			if($image_lightbox == 'enable')
			{
				$return_html.= '<a href="'.esc_url($image).'" class="img_frame">';
			}
			$return_html.= '<img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/>';
			if($image_lightbox == 'enable')
			{
				$return_html.= '</a>';
			}
			
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_card_two_cols_with_image', 'ppb_card_two_cols_with_image_func');


function ppb_card_cols_with_image_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'image' => '',
		'height' => '600',
		'content_align' => 'left',
		'content_width' => 50,
		'content_align' => 'left',
		'padding' => 0,
		'bgcolor' => '#fff',
		'bordercolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($content_align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 600;
	}

	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
		    
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	switch($content_align)
	{
		case 'left':
		default:
			$custom_css_align = 'left:90px;';
		break;
		
		case 'right':
			$custom_css_align = 'right:90px;';
		break;
		
		case 'center':
			$custom_css_align = 'left:'.intval(50-($content_width/2)).'%;';
		break;
	}
	
	//Get content block custom CSS
	$content_custom_css = 'background:'.esc_attr($bgcolor).';';
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	//Display content
	$return_html.= '<div class="one">';
	if(!empty($image))
	{
	    $return_html.= '<div class="image_classic_frame expand"><div class="fullwidth_image" style="height:'.$height.'px;background-image:url(\''.esc_url($image).'\');">';
	    $return_html.= '</div></div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;'.esc_attr($custom_css_align).esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3" data-stellar-vertical-offset="'.intval($height).'">';
	
	//Display Title
	if(!empty($title))
	{
	    $return_html.= '<h2 class="ppb_title" ';
	    if(!empty($fontcolor))
	    {
	    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
	    }
	    $return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
	}
	if(!empty($subtitle))
	{
	    $return_html.= '<div class="ppb_subtitle" ';
	    if(!empty($fontcolor))
	    {
	    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
	    }
	    $return_html.= '>'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($title) OR !empty($subtitle))
	{
	    $return_html.= '<div class="page_header_sep left" ';
	    if(!empty($fontcolor))
	    {
	    	$return_html.= 'style="border-color:'.$fontcolor.'"';
	    }
	    $return_html.= '></div>';
	}
	
	if(!empty($content))
	{
	    $return_html.= $content;
	}
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '<br class="clear"/></div>';

	return $return_html;

}

add_shortcode('ppb_card_cols_with_image', 'ppb_card_cols_with_image_func');


function ppb_image_half_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'subtitle' => '',
		'image' => '',
		'height' => 500,
		'align' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'fontcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper nopadding">';
	
	$content_custom_css = '';
	if($align=='left')
	{
		$return_html.= '<div class="one_half_bg"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
		
		$content_custom_css.= 'style="padding:'.esc_attr($padding).'px;"';
		$return_html.= '<div class="one_half_bg" '.$content_custom_css.'>';
		
		//Display Title
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
			$return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
			$return_html.= '<div class="ppb_subtitle" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
			$return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
			$return_html.= '<div class="page_header_sep left" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="border-color:'.$fontcolor.'"';
			}
			$return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="nicepadding">'.do_shortcode($content).'</div>';
		}
		$return_html.= '</div>';
	}
	else
	{	
		$content_custom_css.= 'style="padding:'.esc_attr($padding).'px;"';
		$return_html.= '<div class="one_half_bg textright" '.$content_custom_css.'>';
		
		//Display Title
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
			$return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
			$return_html.= '<div class="ppb_subtitle" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
			$return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
			$return_html.= '<div class="page_header_sep left" ';
			if(!empty($fontcolor))
			{
				$return_html.= 'style="border-color:'.$fontcolor.'"';
			}
			$return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= '<div class="nicepadding">'.do_shortcode($content).'</div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half_bg"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fullwidth', 'ppb_image_half_fullwidth_func');


function ppb_two_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'display_caption' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	$return_html.= '<div class="one_half">';
	if(!empty($image1))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<div class="one_half last">';
	if(!empty($image2))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_two_cols_images', 'ppb_two_cols_images_func');


function ppb_two_cols_images_no_space_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'height' => 600,
		'display_caption' => 1,
		'padding' => 0,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner" style="padding:0;">';
	
	if(!empty($image1) && !empty($height))
	{
		$return_html.= '<div class="one_half_bg" ';
		$return_html.= 'style="background-image:url(\''.$image1.'\');height:'.$height.'px;"';
		$return_html.= '>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	
	if(!empty($image2) && !empty($height))
	{
		$return_html.= '<div class="one_half_bg" ';
		$return_html.= 'style="background-image:url(\''.$image2.'\');height:'.$height.'px;"';
		$return_html.= '>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_two_cols_images_no_space', 'ppb_two_cols_images_no_space_func');


function ppb_three_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_third">';
	if(!empty($image1))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_third">';
	if(!empty($image2))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Third image
	$return_html.= '<div class="one_third last animate">';
	if(!empty($image3))
	{
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div></div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_cols_images', 'ppb_three_cols_images_func');


function ppb_three_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image_portrait' => '',
		'image_portrait_align' => 'left',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($image_portrait_align))
	{
		$image_portrait_align = 'left';
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	if($image_portrait_align=='left')
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image_portrait))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame"><img src="'.esc_url($image_portrait).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image2))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '<br class="clear"/>';
		
		if(!empty($image3))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image2))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '<br class="clear"/>';
		
		if(!empty($image3))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image_portrait))
		{
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    
		    $image_id = pp_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		    
		    $return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame"><img src="'.esc_url($image_portrait).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_images_block', 'ppb_three_images_block_func');


function ppb_four_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'image4' => '',
		'display_caption' => 1,
		'padding' => 0,
		'bgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_half">';
	if(!empty($image1))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_half last">';
	if(!empty($image2))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/><br/>';
	
	//Third image
	$return_html.= '<div class="one_half">';
	if(!empty($image3))
	{
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Fourth image
	$return_html.= '<div class="one_half last animate">';
	if(!empty($image4))
	{
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    
	    $image_id = pp_get_image_id($image4);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	    
	    $return_html.= '<a href="'.esc_url($image4).'" class="img_frame"><img src="'.esc_url($image4).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image4);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_four_images_block', 'ppb_four_images_block_func');


function ppb_menu_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 8,
		'cat' => '',
		'autoplay' => '',
		'timer' => 5,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 9;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="ppb_portfolio '.$size.' nopadding ';
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	//Get food menu items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('menus'),
	);
	
	if(!empty($cat))
	{
		$args['menucats'] = $cat;
	}
	$menu_arr = get_posts($args);
	
	if(!empty($menu_arr) && is_array($menu_arr))
	{
		wp_enqueue_script("flexslider-js", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, THEMEVERSION, true);
		wp_enqueue_script("script-gallery-flexslider", get_template_directory_uri()."/templates/script-portfolio-flexslider.php?autoplay=".$autoplay.'&amp;timer='.$timer, false, THEMEVERSION, true);
	
		$return_html.= '<div class="slider_wrapper portfolio">';
		$return_html.= '<div class="flexslider tg_gallery" data-height="750">';
		$return_html.= '<ul class="slides">';
	
		foreach($menu_arr as $key => $menu_item)
		{
			//Display Food Menu
			$menu_ID = $menu_item->ID;
			$menu_price = get_post_meta($menu_ID, 'menu_price');
			$menu_price_currency = get_post_meta($menu_ID, 'menu_price_currency');
			if(!isset($menu_price_currency[0]))
			{
			    $menu_price_currency[0] = '$';
			}
			$menu_highlight = get_post_meta($menu_ID, 'menu_highlight');
			
			$image_id = get_post_thumbnail_id($menu_item->ID);
			$image_full = wp_get_attachment_image_src($image_id, 'original', true);
			
			$menu_title_class = '';
			$menu_dots_class = 'menu_dots';
			
			//Begin display HTML
			$return_html.= '<li>';
			
			//Display portfolio detail
			if(isset($image_full[0]) && !empty($image_full[0]))
			{
				$return_html.= '<img src="'.$image_full[0].'" alt=""/>';
			}
			
			$return_html.= '<div id="menuc_'.$menu_ID.'" class="portfolio_slider_desc">';
            $return_html.= '<h5 class="menu_post">
		        	<span class="menu_title">'.$menu_item->post_title.'</span>
		        	<span class="'.$menu_dots_class.'"></span>';
		        	
		    if(isset($menu_price[0]))
		    {
		        	$return_html.= '<span class="menu_price">'.$menu_price_currency[0].$menu_price[0].'</span>';
		    }
		    
		    $return_html.= '</h5>
		        <div class="post_detail menu_excerpt">'.$menu_item->post_excerpt.'</div>';
		        
		    if(!empty($menu_highlight))
		    {
		    	$return_html.= '<div class="menu_highlight"><i class="fa fa-star"></i></div>';
            }
            
            $menu_order_url = get_post_meta($menu_ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
			    $menu_order_url = $menu_order_url[0];
			}
            if(!empty($menu_order_url))
			{
	            $return_html.= '<div class="menu_order"><a href="'.esc_url($menu_order_url).'">'.__( 'Order', PLUGINDOMAIN ).'</a></div>';
	        }
	        
	        //Get menu size options
			$menu_size_item_title_arr = get_post_meta($menu_item->ID, 'menu_size_item_title', true);
			$menu_size_item_price_arr = get_post_meta($menu_item->ID, 'menu_size_item_price', true);
			
			if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
			{
				$return_html.= '<br class="clear"/>';
			
				foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
				{
					if(!empty($menu_size_item_title_item))
					{
					    $return_html.= '<h5 class="menu_post size '.$menu_title_class.'"><span class="menu_title size">'.$menu_size_item_title_item.'</span><span class="'.$menu_dots_class.' size"></span>';
					}
						
					if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
					{
						$return_html.= '<span class="menu_price size">'.$menu_price_currency[0].$menu_size_item_price_arr[$key].'</span>';
					}
				}
			}
               
            $return_html.= '</div>';
			$return_html.= '</li>';
		}
	}
	
	$return_html.= '</ul></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_menu_slider', 'ppb_menu_slider_func');


function ppb_blog_grid_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'cat' => '',
		'items' => '',
		'padding' => '',
		'custom_css' => '',
		'link_title' => '',
		'link_url' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	
	$return_html.= '<div '.$sec_id.' class="'.$size.' withsmallpadding"';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	    'suppress_filters' => false,
	);

	if(!empty($cat))
	{
		$args['category'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div class="blog_grid_wrapper sidebar_content full_width ppb_blog_posts">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$animate_layer = $key+7;
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$return_html.= '<div id="post-'.$ppb_post->ID.'" class="post type-post hentry status-publish">
			<div class="post_wrapper grid_layout">';
		    
		    $return_html.= '<div class="blog_grid_content">';
		    
		    //Check post format
		    $post_format = get_post_format($ppb_post->ID);
		    
		    switch($post_format)
			{
			    case 'quote':
			
			    $return_html.= '
			    <div class="post_header quote">
			    	<div class="post_quote_title grid">
			    		<a href="'.esc_url(get_permalink($ppb_post->ID)).'"><p>'.$ppb_post->post_content.'</p></a>
			    		<div class="post_detail">
			    	    	'.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;';
			    		    
						$post_categories = wp_get_post_categories($ppb_post->ID);
						if(!empty($post_categories))
						{
						 	$return_html.= __( 'In', PLUGINDOMAIN ).'&nbsp;';
						 	
						    foreach($post_categories as $c)
						    {
						        $cat = get_category( $c );
						    	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
						    }
						}
			    		    
				$return_html.= '</div>

			    	</div>
			    </div>';
			    
			    break;
			    
			    case 'link':
			
			    $return_html.= '
			    <div class="post_header quote">
			    	<div class="post_quote_title grid">
			    	'.$ppb_post->post_content.'
			    	<div class="post_detail">
			    	    	'.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;';
			    		    
						$post_categories = wp_get_post_categories($ppb_post->ID);
						if(!empty($post_categories))
						{
						 	$return_html.= __( 'In', PLUGINDOMAIN ).'&nbsp;';
						 	
						    foreach($post_categories as $c)
						    {
						        $cat = get_category( $c );
						    	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
						    }
						}
			    		    
				$return_html.= '</div>';
			    	
				$return_html.= '
			    	</div>
			    </div>';

			    break;
			    
			    default:
		    
				$return_html.= '<div class="post_header grid">
				<h6><a href="'.esc_url(get_permalink($ppb_post->ID)).'" title="'.get_the_title($ppb_post->ID).'">'.get_the_title($ppb_post->ID).'</a></h6>
				<div class="post_detail">
			    	    	'.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;';
			    		    
						$post_categories = wp_get_post_categories($ppb_post->ID);
						if(!empty($post_categories))
						{
						 	$return_html.= __( 'In', PLUGINDOMAIN ).'&nbsp;';
						 	
						    foreach($post_categories as $c)
						    {
						        $cat = get_category( $c );
						    	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>&nbsp;';
						    }
						}
						
						$return_html.= '<span class="post_readmore">
				            <a class="readmore" href="'.esc_url(get_permalink($ppb_post->ID)).'">'.__( 'Read More', PLUGINDOMAIN ).'</a>
				        </span>';
			    		    
				$return_html.= '</div>
				</div>';
				
				//Get post featured content
			    $post_ft_type = get_post_meta($ppb_post->ID, 'post_ft_type', true);
			    
			    switch($post_ft_type)
			    {
			    	case 'Image':
			    	default:
			        	if(!empty($image_thumb))
			        	{
			        		$small_image_url = wp_get_attachment_image_src($image_id, 'gallery_grid', true);
			
			    	    $return_html.= '<div class="post_img small">
			    	    	<a href="'.esc_url(get_permalink($ppb_post->ID)).'">
			    	    		<img src="'.esc_url($small_image_url[0]).'" alt="" class=""/>
			                </a>
			    	    </div>';
			    		}
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$post_ft_vimeo = get_post_meta($ppb_post->ID, 'post_ft_vimeo', true);
			
						$return_html.= do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]').'<br/>';
			    	break;
			    	
			    	case 'Youtube Video':
			    		$post_ft_youtube = get_post_meta($ppb_post->ID, 'post_ft_youtube', true);
	
			    		$return_html.= do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]').'<br/>';
			    	break;
			    	
			    	case 'Gallery':
			    		$post_ft_gallery = get_post_meta($ppb_post->ID, 'post_ft_gallery', true);
			    		$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" size="gallery_2" width="670" height="270"]');
			    	break;
			    	
			    } //End switch
				
				$return_html.= pp_substr(get_excerpt_by_id($ppb_post->ID), 110);
		        break;
		    }
		    
		    $return_html.= '
	    </div>    
	</div>
</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div></div>';
	
	if(!empty($link_title) && !empty($link_url))
	{
		$return_html.= '<a href="'.esc_url($link_url).'" class="button continue_ppb_blog">'.urldecode($link_title).'</a>';
	}
	
	return $return_html;
}

add_shortcode('ppb_blog_grid', 'ppb_blog_grid_func');


function ppb_blog_minimal_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'cat' => '',
		'items' => 3,
		'padding' => '',
		'custom_css' => '',
		'link_title' => '',
		'link_url' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	
	$return_html.= '<div '.$sec_id.' class="'.$size.' ppb_blog_minimal"';
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper">';
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	    'suppress_filters' => false,
	);

	if(!empty($cat))
	{
		$args['category'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		foreach($posts_arr as $key => $ppb_post)
		{
			$animate_layer = $key+7;
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$return_html.= '<div class="one_third_bg">';
			$return_html.= '<a href="'.esc_url(get_permalink($ppb_post->ID)).'">';
			$return_html.= '<div class="blog_minimal_wrapper">';
			
			if(!empty($image_thumb[0]))
			{
				$return_html.= '<div class="featured_image" style="background-image:url(\''.$image_thumb[0].'\');"></div>';
				$return_html.= '<div class="background_overlay"></div>';
			}
			
			$return_html.= '<div class="content">';
			$return_html.= '<h4>'.get_the_title($ppb_post->ID).'</h4>';
			$return_html.= '<div class="post_detail">'.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'</div>';
		    $return_html.= '</div>';
		    $return_html.= '</div>';
		    $return_html.= '</a>';
		    $return_html.= '</div>';
		}
	}
	
	$return_html.= '</div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if(!empty($link_title) && !empty($link_url))
	{
		$return_html.= '<a href="'.esc_url($link_url).'" class="button continue_ppb_blog">'.urldecode($link_title).'</a>';
	}
	
	return $return_html;
}

add_shortcode('ppb_blog_minimal', 'ppb_blog_minimal_func');


function ppb_service_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 3,
		'padding' => 30,
		'cat' => '',
		'columns' => '3',
		'align' => 'left',
		'layout' => 'fixedwidth',
		'custom_css' => '',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withpadding ';
	
	if(!empty($layout) && $layout == 'fullwidth')
	{
		$return_html.= 'fullwidth ';
	}
	
	$return_html.= '" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper"><div class="inner" ';
	if($layout == 'fullwidth')
	{
		$return_html.= 'style="width:100%;"';
	}
	$return_html.= '>';
	
	$service_order = 'ASC';
	$service_order_by = 'menu_order';
	
	//Get service items
	$args = array(
	    'numberposts' => $items,
	    'order' => $service_order,
	    'orderby' => $service_order_by,
	    'post_type' => array('services'),
	);
	
	if(!empty($cat))
	{
		$args['servicecats'] = $cat;
	}
	$services_arr = get_posts($args);
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	$service_h = 'h3';
	
	switch($columns)
	{
		case 1:
			$count_column = 1;
			$columns_class = 'one';
			$service_h = 'h3';
		break;
	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
			$service_h = 'h3';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
			$service_h = 'h3';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
			$service_h = 'h6';
		break;
	}
	
	if(!empty($content))
	{
		$return_html.= '<div class="one_third"  style="text-align:left">';
		$content = preg_replace('/^(?:<br\s*\/?>\s*)+/', '', $content);
		$return_html.= $content;
		$return_html.= '</div>';
	}

	if(!empty($services_arr) && is_array($services_arr))
	{
		if(!empty($content))
		{
			$return_html.= '<div class="two_third last">';
		}
	
		$return_html.= '<div class="service_content_wrapper">';
		$last_class = '';
	
		foreach($services_arr as $key => $service)
		{
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			else
			{
				$last_class = '';
			}
			
			$return_html.= '<div class="'.$columns_class.' '.$last_class.'">';
			
			$image_url = '';
			$service_ID = $service->ID;
					
			//check if use font awesome
			$service_icon_code ='';
			$service_font_awesome = get_post_meta($service_ID, 'service_font_awesome', true);
					
			if(!empty($service_font_awesome))
			{
				$service_icon_code = get_post_meta($service_ID, 'service_font_awesome_code', true);
			}
			else
			{
				if(has_post_thumbnail($service_ID, 'large'))
				{
				    $image_id = get_post_thumbnail_id($service_ID);
				    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
				    $service_icon_code = '<img src="'.$image_url[0].'" alt="" />';
				}
			}
			$return_html.= '<div class="service_wrapper '.esc_attr(urldecode($align)).'">';
			
			if(!empty($service_icon_code))
			{
				$return_html.= '<div class="service_icon">'.$service_icon_code.'<div class="service_border"></div></div>';
			}
			
			$return_html.= '<div class="service_title">';
			$return_html.= '<'.$service_h.'>'.$service->post_title.'</'.$service_h.'>';
			$return_html.= '<div class="service_content">'.$service->post_content.'</div>';
			$return_html.= '</div>';
			
			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
		
		if(!empty($content))
		{
			$return_html.= '</div>';
		}
	}
	
	$return_html.= '</div></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_service', 'ppb_service_func');


function ppb_service_content_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'subtitle' => '',
		'items' => 3,
		'padding' => 30,
		'cat' => '',
		'order' => 'default',
		'custom_css' => '',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' withpadding ';
	
	if(!empty($layout) && $layout == 'fullwidth')
	{
		$return_html.= 'fullwidth ';
	}
	
	$return_html.= '" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper"><div class="inner"> ';
	
	if(!empty($content))
	{
		$return_html.= '<div class="one_half">';
		
		//Add title and content
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title">'.urldecode($title).'</h2>';
		}
		
		if(!empty($subtitle))
		{
			$return_html.= '<div class="ppb_subtitle">'.urldecode($subtitle).'</div>';
		}
		
		$return_html.= do_shortcode(tg_apply_content($content));
		$return_html.= '</div>';
	}

	//display service content
	$return_html.= '<div class="one_half last">';	
	$return_html.= do_shortcode('[tg_service_vertical cat="'.esc_attr($cat).'" items="'.esc_attr($items).'" align="left"]');
	$return_html.= '</div>';
	
	$return_html.= '</div></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_service_content', 'ppb_service_content_func');


function ppb_fullwidth_button_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'padding' => 30,
		'slug' => '',
		'title' => '',
		'bgcolor' => '',
		'fontcolor' => '#000',
		'button_text' => '',
		'link_url' => '',
		'button_bgcolor' => '',
		'button_fontcolor' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' ppb_fullwidth_button" ';
	
	if(!empty($bgcolor))
	{
		$return_html.= 'style="background-color:'.esc_attr($bgcolor).';padding:'.$padding.'px 0 '.$padding.'px 0;"';
	}
	
	$return_html.= '><div class="standard_wrapper">';
	
	if(!empty($title))
	{
		$return_html.= '<h2 class="title" style="color:'.esc_attr($fontcolor).';">'.urldecode($title).'</h2>';
	}
	
	$custom_css = '';
	if(!empty($button_text))
	{
		if(!empty($button_bgcolor))
		{
			$custom_css.= 'background-color:'.$button_bgcolor.';border-color:'.$button_bgcolor.';';
		}
		
		if(!empty($button_fontcolor))
		{
			$custom_css.= 'color:'.$button_fontcolor.';';
		}
	
		$return_html.= '<a href="'.esc_url($link_url).'" class="button" ';
		
		if(!empty($custom_css))
		{
			$return_html.= 'style="'.$custom_css.'"';
		}
		
		$return_html.= '>'.urldecode($button_text).'</a>';
	}
	
	$return_html.= '</div></div>';

	return $return_html;

}

add_shortcode('ppb_fullwidth_button', 'ppb_fullwidth_button_func');


function ppb_pricing_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'skin' => 'normal',
		'items' => 3,
		'cat' => '',
		'columns' => '3',
		'highlightcolor' => '#001d2c',
		'bgcolor' => '',
		'padding' => 30,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' ppb_pricing"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	$pricing_order = 'ASC';
	$pricing_order_by = 'menu_order';
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $pricing_order,
	    'orderby' => $pricing_order_by,
	    'post_type' => array('pricing'),
	);
	
	if(!empty($cat))
	{
		$args['pricingcats'] = $cat;
	}
	$pricing_arr = get_posts($args);
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}
	
	$custom_header = '';
	$custom_button = '';
	$custom_price = '';
	
	if(!empty($highlightcolor))
	{
		switch($skin)
		{
			case 'light':
			default:
				$custom_header = 'color:'.$highlightcolor.';';
				$custom_price = 'color:'.$highlightcolor.';';
				$custom_button = 'background:'.$highlightcolor.';border-color:'.$highlightcolor.';color:#fff;';
				
			break;
			
			case 'normal':
				$custom_header = 'background:'.$highlightcolor.';';
				$custom_price = 'color:'.$highlightcolor.';';
				$custom_button = 'background:'.$highlightcolor.';border-color:'.$highlightcolor.';color:#fff;';
			break;
		}
	}

	if(!empty($pricing_arr) && is_array($pricing_arr))
	{
		$return_html.= '<div class="pricing_content_wrapper '.$skin.'">';
		$last_class = '';
	
		foreach($pricing_arr as $key => $pricing)
		{
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			else
			{
				$last_class = '';
			}
			
			//Check if featured
			$priing_featured_class = '';
			$priing_button_class = '';
			$pricing_plan_featured = get_post_meta($pricing->ID, 'pricing_featured', true);
			if(!empty($pricing_plan_featured))
			{
				$priing_featured_class = 'featured';
			}
			
			$return_html.= '<div class="pricing '.esc_attr($columns_class).' '.esc_attr($priing_featured_class).' '.esc_attr($last_class).'">';
			$return_html.= '<ul class="pricing_wrapper">';
			
			$return_html.= '<li class="title_row '.esc_attr($priing_featured_class).'" style="'.esc_attr($custom_header).'">'.$pricing->post_title.'</li>';
			
			//Check price
			$pricing_plan_currency = get_post_meta($pricing->ID, 'pricing_plan_currency', true);
			$pricing_plan_price = get_post_meta($pricing->ID, 'pricing_plan_price', true);
			$pricing_plan_time = get_post_meta($pricing->ID, 'pricing_plan_time', true);
			
			$return_html.= '<li class="price_row">';
			$return_html.= '<strong>'.$pricing_plan_currency.'</strong>';
			$return_html.= '<em class="exact_price" style="'.esc_attr($custom_price).'">'.$pricing_plan_price.'</em>';
			$return_html.= '<em class="time">'.$pricing_plan_time.'</em>';
			$return_html.= '</li>';
			
			//Get pricing features
			$pricing_plan_features = get_post_meta($pricing->ID, 'pricing_plan_features', true);
			$pricing_plan_features = trim($pricing_plan_features);
			$pricing_plan_features_arr = explode("\n", $pricing_plan_features);
			$pricing_plan_features_arr = array_filter($pricing_plan_features_arr, 'trim');
			
			foreach ($pricing_plan_features_arr as $feature) {
			    $return_html.= '<li>'.$feature.'</li>';
			}
			
			//Get button
			$pricing_button_text = get_post_meta($pricing->ID, 'pricing_button_text', true);
			$pricing_button_url = get_post_meta($pricing->ID, 'pricing_button_url', true);
			
			$return_html.= '<li class="button_row '.esc_attr($priing_featured_class).'"><a href="'.esc_url($pricing_button_url).'" class="button"  style="'.esc_attr($custom_button).'">'.$pricing_button_text.'</a></li>';
			
			$return_html.= '</ul>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div></div>';
	
	return $return_html;
}

add_shortcode('ppb_pricing', 'ppb_pricing_func');


function ppb_team_column_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'columns' => 4,
		'title' => '',
		'items' => 4,
		'cat' => '',
		'order' => 'default',
		'bgcolor' => '',
		'fontcolor' => '',
		'textalign' => 'center',
		'padding' => 30,
		'layout' => 'fixedwidth',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	
	if($layout=='fixedwidth')
	{
		$return_html.= '<div class="standard_wrapper">';
	}
	
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_team_column" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center"><div class="inner">';
	
	$team_order = 'ASC';
	$team_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$team_order = 'ASC';
			$team_order_by = 'menu_order';
		break;
		
		case 'newest':
			$team_order = 'DESC';
			$team_order_by = 'post_date';
		break;
		
		case 'oldest':
			$team_order = 'ASC';
			$team_order_by = 'post_date';
		break;
		
		case 'title':
			$team_order = 'ASC';
			$team_order_by = 'title';
		break;
		
		case 'random':
			$team_order = 'ASC';
			$team_order_by = 'rand';
		break;
	}
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{	
		case 3:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
		default:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
		
		case 5:
			$count_column = 5;
			$columns_class = 'one_fifth';
		break;
	}
	
	//Get team items
	$args = array(
	    'numberposts' => $items,
	    'order' => $team_order,
	    'orderby' => $team_order_by,
	    'post_type' => array('team'),
	);
	
	if(!empty($cat))
	{
		$args['teamcats'] = $cat;
	}
	$team_arr = get_posts($args);
	
	if(!empty($team_arr) && is_array($team_arr))
	{
		$return_html.= '<div class="team_wrapper">';
	
		foreach($team_arr as $key => $member)
		{
			$image_url = '';
			$member_ID = $member->ID;
					
			if(has_post_thumbnail($member_ID, 'tg_grid'))
			{
			    $image_id = get_post_thumbnail_id($member_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'tg_grid', true);
			}
			
			$last_class = '';
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="'.$columns_class.' animated'.($key+1).' '.$last_class.'">';
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="post_img team"><img class="team_pic animated" data-animation="fadeIn" src="'.esc_url($small_image_url[0]).'" alt=""/></div>';
			}
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			//Display portfolio detail
			$return_html.= '<br class="clear"/><div id="portfolio_desc_'.$member_ID.'" class="portfolio_desc team '.esc_attr($last_class).'" style="text-align:'.esc_attr($textalign).';">';
            $return_html.= '<h5 ';
            
            if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.$fontcolor.';"';
			}
            
            $return_html.= '>'.$member->post_title.'</h5>';
            if(!empty($team_position))
            {
            	$return_html.= '<div class="post_detail" ';
            	
            	if(!empty($fontcolor))
				{
					$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
				}
            	
            	$return_html.= '>'.$team_position.'</div>';
            }
            
            $member_facebook = get_post_meta($member_ID, 'member_facebook', true);
			$member_twitter = get_post_meta($member_ID, 'member_twitter', true);
			$member_google = get_post_meta($member_ID, 'member_google', true);
			$member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
            
            if(!empty($member_facebook) OR !empty($member_twitter) OR !empty($member_google) OR !empty($member_linkedin))
			{
			    $return_html.= '<ul class="social_wrapper team">';
			    
			    $social_font_color = '';
			    if(!empty($fontcolor))
				{
					$social_font_color = 'style="color:'.$fontcolor.';"';
				}
			    
			    if(!empty($member_twitter))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Twitter" target="_blank" class="tooltip" href="http://twitter.com/'.$member_twitter.'" '.$social_font_color.'><i class="fa fa-twitter"></i></a></li>';
			    }
	 
			    if(!empty($member_facebook))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Facebook" target="_blank" class="tooltip" href="http://facebook.com/'.$member_facebook.'" '.$social_font_color.'><i class="fa fa-facebook"></i></a></li>';
			    }
			    
			    if(!empty($member_google))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Google+" target="_blank" class="tooltip" href="'.$member_google.'" '.$social_font_color.'><i class="fa fa-google-plus"></i></a></li>';
			    }
			        
			    if(!empty($member_linkedin))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Linkedin" target="_blank" class="tooltip" href="'.$member_linkedin.'" '.$social_font_color.'><i class="fa fa-linkedin"></i></a></li>';
			    }
			    
			    $return_html.= '</ul>';
			}
            
            if(!empty($member->post_content))
            {
            	$return_html.= '<p>'.$member->post_content.'</p>';
            }

			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	if($layout=='fixedwidth')
	{
		$return_html.= '</div>';
	}
	
	return $return_html;
}

add_shortcode('ppb_team_column', 'ppb_team_column_func');


function ppb_team_card_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'title' => '',
		'items' => 4,
		'cat' => '',
		'order' => 'default',
		'bgcolor' => '',
		'fontcolor' => '',
		'card_bgcolor' => '',
		'padding' => 30,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_team_card" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.='<div class="page_content_wrapper"><div class="inner">';
	
	$team_order = 'ASC';
	$team_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$team_order = 'ASC';
			$team_order_by = 'menu_order';
		break;
		
		case 'newest':
			$team_order = 'DESC';
			$team_order_by = 'post_date';
		break;
		
		case 'oldest':
			$team_order = 'ASC';
			$team_order_by = 'post_date';
		break;
		
		case 'title':
			$team_order = 'ASC';
			$team_order_by = 'title';
		break;
		
		case 'random':
			$team_order = 'ASC';
			$team_order_by = 'rand';
		break;
	}
		
	//Get team items
	$args = array(
	    'numberposts' => $items,
	    'order' => $team_order,
	    'orderby' => $team_order_by,
	    'post_type' => array('team'),
	);
	
	if(!empty($cat))
	{
		$args['teamcats'] = $cat;
	}
	$team_arr = get_posts($args);
	
	if(!empty($team_arr) && is_array($team_arr))
	{
	
		foreach($team_arr as $key => $member)
		{
			$card_number = $key+1;
		
			$return_html.= '<div class="team_card_wrapper" ';
			
			if(!empty($card_bgcolor))
			{
				$return_html.= 'style="background-color:'.esc_attr($card_bgcolor).'"';
			}
			
			$return_html.= '>';
		
			$image_url = '';
			$member_ID = $member->ID;
					
			if(has_post_thumbnail($member_ID, 'tg_grid'))
			{
			    $image_id = get_post_thumbnail_id($member_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'tg_grid', true);
			}
			
			//Begin display HTML
			$return_html.= '<div class="one_third_bg nopadding team_photo ';
			
			if ($card_number % 2 == 0) 
			{
				$return_html.= 'floatright';
			}
			
			$return_html.= '">';
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt=""/>';
			}
			
			$return_html.= '</div>';
			
			$return_html.= '<div class="two_third_bg team" ';
			
			if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
			
			$return_html.= '>';
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			//Display team member detail
            $return_html.= '<h3 ';
            
            if(!empty($fontcolor))
			{
				$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
			}
            
            $return_html.= '>'.$member->post_title.'</h3>';
            if(!empty($team_position))
            {
            	$return_html.= '<div class="post_detail" ';
            	
            	if(!empty($fontcolor))
				{
					$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
				}
            	
            	$return_html.= '>'.$team_position.'</div>';
            }
            
            if(!empty($member->post_content))
            {
            	$return_html.= '<div class="team_content">'.$member->post_content.'</div>';
            }
            
            $member_facebook = get_post_meta($member_ID, 'member_facebook', true);
			$member_twitter = get_post_meta($member_ID, 'member_twitter', true);
			$member_google = get_post_meta($member_ID, 'member_google', true);
			$member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
            
            if(!empty($member_facebook) OR !empty($member_twitter) OR !empty($member_google) OR !empty($member_linkedin))
			{
			    $return_html.= '<ul class="social_wrapper team">';
			    
			    $social_font_color = '';
			    if(!empty($fontcolor))
				{
					$social_font_color = 'style="color:'.$fontcolor.';"';
				}
			    
			    if(!empty($member_twitter))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Twitter" target="_blank" class="tooltip" href="http://twitter.com/'.$member_twitter.'" '.$social_font_color.'><i class="fa fa-twitter"></i></a></li>';
			    }
	 
			    if(!empty($member_facebook))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Facebook" target="_blank" class="tooltip" href="http://facebook.com/'.$member_facebook.'" '.$social_font_color.'><i class="fa fa-facebook"></i></a></li>';
			    }
			    
			    if(!empty($member_google))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Google+" target="_blank" class="tooltip" href="'.$member_google.'" '.$social_font_color.'><i class="fa fa-google-plus"></i></a></li>';
			    }
			        
			    if(!empty($member_linkedin))
			    {
			        $return_html.= '<li><a title="'.esc_attr($member->post_title).' on Linkedin" target="_blank" class="tooltip" href="'.$member_linkedin.'" '.$social_font_color.'><i class="fa fa-linkedin"></i></a></li>';
			    }
			    
			    $return_html.= '</ul>';
			}
			
			$return_html.= '</div><br class="clear"/>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div></div>';
	
	return $return_html;
}

add_shortcode('ppb_team_card', 'ppb_team_card_func');


function ppb_promo_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'button_text' => '',
		'button_url' => '',
		'background_color' => '',
	), $atts));
	
	$return_html = '<div class="one skinbg" ';
	
	if(!empty($background_color))
	{
		$return_html.= 'style="background:'.esc_attr($background_color).'"';
	}
	
	$return_html.= '>';
	$return_html.='<div class="page_content_wrapper promo_box_wrapper">';
	$return_html.= do_shortcode('[tg_promo_box title="'.$title.'" button_text="'.urldecode($button_text).'" button_url="'.esc_url($button_url).'" button_style="button transparent"]'.$content.'[/tg_promo_box]');
	$return_html.='</div></div>';
	
	return $return_html;
}

add_shortcode('ppb_promo_box', 'ppb_promo_box_func');


function ppb_testimonial_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'items' => '',
		'cat' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'background' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	wp_enqueue_script("flexslider-js", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, THEMEVERSION, true);
	wp_enqueue_script("sciprt-testimonials-flexslider", get_template_directory_uri()."/templates/sciprt-testimonials-flexslider.php", false, THEMEVERSION, true);
	
	$testimonials_order = 'ASC';
	$testimonials_order_by = 'menu_order';
	
	//Get testimonial items
	$args = array(
	    'numberposts' => $items,
	    'order' => $testimonials_order,
	    'orderby' => $testimonials_order_by,
	    'post_type' => array('testimonials'),
	);
	
	if(!empty($cat))
	{
		$args['testimonialcats'] = $cat;
	}
	$testimonial_arr = get_posts($args);
	
	$return_html = '';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg ';
	}
	
	$return_html.= '" ';
	
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}

	if(!empty($background))
	{
		$custom_css.= 'background-image:url('.esc_url($background).');background-size:cover; ';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div class="page_content_wrapper" style="text-align:center"><div class="inner">';
	
	if(!empty($testimonial_arr) && is_array($testimonial_arr))
	{
		$return_html.= '<div class="testimonial_slider_wrapper">';
		$return_html.= '<div class="flexslider" data-height="750">';
		$return_html.= '<ul class="slides">';
		
		foreach($testimonial_arr as $key => $testimonial)
		{
			$testimonial_ID = $testimonial->ID;
		
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
			
			$return_html.= '<li>';
			$return_html.= '<div class="testimonial_slider_wrapper">';
			$return_html.= '<div class="testimonial_stars">';
			$return_html.= '<i class="fa fa-star"></i>';
			$return_html.= '<i class="fa fa-star"></i>';
			$return_html.= '<i class="fa fa-star"></i>';
			$return_html.= '<i class="fa fa-star"></i>';
			$return_html.= '<i class="fa fa-star"></i>';
			$return_html.= '</div>';
			
			if(!empty($testimonial->post_content))
			{
				$return_html.= $testimonial->post_content;
			}
			
			if(!empty($testimonial_name))
			{
				$return_html.= '<div class="testimonial_slider_meta">';
				
				//Get customer picture
				$small_image_url = array();
				
				if(has_post_thumbnail($testimonial_ID, 'thumbnail'))
				{
				    $image_id = get_post_thumbnail_id($testimonial_ID);
				    $small_image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
				}
				
				if(!empty($small_image_url[0]))
				{
					$return_html.= '<div class="testimonial_image animated" data-animation="bigEntrance">';
					$return_html.='<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($testimonial_name).'"/>';
					$return_html.= '</div>';
				}
				
				$return_html.= '<span class="post_detail" ';
				
				if(!empty($fontcolor))
				{
				    $return_html.= 'style="color:'.esc_attr($fontcolor).'"';
				}
				
				$return_html.= '>'.$testimonial_name.'</span>';
				
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
			$return_html.= '</li>';
		}
		
		$return_html.= '</ul>';
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_testimonial_slider', 'ppb_testimonial_slider_func');


function ppb_testimonial_column_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'slug' => '',
		'columns' => 2,
		'items' => 4,
		'cat' => '',
		'fontcolor' => '',
		'bgcolor' => '',
		'padding' => 30,
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	if(!is_numeric($columns))
	{
		$columns = 2;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_testimonial_column"';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	if(!empty($bgcolor))
	{
		$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= ' style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$testimonials_order = 'ASC';
	$testimonials_order_by = 'menu_order';
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}
	
	//Get testimonial items
	$args = array(
	    'numberposts' => $items,
	    'order' => $testimonials_order,
	    'orderby' => $testimonials_order_by,
	    'post_type' => array('testimonials'),
	);
	
	if(!empty($cat))
	{
		$args['testimonialcats'] = $cat;
	}
	$testimonial_arr = get_posts($args);
	
	if(!empty($testimonial_arr) && is_array($testimonial_arr))
	{
		$return_html.= '<div class="page_content_wrapper"><div class="inner"><div class="testimonial_wrapper">';
	
		foreach($testimonial_arr as $key => $testimonial)
		{
			$image_url = '';
			$testimonial_ID = $testimonial->ID;
					
			//Get customer picture
			if(has_post_thumbnail($testimonial_ID, 'thumbnail'))
			{
			    $image_id = get_post_thumbnail_id($testimonial_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
			}
			
			$last_class = '';
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="'.esc_attr($columns_class).' testimonial_column_element animated'.($key+1).' '.esc_attr($last_class).'">';
			
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
			$testimonial_position = get_post_meta($testimonial_ID, 'testimonial_position', true);
			$testimonial_company_name = get_post_meta($testimonial_ID, 'testimonial_company_name', true);
			$testimonial_company_website = get_post_meta($testimonial_ID, 'testimonial_company_website', true);
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="testimonial_image animated" data-animation="bigEntrance">';
				$return_html.='<img class="team_pic" src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($testimonial_name).'"/>';
				$return_html.= '</div>';
			}
			
			if(!empty($testimonial->post_content))
			{
				$return_html.= '<div class="testimonial_content">';
				$return_html.= $testimonial->post_content;
				
				if(!empty($testimonial_name))
				{
					$return_html.= '<div class="testimonial_customer">';
					$return_html.= '<h5 ';
					
					if(!empty($fontcolor))
					{
						$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
					}
					
					$return_html.= '>'.$testimonial_name.'</h5>';
					
					if(!empty($testimonial_position))
					{
						$return_html.= '<div class="testimonial_customer_position" ';
						
						if(!empty($fontcolor))
						{
							$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
						}
						
						$return_html.= '>'.$testimonial_position.'</div>';
					}
					
					if(!empty($testimonial_company_name))
					{
						$return_html.= '-<div class="testimonial_customer_company">';
						
						if(!empty($testimonial_company_website))
						{
							$return_html.= '<a href="'.esc_url($testimonial_company_website).'" target="_blank" ';
							
							if(!empty($fontcolor))
							{
								$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
							}
							
							$return_html.= '>';
						}
						
						$return_html.=$testimonial_company_name;
						
						if(!empty($testimonial_company_website))
						{
							$return_html.= '</a>';
						}
						
						$return_html.= '</div>';
					}
					
					$return_html.= '</div>';
				}
				
				$return_html.= '</div>';
			}
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div></div></div>';
	}
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_testimonial_column', 'ppb_testimonial_column_func');


function ppb_contact_map_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'popup' => '',
		'address' => '',
		'marker' => '',
		'bgcolor' => '',
		'fontcolor' => '',
		'buttonbgcolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="one nopadding" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="floatleft nopadding" style="width:100%;"><div class="one_half_bg contact_form" ';
	
	$contact_form_custom_css = '';
	if(!empty($bgcolor))
	{
		$contact_form_custom_css.= 'background-color:'.esc_attr($bgcolor).';';
	}
	if(!empty($fontcolor))
	{
		$contact_form_custom_css.= 'color:'.esc_attr($fontcolor).';';
	}
	
	if(!empty($contact_form_custom_css))
	{
		$return_html.= 'style="'.esc_attr($contact_form_custom_css).'"';
	}
	
	$return_html.= '>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title" ';
		if(!empty($fontcolor))
		{
			$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		}
		$return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
	}
	
	//Display Content
	if(!empty($subtitle))
	{
		$return_html.= '<div class="ppb_subtitle" ';
		if(!empty($fontcolor))
		{
			$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		}
		$return_html.= '>'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($title) OR !empty($subtitle))
	{
		$return_html.= '<div class="page_header_sep left"></div>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_content">'.urldecode($content).'</div>';
	}
	
	//Display contact form
	//Get contact form random ID
	$custom_id = time().rand();
    $pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    
    //Setup Google Map API Key
	grandrestaurant_set_map_api();
    
    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);
    
    wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => admin_url('admin-ajax.php'),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);

    $return_html.= '<div id="reponse_msg_'.$custom_id.'" class="contact_form_response"><ul></ul></div>';
    
    $return_html.= '<form id="contact_form_'.$custom_id.'" class="contact_form_wrapper" method="post" action="/wp-admin/admin-ajax.php">';
	$return_html.= '<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>';

    if(is_array($pp_contact_form) && !empty($pp_contact_form))
    {
        foreach($pp_contact_form as $form_input)
        {
        	switch($form_input)
        	{
    				case 1:
    				
    				$return_html.= '<label for="your_name">'.__( 'Name *', PLUGINDOMAIN ).'</label>
    				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="'.__( 'Name *', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 2:
    				
    				$return_html.= '<label for="email">'.__( 'Email *', PLUGINDOMAIN ).'</label>
    				<input id="email" name="email" type="text" class="required_field email" placeholder="'.__( 'Email *', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 3:
    				
    				$return_html.= '<label for="message">'.__( 'Message *', PLUGINDOMAIN ).'</label>
    				<textarea id="message" name="message" rows="7" cols="10" class="required_field" style="width:96%;" placeholder="'.__( 'Message *', PLUGINDOMAIN ).'"></textarea>
    				';	

    				break;
    				
    				case 4:
    				
    				$return_html.= '<label for="address">'.__( 'Address', PLUGINDOMAIN ).'</label>
    				<input id="address" name="address" type="text" placeholder="'.__( 'Address', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 5:
    				
    				$return_html.= '<label for="phone">'.__( 'Phone', PLUGINDOMAIN ).'</label>
    				<input id="phone" name="phone" type="text" placeholder="'.__( 'Phone', PLUGINDOMAIN ).'"/>
    				';

    				break;
    				
    				case 6:
    				
    				$return_html.= '<label for="mobile">'.__( 'Mobile', PLUGINDOMAIN ).'</label>
    				<input id="mobile" name="mobile" type="text" placeholder="'.__( 'Mobile', PLUGINDOMAIN ).'"/>
    				';		

    				break;
    				
    				case 7:
    				
    				$return_html.= '<label for="company">'.__( 'Company Name', PLUGINDOMAIN ).'</label>
    				<input id="company" name="company" type="text" placeholder="'.__( 'Company Name', PLUGINDOMAIN ).'"/>
    				';

    				break;
    				
    				case 8:
    				
    				$return_html.= '<label for="country">'.__( 'Country', PLUGINDOMAIN ).'</label>				
    				<input id="country" name="country" type="text" placeholder="'.__( 'Country', PLUGINDOMAIN ).'"/>
    				';
    				break;
    			}
    		}
    	}

    	$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
    	
    	if(!empty($pp_contact_enable_captcha))
    	{
    	
    	$return_html.= '<div id="captcha-wrap">
    		<div class="captcha-box">
    			<img src="'.get_template_directory_uri().'/get_captcha.php" alt="" id="captcha" />
    		</div>
    		<div class="text-box">
    			<label>Type the two words:</label>
    			<input name="captcha-code" type="text" id="captcha-code">
    		</div>
    		<div class="captcha-action">
    			<img src="'.get_template_directory_uri().'/images/refresh.jpg"  alt="" id="captcha-refresh" />
    		</div>
    	</div>
    	<br class="clear"/><br/>';
    
    }
    
    $return_html.= '<br/><br/><div class="contact_submit_wrapper">
    	<input id="contact_submit_btn'.$custom_id.'" name="contact_submit_btn'.$custom_id.'" type="submit" class="solidbg" value="'.__( 'Send', PLUGINDOMAIN ).'" ';
	
	if(!empty($buttonbgcolor))
	{
		$return_html.= 'style="background-color:'.esc_attr($buttonbgcolor).';border-color:'.esc_attr($buttonbgcolor).'; ';
		
		if(!empty($fontcolor))
		{
			$return_html.= 'color:'.esc_attr($fontcolor).'; ';
		}
		
		$return_html.= '"';
	}
	
    $return_html.= '/>
    </div>';
    
	$return_html.= '</form>';
	
	
	$return_html.= '</div>';
	
	//Display Map
	$return_html.= '<div class="one_half_bg nopadding" style="height:100%">';
	$return_html.= '<div id="map'.$custom_id.'" class="map_shortcode_wrapper" style="width:100%;height:100%">';
	$return_html.= '<div class="map-marker" ';
	
	if(!empty($popup))
	{
		$return_html.= 'data-title="'.esc_attr(urldecode($popup)).'" ';
	}
	
	if(!empty($lat) && !empty($long))
	{
		$return_html.= 'data-latlng="'.esc_attr(urldecode($lat)).','.esc_attr(urldecode($long)).'" ';
	}
	
	if(!empty($address))
	{
		$return_html.= 'data-address="'.esc_attr(urldecode($address)).'" ';
	}
	
	if(!empty($marker))
	{
		$return_html.= 'data-icon="'.esc_attr(urldecode($marker)).'" ';
	}
		
	$return_html.= '>';
	
	if(!empty($popup))
	{
		$return_html.= '<div class="map-infowindow">'.urldecode($popup).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => 'ROADMAP',
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, get_template_directory_uri()."/templates/script-map-shortcode.php?fullheight=true&data=".$ext_attr_serialize, false, THEMEVERSION, true);
	$return_html.= '</div>';
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_contact_map', 'ppb_contact_map_func');


function ppb_contact_sidebar_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'sidebar' => '',
		'sidebar_layout' => 'right',
		'padding' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '';
	$return_html.= '<div class="standard_wrapper">';
	$return_html.= '<div '.$sec_id.' class="one withsmallpadding" ';
	
	$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner"><div class="inner_wrapper"><div class="sidebar_content full_width nopadding">';
	
	$return_html.= '<div class="sidebar_content '.esc_attr($sidebar_layout).'_sidebar page_content">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.urldecode(tg_get_first_title_word($title)).'</h2>';
	}
	
	//Display Content
	if(!empty($subtitle))
	{
		$return_html.= '<div class="ppb_subtitle">'.urldecode($subtitle).'</div>';
	}
	
	if(!empty($title) OR !empty($subtitle))
	{
		$return_html.= '<div class="page_header_sep left"></div>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="ppb_content">'.urldecode($content).'</div>';
	}
	
	//Display contact form
	//Get contact form random ID
	$custom_id = time().rand();
    $pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);
    
    wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => admin_url('admin-ajax.php'),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);

    $return_html.= '<div id="reponse_msg_'.$custom_id.'" class="contact_form_response"><ul></ul></div>';
    
    $return_html.= '<form id="contact_form_'.$custom_id.'" class="contact_form_wrapper" method="post" action="/wp-admin/admin-ajax.php">';
	$return_html.= '<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>';

    if(is_array($pp_contact_form) && !empty($pp_contact_form))
    {
        foreach($pp_contact_form as $form_input)
        {
        	switch($form_input)
        	{
    				case 1:
    				
    				$return_html.= '<label for="your_name">'.__( 'Name *', PLUGINDOMAIN ).'</label>
    				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="'.__( 'Name *', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 2:
    				
    				$return_html.= '<label for="email">'.__( 'Email *', PLUGINDOMAIN ).'</label>
    				<input id="email" name="email" type="text" class="required_field email" placeholder="'.__( 'Email *', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 3:
    				
    				$return_html.= '<label for="message">'.__( 'Message *', PLUGINDOMAIN ).'</label>
    				<textarea id="message" name="message" rows="7" cols="10" class="required_field" style="width:95.5%;" placeholder="'.__( 'Message *', PLUGINDOMAIN ).'"></textarea>
    				';	

    				break;
    				
    				case 4:
    				
    				$return_html.= '<label for="address">'.__( 'Address', PLUGINDOMAIN ).'</label>
    				<input id="address" name="address" type="text" placeholder="'.__( 'Address', PLUGINDOMAIN ).'"/>
    				';	

    				break;
    				
    				case 5:
    				
    				$return_html.= '<label for="phone">'.__( 'Phone', PLUGINDOMAIN ).'</label>
    				<input id="phone" name="phone" type="text" placeholder="'.__( 'Phone', PLUGINDOMAIN ).'"/>
    				';

    				break;
    				
    				case 6:
    				
    				$return_html.= '<label for="mobile">'.__( 'Mobile', PLUGINDOMAIN ).'</label>
    				<input id="mobile" name="mobile" type="text" placeholder="'.__( 'Mobile', PLUGINDOMAIN ).'"/>
    				';		

    				break;
    				
    				case 7:
    				
    				$return_html.= '<label for="company">'.__( 'Company Name', PLUGINDOMAIN ).'</label>
    				<input id="company" name="company" type="text" placeholder="'.__( 'Company Name', PLUGINDOMAIN ).'"/>
    				';

    				break;
    				
    				case 8:
    				
    				$return_html.= '<label for="country">'.__( 'Country', PLUGINDOMAIN ).'</label>				
    				<input id="country" name="country" type="text" placeholder="'.__( 'Country', PLUGINDOMAIN ).'"/>
    				';
    				break;
    			}
    		}
    	}

    	$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
    	
    	if(!empty($pp_contact_enable_captcha))
    	{
    	
    	$return_html.= '<div id="captcha-wrap">
    		<div class="captcha-box">
    			<img src="'.get_template_directory_uri().'/get_captcha.php" alt="" id="captcha" />
    		</div>
    		<div class="text-box">
    			<label>Type the two words:</label>
    			<input name="captcha-code" type="text" id="captcha-code">
    		</div>
    		<div class="captcha-action">
    			<img src="'.get_template_directory_uri().'/images/refresh.jpg"  alt="" id="captcha-refresh" />
    		</div>
    	</div>
    	<br class="clear"/><br/>';
    
    }
    
    $return_html.= '<br/><br/><div class="contact_submit_wrapper">
    	<input id="contact_submit_btn'.$custom_id.'" name="contact_submit_btn'.$custom_id.'" type="submit" class="solidbg" value="'.__( 'Send', PLUGINDOMAIN ).'"/>
    </div>';
    
	$return_html.= '</form>';
	
	
	$return_html.= '</div>';
	
	//Display Sidebar
	$return_html.= '<div class="sidebar_wrapper '.esc_attr($sidebar_layout).'_sidebar"><div class="sidebar"><div class="content"><ul class="sidebar_widget">';
	$return_html.= get_dynamic_sidebar(urldecode($sidebar));
	$return_html.= '</ul></div></div></div>';
	
	$return_html.= '</div></div></div></div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_contact_sidebar', 'ppb_contact_sidebar_func');


function ppb_contact_parallax_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slug' => '',
		'subtitle' => '',
		'image_width' => 50,
		'image' => '',
		'align' => 1,
		'content_width' => 50,
		'padding' => 0,
		'bgcolor' => '#fff',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($image_width))
	{
		$image_width = 50;
	}
	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	//Get content block custom CSS
	$content_custom_css = 'background:'.esc_attr($bgcolor).';';
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div class="page_content_wrapper"><div class="inner">';
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half parallax_scroll_image" style="width:'.esc_attr($image_width).'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;right:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		
		//Display contact form
		//Get contact form random ID
		$custom_id = time().rand();
	    $pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
	    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);
	    
	    wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
		$params = array(
		  'ajaxurl' => admin_url('admin-ajax.php'),
		  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
		);
		wp_localize_script( 'script-contact-form', 'tgAjax', $params );
		wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
	
	    $return_html.= '<div id="reponse_msg_'.$custom_id.'" class="contact_form_response"><ul></ul></div>';
	    
	    $return_html.= '<form id="contact_form_'.$custom_id.'" class="contact_form_wrapper" method="post" action="/wp-admin/admin-ajax.php">';
		$return_html.= '<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>';
	
	    if(is_array($pp_contact_form) && !empty($pp_contact_form))
	    {
	        foreach($pp_contact_form as $form_input)
	        {
	        	switch($form_input)
	        	{
	    				case 1:
	    				
	    				$return_html.= '<label for="your_name">'.__( 'Name *', PLUGINDOMAIN ).'</label>
	    				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="'.__( 'Name *', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 2:
	    				
	    				$return_html.= '<label for="email">'.__( 'Email *', PLUGINDOMAIN ).'</label>
	    				<input id="email" name="email" type="text" class="required_field email" placeholder="'.__( 'Email *', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 3:
	    				
	    				$return_html.= '<label for="message">'.__( 'Message *', PLUGINDOMAIN ).'</label>
	    				<textarea id="message" name="message" rows="7" cols="10" class="required_field" style="width:95.5%;" placeholder="'.__( 'Message *', PLUGINDOMAIN ).'"></textarea>
	    				';	
	
	    				break;
	    				
	    				case 4:
	    				
	    				$return_html.= '<label for="address">'.__( 'Address', PLUGINDOMAIN ).'</label>
	    				<input id="address" name="address" type="text" placeholder="'.__( 'Address', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 5:
	    				
	    				$return_html.= '<label for="phone">'.__( 'Phone', PLUGINDOMAIN ).'</label>
	    				<input id="phone" name="phone" type="text" placeholder="'.__( 'Phone', PLUGINDOMAIN ).'"/>
	    				';
	
	    				break;
	    				
	    				case 6:
	    				
	    				$return_html.= '<label for="mobile">'.__( 'Mobile', PLUGINDOMAIN ).'</label>
	    				<input id="mobile" name="mobile" type="text" placeholder="'.__( 'Mobile', PLUGINDOMAIN ).'"/>
	    				';		
	
	    				break;
	    				
	    				case 7:
	    				
	    				$return_html.= '<label for="company">'.__( 'Company Name', PLUGINDOMAIN ).'</label>
	    				<input id="company" name="company" type="text" placeholder="'.__( 'Company Name', PLUGINDOMAIN ).'"/>
	    				';
	
	    				break;
	    				
	    				case 8:
	    				
	    				$return_html.= '<label for="country">'.__( 'Country', PLUGINDOMAIN ).'</label>				
	    				<input id="country" name="country" type="text" placeholder="'.__( 'Country', PLUGINDOMAIN ).'"/>
	    				';
	    				break;
	    			}
	    		}
	    	}
	
	    	$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
	    	
	    	if(!empty($pp_contact_enable_captcha))
	    	{
	    	
	    	$return_html.= '<div id="captcha-wrap">
	    		<div class="captcha-box">
	    			<img src="'.get_template_directory_uri().'/get_captcha.php" alt="" id="captcha" />
	    		</div>
	    		<div class="text-box">
	    			<label>Type the two words:</label>
	    			<input name="captcha-code" type="text" id="captcha-code">
	    		</div>
	    		<div class="captcha-action">
	    			<img src="'.get_template_directory_uri().'/images/refresh.jpg"  alt="" id="captcha-refresh" />
	    		</div>
	    	</div>
	    	<br class="clear"/><br/>';
	    
	    }
	    
	    $return_html.= '<br/><br/><div class="contact_submit_wrapper">
	    	<input id="contact_submit_btn'.$custom_id.'" name="contact_submit_btn'.$custom_id.'" type="submit" class="solidbg" value="'.__( 'Send', PLUGINDOMAIN ).'"/>
	    </div>';
	    
		$return_html.= '</form>';
		
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;left:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;z-index:2;block !important;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		
		//Display contact form
		//Get contact form random ID
		$custom_id = time().rand();
	    $pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
	    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);
	    
	    wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
		$params = array(
		  'ajaxurl' => admin_url('admin-ajax.php'),
		  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
		);
		wp_localize_script( 'script-contact-form', 'tgAjax', $params );
		wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php?form=".$custom_id, false, THEMEVERSION, true);
	
	    $return_html.= '<div id="reponse_msg_'.$custom_id.'" class="contact_form_response"><ul></ul></div>';
	    
	    $return_html.= '<form id="contact_form_'.$custom_id.'" class="contact_form_wrapper" method="post" action="/wp-admin/admin-ajax.php">';
		$return_html.= '<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>';
	
	    if(is_array($pp_contact_form) && !empty($pp_contact_form))
	    {
	        foreach($pp_contact_form as $form_input)
	        {
	        	switch($form_input)
	        	{
	    				case 1:
	    				
	    				$return_html.= '<label for="your_name">'.__( 'Name *', PLUGINDOMAIN ).'</label>
	    				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="'.__( 'Name *', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 2:
	    				
	    				$return_html.= '<label for="email">'.__( 'Email *', PLUGINDOMAIN ).'</label>
	    				<input id="email" name="email" type="text" class="required_field email" placeholder="'.__( 'Email *', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 3:
	    				
	    				$return_html.= '<label for="message">'.__( 'Message *', PLUGINDOMAIN ).'</label>
	    				<textarea id="message" name="message" rows="7" cols="10" class="required_field" style="width:95.5%;" placeholder="'.__( 'Message *', PLUGINDOMAIN ).'"></textarea>
	    				';	
	
	    				break;
	    				
	    				case 4:
	    				
	    				$return_html.= '<label for="address">'.__( 'Address', PLUGINDOMAIN ).'</label>
	    				<input id="address" name="address" type="text" placeholder="'.__( 'Address', PLUGINDOMAIN ).'"/>
	    				';	
	
	    				break;
	    				
	    				case 5:
	    				
	    				$return_html.= '<label for="phone">'.__( 'Phone', PLUGINDOMAIN ).'</label>
	    				<input id="phone" name="phone" type="text" placeholder="'.__( 'Phone', PLUGINDOMAIN ).'"/>
	    				';
	
	    				break;
	    				
	    				case 6:
	    				
	    				$return_html.= '<label for="mobile">'.__( 'Mobile', PLUGINDOMAIN ).'</label>
	    				<input id="mobile" name="mobile" type="text" placeholder="'.__( 'Mobile', PLUGINDOMAIN ).'"/>
	    				';		
	
	    				break;
	    				
	    				case 7:
	    				
	    				$return_html.= '<label for="company">'.__( 'Company Name', PLUGINDOMAIN ).'</label>
	    				<input id="company" name="company" type="text" placeholder="'.__( 'Company Name', PLUGINDOMAIN ).'"/>
	    				';
	
	    				break;
	    				
	    				case 8:
	    				
	    				$return_html.= '<label for="country">'.__( 'Country', PLUGINDOMAIN ).'</label>				
	    				<input id="country" name="country" type="text" placeholder="'.__( 'Country', PLUGINDOMAIN ).'"/>
	    				';
	    				break;
	    			}
	    		}
	    	}
	
	    	$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
	    	
	    	if(!empty($pp_contact_enable_captcha))
	    	{
	    	
	    	$return_html.= '<div id="captcha-wrap">
	    		<div class="captcha-box">
	    			<img src="'.get_template_directory_uri().'/get_captcha.php" alt="" id="captcha" />
	    		</div>
	    		<div class="text-box">
	    			<label>Type the two words:</label>
	    			<input name="captcha-code" type="text" id="captcha-code">
	    		</div>
	    		<div class="captcha-action">
	    			<img src="'.get_template_directory_uri().'/images/refresh.jpg"  alt="" id="captcha-refresh" />
	    		</div>
	    	</div>
	    	<br class="clear"/><br/>';
	    
	    }
	    
	    $return_html.= '<br/><br/><div class="contact_submit_wrapper">
	    	<input id="contact_submit_btn'.$custom_id.'" name="contact_submit_btn'.$custom_id.'" type="submit" class="solidbg" value="'.__( 'Send', PLUGINDOMAIN ).'"/>
	    </div>';
	    
		$return_html.= '</form>';
		
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half parallax_scroll_image last" style="width:'.$image_width.'%;">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
			
			$image_id = pp_get_image_id($image);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" class="portfolio_img" alt="'.esc_attr($image_alt).'"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('ppb_contact_parallax', 'ppb_contact_parallax_func');


function ppb_map_func($atts) {
	//extract short code attr
	extract(shortcode_atts(array(
		'height' => 600,
		'slug' => '',
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'popup' => '',
		'address' => '',
		'marker' => '',
		'builder_id' => '',
	), $atts));
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}
	
	$return_html = '<div '.$sec_id.' class="one nopadding">';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);

	$custom_id = time().rand();
	$return_html = '<div class="map_shortcode_wrapper" id="map'.$custom_id.'" style="width:100%;height:'.esc_attr($height).'px">';
	$return_html.= '<div class="map-marker" ';
	
	if(!empty($popup))
	{
		$return_html.= 'data-title="'.esc_attr(urldecode($popup)).'" ';
	}
	
	if(!empty($lat) && !empty($long))
	{
		$return_html.= 'data-latlng="'.esc_attr(urldecode($lat)).','.esc_attr(urldecode($long)).'" ';
	}
	
	if(!empty($address))
	{
		$return_html.= 'data-address="'.esc_attr(urldecode($address)).'" ';
	}
	
	if(!empty($marker))
	{
		$return_html.= 'data-icon="'.esc_attr(urldecode($marker)).'" ';
	}
		
	$return_html.= '>';
	
	if(!empty($popup))
	{
		$return_html.= '<div class="map-infowindow">'.urldecode($popup).'</div>';
	}
	
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => 'ROADMAP',
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	//Setup Google Map API Key
	grandrestaurant_set_map_api();
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, get_template_directory_uri()."/templates/script-map-shortcode.php?data=".$ext_attr_serialize, false, THEMEVERSION, true);

	return $return_html;

}

add_shortcode('ppb_map', 'ppb_map_func');


function ppb_map_content_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'subtitle' => '',
		'slug' => '',
		'map_width' => 50,
		'map_height' => 500,
		'lat' => 0,
		'long' => 0,
		'zoom' => 8,
		'type' => '',
		'popup' => '',
		'address' => '',
		'marker' => '',
		'align' => 1,
		'content_width' => 50,
		'padding' => 0,
		'bgcolor' => '#fff',
		'fontcolor' => '',
		'bordercolor' => '',
		'custom_css' => '',
		'builder_id' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($map_width))
	{
		$map_width = 50;
	}
	if(!is_numeric($content_width))
	{
		$content_width = 50;
	}
	
	if(empty($bgcolor))
	{
		$tg_content_bg_color = kirki_get_option('tg_content_bg_color');
		$bgcolor = $tg_content_bg_color;
	}
	
	$sec_id = '';
	if(!empty($slug))
	{
		$sec_id = 'id="'.esc_attr($slug).'"';
	}

	$return_html = '<div '.$sec_id.' class="'.esc_attr($size).'" ';
	$custom_css.= 'position:relative;padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
	
	if(!empty($fontcolor))
	{
		$custom_css.= 'color:'.$fontcolor.';';
	}
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.esc_attr(urldecode($custom_css)).'" ';
	}
	
	//Get content block custom CSS
	$content_custom_css = 'background:'.esc_attr($bgcolor).';';
	
	if(!empty($bordercolor))
	{
	    $content_custom_css.= 'border: 1px solid '.$bordercolor.';';
	}
	
	$return_html.= '>';
	
	//Set begin wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
	
	$return_html.= '<div class="standard_wrapper"><div><div class="inner">';
	
	//Get custom map ID
	$custom_id = time().rand();
	
	if($align=='left')
	{
		$return_html.= '<div class="parallax_scroll_image" id="map'.$custom_id.'" style="width:'.esc_attr($map_width).'%;height:'.esc_attr($map_height).'px;float:left;">';
		
		//Display map
		$return_html.= '<div class="map-marker" ';
	
		if(!empty($popup))
		{
			$return_html.= 'data-title="'.esc_attr(urldecode($popup)).'" ';
		}
		
		if(!empty($lat) && !empty($long))
		{
			$return_html.= 'data-latlng="'.esc_attr(urldecode($lat)).','.esc_attr(urldecode($long)).'" ';
		}
		
		if(!empty($address))
		{
			$return_html.= 'data-address="'.esc_attr(urldecode($address)).'" ';
		}
		
		if(!empty($marker))
		{
			$return_html.= 'data-icon="'.esc_attr(urldecode($marker)).'" ';
		}
			
		$return_html.= '>';
		
		if(!empty($popup))
		{
			$return_html.= '<div class="map-infowindow">'.urldecode($popup).'</div>';
		}
		
		$return_html.= '</div>';
		
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;right:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="parallax_scroll" style="width:'.esc_attr($content_width).'%;position:absolute;left:90px;'.esc_attr($content_custom_css).'padding:'.esc_attr($padding).'px;z-index:2;block !important;" data-stellar-ratio="1.3">';
		
		//Display Title
		if(!empty($title))
		{
		    $return_html.= '<h2 class="ppb_title" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode(tg_get_first_title_word($title, $fontcolor)).'</h2>';
		}
		if(!empty($subtitle))
		{
		    $return_html.= '<div class="ppb_subtitle" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="color:'.esc_attr($fontcolor).';"';
		    }
		    $return_html.= '>'.urldecode($subtitle).'</div>';
		}
		
		if(!empty($title) OR !empty($subtitle))
		{
		    $return_html.= '<div class="page_header_sep left" ';
		    if(!empty($fontcolor))
		    {
		    	$return_html.= 'style="border-color:'.$fontcolor.'"';
		    }
		    $return_html.= '></div>';
		}
		
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="parallax_scroll_image last" id="map'.$custom_id.'" style="width:'.esc_attr($map_width).'%;height:'.esc_attr($map_height).'px;float:right;">';
		
		//Display map
		$return_html.= '<div class="map-marker" ';
	
		if(!empty($popup))
		{
			$return_html.= 'data-title="'.esc_attr(urldecode($popup)).'" ';
		}
		
		if(!empty($lat) && !empty($long))
		{
			$return_html.= 'data-latlng="'.esc_attr(urldecode($lat)).','.esc_attr(urldecode($long)).'" ';
		}
		
		if(!empty($address))
		{
			$return_html.= 'data-address="'.esc_attr(urldecode($address)).'" ';
		}
		
		if(!empty($marker))
		{
			$return_html.= 'data-icon="'.esc_attr(urldecode($marker)).'" ';
		}
			
		$return_html.= '>';
		
		if(!empty($popup))
		{
			$return_html.= '<div class="map-infowindow">'.urldecode($popup).'</div>';
		}
		
		$return_html.= '</div>';
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	//Set end wrapper div for live builder
	$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
	
	$return_html.= '</div>';
	
	//Initialize map
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'zoom' => $zoom,
		'type' => 'ROADMAP',
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	//Setup Google Map API Key
	grandrestaurant_set_map_api();
	
	wp_enqueue_script("simplegmaps", get_template_directory_uri()."/js/jquery.simplegmaps.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("script-contact-map".$custom_id, get_template_directory_uri()."/templates/script-map-shortcode.php?data=".$ext_attr_serialize, false, THEMEVERSION, true);

	return $return_html;

}

add_shortcode('ppb_map_content', 'ppb_map_content_func');


//Check if Layer slider is installed	
$revslider = ABSPATH . '/wp-content/plugins/revslider/revslider.php';

// Check if the file is available to prevent warnings
$pp_revslider_activated = file_exists($revslider);

if($pp_revslider_activated)
{
	function ppb_revslider_func($atts, $content) {
	
		//extract short code attr
		extract(shortcode_atts(array(
			'size' => 'one',
			'slug' => '',
			'slider_id' => '',
			'display' => '',
			'builder_id' => '',
		), $atts));
		
		$sec_id = '';
		if(!empty($slug))
		{
			$sec_id = 'id="'.esc_attr($slug).'"';
		}
	
		$return_html = '<div '.$sec_id.' class="'.esc_attr($size).' fullwidth ';
		
		if($display == 'force')
		{
			$return_html.= 'slideronly';
		}
		
		$return_html.= '">';
		
		//Set begin wrapper div for live builder
		$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
		
		$return_html.= do_shortcode('[rev_slider '.$slider_id.']');
		
		//Set end wrapper div for live builder
		$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
		
		$return_html.= '</div>';
	
		return $return_html;
	
	}
	
	add_shortcode('ppb_revslider', 'ppb_revslider_func');
}

//Check if mailChimp is installed
$mailchimp = ABSPATH . '/wp-content/plugins/mailchimp-for-wp/mailchimp-for-wp.php';

// Check if the file is available to prevent warnings
$pp_mailchimp_activated = file_exists($mailchimp);

if($pp_mailchimp_activated)
{
	function ppb_mailchimp_subscription_func($atts, $content) {

		//extract short code attr
		extract(shortcode_atts(array(
			'size' => 'one',
			'title' => '',
			'slug' => '',
			'padding' => 30,
			'background' => '',
			'background_position' => '',
			'mailchimp_id' => '',
			'fontcolor' => '',
			'custom_css' => '',
			'builder_id' => '',
		), $atts));
		
		$sec_id = '';
		if(!empty($slug))
		{
			$sec_id = 'id="'.esc_attr($slug).'"';
		}
	
		$return_html = '';
		
		if($size!='one')
		{
			$return_html.= '<div class="standard_wrapper">';
		}
		
		$return_html.= '<div '.$sec_id.' class="'.esc_attr($size).' withsmallpadding ppb_mailchimp_subscription ';
		
		if(!empty($background))
		{
			$return_html.= 'withbg ';
			$custom_css.= 'background-image:url('.esc_url($background).');';
		}
		
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.$fontcolor.';';
		}
		
		if(!empty($background_position))
		{
			$custom_css.= 'background-position: center '.esc_attr($background_position).';';
		}
		
		$return_html.= '"';
		
		$custom_css.= 'padding:'.esc_attr($padding).'px 0 '.esc_attr($padding).'px 0;';
		if(!empty($bgcolor))
		{
			$custom_css.= 'background-color:'.esc_attr($bgcolor).';';
		}
		if(!empty($fontcolor))
		{
			$custom_css.= 'color:'.esc_attr($fontcolor).' !important;';
		}
		
		if(!empty($custom_css))
		{
			$return_html.= ' style="'.esc_attr(rawurldecode($custom_css)).'" ';
		}
		
		$return_html.= '>';
		
		//Set begin wrapper div for live builder
		$return_html.= grandrestaurant_live_builder_begin_wrapper($builder_id);
		
		$return_html.= '<div class="standard_wrapper">';
		$return_html.= '<div class="page_content_wrapper"><div class="inner">';
		
		if(!empty($title))
		{
			if(empty($fontcolor))
			{
				$return_html.= '<h2 class="ppb_title">'.rawurldecode(tg_get_first_title_word($title)).'</h2>';
			}
			else
			{
				$return_html.= '<h2 class="ppb_title" style="color:'.$fontcolor.';">'.rawurldecode(tg_get_first_title_word($title)).'</h2>';
			}
		}
	
		$return_html.= do_shortcode('[mc4wp_form id="'.intval($mailchimp_id).'"]').'</div>';
	
		$return_html.= '</div></div>';
		
		//Set end wrapper div for live builder
		$return_html.= grandrestaurant_live_builder_end_wrapper($builder_id);
		
		$return_html.= '</div>';
		
		if($size!='one')
		{
			$return_html.= '</div>';
		}
	
		return $return_html;
	
	}
	
	add_shortcode('ppb_mailchimp_subscription', 'ppb_mailchimp_subscription_func');
}
?>
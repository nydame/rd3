<?php
/*
Theme Name: Grand Restaurant Theme
Theme URI: http://themes.themegoods.com/grandrestaurant
Author: ThemeGoods
Author URI: http://themeforest.net/user/ThemeGoods
License: GPLv2
*/

//Setup theme default constant and data
require_once (get_template_directory() . "/lib/config.lib.php");

//Setup theme translation
require_once (get_template_directory() . "/lib/translation.lib.php");

//Setup theme admin action handler
require_once (get_template_directory() . "/lib/admin.action.lib.php");

//Setup theme support and image size handler
require_once (get_template_directory() . "/lib/theme.support.lib.php");

//Get custom function
require_once (get_template_directory() . "/lib/custom.lib.php");

//Setup menu settings
require_once (get_template_directory() . "/lib/menu.lib.php");

//Setup twitter related functions
require_once (get_template_directory() . "/lib/twitter.lib.php");

//Setup CSS compression related functions
require_once (get_template_directory() . "/lib/cssmin.lib.php");

//Setup JS compression related functions
require_once (get_template_directory() . "/lib/jsmin.lib.php");

//Setup Sidebar
require_once (get_template_directory() . "/lib/sidebar.lib.php");

//Setup theme custom widgets
require_once (get_template_directory() . "/lib/widgets.lib.php");

//Setup theme admin settings
require_once (get_template_directory() . "/lib/admin.lib.php");

//Setup theme custom filters
require_once (get_template_directory() . "/lib/theme.filter.lib.php");

//Setup required plugin activation
require_once (get_template_directory() . "/lib/tgm.lib.php");

//Setup Theme Customizer
include (get_template_directory() . "/modules/kirki/kirki.php");
include (get_template_directory() . "/lib/customizer.lib.php");

//Setup page custom fields and action handler
require_once (get_template_directory() . "/fields/page.fields.php");

//Setup content builder
require_once (get_template_directory() . "/modules/content_builder.php");

// Setup shortcode generator
require_once (get_template_directory() . "/modules/shortcode_generator.php");

// Setup Twitter API
require_once (get_template_directory() . "/modules/twitteroauth.php");


//Check if Woocommerce is installed	
if(class_exists('Woocommerce'))
{
	//Setup Woocommerce Config
	require_once (get_template_directory() . "/modules/woocommerce.php");
}

/**
*	Setup AJAX portfolio content builder function
**/
add_action('wp_ajax_grandrestaurant_ppb', 'grandrestaurant_ppb');
add_action('wp_ajax_nopriv_grandrestaurant_ppb', 'grandrestaurant_ppb');

function grandrestaurant_ppb() {

	if(is_admin() && isset($_GET['shortcode']) && !empty($_GET['shortcode']))
	{
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		//pp_debug($ppb_shortcodes);
		
		if(isset($ppb_shortcodes[$_GET['shortcode']]) && !empty($ppb_shortcodes[$_GET['shortcode']]))
		{
			$selected_shortcode = $_GET['shortcode'];
			$selected_shortcode_arr = $ppb_shortcodes[$_GET['shortcode']];
			//pp_debug($selected_shortcode_arr);
			
			//get action value
			$ppb_builder_remove_id = '';
			if(isset($_GET['builder_action']) && isset($_GET['builder_action']) == 'add')
			{
				$ppb_builder_remove_id = $_GET['rel'];
			}
?>
			<!-- Display button for this content -->
			<div class="ppb_inline_title_bar">
				<h2><?php echo esc_html($selected_shortcode_arr['title']); ?></h2>
			</div>
			
			<div class="ppb_inline_wrap">
			    <a id="save_<?php echo esc_attr($_GET['rel']); ?>" data-parent="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" class="button ppb_inline_save" href="javascript:;"><?php esc_html_e('Update', THEMEDOMAIN ); ?></a>
			    
			    <a class="button" href="javascript:;" onClick="cancelContent('<?php echo esc_attr($ppb_builder_remove_id); ?>');"><?php esc_html_e('Cancel', THEMEDOMAIN ); ?></a>
			    
			</div>
			
			<div id="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" data-shortcode="<?php echo esc_attr($selected_shortcode); ?>" class="ppb_inline">
			<div class="ppb_inline_option_wrap">
				<?php
					if(isset($selected_shortcode_arr['title']) && $selected_shortcode_arr['title']!='Divider')
					{
				?>
				<div class="ppb_inline_option">
					
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_title"><?php esc_html_e('Title', THEMEDOMAIN ); ?></label><br/>
						<span class="label_desc"><?php esc_html_e('Enter Title for this content', THEMEDOMAIN ); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input type="text" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="Title" class="ppb_input"/>
					</div>
				</div>
				<br/>
				<?php
					}
					else
					{
				?>
				<input type="hidden" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="<?php echo esc_attr($selected_shortcode_arr['title']); ?>" class="ppb_input"/>
				<?php
					}
				?>
				
				<?php
					$num_attr = count($selected_shortcode_arr['attr']);
					$i_count = 0;
				
					foreach($selected_shortcode_arr['attr'] as $attr_name => $attr_item)
					{
						$last_class = '';
						
						if(++$i_count === $num_attr && !isset($selected_shortcode_arr['content']))
						{
							$last_class = 'last';
						}
					
						if(!isset($attr_item['title']))
						{
							$attr_title = ucfirst($attr_name);
						}
						else
						{
							$attr_title = $attr_item['title'];
						}
					
						if($attr_item['type']=='jslider')
						{
				?>
				<div class="ppb_inline_option">
				
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="range" class="ppb_input" min="<?php echo esc_attr($attr_item['min']); ?>" max="<?php echo esc_attr($attr_item['max']); ?>" step="<?php echo esc_attr($attr_item['step']); ?>" value="<?php echo esc_attr($attr_item['std']); ?>" /><output for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" onforminput="value = foo.valueAsNumber;"></output><br/>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="jslider"/>
				</div>
				<br/>
				<?php
						}
				
						if($attr_item['type']=='file')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text"  class="ppb_input ppb_file" />
						<a id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>">Upload</a>
						<img id="image_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_file_image" />
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="file"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='video')
						{
				?>
				<div class="ppb_inline_option">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
				
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text"  class="ppb_input ppb_file" />
						<a id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>">Upload</a>
						
						<br/><a id="video_view_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="button ppb_video_url" target="_blank"><?php echo esc_html__('View Video', 'grandportfolio-translation' ); ?></a>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="video"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
						?>
								<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
								}
						?>
						</select>
					</div>	
					<br style="clear:both"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select_multiple')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input" multiple="multiple">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
									if(!empty($attr_item_option))
									{
						?>
									<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
									}
								}
						?>
						</select>
					</div>
					<br style="clear:both"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select_multiple"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='text')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo $attr_item['desc']; ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input" />
					
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="text"/>
					</div>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='colorpicker')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input color_picker" />
						<div id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($selected_shortcode); ?>_<?php echo esc_js($attr_name); ?>').click()" style="background-color:<?php echo esc_attr($attr_item['std']); ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png);margin-top:3px">&nbsp;</div><br style="clear:both"/>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="colorpicker"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='textarea')
						{
				?>
				<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
					<div class="ppb_inline_label">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
						<span class="label_desc"><?php echo esc_attr($attr_item['desc']); ?></span>
					</div>
					
					<div class="ppb_inline_field">
						<textarea name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" cols="" rows="3" class="ppb_input"></textarea>
					</div>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="textarea"/>
				</div>
				<br/>
				<?php
						}
					}
				?>
				
				<?php
					if(isset($selected_shortcode_arr['content']) && $selected_shortcode_arr['content'])
					{
						$last_class = 'last';
				?>
					<div class="ppb_inline_option <?php echo esc_attr($last_class); ?>">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_content"><?php esc_html_e('Content', THEMEDOMAIN ); ?></label><br/>
						<span class="label_desc"><?php esc_html_e('You can enter text, HTML for its content', THEMEDOMAIN ); ?></span><br/><br/>
						
						<textarea id="<?php echo esc_attr($selected_shortcode); ?>_content" name="<?php echo esc_attr($selected_shortcode); ?>_content" cols="" rows="5" class="ppb_input <?php if($_GET['builder_action'] == 'add') { ?>ppb_textarea<?php } ?>"></textarea>
						
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="content"/>
					</div>
				<?php
					}
				?>
			</div>
		</div>
		
		<script>
		jQuery(document).ready(function(){
			var formfield = '';
			
			ppbSetUnsaveStatus();
			
			if(jQuery('body').hasClass('ppb_duplicated'))
			{
				jQuery('.fancybox-inner .ppb_inline_wrap').addClass('duplicated');
			}
	
			jQuery('.metabox_upload_btn').click(function() {
			    jQuery('.fancybox-overlay').css('visibility', 'hidden');
			    jQuery('.fancybox-wrap').css('visibility', 'hidden');
		     	formfield = jQuery(this).attr('rel');
			    
			    var send_attachment_bkp = wp.media.editor.send.attachment;
			    wp.media.editor.send.attachment = function(props, attachment) {
			     	jQuery('#'+formfield).attr('value', attachment.url);
			     	jQuery('#image_'+formfield).attr('src', attachment.url);
			
			        wp.media.editor.send.attachment = send_attachment_bkp;
			        jQuery('.fancybox-overlay').css('visibility', 'visible');
			     	jQuery('.fancybox-wrap').css('visibility', 'visible');
			    }
			
			    wp.media.editor.open();
		     	return false;
		    });
		
			jQuery("#ppb_inline :input").each(function(){
				if(typeof jQuery(this).attr('id') != 'undefined')
				{
					 jQuery(this).attr('value', '');
				}
			});
			
			var currentItemData = jQuery('#<?php echo esc_js($_GET['rel']); ?>').data('ppb_setting');
			var currentItemOBJ = jQuery.parseJSON(currentItemData);
			
			jQuery.each(currentItemOBJ, function(index, value) { 
				if(typeof jQuery('#'+index) != 'undefined')
				{
					jQuery('#'+index).val(decodeURI(value));
					
					if(jQuery('#'+index).is('textarea'))
					{
					    jQuery('#'+index).html(decodeURI(value));
					    jQuery('#'+index).wp_editor();
					}
					
					//Check if color picker
					if(jQuery('#'+index).hasClass('color_picker'))
					{
						var inputID = jQuery('#'+index).attr('id');
						jQuery('#'+inputID+'_bg').css('backgroundColor', jQuery('#'+index).val());
					}
					
					//Check if in put file
					if(jQuery('#type_'+index).val()=='file')
					{
						jQuery('#image_'+index).attr('src', value);
					}
					
					//Check if in put video
					if(jQuery('#type_'+index).val()=='video')
					{
						jQuery('#video_view_'+index).attr('href', value);
					}
					
					//Check if multiple select
					if(jQuery('#type_'+index).val()=='select_multiple')
					{
						var data = value + '';
						var data_array = data.split(",");
						jQuery('#'+index).val(data_array);
					}
				}
			});
			
			jQuery('.color_picker').each(function()
			{	
			    var inputID = jQuery(this).attr('id');
			    
			    jQuery(this).ColorPicker({
			    	color: jQuery(this).val(),
			    	onShow: function (colpkr) {
			    		jQuery(colpkr).fadeIn(200);
			    		return false;
			    	},
			    	onHide: function (colpkr) {
			    		jQuery(colpkr).fadeOut(200);
			    		return false;
			    	},
			    	onChange: function (hsb, hex, rgb, el) {
			    		jQuery('#'+inputID).val('#' + hex);
			    		jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
			    	}
			    });	
			    
			    jQuery(this).css('width', '200px');
			    jQuery(this).css('float', 'left');
			});
			
			var el, newPoint, newPlace, offset;
 
			 jQuery("input[type='range']").change(function() {
			 
			   el = jQuery(this);
			   
			   width = el.width();
			   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
			   el.next("output").text(el.val());
			 })
			 .trigger('change');
			
			jQuery("#save_<?php echo esc_js($_GET['rel']); ?>").click(function(){
				//Save undo data to localstorage
				ppbAddHistory('undo');
			
				tinyMCE.triggerSave();
			
			    var targetItem = '<?php echo esc_js($_GET['rel']); ?>';
			    var parentInline = jQuery(this).attr('data-parent');
			    var currentItemData = jQuery('#'+targetItem).find('.ppb_setting_data').attr('value');
			    var currentShortcode = jQuery('#'+parentInline).attr('data-shortcode');
			    
			    var itemData = {};
			    itemData.id = targetItem;
			    itemData.shortcode = currentShortcode;
			    
			    jQuery("#"+parentInline+" :input.ppb_input").each(function(){
			     	if(typeof jQuery(this).attr('id') != 'undefined')
			     	{	
			    	 	if(jQuery(this).attr('multiple') != 'multiple')
			     		{
			    	 		itemData[jQuery(this).attr('id')] = encodeURI(jQuery(this).attr('value'));
			    	 	}
			    	 	else
			    	 	{
				    	 	itemData[jQuery(this).attr('id')] = jQuery(this).val();
			    	 	}
			    	 	
				    	 if(jQuery(this).attr('data-attr') == 'title')
				    	 {
				    	 	//Set saved module title
				    	 	var shortcodeName = jQuery('#'+targetItem).find('.title').find('.shortcode_title').html();
				    	 	
				    	 	var updatedShortcodeTitleDisplay = decodeURI(jQuery(this).attr('value'));
				    	 	if(updatedShortcodeTitleDisplay == '')
				    	 	{
					    	 	updatedShortcodeTitleDisplay = shortcodeName;
				    	 	}
				    	 	
				    	 	var updatedShortcodeTitle = '<div class="shortcode_title edited">'+updatedShortcodeTitleDisplay+'</div>';
				    	 	
				    	  	jQuery('#'+targetItem).find('.title').html(updatedShortcodeTitle);
				    	  	
				    	  	if(jQuery('#'+targetItem).find('.ppb_unsave').length==0)
				    	  	{
				    	  		ppbSetUnsaveStatus();
				    	  	}
				    	 }
			     	}
			    });
			    
			    var currentItemDataJSON = JSON.stringify(itemData);
			    jQuery('#'+targetItem).data('ppb_setting', currentItemDataJSON);
			    
			    //If in live mode
				if(isLiveMode())
				{
					//Save all content
					ppbSaveAll();
					
					//Set preview frame data
					ppbSetPreviewData();
						
					//Reload preview frame
					ppbReloadPreview();
				}
			    
			    refreshBuilderBlockEvents();
			    
			    jQuery.fancybox.close();
			});
			
			jQuery.fancybox.hideLoading();
		});
		</script>
<?php
		}
	}
	
	die();
}

/**
*	Begin theme custom AJAX calls handler
**/

/**
*	Setup AJAX portfolio content builder preview function
**/
add_action('wp_ajax_grandrestaurant_ppb_preview', 'grandrestaurant_ppb_preview');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_preview', 'grandrestaurant_ppb_preview');

function grandrestaurant_ppb_preview() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']) && isset($_GET['rel']) && !empty($_GET['rel']))
	{
		$page_id = $_GET['page_id'];
		$page_title = $_GET['title'];
		$ppb_form_item = $_GET['rel'];
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview=true&rel='.$ppb_form_item;
?>
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}

/**
*	Setup AJAX portfolio content builder preview page function
**/
add_action('wp_ajax_grandrestaurant_ppb_preview_page', 'grandrestaurant_ppb_preview_page');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_preview_page', 'grandrestaurant_ppb_preview_page');

function grandrestaurant_ppb_preview_page() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']))
	{
		$page_id = $_GET['page_id'];
		$page_title = get_the_title($page_id);
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview_page=true';
?>
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}


/**
*	Setup AJAX portfolio content builder set data for preview page function
**/
add_action('wp_ajax_grandrestaurant_ppb_preview_page_set_data', 'grandrestaurant_ppb_preview_page_set_data');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_preview_page_set_data', 'grandrestaurant_ppb_preview_page_set_data');

function grandrestaurant_ppb_preview_page_set_data() {
	
	if(is_admin() && isset($_POST['page_id']) && !empty($_POST['page_id']))
	{
		$page_id = $_POST['page_id'];
		$data = mb_convert_encoding($_POST['data'],'UTF-8','UTF-8');
		$data = json_decode($_POST['data']);
		//var_dump($_POST['data']);
		//var_dump($_POST['data_order']);
		$data_order = $_POST['data_order'];
		
		//Set data order to WordPress cache
		set_transient('grandrestaurant_'.$page_id.'_data_order', $data_order, 3600 );
		
		//Convert order data to array
		$ppb_form_item_arr = array();
		if(!empty($data_order))
		{
		    $ppb_form_item_arr = explode(',', $data_order);
		}
		
		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
		    $data_arr = array();
		    $size_arr = array();
		
		    foreach($ppb_form_item_arr as $key => $ppb_form_item)
		    {
		    	if(isset($_POST[$ppb_form_item.'_data']))
		    	{
			    	$data_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_data'];
			    	$size_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_size'];
		    	}
		    }
		}
		
		set_transient('grandrestaurant_'.$page_id.'_data', $data_arr, 3600 );
		set_transient('grandrestaurant_'.$page_id.'_size', $size_arr, 3600 );
?>
	
<?php
	}
	die();
}

/**
*	Setup preview demo page function
**/
add_action('wp_ajax_grandrestaurant_ppb_demo_preview', 'grandrestaurant_ppb_demo_preview');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_demo_preview', 'grandrestaurant_ppb_demo_preview');

function grandrestaurant_ppb_demo_preview() {
	if(is_admin() && isset($_POST['key']) && !empty($_POST['key']))
	{
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		
		if(isset($ppb_shortcodes[$_POST['key']]))
		{
			$page_title = $ppb_shortcodes[$_POST['key']]['title'];
			$preview_url = $ppb_shortcodes[$_POST['key']]['url'];
?>
	<div class="ppb_inline_wrap preview">
	    <h2><?php esc_html_e('Preview', THEMEDOMAIN ); ?> <?php echo urldecode($page_title); ?></h2>
	    <a class="button button-primary" href="javascript:;" onClick="jQuery.fancybox.close();"><?php esc_html_e('Close', THEMEDOMAIN ); ?></a>
	</div>	
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
		}
	}
	die();
}

/**
*	Setup live preview element function
**/
add_action('wp_ajax_grandrestaurant_ppb_get_live_preview', 'grandrestaurant_ppb_get_live_preview');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_get_live_preview', 'grandrestaurant_ppb_get_live_preview');

function grandrestaurant_ppb_get_live_preview() {

	if(is_admin() && isset($_POST['data']) && !empty($_POST['data']) && isset($_POST['size']) && !empty($_POST['size']))
	{
		$ppb_form_item = $_POST['rel'];
		$ppb_form_item_size = $_POST['size'];
		$ppb_form_item_data = $_POST['data'];
		$ppb_form_item_data = mb_convert_encoding($ppb_form_item_data,'UTF-8','UTF-8');
		$ppb_form_item_data_obj = json_decode(stripslashes($ppb_form_item_data));
	    $ppb_shortcode_content_name = $_GET['shortcode'];
	    $ppb_shortcode_code = '';
	    
	    /*print '<pre>';
	    print_r($ppb_form_item_data_obj);
	    print '</pre>';*/
	    
	    $ppb_shortcodes = array();
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
	    
	    if(isset($ppb_form_item_data_obj->$ppb_shortcode_content_name))
	    {
	        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size.'" ';
	        
	        //Get shortcode title
	        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	        {
	        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	        }
	        
	        //Get shortcode attributes
	        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	        {
	        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
	        	
	        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
	        	{
	        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
	        		
	        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
	        		{
	        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
	        		}
	        	}
	        }
	
	        $ppb_shortcode_code.= ']'.rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_content_name).'[/'.$ppb_form_item_data_obj->shortcode.']';
	    }
	    else
	    {
	        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size.'" ';
	        
	        //Get shortcode title
	        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
	        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
	        {
	        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
	        }
	        
	        //Get shortcode attributes
	        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
	        {
	        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
	        	
	        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
	        	{
	        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
	        		
	        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
	        		{
	        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
	        		}
	        	}
	        }
	        
	        $ppb_shortcode_code.= ']';
	    }
	    //echo $ppb_shortcode_code;
	    echo do_shortcode($ppb_shortcode_code);
	}
	die();
}


/**
*	Save current as template function
**/
add_action('wp_ajax_grandrestaurant_ppb_set_template', 'grandrestaurant_ppb_set_template');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_set_template', 'grandrestaurant_ppb_set_template');

function grandrestaurant_ppb_set_template() {
	if(is_admin() && isset($_POST['template_name']) && !empty($_POST['template_name']) && isset($_GET['page_id']) && !empty($_GET['page_id']) && strlen($_POST['template_name']) >= 3)
	{
		//Get page ID
		$page_id = $_GET['page_id'];
		
		//get list of my templates in array
		$my_current_templates = get_option(SHORTNAME."_my_templates");
		
		//set new template ID and name
		$new_template_name = sanitize_text_field($_POST['template_name']);
		$new_template_id = $page_id.'_'.time();
		$my_current_templates[$new_template_id] = $new_template_name;
		
		//Update my template list
		update_option( SHORTNAME."_my_templates", $my_current_templates );
		
		//Save current page builder content to my template
		$ppb_form_data_order = get_post_meta($page_id, 'ppb_form_data_order');
		$export_options_arr = array();

		if(!empty($ppb_form_data_order))
		{
		    $export_options_arr['ppb_form_data_order'] = $ppb_form_data_order;

		    //Get each builder module data
		    $ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
		
		    foreach($ppb_form_item_arr as $key => $ppb_form_item)
		    {
		    	$ppb_form_item_data = get_post_meta($page_id, $ppb_form_item.'_data');
		    	$export_options_arr[$ppb_form_item.'_data'] = $ppb_form_item_data;
		    	
		    	$ppb_form_item_size = get_post_meta($page_id, $ppb_form_item.'_size');
		    	$export_options_arr[$ppb_form_item.'_size'] = $ppb_form_item_size;
		    }
		}
		
		update_option( SHORTNAME."_template_".$new_template_id, json_encode($export_options_arr) );
		
		//return template ID
		echo $new_template_id;
	}
	
	die();
}


/**
*	Remove current template function
**/
add_action('wp_ajax_grandrestaurant_ppb_remove_template', 'grandrestaurant_ppb_remove_template');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_remove_template', 'grandrestaurant_ppb_remove_template');

function grandrestaurant_ppb_remove_template() {
	if(is_admin() && isset($_GET['template_id']) && !empty($_GET['template_id']))
	{
		//get list of my templates in array
		$my_current_templates = get_option(SHORTNAME."_my_templates");
		$template_id = $_GET['template_id'];
		
		if(isset($my_current_templates[$template_id]))
		{
			//Remove template from array
			unset($my_current_templates[$template_id]);
			
			//Remove from my template list
			update_option( SHORTNAME."_my_templates", $my_current_templates );
			
			//Remove template data
			delete_option( SHORTNAME."_template_".$template_id );
			
			//display to AJAX response
			echo 1;
		}
	}
	
	die();
}


/**
*	Save page builder custom fields
**/
add_action('wp_ajax_grandrestaurant_ppb_save_page_builder', 'grandrestaurant_ppb_save_page_builder');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_save_page_builder', 'grandrestaurant_ppb_save_page_builder');

function grandrestaurant_ppb_save_page_builder() {
	if(is_admin() && isset($_POST['data_order']) && isset($_GET['page_id']) && !empty($_GET['page_id']))
	{
		$page_id = $_GET['page_id'];
		
		 //Get builder item
	    $ppb_form_data_order = $_POST['data_order'];
	    $ppb_form_item_arr = array();
	    
	    if(isset($ppb_form_data_order))
	    {
	    	$ppb_form_item_arr = explode(',', $ppb_form_data_order);
	    }
	    
	    if(!empty($ppb_form_item_arr))
	    {
	    	update_post_meta($page_id, 'ppb_form_data_order', $ppb_form_data_order);
	    
	    	foreach($ppb_form_item_arr as $key => $ppb_form_item)
	    	{
	    		if(isset($_POST[$ppb_form_item.'_data']) && $_POST[$ppb_form_item.'_data'] != 'undefined')
		    	{
	    			update_post_meta($page_id, $ppb_form_item.'_data', $_POST[$ppb_form_item.'_data']);
	    		}
	    		
	    		if(isset($_POST[$ppb_form_item.'_size']) && $_POST[$ppb_form_item.'_size'] != 'undefined')
	    		{
	    			update_post_meta($page_id, $ppb_form_item.'_size', $_POST[$ppb_form_item.'_size']);
	    		}
	    	}
	    }
	}
	
	die();
}


/**
*	Save page custom fields
**/
add_action('wp_ajax_grandrestaurant_ppb_save_page_custom_field', 'grandrestaurant_ppb_save_page_custom_field');
add_action('wp_ajax_nopriv_grandrestaurant_ppb_save_page_custom_field', 'grandrestaurant_ppb_save_page_custom_field');

function grandrestaurant_ppb_save_page_custom_field() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']) && isset($_POST['field']) && !empty($_POST['field']) && isset($_POST['data']))
	{
		echo $page_id;
		$page_id = $_GET['page_id'];
		update_post_meta($page_id, $_POST['field'], $_POST['data']);
	}
	
	die();
}

/**
*	Setup one click importer function
**/
add_action('wp_ajax_pp_import_demo_content', 'pp_import_demo_content');
add_action('wp_ajax_nopriv_pp_import_demo_content', 'pp_import_demo_content');

function pp_import_demo_content() {
	if(is_admin() && isset($_POST['demo']) && !empty($_POST['demo']))
	{
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	
		// Load Importer API
	    require_once ABSPATH . 'wp-admin/includes/import.php';
	
	    if ( ! class_exists( 'WP_Importer' ) ) {
	        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	        if ( file_exists( $class_wp_importer ) )
	        {
	            require $class_wp_importer;
	        }
	    }
	
	    if ( ! class_exists( 'WP_Import' ) ) {
	        $class_wp_importer = get_template_directory() ."/modules/import/wordpress-importer.php";
	        if ( file_exists( $class_wp_importer ) )
	            require $class_wp_importer;
	    }
	    
	    require_once(ABSPATH . 'wp-admin/includes/file.php');
	    WP_Filesystem();
		$wp_filesystem = grandrestaurant_get_wp_filesystem();
	    
	    $import_files = array();
	    $page_on_front ='';
	    $styling_file = '';
	    $import_widget_filepath = '';
	    
	    switch($_POST['demo'])
	    {
		    case 1:
		    default:
			    //Create empty menu first before importing
			    $main_menu_exists = wp_get_nav_menu_object('Main Menu');
			    if(!$main_menu_exists)
			    {
				    $main_menu_id = wp_create_nav_menu('Main Menu');
			    }
			    
			    $top_menu_exists = wp_get_nav_menu_object('Top Bar Menu');
			    if(!$top_menu_exists)
			    {
				    $top_menu_id = wp_create_nav_menu('Top Bar Menu');
			    }
			    
			    $side_menu_exists = wp_get_nav_menu_object('Side Menu');
			    if(!$side_menu_exists)
			    {
				    $side_menu_id = wp_create_nav_menu('Side Menu');
			    }
			    
			    $footer_menu_exists = wp_get_nav_menu_object('Footer Menu');
			    if(!$footer_menu_exists)
			    {
				    $footer_menu_id = wp_create_nav_menu('Footer Menu');
			    }
			break;
			
			case 2:
			case 3:
		    case 4:
		    case 5:
		    case 7:
			    //Create empty menu first before importing
			    $main_menu_exists = wp_get_nav_menu_object('Main Menu');
			    if(!$main_menu_exists)
			    {
				    $main_menu_id = wp_create_nav_menu('Main Menu');
			    }
			    
			    $side_menu_exists = wp_get_nav_menu_object('Side Menu');
			    if(!$side_menu_exists)
			    {
				    $side_menu_id = wp_create_nav_menu('Side Menu');
			    }
			break;
			
			case 6:
			    //Create empty menu first before importing
			    $main_menu_exists = wp_get_nav_menu_object('Main Menu');
			    if(!$main_menu_exists)
			    {
				    $main_menu_id = wp_create_nav_menu('Main Menu');
			    }
			    
			    $side_menu_exists = wp_get_nav_menu_object('Side Menu');
			    if(!$side_menu_exists)
			    {
				    $side_menu_id = wp_create_nav_menu('Side Menu');
			    }
			    
			    $footer_menu_exists = wp_get_nav_menu_object('Footer Menu');
			    if(!$footer_menu_exists)
			    {
				    $footer_menu_id = wp_create_nav_menu('Footer Menu');
			    }
			break;
	    }
	
		//Check import selected demo
	    if ( class_exists( 'WP_Import' ) ) 
	    { 
	    	switch($_POST['demo'])
	    	{
		    	case 1:
		    	default:
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/xml/demo1/1.xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo1/1_woo.xml" ;
		    		}
		    		
		    		$page_on_front = 4030; //Demo 1 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo1';
		    	break;
		    	
		    	case 2:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo2/2.xml" ;
		    		$page_on_front = 3210; //Demo 2 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo2';
		    	break;
		    	
		    	case 3:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo3/3.xml" ;
		    		$page_on_front = 3298; //Demo 3 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo3';
		    	break;
		    	
		    	case 4:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo4/4.xml" ;
		    		$page_on_front = 3296; //Demo 4 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo4';
		    	break;
		    	
		    	case 5:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo5/5.xml" ;
		    		$page_on_front = 3199; //Demo 5 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo5';
		    	break;
		    	
		    	case 6:
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/xml/demo6/6.xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo6/6_woo.xml" ;
		    		}
		    		
		    		$page_on_front = 3244; //Demo 6 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo6';
		    	break;
		    	
		    	case 7:
		    		$import_filepath = get_template_directory() ."/cache/demos/xml/demo7/7.xml" ;
		    		$page_on_front = 3218; //Demo 7 Homepage ID
		    		$oldurl = 'http://themes.themegoods.com/grandrestaurant/demo7';
		    	break;
	    	}
			
			//Run and download demo contents
			$wp_import = new WP_Import();
	        $wp_import->fetch_attachments = true;
	        $wp_import->import($import_filepath);
	        
	        //Remove default Hello World post
	        wp_delete_post(1);
	    }
	    
	    //Remove all theme mods first
	    remove_theme_mods();
	    
	    //Import theme customizer
		$default_dat_customizer = get_template_directory().'/cache/demos/xml/demo'.$_POST['demo'].'/'.$_POST['demo'].'.dat';
		if(file_exists($default_dat_customizer))
		{
		    $import_customizer_serialize = file_get_contents($default_dat_customizer);
		    $import_customizer_arr = unserialize($import_customizer_serialize);
		    
		    if(isset($import_customizer_arr['mods']) && !empty($import_customizer_arr['mods']) && is_array($import_customizer_arr['mods']))
		    {	
		    	
		    	foreach($import_customizer_arr['mods'] as $key => $import_customizer)
		    	{	
		    		if(!is_array($import_customizer) && tg_starts_with($key, 'tg_'))
		    		{
		    			set_theme_mod($key, $import_customizer);
					}
		    	}
		    }
		}
		
		//Import widgets
		if(file_exists(get_template_directory() ."/cache/demos/xml/demo".$_POST['demo']."/".$_POST['demo'].".wie"))
		{
			$import_widget_filepath = get_template_directory() ."/cache/demos/xml/demo".$_POST['demo']."/".$_POST['demo'].".wie" ;
			
			// Get file contents and decode
			$data = $wp_filesystem->get_contents($import_widget_filepath);
			$data = json_decode( $data );
		
			// Import the widget data
			// Make results available for display on import/export page
			$widget_import_results = grandrestaurant_import_widgets( $data );
		}
		
		//Import Revolution Slider if activate
		if(class_exists('RevSlider'))
		{
			$slider_array = array();
			
			switch($_POST['demo'])
	    	{
		    	case 1:
		    	default:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo1/home1-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home2-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home3-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home5-slider.zip",
		    			get_template_directory() ."/cache/demos/xml/demo1/home6-slider.zip"
		    		);
		    	break;
		    	
		    	case 2:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo2/home-slider.zip"
		    		);
		    	break;
		    	
		    	case 3:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo3/elegant-home-slider.zip"
		    		);
		    	break;
		    	
		    	case 4:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo4/elegant-home-slider.zip"
		    		);
		    	break;
		    	
		    	case 6:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo6/home1-slider.zip"
		    		);
		    	break;
		    	
		    	case 7:
		    		$slider_array = array(
		    			get_template_directory() ."/cache/demos/xml/demo7/home-slider.zip"
		    		);
		    	break;
	    	}
	    	
	    	if(!empty($slider_array))
	    	{
		    	require_once ABSPATH . 'wp-admin/includes/file.php';
				$obj_revslider = new RevSlider();
				
				foreach($slider_array as $revslider_filepath)
				{
					$obj_revslider->importSliderFromPost(true,true,$revslider_filepath);
				}
			}
		}
	    
	    //Setup default front page settings.
	    update_option('show_on_front', 'page');
	    update_option('page_on_front', $page_on_front);
	    
	    //Set default custom menu settings
	    $locations = get_theme_mod('nav_menu_locations');
	    switch($_POST['demo'])
	    {
		    case 1:
		    default:
		    	$locations['primary-menu'] = $main_menu_id;
				$locations['top-menu'] = $top_menu_id;
				$locations['side-menu'] = $side_menu_id;
				$locations['footer-menu'] = $footer_menu_id;
		    break;
		    
		    case 2:
		    case 3:
		    case 4:
		    case 5:
		    case 7:
		    	$locations['primary-menu'] = $main_menu_id;
		    	$locations['side-menu'] = $side_menu_id;
		    break;
		    
		    case 6:
		    	$locations['primary-menu'] = $main_menu_id;
				$locations['side-menu'] = $main_menu_id;
				$locations['footer-menu'] = $main_menu_id;
		    break;
	    }
	    
		set_theme_mod( 'nav_menu_locations', $locations );
		
		//Change all URLs from demo URL
		$update_options = array ( 0 => 'content', 1 => 'excerpts', 2 => 'links', 3 => 'attachments', 4 => 'custom', 5 => 'guids', );
		$newurl = esc_url( site_url() ) ;
		grandrestaurant_update_urls($update_options, $oldurl, $newurl);
		
		//Refresh rewrite rules
		flush_rewrite_rules();
	    
		exit();
	}
}

/**
*	Setup get styling function
**/
add_action('wp_ajax_pp_get_styling', 'pp_get_styling');
add_action('wp_ajax_nopriv_pp_get_styling', 'pp_get_styling');

function pp_get_styling() {
	if(is_admin() && isset($_POST['styling']) && !empty($_POST['styling']))
	{
	    require_once ABSPATH . 'wp-admin/includes/file.php';
		$styling_file = get_template_directory() . "/cache/demos/xml/demo".$_POST['styling']."/".$_POST['styling'].".dat";

		if(file_exists($styling_file))
		{
			$wp_filesystem = grandrestaurant_get_wp_filesystem();
			$styling_data = $wp_filesystem->get_contents($styling_file);
			$styling_data_arr = unserialize($styling_data);
			
			if(isset($styling_data_arr['mods']) && is_array($styling_data_arr['mods']))
			{	
				// Get menu locations and save to array
				$locations = get_theme_mod('nav_menu_locations');
				$save_menus = array();
				
				if(isset($locations))
				{
					foreach( $locations as $key => $val ) 
					{
						$save_menus[$key] = $val;
					}
				}
			
				//Remove all theme customizer
				remove_theme_mods();
				
				//Re-add the menus
				set_theme_mod('nav_menu_locations', array_map( 'absint', $save_menus ));
			
				foreach($styling_data_arr['mods'] as $key => $styling_mod)
				{
					if(!is_array($styling_mod))
					{
						set_theme_mod( $key, $styling_mod );
					}
				}
			}
		    
			exit();
		}
	}
}

/**
*	Setup AJAX search function
**/
add_action('wp_ajax_pp_ajax_search', 'pp_ajax_search');
add_action('wp_ajax_nopriv_pp_ajax_search', 'pp_ajax_search');

function pp_ajax_search() {
	global $wpdb;
	
	if (strlen($_POST['s'])>0) {
		$limit=5;
		$s=strtolower(addslashes($_POST['s']));
		$querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE 1=1 AND ((lower($wpdb->posts.post_title) like %s))
			AND $wpdb->posts.post_type IN ('post', 'page', 'attachment', 'projects', 'galleries')
			AND (post_status = 'publish')
			ORDER BY $wpdb->posts.post_date DESC
			LIMIT $limit;
		 ";

	 	$pageposts = $wpdb->get_results($wpdb->prepare($querystr, '%'.$wpdb->esc_like($s).'%'), OBJECT);
	 	
	 	if(!empty($pageposts))
	 	{
			echo '<ul>';
	
	 		foreach($pageposts as $result_item) 
	 		{
	 			$post=$result_item;
	 			
	 			$post_type = get_post_type($post->ID);
				$post_type_class = '';
				$post_type_title = '';
				
				switch($post_type)
				{
				    case 'galleries':
				    	$post_type_class = '<i class="fa fa-picture-o"></i>';
				    	$post_type_title = __( 'Gallery', THEMEDOMAIN );
				    break;
				    
				    case 'page':
				    default:
				    	$post_type_class = '<i class="fa fa-file-text-o"></i>';
				    	$post_type_title = __( 'Page', THEMEDOMAIN );
				    break;
				    
				    case 'projects':
				    	$post_type_class = '<i class="fa fa-folder-open-o"></i>';
				    	$post_type_title = __( 'Projects', THEMEDOMAIN );
				    break;
				    
				    case 'services':
				    	$post_type_class = '<i class="fa fa-star"></i>';
				    	$post_type_title = __( 'Service', THEMEDOMAIN );
				    break;
				    
				    case 'clients':
				    	$post_type_class = '<i class="fa fa-user"></i>';
				    	$post_type_title = __( 'Client', THEMEDOMAIN );
				    break;
				}
				
				$post_thumb = array();
				if(has_post_thumbnail($post->ID, 'thumbnail'))
				{
				    $image_id = get_post_thumbnail_id($post->ID);
				    $post_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
				    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				    
				    if(isset($post_thumb[0]) && !empty($post_thumb[0]))
				    {
				        $post_type_class = '<div class="search_thumb"><img src="'.$post_thumb[0].'" alt="'.esc_attr($image_alt).'"/></div>';
				    }
				}
	 			
				echo '<li>';
				
				if(!isset($post_thumb[0]))
				{
					echo '<div class="post_type_icon">';
				}
				
				echo '<a href="'.get_permalink($post->ID).'">'.$post_type_class.'</i></a>';
				
				if(!isset($post_thumb[0]))
				{
					echo '</div>';
				}
				
				echo '<div class="ajax_post">';
				echo '<a href="'.get_permalink($post->ID).'"><strong>'.$post->post_title.'</strong><br/>';
				echo '<span class="post_detail">'.date(THEMEDATEFORMAT, strtotime($post->post_date)).'</span></a>';
				echo '</div>';
				echo '</li>';
			}
			
			echo '<li class="view_all"><a href="javascript:jQuery(\'#searchform\').submit()">'.__( 'View all results', THEMEDOMAIN ).'</a></li>';
	
			echo '</ul>';
		}

	}
	else 
	{
		echo '';
	}
	die();

}

/**
*	Setup contact form mailing function
**/
add_action('wp_ajax_pp_contact_mailer', 'pp_contact_mailer');
add_action('wp_ajax_nopriv_pp_contact_mailer', 'pp_contact_mailer');

function pp_contact_mailer() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	if (isset($_POST['your_name'])) {
	
		//Get your email address
		$contact_email = get_option('pp_contact_email');
		$pp_contact_thankyou = __( 'Thank you! We will get back to you as soon as possible', THEMEDOMAIN );
		
		/*
		|
		| Begin sending mail
		|
		*/
		
		$from_name = $_POST['your_name'];
		$from_email = $_POST['email'];
		
		//Get contact subject
		if(!isset($_POST['subject']))
		{
			$contact_subject = __( '[Email Contact]', THEMEDOMAIN ).' '.get_bloginfo('name');
		}
		else
		{
			$contact_subject = $_POST['subject'];
		}
		
		$headers = "";
	   	//$headers.= 'From: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Reply-To: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Return-Path: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
		
		$message = 'Name: '.$from_name.PHP_EOL;
		$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
		$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
		
		if(isset($_POST['address']))
		{
			$message.= 'Address: '.$_POST['address'].PHP_EOL;
		}
		
		if(isset($_POST['phone']))
		{
			$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
		}
		
		if(isset($_POST['mobile']))
		{
			$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
		}
		
		if(isset($_POST['company']))
		{
			$message.= 'Company: '.$_POST['company'].PHP_EOL;
		}
		
		if(isset($_POST['country']))
		{
			$message.= 'Country: '.$_POST['country'].PHP_EOL;
		}
		    
		
		if(!empty($from_name) && !empty($from_email) && !empty($message))
		{
			wp_mail($contact_email, $contact_subject, $message, $headers);
			echo '<p>'.$pp_contact_thankyou.'</p>';
			
			die;
		}
		else
		{
			echo '<p>'.ERROR_MESSAGE.'</p>';
			
			die;
		}

	}
	else 
	{
		echo '<p>'.ERROR_MESSAGE.'</p>';
	}
	die();
}

/**
*	End theme custom AJAX calls handler
**/


/**
*	Setup contact form reservation function
**/
add_action('wp_ajax_tg_reservation_mailer', 'tg_reservation_mailer');
add_action('wp_ajax_nopriv_tg_reservation_mailer', 'tg_reservation_mailer');

function tg_reservation_mailer() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');

	if (isset($_POST['your_name'])) {
	
		//Get your email address
		$contact_email = get_option('pp_reservation_email');
		$pp_contact_thankyou = __( 'Thank you! We will confirm your booking via email/phone', THEMEDOMAIN );
		
		/*
		|
		| Begin sending mail
		|
		*/
		
		$order_no_people = $_POST['seats'];
		$order_date = $_POST['date'];
		$order_time = $_POST['time'];
		
		$from_name = $_POST['your_name'];
		$from_email = $_POST['email'];
		$from_phone = $_POST['phone'];
		
		//Get contact subject
		$contact_subject = __( '[Email Reservation]', THEMEDOMAIN ).' '.get_bloginfo('name');
		
		$headers = "";
	   	//$headers.= 'From: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Reply-To: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Return-Path: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	
	   	//Check Bcc email
	   	$pp_reservation_bcc_email = get_option('pp_reservation_bcc_email');
	   	if(!empty($pp_reservation_bcc_email))
	   	{
		   	$headers.= 'Bcc: '.$pp_reservation_bcc_email.PHP_EOL;
	   	}
	   	
	   	//Check Cc email
	   	$pp_reservation_cc_email = get_option('pp_reservation_cc_email');
	   	if(!empty($pp_reservation_cc_email))
	   	{
		   	$headers.= 'Cc: '.$pp_reservation_cc_email.PHP_EOL;
	   	}
		
		$no_people_title = $order_no_people;
		if($order_no_people==1)
		{
		    $no_people_title.=  ' '.__( 'person', THEMEDOMAIN );
		}
		elseif($order_no_people<20)
		{
		    $no_people_title.=  ' '.__( 'people', THEMEDOMAIN );
		}
		elseif($order_no_people==20)
		{
		    $no_people_title.=  '+ '.__( 'people', THEMEDOMAIN );
		}
		
		$message = __( 'Number of people', THEMEDOMAIN ).': '.$no_people_title.PHP_EOL;
		$message.= __( 'Date', THEMEDOMAIN ).': '.$order_date.PHP_EOL.PHP_EOL;
		$message.= __( 'Time', THEMEDOMAIN ).': '.$order_time.PHP_EOL.PHP_EOL;
		
		$message.= __( 'Special Requests', THEMEDOMAIN ).': '.$_POST['message'].PHP_EOL.PHP_EOL;
		
		$message.= __( 'Name', THEMEDOMAIN ).': '.$from_name.PHP_EOL;
		$message.= __( 'Phone', THEMEDOMAIN ).': '.$from_phone.PHP_EOL.PHP_EOL;
		$message.= __( 'Email', THEMEDOMAIN ).': '.$from_email.PHP_EOL.PHP_EOL;
		    
		
		if(!empty($from_name) && !empty($from_email) && !empty($message))
		{
			wp_mail($contact_email, $contact_subject, $message, $headers);
			
			//Check if send copy of booking email to customer
			$pp_reservation_email_customer = get_option('pp_reservation_email_customer');
			if(!empty($pp_reservation_email_customer))
			{
				wp_mail($from_email, $contact_subject, $message, $headers);
				$pp_contact_thankyou .= '<br/>'.__( 'We also sent a copy of reservation email to', THEMEDOMAIN ).' '.$from_email;
			}
			
			echo '<br/><p>'.$pp_contact_thankyou.'</p>';
			
			die;
		}
		else
		{
			echo '<p>'.ERROR_MESSAGE.'</p>';
			
			die;
		}

	}
	else 
	{
		echo '<p>'.ERROR_MESSAGE.'</p>';
	}
	die();
}

add_action('wp_ajax_grandrestaurant_blurred', 'grandrestaurant_blurred');
add_action('wp_ajax_nopriv_grandrestaurant_blurred', 'grandrestaurant_blurred');

function grandrestaurant_blurred() {
	$do_blur = FALSE;
	if(isset($_GET['src']) && !empty($_GET['src']))
	{
		$image_id = pp_get_image_id($_GET['src']);
		$do_blur = TRUE;
	}
	$blurFactor = 5;
	if(isset($_GET['blur_factor']) && is_numeric($_GET['blur_factor']))
	{
		$blurFactor = $_GET['blur_factor'];
	}
	
	if($do_blur)
	{
		header('Content-Type: image/jpeg');
		$image = imagecreatefromjpeg($_GET['src']);
		$new_image = grandrestaurant_blur($image,$blurFactor);
		imagejpeg($new_image);
		imagedestroy($new_image);
	}

	die();
}

//Setup custom settings when theme is activated
if (isset($_GET['activated']) && $_GET['activated']){
	//Add default contact fields
	$pp_contact_form = get_option('pp_contact_form');
	if(empty($pp_contact_form))
	{
		add_option( 'pp_contact_form', 's:1:"3";' );
	}
	
	$pp_contact_form_sort_data = get_option('pp_contact_form_sort_data');
	if(empty($pp_contact_form_sort_data))
	{
		add_option( 'pp_contact_form_sort_data', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}' );
	}

	wp_redirect(admin_url("admin.php?page=admin.lib.php&activate=true"));
}
?>
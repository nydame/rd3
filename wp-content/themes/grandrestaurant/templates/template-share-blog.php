<?php    
    $pin_thumb = wp_get_attachment_image_src($post->ID, 'gallery_4', true);
    if(!isset($pin_thumb[0]))
    {
	    $pin_thumb[0] = '';
    }
    
    global $share_class;
    global $share_id;
?>
<div class="post_share_bubble_wrapper">
	<div <?php if(!empty($share_id)) { ?>id="<?php echo esc_attr($share_id); ?>"<?php } ?> class="social_share_bubble <?php echo esc_attr($share_class); ?>">
		<ul>
			<li><a title="<?php _e( 'Share On Facebook', THEMEDOMAIN ); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
			<li><a title="<?php _e( 'Share On Twitter', THEMEDOMAIN ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo get_permalink(); ?>&amp;url=<?php echo get_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
			<li><a title="<?php _e( 'Share On Pinterest', THEMEDOMAIN ); ?>" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($pin_thumb[0]); ?>"><i class="fa fa-pinterest"></i></a></li>
			<li><a title="<?php _e( 'Share On Google+', THEMEDOMAIN ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
		</ul>
	</div>
</div>
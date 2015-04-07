<?php
add_action('admin_menu', 'amr_movie_slideshow_add_fields');

/**
 * Add more fields to post type 'movie'
 */
function amr_movie_slideshow_add_fields() {
	
	// Add Year field
    add_meta_box('movie_slideshow_year', __('Year'), 'amr_movie_slideshow_year_show', 
    	'movie_slideshow', 'side', 'high');
		
	// Add Read more link field, just below the editor, using priority "high"	
	add_meta_box('movie_slideshow_link', __('Read more link'), 'amr_movie_slideshow_link_show', 
    	'movie_slideshow', 'normal', 'high');
		
	// Add Thumbnail image field, just below the editor, using priority "high"	
	add_meta_box('movie_slideshow_thumbnail', __('Thumbnail'), 'amr_movie_slideshow_thumbnail_show', 
    	'movie_slideshow', 'normal', 'high');
		
	// Add Main image field, just below the editor, using priority "high"	
	add_meta_box('movie_slideshow_image', __('Main Image'), 'amr_movie_slideshow_image_show', 
    	'movie_slideshow', 'normal', 'high');	

	// Add Plot field, just below the editor, using priority "high"	
	add_meta_box('movie_slideshow_plot', __('Plot'), 'amr_movie_slideshow_plot_show', 
    	'movie_slideshow', 'normal', 'high');
	
}

/**
 * Callback function to show fields in meta box
 * Show year textbox
 */
function amr_movie_slideshow_year_show() {
    global $post;
	
	// Use nonce for verification
    echo '<input type="hidden" name="amr_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<div class="widget-content">';
	$strFieldName = 'movie_slideshow_year';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="32" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';

    echo '</div>';
	
	/* Register javascript for clicking on upload button */
	?>
	<script type="text/javascript">
		(function($) {
			jQuery(function() {
				jQuery('.cls-upload-button').click(function() {
					formfield = jQuery(this).prev().attr('id');
					tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
					return false;
				});

				window.send_to_editor = function(html) {
					imgurl = jQuery('img', html).attr('src');
					jQuery(window.parent.document).find('#' + formfield).val(imgurl);
					tb_remove();
				}
				
			})
		})(jQuery)
	</script>
	<?php
}

/**
 * Callback function to show fields in meta box
 * Show Link textbox
 */
function amr_movie_slideshow_link_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'movie_slideshow_link';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';

    echo '</div>';
}

/**
 * Callback function to show fields in meta box
 * Show Thumbnail textbox and upload button
 */
function amr_movie_slideshow_thumbnail_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'movie_slideshow_thumbnail';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" />';
	echo '<input class="button cls-upload-button" type="button" value="Upload" />';
	echo '</p>';
	echo '<p class="description">'.__('Use the upload button and choose an image, then click on "Insert into post". Or copy an image link and paste here.');
	echo '<br />';
	echo __('The Thumbnail should be 62 x 46px, or an image with proper proportion');
	echo '</p>';
	
	$strTmpExt = strtolower(substr($strMetaValue, -4));
	if ($strMetaValue && ($strTmpExt == '.png' || $strTmpExt == '.jpg' || $strTmpExt == '.gif'))
	{
		echo '<p>';
		echo '<img src="'.$strMetaValue.'" alt="" />';
		echo '</p>';
	}
	
    echo '</div>';
}

/**
 * Callback function to show fields in meta box
 * Show Main Image textbox and upload button
 */
function amr_movie_slideshow_image_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'movie_slideshow_image';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" />';
	echo '<input class="button cls-upload-button" type="button" value="Upload" />';
	echo '</p>';
	echo '<p class="description">'.__('Use the upload button and choose an image, then click on "Insert into post". Or copy an image link and paste here.');
	echo '<br />';
	echo __('The Main Image should be 896 x 400px, or an image with proper proportion');
	echo '</p>';
	
	$strTmpExt = strtolower(substr($strMetaValue, -4));
	if ($strMetaValue && ($strTmpExt == '.png' || $strTmpExt == '.jpg' || $strTmpExt == '.gif'))
	{
		echo '<p>';
		echo '<img src="'.$strMetaValue.'" alt="" />';
		echo '</p>';
	}
	
    echo '</div>';
}

/**
 * Callback function to show fields in meta box
 * Show plot text area
 */
function amr_movie_slideshow_plot_show() {
    global $post;

    $strFieldName = 'movie_slideshow_plot';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'">'.$strMetaValue.'</textarea></p>';
	echo '<p>'.__('Plot, notes for the movie').'</p>';
	
}

add_action('save_post', 'amr_save_movie_slideshow_advbox');

// Save data from meta box
function amr_save_movie_slideshow_advbox($post_id) {
    global $metabox_adv_options;
	
	if ( !isset( $_POST['amr_meta_box_nonce'] ) ) $_POST['amr_meta_box_nonce'] = wp_create_nonce(basename(__FILE__));

    // verify nonce
    if (!wp_verify_nonce($_POST['amr_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ( isset( $_POST['post_type'] ) ) $strPostType = $_POST['post_type'];
	else $strPostType = 'post';
    if ('page' == $strPostType) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
	if ($strPostType == 'movie_slideshow')
	{
		// Save year, strip tags for safety	
		$strFieldName = 'movie_slideshow_year';
		$strOldValue = get_post_meta($post_id, $strFieldName, true);
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			strip_tags(trim($_POST[$strFieldName])) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save plot, strip tags for safety, strip slashes for putting in the database
		$strFieldName = 'movie_slideshow_plot';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save read more link
		$strFieldName = 'movie_slideshow_link';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save thumbnail URL
		$strFieldName = 'movie_slideshow_thumbnail';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save Main image URL
		$strFieldName = 'movie_slideshow_image';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);	
		
	}

}


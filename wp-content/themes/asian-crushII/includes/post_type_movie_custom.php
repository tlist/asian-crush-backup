<?php
add_action('admin_menu', 'amr_movie_add_fields');

/**
 * Add more fields to post type 'movie'
 */
function amr_movie_add_fields() {


		// Add Duration field
    add_meta_box('movie_duration', __('Duration'), 'amr_movie_durarion_show', 
    	'movie', 'side', 'default');
		
	// Add Plot field, just below the editor, using priority "high"	
	add_meta_box('movie_plot', __('Plot'), 'amr_movie_plot_show', 
    	'movie', 'normal', 'high');
		
	// Add Amazon link field, using priority "high"	
	add_meta_box('movie_amazon_link', __('Amazon Link'), 'amr_movie_amazon_link_show', 
    	'movie', 'normal', 'core');
		
	// Add Embedded Video field, using priority "high"	
	add_meta_box('movie_embedded_video', __('Embedded Video'), 'amr_movie_embedded_video_show', 
    	'movie', 'normal', 'high');
		
	// Add Embedded Hulu Video field, using priority "high"	
	add_meta_box('movie_hulu_video', __('Hulu'), 'amr_movie_hulu_video_show', 
    	'movie', 'normal', 'high');	


	
/*
	// Add Put on Main Slideshow field
    add_meta_box('movie_featured', __('Main Slideshow'), 'amr_movie_featured_show', 
    	'movie', 'side', 'low');	
*/	

}


/**
 * Callback function to show fields in meta box
 * Show duration textbox
 */
function amr_movie_year_show() {
    global $post;

    // Use nonce for verification
    echo '<input type="hidden" name="amr_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<div class="widget-content">';
	$strFieldName = 'movie_year';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="32" name="'.$strFieldName.'" id="'.$strFieldName.'" value="'.$strMetaValue.'" /></p>';

    echo '</div>';
}


/**
 * Callback function to show fields in meta box
 * Show duration textbox
 */
function amr_movie_durarion_show() {
    global $post;

    // Use nonce for verification
    echo '<div class="widget-content">';
	$strFieldName = 'movie_duration';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="32" name="'.$strFieldName.'" id="'.$strFieldName.'" value="'.$strMetaValue.'" /></p>';

    echo '</div>';
}

/**
 * Callback function to show fields in meta box
 * Show Featured check-boxes
 */
function amr_movie_featured_show() {
    global $post;
	
	echo '<div class="widget-content">';
	$strFieldName = 'movie_main_slideshow';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	$strTmp = '';
	$strChecked = '';
    if ( $strMetaValue ) $strChecked = 'checked = "checked"';
	$strTmp = '<p>';
	$strTmp .= '<input class="checkbox" type="checkbox" name="'.$strFieldName.'" id="'.$strFieldName.'" '.$strChecked.' />';
	$strTmp .= '&nbsp;';
	$strTmp .= '<label for="'.$strFieldName.'">'.__('Put on Main SlideShow').'</label>';
	$strTmp .= '</p>';
	echo $strTmp;
    echo '</div>';
}

/**
 * Callback function to show fields in meta box
 * Show plot text area
 */
function amr_movie_plot_show() {
    global $post;

    $strFieldName = 'movie_plot';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea></p>';
	echo '<p>'.__('Plot, notes for the movie').'</p>';
	
}

/**
 * Callback function to show fields in meta box
 * Show movie embedded text area
 */
function amr_movie_embedded_video_show() {
    global $post;

    $strFieldName = 'movie_embedded_video';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea>';
	echo '<p>'.__('You tube link, embedded video player').'</p>';
	
}

/**
 * Callback function to show fields in meta box
 * Show Hulu text area
 */
function amr_movie_hulu_video_show() {
    global $post;

    $strFieldName = 'movie_hulu_video';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea>';
	echo '<p>'.__('Hulu link, embedded video player').'</p>';
	
}


/**
 * Callback function to show fields in meta box
 * Show Amazon link for movie
 */
function amr_movie_amazon_link_show() {
    global $post;

    $strFieldName = 'movie_amazon_link';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea>';
	echo '<p>'.__('Link for this movie on Amazon').'</p>';
	
}

add_action('save_post', 'amr_save_advbox');

// Save data from meta box
function amr_save_advbox($post_id) {
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
    if ( !isset( $_POST['post_type'] ) ) $_POST['post_type'] = 'post';
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }


	// Save duration, strip tags for safety	
	$strFieldName = 'movie_duration';
	$strOldValue = get_post_meta($post_id, $strFieldName, true);
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		strip_tags(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);

/*	
	// Save put on Main SlideShow	
	$strFieldName = 'movie_main_slideshow';
	$strOldValue = get_post_meta($post_id, $strFieldName, true);
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		strip_tags(trim($_POST[$strFieldName])) : 0;
	if ($strNewValue && $strNewValue != $strOldValue) {
        update_post_meta($post_id, $strFieldName, $strNewValue);
    } elseif (!$strNewValue && $strOldValue) {
        delete_post_meta($post_id, $strFieldName, $strOldValue);
    }
*/

	// Save plot, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'movie_plot';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);
	
	// Save embedded video, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'movie_embedded_video';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);
	
		// Save Hulu video, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'movie_hulu_video';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);
	
	// Save Amazon link, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'movie_amazon_link';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);

}
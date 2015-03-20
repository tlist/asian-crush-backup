<?php
add_action('admin_menu', 'amr_submitted_film_add_fields');

/**
 * Add more fields to post type 'movie'
 */
function amr_submitted_film_add_fields() {
	
	// Add Name field
    add_meta_box('submitted_film_name', __('Name'), 'amr_submitted_film_name_show', 
    	'submitted_film', 'normal', 'high');

	// Add Email field
    add_meta_box('submitted_film_email', __('Email'), 'amr_submitted_film_email_show', 
    	'submitted_film', 'normal', 'high');

    // Add Subject field
    add_meta_box('submitted_film_subject', __('Subject'), 'amr_submitted_film_subject_show', 
    	'submitted_film', 'normal', 'high');

    // Add Company field
    add_meta_box('submitted_film_company', __('Company'), 'amr_submitted_film_company_show', 
    	'submitted_film', 'normal', 'high');

    // Add Genre field
    add_meta_box('submitted_film_genre', __('Genre'), 'amr_submitted_film_genre_show', 
    	'submitted_film', 'normal', 'high');

	// Add Message field
    add_meta_box('submitted_film_message', __('Message'), 'amr_submitted_film_message_show', 
    	'submitted_film', 'normal', 'high');	
		
}

/**
 * Callback function to show fields in meta box
 * Show name textbox
 */
function amr_submitted_film_name_show() {
    global $post;
	
	// Use nonce for verification
    echo '<input type="hidden" name="amr_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_name';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';
    echo '</div>';
	
}

/**
 * Callback function to show prices in meta box
 * Show email textbox
 */
function amr_submitted_film_email_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_email';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';
    echo '</div>';
}

/**
 * Callback function to show prices in meta box
 * Show subject textbox
 */
function amr_submitted_film_subject_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_subject';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';
    echo '</div>';
}

/**
 * Callback function to show prices in meta box
 * Show company textbox
 */
function amr_submitted_film_company_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_company';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';
    echo '</div>';
}

/**
 * Callback function to show prices in meta box
 * Show genre textbox
 */
function amr_submitted_film_genre_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_genre';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><input class="textbox" type="text" size="96" name="'.$strFieldName.'" id="'.$strFieldName.'input'.'" value="'.$strMetaValue.'" /></p>';
    echo '</div>';
}

/**
 * Callback function to show amazon link in meta box
 * Show message textarea
 */
function amr_submitted_film_message_show() {
    global $post;

    echo '<div class="widget-content">';
	$strFieldName = 'submitted_film_message';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea>';
	echo '<p class="description">'.__('Message of this contact').'</p>';
	
}

add_action('save_post', 'amr_save_submitted_film_advbox');

// Save data from meta box
function amr_save_submitted_film_advbox($post_id) {
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
    
	if ($strPostType == 'submitted_film')
	{
		// Save name, strip tags for safety	
		$strFieldName = 'submitted_film_name';
		$strOldValue = get_post_meta($post_id, $strFieldName, true);
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			strip_tags(trim($_POST[$strFieldName])) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save email, strip tags for safety, strip slashes for putting in the database
		$strFieldName = 'submitted_film_email';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);

		$strFieldName = 'submitted_film_subject';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);

		$strFieldName = 'submitted_film_company';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);

		$strFieldName = 'submitted_film_genre';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep(strip_tags(trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
		// Save message
		$strFieldName = 'submitted_film_message';
		$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
			stripslashes_deep((trim($_POST[$strFieldName]))) : '';
		update_post_meta($post_id, $strFieldName, $strNewValue);
		
	}

}


<?php
add_action('admin_menu', 'amr_tv_operator_add_fields');

/**
 * Add more fields to post type 'movie'
 */
function amr_tv_operator_add_fields() {

	// Add Plot field, just below the editor, using priority "high"	
	add_meta_box('tv_operator_link', __('Operator Link'), 'amr_tv_operator_link_show', 
    	'tv_operator', 'normal', 'high');
	
	// Add Quotes field, using priority "high"	
	add_meta_box('tv_operator_caption', __('Operator Caption'), 'amr_tv_operator_caption_show', 
    	'tv_operator', 'normal', 'high');
				
}

/**
 * Callback function to show fields in meta box
 * Show duration textbox
 */
function amr_tv_operator_link_show() {
    global $post;
	echo '<input type="hidden" name="amr_meta_box_tv_operator_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    $strFieldName = 'tv_operator_link';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea>';
	echo '<p>'.__('Link for this Operator').'</p>';

}	


function amr_tv_operator_caption_show() {
    global $post;

    $strFieldName = 'tv_operator_caption';
	$strMetaValue = get_post_meta($post->ID, $strFieldName, true);
	echo '<p><textarea cols="100" rows="5" class="text-multiline" name="'.$strFieldName.'" id="'.$strFieldName.'">'.$strMetaValue.'</textarea></p>';
	echo '<p>'.__('Caption for this Operator').'</p>';
	
}

add_action('save_post', 'amr_save_tv_operator_box');

// Save data from meta box
function amr_save_tv_operator_box($post_id) {
    global $metabox_adv_options;
	
	// replace this with the path to the HTML Purifier library
	require_once PfBase::app()->themePath.DS.'libs/htmlpurifier-4.3.0/library/HTMLPurifier.auto.php';

	if ( !isset( $_POST['amr_meta_box_tv_operator_nonce'] ) ) $_POST['amr_meta_box_tv_operator_nonce'] = wp_create_nonce(basename(__FILE__));

    // verify nonce
    if (!wp_verify_nonce($_POST['amr_meta_box_tv_operator_nonce'], basename(__FILE__))) {
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
		
	// Save embedded video, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'tv_operator_link';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);
	
	// Save Amazon link, strip tags for safety, strip slashes for putting in the database
	$strFieldName = 'tv_operator_caption';
	$strNewValue = ( isset( $_POST[$strFieldName] ) ) ? 
		stripslashes_deep(trim($_POST[$strFieldName])) : '';
	update_post_meta($post_id, $strFieldName, $strNewValue);
}
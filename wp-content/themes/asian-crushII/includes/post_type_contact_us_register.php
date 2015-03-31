<?php
/* Contact Us Post Type*/
  $labels = array(
    'name' => _x('Contact Us', 'post type general name'),
    'singular_name' => _x('Contact Us', 'post type singular name'),
    'add_new' => _x('Add New Contact Us', 'post type add'),
    'add_new_item' => __('Add New Contact Us'),
    'edit_item' => __('Edit Contact Us'),
    'new_item' => __('New Contact Us'),
    'all_items' => __('All Contact Us'),
    'view_item' => __('View Contact Us'),
    'search_items' => __('Search Contact Us'),
    'not_found' =>  __('No Contact Us found'),
    'not_found_in_trash' => __('No Contact Us found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Contact Us'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 10,
    'supports' => array('title', 'page-attributes')
  ); 
  
  register_post_type('contact_us',$args);

	//add filter to ensure the text Contact Us, or contact_us is displayed when user updates a contact_us 
  add_filter('post_updated_messages', 'amr_contact_us_updated_messages');
function amr_contact_us_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['contact_us'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Contact Us updated. <a href="%s">View Contact Us</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Contact Us updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Contact Us restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Contact Us published. <a href="%s">View Contact Us</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Contact Us saved.'),
    8 => sprintf( __('Contact Us submitted. <a target="_blank" href="%s">Preview Contact Us</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Contact Us scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview dvd</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Contact Us draft updated. <a target="_blank" href="%s">Preview Contact Us</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

function amr_contact_us_posts_columns( $posts_columns ) {
    $tmp = array();
  $tmp['cb'] = $posts_columns['cb'];
  $tmp['title'] = __('Subject');
  $tmp['contact_us_name'] = __('From Name');
  $tmp['contact_us_email'] = __('From Email');
  $tmp['date'] = $posts_columns['date'];
  return $tmp;
}
add_filter( 'manage_contact_us_posts_columns', 'amr_contact_us_posts_columns');

function amr_contact_us_custom_column( $column_name ) {
  global $post;
  
  $strKey = 'contact_us_name';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo $strValue;
  }

  $strKey = 'contact_us_email';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo '<a href="mailto:'.$strValue.';">'.$strValue.'</a>';
  }
}
add_action( 'manage_contact_us_posts_custom_column', 'amr_contact_us_custom_column' );
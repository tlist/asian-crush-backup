<?php
/* Submitted Film Post Type*/
  $labels = array(
    'name' => _x('Submitted Film', 'post type general name'),
    'singular_name' => _x('Submitted Film', 'post type singular name'),
    'add_new' => _x('Add New Submitted Film', 'post type add'),
    'add_new_item' => __('Add New Submitted Film'),
    'edit_item' => __('Edit Submitted Film'),
    'new_item' => __('New Submitted Film'),
    'all_items' => __('All Submitted Film'),
    'view_item' => __('View Submitted Film'),
    'search_items' => __('Search Submitted Film'),
    'not_found' =>  __('No Submitted Film found'),
    'not_found_in_trash' => __('No Submitted Film found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Submitted Film'
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
  
  register_post_type('submitted_film',$args);

	//add filter to ensure the text Submitted Film, or submitted_film is displayed when user updates a submitted_film 
  add_filter('post_updated_messages', 'amr_submitted_film_updated_messages');
function amr_submitted_film_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['submitted_film'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Submitted Film updated. <a href="%s">View Submitted Film</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Submitted Film updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Submitted Film restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Submitted Film published. <a href="%s">View Submitted Film</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Submitted Film saved.'),
    8 => sprintf( __('Submitted Film submitted. <a target="_blank" href="%s">Preview Submitted Film</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Submitted Film scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview dvd</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Submitted Film draft updated. <a target="_blank" href="%s">Preview Submitted Film</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

function amr_submitted_film_posts_columns( $posts_columns ) {
    $tmp = array();
  $tmp['cb'] = $posts_columns['cb'];
  $tmp['title'] = __('Film Title');
  $tmp['submitted_film_name'] = __('From Name');
  $tmp['submitted_film_email'] = __('From Email');
  $tmp['submitted_film_subject'] = __('Subject');
  $tmp['submitted_film_company'] = __('Company');
  $tmp['submitted_film_genre'] = __('Genre');
  $tmp['date'] = $posts_columns['date'];
  return $tmp;
}
add_filter( 'manage_submitted_film_posts_columns', 'amr_submitted_film_posts_columns');

function amr_submitted_film_custom_column( $column_name ) {
  global $post;
  
  $strKey = 'submitted_film_name';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo $strValue;
  }

  $strKey = 'submitted_film_email';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo '<a href="mailto:'.$strValue.';">'.$strValue.'</a>';
  }

  $strKey = 'submitted_film_subject';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo $strValue;
  }

  $strKey = 'submitted_film_company';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo $strValue;
  }

  $strKey = 'submitted_film_genre';
  if( $column_name == $strKey ) { 
    $strValue = get_post_meta($post->ID, $strKey, true); 
    echo $strValue;
  }
}
add_action( 'manage_submitted_film_posts_custom_column', 'amr_submitted_film_custom_column' );
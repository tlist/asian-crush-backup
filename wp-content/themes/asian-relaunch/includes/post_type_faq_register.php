<?php
/* FAQ Post Type*/
  $labels = array(
    'name' => _x('FAQs', 'post type general name'),
    'singular_name' => _x('FAQ', 'post type singular name'),
    'add_new' => _x('Add New', 'FAQ'),
    'add_new_item' => __('Add New FAQ'),
    'edit_item' => __('Edit FAQ'),
    'new_item' => __('New FAQ'),
    'all_items' => __('All FAQs'),
    'view_item' => __('View FAQ'),
    'search_items' => __('Search FAQs'),
    'not_found' =>  __('No FAQs found'),
    'not_found_in_trash' => __('No FAQs found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'FAQs'
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
    'menu_position' => 5,
    'supports' => array('title','editor','page-attributes')
  ); 
  
  
  register_post_type('faq',$args);

	//add filter to ensure the text Movie, or movie, is displayed when user updates a movie 
  add_filter('post_updated_messages', 'amr_faq_updated_messages');
function amr_faq_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['faq'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('FAQ updated. <a href="%s">View FAQ</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('FAQ updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('FAQ restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('FAQ published. <a href="%s">View FAQ</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('FAQ saved.'),
    8 => sprintf( __('FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

function set_custom_post_types_admin_order($wp_query) {  
  if (is_admin()) {  
  
    // Get the post type from the query  
    $post_type = $wp_query->query['post_type'];  
  
    if ( $post_type == 'faq') {  
  
      // 'orderby' value can be any column name  
      $wp_query->set('orderby', 'menu_order');  
  
      // 'order' value can be ASC or DESC  
      $wp_query->set('order', 'ASC');  
    }  
  }  
}  
add_filter('pre_get_posts', 'set_custom_post_types_admin_order'); 



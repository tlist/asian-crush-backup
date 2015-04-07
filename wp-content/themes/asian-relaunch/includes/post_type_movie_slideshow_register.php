<?php
/* Movies Slideshow Post Type*/
  $labels = array(
    'name' => _x('Movies Slideshow', 'post type general name'),
    'singular_name' => _x('Movie-slideshows', 'post type singular name'),
    'add_new' => _x('Add New', 'movie_slideshow'),
    'add_new_item' => __('Add New Movie-slideshows'),
    'edit_item' => __('Edit Movie-slideshows'),
    'new_item' => __('New Movie-slideshows'),
    'all_items' => __('All Movies Slideshow'),
    'view_item' => __('View Movie-slideshows'),
    'search_items' => __('Search Movies Slideshow'),
    'not_found' =>  __('No movie-slideshows found'),
    'not_found_in_trash' => __('No movie-slideshows found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Movies Slideshow'
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
    'supports' => array('title','author', 'page-attributes')
  ); 
  
  register_post_type('movie_slideshow',$args);

	//add filter to ensure the text Movie-slideshows, or movie_slideshow, is displayed when user updates a movie_slideshow 
  add_filter('post_updated_messages', 'amr_movie_slideshow_updated_messages');
function amr_movie_slideshow_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['movie_slideshow'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Movie-slideshows updated. <a href="%s">View movie-slideshow</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Movie-slideshows updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Movie-slideshows restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Movie-slideshows published. <a href="%s">View movie-slideshow</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Movie-slideshows saved.'),
    8 => sprintf( __('Movie-slideshows submitted. <a target="_blank" href="%s">Preview movie-slideshow</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Movie-slideshows scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview movie-slideshow</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Movie-slideshows draft updated. <a target="_blank" href="%s">Preview movie-slideshow</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

 	
  

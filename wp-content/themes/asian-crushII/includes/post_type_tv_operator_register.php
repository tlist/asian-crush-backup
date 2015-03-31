<?php
/* tv_operator Post Type*/
  $labels = array(
    'name' => _x('Tv Operators', 'post type general name'),
    'singular_name' => _x('Tv Operator', 'post type singular name'),
    'add_new' => _x('Add New', 'Tv Operator'),
    'add_new_item' => __('Add New Tv Operator'),
    'edit_item' => __('Edit Tv Operator'),
    'new_item' => __('New Tv Operator'),
    'all_items' => __('All Tv Operators'),
    'view_item' => __('View Tv Operator'),
    'search_items' => __('Search Tv Operators'),
    'not_found' =>  __('No Tv Operators found'),
    'not_found_in_trash' => __('No Tv Operators found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Tv Operators'
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
    'supports' => array('title','author','thumbnail')
  ); 
  
  
  register_post_type('tv_operator',$args);
  

  $labels = array(
    'name' => _x( 'Operator Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Operator Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Operator Types' ),
    'all_items' => __( 'All Operator Types' ),
    'parent_item' => __( 'Parent Operator Type' ),
    'parent_item_colon' => __( 'Parent Operator Type:' ),
    'edit_item' => __( 'Edit Operator Type' ), 
    'update_item' => __( 'Update Operator Type' ),
    'add_new_item' => __( 'Add New Operator Type' ),
    'new_item_name' => __( 'New Operator Type Name' ),
    'menu_name' => __( 'Operator Types' ),
  ); 	

  register_taxonomy('operator_type',array('tv_operator'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'operator_type' ),
  ));
  
  
function amr_tv_operator_posts_columns( $posts_columns ) {
    $tmp = array();
	$tmp['cb'] = $posts_columns['cb'];
	$tmp['title'] = 'Movie Title';
	$tmp['operator-thumb'] = 'Operator Thumb';
	$tmp['operator_type'] = 'Operator Type';
	$tmp['author'] = $posts_columns['author'];
	$tmp['date'] = $posts_columns['date'];
	return $tmp;
}

add_filter( 'manage_tv_operator_posts_columns', 'amr_tv_operator_posts_columns');

function amr_tv_operator_custom_column( $column_name ) {
    global $post;
	
	if( $column_name == 'operator-thumb' ) {
		echo "<a href='" . get_edit_post_link( $post->ID ) . "'>" . get_the_post_thumbnail( $post->ID, 'thumbnail', 'alt=' . $post->post_title . '&title=' . $post->post_title ) . "</a>";
    }

	if( $column_name == 'operator_type' ) { // ta quy uoc ten cot giong ten taxonomy
		$categories = get_the_terms( $post->ID, $column_name );
		if ( !empty( $categories ) ) {
			$out = array();
			foreach ( $categories as $c )
				$out[] = "<a href='edit.php?$column_name=$c->slug&post_type=tv_operator'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $column_name, 'amr')) . "</a>";
			echo join( ', ', $out );
		}
		else {
			_e('Uncategorized');
		}	
	}

}
add_action( 'manage_tv_operator_posts_custom_column', 'amr_tv_operator_custom_column' );


	//add filter to ensure the text Movie, or movie, is displayed when user updates a movie 
  add_filter('post_updated_messages', 'amr_tv_operator_updated_messages');
function amr_tv_operator_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['tv_operator'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Tv_operator updated. <a href="%s">View Tv Operator</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Tv Operator updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Tv Operator restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Tv Operator published. <a href="%s">View Tv Operator</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Tv Operator saved.'),
    8 => sprintf( __('Tv Operator submitted. <a target="_blank" href="%s">Preview Tv Operator</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Tv Operator scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Tv Operator</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Tv Operator draft updated. <a target="_blank" href="%s">Preview Tv Operator</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
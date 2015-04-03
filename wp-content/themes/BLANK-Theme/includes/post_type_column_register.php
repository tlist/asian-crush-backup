<?php
/* Newscolumn Post Type*/
  $labels = array(
    'name' => _x('Column', 'post type general name'),
    'singular_name' => _x('Column', 'post type singular name'),
    'add_new' => _x('Add New', 'column'),
    'add_new_item' => __('Add New Column'),
    'edit_item' => __('Edit Column'),
    'new_item' => __('New Column'),
    'all_items' => __('All Column'),
    'view_item' => __('View Column'),
    'search_items' => __('Search Column'),
    'not_found' =>  __('No columns found'),
    'not_found_in_trash' => __('No columns found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Column'
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
    'supports' => array('title','editor','author','thumbnail')
  ); 
  
  
  register_post_type('column',$args);

	//add filter to ensure the text Column, or column, is displayed when user updates a column 
  add_filter('post_updated_messages', 'amr_column_updated_messages');
function amr_column_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['column'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Column updated. <a href="%s">View column</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Column updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Column restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Column published. <a href="%s">View column</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Column saved.'),
    8 => sprintf( __('Column submitted. <a target="_blank" href="%s">Preview column</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Column scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview column</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Column draft updated. <a target="_blank" href="%s">Preview column</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


function amr_column_posts_columns( $posts_columns ) {
    $tmp = array();
	$tmp['cb'] = $posts_columns['cb'];
	$tmp['title'] = 'Column Title';
	$tmp['column-thumb'] = 'Thumb';
	$tmp['column_genre'] = 'Genres';
	$tmp['column_region'] = 'Region';
	$tmp['column_director'] = __('Directors');
	$tmp['column_actor_actress'] = __('Actors / Actresses');
	$tmp['author'] = $posts_columns['author'];
	$tmp['date'] = $posts_columns['date'];
	return $tmp;
}

add_filter( 'manage_column_posts_columns', 'amr_column_posts_columns');

function amr_column_custom_column( $column_name ) {
    global $post;
	
	if( $column_name == 'column-thumb' ) {
		echo "<a href='" . get_edit_post_link( $post->ID ) . "'>" . get_the_post_thumbnail( $post->ID, 'thumbnail', 'alt=' . $post->post_title . '&title=' . $post->post_title ) . "</a>";
    }

	if( $column_name == 'column_genre' ) { // ta quy uoc ten cot giong ten taxonomy
		$categories = get_the_terms( $post->ID, $column_name );
		if ( !empty( $categories ) ) {
			$out = array();
			foreach ( $categories as $c )
				$out[] = "<a href='edit.php?$column_name=$c->slug&post_type=column'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $column_name, 'amr')) . "</a>";
			echo join( ', ', $out );
		}
		else {
			_e('Uncategorized');
		}	
	}

	if( $column_name == 'column_region' ) { // ta quy uoc ten cot giong ten taxonomy
		$categories = get_the_terms( $post->ID, $column_name );
		if ( !empty( $categories ) ) {
			$out = array();
			foreach ( $categories as $c )
				$out[] = "<a href='edit.php?$column_name=$c->slug&post_type=column'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $column_name, 'amr')) . "</a>";
			echo join( ', ', $out );
		}
		else {
			_e('Uncategorized');
		}	
	}

	if( $column_name == 'column_director' ) { // ta quy uoc ten cot giong ten taxonomy
		$categories = get_the_terms( $post->ID, $column_name );
		if ( !empty( $categories ) ) {
			$out = array();
			foreach ( $categories as $c )
				$out[] = "<a href='edit.php?$column_name=$c->slug&post_type=column'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $column_name, 'amr')) . "</a>";
			echo join( ', ', $out );
		}
		else {
			_e('Uncategorized');
		}	
	}

	if( $column_name == 'column_actor_actress' ) { // ta quy uoc ten cot giong ten taxonomy
		$categories = get_the_terms( $post->ID, $column_name );
		if ( !empty( $categories ) ) {
			$out = array();
			foreach ( $categories as $c )
				$out[] = "<a href='edit.php?$column_name=$c->slug&post_type=column'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $column_name, 'amr')) . "</a>";
			echo join( ', ', $out );
		}
		else {
			_e('Uncategorized');
		}	
	}



}
add_action( 'manage_column_posts_custom_column', 'amr_column_custom_column' );

 	
  /* Taxonomy for column 
   * column_genre
   * column_director
   * column_actor_actress
   * */
    
  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'menu_name' => __( 'Genres' ),
  ); 	

  register_taxonomy('column_genre',array('column', 'column_slideshow'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'column_genre' ),
  ));
  
  $labels = array(
    'name' => _x( 'Directors', 'taxonomy general name' ),
    'singular_name' => _x( 'Director', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Director' ),
    'all_items' => __( 'All Directors' ),
    'parent_item' => __( 'Parent Director' ),
    'parent_item_colon' => __( 'Parent Director:' ),
    'edit_item' => __( 'Edit Director' ), 
    'update_item' => __( 'Update Director' ),
    'add_new_item' => __( 'Add New Director' ),
    'new_item_name' => __( 'New Director Name' ),
    'menu_name' => __( 'Directors' ),
  ); 	

  register_taxonomy('column_director',array('column'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'column_director' ),
  ));
  
  $labels = array(
    'name' => _x( 'Actors/Actresses', 'taxonomy general name' ),
    'singular_name' => _x( 'Actor/Actress', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Actors/Actresses' ),
    'all_items' => __( 'All Actors/Actresses' ),
    'parent_item' => __( 'Parent Actor/Actress' ),
    'parent_item_colon' => __( 'Parent Actor/Actress:' ),
    'edit_item' => __( 'Edit Actor/Actress' ), 
    'update_item' => __( 'Update Actor/Actress' ),
    'add_new_item' => __( 'Add New Actor/Actress' ),
    'new_item_name' => __( 'New Actor/Actress Name' ),
    'menu_name' => __( 'Actors/Actresses' ),
  ); 	

  register_taxonomy('column_actor_actress',array('column'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'column_actor_actress' ),
  ));
  
  $labels = array(
    'name' => _x( 'Regions', 'taxonomy general name' ),
    'singular_name' => _x( 'Region', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Regions' ),
    'all_items' => __( 'All Regions' ),
    'parent_item' => __( 'Parent Region' ),
    'parent_item_colon' => __( 'Parent Region:' ),
    'edit_item' => __( 'Edit Region' ), 
    'update_item' => __( 'Update Region' ),
    'add_new_item' => __( 'Add New Region' ),
    'new_item_name' => __( 'New Region Name' ),
    'menu_name' => __( 'Region' ),
  ); 	

  register_taxonomy('column_region',array('column'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'column_region' ),
  )); 
  
//display contextual help for Column
add_action( 'contextual_help', 'amr_column_add_help_text', 10, 3 );
function amr_column_add_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('column' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a column:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct writer of the column.  Remember that the Author module refers to you, the author of this column review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the column review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-column' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of columns blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
}
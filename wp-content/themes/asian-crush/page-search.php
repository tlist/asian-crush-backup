<?php
/**
 * Template Name: Page Search
 */
$key = isset($_GET['key']) ? $_GET['key'] : '';
$movie_genre_cat = isset($_GET['movie_genre_cat']) ? $_GET['movie_genre_cat'] : 0;

$rows_obj = array();
$found_terms_arr = array();

if ($key) {
	
	$where_conditions = array();	
	$where_conditions[]	=	"(
								(posts.post_title LIKE '%%" . like_escape( $key ) . "%%')
								OR
								(posts.post_content LIKE '%%" . like_escape( $key ) . "%%')
							 )";
/* BEGIN GET INFORMATION FOR CATEGORY COUNT*/

$strQuery = "	SELECT temp.ID, GROUP_CONCAT(temp.taxonomy SEPARATOR ';') taxonomies, GROUP_CONCAT(temp.terms_id SEPARATOR ';') terms_id FROM 
						(SELECT posts.ID ID, term_taxonomy.taxonomy taxonomy, GROUP_CONCAT(term_taxonomy.term_id SEPARATOR ',') terms_id 
						FROM 		{$wpdb->prefix}posts posts 
						LEFT JOIN 	{$wpdb->prefix}term_relationships term_rel
						ON 			(posts.ID = term_rel.object_id)
						LEFT JOIN	{$wpdb->prefix}term_taxonomy term_taxonomy
						ON			(term_rel.term_taxonomy_id = term_taxonomy.term_taxonomy_id AND term_taxonomy.taxonomy = 'movie_genre')
					 	WHERE (posts.post_type = 'movie') AND (posts.post_status = 'publish') AND"
					 	. join( ' AND ', $where_conditions ) .
					 	"GROUP BY term_taxonomy.taxonomy, posts.ID) AS temp
				GROUP BY temp.ID
			 ";

$rows_obj = $wpdb->get_results( $strQuery );

//for each $row_obj, for each term_id of this object, we need to find all term parent of it

	if ($rows_obj) 
	{
		foreach ($rows_obj as $row_obj) {
				
				$terms_temp_arr = array();
				//stranform $row_obj->terms_id to array
				$row_obj->terms_id = $row_obj->terms_id ? explode (',', $row_obj->terms_id) : array();
				//for each terms_id get_ancestors
				foreach ($row_obj->terms_id as $term_id) {
					$terms_temp_arr = array_merge($terms_temp_arr, get_ancestors($term_id, 'movie_genre'));
				}
				
				//now we merge $terms_temp_arr with original $row_obj->terms_id
				$row_obj->terms_id = array_merge($row_obj->terms_id, $terms_temp_arr);
				//and remove duplicate
				$row_obj->terms_id = array_unique($row_obj->terms_id);	
				//now $row_obj->terms_id is an array contain all term this $row_obj belong (inlucde parents)
		} 
		
		//now get all movie genre and number of post for each movie genre of
		$found_terms_arr = array();
		foreach ($rows_obj as $row_obj) {
			/**
			 * Now the client want if it already in one of main movie cat it will not show in orther again.
			 */
			if 	( in_array(_CATE_ID_SPORTS, $row_obj->terms_id) )
			{
				$found_terms_arr[_CATE_ID_SPORTS] = $found_terms_arr[_CATE_ID_SPORTS] ? ($found_terms_arr[_CATE_ID_SPORTS] + 1) : 1; 
			}
			else if (in_array(_CATE_ID_ANIME, $row_obj->terms_id))
			{
				$found_terms_arr[_CATE_ID_ANIME] = $found_terms_arr[_CATE_ID_ANIME] ? ($found_terms_arr[_CATE_ID_ANIME] + 1) : 1; 
			}
			else if (in_array(_CATE_ID_MOVIES, $row_obj->terms_id))
			{
				$found_terms_arr[_CATE_ID_MOVIES] = $found_terms_arr[_CATE_ID_MOVIES] ? ($found_terms_arr[_CATE_ID_MOVIES] + 1) : 1;
			}
			
/*
			foreach ($row_obj->terms_id as $term_id) {
				if( in_array($term_id, PfBase::app()->params['main_cat_id_arr']) ) //limit only to main category
					$found_terms_arr[(int)$term_id] = $found_terms_arr[(int)$term_id] ? ($found_terms_arr[(int)$term_id] + 1) : 1; 
			}
*/
		}
		
		//
		arsort($found_terms_arr);
		
		//sure it will have post so we setup post query 
		
		/*SETUP DATA*/
		$arrPostArgs	=	array(
						'post_type' => 'movie',
						'tax_query' => array(
							'relation' => 'AND',
						)
		);
		
		/* limit only post had search key*/
	 	add_filter( 'posts_where' , 'amr_posts_where_search_key' );
		function amr_posts_where_search_key( $where ) {		
			$where .= 
								" AND (
									(post_title LIKE '%%" . like_escape( $_GET['key'] ) . "%%')
									OR
									(post_content LIKE '%%" . like_escape( $_GET['key'] ) . "%%')
								 ) ";
			return $where;
		}	
		/* limit only post had search key*/
		
		$arrPostTemplate = array(
			'group1' => array (
							'image' => array('type' => 'thumbnail'),
							'watch-online' => '',
						),
			'group2' => array (
							'title' => '',
							'cate-genre' => array('type' => 'movie_genre', 'separator' => ' / '),
							'meta-duration' => array('key' => 'movie_duration'),
							'cate-director' => array('caption' => __('Director(s):'), 'type' => 'movie_director', 'separator' => ' , ', 'cssClass' => ''),
							'cate-starring' => array('caption' => __('Starring:'), 'type' => 'movie_actor_actress', 'separator' => ', ', 'cssClass' => ''),
							'meta-plot' => array('caption' => __('Plot:'), 'key' => 'movie_plot', 'charLimit' => 150),
						),
		);
		
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' ); 			
		if (!$page)
		{
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
		}
		$arrPostArgs['posts_per_page'] = 5;
				
		if ($movie_genre_cat) {
			$plan = 2; // list with category and pagination
			$arrPostArgs['paged'] = $page;
			
			/**
			 * Now the client want if it already in one of main movie cat it will not show in orther again.
			 * loai cheo lan nhau, me kiep
			 */			

			if ($movie_genre_cat == _CATE_ID_MOVIES)
			{
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_MOVIES ),
							'operator' => 'IN'
				);
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'NOT IN'
				);
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_ANIME ),
							'operator' => 'NOT IN'
				);																
			}
			else if ($movie_genre_cat == _CATE_ID_ANIME)
			{
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_ANIME ),
							'operator' => 'IN'
				);
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'NOT IN'
				);																			
			}			
			else if ($movie_genre_cat == _CATE_ID_SPORTS)
			{
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'IN'
				);																	
			}			

			
			/**
			 * Now the client want if it already in one of main movie cat it will not show in orther again.
			 */			
			
			
		}
		else{
			$plan = 3; // for evey $found_term_arr, we just list 5 item limit and nopagination
		}
		
	}else
	{
		$plan = 1; // dont have any thing relative to your search
	}

}
else{
	$plan = 0; // echo please insert something to seach
}





//var_dump($found_terms_arr);

//echo "<pre>";
//var_dump($rows_obj);
//echo "</pre>";

/* END GET INFORMATION FOR CATEGORY COUNT*/



 
?>
<?php get_header() ?>
	
    <?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>
	<div class="main_content cls-search-page">	
		
		<div class="movie_search movie_search_result white_bg">
            <p><?php echo count($rows_obj);  ?> results for "<?php echo $key; ?>"</p>
            <div class="types">
            	<a href="<?php echo get_bloginfo("url") ."/search/?key=". urlencode($key); ?>" id="t1">All results (<?php echo count($rows_obj);   ?>)</a>
            	<?php foreach ($found_terms_arr as $movie_cat => $count) { 
            			$the_term = (get_term_by('id', $movie_cat, 'movie_genre'));
            		?>
            			<a href="<?php echo get_bloginfo("url") ."/search/?key=". urlencode($key) . "&movie_genre_cat=" . $movie_cat ?>" id="t2"><?php  echo $the_term->name; ?> (<?php echo $count ?>)</a>
            	<?php } ?>
            </div>
        </div>
		
		<div class="columns cls-movie-grid columns group">
			<div class="right_col group">
                <?php dynamic_sidebar('ad-right'); ?>
            	
            </div> 
        		
	<?php if 		($plan == 0) { ?>
				<div class="left_col search_results" >
					<?php echo __("Please enter something to search") ?>
				</div>		
	<?php }	
		  else if 	($plan == 1) { ?>
				<div class="left_col search_results" >
					<?php echo __("No result for your search") ?>
				</div>		
	<?php	  		
		  }
		  else if 	($plan == 2) {
				$the_query  = new WP_Query( $arrPostArgs ); // this will effect main query
				//remove_filter ( 'posts_where' , 'amr_posts_where_search_key' ); // revent any side effect
				$rows_post	=	$the_query->posts;	  
				$the_term = (get_term_by('id', $movie_genre_cat, 'movie_genre'));
				$bottom_num = ($page - 1) * 5 + 1; // 5 is post per page
				$top_num = (($bottom_num + ($arrPostArgs['posts_per_page'] - 1)) >= $the_query->found_posts ) ? $the_query->found_posts : ($bottom_num + ($arrPostArgs['posts_per_page'] - 1));
	?>
			
						<div class="left_col search_results movie_grid cls-search-group">
							<div class="result_type"><?php echo $the_term->name; ?> (<?php echo $the_query->found_posts; ?>) <em>matching "<?php echo $key; ?>" <?php echo $bottom_num;  ?>-<?php echo $top_num ?> of <?php echo $the_query->found_posts; ?></em></div>
									<div class="pagination">
								         <?php
								          if ($the_query->max_num_pages > 1) {
								          	echo '<em>'.__('Pages:').'</em>';
													$page > 1 ? $current = $page : $current = 1;
													$pagination_string = array(
														'base' => @add_query_arg('page','%#%'),
														'format' => '',
														'total' => $the_query->max_num_pages,
														'current' => $current,
														'show_all' => false,
														'type' => 'plain',
														'prev_text' => '&lt;',
														'next_text' => '&gt;',
														'end_size'     => 2,
    													'mid_size'     => 3,
													);
													echo paginate_links( $pagination_string );
								        } ?>
								    </div>
							 	<?php echo amr_post_listing($rows_post, 1, $arrPostTemplate, 'clearfix'); ?>	
								    <div class="pagination">
								         <?php 
								          if ($the_query->max_num_pages > 1) {
								          	echo '<em>'.__('Pages:').'</em>';
											echo paginate_links( $pagination_string );
								        } ?>
								    </div>
					</div> <!-- end wrapper -->
			
	<?php	
		  }
		else if ($plan == 3){ ?>
			
	<?php	foreach ($found_terms_arr as $movie_genre_cat => $count) {
				$the_term = (get_term_by('id', $movie_genre_cat, 'movie_genre'));
				$arrTempPostArgs = $arrPostArgs;
			/**
			 * Now the client want if it already in one of main movie cat it will not show in orther again.
			 * loai cheo lan nhau, me kiep
			 */			

			if ($movie_genre_cat == _CATE_ID_MOVIES)
			{
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_MOVIES ),
							'operator' => 'IN'
				);
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'NOT IN'
				);
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_ANIME ),
							'operator' => 'NOT IN'
				);																
			}
			else if ($movie_genre_cat == _CATE_ID_ANIME)
			{
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_ANIME ),
							'operator' => 'IN'
				);
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'NOT IN'
				);																			
			}			
			else if ($movie_genre_cat == _CATE_ID_SPORTS)
			{
				$arrTempPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( _CATE_ID_SPORTS ),
							'operator' => 'IN'
				);																	
			}			

			
			/**
			 * Now the client want if it already in one of main movie cat it will not show in orther again.
			 */			
				
					
				$the_query  = new WP_Query( $arrTempPostArgs ); // this will effect main query
				$rows_post	=	$the_query->posts;	  
				$bottom_num = 1; // 5 is post per page
				$top_num = (($bottom_num + (5 - 1)) >= $the_query->found_posts ) ? $the_query->found_posts : (($bottom_num + (5 - 1)));
	?>
	
						<div class="left_col search_results movie_grid cls-search-group">
							<div class="result_type"><?php echo $the_term->name; ?> (<?php echo $the_query->found_posts ?>) <em>matching "<?php echo $key; ?>" <?php echo $bottom_num; ?>-<?php echo $top_num; ?> of <?php echo $the_query->found_posts; ?></em></div>
							 	<?php echo amr_post_listing($rows_post, 1, $arrPostTemplate, 'clearfix'); ?>	
						</div> <!-- end wrapper -->
	<?php			 
			}
	?>
				
			
	<?php
		}
		
	remove_filter ( 'posts_where' , 'amr_posts_where_search_key' ); // revent any side effect
	?>

            
            
            
        </div>
	   
            

    </div>    
	    
<?php get_footer() ?>
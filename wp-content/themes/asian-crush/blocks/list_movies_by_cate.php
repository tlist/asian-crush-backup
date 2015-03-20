<?php
if (!isset($showFilter)) $showFilter = 0;
if (!isset($pagination)) $pagination = false;
if (!isset($page)) $page = 1;
if (!isset($itemsPerPage)) $itemsPerPage = 35;
if (!isset($cate_id)) $cate_id = ''; // movie_genre
if (!isset($movie_region)) $movie_region = '';
if (!isset($movie_begin_with)) $movie_begin_with = '';
if (!isset($numItemsPerRow)) $numItemsPerRow = 7;

global $wp_query, $wp_rewrite;

$args = array(
	'post_type' => 'movie',
	'tax_query' => array(
		'relation' => 'AND',
	),
	'posts_per_page' => $itemsPerPage,       // if (nopaging == true) this will always show all post even if you set it to any value
	'paged'	   =>  $page
	
 );
 
 if ($pagination){
 	$args['nopaging'] = false;
 }else{
 	$args['nopaging'] = true;
 }
 
 if ($cate_id) {
 	$args['tax_query'][] = 		array(
										'taxonomy' => 'movie_genre',
										'field' => 'id',
										'terms' => array( $cate_id ),
										'operator' => 'IN'
									);
	/* Defaut with a normal $CAT_ID (not MOVIE) we will list all movie belong to this $CAT_ID or sub-category of this $CAT_ID 
	 * NOW MOVIE, ANIME, SPORT is in the same level
	 * So normaly, With $cate_id = MOVIES, movie in ANIME, SPORT will not be list 
	 * 
	 * */
	
	/*
	 * AND THIS IS AN UGLY HACK to also include post in Anime when we are in page_movie.php
	 * */ 	
	 if (is_page_template("page-movies.php") && $cate_id == _CATE_ID_MOVIES)	
	 {
	 	$args['tax_query']['relation'] = 'OR';
	 	
	 }
	/*
	 * AND THIS IS AN UGLY HACK to also include post in Anime when we are in page_movie.php
	 * */ 	
 }
 
  if ($movie_region) {
 	$args['tax_query'][] = 		array(
										'taxonomy' => 'movie_region',
										'field' => 'id',
										'terms' => array( $movie_region ),
										'operator' => 'IN'
									);
 }
  

 
 
if ($movie_begin_with) {
 	add_filter( 'posts_where' , 'amr_posts_where_movie_begin_with' );
	function amr_posts_where_movie_begin_with( $where ) {		
		$where .= " AND (post_title REGEXP '^" . $_GET['movie_begin_with'] . "')";
		return $where;
	}
 }  

$the_query  = new WP_Query( $args ); // this will effect main query

$rows_post	=	$the_query->posts;
$arrPostTemplate = array(
	'group1' => array (
					'image' => array('type' => 'thumbnail'),
					'watch-online' => '',
				),
	'title' => '',
);

if ($movie_begin_with) {
	remove_filter ( 'posts_where' , 'amr_posts_where_movie_begin_with' ); // revent any side effect
}

$arr_movie_region_terms = get_terms('movie_region');
$arr_movie_genre_terms = array();
$main_movie_genre_object = get_term_by('id', (int)$cate_id, 'movie_genre');  

if ( in_array( $cate_id, array(_CATE_ID_MOVIES, _CATE_ID_SPORTS)) )  // Neu la main Movie Categories
{
	if (is_page_template("page-movies.php")) {	
		$arr_movie_genre_terms = get_terms( 'movie_genre', 'hide_empty=0&child_of=' . _CATE_ID_MOVIES .'&parent=' . _CATE_ID_MOVIES ); 
	}
	else
		$arr_movie_genre_terms = get_terms( 'movie_genre', 'hide_empty=0&child_of=' . $cate_id .'&parent=' . $cate_id );
	$main_movie_genre = $cate_id;
	/*Very ugly set $main_movie_genre is one in three main category */
}
else
{	
	$main_movie_genre = amr_get_term_top_most_fixed_parent ( $cate_id, 'movie_genre', array(_CATE_ID_MOVIES, _CATE_ID_SPORTS)); 				//$main_movie_genre will be one in 3 main Movie Categories
	$arr_movie_genre_terms = get_terms( 'movie_genre', 'hide_empty=0&child_of=' . $main_movie_genre->term_id .'&parent=' . $main_movie_genre->term_id); // Movie genre will be direct child terms of this main term 
	$main_movie_genre = $main_movie_genre->term_id;
}

		/* ANIME, MOVIE, SPORT now had same level 
		 * List all sub terms of MOVIE will not include ANIME anymore
		 * AND THIS IS AN UGLY HACK to also include _CATE_ID_ANIME in genre filter when we are in page_movie.php
		 * */	
		 if (is_page_template("page-movies.php")) {
		 	$arr_movie_genre_terms[] = $anime_movie_genre_object;
		 }	

//echo '<pre>';
//$arr_movie_genre_terms 	= get_terms( 'movie_genre');
//var_dump($queried_object);
//var_dump($arr_movie_region_terms);
//var_dump($arr_movie_genre_terms);
//echo '</pre>';


?>

<?php if ($showFilter) { ?>
<div class="movie_search white_bg">
    <p class="filter">Filter <?php echo ucfirst (strtolower ($main_movie_genre_object->name)); ?> (<?php echo $the_query->found_posts; ?>)</p>
    <form action="." method="get">
    	<fieldset>
        	<ul>
            	<li id="region">
                	<label><?php echo __('REGION') ?></label>
                    <select name="movie_region">
                    	<option value=""><?php echo __('All') ?></option>
                    	<?php foreach ($arr_movie_region_terms as $movie_region_term) { ?>
                       	 			<option value="<?php echo $movie_region_term->term_id; ?>" 
                       	 				<?php if ($movie_region_term->term_id == $movie_region ) echo "selected" ?>>
                       	 				<?php echo $movie_region_term->name; ?></option>     
                       	<?php } ?>
                    </select>
            	</li>
                <li id="az">
                    <label>A-Z</label>
                    <select name="movie_begin_with">
                    	<option value="">--</option>
                    	<?php for ($i=65; $i<=90; $i++) { ?>
                        		<option value="<?php echo chr($i); ?>"
                        			<?php if (chr($i) == $movie_begin_with ) echo "selected" ?>><?php echo chr($i); ?></option>
                        <?php } ?>
                    </select>
            	</li>
                <li id="view">
                    <label><?php echo __('VIEW') ?></label>
                    <select name="movie_view">
                        <option value="30">--</option>
                        <option value="35" <?php if($itemsPerPage == 35) echo 'selected'; ?>>35</option>
                        <option value="70" <?php if($itemsPerPage == 70) echo 'selected'; ?>>70</option>
                    </select>
                </li>
                <?php
                if (count($arr_movie_genre_terms) > 0)
				{
				?>
				<li id="gerne">
                    <label><?php echo __('GENRE') ?></label>
                    <select name="movie_genre" class="styled_select">
						<option value="<?php if (is_page_template("page-movies.php")) echo _CATE_ID_MOVIES; else echo $main_movie_genre; ?>">--</option>
						<?php foreach ($arr_movie_genre_terms as $movie_genre_term) { ?>
                        <option value="<?php echo $movie_genre_term->term_id ?>" <?php if ($cate_id == $movie_genre_term->term_id) {echo 'selected';} ?>><?php echo $movie_genre_term->name; ?></option>
                        <?php } ?>
					</select>
                </li>
                <?php
				}
				?>
                <li><button type="submit" id="btn_filter"></button></li>
				
            </ul>
        </fieldset>
    </form>
</div>
<?php } ?>
<div class="movie_grid wrapper white_bg group cls-movie-grid-relative">
	
    <p class="movie_results">
    <?php if($main_movie_genre_object->name != 'Hulu'){ 
    		echo "(".$the_query->found_posts.")"; ?>movies in <em><?php echo $main_movie_genre_object->name; ?></em>
	<?php }else {
			echo "(".$the_query->found_posts .") movies";	
	} ?>     
    </p>

    <div class="pagination cls-pagination-top">
        <?php
        if (function_exists('wp_paginate'))
        {
        	global $wp_query;
		    $objWpQueryTmp = $wp_query;
		    $wp_query = $the_query;
		    wp_paginate();
		    $wp_query = $objWpQueryTmp;
        }
        else
        {
	        if ($the_query->max_num_pages > 1) {
	          	echo '<em>Pages:</em>';
						$page > 1 ? $current = $page : $current = 1;
						$pagination_string = array(
							'base' => @add_query_arg('page','%#%'),
							'format' => '',
							'total' => $the_query->max_num_pages,
							'current' => $current,
							'show_all' => False,
							'end_size'     => 1,
							'mid_size'     => 5,
							'type' => 'plain',
							'prev_text' => '&lt;',
							'next_text' => '&gt;'
							);
						echo paginate_links( $pagination_string );
	        }
	    } 
        ?>
    </div>
	 	<?php echo amr_post_listing($rows_post, $numItemsPerRow, $arrPostTemplate, 'clearfix'); ?>
    <div class="pagination cls-pagination-bottom">
    	<?php
        if (function_exists('wp_paginate'))
        {
        	global $wp_query;
		    $objWpQueryTmp = $wp_query;
		    $wp_query = $the_query;
		    wp_paginate();
		    $wp_query = $objWpQueryTmp;
        }
        else
        {
	        if ($the_query->max_num_pages > 1) {
	          	echo '<em>Pages:</em>';
				echo paginate_links( $pagination_string );
	        }
	    } 
        ?>
    </div>
</div> <!-- end wrapper -->

<script>
	
</script>

<?php 
global $wp_query;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
$itemsPerPage = isset($_GET['movie_view']) ? $_GET['movie_view'] : 35;
$movie_region = isset($_GET['movie_region']) ?  $_GET['movie_region'] : '';
$movie_begin_with = isset($_GET['movie_begin_with']) ? $_GET['movie_begin_with'] : '';
$movie_genre = get_queried_object_id();
?>


<?php get_header() ?>

	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>
	
	<div class="main_content">
	<h1>MOVIE GENRE</h1>	
		
	    <?php echo PfBase::getBlock('blocks'.DS.'list_movies_by_cate.php', array('cate_id' => $movie_genre, 'movie_region'=>$movie_region, 'movie_begin_with' => $movie_begin_with,  'showFilter' => 0, 'pagination' => 1, 'page' => $page, 'itemsPerPage' => $itemsPerPage, 'numItemsPerRow' => _NUM_ITEM_PER_ROW_MOVIE_GENRE, 'cacheLifetime' => 30)) ?>	    	    
	    
	</div>

<?php get_footer() ?>
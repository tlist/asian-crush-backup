<?php
/**
 * Template Name: Page Columns
 */
global $wp_query;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
$itemsPerPage = isset($_GET['columns_view']) ? $_GET['columns_view'] : 35;
//$movie_region = isset($_GET['movie_region']) ?  $_GET['_region'] : '';
//$newsfeed_begin_with = isset($_GET['movie_begin_with']) ? $_GET['movie_begin_with'] : '';
//$movie_genre = isset($_GET['movie_genre']) ? $_GET['movie_genre'] : _CATE_ID_MOVIES;
 
?>
<?php get_header() ?>
	<div class="main_content">
	
		<h1><?php echo get_the_title(); ?></h1>
		
        
                

	  

<?php get_footer() ?>

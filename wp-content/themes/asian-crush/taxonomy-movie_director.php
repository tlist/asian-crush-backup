<?php global $wp_query; 
	  $rows_post =  $wp_query->posts;
	  $numItemsPerRow = _NUM_ITEM_PER_ROW_MOVIE_GENRE;
		$arrPostTemplate = array(
			'group1' => array (
							'image' => array('type' => 'medium'),
							'watch-online' => '',
						),
			'title' => '',
		);
		$the_term = get_queried_object();
?>
<?php get_header() ?>

<!--	<?php echo PfBase::getBlock('blocks'.DS.'slideshow_main.php') ?> -->
	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>
	<div class="main_content">
		
<h1>DIRECTOR</h1>		
<!--		
		<div class="breadcrumb">
			<ul>
		    	<li class="alone"><a href="#" class="active"><?php echo "Director: " . $the_term->name; ?>  <span class="arrow"></span></a></li>
		    </ul> 
		</div> --> <!-- end breadcrumb -->

		<div class="movie_grid wrapper white_bg group">
		<h2><?php echo $the_term->name; ?></h2>
			<!--<p class="movie_results">(20) movies in <em>Korean Horror</em></p> -->
			<div class="pagination">
		         <?php 
				global $wp_query, $wp_rewrite;
				$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		          if ($wp_query->max_num_pages > 1) {
		          			echo '<em>Pages:</em>';
							$pagination_string = array(
								'base' => @add_query_arg('page','%#%'),
								'format' => '',
								'total' => $wp_query->max_num_pages,
								'current' => $current,
								'show_all' => false,
								'end_size'     => 2,
    							'mid_size'     => 3,
								'type' => 'plain',
								'prev_text' => '&lt;',
								'next_text' => '&gt;'
								);
							if( $wp_rewrite->using_permalinks() )
							$pagination_string['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
							echo paginate_links( $pagination_string );
		        } ?>
		    </div>
			
			 	<?php echo amr_post_listing($rows_post, $numItemsPerRow, $arrPostTemplate, 'clearfix'); ?>
		    <div class="pagination">
		         <?php 
		          if ($wp_query->max_num_pages > 1) {
		          	echo '<em>Pages:</em>';
					echo paginate_links( $pagination_string );
		        } ?>
		    </div>
		</div> <!-- end wrapper -->
		

	    
	</div>

<?php get_footer() ?>
<?php 
/* 
 * params from parent block
 * $cate_id
 * $limit
 *  */
if (!isset($cate_id)) $cate_id = 0;
if (!isset($limit)) $limit = 18;
if (!isset($numItemsPerRow)) $numItemsPerRow = 6;
if (!isset($numItemsPerSlide)) $numItemsPerSlide = 3;
if (!isset($orderByPopular)) $orderByPopular = 0;
if (!isset($similar_tags_arr)) $similar_tags_arr = array();
if (!isset($movie_id)) $movie_id = 0;

$the_term = get_term_by('id', (int)$cate_id, 'movie_genre');

$arrPostArgs	=	array(
				'post_type' => 'movie',
				'posts_per_page' => $limit,
				'tax_query' => array(
					'relation' => 'AND',
				)
);


if ($cate_id) {
				$arrPostArgs['tax_query'][] 	=	array(
							'taxonomy' => 'movie_genre',
							'field' => 'id',
							'terms' => array( $cate_id ),
							'operator' => 'IN'
				);
}


if ($similar_tags_arr) {
	
		if($movie_id)
			$arrPostArgs["post__not_in"] = array($movie_id);
				
		$arrPostArgs['tax_query'][] 	=	array(
					'taxonomy' => 'movie_similar',
					'field' => 'id',
					'terms' => $similar_tags_arr,
					'operator' => 'IN'
		);
}



if ($orderByPopular)
{
	$arrPostArgs['v_sortby'] = 'views';
	$arrPostArgs['v_order'] = 'DESC';
	$arrPostArgs['v_timespan'] = 'total';
}
else 
{
	$arrPostArgs['showposts'] = $limit;
	$arrPostArgs['orderby'] = 'date';
	$arrPostArgs['order'] = 'DESC';
}



$the_query = new WP_Query( $arrPostArgs );

$rows_post	=	$the_query->posts;

$arrPostTemplate = array(
	'group1' => array (
					'image' => array('type' => 'thumbnail'),
					'watch-online' => '',
				),
	'title' => '',
);
?>

<div class="movie_list cls-block-cate<?php echo $cate_id ?><?php echo $orderByPopular ?> group">
	<?php if (empty($similar_tags_arr) && $the_term ) { ?> 
    	<h2><?php echo $the_term->name ?></h2> <a href="<?php echo get_term_link( $the_term->slug, 'movie_genre' ); ?>" class="fir viewall"><?php _e('View All'); ?></a>
    <?php } ?>
    <?php if (count($rows_post) > $numItemsPerRow) { ?>
		    <div class="buttons">
		        <div class="prev"></div>
		        <div class="next"></div>
		    </div>
    <?php } ?>
   	<?php echo amr_post_listing($rows_post, $numItemsPerRow, $arrPostTemplate, 'clearfix'); ?>
</div>
<?php if (count($rows_post) > $numItemsPerRow) { ?>
<script type="text/javascript">
	jQuery(document).ready( function(){
		var numItemsPerSlide = <?php echo $numItemsPerSlide ?>;
		var numItemsOnRows = <?php echo $numItemsPerRow ?>;
		var strWrapper = '.cls-block-cate<?php echo $cate_id ?><?php echo $orderByPopular ?>';
		var objMainSlideShow = jQuery(strWrapper + ' .cls-post-listing ul').bxSlider({
    		auto: false,
    		infiniteLoop: false,
    		displaySlideQty: numItemsOnRows,
    		moveSlideQty: numItemsPerSlide,
    		autoControls: false,
    		controls: true,
    		speed: <?php echo (int) (get_option('amr_slideshow_speed', 1000)) ?>,
    		prevSelector: strWrapper + ' .buttons .prev',
    		nextSelector: strWrapper + ' .buttons .next',
    		onAfterSlide: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
			  if (currentSlideNumber + numItemsOnRows >= <?php echo count($rows_post) ?>)
			  {
			  	jQuery(strWrapper + ' .buttons .next a').addClass('cls-disabled');
			  }
			  else
			  {
			  	jQuery(strWrapper + ' .buttons .next a').removeClass('cls-disabled');
			  }
			  
			  if (currentSlideNumber == 0)
			  {
			  	jQuery(strWrapper + ' .buttons .prev a').addClass('cls-disabled');
			  }
			  else
			  {
			  	jQuery(strWrapper + ' .buttons .prev a').removeClass('cls-disabled');
			  }
			}
  		});
  	});
</script>
<?php } ?>
<?php wp_reset_query(); //always do this  ?>
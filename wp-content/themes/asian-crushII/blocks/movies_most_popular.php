<?php
if (!isset($limit)) $limit = 5;
else $limit = (int) $limit;

$arrPostArgs	=	array(
				'post_type' => 'movie',
				'posts_per_page' => $limit,
);

$arrPostArgs['v_sortby'] = 'views';
$arrPostArgs['v_order'] = 'DESC';
$arrPostArgs['v_timespan'] = 'total';

$the_query = new WP_Query( $arrPostArgs );

$rows_post	=	$the_query->posts;

if (count($rows_post) > 0) {
?>

<div class="popular_titles group">
	<div class="breadcrumb">
    	<h4><?php echo __('Most Popular Titles') ?> <span></span></h4>
    </div>
    <?php
    foreach ($rows_post as $numKey => $objPost) {
    	$strYear = get_post_meta($objPost->ID, 'movie_year', true);
		$strYear = $strYear ? " ({$strYear})" : ''; 
		$strText = '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.$objPost->post_title . $strYear . '</a>';
		
		$strThumb = '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.get_the_post_thumbnail($objPost->ID, 'thumbnail', array('alt' => $objPost->post_title, 'title' => $objPost->post_title)).'</a>';
				
    ?>
    <div class="popular_title group">
    	<div class="movie_title"><?php echo $strThumb ?></div>
        <div class="movie_number"><?php echo ($numKey + 1) ?>.</div>
        <div class="movie_desc">
        	<p class="title"><?php echo $strText ?></p>
		</div>
    </div> 
    <?php
	}
	?>
</div>
<?php
}
?>
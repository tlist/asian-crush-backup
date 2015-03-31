<?php get_header() ?>
<?php 
/**	
 *	SETUP DATA FOR A MOVIE
 * $arr_movie_director
 * $arr_movie_actor_actress
 * $arr_movie_region
 * $movie_duration
 * $movie_featured ?
 * $movie_plot
 * $movie_quotes
 * $movie_embedded_video
 * $movie_tills	
  */
$movie_terms = wp_get_object_terms(get_the_ID(), array('movie_director', 'movie_actor_actress', 'movie_region', 'movie_genre') );

$arr_movie_genre = $arr_movie_director = $arr_movie_actor_actress = $arr_movie_region = array();
foreach ($movie_terms as $movie_term) {
	switch ( $movie_term->taxonomy ) {
		case 'movie_director':
			$arr_movie_director[] =  $movie_term->name;
			break;
		case 'movie_actor_actress':
			$arr_movie_actor_actress[] =  $movie_term->name;
			break;
		case 'movie_region':
			$arr_movie_region[] =  $movie_term->name;
			break;		
		case 'movie_genre':
			$arr_movie_genre[] =  $movie_term->name;
			break;				
	}
}


$all_meta_data = amr_get_post_meta_all(get_the_ID());

$movie_year 			= $all_meta_data['movie_year'] ? ' ('. $all_meta_data['movie_year'] . ')' : '';
$movie_duration 		= $all_meta_data['movie_duration'];
$movie_featured 		= $all_meta_data['movie_featured'];
$movie_plot				= $all_meta_data['movie_plot'];
$movie_quotes			= $all_meta_data['movie_quotes'];
$movie_embedded_video 	= $all_meta_data['movie_embedded_video'];
$movie_hulu_video 		= $all_meta_data['movie_hulu_video'];
$movie_amazon_link 		= $all_meta_data['movie_amazon_link'];
$movie_thumb			= $all_meta_data['_thumbnail_id'];

$args = array(
   'post_type' 	=> 'attachment',
   'orderby'   	=> 'menu_order',
   'order'	 	=> 	"ASC",
   'numberposts' => -1,
   'post_parent' => $post->ID,
   'exclude'	 => implode(', ', array($movie_thumb)) 
  );
$movie_tills = array();

$attachments = get_posts( $args );
     if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
           		$movie_tills[] = wp_get_attachment_image( $attachment->ID, 'movie_still');
      }
}
	 
//echo '<pre>';	 
//var_dump($movie_terms);
//var_dump($arr_movie_director);
//var_dump($arr_movie_actor_actress);
//var_dump($arr_movie_region);
//var_dump($all_meta_data);
//var_dump($movie_duration);
//var_dump($movie_feature);
//var_dump($movie_plot);
//var_dump($movie_quotes);
//var_dump($movie_embedded_video);
//var_dump ($movie_tills);
//echo '</pre>';

?>
	
    	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>
    
	<div class="main_content">
		<h1>MOVIES</h1>
        <h2><?php echo get_the_title() ?></h2>
        <?php if ($movie_hulu_video) { 
        echo "<div class=\"movie_hulu_video\">" . $movie_hulu_video ."</div>";
		} ?>
        
        <div class="wrapper movie_profile group">
            <div class="left">
            	<div class="cls-featured-image">
            		<?php the_post_thumbnail('medium', array('alt' => get_the_title(), 'title' => get_the_title(), 'class' => 'thumbnail'));?>
            	</div>
                <?php if ($movie_amazon_link) { ?>
                <a href="<?php echo $movie_amazon_link ?>" class="buy" target="_blank"><img src="<?php echo PfBase::app()->themeUrl; ?>/_img/cta_buy.jpg" alt="BuyDVD on Amazon | <?php bloginfo('name'); ?>"/></a>
                <?php } ?>
                <div class="movie-cast">
                    <table>
                        <tr><th>Director</th></tr>
                        <tr><td><?php echo implode(', ', $arr_movie_director); ?></td></tr>
                        <tr><th>Starring</th></tr>
                        <tr><td><?php echo implode(', ', $arr_movie_actor_actress);?></td></tr>
                   </table>
               </div>
			</div>
        
            <div class="right">
            	<div class="movie_info">
                	<div class="genre">
						<?php echo implode(', ', $arr_movie_genre);
                        if ($movie_duration) { ?>
                        <span class="time"><?php echo $movie_duration; ?></span>
                        <?php } ?>
          			</div>	
					<?php if ($movie_plot) { ?>
					<p><?php echo nl2br($movie_plot); ?></p>
                    <?php } ?>
                    
                    <?php if ($movie_embedded_video) { ?>
                    <h3>TRAILER</h3>
                    <p><?php echo $movie_embedded_video; ?></p>
			        <?php } ?>
					
					<?php if ($post->post_content) { ?>
				    	<?php 
				        $content = apply_filters('the_content', $post->post_content);
				        $content = str_replace(']]>', ']]&gt;', $content);
				        echo $content; ?>
			        <?php } ?>
				</div>
            </div>
            <br clear="all">
            <div class="share">
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e65e86d3cdebecf"></script>
                <!-- AddThis Button END -->			
            </div>
        </div> <!-- end wrapper -->	   
        
        
    <?php 
	$terms = get_the_terms( $post->ID, 'movie_genre' );
	
	
	if($terms){
	?>
	
        <div class="similar"><span class="tab">Similar Movies</span></div>
    
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Similar  -->
	


	<?php
	/*	
	 foreach ( $terms as $term ) {
             $slug .= "&term=". $term -> slug;
            }
	
	<?php
3
$args = array(
4
    'tax_query' => array(
5
        array(
6
            'taxonomy' => 'people',
7
            'field'    => 'slug',
8
            'terms'    => 'bob',
9
            'operator' => 'IN'
10
        )
11
    )
12
);
13
$query = new WP_Query( $args );

	
	
	
	*/
	$i = 0;
	foreach ( $terms as $term ) {		
			if("hulu" == $term -> slug){
				continue;
			}else if($i == 0){
				$slug = "'".$term -> slug."'";
				$i++;
			} else if($i != 0){
				$slug .= ",'".$term -> slug."'";
				$i++;
			}
	}
		
	$array = explode(",", $slug);
	
	
			$arg = array (
				'post_status' => 'publish',
				'post_type' => 'movie',
				'numberposts' => 15,
				'orderby' => 'rand',
				'tax_query' => array(
					array(
						'taxonomy' => 'movie_genre',
						'field' => 'slug',
						'terms' => $array,
						'operator' => 'AND'
					)
				)	
			);
			
			$tax_posts = get_posts($arg ); if($tax_posts): 
	?>
        <ul id="mycarousel14" class="jcarousel-skin-tango">
			
			<?php foreach($tax_posts as $tax_post): 
			$thumbnail = get_the_post_thumbnail($tax_post->ID,"thumbnail",true);
			?>
				
                <li>
        		<span class="top-movie-thumb css-hover2">
                <a href="<?php echo get_permalink($tax_post->ID); ?>"><?php echo $thumbnail; ?></a>
                </span>
                <span class="top-movie-title">
                <a href="<?php echo get_permalink($tax_post->ID); ?>"><?php echo esc_html($tax_post->post_title); ?></a>
                </span>
                </li>
			<?php endforeach; ?>
		
        </ul>
        
	<?php endif; ?>
    </ul></div><!-- movie-genre-box end Similar  -->   
  <?php } ?>  

    
    </div>
    
<?php get_footer() ?>
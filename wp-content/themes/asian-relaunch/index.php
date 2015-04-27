<?php get_header() ?>

	<?php echo PfBase::getBlock('blocks'.DS.'slideshow_main.php', array('limit' => 4)) ?>
	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>	
	<div class="main_content">
		    
			
            
		
		<div class="breadcrumb">
			<ul>
		    	<li class="alone cls-home">
				<a href="javascript:;" class="active"><?php echo __('Recently Added') ?></a>
			</li>
		        <li class="alone cls-popular">
				<a href="javascript:;"><?php echo __('Popular Titles') ?></a>
			</li>
		    </ul> 
		</div> <!-- end breadcrumb -->
		
	    <div class="wrapper cls-content-home group cls-na-content-home">

        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Watch Now  -->
        <h2>Watch Now!</h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/hulu/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel1" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'hulu',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Titles Available on Hulu  -->
        
        
        
        
        
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Action & Martial Arts  -->
        <h2>Action &amp; Martial Arts </h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/action-martial-arts/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel2" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'action-martial-arts',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Action & Martial Arts  -->
        
        
        
        
        
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Drama  -->
        <h2>Drama</h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/drama/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel3" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'drama',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Drama  -->
        
        
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Horror  -->
        <h2>Horror</h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/horror-movies/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel4" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'horror-movies',
            'posts_per_page' => 25
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Horror  -->
        
        
         
        
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Romance  -->
        <h2>Romance</h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/romance/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel5" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'romance',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
            
        
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Romance  -->
        
        
        <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Asian American  -->
        <h2>Asian American</h2>
        <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/asian-america/">View All →</a></p>
        <br clear="all">
        <ul id="mycarousel6" class="jcarousel-skin-tango">
        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'asian-america',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li>
        <span class="top-movie-thumb css-hover2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        <span class="top-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        </li>	
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </ul></div><!-- movie-genre-box end Asian American  -->
	</div> <!-- end wrapper -->
             
	    <div class="wrapper cls-content-popular group">  
        
        <?php $p_counts = wp_count_posts('movie', 'publish'); // <----- Change here  'movie' is post type name
		// var_dump($p_counts);
		$p_counts = (array)$p_counts;
		$p_counts = (int)$p_counts["publish"];
		// var_dump($p_counts);
		// echo $p_counts;
		?>




            <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Watch Now  -->
                <h2>Watch Now!</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/hulu/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel7" class="jcarousel-skin-tango">
				<?php		
                $term ='hulu';			// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Watch Now  -->
            
            <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Action & Martial Arts  -->
                <h2>Action &amp; Martial Arts</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/action-martial-arts/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel8" class="jcarousel-skin-tango">
				<?php		
                $term ='action-martial-arts';	// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Action & Martial Arts  -->
            
            <div class="movie-genre-box clearfix" ><!-- movie-genre-box Drama  -->
                <h2>Drama</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/drama/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel9" class="jcarousel-skin-tango">
				<?php		
                $term ='drama';	// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Drama  -->
            
            
            <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Horror  -->
                <h2>Horror</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/horror-movies/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel10" class="jcarousel-skin-tango">
				<?php		
                $term ='horror-movies';	// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Horror  -->
            
            <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Romance  -->
                <h2>Romance</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/romance/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel12" class="jcarousel-skin-tango">
				<?php		
                $term ='romance';	// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Romance  -->
            
            <div class="movie-genre-box clearfix" ><!-- movie-genre-box start Asian American  -->
                <h2>Asian American</h2>
                <p class="view-all"><a href="<?php echo home_url('/'); ?>movie_genre/asian-america/">View All →</a></p>
                <br clear="all">
                <ul id="mycarousel13" class="jcarousel-skin-tango">
				<?php		
                $term ='asian-america';	// <----- Change here  slug of Genres
                $taxo ='movie_genre';	// taxonomy name
                $i = 1;                 // count 
				$limit = 10;             // <----- Change here posts_per_page
			   
			   
                $posts = wmp_get_popular( array( 'limit' => $p_counts, 'post_type' => 'movie', 'range' => 'all_time' ) );
                global $post;
                
                if (count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
				
                ?>
                <?php 
				if($i > $limit){
					break;
				}
				if( has_term( $term, $taxo ) ) { ?>
                    <li><span class="top-movie-thumb css-hover2">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
                    </span>
                    <span class="top-movie-title">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                    <?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?>
                    </a>
                    </span>
                    </li>
				<?php $i++; } ?>
                <?php endforeach; endif; ?>
        		</ul>
        	</div><!-- movie-genre-box end Asian American  -->
            
            
        </div> <!-- end wrapper -->
        
         <script type="text/javascript">
	    	jQuery('.breadcrumb li a').click( function(){
	    		jQuery('.breadcrumb li a').removeClass('active');
	    		jQuery('.wrapper').hide();
	    		jQuery(this).addClass('active');
	    		var strTmp = jQuery(this).parent().attr('class');
	    		if (strTmp.indexOf('home') >= 0) jQuery('.cls-content-home').fadeIn();
	    		else jQuery('.cls-content-popular').fadeIn();
	    	})
	    	jQuery(document).ready( function(){
	    		jQuery('.cls-content-popular').hide();
	    	})
	    </script>


<?php get_footer() ?>
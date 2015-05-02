<?php get_header() ?>

	<?php echo PfBase::getBlock('blocks'.DS.'slideshow_main.php', array('limit' => 4)) ?>
	<div class="main_content">
		    
			
            
		
		<div class="breadcrumb">
			<ul>
		    	<li class="alone cls-home">
				<a href="javascript:;" class="active"><?php echo __('All') ?></a>
			</li>
		        <li class="alone cls-newsfeed">
				<a href="javascript:;"><?php echo __('Newsfeed') ?></a>
			</li>
			</li>
		        <li class="alone cls-columns">
				<a href="javascript:;"><?php echo __('Columns') ?></a>
			</li>
		    </li>
		        <li class="alone cls-movies">
				<a href="javascript:;"><?php echo __('Movies') ?></a>
			</li>
		    </ul> 
	
		</div> <!-- end breadcrumb -->
		
	   
		<ul class="tile-wrapper">

        <?php query_posts( array(
            'post_type' => 'movie',
            'taxonomy' => 'movie_genre',
            'term' => 'hulu',
            'posts_per_page' => 25 
        )); ?>
        <?php if(have_posts()): ?>
        <?php while(have_posts()):the_post(); ?>
         
        
        <li class="tile">
        <span class="tile-movie-thumb css-tile2">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('top-thumb'); ?></a>
        </span>
        
		<span class="tile-movie-title">
        <a href="<?php the_permalink() ?>"><?php if(mb_strlen($post->post_title)>25) { $title= mb_substr($post->post_title,0,25) ; echo $title."..." ; } else {echo $post->post_title;}?></a>
        </span>
        
		<span class="tile-description">
		 <?php echo $post->post_excerpt; ?>
		</span>
	
	    <span class="tile-readmore">
		<a href="<?php the_permalink() ?>">Read More</a>
		</span>
		
		<span class="tile-author">
		<?php echo $post->post_author; ?>
		</span>
		
		</li>	
        
         
        <?php endwhile; else: ?>
         
        <p>Sorry No item</p>
         
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        
        
		</ul> <!-- end tile wrapper -->
        
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
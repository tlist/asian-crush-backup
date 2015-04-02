<?php get_header() ?>

	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>	
	
	<div class="main_content">
		<h1><?php echo get_the_title(); ?></h1>

<!--		
		 <div class="breadcrumb">
			<ul>
		    	<li class="alone"><a href="#" class="active"><?php the_title(); ?> <span class="arrow"></span></a></li>
		    </ul> 
		</div> --> <!-- end breadcrumb --> 

		
<?php 	
$my_postid = $post->ID ;
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]>', $content);
echo $content;
?>    
	    
	</div>

<?php get_footer() ?>
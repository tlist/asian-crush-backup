<?php
$limit = 10;
$arrPostArgs	=	array	(
								'posts_per_page' => $limit,
								'orderby'  => 'menu_order',
								'order' => 'ASC',
								'post_type'	=>	array('movie_slideshow'),
							);
$the_query = new WP_Query( $arrPostArgs );
$rows_post	=	$the_query->posts;
?>				

<div class="homeslides" id="homeslides">
	<div id="slide_nav">
    	<div id="left_arrow" class="fir homeslide_arrow"></div>
    	<div id="right_arrow" class="fir homeslide_arrow"></div>
    </div>
    
    <?php
    $strTmp = '';
    if (count($rows_post) > 0) {
    	$strTmp .= '<div class="cls-post-listing slide_thumbs">';
    	$strTmp .= '<ul class="non-ajax clearfix">';
		foreach ($rows_post as $numKey => $objPost)
		{
			$strKey = 'movie_slideshow_thumbnail';
			$strImg = $strKey ? get_post_meta($objPost->ID, $strKey, true) : '';
			$strThumb = $strImg ? '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.'<img src="'.$strImg.'" alt="'.$objPost->post_title.'" />'.'</a>' : '';
			$strTmp .= '<li class="cls-item-no'.$numKey.' cls-row0 cls-item">';
			$strTmp .= '<div class="cls-field-image">'.$strThumb.'</div>';
			$strTmp .= '</li>';
		}
    	$strTmp .= '</ul>';
    	$strTmp .= '</div>';
    }
	echo $strTmp;
    
    
    $strTmp = '';
    if (count($rows_post) > 0) {
    	$strTmp .= '<div class="cls-post-listing homeslideshow">';
    	$strTmp .= '<ul class="non-ajax clearfix">';
		foreach ($rows_post as $numKey => $objPost)
		{
			$strKey = 'movie_slideshow_image';
			$strImg = $strKey ? get_post_meta($objPost->ID, $strKey, true) : '';
			$strLink = get_post_meta($objPost->ID, 'movie_slideshow_link', true);
			$strMainImage = $strImg ? '<a href="'.($strLink ? $strLink : 'javascript:;').'" title="'.$objPost->post_title.'">'.'<img src="'.$strImg.'" alt="'.$objPost->post_title.'" />'.'</a>' : '';
			$strTmp .= '<li class="cls-item-no'.$numKey.' cls-row0 cls-item">';
			$strTmp .= '<div class="cls-field-images"><div class="cls-field-inner"><div class="cls-item">'.$strMainImage.'</div></div></div>';
			$strTmp .= '<div class="group group1">';
			
			$strText	=	'';
			$strType	=	'movie_genre';
			$post_categories =  wp_get_object_terms( $objPost->ID, $strType );
			$cats = array();
			$strSeparator	=	',  ';	
			foreach($post_categories as $numKey01	=> $c){
				$cat = get_category( $c );
				if ($numKey01 > 0)
					$strText	.=		'<span class="cls-field-separator">'.$strSeparator.'</span>';
				$strText	.=		'<span>'.'<a href="'.get_category_link( $c ).'">'.$cat->name.'</a>'.'</span>';
				
			}
			
			$strTmp .= '<div class="cls-field-cate">'.$strText.'</div>';
			

			$strLink = get_post_meta($objPost->ID, 'movie_slideshow_link', true);
			$strText = $strLink ? '<a href="'.$strLink.'" title="'.$objPost->post_title.'">'.$objPost->post_title . '</a>' : $objPost->post_title ;
			$strTmp .= '<div class="cls-field-title">'.$strText.'</div>';
			
			$strText = get_post_meta($objPost->ID, 'movie_slideshow_plot', true);
			$strText = amr_get_intro($strText, 150, '...');
			$strTmp .= '<div class="cls-field-meta-plot">'.$strText.'</div>';
			
			$strText = $strLink ? '<div class="cls-field-view-more"><a href="'.$strLink.'" title="'.$objPost->post_title.'">'.__('View more'). '</a></div>' : '' ;
			$strTmp .= $strText;
						
			$strTmp .= '</div>';
			
			$strTmp .= '</li>';
		}
    	$strTmp .= '</ul>';
    	$strTmp .= '</div>';
    }
	echo $strTmp;
    ?>
</div>

<script type="text/javascript">
	jQuery('#homeslides .slide_thumbs ul li.cls-item-no0').addClass('active');
	jQuery('#homeslides .homeslideshow ul li.cls-item-no0').addClass('active');
		
	jQuery(document).ready( function(){
		var objMainSlideShow = jQuery('#homeslides .slide_thumbs ul').bxSlider({
    		auto: true,
    		displaySlideQty: 4,
    		moveSlideQty: 1,
    		autoControls: false,
    		controls: true,
    		prevSelector: '#left_arrow',
    		nextSelector: '#right_arrow',
    		onBeforeSlide: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
			  jQuery('#homeslides .homeslideshow ul li').fadeOut(1500);
			  jQuery('#homeslides .homeslideshow ul li.cls-item-no'+currentSlideNumber).fadeIn(1200);
			  jQuery('#homeslides .slide_thumbs ul li').removeClass('active');
			  jQuery(currentSlideHtmlObject).addClass('active');
			}
  		});
  		jQuery('#homeslides .slide_thumbs ul li a').click( function(){
  			//objMainSlideShow.goToSlide(0);
  			var strTmp = jQuery(this).parent().parent().attr('class').split(' ')[0].replace('cls-item-no', '');
  			objMainSlideShow.goToSlide(strTmp);
  			//alert(strTmp);
  			return false;
  		});
	});
</script>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns" xmlns:fb="http://www.facebook.com/2008/fbml" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />	
		<title>
		<?php
		/**
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'dailyfashion' ), max( $paged, $page ) );
	
		?>
		</title>
		
		<?php /*Facebook Like Button*/
			if ( is_singular( "movie" ) ) { ?>
			<meta property="og:site_name" content="Asian Crush"/>
			<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
			<meta property="og:title" content="<?php echo get_the_title(); ?>"/>	
			<meta property="og:type" content="movie"/>	
			<meta property="og:image" content="<?php $amr_thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail'); echo $amr_thumb_image[0]; ?>"/>	
			<meta property="fb:app_id" content="196790373726487"/>			
		<?php
			}
		?>
		<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Magra' rel='stylesheet' type='text/css'>
        
        
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css' />		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<script src="http://code.jquery.com/jquery-latest.min.js?ver=9778" type="text/javascript" ></script>
        
        <link href='<?php echo PfBase::app()->themeUrl; ?>/_css/j_skin.css' rel='stylesheet' type='text/css' />
		
		<?php
			wp_enqueue_style( 'selectbox', PfBase::app()->themeUrl.'/_css/jquery.selectbox.css');
			wp_enqueue_style( 'main', PfBase::app()->themeUrl.'/_css/main.css');
			
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'plugins', PfBase::app()->themeUrl . '/_js/plugins.js', 'jquery', false );
			wp_enqueue_script( 'bxslider', PfBase::app()->themeUrl . '/_assets/jquery.bxSlider.min.js', 'jquery', false );
			wp_enqueue_script( 'script', PfBase::app()->themeUrl . '/_js/script.js', 'jquery', false );
			
			
			
			/* We add some JavaScript to pages with the comment form
			 * to support sites with threaded comments (when in use).
			 * This javascript seems to conflict with jQuery
			 */
			 
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			
			/* Always have wp_head() just before the closing </head>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to add elements to <head> such
			 * as styles, scripts, and meta tags.
			 */
			wp_head();
		?>
		<!--[if lt IE 9]>
<script src="<?php echo PfBase::app()->themeUrl; ?>/_js/modernizr-2.0.6.min.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo PfBase::app()->themeUrl; ?>/_js/jquery.jcarousel.min.js" type="text/javascript"></script>
<script src="<?php echo PfBase::app()->themeUrl; ?>/_js/jcarousel.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
	$("img.jquery-hover").fadeTo(0,0.4);
	$("img.jquery-hover").hover(function(){
        	$(this).fadeTo(500,1.0);
    	},
    	function(){
        	$(this).fadeTo(500,0.4);
    	});
	});
</script>
	



	</head>
	<body>
		<!--	Device Platform	-->
		<div id="pf-device-platform">
			
			<!--	Browser	-->
			<!--[if lt IE 7]> <div id="pf-browser" class="no-js ie6 ie"> <![endif]-->
			<!--[if IE 7]>    <div id="pf-browser" class="no-js ie7 ie"> <![endif]-->
			<!--[if IE 8]>    <div id="pf-browser" class="no-js ie8 ie"> <![endif]-->
			<!--[if gte IE 9]>    <div id="pf-browser" class="no-js ie9"> <![endif]-->
			<!--[if !IE]><!--> <div id="pf-browser" class="no-js"> <!--<![endif]-->
				<div id="body_container">
					<div id="header">

						<a href="<?php echo site_url() ?>" id="logo" title="<?php bloginfo('name'); ?>">
<img src="<?php echo PfBase::app()->themeUrl; ?>/_img/logo.png" alt="<?php bloginfo('name'); ?>" />
</a>
					    
					   <div class="adv"><?php dynamic_sidebar('ad-header'); ?></div><br clear="all">
					    
					<div class="navigation-box">
					<?php wp_nav_menu(array( 'menu' => 'g-navi' ) ); ?>    
					    <?php echo PfBase::getBlock('blocks'.DS.'form_search_main.php') ?>
					</div> <!-- end .navigation-box -->
					</div> <!-- end header -->
                    <div id="container" <?php body_class(); ?>>			
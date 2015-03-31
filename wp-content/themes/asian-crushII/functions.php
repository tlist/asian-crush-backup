<?php

//	Define global Constant
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('_PREFIX') or define('_PREFIX', 'amr_');

defined('_CATE_ID_FIRST') or define('_CATE_ID_FIRST', 9);
defined('_CATE_ID_SECOND') or define('_CATE_ID_SECOND', 13);
defined('_CATE_ID_THIRD') or define('_CATE_ID_THIRD', 10);

defined('_CATE_ID_MOVIES') or define('_CATE_ID_MOVIES', 4);
defined('_CATE_ID_SPORTS') or define('_CATE_ID_SPORTS', 6);


defined('_NUM_ITEM_PER_ROW_MOVIE_GENRE') or define('_NUM_ITEM_PER_ROW_MOVIE_GENRE', 7);
	
defined('_IS_AJAX') or define('_IS_AJAX', 
	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

if ( !defined('_PF_THEME_DEV') )
	require('includes'.DS.'pf_core.php');

$arrConfig	=	array(
	'themePath' => dirname(__FILE__),	
	'themeUrl' => get_bloginfo('stylesheet_directory'),	
	'cacheEnabled' => 0,	
	'cacheLifetime' => 1800,	
	'cachePath' => dirname(__FILE__).DS.'..'.DS.'..'.DS.'cache'.DS.'theme_amr',
	'params' => array(
		'main_cat_id_arr' => array(_CATE_ID_MOVIES, _CATE_ID_SPORTS)
	),	
);
PfBase::initTheme($arrConfig);
add_action( 'init', 'amr_setup' );

  define (METABOXHIDDEN_MOVIE, 'a:1:{i:0;s:7:"slugdiv";}');
  define (META_BOX_ORDER_MOVIE , 'a:3:{s:4:"side";s:141:"submitdiv,movie_genrediv,movie_regiondiv,tagsdiv-movie_director,tagsdiv-movie_actor_actress,movie_duration,postimagediv";s:6:"normal";s:91:"movie_year,movie_plot,movie_quotes,movie_amazon_link,movie_embedded_video,slugdiv,authordiv";s:8:"advanced";s:0:"";}');
  define (SCREEN_LAYOUT_DASHBOARD, 's:1:"1";');
  define (META_BOX_ORDER_DASHBOARD, 'a:4:{s:6:"normal";s:188:"dashboard_right_now,dashboard_recent_comments,dashboard_incoming_links,dashboard_plugins,yoast_db_widget,dashboard_quick_press,dashboard_recent_drafts,dashboard_primary,dashboard_secondary";s:4:"side";s:0:"";s:7:"column3";s:0:"";s:7:"column4";s:0:"";}');
  define (METABOXHIDDEN_DASHBOARD, 'a:8:{i:0;s:25:"dashboard_recent_comments";i:1;s:24:"dashboard_incoming_links";i:2;s:17:"dashboard_plugins";i:3;s:15:"yoast_db_widget";i:4;s:21:"dashboard_quick_press";i:5;s:23:"dashboard_recent_drafts";i:6;s:17:"dashboard_primary";i:7;s:19:"dashboard_secondary";}');
  
//echo serialize(get_user_meta(1, 'metaboxhidden_dashboard', true));  
//die();  
add_action('user_register', 'set_user_metaboxes');
function set_user_metaboxes($user_id=NULL) {
    // These are the metakeys we will need to update
    update_user_meta($user_id, 'metaboxhidden_movie', unserialize(METABOXHIDDEN_MOVIE));
    update_user_meta($user_id, 'meta-box-order_movie', unserialize(META_BOX_ORDER_MOVIE));
    update_user_meta($user_id, 'screen_layout_dashboard', unserialize(SCREEN_LAYOUT_DASHBOARD));
    update_user_meta($user_id, 'meta-box-order_dashboard', unserialize(META_BOX_ORDER_DASHBOARD));
    update_user_meta($user_id, 'metaboxhidden_dashboard', unserialize(METABOXHIDDEN_DASHBOARD));
           
}

if ( ! function_exists( 'amr_setup' ) ):
function amr_setup() {

	/***** Navigation & Menu *****/
	$menus = array(
		'primary' => __('Primary Menu'),
		'secondary' => __('Secondary Menu'),
		'footer' => __('Footer Menu'),
	);
	foreach ( $menus as $key=>$value  ) {
		if ( !is_nav_menu( $key ) ) wp_update_nav_menu_item( wp_create_nav_menu( $key ), 1 );
	}
	
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus($menus);
	}
		
	//	Remove annoying stylesheets, margin for tag html
	remove_action('wp_head', '_admin_bar_bump_cb');

}
endif; // amr_setup

add_action( 'after_setup_theme', 'amr_theme_setup' );

if ( ! function_exists( 'amr_theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override amr_setup() in a child theme, add your own amr_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function amr_theme_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'dailyfashion' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'amr', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/".$locale.".php";


	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	
	
	
	
	add_theme_support( 'menus' );
	
	if ( function_exists('register_sidebar') )
	  register_sidebar();


	/* Footer start */
    // Area 2, located at the left of the footer.
    register_sidebar( array(
        'name' => __( 'Footer-1st', 'Asian Crush' ),
        'id' => 'footer-1st',
        'description' => __( 'Footer 1st area', 'Asian Crush' ),
        'before_widget' => '<li id="%1$s">',

        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
 

    // Area 3, located at the center of the footer.
    register_sidebar( array(
        'name' => __( 'Footer-2nd', 'Asian Crush' ),
        'id' => 'footer-2nd',
        'description' => __( 'Footer 2nd area', 'Asian Crush' ),
        'before_widget' => '<li id="%1$s">',

        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
 

    // Area 4, located at the right of the footer.
    register_sidebar( array(
        'name' => __( 'Footer-3rd', 'Asian Crush' ),
        'id' => 'footer-3rd',
        'description' => __( 'Footer 3rd area', 'Asian Crush' ),
        'before_widget' => '<li id="%1$s">',

        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
/* Footer end */
/* Advertise widget start */
	// Area 5, located at the right area.
    register_sidebar( array(
        'name' => __( 'Advertise Right Area', 'Asian Crush' ),
        'id' => 'ad-right',
        'description' => __( 'Search Page', 'Asian Crush' ),
        'before_widget' => '<div class="ad_right">',

        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
/* Advertise widget end */

/* Advertise widget start */
	// Area 6, located at the header area.
    register_sidebar( array(
        'name' => __( 'Advertise header Area', 'Asian Crush' ),
        'id' => 'ad-header',
        'description' => __( 'Image size 729px - 91px', 'Asian Crush' ),
        'before_widget' => '<div class="ad_header">',

        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
/* Advertise widget end */

	
	// This theme allows users to set a custom background
	//add_custom_background();
	
	//	Add thumbnail size and crop the image
	//add_image_size( 'mini', 104, 9999, false );
	//add_image_size( 'med', 216, 9999, false );
	//add_image_size( 'meder', 136, 192, true );
	add_image_size( 'movie_still', 480, 320, true );
	add_image_size( 'slide-full', 896, 9999, false );
	
	add_image_size( 'top-thumb', 100, 140, true );
	
}
endif;
 
/**
 * For customize login theme
 */
function amr_custom_login() {
	?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_bloginfo( 'template_url' ) . '/_css/custom-login.css'; ?>" />
	<script type="text/javascript">
		jQuery(document).ready(function(){
			
		});
	</script>
	<?php
}
add_action('login_head', 'amr_custom_login');

/**
 * For customize admin theme
*/
 
function amr_custom_admin_theme() {
	global $typenow, $pagenow; //wordpress dont correctly set $pagenow and $typenow for php var, it only set it correctly for javascrip var
	?>
	<style type="text/css">
	li#menu-posts-contact_us > div.wp-submenu ul li:last-child {
		display: none;
	} 

	li#menu-posts-submitted_film > div.wp-submenu ul li:last-child {
		display: none;
	} 
	<?php if ( isset($typenow) && ( $typenow == "submitted_film" || $typenow == "contact_us" ) ) { ?>
				.wrap .add-new-h2 {
					display:none;
				}
	<?php } ?>
	</style>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			if (typeof(typenow) == 'undefined')
			{
				var typenow = '';
			}

			if (typeof(typenow) != 'undefined')
			{
				if (typenow == 'movie')
				{
					jQuery('#postimagediv h3').html('<?php echo __('Gallery image') ?>');
					if (jQuery('#set-post-thumbnail img').attr('src') == undefined)
					{
						jQuery('#set-post-thumbnail').html('<?php echo __('Upload a gallery image') ?>');
					}
					jQuery('#remove-post-thumbnail').html('<?php echo __('Remove gallery image') ?>');
				} else if (typenow == 'tv_operator') {
					jQuery('#postimagediv h3').html('<?php echo __('Network image') ?>');
					if (jQuery('#set-post-thumbnail img').attr('src') == undefined)
					{
						jQuery('#set-post-thumbnail').html('<?php echo __('Upload a network image') ?>');
					}
					jQuery('#remove-post-thumbnail').html('<?php echo __('Remove network image') ?>');
				}
			}

			if ( typenow === "submitted_film" || typenow === "contact_us" ) ////wordpress dont correctly set $pagenow and $typenow for php var, it only set it correctly for javascrip var
				jQuery(".wrap a.add-new-h2").attr("href", "edit.php?post_type=" + typenow + "&export_action=" + typenow ).html("Export to Excel").show();
			
			//	Add more menu links for export files
			var contact_us_li = jQuery("li#menu-posts-contact_us > div.wp-submenu ul li:last-child");
			var submitted_film_li = jQuery("li#menu-posts-submitted_film > div.wp-submenu ul li:last-child");
			contact_us_li.children("a").attr("href", "edit.php?post_type=contact_us&export_action=contact_us" ).html("Export to Excel");
			submitted_film_li.children("a").attr("href", "edit.php?post_type=submitted_film&export_action=submitted_film").html("Export to Excel");
			contact_us_li.show();
			submitted_film_li.show();
			
			//	Add trash confirm
			if ( adminpage === 'edit-php' && ( pagenow === "edit-movie" || pagenow === "edit-tv_operator" || pagenow === "edit-faq" || pagenow === "edit-movie_slideshow" || pagenow === "edit-dvd_store" || pagenow === "edit-page" || pagenow === "edit-post") ){
						jQuery('div.row-actions > span.trash > a.submitdelete ').click(function(){
							return confirm("Are you sure you want to delete?");
						});
			}

			if ( adminpage === 'post-php' && ( pagenow === "movie" || pagenow === "tv_operator" || pagenow === "faq" || pagenow === "movie_slideshow" || pagenow === "dvd_store" || pagenow === "page" || pagenow === "post") ){
						jQuery('#submitpost > #major-publishing-actions > #delete-action > a.submitdelete').click(function(){
							return confirm("Are you sure you want to delete?");
						});
			}	
			
		});
	</script>
	<?php
}
add_action( 'admin_head', 'amr_custom_admin_theme' );


/**
 * Get all of meta data of a post
 * @param $post_id 
 * @return array of meta value, empty if dont have any meta
 */

function amr_get_post_meta_all($post_id){
	    global $wpdb;
	    $data   =   array();
	    $wpdb->query("
	        SELECT `meta_key`, `meta_value`
	        FROM $wpdb->postmeta
	        WHERE `post_id` = $post_id
	    ");
	    foreach($wpdb->last_result as $k => $v){
	        $data[$v->meta_key] =   $v->meta_value;
	    };
	    return $data;
}

/**
 * Get top_most_parent of a term
 * @param $term_id, $taxonomy
 * @return to_most_parent of the term
 */

function amr_get_term_top_most_parent($term_id, $taxonomy){
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    while ($parent->parent != 0){
        $parent  = get_term_by( 'id', $parent->parent, $taxonomy);
    }
    return $parent;
}

/**
 * Get top_most_parent of a term with fixed parents
 * @param $term_id, $taxonomy
 * @return to_most_parent of the term
 */

function amr_get_term_top_most_fixed_parent($term_id, $taxonomy, $fixed_parents){
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    while ( $parent->parent != 0 && !in_array($parent->term_id, $fixed_parents) ){
        $parent  = get_term_by( 'id', $parent->parent, $taxonomy);
    }
    return $parent;
}


/**
 * This function print out the html result for an array of posts or post types
 * @param array of data, taken from $the_query->posts
 * @param number of items to show on a row
 * @param array of data structure to print out
 * @param css class suffix for the wrapper div
 * @return html result to print out
 */
function amr_post_listing($rows_post, $numItemsPerRow, $arrPostTemplate, $strCssClass='clearfix')
{
	$numRow	=	0;
	$strResult	=	'';
	if (count($rows_post) > 0)
	{
		$strResult	.=	'<div class="cls-post-listing '.$strCssClass.'">';
		$strResult	.=	'<ul class="'.(!_IS_AJAX ? 'non-ajax' : 'ajax-request').' clearfix">';
		foreach ($rows_post as $numKey => $row_post)
		{
			$strTmp	=	'cls-item-no'.$numKey;
			$strTmp	.=	' cls-row'.$numRow;
			$strTmp	.=	' cls-item'.($numKey % $numItemsPerRow == 0 ? ' cls-first-in-line' : '');
			if (($numKey + 1) % $numItemsPerRow == 0 || ($numKey + 1) == count($rows_post)) $strTmp .= ' cls-last-in-line';
			if ((($numKey + 1) % $numItemsPerRow == 0 || ($numKey + 1) == count($rows_post)) && $numKey % $numItemsPerRow == 0) $strTmp .= ' cls-only-in-line';
			$strResult	.=	'<li class="'.$strTmp.'">'.amr_post_item_render($row_post, $arrPostTemplate, '').'</li>';
			if (($numKey + 1) % $numItemsPerRow == 0 || ($numKey + 1) == count($rows_post)) $numRow++;
		}
		$strResult	.=	'</ul>';
		$strResult	.=	'</div>';
	}
	return $strResult;
}

/**
 * This function print out the html result for a post or post type
 * @param object of a single post or post type
 * @param array of data structure to print out
 * @param css class suffix for the wrapper div
 * @return html result to print out
 */
function amr_post_item_render($objPost, $arrPostTemplate, $strCssClass='clearfix')
{
	$strResult	=	'';
	if (!is_array($arrPostTemplate)) $arrPostTemplate = array();
	foreach ($arrPostTemplate as $key	=>	$value)
	{
		if (substr($key, 0, 5) == 'group')
		{
			$strResult	.=	'<div class="group '.$key.' '.$strCssClass.'">'.amr_post_item_render($objPost, $value).'</div>';
		}
		else
		{
			if (substr($key, 0, 4) == 'cate')
			{
				$strText	=	'';
				$strType	=	isset($value['type']) ? $value['type'] : 'category';
				$post_categories =  wp_get_object_terms( $objPost->ID, $strType );
				$cats = array();
				$strSeparator	=	isset($value['separator']) ? $value['separator'] : '';	
				foreach($post_categories as $numKey01	=> $c){
					$cat = get_category( $c );
					if ($numKey01 > 0)
						$strText	.=		'<span class="cls-field-separator">'.$strSeparator.'</span>';
					$strText	.=		'<span>'.'<a href="'.get_category_link( $c ).'">'.$cat->name.'</a>'.'</span>';
					
				}
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : '';
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				$strCaption	=	isset($value['caption']) ? $value['caption'] : '';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				
				$strResult	.=	'</div>';
			}
			else if ($key == 'title')
			{
				$strText = '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.$objPost->post_title . '</a>';
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				$strCaption	=	isset($value['caption']) ? $value['caption'] : '';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if ($key == 'view-more')
			{
				$strText = '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.__('View more').'</a>';
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				$strCaption	=	isset($value['caption']) ? $value['caption'] : '';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if ($key == 'intro')
			{
				$strText	=	$objPost->post_excerpt ? $objPost->post_excerpt : amr_get_intro($objPost->post_content, 200, '...');
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if ($key == 'image' && get_the_post_thumbnail($objPost->ID))
			{
				$strType	=	isset($value['type']) ? $value['type'] : 'full';
				$strText = '<a href="'.get_permalink( $objPost->ID ).'" title="'.$objPost->post_title.'">'.get_the_post_thumbnail($objPost->ID, $strType, array('alt' => $objPost->post_title, 'title' => $objPost->post_title)).'</a>';
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if ($key == 'images')
			{
				$numLimit	=	isset($value['limit']) ? $value['limit'] : 0;
				$arrArgs = array	(
										'posts_per_page' => $numLimit,
										'post_parent'	=>	$objPost->ID,
										'post_status'	=>	'any',
										'orderby'  => 'menu_order',
										'order' => 'ASC',
										'post_type'	=>	array('attachment'),
									);

				$the_query = new WP_Query( $arrArgs );
				$rows_img	=	$the_query->posts;
				$strType	=	isset($value['type']) ? $value['type'] : 'full';
				if (count($rows_img) > 0)
				{
					$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
					$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
					
					if (count($rows_img) > 0)
					{
						if (count($rows_img) > 1)
						{
							$strResult	.=		'<a class="cls-prev" href="javascript:;"> Prev </a>';
							$strResult	.=		'<a class="cls-next" href="javascript:;"> Next </a>';
						}
						
						$strResult	.=		'<div class="cls-field-inner">';
						foreach ($rows_img as $numKey01 => $row_img)
						{
							$arrTmp	=	wp_get_attachment_image_src( $row_img->ID, $strType );
							$arrTmpFull	=	wp_get_attachment_image_src( $row_img->ID, 'full' );
							$strResult	.=	'<div class="cls-item">';
							$strResult	.=		'<a href="'.($numLimit == 1 ? get_permalink( $objPost->ID ) : $arrTmpFull[0]).'" title="'.($numLimit == 1 ? $objPost->post_title : $row_img->post_title).'">'.'<img src="'.$arrTmp[0].'" alt="'.($numLimit == 1 ? $objPost->post_title : $row_img->post_title).'" />'.'</a>';
							$strResult	.=	'</div>';
						}
						$strResult	.=		'</div>';
					}
					else
					{
						$strResult	.=	'<div class="cls-item">';
						$strResult	.=		'<a href="'.'javascript:;'.'" title="'.$objPost->post_title.'">'.get_the_post_thumbnail($objPost->ID, $strType).'</a>';
						$strResult	.=	'</div>';
					}
					
					$strResult	.=	'</div>';
				}
			}
			else if ($key == 'author')
			{
				$text	=	isset($value['text']) && $value['text'] ? $value['text'] : __('by %s');
				$strAuthorNiceName	=	get_the_author_meta('user_nicename', $objPost->post_author);
				$link = sprintf(
					'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
					get_author_posts_url( $objPost->post_author, $strAuthorNiceName ),
					esc_attr( sprintf( __( 'Posts by %s' ), $strAuthorNiceName ) ),
					$strAuthorNiceName
				);
				$strText	=		sprintf($text, $link);
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				
				$strResult	.=	'</div>';
			}
			else if ($key == 'date')
			{
				$strDate = new DateTime($objPost->post_date);
				$strText = $strDate->format('F j, Y');
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if ($key == 'comment')
			{
				$strText = get_comment_count_link($objPost->ID);
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if (substr($key, 0, 9) == 'separator')
			{
				$strResult	.=	'<div class="cls-field-separator '.$key.'">';
				$strResult	.=		'x';
				$strResult	.=	'</div>';
			}
			else if ($key == 'content')
			{
				$content = apply_filters('the_content', $objPost->post_content);
				$strText = str_replace(']]>', ']]&gt;', $content);
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			else if (substr($key, 0, 4) == 'meta')
			{
				$strCaption	=	isset($value['caption']) ? $value['caption'] : '';
				$strKey	=	isset($value['key']) ? $value['key'] : '';
				$numCharLimit	=	isset($value['charLimit']) ? (int) $value['charLimit'] : 0;
				$strTmp = $strKey ? get_post_meta($objPost->ID, $strKey, true) : '';
				$strText	=	$numCharLimit ? amr_get_intro($strTmp, $numCharLimit, '...') : $strTmp;
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				if ($strCaption) {
					$strResult	.=	'<div class="cls-item-caption">';
					$strResult	.=	$strCaption;
					$strResult	.=	'</div>';
					$strResult	.=	'<div class="cls-item-value">';
					$strResult	.=	$strText;
					$strResult	.=	'</div>';
				}
				else {
					$strResult	.=	$strText;
				}
				$strResult	.=	'</div>';
			}
			
			else if ($key == 'watch-online' && get_post_meta($objPost->ID, 'movie_embedded_video', true))
			{
				$strCssClass	=	isset($value['cssClass']) ? $value['cssClass'] : ''; 
				$strResult	.=	'<div class="cls-field-'.$key.($strCssClass ? ' '.$strCssClass : '').'">';
				$strResult	.=		'<a href="'.get_permalink( $objPost->ID ).'?watch=1'.'" title="'.$objPost->post_title.'">'.__('Watch Online').'</a>';
				$strResult	.=	'</div>';
			}
		}
	}
	return $strResult;
}

/**
 * Get introduction from a long content
 */
function amr_get_intro($strText, $numTmp	=	200, $strMore='') {
	$strTmp	=	$strText;
	$arrTmp = 	preg_split('/<!--more-->/', $strTmp);
	$strIntro	=	strip_tags($arrTmp[0]);
	if ($numTmp == 0)
	{
		return $strIntro;
	}
	else if (strlen($strIntro) > $numTmp)
	{
		$strIntro	=	@strpos($strIntro, ' ', $numTmp) ? substr($strIntro, 0, strpos($strIntro, ' ', $numTmp)) : $strIntro;
		return $strIntro.$strMore;
	}
	else 
	{
		return $strIntro;
	}
}

if (isset($_REQUEST['export_action']) && $_REQUEST['export_action'] == 'contact_us')
{
	amr_export_contact_us();
}

if (isset($_REQUEST['export_action']) && $_REQUEST['export_action'] == 'submitted_film')
{
	amr_export_submitted_film();
}


function amr_export_contact_us()
{
	require PfBase::app()->themePath.'/libs/Spreadsheet/Excel/Writer.php';

	$arrPostArgs	=	array(
					'post_type' => 'contact_us',
					'posts_per_page' => 0,
					
	);
	$the_query = new WP_Query( $arrPostArgs );
	$rows_post	=	$the_query->posts;

	// Creating a workbook
	$workbook = new Spreadsheet_Excel_Writer();

	// sending HTTP headers
	$workbook->send('contact_us-'.date('Y-m-d').'.xls');

	// Creating a worksheet
	$worksheet =& $workbook->addWorksheet('Asian Crush Contact list');

	$worksheet->setInputEncoding('utf-8');

	// The actual data
	$worksheet->write(0, 0, 'Name');
	$worksheet->write(0, 1, 'Subject');
	$worksheet->write(0, 2, 'Email');
	$worksheet->write(0, 3, 'Message');
	

	if (is_array($rows_post) && count($rows_post) > 0)
	{
		foreach ($rows_post as $numKey => $objPost)
		{
			$post_id = $objPost->ID;

			$strFieldName = 'contact_us_name';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 0, $strValue);

			$strValue = $objPost->post_title;
			$worksheet->write($numKey + 1, 1, $strValue);

			$strFieldName = 'contact_us_email';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 2, $strValue);

			$strFieldName = 'contact_us_message';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 3, utf8_decode ($strValue));
		}
	}

	// Let's send the file
	$workbook->close();

}

function amr_export_submitted_film()
{
	require PfBase::app()->themePath.'/libs/Spreadsheet/Excel/Writer.php';

	$arrPostArgs	=	array(
					'post_type' => 'submitted_film',
					'posts_per_page' => 0,
					
	);
	$the_query = new WP_Query( $arrPostArgs );
	$rows_post	=	$the_query->posts;

	// Creating a workbook
	$workbook = new Spreadsheet_Excel_Writer();

	// sending HTTP headers
	$workbook->send('submitted_film-'.date('Y-m-d').'.xls');

	// Creating a worksheet
	$worksheet =& $workbook->addWorksheet('Asian Crush Submitted Film list');

	$worksheet->setInputEncoding('utf-8');

	// The actual data
	$worksheet->write(0, 0, 'Name');
	$worksheet->write(0, 1, 'Subject');
	$worksheet->write(0, 2, 'Email');
	$worksheet->write(0, 3, 'Company');
	$worksheet->write(0, 4, 'Film Title');
	$worksheet->write(0, 5, 'Genre');
	$worksheet->write(0, 6, 'Message');	

	if (is_array($rows_post) && count($rows_post) > 0)
	{
		foreach ($rows_post as $numKey => $objPost)
		{
			$post_id = $objPost->ID;

			$strFieldName = 'submitted_film_name';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 0, $strValue);

			$strFieldName = 'submitted_film_subject';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 1, $strValue);

			$strFieldName = 'submitted_film_email';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 2, $strValue);
			
			$strFieldName = 'submitted_film_company';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 3, utf8_decode ($strValue));

			$strValue = $objPost->post_title;
			$worksheet->write($numKey + 1, 4, $strValue);

			$strFieldName = 'submitted_film_genre';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 5, utf8_decode ($strValue));

			$strFieldName = 'submitted_film_message';
			$strValue = get_post_meta($post_id, $strFieldName, true);
			$worksheet->write($numKey + 1, 6, utf8_decode ($strValue));
			
		}
	}

	// Let's send the file
	$workbook->close();

}


include dirname( __FILE__ ) . '/includes/post_type_movie_register.php';
include dirname( __FILE__ ) . '/includes/post_type_movie_custom.php';

include dirname( __FILE__ ) . '/includes/post_type_movie_slideshow_register.php';
include dirname( __FILE__ ) . '/includes/post_type_movie_slideshow_custom.php';
// include dirname( __FILE__ ) . '/includes/post_type_dvd_store_register.php';
// include dirname( __FILE__ ) . '/includes/post_type_dvd_store_custom.php';


// Load up our theme options page and related code.
require( dirname( __FILE__ ) . '/includes/theme_options.php' );

// shortcode
// One half
function onehalf_first( $atts, $content = null) {
	return '<div class="one_half_first">'.$content.'</div>';
}
add_shortcode('one_half_first', 'onehalf_first');

// One half last
function onehalf_last( $atts, $content = null) {
	return '<div class="one_half_last">'.$content.'</div>';
}
add_shortcode('one_half_last', 'onehalf_last');

?>
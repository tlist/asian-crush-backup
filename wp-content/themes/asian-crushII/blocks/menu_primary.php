<?php
/**
 * Get top_most_parent of a term version 2 
 * @param $parent: term object to find it top most parent
 * @return to_most_parent of the term
 */

function amr_get_term_top_most_parent_2($parent){
    while ($parent->parent != 0){
        $parent  = get_term_by( 'id', $parent->parent, $parent->taxonomy);
    }
    return $parent;
}


/**
 * This function check to see if the current display page will make li of a main movie genre of main navi active or not 
 * @param $main_movie_genre: this will be _CATE_ID_MOVIES or _CATE_ID_ANIME, _CATE_ID_SPORTS
 * @return to_most_parent of the term
 */

function amr_is_inside_main_movie_genre( $main_movie_genre_cat ) {
	if (is_page()){
		if (is_page_template("page-movies.php") && $main_movie_genre_cat === _CATE_ID_MOVIES)
			return true;
		else if (is_page_template("page-anime.php") && $main_movie_genre_cat === _CATE_ID_ANIME)
			return true;
		else if (is_page_template("page-sports.php") && $main_movie_genre_cat === _CATE_ID_SPORTS)
			return true;
		return false;
	}
	else if (is_tax()){
		if (is_tax('movie_genre', $main_movie_genre_cat)) // neu trang tax hien tai la ung voi li dang xet
			return true;
		return false;
	}
	else if (is_singular('movie')){
		$the_movie_terms_arr = wp_get_object_terms(get_the_ID(), 'movie_genre'); //this will return many term, because we will find the top most term, we only need use first object of this arr
		$the_movie_terms_with_level_arr = get_ancestors($the_movie_terms_arr[0]->term_id, $the_movie_terms_arr[0]->taxonomy);
		$the_movie_terms_with_level_arr[] = $the_movie_terms_arr[0]->term_id;
		/* so ugly code :(*/

			if ( in_array(_CATE_ID_ANIME, $the_movie_terms_with_level_arr) && $main_movie_genre_cat === _CATE_ID_ANIME )
				return true; // dont hoved movie in anime and sport in movie top navi
			else if (in_array(_CATE_ID_SPORTS, $the_movie_terms_with_level_arr) && $main_movie_genre_cat === _CATE_ID_SPORTS)
				return true;
			else if ($main_movie_genre_cat === _CATE_ID_MOVIES && !in_array(_CATE_ID_SPORTS, $the_movie_terms_with_level_arr) && !in_array(_CATE_ID_ANIME, $the_movie_terms_with_level_arr))
				return true;
			else
				return false;
		return false; //review
	}
}

?>
<div id="nav">
	<ul>
    	<li><a href="<?php echo get_bloginfo("url") ?>" class="<?php if (is_front_page()) echo "active" ?>" id="n1"><?php echo __('HOME') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."movies"?>" class="<?php if (amr_is_inside_main_movie_genre(_CATE_ID_MOVIES)) echo "active"; ?>" id="n2"><?php echo __('MOVIES') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."anime"?>" class="<?php if (amr_is_inside_main_movie_genre(_CATE_ID_ANIME)) echo "active"; ?>" id="n3"><?php echo __('ANIME') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."sports"?>" class="<?php if (amr_is_inside_main_movie_genre(_CATE_ID_SPORTS)) echo "active"; ?>" id="n4"><?php echo __('SPORTS') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."watch-asian-crush/"?>" <?php if (is_page_template("page-where-to-what.php") || is_page_template("page-where-to-what-canada.php")) echo 'class="active"'; ?> id="n5"><?php echo __('WATCH ASIAN CRUSH') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."dvd-store/"?>" <?php if (is_page_template("page-dvd-store.php")) echo 'class="active"'; ?> id="n6"><?php echo __('DVD STORE') ?></a></li>
        <li><a href="<?php echo get_bloginfo("url")."/"."about-asian-crush/"?>" <?php if (is_page("about-asian-crush")) echo 'class="active"'; ?> id="n7"><?php echo __('ABOUT') ?></a></li>
    </ul>
</div> <!-- end nav -->
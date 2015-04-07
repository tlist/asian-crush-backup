jQuery(document).ready(function(){	
	// Layout fixes
	//jQuery('.movie_grid li:nth-child(5n)').css({ 'margin-right': 0});
	//jQuery('.movie_grid li:nth-child(16), .movie_grid li:nth-child(17), .movie_grid li:nth-child(18), .movie_grid li:nth-child(19), .movie_grid li:nth-child(20)').css('margin-bottom', '0px');
	jQuery('.movie_profile .movie_cast table tr:nth-child(2n)').css({'background':'#d6d6d6'});
	jQuery('.movie_profile .movie_cast table tr:nth-child(2n+1)').css({'background':'#ecebeb'});
	jQuery('.movie_result:last-child').css({
		'border': 'none',
		'padding-bottom': 0
	});
	// Fake placeholder
	jQuery('.search input[type=text]').val('Search')
	jQuery('.search input[type=text]').blur(function(){
		if (this.value=='') { this.value = 'Search'; } else { }
	})
	jQuery('.search input[type=text]').focus(function(){
		if (this.value == 'Search') { this.value = ''; }
	})
	
	// Back to Top Button 
	jQuery('#backtop').click(function (e) {
		jQuery('body, html').animate({
			scrollTop: 0
		}, 500);
		e.preventDefault();
	});
	
	// Selectbox 
	jQuery('.selectbox').selectbox();
	//jQuery('.movie_search form select').selectbox();
	
	// Home slideshow
	/*
	jQuery('.homeslideshow').cycle({
		fx: 'fade',
		timeout: 0,
		next: jQuery('#right_arrow'),
		prev: jQuery('#left_arrow'),
		easing: 'jswing',
		pager: jQuery('.slide_thumbs ul'),
		activePagerClass: 'active'
	});
	
	jQuery('.slide_thumbs li').click(function(){
		var slideNo = (jQuery(this).index());
		jQuery('.homeslideshow').cycle(slideNo);
		return false;
	})
	
	jQuery('.thumbs_slide').each(function(){
		var nextBtn = jQuery(this).parent().find('.next'),
			prevBtn = jQuery(this).parent().find('.prev')
		jQuery(this).cycle({
			fx: 'scrollHorz',
			timeout: 0,
			next: nextBtn,
			prev: prevBtn,
			easing: 'jswing'
		})
	})
	
	*/
	
	// Post listing, new line for year
	var strTmp = jQuery('#container').attr('class');
	if (strTmp.indexOf('page-search') < 0)
	{
		jQuery('.cls-post-listing .cls-field-title a').each( function(){
			var strTmp = jQuery(this).html();
			var parts = strTmp.split(" (");
			if (parts.length > 1) {
			    parts[parts.length - 2] += '<br />(' + parts.pop();
			}
			jQuery(this).html(parts.join(" ("));
		});
	}
	
	// FAQ
	jQuery('#faq dt').first().addClass('active');
	jQuery('#faq dd').first().show();
	jQuery('#faq dt').click(function(){
		if(jQuery(this).hasClass('active')) {
			jQuery(this).next().slideUp();
			jQuery(this).removeClass('active');
		} else if (!jQuery(this).hasClass('active')){
			jQuery(this).addClass('active');
			jQuery(this).next().slideDown();
		}
	})
})























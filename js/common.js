jQuery(document).ready(function(){
	var scrollDefault = window.pageYOffset;
	var lastScrollTop = 0;
	// Init masonry blog list
	jQuery('.blog-list').masonry({
		itemSelector: '.col-lg-4',
		percentPosition: true,
		resize: true
	});
	if(scrollDefault > 60) {
	   	jQuery('.site-header.fixed').addClass('move');
	}
	jQuery(window).scroll(function(event){
	   var st = jQuery(this).scrollTop();
	   if (st > lastScrollTop){
	   	   if(st > 60) {
	   	   	jQuery('.site-header.fixed').addClass('move');
	   	   }
	   } else {
	     jQuery('.site-header.fixed').removeClass('move');
	   }
	   lastScrollTop = st;
	});

	if(jQuery(window).width() < 768) {
		jQuery('.site-header').removeClass('fixed');
	}

	jQuery(window).resize(function() {
		jQuery('.blog-list').masonry('reloadItems');
		if(jQuery(window).width() < 768) {
			jQuery('.site-header').removeClass('fixed');
		}
		else {
			jQuery('.site-header').addClass('fixed');
		}
	});
});

// Loader fading out
jQuery(window).load(function() {
	jQuery(".loader").fadeOut();
	jQuery(".loader-wrap").delay(400).fadeOut("slow");
});
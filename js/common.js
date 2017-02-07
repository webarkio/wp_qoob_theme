jQuery(document).ready(function(){
	var scrollDefault = window.pageYOffset;
	// Init masonry blog list
	jQuery('.blog-list').masonry({
		itemSelector: '.col-lg-4',
		percentPosition: true,
		resize: true
	});

	window.onscroll = function() {
		if (window.pageYOffset > 107) {
			jQuery('.site-header.fixed').addClass('move');	
		} 

		if(scrollDefault > window.pageYOffset) {
			jQuery('.site-header.fixed').removeClass('move');	
		}
		if(scrollDefault < window.pageYOffset) {
			jQuery('.site-header.fixed').addClass('move');
			scrollDefault = window.pageYOffset;
		}
		else {
			jQuery('.site-header.fixed').removeClass('move');

		}
		scrollDefault = window.pageYOffset;
	};

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
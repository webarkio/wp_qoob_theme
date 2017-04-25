/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
	 /************************/
    // Mobile Button
    /************************/
    // function show_hide_show_qoob_theme_menu() {
    //     jQuery("#mobile-wrap").slideToggle(300);
    //     e.preventDefault();
    // }
    /************************/
    // Submenu center 
    /************************/
    function menu_center() {
        if (jQuery(window).width() > 768) {
            // document.onreadystatechange = function() {
            //     if (document.readyState === 'complete') {
                    jQuery("#menu > li > ul").each(function(){
                        var parentWidth = jQuery(this).parent().innerWidth()  - 16;
                        var menuWidth = jQuery(this).innerWidth();
                        var margin = ((parentWidth / 2 ) - (menuWidth / 2));
                        margin = margin + "px";
                        jQuery(this).css("margin-left", margin);
                    });
            //     }
            // }
        }
    }
    /************************/
    // Menu
    /************************/
    function qoob_menu() {
        jQuery('ul#menu').superfish({
        	 animation: {
                marginTop: '0px',
                opacity: 'show'
            },
            animationOut: {
                marginTop: '0px',
                opacity: 'hide'
            },
            autoArrows: false,
            delay: 50,
            disableHI: true,
            speed: 'fast',
            speedOut: 'fast',
            onShow: function () { 
            },
            onHide: function() {

            }
        });

        if (jQuery(window).width() < 768) {

            if (jQuery("#menu").length > 0) {

                if (jQuery("#mobile-menu").length < 1) {

                    jQuery("#menu").clone().attr({
                        class: "",
                        id: "mobile-menu"
                    }).appendTo("#mmenu-wrap");
                    // jQuery("#mobile-menu a.sf-with-ul, .mobile-menu-close").next('ul').css('margin-top', '0px');

                    // jQuery("#mobile-menu a.sf-with-ul").on("click", function(e) {

                    //     e.preventDefault();

                    //     jQuery(this).toggleClass("open").next("ul").slideToggle(300);


                    // });


                }
                jQuery('#mobile-menu-button').show();
                jQuery('#menu').hide();
            }

           
        } else {

            jQuery("#mobile-menu").hide();
            jQuery('#mobile-menu-button').hide();
            jQuery('#menu').show();
            jQuery('#mmenu-wrap').removeClass('open');

        }
         if (jQuery(window).width() < 768) { 
            jQuery('.site-header.fixed').addClass('mobile-show');
        }else {
            jQuery('.site-header.fixed').removeClass('mobile-show');
        }
        
    }

jQuery(document).ready(function() {
    qoob_menu();
    // show_hide_show_qoob_theme_menu();
    menu_center();
    jQuery("#mobile-menu-button").click(function() {
        jQuery(this).toggleClass("btn-open");
        jQuery("#mmenu-wrap").slideToggle(300);
        jQuery("body").toggleClass("posfixed");
    });
    jQuery(".sf-with-ul").click(function(e) {
        e.preventDefault();
        jQuery(this).next("ul").slideToggle(300);
    });
     // jQuery("#mobile-menu").find(".social-media-icon").detach();
        // jQuery(".social-media-icon").prependTo(jQuery("#mobile-menu"));
        // jQuery("<div class='mobile-menu-close'></div>").prependTo(jQuery("#mobile-menu"));
    //     jQuery(".mobile-menu-close").on("click", function() {
    //     jQuery("#mobile-menu").toggleClass("open").slideToggle(300);
    // });
});

jQuery(window).resize(function(){
    qoob_menu();
    menu_center();
});


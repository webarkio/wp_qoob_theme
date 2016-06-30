/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function ($) {
    
    //Custom color pallete settups
    var white = {'first_color' : 'rgba(255, 255, 255, 1)', 'second_color' : 'rgba(135, 135, 135, 1)'},
        wheat = {'first_color' : 'rgba(255, 234, 90, 1)', 'second_color' : 'rgba(135, 135, 135, 1)'},
        peru = {'first_color' : 'rgba(157, 107, 0, 1)', 'second_color' : 'rgba(255, 255, 255, 1)'},
        purple = {'first_color' : 'rgba(84, 0, 102, 1)', 'second_color' : 'rgba(255, 255, 255, 1)'},
        green = {'first_color' : 'rgba(41, 75, 0, 1)', 'second_color' : 'rgba(255, 255, 255, 1)'},
        red = {'first_color' : 'rgba(120, 11, 1, 1)', 'second_color' : 'rgba(255, 255, 255, 1)'};

    setTimeout(function () {
        $('#section-first_color .wp-picker-container, #section-second_color .wp-picker-container').off('click.wpcolorpicker');
    }
    , 0);   
        
    $('#header_pallete').change(function () {
        colorscheme = $(this).val();
        
        switch (colorscheme) {
            case 'white' : colorscheme = white;
                break;
            case 'wheat' : colorscheme = wheat;
                break;
            case 'peru' : colorscheme = peru;
                break;
            case 'purple' : colorscheme = purple;
                break;
            case 'green' : colorscheme = green;
                break;
            case 'red' : colorscheme = red;
                break;           
        }
        
        for (id in colorscheme) {
            of_update_color(id, colorscheme[id]);
        }
    });
   
    function of_update_color(id, color) {
        $('#' + id).wpColorPicker('color', color);
    }

    // Loads the color pickers
    $('.of-color').wpColorPicker();

    // Image Options
    $('.of-radio-img-img').click(function () {
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });

    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    // Loads tabbed sections if they exist
    if ($('.nav-tab-wrapper').length > 0) {
        options_framework_tabs();
    }

    function options_framework_tabs() {

        var $group = $('.group'),
                $navtabs = $('.nav-tab-wrapper a'),
                active_tab = '';

        // Hides all the .group sections to start
        $group.hide();

        // Find if a selected tab is saved in localStorage
        if (typeof (localStorage) != 'undefined') {
            active_tab = localStorage.getItem('active_tab');
        }

        // If active tab is saved and exists, load it's .group
        if (active_tab != '' && $(active_tab).length) {
            $(active_tab).fadeIn();
            $(active_tab + '-tab').addClass('nav-tab-active');
        } else {
            $('.group:first').fadeIn();
            $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
        }

        // Bind tabs clicks
        $navtabs.click(function (e) {

            e.preventDefault();

            // Remove active class from all tabs
            $navtabs.removeClass('nav-tab-active');

            $(this).addClass('nav-tab-active').blur();

            if (typeof (localStorage) != 'undefined') {
                localStorage.setItem('active_tab', $(this).attr('href'));
            }

            var selected = $(this).attr('href');

            $group.hide();
            $(selected).fadeIn();

        });
    }

});
<?php

/*
 * ADDING STYLES FOR FRONTEND
 */
add_action('wp_enqueue_scripts', 'front_styles');

function front_styles() {
    wp_enqueue_style('opts_front_styles', get_template_directory_uri() . '/inc/options/css/options.frontend.css.php');
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */
function optionsframework_option_name() {

    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = get_option('stylesheet');
    $themename = preg_replace("/\W/", "_", strtolower($themename));

    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);

    // echo $themename;
}

/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if (!function_exists('get_qoob_option')) {

    function get_qoob_option($name, $default = '') {

        $optionsframework_settings = get_option('optionsframework');

        // Gets the unique option id
        $option_name = $optionsframework_settings['id'];

        if (get_option($option_name)) {
            $options = get_option($option_name);
        }

        if (isset($options[$name])) {
            return $options[$name];
        } else {
            return $default;
        }
    }

}


<?php

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */
function optionsframework_options() {
    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all tags into an array
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ($options_tags_obj as $tag) {
        $options_tags[$tag->term_id] = $tag->name;
    }

    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    $options = array(
        array(
            'name' => __('General Settings', 'qoob-theme'),
            'type' => 'heading'
        ),
        array(
            'name' => __('Blog background image', 'qoob-theme'),
            'desc' => __('Upload any media using the WordPress native uploader to set bg image', 'qoob-theme'),
            'id' => 'blog_bg_img',
            'std' => '',
            'type' => 'upload'
        ),
        array(
            'name' => __('Blog layout', 'qoob-theme'),
            'id' => 'sidebar',
            'std' => 'on',
            'type' => 'radio',
            'options' => array(
                'on' => 'With sidebar',
                'off' => 'Without sidebar'
            )
        ),
        array(
            'name' => __('Footer text', 'qoob-theme'),
            'id' => 'footer_copy',
            'std' => '&copy; qoob 2016',
            'type' => 'text'
        )
    );
    return $options;
}

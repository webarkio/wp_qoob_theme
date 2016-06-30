<?php

/**
 * qoob.theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package qoob.theme
 */
if (!function_exists('qoob_theme_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function qoob_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on qoob.theme, use a find and replace
         * to change 'qoob-theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('qoob-theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'qoob-theme'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('qoob_theme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 52,
            'width' => 52,
            'flex-width' => true
        ));

        /*
         * Set the image size by cropping the image
         * See https://developer.wordpress.org/reference/functions/add_image_size/
         */
        add_image_size( 'thumbnail-size-post-page', 1903, 720, array( 'left', 'top' )); // Hard crop left top
        add_image_size( 'thumbnail-blog-list', 540, 420, array( 'left', 'top' )); // Hard crop left top
    }

endif;
add_action('after_setup_theme', 'qoob_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function qoob_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters('qoob_theme_content_width', 640);
}

add_action('after_setup_theme', 'qoob_theme_content_width', 0);

/**
 * Register excerpt length
 */
function qoob_theme_excerpt_length($length) {
    return 13;
}
add_filter('excerpt_length', 'qoob_theme_excerpt_length');

/**
 * Register new excerpt more
 */
if(!function_exists('qoob_theme_excerpt_more')) {
    function qoob_theme_excerpt_more( $more ) {
        return '...';
    }
}
add_filter( 'excerpt_more', 'qoob_theme_excerpt_more' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function qoob_theme_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'qoob-theme'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'qoob-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'qoob_theme_widgets_init');

/**
 * wp_list_comments comment callback
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 */

function qoobtheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard clearfix">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <div class="comment-author-text">
            <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
            <?php comment_text(); ?>
            <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf( __('%1$s'), get_comment_date('j.m.Y') ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
                ?>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </div>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function qoob_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
                <label>
                    <span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
                    <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
                </label>
            </form>';
    return $form;
}
add_filter( 'get_search_form', 'qoob_search_form' );

if (!function_exists('bootstrapBasicPagination')) {
    /**
     * display pagination (1 2 3 ...) instead of previous, next of wordpress style.
     * 
     * @param string $pagination_align_class
     * @return string the content already echo
     */
    function bootstrapBasicPagination($total = 1, $pagination_align_class = 'pagination-center pagination-row') 
    {
        global $wp_query;
        $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; 
            $args = array(
                'posts_per_page' => get_option('posts_per_page'), 
                'paged' => $current_page 
            );
            $postlist = new WP_Query($args);
            $big = 999999999;
            $pagination_array = paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '/page/%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $postlist->max_num_pages,
                'prev_text' => __('', 'qoob-theme'),
                'next_text' => __('', 'qoob-theme'),
                'type' => 'array',
                'add_args' => false
            ));

            unset($big);

            if (is_array($pagination_array) && !empty($pagination_array)) {
                echo '<nav class="' . $pagination_align_class . '">';
                echo '<ul class="pagination blog list-style-none">';
                foreach ($pagination_array as $page) {
                    echo '<li';
                    if (strpos($page, '<a') === false && strpos($page, '&hellip;') === false) {
                        echo ' class="active"';
                    }
                    echo '>';
                    if (strpos($page, '<a') === false && strpos($page, '&hellip;') === false) {
                        echo '<span>' . $page . '</span>';
                    } else {
                        echo $page;
                    }
                    echo '</li>';
                }
                echo '</ul>';
                echo '</nav>';
            }

            unset($page, $pagination_array);
    }// bootstrapBasicPagination
}
/**
* Register sidebar for footer
*
*/
add_action( 'widgets_init', 'qoob_theme_footer_widgets_init' );
function qoob_theme_footer_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Footer Sidebar', 'qoob-theme' ),
        'id' => 'footer',
        'description' => __( 'Widgets in this area will be shown on footer.', 'qoob-theme' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));
}
/**
 * Enqueue scripts and styles.
 */
function qoob_theme_scripts() {
    //grid system
    wp_enqueue_style('qoob-theme-bootstrap-grid', get_template_directory_uri() . '/css/bootstrap.css');
    //fonts
    wp_enqueue_style('qoob-font-open-sans-light', get_template_directory_uri() . '/css/fonts/open-sans-light.css');
    wp_enqueue_style('qoob-font-open-sans-bold', get_template_directory_uri() . '/css/fonts/open-sans-bold.css');
	wp_enqueue_style('qoob-font-open-sans-semibold', get_template_directory_uri() . '/css/fonts/open-sans-semibold.css');
    wp_enqueue_style('qoob-theme-megafish', get_template_directory_uri() . '/css/megafish.css');
    wp_enqueue_style('qoob-theme-magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css');

    wp_enqueue_style('qoob-theme-style', get_stylesheet_uri());
    wp_enqueue_style('qoob-theme-carousel-css', get_template_directory_uri() . '/css/carousel.css');
	wp_enqueue_style('qoob-theme-collapse-css', get_template_directory_uri() . '/css/collapse.css');
    wp_enqueue_style('qoob-theme-blocks-style', get_template_directory_uri() . '/css/blocks.css');
    
    wp_enqueue_style('qoob-theme-bootstrap-progressbar-css', get_template_directory_uri() . '/css/bootstrap-progressbar.css');

	wp_enqueue_style('qoob-theme-owl-carousel-style', get_template_directory_uri() . '/css/owl.carousel.min.css');
	wp_enqueue_style('qoob-theme-owl-theme-default', get_template_directory_uri() . '/css/owl.theme.default.min.css');
    wp_enqueue_style('qoob-theme-style', get_stylesheet_uri());

    wp_enqueue_script('qoob-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), false, true);

    wp_enqueue_script('qoob-theme-hoverintent', get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'), false, true);
    wp_enqueue_script('qoob-theme-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), false, true);
	wp_enqueue_script('qoob-theme-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('qoob-theme-countTo', get_template_directory_uri() . '/js/jQuery.countTo.js', array('jquery'), false, true);
    wp_enqueue_script('qoob-theme-progressbar', get_template_directory_uri() . '/js/progressbar.min.js', array('jquery'), false, true);

    wp_enqueue_script('qoob-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), false, true);

	wp_enqueue_script('qoob-theme-masonry', get_template_directory_uri() . '/js/masonry.js', array('jquery'), false, true);

    wp_enqueue_script('qoob-theme-bootstrap-progressbar-js', get_template_directory_uri() . '/js/bootstrap-progressbar.js', array('jquery'));
    wp_enqueue_script('qoob-theme-jquery-waypoints-js', get_template_directory_uri() . '/js/jquery.waypoints.js', array('jquery'));
    wp_enqueue_script('qoob-theme-common', get_template_directory_uri() . '/js/common.js', array('jquery'));
    wp_enqueue_script('qoob-theme-contact', get_template_directory_uri() . '/js/contact.js', array('jquery'));

    wp_enqueue_script('qoob-theme-carousel-js', get_template_directory_uri() . '/js/carousel.js', array('jquery'));
	wp_enqueue_script('qoob-theme-collapse-js', get_template_directory_uri() . '/js/collapse.js', array('jquery'));
    wp_enqueue_script('qoob-theme-magnific-popup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), false, true);
    wp_enqueue_script('qoob-theme-bg-video-vimeo-lib', get_template_directory_uri() . '/js/froogaloop.min.js', array('jquery', 'qoob-theme-bg-video-vimeo'), false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'qoob_theme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Contact form
 */
require get_template_directory() . '/inc/ajax-contact-form.php';

require get_template_directory() . '/inc/widgets/widget-register.php';
/**
 * Option framework
 */
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options/');
require get_template_directory() . '/inc/options/options-utils.php';
require get_template_directory() . '/inc/options/options-framework.php';

/**
 * One click demo import plugin
 */
require_once(get_template_directory() . '/inc/radium/init.php');

/**
 * Plugin Activator
 */
require_once(get_template_directory() . '/inc/plugin_activation/init.php');

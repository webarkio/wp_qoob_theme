<?php
/**
 * Qoob functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package qoob
 */

if ( ! function_exists( 'qoob_theme_setup' ) ) :

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
		 * If you're building a theme based on qoob, use a find and replace
		 * to change 'qoob' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'qoob', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'qoob' ),
			'footer' => esc_html__( 'Footer menu', 'qoob' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'qoob_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-logo', array(
			'height' => 52,
			'width' => 52,
			'flex-width' => true,
		) );

		/*
		 * Set the image size by cropping the image
		 * See https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		add_image_size( 'qoob-thumbnail-size-post-page', 1903, 720, array( 'center', 'center' ) ); // Hard crop center center
		add_image_size( 'qoob-thumbnail-blog-list', 540, 420, array( 'center', 'center' ) ); // Hard crop center center

		add_filter( 'qoob_libs', 'qoob_add_theme_lib', 10, 2 );
	}

	/**
	 * Create array libs from json file
	 *
	 * @param array $qoob_libs Array libs from json file.
	 */
	function qoob_add_theme_lib( $qoob_libs ) {
		$qoob_libs[] = get_template_directory() . '/blocks/lib.json';
		return $qoob_libs;
	}

endif;
add_action( 'after_setup_theme', 'qoob_theme_setup' );


/**
 * Adding social media icons links to a Specific WordPress Menu
 * takes user input from the customizer and outputs linked social media icons
 *
 * @param string $nav The HTML list content for the menu items.
 * @param array  $args An object containing wp_nav_menu() arguments.
 */
function qoob_social_media_icons( $nav, $args ) {
	$social_sites = qoob_customizer_social_media_array();

	if ( 'primary' === $args->theme_location ) {
		/* any inputs that aren't empty are stored in $active_sites array */
		foreach ( $social_sites as $social_site ) {
			if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
				$active_sites[] = $social_site;
			}
		}

		$icons = '';
		/* for each active social site, add it as a list item */
		if ( ! empty( $active_sites ) ) {
			foreach ( $active_sites as $active_site ) {
				$icons .= '<li class="menu-item social-media-icon"><a target="_blank" href="' . esc_url( get_theme_mod( $active_site ) ) . '"><i class="' . $active_site . '" aria-hidden="true"></i>
				<span class="screen-reader-text">' . sprintf( esc_html__( 'Link %s profile', 'qoob' ), $active_site ) . '</span></a></li>';
			}
		}

		return $nav . $icons;
	}
	return $nav;
}
add_filter( 'wp_nav_menu_items','qoob_social_media_icons', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function qoob_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'qoob_theme_content_width', 640 );
}

add_action( 'after_setup_theme', 'qoob_theme_content_width', 0 );

/**
 * Register excerpt length
 *
 * @param int $length The number of words.
 */
function qoob_theme_excerpt_length( $length ) {
	return 13;
}
add_filter( 'excerpt_length', 'qoob_theme_excerpt_length' );

if ( ! function_exists( 'qoob_theme_excerpt_more' ) ) {
	/**
	 * Register new excerpt more
	 *
	 * @param string $link The string shown within the more link.
	 */
	function qoob_theme_excerpt_more( $link ) {
		if ( is_admin() ) {
			return $link;
		}

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
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar blog', 'qoob' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'qoob' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Sidebar page', 'qoob' ),
		'id' => 'sidebar-page',
		'description' => esc_html__( 'Add widgets here.', 'qoob' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar(array(
		'name' => esc_html__( 'Sidebar docs page', 'qoob' ),
		'id' => 'sidebar-docs',
		'description' => esc_html__( 'Add widgets here.', 'qoob' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}

add_action( 'widgets_init', 'qoob_theme_widgets_init' );

/**
 * List comments. wp_list_comments comment callback
 * Used in the comments.php template to list comments for a particular post.
 *
 * @param array        $comment Array of WP_Comment objects.
 * @param string|array $args Optional. Formatting options.
 * @param int          $depth The maximum comments depth. Default empty.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 */
function qoobtheme_comment( $comment, $args, $depth ) {

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	
	<<?php echo wp_kses( $tag , array( 'div', 'li' ) ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' !== $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard clearfix">
		<?php if ( 0 !== $args['avatar_size'] ) { ?>
			<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php } ?>
		<div class="comment-author-text">
			<?php printf( wp_kses_post( __( '<cite class="fn">%s</cite>', 'qoob' ) ), get_comment_author_link() ); ?>
			<?php comment_text(); ?>
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( '%1$s', get_comment_date( 'j.m.Y' ) ); ?></a>
				<?php edit_comment_link( esc_html__( '(Edit)', 'qoob' ), '  ', '' );
				?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div>
	</div>
	<?php if ( 0 === $comment->comment_approved ) : ?>
		 <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'qoob' ); ?></em>
		  <br />
	<?php endif; ?>
	<?php if ( 'div' !== $args['style'] ) : ?>
	</div>
	<?php endif; ?>
	<?php
}


add_filter( 'get_search_form', 'qoob_search_form' );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function qoob_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'qoob' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'qoob' ) . '" value="' . get_search_query() . '" name="s" />
						<button type="submit" class="search-submit"><span class="screen-reader-text">' . esc_attr__( 'Search', 'qoob' ) . '</span></button>
				</label>

			</form>';
	return $form;
}

add_action( 'admin_init', 'qoob_add_editor_styles' );
/**
 * Registers an editor stylesheet for the theme.
 */
function qoob_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}

/**
* Change order comment fields
*/
add_filter( 'comment_form_fields', 'qoob_reorder_comment_fields' );

/**
 * Filters the comment form fields, including the textarea.
 *
 * @param (array) $fields The comment fields.
 */
function qoob_reorder_comment_fields( $fields ) {
	$new_fields = array();

	$myorder = array( 'author','email','comment' );

	foreach ( $myorder as $key ) {
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	if ( $fields ) {
		foreach ( $fields as $key => $val ) {
			$new_fields[ $key ] = $val;
		}
	}
	return $new_fields;
}

/**
 * Enqueue scripts and styles.
 */
function qoob_theme_scripts() {
	wp_enqueue_style( 'qoob_custom_bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );

	wp_enqueue_style( 'qoob-fonts', get_template_directory_uri() . '/css/fonts/fonts.css' );

	wp_enqueue_style( 'megafish', get_template_directory_uri() . '/css/megafish.css' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style( 'qoob-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'blocks', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_script( 'qoob-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'hoverIntent' );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'qoob-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'qoob-theme-common', get_template_directory_uri() . '/js/common.js', array( 'jquery' ) );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array( 'jquery' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'qoob_theme_scripts' );

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
 * Register widget
 */
require get_template_directory() . '/inc/widgets/widget-register.php';

/**
 * Plugin Activator
 */
require get_template_directory() . '/inc/plugin_activation/init.php';

<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

get_header('fixed'); ?>
<div class="entry-thumbnail-blog" style="background-image: url(<?php echo esc_url(get_theme_mod('blog_image_bg')); ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2><?php
				global $wp_query;

				$wp_query->is_posts_page ?  wp_title('') : bloginfo('name');

				?></h2>
			</div>
		</div>
	</div>
</div>
<div class="container">
<?php if(get_theme_mod('blog_sidebar') == 'sidebar_right'): ?>
	<div id="primary" class="content-area sidebar-on col-lg-9">
<?php else:?>
	<div id="primary" class="content-area sidebar-off col-lg-12">
<?php endif;?>
		<main id="main" class="site-main blog-list row" role="main">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<?php
			the_posts_pagination(array(
				'prev_text'          => '',
				'next_text'          => '',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'qoob' ) . ' </span>'
			));

		?>
	</div><!-- #primary -->

<?php
if(get_theme_mod('blog_sidebar') == 'sidebar_right'){
	get_sidebar();
}

?>
</div><!--.container -->
<?php
get_footer();

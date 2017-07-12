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

get_header(); ?>
<div class="entry-thumbnail-blog" style="background-image: url(<?php echo esc_url( get_theme_mod( 'blog_image_bg' ) ); ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>
				<?php if ( is_home() && ! is_front_page() ) : ?>
						<?php single_post_title(); ?>
				<?php else : ?>
					<?php esc_html_e( 'Posts', 'qoob' ); ?>
				<?php endif; ?>
				</h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
<?php if ( 'sidebar_right' === get_theme_mod( 'blog_sidebar' ) ) : ?>
	<div id="primary" class="content-area sidebar-on col-lg-9">
<?php else : ?>
	<div id="primary" class="content-area sidebar-off col-lg-12">
<?php endif; ?>
		<main id="main" class="site-main blog-list masonry-list row" role="main">
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
			the_posts_pagination( array(
				'prev_text'          => '<span class="screen-reader-text">' . __( 'Next', 'qoob' ) . ' </span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Next', 'qoob' ) . ' </span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'qoob' ) . ' </span>',
			) );

		?>
	</div><!-- #primary -->

<?php
if ( 'sidebar_right' === get_theme_mod( 'blog_sidebar' ) ) {
	get_sidebar();
}

?>
</div><!--.container -->
<?php
get_footer();

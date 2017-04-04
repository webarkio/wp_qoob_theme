<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<?php if ( 'sidebar_right' === get_theme_mod( 'blog_sidebar' ) ) : ?>
			<div id="primary" class="content-area sidebar-on col-lg-9">
		<?php else : ?>
			<div id="primary" class="content-area sidebar-off col-lg-12">
		<?php endif; ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<main id="main" class="site-main row masonry-list" role="main">

			<?php
			if ( have_posts() ) : ?>


				<?php
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
		</div><!-- #primary -->

		<?php
		if ( 'sidebar_right' === get_theme_mod( 'blog_sidebar' ) ) {
			get_sidebar();
		}
		?>
	</div>
</div> <!-- .container -->
<?php
get_footer();

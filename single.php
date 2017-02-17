<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package qoob
 */

get_header(); ?>
<div class="entry-thumbnail-full" style="background-image: url(<?php the_post_thumbnail_url( 'thumbnail-size-post-page' ); ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php echo get_the_title(); ?></h1>
				<div class="entry-meta">
					<?php qoob_theme_posted_on(); ?>
				</div>
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

		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	if ( 'sidebar_right' === get_theme_mod( 'blog_sidebar' ) ) {
		get_sidebar();
	}
?>
</div><!-- .container -->
<?php
get_footer();

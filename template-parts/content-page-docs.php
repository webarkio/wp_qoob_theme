<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

?>

<section class="doc-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Documentation</h1>
			</div>
		</div>
	</div>
</section>
<style>
  .doc-block {
    background-image: url(<?php echo get_template_directory_uri(); ?>/images/doc-desktop.jpg);
    background-image: -webkit-image-set(url(<?php echo get_template_directory_uri(); ?>/images/doc-desktop.jpg) 1x, url(<?php echo get_template_directory_uri(); ?>/images/doc-desktop-retina.jpg) 2x);
}
@media (max-width: 991px) {
  .doc-block  {
    background-image: url(<?php echo get_template_directory_uri(); ?>/images/doс-bg-tablet.png);
    background-image: -webkit-image-set(url(<?php echo get_template_directory_uri(); ?>/images/doс-bg-tablet-retina.png) 1x, url(<?php echo get_template_directory_uri(); ?>/images/doс-bg-tablet-retina.png) 2x);
}
}

    @media (max-width: 767px) {
  .doc-block  {
    background-image: url(<?php echo get_template_directory_uri(); ?>/images/download-bg-mobile.png);
    background-image: -webkit-image-set(url(<?php echo get_template_directory_uri(); ?>/images/download-bg-mobile.png) 1x, url(<?php echo get_template_directory_uri(); ?>/images/download-bg-mobile-retina.png) 2x);
}
}
</style>
<div id="primary" class="content-area container main-docs">
	<main id="main" class="site-main-docs" role="main">
		<?php

			get_sidebar( 'docs' );

		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-9 col-md-9 col-sm-12 col-xs-12 page-docs' ); ?>>
		<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'qoob' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'qoob' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
	</main><!-- #main -->
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

</div><!-- #primary -->

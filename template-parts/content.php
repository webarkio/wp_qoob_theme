<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

?>
<div class="col-lg-12 col-md-12 col-sm-12 hux">
<article style="background-image: url(<?php the_post_thumbnail_url( 'thumbnail-blog-list' );?>);" id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list' ); ?>>
	<div class="overflow-grey"></div>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
	<!-- <div class="entry-thumbnail"> -->
		<div class="overlay-dark"></div>

	<!-- </div> -->
	<?php endif;?>
	
	<div class="entry-wrap-content">
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'qoob' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div class="entry-meta">
				<?php qoob_theme_posted_meta(); ?>
		</div><!-- .entry-meta -->
	</div><!-- #entry-wrap-content-->
</article><!-- #post-## -->

</div>

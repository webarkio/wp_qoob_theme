<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

?>
<div class="col-lg-4 col-sm-4">
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list' ); ?>>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
	<div class="entry-thumbnail">
		<?php the_post_thumbnail( 'thumbnail-blog-list' ); ?>
	</div>
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
				 the_excerpt();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'qoob' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div class="entry-meta">
				<?php qoob_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</div><!-- #entry-wrap-content-->
</article><!-- #post-## -->
</div>

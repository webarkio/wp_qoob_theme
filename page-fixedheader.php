<?php
/**
 * Template Name: Page with fixed header
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qoob
 */

get_header( 'fixed' ); ?>
	<?php
	$template_parts = 'page';
	while ( have_posts() ) : the_post();
		$meta = json_decode( get_post_meta( get_the_ID(), 'qoob_data', true ), true );

		if ( ( isset( $_GET['qoob'] ) && true === (boolean) $_GET['qoob'] ) ||
			( isset( $meta['blocks'] ) && count($meta['blocks']) > 0 ) ) {
			$template_parts = 'qoob';
		}

		get_template_part( 'template-parts/content', $template_parts );

	endwhile; // End of the loop.
	?>
<?php
get_footer();

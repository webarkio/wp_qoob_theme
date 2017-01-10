<?php
/**
 * Template Name: Page with left sidebar
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

get_header(); ?>
	<?php
	$template_parts = 'page-sidebar';
	while ( have_posts() ) : the_post();
		$content = get_the_content();
		$meta = get_post_meta( get_the_ID(), 'qoob_data', true );

		if ( ( isset( $_GET['qoob'] ) && true === (boolean) $_GET['qoob'] ) || ( '{"blocks":[]}' !== $meta && '' !== $meta ) ) { // input var okay
			$template_parts = 'qoob';
		}
		get_template_part( 'template-parts/content', $template_parts );

	endwhile; // End of the loop.
	?>
<?php
get_footer();

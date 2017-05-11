<?php
/**
 * Template Name: Page partners
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
	while ( have_posts() ) : the_post();
		$content = get_the_content();
		get_template_part( 'template-parts/content', 'page-partners' );

	endwhile; // End of the loop.
	?>
<?php
get_footer();

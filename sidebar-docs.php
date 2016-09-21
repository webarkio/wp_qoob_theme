<?php
/**
 * The sidebar containing the page widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package qoob
 */

if ( ! is_active_sidebar( 'sidebar-docs' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-lg-3 sidebar-docs" role="complementary">
	<?php dynamic_sidebar( 'sidebar-docs' ); ?>
</aside><!-- #secondary -->
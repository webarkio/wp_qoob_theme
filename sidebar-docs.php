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
<div class="spoiler-docs">
<aside id="secondary" class="widget-area col-lg-3 col-md-3 col-sm-3 sidebar-docs" role="complementary">
	<span class="turn-btn-docs">
		<b>●</b><b>●</b><b>●</b>
	</span>
	<?php dynamic_sidebar( 'sidebar-docs' ); ?>
</aside><!-- #secondary -->
</div>
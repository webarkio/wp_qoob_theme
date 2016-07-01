<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp_qoob_theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="container content-404 relative">
			    <div class="row">
			        <div class="col-lg-12 main-block-404"></div>
			    </div>
			    <div class="row text-404">
			        <h1><?php esc_html_e( 'Page not found', 'wp_qoob_theme' ); ?></h1>
			    </div>
			    <div class="row button-404">
			        <a class="btn" href="/"><?php esc_html_e( 'Go to main page', 'wp_qoob_theme' ); ?></a>
			    </div>
			</section><!-- end container-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

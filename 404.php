<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package qoob
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="container content-404 relative">
			    <div class="row">
			        <div class="col-lg-12 main-block-404">
			        	<img alt="<?php esc_html_e( '404', 'qoob' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ) . '/images/qoob_404.png'; ?>">
			        </div>
			    </div>
			    <div class="row text-404">
			        <h1><?php esc_html_e( 'Page not found', 'qoob' ); ?></h1>
			    </div>
			    <div class="row button-404">
			        <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to main page', 'qoob' ); ?></a>
			    </div>
			</section><!-- end container-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

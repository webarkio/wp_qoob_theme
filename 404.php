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
			<section class="container page-404 relative">			    
			    <h1 class="header-block"><?php esc_html_e( 'Qoob - Realtime Frontend Page Builder for WordPress', 'qoob' ); ?></h1>
			    
			    <p><?php esc_html_e( 'It helps you build any template layouts for your website and features absolutely FREE', 'qoob' ); ?></p>
			    <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/qoob_404.png">

			    <h3><?php esc_html_e( 'Sorry, currently no items are found. Please try again later.', 'qoob' ); ?></h3>

			    <div class="col-container">
			    	<div class="col-form">
			    		<form role="search" method="get" class="searchform" action="/">
							<input type="text" class="input-text" placeholder="<?php esc_html_e( 'Search', 'qoob' ); ?>" value="<?php the_search_query(); ?>" name="s" id="s" />
							<button type="submit" class="button-submit">
							    <i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
			    	</div>
			    	<div class="col-button">
			    		<a class="btn" href="/"><?php esc_html_e( 'Go to main page', 'qoob' ); ?></a>
			    	</div>
			    </div>
			</section><!-- end container-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

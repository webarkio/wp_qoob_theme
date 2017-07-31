<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package qoob
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="loader-wrap"></div>
<div class="loader">
	<span></span>
	<span></span>
	<span></span>
	<span></span>
</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'qoob' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
				?>
				<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			</div><!-- .site-branding -->
			<button id="mobile-menu-button">
				<span class="icon">
					<i class="line"></i>
					<i class="line"></i>
					<i class="line"></i>
				</span>
				<strong class="screen-reader-text"><?php esc_html_e( 'Menu', 'qoob' ); ?></strong>
			</button>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container'       => 'div',
							'menu_class'      => 'sf-menu list-style-none',
							'menu_id'         => 'menu',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'link_before'     => '<span>',
							'link_after'      => '</span><span class="menu-separator" style="width: auto; left: 50%; right: 50%;"></span>',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 3
						) );
				?>
			</nav><!-- #site-navigation -->
		</div>

	</header><!-- #masthead -->
	<div id='mmenu-wrap'>
		<!-- <div class="container"></div> -->
	</div>
	<div id="content" class="site-content">

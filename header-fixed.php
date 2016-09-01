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
<div class="loader">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 44 44" style="enable-background:new 0 0 44 44;" xml:space="preserve">
    <style type="text/css">
     .st0{fill:none;stroke:#949599;stroke-width:2;}
    </style>
    <g>
     <circle class="st0" cx="22" cy="22" r="1">
     
      <animate  accumulate="none" additive="replace" attributeName="r" begin="0s" calcMode="spline" dur="1.8s" fill="remove" keySplines="0.165, 0.84, 0.44, 1" keyTimes="0; 1" repeatCount="indefinite" restart="always" values="1; 20">
      </animate>
     
      <animate  accumulate="none" additive="replace" attributeName="stroke-opacity" begin="0s" calcMode="spline" dur="1.8s" fill="remove" keySplines="0.3, 0.61, 0.355, 1" keyTimes="0; 1" repeatCount="indefinite" restart="always" values="1; 0">
      </animate>
     </circle>
     <circle class="st0" cx="22" cy="22" r="1">
     
      <animate  accumulate="none" additive="replace" attributeName="r" begin="-0.9s" calcMode="spline" dur="1.8s" fill="remove" keySplines="0.165, 0.84, 0.44, 1" keyTimes="0; 1" repeatCount="indefinite" restart="always" values="1; 20">
      </animate>
     
      <animate  accumulate="none" additive="replace" attributeName="stroke-opacity" begin="-0.9s" calcMode="spline" dur="1.8s" fill="remove" keySplines="0.3, 0.61, 0.355, 1" keyTimes="0; 1" repeatCount="indefinite" restart="always" values="1; 0">
      </animate>
     </circle>
    </g>
    </svg>
</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'qoob' ); ?></a>

	<header id="masthead" class="site-header fixed" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
				?>
				<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			</div><!-- .site-branding -->
			<a id="mobile-menu-button" href="#">
                        <span class="icon">
                            <i class="line"></i>
                            <i class="line"></i>
                            <i class="line"></i>
                        </span>
                    </a>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php 
                        wp_nav_menu( array(
                            'theme_location'  => 'primary',
                            'menu'            => '', 
                            'container'       => 'div', 
                            'container_class' => '', 
                            'container_id'    => '',
                            'menu_class'      => 'sf-menu list-style-none', 
                            'menu_id'         => 'menu',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '<span>',
                            'link_after'      => '</span><span class="menu-separator" style="width: auto; left: 50%; right: 50%;"></span>',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 3,
                            'walker'          => '',
                        ) ); 
                ?>
			</nav><!-- #site-navigation -->
		</div>
		
	</header><!-- #masthead -->
	<div id='mmenu-wrap' class="fixed">
		<!-- <div class="container"></div> -->
	</div>
	<div id="content" class="site-content">

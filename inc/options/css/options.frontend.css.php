<?php
include_once(str_replace('wp-content' . DIRECTORY_SEPARATOR, '', explode(DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR, dirname(__FILE__))[0] . DIRECTORY_SEPARATOR . 'wp-load.php'));
header('Content-Type: text/css');

ob_start();
?>
/*HEADER SETTINGS*/
.char-pink {
    color: #be5b9a;
}

.char-yellow {
    color: #fdac38;
}

.char-red {
    color: #f4594c;
}

.char-green {
    color: #76be53;
}

.char-blue {
    color: #0090c0;
}

@media (min-width: 768px) {  
    .navbar.navbar-default.navbar-inversed .nav.navbar-nav,
    .navbar.navbar-default.navbar-inversed .smartmenu-navbar-collapse.smartmenu-collapse {
        float: left;
    }
    
    .navbar.navbar-default.navbar-inversed .navbar-header {
        float: right;
    }
}

/*FOOTER SETTINGS*/
footer .copyright {
    font-size: <?php echo get_qoob_option('copyright_size'); ?>px;
}

footer.site-footer {
    background-color: <?php echo get_qoob_option('footer_bg_color'); ?>;
}



/*COMMON SETTINGS*/
<?php if (get_qoob_option('main_font') != '') { ?>
body {
    font-family: <?php echo get_qoob_option('main_font'); ?>, sans-serif;
}
<?php if (get_qoob_option('main_font') != 'PTSansRegular') { ?>
    .navbar-default .navbar-brand .site-name {
        font-family: <?php echo get_qoob_option('main_font'); ?>, sans-serif;
    }
<?php
    }
}
?>
    
p {
    font-family: <?php echo get_qoob_option('paragraphs_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('paragraphs_typography')['size']; ?>;
    color: <?php echo get_qoob_option('paragraphs_typography')['color']; ?>;
}

h1,
.entry-post-sb-content h1,
.entry-post-sb-content h1 a,
.entry-content h1 {
    font-family: <?php echo get_qoob_option('h1_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h1_size'); ?>em;
    color: <?php echo get_qoob_option('h1_typography')['color']; ?>;
}

h2,
.entry-post-sb-content h2,
.entry-post-sb-content h2 a,
.entry-content h2 {
    font-family: <?php echo get_qoob_option('h2_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h2_size'); ?>em;
    color: <?php echo get_qoob_option('h2_typography')['color']; ?>;
}

h3,
.entry-post-sb-content h3,
.entry-post-sb-content h3 a,
.entry-content h3 {
    font-family: <?php echo get_qoob_option('h3_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h3_size'); ?>em;
    color: <?php echo get_qoob_option('h3_typography')['color']; ?>;
}

h4,
.entry-post-sb-content h4,
.entry-post-sb-content h4 a,
.entry-content h4 {
    font-family: <?php echo get_qoob_option('h4_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h4_size');?>em;
    color: <?php echo get_qoob_option('h4_typography')['color']; ?>;
}

h5,
.entry-post-sb-content h5,
.entry-post-sb-content h5 a,
.entry-content h5 {
    font-family: <?php echo get_qoob_option('h5_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h5_size');?>em;
    color: <?php echo get_qoob_option('h5_typography')['color']; ?>;
}

h6,
.entry-post-sb-content h6,
.entry-post-sb-content h6 a,
.entry-content h6 {
    font-family: <?php echo get_qoob_option('h6_typography')['face']; ?>, sans-serif;
    font-weight: normal;
    font-size: <?php echo get_qoob_option('h6_size');?>em;
    color: <?php echo get_qoob_option('h6_typography')['color']; ?>;
}

<?php
$css = ob_get_contents();
ob_end_clean();
echo $css;



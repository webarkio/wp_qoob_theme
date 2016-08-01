<div class="container-fluid container-no-padding">
	<?php
		if (is_user_logged_in() && ( isset($_GET['qoob']) && $_GET['qoob'] == true)) {
    ?>
    		<div id="qoob-blocks"></div>
    <?php
        } else {
            echo do_shortcode(stripslashes( get_the_content() ));
        }
	?>
</div><!-- .container-fluid -->
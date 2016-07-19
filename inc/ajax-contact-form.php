<?php

if (!function_exists('contactform_add_script')) {

    /**
     * Add script and localize form
     */
    function qoob_contactform_add_script() {
        wp_localize_script('qoob-theme-contact', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }

}
add_action('wp_enqueue_scripts', 'qoob_contactform_add_script');

/**
 * Ajax action callback form
 */
function qoob_ajax_contactform_action_callback() {
    $current_user = wp_get_current_user();

    $error = '';
    $status = 'error';

    $params = array();
    parse_str($_POST['form'], $params);

//    if (empty($params['name']) || empty($params['email']) || empty($params['message'])) {
//        $error = __('All fields are required to enter.', 'wp_qoob_theme');
//        if (isset($params['email'])) {
//            var_dump('ddd');
//            echo "Эта переменная определена, поэтому меня и напечатали.";
//        }
//    } else {
    if (isset($params['name'])) {
        $name = filter_var($params['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }
    if (isset($params['email'])) {
        $email = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
    }
    // if the e-mail is not valid, switch $error to TRUE and set the result text to the shortcode attribute named 'error_noemail'
    if (is_email($params['email'])) {
        $subject = __('A message from your website\'s contact form', 'wp_qoob_theme');

        $message = sprintf(__('%1$sIP address: %2$s', 'wp_qoob_theme'), PHP_EOL . PHP_EOL, $_SERVER['REMOTE_ADDR']);
        if (isset($params['message'])) {
            $message .= wp_kses(stripcslashes($params['message']), array());
        }
        if (isset($name)) {
            $message .= sprintf(__('%1$sSender\'s name: %2$s', 'wp_qoob_theme'), PHP_EOL, $name);
        }
        $message .= sprintf(__('%1$sE-mail address: %2$s', 'wp_qoob_theme'), PHP_EOL, $email);

        $sitename = strtolower($_SERVER['SERVER_NAME']);
        if (substr($sitename, 0, 4) == 'www.') {
            $sitename = substr($sitename, 4);
        }
        $emailfrom = get_option('fwsacf-emailfrom', 'noreply@' . $sitename);
        $header = 'From: ' . get_option('blogname') . ' <' . $emailfrom . '>' . PHP_EOL;
        $header .= 'Reply-To: ' . $email . PHP_EOL;

        if (wp_mail($current_user->user_email, $subject, $message, $header)) {
            $status = 'success';
            $error = false;
        } else {
            $error = __('The script can\'t send this email message.', 'wp_qoob_theme');
        }
    } else {
        $error = true;
    }
//    }

    $resp = array('status' => $status, 'errmessage' => $error, 'mail' => $current_user->user_email);
    wp_send_json($resp);
}

add_action('wp_ajax_contactform_action', 'qoob_ajax_contactform_action_callback');
add_action('wp_ajax_nopriv_contactform_action', 'qoob_ajax_contactform_action_callback');

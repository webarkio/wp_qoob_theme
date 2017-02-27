<?php
$sendto   = "subscribe@webark.io"; 
$usermail = $_POST['email_webark']; // stored in a variable data obtained from the field with email

// Formation of the message header
$subject  = "New mail";
$headers  = "From: " . strip_tags($usermail) . "\r\n";
$headers .= "Reply-To: ". strip_tags($usermail) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;charset=utf-8 \r\n";

// Formation of the message body
$msg  = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>New mail</h2>\r\n";
$msg .= "<p><strong>Почта:</strong> ".$usermail."</p>\r\n";

$msg .= "</body></html>";

// send a message
if(@mail($sendto, $subject, $msg, $headers)) {
  echo "<center><img src='images/ne-tpravleno.png'></center>";
  
} else {
    echo "<center><img src='images/ne-tpravleno.png'></center>";
}
 
?>

<?php
// $formcontent = " From: $name \n Phone: $phone \n Call Back: $call \n Type: $type \n Message: $message";
// $recipient = "contactus@your-domain-name.com";
// $subject = "Contact Form";
// $mailheader = "From: $email \r\n";
// echo "\n <!--Dump of mail() params \n $recipient \n $subject \n $formcontent \n $mailheader \n --> \n";
// echo "\n <!--Dump of mail() results \n ".mail($recipient, $subject, $formcontent, $mailheader)." \n --> \n";
// mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

	// require_once "Mail.php";  - rumors are that PEAR with be deprecated in PHPv8....
	$from = "$name <$email>"; 
	$to = "Contact Form <contactus@your-domain-name.com>"; 
	$subject = "Contact Form";

	$body = " From: $name \n Phone: $phone \n Call Back: $call \n Type: $type \n Message: $message";

	$host = "ssl://your.email.host-goes-here.com"; 
	$port = "465"; 
	$username = "contactus@your-domain-name.com"; 
	$password = "YourPasswordGoesHere";  

	$headers = array ('From' => $from,   'To' => $to,   'Subject' => $subject); 

	// $smtp = Mail::factory('smtp',   array ('host' => $host,     'port' => $port,     'auth' => true,     'username' => $username,     'password' => $password));  
	// $mail = $smtp->send($to, $headers, $body);  

	mail( $to, $subject, $body);
?>
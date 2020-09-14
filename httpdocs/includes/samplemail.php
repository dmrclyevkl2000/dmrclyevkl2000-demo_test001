<?php
/*
From http://www.html-form-guide.com 
This is the simplest emailer one can have in PHP.
If this does not work, then the PHP email configuration is bad!
*/

// $msg="";
// if(isset($_POST['submit']))
// {
//     /* ****Important!****
//     replace name@your-web-site.com below 
//     with an email address that belongs to 
//     the website where the script is uploaded.
//     For example, if you are uploading this script to
//     www.my-web-site.com, then an email like
//     form@my-web-site.com is good.
//     */

// 	$from_add = "admin@yourdomainname.com"; 

// 	$to_add = "contactus@yourdomainname.com"; //<-- put your custom/test/yahoo/gmail email address here

// 	$subject = "Test Subject";
// 	$message = "Test Message";
	
// 	$headers = "From: $from_add \r\n";
// 	$headers .= "Reply-To: $from_add \r\n";
// 	$headers .= "Return-Path: $from_add\r\n";
// 	$headers .= "X-Mailer: PHP \r\n";
	
	
// 	if(mail($to_add,$subject,$message,$headers)) 
// 	{
// 		$msg = "Mail sent OK";
// 	} 
// 	else 
// 	{
//  	   $msg = "Error sending email!";
// 	}
// 	$msg .= htmlentities($_SERVER['PHP_SELF']);
// 	$msg .= "\n$to_add,\n$subject,\n$message,\n$headers\n";
// }

	require_once "Mail.php";  
	 $from = "Contact Us  <contactus@yourdomainname.com>"; 
	 $to = "Contact Form  <contactform@yourdomainname.com>"; 
	 $subject = "Hi!"; 
	 $body = "Hi,\n\n test script?";  
	 $host = "ssl://your.secure.email.yourdomainname.com"; 
	 $port = "465"; 
	 $username = "contactus@yourdomainname.com"; 
	 $password = "yourPassWordGoesHere";  
	 $headers = array ('From' => $from,   'To' => $to,   'Subject' => $subject); 

	 $smtp = Mail::factory('smtp',   array ('host' => $host,     'port' => $port,     'auth' => true,     'username' => $username,     'password' => $password));  
	
	 $mail = $smtp->send($to, $headers, $body);  

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Test form to email</title>
</head>

<body>
<?php 
#echo $msg


echo "\n mail: $mail \n";


	if (PEAR::isError($mail)) {   
		echo("<p>" . $mail->getMessage() . "</p>");  
	} 
	else {   
		echo("<p>Message successfully sent!</p>");  
	} 


?>


<p>
<form action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' method='post'>
<input type='submit' name='submit' value='Submit'>
</form>
</p>


</body>
</html>
<!DOCTYPE html>
<html>
    <head>
<?php 
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>           
        <meta name="description" content="Driving Directions | Your Business Name  |  |  | " />
        <meta name="keywords" content="Driving Directions, Your Business Name,, " />
        <title>Your Business Name | 123 Address City, State/Province Zip/CountryCode</title>

    </head>
    <body>
        <div id="main">
            <div id="main2">
                <?php include ('../template/page_top.php'); ?>
                <div id="banner-contact">
                    <h1 class="blue">Contact Your Business Name</h1>
                    <strong>For immediate response, please call us at 555-867-5309 or stop by during business hours.</strong>
                    <br />
                    <strong><a href="/directions/">Click here for directions to our location</a></strong>
                    <h2>Hours of Operation:</h2>
                    <h4>Monday - Friday: 8:00 am - 6:00 pm<br \>Sunday: 8:00 am - 5:00 pm<br \>Sunday: Closed</h4>
                    <?php
                    if (isset($_POST['email_send'])) {

                        // validate a Name
                        if (!preg_match('/^(?=.{2,40}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/', trim($_POST['name']))) {
                            echo '<p>Please enter your name or initials - ' . $_POST['name'] . ' is a not valid entry</p>';
                            unset($_POST['name']);
                        } else {
                            $name = trim($_POST['name']);
                        }
                        // validate an email address
                        if (!preg_match('/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i', trim($_POST['email']))) {
                            echo '<p>You have entered and invalid email address - ' . $_POST['email'] . ' is a not valid entry</p>';
                            unset($_POST['email']);
                        } else {
                            $email = trim($_POST['email']);
                        }

                        // validate a phone number
                        if (!preg_match('/(?:1-?)?(?:\(\d{3}\)|\d{3})[-\s.]?\d{3}[-\s.]?\d{4}/', trim($_POST['phone']))) {
                            echo '<p>Please enter a valid phone number - ' . $_POST['phone'] . ' is a not valid entry</p>';
                            unset($_POST['phone']);
                        } else {

                            $phone = trim($_POST['phone']);
                        }

                        // check for call back request
                        if (!empty($_POST['call'])) {
                            $call = $_POST['call'];
                        } else {
                            $call = $_POST['call'] = 'No';
                        }

                        // Select type of message - validate?
                        $type = $_POST['type'];

                        // validate a message
                        //if (!preg_match("/^[a-zA-Z\s\d\.\,\'\!\?]+$/i", trim($_POST['message']) ) ) {
                        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                        if (empty($message)) {
                            echo '<p>Please enter a valid message</p>';
                            unset($_POST['message']);
                            unset($message);
                        } else {
                            $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                            #$message = htmlentities($message, ENT_QUOTES | ENT_IGNORE, "UTF-8");
                            $message = htmlentities($message, ENT_QUOTES | ENT_IGNORE, "UTF-8");
                        }
                    }
                    if (isset($_POST['email_send']) && !empty($name) && !empty($message) && !empty($email) && !empty($phone)) {
                        /*
                          $formcontent = " From: $name \n Phone: $phone \n Call Back: $call \n Type: $type \n Message: $message";
                          $recipient = "contactus@salonjimbotts.com";
                          $subject = "Contact Form";
                          $mailheader = "From: $email \r\n";
                          mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
                         * 
                         */
                        include('../includes/mailer.php'); //TODO: sending email is currently broken (kind of on purpose)
                        ?>
                        <h1>Thank You For Your Inquiry</h1>
                        <h2>We have received the following information:</h2>

                        <p>Your Name: <?php echo $name; ?></p>
                        <p>Email: <?php echo $email; ?></p>
                        <p>Phone: <?php echo $phone; ?></p>
                        <p>Call You?: <?php echo $call; ?></p>
                        <p>Reason: <?php echo $type; ?></p>
                        <p>Message: <?php echo /* $message; */ $_POST['message']; ?></p>

                        <h3>We will review your message as soon as possible.
                            <br />
                            Call us or stop by the shop for immediate service.<br/>
                            <a href="/directions/">Click here for directions to our location</a>.
                        </h3>
                        <p/>

                    <?php } else {
                        ?>
                        <?php
                        if (isset($_POST['email_send'])) {
                            ?>
                            <h2>Your message was not received.
                                <br />You need to give us more to go on. Try again?
                            </h2>
                        <?php } ?>                                                          
                        <form id="contact-form" action="#emailsent" method="POST">
                            <p>Name: <input type="text" name="name" pattern="^[a-zA-Z ]{2,30}$" size="30" required = "required"  placeholder="Your Name is..." value="<?php
                                if (isset($name)) {
                                    echo $name;
                                }
                                ?>"> </p>
                            <p>Email: <input type="email" name="email" size="30" required = "required" placeholder="Email address is Required" value="<?php
                                if (isset($email)) {
                                    echo $email;
                                }
                                ?>"> </p>
                            <p>Phone: <input type="tel" name="phone" pattern = "(?:1-?)?(?:\(\d{3}\)|\d{3})[-\s.]?\d{3}[-\s.]?\d{4}" size="30" required = "required" placeholder="Phone number is Required" value="<?php
                                         if (isset($phone)) {
                                             echo $phone;
                                         }
                                         ?>"> </p>

                            <p>Check Here to Request a Phone Call from us:&nbsp;
                                <input type="checkbox" name="call" value="Yes" <?php if (isset($call) == "Yes") { ?> checked="checked" <?php } ?>>&nbsp;&nbsp;
                                    <br />

                                    <p>Reason for contacting us: <br />
                                        <select name="type" required="required" size="1">
                                            <option value="" <?php if (!isset($type) || empty($type)) { ?> selected="selected" <?php } ?>>Choose One...</option>
                                            <option value="customer" <?php if (isset($type) == "customer") { ?> selected="selected" <?php } ?>>I have a question about products I purchased already</option>
                                            <option value="new_business" <?php if (isset($type) == "new_business") { ?> selected="selected" <?php } ?>>I want to buy tile from you and have something to ask</option>
                                            <option value="issue" <?php if (isset($type) == "issue") { ?> selected="selected" <?php } ?>>I have a problem maybe you can help with...</option>
                                            <option value="other" <?php if (isset($type) == "other") { ?> selected="selected" <?php } ?>>I just want to say hi!</option>

                                        </select>
                                    </p>
                                    <p>Enter the Details of Your Message Below:</p>
                                    <textarea name="message" rows="6" cols="65" required = "required" placeholder="Your Message goes here (required)..."><?php
                                    if (isset($message)) {
                                        echo $message;
                                    }
                                    ?></textarea>
                                    <br />
                                    <input name="email_send" id="email_send" type="submit" value="Contact Your Business Name ">
                                        </form>
                                    <?php } ?>

                                    </div>
                                    <div id="foot-pad">
                                        <div class="shadow-purple"></div>
                                        <img src="../images/foot-pad.png" alt="" height="46" width="990" />
                                    </div>
                                    </div>
<?php include ('../template/page_footer.php'); ?>
                                    </div>   
                                    </body>
                                    </html>
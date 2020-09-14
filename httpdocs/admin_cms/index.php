<?php
session_start();
session_destroy(); // clear $_SESSION[]'s
session_start();
/* // GET THESE SESSION VARIABLES FROM LOGIN PAGE */

//CHECK LOGIN NAME AND PASSWORD
if (isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['pass'])) {
    // CHECK USERNAME / PASSWORD COMBINATION MATCH 
    include_once '../includes/config_setup.php';

    // CHECK LOGIN TYPE AND REDIRECT TO CORRECT PAGE(S)...
    // must build a login / password table for multiple logins with various user types...
            // $STH = $DBH->prepare('
            // SELECT username, password, access_rights 
            // FROM 
            //         login                    
            // WHERE
            //         username = ?
            //         and password = ?  
            //     ');

    // $STH->bindParam(1, $_POST['user']);
    // $STH->bindParam(2, $_POST['pass']);

    $STH = $DBH->prepare('
    SELECT username, password, access_rights 
    FROM 
            login                    
    WHERE
            username = ?
        ');

    $STH->bindParam(1, $_POST['user']);
    $STH->execute();
    $STH->setFetchMode(PDO::FETCH_ASSOC);

    $result1 = $STH->fetch();
    $row_login = $result1;

// Check for login errors
    if (!$result1) { //TODO: Clean up user login security to prevent Brute Force attempts
//        echo $query_builder1;
        // echo $db->errorMsg();
        echo '<script> alert("No user by that name. Repeated login failures will result in your IP being banned."); </script>';
    }


    $username = $row_login['username'];
    // $password = $row_login['password'];
    $password = $_POST['pass'];
    $hashedPassword = $row_login['password'];

    //check hashed password against what user entered
    function verify($password, $hashedPassword) {
        // return crypt($password, $hashedPassword) == $hashedPassword;
        $verify = password_verify($password, $hashedPassword);
        return (int)$verify;
    }
    $passwordIsValid = (int)verify($password, $hashedPassword);

    // if ( $_POST['user'] == $username && $_POST['pass'] == $password && !empty($row_login['access_rights']) ) {
    if ( $_POST['user'] == $username && $passwordIsValid && !empty($row_login['access_rights']) ) {        
        // 'access_rights' options are: admin | publisher | editor
    
        // redirect to Selector page before the home page
        //$_SESSION['user_current'] = $username;
        //$_SESSION['user_current'] = $_POST['user'];
        $_SESSION['user_current'] = $row_login['access_rights'];
        header('Location: home-admin.php');
        // Include connection
        include('../includes/jmcms_db_conn_cms.php');
    } else {
        $failed_logins = 0;
        // Include connection
        include('../includes/jmcms_db_conn_cms.php');
    }
}
?>

<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>JMicrositeCMS - Admin Login</title>
        <meta name="robots" content="noindex, nofollow" />
        <?php if (isset($_GET['fail'])) {
            ?>
            <script language="javascript" type="text/javascript">
                var failed_logins = '<?php echo $_GET['fail']; ?>';
                if (failed_logins !== 0) {
                    alert('Username / Password combination is incorrect! Try Again!');
                }
            </script>
        <?php } ?>
    </head>

    <body>
        <div id="admin-console">
            <h1>JMicrositeCMS - Admin Login</h1>
            <form action="" method="POST">

                <label for="user">Username:</label>
                <input type="text" name="user"/>

                <label for="pass">Password:</label>
                <input type="password" name="pass"/>
                <br />       
                <input type="submit" name="submit" id="button" value="Submit" />

            </form>

            <div id="footer">
                <pre>JMicrositeCMS Content Management System - v0.3 beta</pre>
            </div>
        </div>
    </body>
</html>

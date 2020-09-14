<?php 
/* advice from: 
https://alexwebdevelop.com/php-password-hashing/
https://www.youtube.com/watch?v=MCpyijK_XgE
*/
function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        // $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        // return crypt($password, $salt);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }
}

function verify($password, $hashedPassword) {
    // return crypt($password, $hashedPassword) == $hashedPassword;
    $verify = password_verify($password, $hashedPassword);
    return (int)$verify;
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Salty!</p>

        <?php
            if (isset($_POST['submit_salty'])) {
                $pass = $_POST['pass'];
            ?>      
                <p>Clear Text PASSWORD: <?php echo $pass;?></p>
                <p>HASH: <?php echo generateHash($pass); ?></p>
            <?php
            }
        ?>
        <form id='salty' name='salty' method='POST' action='#'>
            Password: <input id='pass' name='pass' type='text' value='<?php if (isset($pass)) {echo $pass;}?>' />
            <br />
            <input id='submit_salty' name='submit_salty' type='submit' value='Send It!' />
        </form>                  

        <p>UN Salty!</p>

        <?php
            if (isset($_POST['submit_unsalty'])) {
                
                $hash = $_POST['hash'];
                $pass = $_POST['pass'];
            
        //PASSWORD: <?php echo verify($pass, generateHash($pass)); 
        ?>
                <hr /><hr /><hr />              
                <p>Clear Text PASSWORD: <?php echo $pass;?></p>
                <p>HASH: <?php echo generateHash($pass); ?></p>
                <p>STATUS of PASSWORD: <?php echo verify($pass, $hash);?></p>
                <p>matching is: <?php echo verify($pass, generateHash($pass));?></p>
            <?php
            }
        ?>                
        <form id='unsalty' name='unsalty' method='POST' action='#'>            
            HASH: <input id='hash' name='hash' type='text' value='<?php if (isset($hash)) {echo $hash;}?>' />
            <br />
            Password: <input id='pass' name='pass' type='text' value='<?php if (isset($pass)) {echo $pass;}?>' />
            <br />
            <input id='submit_unsalty' name='submit_unsalty' type='submit' value='Send It!' />
        </form>  
                
    </body>
</html>

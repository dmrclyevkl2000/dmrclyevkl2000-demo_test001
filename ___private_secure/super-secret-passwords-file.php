<?php //include with "./includes/config_setup.php"
/*****#####     BEGIN DB Credentials     #####*****/
/* PDO reference variables for /includes/config_setup.php are below 
    $PDO_host       = '127.0.0.1';
    $PDO_port       = '3306';
    $PDO_dbname     = 'jmicrocms';
    $PDO_charset    = 'utf8mb4';

    $PDO_dbuser       = "jmicrocms";
    $PDO_dbpass       = '$secret_db_password';
*/
$secret_db_hostname     = '172.20.0.10';
$secret_db_portnumber   = '3306';
$secret_db_name         = 'jmcms_kswt';
$secret_db_charset      = 'utf8mb4';

$secret_db_username     = 'jmcms_kswt';
$secret_db_password     = '@bC111!!!';
/*****#####     END DB Credentials     #####*****/
/*****######################################*****/
/*****#####     BEGIN Set Environment     #####*****/
$server_mode = 'development'; //Development
// $server_mode = 'staging'; //Staging
// $server_mode = 'production'; //Production
// IMPORTANT: The Environment MUST BE SET!
/*****#####     END Set Environment     #####*****/
/*****#######################################*****/


?>
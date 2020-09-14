<?php //config_setup.php 
/* BEGIN DO NOT TOUCH BLOCK */
// DO NOT EDIT THIS BLOCK UNLESS YOU KNOW WHAT YOU ARE DOING!!
##### !!!// EXTREMELY IMPORTANT!!!: Include Path/File below contains sensitive data! 
##### !!!// Exclude `/___private_secure/` from repo for security purposes 
//TODO: Create "Getting Started" Docs & reference link here to show repo users how to configure
#include $_SERVER ['DOCUMENT_ROOT'] . '/../___private_secure/super-secret-passwords-file.php'; 
require_once $_SERVER ['DOCUMENT_ROOT'] . '/../___private_secure/super-secret-passwords-file.php'; 

        if (extension_loaded('zlib')) { 
                ob_end_clean(); 
                ob_start('ob_gzhandler'); 
        } 
        else {
            ob_end_clean(); 
            ob_start(); 
        }
//ob_start('ob_gzhandler'); //needed when output_buffer setting is not defined in php.ini (also 'ob_gzhandler' speeds up page on GZIP enabled host!);        

/* END DO NOT TOUCH BLOCK */        
        
// Create a date/time for the session 
date_default_timezone_set('America/New_York');
$_SESSION['date_current'] = $date_current = date("m/d/y g:i:s a");


//////////////////////////////////////////////////////////////////////////
// Set The Environment (eg error reporting, database connections, etc)
// Reference: https://phpdelusions.net/pdo#dsn
//TODO: automate $server_mode once product is more stable
// ^^^ Set Environment in 'super-secret-passwords-file.php' with $server_mode variable for now
// $server_mode = 'development'; //Development
// $server_mode = 'staging'; //Staging
// $server_mode = 'production'; //Production
//////////////////////////////////////////////////////////////////////////
if ( $server_mode == 'development' ) { 
    error_reporting(E_ALL & E_DEPRECATED & E_STRICT);
    ini_set('display_errors', '1');    
} else if ( $server_mode == 'staging' ) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');    
} else if ( $server_mode == 'production' ) {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');    
}

// Connect PDO to database, based on parameters set above STILL TESTING - REMOVE User/Pass in Production!
//TODO: Tokenization for DB Handler credentials
try {
    # MySQL with PDO_MYSQL
    $PDO_host       = $secret_db_hostname;
    $PDO_port       = $secret_db_portnumber;
    $PDO_dbname     = $secret_db_name;
    $PDO_charset    = $secret_db_charset;

    $PDO_dbuser     = $secret_db_username;
    $PDO_dbpass     = $secret_db_password;    
    // $DBH = new PDO("mysql:host=$PDO_host;port=$PDO_port;dbname=PDO_dbname;charset=$PDO_charset", '$PDO_dbuser', $PDO_dbpass);    
    $PDO_DSN = "mysql:host=$PDO_host;port=$PDO_port;dbname=$PDO_dbname;charset=$PDO_charset;";
    $DBH = new PDO($PDO_DSN, $PDO_dbuser, $PDO_dbpass);

    //  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
    //  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // PDO::FETCH_ASSOC: returns an array indexed by column name
    // PDO::FETCH_BOTH (default): returns an array indexed by both column name and number
    // PDO::FETCH_BOUND: Assigns the values of your columns to the variables set with the ->bindColumn() method
    // PDO::FETCH_CLASS: Assigns the values of your columns to properties of the named class. It will create the properties if matching properties do not exist
    // PDO::FETCH_INTO: Updates an existing instance of the named class
    // PDO::FETCH_LAZY: Combines PDO::FETCH_BOTH/PDO::FETCH_OBJ, creating the object variable names as they are used
    // PDO::FETCH_NUM: returns an array indexed by column number
    // PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names
} catch (\PDOException $e) {
    if ($server_mode === 'production') {echo '<pre>Database Connection Error</pre>';} #SAFEEST TO USE IN PRODUCTION
    if ($server_mode === 'staging') {throw new \PDOException($e->getMessage(), (int)$e->getCode());} #SAFER TO USE (Staging); Reveals DB name, user, host, port
    if ($server_mode === 'development') {throw $e;} #DO NOT USE ON PRODUCTION. WILL REVEAL DB CREDENTIALS ON CONNECTION ERROR EXCEPTION
}

//set by above config conditional!
	include_once 'data_functions.php';




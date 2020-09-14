<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
<title>Untitled Document</title>
</head>

<body>
<?php
phpinfo();
echo "Operating System is: " . php_uname('s') . " <br />";

echo php_uname('s');/* Operating system name */ 
echo "<br />"; 
echo php_uname('n');/* Host name */ 
echo "<br />"; 
echo php_uname('r');/* Release name */ 
echo "<br />"; 
echo php_uname('v');/* Version information */ 
echo "<br />"; 
echo php_uname('m');/* Machine type */ 
echo "<br />"; 
echo PHP_OS;/* constant will contain the operating system PHP was built on */ 

echo "<br />"; 
echo "<pre><pre>";/* format the dump of php.ini */ 

// directory path can be either absolute or relative
if (php_uname('s') == 'Linux') {
    echo file_get_contents("/opt/lampp/etc/php.ini");

    $dirPath = "/opt/lampp/etc/";
    $php_ini_path = "/opt/lampp/etc/php.ini";
}
else {
/*    
    echo file_get_contents("C:\\Program Files (x86)\\PHP\\php.ini");

    $dirPath = "C:\\Program Files (x86)\\PHP\\";
    $php_ini_path = "C:\\Program Files (x86)\\PHP\\php.ini";
*/
    echo file_get_contents("D:\\xampp\\PHP\\php.ini");

    $dirPath = "D:\\xampp\\php\\";
    $php_ini_path = "D:\\xampp\\php\\php.ini";
        
    //zlib.output_compression
}
// open the specified directory and check if it's opened successfully
if ($handle = opendir($dirPath)) {

   // keep reading the directory entries 'til the end
   while (false !== ($file = readdir($handle))) {

      // just skip the reference to current and parent directory
      if ($file != "." && $file != "..") {
         if (is_dir("$dirPath/$file")) {
            // found a directory, do something with it?
            echo "[$file]<br>";
         } else {
            // found an ordinary file
            echo "$file<br>";
         }
      }
   }

   // ALWAYS remember to close what you opened
   closedir($handle);
   
}
include($php_ini_path);
echo "</pre></pre>";/* format the dump of php.ini */ 
?>
</body>
</html>
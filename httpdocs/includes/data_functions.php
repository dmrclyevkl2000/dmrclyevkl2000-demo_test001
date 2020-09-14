<?php

function Get_Field($Work_Data) {
	if (isset($_POST[$Work_Data])) {
		$New_Data = $_POST[$Work_Data];
	} elseif (isset($_GET[$Work_Data])) {
		$New_Data = $_GET[$Work_Data];
	} else {
		$New_Data = "";
	}
	
	return($New_Data);
}
// keep for "default" DB connections...
function Prep_Data($Work_Data) {
	global $DB;
	
	$New_Data = $DB->qstr(trim($Work_Data));
	$New_Data = substr($New_Data, 1, strlen($New_Data)-2);
	
	return($New_Data);
}
// added for numbered DB connections...
function Prep_Data_y($Work_Data, $DB) {
	//global $DB;
	
	$New_Data = $DB->qstr(trim($Work_Data));
	$New_Data = substr($New_Data, 1, strlen($New_Data)-2);
	
	return($New_Data);
}
// added for PDO and numbered DB connections...
function Prep_Data_x($Work_Data, $DB) {
	//global $DB;
	
	// $New_Data = $DB->qstr(trim($Work_Data));
	$New_Data = $DB->quote(trim($Work_Data));
	$New_Data = substr($New_Data, 1, strlen($New_Data)-2);
	
	return($New_Data);
}
function Show_Data($Work_Data) {
	$New_Data = htmlspecialchars(stripslashes($Work_Data));
	
	return($New_Data);
}

function Title_Case($Work_Data) {
	$New_Data = htmlspecialchars(ucwords(strtolower($Work_Data)));
	
	return($New_Data);
}

function Show_Text($Work_Data) {
	$New_Data = htmlspecialchars(stripslashes($Work_Data));
	$New_Data = nl2br($New_Data);
	
	return($New_Data);
}

function Show_Date($Work_Date) {
	if ($Work_Date == "0000-00-00" || $Work_Date == "") {
		$New_Date = "";
	} else {
		$New_Date = date("m/d/Y", strtotime($Work_Date));
	}
	
	return($New_Date);
}

function Show_Text_Date($Work_Date) {
	if ($Work_Date == "0000-00-00") {
		$New_Date = "";
	} else {
		$New_Date = date("F jS, Y", strtotime($Work_Date));
	}
	
	return($New_Date);
}

function Show_Date_Time($Work_Date) {
	if ($Work_Date == "0000-00-00 00:00:00") {
		$New_Date = "";
	} else {
		$New_Date = date("m/d/Y @ g:i A", strtotime($Work_Date));
	}
	
	return($New_Date);
}

function Show_Time($Work_Date) {
	if ($Work_Date == "0000-00-00 00:00:00") {
		$New_Date = "";
	} else {
		$New_Date = date("g:i A", strtotime($Work_Date));
	}
	
	return($New_Date);
}

function Prep_Checkbox($Work_Data) {
	if ($Work_Data == "1") {
		$New_Data = "1";
	} else {
		$New_Data = "0";
	}
	
	return($New_Data);
}

function Prep_Date($Work_Date) {
	if (strlen($Work_Date) > 1) {
		$New_Date = date("Y-m-d", strtotime($Work_Date));
	} else {
		$New_Date = "0000-00-00";
	}
	
	return($New_Date);
}

function Prep_Date_Time($Work_Date) {
	if (strlen($Work_Date) > 1) {
		$Work_Date   = str_replace("-", "/", $Work_Date);
		$Work_Date   = str_replace("@", "", $Work_Date);
		$New_Date  	= date("Y-m-d H:i:s", strtotime($Work_Date));
	} else {
		$New_Date = "0000-00-00 00:00:00";
	}
	
	return($New_Date);
}

function Truncate($Work_Data, $Work_Len) {
	$New_Data = $Work_Data;

	if (strlen($New_Data) > $Work_Len) {
		$New_Data   = substr($New_Data,0,$Work_Len);
		$Find_Space = strrpos($New_Data, " ");
		$New_Data   = substr($New_Data,0,$Find_Space) . "...";
	}
	
	return($New_Data);
}

function md5_encrypt($plain_text, $password, $Encrypt_Key) {
   $iv_len = 16;
   $plain_text .= "\x13";
   $n = strlen($plain_text);
   if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
   $i = 0;
   $enc_text = get_rnd_iv($iv_len);
   $iv = substr($password ^ $enc_text, 0, 512);
   while ($i < $n) {
       $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
       $enc_text .= $block;
       $iv = substr($block . $iv, 0, 512) ^ $password;
       $i += 16;
   }
   return base64_encode($enc_text);
}

function md5_decrypt($enc_text, $password, $Encrypt_Key) {
   $iv_len = 16;
   $enc_text = base64_decode($enc_text);
   $n = strlen($enc_text);
   $i = $iv_len;
   $plain_text = '';
   $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
   while ($i < $n) {
       $block = substr($enc_text, $i, 16);
       $plain_text .= $block ^ pack('H*', md5($iv));
       $iv = substr($block . $iv, 0, 512) ^ $password;
       $i += 16;
   }
   return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}

function get_rnd_iv($iv_len) {
   global $Encrypt_Key;
   
   $iv = '';
   
   while ($iv_len-- > 0) {
       $max_rand = mt_rand(0, 255);
       $iv .= chr($max_rand & 0xff);
   }

   return $iv;
}

function Get_XML_Error_Code($XML_Reply) {
	$Find_Err = strpos($XML_Reply, "<returncode>")+12;
	$Err_Code = substr($XML_Reply, $Find_Err, 1);
	
	return $Err_Code;
}

function Get_XML_Error_Msg($XML_Reply) {
	$Find_Text_B = strpos($XML_Reply, "<comments>")+10;
	$Find_Text_E = strpos($XML_Reply, "</comments");
	$Find_Len    = $Find_Text_E - $Find_Text_B;
	$Err_Msg 	 = substr($XML_Reply, $Find_Text_B, $Find_Len);
	
	return $Err_Msg;
}

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'getPagesData' : getPagesData();break;
        // ...etc...
    }
}
function getPagesData() {
	include_once 'config_setup.php'; //SMELLY, but it works (for now)
    # MySQL DB HANDLER
    // global $DBH;
    $STH = $DBH->prepare('SELECT * 
                FROM 
                        content                    
                WHERE
                        id is not null
                ORDER BY content_date DESC');
    $STH->execute();
    $STH->setFetchMode(PDO::FETCH_ASSOC);

	$result1 = $STH->fetchAll();	
    //JSON OBJ FROM PDO
	$json_result1 = json_encode($result1);
	// DEBUGGING
	// echo '<pre><pre> getPagesData result1: ' . print_r($result1, 1 ) . '<pre><pre>';
    // echo '<pre><pre> ' . $json_result1 . '<pre><pre>';
    return $json_result1;
}
########################################
# close the connection
function closePDO($DBH) {
    $DBH = null;    
}


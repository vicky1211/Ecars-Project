<?php
//error_reporting(0);
ob_start();
session_start();


//DEFINE("BASE_URL","http://cipetbhopal.com/");
//DEFINE("BASE_URL","http://localhost/oes/");

DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD',''); 
DEFINE ('DB_HOST','localhost'); 
DEFINE ('DB_NAME','ecars'); 

/*
DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD',''); 
DEFINE ('DB_HOST','localhost'); 
DEFINE ('DB_NAME','tp'); 
*/
date_default_timezone_set('Asia/Calcutta'); 
$conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if($conn->connect_error)
die("Failed to connect database ".$conn->connect_error );



function money_format($money){
    $len = strlen($money);
    $m = '';
    $money = strrev($money);
    for($i=0;$i<$len;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
            $m .=',';
        }
        $m .=$money[$i];
    }
    return strrev($m);
}
?>
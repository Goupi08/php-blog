<?php 
ob_start();
session_start();

$dbhost    = 'localhost'; 
$dbuser    = 'root'; 
$dbpass    = ''; 
$dbname    = 'test'; 
$table    = 'chat_daten'; 
$conn=mysqli_connect($dbhost, $dbuser,$dbpass); 
mysqli_select_db($conn,$dbname); 
?>
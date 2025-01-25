<?php

$servername= "localhost";
$name = 'root';
$password = '';
$db_name = 'feedEat';

$conn = new mysqli($servername, $name, $password, $db_name);
if($conn-> connect_error){
    die("Connection failed".$conn-> connect_error);
}
session_start();
//echo "Connection success";

?>
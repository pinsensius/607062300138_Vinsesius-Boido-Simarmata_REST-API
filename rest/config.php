<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'basasunda';

$conn = mysqli_connect($server, $user, $pass, $db);
if(!$conn){
    die('Connection error: '. mysqli_connect());
}
?>
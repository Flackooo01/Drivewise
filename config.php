<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "";
$database = "lto_db";

$con = mysqli_connect($server, $user, $pass, $database);

if(!$con){
    echo "Connection failed";
}

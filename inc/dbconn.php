<?php

$host="localhost";
$username="root";
$password="";
$dbname="api";

$conn=mysqli_connect($host,$username,$password,$dbname);

if(!$conn){
    die("Connection faield:".mysqli_connect_error());
}


?>
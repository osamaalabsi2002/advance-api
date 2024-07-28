<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="form";

$conn= mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo"connect is felid";
}else{
    echo"connect is sucsseful";
}




?>
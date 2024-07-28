<?php




include 'conndb.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=  $conn->real_escape_string($_POST['name']) ;
$email= $conn->real_escape_string($_POST['email']) ;

$password=password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
$sql="INSERT INTO superuser (name, email,password) VALUES('$name','$email','$password')";
if($conn->query($sql)===TRUE){
    exit();


}}
$conn->close();
?>
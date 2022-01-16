<?php
include 'db_connection.php';

$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];

$sql="INSERT INTO message(name, email, subject, message) VALUES ('$username','$email','$subject','$message')";
if($conn->query($sql) ==true){
  echo 1;
}else{
  echo 0;
}
?>
<?php
include 'db_connection.php';
session_start();
if (!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='index.php'; </script>";
}
if (isset($_POST['order_id']) && isset($_POST['student_email']) && isset($_POST['course_name']) && isset($_POST['amount'])) {    
    $order_id = $_POST["order_id"];
    $stu_email = $_POST['student_email'];
    $course_id = $_SESSION['course_id'];
    $status = 'yes';
    $respmsg = "payment successfully";
    $amount = $_POST['amount'];
    $date = date("Y-m-d");
     $sql="INSERT INTO courseorder(order_id, stu_email, course_id, status, respmsg, amount, order_date) VALUES ('$order_id','$stu_email','$course_id','$status','$respmsg','$amount','$date')";
    if ($conn->query($sql) == true) {
      echo true;
    }else{
      echo false;
    }
  }
  ?>
<?php
 if (!isset($_SESSION)) {
  session_start();
 }

include '../db_connection.php';
//Checking Email Already Registerted
if (isset($_POST['checkmail']) && isset($_POST['stuemail'])) {
  $stuemail = $_POST['stuemail'];
  $sql = "SELECT stu_email FROM student WHERE stu_email='$stuemail'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
}
//Insert Student
if (isset($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass'])) {
  $stuname = ucwords($_POST['stuname']);
  $stuemail = $_POST['stuemail'];
  $stupass = $_POST['stupass'];
  $sql = "INSERT INTO student(stu_name, stu_email, stu_pass,stu_img) VALUES ('$stuname','$stuemail','$stupass','../image/stu/man.png')";
  if ($conn->query($sql) == true) {
    echo json_encode("OK");
  } else {
    echo json_encode("Failed");
  }
}
// Student login verification
if (!isset($_SESSION['is_login'])) {
  if (isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass']) && isset($_POST['checkLogemail'])) {
    $stuLogEmail = $_POST['stuLogEmail'];
    $stuLogPass = $_POST['stuLogPass'];
    $sql2 = "SELECT stu_email, stu_pass FROM student WHERE stu_email='$stuLogEmail' AND stu_pass='$stuLogPass'";
    $result = $conn->query($sql2);
    $row = $result->num_rows;
    if ($row === 1) {
      $_SESSION['is_login'] = true;
      $_SESSION['stuLogEmail'] = $stuLogEmail;
      echo json_encode($row);
    } else if ($row === 0) {
      echo json_encode($row);
    }
  }
}

<?php
include_once '../db_connection.php';
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['is_login'])) {
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php';</script>";
}
if (isset($stuLogEmail)) {
  $sql = "SELECT stu_img FROM student WHERE stu_email='$stuLogEmail'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $stu_img = $row['stu_img'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Google Font Link -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- External CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <input type="checkbox" id="sidebar-toggle">
  <div class="sidebar">
    <div class="sidebar-header">
      <h3 class="brand">
        <span class="ti-unlink"></span>
        <span><a href="student.php" class="navbar-brand">iSchool</a></span>
      </h3>
      <label for="sidebar-toggle" class="ti-menu-alt" id="toggle"></label>
    </div>
    <div class="sidebar-menu">
      <ul id="active_nav">
        <li>
          <img src="<?php echo $stu_img ?>" style="width: 100%; border-radius:50% ;border: 1px solid #ddd;padding: 5px;" alt="Profile">
        </li>
        <li>
          <a href="studentProfile.php">
            <i class="fas fa-user"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="myCourse.php">
            <i class="fas fa-calendar-alt"></i>
            <span>My Courses</span>
          </a>
        </li>
        <li>
          <a href="stufeedback.php">
            <i class="fas fa-comments"></i>
            <span>Feedback</span>
          </a>
        </li>
        <li>
          <a href="studentChangePass.php">
            <i class="fas fa-key"></i>
            <span>Change Password</span>
          </a>
        </li>
        <li>
          <a href="../logout.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="main-content">
    <header>
      <div class="search-wrapper">
        <span class="ti-search"></span>
        <input type="search" placeholder="Search">
      </div>

      <div class="social-icons">
        <span class="ti-bell"></span>
        <span class="ti-comment"></span>
        <div></div>
      </div>
    </header>
    <script>
      const currentLocation = location.href;
      const menuItem = document.querySelectorAll('#active_nav li a');
      const menuLength = menuItem.length;
      for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
          menuItem[i].className = "active";
        }

      }
    </script>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['is_admin_login'])) {
  $adminEmail=$_SESSION['adminLogEmail'];
}else{
 echo "<script> location.href='../index.php'; </script>";
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
  <!-- Sidebar Section Start -->
  <input type="checkbox" id="sidebar-toggle">
  <div class="sidebar">
    <div class="sidebar-header">
      <h3 class="brand">
        <span class="ti-unlink"></span>
        <span><a href="admin_dashboard.php" class="logo">iSchool</a></span>
      </h3>
      <label for="sidebar-toggle" class="ti-menu-alt" id="toggle"></label>
    </div>

    <div class="sidebar-menu">
      <ul>
        <li>
          <a href="admin_dashboard.php">
            <span class="ti-home"></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="courses.php">
            <i class="fas fa-calendar-alt"></i>
            <span>Courses</span>
          </a>
        </li>
        <li>
          <a href="lesson.php">
            <i class="fas fa-calendar-alt"></i>
            <span>Lessons</span>
          </a>
        </li>
        <li>
          <a href="students.php">
            <i class="fas fa-users"></i>
            <span>Students</span>
          </a>
        </li>
        <li>
          <a href="sellReport.php">
            <i class="fas fa-calendar-check"></i>
            <span>Sell Reports</span>
          </a>
        </li>
        <li>
          <a href="paymentstatus.php">
            <i class="fas fa-shopping-bag"></i>
            <span>Payment Status</span>
          </a>
        </li>
        <li>
          <a href="feedback.php">
            <i class="fas fa-comments"></i>
            <span>Feedback</span>
          </a>
        </li>
        <li>
          <a href="adminChangePassword.php">
            <i class="fas fa-key"></i>
            <span>Change Password</span>
          </a>
        </li>
        <li>
          <a href="contact.php">
            <i class="fas fa-envelope    "></i>
            <span>Contact</span>
          </a>
        </li>
        <li>
          <a href="settings.php">
          <i class="fas fa-cog"></i>
            <span>Settings</span>
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
  <!-- Sidebar Section End -->
  <!-- Top Header Section Start -->
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
    <!-- Top Header Section End -->
    <script>
      const currentLocation = location.href;
      const menuItem = document.querySelectorAll('.sidebar-menu ul li a');
      const menuLength = menuItem.length;
      for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
          menuItem[i].className = "active";
        }

      }
    </script>
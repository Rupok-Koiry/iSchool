<!Doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Google Font Link -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- Slider Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- External  CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
  <?php
    include_once 'db_connection.php';
    $sql2="SELECT * FROM settings";
    $result2 = $conn->query($sql2); 
    $row2 = $result2->fetch_assoc();
  ?>
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark px-5 fixed-top">
    <a class="navbar-brand" href="index.php"><?php echo $row2['logo'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav custom-nav ml-auto text-md-left text-center">
        <li class="nav-item custom-nav-item active">
          <a class="nav-link" href="index.php">Home </a>
        </li>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="courses.php">Courses</a>
        </li>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="payment_status.php">Payment Status</a>
        </li>
        <?php
        session_start();
        if (isset($_SESSION['is_login'])) {
        ?>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="studentProfile.php">My Profile</a>
        </li>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php  }else{?>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#login_modal">Login</a>
        </li>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#registration_modal">Signup</a>
        </li>
        <?php }?>
        <li class="nav-item custom-nav-item">
          <a class="nav-link" href="#container-contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- End Navigation -->
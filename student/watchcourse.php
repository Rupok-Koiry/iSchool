<?php
 include_once '../db_connection.php';
/*if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['is_login'])) {
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php';</script>";
}
echo $id= $_GET['course_id'];
$sql2 = "SELECT * FROM courseorder WHERE course_id = $id";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
if ($row2['stu_email'] != $_SESSION["stuLogEmail"]) {
  header("location:../index.php");
}
echo $row2['stu_email'];
echo $_SESSION["stuLogEmail"]; */

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Watch Course</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/watchcourse.css">
  <!-- Google Font Link -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
      <span class="ti-unlink" style="font-size: 28px;"></span>
        <a href="../index.php" class="navbar-brand">
          <h3>iSchool</h3>
        </a>
      </div>

      <ul class="list-unstyled components" id="playlist">
        <p>Watch Course</p>
        <?php
        if (isset($_GET['course_id'])) {
          $course_id = $_GET['course_id'];
          $sql = "SELECT * FROM lesson WHERE course_id=$course_id";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<li>
                      <a href="" movieurl=' . $row['lesson_link'] . '>' . $row['lesson_name'] . '</a>
                  </li>';
            }
          }else{
            echo '<li><p class="alert alert-info" style="color:black"> Lesson Will Be Added Soon...</p></li>';
          }
        }
        ?>
      </ul>

      <ul class="list-unstyled CTAs">
        <li>
          <a href="../index.php" class="download">Visit iSchool</a>
        </li>
        <li>
          <a href="../courses.php" id="article">Buy More Courses</a>
        </li>
      </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Toggle Sidebar</span>
          </button>
          <button class="btn btn-dark d-inline-block d-md-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <a href="myCourse.php" class="btn-danger btn toggle-course">My Profile</a>
            </ul>
          </div>
        </div>
      </nav>
      <div class="embed-responsive embed-responsive-21by9">
        <video src="" controls id="videoarea"></video>
      </div>

    </div>
  </div>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <!-- Custom JS -->
  <script src="../js/custom.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });
    });
    
    $('#playlist li a:first').addClass('active');
    $(function(){
    $('#playlist li a').click(function(){
        $('#playlist li a.active').removeClass('active');
        $(this).addClass('active');
    });
})
  </script>
</body>

</html>
<?php
include 'admin_include/header.php';
include '../db_connection.php';
if (isset($_REQUEST['newStuSubmitBtn'])) {
  //Checking for Empty Fields
  if (($_REQUEST['stu_name'] == '') || ($_REQUEST['stu_email'] == '') || ($_REQUEST['stu_pass'] == '') || ($_REQUEST['stu_occ'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All fields are required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Geeting all value from the input;
    $stu_name =ucwords($_REQUEST['stu_name']);
    $stu_email = $_REQUEST['stu_email'];
    $stu_pass = $_REQUEST['stu_pass'];
    $stu_occ =ucwords($_REQUEST['stu_occ']);
    $sql = "SELECT * FROM student WHERE stu_email='$stu_email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Email already exists
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {

      $sql = "INSERT INTO student(stu_name, stu_email, stu_pass, stu_occ) VALUES ('$stu_name','$stu_email','$stu_pass','$stu_occ')";
      if ($conn->query($sql) == true) {
        $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Student added successfully
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
      } else {
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Unable to add student
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
      }
    }
  }
}
?>
<main>

  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded p-3">
        <h3>Add New Student</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="stu_name">Student Name</label>
                  <input type="text" class="form-control" id="stu_name" name="stu_name">
                </div>
                <div class="form-group">
                  <label for="stu_email">Email</label>
                  <input type="email" class="form-control" id="stu_email" name="stu_email">
                </div>
                <div class="form-group">
                  <label for="stu_pass">Password</label>
                  <input type="password" class="form-control" id="stu_pass" name="stu_pass">
                  <small class="text-info">Password character 8 or long recomended</small>
                </div>
                <div class="form-group">
                  <label for="stu_occ">Occupation</label>
                  <input type="text" class="form-control" id="stu_occ" name="stu_occ">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="newStuSubmitBtn" name="newStuSubmitBtn">Submit</button>
                  <a href="students.php" class="btn btn-danger ml-2">Close</a>
                </div>
              </form>
              <?php
              if (isset($msg)) {
                echo $msg;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'admin_include/footer.php' ?>
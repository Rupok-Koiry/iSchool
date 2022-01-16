<?php
include 'student_include/header.php';
if (isset($_REQUEST['stuPassUpdateBtn'])) {
  //Checking password is not null;
  if (($_REQUEST['input_new_password'] == '') || ($_REQUEST['input_confirm_password'] == '')) {
    $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">All fileds are required
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';//password length checking
  } else if (strlen($_REQUEST['input_new_password']) < 8) {
    $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Password length must be 8 character or long
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';//new password = confirm password checking
  } else if ($_REQUEST['input_new_password'] != $_REQUEST['input_confirm_password']) {
    $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Password didn\'t match
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  } else {
    $sql = "SELECT * FROM student WHERE stu_email='$stuLogEmail'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $stuPass = $_REQUEST['input_new_password'];
      $sql = "UPDATE student SET stu_pass='$stuPass' WHERE stu_email='$stuLogEmail'";
      if ($conn->query($sql) == true) {
        $passmsg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Passowrd updated successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      } else {
        $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Unable to update password
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
        <h3>Change Password</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="input_email">Email</label>
                  <input type="email" class="form-control" id="input_email" required name="input_email" readonly value="<?php echo $stuLogEmail ?>">
                </div>
                <div class="form-group">
                  <label for="input_new_password">New Password</label>
                  <input type="password" class="form-control" id="input_new_password" name="input_new_password">
                </div>
                <div class="form-group">
                  <label for="input_confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" id="input_confirm_password" name="input_confirm_password">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-danger mr-2" id="stuPassUpdateBtn" name="stuPassUpdateBtn">Update</button>
                  <button type="reset" class="btn btn-success ml-2" id="reset">Reset</button>
                </div>
              </form>
              <?php
              if (isset($passmsg)) {
                echo $passmsg;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'student_include/footer.php' ?>
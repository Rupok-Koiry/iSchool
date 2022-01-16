<?php
include 'admin_include/header.php';
include '../db_connection.php';
$adminEmail = $_SESSION['adminLogEmail'];
if (isset($_REQUEST['adminPassUpdateBtn'])) {
  if (($_REQUEST['input_new_password'] == '') || ($_REQUEST['input_confirm_password'] == '')) {
    $passmsg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Password fileds are mandatory
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  } else if ($_REQUEST['input_new_password'] != $_REQUEST['input_confirm_password']) {
    $passmsg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Password didn\'t match
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  } else {
    $sql = "SELECT * FROM admin WHERE admin_email='$adminEmail'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $adminPass = $_REQUEST['input_new_password'];
      $sql = "UPDATE admin SET admin_pass='$adminPass' WHERE admin_email='$adminEmail'";
      if ($conn->query($sql) == true) {
        $passmsg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Password updated successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }else{
        $passmsg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Unable to update password
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
                  <input type="email" class="form-control" id="input_email" name="input_email" readonly value="<?php echo $adminEmail?>">
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
                  <button class="btn btn-danger mr-2" id="adminPassUpdateBtn" name="adminPassUpdateBtn">Update</button>
                  <button type="reset" class="btn btn-success ml-2">Reset</button>
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
<?php include 'admin_include/footer.php' ?>
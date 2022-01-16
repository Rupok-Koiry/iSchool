<?php
include 'admin_include/header.php';
include '../db_connection.php';
// //Update
if (isset($_REQUEST['requpdate'])) {
  //Checking All filed is not empty
  if (($_REQUEST['stu_id'] == '') || ($_REQUEST['stu_name'] == '') || ($_REQUEST['stu_email'] == '') || ($_REQUEST['stu_pass'] == '') || ($_REQUEST['stu_occ'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All Fields are Required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Getting all value
    $sid = $_REQUEST['stu_id'];
    $sname =ucwords($_REQUEST['stu_name']);
    $semail = $_REQUEST['stu_email'];
    $spass = $_REQUEST['stu_pass'];
    $socc = ucwords($_REQUEST['stu_occ']);
    $sql2="UPDATE student SET stu_name='$sname',stu_email='$semail',stu_pass='$spass',stu_occ='$socc' WHERE stu_id=$sid";
    if ($conn->query($sql2) == true) {
      $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated successfully
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }else{
      $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Unable to Update
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }

    
   
  }
}
?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded p-3">
        <h3>Update Student</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <?php
              if (isset($_REQUEST['view'])) {
                $sql = "SELECT * FROM student WHERE stu_id = {$_REQUEST['eid']}";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
              }
              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="stu_id">Student Name</label>
                  <input type="text" class="form-control" id="stu_id" required name="stu_id" value="<?php if (isset($row['stu_id'])) {
                                                                                                    echo $row['stu_id'];
                                                                                                  } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="stu_name">Student Name</label>
                  <input type="text" class="form-control" id="stu_name" required name="stu_name" value="<?php if (isset($row['stu_name'])) {
                                                                                                    echo $row['stu_name'];
                                                                                                  } ?>">
                </div>
                <div class="form-group">
                  <label for="stu_email">Email</label>
                  <input type="email" class="form-control" id="stu_email" required name="stu_email" value="<?php if (isset($row['stu_email'])) {
                                                                                                    echo $row['stu_email'];
                                                                                                  } ?>">
                </div>
                <div class="form-group">
                  <label for="stu_pass">Password</label>
                  <input type="password" class="form-control" id="stu_pass" required name="stu_pass" value="<?php if (isset($row['stu_pass'])) {
                                                                                                    echo $row['stu_pass'];
                                                                                                  } ?>">
                </div>
                <div class="form-group">
                  <label for="stu_occ">Occupation</label>
                  <input type="text" class="form-control" id="stu_occ" required name="stu_occ" value="<?php if (isset($row['stu_occ'])) {
                                                                                                    echo $row['stu_occ'];
                                                                                                  } ?>">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="requpdate" name="requpdate">Submit</button>
                  <a href="students.php" class="btn btn-danger ml-2" >Close</a>
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
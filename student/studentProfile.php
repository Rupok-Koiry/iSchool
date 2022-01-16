<?php
include 'student_include/header.php';
if (isset($_SESSION['is_login'])) {
  $stuEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php';</script>";
}
if (isset($_REQUEST['updateStuNameBtn'])) {
  if ($_REQUEST['stuName'] == "") {
    $msg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Name field is required
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
  } else {
    $stu_id = $_REQUEST['stuId'];
    $stu_name = ucwords($_REQUEST['stuName']);
    $stu_occ =  ucwords($_REQUEST['stuOcc']);


    $stu_image = $_FILES['stuImg']['name'];
    $stu_image_tmp = $_FILES['stuImg']['tmp_name'];
    $img_folder = '../image/stu/' . $stu_image;
    //if student change image then old image will delete
    $sql2 = "SELECT stu_img FROM student WHERE stu_id =$stu_id";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    //Image extension Check
    $extension = pathinfo($stu_image, PATHINFO_EXTENSION);
    $valid_extension = ['jpg', 'jpeg', 'png', 'gif'];
    if ($_FILES['stuImg']['size'] > 1) {
      if (in_array($extension, $valid_extension)) {
        if (file_exists($row2['stu_img']) && !empty($row2['stu_img'])) {
          unlink($row2['stu_img']);
        }
        move_uploaded_file($stu_image_tmp, $img_folder);
        $sql3 = "UPDATE student SET stu_name='$stu_name',stu_occ='$stu_occ',stu_img='$img_folder' WHERE stu_id= $stu_id";
        if ($conn->query($sql3) == true) {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Profile updated successfully
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        } else {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Unable to update
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        }
      } else {
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Image extension must be \'jpg\', \'jpeg\', \'png\', \'gif\' 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    } else {
      //if student did not change image
      echo $sql3 = "UPDATE student SET stu_name='$stu_name',stu_occ='$stu_occ' WHERE stu_id= $stu_id";
      if ($conn->query($sql3) == true) {
        $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Profile updated successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      } else {
        $msg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Unable to update
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    }
  }
}
$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $stuId = $row['stu_id'];
  $stuName = $row['stu_name'];
  $stuOcc = $row['stu_occ'];
  $stuImg = $row['stu_img'];
}
?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded p-3">
        <h3>My Profile</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="stuId">Student ID</label>
                  <input type="text" class="form-control" id="stuId" name="stuId" value="<?php if (isset($stuId)) {
                                                                                            echo ($stuId);
                                                                                          } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="stuEmail">Email</label>
                  <input type="email" name="stuEmail" id="stuEmail" class="form-control" value="<?php if (isset($stuEmail)) {
                                                                                                  echo ($stuEmail);
                                                                                                } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="stuName">Name</label>
                  <input type="text" class="form-control" id="stuName" name="stuName" value="<?php if (isset($stuName)) {
                                                                                                echo $stuName;
                                                                                              } ?>">
                </div>
                <div class="form-group">
                  <label for="stuOcc">Occupation</label>
                  <input type="text" class="form-control" id="stuOcc" name="stuOcc" value="<?php if (isset($stuOcc)) {
                                                                                              echo $stuOcc;
                                                                                            } ?>">
                </div>


                <div class="form-group">
                  <label for="stuImg">Upload Image</label>
                  <input type="file" class="form-control-file" id="stuImg" name="stuImg">
                  <small class="text-info">Square shape image recomended</small>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" id="updateStuNameBtn" name="updateStuNameBtn">Submit</button>
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
<?php include 'student_include/footer.php' ?>
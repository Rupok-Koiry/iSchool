<?php
include 'admin_include/header.php';
include '../db_connection.php';
//Update
if (isset($_REQUEST['courseUpdateBtn'])) {
  //Checking All filed is not empty
  if (($_REQUEST['course_id'] == '') || ($_REQUEST['course_name'] == '') || ($_REQUEST['course_desc'] == '') || ($_REQUEST['course_author'] == '') || ($_REQUEST['course_duration'] == '') || ($_REQUEST['course_original_price'] == '') || ($_REQUEST['course_selling_price'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All Fields are Required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Getting all value
    $cid = $_REQUEST['course_id'];
    $cname =ucwords($_REQUEST['course_name']);
    $cdesc = $_REQUEST['course_desc'];
    $cauthor = ucwords($_REQUEST['course_author']);
    $cduration = $_REQUEST['course_duration'];
    $cprice = $_REQUEST['course_original_price'];
    $coriginalprice = $_REQUEST['course_selling_price'];
    //Getting Image
    $course_image = $_FILES['course_img']['name'];
    $course_image_tmp = $_FILES['course_img']['tmp_name'];
    $img_folder = '../image/courseimg/' . $course_image;
    //if admin change image then old image will delete
    $sql2 = "SELECT course_img FROM course WHERE course_id =$cid";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    //Image extension Check
    $extension = pathinfo($course_image, PATHINFO_EXTENSION);
    $valid_extension = ['jpg', 'jpeg', 'png', 'gif'];
    if ($_FILES['course_img']['size'] > 1) {
      if (in_array($extension, $valid_extension)) {
        if (file_exists($row2['course_img']) && !empty($row2['course_img'])) {
          unlink($row2['course_img']);
        }
        move_uploaded_file($course_image_tmp, $img_folder);
        $sql3 = "UPDATE course SET course_name='$cname',course_desc='$cdesc',course_author='$cauthor',course_img='$img_folder',course_duration='$cduration',course_price='$cprice',course_original_price='$coriginalprice' WHERE course_id='$cid'";
        if ($conn->query($sql3) == true) {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated Successfully
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        } else {
          $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Unable to Update
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        }
      } else {
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Image Extension Must Be \'jpg\', \'jpeg\', \'png\', \'gif\' 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    } else {
      //if admin did not change image
      $sql3 = "UPDATE course SET course_name='$cname',course_desc='$cdesc',course_author='$cauthor',course_duration='$cduration',course_price='$cprice',course_original_price='$coriginalprice' WHERE course_id='$cid'";
      if ($conn->query($sql3) == true) {
        $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Updated Successfully
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      } else {
        $msg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Unable to Update
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
        <h3>Update Course</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <?php
              if (isset($_REQUEST['view'])) {
                $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['eid']}";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
              }
              ?>
              <form action="" method="post" enctype="multipart/form-data" id="update_form">
                <div class="form-group">
                  <label for="course_id">Course ID</label>
                  <input required type="text" class="form-control" id="course_id" name="course_id" value="<?php if (isset($row['course_id'])) {
                                                                                                            echo $row['course_id'];
                                                                                                          } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="course_name">Course Name</label>
                  <input required type="text" class="form-control" id="course_name" name="course_name" value="<?php if (isset($row['course_name'])) {
                                                                                                                echo ($row['course_name']);
                                                                                                              } ?>">
                </div>
                <div class="form-group">
                  <label for="course_desc">Course Description</label>
                  <textarea required name="course_desc" id="course_desc" rows="3" class="form-control"><?php if (isset($row['course_desc'])) {
                                                                                                          echo $row['course_desc'];
                                                                                                        } ?></textarea>
                </div>
                <div class="form-group">
                  <label for="course_author">Author</label>
                  <input required type="text" class="form-control" id="course_author" name="course_author" value="<?php if (isset($row['course_author'])) {
                                                                                                                    echo $row['course_author'];
                                                                                                                  } ?>">
                </div>

                <div class="form-group">
                  <label for="course_duration">Course Duration</label>

                  <div class="input-group">
                    <input required type="text" class="form-control" id="course_duration" name="course_duration" value="<?php if (isset($row['course_duration'])) {
                                                                                                                          echo $row['course_duration'];
                                                                                                                        } ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">Months</div>
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label for="course_original_price">Course Original Price</label>
                  <input required type="text" class="form-control" id="course_original_price" name="course_original_price" value="<?php if (isset($row['course_price'])) {
                                                                                                                                    echo $row['course_price'];
                                                                                                                                  } ?>">
                </div>
                <div class="form-group">
                  <label for="course_selling_price">Course Selling Price</label>
                  <input required type="text" class="form-control" id="course_selling_price" name="course_selling_price" value="<?php if (isset($row['course_original_price'])) {
                                                                                                                                  echo $row['course_original_price'];
                                                                                                                                } ?>">
                </div>
                <div class="form-group">
                  <label for="course_img" class="d-block">Course Image</label>
                  <img src="<?php if (isset($row['course_img'])) {
                              echo $row['course_img'];
                            } ?>" class="img-fluid img-thumbnail mb-3" id="show_image">
                  <input type="file" class="form-control-file" id="course_img" name="course_img">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="courseUpdateBtn" name="courseUpdateBtn">Update</button>
                  <a href="courses.php" class="btn btn-danger ml-2">Close</a>
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
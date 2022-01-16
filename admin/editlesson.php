<?php
include 'admin_include/header.php';
include '../db_connection.php';
//Update
if (isset($_REQUEST['requpdate'])) {
  //Checking All filed is not empty
  if (($_REQUEST['lesson_id'] == '') || ($_REQUEST['lesson_name'] == '') || ($_REQUEST['lesson_desc'] == '') || ($_REQUEST['course_id'] == '') || ($_REQUEST['course_name'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All Fields are Required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Getting all value
    $lid = $_REQUEST['lesson_id'];
    $lname = $_REQUEST['lesson_name'];
    $ldesc = $_REQUEST['lesson_desc'];
    $cid = $_REQUEST['course_id'];
    $cname = $_REQUEST['course_name'];

    //Getting Image
    $link_video = $_FILES['lesson_link']['name'];
    $link_video_tmp = $_FILES['lesson_link']['tmp_name'];
    $vid_folder = '../lessonvid/' . $link_video;
    //if admin change image then old image will delete
    $sql2 = "SELECT lesson_link FROM lesson WHERE lesson_id =$lid";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    //Image extension Check
    $extension = pathinfo($link_video, PATHINFO_EXTENSION);
    $valid_extension = ['webm', 'mkv', 'mp4'];
    if ($_FILES['lesson_link']['size'] > 1) {
      if (in_array($extension, $valid_extension)) {
        if (file_exists($row2['lesson_link']) && !empty($row2['lesson_link'])) {
          unlink($row2['lesson_link']);
        }
        move_uploaded_file($link_video_tmp, $vid_folder);
        $sql3 = "UPDATE lesson SET lesson_name='$lname',lesson_desc='$ldesc',lesson_link='$vid_folder',course_id='$cid',course_name='$cname' WHERE lesson_id=$lid";
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
        $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Image Extension Must Be \'webm\', \'mkv\', \'flv\' 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
      }
    } else {
      //if admin did not change image
      $sql3 = "UPDATE lesson SET lesson_name='$lname',lesson_desc='$ldesc', course_id='$cid',course_name='$cname' WHERE lesson_id=$lid";
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
                $sql = "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['eid']}";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
              }
              ?>
              <form action="" method="post" enctype="multipart/form-data" id="update_form">
                <div class="form-group">
                  <label for="lesson_id">Lesson ID</label>
                  <input type="text" class="form-control" id="lesson_id" name="lesson_id" value="<?php if (isset($row['lesson_id'])) {
                                                                                                    echo $row['lesson_id'];
                                                                                                  } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="lesson_name">Lesson Name</label>
                  <input type="text" class="form-control" id="lesson_name" name="lesson_name" value="<?php if (isset($row['lesson_name'])) {
                                                                                                        echo ($row['lesson_name']);
                                                                                                      } ?>">
                </div>
                <div class="form-group">
                  <label for="lesson_desc">Course Description</label>
                  <textarea name="lesson_desc" id="lesson_desc" rows="3" class="form-control"><?php if (isset($row['lesson_desc'])) {
                                                                                                echo $row['lesson_desc'];
                                                                                              } ?></textarea>
                </div>
                <div class="form-group">
                  <label for="course_id">Course ID</label>
                  <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if (isset($row['course_id'])) {
                                                                                                            echo $row['course_id'];
                                                                                                          } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="course_name">Course Name</label>
                  <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if (isset($row['course_name'])) {
                                                                                                                echo $row['course_name'];
                                                                                                              } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="lesson_link">Lesson Link</label>
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="<?php if (isset($row['lesson_link'])) {
                                                                                                                echo $row['lesson_link'];
                                                                                                              } ?>" frameborder="0" allowfullscreen></iframe>                                                                                          
                  </div>
                  <input type="file" class="form-control-file mt-3" id="lesson_link" name="lesson_link" >
                </div>

                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="requpdate" name="requpdate">Update</button>
                  <a href="lesson.php" class="btn btn-danger ml-2">Close</a>
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
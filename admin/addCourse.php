<?php
include 'admin_include/header.php';
include '../db_connection.php';
if (isset($_REQUEST['courseSubmitBtn'])) {
  //Checking for Empty Fields
  if (($_REQUEST['course_name'] == '') || ($_REQUEST['course_desc'] == '') || ($_REQUEST['course_author'] == '') || ($_REQUEST['course_duration'] == '') || ($_REQUEST['course_original_price'] == '') || ($_REQUEST['course_selling_price'] == '')) {
    $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">All fields are required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  } else {
    //Geeting all value from the input;
    $course_name = ucwords($_REQUEST['course_name']);
    $course_desc = $_REQUEST['course_desc'];
    $course_author = ucwords($_REQUEST['course_author']);
    $course_duration = $_REQUEST['course_duration'];
    $course_original_price = $_REQUEST['course_original_price'];
    $course_selling_price = $_REQUEST['course_selling_price'];
    $course_image = $_FILES['course_img']['name'];
    $course_image_tmp = $_FILES['course_img']['tmp_name'];
    $img_folder = '../image/courseimg/' . $course_image;
    move_uploaded_file($course_image_tmp, $img_folder);
    $sql = "INSERT INTO course(course_name, course_desc, course_author, course_img, course_duration, course_price, course_original_price) VALUES ('$course_name','$course_desc','$course_author','$img_folder','$course_duration',$course_original_price,$course_selling_price)";
    if ($conn->query($sql) == true) {
      $msg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Course added successfully
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    } else {
      $msg = '<div class="alert text-center alert-warning alert-dismissible fade show" role="alert">Unable to add course
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
        <h3>Add New Course</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="course_name">Course Name</label>
                  <input type="text" class="form-control" id="course_name" name="course_name">
                </div>
                <div class="form-group">
                  <label for="course_desc">Course Description</label>
                  <textarea name="course_desc" id="course_desc" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="course_author">Author</label>
                  <input type="text" class="form-control" id="course_author" name="course_author">
                </div>
                <div class="form-group">
                  <label for="course_duration">Course Duration</label>

                  <div class="input-group">
                    <input type="text" class="form-control" id="course_duration" name="course_duration">
                    <div class="input-group-append">
                      <div class="input-group-text">Months</div>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="course_original_price">Course Original Price</label>
                  <input type="number" class="form-control" id="course_original_price" name="course_original_price">
                </div>
                <div class="form-group">
                  <label for="course_selling_price">Course Selling Price</label>
                  <input type="number" class="form-control" id="course_selling_price" name="course_selling_price">
                </div>
                <div class="form-group">
                  <label for="course_img">Course Image</label>
                  <input type="file" class="form-control-file" id="course_img" name="course_img">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
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
<?php
include 'admin_include/header.php';
include '../db_connection.php';
if (isset($_REQUEST['lessonSubmitBtn'])) {
  //Checking for Empty Fields
  if (($_REQUEST['lesson_name'] == '') || ($_REQUEST['lesson_desc'] == '') || ($_REQUEST['course_name'] == '') || ($_REQUEST['course_id'] == '') ) {
    $msg = '<p class="alert alert-warning text-center">All Fields are Required</p>';
  } else {
    //Geeting all value from the input;
    $lesson_name = $_REQUEST['lesson_name'];
    $lesson_desc = $_REQUEST['lesson_desc'];
    $course_id = $_REQUEST['course_id'];
    $course_name = $_REQUEST['course_name'];
    $lesson_link = $_FILES['lesson_link']['name'];
    $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
  
    $link_folder = '../lessonvid/' . $lesson_link;
    move_uploaded_file($lesson_link_temp, $link_folder);
    $sql="INSERT INTO lesson(lesson_name, lesson_desc, lesson_link, course_id, course_name) VALUES ('$lesson_name','$lesson_desc','$link_folder','$course_id','$course_name')";
    if ($conn->query($sql) == true) {
      $msg = '<p class="alert alert-success text-center">Lesson Added Successfully</p>';
    } else {
      $msg = '<p class="alert alert-danger text-center">Unable to Add Lesson</p>';
    }
  }
}
?>
<main>

  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded p-3">
        <h3>Add New Lesson</h3>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="course_id">Course ID</label>
                  <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if (isset($_SESSION['course_id'])) {
                                                                                                    echo $_SESSION['course_id'];
                                                                                                  } ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="course_name">Course Name</label>
                  <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if (isset($_SESSION['course_name'])) {
                                                                                                        echo $_SESSION['course_name'];
                                                                                                      } ?>">
                </div>
                <div class="form-group">
                  <label for="lesson_name">Lesson Name</label>
                  <input type="text" class="form-control" id="lesson_name" name="lesson_name">
                </div>
                <div class="form-group">
                  <label for="lesson_desc">Lesson Description</label>
                  <textarea  rows="3" class="form-control" id="lesson_desc" name="lesson_desc"></textarea>
                </div>
                <div class="form-group">
                  <label for="lesson_link">Lesson Video Link</label>
                  <input type="file" class="form-control-file" id="lesson_link" name="lesson_link">
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button class="btn btn-success mr-2" id="lessonSubmitBtn" name="lessonSubmitBtn">Submit</button>
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
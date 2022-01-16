<?php
include 'student_include/header.php';
$sql="SELECT * FROM student WHERE stu_email='$stuLogEmail'";
$result=$conn->query($sql);
if ($result->num_rows==1) {
  $row=$result->fetch_assoc();
  $stuId=$row['stu_id'];
}
if (isset($_REQUEST['updateStuNameBtn'])) {
  if ($_REQUEST['f_content'] == '') {
    $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Feedback field is required
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

  }else{
    $fcontent=$_REQUEST['f_content'];
    $sql="INSERT INTO feedback (f_content,stu_id) Values ('$fcontent','$stuId')";
    if ($conn->query($sql)==true) {
      $passmsg = '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">Thank you for your feedback
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
    }else{
      $passmsg = '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">Unable to add feddback
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
        <h3>Write Your Feedback</h3>
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
                  <label for="f_content">Your Feedback</label>
                  <textarea name="f_content" id="f_content" rows="5" class="form-control" placeholder="Write Your Feedback"></textarea>
                  <small class="text-info">Try to give a feedback with atleast 100 character</small>
                                                                                          
                </div>                                                                     

                <div class="form-group">
                  <button class="btn btn-primary" id="submitFeedbackBtn" name="updateStuNameBtn">Submit</button>
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
<!-- jQuery.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
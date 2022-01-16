<?php
include 'student_include/header.php';
?>
<style>
  .card-body {
    display: block;
  }
</style>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card shadow rounded-lg p-3">
        <h3>All Course</h3>
        <div class="container">
          <?php
          if (isset($stuLogEmail)) {
            $sql = "SELECT co.order_id,c.course_id,c.course_name,c.course_duration,c.course_desc,c.course_img,c.course_author,c.course_price,c.course_original_price FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email='$stuLogEmail'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
          ?>            
          <div class="row mb-5">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4><?php echo $row['course_name'];?></h4>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <img src="<?php echo $row['course_img'];?>" alt="lohgi" class="img-fluid">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <div class="card-text mb-3">
                      <?php echo $row['course_desc'];?>
                      </div>
                      <div class="crad-text" style="font-size: 15px;">
                        Duration : <?php echo $row['course_duration'];?> 
                      </div>
                      <small class="crad-text py-2 d-block">
                        Intructor : <?php echo $row['course_author'];?>
                      </small>
                      
                      <p class="card-text d-inline">Price: <small><del>&#8377 <?php echo $row['course_price'];?></del></small>
                        <span class="font-weight-bolder" style="font-size: 16px;">&#8377 <?php echo $row['course_original_price'];?></span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <a href="watchcourse.php?course_id=<?php  echo $row['course_id'];?>" class="text-white btn-primary btn">Watch Course</a>
                </div>
              </div>
            </div>
          </div>
          <?php
              }
            }else{
              echo '<h3 class="alert alert-info text-center" style="color:#525252">Please Buy Some Course to Show</h3>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</main>
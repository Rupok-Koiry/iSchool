  <!-- Include Header Section Start-->
  <?php include 'main_include/header.php';
  include 'db_connection.php'; ?>
  <!-- Include Header Section Start-->

  <div class="container-fluid bg-dark">
    <div class="row">
      <img src="<?php echo str_replace('..', '.', $row2['banner']) ?>" alt="" style="height:500px; width:100%; object-fit:cover; box-shadow:10px">
    </div>
  </div>
  <!-- Course Section Start-->
  <div class="container my-5">
    <h2 class="text-center common">All Course</h2>
    <div class="row">
      <?php
      $sql = "SELECT * FROM course ORDER BY course_id DESC";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
      ?>
        <div class="col-md-4 col-sm-6 course">
          <div class="card">
            <a href="coursedetails.php?course_id=<?php echo $course_id ?>"><img class="card-img-top" src="<?php echo str_replace('..', '.', $row['course_img']) ?>" alt="Card image cap"></a>
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['course_name'] ?></h5>
              <p class="card-text"><?php if (strlen($row['course_desc']) < 120) {
                                      echo $row['course_desc'];
                                    } else {
                                      echo substr($row['course_desc'], 0, 120) . "...";
                                    } ?></p>
            </div>
            <div class="card-footer">
              <p class="card-text d-inline">Price: <small><del>&#8377 <?php echo $row['course_price'] ?></del></small>
                <span class="font-weight-bolder">&#8377 <?php echo $row['course_original_price'] ?></span>
              </p>
              <a href="coursedetails.php?course_id=<?php echo $course_id ?>" class="btn btn-primary text-white font-weight-bolder float-right">Buy Now</a>
            </div>
          </div>

        </div>
      <?php } ?>
    </div>
  </div>
  <!-- Course Section End-->
    <!-- Include Footer Section End-->
    <?php include 'contact.php'; ?>
  <!-- Include Footer Section End-->
  <!-- Include Footer Section End-->
  <?php include 'main_include/footer.php'; ?>
  <!-- Include Footer Section End-->
  <!-- Include Header Section Start-->
  <?php
  include 'main_include/header.php';
  include 'db_connection.php';
  ?>
  <!-- Include Header Section Start-->
  <!-- The Video Start-->
  <div class="video-parent">
    <video autoplay muted loop id="myVideo">
      <source src="<?php echo str_replace('..', '.', $row2['video']) ?>" type="video/mp4">
    </video>
    <div class="overlay"></div>
  </div>
  <div class="video-content">
    <h1 class="text-white">Welcome To <?php echo $row2['logo'] ?></h1>
    <p class="text-white">Learn and Implement.</p>
    <?php
    if (!isset($_SESSION['is_login'])) {
    ?>
      <a href="" class="btn btn-primary btn-lg text-white" data-toggle="modal" data-target="#registration_modal">
        Get Started
      </a>
    <?php
    } else {
    ?>
      <a href="student/studentProfile.php" class="btn btn-primary btn-lg text-white">
        My Profile
      </a>
    <?php
    }
    ?>
  </div>
  <!-- The Video End-->
  <!-- Banner Text Start-->
  <div class="container-fluid text-banner px-5 mb-5">
    <div class="row bottom-banner justify-content-center text-center">
      <div class="col-sm-6 col-md-3 responsive">
        <h5><i class="fas fa-book-open mr-3"></i> 100+ Online Courses</h5>
      </div>
      <div class="col-sm-6 col-md-3 responsive">
        <h5><i class="fas fa-users mr-3"></i>Expert Instructors</h5>
      </div>
      <div class="col-sm-6 col-md-3 responsive">
        <h5><i class="fas fa-keyboard mr-3"></i> Lifetime Access</h5>
      </div>
      <div class="col-sm-6 col-md-3 responsive">
        <h5><i class="fas fa-dollar-sign mr-3"></i> Money Back Guarantee*</h5>
      </div>
    </div>
  </div>
  <!-- Banner Text End-->
  <!-- Course Section Start-->
  <div class="container">
    <h2 class="text-center common">Popular Course</h2>
    <div class="row">
      <?php
      $sql = "SELECT * FROM course ORDER BY course_id DESC LIMIT 6";
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
              <a href="coursedetails.php?course_id=<?php echo $course_id ?>" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
            </div>
          </div>
        </div>
      <?php } ?>
      <a href="courses.php" class="btn btn-primary all-course">View All Courses</a>
    </div>
  </div>
  <!-- Course Section End-->
  <!-- Feedback Section Start-->
  <section id="mySlide" class="my-5">
    <div class="container">
      <div class="section-title">
        <h2 class="text-uppercase">Student's Feedback</h2>
        <span class="section-separator"></span>
      </div>
    </div>
    <div class="testimonials-carousel-wrap">
      <div class="listing-carousel-button listing-carousel-button-next"><i class="fa fa-caret-right" style="color: #fff"></i></div>
      <div class="listing-carousel-button listing-carousel-button-prev"><i class="fa fa-caret-left" style="color: #fff"></i></div>
      <div class="testimonials-carousel">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php
            $sql = "SELECT stu_name,stu_occ,stu_img,f_content FROM student JOIN feedback ON student.stu_id=feedback.stu_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <div class="swiper-slide">
                  <div class="testi-item">
                    <div class="testi-avatar"><img src="<?php echo str_replace('..', '.', $row['stu_img']) ?>"></div>
                    <div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
                    <div class="testimonials-text">
                      <!-- <div class="listing-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div> -->
                      <p><?php echo $row['f_content'] ?></p>
                      <a href="#" class="text-link"></a>
                      <div class="testimonials-avatar">
                        <h3><?php echo ucwords($row['stu_name']) ?></h3>
                        <h4><?php echo ucwords($row['stu_occ']) ?></h4>
                      </div>
                    </div>
                    <div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div>
                  </div>
                </div>
            <?php }
            } ?>
            <!--testi end-->
          </div>
        </div>
      </div>

      <div class="tc-pagination"></div>
    </div>
  </section>

  <!-- Feedback Section End-->
  <!-- Include Contact Section Start-->
  <?php include 'contact.php'; ?>
  <!--Include Contact Section End-->
  <!-- Include Footer Section End-->
  <?php include 'main_include/footer.php'; ?>
  <!-- Include Footer Section End-->
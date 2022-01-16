  <!-- Include Header Section Start-->
  <?php include 'main_include/header.php';
  include 'db_connection.php'; ?>
  <!-- Include Header Section Start-->

  <div class="container-fluid bg-dark">

    <div class="row">
      <img src="image/book.jpg" alt="" style="height:500px; width:100%; object-fit:cover; box-shadow:10px">
    </div>
  </div>
  <h2 class="text-center common pb-0 mt-5">Course Details</h2>
  <div class="container p-5 rounded mb-5" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
    <div class="row">
      <?php
      if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
        $_SESSION['course_id']=$course_id;
        $sql = "SELECT * FROM course WHERE course_id=$course_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
      }
      ?>
      <div class="col-md-4">
        <img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" alt="" class="img-fluid img-thumbnail">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">
            Course Name : <?php echo  $row['course_name'] ?>
          </h5>
          <p class="card-text">
            Description : <?php echo  $row['course_desc'] ?>
          </p>
          <p class="card-text">
            Duration : <?php echo  $row['course_duration'] ?>
          </p>
          <?php
           if (isset($_SESSION['stuLogEmail'])) {
          ?>
          <form action="checkout.php" method="post">
            <p class="card-text d-inline">
              Price: <small><del>&#8377 <?php echo  $row['course_price'] ?></del></small>
              <span class="font-weight-bolder">&#8377 <?php echo  $row['course_original_price'] ?></span>
            </p>
            <input type="hidden" name="cname" value="<?php echo  $row['course_name']?>">
            <input type="hidden" name="id" value="<?php echo  $row['course_original_price']?>">
            <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" name="buy">Buy Now</button>
          </form>
          <?php }else{?>
            <p class="card-text d-inline">
              Price: <small><del>&#8377 <?php echo  $row['course_price'] ?></del></small>
              <span class="font-weight-bolder">&#8377 <?php echo  $row['course_original_price'] ?></span>
            </p>
            <input type="hidden" name="id" value="<?php echo  $row['course_original_price']?>">
            <button class="btn btn-primary text-white font-weight-bolder float-right" name="buy" data-toggle="modal" data-target="#registration_modal">Buy Now</button>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <?php
   $sql = "SELECT * FROM lesson WHERE course_id = $course_id";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
     $num = 0;
  ?>
  <div class="container mb-5" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
    <table class="table  table-hover radius">
      <thead>
        <tr>
          <th scope="col">Lesson No.</th>
          <th scope="col">Lesson Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($row = $result->fetch_assoc()) {
            $num++;
        ?>
            <tr>
              <th scope="row"><?php echo $num ?></th>
              <td><?php echo $row['lesson_name'] ?></td>
            </tr>
        <?php }
        }else{
          echo "<h2 class='alert alert-info text-center'>Lesson Will Be Added Soon...</h2>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Include Footer Section End-->
  <?php include 'main_include/footer.php'; ?>
  <!-- Include Footer Section End-->
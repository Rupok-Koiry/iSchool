<!-- Include Sidebar Start -->
<?php include 'admin_include/header.php';
include '../db_connection.php';
$sql = "SELECT * FROM course";
$result = $conn->query($sql);
$total_course = $result->num_rows;

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$total_student = $result->num_rows;

$sql = "SELECT SUM(amount) AS total FROM courseorder";
$result = $conn->query($sql);
$row = $result->fetch_assoc()
?>
<!-- Include Sidebar End -->
<main>
  <h2 class="dash-title">Overview</h2>
  <div class="dash-cards">
    <div class="card-single">
      <div class="card-body">
        <span class="ti-briefcase"></span>
        <div>
          <h5>Courses</h5>
          <h4><?php echo $total_course ?></h4>
        </div>
      </div>
      <div class="card-footer">
        <a href="courses.php">View all</a>
      </div>
    </div>

    <div class="card-single">
      <div class="card-body">
        <span class="ti-user"></span>
        <div>
          <h5>Students</h5>
          <h4><?php echo $total_student ?></h4>
        </div>
      </div>
      <div class="card-footer">
        <a href="students.php">View all</a>
      </div>
    </div>

    <div class="card-single">
      <div class="card-body">
        <span class="ti-check-box"></span>
        <div>
          <h5>Sold</h5>

          <h4>$<?php echo  $row['total']; ?></h4>

        </div>
      </div>
      <div class="card-footer">
        <a href="sellReport.php">View all</a>
      </div>
    </div>
  </div>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT * FROM courseorder";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

        ?>
          <h3>Courses Order</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Course Id</th>
                  <th>Student E-Mail</th>
                  <th>Order Date</th>
                  <th>Amount</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $row['order_id'] ?></td>
                    <td><?php echo $row['course_id'] ?></td>
                    <td><?php echo $row['stu_email'] ?></td>
                    <td><?php echo $row['order_date'] ?></td>
                    <td><?php echo $row['amount'] ?></td>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['co_id'] ?>">
                      <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else {
          echo "<h3>No Order Record Found</h3>";
        }
        if (isset($_REQUEST['delete'])) {
          $sql2 = "DELETE FROM courseorder WHERE co_id={$_REQUEST['id']}";
          if ($conn->query($sql2) == true) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
          } else {
            echo "Unable to Delete Data";
          }
        } ?>
      </div>
    </div>
  </section>

</main>
<!-- Include Footer Start -->
<?php include 'admin_include/footer.php' ?>
<!-- Include Footer End -->
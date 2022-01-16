<?php
include '../db_connection.php';
include 'admin_include/header.php';
?>
<style>
  .form-group {
    width: 46%;
    display: inline-block;
  }
</style>
<main>
<div class="container shadow p-4 rounded">
          <form action="" method="post">
            <div class="d">
              <div class="form-group mr-3">
                <input type="date" class="form-control" name="startdate" id="startdate">
              </div>
              <span>To</span>
              <div class="form-group ml-3">
                <input type="date" class="form-control" name="enddate" id="enddate">
              </div>
            </div>
            <button name="searchsubmit" class="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
  <section class="recent">
  
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        if (isset($_REQUEST['searchsubmit'])) {
          $startdate = $_REQUEST['startdate'];
          $enddate = $_REQUEST['enddate'];
          $sql = "SELECT * FROM courseorder WHERE order_date BETWEEN '$startdate' AND '$enddate'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {


        ?>
        <h3>Order Between : <?php echo $startdate?> to <?php echo $enddate?></h3>
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th>Order Id</th>
                    <th>Course Id</th>
                    <th>Student Email</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Amount</th>
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
                      <td><span class="badge badge-success"><?php echo $row['status'] ?></span></td>
                      <td><?php echo $row['order_date'] ?></td>
                      <td><?php echo $row['amount'] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
        <?php
          }else{
            echo "<h3>No Record Found</h3>";
          }
        }
        
        ?>
      </div>
    </div>
  </section>
</main>
<?php include 'admin_include/footer.php' ?>
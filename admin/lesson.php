<?php
include 'admin_include/header.php';
include '../db_connection.php';
?>
<main>
  <div class="container shadow p-4 rounded">
    <form action="">
      <div class="form-group">
        <label for="checkid">Enter Course ID: </label>
        <input type="number" class="form-control" name="checkid" id="checkid">
      </div>
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
  </div>

  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT course_id FROM course";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          if (isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['course_id']) {
            $sql = "SELECT * FROM course WHERE course_id={$_REQUEST['checkid']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if (($row['course_id']) == ($_REQUEST['checkid'])) {
              $_SESSION['course_id'] = $row['course_id'];
              $_SESSION['course_name'] = $row['course_name'];
        ?>
              <h3>Course ID:
                <?php
                if (isset($row['course_id'])) {
                  echo $row['course_id'];
                }
                ?>
                Course Name:
                <?php
                if (isset($row['course_name'])) {
                  echo $row['course_name'];
                }
                ?>
              </h3>
              <?php
              $sql = "SELECT * FROM lesson WHERE course_id={$_REQUEST['checkid']}";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {

              ?>
                <div class="table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th>Lesson Id</th>
                        <th>Lesson Name</th>
                        <th>lesson Link</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row = $result->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?php echo $row['lesson_id'] ?></td>
                          <td><?php echo $row['lesson_name'] ?></td>
                          <td><?php echo $row['lesson_link'] ?></td>
                          <form action="editlesson.php" method="post">
                            <input type="hidden" name="eid" value="<?php echo $row['lesson_id'] ?>">
                            <td><button name='view' class="btn"><span class='ti-pencil-alt'></span></button></td>
                          </form>
                          <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['lesson_id'] ?>">
                            <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                          </form>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
        <?php } else {
                echo "<h3>No Lesson Found</h3>";
              }
            } else {
              echo '<p class="alert alert-warning">Course not found</p>';
            }
            if (isset($_REQUEST['delete'])) {
              $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
              if ($conn->query($sql) == true) {
                echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
              } else {
                echo "Unable to Delete Data";
              }
            }
          }
        }
        ?>
      </div>
    </div>
  </section>
  <?php
  if (isset($_SESSION['course_id'])) {
  ?>
    <div><a href="addLesson.php" class="add-course" title="Add Course"><i class="fas fa-plus-circle"></i></a></div>
  <?php } ?>
</main>
<?php include 'admin_include/footer.php' ?>
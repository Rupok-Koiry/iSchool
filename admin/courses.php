<?php
include 'admin_include/header.php';
include '../db_connection.php';

?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <h3>List Of Courses</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Course Id</th>
                  <th>Name</th>
                  <th>Author</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $row['course_id'] ?></td>
                    <td><?php echo $row['course_name'] ?></td>
                    <td><?php echo $row['course_author'] ?></td>
                    <form action="editcourse.php" method="post">
                      <input type="hidden" name="eid" value="<?php echo $row['course_id'] ?>">
                      <td><button name='view' class="btn"><span class='ti-pencil-alt'></span></button></td>
                    </form>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['course_id'] ?>">
                      <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php
        } else {
          echo "<h3>No Course Found</h3>";
        }
        if (isset($_REQUEST['delete'])) {
          $sql2 = "DELETE FROM course WHERE course_id={$_REQUEST['id']}";
          if ($conn->query($sql2) == true) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
          } else {
            echo "Unable to Delete Data";
          }
        }
        ?>
      </div>
    </div>
  </section>
  <div><a href="addCourse.php" class="add-course" title="Add Course"><i class="fas fa-plus-circle"></i></a></div>
</main>

<?php include 'admin_include/footer.php' ?>
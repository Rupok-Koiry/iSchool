<?php
include 'admin_include/header.php';
include '../db_connection.php';

?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <h3>List Of Students</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Student Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $row['stu_id'] ?></td>
                    <td><?php echo $row['stu_name'] ?></td>
                    <td><?php echo $row['stu_email'] ?></td>
                    <form action="editstudent.php" method="post">
                      <input type="hidden" name="eid" value="<?php echo $row['stu_id'] ?>">
                      <td><button name='view' class="btn"><span class='ti-pencil-alt'></span></button></td>
                    </form>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['stu_id'] ?>">
                      <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php
        } else {
          echo "<h3>No Student Found</h3>";
        }
        if (isset($_REQUEST['delete'])) {
          $sql2 = "DELETE FROM student WHERE stu_id={$_REQUEST['id']}";
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
  <div><a href="addnewstudent.php" class="add-course" title="Add Student"><i class="fas fa-plus-circle"></i></a></div>
</main>

<?php include 'admin_include/footer.php' ?>
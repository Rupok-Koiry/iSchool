<?php
include 'admin_include/header.php';
include '../db_connection.php';
?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT * FROM feedback Join student ON feedback.stu_id = student.stu_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <h3>List Of Feedback</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr class="text-center">
                  <th>Feedback Id</th>
                  <th>Content</th>
                  <th>Student Email</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr class="text-center">
                    <td><?php echo $row['f_id'] ?></td>
                    <td style="width: 60%;"><?php echo $row['f_content'] ?></td>
                    <td><?php echo $row['stu_email'] ?></td>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['f_id'] ?>">
                      <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php
        } else {
          echo "<h3>No Feedback Found</h3>";
        }
        if (isset($_REQUEST['delete'])) {
          $sql2 = "DELETE FROM feedback WHERE f_id={$_REQUEST['id']}";
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
</main>
<?php include 'admin_include/footer.php' ?>
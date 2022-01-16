<?php
include 'admin_include/header.php';
include '../db_connection.php';
?>
<main>
  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <?php
        $sql = "SELECT * FROM message";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <h3>List Of Message</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr class="text-center">
                  <th>Student Id</th>
                  <th>Name</th>
                  <th>Student Email</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr class="text-center">
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['subject'] ?></td>
                    <td><?php echo $row['message'] ?></td>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                      <td><button name='delete' type="submit" class="btn"><span class='ti-trash'></span></button></td>
                    </form>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php
        } else {
          echo "<h3>No Message Found</h3>";
        }
        if (isset($_REQUEST['delete'])) {
          $sql2 = "DELETE FROM message WHERE id={$_REQUEST['id']}";
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
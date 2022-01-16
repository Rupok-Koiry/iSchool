
<?php
include 'db_connection.php';
if (isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];
  $sql = "SELECT * FROM courseorder WHERE order_id='$order_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $output = "<h3 class='text-center mb-3'>Payment Recipent</h3>";
    while ($value = $result->fetch_assoc()) {
      $output .="<table class='table table-hover table-bordered'>
         <tbody>
            <tr>
               <th scope='value'>Order ID</th>
              <td>" .$value['order_id'] ."</td>
            </tr>
            <tr>
              <th scope='value'>Studen Email</th>
              <td>" .$value['stu_email'] ."</td>
            </tr>
            <tr>
              <th scope='value'>Satus</th>
              <td><span class='badge badge-success'>" .$value['status'] ."</span></td>
            </tr>
            <tr>
              <th scope='value'>Amount</th>
              <td>$" .$value['amount'] ."</td>
            </tr>
            <tr>
              <th scope='value'>Order Date</th>
              <td>" .$value['order_date'] ."</td>
            </tr>
          </tbody>
        </table>";
    }
    echo $output;
  } else {
    echo 0;
  }
}

<?php
include 'db_connection.php';
session_start();
if (!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='index.php'; </script>";
} else {
  $stuEmail = $_SESSION['stuLogEmail'];
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <title>iSchool</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Google Font Link -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 m-auto jumbotron shadow-sm">
        <h3 class="mb-5 text-center" style="color: #007aff;">Welcome to iSchool Payment Page</h3>
        <form id="payment_form">
          <div class="form-group row">
            <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
            <div class="col-sm-8">
              <input class="form-control bg-white" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" readonly autocomplete="off" value="<?php echo  "ORDS" . rand(10000, 99999999) ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="STUDENT_EMAIL" class="col-sm-4 col-form-label">Student Email</label>
            <div class="col-sm-8">
              <input class="form-control bg-white" id="STUDENT_EMAIL" tabindex="2" maxlength="12" size="12" name="STUDENT_EMAIL" autocomplete="off" value="<?php if (isset($stuEmail)) {
                                                                                                                                                              echo $stuEmail;
                                                                                                                                                            } ?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="COURSE_NAME" class="col-sm-4 col-form-label">Course Name</label>
            <div class="col-sm-8">
              <input class="form-control bg-white" id="COURSE_NAME" tabindex="2" maxlength="12" size="12" name="COURSE_NAME" autocomplete="off" value="<?php if (isset($_POST['cname'])) {
                                                                                                                                                          echo $_POST['cname'];
                                                                                                                                                        } ?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
            <div class="col-sm-8">
              <input id="TXN_AMOUNT" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php if (isset($_POST['id'])) {
                                                                                                              echo $_POST['id'];
                                                                                                            } ?>" class="form-control mb-3  bg-white" readonly>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" id="payment_buttton">Confirm Payment</button>
            <a href="courses.php" class="btn btn-secondary" id="close_button">Cancel</a>
          </div>
        </form>
        <small class="form-text text-muted font-weight-bold">Note : Complete Payment by Clicking Checkout Button</small>
        <p class="alert text-center d-none mb-0 mt-3" id="message"></p>
      </div>
    </div>
  </div>
  <!-- jQuery.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $('#payment_buttton').click(function(e) {
      e.preventDefault();
      $('#payment_buttton').html('<span class="spinner-border spinner-border-sm" style="width: 1rem; height: 1rem;" role="status" aria-hidden="true"></span> Loading...').attr('disabled', true);
      $('#close_button').addClass('disabled');
      var order_id = $('#ORDER_ID').val();
      var student_email = $('#STUDENT_EMAIL').val();
      var course_name = $('#COURSE_NAME').val();
      var amount = $('#TXN_AMOUNT').val();
      setTimeout(() => {
        $.ajax({
          url: 'payment.php',
          type: "POST",
          data: {
            order_id: order_id,
            student_email: student_email,
            course_name: course_name,
            amount: amount
          },
          success: function(data) {
            if (data == true) {
              $('#message').removeClass('alert-danger').addClass('alert-success d-block').html('Payment successfully');
              $('#payment_buttton').html('Go to Profile page').attr('disabled', false);
              $('#payment_buttton').click(function(){
                window.location.href='student/myCourse.php';
              })
              $('#close_button').addClass('d-none');
              $('#ORDER_ID').val('');
              $('#STUDENT_EMAIL').val('');
              $('#COURSE_NAME').val('');
              $('#TXN_AMOUNT').val('');
            } else {
              $('#message').removeClass('alert-successs').addClass('alert-danger d-block').html('Something wents wrong');

            }
          }
        })
      }, 2000);


    })
  </script>
</body>

</html>
  <!-- Include Header Section Start-->
  <?php include 'main_include/header.php'; ?>
  <!-- Include Header Section Start-->

  <div class="container-fluid bg-dark">
    <div class="row">
      <img src="<?php echo str_replace('..', '.', $row2['banner']) ?>" alt="" style="height:500px; width:100%; object-fit:cover; box-shadow:10px">
    </div>
  </div>
  <div class="container my-5">
    <h2 class="text-center common pb-0">Payment Status</h2>
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="payment shadow p-5 rounded">
          <form>
            <div class="form-group">
              <label for="order-id">Order Id : </label>
              <div class="input-group">
                <input type="text" class="form-control" id="order-id" name=" order-id">
                <div class="invalid-feedback" id="payment-error">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" id="status">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container mb-5">
    <div class="row">
      <div class="col-md-6 m-auto payment_recipent">

      </div>
    </div>
  </div>
  <!-- Include Contact Section Start-->
  <?php include 'contact.php'; ?>
  <!--Include Contact Section End-->
  <!-- Include Footer Section End-->
  <?php include 'main_include/footer.php'; ?>
  <!-- Include Footer Section End-->
  <script>
    $('#status').click(function(e) {
      e.preventDefault();
      var order_id = $('#order-id').val();
      if (order_id.trim() == "") {
        $('#payment-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Order id field is mandatory !');
        $('#order-id').removeClass('is-valid').addClass('is-invalid');
        $('#order-id').focus();
        return false;
      } else {
        $.ajax({
          url: 'checkorderid.php',
          method: 'POST',
          data: {
            order_id: order_id
          },
          success: function(data) {
            console.log(data);
            if (data == 0) {
              $('#payment-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Invalid order id !');
              $('#order-id').removeClass('is-valid').addClass('is-invalid');
              $('#order-id').focus();
            } else{
              $('.payment_recipent').html(data);
            }
          }
        })

      }

    })
  </script>
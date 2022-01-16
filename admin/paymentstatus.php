<?php
include 'admin_include/header.php';
include '../db_connection.php';
?>
<main>
  <div class="container shadow p-4 rounded">
    <form>
      <div class="form-group">
        <label for="order-id">Enter Order Id : </label>
        <div class="input-group">
          <input type="text" class="form-control" id="order-id" name=" order-id">
          <div class="invalid-feedback" id="payment-error">
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" id="status">
      </div>
    </form>
  </div>

  <section class="recent">
    <div class="activity-grid">
      <div class="activity-card">
        <div class="col-md-12 payment_recipent p-4 rounded" style="display: none;"></div>
      </div>
    </div>
  </section>
</main>
<?php include 'admin_include/footer.php' ?>
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
        url: '../checkorderid.php',
        method: 'POST',
        data: {
          order_id: order_id
        },
        success: function(data) {
          if (data == 0) {
            $('#payment-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Invalid order id !');
            $('#order-id').removeClass('is-valid').addClass('is-invalid');
            $('#order-id').focus();
          } else {
            $('.payment_recipent').fadeIn().html(data);
          }
        }
      })

    }
  })
</script>
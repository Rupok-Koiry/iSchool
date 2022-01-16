//ajax call admin Login verification
$('#admin_submit').click(function(e){
  e.preventDefault();
  var adminLogEmail=$('#admin_email').val();
  var adminLogPass=$('#admin_password').val();
  $.ajax({
    url: "admin/admin.php",
    method: 'POST',
    data:{
      checkLogemail:"checklogemail",
      adminLogEmail:adminLogEmail,
      adminLogPass:adminLogPass
    },
    success:function(data){
      console.log(data);
     if (data == 0) {
       $('#alert-message-admin').fadeIn().removeClass('alert-success').addClass('alert-danger').html('Invalid Email ID or Password !');
     }else if(data == 1){
      $('#alert-message-admin').fadeIn().removeClass('alert-danger').addClass('alert-success').html('Log in successfully !');
      $('#admin_submit').html('<span class="spinner-border spinner-border-sm" style="width: 1.5rem; height: 1.5rem;" role="status" aria-hidden="true"></span> Loading...').attr('disabled',true);
      setTimeout(() => {
        window.location.href='admin/admin_dashboard.php'
      }, 1000);
     }
    }
  })
})
$('#admin_close_btn').click(function () {
  $('#alert-message-login').fadeOut();
})
$('#login_modal').parent().click(function () {
  $('#alert-message-login').fadeOut();
})

  <!-- Contact Section Start-->
  <!-- <div class="container" id="contact">
    <h2 class="text-center common">Contact Us</h2>
    <div class="row">
      <div class="col-md-8">
        <form action="" method="post">
          <input type="text" class="form-control" name="name" placeholder="Name"><br>
          <input type="text" class="form-control" name="subject" placeholder="Subject"><br>
          <input type="email" class="form-control" name="email" placeholder="E-Mail"><br>
          <textarea name="message" class="form-control" placeholder="How can we help you?" style="height: 150px;"></textarea><br>
          <input type="submit" class="btn btn-primary" value="send" name="submit"><br><br>
        </form>
      </div>
      <div class="col-md-4 stripe text-white text-center">
        <h4>iSchool</h4>
        <p>iSchool,
          Near Police Camp II, Bokaro,
          Jharkhand - 834005 <br>
          Phone: +01719032457 <br>
          www.ischool.com
        </p>
      </div>
    </div>
  </div> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <div class="container-contact" id="container-contact">
    <span class="big-circle d-none d-lg-block"></span>
    <div class="form">
      <div class="contact-info">
        <h3 class="title">Contact Info</h3>
        <p class="text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
          dolorum adipisci recusandae praesentium dicta!
        </p>

        <div class="info">
          <div class="information">
            <i class="fas fa-map-marked-alt"></i>
            <p class="mt-3">92 Cherry Drive Uniondale, NY 11553</p>
          </div>
          <div class="information">
            <i class="fas  fa-envelope"></i>
            <p class="mt-3">lorem@ipsum.com</p>
          </div>
          <div class="information">
            <i class="fas fa-phone-alt"></i>
            <p class="mt-3">123-456-789</p>
          </div>
        </div>

        <div class="social-media">
          <p>Connect with us :</p>
          <div class="social-icons">
            <a href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="contact-form">
        <span class="circle one"></span>
        <span class="circle two"></span>

        <form autocomplete="off" id="contact_form" action="">
          <h3 class="title">Contact us</h3>
          <div class="input-container">
            <input type="text" name="name" class="input" id="username"/>
            <label for="username">Username</label>
            <span>Username</span>
          </div>
          <div class="input-container">
            <input type="email" name="email" class="input" id="email"/>
            <label for="email">Email</label>
            <span>Email</span>
          </div>
          <div class="input-container">
            <input type="tel" name="subject" class="input" id="subject"/>
            <label for="subject">Subject</label>
            <span>Subject</span>
          </div>
          <div class="input-container textarea">
            <textarea name="message" class="input" id="message"></textarea>
            <label for="message">Message</label>
            <span>Message</span>
          </div>
          <button type="submit" class="btn mb-3" id="send">Send</button>
          <p class="alert text-center" style="display: none;" id="contact_error"></p>
        </form>
      </div>
    </div>
  </div>

  <!-- Contact Section End-->
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $('#send').click(function(e) {
      e.preventDefault();
      var username = $('#username').val();
      var email = $('#email').val();
      var subject = $('#subject').val();
      var message = $('#message').val();
      if (username.trim() == "" || email.trim() == "" || subject.trim() == "" || message.trim() == "") {
        $('#contact_error').fadeIn().removeClass('alert-success').addClass('alert-danger').html('All fields are required !')
      } else {
        $.ajax({
          url: 'contactDataSave.php',
          method: 'POST',
          data: {
            username: username,
            email: email,
            subject: subject,
            message: message
          },
          success: function(data) {
            if (data == 1) {
              $('#contact_form').trigger('reset');
              $('#send').html('<span class="spinner-border spinner-border-sm" style="width: 1rem; height: 1rem;" role="status" aria-hidden="true"></span> Sending...');
              setTimeout(() => {
                $('#contact_error').fadeIn().removeClass('alert-danger').addClass('alert-success').html('Message sent successfully. you will get notiication soon via email');
              $('#send').html('Send');

              }, 1000);
            }else {
              $('#contact_error').fadeIn().removeClass('alert-success').addClass('alert-danger').html('Something wents wrong !')
            }
          }
        })

      }

    })
  </script>
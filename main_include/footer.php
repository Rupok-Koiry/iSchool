  <!-- Footer Section Start-->
  <div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(114,137,218,0.7)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(114,137,218,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(114,137,218,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#7289da" />
      </g>
    </svg>
  </div>

  <footer class="page-footer font-small unique-color-dark pt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-6">
          <h4 class="logo"><?php echo $row2['logo'] ?></h4>
          <p class="text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure voluptas laudantium fugiat expedita labore. Delectus similique reprehenderit in rerum voluptatibus!</p>
        </div>
        <div class="col-md-3 col-6">
          <h4>get help</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">shipping</a></li>
            <li><a href="#">returns</a></li>
            <li><a href="#">order status</a></li>
            <li><a href="#">payment options</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4>online shop</h4>
          <ul>
            <li><a href="#">watch</a></li>
            <li><a href="#">bag</a></li>
            <li><a href="#">shoes</a></li>
            <li><a href="#">dress</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4>follow us</h4>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
      <div class="container-fluid border-top py-3">
        <h6 class="mb-0 text-center text-white"><?php echo $row2['footer_text'] ?> || <a href="#" data-toggle="modal" data-target="#admin_modal" class="admin"> Admin</a></h6>
      </div>
  </footer>
  </div>
  <!-- Footer Section End-->
  <!--Registration Modal Start -->

  <div class="modal fade" id="registration_modal" tabindex="-1" role="dialog" aria-labelledby="registration_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='registration-close-btn'>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="login-email" id="registration_form">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;  color:#007bff">Register</p>
            <div class="input-group">
              <input type="text" class="form-control" id="registration_username" placeholder="Username" required>
              <div class="ml-3" id="registration-user-error">
              </div>
            </div>
            <div class="input-group my-3">
              <input type="text" class="form-control" id="registration_email" placeholder="Email" required>
              <div class="ml-3" id="registration-email-error">
              </div>
            </div>
            <div class="input-group">
              <input type="text" class="form-control" id="registration_password" placeholder="Password" required>
              <div class="ml-3" id="registration-password-error">
              </div>
            </div>
            <div class="input-group my-3">
              <button name="registration_submit" class="btn" id="registration_submit" type="submit">Register</button>
            </div>
            <p class="login-register-text ml-3">Have an account? <a href="" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#login_modal">Login Here</a>.</p>
            <p class="text-center alert" id="alert-message" style="display: block;"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Registration Modal End -->
  <!--Login Modal Start -->
  <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="login_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="log_close_btn">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="login-email" id="login_form">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;  color:#007bff">Login</p>
            <div class="input-group">
              <input type="email" placeholder="Email" name="login_email" class="form-control" id="login_email" required>
            </div>
            <div class="input-group my-3">
              <input type="password" placeholder="Password" name="login_password" class="form-control" required id="login_password">
            </div>
            <div class="input-group my-3">
              <button name="login_submit" class="btn" type="submit" id="login_submit">
                Login
              </button>
            </div>
            <p class="login-register-text ml-3">Don't have an account? <a href="" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#registration_modal">Register Here</a>.</p>
            <p class="text-center alert" id="alert-message-login" style="display: block;"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Login Modal End -->
  <!--Admin Modal Start -->
  <div class="modal fade" id="admin_modal" tabindex="-1" role="dialog" aria-labelledby="admin_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="admin_close_btn">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="login-email" id="admin_form">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:#007bff">Admin Login</p>
            <div class="input-group">
              <input type="email" placeholder="Email" name="admin_email" class="form-control" id="admin_email" required>
            </div>
            <div class="input-group my-3">
              <input type="password" placeholder="Password" name="admin_password" class="form-control" required id="admin_password">
            </div>
            <div class="input-group my-3">
              <button name="admin_submit" class="btn" type="submit" id="admin_submit">Login</button>
            </div>
            <p class="text-center alert" id="alert-message-admin" style="display: block;"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Admin Modal End -->


  <!-- Optional JavaScript -->
  <!-- jQuery.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Slider Js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
  <!-- External js -->
  <script src="js/scripts.js"></script>
  <!-- Student Ajax Call Js -->
  <script src="js/ajaxrequest.js"></script>
  <!-- Admin Ajax Call Js -->
  <script src="js/adminajaxrequest.js"></script>
  </body>

  </html>
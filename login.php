<?php
require_once('inc/functions.php');
setHeaderName("FocusOn private section");
?>

<div class="register-container">
  <div class="register-box">
    <div class="l-sidebar">
      <div class="l-sidebar-container">
        <div class="l-sidebar-content">
            <div class="avatar">
              <img src="https://www.shareicon.net/data/2016/08/05/806962_user_512x512.png" alt="">
            </div>
            <div class="avatar-welcome">
              <h3>Let's get your set up !</h3>
              <p>
                It should only take a couple of minutes to get started
              </p>
              <div class="next-btn"></div>
            </div>
        </div>
      </div>
    </div>
    <div class="r-sidebar">
      <div class="r-sidebar-container">
        <h3>Create Account</h3>
        <div class="form">
          <form action="" method="GET">
            <div class="form-field">
              <div class="form-field-label">
                <span for="email">Email</span>
              </div>
              <div class="form-field-input">
                <input type="text">
              </div>
            </div>
            <div class="form-field">
              <div class="form-field-label">
                <span for="email">Password</span>
              </div>
              <div class="form-field-input">
                <input type="password">
              </div>
            </div>
            <div class="submit">
              <a href="#" class="submit-btn">Register</a>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  
</div>

<?php
require_once('inc/footer.php');
?>
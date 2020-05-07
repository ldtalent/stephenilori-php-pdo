<?php require_once('./controller/Login.php'); ?>
<?php
  $Login = new Login();
  $Response = [];
  $active = $Login->active;
  if (isset($_POST) && count($_POST) > 0) $Response = $Login->login($_POST);
?>
  <?php require('./nav.php'); ?>
    <main role="main" class="container">
      <div class="container">
        <div class="row justify-content-center mt-10">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
            <?php if (isset($Response['status']) && !$Response['status']) : ?>
            <div class="alert alert-danger" role="alert">
              <span><B>Oops!</B> Invalid Credentials Used.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
              </button>
            </div>
            <?php endif; ?>
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
              <h4 class="h3 mb-3 font-weight-normal text-center">Sign in</h4>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
                <div class="form-group">
                  <label for="inputEmail" class="sr-only">Email address</label>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <div class="form-group">
                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>
              </div>
              <p class="mt-5 text-center mb-3 text-muted">&copy; Ilori Stephen A <?php echo date('Y'); ?></p>
            </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
  </html>

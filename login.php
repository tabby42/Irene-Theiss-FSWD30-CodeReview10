<?php include "partials/header.php";?>
<?php include "lib/loginprocess.php";?>
<!-- Modal -->
<div id="login-modal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">SIGN IN</h4>
        <p class="text-center">Don't have an account yet? <a href="register.php" class="text-uppercase">Sign up here</a></p>
            <p class="text-center">TESTUSER:<br> e-mail: test@gmx.at<br>password: 12341234</p>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
            <?php if (!empty($login_err)) {?>
                  <p class="help-block alert alert-danger"><?php echo $login_err;?></p>
                <?php }
                ?>
            <div class="form-group">
              <label for="email">Email address *</label>
              <input type="text" class="form-control" name="email" placeholder="Email"
              value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
              <?php if (!empty($email_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $email_err;?></p>
              <?php }
              ?>
            </div>
            <div class="form-group">
                <label for="pwd_login">Password *</label>
                <input type="password" class="form-control" name="pwd_login" placeholder="Password">
                <?php if (!empty($login_password_err)) {?>
                  <p class="help-block alert alert-danger"><?php echo $login_password_err;?></p>
                <?php }
                ?>
            </div>
            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "partials/footer.php";?>

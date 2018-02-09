<!-- Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">SIGN IN</h4>
        <p class="text-center">Don't have an account yet? <a href="#" data-toggle="modal" data-target="#register-modal" data-dismiss="modal">Sign up here</a></p>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
            <?php if (!empty($login_err)) {?>
                  <p class="help-block alert alert-danger"><?php echo $login_err;?></p>
                <?php }
                ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username"
                value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                <?php if (!empty($username_err)) {?>
                  <p class="help-block alert alert-danger"><?php echo $username_err;?></p>
                <?php }
                ?>
            </div>
            <div class="form-group">
                <label for="pwd_login">Password</label>
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
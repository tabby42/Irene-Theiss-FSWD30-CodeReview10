<?php include "lib/registration.php";?>
<!-- Modal -->
<div id="register-modal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">REGISTER</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
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
              <label for="email">Email address</label>
              <input type="text" class="form-control" name="email" placeholder="Email"
              value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
              <?php if (!empty($email_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $email_err;?></p>
              <?php }
              ?>
            </div>
            <div class="form-group">
              <label for="pwd">Password</label>
              <input type="password" class="form-control" name="pwd" placeholder="Password">
              <?php if (!empty($password_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $password_err;?></p>
              <?php }
              ?>
            </div>
            <div class="form-group">
              <label for="pwd_confirm">Confirm Password</label>
              <input type="password" class="form-control" name="pwd_confirm" placeholder="Password">
              <?php if (!empty($confirm_password_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $confirm_password_err;?></p>
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
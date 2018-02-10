<?php include "partials/header.php";?>
<?php include "lib/registration.php";?>
<!-- Modal -->
<div id="register-modal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">REGISTER</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
            <div class="form-group">
              <label for="username">First name *</label>
              <input type="text" class="form-control" name="firstname" placeholder="First Name"
              value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
              <?php if (!empty($firstname_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $firstname_err;?></p>
              <?php }
              ?>
            </div>
            <div class="form-group">
              <label for="username">Last name *</label>
              <input type="text" class="form-control" name="lastname" placeholder="Last Name"
              value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
              <?php if (!empty($lastname_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $lastname_err;?></p>
              <?php }
              ?>
            </div>
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
              <label for="pwd">Password *</label>
              <input type="password" class="form-control" name="pwd" placeholder="Password">
              <?php if (!empty($password_err)) {?>
                <p class="help-block alert alert-danger"><?php echo $password_err;?></p>
              <?php }
              ?>
            </div>
            <div class="form-group">
              <label for="pwd_confirm">Confirm Password *</label>
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
<?php include "partials/footer.php";?>

<?php include "partials/header.php";?>
<?php if (!isset($_SESSION['username'])) : ?>
<?php     header("location: login.php");?>
<?php endif ?>

<div id="author-modal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Author</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="get" accept-charset="utf-8">
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

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <span>Big <i class="fa fa-book"></i> Library</span>
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <?php if (isset($_SESSION['username'])): ?>
             <a class="" href="#">
              <span>
              <?php echo $_SESSION['username']; ?>
            </span>
            </a>
          <?php endif ?>
        </li>
        <li>
          <?php if (isset($_SESSION['username'])) : ?>
            <a class="" href="lib/logout.php">
              <span>Logout</span>
            </a>
          <?php endif ?>
        </li>
        <!-- <li>
          <a href="add-author.php" title="add autor">Add Author</a>
        </li> -->
        <li>
          <a href="publishers.php" title="add autor">Publishers</a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
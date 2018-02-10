<?php include "partials/header.php";?>
<?php include "lib/Media.php";?>
<?php if (!isset($_SESSION['username'])) : ?>
<?php     header("location: login.php");?>
<?php endif ?>
<!-- <header id="header" class="pad-row ">
  <h1 class="text-center text-uppercase">Anyone who says<br>they have only one life to live<br>must not know<br>how to read a book.<span><small>&mdash; Author Unknown &mdash;</small></span>
  </h1>
</header> -->
<!-- /header -->
<div>
	<?php $media = Media::getAllMedia(); 
			//var_dump($media);?>
</div>
<div class="container-fluid">
  <div class="row dark-bg pad-row-lr media-container">
  	<!-- Media Items here-->
  	<?php Media::displayMedia($media);?>
  </div>
</div><!-- /.container-fluid -->

<?php include "partials/footer.php";?>

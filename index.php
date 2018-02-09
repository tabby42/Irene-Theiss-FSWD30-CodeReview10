<?php include "partials/header.php";?>
<?php include "lib/Media.php";?>

<header id="header" class="pad-row ">
  <h1 class="text-center text-uppercase">Anyone who says<br>they have only one life to live<br>must not know<br>how to read a book.<span><small>&mdash; Author Unknown &mdash;</small></span>
  </h1>
</header><!-- /header -->
<div>
	<?php Media::getAllMedia();?>
</div>

<?php include "partials/footer.php";?>

<?php include "partials/header.php";?>
<div class="container-fluid">
  <div class="row dark-bg  media-container detail-container">
  	<div class="col-md-2 hidden-xs">
  	</div>
	<?php
		include "lib/Media.php";
		if($_SERVER["REQUEST_METHOD"] == "GET"){
			if (isset($_GET["mediaId"])) {
				$id = $_GET["mediaId"];
				//var_dump($id);
				$media = new Media();
				$media->mediaId = $id;
				if ($media->getMediaById()) {
					$media = $media->getMediaById();
					$media->displayMediaDetails();
				}
			} else {
				echo "Media could not be found.";
			}
		}
	?>
	<div class="col-md-2 hidden-xs">
  	</div>
  </div>
</div><!-- /.container-fluid -->
<?php include "partials/footer.php";?>

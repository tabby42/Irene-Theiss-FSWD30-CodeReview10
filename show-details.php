<?php
	include "lib/Media.php";
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if (isset($_GET["mediaId"])) {
			$id = $_GET["mediaId"];
			//var_dump($id);
			$media = new Media();
			$media->mediaId = $id;
		} else {
			echo "Media could not be found.";
		}
	}
?>
<?php include "partials/header.php";?>

<?php include "partials/footer.php";?>

<?php 
class Media {
	//properties
	public $mediaId;
	public $title;
	public $imageUrl;
	public $isbn;
	public $publishDate;
	public $mediaType;
	public $author;
	public $genre;
	public $publisher;

	//constructor
	function __construct() {
        
    }

	static function constructWithParam($id, $title, $imageUrl, $isbn, 
		$publishDate, $mediatype, $author, $genre, $publisher) {
		$instance = new self();
		$instance->mediaId = $id;
		$instance->title = $title;
		$instance->imageUrl = $imageUrl;
		$instance->isbn = $isbn;
		$instance->publishDate = $publishDate;
		$instance->mediatype = $mediatype;
		$instance->author = $author;
		$instance->genre = $genre;
		$instance->publisher = $publisher;
        return $instance;
	}

	static function getAllMedia() {
		$medialist = array();
		$connection = openConnection();
		$sql = "SELECT * FROM getMedia";

		if($stmt = $connection->prepare($sql)){
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                /// Store result
                $stmt->store_result();
                if($stmt->num_rows > 0){ 
                	// Bind result variables
                    $stmt->bind_result($retid, $rettitle, $retimageUrl, $retisbn,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher);
                	 while ($stmt->fetch()) {
				        //printf ("%s \n", $retid);
				        array_push($medialist, Media::constructWithParam($retid, $rettitle, $retimageUrl, $retisbn,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher) );
				    }
            	}
        	} 
    	}

    	return $medialist;
	}

	static function displayMedia($medialist) {
		ob_start();
		foreach ($medialist as $item) {
			//printf ("%s \n", $item->title);
			?>
			<div class="col-lg-3 col-md-4 col-sm-6 media-item" data-id="<?php echo $item->mediaId; ?>">
        		<div class="media">
				  <div class="media-center">
				      <img class="media-object thumbnail" src="<?php echo $item->imageUrl; ?>" alt="Media Thumbnail">
				  </div>
				  <div class="media-body text-center">
				  	<h4 class="media-heading text-uppercase"><?php echo $item->title; ?></h4>
				    <h6>by <span class="italic"><?php echo $item->author; ?></span> | published by <span class="italic"><?php echo $item->publisher; ?><span></h6>
				    <h6>published on <span class="italic"><?php echo $item->publishDate; ?></span> <br>
				    	<?php if (!empty($item->isbn)): ?>
				     		ISBN <span class="italic"><?php echo $item->isbn; ?><span>
				    	<?php endif ?>
				     </h6>
				    <span class="label label-primary"><?php echo $item->mediatype; ?></span>
				    <span class="label label-info"><?php echo $item->genre; ?></span>
				</div>
				</div>
    		</div>
		<?php }
		$content = ob_get_contents();
		ob_get_clean();
		echo $content;
	}

}

?>
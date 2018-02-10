<?php 
class Media {
	//properties
	public $mediaId;
	public $title;
	public $imageUrl;
	public $isbn;
	public $shortDesc;
	public $publishDate;
	public $mediaType;
	public $author;
	public $genre;
	public $publisher;
	public $isReserved;

	//constructor
	function __construct() {
        
    }
    //constructor overload
	static function constructWithParam($id, $title, $imageUrl, $isbn, $shortDesc,
		$publishDate, $mediatype, $author, $genre, $publisher, $isReserved) {
		$instance = new self();
		$instance->mediaId = $id;
		$instance->title = $title;
		$instance->imageUrl = $imageUrl;
		$instance->isbn = $isbn;
		$instance->shortDesc= $shortDesc;
		$instance->publishDate = $publishDate;
		$instance->mediatype = $mediatype;
		$instance->author = $author;
		$instance->genre = $genre;
		$instance->publisher = $publisher;
		$instance->isReserved = $isReserved;
        return $instance;
	}

	static function getAllMedia($filter = null) {
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
                    $stmt->bind_result($retid, $rettitle, $retimageUrl, $retisbn, $retshortDesc,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher, $retReserved);
                	 while ($stmt->fetch()) {
				        //printf ("%s \n", $retid);
				        array_push($medialist, Media::constructWithParam($retid, $rettitle, $retimageUrl, $retisbn, $retshortDesc,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher, $retReserved) );
				    }
				    $stmt->close();
				    $connection->close();
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
				    <span class="label label-primary"><?php echo $item->mediatype; ?></span>
				    <span class="label label-info"><?php echo $item->genre; ?></span>
				    <form action="show-details.php" method="get" accept-charset="utf-8">
				    	<input type="hidden" name="mediaId" value="<?php echo $item->mediaId; ?>">
            			<button type="submit" class="btn btn-primary btn-sm">Show details</button>
				    </form>
				</div>
				</div>
    		</div>
		<?php }
		$content = ob_get_contents();
		ob_get_clean();
		echo $content;
	}

	function getMediaById () {
		$connection = openConnection();
		$sql = "SELECT * FROM getMedia WHERE id = ?";
		if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_id);
            // Set parameters
            $param_id = $this->mediaId;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                if($stmt->num_rows == 1){
                	$stmt->bind_result($retid, $rettitle, $retimageUrl, $retisbn, $retshortDesc,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher, $retReserved);
                	while ($stmt->fetch()) {
				        //printf ("%s \n", $rettitle);
				        $this->title = $rettitle;
				        $this->imageUrl = $retimageUrl;
				        $this->isbn = $retisbn;
				        $this->shortDesc = $retshortDesc;
				        $this->publishDate = $retpublishDate;
				        $this->mediatype = $retmediatype;
				        $this->author = $retauthor;
				        $this->genre = $retgenre;
				        $this->publisher = $retpublisher;
				        $this->isReserved = $retReserved;
				    }
                    $stmt->close();
                } else{
                	$stmt->close();
        			$connection->close();
                	return false;
                }
            } else{
            	$stmt->close();
                echo "Something went wrong. Please try again later.";
            }
        }
        $connection->close();
        return $this;
	}

	function displayMediaDetails() {
		ob_start(); ?>
		<div class="col-lg-8 col-md-8 col-sm-12 media-item item-detail">
    		<div class="media">
			  <div class="media-body text-center">
		  		<div class="media-center">
			      <img class="media-object thumbnail" src="<?php echo $this->imageUrl; ?>" alt="Media Thumbnail">
			  	</div>
		  		<h4 class="media-heading text-uppercase"><?php echo $this->title; ?></h4>
			    <h6>by <span class="italic"><?php echo $this->author; ?></span> | published by <span class="italic"><?php echo $this->publisher; ?><span></h6>
		  		<span class="label label-primary"><?php echo $this->mediatype; ?></span>
			    <span class="label label-info"><?php echo $this->genre; ?></span>
			    <?php if ($this->isReserved === "true"): ?>
					<span class="label label-primary">reserved</span>
				<?php endif ?>
				<?php if ($this->isReserved === "false"): ?>
					<span class="label label-primary">available</span>
				<?php endif ?>
		  		<h6>published on <span class="italic"><?php echo $this->publishDate; ?></span> <br>
			    	<?php if (!empty($this->isbn)): ?>
			     		ISBN <span class="italic"><?php echo $this->isbn; ?><span>
			    	<?php endif ?>
			     </h6>
			    <h6 class="media-heading text-uppercase alfa">Description</h6>
			    <p class="desc"><?php echo $this->shortDesc; ?></p>
				
			  </div>
		  </div>
		</div>
		<?php 
		$content = ob_get_contents();
		ob_get_clean();
		echo $content;
	}

}

?>
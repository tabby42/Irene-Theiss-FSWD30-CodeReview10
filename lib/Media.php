<?php require_once "lib/dbconfig.php";
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
		$instance->id = $id;
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
				        //printf ("%s \n", $rettitle);
				        array_push($medialist, Media:constructWithParam($retid, $rettitle, $retimageUrl, $retisbn,
                    	$retpublishDate, $retmediatype, $retauthor, $retgenre, $retpublisher) );
				    }
            	}
        	} 
    	}
    	
    	return $medialist;
	}

}

?>
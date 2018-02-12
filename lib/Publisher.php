
<?php 
class Publisher {

	public $name;
	public $size;
	public $address;
	public $cityCounry;
	public $title;
	public $author;
	public $mediatype;

	//constructor
	function __construct() {
        
    }

    static function createPubWithParam($name, $size, $address, $cityCounry) {
		$instance = new self();
    	$instance->name = $name;
    	$instance->size = $size;
    	$instance->address = $address;
    	$instance->cityCounry = $cityCounry;
    	return $instance;
    }

	static function getPublishers($filter = null) {
		$publisherlist = array();
		$connection = openConnection();
		$sql = "SELECT * FROM getPublishers GROUP BY id";
		if($stmt = $connection->prepare($sql)){
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                /// Store result
                $stmt->store_result();
                if($stmt->num_rows > 0){ 
                	// Bind result variables
                    $stmt->bind_result($retname, $retsize, $retaddress, $retcitycountry);
                	 while ($stmt->fetch()) {
				        //printf ("%s \n", $retid);
				        array_push($publisherlist, Publisher::createPubWithParam($retname, $retsize, $retaddress, $retcitycountry) );
				    }
				    $stmt->close();
				    $connection->close();
            	}
        	} 
    	}
    	return json_encode($publisherlist);
	}
}
?>
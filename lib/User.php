<?php 
Class User {
    //properties
	public $id;
    public $firstname;
    public $lastname;
	public $email;
	public $password;
    //constructor
	function __construct() {
        
    }
    //constructor overload
	static function fakeConstruct($firstname, $lastname,  $email, $password) {
		$instance = new self();
		$instance->firstname = $firstname;
        $instance->lastname = $lastname;
		$instance->email = $email;
		$instance->password = $password;
        return $instance;
	}
	
	function checkEmailExists () {
        $connection = openConnection();
		// Prepare a select statement
        $sql = "SELECT id FROM user WHERE email = ?";
        
        if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            // Set parameters
            $param_email = $this->email;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $stmt->close();
                    return false;
                } else{
                	$stmt->close();
                    return true;
                }
            } else{
            	$stmt->close();
                echo "Something went wrong. Please try again later.";
            }
        }
        $connection->close();
	}

	function checkEmail() {
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		  return false;
		}
		return true;
	}

	function checkPassword() {
		if (strlen($this->password) < 8) {
			return false;
		}
		return true;
	}

	function createNewUser() {
        $connection = openConnection();
		 //statement
		 $sql = "INSERT INTO user (firstname, lastname, pwd, email) VALUES (?, ?, ?, ?)";
		 //prepare statement
		 if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_firstname, $param_lastname, $param_password, $param_email);
            // Set parameters 
            $param_firstname = $connection->real_escape_string($this->firstname);
            $param_lastname = $connection->real_escape_string($this->lastname);
            //password_hash -> creates a password hash and
            //generates and applies a random salt automatically
            $param_password = password_hash($connection->real_escape_string($this->password), PASSWORD_DEFAULT); 
            $param_email = $connection->real_escape_string($this->email);
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            	$stmt->close();
            } else{
                echo "Something went wrong. Please try again later.";
            	$stmt->close();
            } 
        }
        $connection->close();
	}

	function checkCredentials() {
        $connection = openConnection();
		 //statement
		$sql = "SELECT email, pwd FROM user WHERE email = ?";

		if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            // Set parameters
            $param_email = $this->email;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                /// Store result
                $stmt->store_result();
                // Check if email exists, if yes then verify password
                if($stmt->num_rows == 1){ 
                	// Bind result variables
                    $stmt->bind_result($username, $hashed_password);
                    if($stmt->fetch()){
                    	//compare passwords
                    	if(password_verify($this->password, $hashed_password)){
            				$stmt->close();
        					$connection->close();
                            return true;
                        } else{
            				$stmt->close();
        					$connection->close();
                            return false;
                        }
                    }
                } else {
            		$stmt->close();
        			$connection->close();
                	return false;
                }
            } 
        }
	}


}


?>
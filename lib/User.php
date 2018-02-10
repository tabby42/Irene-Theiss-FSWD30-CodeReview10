<?php 

Class User {
	public $id;
    public $firstname;
    public $lastname;
	public $email;
	public $password;

	function __construct() {
        
    }

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

	// static function getUserInfo ($username){
	// 	$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// 	$connection->set_charset("utf8mb4");
	// 	// Check connection
	// 	if($connection === false){
	// 	    die("ERROR: Could not connect. " . $mysqli->connect_error);
	// 	}
	// 	 //statement
	// 	$sql = "SELECT * FROM userInfo WHERE username = ?";
	// 	if($stmt = $connection->prepare($sql)){
 //            // Bind variables to the prepared statement as parameters
 //            $stmt->bind_param("s", $param_username);
 //            // Set parameters
 //            $param_username = $username;
 //            // Attempt to execute the prepared statement
 //            if($stmt->execute()){
 //                /// Store result
 //                $stmt->store_result();
 //                // Check if username exists, if yes then verify password
 //                if($stmt->num_rows == 1){ 
 //                	// Bind result variables
 //                    $stmt->bind_result($retid, $retusername, $retemail, $retfirstname,
 //                    	$retlastname, $retphoneCountryCode, $retPhoneNr, $retStreet,
 //                    	$retStreetNr, $retZipcode, $retCity, $retCountry, $retDriversLicense);
 //                    if($stmt->fetch()){
 //                    	$inst = new self();
 //                    	$inst->id = $retid;
 //                    	$inst->username = $retusername;
 //                    	$inst->email = $retemail;
 //                    	$inst->firstname = $retfirstname;
 //                    	$inst->lastname = $retlastname;
 //                    	$inst->phoneCountryCode = $retphoneCountryCode;
 //                    	$inst->phoneNr = $retPhoneNr;
 //                    	$inst->street = $retStreet;
 //                    	$inst->streetNr = $retStreetNr;
 //                    	$inst->zipcode = $retZipcode;
 //                    	$inst->city = $retCity;
 //                    	$inst->country = $retCountry;
 //                    	$inst->driversLicenseNr = $retDriversLicense;
 //                    	return $inst;
 //         //            	 while ($stmt->fetch()) {
	// 				    //     printf ("%s (%s)\n", $name, $code);
	// 				    // }
 //                    }
 //                } else {
 //            		$stmt->close();
 //        			$connection->close();
 //                	return false;
 //                }
 //            } 
 //        }

	// }

	// function updateUserInfo() {
	// 	echo "function called";
	// 	$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// 	$connection->set_charset("utf8mb4");
	// 	// Check connection
	// 	if($connection === false){
	// 	    die("ERROR: Could not connect. " . $mysqli->connect_error);
	// 	}
	// 	 //statement
	// 	 $sql = "UPDATE user SET email = ?, firstname = ? WHERE username = ?";
	// 	 if($stmt = $connection->prepare($sql)){
 //            // Bind variables to the prepared statement as parameters
 //            $stmt->bind_param("sss", $param_email, $param_username, $param_firstname);
 //            // Set parameters
 //            $param_email = $this->email;
 //            $param_username = $this->username;
 //            $param_firstname = $this->firstname;
 //            // Attempt to execute the prepared statement
 //            if($stmt->execute()){
 //                //echo "Executed";
 //            } else{
 //                echo "Something went wrong. Please try again later.";
 //            } 
 //        } else {
 //        	echo "Something went wrong. Please try again later.";
 //        }
 //    	$stmt->close();
 //        $connection->close();
	// }

}


?>
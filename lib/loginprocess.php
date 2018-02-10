<?php 
	include "User.php";
	//error variables
	$email_err = $login_password_err = $login_err = "";
	//process form data
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 
		$user = new User();
		//validate username
    	if(empty(trim($_POST["email"]))){
    		$email_err = "Please enter your e-mail address.";
    	} else {
    		$user->email = trim($_POST['email']);
    		if (!$user->checkEmail()) {
	    		$email_err = "Please enter a valid e-mail address.";
	    	} else {
	    		$email_err = "";
	    	}
    	}
    	// Check if password is empty
	    if(empty(trim($_POST['pwd_login']))){
	        $login_password_err = 'Please enter your password.';
	    } else{
	        $user->password = trim($_POST['pwd_login']);
	        $login_password_err = "";
	    }

	    if ($email_err === "" && $login_password_err === "") {
	    	if (!$user->checkCredentials()) {
	    		$login_err = "Access denied.";
	    	} else {
	    		/* Password is correct, so start a new session and
                save the username to the session */
	    		$login_err = "";
	    		session_start();
                $_SESSION['username'] = $user->email;      
                header("location: index.php");
	    	}
	    }
	}

?>
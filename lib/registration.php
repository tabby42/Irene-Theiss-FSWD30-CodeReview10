<?php 
	include "User.php";
	// Define variables and initialize with empty values
	$confirm_password = "";
	$username_err = $email_err = $password_err = $confirm_password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//create new user object
		$newUser = User::fakeConstruct(trim($_POST["username"]), trim($_POST["email"]), trim($_POST["pwd"]));
		//validate username
		if(empty($newUser->username)){
	        $username_err = "Please enter a username.";
	    } else {
	    	if (!$newUser->checkUsername()) {
	    		$username_err = "Username is already taken.";
	    	} else {
	    		$username_err = "";
	    	}
	    }
	    //validate email
	   	if(empty($newUser->email)){
	        $email_err = "Please enter an e-mail address.";
	    } else {
	    	if (!$newUser->checkEmail()) {
	    		$email_err = "Please enter a valid e-mail address.";
	    	} else {
	    		$email_err = "";
	    	}
	    }
	    //validate password
	    if(empty($newUser->password)){
	        $password_err = "Please enter a password.";     
	    } else {
	    	if (!$newUser->checkPassword()) {
	    		$password_err = "Password must have at least 8 characters";
	    	} else {
	    		$password_err = "";
	    	}
	    }
	    //compare with confirm
	    if(empty(trim($_POST['pwd_confirm']))){
	        $confirm_password_err = "Please confirm password.";   
	    } else {
	    	$confirm_password = trim($_POST['pwd_confirm']);
	    	if ($newUser->password !== $confirm_password) {
	    		$confirm_password_err = "Passwords don't match.";
	    	} else {
	    		$confirm_password_err = "";
	    	}
	    }
	    //check error messages before inserting to database
	    if ($username_err === "" && $email_err === "" && $password_err === "" && $confirm_password_err === "") {
	    	$newUser->createNewUser();
	    } else {

	    }
	}
?>
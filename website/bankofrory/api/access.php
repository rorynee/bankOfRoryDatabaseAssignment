<?php
/* Login, Logout, Error function*/

// Valadate the Login
function validateLogin() {
	 $app = Slim\Slim::getInstance();  // Creating a Slim instance
	 $request = $app->request(); // Creating a Slim request object
	 // Taking in the Username and password
	 $username = htmlspecialchars($request->post('username')); 
	 $password = $request->post('password');
	 
	// Encrypting the password and checking the password and the user name againest the database 
	$encript_Pass = md5( $password );
    $query = "CALL CHECK_LOGIN_DETAILS('$username','$encript_Pass');";
	$db = dbConn::getConnection(); // Create an instance of the database
    $result = $db->query($query);
    $current_user = $result->fetch();

	if(!empty($current_user)){ // If it is in the database
		
		// Add session variables used to secure pages and for role controle
		$_SESSION['user_id'] = $current_user['account_no'];
		$_SESSION['fname'] = $current_user['first_name'];
		$_SESSION['lname'] = $current_user['last_name'];
		$_SESSION['role'] = $current_user['user_roles_role_id'];
		$_SESSION['user_token'] = $current_user['account_no'];
		
		
		if($current_user['user_roles_role_id'] == 1 || $current_user['user_roles_role_id'] == 2){
			// Redirest to the Admin section or the support section	
			$app->redirect('dashboard/admin/'.$current_user['account_no']);
			
		}else{
			// Redirect to the User section
			$app->redirect('dashboard/user/'.$current_user['account_no']);
		}
		
	}else{ 
		
		 $error =  array("error" =>"Login Details Not Found");
		 // Render the page
		$app->render('../api/resources/login.php', array('myerror' => $error ));
	}
  }
  
 // Log a a user (all users) out of the system 
 function logout(){
    $app = Slim\Slim::getInstance();
	
	dbConn::close_connection(); // Close the connection to the MySQL database
	mongoConn::close_connection(); // Close the connection to the NoSQL database
	
	// remove all session variables
	session_unset(); 
	// destroy the session 
	session_destroy();

	// User Message
    $message =  array("message" =>"You Have Been Logged Out");
	// Render the page
	$app->render('../api/resources/login.php', array('finish' => $message ));

}

// General Purpose Error Page - Used mainly to keep users out of the admin section and the support section.
// Also used to keep out people not logged on to the system.
function error(){
    $app = Slim\Slim::getInstance();

	dbConn::close_connection(); // Close the connection to the MySQL database
	mongoConn::close_connection(); // Close the connection to the NoSQL database
	
	// remove all session variables
	session_unset(); 
	// destroy the session 
	session_destroy();
	// Show the error
	$error = array("error" =>"Unauthorised Access. Please Login to use this site.");	
	$app->render('../api/resources/error.php', array('myerror' => $error ));

}
 
?>
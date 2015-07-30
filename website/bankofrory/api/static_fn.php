<?php
/* Function to show the Front end static pages*/
// Show the Main Page
function getMain() {
	 $app = Slim\Slim::getInstance();
	 $app->render('../api/resources/main.php');
}

// Show the About Page
function getabout() {
	 $app = Slim\Slim::getInstance();
	 $app->render('../api/resources/about.php');
}
// Show the Login Page
function getlogin() {
	 $app = Slim\Slim::getInstance();
	 $app->render('../api/resources/login.php');
}
// Show the Signup Page
function getsignup() {
	 $app = Slim\Slim::getInstance();
	 $app->render('../api/resources/signup.php');
}

?>
<?php
//db connection class using singleton pattern
class dbConn{
 
	//variable to hold connection object.
	protected static $db;
	//private construct - class cannot be instatiated externally.
	private function __construct() {
		$dsn = 'mysql:host=localhost;dbname=bankofrorybd';
		$username = 'root';
		$password = '';
	 	 
		try {
			// assign PDO object to db variable
			self::$db = new PDO( $dsn, $username, $password );
		}
		catch (PDOException $e) {
			echo "Connection Error: Please Try Later";
		
		}
	 
	}
	 
	// get connection function. Static method - accessible without instantiation
	public static function getConnection() {
		
		if (!self::$db) {
		
			new dbConn(); //new connection object.
		}
		 
	return self::$db;
	}
	// close the connection to the database
	public static function close_connection(){
		self::$db = null;
	}
}

?>
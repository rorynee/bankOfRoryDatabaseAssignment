<?php
//db connection class using singleton pattern
class mongoConn{
 
	//variable to hold connection object.
	protected static $dbmongo;
	 
	//private construct - class cannot be instatiated externally.
	private function __construct() {

		try {
			self::$dbmongo = new Mongo(); // new mongo object
		}
		catch (Exception $e) {
		
			echo "Connection Error: Please Try Later";
		}
	}
	// get connection function. Static method - accessible without instantiation
	public static function getConnection() {
	 
		if (!self::$dbmongo) {
			new mongoConn(); //new connection object.
		}
		$dbname = self::$dbmongo->selectDB('bankofrory'); // Set the table
		$ticket = $dbname->ticket; // set the collection
		
	return $ticket;
	}
	// close the connection to the database
	public static function close_connection(){
	
		self::$dbmongo = null;
	}
}
?>
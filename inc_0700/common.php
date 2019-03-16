<?php
require 'inc_0700/config_inc.php';
//provide credentials to connect with the database
require 'credentials.php';
//Common class definition

class Common 
{ 
	private static $instance = null; #stores a reference to this class

	private function __construct() 
	{#establishes a mysqli connection - private constructor prevents direct instance creation 
		#hostname, username, password, database
		$this->dbHandle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME) or die(trigger_error(mysqli_connect_error(), E_USER_ERROR)); 
	}// end constructor

	/** 
	* Creates a single instance of the database connection 
	* 
	* @return object singleton instance of the database connection
	* @access public 
	*/ 
	public static function conn() 
    { 
      if(self::$instance == null){self::$instance = new self;}#only create instance if does not exist
      return self::$instance->dbHandle;
    }//end conn
}//end class

//functions

function getCategoryData() {
    //create the query 
    $sql = 'SELECT * FROM g1p4_categories';
    $result = mysqli_query(Common::conn(),$sql) or die(trigger_error(mysqli_error(Common::conn()), E_USER_ERROR));
    return $result;    
}//end getCategoryData

function getFeedData($catID) {
	$sql = "SELECT * FROM g1p4_feed
			WHERE CategoryID = $catID";
    $result = mysqli_query(Common::conn(),$sql) or die(trigger_error(mysqli_error(Common::conn()), E_USER_ERROR));
    return $result; 
}//end getFeedData

function ClearAll() {
    unset($_SESSION['feeds']);
}

function ClearFeed($request) {
    unset($_SESSION['feeds'][$request]);

}
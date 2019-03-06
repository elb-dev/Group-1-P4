
<?php 
/*
Login to Database with only SELECT, UPDATE and INSERT permissions.
*/ 
define('SERVER', ''); #DB Host URL
define('DBNAME','');  #Database name
define('PASSWORD', ''); #Password   
define('USERNAME','');     #userName
/*
Uses constants to create a PDO database connection
@return PDO MySQL database connection object.
*/
function db_conn() {
    try {
        $conn = new PDO('mysql:host=' . SERVER . ';dbname='  . DBNAME . ';', USERNAME, PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}

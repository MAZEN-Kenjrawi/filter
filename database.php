<?php
global $db;
class Database{

	private $connection; 

	/*------------------------------------------------------------------------------------------BREAK */
	public function __construct(){
		$this->connection = mysqli_connect('localhost','root','','test');

		mysqli_query($this->connection ,"SET NAMES 'utf8'");
		mysqli_query($this->connection ,"SET CHARACTER SET utf8");
		mysqli_query($this->connection ,"SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

		if(mysqli_connect_error($this->connection)){	
			exit("Error Connecttin to my sql :".mysqli_connect_error($this->connection));
		}
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function set_query($query){
		$run = mysqli_query($this->connection, $query);
		$results = NULL;
		if($run){
			while($row = mysqli_fetch_assoc($run)){
				$results[] = $row;
			}
			if($results){
				return $results;
			}
		}
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function get_data_form($table_name){
		$sql = 'SELECT ProductBarcode FROM '.$table_name;
		$results = self::set_query($sql);
		return $results;
	}
};	
$db = new Database;
?>

<?php
 
	function connect(){

		//Connect To Database
		$hostname='mysqldb.its.utexas.edu';
		$username='XXXXX';
		$password='XXXXX';
		$dbname='XXXXX';

		$con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		//return $con;
		return $con;

	}
	
	function disconnect($connection) {
		
		return mysql_close($connection);
		
	}
  
?>
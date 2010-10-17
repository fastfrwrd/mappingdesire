<?php
 
	function connect(){

		//Connect To Database
		$hostname='mysqldb.its.utexas.edu';
		$username='fa_dfs_prod';
		$password='$erp3nT@r_H1$$';
		$dbname='fa_dfs_prod';

		$con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		mysql_select_db($dbname);
		
		//return $con;
		return $con;

	}
	
	function disconnect($connection) {
		
		return mysql_close($connection);
		
	}
  
?>
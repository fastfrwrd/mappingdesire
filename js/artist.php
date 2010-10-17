<?php
	require '../connect.inc';
	$id = $_GET['id'];
	$con = connect();
	
	$query = 'SELECT * FROM `artists` WHERE id=';
	$query .= $id;
	$result = mysql_query($query);
	disconnect($con);
	
	while ($item = mysql_fetch_assoc($result)){
		$html = '<img style="float:right; width:112.5px; height:150px;" src="../images/bio/' . $item['photo_url'] . '" />
		<div id="name"><strong>' . $item['name'] . '</strong></div>
		<div id="title"><em>' . $item['title'] . '</em></div>
		<div id="description">' . urldecode($item['description']) . '</div>';
	}
	
	echo $html;

?>
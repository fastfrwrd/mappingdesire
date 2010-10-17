<?php

require 'connect.inc';

function getRandHotSpots($sort) {
	if($sort==1) {
		$order = "id DESC";
	} else if($sort==2) {
		$order = "title ASC";
	} else if($sort==3) {
		$order = "views DESC";
	}
	
	$con = connect();
	
	$query = 'SELECT * FROM `hotspots` ORDER BY '.$order;
	$result = mysql_query($query);
	disconnect($con);
	
	$hotspots = array();

	if ( $result ) {
		$hotspots['result'] = 1;
		$hotspots['total'] = mysql_num_rows($result);
		$hotspots['hotspots'] = array();
		while($row = mysql_fetch_assoc($result)){
			array_push($hotspots['hotspots'],$row);
		}
		
		return $hotspots;
	} else {
		return $hotspots['results'] = 0;
	}
	
}

function getHotSpots($max = 9999,$order = "title") {
	
	$con = connect();
	
	$query = 'SELECT * FROM `hotspots` ORDER BY `'.$order.'` LIMIT '.$max;
	$result = mysql_query($query);
	disconnect($con);
	
	$hotspots = array();

	if ( $result ) {
		$hotspots['result'] = 1;
		$hotspots['total'] = mysql_num_rows($result);
		$hotspots['hotspots'] = array();
		while($row = mysql_fetch_assoc($result)){
			array_push($hotspots['hotspots'],$row);
		}
		return $hotspots;
	} else {
		return $hotspots['results'] = 0;
	}
	
}

function getHotSpot( $id ) {
	
	$con = connect();
	
	$query = 'SELECT * FROM `hotspots` WHERE `id` = '.$id.' LIMIT 1';
	$result = mysql_query($query);
	
	$hotspots = array();

	if ( $result ) {
		$hotspots['result'] = 1;
		$hotspots['total'] = mysql_num_rows($result);
		$hotspots['hotspots'] = array();
		while($row = mysql_fetch_assoc($result)){
			array_push($hotspots['hotspots'],$row);
			$new_view = $row['views']+1;
		}
		$pcq = "UPDATE hotspots SET views=".$new_view." WHERE id=".$id;
		$pcr = mysql_query($pcq);
		disconnect($con);
		return $hotspots;
	} else {
		disconnect($con);
		return $hotspots['results'] = 0;
	}
	
	
	
}
function getDescription ( $id ) {
	$con = connect();
	
	$query = 'SELECT * FROM `hotspots` WHERE `title` = \''.$name.'\' LIMIT 1';
	//return $query;
	$result = mysql_query($query);
	disconnect($con);

	if ( $result ) {
		$row = mysql_fetch_assoc($result);
		//return $row;
		if( $row ) {
			return addslashes($row['description']);
		} else
			return "";
	} else {
		return "";
	}
	
}

function getTabText($name) {

	$con = connect();
	
	$query = 'SELECT * FROM `text` WHERE `title` = \''.$name.'\' LIMIT 1';
	//return $query;
	$result = mysql_query($query);
	disconnect($con);

	if ( $result ) {
		$row = mysql_fetch_assoc($result);
		//return $row;
		if( $row ) {
			return addslashes($row['description']);
		} else
			return "";
	} else {
		return "";
	}

}

function getArtistList() {

	$con = connect();
	
	$query = 'SELECT * FROM `artists` ORDER BY `id` ASC';
	$list_result = mysql_query($query);
	disconnect($con);
	
	$html = "";
	$list = array();
	while($row = mysql_fetch_assoc($list_result)){
		$html .= '<li><a style="text-decoration:none;" href="javascript:artistReplace(' . $row['id'] . ')">' . $row['name'] . '</a></li><li>   <em style="font-size:9px;">'.$row['title'].'</em></li>';
	}
	
	return $html;
	
}

function convertType($type) {
	if ($type==1) {
		return "iclip";
	} else if($type==2) {
		return "ctour";
	} else {
		return NULL;
	}
}

?>
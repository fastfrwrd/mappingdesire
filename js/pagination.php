<?php

require '../functions.php';

$page = $_GET['page'];
$results = getRandHotSpots($_GET['sort']);
$spots = $results['hotspots'];

for($i=($page*16); $i<((16*($page+1))); $i++) {
	if($spots[$i]['type'] == 1 || $spots[$i]['type'] == 2 ) {
		echo '<li id="'.$spots[$i]['id'].'" class="'.convertType($spots[$i]['type']).'" onclick="clickFunction(&#39; &#39;,'.$spots[$i]['id'].','.$spots[$i]['type'].');">'.$spots[$i]['title'].'</li>';
	}
}

?>
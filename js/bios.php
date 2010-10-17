<?php
require '../functions.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="../css/greybox.css" type="text/css" media="screen" rel="stylesheet" />
<script type="text/javascript" src="greybox/greybox.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">

function artistReplace(id) {
	$.ajax({
		type: "GET",
		url: "artist.php",
		data: "id=" + id,
		success: function(html){
			$('#content').empty();
			$('#content').append(html);
		}
	});
}

</script>
</head>
<body>
<?php
	echo '
	<div id="select" style="float:left; border:solid; height:300px; width:40%; padding:5px;">
		<ul id="artistlist" style="list-style:none;">'.
			getArtistList()
		.'</ul>
	</div>
	<div id="bio">
		<p id="content" style="position:absolute; left:300px;">Click any of the names on the left to view information about the artists behind <strong>mappingDESIRE</strong>.</p>
	</div>';
?>
</body>
</html>
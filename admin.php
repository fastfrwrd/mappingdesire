<?php 

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	include 'functions.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
	
		<title>Mapping Desire - Admin</title>
		
		<link href="css/style.css" type="text/css" media="screen" rel="stylesheet" />
		<link rel="stylesheet" href="css/ui.tabs.css" type="text/css" media="print, projection, screen">
		<link rel="json" type="application/json" href="json.php" />
		
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA2Img7Sd_v71BcEq_kW2OehTFYDxjVrB-MjeUNIRG0EumMI91pRQPUzT6L-hylHS0VxJDF-AdmNPrDw" type="text/javascript"></script>
		<script src="js/ajaxupload.js" type="text/javascript"></script>
		<script src="js/upload.js" type="text/javascript"></script>
		<script src="js/ui.core.js" type="text/javascript"></script>
        <script src="js/ui.tabs.js" type="text/javascript"></script>
		<script src="js/adminmap.js" type="text/javascript"></script>
		
		<meta name="email" content="" />
		<meta name="copyright" content="" />
    	<meta name="author" content="" />
    	<meta name="Charset" content="UTF-8" />
    	<meta name="Revisit-after" content="7 days" />
    	<meta name="zipcode" content="78705" />
    	<meta http-equiv="Content-Language" content="en-us" />
    	<meta name="description" content="" />
    	<meta name="keywords" lang="en" content="" />

	</head>
	
	<body onload="initialize()" onunload="GUnload()">
		<div id="tabs" class="admintabs">
			<ul>
				<li><a href="#hotspots"><span>Hot Spots</span></a></li>
				<li><a href="#about"><span>About</span></a></li>
				<li><a href="#contribute"><span>Contribute</span></a></li>
				<li><a href="#desire"><span>Desire</span></a></li>
			</ul>
			<div id="hotspots">
				<div id="sort">
					<select id="changeView" name="view" onclick="showList(this.value)">
						<option value="title">Title</option>
						<option value="location">Location</option>
					</select>
					<input type="button" value="reverse" onclick="reverseList()" />
				</div>
				<div id="lists">
					<select id="listtitle" size="13">
						<?php
						$hotspots = getHotSpots(9999,"title");
						foreach ( $hotspots['hotspots'] as $hotspot ) {
							echo '<option onclick="showHotSpotInfo('.$hotspot['id'].')">'.stripcslashes($hotspot['title']).'</option>';
						}
						?> 
					</select>
					<select id="listlocation" size="13">
						<?php
						$hotspots = getHotSpots(9999,"location");
						foreach ( $hotspots['hotspots'] as $hotspot ) {
							echo '<option onclick="showHotSpotInfo('.$hotspot['id'].')">'.stripcslashes($hotspot['location']).'</option>';
						}
						?> 
					</select>
				</div>
				<div id="hotspotinfo">
					<label>Title<input type="text" /></label>
					<label>Location<input type="text" /></label>
					<label>Description<textarea></textarea></label>
					<div class="clear"></div>
					<div class="file">
						Interview
						<input type="button" id="interview" value="Choose" />
						<div id="interview_file">asdf</div>
						<div class="clear"></div>
						<label>None<input type="radio" name="type" value="none" /></label>
						<label>Interview<input type="radio" name="type" value="interview" /></label>
						<label>Other<input type="radio" name="type" value="other" /></label>
					</div>
				</div>
				<div id="hotspotmap">
				</div>
				<div class="clear"></div>
			</div>
			<div id="about">
				about
			</div>
			<div id="contribute">
				contribute
			</div>
			<div id="desire">
				desire
			</div>
		</div>
	
	</body>
	
</html>
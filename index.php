<?php 

	echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
	
		<title>Mapping Desire</title>
		<meta name="description" content="Everybody's talking about it... what do you have to say? Join us as people at the University of Austin share their stories of DESIRE. This multimedia art piece is in celebration of DESRIRE, a new exhibit at the Blanton Museum of Art, February 5th - April 25th." />
		<meta name="keywords" content="desire, UT, Texas, University, Blanton, stories, audio, mapping, desire, map" />
		<link href="css/style.css" type="text/css" media="screen" rel="stylesheet" />
		<link rel="stylesheet" href="css/ui.tabs.css" type="text/css" media="print, projection, screen">
		<link href="css/greybox.css" type="text/css" media="screen" rel="stylesheet" />
		<link rel="json" type="application/json" href="json.php" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA2Img7Sd_v71BcEq_kW2OehTFYDxjVrB-MjeUNIRG0EumMI91pRQPUzT6L-hylHS0VxJDF-AdmNPrDw" type="text/javascript"></script>
		<script type="text/javascript" src="js/soundmanager/script/soundmanager2.js"></script>
		<script type="text/javascript" src="js/greybox/greybox.js"></script>
		<script type="text/javascript" src="js/swfobject.js"></script>
		<script src="js/ui.core.js" type="text/javascript"></script>
		<script src="js/ui.tabs.js" type="text/javascript"></script>
		<script src="js/jquery.blockUI.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/mapandsounds.php"></script>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			try {
				var pageTracker = _gat._getTracker("UA-13090853-1");
				pageTracker._trackPageview();
			} catch(err) {}
		</script>
		
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
		<div id="wrapper">
			<div id="welcome-screen"><img src="images/loading.jpg" style="width:860px; height:680px;" /></div>
			<div id="map_canvas"></div>
			<div id="debug"></div>
		</div>
	</body>
	
</html>
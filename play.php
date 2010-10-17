<?php

require 'functions.php';

$result = getHotSpot($_GET['id']);
$hotspot = $result['hotspots'][0];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="css/greybox.css" type="text/css" media="screen" rel="stylesheet" />
		
<script type="text/javascript" src="js/soundmanager/script/soundmanager2.js"></script>
<script type="text/javascript" src="js/greybox/greybox.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
soundManager.url = 'js/soundmanager/swf';
soundManager.onload = function () {
	soundManager.stopAll();
	<?php echo 'var player = soundManager.createSound({
       		id: \'player\',
			url: \'audio/interview/'.$hotspot["audio"].'\',
			volume:100,
			pan:0,
			onjustbeforefinish:function(){
				soundManager.destroySound(\'player\');
				parent.GB_hide();
				parent.closeFunction();
			}
 		});
		soundManager.play(\'player\');';
	?>
}
</script>
</head>

<body>
	<?php
		if( $hotspot['latitude']!='0' ) {
			?>
	<img id="satview" src="http://maps.google.com/maps/api/staticmap?center=<?php echo $hotspot['latitude'].",".$hotspot['longitude'] ?>&zoom=18&size=300x300&maptype=satellite&markers=color:blue|<?php echo $hotspot['latitude'].",".$hotspot['longitude'] ?>&sensor=false&key=ABQIAAAA2Img7Sd_v71BcEq_kW2OehTFYDxjVrB-MjeUNIRG0EumMI91pRQPUzT6L-hylHS0VxJDF-AdmNPrDw" />
			<?php
		} else {
			?>
	<img id="satview" src="images/desirelogo.jpg" style="width:400px; height:300px;" />
			<?php
		}
			?>
	<div id="title"><strong><?php echo stripslashes($hotspot['title']); ?></strong></div>
	<div id="location"><?php echo stripslashes($hotspot['location']); ?></div>
	<div id="description"><?php echo trim(stripslashes($hotspot['description'])); ?></div>
</body>
</html>
<?php

header('Content-type: text/javascript');
require '../functions.php';
$results = getRandHotSpots(1);
$hotspots = $results['hotspots'];
if(count($hotspots)%16==0) {
	$page_ct = (count($hotspots)/16);
}
else
{
	$page_ct = ceil(count($hotspots)/16);
}

////// MAP AND MENU /////////

echo '
var sort = 1;
function pagination(page,sort_change) {
	if(sort_change!==undefined) { sort=sort_change; }
	$.ajax({
		type: "GET",
		url: "js/pagination.php?sort="+sort,
		data: "page=" + page,
		success: function(list_html){
			$(\'#list\').empty();
			$(\'#list\').append(list_html);
		}
	});
}
function initialize() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map_canvas"));
		
		// ====== Restricting the range of Zoom Levels =====
		// Get the list of map types      
		var mt = map.getMapTypes();
		// Overwrite the getMinimumResolution() and getMaximumResolution() methods
		for (var i=0; i<mt.length; i++) {
			mt[i].getMinimumResolution = function() {return 14;}
		}
		
		var center = new GLatLng(30.284029580930603,-97.74297952651978);
		map.setCenter(center, 14);
    	map.addControl(new GSmallMapControl());
		var html =	\'<div id="overlay">\' +
					\'<div class="top">\' +
						\'<img id="o1" src="images/overlay/overlay_01.png" />\' +
					\'</div>\' +
					\'<div id="images">\' +
					\'<div class="left">\' +
						\'<img src="images/overlay/overlay_02.png" />\' +
						\'<img src="images/overlay/overlay_15.png" />\' +
						\'<img src="images/overlay/overlay_23.png" />\' +
						\'<img src="images/overlay/overlay_26.png" />\' +
						\'<img src="images/overlay/overlay_32.png" />\' +
						\'<img src="images/overlay/overlay_37.png" />\' +
						\'<img src="images/overlay/overlay_43.png" />\' +
						\'<img src="images/overlay/overlay_47.png" />\' +
						\'<img src="images/overlay/overlay_50.png" />\' +
						\'<img src="images/overlay/overlay_53.png" />\' +
						\'<img src="images/overlay/overlay_57.png" />\' +
						\'<img src="images/overlay/overlay_59.png" />\' +
						\'<img src="images/overlay/overlay_63.png" />\' +
						\'<img src="images/overlay/overlay_65.png" />\' +
						\'<img src="images/overlay/overlay_69.png" />\' +
					\'</div>\' +
					\'<div class="right">\' +
						\'<img src="images/overlay/overlay_04.png" />\' +
						\'<img src="images/overlay/overlay_06.png" />\' +
						\'<img src="images/overlay/overlay_08.png" />\' +
						\'<img src="images/overlay/overlay_10.png" />\' +
						\'<img src="images/overlay/overlay_12.png" />\' +
						\'<img src="images/overlay/overlay_14.png" />\' +
						\'<img src="images/overlay/overlay_18.png" />\' +
						\'<img src="images/overlay/overlay_19.png" />\' +
						\'<img src="images/overlay/overlay_20.png" />\' +
						\'<img src="images/overlay/overlay_22.png" />\' +
						\'<img src="images/overlay/overlay_25.png" />\' +
						\'<img src="images/overlay/overlay_29.png" />\' +
						\'<img src="images/overlay/overlay_31.png" />\' +
						\'<img src="images/overlay/overlay_34.png" />\' +
						\'<img src="images/overlay/overlay_36.png" />\' +
						\'<img src="images/overlay/overlay_40.png" />\' +
						\'<img src="images/overlay/overlay_42.png" />\' +
						\'<img src="images/overlay/overlay_46.png" />\' +
						\'<img src="images/overlay/overlay_49.png" />\' +
						\'<img src="images/overlay/overlay_52.png" />\' +
						\'<img src="images/overlay/overlay_56.png" />\' +
						\'<img src="images/overlay/overlay_62.png" />\' +
						\'<img src="images/overlay/overlay_68.png" />\' +
					\'</div>\' +
					\'</div>\' +
					\'<div id="tabs" class="usertabs">\' +
						\'<ul>\' +
							\'<li><a href="#hotspots"><span>Hot Spots</span></a></li>\' +
							\'<li><a href="#about"><span>About</span></a></li>\' +
							\'<li><a href="#contribute"><span>Contribute</span></a></li>\' +
							\'<li><a href="#desire"><span>Desire</span></a></li>\' +
						\'</ul>\' +
						\'<div id="hotspots">\' +
							\'<div id="list" style="padding:10px; height:300px;">\' +
								\' \' +
							\'</div>\' +
					\'<br /><div id="pagination" style="position:absolute; left:40px;">page \' + ';
					for($i=1; $i<=$page_ct; $i++) {
						echo '\'<a href="javascript:pagination('.($i-1).')">'.$i.'</a>\'+
						';
						if($i!=$page_ct) {
							echo '\' .:. \' + 
							';
						}
					}
					echo '
							\'<br />\' +
							\'<em>sort by</em> <a href="javascript:pagination(0,1)">date</a>, <a href="javascript:pagination(0,2)">title</a>, <a href="javascript:pagination(0,3)">plays</a>\' +
							\'</div>\' +
							\'<img id="desc" src="images/desc.png" />\' +
							\'<a href="http://www.utexas.edu/finearts"><img id="cofa_logo" src="images/cofa_logo2.png" /></a>\' +
							\'<a href="http://www.finearts.utexas.edu/tad/"><img id="tad_logo" src="images/tad_logo2.png" /></a>\' +
							\'<a href="http://www.facebook.com/event.php?eid=284944220434&ref=ts"><img id="mix_logo" src="images/mix_logo2.png" /></a>\' +
							\'<a href="http://blantonmuseum.org"><img id="blanton_logo" src="images/blanton_logo2.png" /></a>\' +
						\'</div>\' +
						\'<div id="about">\' +
							\'<div>'.trim(getTabText('about')).'</div>\' +
							\'<a href="http://www.utexas.edu/finearts"><img id="cofa_logo" src="images/cofa_logo2.png" /></a>\' +
							\'<a href="http://www.finearts.utexas.edu/tad/"><img id="tad_logo" src="images/tad_logo2.png" /></a>\' +
							\'<a href="http://www.facebook.com/event.php?eid=284944220434&ref=ts"><img id="mix_logo" src="images/mix_logo2.png" /></a>\' +
							\'<a href="http://blantonmuseum.org"><img id="blanton_logo" src="images/blanton_logo2.png" /></a>\' +
						\'</div>\' +
						\'<div id="contribute">\' +
							\'<div>'.trim(getTabText('contribute')).'</div>\' +
							\'<a href="http://www.utexas.edu/finearts"><img id="cofa_logo" src="images/cofa_logo2.png" /></a>\' +
							\'<a href="http://www.finearts.utexas.edu/tad/"><img id="tad_logo" src="images/tad_logo2.png" /></a>\' +
							\'<a href="http://www.facebook.com/event.php?eid=284944220434&ref=ts"><img id="mix_logo" src="images/mix_logo2.png" /></a>\' +
							\'<a href="http://blantonmuseum.org"><img id="blanton_logo" src="images/blanton_logo2.png" /></a>\' +
						\'</div>\' +
						\'<div id="desire">\' +
							\'<div>'.trim(stripslashes(getTabText('desire'))).'</div>\' +
							\'<a href="http:/www.utexas.edu/finearts"><img id="cofa_logo" src="images/cofa_logo2.png" /></a>\' +
							\'<a href="http://www.finearts.utexas.edu/tad/"><img id="tad_logo" src="images/tad_logo2.png" /></a>\' +
							\'<a href="http://www.facebook.com/event.php?eid=284944220434&ref=ts"><img id="mix_logo" src="images/mix_logo2.png" /></a>\' +
							\'<a href="http://blantonmuseum.org"><img id="blanton_logo" src="images/blanton_logo2.png" /></a>\' +
						\'</div>\' +
					\'</div>\' +
					\'<div id="importantlinks" style="position:absolute; top:400px; left:700px; text-align:right;" >\' +
						\'<p><strong><a href="mailto:mappingdesire@gmail.com">Share your story</strong></a></p>\' +
						\'<p><strong><a href="http://www.surveymonkey.com/s/MF36DFV">Survey</strong></a></p>\' +
						\'<p><strong><a href="http://www.utexas.edu/finearts/events/details/2770">Ears, Eyes, and Feet</a><br />May 7 & 8 2010</strong></p>\' +
					\'</div>\' +  
					\'<div id="mute" style="position:absolute; top:660px; left:790px;" >\' +
					    \'<a href="javascript:muteFunction(1)">mute</a>\' +
					\'</div>\' +   
				\'</div>\';
		$(\'#map_canvas\').append(html);
		$(\'#tabs\').tabs();
		pagination(0);
		$(document).ready(function(){
			var images = document.getElementsByTagName("img");
    		$("#welcome-screen").fadeOut(\'slow\');
  		});
		// Creates a marker at the given point
		// Clicking the marker will hide it

		function createMarker(i,t,l,d,la,ln,a,t,v) {
			var id = i;
			var title = t;
			var location = l;
			var description = d;
			var lat = parseFloat(la);
			var lng = parseFloat(ln);
			var audio = a;
			var type = t;
			var views = v;
			var latlng = new GLatLng(lat,lng);
			var flame = new GIcon();
			flame.image = "images/flame.png";
			flame.iconSize = new GSize(22, 35);
			flame.iconAnchor = new GPoint(10, 33);

			var marker = new GMarker(latlng,{icon:flame});
			
			GEvent.addListener(marker,"click", function() {
				clickFunction("",id,type);
			});
			return marker;
		}';
		
		foreach($hotspots as $i) {
			if( $i['latitude'] != 0 ) {
				echo 'map.addOverlay(createMarker('.$i[id].',"'.$i[title].'","'.$i[location].'","'.trim(stripslashes(getDescription($i['id']))).'","'.$i[latitude].'","'.$i[longitude].'","'.$i[audio].'",'.$i['type'].','.$i['views'].'));';
			}
		}
		
		echo '
		
		// Add a move listener to restrict the bounds range
		GEvent.addListener(map, "move", function() {
			checkBounds();
		});
		
		// The allowed region which the whole map must be within
		var allowedBounds = new GLatLngBounds(new GLatLng(30.27,-97.752), new GLatLng(30.3,-97.727));
      
		// If the map position is out of range, move it back
		function checkBounds() {
			// Perform the check and return if OK
			if (allowedBounds.contains(map.getCenter())) {
				return;
			}
			// It`s not OK, so find the nearest allowed point and move there
			var C = map.getCenter();
			var X = C.lng();
			var Y = C.lat();

			var AmaxX = allowedBounds.getNorthEast().lng();
			var AmaxY = allowedBounds.getNorthEast().lat();
			var AminX = allowedBounds.getSouthWest().lng();
			var AminY = allowedBounds.getSouthWest().lat();

			if (X < AminX) {X = AminX;}
			if (X > AmaxX) {X = AmaxX;}
			if (Y < AminY) {Y = AminY;}
			if (Y > AmaxY) {Y = AmaxY;}
			//alert ("Restricting "+Y+" "+X);
			map.setCenter(new GLatLng(Y,X));
		}
	}	
}
';





///// SOUNDS ///////

$vol_factor = 100/$results['total'];

echo '
soundManager.url = "js/soundmanager/swf";
var count = 0;
var i = 0;
var inc = 0;
var clicked = 0;
var vol = 0;
// above is URL of "swf" folder relative to index.php
function soundscape(c) {
	count = c;
	if(!muted && !clicked) {
		vol = 100;
	}
	else if(clicked===1) {
		vol = 5;
	}
	else {
		vol = 0;
	}
	var vol_factor = '.$vol_factor.';
	soundManager.createSound({
		id: "background"+c,
		url: "audio/murmurs.mp3",
		volume:vol,
		pan:0,
		onbeforefinish:function() {
			setTimeout("soundManager.destroySound(\'background\'+c)",8000);
			soundscape(c+1);
		}
	});
	soundManager.play("background"+c);
}
//builds the audio that plays back at a random panning and at an appropriate volume. This function will be slightly different when there are completed background tracks and I figure out looping, but this will do for right now.
function clickFunction(desc,id,type) {
	if(type===2) {
		vol = 0;
		clicked = 2;
	} else {
		vol = 5;
		clicked = 1;
	} 
	if(!muted) {
		scaleVolume(100,vol,"background"+count,1000);
	}
	GB_show(desc,"play.php?id="+id,360,700);
}

function closeFunction() {
	if(!muted) {
		clicked = 0;
		scaleVolume(5,100,"background"+count,1000);
	}
}

soundManager.onload = function () {
	soundscape(0);
}

function scaleVolume(start_vol,end_vol,id,time) {
	inc = (1/time);
	if(start_vol>end_vol) {
		for(i=start_vol;i>end_vol;i=(i-0.1)) {
			soundManager.setVolume(id,i);
		}
		if(muted) {
			soundManager.stop(id);
		}
	}
	else {
		if(muted) {
			muted = false;
			soundscape(count);
		}
		else {
			for(i=start_vol;i<end_vol;i=(i+0.1)) {
				soundManager.setVolume(id,i);
			}
		}
	}
}

var muted = "";

function muteFunction(m) {
	if(m===1) {
		muted=true;
		scaleVolume(100,0,"background"+count,400);
		scaleVolume(100,0,"background"+(count+1),400);
		$(\'#mute\').html(\'<a href="javascript:muteFunction(0)">unmute</a>\');
	}
	else {
		count = 0;
		scaleVolume(0,100,"background"+count,400);
		scaleVolume(0,100,"background"+(count+1),400);
		$(\'#mute\').html(\'<a href="javascript:muteFunction(1)">mute</a>\');
	}
}

';

?>
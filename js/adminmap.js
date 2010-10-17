///// TABS //////
$(function() {
	$('#tabs').tabs();
});

///// CONTROLS //////
function showList(name) {
	$("#lists select").hide();
	$("#list"+name).show();
}
function reverseList() {
	var name = $("#changeView").val();
	var options = $("#list"+name).get(0).options;
	var list = new Array();
	for( var i = 0; i < options.length; i += 1) {
		list[i] = options[i].value;
	}
	list = list.reverse();
	for( var i = 0; i < options.length; i += 1) {
		options[i].value = list[i];
		options[i].text = list[i];
	}
}


////// MAP ///////
function initialize() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("hotspotmap"));
		
		/*
		// ====== Restricting the range of Zoom Levels =====
		// Get the list of map types      
		var mt = map.getMapTypes();
		// Overwrite the getMinimumResolution() and getMaximumResolution() methods
		for (var i=0; i<mt.length; i++) {
			mt[i].getMinimumResolution = function() {return 14;}
		}
		*/
		
		var center = new GLatLng(30.284029580930603,-97.74297952651978);
		map.setCenter(center, 14);
    	map.addControl(new GSmallMapControl());
		/*
		html =	'<div id="overlay">' +
					'<div class="top">' +
						'<img id="o1" src="images/overlay/overlay_01.png" />' +
					'</div>' +
					'<div class="left">' +
						'<img src="images/overlay/overlay_02.png" />' +
						'<img src="images/overlay/overlay_15.png" />' +
						'<img src="images/overlay/overlay_23.png" />' +
						'<img src="images/overlay/overlay_26.png" />' +
						'<img src="images/overlay/overlay_32.png" />' +
						'<img src="images/overlay/overlay_37.png" />' +
						'<img src="images/overlay/overlay_43.png" />' +
						'<img src="images/overlay/overlay_47.png" />' +
						'<img src="images/overlay/overlay_50.png" />' +
						'<img src="images/overlay/overlay_53.png" />' +
						'<img src="images/overlay/overlay_57.png" />' +
						'<img src="images/overlay/overlay_59.png" />' +
						'<img src="images/overlay/overlay_63.png" />' +
						'<img src="images/overlay/overlay_65.png" />' +
						'<img src="images/overlay/overlay_69.png" />' +
					'</div>' +
					'<div class="right">' +
						'<img src="images/overlay/overlay_04.png" />' +
						'<img src="images/overlay/overlay_06.png" />' +
						'<img src="images/overlay/overlay_08.png" />' +
						'<img src="images/overlay/overlay_10.png" />' +
						'<img src="images/overlay/overlay_12.png" />' +
						'<img src="images/overlay/overlay_14.png" />' +
						'<img src="images/overlay/overlay_18.png" />' +
						'<img src="images/overlay/overlay_19.png" />' +
						'<img src="images/overlay/overlay_20.png" />' +
						'<img src="images/overlay/overlay_22.png" />' +
						'<img src="images/overlay/overlay_25.png" />' +
						'<img src="images/overlay/overlay_29.png" />' +
						'<img src="images/overlay/overlay_31.png" />' +
						'<img src="images/overlay/overlay_34.png" />' +
						'<img src="images/overlay/overlay_36.png" />' +
						'<img src="images/overlay/overlay_40.png" />' +
						'<img src="images/overlay/overlay_42.png" />' +
						'<img src="images/overlay/overlay_46.png" />' +
						'<img src="images/overlay/overlay_49.png" />' +
						'<img src="images/overlay/overlay_52.png" />' +
						'<img src="images/overlay/overlay_56.png" />' +
						'<img src="images/overlay/overlay_62.png" />' +
						'<img src="images/overlay/overlay_68.png" />' +
					'</div>' +
				'</div>';
		$("#map_canvas").append(html);
		*/
		/*
		GDownloadUrl("hotspots.php", function(doc) {
			//alert(doc);
			var xmlDoc = GXml.parse(doc);
			var markers = xmlDoc.documentElement.getElementsByTagName("hotspot");

			for (var i = 0; i < markers.length; i++) {
				/*var point = new GLatLng(lat,lng);
				var html = markers[i].getAttribute("html");
				var pic = markers[i].getAttribute("iconpic");

				var tabs = markers[i].getElementsByTagName("tab");
				var tabtitles = [];
				var tabhtmls = [];

				var tophtmls = [];

				for(var k = 0; k < tabs.length; k++) {
					tabtitles[k] = tabs[k].getAttribute("title");
					tabhtmls[k] = tabs[k].getAttribute("html");
					tophtmls[k] = tabs[k].getAttribute("tophtml");
				}*//*

				// create the marker 
				map.addOverlay(createMarker(markers[i]));
			}
		});
		*/
		/*
		// Creates a marker at the given point
		// Clicking the marker will hide it
		function createMarker(m) {
			var id = m.getAttribute("id");
			var location = m.getAttribute("location");
			var lat = parseFloat(m.getAttribute("lat"));
			var lng = parseFloat(m.getAttribute("lng"));
			var latlng = new GLatLng(lat,lng);
			var marker = new GMarker(latlng);
			GEvent.addListener(marker,"click", function() {
				var myHtml = location;
				map.savePosition();
				centerMessage(latlng);
				window.setTimeout(function() {
      				map.openInfoWindowHtml(latlng, myHtml,{
						onCloseFn:function(){
							map.returnToSavedPosition();
						}
					});
    			}, 400);
			});
			return marker;
		}
		
		function centerMessage(p) {
			var pxs = map.fromLatLngToContainerPixel(p,map.getZoom()); 
			var c = new GPoint(pxs.x-60,pxs.y-110);
			p = map.fromContainerPixelToLatLng(c,map.getZoom(),true);
			map.panTo(p);
		}
		
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
		
		*/
		
	}
}
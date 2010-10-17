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
		
		GDownloadUrl("hotspots.php", function(doc) {
			var xmlDoc = GXml.parse(doc);
			var markers = xmlDoc.documentElement.getElementsByTagName("hotspot");

			for (var i = 0; i < markers.length; i++) {
				map.addOverlay(createMarker(markers[i]));
			}
		});
		
		// Creates a marker at the given point
		// Clicking the marker will hide it
		function createMarker(m) {
			var id = m.getAttribute("id");
			var title = m.getAttribute("title");
			var location = m.getAttribute("location");
			var description = m.getAttribute("description");
			var lat = parseFloat(m.getAttribute("lat"));
			var lng = parseFloat(m.getAttribute("lng"));
			var audio = m.getAttribute("audio");
			var latlng = new GLatLng(lat,lng);
			var marker = new GMarker(latlng);
			GEvent.addListener(marker,"click", function() {
				clickFunction("",id);
			});
			return marker;
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
		
	}
}
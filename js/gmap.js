var map;

function initialize() {
	map = new google.maps.Map(document.getElementById('map_canvas'), {
	  zoom: 15,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	// Try HTML5 geolocation
	if(navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var pos = new google.maps.LatLng(position.coords.latitude,
	                                     position.coords.longitude);


	    map.setCenter(pos);
	  }, function() {
	    handleNoGeolocation(true);
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleNoGeolocation(false);
	}
}

function handleNoGeolocation(errorFlag) {
	if (errorFlag) {
	  var content = 'Error: The Geolocation service failed.';
	} else {
	  var content = 'Error: Your browser doesn\'t support geolocation.';
	}

	var options = {
	  map: map,
	  position: new google.maps.LatLng(60, 105),
	  content: content
	};

	var infowindow = new google.maps.InfoWindow(options);
	map.setCenter(options.position);
}

function Geolocalizar()
{
	var direccion = document.getElementById("target").value;
   	$.ajax({
		url: "mapa/Geolocalizar",
		data: "direccion=" + direccion,
		type: "POST",
		dataType: "json",
		success: function(source){
			var coordenadas = new google.maps.LatLng(source["latitud"], source["longitud"]);
			map.setCenter(coordenadas);
		},
		error: function(dato){
			alert("ERROR");
		}
	});			


}

google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(document.getElementById("target"), 'change', Geolocalizar);

var map;
var marker;

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
	var direccion = document.getElementById("Eventos_Lugar").value;
   	$.ajax({
		url: "../../index.php/mapa/Geolocalizar",
		data: "direccion=" + direccion,
		type: "POST",
		dataType: "json",
		success: function(source){
			map = new google.maps.Map(document.getElementById('map_canvas'), {
			  zoom: 15,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var coordenadas = new google.maps.LatLng(source["latitud"], source["longitud"]);
			map.setCenter(coordenadas);
			map.setZoom(15);
			marker = new google.maps.Marker({
			          map:map,
			          draggable:false,
			          animation: google.maps.Animation.DROP,
			          position: new google.maps.LatLng(source["latitud"], source["longitud"])
			          });

		},
		error: function(dato){
			alert("¡Error en Lugar!");
		}
	});			


}

google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(document.getElementById("Eventos_Lugar"), 'change', Geolocalizar);

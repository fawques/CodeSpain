var map;
var markerCluster;

function initialize() {
	map = new google.maps.Map(document.getElementById('map_canvas'), {
	  zoom: 15,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	markerCluster = new MarkerClusterer(map);
	// Try HTML5 geolocation
	if(navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var pos = new google.maps.LatLng(position.coords.latitude,
	                                     position.coords.longitude);

	    
	    AnyadirMarkers();

		google.maps.event.addListener(map,'dragend',ObtenerMarkers);
		google.maps.event.addListener(map,'zoom_changed',ObtenerMarkers);

		map.setCenter(pos);
		ObtenerMarkers();


	  }, function() {
	    handleNoGeolocation(true);
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleNoGeolocation(false);
	}
}


function initialize2() {
	map = new google.maps.Map(document.getElementById('map_canvas'), {
	  zoom: 15,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	google.maps.event.addDomListener(map, 'click', AnyadirMarkersNuevoEvento);
	markerCluster = new MarkerClusterer(map);

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

function Geolocalizar(elemento)
{
	var address = elemento.currentTarget.value;
   	/*$.ajax({
		url: "index.php/mapa/Geolocalizar",
		data: "direccion=" + direccion,
		type: "POST",
		dataType: "json",
		success: function(source){
			var coordenadas = new google.maps.LatLng(source["latitud"], source["longitud"]);
			map.setCenter(coordenadas);
			map.setZoom(10);
			ObtenerMarkers();
		},
		error: function(dato){
			alert("ERROR1");
		}
	});	*/

	var geocoder = new google.maps.Geocoder();

	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{

		    var latitude = results[0].geometry.location.lat();

		    var  longitude = results[0].geometry.location.lng();

		    var coordenadas = new google.maps.LatLng(latitude, longitude);
			map.setCenter(coordenadas);
			map.setZoom(10);
			if(elemento.id == "target")
			{
				ObtenerMarkers();
			}
			

		} 
	}); 

}

function CentrarEnCoodenadas(id)
{
	if(id != "")
	{
	   	$.ajax({
			url: "index.php/site/ObtenerDatosLista",
			data: "idLista=" + id,
			type: "POST",
			dataType: "json",
			success: function(source){

				//Actualizar mapa y lista de eventos
				var coordenadas = new google.maps.LatLng(source["latitud"], source["longitud"]);
				
				map.setCenter(coordenadas);
				map.setZoom(15);
				//ObtenerMarkers();

				//Actualizar calendario
				var mes = source['mes'] -1;
				$('#CalendarioIndex').fullCalendar( 'gotoDate',source['anyo'],mes,source['dia']);

			},
			error: function(dato){
				alert("ERROR2");
			}
		});			
	}
}

function CentrarEnCoordenadasCalendario(idEvento)
{
	CentrarEnCoodenadas(idEvento);
}

function CentrarEnCoordenadasLista()
{
	var id = $.fn.yiiGridView.getSelection('evento');
	CentrarEnCoodenadas(id);
}


function AnyadirMarkers()
{
	$.ajax({
			url: "index.php/site/ObtenerJsonEventos",
			type: "POST",
			async:false,
			dataType: "json",
			success: function(source){				
				
				//$.fn.yiiGridView.update('evento');
				var markers = [];
				for(var i=0;i<source.length;i++)
				{
					marker = new google.maps.Marker({
			          map:map,
			          draggable:false,
			          animation: google.maps.Animation.DROP,
			          position: new google.maps.LatLng(source[i].CoordX, source[i].CoordY)
			        });

			        markers.push(marker);
				}

				markerCluster = new MarkerClusterer(map, markers);

			},
			error: function(dato){
				alert("ERROR3");
			}
		});		
}

function ObtenerMarkers()
{

	var visibleMarkers = ListaMarkers();
	$.ajax({
			url: "index.php/site/ActualizarLista",
			data: $.param( visibleMarkers ),
			type: "POST",
			dataType: "text",
			async: false,
			success: function(source){				
				$.fn.yiiGridView.update('evento');
			},
			error: function(dato){
				alert("ERROR4");
			}
		});	

}

function ListaMarkers()
{
	var markers = markerCluster.getTotalMarkers();
	var visibleMarkers = new Array();
	//map; // your map
	var j = 0;
	for(var i = markers.length, bounds = map.getBounds(); i--;) {
	    if( bounds.contains(markers[i].getPosition()) ){
	        // code for showing your object
	        var aux = new Object();
	        aux.lat = markers[i].getPosition().lat();
	        aux.lng = markers[i].getPosition().lng();
	        visibleMarkers.push({name: j, value: markers[i].getPosition().lat()+'|'+markers[i].getPosition().lng()});
	        j++;
	    }
	}
	return visibleMarkers;
}

function AnyadirMarkersNuevoEvento(event)
{
	var lista = ListaMarkers();
	if(lista.length == 0)
	{
		var marker = new google.maps.Marker({
			position: (event.latLng),
			map: map,
		});	
		markerCluster.addMarker(marker);

	}

}

/*google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(document.getElementById('target'), 'change', Geolocalizar);*/
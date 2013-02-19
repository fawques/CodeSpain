<?php

class MapaController extends Controller
{	
	public $coordenadas;
	public function actionIndex()
	{

		/*echo '<script> 
		  navigator.geolocation.getCurrentPosition(coordenadas);
		  function coordenadas(position) {
		      var latitud = position.coords.latitude;
		      var longitud = position.coords.longitude;
		    var xmlhttp;
		    if (window.XMLHttpRequest)
		    {// code for IE7+, Firefox, Chrome, Opera, Safari
		      xmlhttp=new XMLHttpRequest();
		    }
		    else
		    {// code for IE6, IE5
		      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		    }

		    xmlhttp.open("POST","mapa/Geolocalizar",false);
		    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		    xmlhttp.send("latitud="+ latitud +"&longitud="+ longitud +"\"");

		  } 
		</script>';

		session_start();
		$this->coordenadas = array('lat' => $_SESSION["latitud"], 'lon' => $_SESSION["longitud"]);*/

		Yii::app()->clientScript->registerScriptFile(
        	'https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU&sensor=false&libraries=places',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/gmap.js',
			CClientScript::POS_END
		);
		$this->render('Index');
	}

	/*public function CrearMapa($coordenadas)
	{

		$gMap = new EGMap();
		$gMap->zoom = 15;
		$mapTypeControlOptions = array(
		  'position'=> EGMapControlPosition::LEFT_BOTTOM,
		  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
		);
		 
		$gMap->mapTypeControlOptions= $mapTypeControlOptions;

		$gMap->setCenter($coordenadas["lat"],$coordenadas["lon"]);			


		 
		// Create GMapInfoWindows
		$info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
		$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
		 
		$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");
		 
		$icon->setSize(32, 37);
		$icon->setAnchor(16, 16.5);
		$icon->setOrigin(0, 0);
		 
		// Create marker
		$marker = new EGMapMarker(39.721089311812094, 2.91165944519042, array('title' => 'Marker With Custom Image','icon'=>$icon));
		$marker->addHtmlInfoWindow($info_window_a);
		$gMap->addMarker($marker);
		 
		// Create marker with label
		$marker = new EGMapMarkerWithLabel(39.821089311812094, 2.90165944519042, array('title' => 'Marker With Label'));
		 
		$label_options = array(
		  'backgroundColor'=>'yellow',
		  'opacity'=>'0.75',
		  'width'=>'100px',
		  'color'=>'blue'
		);
		 
		/*
		// Two ways of setting options
		// ONE WAY:
		$marker_options = array(
		  'labelContent'=>'$9393K',
		  'labelStyle'=>$label_options,
		  'draggable'=>true,
		  // check the style ID 
		  // afterwards!!!
		  'labelClass'=>'labels',
		  'labelAnchor'=>new EGMapPoint(22,2),
		  'raiseOnDrag'=>true
		);
		 
		$marker->setOptions($marker_options);
		*/
		 
		// SECOND WAY:
		/*$marker->labelContent= '$425K';
		$marker->labelStyle=$label_options;
		$marker->draggable=true;
		$marker->labelClass='labels';
		$marker->raiseOnDrag= true;
		 
		$marker->setLabelAnchor(new EGMapPoint(22,0));
		 
		$marker->addHtmlInfoWindow($info_window_b);
		 
		$gMap->addMarker($marker);
		 
		// enabling marker clusterer just for fun
		// to view it zoom-out the map
		$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
		 
		$gMap->renderMap();

	}*/


	public function actionGeolocalizar()
	{
		Yii::import('ext.EGMap.*');
		$gMap = new EGMap();
		// Create geocoded address
		$geocoded_address = new EGMapGeocodedAddress($_POST["direccion"]);
		$geocoded_address->geocode($gMap->getGMapClient());

		echo json_encode(array('latitud' => $geocoded_address->getLat(), 'longitud' => $geocoded_address->getLng()));
	}

	/*public function actionBuscarMapa()
	{
		$sample_address = 'Czech Republic, Prague, Olivova';
		$gMap = new EGMap();
		$geocoded_address = new EGMapGeocodedAddress($sample_address);
		$geocoded_address->geocode($gMap->getGMapClient());

		$coordenadas = array('lat' => $geocoded_address->getLat(), 'lon' => $geocoded_address->getLng());
		$this->renderPartial('_mapa', array('coordenadas'=>$coordenadas), false, true);
	}*/
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
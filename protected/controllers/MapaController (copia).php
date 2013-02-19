<?php
Yii::import('ext.EGMap.*');
class MapaController extends Controller
{	
	public $gMap;

	public function actionIndex()
	{

		echo '<script> 
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

		$this->render('Index');
	}

	public function CrearMapa()
	{
		$this->gMap = new EGMap();
		$this->gMap->zoom = 15;
		$mapTypeControlOptions = array(
		  'position'=> EGMapControlPosition::LEFT_BOTTOM,
		  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
		);
		 
		$this->gMap->mapTypeControlOptions= $mapTypeControlOptions;

		session_start();
		$this->gMap->setCenter($_SESSION["latitud"],$_SESSION["longitud"]);			


		 
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
		$this->gMap->addMarker($marker);
		 
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
		$marker->labelContent= '$425K';
		$marker->labelStyle=$label_options;
		$marker->draggable=true;
		$marker->labelClass='labels';
		$marker->raiseOnDrag= true;
		 
		$marker->setLabelAnchor(new EGMapPoint(22,0));
		 
		$marker->addHtmlInfoWindow($info_window_b);
		 
		$this->gMap->addMarker($marker);
		 
		// enabling marker clusterer just for fun
		// to view it zoom-out the map
		$this->gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
		 
		$this->gMap->renderMap();

	}


	public function actionGeolocalizar()
	{
		session_start();
		$_SESSION["latitud"] = $_POST["latitud"];
		$_SESSION["longitud"] = $_POST["longitud"];
	}
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
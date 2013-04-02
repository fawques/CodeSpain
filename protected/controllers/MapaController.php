<?php

class MapaController extends Controller
{	
	public $coordenadas;
	public function actionIndex($index)
	{

		Yii::app()->clientScript->registerScriptFile(
        	'https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU&sensor=false&libraries=places',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/gmap.js',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/markerclusterer.js',
			CClientScript::POS_END
		);

		if($index)
		{
			Yii::app()->clientScript->registerScript(
				"index",
	       		"google.maps.event.addDomListener(window, 'load', initialize);
				 google.maps.event.addDomListener(document.getElementById('target'), 'change', Geolocalizar);",
				 CClientScript::POS_END
			);			
		}
		else
		{
			Yii::app()->clientScript->registerScript(
				"detalle",
       			"google.maps.event.addDomListener(window, 'load', initialize2);
				 google.maps.event.addDomListener(document.getElementById('Eventos_Lugar'), 'keyup', Geolocalizar);
				 google.maps.event.addDomListener(document.getElementById('Eventos_Lugar'), 'blur', Geolocalizar);",
				 CClientScript::POS_END
			);
		}


		$this->renderPartial('Index',array('index'=>$index));
	}


	/*public function actionGeolocalizar()
	{
		Yii::import('ext.EGMap.*');
		$gMap = new EGMap();
		// Create geocoded address
		$geocoded_address = new EGMapGeocodedAddress($_POST['direccion']);
		$geocoded_address->geocode($gMap->getGMapClient());

		echo json_encode(array('latitud' => $geocoded_address->getLat(), 'longitud' => $geocoded_address->getLng()));
	}*/

	/*public function actionNuevoEvento()
	{
		Yii::app()->clientScript->registerScriptFile(
        	'https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU&sensor=false&libraries=places',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/gmap2.js',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/markerclusterer.js',
			CClientScript::POS_END
		);

		$this->renderPartial('Index');
	}*/
}
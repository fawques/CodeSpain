<?php

class MapaController extends Controller
{	
	public $coordenadas;
	public function actionIndex()
	{

		Yii::app()->clientScript->registerScriptFile(
        	'https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU&sensor=false&libraries=places',
			CClientScript::POS_END
		);

		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/gmap.js',
			CClientScript::POS_END
		);
		$this->renderPartial('Index');
	}


	public function actionGeolocalizar()
	{
		Yii::import('ext.EGMap.*');
		$gMap = new EGMap();
		// Create geocoded address
		$geocoded_address = new EGMapGeocodedAddress($_POST["direccion"]);
		$geocoded_address->geocode($gMap->getGMapClient());

		echo json_encode(array('latitud' => $geocoded_address->getLat(), 'longitud' => $geocoded_address->getLng()));
	}
}
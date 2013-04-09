<?php

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{


          $identity=new UserIdentity("bl4ckf4lk0n@gmail.com","123456789");

          $identity->authenticate();

          $login=Yii::app()->user;
          $login->login($identity);
		Yii::app()->clientScript->registerScriptFile(
        	Yii::app()->baseUrl . '/js/search.js',
			CClientScript::POS_END
		);
		Yii::app()->clientScript->registerScriptFile(
        	'https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU&sensor=false&libraries=places',
			CClientScript::POS_END
		);
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/index.css');
		//session_start();
		$controlador = new EventoController('Eventos');
		$array_eventos = $controlador->GetAll();

		// Inicializamos los datos del calendario
		$data = array(
	        'data'=>array(
			),
	        'options'=>array(
	            'editable'=>false,
	        ),
	        'htmlOptions'=>array(
	               'class'=>'well well-small',
	        ),
	        'id' => 'CalendarioIndex',
	    );

		// Añadimos los eventos que toque al calendario
		for ($i=0; $i < count($array_eventos); $i++) { 
			$idEvento = $array_eventos[$i]->idEventos;
			$nuevoElemento = array(
			                'title'=> $array_eventos[$i]->Nombre,
			                'start'=> $array_eventos[$i]->FechaIni,
			                'end' => $array_eventos[$i]->FechaFin,
			                'url'=>'javascript:CentrarEnCoordenadasCalendario('.$idEvento.');',
			            );
			$data['data'][$i] = $nuevoElemento;
		}

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'*/
		//echo json_encode(array('data'=>$data,'ArrayListaEventos' => $ArrayListaEventos));
		$this->render('index', array('data'=>$data));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$nombre='=?UTF-8?B?'.base64_encode($model->nombre).'?=';
				$asunto='=?UTF-8?B?'.base64_encode($model->asunto).'?=';
				$headers="From: $nombre <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$asunto,$model->mensaje,$headers);
				Yii::app()->user->setFlash('contact','Gracias por hablarnos. No es normal que la gente común nos hable.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(Yii::app()->user->isGuest)
		{
			$model=new LoginForm;
			$this->render('login',array('model'=>$model));			
		}
		else
		{
			$urlIni = Yii::app()->createUrl("");
            header("Location: $urlIni");
		}

	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionSearch()
	{
		$busqueda =$_POST['busqueda'];

		$controladorEvento = new EventoController('Eventos');
		$resultados = $controladorEvento->actionSearch($busqueda);

		$array_eventos = array();
		for ($i=0; $i < count($resultados); $i++) { 
			$nuevoElemento = array(
                'title'=> $resultados[$i]->Nombre,
                'desc'=> $resultados[$i]->Descripcion,
                'start'=> $resultados[$i]->FechaIni,
                'end'=> $resultados[$i]->FechaFin,
                'lat' => $resultados[$i]->CoordX,
                'lng' => $resultados[$i]->CoordY,
                'url'=>'javascript:CentrarEnCoordenadasCalendario('.$resultados[$i]->idEventos.');',
            );
			$array_eventos[$i] = $nuevoElemento;
		}

		echo json_encode($array_eventos);

	}

	public function actionObtenerDatosLista()
	{
		$controladorEvento = new EventoController('Eventos');
		$evento = $controladorEvento->loadModel($_POST["idLista"]);
		
		list($anyo, $mes, $dia) = explode("-", $evento->FechaIni);

		echo json_encode(array('latitud' => $evento->CoordX, 'longitud' => $evento->CoordY, 'dia' => $dia, 'mes' => $mes, 'anyo' => $anyo));
	}

	public function actionObtenerJsonEventos()
	{
		$controladorEvento = new EventoController('Eventos');
		$array_eventos = $controladorEvento->GetAll();

		echo CJSON::encode($array_eventos);

	}

	public function ObtenerDataProvider()
	{
		//session_start();
		if(Yii::app()->getSession()->get('criteria') != null)
		{

			$dataProvider=new CActiveDataProvider(Eventos::model(), array(
						'keyAttribute'=>'idEventos',// IMPORTANTE, para que el CGridView conozca la seleccion
						'criteria'=>Yii::app()->getSession()->get('criteria'),
						'pagination'=>array(
							'pageSize'=>4,
						),
						'sort'=>array(
							'defaultOrder'=>array('nombre'=>true),
						),
			));

			Yii::app()->getSession()->remove('criteria');

			return $dataProvider;
		}
		else
		{
			$dataProvider=new CActiveDataProvider(Eventos::model(), array(
						'keyAttribute'=>'idEventos',// IMPORTANTE, para que el CGridView conozca la seleccion
						'sort'=>array(
							'defaultOrder'=>array('nombre'=>true),
						),
			));
			return $dataProvider;			
		}
	}

	public function actionActualizarLista()
	{
		session_start();
		$criteria = new CDbCriteria;
		$i = 0;
		while(isset($_POST["$i"]))
		{
			$coord  = explode("|", $_POST["$i"]);
			$criteria->addColumnCondition(array('CoordX' => $coord[0], 'CoordY' => $coord[1]), 'AND', 'OR');
			$i++;

		}
		$dataProvider;
		if($i>0)
		{
			Yii::app()->getSession()->add('criteria', $criteria);
			//$_SESSION["criteria"] = $criteria;
					
		}
		else
		{
			Yii::app()->getSession()->add('criteria', array('condition'=>'idEventos=-1'));
			//$_SESSION["criteria"] = array('condition'=>'idEventos=-1');

		}
		
	}

}
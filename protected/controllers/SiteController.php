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
		$controlador = new EventoController('Evento');
		$array_eventos = $controlador->GetAll();

		// Inicializamos los datos del calendario
		$data = array(
	        'data'=>array(
			),
	        'options'=>array(
	            'editable'=>false,
	        ),
	        'htmlOptions'=>array(
	               'style'=>'width:350px;margin: 0 auto;',
	               'class'=>'well well-small',
	        ),
	    );

		// Añadimos los eventos que toque al calendario
		for ($i=0; $i < count($array_eventos); $i++) { 
			$nuevoElemento = array(
			                'title'=> $array_eventos[$i]->Nombre,
			                'start'=> $array_eventos[$i]->Fecha,
			                'url'=>'javascript:alert("Hola!");',
			            );
			$data['data'][$i] = $nuevoElemento;
		}

		$ArrayListaEventos = $this->CrearListaEventos($array_eventos);

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'*/
		//echo json_encode(array('data'=>$data,'ArrayListaEventos' => $ArrayListaEventos));
		$this->render('index', array('data'=>$data,'ArrayListaEventos' => $ArrayListaEventos));
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
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
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
		$model=new LoginForm;
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	private function CrearListaEventos($array)
	{

		$dataProvider=new CActiveDataProvider(Evento::model(), array(
					'keyAttribute'=>'idEventos',// IMPORTANTE, para que el CGridView conozca la seleccion
					'criteria'=>array(
						//'condition'=>'cualquier condicion where de tu sql iria aqui',
					),
					'pagination'=>array(
						'pageSize'=>20,
					),
					'sort'=>array(
						'defaultOrder'=>array('nombre'=>true),
					),
		));

		return $dataProvider;


	}

	public function actionObtenerCoordenadasLista()
	{
		$controladorEvento = new EventoController('Evento');
		$evento = $controladorEvento->loadModel($_POST["idLista"]);

		echo json_encode(array('latitud' => $evento->CoordX, 'longitud' => $evento->CoordY));
	}

}
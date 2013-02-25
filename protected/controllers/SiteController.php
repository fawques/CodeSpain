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

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'*/
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
		/*Yii::import('ext.eoauth.*');
 
        $ui = new EOAuthUserIdentity(
                array(
                    //Set the "scope" to the service you want to use
                        'scope'=>'https://www.googleapis.com/auth/userinfo.email',
                        'provider'=>array(
                                'request'=>'https://www.google.com/accounts/OAuthGetRequestToken',
                                'authorize'=>'https://www.google.com/accounts/OAuthAuthorizeToken',
                                'access'=>'https://www.google.com/accounts/OAuthGetAccessToken',
                        )
                )
        );
 
        if ($ui->authenticate()) {
            $user=Yii::app()->user;
            $user->login($ui);
            $this->redirect($user->returnUrl);
        }
        else throw new CHttpException(401, $ui->error);*/

		/*$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));*/
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
<?php


require_once('protected/vendors/twitteroauth-master/twitteroauth/twitteroauth.php');
require_once('protected/vendors/twitteroauth-master/config.php');

class AccesoController extends Controller
{


	public function actionGoogle()
	{

	}


	public function actionTwitter()
	{
        /* Start session and load library. */
        session_start();

        /* Build TwitterOAuth object with client credentials. */
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
         
        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

        /* Save temporary credentials to session. */
        $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];



         
        /* If last connection failed don't display authorization link. */
        switch ($connection->http_code) 
        {
          case 200:
            /* Build authorize URL and redirect user to Twitter. */
            $url = $connection->getAuthorizeURL($token);
            header('Location: ' . $url);
            break;
          default:
            /* Show notification if something went wrong. */
            echo 'No ha sido posible conectar con twitter. Refresca o intentalo más tarde';
        }
    }

    public function actionTwitterCallback()
    {
        /* Start session and load lib */
        session_start();
        require_once('protected/vendors/twitteroauth-master/twitteroauth/twitteroauth.php');
        require_once('protected/vendors/twitteroauth-master/config.php');

        /* If the oauth_token is old redirect to the connect page. */
        if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
          $_SESSION['oauth_status'] = 'oldtoken';
          unset($_SESSION['oauth_token']);
          unset($_SESSION['oauth_token_secret']);
          header('Location: ..');
          return true;

        }

        if (!isset($_REQUEST['oauth_verifier']))
        {
            echo "ok";
            unset($_SESSION['oauth_token']);
            unset($_SESSION['oauth_token_secret']);
            header('Location: ..');
            return true;
        }

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

        /* Request access tokens from twitter */
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        /* Save the access tokens. Normally these would be saved in a database for future use. */
        $_SESSION['access_token'] = $access_token;

        

        /* Remove no longer needed request tokens */
        unset($_SESSION['oauth_token']);
        unset($_SESSION['oauth_token_secret']);

        /* If HTTP response is 200 continue otherwise send to connect page to retry */
        if (200 == $connection->http_code) {
          /* The user has been verified and the access tokens can be saved for future use */
          $_SESSION['status'] = 'verified';

          $user = $connection->get('account/verify_credentials');

          $identity=new UserIdentity($user->name,$_SESSION['access_token']);

          $login=Yii::app()->user;
          $login->login($identity);


          /*TODO Añadir Usuario a la BD*/
          //require_once('protected/controllers/UsuariosController.php');
          $ctrlUsuarios = new UsuariosController('usuarios');
          $model = $ctrlUsuarios->buscarPorNombre($user->name);

          if($model == null)
          {
            $ctrlUsuarios->Create($user->name,$access_token["oauth_token_secret"]);
          }
          else
          {
            $ctrlUsuarios->Update($model->idUsuarios,$access_token["oauth_token_secret"]);
          }

          header('Location: ..');
        } else 
        {
          /* Save HTTP status for error dialog on connnect page.*/
          unset($_SESSION['access_token']);
          header('Location: ..');
        }
    }
}
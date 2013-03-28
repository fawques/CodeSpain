<?php




class AccesoController extends Controller
{


	public function actionGoogle()
	{
        require_once ('protected/vendors/google-api-php-client/src/Google_Client.php');
        require_once ('protected/vendors/google-api-php-client/src/contrib/Google_PlusService.php');

        session_start();
        
        $client = new Google_Client();
        $client->setClientId('489451579759.apps.googleusercontent.com');
        $client->setClientSecret('vB3LeyMP06S0aHoSw5vYPxJ5');
        $client->setRedirectUri('http://localhost/CodeSpain/index.php/Acceso/Google');
        $client->setDeveloperKey('AIzaSyAm4Db2U-kRW0PjdAlvedYt2eEF8sEzfuU');

        $plus = new Google_PlusService($client);

        if (isset($_REQUEST['logout'])) {
          unset($_SESSION['access_token']);
        }

        if (isset($_GET['code'])) {
          $client->authenticate($_GET['code']);
          $_SESSION['access_token'] = $client->getAccessToken();
          header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if (isset($_SESSION['access_token'])) {
          $client->setAccessToken($_SESSION['access_token']);
        }

        if ($client->getAccessToken()) {
          $me = $plus->people->get('me');

          // These fields are currently filtered through the PHP sanitize filters.
          // See http://www.php.net/manual/en/filter.filters.sanitize.php
          //$url = filter_var($me['url'], FILTER_VALIDATE_URL);
          //$img = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
          $name = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
          //$personMarkup = "<a rel='me' href='$url'>$name</a><div><img src='$img'></div>";


          /*Insertar en BD*/
          $decode = json_decode($_SESSION['access_token'], true);
          $this->GuardarEnBD($name,$decode['access_token']);

          /*$optParams = array('maxResults' => 100);
          $activities = $plus->activities->listActivities('me', 'public', $optParams);
          $activityMarkup = '';
          foreach($activities['items'] as $activity) {
            // These fields are currently filtered through the PHP sanitize filters.
            // See http://www.php.net/manual/en/filter.filters.sanitize.php
            $url = filter_var($activity['url'], FILTER_VALIDATE_URL);
            $title = filter_var($activity['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $content = filter_var($activity['object']['content'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $activityMarkup .= "<div class='activity'><a href='$url'>$title</a><div>$content</div></div>";*/

          // The access token may have been updated lazily.
          $_SESSION['access_token'] = $client->getAccessToken();
        } else {
          if(isset($_GET['error']))
          {
            $urlIni = Yii::app()->createUrl("");
            header("Location: $urlIni");
          }
          else
          {
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);         
          }

        }

	}

  public function actionGoogleCallback()
  {

  }

	public function actionTwitter()
	{
        require_once('protected/vendors/twitteroauth-master/twitteroauth/twitteroauth.php');
        require_once('protected/vendors/twitteroauth-master/config.php');
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
          $urlIni = Yii::app()->createUrl("");
          header("Location: $urlIni");
          return true;

        }

        if (!isset($_REQUEST['oauth_verifier']))
        {
            echo "ok";
            unset($_SESSION['oauth_token']);
            unset($_SESSION['oauth_token_secret']);
            $urlIni = Yii::app()->createUrl("");
            header("Location: $urlIni");
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
          $this->GuardarEnBD($user->name,$access_token["oauth_token_secret"]);
          
        } else 
        {
          /* Save HTTP status for error dialog on connnect page.*/
          unset($_SESSION['access_token']);
          $urlIni = Yii::app()->createUrl("");
          header("Location: $urlIni");
        }
    }

     public function actionFacebook()
     {
        require 'protected/vendors/facebook-php-sdk-master/src/facebook.php';

        $facebook = new Facebook(array(
          'appId'  => '532159653489490',
          'secret' => '6aef4999e4dee55f07022de18aa14c31',
        ));

        // Get User ID
        $user = $facebook->getUser();

        // We may or may not have this data based on whether the user is logged in.
        //
        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.

        if ($user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $facebook->api('/me');
            $this->GuardarEnBD($user_profile["first_name"],$user_profile["id"]);
          } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
          }
        }

        // Login or logout url will be needed depending on current user state.
        if ($user) {
          //$logoutUrl = $facebook->getLogoutUrl();
        } else {
          $loginUrl = $facebook->getLoginUrl();
          header('Location: ' . $loginUrl);

        }

     }

    public function GuardarEnBD($nombre,$token)
    {
          $identity=new UserIdentity($nombre,$token);

          $login=Yii::app()->user;
          $login->login($identity);


          $ctrlUsuarios = new UsuariosController('usuarios');
          $model = $ctrlUsuarios->buscarPorNombre($nombre);

          if($model == null)
          {
            $ctrlUsuarios->Create($nombre,$token);
          }
          else
          {
            $ctrlUsuarios->Update($model->idUsuarios,$token);
          }

          $urlIni = Yii::app()->createUrl("");
          header("Location: $urlIni");
    }
}
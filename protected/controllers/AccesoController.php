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
                

            /*if($connection->http_code == 200)
            {
                $identity=new UserIdentity("$aux",$token);
                $user=Yii::app()->user;
                $user->login($identity);
            }*/

            break;
          default:
            /* Show notification if something went wrong. */
            echo 'No ha sido posible conectar con twitter. Refresca o intentalo más tarde';
        }
    }
}
<?php

class TwitterCallbackController extends Controller
{
	public function actionCallback()
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

		/*TODO Añadir Usuario a la BD*/

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

		  header('Location: ..');
		} else 
		{
		  /* Save HTTP status for error dialog on connnect page.*/
		  unset($_SESSION['access_token']);
		  header('Location: ..');
		}

	}
}
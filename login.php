<?php

require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );

require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookPermissionException.php' );
require_once( 'Facebook/FacebookOtherException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/GraphSessionInfo.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\FacebookClientException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
session_start();
FacebookSession::setDefaultApplication('511295815673416', '30830cfb933fbb3d2a68380735aab3bc');

$redirect_url="http://localhost/Ghost_Post/login.php";
$helper = new FacebookRedirectLoginHelper($redirect_url);
try {
    $session = $helper->getSessionFromRedirect()->getLongLivedSession();

    $access_token=$session->getToken();
    $userid=$_SESSION['userid'];

    $user="root";
	$pass="";
	$db="ghostpost";
    $dbh=mysqli_connect("localhost",$user,$pass,$db) or die("Mysql connection Error");
    $dbh->query("insert into user values($userid,'$access_token')");
    header("location:frame.php");

} catch(FacebookRequestException $ex) {
    var_dump($ex);
} catch(\Exception $ex) {
    var_dump($ex);
}
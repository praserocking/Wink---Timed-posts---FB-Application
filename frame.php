<?php

session_start();

$status=$_SESSION['status'];
$userid=$_SESSION['userid'];
if(isset($_GET['expiry_time']))
	$expiry_time=$_GET['expiry_time'];
else
	$expiry_time=$_SESSION['expiry_time'];

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
require_once( 'Facebook\FacebookClientException.php');
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
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookClientException;



FacebookSession::setDefaultApplication('511295815673416', '30830cfb933fbb3d2a68380735aab3bc');

$user="root";
$pass="";
$db="ghostpost";
$session=NULL;

$dbh=mysqli_connect("localhost",$user,$pass,$db) or die("Mysql connection Error");

$result=$dbh->query("select count(*) from user where FacebookUserId=".$userid);

$temp_array=$result->fetch_array();

if($temp_array[0]==1){
	
	$result=$dbh->query("select FacebookToken from user where FacebookUserId=".$userid);
	$temp_result=$result->fetch_array();
	$access_token=$temp_result[0];
	$session=new FacebookSession($access_token);

	//var_dump($session);

}

if($session){

	try {

		$urlhash=NULL;

		if(isset($_SESSION['posturl']) && $_SESSION['posturl']!='null'){

			$urlhash=md5($_SESSION['posturl']);
			$realurl=$_SESSION['posturl'];
			$posturl="http://localhost/Ghost_Post/urlcount.php?hash=".$urlhash;
			//var_dump($posturl);

			$postvalues=array('message' => $status,'link' => $posturl, 'name' => $realurl, 'description' => $realurl);
		}
		else
			$postvalues=array('message' => $status);

    	$response = (new FacebookRequest($session, 'POST', '/me/feed', $postvalues))->execute()->getGraphObject();

    	$post_id = $response->getProperty('id');
    	$start_time_stamp=date('Y-m-d h:i:s');
    	//var_dump($start_time_stamp);

    	$query="insert into post values($userid,'$post_id','$status','$start_time_stamp','$expiry_time',1234567890)";
    	$dbh->query($query);

    	if(isset($_SESSION['posturl'])&& $_SESSION['posturl']!='null'){
    		$posturi=$_SESSION['posturl'];
    		$query="insert into urls values('$urlhash','$posturi','$post_id',0)";
    		$dbh->query($query);
    	}

    	echo "<center><h2 style='color:#4CC417'>Winked &#10004;</h2></center>";
    	session_destroy();

  	} catch(FacebookRequestException $e) {

    	echo "Exception occured, code: " . $e->getCode();
    	echo " with message: " . $e->getMessage();

  	}

}else{

	$_SESSION['expiry_time']=$expiry_time;
	$redirect_url="http://localhost/Ghost_Post/login.php";
	$helper = new FacebookRedirectLoginHelper($redirect_url);
	$scope = array('publish_actions','read_insights');
	header("location:".$helper->getLoginUrl($scope));

}
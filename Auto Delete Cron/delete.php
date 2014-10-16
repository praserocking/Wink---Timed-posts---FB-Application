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
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

date_default_timezone_set("Asia/Calcutta");
session_start();
FacebookSession::setDefaultApplication('511295815673416', '30830cfb933fbb3d2a68380735aab3bc');

$dbh=mysqli_connect("localhost","root","","ghostpost");
$qry="select * from post";

	$result=$dbh->query($qry);
	$current=time();
	foreach($result as $i){
		$exp=date($i['DeleteTime']);
		if($current >= strtotime($exp))
			delete_post($i['FacebookUserId'],$i['FacebookPostId']);
	}

function delete_post($userid,$postid){

	$dbh=mysqli_connect("localhost","root","","ghostpost");
	$token=$dbh->query("select FacebookToken from user where FacebookUserId='".$userid."'");
	$result=$token->fetch_array();
	$token=$result[0];
	var_dump($postid);
	try{
		$session=new FacebookSession($token);
		var_dump($session->getSessionInfo());
		if($session){
			$request = new FacebookRequest(
		  		$session,
		  		'DELETE',
		  		'/'.$postid
			);
			$response = $request->execute();
			$graphObject = $response->getGraphObject();
		}
	}catch(\Exception $e){var_dump($e);}

}

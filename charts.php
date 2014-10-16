<?php

session_start();

$userid=$_GET['userid'];

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

$dbh=mysqli_connect("localhost",$user,$pass,$db) or die("Mysql connection Error");

$result=$dbh->query("select * from post where FacebookUserId=".$userid);

try{
		$params=array();
		while(($i=$result->fetch_array())){
			$postid=$i['FacebookPostId'];
			$temp=$dbh->query("select counthit from urls where postid='$postid'");
			
			$tmp=$temp->fetch_array();
			$hitcount=$tmp[0];

			$params[]=$hitcount;
		}
		echo json_encode($params);
		
}catch(\Exception $e){
	var_dump($e);
}



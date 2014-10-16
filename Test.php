<?php
$username = "root";
$password = "";
$hostname = "localhost:3306"; 
$db="ghostpost";
//connection to the database

    $mysqli = new mysqli($hostname, $username, $password,$db);
    if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

   // while(true)
    {
        $date=date('Y-m-d h:m:s',time());
       // $date="2014-10-11 12:00:00";
        $query="SELECT * FROM Post WHERE `DeleteTime`=\"$date\"";
        $result=$mysqli->query($query);
        
        while($posts=$result->fetch_array())
        {
            $userId=$posts['FacebookUserId'];
            $query2="SELECT * FROM User WHERE `FacebookUserId`=$userId";
            $result2=$mysqli->query($query2);
            $userRecord=$result2->fetch_array();
            $accessToken=$userRecord['FacebookToken'];
            $postId=$posts['FacebookPostId'];
            
            //echo $accessToken." ".$postId;
            
            // Call the delete function
            deletePost($accessToken,$postId);
        }
    }
?>
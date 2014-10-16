<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
$db="ghostpost";
//connection to the database

    $mysqli = new mysqli($hostname, $username, $password,$db);
    if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
    }
    $userid=$_POST["userid"];
    $result=$mysqli->query("SELECT * FROM Post WHERE `FacebookUserId`=$userid AND `DeleteTime`>=now()");
    $row=$result->fetch_array();
    $x=array();
    $i=0;
    while($row)
    {
        $x[$i++]=array('postid'=>$row['FacebookPostId'],'status'=>$row['Status'],'postedTime'=>$row['RecievedTime'],'deleteTime'=>$row['DeleteTime']);
        $row=$result->fetch_array();
    }
    echo json_encode($x);
?>
<?php

$hash=$_GET['hash'];

$dbh=mysqli_connect("localhost","root","","ghostpost");

var_dump($hash);

$qry="select url,counthit from urls where urlhash='".$hash."'";

$result=$dbh->query($qry);

$temp=$result->fetch_array();

var_dump($temp);

$qry="update urls set counthit=".($temp[1]+1)." where urlhash='".$hash."'";

var_dump($qry);

$dbh->query($qry);

header("location:http://".$temp[0]);
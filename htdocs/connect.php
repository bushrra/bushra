<?php
$servername="localhost";
$username="root";
$password="";
$db = mysqli_connect($servername, $username, $password, 'eb2a_23541458_ai_shopping');

if (!$db){
    die("Database Connection Failed" . mysqli_error($db));
}else{
	
}

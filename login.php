<?php
include 'functions.php';
$db = connect_db();


$user = $_POST["user"];
$pass = $_POST["pass"];

$result = consult_db("admins",$user);

$dbpass = $result[0]["password"];



if($dbpass != NULL && $dbpass == $pass){
	session_start();
	$_SESSION['user'] = $user;
	echo $_SESSION['user'];
	header('Location: edit.php');
}else{
	//login fail
	echo "Login or passwor invalid";
	header('Location: index.php');
}

?>

<?php
session_start();

if (isset($_SESSION['name'])) {
    header('location: ./home.php');
    exit;
}

if (!isset($_POST['submit'])) {
    header('location: ./index.php');
    exit;
}

$secret = $_POST['username'];
$secret_key_1 = "hell@saMYeah$23";
$secret_key_2 = "so&Cool#reHduDe@45";


if($secret_key_1 == $secret){
	$_SESSION['name'] = $secret_key_1;
	
	header('location: ./home.php');
	exit;
}
elseif($secret_key_2 == $secret){
	$_SESSION['name'] = $secret_key_2;
	
	header('location: ./home.php');
	exit;
}
else{
	$_SESSION['login_failed'] = true;
    header('location: ./index.php');
    exit;
}

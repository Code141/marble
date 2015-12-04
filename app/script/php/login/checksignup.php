<?php


$data['logmail'] = stripslashes($_POST['logmail']);
$data['logpass'] = stripslashes($_POST['logpass']);
$data['logpassbis'] = stripslashes($_POST['logpassbis']);
$data['firstname'] = stripslashes($_POST['firstname']);
$data['lastname'] = stripslashes($_POST['lastname']);
$data['birthdate'] = stripslashes($_POST['birthdate']);

if(!isset($_POST['gender'])){
	$data['gender'] = null;
}else{
	$data['gender'] = stripslashes($_POST['gender']);
}



$data['dblogin'] = $data['dblogin']->fetchAll();
if(count($data['dblogin'])!=0){
	header('location:'.SITE_ROOT);
	die();
}else if($data['logpass']!=$data['logpassbis'] OR !isset($_POST['logmail']) OR !isset($_POST['logpass']) OR !isset($_POST['firstname']) OR !isset($_POST['lastname']) OR !isset($_POST['birthdate']) OR !isset($_POST['gender'])){
	header('location:'.SITE_ROOT.'login/signup/'.$data['logmail']);
	die();
}else{
	$data['encrypted_logpass'] = hash('sha512', $data['logpass']);
	return ($data);
}

